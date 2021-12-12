var level = 3;
var activeLevel = 0;
var count = 0;

var correct=0;
var incorrect=0
$(window).on("resize", function () {




    resizeGame();

    reCalculatePoints()
    $('#level-container').css("width", ($('.work-area').width() + "px"));
    $(".level-inner-container").css("width", ($('.work-area').width() ));

});


function initGame(){
	 level = 3;
	 activeLevel = 0;
    levelNum=0
	 count = 0;
    $(".level-num span").html("1");
	levelIndexer=[]
	svgText = "";
	levelCounter = 0
	// SwiperArray = []


	$(".slidesLabel").html("")
	resizeGame();

	drawLevels()

	game.levelIndex = game.firstIndex
	$(".header-container label").html(game.levelTitle[game.levelIndex].title)
	$('#level-container').css("width", ($('.work-area').width() + "px"));
	$(".level-inner-container").css("width", ($('.work-area').width() ));


	for (var t = 0; t < game.level.length; t++) {
		shuffleDivs("#level-" + t + " .label-container");
	}


	$("#level-container").children(":first").show();
	$("#level-container-label"+game.firstIndex).show();

	resizeGame()
	reCalculatePoints()
	
	$(".instructions-container").fadeOut();
	resizeGameInner()
	
	
	$(".messageContainer").fadeOut("fast")
	scorm.failAnswers=0
	scorm.correctAnswers=0
	$(".wrong span").html(scorm.failAnswers)
	$(".correct span").html(scorm.correctAnswers)

	if(!game.option.labelJust){
		$(".poent,svg").show()
	}else{
		$(".poent,svg").hide()
	}
		
    $("#messageContainer").show()
	// timerStart({min: 1, sec: 30}, true);
}


function getNumberOflevel() {
    c = 0
    for (var t = 0; t < game.level.length; t++) {
        if (game.level[t] != "removed") {
            c++
        }

    }
    return c
}
levelIndexer=[];
tmpSrc=[];
for(var i=0;i<game[0].backgroundLevel.length;i++){
    tmpSrc.push({type: "image", url: "../../" + langStory + "/"+game[0].backgroundLevel[i].short});
}
tmpSrc.push({type: "image", url: "../all/images/label.svg"},{type: "image", url: "../all/images/sound-on.svg"},
            {type: "image", url: "../all/images/help.svg"},{type: "image", url: "../all/images/ans-correct.svg"},
            {type: "image", url: "../all/images/ans-wrong.svg"},{type: "image", url: "../all/images/timeout.svg"},
            {type: "image", url: "../all/images/timeout.svg"},{type: "image", url: "../all/images/messg-box.svg"},
            {type: "image", url: "../all/images/falid.svg"},{type: "image", url: "../all/images/win.svg"},
            {type: "image", url: "../all/images/win-boy.png"},);
