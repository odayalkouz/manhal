var viewpage = 1;
var viewzoom = 1;
var viewshare = 1;
var viewqrcode = 1;
var pen = 1;
var viewenricment = 1;
var search = 0;
var notes1 = 0;
var bookmark = 0;
var thumbs = 0;
var enrichment = 0;
var settings = 1;
function closetab() {
    window.close();
}
document.addEventListener('fullscreenchange', exitHandler);
document.addEventListener('webkitfullscreenchange', exitHandler);
document.addEventListener('mozfullscreenchange', exitHandler);
document.addEventListener('MSFullscreenChange', exitHandler);

function exitHandler() {
    if (!document.fullscreenElement && !document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement) {
        $('.exit-full-screen-container').hide();
    }
}
$(document).ready(function () {
    $('body').manhalLoader({
        splashID: "#jSplash",
        splashVPos: '50%',
        loaderVPos: '90%',
        splashFunction: function () {
            $('<div class="manhal-main-loader"><div class="loader-effect"><div class="checkmark draw"></div>' +
                '</div><div class="logo-loader"></div></div>').appendTo('#manhalpreOverlay');
        },
        onLoading: function (per) {
        },
    }, function () {
        $("#manhalpreOverlay").fadeOut("fast");
        $(".viewer-container").css("display","block !important").show();
        $(".exit-tab").css("display","block !important").show();
        $(".left-menu-main-container").css("display","block !important").show();

    });


       if(window.location.href.search("scorm")!=-1){
        $(".fullscreen-icon").hide();
    }
    
    
    $(window).bind('orientationchange', function (event) {
        setTimeout(function () {
            location.reload(true);

        },1000)
    });
    // var userAgent = window.navigator.userAgent.toLowerCase(),
    //     ios = /iphone|ipod|ipad/.test( userAgent );

    if(  deviceType=="iphone" ||  deviceType=="ipad" ) {
        $("body,.book-viewer-container").bind('touchmove', function (e) {
                e.preventDefault();
            }
        );
    }
    $(document).on("click", "a.doaction[actiontype='paint']", function (e) {
        footerpen();

        $(".icon-header-mobile a.pen").trigger("click");
    });
    // $(document).on("click", ".save-Paint", function (e) {
    //     Closefooterpen();
    // });

    $(document).on("touchmove click touchstart", "html", function (e) {
        if (typeof $(e.target).closest(".jq_enrichment,.doaction,.exit-full-screen,.exit-exit,.plyr__control,.crossorigin,.plyr,.plyr--full-ui,.plyr--video,.fullscreen-popup,.inner-content,iframe,.loader-in,.loader-inpopup")[0] == "undefined") {
            e.preventDefault();
            Closepopupenrishmentscontainer();
        }
    });
    $(document).on("click", ".exit-full-screen", function () {
        exitFullscreen();
        // if(/^((?!chrome|android).)*safari/i.test(navigator.userAgent))
        if(  deviceType=="iphone" ||  deviceType=="ipad" ) {
            $("#container-popup").removeClass("active");
            $('.exit-exit').hide();
            $('.exit-full-screen-container').hide();
        }
    });
    $(document).on("click", ".popup-enrishments-container .container-popup .fullscreen-popup,.doaction,.jq_enrichment", function () {
        // if(/^((?!chrome|android).)*safari/i.test(navigator.userAgent))
        //
        // {
        if(  deviceType=="iphone" ||  deviceType=="ipad" ) {
            $('.exit-full-screen-container').hide();
        }
        // else {
        //     alert();
        //     $('.exit-full-screen-container').show();
        // }
    });
    $('.sign-popup-container').on('click', function(e) {
        if (e.target == this) {
            $(".sign-popup-container .signin-popup-content .head .close-info-popup, .sign-popup-container .forget-password-content .head .close-info-popup").trigger( "click" );
        }
    });
    $('.third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container a.info').on('click', function() {
        $(".popup-information-main-container").fadeIn();
        $(".popup-information-white-content").removeClass("slideOutUp animated");
        $(".popup-information-white-content").addClass("slideInDown animated");
        Closefooterview();
        Closefooterqrcode();
        Closefooterindex();
        closebookmark();
        closesearch();
        closethumbs();
        closenotes();
        Closefootersettings();
    });
    $(document).on("click", ".close-info-popup", function () {
        $(".popup-information-white-content").removeClass("slideInDown animated");
        $(".popup-information-white-content").addClass("slideOutUp animated");
        $(".popup-information-main-container").fadeOut();
    });
    $('.sign-popup-container').on('click', function(e) {
        if (e.target == this) {
            $(".sign-popup-container .signin-popup-content .head .close-info-popup, .sign-popup-container .forget-password-content .head .close-info-popup").trigger( "click" );
        }
    });

    //Check Mobile Devices
        //Check Device
        //Check Device //All Touch Devices
        if (('ontouchstart' in document.documentElement))

            {
        $(document).on("click", ".header-pens a.save", function (e) {
            $(".header-pens .back").trigger("click");
        });
        $(document).on("click",".left-menu-main-container .tabs-content .tabD .content .item-container",function(){
            $(".left-menu-main-container").css("z-index","9");
            $(".left-menu-main-container").fadeOut();
            $(".left-menu-main-container .tabs-content .tabC").fadeOut();
        });
        $(document).on("click",".left-menu-main-container .tabs-content .tabC .content .item-container .icon-content",function(){
            $(".left-menu-main-container").css("z-index","9");
            $(".left-menu-main-container").fadeOut();
            $(".left-menu-main-container .tabs-content .tabC").fadeOut();
        });
        $(".left-menu-main-container .tabs-content .tabB .content .thumb-item").click(function () {
            $(".left-menu-main-container").css("z-index","9");
            $(".left-menu-main-container").fadeIn();
            $(".left-menu-main-container .tabs-content .tabB").fadeOut();
        });
        $(".icon-header-mobile a.pen").click(function () {
            $(".header-pens").fadeIn();
            Mobilepen();
            $(".header-pens a.settings").trigger( "click" );
        });
        $('.third-section-viewer .book-viewer-container footer').on('click', function(e) {
            if (e.target == this) {
                $(".header-pens a.settings").trigger( "click" );
            }
        });
        //start Hussan Update 23102017
        //End Hussan Update 23102017
        $(document).on("click", ".index-container-white .box-container-index .inner-item-box-container .box-left", function () {
            $(this).children(".bottom-container-index").slideToggle();
            $(this).children(".title").toggleClass("open");
        });
        $(document).on("click", ".first-footer-mobile .right-icons a.info,.footer-icons-mobile .right-icons-mobile a.info i", function () {
            $(".header-pens").fadeOut();
            $(".content-setting-mobile").fadeOut();
            $(".content-mobile").fadeOut();
            $(".header-pens a.settings").removeClass("active");

            $(".third-section-viewer .book-viewer-container footer").fadeOut();
            $(".third-section-viewer .book-viewer-container footer .pen-page-popup").fadeOut();
            $(".third-section-viewer .book-viewer-container footer .view-page-popup").fadeOut();

            $("#ccanvas").remove();
            $("#canvasback").remove();
            $(".magazine").turn("disable", false);
            pen=1;
            $(".popup-information-main-container").fadeIn();
            $(".popup-information-white-content").removeClass("slideOutUp animated");
            $(".popup-information-white-content").addClass("slideInDown animated");
        });

        $(document).on("click", ".left-menu-main-container .tabs-content .tabB .content .thumb-item", function () {
            $(".left-menu-main-container").css("z-index","9");

            $(".left-menu-main-container").fadeOut();
            $(".left-menu-main-container .tabs-content .tabB").fadeOut();
        });
        $(document).on("click", ".left-menu-main-container .tabs-content .tabA .content-search .thumb-item", function () {
            $(".left-menu-main-container").css("z-index","9");
            $(".left-menu-main-container").fadeOut();
            $(".left-menu-main-container .tabs-content .tabA").fadeOut();
        });
        $(document).on("click", ".unit-number", function ()
        {
            if(!$(this).hasClass("active")){

                $(this).parent(".level").children(".cd-timeline-block").removeClass("animated fadeInLeft").addClass("animated fadeInRight").fadeIn();
                $(this).addClass("active");
            }
            else {
                $(this).parent(".level").children(".cd-timeline-block").removeClass("animated fadeInRight").addClass("animated fadeInLeft").fadeOut();
                $(this).removeClass("active");
            }
        });
        $(document).on("click", ".cd-date", function () {
            if($(this).closest(".cd-timeline-content").find(".jq_enrichment").length > 0)
            {
                if(!$(this).hasClass("active")){
                    $(this).closest(".cd-timeline-content").find(".icons-container").fadeIn();
                    $(this).addClass("active");
                    if($(window).width()<=320) {
                        $(this).closest(".cd-timeline-content").closest(".cd-timeline-block").css("height", "auto")
                    }
                }
                else {
                    $(this).closest(".cd-timeline-content").find(".icons-container").fadeOut();
                    $(this).removeClass("active");
                    if($(window).width()<=320) {
                        $(this).closest(".cd-timeline-content").closest(".cd-timeline-block").css("height","35px");
                    }
                }
            }
            else {
            }
        });
    }
    $(".sign-popup-container .signin-popup-content .head .close-info-popup, .sign-popup-container .forget-password-content .head .close-info-popup").click(function () {
        $("#ForgetPass").fadeOut();
        $("#SignUp").fadeOut();
        $("#SignIn").fadeOut();
        $(".sign-popup-container").fadeOut();
        $("#SignIn").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated");
        $("#SignUp").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated");
        $("#ForgetPass").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated");
    });
    $(".do-you-know-popup-container .letter .head-container .close").click(function () {
        $(".do-you-know-content").removeClass("slideInDown animated");
        $(".do-you-know-content").addClass("slideOutUp animated");
        $(".do-you-know-popup-container").fadeOut();
    });
    $(".third-section-viewer .book-viewer-container footer .pen-page-popup .row-a a").click(function () {
        $(this).addClass("active").siblings().removeClass("active");

        if ($(this).hasClass("color-1")) {
            $("#ccanvas").mouseover(function () {
                $(this).css("cursor", "url('themes/Brown-Ar/images/viewpage/pen1.svg'), auto")
            });
        }
        else if ($(this).hasClass("color-2")) {
            $("#ccanvas").mouseover(function () {
                $(this).css("cursor", "url('themes/Brown-Ar/images/viewpage/pen2.svg'), auto")
            });
        }
        else if ($(this).hasClass("color-3")) {
            $("#ccanvas").mouseover(function () {
                $(this).css("cursor", "url('themes/Brown-Ar/images/viewpage/pen3.svg'), auto")
            });
        }
        else if ($(this).hasClass("color-4")) {
            $("#ccanvas").mouseover(function () {
                $(this).css("cursor", "url('themes/Brown-Ar/images/viewpage/pen4.svg'), auto")
            });
        }
        else if ($(this).hasClass("color-5")) {
            $("#ccanvas").mouseover(function () {
                $(this).css("cursor", "url('themes/Brown-Ar/images/viewpage/pen5.svg'), auto")
            });
        }
        else if ($(this).hasClass("color-6")) {
            $("#ccanvas").mouseover(function () {
                $(this).css("cursor", "url('themes/Brown-Ar/images/viewpage/pen6.svg'), auto")
            });
        }
    });
    $(".third-section-viewer .book-viewer-container footer .pen-page-popup .row-b a").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
    });
    $(".third-section-viewer .book-viewer-container footer .pen-page-popup .row-c a").click(function () {
        $(this).addClass("active").siblings().removeClass("active");

        if($(this).hasClass("erazer"))
        {

            $("#ccanvas").mouseover(function () {
                $(this).css("cursor", "url('themes/Brown-Ar/images/viewpage/eraser01.svg')0 20, auto")
            });
        }
        else {
        }
    });
    $(".third-section-viewer .book-viewer-container footer .setting-page-popup a.sound-on").click(function () {
        if ($(this).hasClass("sound-on")) {
            $(this).addClass("sound-off");
            $(this).removeClass("sound-on");
            $(".jq_audio").prop("muted", true);
        }
        else {
            $(this).removeClass("sound-off");
            $(this).addClass("sound-on");
            $(".jq_audio").prop("muted", false);
        }
    });
    $(".third-section-viewer .book-viewer-container footer .setting-page-popup a.Enrichment").click(function () {
        if ($(this).hasClass("Enrichment")) {
            $(this).addClass("Enrichment1");
            $(this).removeClass("Enrichment");
            $(".page_container .doaction").fadeOut();
            localStorage.showEnrichment = false;
        }
        else {
            $(this).removeClass("Enrichment1");
            $(this).addClass("Enrichment");
            $(".page_container .doaction").fadeIn();
            localStorage.showEnrichment = true;
        }
    });
    $(document).click(function (e) {
        if (typeof $(e.target).closest(".jq_noclose")[0] == "undefined" && !$(e.target).hasClass("doaction")) {
            Closefooterview();
            Closefooterqrcode();
            Closefooterindex();
            closebookmark();
            closesearch();
            closethumbs();
            closenotes();
            Closefootersettings();
        }
        // if ($(".popup-enrishments-container").is(":visible")) {
        //     if (typeof $(e.target).closest("#iframe").contents().find("img")[0] == "undefined" && typeof $(e.target).closest(".doaction,.plyr__control,.popup-content-a")[0] == "undefined") {
        //         e.preventDefault();
        //         Closefooterindex();
        //         Closepopupenrishmentscontainer();
        //         exitFullscreen();
        //         // alert();
        //     }
        // }
    });
    $(".addnote").click(function () {
        $(".popup-add-note").fadeIn();
    });
    //start view page active
    $(".third-section-viewer .book-viewer-container footer .view-page-popup a").click(function () {
        if ($(this).hasClass("activates")) {
            $(this).addClass("active");
            $(this).siblings().removeClass("active");
        }
    });
    $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container a.view").click(function () {
        footerview();
        Closefooterqrcode();
        Closefooterindex();
        Closefootersettings();
        Closefooterpen();
    });
    $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container .settings-icon").click(function () {
        footersettings();
        Closefooterview();
        Closefooterqrcode();
        Closefooterindex();
        Closefooterpen();
    });
    $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container a.pen").click(function () {
        if($(".zoom").hasClass("zoom1")){
            $(".zoom").click();
            setTimeout(function(){
                footerpen();
                Closefootersettings();
                Closefooterview();
                Closefooterqrcode();
                Closefooterindex();
            },700);
        }else{
            footerpen();
            Closefootersettings();
            Closefooterview();
            Closefooterqrcode();
            Closefooterindex();
        }
    });
    $(".third-section-viewer .book-viewer-container footer .view-page-popup a.zoom").click(function () {
        footerzoom();
        Closefooterview();
        Closefooterqrcode();
        Closefooterindex();
        Closefooterpen();
    });
    $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container a.qrcode").click(function () {
        footerqrcode();
        Closefooterview();
        Closefooterindex();
        Closefootersettings();
        Closefooterpen();
    });
    $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container a.index").click(function () {
        footerindex();
        Closefooterview();
        Closefooterqrcode();
        Closefootersettings();
        Closefooterpen();
        $(".exit-tab").hide();
    });
    $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container a.timeline").click(function () {
        timeline();
        Closefooterview();
        Closefooterqrcode();
        Closefooterindex();
        Closefootersettings();
        Closefooterpen();
        $(".exit-tab").hide();
        $(".viewer-container .forth-section-viewer .logo").fadeIn()
    });

    $(".timeline-section-viewer *").click(function () {
        $(".viewer-container .forth-section-viewer .logo").fadeOut()
    });
    $(".popup-index .container-popup .close-index-popup,.close-index-popup1").click(function () {
        Closepopupenrishmentscontainer();
        exitFullscreen();
    });
    $(".popup-enrishments-container .container-popup .close-index-popup,.close-index-popup1").click(function () {
        Closepopupenrishmentscontainer();
        exitFullscreen();
    });
    $(".exit-exit").click(function () {
        Closepopupenrishmentscontainer1();
        exitFullscreen();
    });
    $(".left-menu-main-container .tabs-icons-container a").click(function () {
        Closefooterpen();
        $(".header-pens").fadeOut();
        if ($(this).hasClass("search")) {
            $(".tabA").show();
            $(".tabA").siblings().hide();
            // $(".left-menu-main-container").removeClass("fade-right");
            // $(".left-menu-main-container").addClass("fade-left");
            if (search == 0) {
                if (window.sound) {
                    $("#sound_menu")[0].play();
                }
                $(this).addClass("active");
                $(this).siblings("a").removeClass("active");
                $(this).children("i").addClass("hang animated infinite");
                $(this).siblings("a").children("i").removeClass("hang animated infinite");
                $(".left-menu-main-container").addClass("fade-right");
                $(".left-menu-main-container").removeClass("fade-left");
                // $(".left-menu-main-container .tabs-content .tabA .top-title label").addClass("animated fadeInLeft");
                search = 1;
                thumbs = 0;
                notes1 = 0;
                bookmark = 0;
                enrichment = 0;
            }
            else {
                closesearch();

            }
        }
        else if ($(this).hasClass("thumbs")) {
            if (window.sound) {
                $("#sound_menu")[0].play();
            }
            $(this).addClass("active");
            $(this).siblings("a").removeClass("active");
            $(this).children("i").addClass("hang animated infinite");
            $(this).siblings("a").children("i").removeClass("hang animated infinite");
            $(".tabB").show();
            $(".tabB").siblings().hide();
            $(".left-menu-main-container .tabs-content .tabB .content .thumb-item:nth-child(2n)").addClass("animated fadeInLeft");
            $(".left-menu-main-container .tabs-content .tabB .content .thumb-item:nth-child(2n+1)").addClass("animated fadeInRight");
            // $(".left-menu-main-container .tabs-content .tabB .top-title label").addClass("animated fadeInLeft");
            if (thumbs == 0) {
                $(".left-menu-main-container").addClass("fade-right");
                $(".left-menu-main-container").removeClass("fade-left");
                thumbs = 1;
                search = 0;
                notes1 = 0;
                bookmark = 0;
                enrichment = 0;
            }
            else {
                closethumbs();
            }
            // },400);
        }
        else if ($(this).hasClass("notes")) {
            if (window.sound) {
                $("#sound_menu")[0].play();
            }
            $(this).addClass("active");
            $(this).siblings("a").removeClass("active");
            $(this).children("i").addClass("hang animated infinite");
            $(this).siblings("a").children("i").removeClass("hang animated infinite");
            $(".tabC").show();
            $(".tabC").siblings().hide();
            $(".left-menu-main-container .tabs-content .tabC .content .thumb-item:nth-child(2n)").addClass("animated fadeInLeft");
            $(".left-menu-main-container .tabs-content .tabC .content .thumb-item:nth-child(2n+1)").addClass("animated fadeInRight");
            // $(".left-menu-main-container .tabs-content .tabC .top-title label").addClass("animated fadeInLeft");

            if (notes1 == 0) {
                $(".left-menu-main-container").addClass("fade-right");
                $(".left-menu-main-container").removeClass("fade-left");
                notes1 = 1;
                search = 0;
                thumbs = 0;
                bookmark = 0;
                enrichment = 0;
            }
            else {
                closenotes();
            }
            // },400);
        }
        else if ($(this).hasClass("bookmark")) {
            if (window.sound) {
                $("#sound_menu")[0].play();
            }
            $(this).addClass("active");
            $(this).siblings("a").removeClass("active");
            $(this).children("i").addClass("hang animated infinite");
            $(this).siblings("a").children("i").removeClass("hang animated infinite");
            $(".tabD").show();
            $(".tabD").siblings().hide();
            $(".left-menu-main-container .tabs-content .tabD .content .item-container:nth-child(2n)").addClass("animated fadeInLeft");
            $(".left-menu-main-container .tabs-content .tabD .content .item-container:nth-child(2n+1)").addClass("animated fadeInRight");
            // $(".left-menu-main-container .tabs-content .tabD .top-title label").addClass("animated fadeInLeft");
            // $(".left-menu-main-container").removeClass("fade-right");
            // $(".left-menu-main-container").addClass("fade-left");

            // setTimeout(function () {
            if (bookmark == 0) {
                $(".left-menu-main-container").addClass("fade-right");
                $(".left-menu-main-container").removeClass("fade-left");
                bookmark = 1;
                search = 0;
                thumbs = 0;
                notes1 = 0;
                enrichment = 0;
            }
            else {
                closebookmark();
            }
        }
        else if ($(this).hasClass("enrichment")) {
            if (window.sound) {
                $("#sound_menu")[0].play();
            }
            $(this).addClass("active");
            $(this).siblings("a").removeClass("active");
            $(this).children("i").addClass("hang animated infinite");
            $(this).siblings("a").children("i").removeClass("hang animated infinite");
            $(".tabE").show();
            $(".tabE").siblings().hide();
            $(".left-menu-main-container .tabs-content .tabE .content .item-container:nth-child(2n)").addClass("animated fadeInLeft");
            $(".left-menu-main-container .tabs-content .tabE .content .item-container:nth-child(2n+1)").addClass("animated fadeInRight");
            // $(".left-menu-main-container .tabs-content .tabE .top-title label").addClass("animated fadeInLeft");
            // $(".left-menu-main-container").removeClass("fade-right");
            // $(".left-menu-main-container").addClass("fade-left");
            // setTimeout(function () {
            if (enrichment == 0) {
                $(".left-menu-main-container").addClass("fade-right");
                $(".left-menu-main-container").removeClass("fade-left");
                bookmark = 0;
                search = 0;
                thumbs = 0;
                notes1 = 0;
                enrichment = 1;
            }
            else {
                closeenrichment();
            }
        }
    });
    // $(document).manhalLoader({
    //     splashID: "#jSplash",
    //     splashVPos: '50%',
    //     loaderVPos: '80%',
    //     addFiles: [],
    //     splashFunction: function () {
    //         $('<div class="loder-bg">').appendTo('#manhalpreOverlay');
    //     },
    //     onLoading: function (per) {
    //     },
    // }, function () {
    // });
    // $(".button-animation").mouseover(function () {
        // $(this).addClass("animated hvr-push");
        // $(this).removeClass("flip fadeInRight");
        // if ($(this).hasClass("disable")) {
        //     $(this).removeClass("animated hvr-push");
        // }
    // });
    $(".button-animation").mouseleave(function () {
        $(this).removeClass("animated hvr-push");
    });
    if($(window).width() > 1024)
    {

        $(document).on("mouseover", ".doaction", function () {
            if ($(this).hasClass("jq_enrichment")) {
            }
            else {
                $(this).addClass("animated flip");
                $(this).removeClass(" fadeInRight");
                if ($(this).hasClass("disable")) {
                    $(this).removeClass("animated flip");
                }
            }
        });
        $(document).on("mouseleave", ".doaction", function () {
            $(this).removeClass("animated flip");
        });
    }
    $(".viewer-container .first-section-viewer .right-cover-container .book-play").click(function () {
        play();
    });
    $(".js-book").click(function () {
        play();
    });
    $(".index-container-white .book-title a").click(function () {
        setTimeout(function () {
            $(".exit-tab").show()
        },1000)

        if ($(".index-container-white .book-title a").attr("curent") == "home") {
            back();
        }
        else if ($(".index-container-white .book-title a").attr("curent") == "view") {
            play();
        }
    });
    $(".timeline-container-white .book-title a").click(function () {
        setTimeout(function () {
            $(".exit-tab").show()
        },1000)
        play();
    });
    $(".viewer-container .first-section-viewer .information .play").click(function () {
        indexbook();
        $(".index-container-white .book-title a").attr("curent", "home");
    });
    $(".first-footer-mobile .right-icons a.index").click(function () {
        indexbook();
        $(".index-container-white .book-title a").attr("curent", "home");
    });
    $(".footer-icons-mobile .right-icons-mobile a.index").click(function () {
        $(".header-pens").fadeOut();
        $(".content-setting-mobile").fadeOut();
        $(".content-mobile").fadeOut();
        $(".header-pens a.settings").removeClass("active");

        $(".third-section-viewer .book-viewer-container footer").fadeOut();
        $(".third-section-viewer .book-viewer-container footer .pen-page-popup").fadeOut();
        $(".third-section-viewer .book-viewer-container footer .view-page-popup").fadeOut();

        $("#ccanvas").remove();
        $("#canvasback").remove();
        $(".magazine").turn("disable", false);
        pen=1;
        indexbook();
        $(".index-container-white .book-title a").attr("curent", "view");
    });
    $(".footer-icons-mobile .right-icons-mobile a.sound-on").click(function () {
        $(".header-pens").fadeOut();
        $(".content-setting-mobile").fadeOut();
        $(".content-mobile").fadeOut();
        $(".header-pens a.settings").removeClass("active");

        $(".third-section-viewer .book-viewer-container footer").fadeOut();
        $(".third-section-viewer .book-viewer-container footer .pen-page-popup").fadeOut();
        $(".third-section-viewer .book-viewer-container footer .view-page-popup").fadeOut();

        $("#ccanvas").remove();
        $("#canvasback").remove();
        $(".magazine").turn("disable", false);
        pen=1;
        if ($(this).hasClass("sound-on")) {
            $(this).addClass("sound-off");
            $(this).removeClass("sound-on");
            $(".jq_audio").prop("muted", true);
        }
        else {
            $(this).removeClass("sound-off");
            $(this).addClass("sound-on");
            $(".jq_audio").prop("muted", false);
        }
    });
    $(".footer-icons-mobile .right-icons-mobile a.thumbs").click(function () {
        $(".header-pens").fadeOut();
        $(".content-setting-mobile").fadeOut();
        $(".content-mobile").fadeOut();
        $(".header-pens a.settings").removeClass("active");

        $(".third-section-viewer .book-viewer-container footer").fadeOut();
        $(".third-section-viewer .book-viewer-container footer .pen-page-popup").fadeOut();
        $(".third-section-viewer .book-viewer-container footer .view-page-popup").fadeOut();

        $("#ccanvas").remove();
        $("#canvasback").remove();
        $(".magazine").turn("disable", false);
        pen=1;
        $(".left-menu-main-container").css("z-index","999");
        $(".left-menu-main-container").fadeIn();
        $(".left-menu-main-container .tabs-content .tabB").fadeIn();
    });
    $(".icon-header-mobile div.back").click(function () {
        back();
        $(".forth-section-viewer").hide();
    });
    $(".footer-icons-mobile .right-icons-mobile a.view").click(function () {
        $(".header-pens").fadeOut();
        $(".content-setting-mobile").fadeOut();
        $(".content-mobile").fadeOut();
        $(".header-pens a.settings").removeClass("active");

        $(".third-section-viewer .book-viewer-container footer").fadeOut();
        $(".third-section-viewer .book-viewer-container footer .pen-page-popup").fadeOut();
        $(".third-section-viewer .book-viewer-container footer .view-page-popup").fadeOut();

        $("#ccanvas").remove();
        $("#canvasback").remove();
        $(".magazine").turn("disable", false);
        pen=1;
        $(".third-section-viewer .book-viewer-container footer").fadeIn();
        $(".third-section-viewer .book-viewer-container footer .view-page-popup").fadeIn();
        $(".third-section-viewer .book-viewer-container footer .pen-page-popup").hide();

    });
    $(".title-view-mobile span").click(function () {
        $(".third-section-viewer .book-viewer-container footer").fadeOut();
    });
    $(".icon-header-mobile a.bookmark").click(function () {
        $(this).toggleClass("active");
        $("#bookmark").trigger("click");
    });

    $(".footer-icons-mobile .right-icons-mobile a.search").click(function () {
        $(".left-menu-main-container").css("z-index","999");
        $(".left-menu-main-container").show();
        $(".left-menu-main-container .tabs-content .tabA").show();

        $(".header-pens").fadeOut();
        $(".content-setting-mobile").fadeOut();
        $(".content-mobile").fadeOut();
        $(".header-pens a.settings").removeClass("active");

        $(".third-section-viewer .book-viewer-container footer").fadeOut();
        $(".third-section-viewer .book-viewer-container footer .pen-page-popup").fadeOut();
        $(".third-section-viewer .book-viewer-container footer .view-page-popup").fadeOut();

        $("#ccanvas").remove();
        $("#canvasback").remove();
        $(".magazine").turn("disable", false);
        pen=1;


    });
    $(".left-menu-main-container .tabs-content .tabA .search-box .back").click(function () {
        $(".left-menu-main-container").css("z-index","9");
        $(".left-menu-main-container").fadeOut();
        $(".left-menu-main-container .tabs-content .tabA").fadeOut();
    });
    $(".footer-icons-mobile .right-icons-mobile a.bookmark").click(function () {
        $(".header-pens").fadeOut();
        $(".content-setting-mobile").fadeOut();
        $(".content-mobile").fadeOut();
        $(".header-pens a.settings").removeClass("active");

        $(".third-section-viewer .book-viewer-container footer").fadeOut();
        $(".third-section-viewer .book-viewer-container footer .pen-page-popup").fadeOut();
        $(".third-section-viewer .book-viewer-container footer .view-page-popup").fadeOut();

        $("#ccanvas").remove();
        $("#canvasback").remove();
        $(".magazine").turn("disable", false);
        pen=1;
        $(".left-menu-main-container").css("z-index","999");
        $(".left-menu-main-container").fadeIn();
        $(".left-menu-main-container .tabs-content .tabC").fadeIn();
    });

    $(".header-pens .back").click(function () {
        $(".header-pens").fadeOut();
        $(".content-setting-mobile").fadeOut();
        $(".content-mobile").fadeOut();
        $(".header-pens a.settings").removeClass("active");

        $(".third-section-viewer .book-viewer-container footer").fadeOut();
        $(".third-section-viewer .book-viewer-container footer .pen-page-popup").fadeOut();
        $(".third-section-viewer .book-viewer-container footer .view-page-popup").fadeOut();
        $(".doaction").show();

        $("#ccanvas").remove();
        $("#canvasback").remove();
        $(".magazine").turn("disable", false);
        pen=1;

    });
    $(".header-pens a.settings").click(function () {
        if(!$(this).hasClass("active"))
        {
            $(".content-setting-mobile").fadeIn();
            $(".content-mobile").fadeIn();
            $(this).addClass("active");
            $(".third-section-viewer .book-viewer-container footer").fadeIn();
            $(".third-section-viewer .book-viewer-container footer .pen-page-popup").fadeIn();
            $(".third-section-viewer .book-viewer-container footer .view-page-popup").hide();
        }
        else {
            $(".content-setting-mobile").fadeOut();
            $(".content-mobile").fadeOut();
            $(this).removeClass("active");
            $(".third-section-viewer .book-viewer-container footer").fadeOut();
            $(".third-section-viewer .book-viewer-container footer .pen-page-popup").fadeOut();
            $(".third-section-viewer .book-viewer-container footer .view-page-popup").hide();
        }
    });
    $(".icon-header-mobile a.note").click(function () {
        $("#AddNote").trigger( "click" );
    });
    $(".footer-icons-mobile .right-icons-mobile a.timeline").click(function () {
        timelinemobile();
        Closefooterview();
        Closefooterqrcode();
        Closefooterindex();
        Closefootersettings();
        Closefooterpen();
        $(".header-pens").fadeOut();
        $(".content-setting-mobile").fadeOut();
        $(".content-mobile").fadeOut();
        $(".header-pens a.settings").removeClass("active");

        $(".third-section-viewer .book-viewer-container footer").fadeOut();
        $(".third-section-viewer .book-viewer-container footer .pen-page-popup").fadeOut();
        $(".third-section-viewer .book-viewer-container footer .view-page-popup").fadeOut();

        $("#ccanvas").remove();
        $("#canvasback").remove();
        $(".magazine").turn("disable", false);
        pen=1;
    });
    $(".left-menu-main-container .tabs-content .tabC .top-title label,.left-menu-main-container .tabs-content .tabD .top-title label").click(function () {
        if($(this).hasClass("note-mobile"))
        {
            $(".left-menu-main-container .tabs-content .tabD").fadeOut();
            $(".left-menu-main-container").css("z-index","999");
            $(".left-menu-main-container").removeClass("puffOut animated").addClass("animated puffIn").fadeIn();
            $(".left-menu-main-container .tabs-content .tabC").fadeIn();
            $(".note-mobile").addClass("active");
            $(".bookmark-mobile").removeClass("active");
        }
        else if($(this).hasClass("bookmark-mobile")) {
            $(".left-menu-main-container .tabs-content .tabC").fadeOut();
            $(".left-menu-main-container").css("z-index","999");
            $(".left-menu-main-container").removeClass("puffOut animated").addClass("animated puffIn").fadeIn();
            $(".left-menu-main-container .tabs-content .tabD").fadeIn();
            $(this).addClass("active").siblings().removeClass("active");
            $(".bookmark-mobile").addClass("active");
            $(".note-mobile ").removeClass("active");
        }
    });
    $(".left-menu-main-container .tabs-content .tabC .top-title .back,.left-menu-main-container .tabs-content .tabD .top-title .back").click(function () {
        $(".left-menu-main-container").css("z-index","9");
        $(".left-menu-main-container").fadeOut();
        $(".left-menu-main-container .tabs-content .tabC").fadeOut();
        setTimeout(function () {
            $(".note-mobile").addClass("active");
            $(".bookmark-mobile").removeClass("active");
        },700)
    });
});
$(window).on("load",function() {
    $(".loader-screen").fadeOut("slow");
    $(".viewer-container .first-section-viewer .title h1").addClass("animated zoomIn").fadeIn();
    play();
});
function back() {
    $(".first-section-viewer").removeClass("animated puffOut").fadeIn();
    $(".viewer-container").fadeIn();
    $(".second-section-viewer").removeClass("animated puffOut").fadeOut();
    $(".third-section-viewer").removeClass("animated puffIn").fadeOut();
    $(".second-section-viewer").removeClass("animated puffIn").fadeOut();
    $(".third-section-viewer").removeClass("animated puffIn").fadeOut();
    // $(".pencel").removeClass("animated fadeInLeft").fadeOut();
    $(".index-container-white .box-container-index .item-box-container .item-row-container").removeClass("animated fadeInRight").fadeOut();
    $(".third-section-viewer .book-viewer-container header").width($(".magazine").width());
}
function play() {
    if (('ontouchstart' in document.documentElement))
    {
        $(".left-menu-main-container .tabs-content .tabB .top-title i").click(function () {
            $(".left-menu-main-container").css("z-index","9");
            $(".left-menu-main-container").fadeIn();
            $(".left-menu-main-container .tabs-content .tabB").fadeOut();
        });
        $(".unit-number").parent(".level").children(".cd-timeline-block").removeClass("animated fadeInRight").addClass("animated fadeInLeft").fadeOut();
        $(".unit-number").removeClass("active");
        $(".cd-date").removeClass("active");
        $(".cd-date").closest(".cd-timeline-content").find(".icons-container").fadeOut();
        $(".first-section-viewer").fadeOut();
        $(".second-section-viewer").fadeOut();
        $(".third-section-viewer").fadeIn();
        setTimeout(function () {
            $(".third-section-viewer .book-viewer-container header .title-container").fadeIn();
            $(".left-menu-main-container").fadeIn();
            $(".enrichment-container-menu-right").fadeIn();
            $(".third-section-viewer .book-viewer-container header").width($(".magazine").width());
            //resizeViewport();
        }, 1000)
    }
    else {
        // $(".pencel").addClass("animated fadeOutRight").fadeOut();
        $(".first-section-viewer").addClass("animated puffOut").fadeOut();
        $(".second-section-viewer").addClass("animated puffOut").fadeOut();

        $(".third-section-viewer").addClass("animated puffIn").fadeIn();
        setTimeout(function () {
            $(".third-section-viewer .book-viewer-container header .title-container").addClass("animated fadeInRight").fadeIn();
            $(".left-menu-main-container").fadeIn();
            $(".enrichment-container-menu-right").addClass("animated puffOut").fadeIn();
            $(".third-section-viewer .book-viewer-container header").width($(".magazine").width());
            //resizeViewport();
        }, 2800)
    }
}
function timeline() {
    $(".third-section-viewer").addClass("animated puffOut").fadeOut();
    $(".forth-section-viewer").addClass("animated puffIn").fadeIn();
    $(".left-menu-main-container").hide();
    $(".enrichment-container-menu-right").hide();
    setTimeout(function () {
    }, 500)
}
function timelinemobile() {
    $(".cd-date").each(function() {
        if ($(this).closest(".cd-timeline-content").find(".jq_enrichment").length <= 0) {
            $(this).css("background-image","none");
        }
    });
    $(".third-section-viewer").fadeOut();
    $(".forth-section-viewer").fadeIn();
    $(".left-menu-main-container").hide();
    $(".enrichment-container-menu-right").hide();
    setTimeout(function () {
    }, 500)
}

