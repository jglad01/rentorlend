$(document).ready(function () {
    $('.rating-star').on('mouseenter mouseleave click', function () {
        $(this).toggleClass('star-checked');
        $(this).prevAll('.rating-star').toggleClass('star-checked');
    }).on('click', function () {
        let ratingValue = $(this).attr('data-rating-value');
        $(this).parents('.rating-container').siblings('.rating-submit').find('#rating-value').attr('value', ratingValue);
    })
});