console.log("tmpSrc<<<>>>"+tmpSrc);
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
        addFiles: tmpSrc,
        //     [
        //
        //     {type: "image", url: "../all/images/label.svg"},
        //     {type: "image", url: "../all/images/sound-on.svg"},
        //     {type: "image", url: "../all/images/help.svg"},
        //     {type: "image", url: "../all/images/ans-correct.svg"},
        //     {type: "image", url: "../all/images/ans-wrong.svg"},
        //     {type: "image", url: "../all/images/timeout.svg"},
        //     {type: "image", url: "../all/images/timeout.svg"},
        //     {type: "image", url: "../all/images/messg-box.svg"},
        //     {type: "image", url: "../all/images/falid.svg"},
        //     {type: "image", url: "../all/images/win.svg"},
        //     {type: "image", url: "../all/images/win-boy.png"},
        //     tmpSrc
        //     // {type:"audio",url:"sounds/ulna_r.mp3"},{type:"audio",url:"sounds/sort.mp3"}
        // ],
        splashFunction: function () {  //passing Splash Screen script to jPreLoader
            $('<div class="manhal-main-loader"><div class="loader-effect"><div class="checkmark draw"></div>' +
                '</div><div class="logo-loader"></div></div>').appendTo('#manhalpreOverlay');
            resizeGame();
            reCalculatePoints();
            resizeGameInner();
            // timerStart({min: 1, sec: 30}, true);

        },
        onLoading: function (per) {
         
         
	        // if (game.option.typeViewr == "undefined" || typeof game.option.typeViewr == "undefined" || game.option.typeViewr != "Number") {
		    //     game.option.typeViewr = "letter"
		    //     $(".instrucions-text").css({
			//         background: "url(images/instructions.png)",
			//         "background-size": "100% 100%"
		    //     })
		    //     $(".manhalpreOverlay").css({
			//         background: "url(images/instructions.png)",
			//         "background-size": "100% 100%"
		    //     })
		    //     $(".game-logo").css({
			//         background: "url(images/logo-game.png)",
			//         "background-size": "100% 100%"
		    //     })
            //
	        // } else {
		    //     $(".instrucions-text").css({
			//         background: "url(images/instructionsN.png)",
			//         "background-size": "100% 100%"
		    //     })
		    //     $(".manhalpreOverlay").css({
			//         background: "url(images/lodeer-bgN.png)",
			//         "background-size": "100% 100%"
		    //     })
		    //     $(".game-logo").css({
			//         background: "url(images/logo-gameN.png)",
			//         "background-size": "100% 100%"
		    //     })
	        // }
        },
    }, function () {

        // $(".game-logo").fadeIn();
        // $(".instructions-text-container").fadeIn();

        $("#manhalpreOverlay").fadeOut(0);
        if (game.option.noBackgrondSound) {
            playSoundbg()
        }


    });

    game = game[0]

    resizeGame();
setTimeout(function () {
    drawLevels()


    game.levelIndex = game.firstIndex
    $(".header-container label").html(game.levelTitle[game.levelIndex].title)
    $('#level-container').css("width", ($('.work-area').width() + "px"));
    $(".level-inner-container").css("width", ($('.work-area').width() ));


    for (var t = 0; t < game.level.length; t++) {
        shuffleDivs("#level-" + t + " .label-container");
    }


    $("#level-container").children(":first").show();
    $("#level-container-label"+game.firstIndex).show();




    $(".header-container").find("label").html();
    reCalculatePoints();
},2000)
    $(".play-btn").click(function () {

        $(".instructions-container").fadeOut();
        resizeGameInner()
        // timerStart({min: 1, sec: 30}, true);
	    
    });


    bgNotFountd = false
    $(".bgsound").prop('muted', true);
    $(".muteIcon").click(function () {
        if ($(".bgsound").prop('muted') || bgNotFountd) {
            $(".bgsound").prop('muted', false);
            $(this).find("img").attr('src', "../all/images/sound-on.svg?" + Math.random()); // changing icon for button
            bgNotFountd = false
        } else {
            $(".bgsound").prop('muted', true);
            $(this).find("img").attr('src', "../all/images/sound-off.svg?" + Math.random());
            bgNotFountd = true
        }
    });
    if (game.option.fillOff) {
        $(".poent").css({
            background: game.option.colorDots,
            width: game.option.dotSize + "vw",
            height: game.option.dotSize + "vw",
            border: "1px solid " + game.option.colorDots
        })
    } else {
        $(".poent").css({
            background: game.option.colorDots,
            width: game.option.dotSize + "vw",
            height: game.option.dotSize + "vw",
        })
    }

    resizeImageContainer()
    // if(!game.option.labelJust){
    //     $(".poent,svg").show()
    // }else{
    //     $(".poent,svg").hide()}

    if (game.font == "Cocon") {
        $(".lable-bg-drag span").css({
            "font-family": "Conv_Cocon",
            "font-size": "3.4vmin",
            "line-height":"2.4em"
        })
    }
    // if(game.colorFont !="white"){
    //     $(".LAbelText").css("color",game.colorFont);
    // }
    if(game.showHideBackground){
        $(".top-bg").fadeOut();
    }


    if (typeof game.css == "undefined" || game.css == "") {
        game.css = ""
    }


    var style = document.createElement('style');
    style.type = 'text/css';
    style.innerHTML = game.css;
    document.getElementsByTagName('head')[0].appendChild(style);
    setTimeout(function () {
        if(!game.option.labelJust){
            $(".poent,svg").show()
        }else{
            $(".poent,svg").hide()
        }
    },2000)
});
function shuffle(a) {
    for (let i = a.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [a[i], a[j]] = [a[j], a[i]];
    }
    return a;
}

