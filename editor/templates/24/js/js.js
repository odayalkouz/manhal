/**
 * Created by osaid zalloum on 30/08/2020.
 */
var correct=0,allCorrect=0;
var incorrect=0;
var questionNum=0;
var count=0;
var Stage=1;

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
            {type:'image',url:'images/correct.svg'},{type:'image',url:'images/good.svg'},{type:'image',url:'images/home.svg'},
            {type:'image',url:'images/message-icon-good.svg'},{type:'image',url:'images/message-icon-tryAgain.svg'},{type:'image',url:'images/message-icon-wellDonw.svg'},{type:'image',url:'images/next2.svg'},
            {type:'image',url:'images/notdone.svg'},{type:'image',url:'images/poweredBy.svg'},
            {type:'image',url:'images/reload.svg'},
            {type:'image',url:'images/result.svg'},{type:'image',url:'images/result-text.svg'},
            {type:'image',url:'images/tryAgain.svg'},
            {type:'image',url:'images/wellDonw.svg'},
            {type:'image',url:'images/b1.svg'},
            {type:'image',url:'images/b2.svg'},
            {type:'image',url:'images/b3.svg'},
            {type:'image',url:'images/mainbubble.svg'},
            {type:'image',url:'images/obj.svg'},
            {type:'image',url:'images/qus.svg'},
            {type:'image',url:'images/bk.svg'},
            {type:'image',url:'images/word/word01/01.svg'},
            {type:'image',url:'images/word/word01/02.svg'},
            {type:'image',url:'images/word/word01/03.svg'},
            {type:'image',url:'images/word/word01/word.svg'},
            {type:'image',url:'images/word/word02/01.svg'},
            {type:'image',url:'images/word/word02/02.svg'},
            {type:'image',url:'images/word/word02/03.svg'},
            {type:'image',url:'images/word/word02/04.svg'},
            {type:'image',url:'images/word/word02/word.svg'},
            {type:'image',url:'images/word/word03/01.svg'},
            {type:'image',url:'images/word/word03/02.svg'},
            {type:'image',url:'images/word/word03/03.svg'},
            {type:'image',url:'images/word/word03/04.svg'},
            {type:'image',url:'images/word/word03/05.svg'},
            {type:'image',url:'images/word/word03/word.svg'},

            {type:'image',url:'images/wrong/word01/01.svg'},
            {type:'image',url:'images/wrong/word01/02.svg'},
            {type:'image',url:'images/wrong/word01/03.svg'},
            {type:'image',url:'images/wrong/word01/04.svg'},

            {type:'image',url:'images/wrong/word02/01.svg'},
            {type:'image',url:'images/wrong/word02/02.svg'},
            {type:'image',url:'images/wrong/word02/03.svg'},
            {type:'image',url:'images/wrong/word02/04.svg'},
            {type:'image',url:'images/wrong/word02/05.svg'},
            {type:'image',url:'images/wrong/word02/06.svg'},

            {type:'image',url:'images/wrong/word03/01.svg'},
            {type:'image',url:'images/wrong/word03/02.svg'},
            {type:'image',url:'images/wrong/word03/03.svg'},
            {type:'image',url:'images/wrong/word03/04.svg'},
            {type:'image',url:'images/wrong/word03/05.svg'},
            {type:'image',url:'images/wrong/word03/06.svg'},
        ],
        splashFunction: function () {
            resizeGame();
            $('<div class="manhal-main-loader"><div class="loader-effect"><div class="checkmark draw"></div>' +
                '</div><div class="logo-loader"></div></div>').appendTo('#manhalpreOverlay');
            $('#helpIframe').on('load', function() {
                console.log("saaaaaaaaa")
                let head = $("#helpIframe").contents().find("head");
                let css = '<style>body{margin:0;padding:0}</style>';
                $(head).append(css);
            });
        },
        onLoading: function (per) {

        },
    }, function () {
        $("#manhalpreOverlay").fadeOut(0);
        questionNum=0;
        drawList();
        drawItem(questionNum);
    });

    $(".reload").click(function () {
        $(".main-message-container").fadeOut();
        $(".stage-main-container").html("");
        $(".question-item").removeClass("true-question");
        questionNum=0;
        drawList();
        drawItem(questionNum);
        correct=0;
        incorrect=0;
        count=0;
        allCorrect=0;
    });
    $(".title-icon").click(function () {
        $(".help-main-popup").fadeIn();
    })
    $(".close").click(function () {
        $(".help-main-popup").fadeOut();
    })
    $(document).click(function (e) {
        if ( !$(e.target).andSelf().is('.inner-help-popup') && !$(e.target).andSelf().is('.title-icon')){
            console.log("sasasas")
            $(".help-main-popup").fadeOut();
        }
    });
});
function nextSceneClick(obj) {
    var data1=parseInt(obj);
    $(".main-message-container_nextMessage").fadeOut();
    $(".stage-container").fadeOut();
    correct=0;
    console.log("data1<<<>>>"+data1);
    setTimeout(function () {
        $(".stage-container").fadeOut();
        $("#stage-"+(data1+1)).fadeIn();
        console.log("data1+1<<<>>>"+(data1+1))
        setTimeout(function () {
            $("#stage-"+(data1+1)).removeClass("wheel-spin");
        },9500)
    },2000);

}
function choseCorrect(obj) {
    noOfQuestion=itemList.length;
    var data="";
    $(".drop-item").each(function () {
        if($(this).hasClass("selected")){
            data=$(this).find("span").attr("data");
        }
    })
    if($(obj).find("span").attr("data")==data){
        correct++;
        $(".drop-item.selected").find("span").css({'opacity': '1'});
        $(obj).css({'opacity': '0.5','pointer-events':'none'});
        soundEffect("sounds/correct.mp3");

        if(correct==($(".word-container").attr("data")-1)){
            questionNum++;
            $(".question-item.item-"+questionNum).addClass("true-question");
            allCorrect=allCorrect+correct;

            if(questionNum!=noOfQuestion){
                setTimeout(function () {
                    drawItem(questionNum);
                },2000)

            }
        }else {
            $(".drop-item").removeClass("selected");
            $(".drop-item:nth-child("+(correct+1)+")").css({'opacity': '1'});
            $(".drop-item:nth-child("+(correct+2)+")").addClass("selected");
        }
        if(questionNum==noOfQuestion){
            // scorm
            $(".question-item.item-"+questionNum).addClass("true-question");
            clearInterval(SetTimerScorm);
            SetTimerScorm=null;
            Result='unknown';
            var per=Math.round((allCorrect/(allCorrect + incorrect)) * (100/1));
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
            },2000)
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
