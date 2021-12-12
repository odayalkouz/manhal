var per=0;

var incorrect=0;
var correct=0;
var word='';

$(window).resize(function () {
    resizeGame();
});
$(document).ready(function(){
    console.log(game);
//scorm
    GetAPI(window);
    if(API!=null){
        if(API.Initialize("")){
            LMSStatus=true;
            API.SetValue("cmi.score.min",0);//to set min score in the game
            API.SetValue("cmi.score.max",100);//to set max score in the game
        }
    }
    drowelement();
    SetTimerScorm=setInterval(function(){TimeScorm++ }, 1000);
    $('body').manhalLoader({
        splashID: "#jSplash",
        splashVPos: '50%',
        loaderVPos: '83%',
        addFiles: [
            {type: 'image', url: "../../../games/"+config.id+"/images/left.jpg"},
            {type: 'image', url: "../../../games/"+config.id+"/images/right.jpg"},
            {type: 'image', url: "../../../games/"+config.id+"/images/good.jpg"},
            {type: 'image', url: "../../../games/"+config.id+"/images/good1.jpg"}
        ],
        splashFunction: function () {
            console.log('viewerType=',typeof viewerType)
            if(typeof (parent.bookid)=="undefined"){
                resizeGame();
                timerStart({min: 1, sec: 0}, true);
                background.Play();
                background.soundvolume(0.2);
            }else if( typeof viewerType  != 'undefined' && viewerType!=undefined && viewerType==true){
                $(".header-container").hide();
                $(".footer").hide();
                $(".stars-container").css({"background":"none","bottom":"1%","height":"5.9%"});
                $(".game-container").css({"background":"none"});
                $(".bstar").css({"width":"2.958%","height":"76.32%","margin":"0.782% 0.655% 0 0"});
                $(".center-container").css({"width":"96%","height":"90%","top":"3%"});
                $(".image-container").css({"border":"3px solid rgba(3,90,124)","border-radius":"0","box-shadow":"none","width":"100%","height":"48%","margin-bottom":"2%"});
                $(".powerdBy").css({"width":"6.38%","height":"2.377%","bottom":"3.042%","right":"auto"});
            }else {
                $(".header-container").hide();
                $(".footer").hide();
                $(".stars-container").css({"background":"none","bottom":"1%","height":"5.9%"});
                $(".game-container").css({"background":"none"});
                $(".bstar").css({"width":"2.958%","height":"76.32%","margin":"0.782% 0.655% 0 0"});
                $(".center-container").css({"width":"96%","height":"90%","top":"3%"});
                $(".image-container").css({"border":"3px solid rgba(3,90,124)","border-radius":"0","box-shadow":"none","width":"48.1%","height":"100%"});
                $(".powerdBy").css({"width":"6.38%","height":"2.377%","bottom":"3.042%","right":"auto"});
            }
            $('<div class="manhal-main-loader"><div class="loader-effect"><div class="checkmark draw"></div>' +
                '</div><div class="logo-loader"></div></div>').appendTo('#manhalpreOverlay');

        },
        onLoading: function (per) {

        },
    }, function () {
        $("#manhalpreOverlay").fadeOut(0);
        $(".image-container img").addClass("zoomInDown");
    });

    $(".reload-btn-message").click(function () {
        $(".message-main-container-feedBack").fadeOut();
        $(".message-main-container-timeOut").fadeOut();
        reset();
        timerStart({min: 1, sec: 0}, true);
    });
    $(".reload-btn").click(function () {
        reset();
        timerStart({min: 1, sec: 0}, true);
    });
    $(".sound-btn").click(function () {
        if ($(this).find("i").hasClass('sound-off')) {
            background.Play();
            $(this).find("i").removeClass("sound-off");

        } else {
            $(this).find("i").addClass("sound-off");
            background.Stop();
        }
    });
});
var count = 0;
var total=game[0].length;
var goodsound=new manhalsound('sound/good.mp3');
var wrongsound=new manhalsound('sound/wrong.mp3');
var disable=new manhalsound('sound/disable.mp3');
var winsound=new manhalsound('sound/win.mp3');
var resetsound=new manhalsound('sound/reset.mp3');
var timesound=new manhalsound('sound/error.mp3');
var background=new manhalsound('sound/sort.mp3',true);

