errorSound1 = new manhalsound('../all/sound/errorsound2.mp3');
errorSound2 = new manhalsound('../all/sound/errorsound.mp3');
mouseclick = new manhalsound('../all/sound/AppleKeyboard_S08TE.5.mp3');
mousedown_sound = new manhalsound('../all/sound/button.mp3');
mouseup_sound = new manhalsound('../all/sound/MultimediaAction_S011TE.275.mp3');
winMatching1 = new manhalsound('../all/sound/winSound.mp3');
winMatching2 = new manhalsound('../all/sound/winSound2.mp3');
errorMatching1 = new manhalsound('../all/sound/errorsound.mp3');
errorMatching2 = new manhalsound('../all/sound/errorsound2.mp3');
// bgSound=new manhalsound(config.root+"/sound/bg.mp3");
titleSound=new manhalsound(config.root+"/sound/title.mp3");
backgroundSounds=new manhalsound(config.root+"/sound/bg.mp3");

var incorrect=0;
$(document).ready(function () {
    //scorm
    GetAPI(window);
    if(API!=null){
        if(API.Initialize("")){
            LMSStatus=true;
            API.SetValue("cmi.score.min",0);//to set min score in the game
            API.SetValue("cmi.score.max",100);//to set max score in the game
        }
    }
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
        loaderVPos: '50%',
        addFiles: [],
        splashFunction: function ()
        {
            resizeGame();
            $('<div class="manhal-main-loader"><div class="loader-effect"><div class="checkmark draw"></div>' +
                '</div><div class="logo-loader"></div></div>').appendTo('#manhalpreOverlay');

        },
        onLoading: function (per)
        {
            if(per==100){
               setTimeout(function () {
                   drawColumn()
                   $("#manhalpreOverlay").fadeOut();
               },1000)

            }
        },
    }, function ()
    {

        $("#matching-content").show();
        $("#manhalpreOverlay").css({
            backgroundSize:"contain",
            // backgroundColor:"black"
        });
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
        //game[0].backgroundSound.Play()
        backgroundSounds.Play()
    }
    // setTimeout(function () {
    //     $(".game-title").addClass("slideInDown").fadeIn();
    //     setTimeout(function () {
    //         $(".game-title-image").addClass("swing").fadeIn();
    //         $(".play").removeClass("rotateIn");
    //     }, 1000);
    // }, 500);
    // $("#manhalpreOverlay").fadeOut();
    // $(".game-title").fadeOut();
    // $(".game-title-image").fadeOut();
    // $(".powerby-1").fadeOut();
    // drawColumn();
    // titleSound.Play();
	
});



function checkAnswer(object) {
    mouseclick.Play();
    if ($('.imageCheckAnswer').length) $('.imageCheckAnswer').remove();
    if ($('.dot-class').length) $('.dot-class').attr("activ", 'false');
    count = 0;
    incorrect=0;
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
            incorrect++;
            $("#" + object.linesArray[i].indexStartBox).attr('checkedValue', 'no');
        }
    }
    //scorm
    clearInterval(SetTimerScorm);
    SetTimerScorm = null;
    Result = 'unknown';
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

    console.log("incorrect"+incorrect)
    console.log("count"+count)
    console.log("per"+per)
    var per = Math.round((count / (count + incorrect)) * (100 / 1));
    if(per=="undefined"){
        per=0;
    }
    if (LMSStatus) {

        API.SetValue("cmi.score.raw", per.toFixed(2));//return text true or false | to set student mark
        API.SetValue("cmi.completion_status", "completed");//when complete game
        API.SetValue("cmi.success_status", Result);//when complete game set value to one of ("passed","failed","unknown")
        API.SetValue("cmi.session_time", TimeScorm);//to set Amount of seconds that the learner has spent

        API.Commit("");//return text true or false | to save student mark to DB
    }
    TimeScorm = 0;
    addXToAllNoneAnswerd(object);
}




function questionreset(object) {
    console.log(object)
    $(".buttons").css({"opacity":"0.5","pointer-events":"none"})
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