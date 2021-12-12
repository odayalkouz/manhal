document.addEventListener("touchmove", function(event) {event.preventDefault();}, {passive: false} );
//close full screen
document.addEventListener('fullscreenchange', exitHandler);
document.addEventListener('webkitfullscreenchange', exitHandler);
document.addEventListener('mozfullscreenchange', exitHandler);
document.addEventListener('MSFullscreenChange', exitHandler);
function exitHandler() {
    if (!document.fullscreenElement && !document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement) {
        $('.closefull').hide();
        $('.closefullAction').hide();
    }
}

//close full screen
var imageUrl="";
$(document).ready(function () {
$(".end-time").html("")
    // $(document).load(function () {
    //     $('.disss').hide();
    // })
    // $('body').manhalLoader({
    //     splashID: "#jSplash",
    //     addFiles: [],
    //     splashFunction: function () {  //passing Splash Screen script to jPreLoader
    //         $(".site-container").show();
    //         $(".slider-single").addClass("zoomIn animated").show();
    //         $('.disss').hide();
    //     },
    //     onLoading: function () {
    //         $('.disss').hide();
    //     },
    // }, function () {
    //     $('#jSplash').children('section').not('.selected').hide();
    //     $('#jSplash').hide().fadeIn(800);
    //     // $('.disss').hide();
    // });
    $('.coloring-main-container .user-info-headernew .no-close a').removeClass("waves-effect waves-block");
    $('.coloring-main-container .user-info-headernew .no-close').on('click', function(event){
        event.stopPropagation();
    });
    $(".row-a a").click(function () {
        $(".row-c a.erazer").removeClass("active");
        $(this).addClass("active").siblings().removeClass("active");
        if ($(this).hasClass("color-1")) {
            $("#ccanvas").mouseover(function () {
                $(this).css("cursor", "url('"+window.SITE_URL+"storyeditor/viewer/themes/en/images/pen1.svg'), auto")
            });
        }
        else if ($(this).hasClass("color-2")) {
            $("#ccanvas").mouseover(function () {
                $(this).css("cursor", "url('"+window.SITE_URL+"storyeditor/viewer/themes/en/images/pen2.svg'), auto")
            });
        }
        else if ($(this).hasClass("color-3")) {
            $("#ccanvas").mouseover(function () {
                $(this).css("cursor", "url('"+window.SITE_URL+"storyeditor/viewer/themes/en/images/pen3.svg'), auto")
            });
        }
        else if ($(this).hasClass("color-4")) {
            $("#ccanvas").mouseover(function () {
                $(this).css("cursor", "url('"+window.SITE_URL+"storyeditor/viewer/themes/en/images/pen4.svg'), auto")
            });
        }
        else if ($(this).hasClass("color-5")) {
            $("#ccanvas").mouseover(function () {
                $(this).css("cursor", "url('"+window.SITE_URL+"storyeditor/viewer/themes/en/images/pen5.svg'), auto")
            });
        }
        else if ($(this).hasClass("color-6")) {
            $("#ccanvas").mouseover(function () {
                $(this).css("cursor", "url('"+window.SITE_URL+"storyeditor/viewer/themes/en/images/pen6.svg'), auto")
            });
        }
    });
    $(".row-b a").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
    });
    $(".row-c a").click(function () {
        $(this).addClass("active").siblings().removeClass("active");

        if ($(this).hasClass("erazer")) {
            $(this).addClass("active");
            $(".row-a .jq_color").removeClass("active");
            $("#ccanvas").mouseover(function () {
                $(this).css("cursor", "url('../../images/eraser01.svg')0 20, auto")
            });
        }
        else {
        }
    });
    $(".row-c a").click(function (){});
    $(".coloring-main-container .user-info-headernew a.dropdown-toggle").click(function () {
        if(!$(this).hasClass("active"))
        {
            if($(".slider.responsive").length==1) {
                $(".slider.responsive").append('<div id="canvas1"><canvas id="canvasback" style="position: absolute;left: 0px;top:0px;right: 0;bottom:0;margin:auto;z-index:997!important;"></canvas><canvas id="ccanvas" style="position: absolute;left: 0px;top:0px;right: 0;bottom:0;margin:auto;z-index:998!important;"></canvas></div>\n');
            }
            else {
                $(".magazine").append('<div id="canvas1"><canvas id="canvasback" style="position: absolute;left: 0px;top:0px;right: 0;bottom:0;margin:auto;z-index:997!important;"></canvas><canvas id="ccanvas" style="position: absolute;left: 0px;top:0px;right: 0;bottom:0;margin:auto;z-index:998!important;"></canvas></div>\n');
            }
            $(this).addClass("active");
            $(this).parent().children(".dropdown-menu").addClass("show");
            $(this).parent().parent().parent().removeClass("animated infinite pulse");
            $("#canvas1").show();
            drawing();
        }
        else{
            $(this).removeClass("active");
            $(this).parent().children(".dropdown-menu").removeClass("show");
            $(this).parent().parent().parent().addClass("animated infinite pulse");
            $("#canvas1").remove();
        }
    });
    $(".vertical-slider-viewer ,.vertical-slider-viewer *").click(function () {
        $(".coloring-main-container .user-info-headernew a.dropdown-toggle").removeClass("active");
        $(".coloring-main-container .user-info-headernew a.dropdown-toggle").parent().children(".dropdown-menu").removeClass("show");
    });


    $(document).on("click", ".action-popup-container .action-popup-content .head .close-info-popup", function (e) {
        CloseActionPopup();
    });
    $(document).on("click", ".action-popup-container .action-popup-content .head .fullscreen-info-popup", function (e) {
        openFullscreenAction();
    });
    $(document).on("click", ".closefullAction", function (e) {
        closeFullscreenAction();
    });

    //Handle Slider
    handleslider();
    //open Fullscreen
    $(document).on("click", ".fullscreen-button", function (e) {
        if(!$(this).hasClass("active"))
        {
            openFullscreen();
        }
    });
    //close Fullscreen
    $(document).on("click", ".closefull", function (e) {
        closeFullscreen()
    });
    //thumbs
    $(document).on("click", ".thumbs-button", function (e) {
        if(!$(this).hasClass("active"))
        {
            $(this).addClass("active");
            $(".footer-main-container").addClass("active");
        }
        else {
            $(this).removeClass("active");
            $(".footer-main-container").removeClass("active");
        }
    });
    //speacking
    $(document).on("click", ".speacking-button", function (e) {
        if(!$(this).hasClass("active"))
        {
            $(this).addClass("active");
        }
        else {
            $(this).removeClass("active");
        }
    });
    //music
    $(document).on("click", ".music-button", function (e) {
        if(!$(this).hasClass("active"))
        {
            $(this).addClass("active ");
        }
        else {
            $(this).removeClass("active");
        }
    });
    $(document).on("click", ".slider-nav .slider-item", function (e) {
        $(this).addClass("is-active").siblings().removeClass("is-active");
        $('.magazine').turn("page",parseInt($(this).attr("data-slick-index"))+1);
    });
    $(document).on("click", ".doyouknow-popup-container .doyouknow-popup-content .head .close-info-popup", function () {
        closedoyouknow();
    });
    $(document).on("click", ".jq_douknow", function () {
       Opendoyouknow($(this));
    });
    //hide-show-tools
    $(document).on("click", ".hide-show-tools", function (e) {
        if(!$(this).hasClass("active")) {
            $(this).addClass("active");
            $(".footer-main-container .tools-title-container .left-container").addClass("fade-bottom");
            $(".footer-main-container .tools-title-container .right-container").addClass("fade-bottom");
            $(".footer-main-container .tools-title-container .center-container").addClass("active");
            $(".thumbs-button").removeClass("active");
            $(".footer-main-container").removeClass("active");
        }
        else {
            $(this).removeClass("active");
            $(".footer-main-container .tools-title-container .left-container").removeClass("fade-bottom");
            $(".footer-main-container .tools-title-container .right-container").removeClass("fade-bottom");
            $(".footer-main-container .tools-title-container .center-container").removeClass("active");
            $(".thumbs-button").removeClass("active");
            $(".footer-main-container").removeClass("active");
        }
    });
    $(".slick-next,.slick-prev,.footer-main-container .tools-title-container .left-container a").mouseover(function() {
        $(this).removeClass("rollIn");
        $(this).addClass("animated jello")
    });
    $(".slick-next,.slick-prev,.footer-main-container .tools-title-container .left-container a").mouseleave(function() {
        $(this).removeClass("animated jello")
    });
    //start close all popups
    $(document).on("click", ".sign-popup-container .close-info-popup", function () {
        $("#ForgetPass").fadeOut();
        $("#SignUp").fadeOut();
        $("#SignIn").fadeOut();
        $(".block-mainContainer").fadeOut();
        $(".sign-popup-container").fadeOut();
        $("#SignIn").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated");
        $("#SignUp").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated");
        $("#ForgetPass").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated");
        $("#message-container").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated");
    });
    $(document).on("click", "#activation .close-info-popup", function () {
        $("#activation").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated").fadeOut();
        $(".activation-popup-main-container").fadeOut();
        $(".block-mainContainer").fadeOut();
    });
    $(document).on("click", "#message-container .close-info-popup", function () {
        $("#message-container").removeClass("bounceOutRight bounceInLeft bounceOutLeft animated").fadeOut();
        $(".message-main-container").fadeOut();
    });
    //End close all popups
    $(document).on("click", "html", function (e) {
        if (typeof $(e.target).closest(".footer-main-container")[0] == "undefined") {
            if($(".thumbs-button").hasClass("active")){
                $(".thumbs-button").removeClass("active");
                $(".footer-main-container").removeClass("active");
            }
        }
    });
    });
