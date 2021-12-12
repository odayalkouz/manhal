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
var finalMessageEror = "";
var finalMessage = "";
var winSound = ""
var fail = 0;
var accu = 0;

var oldSize={
    width:0,
    height:0
}

if(getUrlParameter('scorm')=='true'){
    var isLMS=true;
}else{
    var isLMS=false;
}

if (langStory == "ar") {
    finalMessageEror = "حاول مرة أخرى";
    finalMessage = "لقد فزت";
    winSound = "../all/sound/";
} else {
    finalMessageEror = "Try again";
    finalMessage = "You win";
}


var MatchingMapArray = [];

function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};

function resizeGameInner(container, inner, aspectRatio,isapply=true) {

//fghfg

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
    oldSize.width=newWidth
    oldSize.height=newHeight
    if(isapply) {
        gameCanvas.css({
            width: newWidth + "px",
            height: newHeight + "px"
        })
    }



}


function resizeGame(isapply=true) {
    var gameArea = document.getElementById('gameContainer');
    var widthToHeight = 4 / 3;
    var newWidth = window.innerWidth;
    var newHeight = window.innerHeight;
    percentWidthToPixle = 0 //(newWidth * 10) / 100
    percentHeightToPixle = (newHeight * 90) / 100

    var newWidthToHeight = newWidth / newHeight;

    if (newWidthToHeight > widthToHeight) {
        if(isapply) {
            newWidth = newHeight * widthToHeight;
            gameArea.style.height = (newHeight) + 'px';
            gameArea.style.width = (newWidth) + 'px';
        }
    } else {
        if(isapply) {
            newHeight = newWidth / widthToHeight;
            gameArea.style.width = (newWidth) + 'px';
            gameArea.style.height = (newHeight) + 'px';
        }
    }



    //gameArea.style.marginTop = (-newHeight / 2) + 'px';
    //gameArea.style.marginLeft = (-newWidth / 2) + 'px';

    // var gameCanvas = document.getElementById('gameContent');
    // gameCanvas.style.width = (newWidth - percentWidthToPixle ) + 'px';
    // gameCanvas.style.height = (newHeight - percentHeightToPixle) + 'px';
    //autoSizeText


    // resizeGameInner(".gameContainer", ".gameContentContainer", (4 / 3), 1,isapply)


    autoSizeText()
    var fontSize = parseInt($(".titleContainer").height() / 2) + "px";

    //  $(".titleText").css('font-size', fontSize);
    resizeCanvas()
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


function getRandomeImageMatching(arrayObject) {


    if (arrayObject.length != 0) {

        return Math.floor(Math.random() * (arrayObject.length))
    }
    else {

        return -1
    }

}


var groupElmentArray = []

function setTagElmentByGroup() {

    if (typeof game[0].group == "undefined") {
        return
    }

    if (game[0].group.length > 0) {
        groupElmentArray.length = game[0].group.length
    }
    for (i = 0; i < game[0].group.length; i++) {

        groupElment = game[0].group[i]
        groupTag = i

        console.log(groupElment)
        for (j = 0; j < groupElment.length; j++) {
            id = groupElment[j]
            console.log(id)

            $.grep(game[0].objects, function (object) {

                if (object.id == id) {

                    object.groupTagIndex = groupTag

                    groupElmentArray[groupTag] = []


                }


            })
        }
    }


    // // get x,y  from by group
    //
    for (i = 0; i < game[0].objects.length; i++) {

        objectData = game[0].objects[i];



        if (typeof objectData.groupTagIndex != "undefined") {

            groupElmentArray[objectData.groupTagIndex].push({
                empty: false,
                x: objectData.left,
                y: objectData.top,
                width: objectData.width,
                height: objectData.height,
                centerX: objectData.left + (objectData.width / 2),
                centerY: objectData.top + (objectData.height / 2),
            })

            groupElmentArray[objectData.groupTagIndex].count = 0
        }

    }


    // Resort array by shuffle

    for (i = 0; i < groupElmentArray.length; i++) {


        shuffle(groupElmentArray[i])

    }


    for (i = 0; i < game[0].objects.length; i++) {


        objectData = game[0].objects[i]

        if (typeof objectData.groupTagIndex != "undefined") {

            var indexTag = objectData.groupTagIndex
            var count = groupElmentArray[indexTag].count


            objectData.left = groupElmentArray[indexTag][count].centerX - ((objectData.width / 2))
            objectData.top = groupElmentArray[indexTag][count].centerY - ((objectData.height / 2))

            groupElmentArray[indexTag].count = groupElmentArray[indexTag].count + 1

        }


    }


}var shufflea = function (array) {

    var currentIndex = array.length;
    var temporaryValue, randomIndex;

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

};


function shuffle(a) {
    for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
    }
    return a;
}

