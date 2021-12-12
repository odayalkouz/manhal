var game = game[0],
    UploadType = "",
    ActiveElement = ""

qustionIndex = 0
var qustionSoundArray = [],
    ActiveClick = false,
    correctCounter = 0,
    correctCounterAnswer = 0,
    helpCounter = 0,
    losslevel = 0,
    autoConnect = false;
var countOfcorrectAnswer = 0;
var countCorrectAnswersByUser = 0;
var failAnswerCounter = 0;


var soundEffect = {
    connectline: "sound/connect.mp3",
    correct: "sound/correct.mp3",
    slide: "sound/slide.mp3",
    slideUp: "sound/slideUp.mp3",
    error: "sound/error.mp3",
    fadeOut: "sound/fadeOut.mp3",
    dotClick: "sound/dotClick.mp3",
    help: "sound/help.mp3",
    start: "sound/start.mp3",
}
function resizeGameInner(container, inner, aspectRatio) {

    gameArea = $(container)
    var widthToHeight = aspectRatio;
    var newWidth = gameArea.width();
    var newHeight = gameArea.height();
    var newWidthToHeight = newWidth / newHeight;
    if (newWidthToHeight > widthToHeight) {
        newWidth = newHeight * widthToHeight;
    } else {
        newHeight = newWidth / widthToHeight;

    }
    var gameCanvas = $(inner)
    gameCanvas.css({
        width: newWidth + "px",
        height: newHeight + "px"
    })


}

function resizeGame() {
    var gameArea = document.getElementById('main-container');
    var widthToHeight = 4 / 3;
    var newWidth = window.innerWidth;
    var newHeight = window.innerHeight;
    percentWidthToPixle = 0 //(newWidth * 10) / 100
    percentHeightToPixle = (newHeight * 10) / 100

    var newWidthToHeight = newWidth / newHeight;

    if (newWidthToHeight > widthToHeight) {
        newWidth = newHeight * widthToHeight;
        gameArea.style.height = (newHeight) + 'px';
        gameArea.style.width = (newWidth) + 'px';
    } else {
        newHeight = newWidth / widthToHeight;
        gameArea.style.width = (newWidth) + 'px';
        gameArea.style.height = (newHeight) + 'px';
    }

    //gameArea.style.marginTop = (-newHeight / 2) + 'px';
    //gameArea.style.marginLeft = (-newWidth / 2) + 'px';

    var gameCanvas = document.getElementById('canvas');
    gameCanvas.style.width = (newWidth - percentWidthToPixle ) + 'px';
    gameCanvas.style.height = (newHeight - percentHeightToPixle) + 'px';
    //autoSizeText


    resizeGameInner(".gameContentContainer", ".gameContent", (4 / 3), 1)
    autoSizeText()
}

var autoSizeText;

autoSizeText = function () {
    var el, elements, _i, _len, _results;
    elements = $('.resizeText');

    if (elements.length < 0) {
        return;
    }
    _results = [];
    for (_i = 0, _len = elements.length; _i < _len; _i++) {
        el = elements[_i];
        _results.push((function (el) {
            var resizeText, _results1;
            resizeText = function () {
                var elNewFontSize;
                elNewFontSize = (parseInt($(el).css('font-size').slice(0, -2)) - 1) + 'px';
                return $(el).css('font-size', elNewFontSize);
            };
            _results1 = [];
            while (el.scrollHeight > el.offsetHeight) {
                _results1.push(resizeText());
            }
            return _results1;
        })(el));
    }
    return _results;
};