//<summary>
// A function that drow elment area difirence
// </smmary>
function drowelement(){
    var data1=$(".imag1").html();
    var data2=$(".imag2").html();
    var data3='';
    for(var i=0;i<game[0].length;i++){
        style1=";left:"+game[0][i].left+"%;top:"+game[0][i].top+"%";
        style2=";width:"+game[0][i].width+"%;height:"+game[0][i].height+"%;";
        data1+='<div class="area ar'+i+'" style="'+style1+style2+'" onclick="diff('+i+');"></div>';
        data2+='<img class="good" id="good_'+i+'" style="'+style1+'" src=""/>';
        data2+='<div class="area ar'+i+'" style="'+style1+style2+'" onclick="diff('+i+');"></div>';
        data3+='<div id="star_'+i+'"  class="bstar"></div>';
    }
$(".imag1").html(data1);
$(".imag2").html(data2);
    if (signImg==false){
        $(".good").attr("src","img/good1.svg");
    }else {
        $(".good").attr("src","img/good.svg");
    }
$(".stars-container").html(data3);

}
function diff(id) {
    if ($("#good_" + id).attr('corr') != 'yes') {
        $("#good_" + id).show().addClass('flip').addClass('animated');
        $("#good_" + id).attr('corr', 'yes');
            $("#star_" + count).removeClass('bstar').addClass('fstar').addClass('rotateIn').addClass('animated');
            console.log(count,total)
        count++;
        correct++;
        goodsound.Play();
        if(count==total){
            winsound.Play();
            per=Math.round((correct/(correct + incorrect)) * (100/1));
            console.log("per"+per)
            //scorm
            clearInterval(SetTimerScorm);
            SetTimerScorm=null;
            var Result='unknown';

            if(typeof (parent.bookid)=="undefined"){
                normalMessag();
            }else{
                BookMessage();
            }
            if(LMSStatus){

                API.SetValue("cmi.score.raw",per.toFixed(2));//return text true or false | to set student mark
                API.SetValue("cmi.completion_status","completed");//when complete game
                API.SetValue("cmi.success_status",Result);//when complete game set value to one of ("passed","failed","unknown")
                API.SetValue("cmi.session_time",TimeScorm);//to set Amount of seconds that the learner has spent
                API.Commit("");//return text true or false | to save student mark to DB
            }
            TimeScorm=0;
        }

    }else{
        disable.Play();
        incorrect++;


    }

}
function normalMessag() {
    timerPause=false;
    puaseTimer();
    $(".message-main-container-feedBack").fadeIn();
    $(".image-container img").removeClass("zoomInDown");
}

function BookMessage() {
    window.parent.showBookMsg("أحسنت","<span style='display: block;font-size: 2vmin;'>نتيجتك هي</span ><span style='font-size: 2vmin;font-weight: bold;'>%"+per+"</span>",window.parent.$('iframe[src="'+window.location.href+'"]').closest(".element").attr("id"));
}
function replyGame(){
    SetTimerScorm=setInterval(function(){TimeScorm++ }, 1000);
    resetsound.Play();
    count=0;
    incorrect=0;
    correct=0;
    $(".good").hide();
    $(".good").attr('corr', 'no');
    $(".fstar").removeClass('fstar').addClass('bstar');
    $(".image-container img").removeClass("zoomInDown");
    setTimeout(function () {
        $(".image-container img").addClass("zoomInDown");
    },300)
}
function reset() {
    SetTimerScorm=setInterval(function(){TimeScorm++ }, 1000);
    resetsound.Play();
    count=0;
    incorrect=0;
    correct=0;
    $(".good").hide();
    $(".good").attr('corr', 'no');
    $(".fstar").removeClass('fstar').addClass('bstar');
    $(".image-container img").removeClass("zoomInDown");
    setTimeout(function () {
        $(".image-container img").addClass("zoomInDown");
    },300)

}
document.addEventListener('click',wrong);
function wrong(e){
var id=e.target.id;
    if(id=='imag1'||id=='imag2'){
        wrongsound.Play();
        incorrect++;
    }

}

function resizeGame() {
    var gameArea = document.getElementById('gameConainer');
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
    var gameCanvas = document.getElementById('inner-gameContainer');
    gameCanvas.style.width = newWidth + 'px';
    gameCanvas.style.height = newHeight + 'px';
}
