<?php
include ('templates/header.php');
require ('../backend/classes/Music.php');
//require ('../backend/config.php');

$music = Music::getMusicById($_SESSION['music_id']);
?>
<div class="progress progress-striped active">
    <div class="progress-bar" style="width: 66%;">
    </div>
</div>
<div class="container text-center">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form class="down_img" action="../backend/upload_thumb.php" method="post" enctype="multipart/form-data"
                  id="downloadMusic">
                <input type="hidden" name="MAX_FILE_SIZE" value="160000000">
                <div class="file_upload">
                    <button id="down_to_pc" type="button" class="btn btn-primary btn-lg">Выбрать обложку для трека
                    </button>
                    <div>Файл не выбран</div>
                    <input id="mydick" type="file" name="music_thumb" required>
                </div>
                <input class="down_btn_text done_pc" type="submit" value="Загрузить и просмотреть обложку">

            </form>
        </div>
    </div>
</div>


<script>
    $(document).ready(function () {
            $("#down_to_pc").click(function(event) {
                $(".done_pc").show();
                event.preventDefault();
            })
            setInterval(function () {
                if (!$("#mydick").val()) {
                    $(".done_pc").hide();
                }
                else {
                    $(".done_pc").show();
                }
            }, 100)

        }
        /* $("#save_name").on('submit', function() {
         $(".down_img").show();
         });*/
    )

</script>