var coords = [];
var canvasDrawing = ""
$(document).ready(function () {


    $('body').manhalLoader({
        splashID: "#jSplash",
        addFiles: [
            {type: "image", src: game.backgroundImage},
            {type: "audio", src: game.backgroundSound},
            {type: "audio", src: game.WinSound}
        ],
        splashFunction: function () {  //passing Splash Screen script to jPreLoader
            // resizeGame()


            // soundEffectBG("sound/bg.wav", true, 0.4)

        },
        onLoading: function (per) {


        },
    }, function () {

        //jPreLoader callback function
        $('#jSplash').children('section').not('.selected').hide();
        $('#jSplash').hide().fadeIn(800);
        $(".gameContainer").fadeIn()
    });

    // playSoundConnect(soundEffect.start)
    setTimeout(function () {
        $(".star").removeClass("animated")
        $(".star").removeClass("slideInLeft")
        $(".star").removeClass("slideInUp")
        $(".star").removeClass("slideInDwon")
        $(".star").removeClass("slideInRight")

    }, 1000)

    window.addEventListener("resize", resizeGame);
    canvasDrawing = document.getElementById("canvasDrawing")
    resizeGame();

    preloadimages(game.objects)

    if (game.option.ShowImage) {

        $(".gameContent").css(
            {
                'background-image': 'url(../ar/images/bg.png?' + Math.random() + ')',
                'background-size': '100% 100%',
                'background-repeat': 'no-repeat'


            })
    }

    $(".bgsound").prop('muted', true);
    bgNotFountd=false
    $(".muteIcon").click(function () {
        if ($(".bgsound").prop('muted') ||  bgNotFountd) {
            $(".bgsound").prop('muted', false);

            $(this).css({
                'background-image': 'url(../all/images/headset.svg?' + Math.random() + ')',
                'background-size': '100% 100%',
                'background-repeat': 'no-repeat'
            })
            bgNotFountd=false
        } else {
            $(".bgsound").prop('muted', true);

            $(this).css({
                'background-image': 'url(../all/images/mute.svg?' + Math.random() + ')',
                'background-size': '100% 100%',
                'background-repeat': 'no-repeat'
            })
            bgNotFountd=true
        }
    });

    $(".play-btn").click(function () {
        $(".instructions-container").hide();
        $(".game-container").fadeTo("slow", 1);
    })


    $(".lbl-qustion").html(game.titleText)
});

