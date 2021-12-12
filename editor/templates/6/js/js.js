/**
 * Created by osaid zalloum on 13/09/2020.
 */
var correct=0;
var incorrect=0;
var allCorrect=0;
var questionNum=0;
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
            {type:'audio',url:'sounds/error.mp3'},{type:'audio',url:'sounds/good.mp3'},
            {type:'audio',url:'sounds/click.mp3'},{type:'audio',url:'sounds/reset.mp3'},
            // {type: 'image', url: 'images/cel.svg'}
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
        drawList()
        drawItem(questionNum);


    });

    $(".reload").click(function () {
        $(".main-message-container").fadeOut();
        correct=0;
        incorrect=0;
        allCorrect=0;
        questionNum=0;
        drawList();
        drawItem(questionNum);
        $(".main-game-container").html("");
        $(".question-item").removeClass("true-question");
        $(".question-item").removeClass("false-question");
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
/*================================================================*/

function selectItem(obj) {
    $(".drag-item").css("pointer-events","none");
    if($(obj).find("span").attr("data")==1){
        correct++;
        $(obj).addClass("correct");
        $(obj).find(".correct-Icon").show();
        if(questionNum==(shuffleList2.length-1)){
            $(".question-item.item-"+(questionNum+1)).addClass("true-question");
            var per=Math.round((correct/(correct + incorrect)) * (100/1));
            //scorm
            SetTimerScorm=null;
            Result='unknown';
            $("#feedback").attr("class","");
            $("#message-icone").attr("class","");
            $(".result-container span").html("%"+per);
            if(per<=100 && per>=80){
                $("#feedback").addClass("wellDonw");
                $("#message-icone").addClass("wellDonw-icon");
                Result='passed';
                soundEffect("sounds/good.mp3","","");
            }else if (per<=79 && per>=50) {
                $("#feedback").addClass("good");
                $("#message-icone").addClass("good-icon");
                Result='passed';
                soundEffect("sounds/good.mp3","","");
            }else {
                $("#feedback").addClass("tryAgain");
                $("#message-icone").addClass("tryAgain-icon");
                Result='failed';
                soundEffect("sounds/error.mp3","","");
            }
            setTimeout(function () {
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
        }else {
            $(".question-item.item-"+(questionNum+1)).addClass("true-question");
            questionNum++;
            soundEffect("sounds/correct.mp3","","");
            setTimeout(function () {
                drawItem(questionNum);
            },2000)
        }
    }else {
        incorrect++;
        $(obj).addClass("wrong");
        $(obj).find(".wrong-Icon").show();
        if(questionNum==(itemList.length-1)){
            $(".question-item.item-"+(questionNum+1)).addClass("false-question");
            var per=Math.round((correct/(correct + incorrect)) * (100/1));
            //scorm
            SetTimerScorm=null;
            Result='unknown';
            $("#feedback").attr("class","");
            $("#message-icone").attr("class","");
            $(".result-container span").html("%"+per);
            if(per<=100 && per>=80){
                $("#feedback").addClass("wellDonw");
                $("#message-icone").addClass("wellDonw-icon");
                Result='passed';
                soundEffect("sounds/good.mp3","","");
            }else if (per<=79 && per>=50) {
                $("#feedback").addClass("good");
                $("#message-icone").addClass("good-icon");
                Result='passed';
                soundEffect("sounds/good.mp3","","");
            }else {
                $("#feedback").addClass("tryAgain");
                $("#message-icone").addClass("tryAgain-icon");
                Result='failed';
                soundEffect("sounds/error.mp3","","");
            }
            setTimeout(function () {
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
        }else {
            $(".question-item.item-"+(questionNum+1)).addClass("false-question");
            questionNum++;

            soundEffect("sounds/error.mp3","","");
            setTimeout(function () {
                drawItem(questionNum);
            },2000)
        }
    }
}

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
    $(".SoundEffect2").prop("volume", 1);
}

function shuffleDivs(i) {
    var parent = $(i);
    var divs = parent.children();
    while (divs.length) {
        parent.append(divs.splice(Math.floor(Math.random() * divs.length), 1)[0]);
    }
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
