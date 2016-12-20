/**
 * Created by Anna on 20.12.2016.
 */
$(document).ready(function () {
    $("#down_to_pc").click(function(event) {
        $(".done_pc").show();
        event.preventDefault();
    })
    setInterval(function () {
        if (!$("#mytits").val()) {
            $(".done_pc").hide();
        }
        else {
            $(".done_pc").show();
        }
    }, 500)

})