function randomePositionMatching() {

    var arrayPositionTop = []
    var arrayPositionBottom = []

    for (i = 0; i < game[0].objects.length; i++) {

        if (game[0].objects[i] != "removed") {
            objectData = game[0].objects[i]
            if (objectData.matching.column == "top" || objectData.matching.column == "undefined") {
                arrayPositionTop.push({
                    empty: false,
                    x: objectData.left,
                    y: objectData.top,
                    width: objectData.width,
                    height: objectData.height,
                    centerX: objectData.left + (objectData.width / 2),
                    centerY: objectData.top + (objectData.height / 2),
                })
            } else if (objectData.matching.column == "bottom") {

                arrayPositionBottom.push({
                    empty: false,
                    x: objectData.left,
                    y: objectData.top,
                    width: objectData.width,
                    height: objectData.height,
                    centerX: objectData.left + (objectData.width / 2),
                    centerY: objectData.top + (objectData.height / 2),
                })


            }
        }
    }


    shuffle(arrayPositionTop);
    shuffle(arrayPositionBottom);


    var count = 0

    for (j = 0; j < game[0].objects.length; j++) {

        if (game[0].objects[j] != "removed") {
            objectData = game[0].objects[j]
            if (objectData.matching.column == "top" || objectData.matching.column == "undefined") {


                objectData.left = arrayPositionTop[count].centerX - ((objectData.width / 2))
                objectData.top = arrayPositionTop[count].centerY - ((objectData.height / 2))
                count++
            }

        }
    }


    var count = 0
    for (j = 0; j < game[0].objects.length; j++) {

        if (game[0].objects[j] != "removed") {
            objectData = game[0].objects[j]

            if (objectData.matching.column == "bottom") {

                objectData.left = arrayPositionBottom[count].centerX - ((objectData.width / 2))
                objectData.top = arrayPositionBottom[count].centerY - ((objectData.height / 2))


                count++
            }

        }
    }


}
function randomePositionMatchingB(col) {

    var arrayPositionTop = []
    var arrayPositionBottom = []

    for (i = 0; i < game[0].objects.length; i++) {

        if (game[0].objects[i] != "removed") {

            objectData = game[0].objects[i]
            if (objectData.matching.column == "top" || objectData.matching.column == "undefined") {
                arrayPositionTop.push({
                    empty: false,
                    x: objectData.left,
                    y: objectData.top,
                    width: objectData.width,
                    height: objectData.height,
                    centerX: objectData.left + (objectData.width / 2),
                    centerY: objectData.top + (objectData.height / 2),
                })

            } else if (objectData.matching.column == "bottom") {

                arrayPositionBottom.push({
                    empty: false,
                    x: objectData.left,
                    y: objectData.top,
                    width: objectData.width,
                    height: objectData.height,
                    centerX: objectData.left + (objectData.width / 2),
                    centerY: objectData.top + (objectData.height / 2),
                })


            }
        }
    }


    if (col == "a") {

        shuffle(arrayPositionTop);
    }


    if (col == "b") {

        shuffle(arrayPositionBottom);
    }


    var count = 0

    for (j = 0; j < game[0].objects.length; j++) {

        if (game[0].objects[j] != "removed") {
            objectData = game[0].objects[j]
            if (objectData.matching.column == "top" || objectData.matching.column == "undefined") {

                objectData.left = arrayPositionTop[count].centerX - ((objectData.width / 2))
                objectData.top = arrayPositionTop[count].centerY - ((objectData.height / 2))

                switch (game[0].subType) {

                    case "line" :


                        break

                    case "drag" :


                        if (game[0].isRandomX || typeof game[0].isRandomX == "undefined") {
                            console.log("test frag random")

                            objectData.left = arrayPositionTop[count].centerX - ((objectData.width / 2))
                        }


                        if (game[0].isRandomY || typeof game[0].isRandomY == "undefined") {
                            console.log("test frag random " + game[0].isRandomY)
                            console.log("test frag random " + col)
                            objectData.top = arrayPositionTop[count].centerY - ((objectData.height / 2))
                        }


                        break
                }


                count++
            }

        }
    }


    var count = 0
    for (j = 0; j < game[0].objects.length; j++) {

        if (game[0].objects[j] != "removed") {
            objectData = game[0].objects[j]
            if (objectData.matching.column == "bottom") {

                if (objectData.matching.column == "bottom") {

                    objectData.left = arrayPositionBottom[count].centerX - ((objectData.width / 2))
                    objectData.top = arrayPositionBottom[count].centerY - ((objectData.height / 2))

                    switch (game[0].subType) {

                        case "line" :


                            break

                        case "drag" :


                            if (game[0].isRandomX || typeof game[0].isRandomX == "undefined") {
                                objectData.left = arrayPositionBottom[count].centerX - ((objectData.width / 2))
                            }

                            if (game[0].isRandomY || typeof game[0].isRandomY == "undefined") {
                                objectData.top = arrayPositionBottom[count].centerY - ((objectData.height / 2))
                            }
                            break
                    }


                    count++
                }
            }

        }
    }


}
$(document).ready(function () {
    iNoBounce.enable()
    //scorm
    GetAPI(window);
    if(API!=null){
        if(API.Initialize("")){
            LMSStatus=true;
            API.SetValue("cmi.score.min",0);//to set min score in the game
            API.SetValue("cmi.score.max",100);//to set max score in the game
        }
    }


    // window.addEventListener("resize", resizeGameHelp);
    // window.addEventListener("resize", resizeGame);

    //calling jPreLoader function with properties
    resizeGameHelp()

    document.body.ontouchstart = function (event) {

        event.preventDefault()
        event.preventDefault()


    }

    document.addEventListener('touchmove', function (event) {

        event.preventDefault();

    }, false);

    // document.body.ontouchstart = function (event) {
    //
    //     if (event.touches.length > 1) {
    //         event.preventDefault()
    //         event.preventDefault()
    //     }
    //
    // }

    changeBackground()


    $(".titleText").html(game[0].titleText)
    $(".textIcon").attr("src", "images/titleIcon.png?" + Math.random())


    if (typeof game[0].resultType == "undefined") {
        game[0].resultType = "counting"
    }

    if (typeof game[0].subType == "undefined") {
        game[0].subType = "line"
    }
    if (typeof game[0].inputType == "undefined") {

        game[0].inputType = "0";
    }
    if (game[0].noHelp) {
        $("#help").hide()
    }

    if (game[0].noSound || game[0].typeEdit == "correctChoose" || game[0].typeEdit == "putCircle" || game[0].typeEdit == "justText") {
        $("#hear").hide()
    }


    if (game[0].typeEdit == "TrueAndFalse") {


        var text1 = ""
        var text2 = ""


        if (typeof game[0].trueFalseControl == "undefined") {

            game[0].trueFalseControl = {
                top: "90",
                left: "35",
                width: "30",
                height: "10",
                trueShow: true,
                falseShow: true
            }
        }


        if (game[0].trueFalseControl.falseShow == "true" && game[0].trueFalseControl.trueShow == "true") {
            if(!isLMS){
                if (typeof (parent.bookid) == "undefined") {
                    text1 = "<div class='icon-bg'><img flag='true' class='draggable' src='../all/images/correct-2/correcttag.svg' style='height: 59%;left: 16%;top: 8%'></div>"
                    text2 = "<div class='icon-bg'><img flag='false' class='draggable' src='../all/images/correct-2/wrongtag.svg' style='height: 59%;left: 23%;top: 11%'></div>"
                } else {
                    text1 = "<div class='icon-bg'><img flag='true' class='draggable' src='../all/images/correct-2/correcttag.svg' style='height: 59%;left: 16%;top: 8%'></div>"
                    text2 = "<div class='icon-bg'><img flag='false' class='draggable' src='../all/images/correct-2/wrongtag.svg' style='height: 59%;left: 23%;top: 11%'></div>"
                }
            }else {
                text1 = "<div class='icon-bg'><img flag='true' class='draggable' src='../all/images/correct-2/correcttag.svg' style='height: 59%;left: 16%;top: 8%'></div>"
                text2 = "<div class='icon-bg'><img flag='false' class='draggable' src='../all/images/correct-2/wrongtag.svg' style='height: 59%;left: 23%;top: 11%'></div>"
            }


        }
        // if (game[0].trueFalseControl.falseShow == "true" && game[0].trueFalseControl.trueShow == "true") {
        //     if(!isLMS){
        //         if (typeof (parent.bookid) == "undefined") {
        //             text1 = "<div class='icon-bg' style='margin-left: 13%;'><img flag='true' class='draggable' src='../all/images/correct/correct.svg' style='height: 70%;left: 8%;'></div>"
        //             text2 = "<div class='icon-bg'><img flag='false' class='draggable' src='../all/images/correct/false.svg' style='height: 67%;left: 17%;top: 14%'></div>"
        //         } else {
        //             text1 = "<div class='icon-bg'><img flag='true' class='draggable' src='../all/images/correct/correct.svg' style='height: 70%;left: 8%;'></div>"
        //             text2 = "<div class='icon-bg'><img flag='false' class='draggable' src='../all/images/correct/false.svg' style='height: 67%;left: 17%;top: 14%'></div>"
        //         }
        //     }else {
        //         text1 = "<div class='icon-bg' style='margin-left: 13%;'><img flag='true' class='draggable' src='../all/images/correct/correct.svg' style='height: 70%;left: 8%;'></div>"
        //         text2 = "<div class='icon-bg'><img flag='false' class='draggable' src='../all/images/correct/false.svg' style='height: 67%;left: 17%;top: 14%'></div>"
        //     }
        //
        //
        // }
        else if (game[0].trueFalseControl.trueShow == "true") {
            if(!isLMS){
                if (typeof (parent.bookid) == "undefined") {
                    text1 = "<div class='icon-bg'><img flag='true' class='draggable' src='../all/images/correct-2/correcttag.svg' style='height: 59%;left: 16%;top: 8%'></div>"
                } else {
                    text1 = "<div class='icon-bg' ><img flag='true' class='draggable' src='../all/images/correct-2/correcttag.svg' style='height: 59%;left: 16%;top: 8%;'></div>"
                }
            }else {
                text1 = "<div class='icon-bg'><img flag='true' class='draggable' src='../all/images/correct-2/correcttag.svg' style='height: 59%;left: 16%;top: 8%'></div>"
            }


        }
        // else if (game[0].trueFalseControl.trueShow == "true") {
        //     if(!isLMS){
        //         if (typeof (parent.bookid) == "undefined") {
        //             text1 = "<div class='icon-bg' style='margin-left: 31%;'><img flag='true' class='draggable' src='../all/images/correct/correct.svg' style='height: 70%;left: 8%;'></div>"
        //         } else {
        //             text1 = "<div class='icon-bg' ><img flag='true' class='draggable' src='../all/images/correct/correct.svg' style='height: 70%;left: 8%;'></div>"
        //         }
        //     }else {
        //         text1 = "<div class='icon-bg' style='margin-left: 31%;'><img flag='true' class='draggable' src='../all/images/correct/correct.svg' style='height: 70%;left: 8%;'></div>"
        //     }
        //
        //
        // }


        else if (game[0].trueFalseControl.falseShow == "true") {
            if (!isLMS) {
                if (typeof (parent.bookid) == "undefined") {
                    text2 = "<div class='icon-bg' style='margin-left: 31%;'><img flag='false' class='draggable' src='../all/images/correct-2/wrongtag.svg' style='height: 59%;left: 23%;top: 11%'></div>"
                    // text2 = "<div class='icon-bg' style='margin-left: 31%;'><img flag='false' class='draggable' src='../all/images/correct/false.svg' style='height: 67%;left: 17%;top: 14%'></div>"
                } else {
                    text2 = "<div class='icon-bg'><img flag='false' class='draggable' src='../all/images/correct-2/wrongtag.svg' style='height: 59%;left: 23%;top: 11%'></div>"
                    // text2 = "<div class='icon-bg'><img flag='false' class='draggable' src='../all/images/correct/false.svg' style='height: 67%;left: 17%;top: 14%'></div>"
                }
            } else {
                text2 = "<div class='icon-bg' style='margin-left: 31%;'><img flag='false' class='draggable' src='../all/images/correct-2/wrongtag.svg' style='height: 59%;left: 23%;top: 11%'></div>"
                // text2 = "<div class='icon-bg' style='margin-left: 31%;'><img flag='false' class='draggable' src='../all/images/correct/false.svg' style='height: 67%;left: 17%;top: 14%'></div>"
            }


        }


        var textContainer = "<div class='trueAndFalseContainer'>" +
            "" +
            text1 +
            text2 +
            "" +
            "</div>";

        info = game[0].trueFalseControl
        if (!isLMS) {
            if (typeof (parent.bookid) == "undefined") {
                $(".fotterGame").append(textContainer)
            } else {
                $(".gameContent").append(textContainer)
            }
        } else {
            $(".fotterGame").append(textContainer)
        }


        // $(".trueAndFalseContainer").css({
        //     top:info.top+"%",
        //     left:info.left+"%",
        //     width:info.width+"%",
        //     height:info.height+"%",
        //     position: "absolute",
        //    background: "#64336b" ,
        //
        //
        //
        //
        // })
        // $(".gameContent").append(text2)


        $(".draggable").draggable({
            revert: "valid", helper: "clone",
            cursor: "move",
            stack: "div",
            start: function (event, ui) {
                $(this).css("z-index", "99999999999");
                $(this).parent().css("z-index", "99999999999");
            }

        });


    }


    for (var i = 0; i < game[0].objects.length; i++) {
        if (game[0].objects[i].src = "") {

        } else {


            tmpSrc.push({type: "image", url: game[0].objects[i].src})
        }

    }
    $("#gameContainer").hide();
    src1 = "../../../games/" + config.id + "/all/" + "images/bg.png?" + Math.random();
    src2 = "../../../games/" + config.id + "/all/" + "images/bg.jpg?" + Math.random();
    if (langStory == "ar") {

        src3 = "../../" + langStory + "/sound/win.mp3" + Math.random();
        src4 = "../../" + langStory + "/sound/good.mp3" + Math.random();
        src5 = "../../" + langStory + "/sound/correct.mp3" + Math.random();
        src6 = "../../" + langStory + "/sound/goodA.mp3" + Math.random();
        src7 = "../../" + langStory + "/sound/error.mp3" + Math.random();
        src8 = "../../" + langStory + "/sound/trySpeach.mp3" + Math.random();
        tmpSrc.push({type: "audio", url: src6});
        tmpSrc.push({type: "audio", url: src7});
        tmpSrc.push({type: "audio", url: src8});
    } else {
        src3 = "../../" + langStory + "/sound/win.mp3" + Math.random();
        src4 = "../../" + langStory + "/sound/correct.mp3" + Math.random();
        src5 = "../../" + langStory + "/sound/error.mp3" + Math.random();
    }
    tmpSrc.push({type: "image", url: src1});
    tmpSrc.push({type: "image", url: src2});
    tmpSrc.push({type: "audio", url: src3});
    tmpSrc.push({type: "audio", url: src4});
    tmpSrc.push({type: "audio", url: src5});
    $('body').manhalLoader({
        splashID: "#jSplash",
        addFiles: tmpSrc,
        splashFunction: function () {  //passing Splash Screen script to jPreLoader
            // resizeGameHelp()
            $('<div class="manhal-main-loader"><div class="loader-effect"><div class="checkmark draw"></div>' +
                '</div><div class="logo-loader"></div></div>').appendTo('#manhalpreOverlay');
            if (!isLMS) {
                if (typeof (parent.bookid) == "undefined") {
                // if (1!=1) {
                    resizeGame();
                    $(".trueAndFalseContainer").addClass("inBrowser");
                } else {
                    resizeGame(false);

                    $("body").css("background", "transparent");
                    $(".top-container").fadeOut();
                    $(".headerGame").hide();
                    $(".fotterGame").hide();
                    $(".gameContentContainer").css({
                        "top": 0,
                        "border": "none",
                        "box-shadow": "none",
                        "width": "100%",
                        "height": "100%",
                        "background": "transparent"
                    });
                    $(".inner-footer-right").css({
                        "top": "1.2%",
                        "background": "rgba(255,255,255,0.7)",
                        "border-radius": "10px",
                        "box-shadow": "0px 0px 3px #000",
                        "left": "2%",
                        "right": "auto"
                    });
                    $(".star").css({"margin-top": "2.6%", "height": "76%"});
                    $(".poweredBy").hide();


if(game[0].hideStar){

    $(".inner-footer-right").hide()
}

                }
            } else {
                resizeGame();
                $(".trueAndFalseContainer").addClass("inBrowser");
            }


        },
        onLoading: function (per) {


        },
    }, function () {
        if (typeof game[0].css == "undefined" || game[0].css == "") {
            game[0].css = ""
        }


        var style = document.createElement('style');
        style.type = 'text/css';
        style.innerHTML = game[0].css;
        document.getElementsByTagName('head')[0].appendChild(style);

        //jPreLoader callback function
        $('#jSplash').children('section').not('.selected').hide();
        $('#jSplash').show();
        // $(".gameContainer").fadeIn()
        $(".playSoundQustion1").hide();
        $("#gameContainer").fadeIn();
        $("#manhalpreOverlay").fadeOut(0);
        initGame()
        // if($(".gameContentContainer").height()>$(".gameContentContainer").width()){
        //     $(".allElem").css('max-width','none');
        // }
    });

    preloadimages(game[0].objects)
    noTriesME(game[0].noTries)


    // StartScorm()


    $(window).on("beforeunload", function () {
        alert("you leaving this page");

    });

    autoSizeText();
    bgNotFountd = false
    $(".bgsound").prop('muted', true);
    $(".muteIcon").click(function (event) {
        event.preventDefault()
        event.preventDefault()
        if ($(".bgsound").prop('muted') || bgNotFountd) {
            $(".bgsound").prop('muted', false);
            $(this).css('background-image', 'url(images/sound.svg)'); // changing icon for button
            bgNotFountd = false

        } else {
            $(".bgsound").prop('muted', true);
            $(this).css('background-image', 'url(images/mute.svg)');
            bgNotFountd = true
        }
    });
    // $(".question-icon").click(function (event) {
    //     event.preventDefault()
    //     event.preventDefault()
    //     if (!$(".help-main-container").is(':visible')) {
    //         $(".help-main-container").css({
    //             display: "block",
    //             zIndex: "99999999",
    //             background: "rgba(0,0,0,0.5)",
    //         })
    //         $(".logo").hide()
    //     } else {
    //         $(".help-main-container").css({
    //             display: "none",
    //             zIndex: "0",
    //             background: "rgba(0,0,0,0.5)",
    //         })
    //         $(".logo").show()
    //     }
    //
    //     setTimeout(function () {
    //         $(".help-inner-container").addClass("animated slideInDown").fadeIn();
    //         setTimeout(function () {
    //             $(".boy").addClass("animated slideInLeft").fadeIn();
    //             setTimeout(function () {
    //                 $(".char-help").addClass("animated fadeIn").fadeIn();
    //             }, 500)
    //         }, 500)
    //     }, 500)
    //
    // })
    $(".play-btn").click(function (event) {
        event.preventDefault()
        event.preventDefault()
        $(".help-main-container").fadeOut()
        $(".gameContainer").fadeIn()

        resizeGame();
        $(".playSoundQustion1").hide()
        setTimeout(function () {
            if (game[0].typeEdit == "withSound" || game[0].typeEdit == "WithSound") {
                $(".playSoundQustion1").show()
                $(".playSoundQustion1").click()
            }
        }, 1000)

    })


    // if (game[0].noSound || typeof game[0].noSound === "undefined") {
    //     if (!isLMS) {
    //         if (typeof (parent.bookid) == "undefined") {
    //             soundEffectBG("../../../games/" + config.id + "/all/sound/bg.mp3", true, 0.4)
    //         }
    //     } else {
    //         soundEffectBG("../../../games/" + config.id + "/all/sound/bg.mp3", true, 0.4)
    //     }
    //
    //
    // }

    if (game[0].typeEdit == "WithSound" || game[0].typeEdit == "withSound") {
        $(".playSoundQustion1").click(function (event) {
            event.preventDefault()
            event.preventDefault()
            playSoundQustion(
                qustionSoundArray[qustionIndex].sound,
                qustionSoundArray[qustionIndex].id,
                qustionSoundArray[qustionIndex].imageSrc,
                qustionSoundArray[qustionIndex].text
            );
        })

    }

    setTimeout(function () {
        $(".help-inner-container").addClass("animated slideInDown").fadeIn();
        setTimeout(function () {
            $(".boy").addClass("animated slideInLeft").fadeIn();
            setTimeout(function () {
                $(".char-help").addClass("animated fadeIn").fadeIn();
            }, 500)
        }, 500)
    }, 500)


    if (game[0].typeEdit == "correctChoose" || game[0].typeEdit == "putCircle") {


        $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer)

    } else if (game[0].typeEdit == "TrueAndFalse") {

        $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer)

    } else if (game[0].typeEdit == "matching") {

        $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer)

    } else {
        $('#score span').html(countCorrectAnswersByUser + " / " + qustionSoundArray.length)

    }

    // setTimeout(function() {
    //     $('svg').each(function() {
    //         var svg = $(this);
    //         var text = svg.find('text');
    //         var bbox = text.get(0).getBBox();
    //
    //         svg.get(0).setAttribute('viewBox',
    //             [bbox.x,
    //                 bbox.y,
    //                 bbox.width,
    //                 bbox.height].join(' '));
    //     });
    // }, 1000);

    // $(".titleText").hide()
    setTimeout(function () {
        //var fontSize = parseInt($(".titleContainer").height()/2)+"px";

        // $(".titleText").css('font-size', fontSize).show();
    }, 1000)

    if (game.typeEdit == "fillBox") {
        if (game.font == "DroidKufi Bold") {
            $(".filltextStyle").css("font-family", "Droid Arabic Kufi");
            $(".ui-keyboard-button span").css("font-family", "Droid Arabic Kufi")
        } else if (game.font == "opensans") {
            $(".filltextStyle").css("font-family", "open_sans")
            $(".ui-keyboard-button span").css("font-family", "open_sans")
        }
    }

    $(".play-bt").click(function () {
        playSoundQustion(
            qustionSoundArray[qustionIndex].sound,
            qustionSoundArray[qustionIndex].id,
            qustionSoundArray[qustionIndex].imageSrc,
            qustionSoundArray[qustionIndex].text
        );
        $(".play-container").fadeOut();
    })

    $(".play-again").click(function () {
        playSoundQustion(
            qustionSoundArray[qustionIndex].sound,
            qustionSoundArray[qustionIndex].id,
            qustionSoundArray[qustionIndex].imageSrc,
            qustionSoundArray[qustionIndex].text
        );
    })
});

