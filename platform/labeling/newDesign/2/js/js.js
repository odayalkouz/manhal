var level = 3;
var activeLevel = 1;
var count = 0;

$(window).on("resize", function () {
    $('#level-container').css("width", ($(".inner-container").width() * level) + "px");
    $(".level-inner-container").css("width", $('#level-container').width() / level + "px");
    // $(".label-container span").css("lineHeight", $(".label-container span").height() + "px");
    // $(".image-container span").css("lineHeight", $(".image-container span").height() + "px");
    resizeGame();
    //if ($(".svgGroup").length)$(".svgGroup").remove();
    // drawPoint(game.level[game.levelIndex], game.levelIndex);
    //switch (activeLevel) {
    //    case 1:
    //        drawPoint(levela, 1);
    //        break;
    //    case 2:
    //        drawPoint(levelb, 2);
    //        break;
    //    case 3:
    //        drawPoint(levelc, 3);
    //        break;
    //}
    reCalculatePoints()

});

$(document).ready(function () {
    $('body').manhalLoader({
        splashID: "#jSplash",
        addFiles: [
            {type:"image",url:"images/bg_0.png"},{type:"image",url:"images/bg_1.png"},
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
        //jPreLoader callback function
        // $('#jSplash').children('section').not('.selected').hide();
        // $('#jSplash').hide().fadeIn(800);
        // $(".game").fadeIn()
    });

    game = game[0]
    resizeGame();
    drawLevels()
    $('#level-container').css("width", ($(".inner-container").width() * game.level.length) + "px");
    $(".level-inner-container").css("width", ($('#level-container').width() / game.level.length) - 2 + "px");
    //$('#level-0 .image-container').css("background-image", "url(" + game.backgroundLevel[0][0] + ")");
    //$('#level-1 .image-container').css("background-image", "url(" + game.backgroundLevel[0][1] + ")");
    //$('#level-2 .image-container').css("background-image", "url(" + game.backgroundLevel[0][2] + ")");


    for (var t = 0; t < game.level.length; t++) {
        shuffleDivs("#level-" + t + " .label-container");
    }


    $("#level-0").show()

    reCalculatePoints();
    $(".play-btn").click(function () {
        $(".instructions-container").fadeOut();
        // $(".game-container").fadeIn();
    })
});

svgText = "";
function draw(arrayObject, divNum) {
    //$('.image-container span').remove();

    for (var i = 0; i < arrayObject.length; i++) {
        $("<div class='lable-bg' data-index='" + i + "' id='span-" + i + "-L" + divNum + "' style='top: " + arrayObject[i].top + "%" + ";left: " + arrayObject[i].left + "%" + ";'><div class='top'></div><div class='bottom'></div><span class='LAbelText'   data-div='" + i + "'  answer='" + arrayObject[i].word + "' ></span></div>").appendTo("#level-" + divNum + " .image-container");
        $("<div class='lable-bg hvr-bounce-in'><div class='top'></div><div class='bottom'></div><span>" + arrayObject[i].word + "</span></div>").appendTo("#level-" + divNum + " .label-container");

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

        objectPosition = {
            x1: spanPos.left - parentPos.left,
            x2: pointPos.left - parentPos.left,
            y1: spanPos.top - parentPos.top,
            y2: pointPos.top - parentPos.top
        };
        xx = "M" + objectPosition.x1 + " " + (objectPosition.y1) + " " + objectPosition.x2 + " " + (objectPosition.y2);
        innerSvg += '<path id="svg-' + i + "-L" + divNum + '" data-index="' + i + '" data-indexLevel="' + divNum + '" data-svg="' + i + '" d="' + xx + '" stroke="#231f20" stroke-width="2" fill="none" stroke-linecap="round"/>'
        svgText = svgText + innerSvg + "</svg>";
        $(svgText).appendTo("#level-" + divNum);


        // $(".label-container span").css("lineHeight", $(".label-container span").height() + "px");
        // $(".image-container span").css("lineHeight", $(".image-container span").height() + "px");
    }


    $('.label-container .lable-bg').draggable({
        placeholder: 'ui-sortable-placeholder',
        containment: '.main-container',
        stack: '.image-container .lable-bg',
        revert: true,
        drag: function (event, ui) {
            object = $(this);
            words = $(this).find("span").html();
        }

    });
    $('.image-container .lable-bg span').droppable({
        accept: '.label-container .lable-bg',
        drop: function (event, ui) {
            if ($(this).attr("answer") == words) {
                count++;
                console.log("count :" + count);
                soundEffect("sound/correct.mp3");
                console.log("true");
                $(this).html($(object).text());
                $(this).parent(".lable-bg").addClass("activ")
                // $(this).css("background", "#00AB67");
                $(object).css("display", "none");


                if (game.level[game.levelIndex].length <= count) {

                    $("#level-" + game.levelIndex).fadeOut("fast")
                    game.levelIndex = game.levelIndex + 1
                    //drawPoint(game.level[game.levelIndex], game.levelIndex);
                    //draw(game.level[game.levelIndex], game.levelIndex);
                    activeLevel++;
                    count = 0;
                    $("#level-" + game.levelIndex).fadeIn("fast")
                    reCalculatePoints()

                }

            }
            else {
                soundEffect("sound/error.mp3");
                console.log("fales");
            }
            if (game.levelIndex >= game.level.length) {
                alert("you win!")
                restartgame();
            }

        }

    });


}

function drawLevels() {

    for (var a = 0; a < game.level.length; a++) {

        addLevelLoaded(a);

        draw(game.level[a], a);
        changeBackground(a)
    }


}
function addLevelLoaded(index) {


    $("<div id='level-" + index + "' class='level-inner-container'>" +
        "<div class='image-container'></div>" +
        " <div class='label-container'></div>" +
        "</div>").appendTo('#level-container');


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


    $("#level-" + index).find(".image-container").css(
        {
            'background-image': 'url(images/bg_' + index + '.png)',
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
            y2: (point.top - parentPos.top) + pointBox.height() / 2
        };

        xx = "M" + objectPosition.x1 + " " + (objectPosition.y1) + " " + objectPosition.x2 + " " + (objectPosition.y2);
        $("#svg-" + ident + "-L" + levelIndex).attr("d", xx);
    })
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


