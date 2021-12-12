/**
 * Created by osaid zalloum on 27/01/2021.
 */

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
        loaderVPos: '90%',
        addFiles: [
            {type:'audio',url:'sounds/error.mp3'},{type:'audio',url:'sounds/good.mp3'},{type:'audio',url:'sounds/reset.mp3'},{type:'audio',url:'sounds/sort.mp3'},
            {type:'image',url:'images/good.svg'},{type:'image',url:'images/logo.svg'},{type:'image',url:'images/message-icon-good.svg'},{type:'image',url:'images/message-icon-tryAgain.svg'},
            {type:'image',url:'images/message-icon-wellDonw.svg'},{type:'image',url:'images/next2.svg'},{type:'image',url:'images/POWEREDBY.svg'},{type:'image',url:'images/reload.svg'},
            {type:'image',url:'images/result.svg'},{type:'image',url:'images/result-text.svg'},{type:'image',url:'images/tryAgain.svg'},{type:'image',url:'images/wellDonw.svg'},
            {type:'image',url:'images/header.svg'},{type:'image',url:'images/help.svg'},{type:'image',url:'images/qusmark.svg'},{type:'image',url:'images/stage.svg'},{type:'image',url:'images/stage.svg'}
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
        drawItem(questionNum)
        // shuffleDivs(".drag-container")
    });

    $('.reload').click(function () {
        incorrect=0;
        correct=0;
        questionNum=0;
        $(".text-main-container").html("");
        drawList();
        drawItem(questionNum);
        $(".drop-item span").html("");
        $(".main-message-container").fadeOut();
        $(".question-item").removeClass("true-question");
        $(".question-item").removeClass("false-question");
    });
    // $(document).on("mouseenter",".clones",function(){
    //     $(this).draggable("option", "cursorAt", {top: $(this).height()/2, left: $(this).width()/2 });
    // });

    if($(".main-drag-container").find(".img-container").hasClass("show")){
        $(".text-container").css("width","65.238%");
    }else {
        $(".text-container").css("width","100%");
    }
});

/*=============================================*/
function playSound(obj) {
    soundEffect($(obj).attr("sound"))
}
function nextSceneClick() {
    $(".main-message-container_nextMessage").fadeOut();
    drawItem(questionNum);
}
function css(a) {
    var sheets = document.styleSheets, o = {};
    for (var i in sheets) {
        var rules = sheets[i].rules || sheets[i].cssRules;
        for (var r in rules) {
            if (a.is(rules[r].selectorText)) {
                o = $.extend(o, css2json(rules[r].style), css2json(a.attr('style')));
            }
        }
    }
    return o;
}

function css2json(css) {
    var s = {};
    if (!css) return s;
    if (css instanceof CSSStyleDeclaration) {
        for (var i in css) {
            if ((css[i]).toLowerCase) {
                s[(css[i]).toLowerCase()] = (css[css[i]]);
            }
        }
    } else if (typeof css == "string") {
        css = css.split("; ");
        for (var i in css) {
            var l = css[i].split(": ");
            s[l[0].toLowerCase()] = (l[1]);
        }
    }
    return s;
}
function drag() {
    $(".drag-item").draggable({
        revert: true,
        helper: function () {
            style = css($(this));
            var style1 = $(this).width();
            var style2 = $(this).height();
            console.log("style"+style1)
            //debugger;
            obj=$(this).find("span").html().replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>:,،\{\}\[\]\\\/]/gi, '');
            return $($(this).clone()).addClass("clones noSwipingClass").css({
                "width":style1+"px",
                "height":style2+"px",
                // "padding":"0 2%",
                // "position":"absolute"
                // "display":"block"
            }).appendTo(".inner-gameContainer");
        },
        // cursorAt: {
        //     top: $(".clones").height/2,
        //     left:$(".clones").width/2
        // },
        drag: function (event, ui) {
            object = $(this);
            image = $(this).find("span").css("background-image");

        },
        start: function (event, ui) {
            $(this).css({'z-index': 10});
            $(".clones span").html(obj);
            $(this).draggable('instance').offset.click = {
                left: Math.floor(ui.helper.width() / 2),
                top: Math.floor(ui.helper.height() / 2)
            };
            $(".drag-item").css("opacity","0.5")
        },
        stop:function () {
            $(this).css({'z-index': 9,});
            object='';
            $(".drag-item").css("opacity","1")
        }
    });
    $(".ans-box").droppable({
        accept: '.drag-item',
        drop: function (event, ui) {
            $(this).find(".qus-mark").fadeOut();
            $(this).find(".dot-container").fadeOut();
            $(this).find(".ans-text span").html(obj);
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