var counting = 0

function initGame() {
    counting = counting + 1

    // alert("init Game" +game[0].objects.length)

    if ($(".elementsObject").length > 0) {

        $(".elementsObject").remove()
    }
    $(".stopUnconnect").remove()
    UploadType = "",
        ActiveElement = ""

    qustionIndex = 0
    qustionSoundArray = [],
        ActiveClick = false,
        correctCounter = 0,
        correctCounterAnswer = 0,
        helpCounter = 0;
    countOfcorrectAnswer = 0;
    countCorrectAnswersByUser = 0;
    failAnswerCounter = 0;
    finalMessageEror = "";
    finalMessage = "";
    winSound = "";
    bgNotFountd = false;
    if (langStory == "ar") {
        finalMessageEror = "حاول مرة أخرى";
        finalMessage = "لقد فزت";
        winSound = "../all/sound/"
    } else {
        finalMessageEror = "Try again";
        finalMessage = "You win";
    }
    $(".elementResizable").remove();


    DrawObjects()


    $(".hintContainerWin").hide()
    if (game[0].typeEdit == "correctChoose" || game[0].typeEdit == "putCircle") {


        $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer)

    } else if (game[0].typeEdit == "TrueAndFalse") {
        // $("#help").fadeOut(0);
        $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer);
        $(".trueAndFalseContainer img").css("pointer-events","auto");

    } else if (game[0].typeEdit == "matching") {

        var counMatching = 0;


        for (i = 0; i < game[0].objects.length; i++) {
            obj = game[0].objects[i]
            if (obj != "removed") {
                if (obj.matching.column == "top") {
                    if (obj.matching.linkWith.length > 0) {
                        counMatching += obj.matching.linkWith.length
                    }
                }
            }
        }

        countOfcorrectAnswer = counMatching

        $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer)


    } else {
        $('#score span').html(countCorrectAnswersByUser + " / " + qustionSoundArray.length)

    }
    $('#scoreFail span').html(failAnswerCounter)

    // if (game[0].noSound || typeof game[0].noSound === "undefined") {
    //     if(!isLMS ){
    //
    //         if (typeof (parent.bookid) == "undefined") {
    //             soundEffectBG("../../../games/" + config.id + "/all/sound/bg.mp3", true, 0.4)
    //         }
    //     }else {
    //         soundEffectBG("../../../games/" + config.id + "/all/sound/bg.mp3", true, 0.4)
    //     }
    //
    // }
    $("#help").css({
        opacity: 1,
        "pointer-events": "auto"
    })
    noTriesME(game[0].noTries)


    $(".gameContent").show()

    console.log("again rt")
    // if (game[0].typeEdit == "withSound" || game[0].typeEdit == "WithSound") {
    //     playSoundQustion(
    //         qustionSoundArray[qustionIndex].sound,
    //         qustionSoundArray[qustionIndex].id,
    //         qustionSoundArray[qustionIndex].imageSrc,
    //         qustionSoundArray[qustionIndex].text
    //     );
    // }

}


