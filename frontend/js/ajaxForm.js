$(document).ready(function() {
saveEditForm($('#editFullName'));
saveEditForm($('#editBio'));
    function saveEditForm(formId) {
        var request = $.ajax({
            url: '../backend/editProfile.php',
            type: 'POST',
            data: formId
        });
        request.success = function(msg) {
            alert('Данные Сохранены')
        }
        request.error = function () {
            alert('Ошибка');
        }
    }
});