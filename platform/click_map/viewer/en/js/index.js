UploadType = "",
    ActiveElement = ""

qustionIndex = 0
var qustionSoundArray = [],
    ActiveClick = false,
    correctCounter = 0,
    correctCounterAnswer = 0,
    helpCounter = 0;
var countOfcorrectAnswer = 0;
var countCorrectAnswersByUser = 0;
var failAnswerCounter = 0;
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
    var gameArea = document.getElementById('gameContainer');
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

    var gameCanvas = document.getElementById('gameContent');
    gameCanvas.style.width = (newWidth - percentWidthToPixle ) + 'px';
    gameCanvas.style.height = (newHeight - percentHeightToPixle) + 'px';
    //autoSizeText


    resizeGameInner(".gameContentContainer", ".gameContent", (4 / 3), 1)
    autoSizeText()
}
function resizeGameHelp() {
    var gameArea = document.getElementById('help-main-container');
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

    // var gameCanvas = document.getElementById('gameContent');
    // gameCanvas.style.width = (newWidth - percentWidthToPixle ) + 'px';
    // gameCanvas.style.height = (newHeight - percentHeightToPixle) + 'px';
    //autoSizeText


    resizeGameInner("help-inner-container", "help-main-container", (4 / 3), 1)
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


tmpSrc = []
$(document).ready(function () {
    window.addEventListener("resize", resizeGameHelp);
    window.addEventListener("resize", resizeGame);

    //calling jPreLoader function with properties
    resizeGameHelp()


    $.getScript("js/game.js", function (data, textStatus, jqxhr) {


        $(".titleText").html(game[0].titleText)
        $(".textIcon").attr("src", "images/titleIcon.png?" + Math.random())

        if (game[0].noHelp) {
            $("#help").hide()
        }
        if (game[0].noSound || game[0].typeEdit == "correctChoose" || game[0].typeEdit == "justText") {
            $("#hear").hide()
        }

        for (var i = 0; i < game[0].objects.length; i++) {
            if (game[0].objects[i].src = "") {

            } else {


                tmpSrc.push({type: "image", url: game[0].objects[i].src})
            }
        }
        $('body').manhalLoader({
            splashID: "#jSplash",
            addFiles: tmpSrc,
            splashFunction: function () {  //passing Splash Screen script to jPreLoader
                // resizeGameHelp()
                resizeGame()

                // soundEffectBG("sound/bg.mp3", true, 0.4)

            },
            onLoading: function (per) {


            },
        }, function () {

            //jPreLoader callback function
            $('#jSplash').children('section').not('.selected').hide();
            $('#jSplash').hide().fadeIn(800);
            // $(".gameContainer").fadeIn()
            $(".playSoundQustion1").hide()
            setTimeout(function(){
                if (game[0].typeEdit == "withSound") {
                    $(".playSoundQustion1").show()
                    $(".playSoundQustion1").click()
                }
            },1000)
        });

        preloadimages(game[0].objects)
        noTriesME(game[0].noTries)
    });


    StartScorm()



    $(window).on("beforeunload", function () {
        alert("you leaving this page");

    });

    autoSizeText();
    $(".bgsound").prop('muted', true);
    $(".muteIcon").click(function () {
        if ($(".bgsound").prop('muted')) {
            $(".bgsound").prop('muted', false);
            $(this).css('background-image', 'url(images/mute.svg)'); // changing icon for button

        } else {
            $(".bgsound").prop('muted', true);
            $(this).css('background-image', 'url(images/sound.svg)');
        }
    });
    $(".play-btn").click(function () {

        $(".help-main-container").fadeOut()
        $(".gameContainer").fadeIn()

        resizeGame();
    })
});

function DrawObjects() {

    length = game[0].objects.length;
    objects = game[0].objects

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
        if (game[0].objects[i] == "removed") {

        }
        else {

            qustionSoundArray.push(
                {
                    sound: game[0].objects[i].sound,
                    id: game[0].objects[i].id,
                    imageSrc: game[0].objects[i].name,
                    text: game[0].objects[i].text,
                    index: i,


                })
            pushNewObject(game[0].objects[i])
        }


    }
    shuffle(qustionSoundArray)
}
function changeBackground(src) {


    $(".gameContent").css(
        {
            'background-image': 'url(' + src + ')',
            'background-size': '100% 100%',
            'background-repeat': 'no-repeat'


        })
}

