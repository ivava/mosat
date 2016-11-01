/* В этом файле собраны все скрипты, участвующие в сервисе */

// Список разрешенных в загрузчике расширений файлов и функция проверки им расширения

var allowed_extensions = [".aac",".AAC",".flac",".FLAC",".m4a",".M4A",".mp3",".MP3",".ogg",".OGG",".wav",".WAV",".wma",".WMA"];

$.ajaxSetup({ cache: false,
    timeout: 45000,
    method: "POST",
    url: "/wp-admin/admin-ajax.php",
    error: function(err) {
        console.log(err); alert('Долгое ожидание от сервиса. Повторите попытку позже!');
    }
});

function has_extension(filename, exts) { return (new RegExp('(' + exts.join('|').replace(/\./g, '\\.') + ')$')).test(filename); }

/* Отправка запроса на сервер для обрезки загруженной песни.
 * Функция вешается на кнопку "Получить рингтон". Сервер должен вернуть контент для отображения в модальном окне */

function get_ringtone(fid) {
    $('.stopcontrol').trigger('click');
    var start_time = parseFloat($('#start-'+fid).val()),
        endtime = parseFloat($('#end-'+fid).val()),
        ringtonetype = $('#ringtone_type-'+fid).val();
    $('.modal-body').html('<div class="preparing-ringtone"><span class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></span> Ваш рингтон обрабатывается. <br/>Подождите, пожалуйста</div>');
    $('#myModal').modal({show:true});

    $.ajax({
        data: {action: "create_ringtone", fileid: fid, starttime: start_time, endtime: endtime, ringtonetype: ringtonetype, mp3support: $('#canplaymp3').val(), oggsupport: $('#canplayogg').val(), aacsupport: $('#canplayaac').val()},
        success: function(mes) {
            $('.modal-body').html(mes);
        }
    });
}

/* Полное удаление песни. Удаляет редактор и отправляет запрос на сервер об удалении остатков этой песни */

function unload_file(fileid) {
    $.ajax({
        data: {action: "unload_ringtone_file", fileid: fileid},
        success: function() {
            if(fileid != 0) {
                $('.editorial#song-'+fileid).remove();
            }
        }
    });
}

function send_captcha() {
    var wait = $('#loading');
    var q = $("#captcha_q").val(), sid = $("#captcha_sid").val(), key = $("#captcha_key").val();
    var block = $('#search-content'); block.empty(); wait.fadeIn();

    if(q == '') { setTimeout(function(){ wait.fadeOut(); }, 500); return false; }

    $.ajax({
        data: { action: "get_audio_from_vk", q: q, captcha_sid: sid, captcha_key: key },
        success: function(dt) { wait.fadeOut('fast', function() { block.html(dt); }); }
    });

    return false;
}

/* Загрузка песни для обработки по ее идентификтору */

function load_for_work(fileid) {
    $('.editorial').hide();
    var parent_elm = $('#loaded_songs');
    $('.design-panel.loading').show();
    if($('.editorial#song-'+fileid).length == 0) {
        $.ajax({
            data: { action: "load_ringtone_for_work",
                fileid: fileid,
                mp3support: $('#canplaymp3').val(),
                oggsupport: $('#canplayogg').val(),
                aacsupport: $('#canplayaac').val()
            }
        }).success(function(mes) {
            mes = $.parseJSON(mes);
            parent_elm.html(parent_elm.html() + mes.html);
            init_editor(fileid, mes.filename, mes.duration, mes.formats);
        });
    }
    $('.design-panel.loading').hide();
    $('.editorial#song-'+fileid).show();
    $('.stopcontrol').trigger('click');
}

/* Проверка поддерживаемых форматов для браузера и заполнение соответствующих полей */

function check_supported() {
    if(buzz.isMP3Supported())
        $('#canplaymp3').val('1');
    if(buzz.isOGGSupported())
        $('#canplayogg').val('1');
    if(buzz.isAACSupported())
        $('#canplayaac').val('1');
}

/* Эта функция инициализирует загрузчик на странице и добавляет обработчики на его события */

