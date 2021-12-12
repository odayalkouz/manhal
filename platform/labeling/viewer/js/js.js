var level = 3;
var activeLevel = 0;
var count = 0;
config={};
$(window).on("resize", function () {
    $('#level-container').css("width", ($(".inner-container").width() * level) + "px");
    $(".level-inner-container").css("width", $('#level-container').width() / level + "px");

    resizeGame();

    reCalculatePoints()

});


function getNumberOflevel(){
    c=0
    for (var t = 0; t < game.level.length; t++) {
       if(game.level[t]!="removed"){
           c++
       }

    }
    return c
}

$(document).ready(function () {
    $('body').manhalLoader({
        splashID: "#jSplash",
        addFiles: [

            {type: "image", url: "images/label.svg"},
            {type: "image", url: "images/sound-on.svg"},
            {type: "image", url: "images/help.svg"},
            {type: "image", url: "images/ans-correct.svg"},
            {type: "image", url: "images/ans-wrong.svg"},
            {type: "image", url: "images/timeout.svg"},
            {type: "image", url: "images/messg-box.svg"},
            {type: "image", url: "images/falid.svg"},
            {type: "image", url: "images/win.svg"},
            {type: "image", url: "images/win-boy.png"},
            // {type:"audio",url:"sounds/ulna_r.mp3"},{type:"audio",url:"sounds/sort.mp3"}
        ],
        splashFunction: function () {  //passing Splash Screen script to jPreLoader


            resizeGame()

            reCalculatePoints()

        },
        onLoading: function (per) {
        },
    }, function () {
        $(".instructions-text-container").fadeIn();


        if(game.option.noBackgrondSound){
            playSoundbg()
        }

    });

    game = game[0]
    game.levelIndex = activeLevelIncrease()
    resizeGame();

    drawLevels()
    $(".header-container label").html(game.levelTitle[game.levelIndex].title)
    $('#level-container').css("width", ($(".inner-container").width() * game.level.length) + "px");
    $(".level-inner-container").css("width", ($('#level-container').width() / game.level.length) - 2 + "px");



    for (var t = 0; t < game.level.length; t++) {
        shuffleDivs("#level-" + t + " .label-container");
    }


    $("#level-container").children(":first").show();
    $("#level-container-label1").show();
    $(".header-container").find("label").html();
    reCalculatePoints();
    $(".play-btn").click(function () {
        $(".instructions-container").fadeOut();
        resizeGameInner()
        timerStart({min: 1, sec: 30}, true);

    })
    bgNotFountd=false
    $(".bgsound").prop('muted', true);
    $(".muteIcon").click(function () {
        if ($(".bgsound").prop('muted') ||  bgNotFountd) {
            $(".bgsound").prop('muted', false);
            $(this).find("img").attr('src', "images/sound-on.svg?" + Math.random()); // changing icon for button
            bgNotFountd=false
        } else {
            $(".bgsound").prop('muted', true);
            $(this).find("img").attr('src', "images/sound-off.svg?" + Math.random());
            bgNotFountd=true
        }
    });
    if(game.option.fillOff){
        $(".poent").css({
            background:"rgba(0,0,0,0)",
            width:game.option.dotSize+"vw",
            height:game.option.dotSize+"vw",
            border:"1px solid "+game.option.colorDots
        })
    }else{
        $(".poent").css({
            background:game.option.colorDots,
            width:game.option.dotSize+"vw",
            height:game.option.dotSize+"vw",
        })
    }
});

