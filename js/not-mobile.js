
$(document).ready(function () {
});
function scroll()
{
    var scrollTop = $(window).scrollTop();
    var height = $(window).height();
    var visibleTop = scrollTop + height;
    //if($(window).width()>1024)
    //{
    if(scrollTop>= window.topHeaderHeight)
    {
        $(".bottom-header-container").css("top","0px");
        $(".bottom-header-container").css("position","fixed");
        $("header .buy-content-container,header .after-login-content-container").css("top", headerHeightmain1 -2);
        $("header .after-login-content-container1").css("top", headerHeightmain1 - 3);

        $("header .bottom-header-container .menu-header-container nav li .current-tab").css("top", headerHeightmain1);
    }
    else
    {
        $(".bottom-header-container").css("position","initial");
        $("header .buy-content-container,header .after-login-content-container").css("top", headerHeightmain -2);
        $("header .after-login-content-container1").css("top", headerHeightmain - 2);

        $("header .bottom-header-container .menu-header-container nav li .current-tab").css("top", headerHeightmain + "px");
    }
    //}
    $('.reveal,.reveal-left,.reveal-right,.reveal-top,.reveal-rotate,.reveal-zoom,.bounceInUp,.reveal-bottom,.reveal-return-left,.reveal-return-right').each(function ()
    {
        var $t = $(this);
        if ($t.hasClass('reveal_visible'))
        {
            return;
        }
        var top = $t.offset().top - bottomheadercontainer;
        if (top <= visibleTop) {
            if (top + $t.height() < scrollTop)
            {
                $t.removeClass('reveal_pending').addClass('reveal_visible');
            }
            else
            {
                $t.addClass('reveal_pending');
                if (!rafId) requestAnimationFrame(reveal);
            }
        }
    });
}