index = 0;
function closesearch() {
    if ($(".left-menu-main-container").hasClass("fade-right")) {
        $(".left-menu-main-container").removeClass("fade-right");
        $(".left-menu-main-container").addClass("fade-left");
        $(".left-menu-main-container .tabs-icons-container a").removeClass("active");
        $(".left-menu-main-container .tabs-icons-container a").children("i").removeClass("hang animated infinite");
        // $(".left-menu-main-container .tabs-content .tabA .top-title label").removeClass("animated fadeInLeft");
        bookmark = 0;
        search = 0;
        thumbs = 0;
        notes1 = 0;
        enrichment = 0;
        if (window.sound) {
            $("#sound_close")[0].play();
        }
    }
}

function closethumbs() {
    if ($(".left-menu-main-container").hasClass("fade-right")) {
        $(".left-menu-main-container").removeClass("fade-right");
        $(".left-menu-main-container").addClass("fade-left");
        $(".left-menu-main-container .tabs-icons-container a").removeClass("active");
        $(".left-menu-main-container .tabs-icons-container a").children("i").removeClass("hang animated infinite");
        $(".left-menu-main-container .tabs-content .tabB .content .thumb-item:nth-child(2n)").removeClass("animated fadeInLeft");
        $(".left-menu-main-container .tabs-content .tabB .content .thumb-item:nth-child(2n+1)").removeClass("animated fadeInRight");
        // $(".left-menu-main-container .tabs-content .tabB .top-title label").removeClass("animated fadeInLeft");
        bookmark = 0;
        search = 0;
        thumbs = 0;
        notes1 = 0;
        enrichment = 0;
        if (window.sound) {
            $("#sound_close")[0].play();
        }
    }
}
function closenotes() {
    if ($(".left-menu-main-container").hasClass("fade-right")) {
        $(".left-menu-main-container").removeClass("fade-right");
        $(".left-menu-main-container").addClass("fade-left");
        $(".left-menu-main-container .tabs-icons-container a").removeClass("active");
        $(".left-menu-main-container .tabs-icons-container a").children("i").removeClass("hang animated infinite");
        // $(".left-menu-main-container .tabs-content .tabC .top-title label").removeClass("animated fadeInLeft");
        $(".left-menu-main-container .tabs-content .tabC .content .item-container:nth-child(2n)").removeClass("animated fadeInLeft");
        $(".left-menu-main-container .tabs-content .tabC .content .item-container:nth-child(2n+1)").removeClass("animated fadeInRight");
        bookmark = 0;
        search = 0;
        thumbs = 0;
        notes1 = 0;
        enrichment = 0;
        if (window.sound) {
            $("#sound_close")[0].play();
        }
    }
}
function closebookmark() {
    if ($(".left-menu-main-container").hasClass("fade-right")) {
        $(".left-menu-main-container").removeClass("fade-right");
        $(".left-menu-main-container").addClass("fade-left");
        $(".left-menu-main-container .tabs-icons-container a").removeClass("active");
        $(".left-menu-main-container .tabs-icons-container a").children("i").removeClass("hang animated infinite");
        $(".left-menu-main-container .tabs-content .tabD .content .item-container:nth-child(2n)").removeClass("animated fadeInLeft");
        $(".left-menu-main-container .tabs-content .tabD .content .item-container:nth-child(2n+1)").removeClass("animated fadeInRight");
        // $(".left-menu-main-container .tabs-content .tabD .top-title label").removeClass("animated fadeInLeft");
        bookmark = 0;
        search = 0;
        thumbs = 0;
        notes1 = 0;
        enrichment = 0;
        if (window.sound) {
            $("#sound_close")[0].play();
        }
    }
}