function DrawObjects() {

    length = game.objects.length;
    objects = game.objects

    {
        //id:"",
        //top:"",
        //left:"",
        //sound:"",
        //element:"",
        //text:"",
        //type:"image/sound/text",
        //animation:"",
        //click:"",
        //mouseup:"",
        // style:""

    }

    for (i = 0; i < length; i++) {
        game.objects[i].index = game.option.orderValue
        game.objects[i].id = "dot_container_" + game.option.orderValue
        coords.push([game.objects[i].left, game.objects[i].top])


        qustionSoundArray.push(
            {
                sound: game.objects[i].sound,
                id: game.objects[i].id,
                imageSrc: game.objects[i].src,
                text: game.objects[i].text,
                index: i,


            })
        pushNewObject(game.objects[i])

        game.option.orderValue++
    }
    shuffle(qustionSoundArray)

    if (game.option.visible) {
        $("#visiblePointes").prop("checked", true);

        $(".dot_container").css({
            background: "transparent",

        }).find('.dot').css({
            //width:"1px",
            //height:"1px"
        })
    }


    $('.dot_container').click(function () {


        if ($(this).hasClass('active')) { //check if active class has been added to the dot (note: can't move this into the .click event handler as it won't work there)
            if (!autoConnect) {
                playSoundConnect(soundEffect.dotClick)
                $(this).css("opacity", "0")
                $(this).css("pointer-events", "none")
            }
            var i = parseInt($(this).attr('order_value')); //its order in the dot series

            //take active class off current dot
            $(this).removeClass('active');

            //if it's the first dot, no line to draw, just make the next dot active
            if (i == 0) {
                $('div#dot_container_' + (i + 1)).addClass('active'); //make next dot active
                return false;
            }

            var parentPos = $("#dot_container_" + eval(i - 1)).parent().offset();
            //draw line from previous dot to this dot
            offset1 = $("#dot_container_" + eval(i - 1)).offset()
            offset2 = $("#dot_container_" + i).offset()

            width = $("#dot_container_" + eval(i - 1)).width() / 2

            x1 = (offset1.left + (width) - parentPos.left);
            y1 = offset1.top + (width) - parentPos.top;
            x2 = offset2.left + (width) - parentPos.left;
            y2 = offset2.top + (width) - parentPos.top;

            var m = (y2 - y1) / (x2 - x1); //slope of the segment
            var angle = (Math.atan(m)) * 180 / (Math.PI); //angle of the line
            var d = Math.sqrt(((x2 - x1) * (x2 - x1)) + ((y2 - y1) * (y2 - y1))); //length of the segment
            var transform;

            // the (css) transform angle depends on the direction of movement of the line
            if (x2 >= x1) {
                transform = (360 + angle) % 360;
            } else {
                transform = 180 + angle;
            }

            // add the (currently invisible) line to the page
            var id = 'line_' + new Date().getTime();
            var line = "<div id='" + id + "'class='line'>&nbsp;</div>";
            $('#canvas').append(line);

            //rotate the line
            $('#' + id).css({
                'left': x1,
                'top': y1,
                'width': '0px',
                'height': game.option.widthLine,
                'transform': 'rotate(' + transform + 'deg)',
                'transform-origin': '0px 0px',
                '-ms-transform': 'rotate(' + transform + 'deg)',
                '-ms-transform-origin': '0px 0px',
                '-moz-transform': 'rotate(' + transform + 'deg)',
                '-moz-transform-origin': '0px 0px',
                '-webkit-transform': 'rotate(' + transform + 'deg)',
                '-webkit-transform-origin': '0px 0px',
                '-o-transform': 'rotate(' + transform + 'deg)',
                '-o-transform-origin': '0px 0px',
                'background-color': game.option.colorLine
            });

            // 'draw' the line
            $('#' + id).animate({
                width: d,
            }, 1000, "linear", function () {


                //make the next dot active after the line is drawn
                if (i < coords.length)
                    $('div#dot_container_' + (i + 1)).addClass('active');
                backupI = i
                if (autoConnect) {

                    $('div#dot_container_' + (i + 1)).click()
                }
                var wrapper = $('.gameContent');
                line = $('#' + id)

                leftObject = parseInt($(line).css("left")) / (wrapper.width() / 100)
                topObject = parseInt($(line).css("top")) / (wrapper.height() / 100)
                widthObject = parseInt($(line).width()) / (wrapper.width() / 100)
                heightObject = parseInt($(line).css("height")) / (wrapper.height() / 100)


                $(line).css("left", leftObject + "%");
                $(line).css("top", topObject + "%");
                $(line).css("width", widthObject + "%");
                $(line).css("height", heightObject + "%");
                happy()
            });

            //if it's the last dot, reveal the image


            if (i == coords.length - 1) {

                if (autoConnect) {
                    setTimeout(function () {
                        if ($(".hintContainerWin").length) $(".hintContainerWin").remove()
                        str = '<div class="hintContainerWin ">' +
                            '<div class="hintWin sad animated bounce" >' +
                            '<label class="labelWin main-lbl" style="left: 21%;font-size: 3vw;" >لقد خسرت</label>' +
                            '<label class="labelWin sub-lbl" >حاول مرة أخرى</label>' +
                            '<div class="imgShapes sad animated shake"></div>' +
                            '<a class="relodeImg" onclick="again()"><i></i></a>' +
                            '</div>' +
                            '</div>'
                        $(str).appendTo("body")
                    }, 1000)
                    return;
                }

                if (game.option.drawing) {
                    revealImage();
                }
                else {
                    win()
                }


            }


        }
        else {
            Angry()
        }

    });

    $(".dot_container").hide();


}
function changeBackground(src) {

    if (game.option.ShowImage) {

        $(".gameContent").css(
            {
                'background-image': 'url(' + src + ')',
                'background-size': '100% 100%',
                'background-repeat': 'no-repeat'


            })
    }
}

