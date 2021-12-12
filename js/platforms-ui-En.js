    //**********************start reveal**********************//
var openBuy = 0;
var openuser = 0;
var openfeedbacks=0;
var openlanguage = 0;
var rafId = null;
var delay = 0;
var lTime = 0;
var menus=0;
var phonemenu=0;
var editoropen = 0;
var WarningMessage=0;
//***********************end reveal**************************//
function readURL(input,id)
{
    if (input.files && input.files[0])
    {
        var reader = new FileReader();
        reader.onload = function (e) {
           // document.getElementById(id).src=e.target.result;
            resizedataURL(e.target.result, 200, 200,id);
            $("#"+id).attr("updated","1");
        }
        reader.readAsDataURL(input.files[0]);
    }
}
function resizedataURL(datas, wantedWidth, wantedHeight,id)
{
    // We create an image to receive the Data URI
    var img = document.createElement('img');
    // When the event "onload" is triggered we can resize the image.
    img.onload = function()
    {
        // We create a canvas and get its context.
        var canvas = document.createElement('canvas');
        var ctx = canvas.getContext('2d');
        // We set the dimensions at the wanted size.
        canvas.width = wantedWidth;
        canvas.height = wantedHeight;
        // We resize the image with the canvas method drawImage();
        ctx.drawImage(this, 0, 0, wantedWidth, wantedHeight);
        var dataURI = canvas.toDataURL();
            document.getElementById(id).src=dataURI
        /////////////////////////////////////////
        // Use and treat your Data URI here !! //
        /////////////////////////////////////////
    };
    // We put the Data URI in the image's src attribute
    img.src = datas;
}
function calcIframe() {
    if($(window).width()>=1024){
        var w=1024;
    }else{
        var w=$(".center-piece").width()-12;
    }
    var h=w*0.75;

    $(".Game-play-main-container .Game-play-iframe").height(h);
    $(".Game-play-main-container .Game-play-iframe").width(w);
}
    $(window).on('scroll', function (e) {
        if (phonemenu == 1) {
            scrollAmount = $(this).scrollTop();
            if (scrollAmount < 1) {
                $(this).scrollTop(1);
            }
            if (scrollAmount > $(document).height() - $(window).height()) {
                $(this).scrollTop($(window).height());
            }
        }
    });
    $("body").bind('touchmove', function (e) {
            if (phonemenu == 1) {
                // $(window).scrollTo(0,0);
                e.preventDefault();
            }
        }
    );
    $(document).ready(function () {
        $(".tooltip-lms").click(function() {
            $(".custom.help").fadeToggle();
        });
        $(".jq_close_download").on('click', function () {
            $(".popup-main-container-b .popup-content").removeClass("fadeInDownBig");
            $(".popup-main-container-b").hide();
        });
        $(".popup-main-container-c .close-container a i").on('click', function () {
            $(".popup-main-container-c .popup-content").removeClass("fadeInDownBig");
            $(".popup-main-container-c").hide();
            $("body").css("overflow-y","auto");
            $("body").css("position","relative");
            $(".site-container").css("pointer-events","auto");
            y=$(".site-container").css("transform").split(",");
            y[5]=y[5].replace(")","");
            $(document).scrollTop(parseInt(y[5])*-1);
            console.log("y",y[5]);
            $(".site-container").css("transform","");
        });
        $(".viewseries").on('click', function () {
            $(".popup-container-c").addClass("fadeInDownBig").addClass("animated1");
            $(".popup-main-container-c").fadeIn();
            $("body").css("overflow-y","hidden");
            $(".full-page").css("overflow-y","hidden");
            $("body").css("position","fixed");
            $("body").css("width","100%");
        });
        $('.inner-pages-main-container-galleries-inner .galleries-inner-content .main-galleries-container .item-container').click(function(){
            $("body").css("overflow-y","hidden");
            $(".full-page").css("overflow-y","hidden");
            $("body").css("position","fixed");
            $("body").css("width","100%");
        });
        $('.close-container-gall a').click(function(){
            $("body").css("overflow-y","auto");
            $(".full-page").css("overflow-y","auto");
            $("body").css("position","relative");

        });
            $(".full-page").on('scroll', function (e) {
        if (phonemenu == 1) {
            scrollAmount = $(this).scrollTop();
            if (scrollAmount < 1) {
                $(this).scrollTop(1);
            }
            if (scrollAmount > $(document).height() - $(window).height()) {
                $(this).scrollTop($(window).height());
            }
        }
    });
    $(".full-page").bind('touchmove', function (e) {
            if (phonemenu == 1) {
                e.preventDefault();
            }
        }
    );
    $('.backgoround-menu').click(function(){
        e.preventDefault();
        e.stopPropagation();
    });
        $('a').bind('touchend', function() {});
    $('.exit-full-screen').click(function(){
        $("#jq-iframe").attr("src","");
        exitFullscreen();
        $('#Game-play-iframe').removeClass("active");
    });
    calcIframe();
    $(window).on("resize",function () {
        calcIframe();
    });
    $('.imageurl').click(function(){
        $(".popup-main-container-sub").fadeIn();
        $(".popup-main-container-sub .popup-container").addClass("animated1 fadeInDownBig").css("display","inline-block");
        $(".popup-main-container-sub .popup-content").fadeIn();
        $(".popup-main-container-sub .popup-content img").attr("src",$(this).attr("image_url"));
    });
    $('.popup-main-container-sub .close-container a').click(function() {
        $(".popup-main-container-sub").fadeOut();
        $(".popup-main-container-sub .popup-container").removeClass("animated1 fadeInDownBig").fadeOut();
        $(".popup-main-container-sub .popup-content").fadeOut();
    });
    $('.toggle-form').click(function(){
        $(".about-us-main-container #contact_form").slideToggle();
    });
    $('.accordion a').click(function(){
        $(this).toggleClass('active');
        $(this).next('.content').slideToggle(400);
    });
    $("body").click(function(e)
    {
        if($(e.target).closest(".close-all-popup").attr("class")==undefined && $(e.target).closest(".responsive-menu-container").attr("class")==undefined && $(e.target).closest(".buy-button").attr("class")==undefined && $(e.target).closest(".after-login-container").attr("class")==undefined && $(e.target).closest(".modal *").attr("class")==undefined && $(e.target).closest(".modal-header .close").attr("class")==undefined)
         {
             closebuycontents();
             $(".container-a").addClass("fade-right-social");
             $(".container-b").addClass("fade-right-social");
             $(".container-c").addClass("fade-right-social");
             $(".container-a").removeClass("fade-left-social");
             $(".container-b").removeClass("fade-left-social");
             $(".container-c").removeClass("fade-left-social");
             closeusercontnets();
             closelanuagecontnets();
             if($(window).width()<= 1024)
             {
                 closeMenu();
                 $(".menu-toggle").removeClass("on");
                 $(".backgoround-menu").fadeOut();
             }
         }
    });
    $(".tooltip").click(function()
    {
        $(".tooltip span").fadeToggle();
    });
    $(".tooltip").hover(function()
    {
        $(".tooltip span").fadeToggle();
    });
    $(".tooltip-a").click(function()
    {
        $(".tooltip-a .defualt-a").fadeToggle();
    });
    $(".tooltip-a").hover(function()
    {
        $(".tooltip-a .defualt-a").fadeToggle();
    });
    $(".view-map").click(function()
    {
        $(".iframe-container .manhal-loader-main-container").fadeIn();
        $(".map-container").attr("src", $(this).attr("data-value"));
        $("body").animate({
            scrollTop: $(".map-container").offset().top
        }, 2000)
    });
    $('.map-container').on('load', function()
    {
        $(".iframe-container .manhal-loader-main-container").fadeOut();
    });
    //**********************start get current date*****************//
    //**********************warning message************************//
    $(document).on("click",".warning.message a", function ()
    {
        if(WarningMessage==0)
        {
            openWarningMessage();
        }
        else
        {
            closeWarningMessage();
        }
    });
    // vDevice = navigator.platform; if (vDevice.indexOf("iPhone") > -1 || vDevice.indexOf("iPod")> -1 || vDevice.indexOf("iPad") > -1) {
    //     alert($(window).width());
    //     alert($(window).height());
    // };

        $(document).on("click", "header .bottom-header-container .menu-header-container nav li.jq_menu", function ()
        {
            console.log($(this));
            if(menus==0)
            {
                $(this).find(".current-tab-ipads").show();
                $(this).find("a.Education").addClass("Education-b");
                $(this).find(".a.Education").removeClass("Education-a");
                menus=1;
            }
            else
            {
                $(this).find(".current-tab-ipads").hide();
                $(this).find("a.Education").removeClass("Education-b");
                $(this).find("a.Education").addClass("Education-a");
                menus=0;
            }
        });

    $(".menu-toggle").click(function(e){
        if(phonemenu==0)
        {
            phonemenu=1;
            $(this).addClass("on");
            $(".menu").addClass("active");
            $("header .bottom-header-container .menu-header-container nav").height($(window).height()-$("header .bottom-header-container").height()-30);
            $(".menu-header-container nav").show();
            $(".backgoround-menu").show();
            $(".menu-header-container nav li.active").each(function(i){
                $(this).css("margin-Left", "0px");
            });
            $(".site-container").css("transform","translatey("+($(document).scrollTop()*-1).toString()+"px)");
            $("body").css("overflow-y","hidden");
            $(".full-page").css("overflow-y","hidden");
            $("body").css("position","fixed");
            $("body").css("width","100%");
            $(".site-container").css("pointer-events","none");
        }
        else
        {
            phonemenu=0;
            closeMenu();
            $(this).removeClass("on");
            $(".menu").removeClass("active");
            $(".current-tab-ipads").hide();
            $(".backgoround-menu").hide();
            $(".last-childs a.Education").removeClass("Education-b");
            $(".last-childs a.Education").addClass("Education-a");

            $("body").css("overflow-y","auto");
            $(".full-page").css("overflow-y","auto");
            $("body").css("position","relative");
            $(".site-container").css("pointer-events","auto");
            x=$(".site-container").css("transform").split(",");
            x[5]=x[5].replace(")","");
            $(document).scrollTop(parseInt(x[5])*-1);
            console.log("x",x[5]);
            $(".site-container").css("transform","");
        }
    });
    $(".popup-layer").click(function()
    {
        closeMenu();
    });
    $(window).bind('orientationchange', function(event)
    {
        $(scroll);
        $(window).scroll(scroll);
        sectionHeight();
    });
    $( window ).resize(function()
    {
        $(scroll);
        $(window).scroll(scroll);
        sectionHeight();
    });
    //start editor page
    $(document).on("click", ".inner-pages-main-container-editor .button", function ()
    {
        if($(this).closest(".inner-item-container").find(".container-to-open").hasClass("open"))
        {
            $(this).closest(".inner-item-container").find(".container-to-open").removeClass("open");
            $(this).find("i").removeClass("rotate");
        }
        else
        {
            $(".container-to-open").removeClass("open");
            $(this).closest(".inner-item-container").find(".container-to-open").addClass("open");
            $(this).closest(".inner-item-container").find(".container-to-open").slideDown();
            $("i").removeClass("rotate");
            $(this).find("i").addClass("rotate");
        }
    });
    //end editor page
    var clickedTab = $(".tabs .active");
    var tabWrapper = $(".tab__content");
    var activeTab = tabWrapper.find(".active");
    var activeTabHeight = activeTab.height();
    // Show tab on page load
    activeTab.show();
    // Set height of wrapper on page load
    tabWrapper.height(activeTabHeight);
    //alert($(tabWrapper).height())
    $(".tabs li").on("click", function()
    {
        tabWrapper.height(activeTabHeight);
        // Remove class from active tab
        $(".tabs li").removeClass("active");
        // Add class active to clicked tab
        $(this).addClass("active");
        // Update clickedTab variable
        clickedTab = $(".tabs .active");
        // fade out active tab
        activeTab.fadeOut(250, function()
        {
            // Remove active class all tabs
            $(".tab__content .tab-li").removeClass("active");
            // Get index of clicked tab
            var clickedTabIndex = clickedTab.index();
            // Add class active to corresponding tab
            $(".tab__content .tab-li").eq(clickedTabIndex).addClass("active");
            // update new active tab
            activeTab = $(".tab__content .active");
            // Update variable
            activeTabHeight = activeTab.outerHeight();
            // Animate height of wrapper to new tab height
            tabWrapper.stop().delay(50).animate({
                height: activeTabHeight
            }, 10, function() {
                // Fade in active tab
                activeTab.delay(50).fadeIn(250);
            });
        });
    });
    //start slider items//
    $('#slider .item').each(function(i){
        var $this = $(this),
            width = $this.width(),
            left = width * i,
            color = 25 * i;
        $this.css({ left: left });

    });
    $('#slider .item .inset').each(function(){
        var $this = $(this),
            color = $this.css('backgroundColor');
        $this.append('<div class="shadow"></div>');
        $this.find('.shadow').css({
            position: 'absolute',
            left: 0, right: 0, bottom: 0,
            'box-shadow': '0 0 25px 25px ' + color
        });
    });
    $('.trigger').on('click',function()
    {
        var $this = $(this),
            width = $('.item').width() * 4,
            speed = 500;
        if ( $this.hasClass('first') ) {
            $('.frame').animate({ scrollLeft: 0 },speed * 3);
        } else if ( $this.hasClass('last') ) {
            $('.frame').animate({ scrollLeft: $('.frame')[0].scrollWidth },speed * 3);
        } else if ( $this.hasClass('prev') ) {
            $('.frame').animate({ scrollLeft: '-=' + width },speed);
        } else if ( $this.hasClass('next') ) {
            $('.frame').animate({ scrollLeft: '+=' + width },speed);
        }
    });
    //end slider items//
    $(document).on("click", ".social-share-position-container .buttons-content a", function ()
    {
      var conSocial=$(this).attr("id");
        switch(conSocial)
        {
            case "facebook_Position":
                if($(".container-a").hasClass("fade-right-social"))
                {
                    $(".container-a").removeClass("fade-right-social");
                    $(".container-a").addClass("fade-left-social");
                    $(".container-b").addClass("fade-right-social");
                    $(".container-b").removeClass("fade-left-social");
                    $(".container-c").addClass("fade-right-social");
                    $(".container-c").removeClass("fade-left-social");
                }
                else
                {
                    $(".container-a").addClass("fade-right-social");
                    $(".container-a").removeClass("fade-left-social");
                    $(".container-b").addClass("fade-right-social");
                    $(".container-b").removeClass("fade-left-social");
                    $(".container-c").addClass("fade-right-social");
                    $(".container-c").removeClass("fade-left-social");
                }
                break;
            case "twitter_Position":
                if($(".container-b").hasClass("fade-right-social"))
                {
                    $(".container-b").removeClass("fade-right-social");
                    $(".container-b").addClass("fade-left-social");
                    $(".container-a").addClass("fade-right-social");
                    $(".container-a").removeClass("fade-left-social");
                    $(".container-c").addClass("fade-right-social");
                    $(".container-c").removeClass("fade-left-social");
                }
                else
                {
                    $(".container-b").addClass("fade-right-social");
                    $(".container-b").removeClass("fade-left-social");
                    $(".container-a").addClass("fade-right-social");
                    $(".container-a").removeClass("fade-left-social");
                    $(".container-c").addClass("fade-right-social");
                    $(".container-c").removeClass("fade-left-social");
                }
                break;
            case "youtube_Position":
                if($(".container-c").hasClass("fade-right-social"))
                {
                    $(".container-c").removeClass("fade-right-social");
                    $(".container-c").addClass("fade-left-social");
                    $(".container-a").addClass("fade-right-social");
                    $(".container-a").removeClass("fade-left-social");
                    $(".container-b").addClass("fade-right-social");
                    $(".container-b").removeClass("fade-left-social");
                }
                    else
                {
                    $(".container-c").addClass("fade-right-social");
                    $(".container-c").removeClass("fade-left-social");
                    $(".container-a").addClass("fade-right-social");
                    $(".container-a").removeClass("fade-left-social");
                    $(".container-b").addClass("fade-right-social");
                    $(".container-b").removeClass("fade-left-social");
                }
                break;
            default:
        }
    });
    //end change avatar path//
    $(".buy-content-container").hide();
    $(".after-login-content-container").hide();
    $(".after-login-content-container1").hide();
    $(".ddl-container-a-content-container").hide();
    //**********************start buy-click**********************//
    $(document).on("click", ".static-header .buy-button", function ()
    {
       // $(".static-header .buy-content-container").show();
        if (openBuy == 0)
        {
            openbuycontents();
            closeusercontnets();
            closelanuagecontnets();

            $(".static-header .buy-content-container").show();
            $("header .buy-content-container .top-container").addClass("slideInDown").addClass("animated");
            $("header .buy-content-container .item-container").addClass("fadeInRight").addClass("animated");
            $("header .buy-content-container .total-price").addClass("fadeIn").addClass("animated");
            $("header .buy-content-container .button").addClass("slideInUp").addClass("animated");
        }
        else
        {
            closebuycontents();
            $(".static-header .buy-content-container").hide();
            $("header .buy-content-container .top-container").removeClass("slideInDown").removeClass("animated");
            $("header .buy-content-container .item-container").removeClass("fadeInRight").removeClass("animated");
            $("header .buy-content-container .total-price").removeClass("fadeIn").removeClass("animated");
            $("header .buy-content-container .button").removeClass("slideInUp").removeClass("animated");
        }
    });
    //**********************end buy-click***********************//
    //**********************start buy-click***********************//
    //**********************end buy-click***********************//
    // **********************start user-click**********************//
    $(document).on("click", ".static-header .after-login-container", function ()
    {
        if (openuser == 0)
        {
            openusercontnets();
            closebuycontents();
            closelanuagecontnets();
            $(".static-header .after-login-content-container").show();
            $("header .after-login-content-container .buttons-container a").addClass("fadeIn").addClass("animated");
        }
        else
        {
            closeusercontnets();
            $(".static-header .after-login-content-container").hide();
            $("header .after-login-content-container .buttons-container a").removeClass("fadeIn").removeClass("animated");
        }
    });
    $(document).on("click", ".static-header .after-login-container1", function ()
    {
        if (openlanguage == 0) {
            openlanuagecontnets();
            closebuycontents();
            closeusercontnets();

            $(".static-header .after-login-content-container1").show();
            $("header .after-login-content-container1 .buttons-container a").addClass("fadeIn").addClass("animated");
        }
        else {
            closelanuagecontnets();
            $(".static-header .after-login-content-container1").hide();
            $("header .after-login-content-container1 .buttons-container a").removeClass("fadeIn").removeClass("animated");
        }
    });
     $(document).on("click", "header .after-login-content-container1 .buttons-container .button", function (){
         $("header .bottom-header-container .right-header-container .sign-container a.after-login-container1 .name").html($(this).html())
     });
    //**********************end user-click***********************//
    //**********************start language-click**********************//
    $(document).on("click", ".static-header .ddl-container-a", function ()
    {
       // $(".static-header .ddl-container-a-content-container").show();
        //$(".movable-header .ddl-container-a-content-container").hide();
        if (openlanguage == 0)
        {
            closebuycontents();
            closeusercontnets();
        }
        else
        {
            closelanuagecontnets();
        }
    });
    if($(window).width()>1024) {
        $("header .bottom-header-container .menu-header-container nav li").hover(function () {
            $(".buy-content-container").addClass("fade-top-buy");
            $(".after-login-content-container").addClass("fade-top-buy");
            $(".after-login-content-container1").addClass("fade-top-buy");
            $(".ddl-container-a-content-container").addClass("fade-top-buy");
            openBuy = 0;
            openuser = 0;
            openlanguage = 0;
        });
    }
    //**********************end language-click***********************//
    //**********************start checkout check***********************//
    //if($(".shipping-main-container .information-container").css("display","none"))
    //{
    //    $(".shipping-main-container .viewer-container").css("margin-left","0px");
    //}
    //else
    //{
    //    $(".shipping-main-container .viewer-container").css("margin-left","30px")
    //}
    //**********************end checkout check***********************//
    //**********************start ddl & fu***********************//
    $("select").each(function ()
    {
        conID = $(this).attr("id");
        $("#lbl" + conID).html($("#" + conID + " option:selected").text());
    });
    $(document).on("change", 'select', function ()
    {
        conID = $(this).attr("id");
        $("#lbl" + conID).html($("#" + conID + " option:selected").text());
    });
    $(document).on("change", "input[type=file]", function ()
    {
        conID = $(this).attr("id");
        $("#lbl" + conID).html($("#" + conID).val());
    });
    //**********************end ddl & fu**********************//




    $("#CurrentYear").text((new Date).getFullYear());
    //**********************end get current date************************//
    //**********************start calculate section height**************//
    function sectionHeight()
    {
        WinHeight = $(window).height();
        WinWidth = $(window).width();
        headerHeight = $("header").height();
        headerHeightmain = $(".header-main").height();
        headerHeightmain1 = $(".bottom-header-container").height();
        topheaderContainer = $(".top-header-container").height();
        bottomheadercontainer = $(".bottom-header-container").height();
        benifits = $(".section-main-container .display-cell .content-container .benifits-container .top-container").height();
        startfromright = (WinWidth - $(".center-piece-header-bottom").width()) / 2;
        WminH = WinHeight - $(".header-main static-header").height();

        //**********************start sub menu top*********************//
        $("header .bottom-header-container .menu-header-container nav li .current-tab").css("top", headerHeightmain + "px");
        $("header .bottom-header-container .right-header-container .buy-content-container").css("right", startfromright);
        $("header .buy-content-container,header .after-login-content-container").css("top", headerHeightmain - 3);
        $("header .after-login-content-container1").css("top", headerHeightmain - 3);
        $("header .bottom-header-container .right-header-container .after-login-content-container").css("right", (startfromright + $("header .bottom-header-container .right-header-container .sign-container").width()) - $(".after-login-container").width() - 20);
        $("header .bottom-header-container .right-header-container .after-login-content-container1").css("right", startfromright+$(".buy-button").width()+15);
        $("header .bottom-header-container .right-header-container .ddl-container-a-content-container").css("right", (startfromright + $("header .bottom-header-container .right-header-container .sign-container a.buy-button").width()) + 12);
        //**********************end sub menu top************************//
        //**********************start back to top***********************//
        ////**********************start inner-pages-main-container***********************//
        $(".inner-pages-main-container,.inner-pages-main-container .coming-soon").css("min-height", WinHeight - headerHeightmain - 80);
        $(".inner-pages-main-container,.inner-pages-main-container .coming-soon").css("line-height", WinHeight - headerHeightmain - 100 + "px");
        ////**********************end inner-pages-main-container***********************//
        ////**********************start page height game*********************//
        // $(".inner-pages-main-container-games .inner-container").height($(".inner-pages-main-container-games .inner-container .items-main-container").height()+$(".inner-pages-main-container-games .paging").height()+380);
        ////**********************end page height game***********************//
    }
    sectionHeight();
    //**********************end calculate section height***********//


    var offset = 220;
    var duration = 100;
    $(window).scroll(function ()
    {
        if (jQuery(this).scrollTop() > offset)
        {
            jQuery('.back-to-top').fadeIn(500);
            jQuery('.back-to-top').addClass("bounceInUp");
        } else {
            jQuery('.back-to-top').fadeOut(500);
        }
    });
    $('.back-to-top').click(function (event)
    {
        event.preventDefault();
        $('html, body').animate({scrollTop: 0}, 1000);
        jQuery('.back-to-top').removeClass("bounceInUp");
        return false;
    });
    //************************end back to top**********************//
    //************************start menu on scroll*****************//
    $(window).scroll(function ()
    {
        $(".buy-content-container").addClass("fade-top-buy");
        $(".after-login-content-container").addClass("fade-top-buy");
        $(".after-login-content-container1").addClass("fade-top-buy");
        $(".ddl-container-a-content-container").addClass("fade-top-buy");
        openBuy = 0;
        openuser = 0;
        openlanguage = 0;
        if ($(window).scrollTop() > 70)
        {
            $(".movable-header").addClass("fade-bottom");
            $(".movable-header").removeClass("fade-top");
            $(".movable-header").css("top", -topheaderContainer);
        }
        else
        {
            $(".movable-header").addClass("fade-top");
            $(".movable-header").removeClass("fade-bottom");
            $(".movable-header").css("top", 0);
        }
        if ($(window).scrollTop() == 0)
        {
            $(".buy-content-container").hide();
            $(".after-login-content-container").hide();
            $(".after-login-content-container1").hide();
            $(".ddl-container-a-content-container").hide();
        }
    });
    //************************end menu on scroll**********************//
    //************************start home slider in ready**************//
    if($(window).width()>459){
        $(".Modern-Slider").slick(
            {
                autoplay: true,
                autoplaySpeed: 7000,
                infinite: true,
                speed: 600,
                slidesToShow: 1,
                slidesToScroll: 1,
                pauseOnHover: false,
                dots: false,
                pauseOnDotsHover: true,
                cssEase: 'linear',
                fade: false,
                draggable: true,
                prevArrow: '<button class="PrevArrow"><span class="Thumbnail"></span></button>',
                nextArrow: '<button class="NextArrow"><span class="Thumbnail"></span></button>'
            });
        var PrevThumbinalFirst = $(".Modern-Slider .item:nth-child(6)").children(".img-fill").children(".img").css("background-image");
        $(".Modern-Slider .PrevArrow .Thumbnail").css({"background-image": PrevThumbinalFirst});
        var NextThumbinalFirst = $(".Modern-Slider .item:nth-child(2)").next().children(".img-fill").children(".img").css("background-image");
        $(".Modern-Slider .NextArrow .Thumbnail").css({"background-image": NextThumbinalFirst});
        $(".Modern-Slider").on('afterChange', function (event, slick, currentSlide) {
            var PrevThumbinal = $(".Modern-Slider .item.slick-active").prev(".item").children(".img-fill").children(".img").css("background-image");
            $(".Modern-Slider .PrevArrow .Thumbnail").css({"background-image": PrevThumbinal});
            var NextThumbinal = $(".Modern-Slider .item.slick-active").next(".item").children(".img-fill").children(".img").css("background-image");
            $(".Modern-Slider .NextArrow .Thumbnail").css({"background-image": NextThumbinal});
        });
    }else{
        $(".jq-section-first").hide();
    }


    //************************end home slider in ready**********************//
    //************************start scroll one block on click on arrow******//
    $('.arrow-container').click(function () {
        if($(window).width()==1024 && $(window).height()==1251)
        {
            $('html, body').animate({scrollTop: WminH-435}, 1000);
        }
        else {
            $('html, body').animate({scrollTop: WminH}, 1000);
        }
    });
    //************************end scroll one block on click on arrow********//
    //************************start open & close popup**********************//

        $(document).on("click", ".btn-popup", function ()
        {
        // $("#popup_content").load("includes/popupcontent.php");
            var condata = $(this).attr("data-type");
        $( "#popup_content" ).load( SITE_URL+Lang.Lang+"/signin-popup", function() {
            $(".popup-container").addClass("fadeInDownBig").addClass("animated1").show();

            var popID = condata.replace("Container", "Popup");
            $(".popup-content").fadeOut();
            setTimeout(function ()
            {
                $("." + popID).fadeIn();
            }, 200);
            $(".popup-main-container").fadeIn();
        });

    });

        $(document).on("click", ".btn-popup-a", function ()
        {
        $("body").css("overflow-y","hidden");
        $(".full-page").css("overflow-y","hidden");
        $("body").css("position","fixed");
        $("body").css("width","100%");

        if(this.id=='show_screenshots'){
            $(".screenschoots-image").each(function(){
                $(this).attr("src",$(this).attr("data-src"));
            });
            for(var i=0;i<8;i++){
                $("#screenshoots_"+i).attr('src',$("#screenshoots_"+i).attr('att'));
                $("#thumbscreenshoots_"+i).attr('href',$("#screenshoots_"+i).attr('att'))
                $("#thumbscreenshoots_"+i).css('background-image','url('+$("#screenshoots_"+i).attr('att')+')');
            }
        }
        $(".popup-container-a").addClass("fadeInDownBig").addClass("animated1");
        var condatas = $(this).attr("data-type");
        var popIDs = condatas.replace("Containers", "Popups");
        $(".popup-content-a").fadeOut();
        setTimeout(function ()
        {
            $("." + popIDs).fadeIn();
        }, 200);
        $(".popup-main-container-a").fadeIn();
    });
    var mouseIns = 0;
    $(".popup-container-a").mouseenter(function ()
    {
        mouseIns = 1;
    });
    $(".popup-container-a").mouseleave(function ()
    {
        mouseIns = 0;
    });
    $(".popup-main-container-a").click(function ()
    {
        if (mouseIns == 0) {
            $(".popup-container-a").removeClass("fadeInDownBig");
            $(".popup-main-container-a").fadeOut(400);
            $("body").css("overflow-y","auto");
            $("body").css("position","relative");
            $(".site-container").css("pointer-events","auto");
            y=$(".site-container").css("transform").split(",");
            y[5]=y[5].replace(")","");
            $(document).scrollTop(parseInt(y[5])*-1);
            console.log("y",y[5]);
            $(".site-container").css("transform","");
        }
    });
        $(document).on("click", ".close", function ()
    {
        $(".popup-container").removeClass("fadeInDownBig");
        $(".popup-main-container").fadeOut(400);
        $(".popup-container-a").removeClass("fadeInDownBig");
        $(".popup-main-container-a").fadeOut(400);
        $("body").css("overflow-y","auto");
        $("body").css("position","relative");
        $(".site-container").css("pointer-events","auto");
        y=$(".site-container").css("transform").split(",");
        y[5]=y[5].replace(")","");
        $(document).scrollTop(parseInt(y[5])*-1);
        console.log("y",y[5]);
        $(".site-container").css("transform","");
    });
    $('#rerun').click(function ()
    {
        stat();
    });
    //*******************end open & close popup*******************//
    //************************start site map**********************//
    $(".tree ul li i.folder").on("click", function ()
    {
        $(this).siblings("ul").slideToggle();
        $(this).toggleClass("fa-folder-o");
        $(this).toggleClass("fa-folder-open-o");
        $(this).siblings("i").toggleClass("fa-minus-circle");
        $(this).siblings("i").toggleClass("fa-plus-circle");
    });
    $(".fa-plus-circle").on("click", function()
    {
        $(this).siblings("ul").slideToggle();
        $(this).siblings("i").toggleClass("fa-folder-o");
        $(this).siblings("i").toggleClass("fa-folder-open-o");
        if($(this).hasClass("fa-minus-circle"))
        {
            $(this).removeClass("fa-minus-circle");
            $(this).addClass("fa-plus-circle");
        }
        else
        {
            $(this).removeClass("fa-plus-circle");
            $(this).addClass("fa-minus-circle");
        }
    });
    $(".tree ul li a.open").on("click", function ()
    {
        $(this).siblings("ul").slideToggle();
        $(this).siblings("i.folder").toggleClass("fa-folder-o");
        $(this).siblings("i.folder").toggleClass("fa-folder-open-o");
        $(this).siblings("i").toggleClass("fa-minus-circle");
        $(this).siblings("i").toggleClass("fa-plus-circle");
    });
    //************************end site map**********************//
    var prevButton = '<button type="button" data-role="none" class="slick-prev" aria-label="prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" version="1.1"><path fill="#FFFFFF" d="M 16,16.46 11.415,11.875 16,7.29 14.585,5.875 l -6,6 6,6 z" /></svg></button>',
        nextButton = '<button type="button" data-role="none" class="slick-next" aria-label="next"><svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="#FFFFFF" d="M8.585 16.46l4.585-4.585-4.585-4.585 1.415-1.415 6 6-6 6z"></path></svg></button>';
    $('.single-item').slick(
        {
        infinite: true,
        dots: false,
        autoplay: true,
        autoplaySpeed: 4000,
        speed: 1000,
        cssEase: 'ease-in-out',
        prevArrow: prevButton,
        nextArrow: nextButton
    });
    $('.quote-container').mousedown(function ()
    {
        $('.single-item').addClass('dragging');
    });
    $('.quote-container').mouseup(function ()
    {
        $('.single-item').removeClass('dragging');
    });
    //************************start feedback**********************//
    $(document).on("click", ".feedback-button-container", function ()
    {
        if (openfeedbacks == 0)
        {
            $(".site-container").css("transform","translatey("+($(document).scrollTop()*-1).toString()+"px)");
            $("body").css("overflow-y","hidden");
            $("body").css("position","fixed");
            $("body").css("width","100%");
            $(".site-container").css("pointer-events","none");
            openfeedback();

        }
        else
        {
            closefeedback();
            $("body").css("overflow-y","auto");
            $("body").css("position","relative");
            $(".site-container").css("pointer-events","auto");
            y=$(".site-container").css("transform").split(",");
            y[5]=y[5].replace(")","");
            $(document).scrollTop(parseInt(y[5])*-1);
            console.log("y",y[5]);
            $(".site-container").css("transform","");
        }
    });
    $(document).on("click", ".feedback-main-container .close-container a", function ()
    {
        closefeedback();
        $("body").css("overflow-y","auto");
        $("body").css("position","relative");
        $(".site-container").css("pointer-events","auto");
        y=$(".site-container").css("transform").split(",");
        y[5]=y[5].replace(")","");
        $(document).scrollTop(parseInt(y[5])*-1);
        console.log("y",y[5]);
        $(".site-container").css("transform","");
    });
    $(document).on("click", ".feedbacksitemap", function () {
        $(".feedback-button-container").trigger("click");
    });
    //************************end feedback**********************//
});
//static-header
//movable-header
function openbuycontents()
{
    $(".buy-content-container").removeClass("fade-top-buy");
    $(".buy-content-container").addClass("fade-bottom-buy");
    openBuy = 1;
}
function closebuycontents() {
    $(".buy-content-container").removeClass("fade-bottom-buy");
    $(".buy-content-container").addClass("fade-top-buy");
    openBuy = 0;
}
function openusercontnets()
{
    $(".after-login-content-container").removeClass("fade-top-buy");
    $(".after-login-content-container").addClass("fade-bottom-buy");

    openuser = 1;
}
function closeusercontnets()
{
    $(".after-login-content-container").removeClass("fade-bottom-buy");
    $(".after-login-content-container").addClass("fade-top-buy");
    openuser = 0;
}
function openlanuagecontnets()
{
    $(".after-login-content-container1").removeClass("fade-top-buy");
    $(".after-login-content-container1").addClass("fade-bottom-buy");
    openlanguage = 1;
}
function closelanuagecontnets()
{
    $(".after-login-content-container1").removeClass("fade-bottom-buy");
    $(".after-login-content-container1").addClass("fade-top-buy");
    openlanguage = 0;
}
function showloader(e)
{
    $(".manhal-loader-main-container").fadeIn();
    if(e === 1)
    {
        setTimeout(function () {
            $(".lms-help-message").addClass("animated slideInDown").fadeIn();
        },1000);
    }
}
function hideloader(e)
{
    $(".manhal-loader-main-container").fadeOut();
    if(e === 1)
    {
        $(".lms-help-message").removeClass("animated slideInDown").fadeOut();
    }
}
function increment()
{
    $('.statistics-container .item-container .number').each(function ()
    {
        var $this = $(this),
            value = $this.text();
        $({someValue: 0}).animate({someValue: value},
            {
                duration: 1200,
                easing: 'swing',
                step: function ()
                {
                    $this.text(Math.round(this.someValue));
                },
                complete: function ()
                {
                    $this.text(value);
                }
            });
    });
}
//increment();
setInterval(function ()
{
    increment();
}, 5000);
function openfeedback()
{
    $(".feedback-main-container").show();
    setTimeout(function() {
        $(".feedback-main-container").removeClass("fade-top-feedback");
        $(".feedback-main-container").addClass("fade-bottom-feedback");
        $(".feedback-button-container").hide();
    },300);
    //$(".feedback-button-container").removeClass("fade-top-feedback-button");
    //$(".feedback-button-container").addClass("fade-bottom-feedback-button");
    openfeedbacks = 1;
}
function closefeedback()
{
    $(".feedback-main-container").removeClass("fade-bottom-feedback");
    $(".feedback-main-container").addClass("fade-top-feedback");
    setTimeout(function()
    {
        $(".feedback-main-container").hide();
    },500);
        $(".feedback-button-container").show();
    openfeedbacks = 0;
}
function DropDown(el)
{
    this.dd = el;
    this.placeholder = this.dd.children('span');
    this.opts = this.dd.find('ul.dropdown > li').not("ul.dropdown > li.main-dropdown");
    this.val = '';
    this.index = -1;
    this.initEvents();
}
DropDown.prototype=
{
    initEvents : function()
    {
        var obj = this;
        obj.dd.on('click', function(event)
        {
            if(!$(event.target).closest("li").hasClass("main-dropdown"))
            {
                if(!$(this).closest(".wrapper-dropdown-3").hasClass("active"))
                {
                    $(".wrapper-dropdown-3").removeClass('active');
                    $(this).closest(".wrapper-dropdown-3").addClass('active');
                }
                else
                {
                    $(".wrapper-dropdown-3").removeClass('active');
                }
            }
            return false;
        });
        obj.opts.on('click',function()
        {
            if($(this).attr('year')!=undefined){
                window.location.href=$(this).attr('year');
            }

            $(this).parent().css("max-height","300px");
            $(".wrapper-dropdown-3").css("max-height","300px");

            var opt = $(this);
            obj.val = opt.text();
            obj.index = opt.index();
            obj.placeholder.text(obj.val);
            $(this).toggleClass('active');
            $(this).siblings().removeClass('active');
            console.log("aasdasd",$(this).attr("class"));
            if(!$(this).hasClass("main-dropdown") && !$(this).hasClass("changeBbackground"))
            {
                $(this).closest(".jq_bookdropdown span").css("background-image",$(this).children("a").css("background-image"));
                $(this).closest(".jq_bookdropdown span").html(opt.text());
                $(this).closest("ul").find(".hidden_input").val($(this).attr("catid"));


                if($(this).closest("ul").hasClass("submit")){
                    if($(this).closest("div").attr("id")=="subject"){
                        if((location.href).indexOf("/category/")!=-1 ){
                            arr=location.href.split("/");
                            arr[arr.length-2]=$(this).attr("catid");
                            arr2=arr[arr.length-1].split("?");

                            arr2[0]=opt.text().toLowerCase().trim().replace(" ","-");
                            arr[arr.length-1]=arr2.join("?");
                            link=arr.join("/");
                            $(this).closest("form").attr("action",link);
                        }else{
                            arr=location.href.split("/");
                            l=arr.length-1;
                            arr[l+1]="category";
                            arr[l+2]=$(this).attr("catid");
                            arr[l+3]=$(this).attr("catid");
                            arr2=arr[l-1].split("?");
                            arr2[0]=opt.text().toLowerCase().trim().replace(" ","-");
                            arr[arr.length-1]=arr2.join("?");
                            link=arr.join("/");
                            $(this).closest("form").attr("action",link);
                        }
                    }
                    $(this).closest("form").submit();
                }
            }
        });
    },
    getValue : function()
    {
        return this.val;
    },
    getIndex : function()
    {
        return this.index;
    }
};
$(function()
{
    var sortby = new DropDown($('#sortby'));
    var subject = new DropDown($('#subject'));
    var subjectfav = new DropDown($('#subjectfav'));
    var subject1 = new DropDown($('#subject1'));
    var subject2 = new DropDown($('#subject2'));
    var grade = new DropDown($('#grade'));
    var brand = new DropDown($('#brand'));
    var publishers = new DropDown($('#publishers'));
    var department = new DropDown($('#department'));



    var favpurch = new DropDown($('#favpurch'));
    var age = new DropDown($('#age'));

    var year = new DropDown($('#year'));
    var number = new DropDown($('#number'));
    var shipping = new DropDown($('#shipping'));
    var NewsYaer = new DropDown($('#NewsYaer'));
    var NewsMonth = new DropDown($('#NewsMonth'));
    var subjectgame = new DropDown($('#subject-game'));
    var series = new DropDown($('#series'));
    $(document).click(function()
    {
        $('.wrapper-dropdown-3').removeClass('active');
    });
});
//close-menu
function closeMenu(){
    $(".menu-toggle").removeClass("active");
    $(".menu-header-container nav li.active").each(function(i){
        // sssssss=(400)+(-i*250);
        // $(this).css("margin-Left","-120%");
    });
        $(".menu-header-container nav").hide();
}
function openWarningMessage()
{
    $(".warning.message").fadeIn();
    $(".header-main").css("top",$(".warning").height());
    WarningMessage=1;
}
function closeWarningMessage()
{
    $(".warning.message").fadeOut();
    setTimeout(function () {
        $(".header-main").css("top","0px");
    },200)
    WarningMessage=0;
}
function launchFullscreen() {
    element = document.getElementById("Game-play-iframe");
    element.style.display = "";
    if (element.requestFullscreen) {
        element.requestFullscreen();
    } else if (element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
    } else if (element.webkitRequestFullscreen) {
        element.webkitRequestFullscreen();
    } else if (element.msRequestFullscreen) {
        element.msRequestFullscreen();
    }
    else {
        $('#Game-play-iframe').addClass("active");
        // $('.exit-full-screen').show();
    }
}
// Launch fullscreen for browsers that support it!
// Whack fullscreen
document.addEventListener("fullscreenchange", cancelFullScreen, false);
document.addEventListener("webkitfullscreenchange", cancelFullScreen, false);
document.addEventListener("mozfullscreenchange", cancelFullScreen, false);
function exitFullscreen() {
    $('#Game-play-iframe').removeClass("active");
    $("#jq-iframe").attr("src","");
    element = document.getElementById("Game-play-iframe");
    if (document.exitFullscreen) {

        document.exitFullscreen();
    } else if (document.mozCancelFullScreen)
    {

        document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen)
    {

        document.webkitExitFullscreen();
    }
}
    function cancelFullScreen(event)
    {
        $("#jq-iframe").attr("src","");
    }