function handleslider() {
    //slider-single
    $('.slider-single').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
        fade: false,
        adaptiveHeight: true,
        infinite: false,
        useTransform: true,
        speed: 400,
        cssEase: 'cubic-bezier(0.77, 0, 0.18, 1)'
        // cssEase:'linear'
    });
    //slider-nav
    $('.slider-nav').on('init', function(event, slick) {
        $('.slider-nav .slick-slide.slick-current').addClass('is-active');
    })
        .slick({
            slidesToShow: 7,
            slidesToScroll: 3,
            dots: false,
            focusOnSelect: false,
            infinite: false,
            responsive: [{
                breakpoint: 1024,
                settings: {
                    slidesToShow: 5,
                    slidesToScroll: 3
                }
            }, {
                breakpoint: 768,
                settings: {
                    slidesToShow: 4,
                    slidesToScroll: 2
                }
            }, {
                breakpoint: 420,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            }]
        });
    $('.slider-single').on('afterChange', function(event, slick, currentSlide) {
        $('.slider-nav').slick('slickGoTo', currentSlide);
        var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
        $('.slider-nav .slick-slide.is-active').removeClass('is-active');
        $(currrentNavSlideElem).addClass('is-active');
    });
    $('.slider-nav').on('click', '.slick-slide', function(event) {
        event.preventDefault();
        var goToSingleSlide = $(this).data('slick-index');
        $('.slider-single').slick('slickGoTo', goToSingleSlide);
    });
}
function openFullscreen() {
    $(".closefull").show();
    var userAgent = window.navigator.userAgent.toLowerCase(),
        ios = /iphone|ipod|ipad/.test(userAgent);
    element = document.getElementById("site-container");
    element.style.display = "";
    if (element.requestFullscreen) {
        element.requestFullscreen();
    } else if (element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
    } else if (element.msRequestFullscreen) {
        element.msRequestFullscreen();
    } else if (element.webkitRequestFullscreen) {
    }

    if($(".magazine").turn("display")=="double"){
        setTimeout(function () {
            oldHeight=$(".magazine").height();
            newHeight=$(window).height()-50;
            p=newHeight/oldHeight;
            newWidth=$(".magazine").width()*p;

            $('.magazine-viewport').css({
                width: newWidth,
                height: newHeight
            });
            $(".magazine").turn("size", newWidth,newHeight);
            setTimeout(function () {
                reScale();
                setTimeout(function () {
                    $(".magazine").turn("center");
                },150);
            },150);
        },150);
    }else{
        setTimeout(function () {
            oldHeight=$(".magazine").height();
            newHeight=$(window).height()-50;
            p=newHeight/oldHeight;
            newWidth=$(".magazine").width()*p;

            $('.magazine-viewport').css({
                width: newWidth,
                height: newHeight
            });
            $(".magazine").turn("size", newWidth,newHeight);
            setTimeout(function () {
                reScale();
                setTimeout(function () {
                    $(".magazine").turn("center");
                    $(".magazine").css("left",-($(window).width()-$(".magazine").width()+100));

                },150);
            },150);
        },150);

    }
}
function closeFullscreen(){
    $(".closefull").hide();
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.mozCancelFullScreen) { /* Firefox */
        document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
    }
    setTimeout(function(){
    resizeViewport();
        if($(".magazine").turn("display")=="single" && window.fullScreen){
            newHeight=$(window).height()-50;
            p=newHeight/bookHeight;
            newWidth=(bookWidth*p)/2;
            $(".magazine").width(newWidth);
            $(".magazine").css("left",($(window).width()-$(".magazine").width())/2-$(".container").offset().left);
        }
        setTimeout(function(){
            reScale();
        },500);
    },150);
}
function OpenSignIn(){
    if((window.location.href).indexOf("secret")!=-1){
        showAppMsg();
    }else{
        $("#ForgetPass").fadeOut();
        $("#SignUp").fadeOut();
        $("#SignIn").fadeIn();
        $(".sign-popup-container").fadeIn();
    }
}
function OpenSignUp(){
    if((window.location.href).indexOf("secret")!=-1){
        showAppMsg();
    }else{
        $("#SignIn").fadeOut();
        $("#ForgetPass").fadeOut();
        $("#SignUp").fadeIn();
        $(".sign-popup-container").fadeIn();
    }
}
function Openforgetpass(){
    $("#SignIn").fadeOut();
    $("#SignUp").fadeOut();
    $("#ForgetPass").fadeIn();
    $(".sign-popup-container").fadeIn();
}
function Openactivation(){
    $("#activation").addClass("bounceInLeft animated").fadeIn();
    $(".activation-popup-main-container").fadeIn();
    $(".block-mainContainer").fadeIn();
}
function showMsg(type,title,msg){
    // $(".message-main-container").fadeIn();
    // $("#message-container").fadeIn();
    // $(".message-main-container .paragraph").html(msg);
     swal({ html:true, title:title, type:type, text:msg});
}
function showLoader(){
    $(".manhal-main-loader").fadeIn();
}
function hideLoader(){
    $(".manhal-main-loader").fadeOut();
}
function Opendoyouknow(jq) {

    $("#douknow_txt_view").html(jq.closest(".element").attr("txt"));
    $("#douknow_img_view").attr("src",    jq.closest(".element").attr("img"));
    $(".doyouknow-popup-container").fadeIn();
    $(".doyouknow-popup-content").fadeIn();
}
function closedoyouknow() {
    $(".doyouknow-popup-container").fadeOut();
    $(".doyouknow-popup-content").fadeOut();
}