function DrawObjects() {
    if (typeof game[0].allFillElemRandom == "undefined") {

        game[0].allFillElemRandom = true;
    }
    if (typeof game[0].allFillElemDirection == "undefined") {

        game[0].allFillElemDirection = false;
    }

    if (game[0].typeEdit == "matching") {

        if (game[0].isRandom) {

            randomePositionMatching()
        }


        if (game[0].isRandomB) {

            randomePositionMatchingB("b")
        }

        if (game[0].isRandomA) {

            randomePositionMatchingB("a")
        }

    } else {

        setTagElmentByGroup()
    }


    length = game[0].objects.length;
    objects = game[0].objects;

    MatchingMapArray = []
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

            if (game[0].typeEdit == "matching") {
                if (game[0].subType == "line") {
                    getTempMatchingArray(game[0].objects[i])
                } else {

                }
            }

        }


    }

    if (game[0].typeEdit == "matching") {
        $(".elementsObject").hide()
        if (game[0].subType == "line") {
            canvasText = "<canvas id='canvasColumn' class='canvasColumn'>" +

                "</canvas>"


            $(".gameContent").append(canvasText)

            resizeCanvas()
        }
        $(".elementsObject").show()
    } else {
        $(".elementsObject").hide()
        shuffle(qustionSoundArray);
        $(".elementsObject").show()
    }
if(game[0].allElemWidth){
    $(".allElem").css("width","100%")
}
    if (game[0].typeEdit == "fillBox") {
        $(".elementsObject").removeClass("selected");
    }


    if(game[0].typeEdit=="correctChoose" || game[0].typeEdit=="withSound"){
        $(".elementsObject").append("<div class='trueFalse animate pulse'><img src></div>")
    }

    if(game[0].typeEdit=="withSound"){
        $(".play-container").fadeIn();
        $(".play-again").fadeIn();
        if(game[0].langauge=="en"){
            $(".inner-footer-right").css({"left":"6.972%","right":"auto"});
            $("#score").css("left","0");
            $("#scoreFail").css("right","0");
            $(".separator").css("left","-13%");
            $(".separator-tow").css({"left":"-13%","right":"auto"});
            $(".separator").css("right","28.18%");
            $(".inner-footer-left").css("left","20.4%");
        }else  {
            $(".inner-footer-right").css("left","6.972%");
            $("#score").css("left","0");
            $("#scoreFail").css("right","52%");
            $(".separator").css("left","-13%");
            $(".separator-tow").css({"left":"-13%","right":"auto"});
            $(".separator").css("right","28.18%");
            $(".inner-footer-left").css("left","20.4%");
        }

    }

}


function getTempMatchingArray(object) {


    if (object != "removed") {

        if (game[0].typeEdit == "matching") {
            $(".elementsObject").hide()
            if (object.matching.column == "top") {

                MatchingMapArray[object.id] = {
                    correct: object.matching.linkWith,
                    answer: [],
                    type: "top"
                }


            } else {
                MatchingMapArray[object.id] = {
                    correct: object.matching.linkWith,
                    answer: [],
                    type: "bottom"
                }
            }

            assignEventToCircleMatching(object.id)

            document.querySelector("#" + object.id).ontouchend = function (event) {

                if (game[0].typeEdit == "matching") {
                    // alert($(this).attr("sound"))
                    srcSound = "../../../games/" + config.id + "/all/" + "" + $(this).attr("sound")

                    soundSpeach(srcSound)
                }
            }

            $("#" + object.id).click(function () {

                if (game[0].typeEdit == "matching") {
                    // alert($(this).attr("sound"))
                    srcSound = "../../../games/" + config.id + "/all/" + "" + $(this).attr("sound")


                    soundSpeach(srcSound)
                }
            })
            $(".elementsObject").show()

        }
    }

}


function changeBackground(src) {

    if (game[0].backgroundImage == "") {
        return
    }

    // src1 = "../../../games/" + config.id + "/all/" + "images/bg.png?" + Math.random()
    src2 = "../../../games/" + config.id + "/all/" + "images/bg.jpg?" + Math.random()
    src3 = "../../../games/" + config.id + "/all/" + "images/bg.svg?" + Math.random()
    $.ajax({
        url: src2,
        type: 'HEAD',
        error: function () {
            $(".gameContent").css(
                {
                    'background': 'url(' + src2 + ')100% 100% no-repeat ,url(' + src1 + ')100% 100% no-repeat ,url(' + src3 + ')100% 100% no-repeat',
                    'background-size': '100% 100%',
                    'background-repeat': 'no-repeat',
                    // 'background-repeat':'no-repeat',
                    // 'background-position':'center',
                    // 'background-size':'contain'

                })

        },
        success: function () {

            $(".gameContent").css(
                {
                    'background': 'url(' + src1 + ')100% 100% no-repeat ,url(' + src2 + ')100% 100% no-repeat,url(' + src3 + ')100% 100% no-repeat',
                    'background-size': '100% 100%',
                    'background-repeat': 'no-repeat',
                    // 'background-repeat':'no-repeat',
                    // 'background-position':'center',
                    // 'background-size':'contain'

                })

        }
    });


}

function fixSymbole(object) {

    vall = object.textBoxConfig.text
        vall = vall.replaceAll("'", "&apos;")
        vall = vall.replaceAll("'", "&apos;")
        vall = vall.replaceAll("(", "&lpar;")
        vall = vall.replaceAll(")", "&rpar;")
    return vall
}

function pushNewObject(object) {

    if ($("#" + object.id).length > 0) {
        $("#" + object.id).remove()
    }

    //rezie = ' <div class="ui-resizable-handle ui-resizable-nw corner" id="nwgrip"></div>' +
    //    ' <div class="ui-resizable-handle ui-resizable-ne corner" id="negrip"></div>' +
    //    '<div class="ui-resizable-handle ui-resizable-sw corner" id="swgrip"></div>' +
    //    '<div class="ui-resizable-handle ui-resizable-se corner" id="segrip"></div>'

    var textElment = ""
    var sourceImage = object.name
    var soundURL = ""
    var strImage = ""

    if(typeof object.sound!="undefined"){

        soundURL =object.sound
    }

    if (object.name != "") {
        src = "../../../games/" + config.id + "/all/" + "images/" + name

        if (game[0].typeEdit == "matching") {
            if (typeof object.srcGroup == "object" && object.srcGroup.length > 0) {

                indexImage = getRandomeImageMatching(object.srcGroup)
                if (indexImage != -1) {
                    if(game.subType=="drag"){

                        soundURL =object.sound
                    }else{
                        sourceImage = object.srcGroup[indexImage].image;
                        soundURL = "/sound/" + sourceImage.split(".")[0] + ".mp3";

                    }

                }
            } else {

                soundURL = object.sound
            }

        } else {
            soundURL = object.sound
        }

        if (game[0].typeEdit == "matching") {
            if(object.flip==true){
                strImage = '<img  sound="' + soundURL + '" class="allElem ' + animationCss[getRandomInt(0, animationCss.length - 1)] + '" src="' + src + sourceImage + '"  colType="' + object.matching.column + '" style="pointer-events: none;transform: scaleX(-1);">'

            }else {
                strImage = '<img sound="' + soundURL + '" class="allElem ' + animationCss[getRandomInt(0, animationCss.length - 1)] + '" src="' + src + sourceImage + '"  colType="' + object.matching.column + '" style="pointer-events: none">'

            }
        } else {

            {
                if(object.flip==true){
                    strImage = '<img style="transform: scaleX(-1);" class="allElem ' + animationCss[getRandomInt(0, animationCss.length - 1)] + '" src="' + src + sourceImage + '">'
                }else {
                    strImage = '<img class="allElem ' + animationCss[getRandomInt(0, animationCss.length - 1)] + '" src="' + src + sourceImage + '">'
                }

            }

        }

        classNAme = "containOmage"
    } else {
    if( typeof object.textBoxConfig != "undefined"){


        if (game[0].typeEdit == "fillBox" && object.textBoxConfig.text != "") {


            textElment += '<div sound="' + soundURL + '" id="true' + object.id + '" class="trueIcon animated"></div> <div id="CtextBox' + object.id + '" class="textBoxContainer">'
                // '<div style="width: 100%;height: 100%;position: absolute;z-index: 99999;">' +
                // '</div>'+
            vall= fixSymbole(object);


            if(game[0].inputType=="0"){


                    textElment += "<input   id='textBox" + object.id + "' answer='" + vall + "' type='text' class='filltextStyle allElem effect-21 " + 0 + "' src='" + 0 + "' valuee='" + vall + "'></input>"



                }else if(game[0].inputType=="1"){
                    textElment += '<textarea   id="textBox' + object.id + '" answer="' + vall + '" type="text" class="filltextStyle allElem effect-21 ' + 0 + '" src="' + 0 + '" valuee="' + vall + '"></textarea>'
                }

                '</div>'

            countOfcorrectAnswer++
            // textElment += '<textarea id="textBox' + object.id + '" answer="' + object.textBoxConfig.text + '" type="text" class="allElem effect-21 ' + 0 + '" src="' + 0 + '" value="' + object.textBoxConfig.text + '"></textarea>'
        }
        strImage = ""
        classNAme = "notcontainOmage"

        }

        if (game[0].typeEdit == "fillBox") {

            soundURL = object.sound

        }


    }

    if (game[0].typeEdit == "TrueAndFalse") {

        if (object.trueOrFalse == "true" || object.trueOrFalse == "false") {
            console.log("add")
            countOfcorrectAnswer++
        }

    } else if (game[0].typeEdit == "matching") {
        colType = object.matching.column
        if (colType == "bottom") {

            countOfcorrectAnswer++
        }
    }
    else {
        if (object.setAsTrue == "true" || object.setAsTrue) {

            countOfcorrectAnswer++
        }
    }


    answer = ""
    colType = ""

    if (game[0].typeEdit == "matching") {
        answer = object.matching.linkWith.toString()
        colType = object.matching.column
    }


    animatedClass = ""
    if (game[0].typeEdit != "fillBox") {
        animatedClass = animationCss[getRandomInt(0, animationCss.length - 1)]



    }

if(typeof strImage=="undefined"){
        strImage=""
    }
    str = '<div sound="' + soundURL + '"  answer="' + answer + '" isConnect="false"  colType="' + colType + '" onclick="" trueAndFalse="' + object.trueOrFalse + '" flagTrueORfalse="' + object.setAsTrue + '" name="' + object.name + '" text="' + object.text + '" class="elementsObject droppable elementResizable ' + animatedClass + '"  srcimage="' + object.name + '" id="' + object.id + '" idElemnt="' + object.id + '">' +
        strImage +
        textElment +

        //rezie +
        '</div>'

console.log(oldSize)
   var newCord=resizeCordinate(object.left,object.top,oldSize,{width:$(".gameContent").width(),height:$(".gameContent").height()})
   var newSize=resizeCordinate(object.width,object.height,oldSize,{width:$(".gameContent").width(),height:$(".gameContent").height()})
    console.log(newSize)

    $(str).appendTo('.gameContent')
        .css({
            width: object.width + "%",
            height: object.height + "%",
            top: object.top + "%",
            left:object.left+ "%",
            position: 'absolute',
            'z-index': object.zIndex,
            opacity: object.opacity
        })

        .click(function (event) {
            // event.preventDefault()
            // event.preventDefault()
           let src="../../../games/" + config.id + "/all/"+soundURL
            soundSpeachWordCorrect(src)

            if (game.typeEdit == "TrueAndFalse") {
                return
            }


            checkAnswer(this, event)

        })


    if (game[0].typeEdit == "correctChoose" || game[0].typeEdit == "putCircle") {


        $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer)

    } else if (game[0].typeEdit == "TrueAndFalse") {

        setDroppable_trueFalse(object.id)

        $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer)

    } else {
        $('#score span').html(countCorrectAnswersByUser + " / " + qustionSoundArray.length)

    }


    isDrag = game[0].subType
    if (game[0].typeEdit == "matching" && isDrag == "drag") {


        if (colType == "top") {
            setDraggable_Matching(object.id)
        } else if (colType == "bottom") {
            if (object.opacity == 1) {
                $("#" + object.id).css({
                    opacity:1
                })
            } else {
                $("#" + object.id).css({
                    opacity: object.opacity
                })
            }
            setDroppable_Matching(object.id)
        }

        // $("#"+object.id).css({
        //     filter:"drop-shadow(rgb(0, 0, 0) 6px 7px 8px)"
        // })


    }

    if (game[0].typeEdit == "fillBox") {
        setup_TextBox(object)

    }


    if ($("#gameContent").width() < $("#gameContent").height()) {
        // $(".allElem").css({"height": "auto"});
    }


}

