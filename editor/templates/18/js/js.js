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
    $(".title-icon").click(function () {
        $(".help-main-popup").fadeIn();
    });
    $(".close").click(function () {
        $(".help-main-popup").fadeOut();
    });
    $(document).click(function (e) {
        if ( !$(e.target).andSelf().is('.inner-help-popup') && !$(e.target).andSelf().is('.title-icon')){
            console.log("sasasas")
            $(".help-main-popup").fadeOut();
        }
    });
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
            if($(this).attr("data")==obj){
                correct++;
                soundEffect("sounds/good.mp3","","");
                $(this).css("background-image","url("+$(this).attr("img")+")");
                $(object).css({"opacity":"0.5","pointer-events":"none"});
                $(this).find(".qus-mark").fadeOut();
                $(this).find(".dot-container").fadeOut();
                $(this).find(".ans-text span").html(obj);
                $(".drag-item").css("pointer-events","none");
                if(shuffleList2.length==correct){
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
                    setTimeout(function () {
                        drawItem(questionNum);
                    },2000)
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