function init_uploader() {
    // Starting from here - all upload functions
    // Get the template HTML and remove it from the doument
    previewNode = document.querySelector("#template"); previewNode.id = "";
    previewTemplate = previewNode.parentNode.innerHTML; previewNode.parentNode.removeChild(previewNode);

    window.alertshown = 0;

    myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "/wp-admin/admin-ajax.php?action=upload_ringtone_file", // Set the url
        thumbnailWidth: 80,
        thumbnailHeight: 80,
        parallelUploads: 3,
        acceptedFiles: '.aac,.AAC,.flac,.FLAC,.m4a,.M4A,.mp3,.MP3,.ogg,.OGG,.wav,.WAV,.wma,.WMA',
        previewTemplate: previewTemplate,
        autoQueue: true, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    });

    // При добавлении файла проверяем, чтобы файлов было не более 5, и тип файла
    myDropzone.on("addedfile", function (file) {
        $('button.cancel').show();
        var f = $('#audio-preview-block').offset(), y = f.top - 10;
        $('html, body').animate({scrollTop: y},500);
        if (myDropzone.files.length > 1) {
            myDropzone.removeFile(file);
            if (window.alertshown == 0) {
                alert('Максимальное число одновременно обрабатываемых файлов: 1');
                window.alertshown = 1;
            }
        }
        if(!has_extension(file.name, allowed_extensions)) {
            myDropzone.removeFile(file);
            alert('Данный тип файлов не поддерживается');
        }
    });

    // При нажатии на кнопку сброса нужно ее скрыть, а на сервер отправить сообщение о сбросе
    myDropzone.on("reset", function (file) {
        $('button.cancel').hide();
        $.ajax({ data: {action: "reset_ringtone_form"} });
        $('.editorial').each(function() {
            var thisid = $(this).attr('id').replace('song-', '');
            if(thisid != 0) { $(this).remove(); }
        });
    });

    // Обновляем состояние общего прогрессбара во время загрузки
    myDropzone.on("totaluploadprogress", function (progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
    });

    // Когда запускается загрузка хотя бы одного файла, включаем общий прогрессбар
    myDropzone.on("sending", function (file) {
        document.querySelector("#total-progress").style.opacity = "1";
    });

    // После окончания загрузки всех файлов нужно спрятать общий прогрессбар
    myDropzone.on("queuecomplete", function (progress) {
        document.querySelector("#total-progress").style.opacity = "0";
        $('.file-wrapper').first().trigger('click');
    });

    // После загрузки файла, его контейнер нужно сделать кликабельным, а также заменить фон на вейвформу
    myDropzone.on("success", function (file, response) {
        var responseMes = jQuery.parseJSON(response);
        file.previewElement.querySelector('span.remove').setAttribute('style', 'display:inline-block !important');
        file.previewElement.querySelector('span.remove').setAttribute('onclick', 'unload_file(\'' + responseMes.fileid + '\')');
        file.previewElement.querySelector('div.waveform_preview').innerHTML = '<div class="wform" style="background-image:url(' + responseMes.background + ');"></div>';
        file.previewElement.querySelector('span.remove').addEventListener("click", function () {
            myDropzone.removeFile(file);
        });
        file.previewElement.querySelector('div.file-wrapper').setAttribute('onclick', 'load_for_work(\'' + responseMes.fileid + '\')');
    });
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    $("button.cancel, .fileinput-button").on('click', function () {
        myDropzone.removeAllFiles(true);
        if($('button.cancel').is(':visible')) {
            $('button.cancel').hide();
            $.ajax({ data: {action: "form_reset"} });
            $('.editorial').each(function() {
                var thisid = $(this).attr('id').replace('song-', '');
                if(thisid != 0) $(this).remove();
            });
        } $('#previews').empty();
    });
}

/* Инициализация редактора мелодии. Превращает 2 инпута и имя файла в визуально доступный редактор
 * цепляет обработчики на различные действия в редакторе, управляет кнопками пуска и остановки, обрезки
 * и лимитирования */