function resizeCordinate(old_x,old_y,oldSize,newSize){

    newX=eval(old_x*(newSize.width/oldSize.width))
    newY=eval(old_y*(newSize.height/oldSize.height))



    return {x:newX,y:newY}
}
// (function ($) {
//     $.fn.hideKeyboard = function () {
//         var inputs = this.filter("input").attr('readonly', 'readonly'); // Force keyboard to hide on input field.
//         var textareas = this.filter("textarea").attr('disabled', 'true'); // Force keyboard to hide on textarea field.
//         setTimeout(function () {
//             inputs.blur().removeAttr('readonly');  //actually close the keyboard and remove attributes
//             textareas.blur().removeAttr('disabled');
//         }, 100);
//         return this;
//     };
// }(jQuery));


function makeshiffle(spArray) {
    spArray.forEach(function (val, index) {
        spArray[index] = val.shuffle()

    })

    return spArray
}

String.prototype.shuffle = function () {
    var a = this.split(" "),
        n = a.length;



    for (var i = n - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var tmp = a[i];
        a[i] = a[j];
        a[j] = tmp;
    }

        return a.join(" ");


}

function shuffleArray(a) {
    for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
    }
    return a;
}

String.prototype.replaceAll = function(str1, str2, ignore)
{
    return this.replace(new RegExp(str1.replace(/([\/\,\!\\\^\$\{\}\[\]\(\)\.\*\+\?\|\<\>\-\&])/g,"\\$&"),(ignore?"gi":"g")),(typeof(str2)=="string")?str2.replace(/\$/g,"$$$$"):str2);
}
function setup_TextBox(object) {
    if($("#textBox" + object.id).length==0) {

return
    }
    $('#CtextBox' + object.id).click(function (event) {

        event.preventDefault()
        event.stopPropagation()
        $("#textBox" + object.id).val("")

        $("#textBox" + object.id).getkeyboard()
        return false;
    });


    var spArray = []
    var layout = object.fillBoxAnswer
    if (object.fillBoxAnswer != "" && typeof layout != "undefined") {
        // spArray = layout.split('\n');
        /*if(game[0].fillType=="0"){
            spArray = layout.split('\n');
        }else if(game[0].fillType=="1"){
            spArray = layout.split('\n');
            console.log("===OZ===="+spArray)
        }*/

        spArray = layout.split('\n');


        if(game[0].allFillElemRandom==true){
            var spArray2= makeshiffle(spArray)

        }else {
            var spArray2= spArray;

        }
        console.log("spArray2======"+spArray2);
        console.log("spArray2======"+spArray2.length);

    }


    // spArray.push('{a}')


    $("#textBox" + object.id).mousedown(function () {
        console.log(this)
        $("#textBox" + object.id).val("")
    })


    document.getElementById("textBox" + object.id).ontouchstart = function () {
        $("#textBox" + object.id).val("")
    }

// for(var i=0;spArray2.length)

    spArray2[0] = spArray2[0].replaceAll("(", "&lpar;");
    spArray2[0] = spArray2[0].replaceAll(")", "&rpar;");


    // alert(spArray2[0])
    $("#textBox" + object.id)
        .css({
            // fontSize: object.textBoxConfig.style.size + "px",
            color: object.textBoxConfig.style.color

        }).click(function () {

    })
        .keyboard({
            layout: 'custom',
            lockInput: true,
            customLayout: {
                'normal': spArray2,
                usePreview: true, // disabled for contenteditable
                autoAccept: true,
                userClosed: true,
                acceptValid : true,
                autoAcceptOnValid:true

            },

            // validate : function(keyboard, value, isClosing){
            //     keyboard.close()
            // },

            // example callback function

            beforeClose   : function(e, keyboard, el, accepted) {

            },

            visible:function() {
                // setTimeout(function () {
                    if (game[0].allFillElemDirection == true) {
                        $(".ui-keyboard div").css("direction", "ltr");

                    } else {
                        $(".ui-keyboard div").css("direction", "rtl");
                    }



                // }, 5)
            }
            ,

            initialized: function (e, keyboard, el) {


            },
            accepted: function (e, keyboard, el) {

                value=$("#textBox" + object.id).attr("valuee")
                el.value=el.value.replaceAll("&lpar;", "(");
                el.value=el.value.replaceAll("&rpar;", ")");
                // alert(value+" - "+el.value)
                if(game[0].addBackgroundFill=="0"){
                    $("#textBox" + object.id).parent().parent().removeClass("selected");
                }else if(game[0].addBackgroundFill=="1") {
                    $("#textBox" + object.id).parent().parent().addClass("selected");
                }
                if(value==el.value){

                    countCorrectAnswersByUser++;
                    $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer);

                    if (countCorrectAnswersByUser >= countOfcorrectAnswer) {
                        per = Math.round((countCorrectAnswersByUser / (countCorrectAnswersByUser + countOfcorrectAnswer)) * (100 / 1));
                        $(".elementsObject").css("pointer-events", "none")

                        let src="../../../games/" + config.id + "/all/"+object.sound;
                        soundSpeachWordCorrect(src)

                        $("#true" + object.id ).show().addClass("flash");
                        setTimeout(function () {
                            win()
                        }, 2000)
                    } else {
                        per = Math.round((countCorrectAnswersByUser / (countCorrectAnswersByUser + countOfcorrectAnswer)) * (100 / 1));
                        $("#textBox" + object.id).css({"pointer-events":"none"});
                        let src="../../../games/" + config.id + "/all/"+object.sound;
                        soundSpeachWordCorrect(src)
                        setTimeout(function () {
                            correctAnswer()
                        }, 2000);

                        // animiteTrue("true"+object.id);
                        $("#true" + object.id ).show().addClass("flash");

                    }
                    obj=$("#textBox" + object.id).parent();

                    obj.css({"pointer-events":"none"})

                }else{

                    $("#textBox" + object.id).css({ });
                  //  alert('The content "' + el.value + '" was accepted!');

                    $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer);
                    failAnswerCounter++;

                    tryAgain()
                }
            }
        })
        .addTyping();



    setTimeout(function () {
        if(game[0].allFillElemDirection==true){
            $(".ui-keyboard div").css("direction","ltr");

        }else {
            $(".ui-keyboard div").css("direction","rtl");
        }
    },500)





}


function checkAnswer(object) {


}


function setDraggable_Matching(id) {


    $("#" + id).draggable({
        revert: "valid", helper: "clone",
        cursor: "move",

        start: function (event, ui) {
            $(this).css("z-index", "99999999999");
            let src="../../../games/" + config.id + "/all/"+$(this).attr("sound");
            soundEffect(src);
        }

    });


}


function setDroppable_Matching(id) {

    $("#" + id).droppable({

        drop: function (event, ui) {
            event.stopPropagation()
            event.preventDefault()


            self = this
            targetID = ($(this).attr("answer"))


            sourceID = (ui.helper.attr("idElemnt"))

            answerCount = $("#" + sourceID).attr("answer").split(",")


            if (answerCount.length == 1) {

                if (game[0].typeEdit == "matching") {

                    ui.helper.remove()


                    checkDropMatching(ui, targetID, sourceID, self)
                    if (targetID == sourceID) {

                        $(this).css({
                            opacity: 1
                        })

                        $("#" + sourceID).draggable('disable')
                        $("#" + sourceID).css({
                            "pointer-events": "none"
                        })
                        // $(this).css({
                        //     "pointer-events": "none"
                        // })
                        $(this).droppable('disable')
                    }

                }
            } else {


                ui.helper.remove()

                //more than one answer
                targetID = ($(this).attr("id"))

                if (answerCount.includes(targetID)) {
                    $(this).css({
                        opacity: 1
                    })

                    $("#" + targetID).css({
                        "pointer-events": "none"
                    })

                    // $(this).css({
                    //     "pointer-events": "none"
                    // })
                    $(this).droppable('disable')
                    checkDropMatching(ui, targetID, targetID, self)
                } else {

                    checkDropMatching(ui, "1", targetID, self) // set 1 to give false
                }
            }
        },
        over: function (event, ui) {
            event.stopPropagation()
            event.preventDefault()
            // $(this).css('z-index', 0);
            // ui.helper.css('z-index', -1);
        }
    })
}