svgText = "";
function draw(arrayObject, divNum) {
    //$('.image-container span').remove();

    for (var i = 0; i < arrayObject.length; i++) {

        if (arrayObject[i] == "removed") {

        }
        else {


            $("<div class='lable-bg' data-index='" + i + "' id='span-" + i + "-L" + divNum + "' style='top: " + arrayObject[i].top + "%" + ";left: " + arrayObject[i].left + "%" + ";'><span class='LAbelText'   data-div='" + i + "'  answer='" + arrayObject[i].word + "' ></span></div>").appendTo("#level-" + divNum + " .image-container");
            //$("<div class='lable-bg hvr-bounce-in'><span>" + arrayObject[i].word + "</span></div>").appendTo("#level-" + divNum + " .label-container");

            $("<div class='lable-bg hvr-bounce-in noSwipingClass swiper-slide'><span>" + arrayObject[i].word + "</span></div>").appendTo("#level-container-label" + divNum);

            $("<div class='poent'  data-index='" + i + "' data-point='" + i + "' id='point-" + i + "-L" + divNum + "' >" +
                "</div>")
                .appendTo("#level-" + divNum).css({
                top: arrayObject[i].p.y + "%",
                left: arrayObject[i].p.x + "%"
            });
            ;


            svgText = '<svg class="svgGroup" xmlns="http://www.w3.org/2000/svg" version="1.1" height="' + $(".inner-container").height() + '" width="' + $(".inner-container").width() + '">';
            innerSvg = "";
            var parentPos = $(".inner-container").offset();
            var spanPos = $("#span-" + i + "-L" + divNum).offset();
            var pointPos = $("#point-" + i + "-L" + divNum).offset();

            pointWidth=parseInt($(".poent").outerWidth())

            objectPosition = {
                x1: (spanPos.left - parentPos.left),
                x2: (pointPos.left - parentPos.left)-pointWidth,
                y1: (spanPos.top - parentPos.top),
                y2: (pointPos.top - parentPos.top)-pointWidth
            };
            xx = "M" + objectPosition.x1 + " " + (objectPosition.y1) + " " + objectPosition.x2 + " " + (objectPosition.y2);
            innerSvg += '<path id="svg-' + i + "-L" + divNum + '" data-index="' + i + '" data-indexLevel="' + divNum + '" data-svg="' + i + '" d="' + xx + '" stroke="#a46125" stroke-width="2" fill="none" stroke-linecap="round"/>'
            svgText = svgText + innerSvg + "</svg>";
            $(svgText).appendTo("#level-" + divNum);


            // $(".label-container span").css("lineHeight", $(".label-container span").height() + "px");
            // $(".image-container span").css("lineHeight", $(".image-container span").height() + "px");
        }
    }

    $('.slidesLabel .lable-bg').draggable({
        placeholder: 'ui-sortable-placeholder',
        containment: '.game-container',
        stack: '.image-container .lable-bg',
        helper: function () {
            //debugger;
            return $($(this).clone()).addClass("clones noSwipingClass").appendTo(".game-container").css({

            })
        },
        cursor: 'hand',
        revert: true,
        start: function () {
            soundEffect("sound/move.mp3");
        },
        drag: function (event, ui) {

            object = $(this);
            words = $(this).find("span").html();
            console.log(words)
        }

    });
    $('.image-container .lable-bg span').droppable({
        accept: '.slidesLabel .lable-bg',
        drop: function (event, ui) {

            if ($(this).attr("answer") == words) {
                //correct answer
                scorm.correctAnswers++
                $(".correct span").html(scorm.correctAnswers)
                 $(ui.helper).remove();
                refreshSwipers()
                count++;

                soundEffect("sound/correct.mp3");

                $(this).html($(object).text());
                $(this).parent(".lable-bg").addClass("activ")

                $(object).addClass("correct-answer");

                labelAnswerLength=$("#level-container-label"+game.levelIndex).find("div").length

                if (count >= labelAnswerLength) {

                if (game.levelIndex+1 >= getNumberOflevel()) {

                        //win game
                        $(document.body).msgBox({

                            msgText1: "images/win.svg",
                            imgSrc: "images/win-boy.png",

                            confirmFn: function () {
                                restartgame();
                            },

                        });
                        $('#messageData').css("width", "59%");
                        $('#lbl-data1').css("width", "60%");
                        $('#aa i').css("background-image", "url('images/try-again.svg')")


                        return
                    }

                    tempLevel= game.levelIndex
                    game.levelIndex = game.levelIndex + 1

                    activeLevel++;
                    count = 0;

                    if (game.level[activeLevel] == "removed") {

                        activeLevel = game.levelIndex = activeLevelIncrease()


                    }



                    //pass Next level
                   {
                        $(document.body).msgBox({
                            msgText1: "images/level.svg",
                            msgText2: "",
                            imgSrc: "images/level-image.png",
                            confirmFn: function () {
                                document.getElementById("messageContainer").style.display = "none";

                                timerStart({min: 1, sec: 30}, true)

                                $("#level-" + tempLevel).hide()
                                $(".swiper-container").hide()
                                $('#messageData').css("width", "59%");
                                $('#lbl-data1').css("width", "60%");
                                $('#aa i').css("background-image", "url('images/next.svg')")

                                $("#level-" + game.levelIndex).fadeIn("fast")
                                $("#swiper-container" + game.levelIndex).fadeIn("fast")
                                setTimeout(function () {
                                    $("#level-container-label" + game.levelIndex).fadeIn("fast")
                                }, 1500)

                                if (typeof game.levelTitle[game.levelIndex].title != "undefined") {
                                    $(".header-container label").html(game.levelTitle[game.levelIndex].title)

                                }
                                reCalculatePoints()
                            },
                        });
                       $('#messageData').css("width", "59%");
                       $('#lbl-data1').css("width", "60%");
                       $('#aa i').css("background-image", "url('images/next.svg')")



                    }


                }

            }
            else {
                //error answer
                scorm.failAnswers++
                $(".wrong span").html(scorm.failAnswers)
                soundEffect("sound/error.mp3");

            }


        }

    });
    $(".level-inner-labels").hide()
    $("#level-container-label" + 0).fadeIn("fast")

}