function init_editor(fid, filename, duration, formats) {
    formats = typeof formats !== 'undefined' ? formats : ['mp3', 'ogg', 'aac'];
    // Starting from here - all edit functions
    var $range1 = $('#range-'+fid),
        $range2 = $('#position-'+fid),
        srange, sposition, song, starttime, endtime, diftime, curtime, playtimer;

    starttime = endtime = 0;

    function playpause() {
        if (song.isPaused()) {
            if (starttime == 0)
                starttime = parseFloat($('#start-'+fid).val());
            endtime = parseFloat($('#end-'+fid).val());
            console.log(starttime);
            diftime = endtime - starttime;
            song.setTime(starttime).play();
            console.log(song.getTime());
            song.bind("ended", function () {
                playstop(true);
            });
            playtimer = $.timer(10, function () {
                curtime = song.getTime();
                sposition.update({from: curtime});
                if (curtime >= endtime) {
                    if ($('#repeatinput-'+fid).val() == "1") {
                        song.setTime(parseFloat($('#start-'+fid).val()));
                    } else {
                        playstop(true);
                        playtimer.stop();
                    }
                }
            });
            $('#play-'+fid).html('<span class="glyphicon glyphicon-pause"></span>');
        } else {
            playstop(false);
        }
    }

    function playstop(force_stop) {
        if (!song.isPaused()) {
            starttime = song.getTime();
            endtime = parseFloat($('#end-'+fid).val());
            playtimer.stop();
            song.pause();
            $('#play-'+fid).html('<span class="glyphicon glyphicon-play"></span>');
            if (force_stop) {
                starttime = parseFloat($('#start-'+fid).val());
                song.stop();
            }
            sposition.update({from: starttime});
        }
    }

    song = new buzz.sound(filename, {formats: formats});

    $('#play-'+fid).on('click', function () {
        playpause();
    });

    $('#stop-'+fid).on('click', function () {
        playstop(true);
    });

    $('#repeat-'+fid).on('click', function () {
        if ($(this).hasClass('btn-warning')) {
            $(this).removeClass('btn-warning').addClass('btn-default');
            $('#repeatinput-'+fid).val('0');
        } else {
            $(this).removeClass('btn-default').addClass('btn-warning');
            $('#repeatinput-'+fid).val('1');
        }
    });

    $('#toggle_limit-'+fid).on('click', function () {
        if ($(this).hasClass('btn-warning')) {
            $(this).removeClass('btn-warning').addClass('btn-default');
            $('#limitinput-'+fid).val('0');
            srange.update({max_interval: 600});
        } else {
            $(this).removeClass('btn-default').addClass('btn-warning');
            $('#limitinput-'+fid).val('1');
            var to_time = parseFloat($('#start-'+fid).val()) + 30;
            if (parseFloat($('#end-'+fid).val()) > to_time) {
                srange.update({to: to_time});
                $('#end-'+fid).val(to_time);
            }
            srange.update({max_interval: 30})
        }
    });

    $('.rtype_selector').on('click', function () {
        if ($(this).hasClass('btn-default')) {
            $('.rtype_selector').removeClass('btn-warning').addClass('btn-default');
            $(this).removeClass('btn-default').addClass('btn-warning');
            $('#ringtone_type-'+fid).val($(this).attr('id').replace('-'+fid, ''));
        }
    });


    $range1.ionRangeSlider({
        type: "double",
        min: 0,
        max: duration,
        from: 0,
        to: duration,
        step: 0.1,
        min_interval: 5,
        max_interval: 600,
        drag_interval: true,
        onChange: function (data) {
            playstop(true);
            starttime = data.from;
            sposition.update({from: data.from, from_min: data.from, from_max: data.to});
            $('#start-'+fid).val(data.from);
            $('#end-'+fid).val(data.to);
        }, onUpdate: function (data) {
            sposition.update({from: data.from, from_min: data.from, from_max: data.to});
            playstop(true);
            starttime = data.from;
        }
    });

    $range2.ionRangeSlider({
        type: "single",
        min: 0,
        max: duration,
        from: 0,
        to: duration,
        step: 0.1,
        onUpdate: function (data) {
            //console.log('slider pos: ' + data.from);
        }, onChange: function (data) {
            starttime = data.from;
        }
    });

    $("#start-"+fid).TouchSpin({
        min: 0,
        max: duration,
        step: 0.1,
        decimals: 1,
        boostat: 5,
        maxboostedstep: 10,
        buttondown_class: 'btn btn-danger',
        buttonup_class: 'btn btn-success',
        buttondown_txt: '<span class="glyphicon glyphicon-minus"></span>',
        buttonup_txt: '<span class="glyphicon glyphicon-plus"></span>'
    }).change(function () {
        if (parseFloat($(this).val()) > parseFloat($('#end-'+fid).val()) - 5)
            $(this).val(parseFloat($('#end-'+fid).val()) - 5);
        else {
            srange.update({from: $('#start-'+fid).val()});
        }
        if($('#limitinput-'+fid).val() == "1") {
            if (parseFloat($(this).val()) < parseFloat($('#end-'+fid).val()) - 30)
                $(this).val(parseFloat($('#end-'+fid).val()) - 30);
            else {
                srange.update({from: $('#start-'+fid).val()});
            }
        }

    });

    $("#end-"+fid).TouchSpin({
        min: 0,
        max: duration,
        step: 0.1,
        decimals: 1,
        boostat: 5,
        maxboostedstep: 10,
        buttondown_class: 'btn btn-danger',
        buttonup_class: 'btn btn-success',
        buttondown_txt: '<span class="glyphicon glyphicon-minus"></span>',
        buttonup_txt: '<span class="glyphicon glyphicon-plus"></span>'
    }).change(function () {
        if (parseFloat($(this).val()) < parseFloat($('#start-'+fid).val()) + 5)
            $(this).val(parseFloat($('#start-'+fid).val()) + 5);
        else
            srange.update({to: $('#end-'+fid).val()});
        if($('#limitinput-'+fid).val() == "1") {
            if (parseFloat($(this).val()) > parseFloat($('#start-'+fid).val()) + 30)
                $(this).val(parseFloat($('#start-'+fid).val()) + 30);
            else
                srange.update({to: $('#end-'+fid).val()});
        }
    });

    srange = $range1.data('ionRangeSlider');
    sposition = $range2.data('ionRangeSlider');
}

/* Центрирование модального окна по вертикали */

function reposition() {
    var modal = $(this),
        dialog = modal.find('.modal-dialog');
    modal.css('display', 'block');
    // Dividing by two centers the modal exactly, but dividing by three
    // or four works better for larger screens.
    dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 3));
}