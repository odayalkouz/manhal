if (document.location.host != 'www.manhal.com') {
    //window.location.href='https://www.manhal.com/';
}
$(document).ready(function () {
    $(".sound-option").click(function () {
        $(this).toggleClass("selected")
    });
    $(".help-button").click(function () {
        $(".help-content").addClass("fadeInDown animated");
        $(".help-main-container").fadeToggle();
    });
    $(".play").click(function () {
        $(".play").fadeOut("fast");
        $("#manhalpreOverlay").fadeOut();
        $(".game-title").fadeOut();
        $(".game-title-image").fadeOut();
        $(".powerby-1").fadeOut();

	
	
	
	
	
	    drawColumn()
	    titleSound.Play()
    });
    $(".close").click(function () {
        $(".help-main-container").fadeToggle();
    });
    $(".button-animation").mouseover(function ()
    {
        $(this).addClass("animated tada");
    });
    $(".button-animation").mouseleave(function ()
    {
        $(this).removeClass("animated tada");
    });
    $('body').manhalLoader({
        splashID: "#jSplash",
        splashVPos: '50%',
        loaderVPos: '80%',
        addFiles: [],
        splashFunction: function ()
        {
            resizeGame();
            $('<div class="loder-bg">').appendTo('#manhalpreOverlay');
            
        },
        onLoading: function (per)
        {
        },
    }, function ()
    {
	   
    });
	
	
    $(".textQustion").html(game[0].titleText)
	
    // allobject_array = new Array();
    // object_match = new MatchingOOP('object_match', '1', 'col1A', 3, 'sound/question1.mp3');
    // allobject_array.push(object_match);
    // //fix width-height//
    // var conHeight = ($(window).height() - ($(".admin-login .popup-container .close-container").height() + 10));
    // $(".matching-content").height(conHeight);
    // $("#canvas1").attr("height", conHeight);
    // $("#image_A").css('background-image', 'url(images/A' + (Math.floor(Math.random() * 3) + 1) + '.svg)');
    // $("#image_B").css('background-image', 'url(images/B' + (Math.floor(Math.random() * 3) + 1) + '.svg)');
    // $("#image_C").css('background-image', 'url(images/C' + (Math.floor(Math.random() * 3) + 1) + '.svg)');
    resizeGame();
    if(game[0].noSound){
	 //   bgSound.Play()
    }
    setTimeout(function () {
        $(".game-title").addClass("slideInDown").fadeIn();
        setTimeout(function () {
            $(".game-title-image").addClass("swing").fadeIn();
            $(".play").removeClass("rotateIn");
        }, 1000);
    }, 500);
	
});



function checkAnswer(object) {
    mouseclick.Play();
    if ($('.imageCheckAnswer').length) $('.imageCheckAnswer').remove();
    if ($('.dot-class').length) $('.dot-class').attr("activ", 'false');
    count = 0
    for (var i = 0; i < object.linesArray.length; i++) {
        startPoint = $("#" + object.linesArray[i].indexStartBox).attr('attrindex');
        endPoint = $("#" + object.linesArray[i].indexEndtBox).attr('attrindex');
        coordinate = getCorrectpositionToCheckAnswer(object.linesArray[i].indexStartBox, object.linesArray[i].indexEndtBox);
        if (startPoint == endPoint)
        {
            $("#" + object.linesArray[i].indexStartBox).attr('checkedValue', 'yes');
            count++
        }
        else
        {
            $("#" + object.linesArray[i].indexStartBox).attr('checkedValue', 'no');
        }
    }
    if (count > 0 && count == object.linesArray.length)
    {
        if(langStory=="ar") {
            winMatching1.Play();
            winMatching2.Play();
        }else{
            winMatching2.Play();
        }
        setTimeout(function ()
        {
            $("#message-good").fadeIn();
            $(".message-content").addClass("fadeInLeft animated");
        },1500);
    } else
    {
        if(langStory=="ar") {
            errorMatching1.Play();
            errorMatching2.Play();
        }else
        {
            errorMatching2.Play();
        }

        setTimeout(function () {
            $("#message-faild").fadeIn();
            $(".message-content-a").addClass("fadeInRight animated");
        },1500);
    }
    addXToAllNoneAnswerd(object);
}




function questionreset(object) {
    $("#message-good").fadeOut();
    $("#message-faild").fadeOut();
    mouseclick.Play();
  
    if ($('.object_match-imageCheckAnswer').length) $('.object_match-imageCheckAnswer').remove();
    if ($('.object_match-dot').length) $('.object_match-dot').attr("activ", 'true');
    if ($('.object_match-dot').length) $('.object_match-dot').attr("checkedValue", 'no');
    object.linesArray = [];
    object.ctxCanvas.clearRect(0, 0, object.canvas.width, object.canvas.height);
  drawColumn()
  
  
}