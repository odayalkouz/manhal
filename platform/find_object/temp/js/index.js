
    UploadType = "",
    ActiveElement = ""

qustionIndex = 0
var qustionSoundArray = [],
    ActiveClick = false,
    correctCounter = 0,
    correctCounterAnswer = 0,
    helpCounter = 0
resizeGame = function () {


    var gameArea = document.getElementById('gameContainer');
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


};

tmpSrc=[]
$(document).ready(function () {
    window.addEventListener("resize", resizeGame);
    //calling jPreLoader function with properties
    resizeGame();
    $.getScript( "js/game.js", function( data, textStatus, jqxhr ) {
        // console.log( data ); // Data returned
        // console.log( textStatus ); // Success
        // console.log( jqxhr.status ); // 200
        // console.log( "Load was performed." );
        for (var i = 0; i < game[0].objects.length; i++) {
            tmpSrc.push( {type:"image",url:game[0].objects[i].src})
        }
        $('body').manhalLoader({
            splashID: "#jSplash",
            addFiles: tmpSrc,
            splashFunction: function () {  //passing Splash Screen script to jPreLoader
                resizeGame()


               // soundEffectBG("sound/bg.wav", true, 0.4)

            },
            onLoading: function (per) {

                console.log(per)
            },
        }, function () {

            //jPreLoader callback function
            $('#jSplash').children('section').not('.selected').hide();
            $('#jSplash').hide().fadeIn(800);
            $(".gameContainer").fadeIn()
        });

        preloadimages(game[0].objects)
    });








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
        qustionSoundArray.push(
            {
                sound: game[0].objects[i].sound,
                id: game[0].objects[i].id,
                imageSrc: game[0].objects[i].src,
                text: game[0].objects[i].text,
                index: i,


            })
        pushNewObject(game[0].objects[i])


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

    if(object.src!=""){
        src =   "images/" + name
        strImage= '<img class="allElem ' + animationCss[getRandomInt(0, animationCss.length - 1)] + '" src="' + object.src + '">'
        classNAme="containOmage"
    }else{
        strImage=""
        classNAme="notcontainOmage"

    }

    str = '<div onclick="checkAnswer(this)" name="' + object.name + '" text="' + object.text + '" class="elementResizable"  srcimage="' + object.src + '" id="' + object.id + '">' +
        strImage+

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

            soundEffect("sound/click.mp3")

        })
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
            playSoundbg("sound/bg.mp3")
            changeBackground(game[0].backgroundImage)
            setTimeout(getQustion, 1000)
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
        alert()
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


function checkAnswer(object) {
    $('.allElem').css({
        'pointer-events': 'none',

    });
    idImage = object.id;
    idSound = $(".playSoundQustion").attr('idAttr');
    text = $(".playSoundQustion").attr('text');
    image = $(".playSoundQustion").attr('image');


    if (idSound == idImage) {
        correctCounterAnswer++;
        correctCounter += 5;
        alert('good,next qustion .')
        $('.allElem').css({
            'pointer-events': 'auto',

        });
        $('#score').html(correctCounter)
        getQustion()
    }
    else {
        if ($(".hintContainer").length)$(".hintContainer").remove()
        str = '<div class="hintContainer"><div class="hint" >' +
            '<img class="imgShapes" src="' + image + '">' +
            '<h1>' + text + '</h1>' +
            '<img class="closeImg" src="images/close.png" onclick="closeBox()">' +

            '</div>' +
            '</div>'

        $(str).appendTo("body")
    }


}

function closeBox() {
    getQustion()
    $('.allElem').css({
        'pointer-events': 'auto',

    });
    if ($(".hintContainer").length)$(".hintContainer").remove()
    if ($(".hintContainerWin").length)$(".hintContainerWin").remove()
}
function closeBoxWin() {

    $('.allElem').css({
        'pointer-events': 'auto',

    });
    if ($(".hintContainer").length)$(".hintContainer").remove()
    if ($(".hintContainerWin").length)$(".hintContainerWin").remove()
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
    if ($(".hintContainerWin").length)$(".hintContainerWin").remove()
    str = '<div class="hintContainerWin"><div class="hintWin" >' +
        '<img class="imgShapes" src="images/win.png">' +
        '<img class="relodeImg" src="images/relode.png" onclick="again()">' +

        '</div>' +

        '</div>'

    $(str).appendTo("body")
}

function tryAgain() {
    if ($(".hintContainerWin").length)$(".hintContainerWin").remove()
    str = '<div class="hintContainerWin"><div class="hintWin" >' +
        '<img class="imgShapes" src="images/tryagain.png">' +
        '<img class="relodeImg" src="images/relode.png" onclick="again()">' +

        '</div>' +
        '</div>'

    $(str).appendTo("body")
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

