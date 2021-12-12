function showdeletemessage() {
    $(".popup-delete-container").fadeIn();
    $(".popup-delete-container .delete-container").removeClass("slideOutUp").addClass("animated slideInDown").fadeIn();
}
/////////////////////////////////*******************************///////////////////////////////
function hidedeletemessage() {
    $(".popup-delete-container").fadeOut();
    $(".popup-delete-container .delete-container").removeClass("slideInDown").addClass("slideOutUp").fadeOut();
}
function showloginmessage() {
    $(".popup-login-container").fadeIn();
    $(".popup-login-container .login-container").removeClass("slideOutUp").addClass("animated slideInDown").fadeIn();
}
/////////////////////////////////*******************************///////////////////////////////
function hideloginmessage() {
    $(".popup-login-container").fadeOut();
    $(".popup-login-container .login-container").removeClass("slideInDown").addClass("slideOutUp").fadeOut();
}
function printDiv()
{
   var a9= parseInt($(".swiper-pagination-total").html())+1;
    var b9= $(window).height();
   var b91= $(window).height();
    $(".questions-main-container .content-container").height(a9*b9);

    var divToPrint=document.getElementById('printing-container');
    var divToPrint1=document.getElementById('print-result-a');
    var newWin=window.open('','Print-Window');
    newWin.document.open();
    newWin.document.write('<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"><link href="../all/thems/ar/css/swiper.min.css" rel="Stylesheet" type="text/css"/><link rel="Stylesheet" type="text/css" href="../all/thems/ar/css/print.css" /><link rel="Stylesheet" type="text/css" href="../all/thems/ar/css/size1.css" /></head><body onload="window.print()"><section class="quiz-container"><div class="result-page-container">'+divToPrint1.innerHTML+ "</div>" + divToPrint.innerHTML+'</section></body></html>');
    newWin.document.close();
    setTimeout(function(){
        newWin.close();
        $(".questions-main-container").addClass("zoomOut").removeClass("animated zoomIn").fadeOut();
    },200);
}
$(document).ready(function () {

    // start fullscreen****************************************************
    document.addEventListener('fullscreenchange', exitHandler);
    document.addEventListener('webkitfullscreenchange', exitHandler);
    document.addEventListener('mozfullscreenchange', exitHandler);
    document.addEventListener('MSFullscreenChange', exitHandler);
    function exitHandler() {
        if (!document.fullscreenElement && !document.webkitIsFullScreen && !document.mozFullScreen && !document.msFullscreenElement) {
            $(".fullscreen-buttons-min").hide();
            $(".fullscreen-buttons").show();
        }
    }
    $(document).on("click",".fullscreen-buttons",function(){
        $(".fullscreen-buttons-min").show();
        $(".fullscreen-buttons").hide();
        launchFullscreen();
    });
    $(document).on("click",".fullscreen-buttons-min",function() {
        exitFullscreen();
        $(".fullscreen-buttons-min").hide();
        $(".fullscreen-buttons").show();
    });
// end fullscreen****************************************************
    // $("#QuizTitle").html($("#title").html());

    $(document).on("click", ".questions-main-container .question-answer-container .answer .true-false li input, .questions-main-container .question-answer-container .answer .multible-choises li input,.questions-main-container .question-answer-container .answer .multiple-response .line-row input", function () {
   
        if($(this).prop("checked") == true) {
          
            $(this).prop("checked", true);
        }
        else {
             
            $(this).prop("checked", false);
        }
    });
    $(document).on("change", ".questions-main-container .question-answer-container .answer .fill-in-the-blank .box-text input", function () {
        $(this).attr("value",$(this).val())
    });
    $(document).on("click", "#print_result", function () {
        $(".questions-main-container").removeClass("zoomOut").addClass("animated zoomIn").fadeIn().css("opacity","1");
        printDiv();
            // setTimeout(function () {
            //     $(".questions-main-container").addClass("zoomOut").removeClass("animated zoomIn").fadeOut().css("opacity","1");
            // },3000)
    });
    $(document).on("click", ".asound", function () {
        if($("#"+$(this).attr("asound"))[0].paused){
            $("#"+$(this).attr("asound"))[0].play();
        }else{
            $("#"+$(this).attr("asound"))[0].pause();
            $("#"+$(this).attr("asound"))[0].currentTime = 0;
        }
    });
    $('.hamburger').click(function () {
        if ($(this).hasClass("is-active")) {
            $(this).removeClass("is-active");
            $(".feedback-question-container").addClass("active");
        }
        else {
            $(this).addClass("is-active");
            $(".feedback-question-container").removeClass("active");
        }
    });
    $(".popup-login-container .login-container .close").click(function () {
        hideloginmessage();
    });
    // Start loader //
    $('body').manhalLoader({
        splashID: "#jSplash",
        splashVPos: '50%',
        loaderVPos: '90%',
        splashFunction: function () {
            $('<div class="manhal-main-loader"><div class="loader-effect"><div class="checkmark draw"></div>' +
                '</div><div class="logo-loader"></div></div>').appendTo('#manhalpreOverlay');
        },
        onLoading: function (per) {
            $(".silver-container").addClass("animated zoomOut").fadeOut();
            $(".result-page-container").removeClass("zoomIn").addClass("zoomOut").fadeOut();
            $(".questions-main-container").removeClass("zoomOut").addClass("animated zoomIn").fadeIn();
        },
    }, function () {
        $("#manhalpreOverlay").fadeOut("fast");
        playslider();
    });
    // End loader //
    // $(".silver-container .content-container .btn-start-container a").click(function () {
    // $(".result-page-container").addClass("animated zoomIn").fadeIn();
    // setTimeout(function () {
    //     $(".result-page-container .content-container .btn-start-container").addClass("animated zoomIn").fadeIn();
    // }, 250)
    // });
    $(".questions-main-container .content-container .information").click(function () {
        $(".btn-print-container").fadeOut();
        $(".questions-main-container").removeClass("zoomIn").addClass("zoomOut").fadeOut();
        $(".result-page-container").removeClass("zoomOut").addClass("animated zoomIn").fadeIn();
        $(".result-page-container .content-container .btn-start-container").show();
        $(".result-page-container .content-container .content .bottom-content .right-container .box-white .bottom").removeClass("opacity");
        $(".result-page-container .content-container .btn-again-container").hide();
        $(".result-page-container .content-container .btn-again-container2").hide();

    });
    $(".result-page-container .content-container .btn-again-container a").click(function () {
        $(".result-page-container").removeClass("zoomIn").addClass("zoomOut").fadeOut();
        $(".questions-main-container").removeClass("zoomOut").addClass("animated zoomIn").fadeIn();
        $(".feedback-question-container").hide();
        // startquiz();
    });
    $(".result-page-container .content-container .btn-start-container a").click(function () {
        $(".btn-print-container").fadeIn();
        $(".result-page-container").removeClass("zoomIn").addClass("zoomOut").fadeOut();
        $(".questions-main-container").removeClass("zoomOut").addClass("animated zoomIn").fadeIn();
        // playslider();
    });
    $(".questions-main-container .question-answer-container .correction-btn a.image #viewquiz").click(function () {
        $(".questions-main-container").removeClass("zoomIn").addClass("zoomOut").fadeOut();
        $(".result-page-container").removeClass("zoomOut").addClass("animated zoomIn").fadeIn();
        $(".result-page-container .content-container .btn-start-container").hide();
        $(".result-page-container .content-container .btn-again-container").show();
        $(".result-page-container .content-container .content .bottom-content .right-container .box-white .bottom").removeClass("opacity");
    });
});
function playslider()
{
    stopVideo(document);
     swiper = new Swiper('.swiper-container', {
      pagination: '.swiper-pagination',
      paginationType: 'progress',
      nextButton: '.swiper-button-next',
      prevButton: '.swiper-button-prev',
      keyboardControl: true,
      noSwiping:true,
      noSwipingClass:'swiper-no-swiping'
     });
    swiper.on('transitionStart', function () {
        $(".swiper-pagination-current").val($(".swiper-slide-active").index()+1);
        feedbackQuestion();
        stopVideo(document);
    });
     swiper1 = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination1',
        paginationType: 'fraction',
        paginationClickable: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        keyboardControl: true,
        noSwiping:true,
        noSwipingClass:'swiper-no-swiping',
         inverse:'true',
        paginationFractionRender: function (swiper, currentClassName, totalClassName) {
        $(".questions-main-container .question-answer-container .question .num").addClass("swiper-pagination-current2");
        return '<input type="text" value="0" class="floating-left ' + currentClassName + '"/>' +
        '<span>-</span>' + '<span class="' + totalClassName + '"></span>';},
     });
    $(".swiper-pagination1 span").click(function () {
        var val=$(this).index()+"1";
        swiper.slideTo(val, 300, false);
    });
    
    if($(window).width()<=1024){
        resizeviews();
    }
}




function launchFullscreen() {
    $('.exit-full-screen-container').show();
    var userAgent = window.navigator.userAgent.toLowerCase(),
        ios = /iphone|ipod|ipad/.test(userAgent);
    $(".exit-exit").fadeIn();
    element = document.getElementById("full-screen-container");
    if (element.requestFullscreen) {
        element.requestFullscreen();
    } else if (element.mozRequestFullScreen) {
        element.mozRequestFullScreen();
    } else if (element.msRequestFullscreen) {
        element.msRequestFullscreen();
    } else if (element.webkitRequestFullscreen) {
    }

}

function exitFullscreen() {

    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
    }


}
