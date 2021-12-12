/**
 * Created by osaid zalloum Manhal on 18/09/2016.
 */
$(document).ready(function () {
    var swiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        paginationType: 'fraction'
    });


    var swiper = new Swiper('.gallery-thumbs', {
        pagination: '.swiper-pagination',
        slidesPerView: 4,
        paginationClickable: true,
        spaceBetween: 30
    });

})