function closeenrichment() {
    if ($(".left-menu-main-container").hasClass("fade-right")) {
        $(".left-menu-main-container").removeClass("fade-right");
        $(".left-menu-main-container").addClass("fade-left");
        $(".left-menu-main-container .tabs-icons-container a").removeClass("active");
        $(".left-menu-main-container .tabs-icons-container a").children("i").removeClass("hang animated infinite");
        $(".left-menu-main-container .tabs-content .tabE .content .item-container:nth-child(2n)").removeClass("animated fadeInLeft");
        $(".left-menu-main-container .tabs-content .tabE .content .item-container:nth-child(2n+1)").removeClass("animated fadeInRight");
        // $(".left-menu-main-container .tabs-content .tabE .top-title label").removeClass("animated fadeInLeft");
        bookmark = 0;
        search = 0;
        thumbs = 0;
        notes1 = 0;
        enrichment = 0;
        if (window.sound) {
            $("#sound_close")[0].play();
        }
    }
}
function indexbook() {
    if (('ontouchstart' in document.documentElement)) {
        $(".first-section-viewer").fadeOut();
        $(".second-section-viewer").fadeOut();
        $(".third-section-viewer").fadeIn();
        $(".first-section-viewer").fadeOut();
        $(".second-section-viewer").fadeIn();
        $(".third-section-viewer").fadeOut();
        setTimeout(function () {
            setTimeout(function () {
                $(".index-container-white .box-container-index .item-box-container .item-row-container").fadeIn();
            }, 500);
        }, 500);
        if (window.sound) {
            $("#sound_menu")[0].play();
        }
    }
    else {
        $(".first-section-viewer").addClass("animated puffOut").fadeOut();
        $(".second-section-viewer").addClass("animated puffOut").fadeOut();
        $(".third-section-viewer").addClass("animated puffIn").fadeIn();
        $(".first-section-viewer").addClass("animated puffOut").fadeOut();
        $(".second-section-viewer").addClass("animated puffIn").fadeIn();
        $(".third-section-viewer").addClass("animated puffIn").fadeOut();
        setTimeout(function () {
            // $(".pencel").addClass("animated fadeInLeft").fadeIn();

            setTimeout(function () {
                $(".index-container-white .box-container-index .item-box-container .item-row-container").addClass("animated fadeInRight").fadeIn();
            }, 500);
        }, 500);
        if (window.sound) {
            $("#sound_menu")[0].play();
        }
    }

}
function footerview() {
    if (viewpage == 1) {
        if (window.sound) {
            $("#sound_menu")[0].play();
        }

        $(".third-section-viewer .book-viewer-container footer .view-page-popup").removeClass("fade-right-a");
        $(".third-section-viewer .book-viewer-container footer .view-page-popup").addClass("fade-left-a");
        $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container a.view").addClass("active");
        viewpage = 0;
    }
    else {
        if (window.sound) {
            $("#sound_close")[0].play();
        }
        $(".third-section-viewer .book-viewer-container footer .view-page-popup").addClass("fade-right-a");
        $(".third-section-viewer .book-viewer-container footer .view-page-popup").removeClass("fade-left-a");
        $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container a.view").removeClass("active");
        viewpage = 1;
    }
}
function footersettings() {
    if (settings == 1) {
        if (window.sound) {
            $("#sound_menu")[0].play();
        }

        $(".third-section-viewer .book-viewer-container footer .setting-page-popup").removeClass("fade-right-a");
        $(".third-section-viewer .book-viewer-container footer .setting-page-popup").addClass("fade-left-a");
        $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container .settings-icon").addClass("active");
        settings = 0;
    }
    else {
        if (window.sound) {
            $("#sound_close")[0].play();
        }
        $(".third-section-viewer .book-viewer-container footer .setting-page-popup").addClass("fade-right-a");
        $(".third-section-viewer .book-viewer-container footer .setting-page-popup").removeClass("fade-left-a");
        $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container .settings-icon").removeClass("active");
        settings = 1;
    }
}

