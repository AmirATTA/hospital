$(document).ready(function () {
    $('input.comma').on('keyup', function(event) {
        if(event.which >= 37 && event.which <= 40) return;
        $(this).val(function(index, value) {
            return value
                .replace(/\D/g, "")
                .replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        });
    });
});

$(document).ready(function () {
    $('.comma').each(function () {
        var value = $(this).text();
        $(this).text(value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    });
});

$(document).ready(function () {
    $('input.comma').each(function () {
        var value = $(this).val();
        $(this).val(value.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ","));
    });
});