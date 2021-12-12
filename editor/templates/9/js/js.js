/**
 * Created by osaid zalloum on 13/12/2020.
 */
var correct = 0;
var incorrect = 0;
var drop1=0;
var drop2=0;
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
        loaderVPos: '90%',
        addFiles: [
            {type:'audio',url:'sounds/error.mp3'},{type:'audio',url:'sounds/good.mp3'},{type:'audio',url:'sounds/reset.mp3'},{type:'audio',url:'sounds/sort.mp3'},
            {type:'image',url:'images/good.svg'},{type:'image',url:'images/logo.svg'},{type:'image',url:'images/message-icon-good.svg'},{type:'image',url:'images/message-icon-tryAgain.svg'},
            {type:'image',url:'images/message-icon-wellDonw.svg'},{type:'image',url:'images/next2.svg'},{type:'image',url:'images/POWEREDBY.svg'},{type:'image',url:'images/reload.svg'},
            {type:'image',url:'images/result.svg'},{type:'image',url:'images/result-text.svg'},{type:'image',url:'images/tryAgain.svg'},{type:'image',url:'images/wellDonw.svg'},
            {type:'image',url:'images/qus.svg'},{type:'image',url:'images/word/01.svg'},{type:'image',url:'images/word/02.svg'},{type:'image',url:'images/word/03.svg'},
            {type:'image',url:'images/word/04.svg'},{type:'image',url:'images/word/05.svg'},{type:'image',url:'images/word/06.svg'},{type:'image',url:'images/word/07.svg'},
            {type:'image',url:'images/drag.svg'},{type:'image',url:'images/HEADER.svg'},{type:'image',url:'images/mark.svg'},{type:'image',url:'images/table.svg'},
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
        drawItem()
    });

    $('.reload').click(function () {
        incorrect=0;
        correct=0;
        // drawItem();
        $(".drop-item .mark").fadeIn();
        $(".drop-item .jq_cell").html("");
        $(".drag-item span").css({"opacity":"1","height":'auto',"pointer-events":'auto'});
        $(".main-message-container").fadeOut();
        shuffleDivs(".drag-container");

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
    $(document).on("mouseenter",".drag-item span",function(){
        $(this).draggable("option", "cursorAt", {top: $(this).height()/2, left: $(this).width()/2 });
    });
});
/*=============================================*/
function playSound(obj) {
    soundEffect($(obj).attr("sound"))
}

function drag() {
    $(".drag-item span").draggable({
        revert: true,
        drag: function (event, ui) {
            object = $(this);
            image = $(this).html();

        },
        start: function () {
            $(this).css('z-index', 10);
            // soundEffect($(this).parent().attr("sound"))
        },
        stop:function () {
            $(this).css({'z-index': 9,top:'50%'});
            object='';
        }
    });
    $(".drop-item").droppable({
      //  accept: '.drag-item span',
        drop: function (event, ui) {
            console.log('event=',event);
            console.log('ui=',ui);
            console.log('drop-container='+$(this).closest('.drop-container').attr("data") +' drag='+$(object).closest('.drag-item').attr("data"));
            if($(this).closest('.drop-container').attr("data") == $(object).closest('.drag-item').attr("data")){
                // if($(this).attr("data")=="1"){
                //     drop1++;
                    $(this).find("span").html(image);
                    $(this).find(".mark").fadeOut();
                // }else if($(this).attr("data")=="2"){
                //     drop2++;
                //     $(this).find(".drop-item:nth-child("+drop2+")").find("span").html(image);
                //     $(this).find(".drop-item:nth-child("+drop2+")").find(".mark").fadeOut();
                // }
                correct++;
                soundEffect("sounds/good.mp3","","");
                $(object).css({"opacity":"0.5","pointer-events":"none"});
                if(correct==allList.length){
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
                }
            }else {
                incorrect++;
                soundEffect("sounds/error.mp3","","");
            }
        }
    });
}

//////////////////////////////////////////
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

function shuffleDivs(c) {
    var parent = $(c);
    var divs = parent.children();
    while (divs.length) {
        parent.append(divs.splice(Math.floor(Math.random() * divs.length), 1)[0]);
    }
}

function bgSound() {
    bgMusic = new Howl({
        src: ['sounds/bgMusic.mp3'],
        autoplay: true,
        loop: true,
        volume: 1
    });
    playing = false;
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