function footerpen() {
    if (pen == 1) {
        if (window.sound) {
            $("#sound_menu")[0].play();
        }
        $(".third-section-viewer .book-viewer-container footer .pen-page-popup").removeClass("fade-right-a");
        $(".third-section-viewer .book-viewer-container footer .pen-page-popup").addClass("fade-left-a");
        $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container a.pen").addClass("pen1");
        pen = 0;
        if ($("#ccanvas").length < 1) {
            $(".magazine").turn("disable", true);
            drawing();
        }

        $("#ccanvas").mouseover(function () {
            $(this).css("cursor", "url('themes/Brown-Ar/images/viewpage/pen1.svg'), auto");
        });

        $(".page_container .doaction").hide();

    }
    else {
        Closefooterpen();
    }
}
function Closefooterview() {
    if ($(".third-section-viewer .book-viewer-container footer .view-page-popup").hasClass("fade-left-a")) {
        viewpage = 1;
        $(".third-section-viewer .book-viewer-container footer .view-page-popup").addClass("fade-right-a");
        $(".third-section-viewer .book-viewer-container footer .view-page-popup").removeClass("fade-left-a");
        $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container a.view").removeClass("active");
        if (window.sound) {
            $("#sound_close")[0].play();
        }
    }
}
function Closefootersettings() {
    if ($(".third-section-viewer .book-viewer-container footer .setting-page-popup").hasClass("fade-left-a")) {
        settings = 1;
        $(".third-section-viewer .book-viewer-container footer .setting-page-popup").addClass("fade-right-a");
        $(".third-section-viewer .book-viewer-container footer .setting-page-popup").removeClass("fade-left-a");
        $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container .settings-icon").removeClass("active");
        if (window.sound) {
            $("#sound_close")[0].play();
        }
    }
}