function pushNewObject(object) {


    //rezie = ' <div class="ui-resizable-handle ui-resizable-nw corner" id="nwgrip"></div>' +
    //    ' <div class="ui-resizable-handle ui-resizable-ne corner" id="negrip"></div>' +
    //    '<div class="ui-resizable-handle ui-resizable-sw corner" id="swgrip"></div>' +
    //    '<div class="ui-resizable-handle ui-resizable-se corner" id="segrip"></div>'

    if (object.name != "") {
        src = "images/" + name
        strImage = '<img class="allElem ' + animationCss[getRandomInt(0, animationCss.length - 1)] + '" src="images/' + object.name + '">'
        classNAme = "containOmage"
    } else {
        strImage = ""
        classNAme = "notcontainOmage"

    }
    if (object.setAsTrue == "true" || object.setAsTrue) {
        countOfcorrectAnswer++
    }
    str = '<div onclick="checkAnswer(this)" flagTrueORfalse="' + object.setAsTrue + '" name="' + object.name + '" text="' + object.text + '" class="elementResizable"  srcimage="' + object.name + '" id="' + object.id + '">' +
        strImage +

        //rezie +
        '</div>'
    $(str).appendTo('.gameContent')
        .css({
            width: object.width + "%",
            height: object.height + "%",
            top: object.top + "%",
            left: object.left + "%",
            position: 'absolute',
            'z-index': object.zIndex,
            opacity: object.opacity
        })

        .click(function () {
            event.stopPropagation()

            //  soundEffect("sound/dotClick.mp3")

        })
    if (game[0].typeEdit == "correctChoose") {


        $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer)

    } else {
        $('#score span').html(countCorrectAnswersByUser + " / " + qustionSoundArray.length)

    }
}