// function getTextWidth(text, font) {
//     // re-use canvas object for better performance
//     var canvas = getTextWidth.canvas || (getTextWidth.canvas = document.createElement("canvas"));
//     var context = canvas.getContext("2d");
//     context.font = font;
//     var metrics = context.measureText(text);
//     return metrics.width;
// }

function randomePositionMatching(arrayObject) {
    var arrayPosition= []
    console.log("random")
    for (i = 0; i < arrayObject.length; i++) {

        if ( arrayObject[i] !== "removed" && arrayObject[i] !="undefined") {
            objectData = arrayObject[i].answer


            arrayPosition.push({
                empty: false,
                x: objectData.left,
                y: objectData.top,
                width: objectData.width,
                height: objectData.height,
                centerX: objectData.left + (objectData.width / 2),
                centerY: objectData.top + (objectData.height / 2),
            })
            console.log("objectDataLeft"+JSON.stringify(objectData) )
            // console.log("objectDataTop"+objectData.top)
        }
    }
    console.log("arrayPosition",arrayPosition)

    shuffle(arrayPosition);


    var count = 0
    for (j = 0; j < arrayObject.length; j++) {

        if (arrayObject[j] != "removed" && arrayObject[j] !="undefined") {
            objectData = arrayObject[j].answer
            objectData.left = arrayPosition[count].centerX - ((objectData.width / 2))
            objectData.top = arrayPosition[count].centerY - ((objectData.height / 2))
            count++
        }
        // console.log("objectDataTop"+objectData.width)
    }


}