function checkDropMatching(ui, targetID, sourceID, objectSelf) {

    if (targetID == sourceID) {


        $("#" + sourceID).find("img").addClass('rotate-x')

        sourceSrc = ui.draggable.find("img").attr("src");


        if (game[0].isdragReplace) {


            if ($(objectSelf).attr("srcimage") == "" || typeof $(objectSelf).attr("srcimage") == "undefined") {

                strImage = '<img   class="allElem ' + ' ' + '" src="' + sourceSrc + '"  style="">'

                $(strImage).appendTo(objectSelf);
                $(objectSelf).droppable("disable");

            } else {

                objectelem = $(objectSelf).find("img")
                objectelem.attr("src", sourceSrc);
                $(objectSelf).droppable("disable");
            }
        }

        animiteTrue(sourceID)

        countCorrectAnswersByUser++

        $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer);

        if (countCorrectAnswersByUser >= countOfcorrectAnswer) {
            per = Math.round((countCorrectAnswersByUser / (countCorrectAnswersByUser + failAnswerCounter)) * (100 / 1));
            // per = Math.round((countCorrectAnswersByUser / (countCorrectAnswersByUser + countOfcorrectAnswer)) * (100 / 1));
            $(".elementsObject").css("pointer-events", "none")
            console.log("countCorrectAnswersByUser<<<>>>>>"+countCorrectAnswersByUser)
            console.log("failAnswerCounter<<<>>>>>"+failAnswerCounter)
            setTimeout(function () {
                win()
            }, 1000)
        } else {
            per = Math.round((countCorrectAnswersByUser / (countCorrectAnswersByUser + failAnswerCounter)) * (100 / 1));
            // per = Math.round((countCorrectAnswersByUser / (countCorrectAnswersByUser + countOfcorrectAnswer)) * (100 / 1));
            correctAnswer()
        }

    }

    else {


        $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer)
        failAnswerCounter++

        tryAgain()
    }

}


function setDroppable_trueFalse(id) {

    $("#" + id).droppable({

        drop: function (event, ui) {

            if (game[0].typeEdit == "TrueAndFalse") {
                checkAnswerTrueAndFalse(this, ui.draggable, event)

            }

        },
        over: function (event, ui) {

            $(this).css('z-index', 0);
            ui.helper.css('z-index', -1);
        }
    })
}


function animiteTrue(sourceID) {
    var path = '../all/done.json';
    //
    // var myNode = $("#"+sourceID).children(".textBoxContainer");
    // var str = $(myNode).attr("id");
    // var res = str.substring(0, 8);
    // var ss='CtextBox';
    $(".trueImage").fadeIn();
    setTimeout(function () {
        $(".trueImage").fadeOut();
    },500)
    // if(res==ss){
    //     $(".trueIcon").css("left","23%");
    //     var animation = bodymovin.loadAnimation({
    //         container: document.getElementById(sourceID), // Required
    //         path: path,
    //         renderer: 'svg/canvas/html', // Required
    //         loop: false, // Optional
    //         autoplay: true, // Optional
    //         name: "checked", // Name for future reference. Optional.
    //         end: function (data) {
    //
    //         }
    //
    //     });
    //
    // }else {
    //     var animation = bodymovin.loadAnimation({
    //         container: document.getElementById(sourceID), // Required
    //
    //         path: path,
    //         renderer: 'svg/canvas/html', // Required
    //         loop: false, // Optional
    //         autoplay: true, // Optional
    //         name: "checked", // Name for future reference. Optional.
    //         end: function (data) {
    //
    //         }
    //
    //
    //
    //     })
    // }


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

    }).appendTo("body");

    $(".soundSpeach").prop("loop", false);
    $(".soundSpeach")[0].play()

}
function soundSpeachWordCorrect(src) {

    if ($('.soundSpeachWordCorrect').length)
        $('.soundSpeachWordCorrect').remove();


    $("<audio class='soundSpeachWordCorrect'></audio>").attr({
        'src': src,

    }).appendTo("body");

    $(".soundSpeachWordCorrect").prop("loop", false);
    $(".soundSpeachWordCorrect")[0].play()

}