function Closefooterpen() {
    // $( ".pen-page-popup" ).click(function( event ) {
    //     alert(event.target.className)
    //
    // });
        $(".page_container .doaction").show();
        if ($(".third-section-viewer .book-viewer-container footer .pen-page-popup").hasClass("fade-left-a")) {
            pen = 1;
            $(".third-section-viewer .book-viewer-container footer .pen-page-popup").addClass("fade-right-a");
            $(".third-section-viewer .book-viewer-container footer .pen-page-popup").removeClass("fade-left-a");
            $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container a.pen").removeClass("pen1");
            if (window.sound) {
                $("#sound_close")[0].play();
            }
            $("#ccanvas").mouseover(function () {
                $(this).css("cursor", "default");
            });

            $("#ccanvas").remove();
            $("#canvasback").remove();
            $(".magazine").turn("disable", false);
            if (localStorage.showEnrichment == "true") {
                $(".page_container .doaction").show();
            }
        }
}

function footerzoom() {
    if (window.zoomed == 0) {
        if (window.sound) {
            $("#sound_menu")[0].play();
        }
        $('.magazine-viewport').zoom('zoomIn');
        $(".third-section-viewer .book-viewer-container footer .zoom-popup").removeClass("fade-bottom");
        $(".third-section-viewer .book-viewer-container footer .zoom-popup").addClass("fade-top");
        $(".third-section-viewer .book-viewer-container footer .view-page-popup a.zoom").addClass("zoom1");

        window.zoomed = 1;
        $("#zoom_label").html(Lang.ZoomOut);
        $("#zoom_label").parent().attr("title",Lang.ZoomOut);
    }
    else {
        if (window.sound) {
            $("#sound_close")[0].play();
        }
        $('.magazine-viewport').zoom('zoomOut');
        $(".third-section-viewer .book-viewer-container footer .zoom-popup").addClass("fade-bottom");
        $(".third-section-viewer .book-viewer-container footer .zoom-popup").removeClass("fade-top");
        $(".third-section-viewer .book-viewer-container footer .view-page-popup a.zoom").removeClass("zoom1");
        window.zoomed = 0;
        $("#zoom_label").html(Lang.ZoomIn);
        $("#zoom_label").parent().attr("title",Lang.ZoomIn);

    }
}
function footerqrcode() {
    if (viewqrcode == 1) {
        if (window.sound) {
            $("#sound_menu")[0].play();
        }
        $(".third-section-viewer .book-viewer-container footer .qrcode-popup").removeClass("fade-right-a");
        $(".third-section-viewer .book-viewer-container footer .qrcode-popup").addClass("fade-left-a");
        $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container a.qrcode").addClass("active");
        viewqrcode = 0;
    }
    else {
        if (window.sound) {
            $("#sound_close")[0].play();
        }
        $(".third-section-viewer .book-viewer-container footer .qrcode-popup").addClass("fade-right-a");
        $(".third-section-viewer .book-viewer-container footer .qrcode-popup").removeClass("fade-left-a");
        $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container a.qrcode").removeClass("active");
        viewqrcode = 1;
    }
}
function Closefooterqrcode() {
    if ($(".third-section-viewer .book-viewer-container footer .qrcode-popup").hasClass("fade-left-a")) {
        if (window.sound) {
            $("#sound_close")[0].play();
        }
        viewqrcode = 1;
        $(".third-section-viewer .book-viewer-container footer .qrcode-popup").addClass("fade-right-a");
        $(".third-section-viewer .book-viewer-container footer .qrcode-popup").removeClass("fade-left-a");
        $(".third-section-viewer .book-viewer-container footer .right .center-bg .footer-icon-function-container a.qrcode").removeClass("active");
    }
}
function footerindex() {
    $(".third-section-viewer").addClass("animated puffOut").fadeOut();
    $(".second-section-viewer").addClass("animated puffIn").fadeIn();
    $(".left-menu-main-container").hide();
    $(".enrichment-container-menu-right").hide();
    setTimeout(function () {
        $(".index-container-white .box-container-index .item-box-container .item-row-container").addClass("animated fadeInRight").fadeIn();
    }, 500);
    $(".index-container-white .book-title a").attr("curent", "view");
}
function Closefooterindex() {
    $(".popup-index").fadeOut();
    $(".popup-index .container-popup").addClass("animated slideOutUp");
}
function popupenrishmentscontainer() {
    $(".popup-enrishments-container").fadeIn();
    $(".popup-enrishments-container .container-popup").addClass("animated fadeIn");
    $(".popup-enrishments-container .container-popup").removeClass("slideOutUp");
    if (window.sound) {
        $("#sound_menu")[0].play();
    }
}
function Closepopupenrishmentscontainer() {
    if ($(".popup-enrishments-container .container-popup").hasClass("fadeIn")) {
        if (window.sound) {
            $("#sound_close")[0].play();
        }
        $(".popup-content-a .inner-content").html("");
        $(".popup-enrishments-container").fadeOut();
        $(".popup-enrishments-container .container-popup").addClass("animated slideOutUp");
        $(".popup-enrishments-container .container-popup").removeClass("slideInDown");
    }
}
function Closepopupenrishmentscontainer1() {
    if ($(".popup-enrishments-container .container-popup").hasClass("fadeIn")) {
        if (window.sound) {
            $("#sound_close")[0].play();
        }
        $(".popup-content-a .inner-content").html("");
        $(".popup-enrishments-container .container-popup").removeClass("fadeIn");
        $(".popup-enrishments-container").hide();
    }
}
function Closefooterindex() {
    if ($(".second-section-viewer").css("display") == "block") {
        if (window.sound) {
            $("#sound_close")[0].play();
        }
        $(".popup-index").fadeOut();
    }
}
var is_safari = navigator.userAgent.indexOf('Safari') == -1;
function launchFullscreenEnrishments() {
    // var userAgent = window.navigator.userAgent.toLowerCase(),
    //     ios = /iphone|ipod|ipad/.test( userAgent );
    $(".exit-exit").fadeIn();
    element = document.getElementById("container-popup");
    element.style.display = "";
    if (element.requestFullscreen) {
        element.requestFullscreen();
    } else if (element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
    } else if (element.msRequestFullscreen) {
        element.msRequestFullscreen();
    } else if (element.webkitRequestFullscreen) {
}
        if(  deviceType=="iphone" ||  deviceType=="ipad" ) {
            $('#container-popup').addClass("active");
            $('.exit-full-screen').show();
            $('.exit-exit').show();
        }
    }