function OpenActionPopup() {
    $(".action-popup-container").fadeIn();
    $(".action-popup-content").fadeIn();
}
function CloseActionPopup() {
    $(".action-popup-container").fadeOut();
    $(".action-popup-content").fadeOut();
}





function openFullscreenAction() {
    $(".closefullAction").show();
    var userAgent = window.navigator.userAgent.toLowerCase(),
        ios = /iphone|ipod|ipad/.test(userAgent);
    element = document.getElementById("Jq_append_Action");
    element.style.display = "";
    if (element.requestFullscreen) {
        element.requestFullscreen();
    } else if (element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
    } else if (element.msRequestFullscreen) {
        element.msRequestFullscreen();
    } else if (element.webkitRequestFullscreen) {
    }
}
function closeFullscreenAction(){
    $(".closefullAction").hide();
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.mozCancelFullScreen) { /* Firefox */
        document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
    }
}




function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
        x: touchEvent.touches[0].clientX - rect.left,
        y: touchEvent.touches[0].clientY - rect.top
    };
}
function midPointBtw(p1, p2) {
    return {
        x: p1.x + (p2.x - p1.x) / 2,
        y: p1.y + (p2.y - p1.y) / 2
    };
}

function drawing()
{
    var left=0;
    // var height=$(".view-book-lms").height();
    if($(".slider.responsive").length==1){
        var widtht=$("#canvas1").width();
        var height=$(".slider").height();
    }
    else {
        var widtht=$("#canvas1").width();

        var height=$(".magazine").height();
    }

    var transition=1;
    $("#canvasback").attr("height",height*transition);
    $("#canvasback").attr("width",widtht*transition);

    $("#ccanvas").attr("height",height*transition);
    $("#ccanvas").attr("width",widtht*transition);
    var el = document.getElementById('ccanvas');
    var el2 = document.getElementById('canvasback');
    var ctx = el.getContext('2d');
    var ctxBack = el2.getContext('2d');
    var isDrawing, points = [ ];
    window.canvas=el2;
    window.canvasFront=el;
    window.drawingMod="pen";
    // Set up touch events for mobile, etc
    el.addEventListener("touchstart", function (e) {
        mousePos = getTouchPos(canvas, e);
        var touch = e.touches[0];
        var mouseEvent = new MouseEvent("mousedown", {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        el.dispatchEvent(mouseEvent);
    }, false);
    el.addEventListener("touchend", function (e) {
        var mouseEvent = new MouseEvent("mouseup", {});
        el.dispatchEvent(mouseEvent);
    }, false);
    el.addEventListener("touchmove", function (e) {
        var touch = e.touches[0];
        var mouseEvent = new MouseEvent("mousemove", {
            clientX: touch.clientX,
            clientY: touch.clientY
        });
        el.dispatchEvent(mouseEvent);
    }, false);
    ctx.lineWidth = 2;
    ctx.lineJoin = ctx.lineCap = 'round';
    offset=$("#ccanvas").offset();
    rescal=1;
    el.onmousedown = function(e) {
        isDrawing = true;
        points.push({ x:(e.pageX-offset.left)*rescal, y: (e.pageY-offset.top)*rescal });
        //ctx.moveTo((e.pageX-offset.left)*rescal, (e.pageY-offset.top)*rescal);
    };
    el.onmousemove = function(e) {
        if (isDrawing) {
            points.push({ x: (e.pageX-offset.left)*rescal, y: (e.pageY-offset.top)*rescal });
            if(ctx.globalCompositeOperation=="destination-out"){
            }else{
                ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
            }
            var p1 = points[0];
            var p2 = points[1];
            ctx.beginPath();
            ctx.moveTo(p1.x, p1.y);
            for (var i = 1, len = points.length; i < len; i++) {
                var midPoint = midPointBtw(p1, p2);
                ctx.quadraticCurveTo(p1.x, p1.y, midPoint.x, midPoint.y);
                p1 = points[i];
                p2 = points[i+1];
            }
            ctx.lineTo(p1.x, p1.y);
            ctx.stroke();
        }
    };
    el.onmouseup = function() {
        ctxBack.globalCompositeOperation = 'source-over';
        ctxBack.drawImage(ccanvas, 0, 0);
        isDrawing = false;
        points.length = 0;

        if(window.drawingMod=="erease"){
            ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
            ctx.globalCompositeOperation = 'source-over';
            ctx.drawImage(canvasback, 0, 0);
            ctxBack.clearRect(0, 0, ctxBack.canvas.width, ctxBack.canvas.height);
            ctx.globalCompositeOperation = "destination-out";
            ctx.strokeStyle = "rgba(0,0,0,1)";
            ctx.beginPath();
        }
    };
    $(".jq_color").click(function(){
        window.drawingMod="pen";
        ctxBack.globalCompositeOperation = 'source-over';
        ctxBack.drawImage(ccanvas, 0, 0);
        ctx.globalCompositeOperation="source-over";
        ctx.strokeStyle = $(this).attr("color");
        ctx.beginPath();
    });
    $(".jq_canvas_width").click(function(){
        ctx.lineWidth = $(this).attr("line-width");
        ctx.beginPath();
    });
    $(".erazer").click(function(){
        window.drawingMod="erease";
        ctx.clearRect(0, 0, ctx.canvas.width, ctx.canvas.height);
        ctx.globalCompositeOperation = 'source-over';
        ctx.drawImage(canvasback, 0, 0);
        ctxBack.clearRect(0, 0, ctxBack.canvas.width, ctxBack.canvas.height);
        ctx.globalCompositeOperation = "destination-out";
        ctx.strokeStyle = "rgba(0,0,0,1)";
        ctx.beginPath();
    });
    $(".clear-all").click(function () {
        window.drawingMod="pen";
        ctxBack.clearRect(0, 0, el.width, el  .height);
        ctxBack.globalCompositeOperation="source-over";


        ctx.clearRect(0, 0, el.width, el  .height);
        ctx.globalCompositeOperation="source-over";
        ctx.strokeStyle = $(".jq_color.active").attr("color");
        ctx.beginPath();
        $(".jq_color.active").click();

    });

    if(typeof $(".jq_color.active")[0]!="undefined"){
        $(".jq_color.active").click();
    }
}





function calculateTotalValue(length) {
    var minutes = Math.floor(length / 60),
        seconds_int = length - minutes * 60,
        seconds_str = seconds_int.toString(),
        seconds = seconds_str.substr(0, 2),
        time = minutes + ':' + seconds

    return time;
}

function calculateCurrentValue(currentTime) {
    var current_hour = parseInt(currentTime / 3600) % 24,
        current_minute = parseInt(currentTime / 60) % 60,
        current_seconds_long = currentTime % 60,
        current_seconds = current_seconds_long.toFixed(),
        current_time = (current_minute < 10 ? "0" + current_minute : current_minute) + ":" + (current_seconds < 10 ? "0" + current_seconds : current_seconds);

    return current_time;
}
var totalLength="";

function initProgressBar(pl) {
    var player = pl;
    // console.log("player",pl);
    var length = player.duration;
    var current_time = player.currentTime;

    // calculate total length of value
    var currentTime = calculateCurrentValue(current_time);
    totalLength = calculateTotalValue(length);

    $(pl).closest(".audio-player").find(".end-time").html(totalLength);
    // calculate current value time


    $(pl).closest(".audio-player").find(".start-time").html(currentTime);


    var progressbar = $(pl).closest(".audio-player").find('.seekObj')[0];
    progressbar.value = (player.currentTime / player.duration);
    progressbar.addEventListener("click", seek);

    if (player.currentTime == player.duration) {
        $(pl).closest(".audio-player").find(".play-button").removeClass('pause');
        $(pl).closest(".audio-player").find(".album-image").removeAttr("style")

    }

    function seek(evt) {
        var percent = evt.offsetX / this.offsetWidth;
        player.currentTime = percent * player.duration;
        progressbar.value = percent / 100;
    }
};

function initPlayers(pl) {
    // pass num in if there are multiple audio players e.g 'player' + i
    (function() {
        // Variables
        // ----------------------------------------------------------
        // audio embed object
        var playerContainer =pl.find(".audio-wrapper")[0],
            player =pl.find("audio")[0],
            isPlaying = false,
            playBtn =pl.find(".play-button")[0];

        // Controls Listeners
        // ----------------------------------------------------------
        if (playBtn != null) {
            playBtn.addEventListener('click', function() {
                togglePlay()
            });
        }
        // Controls & Sounds Methods
        // ----------------------------------------------------------
        function togglePlay() {
            $(".end-time").html("");

            if (player.paused === false) {
                player.pause();
                isPlaying = false;
                $(playBtn).removeClass('pause');
                imageUrl=window.SITE_URL+"storyeditor/viewer/themes/en/images/soundwave.png";
                $(playBtn).parent().children(".album-image").css('background-image', 'url(' + imageUrl + ')');

            } else {

                player.play();
                $(playBtn).addClass('pause');
                isPlaying = true;
                setTimeout(function () {
                    $(".start-time").show();
                    $(".end-time").show();
                },100);
                imageUrl=window.SITE_URL+"storyeditor/thems/En/images/soundanimation.gif";
                $(playBtn).parent().children(".album-image").css('background-image', 'url(' + imageUrl + ')');
            }
        }
    }());
}
