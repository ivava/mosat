$(document).ready(function () {
    var likeCount = $('.like_count');
    likeCount.click(function(event) {
        var id = $('#mId').val();
        var uId = $('#uId').val();
        event.preventDefault();
        $.ajax(
            {
                url: '../backend/like.php',
                data: 'id=' + id + '&' + uId,
                success: function (data) {
                    alert(data);
                }
            }
        )
    })
});