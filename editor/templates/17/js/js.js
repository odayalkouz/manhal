/**
 * Created by osaid zalloum on 14/02/2021.
 */
var correct=0,allCorrect=0;
var incorrect=0;
var count=0;
var Stage=1;
var selct1="";
var selct2="";
var selectNum=0;
$(window).resize(function () {
    resizeGame();
});
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
    $('body').manhalLoader({

        splashID: "#jSplash",
        splashVPos: '50%',
        loaderVPos: '50%',
        addFiles: [
            {type:'audio',url:'sounds/error.mp3'},{type:'audio',url:'sounds/good.mp3'},{type:'audio',url:'sounds/click.mp3'},{type:'audio',url:'sounds/reset.mp3'},
            {type:'image',url:'images/good.svg'},{type:'image',url:'images/home.svg'},
            {type:'image',url:'images/message-icon-good.svg'},{type:'image',url:'images/message-icon-tryAgain.svg'},{type:'image',url:'images/message-icon-wellDonw.svg'},{type:'image',url:'images/next2.svg'},
            {type:'image',url:'images/poweredBy.svg'},
            {type:'image',url:'images/reload.svg'},
            {type:'image',url:'images/result.svg'},{type:'image',url:'images/result-text.svg'},
            {type:'image',url:'images/tryAgain.svg'},
            {type:'image',url:'images/wellDonw.svg'},
        ],
        splashFunction: function () {
            resizeGame();
            $('<div class="manhal-main-loader"><div class="loader-effect"><div class="checkmark draw"></div>' +
                '</div><div class="logo-loader"></div></div>').appendTo('#manhalpreOverlay');
        },
        onLoading: function (per) {

        },
    }, function () {
        $("#manhalpreOverlay").fadeOut(0);
        drawList();
        drawItem();
    });

    $(".reload").click(function () {
        $(".main-message-container").fadeOut();
        $(".stage-main-container").html("");
        $(".question-item").removeClass("true-question");
        drawList();
        drawItem();
        correct=0;
        incorrect=0;
        selct1="";
        selct2="";
        selectNum=0;
    });
    $(".help-icon").click(function () {
        $(".help-main-popup").fadeIn();
    });
    $(".close").click(function () {
        $(".help-main-popup").fadeOut();
    });
    $(document).click(function (e) {
        if ( !$(e.target).andSelf().is('.inner-help-popup') && !$(e.target).andSelf().is('.help-icon')){
            console.log("sasasas")
            $(".help-main-popup").fadeOut();
        }
    });
});