function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function playSoundbg(src) {
    // stopAll()

    $("<audio class='bgsound' loop></audio>").attr({
        'src': src,


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
function soundEffectBG(src) {

    if ($('.bgsound').length)
        $('.bgsound').remove();
    // stopAll()

    $("<audio class='bgsound'></audio>").attr({
        'src': src,


        'autoplay': 'autoplay'
    }).appendTo("body");

    $(".bgsound").prop("loop", true);
    $(".bgsound").prop("volume", .8);


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
            //  playSoundbg("sound/bg.mp3")
            changeBackground(game[0].backgroundImage)

            setTimeout(gameType, 1000)
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


    if (game[0].typeEdit == "WithSound") {


        $("<audio  idAttr='" + id + "' image='" + image + "' text='" + text + "' class='playSoundQustion'></audio>").attr({
            'src': src,
            'autoplay': 'autoplay'
        }).appendTo("body");
    }

    if (game[0].typeEdit == "justText") {
        $(".titleText").html("")
        $("<span  " +
            "idAttr='" + id + "' " +
            "image='" + image + "' " +
            "text='" + text + "' " +
            "class=' playSoundQustion TextPlayQustion bounce animated'" +
            ">" +
            "" + text + "" +
            "</span>")
            .appendTo(".titleText");

    }


}


function getQustion() {
    if (checkIfWin()) {

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

    }

}


function listen() {
    $(".playSoundQustion").trigger('play')
}


function checkAnswer(object) {
    $('.allElem').css({
        'pointer-events': 'none',

    });
    idImage = object.id;
    idSound = $(".playSoundQustion").attr('idAttr');
    text = $(".playSoundQustion").attr('text');
    image = $(object).attr('name');
    flagCheck = $(object).attr('flagTrueORfalse');

    if (game[0].typeEdit == "WithSound" || game[0].typeEdit == "justText") {


        if (idSound == idImage) {
            qustionIndex++
            correctCounterAnswer++;
            correctCounter++;
            countCorrectAnswersByUser++
            correctAnswer()
            $(object).hide("fast")
            $('.allElem').css({
                'pointer-events': 'auto',

            });
            $('#score span').html(countCorrectAnswersByUser + " / " + qustionSoundArray.length)

            getQustion()


        }
        else {
            $(".star:last-child").remove()
            failAnswerCounter++
            scorm.failAnswers = scorm.failAnswers + 1
            $('#scoreFail span').html(failAnswerCounter)
            if ($(".star").length <= 0) {
                if ($(".hintContainerWin").length) $(".hintContainerWin").remove()
            }
            if ($(".hintContainer").length) $(".hintContainer").remove()
            str = '<div class="hintContainer"><div class="hint" >' +
                '<div class="line-top"></div>' +
                '<label class="checkAnswerLabel">The correct answer is :</label>' +
                '<div class="imgShapes-container">'+
                '<img src="images/' + qustionSoundArray[qustionIndex].imageSrc + '">' +
                '</div>' +
                '<label class="labelName">' + text + '</label>' +
                '<img class="imgShapes wrong" src="images/wrong-image.png">' +
                '<a class="closeImg" onclick="closeBox()"><i></i></a>' +

                '</div>' +
                '</div>'

            $(str).appendTo("body")

            if ($(".star").length <= 0) {
                attempNumbersCheck()
                return
            }
        }
    } else if (game[0].typeEdit == "correctChoose") {

        if (flagCheck == "true") {
            $(object).css({
                'pointer-events': 'none',

            });


            countCorrectAnswersByUser++
            $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer)

            var putCircle = new CircleAnimate(object);
            putCircle.animate()
            if (countCorrectAnswersByUser >= countOfcorrectAnswer) {

                win()
            } else {
                $(object).attr('flagTrueORfalse', "false");
                correctAnswer()
            }
        } else {
            failAnswerCounter++

            tryAgain()
        }

    }


}

function closeBox() {
    soundEffect("sound/fadeOut.mp3")
    if (game[0].typeEdit == "WithSound" || game[0].typeEdit == "justText") {
        getQustion()
    }

    else if (game[0].typeEdit == "correctChoose") {
    }

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
    accu = 100 - accuracy()
    $(".bgsound").remove()
    soundEffect("sound/win.mp3")

    soundSpeach("sound/good.mp3")
    if ($(".hintContainerWin").length) $(".hintContainerWin").remove()
    str = '<div class="hintContainerWin final"><div class="hintWin final animated rotateIn" >' +
        '<label class="labelWin" >You Win</label><br>' +
        '<label class="rate-container" > <span>' + accu + '%</span></label>' +
        '<img class="imgShapes" src="images/win.png">' +
        '<a class="relodeImg playAgain" onclick="again()"><i></i></a>' +

        '</div>' +

        '</div>'

    $(str).appendTo("body")
}

function correctAnswer() {

    soundEffect("sound/correct.mp3")
    soundSpeach("sound/goodA.mp3")
    scorm.correctAnswers = scorm.correctAnswers + 1
    if ($(".hintContainerWin").length) $(".hintContainerWin").remove()
    str = '<div class="hintContainerWin"><div class="hintWin animated bounce" >' +
        '<label class="labelWin" >Excellent lets go to play</label>' +
        '<img class="imgShapes animated tada" src="images/correct.png">' +
        '<a class="relodeImg" onclick="closeBox()"><i></i></a>' +

        '</div>' +

        '</div>'

    $(str).appendTo("body")


}

function tryAgain() {
    soundEffect("sound/error.mp3")
    soundSpeach("sound/trySpeach.mp3");
    $(".star:last-child").remove()
    if ($(".star").length <= 0) {
        attempNumbersCheck()
        return
    }
    scorm.failAnswers = scorm.failAnswers + 1
    $('#scoreFail span').html(failAnswerCounter)
    if ($(".hintContainerWin").length) $(".hintContainerWin").remove()
    str = '<div class="hintContainerWin ">' +
        '<div class="hintWin animated bounce" >' +
        '<label class="labelWin" >خطأ , حاول مرة أخرى</label>' +
        '<img class="imgShapes animated shake" src="images/lose.png">' +
        '<img class="relodeImg" src="images/continue.png" onclick="closeBox()">' +

        '</div>' +
        '</div>'

    $(str).appendTo("body")
}

function attempNumbersCheck() {
    if ($(".star").length <= 0) {
        if ($(".hintContainerWin").length) $(".hintContainerWin").remove()
        str = '<div class="hintContainerWin final">' +
            '<div class="hintWin final animated bounce" >' +
            '<label class="labelWin lose" >You Lose try again</label>' +
            '<img class="imgShapes animated shake" src="images/loser.png">' +
            '<a class="relodeImg playAgain" onclick="again()"><i></i></a>' +

            '</div>' +
            '</div>'

        $(str).appendTo("body")

        return
    }
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
    soundEffect("sound/help.mp3")
    id = $('#help').attr('currentObject')
    $('#' + id).addClass("animated flash").css({
        "box-shadow": "2px 2px 2px rgba(0,0,0,1)"
    });
    if (game[0].typeEdit == "correctChoose") {
        $(".elementResizable[flagtrueorfalse='true']").first().css({
            "box-shadow": "0px 1px 2px rgba(0,0,0,1)"
        });
    }

    setTimeout(function () {
        $('#' + id).removeClass("animated flash").css({
            "box-shadow": "none"
        });


        if (game[0].typeEdit == "correctChoose") {
            $(".elementResizable[flagtrueorfalse='true']").first().css({
                "box-shadow": "none"
            });
        }

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


function accuracy() {
    if (game[0].typeEdit == "correctChoose") {
        $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer)
        if (failAnswerCounter >= countOfcorrectAnswer) {
            accu = (countOfcorrectAnswer / failAnswerCounter) * 100
        } else {
            accu = (failAnswerCounter / countOfcorrectAnswer) * 100
        }
    } else {
        if (failAnswerCounter >= qustionSoundArray.length) {
            accu = (qustionSoundArray.length / failAnswerCounter) * 100
        } else {
            accu = (failAnswerCounter / qustionSoundArray.length) * 100
        }

    }


    return Math.round(accu, 2)
}


function noTriesME(gameTrie) {
    $(".star").remove()
// str='<div class="star"></div>'

    for (_i = 0, _len = Number(gameTrie); _i < _len; _i++) {
        $("<div class='star str"+(_i+1)+"'></div>").appendTo('.cn-wrapper')
        // $(str).appendTo('.cn-wrapper')
    }

}