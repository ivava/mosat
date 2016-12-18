$(document).ready(function() {
    var cropProgress = $('#cropProgress');
    cropProgress.slider({
        animate: 'fast',
        max: 100,
        min: 10,
        range: true,
        values: [0, 50]
    })
    var values = cropProgress.slider('values');
    var minValue = cropProgress.slider('option', 'min');
    var maxValue = cropProgress.slider('option', 'max');
    var minCont = $('.min_val');
    var maxCont = $('.max_val');

    minCont.text(minValue);
    maxCont.text(maxValue);

    cropProgress.on('slidechange', function(event, ui) {
        minCont.text(ui.values[0]);
        maxCont.text(ui.values[1]);
    })
});