function choseCorrect(obj) {

    if(selectNum==0){
        selct1=$(obj).attr("data");
    }
    if(selectNum==1 && $(obj).hasClass("selected")){
        selct1="";
        selct2="";
        selectNum=0;
        $(obj).removeClass("selected").css({"border":"1px solid #4fb8c1","pointer-events":"auto"});
        $(obj).css("background","transparent");

    }else {
        selectNum++;
        soundEffect("sounds/click.mp3");
        $(obj).addClass("selected");
        $(obj).css({"border-width":"3px","border-color":$(obj).attr("bk")});
        $(obj).css("background",$(obj).attr("bk2"));
        $(obj).attr("click","1");
    }

    if(selectNum==2){
        // console.log("selectNum<<<<>>>>"+selectNum);
        selct2=$(obj).attr("data");
        if(selct1==selct2){
            $(".cardClick").each(function () {
                if($(this).hasClass("selected")){
                    $(this).css({"border-color":$(this).attr("bk2"),"border-width":"2px"});
                    $(this).css("pointer-events","none");
                    $(this).removeClass("selected");
                }
            })
            correct++;
            soundEffect("sounds/correct.mp3");
            selct1="";
            selct2="";
            selectNum=0;
            if(correct==loop){
                // scorm
                clearInterval(SetTimerScorm);
                SetTimerScorm=null;
                Result='unknown';
                var per=Math.round((correct/(correct + incorrect)) * (100/1));
                var soundName='';
                $("#feedback").attr("class","");
                $("#message-icone").attr("class","");
                $(".result-container span").html("%"+per);
                if(per<=100 && per>=80){
                    $("#feedback").addClass("wellDonw");
                    $("#message-icone").addClass("wellDonw-icon");
                    soundName="sounds/good.mp3"
                    Result='passed';
                }else if (per<=79 && per>=50) {
                    $("#feedback").addClass("good");
                    $("#message-icone").addClass("good-icon");
                    soundName="sounds/good.mp3"
                    Result='passed';
                }else {
                    $("#feedback").addClass("tryAgain");
                    $("#message-icone").addClass("tryAgain-icon");
                    soundName="sounds/wrong.mp3"
                    Result='failed';
                }
                setTimeout(function () {
                    soundEffect(soundName);
                    $(".main-message-container").fadeIn();
                },1000)
                if(LMSStatus){
                    API.SetValue("cmi.score.raw",per.toFixed(2));//return text true or false | to set student mark
                    API.SetValue("cmi.completion_status","completed");//when complete game
                    API.SetValue("cmi.success_status",Result);//when complete game set value to one of ("passed","failed","unknown")
                    API.SetValue("cmi.session_time",TimeScorm);//to set Amount of seconds that the learner has spent
                    API.Commit("");//return text true or false | to save student mark to DB
                }
                TimeScorm=0;
            }
        }else {
            soundEffect("sounds/error.mp3");
            incorrect++;
            selct1="";
            selct2="";
            selectNum=0;
            $(".cardClick").each(function () {
                if($(this).hasClass("selected")){
                    $(this).css({"border":"1px solid #4fb8c1","pointer-events":"auto"});
                    $(this).css("background","transparent");
                    $(this).removeClass("selected");
                }
            })
            // $(obj).css("background-image","url(images/normal.svg)");
            // $(".card").removeClass("selected");
        }
    }



}
/*================================================================*/
function resizeGame() {
    var gameArea = document.getElementById('main-container');
    var widthToHeight = 4 / 3;
    var newWidth = window.innerWidth;
    var newHeight = window.innerHeight;
    var newWidthToHeight = newWidth / newHeight;

    if (newWidthToHeight > widthToHeight) {
        newWidth = newHeight * widthToHeight;
        gameArea.style.height = newHeight + 'px';
        gameArea.style.width = newWidth + 'px';
    } else {
        newHeight = newWidth / widthToHeight;
        gameArea.style.width = newWidth + 'px';
        gameArea.style.height = newHeight + 'px';
    }
    var gameCanvas = document.getElementById('inner-container');
    gameCanvas.style.width = newWidth + 'px';
    gameCanvas.style.height = newHeight + 'px';
}
function soundEffect(src) {

    if ($('.SoundEffect').length)
        $('.SoundEffect').remove();
    // stopAll()
    $("<audio class='SoundEffect'></audio>").attr({
        'src': src,
        'autoplay': 'autoplay'
    }).appendTo("body");
    $(".SoundEffect").prop("loop", false);
    $(".SoundEffect").prop("volume", 1);
}
function soundEffect2(src) {

    if ($('.SoundEffect2').length)
        $('.SoundEffect2').remove();
    // stopAll()
    $("<audio class='SoundEffect2'></audio>").attr({
        'src': src,
        'autoplay': 'autoplay'
    }).appendTo("body");
    $(".SoundEffect2").prop("loop", false);
    $(".SoundEffect2").prop("volume", 0.7);
}

function shuffleDivs(i) {
    var parent = $(i);
    var divs = parent.children();
    while (divs.length) {
        parent.append(divs.splice(Math.floor(Math.random() * divs.length), 1)[0]);
    }
}
function BackgroundSound(src) {

    if ($('.BackgroundSound').length)
        $('.BackgroundSound').remove();
    // stopAll()

    $("<audio class='BackgroundSound' autoplay></audio>").attr({
        'src': src,
        'autoplay': 'autoplay'
    }).appendTo("body");

    $(".BackgroundSound").prop("loop", false);
    $(".BackgroundSound").prop("volume", 0.3);

    $('.BackgroundSound').on('ended', function () {
        $(this).trigger('play')
    })
}
function randomarray(Length) {
    var shuffle_Array = [];
    for ($x = 0; $x < Length; $x++) {
        shuffle_Array.push($x);
    }
    return shuffleArray(shuffle_Array);
}
function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
}