function soundEffectBG(src) {

    if ($('.bgsound').length)
        $('.bgsound').remove();


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

// animationCss = []


function preloadimages(arr) {
    var newimages = [], loadedimages = 0
    var arr = (typeof arr != "object") ? [arr] : arr

    function imageloadpost() {
        loadedimages++
        if (loadedimages == arr.length) {
            //alert("All images have loaded (or died trying)!")
            $(".loader").fadeOut('slow')
            //   DrawObjects()
            //  playSoundbg("sound/bg.mp3")
            changeBackground("../../../games/" + config.id + "/all/" + "images/bg.png?" + Math.random())

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


function onSoundEnd() {
    // alert()
}
var duration;
function playSoundQustion(src, id, image, text) {

    if ($('.playSoundQustion').length)
        $('.playSoundQustion').remove();
    src = "../../../games/" + config.id + "/all/" + src;
    console.log(src)
    if (game[0].typeEdit == "WithSound" || game[0].typeEdit == "withSound") {

        // $("<audio  idAttr='" + id + "' image='" + image + "' text='" + text + "' class='playSoundQustion'></audio>").attr({
        //     'src': src,
        //
        // }).appendTo("body");
        //

        var sound      = document.createElement('audio');
        sound.id       = id;
        sound.src      = src;
        sound.type     = 'audio/mpeg';
        sound.className='playSoundQustion'

        document.body.appendChild(sound);
        $(sound).attr("text",text)
        $(sound).attr("image",image)
        $(sound).attr("idAttr",id)

        sound.play()
        $(".playSoundQustion").on("canplay", function () {
            duration=this.duration*1000
            console.log("duration<<<>>>"+duration);
        });
        // console.log("duration<<<>>>"+duration)
        // sound.addEventListener("ended",function() {
        //     onSoundEnd()
        // });
        //   document.getElementById(id).play();
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
        per=Math.round((correctCounterAnswer/(correctCounterAnswer+failAnswerCounter))* (100/1))

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


function checkAnswer(object, dropElement, event) {
    // event.preventDefault()
    // event.preventDefault()
    // $('.allElem').css({
    //     'pointer-events': 'none',
    //
    // });


    // if (game[0].typeEdit == "TrueAndFalse") {
    //     return
    //
    // }
    idImage = object.id;
    idSound = $(".playSoundQustion").attr('idAttr');
    text = $(".playSoundQustion").attr('text');
    image = $(object).attr('name');
    flagCheck = $(object).attr('flagTrueORfalse');
    trueAndFalse = $(object).attr('trueAndFalse');

    if (game[0].typeEdit == "WithSound" || game[0].typeEdit == "withSound" || game[0].typeEdit == "justText") {

        if (idSound == idImage) {
            qustionIndex++
            correctCounterAnswer++;
            correctCounter++;
            countCorrectAnswersByUser++
            correctAnswer()
            // $(object).hide("fast")
            $(object).css("pointer-events","none");
            $('.allElem').css({
                'pointer-events': 'auto',

            });
            $(object).find(".trueFalse").find("img").attr("src","../all/images/correct/correct.png").fadeIn();
            setTimeout(function () {
                $(object).find(".trueFalse").find("img").fadeOut();
            },2000)
            $('#score span').html(countCorrectAnswersByUser + " / " + qustionSoundArray.length)

            setTimeout(function () {

                getQustion()
            }, duration)


        }
        else {

            $(object).find(".trueFalse").find("img").attr("src","../all/images/correct/false.png").fadeIn();
            setTimeout(function () {
                $(object).find(".trueFalse").find("img").fadeOut();
            },2000)

            failAnswerCounter++
            // scorm.failAnswers = scorm.failAnswers + 1
            $('#scoreFail span').html(failAnswerCounter)
            if (failAnswerCounter >= parseInt(game[0].noTries)) {
                if ($(".hintContainerWin").length) $(".hintContainerWin").remove()
            }
            if ($(".hintContainer").length) $(".hintContainer").remove()
            // str = '<div class="hintContainer"><div class="hint" >' +
            //     '<div class="line-top"></div>' +
            //     '<label class="checkAnswerLabel">الإجابة الصحيحة هي :</label>' +
            //     '<div class="imgShapes-container">' +
            //     '<img src="images/' + qustionSoundArray[qustionIndex].imageSrc + '">' +
            //     '</div>' +
            //     '<label class="labelName">' + text + '</label>' +
            //     '<img class="imgShapes wrong" src="images/wrong-image.png">' +
            //     '<a class="closeImg" onclick="closeBox()"><i></i></a>' +
            //
            //     '</div>' +
            //     '</div>'
            //
            // // $(str).appendTo("#gameContainer")

            if (failAnswerCounter >= parseInt(game[0].noTries)) {
                attempNumbersCheck()
                return
            }
            setTimeout(function () {
                if (game[0].typeEdit == "WithSound" || game[0].typeEdit == "withSound") {
                    $(".playSoundQustion1").show()
                    $(".playSoundQustion1").click()
                }
            }, 2000)
            tryAgain()
        }
    } else if (game[0].typeEdit == "correctChoose" || game[0].typeEdit == "putCircle") {


        if (game[0].typeEdit == "putCircle") {

            $(object).css({
                'pointer-events': 'none',

            });

        }

        if (flagCheck == "true") {
            if(game[0].typeEdit == "correctChoose"){
                $(object).find(".trueFalse").find("img").attr("src","../all/images/correct/correct.png").fadeIn();
                setTimeout(function () {
                    $(object).find(".trueFalse").find("img").fadeOut();
                },2000)
            }

            $(object).css({
                'pointer-events': 'none',

            });

            countCorrectAnswersByUser++
            $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer)

            if (game[0].typeEdit == "putCircle") {

                var putCircle = new CircleAnimate(object, true);
                putCircle.animate(0)
            }

            if (countCorrectAnswersByUser >= countOfcorrectAnswer) {
                $(".elementsObject").css("pointer-events", "none")
                per = Math.round((countCorrectAnswersByUser / (countCorrectAnswersByUser + failAnswerCounter)) * (100 / 1));

                // per = Math.round((countCorrectAnswersByUser / (countCorrectAnswersByUser + countOfcorrectAnswer)) * (100 / 1));


                setTimeout(function () {
                    win()
                }, 4000)
            } else {
                per = Math.round((countCorrectAnswersByUser / (countCorrectAnswersByUser + failAnswerCounter)) * (100 / 1));
                // per = Math.round((countCorrectAnswersByUser / (countCorrectAnswersByUser + countOfcorrectAnswer)) * (100 / 1));
                $(object).attr('flagTrueORfalse', "false");
                let src="../../../games/" + config.id + "/all/"+$(object).attr("sound")
                soundSpeachWordCorrect(src)
                setTimeout(function () {
                    correctAnswer()
                }, 2000)

            }
        } else {
            if(game[0].typeEdit == "correctChoose"){
                $(object).find(".trueFalse").find("img").attr("src","../all/images/correct/false.png").fadeIn();
                setTimeout(function () {
                    $(object).find(".trueFalse").find("img").fadeOut();
                },1000)
            }
            $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer)

            if (game[0].typeEdit == "putCircle") {
                var putCircle = new CircleAnimate(object, false);
                putCircle.animate(0)
            }
            failAnswerCounter++

            tryAgain()
        }


    }

    else {

    }


}


function checkAnswerTrueAndFalse(object, dropElement, event) {


    isAnswered=$(object).attr("isAnswered")
    if(isAnswered=="true"){

        return
    }
    if (game[0].typeEdit == "TrueAndFalse") {

        flagDroped = $(dropElement).attr("flag")

        trueAndFalse = $(object).attr('trueAndFalse');

        if (trueAndFalse == flagDroped) {


            if (trueAndFalse == "true") {
                $(object).append("<img class='droppedimage' flag='true' class='' src='../all/images/correct-2/correcttag.svg'>")
            } else if (trueAndFalse = "false") {
                $(object).append("<img class='droppedimage' flag='true' class='' src='../all/images/correct-2/wrongtag.svg'>")

            }
            // if (trueAndFalse == "true") {
            //     $(object).append("<img class='droppedimage' flag='true' class='' src='../all/images/correct/correct.svg'>")
            // } else if (trueAndFalse = "false") {
            //     $(object).append("<img class='droppedimage' flag='true' class='' src='../all/images/correct/false.svg'>")
            //
            // }

            countCorrectAnswersByUser++
            $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer)

            if (countCorrectAnswersByUser >= countOfcorrectAnswer) {
                per = Math.round((countCorrectAnswersByUser / (countCorrectAnswersByUser + failAnswerCounter)) * (100 / 1));
                $(".elementsObject").css("pointer-events", "none");
                $(".trueAndFalseContainer img").css("pointer-events","none");
                setTimeout(function () {
                    win()
                }, 2000)
            } else {
                per = Math.round((countCorrectAnswersByUser / (countCorrectAnswersByUser + failAnswerCounter)) * (100 / 1));
                $(object).css("pointer-events", "none")
                setTimeout(function () {
                    $(object).attr("isAnswered", "true")
                }, 1000)
                $(object).attr('flagTrueORfalse', "false");
                correctAnswer()
            }
            // if (countCorrectAnswersByUser >= countOfcorrectAnswer) {
            //     per = Math.round((countCorrectAnswersByUser / (countCorrectAnswersByUser + countOfcorrectAnswer)) * (100 / 1));
            //     $(".elementsObject").css("pointer-events", "none");
            //     $(".trueAndFalseContainer img").css("pointer-events","none");
            //     setTimeout(function () {
            //         win()
            //     }, 2000)
            // } else {
            //     per = Math.round((countCorrectAnswersByUser / (countCorrectAnswersByUser + countOfcorrectAnswer)) * (100 / 1));
            //     $(object).css("pointer-events", "none")
            //     setTimeout(function () {
            //         $(object).attr("isAnswered", "true")
            //     }, 1000)
            //     $(object).attr('flagTrueORfalse', "false");
            //     correctAnswer()
            // }

        }
        else {

            $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer)
            failAnswerCounter++

            tryAgain()
        }
    }
}

function closeBox() {
    soundEffect("sound/fadeOut.mp3")
    if (game[0].typeEdit == "WithSound" || game[0].typeEdit == "withSound" || game[0].typeEdit == "justText") {
        getQustion()
    }

    else if (game[0].typeEdit == "correctChoose" || game[0].typeEdit == "putCircle") {
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


    return (qustionIndex >= length)
}

function win() {
    //scorm
    clearInterval(SetTimerScorm);
    SetTimerScorm = null;
    Result = 'unknown';
    accu = accuracy()
    $(".bgsound").remove()

    if (langStory == "ar") {
        soundEffect("sound/win.mp3")

        soundSpeach("sound/good.mp3")
    } else {
        soundEffect("sound/win.mp3")
    }

    if ($(".hintContainerWin").length) $(".hintContainerWin").remove();
    if(!isLMS){
        var gametries=game[0].noTries
        if (typeof (parent.bookid) == "undefined") {
            str = '<div class="hintContainerWin final"><div class="hintWin final" >' +
                '<label class="labelWin" >' + finalMessage + '</label><br>' +
                // '<span class="result-text"></span>' +
                // '<label class="rate-container" > <span>' + accu + '%</span></label>' +
                '<div class="imgShapes"></div>' +
                '<a class="relodeImg playAgain" onclick="again()"><i></i></a>' +
                '</div>' +
                '</div>';
            $(str).appendTo("#gameContainer");
            messagStar(game[0].noTries);
            for (var x = 0; x < failAnswerCounter; x++) {
                $(".messageStar:nth-child(" + (x + 1) + ")").addClass("startFail");
            }
        } else if (langStory == "ar") {
                window.parent.style = document.createElement('style');
                window.parent.style.type = 'text/css';
                window.parent.style.innerHTML = '.cssClass {display: inline-block; overflow: hidden; width: 10.61%; height: 100%; background-image: url(https://www.manhal.com/platform/click_map/viewer/all/images/star.svg); background-repeat: no-repeat; background-position: center; background-size: 88% 100%; z-index: 99;} ' +
                    '.cssClass1 {background-image: url(https://www.manhal.com/platform/click_map/viewer/all/images/star-f.svg);}' +
                    '.cssClass2{display: block; width: 100%; overflow: hidden; height: 109.5%; position: absolute; top: 1.4%;z-index: 99;}';
                window.parent.document.getElementsByTagName('head')[0].appendChild(window.parent.style);
                str = '<div class="cssClass2">';
                if(gametries>4){
                    for (_i = 0, _len = Number(4 - failAnswerCounter); _i < _len; _i++) {
                        str += "<div class='cssClass str" + (_i + 1) + "'></div>"
                    }
                }else {
                    for (_i = 0, _len = Number(game[0].noTries - failAnswerCounter); _i < _len; _i++) {
                        str += "<div class='cssClass str" + (_i + 1) + "'></div>"
                    }
                }


                messagStar(game[0].noTries);
                for (var x = 0; x < failAnswerCounter; x++) {
                    str += "<div class='cssClass cssClass1 str" + (_i + 1) + "'></div>";
                }
                str += '</div>'

                // window.parent.showBookMsg("أحسنت",str+"<span style='display: block; font-size: 2vmin; padding: 6% 0;'>نتيجتك هي</span ><span style='font-size: 2vmin;font-weight: bold;'>%"+accu+"</span>",window.parent.$('iframe[src="'+window.location.href+'"]').closest(".element").attr("id"));
                window.parent.showBookMsg(finalMessage, "<span style='display: block;padding: 5% 0 3% 0'>" + str + "</span>", window.parent.$('iframe[src="' + window.location.href + '"]').closest(".element").attr("id"));

        } else if (langStory == "en"){
            window.parent.style = document.createElement('style');
            window.parent.style.type = 'text/css';
            window.parent.style.innerHTML = '.cssClass {display: inline-block; overflow: hidden; width: 10.61%; height: 100%; background-image: url(https://www.manhal.com/platform/click_map/viewer/all/images/star.svg); background-repeat: no-repeat; background-position: center; background-size: 88% 100%; z-index: 99;} ' +
                '.cssClass1 {background-image: url(https://www.manhal.com/platform/click_map/viewer/all/images/star-f.svg);}' +
                '.cssClass2{display: block; width: 100%; overflow: hidden; height: 109.5%; position: absolute; top: 1.4%;z-index: 99;}';
            window.parent.document.getElementsByTagName('head')[0].appendChild(window.parent.style);
            str = '<div class="cssClass2">';
            if(gametries>4){
                for (_i = 0, _len = Number(4 - failAnswerCounter); _i < _len; _i++) {
                    str += "<div class='cssClass str" + (_i + 1) + "'></div>"
                }
            }else {
                for (_i = 0, _len = Number(game[0].noTries - failAnswerCounter); _i < _len; _i++) {
                    str += "<div class='cssClass str" + (_i + 1) + "'></div>"
                }
            }


            messagStar(game[0].noTries);
            for (var x = 0; x < failAnswerCounter; x++) {
                str += "<div class='cssClass cssClass1 str" + (_i + 1) + "'></div>";
            }
            str += '</div>';
            console.log("str<<<<<>>>>>>"+str);
                // window.parent.showBookMsg("Excellent",str+"<span style='display: block; font-size: 2vmin; padding: 6% 0;'>The Result</span ><span style='font-size: 2vmin;font-weight: bold;'>"+accu+"%</span>",window.parent.$('iframe[src="'+window.location.href+'"]').closest(".element").attr("id"));
                window.parent.showBookMsg(finalMessage, "<span style='display: block;padding: 5% 0 3% 0'>" + str + "</span>", window.parent.$('iframe[src="' + window.location.href + '"]').closest(".element").attr("id"));
        }

    }else {
        str = '<div class="hintContainerWin final"><div class="hintWin final" >' +
            '<label class="labelWin" >' + finalMessage + '</label><br>' +
            // '<span class="result-text"></span>' +
            // '<label class="rate-container" > <span>' + accu + '%</span></label>' +
            '<div class="imgShapes"></div>' +
            '<a class="relodeImg playAgain" onclick="again()"><i></i></a>' +
            '</div>' +
            '</div>';
        $(str).appendTo("#gameContainer");
        messagStar(game[0].noTries);
        for (var x = 0; x < failAnswerCounter; x++) {
            $(".messageStar:nth-child(" + (x + 1) + ")").addClass("startFail");
        }
    }
    console.log("per<<<>>>"+per)
    if (LMSStatus) {

        API.SetValue("cmi.score.raw", per.toFixed(2));//return text true or false | to set student mark
        API.SetValue("cmi.completion_status", "completed");//when complete game
        API.SetValue("cmi.success_status", Result);//when complete game set value to one of ("passed","failed","unknown")
        API.SetValue("cmi.session_time", TimeScorm);//to set Amount of seconds that the learner has spent

        API.Commit("");//return text true or false | to save student mark to DB
    }
    TimeScorm = 0;
}

function messagStar(gameTrie) {
    $(".messageStar").remove()
    if(Number(gameTrie)>4){
        for (_i = 0, _len = 4; _i < _len; _i++) {
            $("<div class='messageStar str" + (_i + 1) + "'></div>").appendTo('.imgShapes')
        }
    }else {
        for (_i = 0, _len = Number(gameTrie); _i < _len; _i++) {
            $("<div class='messageStar str" + (_i + 1) + "'></div>").appendTo('.imgShapes')
        }
    }

}

function correctAnswer() {

    $('#score span').removeClass('flash animated').addClass('flash animated').one('webkitAnimationEnd' +
        ' mozAnimationEnd' +
        ' MSAnimationEnd' +
        ' oanimationend animationend', function () {
        $(this).removeClass('flash animated');
    });
    if (langStory == "ar") {
        soundEffect("sound/correct.mp3");
        // soundSpeach("sound/goodA.mp3")
    } else {
        soundEffect("sound/correct.mp3")
    }
    // scorm.correctAnswers = scorm.correctAnswers + 1
    // if ($(".hintContainerWin").length) $(".hintContainerWin").remove()
}




function tryAgain() {
    // event.preventDefault()
    // event.preventDefault()
    if (langStory == "ar") {
        soundEffect("sound/error.mp3")
        soundSpeach("sound/trySpeach.mp3");
    } else {
        soundEffect("sound/error.mp3")
    }

    // scorm.failAnswers = scorm.failAnswers + 1;
    $(".star:nth-child(" + failAnswerCounter + ")").addClass("star-f");
    if (failAnswerCounter >= parseInt(game[0].noTries)) {
        attempNumbersCheck()
        return
    }
    $('#scoreFail span').html(failAnswerCounter)
    if ($(".hintContainerWin").length) $(".hintContainerWin").remove()
    $('#scoreFail span').removeClass('flash animated').addClass('flash animated').one('webkitAnimationEnd' +
        ' mozAnimationEnd' +
        ' MSAnimationEnd' +
        ' oanimationend animationend', function () {
        $(this).removeClass('flash animated');
    });
}

function attempNumbersCheck() {
    accu = accuracy()
    if (failAnswerCounter >= parseInt(game[0].noTries)) {
        if(!isLMS){
            var gameTries=game[0].noTries;
            if (typeof (parent.bookid) == "undefined") {
                str = '<div class="hintContainerWin final">' +
                    '<div class="hintWin final animated bounce" >' +
                    // '<span class="result-text"></span>' +
                    '<label class="labelWin lose" >' + finalMessageEror + '</label>' +
                    // '<label class="rate-container" > <span>' + accu + '%</span></label>' +
                    '<div class="imgShapes"></div>' +
                    '<a class="relodeImg playAgain" onclick="again()"><i></i></a>' +

                    '</div>' +
                    '</div>'

                $(str).appendTo("#gameContainer");
                messagStar(game[0].noTries);
                for (var x = 0; x < failAnswerCounter; x++) {
                    $(".messageStar:nth-child(" + (x + 1) + ")").addClass("startFail");
                }

            } else if (langStory == "ar") {
                    window.parent.style = document.createElement('style');
                    window.parent.style.type = 'text/css';
                    window.parent.style.innerHTML = '.cssClass {display: inline-block; overflow: hidden; width: 10.61%; height: 100%; background-image: url(https://www.manhal.com/platform/click_map/viewer/all/images/star.svg); background-repeat: no-repeat; background-position: center; background-size: 88% 100%; z-index: 99;} ' +
                        '.cssClass1 {background-image: url(https://www.manhal.com/platform/click_map/viewer/all/images/star-f.svg);}' +
                        '.cssClass2{display: block; width: 100%; overflow: hidden; height: 109.5%; position: absolute; top: 1.4%;z-index: 99;}';
                    window.parent.document.getElementsByTagName('head')[0].appendChild(window.parent.style);
                    str = '<div class="cssClass2">';
                    if(gameTries>4){
                        if(failAnswerCounter>4){
                            failAnswerCounter=4;
                        }
                        for (_i = 0, _len = Number(4 - failAnswerCounter); _i < _len; _i++) {
                            str += "<div class='cssClass str" + (_i + 1) + "'></div>"
                        }
                    }else {
                        for (_i = 0, _len = Number(game[0].noTries - failAnswerCounter); _i < _len; _i++) {
                            str += "<div class='cssClass str" + (_i + 1) + "'></div>"
                        }
                    }


                    messagStar(game[0].noTries);
                if(failAnswerCounter>4){
                    failAnswerCounter=4;
                }
                    for (var x = 0; x < failAnswerCounter; x++) {
                        str += "<div class='cssClass cssClass1 str" + (_i + 1) + "'></div>";
                    }
                    str += '</div>'
                    // window.parent.showBookMsg("حاول مرة أخرى",str+"<span style='display: block; font-size: 2vmin; padding: 6% 0;''>نتيجتك هي</span ><span style='font-size: 2vmin;font-weight: bold;'>%"+accu+"</span>",window.parent.$('iframe[src="'+window.location.href+'"]').closest(".element").attr("id"));
                    window.parent.showBookMsg(finalMessageEror, "<span style='display: block;padding: 5% 0 3% 0'>" + str + "</span>", window.parent.$('iframe[src="' + window.location.href + '"]').closest(".element").attr("id"));

            } else {
                window.parent.style = document.createElement('style');
                window.parent.style.type = 'text/css';
                window.parent.style.innerHTML = '.cssClass {display: inline-block; overflow: hidden; width: 10.61%; height: 100%; background-image: url(https://www.manhal.com/platform/click_map/viewer/all/images/star.svg); background-repeat: no-repeat; background-position: center; background-size: 88% 100%; z-index: 99;} ' +
                    '.cssClass1 {background-image: url(https://www.manhal.com/platform/click_map/viewer/all/images/star-f.svg);}' +
                    '.cssClass2{display: block; width: 100%; overflow: hidden; height: 109.5%; position: absolute; top: 1.4%;z-index: 99;}';
                window.parent.document.getElementsByTagName('head')[0].appendChild(window.parent.style);
                str = '<div class="cssClass2">';
                if(gameTries>4){
                    if(failAnswerCounter>4){
                        failAnswerCounter=4;
                    }
                    for (_i = 0, _len = Number(4 - failAnswerCounter); _i < _len; _i++) {
                        str += "<div class='cssClass str" + (_i + 1) + "'></div>"
                    }
                }else {
                    for (_i = 0, _len = Number(game[0].noTries - failAnswerCounter); _i < _len; _i++) {
                        str += "<div class='cssClass str" + (_i + 1) + "'></div>"
                    }
                }


                messagStar(game[0].noTries);
                if(failAnswerCounter>4){
                    failAnswerCounter=4;
                }
                for (var x = 0; x < failAnswerCounter; x++) {
                    str += "<div class='cssClass cssClass1 str" + (_i + 1) + "'></div>";
                }
                str += '</div>'
                    // window.parent.showBookMsg("Try Again",str+"<span style='display: block; font-size: 2vmin; padding: 6% 0;''>The Result</span ><span style='font-size: 2vmin;font-weight: bold;'>"+accu+"%</span>",window.parent.$('iframe[src="'+window.location.href+'"]').closest(".element").attr("id"));
                    window.parent.showBookMsg(finalMessageEror, "<span style='display: block;padding: 5% 0 3% 0'>" + str + "</span>", window.parent.$('iframe[src="' + window.location.href + '"]').closest(".element").attr("id"));
            }
        }else {
            str = '<div class="hintContainerWin final">' +
                '<div class="hintWin final animated bounce" >' +
                // '<span class="result-text"></span>' +
                '<label class="labelWin lose" >' + finalMessageEror + '</label>' +
                // '<label class="rate-container" > <span>' + accu + '%</span></label>' +
                '<div class="imgShapes"></div>' +
                '<a class="relodeImg playAgain" onclick="again()"><i></i></a>' +

                '</div>' +
                '</div>'

            $(str).appendTo("#gameContainer");
            messagStar(game[0].noTries);
            for (var x = 0; x < failAnswerCounter; x++) {
                $(".messageStar:nth-child(" + (x + 1) + ")").addClass("startFail");
            }
        }


        return
    }
}


function again() {
    // event.preventDefault();
    // event.preventDefault();
    initGame();
}

function replyGame() {
    // window.event.preventDefault();
    // window.event.preventDefault();
    initGame();
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
    event.preventDefault()
    event.preventDefault()
    soundEffect("sound/help.mp3")
    id = $('#help').attr('currentObject')
    $('#' + id).addClass("animated flash").css({
        "box-shadow": "2px 2px 2px rgba(0,0,0,1)"
    });
    if (game[0].typeEdit == "correctChoose" || game[0].typeEdit == "putCircle") {
        $(".elementResizable[flagtrueorfalse='true']").first().css({
            "box-shadow": "0px 1px 2px rgba(0,0,0,1)"
        });
    }

    setTimeout(function () {
        $('#' + id).removeClass("animated flash").css({
            "box-shadow": "none"
        });


        if (game[0].typeEdit == "correctChoose" || game[0].typeEdit == "putCircle") {
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
    accuError = (((failAnswerCounter - game[0].noTries)) / game[0].noTries) * 100
    return Math.round(Math.abs(accuError, 2))
}


function noTriesME(gameTrie) {
    $(".star").remove()
    if(Number(gameTrie)>4){
        for (_i = 0, _len = 4; _i < _len; _i++) {
            $("<div class='star str" + (_i + 1) + "'></div>").appendTo('.inner-footer-right')
        }
    }else {
        for (_i = 0, _len = Number(gameTrie); _i < _len; _i++) {
            $("<div class='star str" + (_i + 1) + "'></div>").appendTo('.inner-footer-right')
        }
    }

}

function BookMessage() {
    if(!isLMS){
        if (per >= 50) {
            window.parent.showBookMsg("أحسنت", "<span style='display: block;font-size: 2vmin;'>نتيجتك هي</span ><span style='font-size: 2vmin;font-weight: bold;'>%" + per + "</span>", window.parent.$('iframe[src="' + window.location.href + '"]').closest(".element").attr("id"));
        } else {
            window.parent.showBookMsg("حاول مرة أخرى", "<span style='display: block;font-size: 2vmin;'>نتيجتك هي</span><span style='font-size: 2vmin;font-weight: bold;'>%" + per + "</span>", window.parent.$('iframe[src="' + window.location.href + '"]').closest(".element").attr("id"));
        }
    }

}