var activeLevelIncrease = function () {
    valueCondition = game.level[activeLevel]
    if (valueCondition == "removed") {
        activeLevel++
        return activeLevelIncrease();
    } else {
        return activeLevel;
    }
};

function drawLevels() {

    for (var a = 0; a < game.level.length; a++) {
        if (game.level[a] == "removed") {

        } else {
            addLevelLoaded(a);

            draw(game.level[a], a);
            changeBackground(a)
        }

    }


}

var SwiperArray = []
function addLevelLoaded(index) {


    $("<div id='level-" + index + "' class='level-inner-container'>" +
        "<div class='image-container'></div>" +
        " <div class='label-container'></div>" +
        "</div>").appendTo('#level-container');



    sliderString = '<div id="swiper-container' + index + '" class="swiper-container">' +
        "<a onclick='SimulPrev("+index+")' id='swiper-prev"+index+"'  class='btn prev'><i></i></a>"

    $(sliderString + "<div index='" + index + "' id='level-container-label" + index + "' class='level-inner-labels swiper-wrapper'></div>" +
        "</div>" +
        "<div id='swiper-scrollbar"+index+"' class='swiper-scrollbar'></div>" +
        "<div id='swiper-button-next"+index+"'  class='swiper-button-next swiperControlHidden'></div>" +
        "<div id='swiper-button-prev"+index+"'  class='swiper-button-prev swiperControlHidden'></div>" +
        "<a onclick='SimulNext("+index+")' id='swiper-next"+index+"'  class='btn next'><i></i></a> " +
        "</div>").appendTo(".slidesLabel")


    SwiperArray.push(
        {
            val: new Swiper('#swiper-container' + index, {

                slidesPerView: "auto",
                freeMode: true,
                noSwipingClass: "noSwipingClass",
                spaceBetween: 0
            }),
            string: "new Swiper('#swiper-container" + index + "', {" +
            " scrollbar: '.swiper-scrollbar'," +
            "scrollbarHide: true," +

            "slidesPerView: 'auto'," +
            // "effect: 'coverflow'," +
            "freeMode: true,grabCursor: true," +
            " nextButton: '.swiper-button-next'," +
            "prevButton: '.swiper-button-prev'," +
            "noSwipingClass:'noSwipingClass'," +
            "spaceBetween: 0})"

        }
    )


    refreshSwipers()

}

function refreshSwipers(flag,index) {
    for (var t = 0; t < SwiperArray.length; t++) {
        SwiperArray[t].val.destroy();
        SwiperArray[t].val = eval(SwiperArray[t].string)

    }



}