function openinformation() {
    $(".do-you-know-popup-container").fadeIn();
    $(".do-you-know-popup-container .letter .lamp").fadeIn();
    $(".do-you-know-content").removeClass("slideOutUp animated");
    $(".do-you-know-content").addClass("slideInDown animated");
    $(".do-you-know-popup-container .letter .lamp").addClass("flash animated");
}
function OpenSignIn()
{
    if((window.location.href).indexOf("secret")!=-1){
        showAppMsg();
    }else{
        $("#ForgetPass").fadeOut();
        $("#SignUp").fadeOut();
        $("#SignIn").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated");
        $("#SignIn").fadeIn();
        $(".sign-popup-container").fadeIn();
    }
}
function OpenSignUp()
{
    if((window.location.href).indexOf("secret")!=-1){
        showAppMsg();
    }else{
        $("#SignIn").fadeOut();
        $("#ForgetPass").fadeOut();
        $("#SignUp").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated");
        $("#SignUp").fadeIn();
        $(".sign-popup-container").fadeIn();
    }
}
function Openforgetpass()
{
    $("#SignIn").addClass("bounceOutLeft animated").fadeOut();
    $("#SignUp").addClass("bounceOutLeft animated").fadeOut();
    $("#ForgetPass").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated");
    $("#ForgetPass").addClass("bounceInRight animated").fadeIn();
    $(".sign-popup-container").fadeIn();
}
function OpenActivation()
{
    if((window.location.href).indexOf("secret")!=-1){
        showAppMsg();
    }else{
        $("#activation").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated");
        $("#activation").fadeIn();
        $(".activation-popup-main-container").fadeIn();
    }
}
function cloaseActivation()
{
    $("#activation").addClass("bounceOutRight bounceInLeft bounceOutLeft animated");
    $("#activation").fadeOut();
    $(".activation-popup-main-container").fadeOut();
}
function showAppMsg(){
    // var userAgent = window.navigator.userAgent.toLowerCase(),
    //     ios = /iphone|ipod|ipad/.test( userAgent );

    if(  deviceType=="iphone" ||  deviceType=="ipad" ) {
        window.webkit.messageHandlers.callbackHandler.postMessage('Show subscribe messege');
    } else {
        Manhal_app.callSubscribeScreen();
    }
}