function pushNewObject(object) {


    //rezie = ' <div class="ui-resizable-handle ui-resizable-nw corner" id="nwgrip"></div>' +
    //    ' <div class="ui-resizable-handle ui-resizable-ne corner" id="negrip"></div>' +
    //    '<div class="ui-resizable-handle ui-resizable-sw corner" id="swgrip"></div>' +
    //    '<div class="ui-resizable-handle ui-resizable-se corner" id="segrip"></div>'


    class_active = (object.index == 0) ? ' active' : '';

    if (game.option.LetterOrNumber) {
        TextValue = object.index
    } else {
        TextValue = object.text
    }
    str = '<div   name="' + object.name + '" text="' + object.text + '" class="elementResizable dot_container hvr-pulse ' + class_active + '"  order_value="' + object.index + '"  srcimage="' + object.src + '" id="' + object.id + '">' +
        //'<img class="allElem ' + animationCss[getRandomInt(0, animationCss.length - 1)] + '" src="' + object.src + '">' +
        '<div class="dot"></div>' +
        '<div class="dot_number">' + TextValue + '</div>' +
        //rezie +
        '</div>'
    $(str).appendTo('.gameContent')
        .css({
            width: game.option.widthCircle + "%",
            height: game.option.widthCircle + "%",
            top: object.top + "%",
            left: object.left + "%",
            position: 'absolute',
            'z-index': object.zIndex,
            opacity: object.opacity,
            color: game.option.textColor
        })

        .click(function () {
            // event.stopPropagation()

            // soundEffect("sound/click.mp3")

        })

    $(".dot_number").css({
        'font-size': game.option.fontSize + "vw"
    })
}


function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function playSoundbg(src) {
    // stopAll()

    $("<audio class='bgsound' loop></audio>").attr({
        'src': "sound/bg.mp3",


        'autoplay': 'autoplay'
    }).appendTo("body");
    $(".bgsound").prop("loop", true);

    $(".bgsound").prop("volume", $("#musicSound").val());


    //$('.media').on('ended', function() {
    //    if(!next)return
    //    $(".swiper-button-next").addClass('animated shake');
    //    nextPage()
    //});


    //$('.media').bind('pause', function () { //should trigger once on every pause event
    //
    //});


    $('.bgsound').on('ended', function () {

        $(this).trigger('play')
    })

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
    //  $(".SoundEffect").prop("volume", $("#musicSound").val());


}

animationCss = ["hvr-grow",
    "hvr-shrink",
    "hvr-pulse",
    "hvr-pulse-grow",
    "hvr-pulse-shrink",
    "hvr-push",
    "hvr-pop",
    "hvr-bounce-in",
    "hvr-bounce-out",
    "hvr-rotate",
    "hvr-grow-rotate",
    "hvr-float",
    "hvr-sink",
    "hvr-bob",
    "hvr-hang",
    "hvr-skew",
    "hvr-skew-forward",
    "hvr-skew-backward",
    "hvr-wobble-horizontal",
    "hvr-wobble-vertical",
    "hvr-wobble-to-bottom-right",
    "hvr-wobble-to-top-right",
    "hvr-wobble-top",
    "hvr-wobble-bottom",
    "hvr-wobble-skew",
    "hvr-buzz",

    "hvr-buzz-out",
    "hvr-buzz-out",]

function preloadimages(arr) {
    var newimages = [], loadedimages = 0
    var arr = (typeof arr != "object") ? [arr] : arr

    function imageloadpost() {
        loadedimages++
        if (loadedimages == arr.length) {
            //alert("All images have loaded (or died trying)!")
            $(".loader").fadeOut('slow')
            DrawObjects()
            if (game.option.noBackgrondSound) {
                playSoundbg("sound/bg.mp3");
            }


            //   changeBackground(game.backgroundImage)
            // timerStart({min: 5, sec: 0}, true)
            setTimeout(getQustion, 1000)

            setTimeout(function () {
                count = 0
                var setCounterShow = setInterval(function () {
                    if (count >= $(".dot_container").length) {
                        clearInterval(setCounterShow)
                        return
                    }
                    $("#dot_container_" + count).fadeIn("fast")
                    count++
                }, 100)
            }, 1000)

        }
    }

    for (var i = 0; i < arr.length; i++) {
        newimages[i] = new Image()
        newimages[i].src = arr[i]
        newimages[i].onload = function () {
            imageloadpost()
        }
        newimages[i].onerror = function () {
            imageloadpost()
        }
    }
}

function playSoundQustion(src, id, image, text) {


    if ($('.playSoundQustion').length)
        $('.playSoundQustion').remove();


    $("<audio  idAttr='" + id + "' image='" + image + "' text='" + text + "' class='playSoundQustion'></audio>").attr({
        'src': src,
        'autoplay': 'autoplay'
    }).appendTo("body");


}