svgText = "";
levelCounter = 0
function draw(arrayObject, divNum , layoutss) {
    if(game.isRandom){
        randomePositionMatching(arrayObject)
    }
    //$('.image-container span').remove();

    for (var i = 0; i < arrayObject.length; i++) {

        if (arrayObject[i] == "removed") {

        }
        else {
            if(game.empteBox){
                $("<div answer='" + arrayObject[i].word + "' class=' emptySelected lable-bg ' data-index='" + i + "' id='span-" + i + "-L" + divNum + "' style='top: " + arrayObject[i].top + "%" + ";left: " + arrayObject[i].left + "%" + ";'>" +
                    "<span class='LAbelText'   data-div='" + i + "'  answer='" + arrayObject[i].word + "' ></span><span class='dot'>................</span></div>")
                    .appendTo("#answerlayout-" + divNum).css({
                    width: arrayObject[i].width + "%",
                    height: arrayObject[i].height + "%",
                    position:"absolute",
                    // background:"white"
                });
            }else {
                $("<div answer='" + arrayObject[i].word + "' class='lable-bg ' data-index='" + i + "' id='span-" + i + "-L" + divNum + "' style='top: " + arrayObject[i].top + "%" + ";left: " + arrayObject[i].left + "%" + ";'>" +
                    "<span class='LAbelText'   data-div='" + i + "'  answer='" + arrayObject[i].word + "' ></span></div>")
                    .appendTo("#answerlayout-" + divNum).css({
                    width: arrayObject[i].width + "%",
                    height: arrayObject[i].height + "%",
                    position:"absolute",
                    // background:"white"
                });
            }


            //$("<div class='lable-bg hvr-bounce-in'><span>" + arrayObject[i].word + "</span></div>").appendTo("#level-" + divNum + " .label-container");
            if(arrayObject[i].answer.width == 0 || arrayObject[i].answer.width == undefined){
                if(game.empteBox2){
                    $("<div class='lable-bg-drag  noSwipingClass emptyDragItem' answer='" + arrayObject[i].word + "'><span" +
                        " class='' answer='" + arrayObject[i].word + "'>" + arrayObject[i].word + "</span></div>").appendTo("#level-" + divNum).css({
                        // width: arrayObject[i].answer.width + "%",
                        top: arrayObject[i].answer.top + "%",
                        left: arrayObject[i].answer.left + "%",
                        width:  "auto",
                        height: "5%",
                        display:"block",
                        "min-width":"15.235%",

                        position:"absolute",

                    })
                }else {
                    $("<div class='lable-bg-drag  noSwipingClass' answer='" + arrayObject[i].word + "'><span" +
                        " class='' answer='" + arrayObject[i].word + "'>" + arrayObject[i].word + "</span></div>").appendTo("#level-" + divNum).css({
                        // width: arrayObject[i].answer.width + "%",
                        top: arrayObject[i].answer.top + "%",
                        left: arrayObject[i].answer.left + "%",
                        width:  "auto",
                        height: "5%",
                        display:"block",
                        "min-width":"15.235%",

                        position:"absolute",

                    })
                }
            }else {
                if(game.empteBox2){
                    $("<div class='lable-bg-drag  noSwipingClass emptyDragItem' answer='" + arrayObject[i].word + "'><span" +
                        " class='' answer='" + arrayObject[i].word + "'>" + arrayObject[i].word + "</span></div>").appendTo("#level-" + divNum).css({
                        // width: arrayObject[i].answer.width + "%",
                        top: arrayObject[i].answer.top + "%",
                        left: arrayObject[i].answer.left + "%",
                        width:  arrayObject[i].answer.width + "%",
                        height: arrayObject[i].answer.height + "%",
                        display:"block",
                        position:"absolute",

                    })
                }else {
                    $("<div class='lable-bg-drag  noSwipingClass' answer='" + arrayObject[i].word + "'><span" +
                        " class='' answer='" + arrayObject[i].word + "'>" + arrayObject[i].word + "</span></div>").appendTo("#level-" + divNum).css({
                        // width: arrayObject[i].answer.width + "%",
                        top: arrayObject[i].answer.top + "%",
                        left: arrayObject[i].answer.left + "%",
                        width:  arrayObject[i].answer.width + "%",
                        height: arrayObject[i].answer.height + "%",
                        display:"block",

                        position:"absolute",

                    })

                }
            }


                // .css("background", "url('../all/images/drag-bg.svg') no-repeat center").css("background-size", "100% 100%")




            $("<div class='poent'  data-index='" + i + "' data-point='" + i + "' id='point-" + i + "-L" + divNum + "' >" +
                "</div>")
                .appendTo("#answerlayout-" + divNum).css({
                top: arrayObject[i].p.y + "%",
                left: arrayObject[i].p.x + "%"
            });
            ;


            svgText = '<svg class="svgGroup" xmlns="http://www.w3.org/2000/svg" version="1.1" height="' + $(".inner-container").height() + '" width="' + $(".inner-container").width() + '">';
            innerSvg = "";
            var parentPos = $(".inner-container").offset();
            var spanPos = $("#span-" + i + "-L" + divNum).offset();
            var pointPos = $("#point-" + i + "-L" + divNum).offset();

            pointWidth = parseInt($(".poent").outerWidth())

            objectPosition = {
                x1: (spanPos.left - parentPos.left),
                x2: (pointPos.left - parentPos.left) - pointWidth,
                y1: (spanPos.top - parentPos.top),
                y2: (pointPos.top - parentPos.top) - pointWidth
            };
            xx = "M" + objectPosition.x1 + " " + (objectPosition.y1) + " " + objectPosition.x2 + " " + (objectPosition.y2);
            innerSvg += '<path id="svg-' + i + "-L" + divNum + '" data-index="' + i + '" data-indexLevel="' + divNum + '" data-svg="' + i + '" d="' + xx + '" stroke="'+game.option.colorDots+'" stroke-width="1" fill="none" stroke-linecap="round"/>'
            svgText = svgText + innerSvg + "</svg>";
            $(svgText).appendTo("#answerlayout-" + divNum);


            // $(".label-container span").css("lineHeight", $(".label-container span").height() + "px");
            // $(".image-container span").css("lineHeight", $(".image-container span").height() + "px");
        }
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
    $('.lable-bg-drag').draggable({
        placeholder: 'ui-sortable-placeholder',
        containment: '.game-container',
        stack: '.answerlayout',
	    // snap: '.image-container .lable-bg',
	    // snapMode: 'corner',

	    cursor: "move",
        // cursorAt: {
		//     top: 0},

        helper: function () {
            var style = css($(this));
            var style1 = $(this).width();
            var style2 = $(this).height();
            console.log("style"+style)
            //debugger;
             return $($(this).clone()).addClass("clones noSwipingClass").css({
                 "width":(style1+2)+"px",
                 "height":style2+"px",
                 // "padding":"0 2%",
                 // "position":"absolute"
                 // "display":"block"

             }).appendTo(".game-container");

            // var nnnn=css($(".clones span"))
        },

        revert: true,
        start: function (event, ui) {
            // console.log("nnnn"+nnnn)
            // ui.helper.css('margin', '0 !important');
            soundEffect("../all/sound/move.mp3");
        },
        drag: function (event, ui) {

            object = $(this);
            words = $(this).attr("answer");
            console.log(words)
        }

    });


    $('.lable-bg').droppable({
        accept: '.lable-bg-drag',
	    cursor: 'move',

        drop: function (event, ui) {

            if ($(this).attr("answer").replace(/&nbsp;/gi,' ') === words) {

                //correct answer
                scorm.correctAnswers++
                $(".correct span").html(scorm.correctAnswers)
                $(ui.helper).remove();
                // refreshSwipers()
                count++;
                if(langStory == "ar"){
                    soundEffect("../ar/sound/correct2.mp3");
                }else{
                    soundEffect("../en/sound/correct.mp3");
                }
                if(game.empteBox){
                    $(this).fadeOut(0)
                }
                $(this).find(".LAbelText").html($(object).text());
                $(this).find(".dot").fadeOut();
                $(this).parent(".lable-bg").addClass("activ")
                $(object).addClass("correct-answer");

                labelAnswerLength = $("#level-" + game.levelIndex).find(".correct-answer").length


                //chack if complete current level
                if ($("#answerlayout-" + game.levelIndex).find(".lable-bg").length <= labelAnswerLength) {
                    activeLevel++
                    //check if this is last level and win


                    if (activeLevel >= levelIndexer.length) {
                        // puaseTimer();
                        // timerPause=false
                        endGame=true
                        //win game
                        //scorm
                        clearInterval(SetTimerScorm);
                        SetTimerScorm=null;
                        Result='unknown';
                        perFinal=Math.round((scorm.correctAnswers/(scorm.correctAnswers + scorm.failAnswers)) * (100/1))
                        $("#feedback").attr("class","");
                        $("#message-icone").attr("class","");
                        $(".result-container span").html("%"+perFinal);
                        if(perFinal<=100 && perFinal>=80){
                            $("#feedback").addClass("wellDonw");
                            $("#message-icone").addClass("wellDonw-icon");
                            Result='passed';
                        }else if (perFinal<=79 && perFinal>=50) {
                            $("#feedback").addClass("good");
                            $("#message-icone").addClass("good-icon");
                            Result='passed';
                        }else {
                            $("#feedback").addClass("tryAgain");
                            $("#message-icone").addClass("tryAgain-icon");
                            Result='failed';
                        }
                        if(LMSStatus){
                            API.SetValue("cmi.score.raw",perFinal.toFixed(2));//return text true or false | to set student mark
                            API.SetValue("cmi.completion_status","completed");//when complete game
                            API.SetValue("cmi.success_status",Result);//when complete game set value to one of ("passed","failed","unknown")
                            API.SetValue("cmi.session_time",TimeScorm);//to set Amount of seconds that the learner has spent
                            API.Commit("");//return text true or false | to save student mark to DB
                        }
                        TimeScorm=0;
                        setTimeout(function () {
                            $(".main-message-container").fadeIn();
                        },1000)

                        // $(document.body).msgBox({
                        //     msgText1: "images/win.svg",
                        //     imgSrc: "../all/images/win-boy.png",
                        //     confirmFn: function () {
                        //         restartgame();
                        //     },
                        // });
                        // $('#messageData').css("width", "59%");
                        // $('#lbl-data1').css("width", "60%");
                        // $('#aa i').css("background-image", "url('../all/images/try-again.svg')")
                        return
                    }


                    tempLevel = game.levelIndex
                    game.levelIndex = levelIndexer[activeLevel]


                    count = 0;

                    //pass Next level
                    {
                        setTimeout(function () {
                            $(".main-message-container_nextMessage").fadeIn();
                            resizeImageContainer()
                        },1000)

                        setTimeout(function () {
                            nextLeval()
                        },3500)
                        // $(document.body).msgBox({
                        //     confirmFn: function () {
                        //
                        //         document.getElementById("messageContainer").style.display = "none";
                        //
                        //         // timerStart({min: 1, sec: 30}, true)
                        //
                        //         $("#level-" + tempLevel).hide()
                        //         $(".swiper-container").hide()
                        //         $('#messageData').css("width", "59%");
                        //         $('#lbl-data1').css("width", "60%");
                        //         $('#aa i').css("background-image", "url('images/next.svg')")
                        //
                        //         $("#level-" + game.levelIndex).fadeIn("fast")
                        //         $("#swiper-container" + game.levelIndex).show()
                        //         setTimeout(function () {
                        //             $("#level-container-label" + game.levelIndex).show()
	                    //             resizeGame(),resizeGame()
                        //         }, 1000)
                        //
                        //         if (typeof game.levelTitle[game.levelIndex].title != "undefined") {
                        //             $(".header-container label").html(game.levelTitle[game.levelIndex].title)
                        //
                        //         }
                        //
                        //         reCalculatePoints(game.levelIndex)
                        //         //changeBackground(game.levelIndex)
                        //     },
                        // });

                    }


                }

            }
            else {
                //error answer
                scorm.failAnswers++
                $(".wrong span").html(scorm.failAnswers)
                soundEffect("../all/sound/error.mp3");

            }


        }

    });
    $(".level-inner-labels").hide()

    shuffleDivs("#level-container-label"+divNum)
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
var levelNum=0;
function nextLeval() {
    levelNum++;
    console.log("next"+game.levelIndex)
    $("#level-" + tempLevel).hide()
    $("#level-" + game.levelIndex).fadeIn("fast")
    $("#swiper-container" + game.levelIndex).show();

    $(".level-num span").html(levelNum)
    setTimeout(function () {
        $("#level-container-label" + game.levelIndex).show()
        resizeGame(),resizeGame()
    }, 1000)

    if (typeof game.levelTitle[game.levelIndex].title != "undefined") {
        $(".header-container label").html(game.levelTitle[game.levelIndex].title)

    }
    // if(game.isRandom){
    //     randomePositionMatching(arrayObject)
    // }
    reCalculatePoints(game.levelIndex)
    // resizeImageContainer();
    $(".main-message-container_nextMessage").fadeOut();
    $(".level-num span").html(levelNum+1)
}
var levelIndexNum=0;
function drawLevels() {
    flagGetFirstIndex=true
    $(".level-container").html("")

    for (var a = 0; a < game.level.length; a++) {
        if (typeof game.level[a] == "object") {
	        console.log(1)
            levelIndexer.push(a)
            addLevelLoaded(a);
            if(flagGetFirstIndex){
                game.firstIndex=a
                flagGetFirstIndex=false
            }

            draw(game.level[a], a);
            changeBackground(a)


        }


    }
    levelIndexNum=0;
    for(var i=0;i<game.level.length;i++){
        if(game.level[i]!="removed"){
            levelIndexNum++;
        }
    }
    if(levelIndexNum>1){
        $(".level-num-container").fadeIn();
        $(".level-count span").html(levelIndexNum);
    }
}
// var SwiperArray = []
function addLevelLoaded(index) {
    classNAme= "answerlayout"

    $("<div index='" + index + "' complete='false' id='level-" + index + "' class='level-inner-container'>" +
        "<div class='image-container' id='level-ImageContainer-" + index + "'></div>" +
        " <div class='label-container'></div>" +
        "</div>").appendTo('#level-container');


    str = '<div  class="elementResizable  ' + classNAme + '" id="' + classNAme + '-' + index + '">' + '</div>'


$(str).appendTo('#level-'+index).css({
    top: game.layout[index].answer.top + "%",
    left: game.layout[index].answer.left + "%",
    width: game.layout[index].answer.width + "%",
    height: game.layout[index].answer.height + "%"
})

    // $("#level-ImageContainer-"+index).css({
    //
    // })
    sliderString = '<div index="'+index+'" id="swiper-container' + index + '" class="swiper-container">' +
        "<a onclick='SimulPrev(" + index + ")' id='swiper-prev" + index + "'  class='btn prev'><i></i></a>"

    $(sliderString + "<div index='" + index + "' id='level-container-label" + index + "' class='level-inner-labels swiper-wrapper'></div>" +
        "</div>" +
        "<div index='" + index + "' id='swiper-scrollbar" + index + "' class='swiper-scrollbar'></div>" +
        "<div  id='swiper-button-next" + index + "'  class='swiper-button-next swiperControlHidden'></div>" +
        "<div id='swiper-button-prev" + index + "'  class='swiper-button-prev swiperControlHidden'></div>" +
        "<a onclick='SimulNext(" + index + ")' id='swiper-next" + index + "'  class='btn next'><i></i></a> " +
        "</div>").appendTo(".slidesLabel")


    // SwiperArray.push(
    //     {
    //         val: new Swiper('#swiper-container' + index, {
    //
    //             slidesPerView: "auto",
    //
    //             noSwipingClass: "noSwipingClass",
    //             spaceBetween: 0,
    //
    //         }),
    //         string: "new Swiper('#swiper-container" + index + "', {" +
    //         // " scrollbar: '.swiper-scrollbar'," +
    //         "scrollbarHide: true," +
    //
    //         "slidesPerView: 'auto'," +
    //         // "effect: 'coverflow'," +
    //         "freeMode: true,grabCursor: true," +
    //         " nextButton: '.swiper-button-next'," +
    //         "prevButton: '.swiper-button-prev'," +
    //         "noSwipingClass:'noSwipingClass'," +
    //         "spaceBetween: 0})"
    //
    //     }
    // )


    // refreshSwipers()

}

// function refreshSwipers(flag, index) {
//     for (var t = 0; t < SwiperArray.length; t++) {
//         SwiperArray[t].val.destroy();
//         SwiperArray[t].val = eval(SwiperArray[t].string)
//
//     }
//
//
// }

function SimulNext(index) {
    $("#swiper-button-next" + index).click()

    if ($("#swiper-button-next" + index).hasClass("swiper-button-disabled")) {
        $("#swiper-button-next" + index).addClass("swiper-button-disabled")
        return
    }
    $("#swiper-button-next" + index).removeClass("swiper-button-disabled")

}


function SimulPrev(index) {
    $("#swiper-button-prev" + index).click()

    if ($("#swiper-button-prev" + index).hasClass("swiper-button-disabled")) {
        $("#swiper-button-prev" + index).addClass("swiper-button-disabled")
        return
    }
    $("#swiper-button-prev" + index).removeClass("swiper-button-disabled")

}


function restartgame() {
	$(".main-message-container").fadeOut();
	initGame()
	// $("#messageContainer").hide()
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
	var containerWidth = $(".lable-bg").width();
	var items = $(".lable-bg span");
	var fontSize = 16;

	// items.each(function(){
	// 	//display value depend sometimes on your case you may make it block or inline-table instead of inline-block or whatever value that make the div take overflow width
	// 	$(this).css({"whiteSpace":"nowrap","display":"inline-block;overflow:hidden"});
	// 	while ($(this).width() > containerWidth){
	//
	// 		$(this).css("font-size", fontSize -= 0.5);
	// 	}
	// });
   // resizeGameInner()
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
    // var gameArea = document.getElementById('main-container');
    // gameArea = $('.level-inner-container')
    // var widthToHeight = 4 / 3;
    // var newWidth = gameArea.width();
    // var newHeight = gameArea.height();
    // var newWidthToHeight = newWidth / newHeight;
    // if (newWidthToHeight > widthToHeight) {
    // 	newWidth = newHeight * widthToHeight;
    // 	//gameArea.style.height = newHeight + 'px';
    // 	// gameArea.style.width = newWidth + 'px';
    // } else {
    // 	newHeight = newWidth / widthToHeight;
    // 	// gameArea.style.width = newWidth + 'px';
    // 	// gameArea.style.height = newHeight + 'px';
    // }
    // //gameArea.style.marginTop = (-newHeight / 2) + 'px';
    // //gameArea.style.marginLeft = (-newWidth / 2) + 'px';
    // var gameCanvas = $('.image-container')
    // gameCanvas.css({
    // 	width: newWidth + "px",
    // 	height: newHeight + "px"
    // })
    //resizeImageContainer()
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

	src1="../../../games/" + config.id + "/" + langStory + "/images/bg_BackLayer" + index + ".png?"
	src1_1="../../../games/" + config.id + "/" + langStory + "/images/bg_BackLayer" + index + ".jpg?"
	src2="../../../games/" + config.id + "/" + langStory + "/images/bg_" + index + ".png?"
	src2_2="../../../games/" + config.id + "/" + langStory + "/images/bg_BackLayer" + index + ".jpg?"
	$("#answerlayout-" + index).css(
		{
			'background': 'url(' + src2_2 + ')100% 100% no-repeat,url(' + src2 + ')100% 100% no-repeat,url(' + src1_1 + ')100% 100% no-repeat ,url(' + src1 + ')100% 100% no-repeat',
			backgroundPosition:"center",
			backgroundSize: "100% 100%"

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

        var parentPos = $("#answerlayout-" + levelIndex).offset();


        if(game.level[game.levelIndex] != "removed") {

        var diff = 0;

        direction = getDirection(ident, levelIndex)
        spanBoxInfo = {
            width: spanBox.width()/2,
            height: spanBox.height()/2,
        }
        increaseValue = {
            left: 0,
            top: 0
        }
        // if (direction == "topLeft") {
        //     increaseValue.left = spanBoxInfo.width
        //     increaseValue.top = spanBoxInfo.height
        // }
        // else if (direction == "bottomLeft") {
        //     increaseValue.left = spanBoxInfo.width
        //     increaseValue.top = 0
        // }
        // else if (direction == "topRight") {
        //     increaseValue.left = 0
        //     increaseValue.top = spanBoxInfo.height
        // }
        // else if (direction == "bottomRight") {
        //     increaseValue.left = 0
        //     increaseValue.top = 0
        // }
        // else {
        //     increaseValue.left = 0
        //     increaseValue.top = 0
        // }

        objectPosition = {
            x1: ((Spanattr.left - parentPos.left)) + increaseValue.left + spanBoxInfo.width,
            x2: ((point.left - parentPos.left)) + pointBox.width() / 2,
            y1: (Spanattr.top - parentPos.top) + increaseValue.top + spanBoxInfo.height,
            y2: (point.top - parentPos.top) - diff + pointBox.height() / 2
        };

        xx = "M" + objectPosition.x1 + " " + (objectPosition.y1) + " " + objectPosition.x2 + " " + (objectPosition.y2);
        $("#svg-" + ident + "-L" + levelIndex).attr("d", xx);
        }
    })

    // refreshSwipers()
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
    var helpText = ""

    helpText = "<div class='help-main-container'>" +
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
        'src': "../../../games/" + config.id + "/" + langStory + "/sound/bg.mp3",



        'autoplay': 'autoplay'
    }).appendTo("body");
    $(".bgsound").prop("loop", true);

    $(".bgsound").prop("volume", 0.6);


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
        queryEnd = url.indexOf("#") + 1 || url.length + 1,
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


function resizeImageContainer() {

    // $("#level-" + game.levelIndex).css({
    // 	width: 1024 + "px",
    // 	height: 768 + "px"
    // })
    //
    // gameArea = $(".level-container")
    // var widthToHeight = 4 / 3;
    // var newWidth = gameArea.width();
    // var newHeight = gameArea.height();
    // var newWidthToHeight = newWidth / newHeight;
    // if (newWidthToHeight > widthToHeight) {
    // 	newWidth = newHeight * widthToHeight;
    // } else {
    // 	newHeight = newWidth / widthToHeight;
    //
    // }
    // var gameCanvas = $("#level-" + game.levelIndex)
    // gameCanvas.css({
    // 	width: newWidth + "px",
    // 	height: newHeight + "px"
    // })
    //
    reCalculatePoints()
}


function conrolNextButton(){
	$("#swiper-next"+activeLevel).click()
}

function conrolPrevButton(){

	$("#swiper-prev"+activeLevel).click()
}
