function reveal()
{
    rafId = null;
    var now = performance.now();
    if (now - lTime > delay)
    {
        lTime = now;
        var $ts = $('.reveal_pending');
        $($ts.get(0)).removeClass('reveal_pending').addClass('reveal_visible');
    }
    if ($('.reveal_pending').length >= 1) rafId = requestAnimationFrame(reveal);
}
$(document).ready(function () {
    if(navigator.userAgent.toLowerCase().indexOf('chrome') > -1)
    {
        // jQuery.scrollSpeed(100, 800, 'easeOutCubic');
    }
    else
    {
    }
    ua = navigator.userAgent.toLowerCase();
    if (ua.indexOf('safari') != 1)
    {
       // if (ua.indexOf('chrome') > -1) {
            //**********************start reveal ready****************//
            $(scroll);
            $(window).scroll(scroll);
            $(window).load(function ()
            {
                $('.reveal').removeClass('reveal_visible').removeClass('reveal_pending');
                $('.reveal-left').removeClass('reveal_visible').removeClass('reveal_pending');
                $('.reveal-top').removeClass('reveal_visible').removeClass('reveal_pending');
                $('.reveal-right').removeClass('reveal_visible').removeClass('reveal_pending');
                $('.reveal-rotate').removeClass('reveal_visible').removeClass('reveal_pending');
                $('.reveal-zoom').removeClass('reveal_visible').removeClass('reveal_pending');
                $('.reveal-return-left').removeClass('reveal_visible').removeClass('reveal_pending');
                $('.reveal-return-right').removeClass('reveal_visible').removeClass('reveal_pending');
                lTime = performance.now() - 100;
                var top = $(window).scrollTop();
                $(window).scrollTop(top === 0 ? 1 : top - 1);
            });
            $(".ui-tab1,.ui-tab2,.ui-tab3,.ui-tab4,.ui-tab5").click(function ()
            {
                $('.reveal').removeClass('reveal_visible').removeClass('reveal_pending');
                $('.reveal-left').removeClass('reveal_visible').removeClass('reveal_pending');
                $('.reveal-top').removeClass('reveal_visible').removeClass('reveal_pending');
                $('.reveal-right').removeClass('reveal_visible').removeClass('reveal_pending');
                $('.reveal-rotate').removeClass('reveal_visible').removeClass('reveal_pending');
                $('.reveal-zoom').removeClass('reveal_visible').removeClass('reveal_pending');
                $('.reveal-return-left').removeClass('reveal_visible').removeClass('reveal_pending');
                $('.reveal-return-right').removeClass('reveal_visible').removeClass('reveal_pending');
                lTime = performance.now() - 100;
                var top = $(window).scrollTop();
                $(window).scrollTop(top === 0 ? 1 : top - 1);
            });
            //**********************end reveal ready****************************//
        }
        else
        {
            $('.reveal').removeClass('reveal');
            $('.reveal-left').removeClass('reveal-left');
            $('.reveal-top').removeClass('reveal-top');
            $('.reveal-right').removeClass('reveal-right');
            $('.reveal-bottom').removeClass('reveal-bottom');
            $('.reveal-rotate').removeClass('reveal-rotate');
            $('.reveal-zoom').removeClass('reveal-zoom');
            $('.reveal-return-left').removeClass('reveal-return-left');
            $('.reveal-return-right').removeClass('reveal-return-right');
            var headerHH=$(".header-main").height();
            $(".jq-section-first").height($(window).height()-headerHH);
            $(".jq-section-first .slick-slider").height($(window).height()-headerHH);
            $(".jq-section-first .Modern-Slider .item .info > .position").height($(window).height()-headerHH);
            $(".jq-section-first .Modern-Slider .item .slide1-image3,.jq-section-first .Modern-Slider .item .slide5-image1,.jq-section-first .Modern-Slider .item .slide5-image2,.jq-section-first .Modern-Slider .item .slide5-image3,.jq-section-first .Modern-Slider .item .slide5-image4,.jq-section-first .Modern-Slider .item .slide5-image5,.jq-section-first .Modern-Slider .item .slide5-left-square,.jq-section-first .Modern-Slider .item .slide5-left-square,.jq-section-first .Modern-Slider .item .slide4-left-square,.jq-section-first .Modern-Slider .item .slide3-image5,.jq-section-first .Modern-Slider .item .slide2-image1-rectangle,.jq-section-first .Modern-Slider .item .slide1-image2,.jq-section-first .Modern-Slider .item .slide4-image1,.jq-section-first .Modern-Slider .item .slide4-image2,.jq-section-first .Modern-Slider .item .slide4-image3,.jq-section-first .Modern-Slider .item .slide4-image4").height($(window).height()-headerHH);
            $(".jq-section-first .img-fill .img").height($(window).height()-headerHH);
            $(".jq-section-first .Modern-Slider .item .info > .position").width($(window).width());
            $(".jq-section-first .img-fill .img").width($(window).width());
            $(".section-main-container .display-cell .content-container .benifits-container .bottom-container .item-container").addClass("floating-left");
        }
});