function getQustion() {
    if (checkIfWin()) {
        // alert("you Win")
        win();
        return
    }
    if (checkIfFinish()) {
        tryAgain()
    }

    if (typeof qustionSoundArray[qustionIndex].sound == "undefined") {

    } else {


        playSoundQustion(
            qustionSoundArray[qustionIndex].sound,
            qustionSoundArray[qustionIndex].id,
            qustionSoundArray[qustionIndex].imageSrc,
            qustionSoundArray[qustionIndex].text
        );
        $("#help").attr('currentObject', qustionSoundArray[qustionIndex].id)
        qustionIndex++
    }

}


function listen() {
    $(".playSoundQustion").trigger('play')
}


//function checkAnswer(object) {
//    $('.allElem').css({
//        'pointer-events': 'none',
//
//    });
//    idImage = object.id;
//    idSound = $(".playSoundQustion").attr('idAttr');
//    text = $(".playSoundQustion").attr('text');
//    image = $(".playSoundQustion").attr('image');
//
//
//    if (idSound == idImage) {
//        correctCounterAnswer++;
//        correctCounter += 5;
//        alert('good,next qustion .')
//        $('.allElem').css({
//            'pointer-events': 'auto',
//
//        });
//        $('#score').html(correctCounter)
//        getQustion()
//    }
//    else {
//        if ($(".hintContainer").length)$(".hintContainer").remove()
//        str = '<div class="hintContainer"><div class="hint" >' +
//            '<img class="imgShapes" src="' + image + '">' +
//            '<h1>' + text + '</h1>' +
//            '<img class="closeImg" src="images/close.png" onclick="closeBox()">' +
//
//            '</div>' +
//            '</div>'
//
//        $(str).appendTo("body")
//    }
//
//
//}

function closeBox() {
    getQustion()
    $('.allElem').css({
        'pointer-events': 'auto',

    });
    if ($(".hintContainer").length) $(".hintContainer").remove()
    if ($(".hintContainerWin").length) $(".hintContainerWin").remove()
}
function closeBoxWin() {

    $('.allElem').css({
        'pointer-events': 'auto',

    });
    if ($(".hintContainer").length) $(".hintContainer").remove()
    if ($(".hintContainerWin").length) $(".hintContainerWin").remove()
}


function checkIfWin() {


    length = qustionSoundArray.length;


    return (correctCounterAnswer == length)
}

function checkIfFinish() {
    length = qustionSoundArray.length;


    return (qustionIndex >= length )
}

function win() {
    // accu = 100 - accuracy()
    accu = 100
    $(".bgsound").remove()
    // soundEffect("sound/win.mp3")

    soundSpeach("sound/good.mp3")
    $(".gameContent").css(
        {
            'background-image': 'url(images/bg.png)',
            'background-size': '100% 100%',
            'background-repeat': 'no-repeat'


        })
    setTimeout(function () {
        if ($(".hintContainerWin").length) $(".hintContainerWin").remove()
        str = '<div class="hintContainerWin"><div class="hintWin animated rotateIn" >' +
            '<label class="labelWin main-lbl" >أحسنت</label><br>' +
            '<label class="labelWin sub-lbl" >نسبة الدقة  في الاجابة % ' + accu + '</label>' +
            '<div class="imgShapes animated shake"></div>' +
            '<a class="relodeImg" onclick="again()"><i></i></a>' +

            '</div>' +

            '</div>'

        $(str).appendTo(".main-container")
    }, 1500)
}
function soundEffect(src) {

    if ($('.SoundEffect').length)
        $('.SoundEffect').remove();


    $("<audio class='SoundEffect'></audio>").attr({
        'src': src,
        'autoplay': 'autoplay'
    }).appendTo("body");

    $(".SoundEffect").prop("loop", false);
    //  $(".SoundEffect").prop("volume", $("#musicSound").val());


}

function soundSpeach(src) {

    if ($('.soundSpeach').length)
        $('.soundSpeach').remove();


    $("<audio class='soundSpeach'></audio>").attr({
        'src': src,
        'autoplay': 'autoplay'
    }).appendTo("body");

    $(".soundSpeach").prop("loop", false);


}