function SimulNext(index){
    $("#swiper-button-next"+index).click()

    if($("#swiper-button-next"+index).hasClass("swiper-button-disabled")){
        $("#swiper-button-next"+index).addClass("swiper-button-disabled")
        return
    }
    $("#swiper-button-next"+index).removeClass("swiper-button-disabled")

}



function SimulPrev(index){
    $("#swiper-button-prev"+index).click()

    if($("#swiper-button-prev"+index).hasClass("swiper-button-disabled")){
        $("#swiper-button-prev"+index).addClass("swiper-button-disabled")
        return
    }
    $("#swiper-button-prev"+index).removeClass("swiper-button-disabled")

}


function restartgame() {

    location.reload()
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
    //gameArea.style.marginTop = (-newHeight / 2) + 'px';
    //gameArea.style.marginLeft = (-newWidth / 2) + 'px';
    var gameCanvas = document.getElementById('inner-container');
    gameCanvas.style.width = newWidth + 'px';
    gameCanvas.style.height = newHeight + 'px';

    resizeGameInner()
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
        width: newWidth / 2 + "px",
        height: newHeight / 2 + "px"
    })



}
function resizeGameInner() {
    var gameArea = document.getElementById('main-container');
    gameArea = $('.level-inner-container')
    var widthToHeight = 4 / 3;
    var newWidth = gameArea.width();
    var newHeight = gameArea.height();
    var newWidthToHeight = newWidth / newHeight;
    if (newWidthToHeight > widthToHeight) {
        newWidth = newHeight * widthToHeight;
        //gameArea.style.height = newHeight + 'px';
        // gameArea.style.width = newWidth + 'px';
    } else {
        newHeight = newWidth / widthToHeight;
        // gameArea.style.width = newWidth + 'px';
        // gameArea.style.height = newHeight + 'px';
    }
    //gameArea.style.marginTop = (-newHeight / 2) + 'px';
    //gameArea.style.marginLeft = (-newWidth / 2) + 'px';
    var gameCanvas = $('.image-container')
    gameCanvas.css({
        width: newWidth + "px",
        height: newHeight + "px"
    })
    reCalculatePoints()
}

function getXY(evt, element) {
    var rect = element.getBoundingClientRect();
    var scrollTop = document.documentElement.scrollTop ?
        document.documentElement.scrollTop : document.body.scrollTop;
    var scrollLeft = document.documentElement.scrollLeft ?
        document.documentElement.scrollLeft : document.body.scrollLeft;
    var elementLeft = rect.left + scrollLeft;
    var elementTop = rect.top + scrollTop;
    x = evt.pageX - elementLeft;
    y = evt.pageY - elementTop;
    return {x: x, y: y};
}

function activeObject(p, array) {
    if (p > array.length) {
        return 0;
    }
    return array[0][p]
}

