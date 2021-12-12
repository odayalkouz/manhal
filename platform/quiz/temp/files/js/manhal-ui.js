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
$(document).ready(function () {
    $(document).on("click", ".asound", function () {
        if($("#"+$(this).attr("asound"))[0].paused){
            $("#"+$(this).attr("asound"))[0].play();
        }else{
            $("#"+$(this).attr("asound"))[0].pause();
            $("#"+$(this).attr("asound"))[0].currentTime = 0;
        }

    });

    $(".popup-login-container .login-container .close").click(function () {
        hideloginmessage();
    });

        // Start loader //
    $('body').manhalLoader(
        {
            splashID: "#jSplash",
            splashVPos: '50%',
            loaderVPos: '71%',
            addFiles: [],
            splashFunction: function () {
                $('<div class="loder-bg">').appendTo('#manhalpreOverlay');
            },
            onLoading: function (per) {
            },
        }, function () {
            $(".silver-container").addClass("animated zoomOut").fadeOut();

            $(".result-page-container").removeClass("zoomIn").addClass("zoomOut").fadeOut();
            $(".questions-main-container").removeClass("zoomOut").addClass("animated zoomIn").fadeIn();
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
        startquiz();
    });
    $(".result-page-container .content-container .btn-start-container a").click(function () {
        $(".result-page-container").removeClass("zoomIn").addClass("zoomOut").fadeOut();
        $(".questions-main-container").removeClass("zoomOut").addClass("animated zoomIn").fadeIn();
        playslider();
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
     swiper = new Swiper('.swiper-container', {
      pagination: '.swiper-pagination',
      paginationType: 'progress',
      nextButton: '.swiper-button-next',
      prevButton: '.swiper-button-prev',
      keyboardControl: true,
      noSwiping:true,
      noSwipingClass:'swiper-no-swiping'
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
        swiper.slideTo($(this).index()+"1", 300, false);
    });

    // $(".questions-main-container .question-answer-container .answer").height($(window).height()-($(".questions-main-container .content-container .top-content").height()+149+$(".questions-main-container .question-answer-container .question").height()));

}