function tryAgain() {
    if ($(".hintContainerWin").length) $(".hintContainerWin").remove()
    str = '<div class="hintContainerWin"><div class="hintWin" >' +
        '<img class="imgShapes" src="images/tryagain.png">' +
        '<img class="relodeImg" src="images/relode.png" onclick="again()">' +

        '</div>' +
        '</div>'

    $(str).appendTo(".main-container")
}


function again() {
    location.reload()
}


function shuffle(array) {
    var currentIndex = array.length, temporaryValue, randomIndex;

    // While there remain elements to shuffle...
    while (0 !== currentIndex) {

        // Pick a remaining element...
        randomIndex = Math.floor(Math.random() * currentIndex);
        currentIndex -= 1;

        // And swap it with the current element.
        temporaryValue = array[currentIndex];
        array[currentIndex] = array[randomIndex];
        array[randomIndex] = temporaryValue;
    }

    return array;
}


function helpQustion() {

    id = $('#help').attr('currentObject')
    $('#' + id).addClass("animated flash");

    setTimeout(function () {
        $('#' + id).removeClass("animated flash");
    }, 1000);

    helpCounter++;

    if (helpCounter >= 3) {
        $('#help').css(
            {
                'pointer-events': 'none',
                opacity: .5
            })
        return
    }
}


function Angry() {

    if ($('.active').attr("order_value") == 0) {


    }
    playSoundConnect(soundEffect.error)
    // if ($(".face").length) {
    //     $(".face").remove()
    // }

    $('.gameContent').css(
        {
            'pointer-events': 'none',

        });
    failAnswerCounter++
    $("#scoreFail span").html(failAnswerCounter)

    setTimeout(function () {
        $(".face").remove()
        $("<img class='face animated shake' src='images/sad.svg'/>").appendTo(".face-container")

        setTimeout(function () {
            $(".face").remove()
            $("<img class='face animated fadeInUp' src='../all/images/logonormal.svg'/>").appendTo(".face-container")


            $('.gameContent').css(
                {
                    'pointer-events': 'auto',

                });
            losslevel++

            if (losslevel >= 4) {
                $("#tryCounter" + losslevel).addClass('animated zoomOutRight')
                autoConnect = true;

                // alert('you lose')

                if ($('.active').attr("order_value") == 0) {
                    $('.active').click()
                    $('.active').click()

                }
                else {
                    $('.active').click()
                }
                return
            }
        }, 3000)
        playSoundConnect(soundEffect.fadeOut)
        $("#tryCounter" + losslevel).addClass('bounceOut animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {
            // $(this).removeClass();
            //  $("#tryCounter" + losslevel).attr('src',"images/angryStar.png")
            $(this).hide("fast")
            $(this).removeClass('bounceOut').addClass('bounceIn animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function () {

            });
        });
    }, 300)


}


function happy() {
    if (autoConnect) {
        return
    }

    // if ($(".face").length) {
    //     $(".face").remove()
    // }

    playSoundConnect(soundEffect.slide)

    playSoundslideAnimiation(soundEffect.correct)
    countCorrectAnswersByUser++
    $("#score span").html(countCorrectAnswersByUser)
    setTimeout(function () {
        $(".face").remove();
        $("<img class='face animated flash' src='images/happy.svg'/>").appendTo(".face-container")

        setTimeout(function () {
            playSoundConnect(soundEffect.slideUp)
            $(".face").remove()
            $("<img class='face animated fadeInUp' src='../all/images/logonormal.svg'/>").appendTo(".face-container")
        }, 3000)
    }, 300)
}


var helpConnectCounter = 0,
    backupI = 0
function helpConnect(object) {
    playSoundConnect(soundEffect.help)
    $(object).css(
        {
            'pointer-events': 'none',

        });


    $(".active").click()


    helpConnectCounter++
    if (helpConnectCounter >= 3) {

        $(object).css(
            {
                'pointer-events': 'none',
                opacity: .5
            }).removeClass("hvr-bounce-in")
        return
    }
    else {

        setTimeout(function () {
            $(object).css(
                {
                    'pointer-events': 'auto',

                })
        }, 2000)

    }
}