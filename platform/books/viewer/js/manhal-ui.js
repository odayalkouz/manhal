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
$(document).ready(function (){
        $(".jq_audio").prop("muted", false);
        $(".moresound").addClass("sound-on");

    setTimeout(function (){
        $(".loader-start-browsing .logo-loader").addClass("animates");
        $(".loader-start-browsing .logo-text").addClass("slideInLeft animated");
        setTimeout(function (){
            $(".loader-start-browsing .logo-text").show();
        },10);
        setTimeout(function (){
            $(".loader-start-browsing .logo-text1").addClass("slideInLeft animated");
            setTimeout(function (){
                $(".loader-start-browsing .logo-text1").show();
            },10)
        },100);
    }, 500);
    jQuery(window).load(function (){
        setTimeout(function (){
            $(".loader-start-browsing").hide();
        }, 1500);
    });
    // accordion jquery


    var userAgent = window.navigator.userAgent.toLowerCase(),
        ios = /iphone|ipod|ipad/.test(userAgent);
    if (ios) {
        // $("body,.book-viewer-container").bind('touchmove', function (e) {
        //         e.preventDefault();
        //     }
        // );
    }
    $(document).on("click", "a.doaction[actiontype='paint']", function (e) {
        footerpen();
    });
    $(document).on("click", "html", function (e) {
        if (typeof $(e.target).closest(".full-screen-index-popup1,.doaction,.popup-header,.do-you-know-content,.moreshare,.new-footer-design a.footer-icons,.jq_enrichment,.doaction,.exit-full-screen,.exit-exit,.plyr__control,.crossorigin,.plyr,.plyr--full-ui,.plyr--video,.fullscreen-popup,.inner-content,iframe,.loader-in,.loader-inpopup")[0] == "undefined") {
            // e.preventDefault();
            e.stopPropagation();
            Closepopupenrishmentscontainer();
            //start hide thumbnail and more
            $(".thump-slider").fadeOut();
            $(".more-page-popup").addClass("fade-bottom");
            //$(".pen-page-popup").addClass("fade-bottom");
            $(".new-footer-design a.footer-icons.thumbs").removeClass("active");
            $(".new-footer-design a.footer-icons.more").removeClass("active");
            $("#a2apage_dropdown").removeClass("show");
            //end hide thumbnail and more
            $(".do-you-know-popup-container .letter .head-container .close").trigger("click")
        }
    });
    $(document).on("click", ".pen-page-popup .row-head .minmize", function () {
        $(".pen-page-popup").toggleClass("fade-left-minimize");
        $(this).toggleClass("maximize");
    });
    $(document).on("click", ".exit-full-screen", function () {


        exitFullscreen();
        if (ios) {
            $("#container-popup").removeClass("active");
            $('.exit-exit').hide();
            $('.exit-full-screen-container').hide();
        }

    });
    $(document).on("click", ".popup-enrishments-container .container-popup .fullscreen-popup,.doaction,.jq_enrichment", function () {
        if (ios){
            $('.exit-full-screen-container').hide();
        }
        else {
            // $('.exit-full-screen-container').show();
        }
    });
    $('.sign-popup-container').on('click', function (e) {
        if (e.target == this) {
            $(".sign-popup-container .signin-popup-content .head .close-info-popup, .sign-popup-container .forget-password-content .head .close-info-popup").trigger("click");
        }
    });
    $('.info-popup').on('click', function () {
        $(".popup-information-main-container").fadeIn();
        $(".popup-information-white-content").removeClass("slideOutUp animated");
        $(".popup-information-white-content").addClass("slideInDown animated");
        openmore();
        Closefooterview();
        Closefooterqrcode();
        Closefooterindex();
        closebookmark();
        closesearch();
        closethumbs();
        closenotes();
        Closefootersettings();
        $("#a2apage_dropdown").removeClass("show")
    });
    $(document).on("click", ".close-info-popup", function () {
        $(".popup-information-white-content").removeClass("slideInDown animated");
        $(".popup-information-white-content").addClass("slideOutUp animated");
        $(".popup-information-main-container").fadeOut();
    });
    $('.sign-popup-container').on('click', function (e) {
        if (e.target == this) {
            $(".sign-popup-container .signin-popup-content .head .close-info-popup, .sign-popup-container .forget-password-content .head .close-info-popup").trigger("click");
        }
    });
    if ($(window).width() <= 1024 || ($(window).height() == 1024 && $(window).width() == 1366)) {
        $('.third-section-viewer .book-viewer-container footer').on('click', function (e) {
            if (e.target == this) {
                $(".header-pens a.settings").trigger("click");
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
            $(".pen-page-popup").fadeOut();
            $(".third-section-viewer .book-viewer-container footer .view-page-popup").fadeOut();

            $("#ccanvas").remove();
            $("#canvasback").remove();
            $(".magazine").turn("disable", false);
            pen = 1;
            $(".popup-information-main-container").fadeIn();
            $(".popup-information-white-content").removeClass("slideOutUp animated");
            $(".popup-information-white-content").addClass("slideInDown animated");
        });
        $(document).on("click", ".left-menu-main-container .tabs-content .tabB .content .thumb-item", function () {
            $(".left-menu-main-container").css("z-index", "9");
            $(".left-menu-main-container").fadeOut();
            $(".left-menu-main-container .tabs-content .tabB").fadeOut();
        });
        $(document).on("click", ".left-menu-main-container .tabs-content .tabA .content-search .thumb-item", function () {
            $(".left-menu-main-container").css("z-index", "9");
            $(".left-menu-main-container").fadeOut();
            $(".left-menu-main-container .tabs-content .tabA").fadeOut();
        });
        $(document).on("click", ".unit-number", function () {
            if (!$(this).hasClass("active")) {

                $(this).parent(".level").children(".cd-timeline-block").removeClass("animated fadeInLeft").addClass("animated fadeInRight").fadeIn();
                $(this).addClass("active");
            }
            else {
                $(this).parent(".level").children(".cd-timeline-block").removeClass("animated fadeInRight").addClass("animated fadeInLeft").fadeOut();
                $(this).removeClass("active");
            }
        });
        $(document).on("click", ".cd-date", function () {
            if ($(this).closest(".cd-timeline-content").find(".jq_enrichment").length > 0) {
                if (!$(this).hasClass("active")) {
                    $(this).closest(".cd-timeline-content").find(".icons-container").fadeIn();
                    $(this).addClass("active");
                    if ($(window).width() <= 320) {
                        $(this).closest(".cd-timeline-content").closest(".cd-timeline-block").css("height", "auto")
                    }
                }
                else {
                    $(this).closest(".cd-timeline-content").find(".icons-container").fadeOut();
                    $(this).removeClass("active");
                    if ($(window).width() <= 320) {
                        $(this).closest(".cd-timeline-content").closest(".cd-timeline-block").css("height", "35px");
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
    $(".pen-page-popup .row-a a").click(function () {
        $(".pen-page-popup .row-c a.erazer").removeClass("active");
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
    $(".pen-page-popup .row-b a").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
    });
    $(".pen-page-popup .row-c a").click(function () {
        $(this).addClass("active").siblings().removeClass("active");

        if ($(this).hasClass("erazer")) {
            $(this).addClass("active");
            $(".pen-page-popup .row-a .jq_color").removeClass("active");
            $("#ccanvas").mouseover(function () {
                $(this).css("cursor", "url('themes/Brown-Ar/images/viewpage/eraser01.svg')0 20, auto")
            });
        }
        else {
        }
    });
    $(".sound-on").click(function () {
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
        if ($(".popup-enrishments-container").is(":visible")) {
            if (typeof $(e.target).closest("#iframe").contents().find("img")[0] == "undefined" && typeof $(e.target).closest(".doaction,.plyr__control,.popup-content-a")[0] == "undefined") {
                Closefooterindex();
                exitFullscreen()

            }
        }
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
    $(".new-footer-design a.footer-icons.pen").click(function () {
        if ($(".morezoomin").hasClass("zoom1")) {
            $(".morezoomin").click();
            setTimeout(function () {
                footerpen();
                Closefootersettings();
                Closefooterview();
                Closefooterqrcode();
                Closefooterindex();
            }, 700);
        } else {
            footerpen();
            Closefootersettings();
            Closefooterview();
            Closefooterqrcode();
            Closefooterindex();
        }
    });
    $(".morezoomin").click(function () {
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
    $(".popup-index .container-popup .close-index-popup,.close-index-popup1").click(function () {
        Closepopupenrishmentscontainer();
        exitFullscreen();
    });
    $(".popup-enrishments-container .container-popup .close-index-popup").click(function () {
        Closepopupenrishmentscontainer();
        exitFullscreen();
    });
    $(".exit-exit").click(function () {
        Closepopupenrishmentscontainer1();
        exitFullscreen();
    });
    $(".new-footer-design a.footer-icons.thumbs").click(function () {
        Closefooterpen();
        $(this).toggleClass("active");
        $(".thump-slider").fadeToggle("slow");
        $(".qrcode-page-popup").addClass("fade-bottom");
        $(".note-content-page-popup").addClass("fade-bottom");
        $(".enrichments-page-popup").addClass("fade-bottom");
        $(".search-content-page-popup").addClass("fade-bottom");
        $(".bookmark-content-page-popup").addClass("fade-bottom");
        $("#a2apage_dropdown").removeClass("show");
        //Start Hide More//
        $(".more-page-popup").addClass("fade-bottom");
        $(".new-footer-design a.footer-icons.more").removeClass("active");
        //End Hide More//
    });
    $(".new-footer-design a.footer-icons.more").click(function () {
        openmore();
        Closefooterpen();
        $(".qrcode-page-popup").addClass("fade-bottom");
        $(".note-content-page-popup").addClass("fade-bottom");
        $(".enrichments-page-popup").addClass("fade-bottom");
        $(".search-content-page-popup").addClass("fade-bottom");
        $(".bookmark-content-page-popup").addClass("fade-bottom");
        $("#a2apage_dropdown").removeClass("show");
    });
    $(document).on("click", ".moreqrcode,.qrcode-page-popup .head a.close", function (e) {
        openqrcode();
    });
    $(document).on("click", ".morenotes,.note-content-page-popup .head a.close", function (e) {
        opennotecontnet();
    });
    $(document).on("click", ".moreshare,.share-content-page-popup .head a.close", function (e) {
        opensharecontnet();
    });
    $(document).on("click", ".moresearch,.search-content-page-popup .head a.close", function (e) {
        opensearchcontnet();
    });
    $(document).on("click", ".morebookmark,.bookmark-content-page-popup .head a.close", function (e) {
        openbookmarkcontnet();
    });
    $(document).on("click", ".moreenrishment,.enrichments-page-popup .head a.close", function (e) {
        openenrichmentscontnet();
    });
    $(document).on("click", ".moreenrishmentbook,.enrichmentsbook-page-popup .head a.close", function (e) {
        openenrichmentbookscontnet();
    });
    $(document).on("click", ".moreindex,.index-page-popup .head a.close", function (e) {
        openindexcontnet();
    });
    $(".new-footer-design a.footer-icons.note").click(function () {
        $(".addnote").trigger("click");
        $(this).removeClass("animated pulse");
        $(this).addClass("pulse animated");
        setTimeout(function () {
            $(this).removeClass("animated pulse");
        },1000);
    });
    $(".new-footer-design a.footer-icons.note").mouseleave(function () {
        $(this).removeClass("animated pulse");
    });
    $(".button-animation").mouseleave(function () {
        $(this).removeClass("animated hvr-push");
    });
    if ($(window).width() > 1024) {
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
    $(".index-container-white .book-title a").click(function () {
        setTimeout(function () {
            $(".exit-tab").show()
        }, 1000);
        if ($(".index-container-white .book-title a").attr("curent") == "home") {
            back();
        }
        else if ($(".index-container-white .book-title a").attr("curent") == "view") {
            play();
        }
    });
    $(".timeline-container-white .book-title a").click(function () {
        setTimeout(function () {
            $(".exit-tab").show();
        }, 1000);
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
    $(".left-menu-main-container .tabs-content .tabC .top-title label,.left-menu-main-container .tabs-content .tabD .top-title label").click(function () {
        if ($(this).hasClass("note-mobile")) {
            $(".left-menu-main-container .tabs-content .tabD").fadeOut();
            $(".left-menu-main-container").css("z-index", "999");
            $(".left-menu-main-container").removeClass("puffOut animated").addClass("animated puffIn").fadeIn();
            $(".left-menu-main-container .tabs-content .tabC").fadeIn();
            $(".note-mobile").addClass("active");
            $(".bookmark-mobile").removeClass("active");
        }
        else if ($(this).hasClass("bookmark-mobile")) {
            $(".left-menu-main-container .tabs-content .tabC").fadeOut();
            $(".left-menu-main-container").css("z-index", "999");
            $(".left-menu-main-container").removeClass("puffOut animated").addClass("animated puffIn").fadeIn();
            $(".left-menu-main-container .tabs-content .tabD").fadeIn();
            $(this).addClass("active").siblings().removeClass("active");
            $(".bookmark-mobile").addClass("active");
            $(".note-mobile ").removeClass("active");
        }
    });
    $(".left-menu-main-container .tabs-content .tabC .top-title .back,.left-menu-main-container .tabs-content .tabD .top-title .back").click(function () {
        $(".left-menu-main-container").css("z-index", "9");
        $(".left-menu-main-container").fadeOut();
        $(".left-menu-main-container .tabs-content .tabC").fadeOut();
        setTimeout(function () {
            $(".note-mobile").addClass("active");
            $(".bookmark-mobile").removeClass("active");
        }, 700)
    });
});
$(window).on("load", function () {
    $(".loader-screen").fadeOut("slow");
    $(".viewer-container .first-section-viewer .title h1").addClass("animated zoomIn").fadeIn();
    // play();
});
function back() {
    $(".first-section-viewer").removeClass("animated puffOut").fadeIn();
    $(".viewer-container").fadeIn();
    $(".second-section-viewer").removeClass("animated puffOut").fadeOut();
    $(".third-section-viewer").removeClass("animated puffIn").fadeOut();
    $(".second-section-viewer").removeClass("animated puffIn").fadeOut();
    $(".third-section-viewer").removeClass("animated puffIn").fadeOut();
    $(".index-container-white .box-container-index .item-box-container .item-row-container").removeClass("animated fadeInRight").fadeOut();
    $(".third-section-viewer .book-viewer-container header").width($(".magazine").width());
}
function play() {
    // alert();
    $(".first-section-viewer").addClass("animated puffOut").fadeOut();
    $(".second-section-viewer").addClass("animated puffOut").fadeOut();
    $(".third-section-viewer").addClass("animated puffIn").fadeIn();
    // setTimeout(function () {
        $(".third-section-viewer .book-viewer-container header .title-container").addClass("animated fadeInLeft").fadeIn();
        $(".left-menu-main-container").fadeIn();
        $(".enrichment-container-menu-right").addClass("animated puffOut").fadeIn();
        $(".third-section-viewer .book-viewer-container header").width($(".magazine").width());
        // resizeViewport();
    // }, 2800);
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
    $(".more-page-popup").addClass("fade-bottom");
    $(".qrcode-page-popup").addClass("fade-bottom");
    $(".note-content-page-popup").addClass("fade-bottom");
    $(".enrichments-page-popup").addClass("fade-bottom");
    $(".search-content-page-popup").addClass("fade-bottom");
    $(".bookmark-content-page-popup").addClass("fade-bottom");
    $("#a2apage_dropdown").removeClass("show");

    if (pen == 1) {
        $(".new-footer-design a.footer-icons.pen").addClass("active");

        if (window.sound) {
            $("#sound_menu")[0].play();
        }
        $(".pen-page-popup").removeClass("fade-bottom");
        pen = 0;
        if ($("#ccanvas").length < 1) {
            $(".magazine").turn("disable", true);
            drawing();
        }
        $("#ccanvas").mouseover(function () {
            $(this).css("cursor", "url('themes/Brown-Ar/images/viewpage/pen1.svg'), auto");
        });
        // $(".page_container .doaction").hide();
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
    $(".pen-page-popup").addClass("fade-bottom");
    $(".page_container .doaction").show();
    if ($(".pen-page-popup").hasClass("fade-bottom")) {
        $(".new-footer-design a.footer-icons.pen").removeClass("active");
        pen = 1;
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
    if ($(".pen-page-popup").hasClass("fade-left-minimize")) {
        setTimeout(function () {
            $(".pen-page-popup").removeClass("fade-left-minimize");
        }, 1000);
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
        $(".morezoomin").addClass("zoom1");

        window.zoomed = 1;
        $("#zoom_label").attr("title", Lang.ZoomOut);

    }
    else {
        if (window.sound) {
            $("#sound_close")[0].play();
        }
        $('.magazine-viewport').zoom('zoomOut');
        $(".third-section-viewer .book-viewer-container footer .zoom-popup").addClass("fade-bottom");
        $(".third-section-viewer .book-viewer-container footer .zoom-popup").removeClass("fade-top");
        $(".morezoomin").removeClass("zoom1");
        window.zoomed = 0;
        $("#zoom_label").attr("title", Lang.ZoomIn);
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
        setTimeout(function () {
            $(".popup-enrishments-container").fadeOut();
        });
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
function launchFullscreenEnrishments() {
    $('.exit-full-screen-container').show();
    var userAgent = window.navigator.userAgent.toLowerCase(),
        ios = /iphone|ipod|ipad/.test(userAgent);
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
    if (ios) {
        $('#container-popup').addClass("active");
        $('.exit-exit').show();
    }
    if (document.documentMode || /Edge/.test(navigator.userAgent)) {
        $('#container-popup').addClass("active");
        $('.exit-exit').show();
        $('.do-you-know-popup-container .do-you-know-content').css("top",25+'%');
    }
}
function openinformation() {
    $(".do-you-know-popup-container").fadeIn();
    $(".do-you-know-popup-container .letter .lamp").fadeIn();
    $(".do-you-know-content").removeClass("slideOutUp animated");
    $(".do-you-know-content").addClass("slideInDown animated");
    $(".do-you-know-popup-container .letter .lamp").addClass("flash animated");
}
function OpenSignIn() {
    if ((window.location.href).indexOf("secret") != -1) {
        showAppMsg();
    } else {
        $("#ForgetPass").fadeOut();
        $("#SignUp").fadeOut();
        $("#SignIn").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated");
        $("#SignIn").css("display", "table");
        $(".sign-popup-container").fadeIn();
    }
}
function OpenSignUp() {
    if ((window.location.href).indexOf("secret") != -1) {
        showAppMsg();
    } else {
        $("#SignIn").fadeOut();
        $("#ForgetPass").fadeOut();
        $("#SignUp").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated");
        $("#SignUp").css("display", "table");
        $(".sign-popup-container").fadeIn();
    }
}
function Openforgetpass() {
    $("#SignIn").addClass("bounceOutLeft animated").fadeOut();
    $("#SignUp").addClass("bounceOutLeft animated").fadeOut();
    $("#ForgetPass").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated");
    $("#ForgetPass").addClass("bounceInRight animated").fadeIn();
    $(".sign-popup-container").fadeIn();
}
function OpenActivation() {
    if ((window.location.href).indexOf("secret") != -1) {
        showAppMsg();
    } else {
        $("#activation").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated");
        $("#activation").css("display", "table");
        $(".activation-popup-main-container").fadeIn();
    }
}
function cloaseActivation() {
    $("#activation").addClass("bounceOutRight bounceInLeft bounceOutLeft animated");
    $("#activation").fadeOut();
    $(".activation-popup-main-container").fadeOut();
}
function showAppMsg() {
    var userAgent = window.navigator.userAgent.toLowerCase(),
        ios = /iphone|ipod|ipad/.test(userAgent);
    if (ios) {
        window.webkit.messageHandlers.callbackHandler.postMessage('Show subscribe messege');
    } else {
        Manhal_app.callSubscribeScreen();
    }
}
function openmore() {
    //Start Hide Thumbs
    $(".thump-slider").fadeOut();
    $(".new-footer-design a.footer-icons.thumbs").removeClass("active");
    //End Hide Thumbs
    if ($(".more-page-popup").hasClass("fade-bottom")) {
        $(".more-page-popup").removeClass("fade-bottom");
        $(".new-footer-design a.footer-icons.more").addClass("active");
        $("#AddNote").removeClass("pulse animated infinite");
        $("#bookmark").removeClass("pulse animated infinite");
    }
    else {
        $(".more-page-popup").addClass("fade-bottom");
        $(".new-footer-design a.footer-icons.more").removeClass("active")
    }
}
function openqrcode() {
    openmore();
    if ($(".qrcode-page-popup").hasClass("fade-bottom")) {
        $(".qrcode-page-popup").removeClass("fade-bottom");
    }
    else {
        $(".qrcode-page-popup").addClass("fade-bottom");
    }
}
function opennotecontnet() {
    openmore();
    if ($(".note-content-page-popup").hasClass("fade-bottom")) {
        $(".note-content-page-popup").removeClass("fade-bottom");
        $("#AddNote").addClass("pulse animated infinite");
    }
    else {
        $(".note-content-page-popup").addClass("fade-bottom");
        $("#AddNote").removeClass("pulse animated infinite");
    }
}
function opensearchcontnet() {
    openmore();
    $(".search-slider").show();
    if ($(".search-content-page-popup").hasClass("fade-bottom")) {
        $(".search-content-page-popup").removeClass("fade-bottom");
    }
    else {
        $(".search-content-page-popup").addClass("fade-bottom");
    }
}
function openbookmarkcontnet() {
    openmore();
    $(".bookmark-slider").show();
    if ($(".bookmark-content-page-popup").hasClass("fade-bottom")) {
        $(".bookmark-content-page-popup").removeClass("fade-bottom");
        $("#bookmark").addClass("pulse animated infinite");
    }
    else {
        $(".bookmark-content-page-popup").addClass("fade-bottom");
        $("#bookmark").removeClass("pulse animated infinite");
    }
}
function openenrichmentscontnet() {
    openmore();
    if ($(".enrichments-page-popup").hasClass("fade-bottom")) {
        $(".enrichments-page-popup").removeClass("fade-bottom");
        loadEnrichments();
    }
    else {
        $(".enrichments-page-popup").addClass("fade-bottom");
    }
}
function openenrichmentbookscontnet() {
    openmore();
    if ($(".enrichmentsbook-page-popup").hasClass("fade-bottom")) {
        $(".enrichmentsbook-page-popup").removeClass("fade-bottom");
        $(".enrichmentsbook-page-popup").addClass("slideInDown animated");
        $(".absolute-enrichmentsbook-page-popup").show();
        loadEnrichments();
    }else{
        $(".enrichmentsbook-page-popup").addClass("fade-bottom");
        $(".absolute-enrichmentsbook-page-popup").hide();
        $(".enrichmentsbook-page-popup").removeClass("slideInDown animated");
    }
}
function openindexcontnet() {
    openmore();
    if ($(".index-page-popup").hasClass("fade-bottom")) {
        $(".index-page-popup").removeClass("fade-bottom");
        $(".index-page-popup").addClass("slideInDown animated");
        $(".absolute-index-page-popup").show();
        loadEnrichments();
    }
    else {
        $(".index-page-popup").addClass("fade-bottom");
        $(".absolute-index-page-popup").hide();
        $(".index-page-popup").removeClass("slideInDown animated");
    }
}
function opensharecontnet() {
    openmore();
    if (!$("#a2apage_dropdown").hasClass("show")) {
        $("#a2apage_dropdown").addClass("show").show();
    }
    else {
        $("#a2apage_dropdown").removeClass("show").hide()
    }
}
