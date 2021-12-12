function tutorialAnimation(x,timeOut) {
    var actualtimeout=600;
    setTimeout(function () {
        $(".tooltip:eq("+ x +")").attr("data-balloon-visible", "");
        $(".tooltip:eq("+ x +")").addClass("data-balloon-visible");
    }, timeOut);
    setTimeout(function () {
        $(".tutorial-icon").css("display","block");
        $(".tutorial-icon").addClass("move");
        $(".tutorial-icon").attr("data-balloon-visible", "");
        $(".tutorial-icon").addClass("data-balloon-visible");
    }, $(".tooltip").length*actualtimeout);
    // console.log(x*actualtimeout)
}
$(document).ready(function () {
    var actualtimeout=600;
    setTimeout(function (){
        for (i = 0; i < $(".tooltip").length; i++) {
            tutorialAnimation(i,i*actualtimeout);
        }
    }, 500);
    $(document).on("click", ".tutorial-icon", function () {
            $(this).removeClass("move");
        $(".tutorial-icon").removeAttr("data-balloon-visible", "");
        if (!$(".tooltip").hasClass("data-balloon-visible")) {
            $(".tooltip").addClass("data-balloon-visible");
            $(".tooltip").attr("data-balloon-visible", "");
            // $(this).addClass("move");
            $(".tutorial-icon").attr("data-balloon-visible", "");
        }
        else {
            $(".tooltip").removeClass("data-balloon-visible");
            $(".tooltip").removeAttr("data-balloon-visible", "")
        }
    });
    $(document).on("click", ".editor-main-container footer .content .rectangle-items-container .addQuestion,.editor-main-container .options-icons .settings,.editor-main-container footer .content .rectangle-items-container #slider ul li label i.edit", function () {
        $(".tooltip,.tutorial-icon").removeAttr("data-balloon-visible", "");
        $(".tooltip").removeClass("data-balloon-visible");
        $(".tutorial-icon").removeClass("move");
        setTimeout(function () {
            $(".tooltip,.tutorial-icon").removeAttr("data-balloon-visible", "");
            $(".tooltip").removeClass("data-balloon-visible");
            $(".tutorial-icon").removeClass("move");
        },2000);
    });
    /////////////////////////////////*******************************///////////////////////////////
    var indexofA = $(".editor-main-container footer .content .rectangle-items-container #slider ul li.active").index() + 1;
    $(".questions-main-container .question-answer-container .num").eq(indexofA - 1).html(indexofA);
    /////////////////////////////////*******************************///////////////////////////////

    /////////////////////////////////*******************************///////////////////////////////
    $(".questions-main-container .question-answer-container .answer .matching .left-container .box-container").resizable({
        animate: true,
        maxHeight: 300,
        handles: 's',
        alsoResize: ".questions-main-container .question-answer-container .answer .matching .item,.questions-main-container .question-answer-container .answer .matching .left-container .box-container,.questions-main-container .question-answer-container .answer .matching .RIGHT-container .box-container"
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".delete_widget", function () {
        $(this).parent().remove();
    });
    /////////////////////////////////*******************************///////////////////////////////
    var slideCount = $('#slider ul li').length;
    var slideWidth = $('#slider ul li').width() + 8;
    var slideHeight = $('#slider ul li').height();
    var sliderUlWidth = slideCount * slideWidth;
    $('#slider').css({width: sliderUlWidth, height: slideHeight});
    function moveLeft() {
        if(parseInt($("#questions_slider").css("left").replace("px",""))==0){
            $(".control_prev").fadeOut();
        }else{
            var newLeft1 = parseInt($('#slider ul').css("left")) + slideWidth;
            $('#slider ul').animate({
                left: newLeft1
            });
            $('#slider ul').css("margin-right","0");
            $('#slider ul').css("margin-left","0");
            $(".control_next").fadeIn();
        }
    }
    var dist = sliderUlWidth - (parseInt($('#slider ul').css("left")) * -1+($("#questions_slider").width()-$(".addQuestion").width()));
    function moveRight() {

        if(dist<=0) {

            $(".control_next").fadeOut();
        }else{
            var newLeft = parseInt($('#slider ul').css("left")) - slideWidth;
            $('#slider ul').animate({
                left: newLeft
            });
            $('#slider ul').css("margin-left","0");
            $('#slider ul').css("margin-right","51px");
            $(".control_prev").fadeIn();
        }

    }
    /////////////////////////////////*******************************///////////////////////////////
    function changenumofQuestion() {
        $(".editor-main-container footer .content .num-of-question label:nth-child(1)").html(slideCount);
    }
    /////////////////////////////////*******************************///////////////////////////////
    function changenumofQuestionActive() {
        $(".editor-main-container footer .content .num-of-question input").val($(".editor-main-container footer .content .rectangle-items-container #slider ul li.active").length);
    }
    /////////////////////////////////*******************************///////////////////////////////
    $('a.control_prev').click(function () {
        moveLeft();
        // $('#slider').css({width: "100%", height: slideHeight});
        // $('#questions_slider').css({width: ""});

    });
    $('a.control_next').click(function () {
        moveRight();
        // $('#slider').css({width: "100%", height: slideHeight});
        // $('#questions_slider').css({width: ""});
    });
    if (sliderUlWidth > $('#slider').width()) {
        $(".control_next").fadeIn();
        $(".control_prev").fadeOut();
        // $("#questions_slider").css('width', '100%');
        // $("#slider").css('width', '100%');
    }
    /////////////////////////////////*******************************///////////////////////////////
    changenumofQuestion();
    changenumofQuestionActive();
    /////////////////////////////////*******************************///////////////////////////////
    //$('.editor-main-container footer .content .rectangle-items-container #slider ul li').click(function () {
    //
    //    //$(".editor-main-container footer .content .num-of-question input").val($(this).index() + 1);
    //    //indexofA=$(".editor-main-container footer .content .rectangle-items-container #slider ul li.active").index()+1;
    //    //$(".questions-main-container .question-answer-container").removeClass("active animated zoomIn");
    //    //$(".questions-main-container .question-answer-container").eq(indexofA-1).addClass("active animated zoomIn");
    //    //$(".questions-main-container .question-answer-container .num").eq(indexofA-1).html(indexofA);
    //});
    /////////////////////////////////*******************************///////////////////////////////

    /////////////////////////////////*******************************///////////////////////////////

    $('.hamburger').click(function () {
        if (!$(this).hasClass("is-active")) {
            $(this).addClass("is-active");
            $(".editor-main-container footer").addClass("active");
            $(".editor-main-container footer .content .num-of-question").fadeIn(300);
            $(".questions-main-container .content-container").removeClass("active");
        }
        else {
            $(this).removeClass("is-active");
            $(".editor-main-container footer").removeClass("active");
            $(".editor-main-container footer .content .num-of-question").fadeOut(300);
            $(".questions-main-container .content-container").css("height", "calc(100%-90px)");
            $(".questions-main-container .content-container").addClass("active");
        }
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".editor-main-menu-container .nav a", function () {
        var conID = $(this).attr("id");
        $(this).siblings().removeClass("active");
        switch (conID) {
            case "Page_menu":
                $(this).addClass("active");
                $("#page-content").fadeIn();
                $("#action-content").fadeOut();
                $(".droppable").addClass("active");
                $(".tooltip,.tutorial-icon").removeAttr("data-balloon-visible", "");
                $(".tooltip").removeClass("data-balloon-visible");
                $(".tutorial-icon").removeClass("move");
                setTimeout(function () {
                    $(".tooltip,.tutorial-icon").removeAttr("data-balloon-visible", "");
                    $(".tooltip").removeClass("data-balloon-visible");
                    $(".tutorial-icon").removeClass("move");
                },2000);
                break;
            case "feedback_menu":
                $(this).addClass("active");
                $("#action-content").fadeIn();
                $("#page-content").fadeOut();
                $(".droppable").removeClass("active");
                $(".tooltip,.tutorial-icon").removeAttr("data-balloon-visible", "");
                $(".tooltip").removeClass("data-balloon-visible");
                $(".tutorial-icon").removeClass("move");
                setTimeout(function () {
                    $(".tooltip,.tutorial-icon").removeAttr("data-balloon-visible", "");
                    $(".tooltip").removeClass("data-balloon-visible");
                    $(".tutorial-icon").removeClass("move");
                },2000);
                break;
        }
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).click(function (e) {
        if (typeof $(e.target).closest(".noclose")[0] == "undefined") {
            $("#page-content").fadeOut();
            $("#action-content").fadeOut();
            $(".editor-main-menu-container .nav a").removeClass("active");
            $(".droppable").removeClass("active");
        }
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".editor-main-container footer .content .rectangle-items-container #slider ul li label i.delete", function () {
        showdeletemessage();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(".popup-delete-container .delete-container a").click(function () {
        hidedeletemessage();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(".popup-questiontype-container .questiontype-container .items-container .item-container").click(function () {
        $(this).addClass("active").siblings().removeClass("active");
        window.selectedtype = $(this).attr("qtype");
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".questions-main-container .question-answer-container .answer .click-map .edit-image", function () {
        $(".popup-edit-image-container.clickmap-1").fadeIn();
        $(".popup-edit-image-container.clickmap-1 .edit-image-container").removeClass("slideOutUp").addClass("animated slideInDown").fadeIn();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(".popup-questiontype-container .questiontype-container .items-container .btn-save-container").click(function () {
        hideeditpopup();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(".popup-questiontype-container .questiontype-container .close").click(function () {
        hideeditpopup();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(".editor-main-container .options-icons .settings").click(function () {
        showsettingpopup();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(".popup-settings-container .settings-container .close").click(function () {
        hidesettingpopup();
    });
    /////////////////////////////////*******************************///////////////////////////////
    //$(".popup-settings-container .settings-container .btn-save-container .save").click(function () {
    //    hidesettingpopup();
    //});
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".questions-main-container .question-answer-container .answer .multible-choises li .action-hover i.edit", function () {
        $(this).parent().siblings("label").children("div").fadeOut();
        $(this).parent().siblings("label").children("textarea").fadeIn();
        $(this).parent().siblings("label").children("textarea").html($(this).parent().siblings("label").children("div").children("span").html());
        $(this).hide();
        $(this).siblings().show();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".questions-main-container .question-answer-container .answer .multible-choises li .action-hover i.save", function () {
        $(this).parent().siblings("label").children("div").fadeIn();
        $(this).parent().siblings("label").children("textarea").fadeOut();
        $(this).parent().siblings("label").children("div").html($(this).parent().siblings("label").children("textarea").val());
        $(this).hide();
        $(this).siblings().show();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(".questions-main-container .question-answer-container .answer .multible-choises li .action-hover i.delete").click(function () {
        $(this).parent().parent("li").remove();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".questions-main-container .question-answer-container .answer .sequence li .action-hover i.edit", function () {
        $(this).parent().siblings("span").fadeOut();
        $(this).parent().siblings("textarea").fadeIn();
        $(this).parent().siblings("textarea").html($(this).parent().siblings("span").html());
        $(this).hide();
        $(this).siblings().show();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".questions-main-container .question-answer-container .answer .sequence li .action-hover i.save", function () {
        $(this).parent().siblings("span").fadeIn();
        $(this).parent().siblings("textarea").fadeOut();
        $(this).parent().siblings("span").html($(this).parent().siblings("textarea").val());
        $(this).hide();
        $(this).siblings().show();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(".questions-main-container .question-answer-container .answer .sequence li .action-hover i.delete").click(function () {
        $(this).parent().parent("li").remove();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".questions-main-container .question-answer-container .answer .fill-in-the-blank .box-text .action-hover i.edit", function () {
        $(this).parent().siblings("span").hide();
        $(this).parent().siblings("input[type='text']").show();
        $(this).parent().siblings("input[type='text']").html($(this).parent().siblings("span").html());
        $(this).hide();
        $(this).siblings().show();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".questions-main-container .question-answer-container .answer .fill-in-the-blank .box-text .action-hover i.save", function () {
        $(this).parent().siblings("span").show();
        $(this).parent().siblings("input[type='text']").hide();
        $(this).parent().siblings("span").html($(this).parent().siblings("input[type='text']").val());
        $(this).hide();
        $(this).siblings().show();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(".questions-main-container .question-answer-container .answer .fill-in-the-blank .box-text .action-hover i.delete").click(function () {
        $(this).parent().parent().remove();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".questions-main-container .question-answer-container .answer .word-bank li .action-hover i.edit", function () {
        $(this).parent().siblings("a").hide();
        $(this).parent().siblings("label").children("textarea").show();
        $(this).parent().siblings("label").children("textarea").html($(this).parent().siblings("label").children("div").html());
        $(this).hide();
        $(this).siblings().show();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".questions-main-container .question-answer-container .answer .word-bank li .action-hover i.save", function () {
        $(this).parent().siblings("a").show();
        $(this).parent().siblings("label").children("textarea").hide();
        $(this).parent().siblings("label").children("div").html($(this).parent().siblings("label").children("textarea").val());
        $(this).hide();
        $(this).siblings().show();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(".questions-main-container .question-answer-container .answer .word-bank li .action-hover i.delete").click(function () {
        $(this).parent().parent().remove();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".questions-main-container .question-answer-container .answer .multiple-response .action-hover i.edit", function () {
        $(this).parent().siblings("label.option-text").hide();
        $(this).parent().siblings("textarea").show();
        $(this).parent().siblings("textarea").html($(this).parent().siblings("label.option-text").children("div").children("label").html());
        $(this).hide();
        $(this).siblings().show();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".questions-main-container .question-answer-container .answer .multiple-response .action-hover i.save", function () {
        $(this).parent().siblings("label.option-text").show();
        $(this).parent().siblings("textarea").hide();
        $(this).parent().siblings("label.option-text").children("div").html($(this).parent().siblings("textarea").val());
        $(this).hide();
        $(this).siblings().show();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(".questions-main-container .question-answer-container .answer .multiple-response .action-hover i.delete").click(function () {
        $(this).parent().parent().remove();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".questions-main-container .edit_widget[widget_type='video']", function () {
        window.widgetID = $(this).closest(".element").attr("id");
        $(".popup-edit-video-container").fadeIn();
        $(".popup-edit-video-container .edit-video-container").removeClass("slideOutUp").addClass("animated slideInDown").fadeIn();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".questions-main-container .edit_widget[widget_type='audio']", function () {
        window.widgetID = $(this).closest(".element").attr("id");
        $(".popup-edit-sound-container").fadeIn();
        $(".popup-edit-sound-container .edit-sound-container").removeClass("slideOutUp").addClass("animated slideInDown").fadeIn();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".questions-main-container .edit_widget[widget_type='image']", function () {
        window.widgetID = $(this).closest(".element").attr("id");
        $(".popup-edit-image-container.itemA").fadeIn();
        $(".popup-edit-image-container.itemA .edit-image-container").removeClass("slideOutUp").addClass("animated slideInDown").fadeIn();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".edit_sound", function () {
        window.widgetID = $(this).closest(".element").attr("id");
        $(".popup-edit-image-container.itemB").fadeIn();
        $(".popup-edit-image-container.itemB .edit-image-container").removeClass("slideOutUp").addClass("animated slideInDown").fadeIn();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".popup-edit-video-container .edit-video-container .close", function () {
        $(".popup-edit-video-container").fadeOut();
        $(".popup-edit-video-container .edit-video-container").removeClass("slideInDown").addClass("slideOutUp").fadeOut();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".popup-edit-sound-container .edit-sound-container .close", function () {
        $(".popup-edit-sound-container").fadeOut();
        $(".popup-edit-sound-container .edit-sound-container").removeClass("slideInDown").addClass("slideOutUp").fadeOut();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("click", ".popup-edit-image-container .edit-image-container .close", function () {
        $(".popup-edit-image-container").fadeOut();
        $(".popup-edit-image-container .edit-image-container").removeClass("slideInDown").addClass("slideOutUp").fadeOut();
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("change", "input[type=file]", function () {
        conID = $(this).attr("id");
        $("#lbl" + conID).html($("#" + conID).val());
    });
    /////////////////////////////////*******************************///////////////////////////////
    $(document).on("change", "select", function () {
        conID = $(this).attr("id");
        $("#lbl" + conID).html($("#" + conID + " option:selected").text());
    });

    $(document).on("click", ".asound", function () {
        if($("#"+$(this).attr("asound"))[0].paused){
            $("#"+$(this).attr("asound"))[0].play();
        }else{
            $("#"+$(this).attr("asound"))[0].pause();
            $("#"+$(this).attr("asound"))[0].currentTime = 0;
        }

    });


});



/////////////////////////////////*******************************///////////////////////////////
function showdeletemessage() {
    $(".popup-delete-container").fadeIn();
    $(".popup-delete-container .delete-container").removeClass("slideOutUp").addClass("animated slideInDown").fadeIn();
}
/////////////////////////////////*******************************///////////////////////////////
function hidedeletemessage() {
    $(".popup-delete-container").fadeOut();
    $(".popup-delete-container .delete-container").removeClass("slideInDown").addClass("slideOutUp").fadeOut();
}
/////////////////////////////////*******************************///////////////////////////////
function showeditpopup() {
    $(".popup-questiontype-container").fadeIn();
    $(".popup-questiontype-container .questiontype-container").removeClass("slideOutUp").addClass("animated slideInDown").fadeIn();
}
/////////////////////////////////*******************************///////////////////////////////
function hideeditpopup() {
    $(".popup-questiontype-container").fadeOut();
    $(".popup-questiontype-container .questiontype-container").removeClass("slideInDown").addClass("slideOutUp").fadeOut();
}
/////////////////////////////////*******************************///////////////////////////////
function showsettingpopup() {
    $(".popup-settings-container").fadeIn();
    $(".popup-settings-container .settings-container").removeClass("slideOutUp").addClass("animated slideInDown").fadeIn();
}
/////////////////////////////////*******************************///////////////////////////////
function hidesettingpopup() {
    $(".popup-settings-container").fadeOut();
    $(".popup-settings-container .settings-container").removeClass("slideInDown").addClass("slideOutUp").fadeOut();
}

/////////////////////////////////*******************************///////////////////////////////