function shuffleDivs(i) {
    var parent = $(i);
    var divs = parent.children();
    while (divs.length) {
        parent.append(divs.splice(Math.floor(Math.random() * divs.length), 1)[0]);
    }
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

function changeBackground(index) {

    // stringImage='<img class="imgObjectLabeling" src="images/bg_'+index+'.png">'
    //     //$(".imgObjectLabeling").remove()
    // $(stringImage).appendTo("#level-"+game.levelIndex)

    $("#level-" + index).find(".image-container").css(
        {
            'background-image': 'url(../../games/'+config.location.id+'/images/bg_' + index + '.png)',
            'background-size': '100% 100%',
            'background-repeat': 'no-repeat'


        })
}


function reCalculatePoints() {
    $("path").each(function (index) {


        var ident = $(this).data("index");
        var levelIndex = $(this).data("indexlevel");

        spanBox = $("#span-" + ident + "-L" + levelIndex)
        pointBox = $("#point-" + ident + "-L" + levelIndex)
        var Spanattr = spanBox.offset();
        var point = pointBox.offset();

        var parentPos = $(".level-container").offset();
        var diff = 0;

        direction = getDirection(ident, levelIndex)
        spanBoxInfo = {
            width: spanBox.width(),
            height: spanBox.height(),
        }
        increaseValue = {
            left: 0,
            top: 0
        }
        if (direction == "topLeft") {
            increaseValue.left = spanBoxInfo.width
            increaseValue.top = spanBoxInfo.height
        }
        else if (direction == "bottomLeft") {
            increaseValue.left = spanBoxInfo.width
            increaseValue.top = 0
        }
        else if (direction == "topRight") {
            increaseValue.left = 0
            increaseValue.top = spanBoxInfo.height
        }
        else if (direction == "bottomRight") {
            increaseValue.left = 0
            increaseValue.top = 0
        }
        else {
            increaseValue.left = 0
            increaseValue.top = 0
        }

        objectPosition = {
            x1: (Spanattr.left - parentPos.left) + increaseValue.left,
            x2: (point.left - parentPos.left) + pointBox.width() / 2,
            y1: (Spanattr.top - parentPos.top) + increaseValue.top,
            y2: (point.top - parentPos.top) - diff + pointBox.height() / 2
        };

        xx = "M" + objectPosition.x1 + " " + (objectPosition.y1) + " " + objectPosition.x2 + " " + (objectPosition.y2);
        $("#svg-" + ident + "-L" + levelIndex).attr("d", xx);
    })
    refreshSwipers()
}

function calculateAspectRatioFit(srcWidth, srcHeight, maxWidth, maxHeight) {

    var ratio = Math.min(maxWidth / srcWidth, maxHeight / srcHeight);

    return {width: srcWidth * ratio, height: srcHeight * ratio};
}


function getDirection(ident, levelIndex) {

    spanBox = $("#span-" + ident + "-L" + levelIndex)
    pointBox = $("#point-" + ident + "-L" + levelIndex)

    containerInfo = {
        top: $(".inner-container").offset().top,
        left: $(".inner-container").offset().left,

    }


    objectInfo = {
        top: spanBox.offset().top - containerInfo.top,
        left: spanBox.offset().left - containerInfo.left,
        width: spanBox.width(),
        height: spanBox.height()

    }

    pointInfo = {
        top: pointBox.offset().top - containerInfo.top,
        left: pointBox.offset().left - containerInfo.left,


    }


    if (objectInfo.top + objectInfo.height / 2 < pointInfo.top && objectInfo.left + objectInfo.width / 2 <= pointInfo.left) {
        return "topLeft"
    }
    if (objectInfo.top + objectInfo.height / 2 > pointInfo.top && objectInfo.left + objectInfo.width / 2 <= pointInfo.left) {
        return "bottomLeft"
    }

    if (objectInfo.top + objectInfo.height / 2 < pointInfo.top && objectInfo.left + objectInfo.width / 2 >= pointInfo.left) {
        return "topRight"
    }

    if (objectInfo.top + objectInfo.height / 2 > pointInfo.top && objectInfo.left + objectInfo.width / 2 > pointInfo.left) {
        return "bottomRight"
    }


    else {
        return "none"
    }


}

function showHwlp() {
var helpText=""

    helpText="<div class='help-main-container'>" +
        "<div class='help-inner-container'>" +
        "<div class='help-text-container-box'></div> " +
        "<a class='back-btn animated' onclick='closeHelp()'><i></i></a>" +
        "</div>" +
        "</div>" +
        "</div>"

$(helpText).appendTo(".game-container");
}

function closeHelp() {
    $(".help-main-container").remove()
}

function playSoundbg(src) {
    // stopAll()

    $("<audio class='bgsound' loop></audio>").attr({
        'src': "../../"+config.location.id+"sound/bg.mp3",


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




function parseURLParams(url) {
    var queryStart = url.indexOf("?") + 1,
        queryEnd   = url.indexOf("#") + 1 || url.length + 1,
        query = url.slice(queryStart, queryEnd - 1),
        pairs = query.replace(/\+/g, " ").split("&"),
        parms = {}, i, n, v, nv;

    if (query === url || query === "") return;

    for (i = 0; i < pairs.length; i++) {
        nv = pairs[i].split("=", 2);
        n = decodeURIComponent(nv[0]);
        v = decodeURIComponent(nv[1]);

        if (!parms.hasOwnProperty(n)) parms[n] = [];
        parms[n].push(nv.length === 2 ? v : null);
    }
    return parms;
}