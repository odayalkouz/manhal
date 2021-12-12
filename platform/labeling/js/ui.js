var game = {
    level: [],
    levelTitle:[],
    images:[],
    backgroundLevel: [],
    title:"",
    option:{
        noBackgrondSound:false,
        fillOff:false,
        dotSize:1.2,
        colorDots:"white",
	    labelJust:false,
        typeViewr:"letters"
    },

    levelIndex: 0,
    activePointer: 0

}
var swiperThumbs =""
var count = 0;
var pointnum = 0
$(window).on("resize", function () {
    $(".image-container span").css("lineHeight", $(".image-container span").height() + "px");
});


var config = {

    GameID: GameID,
    UserId: UserId,
    rootPath: rootPath

}
//config.rootPath = "gamesUser/" + config.UserId + "/" + config.GameID
orderValue = 0
$(document).ready(function () {


    $('body').manhalLoader({

        splashID: "#jSplash",
        // splashVPos: '50%',
        // loaderVPos: '80%',
        addFiles: [



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

        orderValue = $("#startnumber").val()


        window.addEventListener("resize", resizeGame);

        loadJsonData()
        resizeGame();


        $(document).on("keyup", ".image-container span", function () {
            console.log($(this).html())
            updateCurrentpointDataWord($(this).html())
        })


        $(".gameContent,.work-place").click(function () {
            event.stopPropagation()
            event.preventDefault()
            $(".LAbelText,.poent").removeClass("activeElementDot")
            $(".LAbelText").draggable("option", "disabled", false)
                .attr('contenteditable', 'false');
	        $(".LAbelText,.poent").removeClass("selLabel")
	        game.activePointer=""
        })
        drop()

    });

    
$(document).on("click",".exerciseSelectType",function(){
    type=$(this).attr("attrType")
    $(".exerciseSelectType").removeClass("selectTypeExercise")
    $(this).addClass("selectTypeExercise")
    
    game.option.typeViewr=type;
})

});
//window.addEventListener('resize', resizeGame, false);
function selectLabel(){
	$(".LAbelText,.poent").removeClass("selLabel")
	targetObjectString="span-"+ game.activePointer+"-L"+game.levelIndex
	targetPointString="point-"+ game.activePointer+"-L"+game.levelIndex
	targetsvgString="svg-"+ game.activePointer+"-L"+game.levelIndex
    $("#"+targetObjectString+",#"+targetPointString+",#"+targetsvgString).addClass("selLabel")
}

function loadJsonData() {

    setdatafunction(
        {
            TypeProcesses: 'getdatagames',
            id: config.GameID
        });
}


function randomString(length, chars) {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

    for( var i=0; i < 5; i++ )
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}




svgText = "";
function draw(arrayObject, divNum) {
    $('.image-container span').remove();
    for (var i = 0; i < arrayObject.length; i++) {
        $("<span contenteditable='true' data-index='" + i + "' data-div='" + i + "' id='span-" + i + "'></span>").appendTo(".image-container");
        $("<div class='poent'  data-index='" + i + "' data-point='" + i + "' id='point-" + i + "' style='top: " + game.level[game.levelIndex][game.activePointer].p.y + ";" +
            "left: " + game.level[game.levelIndex][game.activePointer].p.x + ";'><a class='delete-point' onclick='deletePoint(this)'>Delete</a></div>").appendTo(".image-container");
        $(".image-container span").css("lineHeight", $(".image-container span").height() + "px");


    }
}


function addobject() {
    pointnum = game.level[game.levelIndex].length
    $("<span class='LAbelText'  data-index='" + pointnum + "' data-div='" + pointnum + "' id='span-" + pointnum + "-L" + game.levelIndex + "'></span>")
        .appendTo("#level-" + game.levelIndex);

    $("<div class='poent'  data-index='" + pointnum + "' data-point='" + pointnum + "' id='point-" + pointnum + "-L" + game.levelIndex + "' style='top: 20%;left: 30%;'>" +
        "<a class='delete-point' onclick='deletePoint(this)'>Delete</a></div>")
        .appendTo("#level-" + game.levelIndex);

    $(".image-container span").css("lineHeight", $(".image-container span").height() + "px");

    svgText = '<svg class="svgGroup" xmlns="http://www.w3.org/2000/svg" version="1.1" height="' + $(".level-inner-container").height() + '" width="' + $(".level-inner-container").width() + '">';
    innerSvg = "";

    objectPosition = {
        x1: 365,
        x2: 0 + $(".image-container span").width(),
        y1: 138,
        y2: 0 + $(".image-container span").height()
    };
    xx = "M" + objectPosition.x1 + " " + (objectPosition.y1) + " " + objectPosition.x2 + " " + (objectPosition.y2);
    innerSvg += '<path id="svg-' + pointnum + "-L" + game.levelIndex + '" data-index="' + pointnum + '"  data-indexLevel="' + game.levelIndex + '"  data-svg="' + pointnum + '" d="' + xx + '" stroke="#959595" stroke-width="2" fill="none" stroke-linecap="round"/>'
    svgText = svgText + innerSvg + "</svg>";
    $(svgText).appendTo("#level-" + game.levelIndex);

    game.level[game.levelIndex].push({
        word: "",
        top: 0 + $(".image-container span").height(),
        left: 0 + $(".image-container span").width(),
        p: {
            x: 20,
            y: 20
        }
    })

    game.activePointer = pointnum





    $("#point-" + pointnum + "-L" + game.levelIndex).draggable({
        start: function (event, ui) {
            $(".LAbelText").removeClass("activeElementDot")
            $(this).addClass("activeElementDot")
            game.activePointer = $(this).data("index")
	        selectLabel()
        },
        containment: "#level-" + game.levelIndex,

        drag: function (event, ui) {
            game.activePointer = $(this).data("index")
	        selectLabel()
            reCalculatePoints()
        },
        stop: function (event, ui) {
            $(".LAbelText").removeClass("activeElementDot")
            $(this).addClass("activeElementDot")
            game.activePointer = $(this).data("index")
            updateCurrentpointDataP(ui.position)
            object = game.level[game.levelIndex][game.activePointer]
            $(this).css({
                top: object.p.y + "%",
                left: object.p.x + "%",
            })
	        selectLabel()
        }

    }).click(function () {
        $(".LAbelText").removeClass("activeElementDot")
        $(this).addClass("activeElementDot")
        game.activePointer = $(this).data("index")
	    selectLabel()
    })






    $("#span-" + pointnum + "-L" + game.levelIndex).draggable({
        containment: "#level-" + game.levelIndex,
        drag: function (event, ui) {
            $(".LAbelText").removeClass("activeElementDot")
            $(this).addClass("activeElementDot")

            game.activePointer = $(this).data("div")
            reCalculatePoints()
	        selectLabel()
        },
        stop: function (event, ui) {

            game.activePointer = $(this).data("div")
            updateCurrentpointDataTOPLEFT(ui.position)
            object = game.level[game.levelIndex][game.activePointer]
            $(this).css({
                top: object.top + "%",
                left: object.left + "%",
            })
	        selectLabel()
        }
    }).click(function () {

        $(".LAbelText").removeClass("activeElementDot")
        $(this).addClass("activeElementDot")
        event.stopPropagation()
        event.preventDefault()
        game.activePointer = $(this).data("div")
	    selectLabel()
    }).dblclick(function () {

        $(".LAbelText").removeClass("activeElementDot")
        $(this).addClass("activeElementDot")
           event.stopPropagation()
            event.preventDefault()
            if ($(this).is('.ui-draggable-dragging')) {
                return;
            }
            $(this).draggable("option", "disabled", true);
            $(this).attr('contenteditable', 'true');
		    selectLabel()
        })
        .keyup(function () {

            updateCurrentpointDataWord($(this).text())

        })


    //$("#level-thumb-"+game.activePointer).click()
    reCalculatePoints()

    resizeGame()

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
	
	labelJust()
}


function removeLabel(){
targetElement=game.level[game.levelIndex][game.activePointer]
game.level[game.levelIndex][game.activePointer]="removed"

    
    if(game.activePointer==""){
	    Lobibox.notify("error", {
		
		   
		
		    delayIndicator: true,
		    msg: 'Select label to remove.'
	    });
    return
    }
    
targetObjectString="span-"+ game.activePointer+"-L"+game.levelIndex
targetPointString="point-"+ game.activePointer+"-L"+game.levelIndex
targetsvgString="svg-"+ game.activePointer+"-L"+game.levelIndex

  
    $("#"+targetObjectString).remove()
    $("#"+targetPointString).remove()
    $("#"+targetsvgString).remove()
    // saveData()
	Lobibox.notify("success", {
		
		
		
		delayIndicator: true,
		msg: 'Removed complete'
	});
}


function removePage(){
    if($(".page-thumb").length==1){
	
	    Lobibox.notify("error", {
		
		
		
		    delayIndicator: true,
		    msg: 'You could not remove less than one page'
	    });
        return
    }
    targetElement=game.level[game.levelIndex][game.activePointer]
    game.level[game.levelIndex]="removed"
    game.levelTitle[game.levelIndex]="removed"
    game.backgroundLevel[game.levelIndex]="removed"
    targetObjectString="level-thumb"+ game.levelIndex



bef=game.levelIndex-1
    $(".swiper-wrapper").html("")
    drawGame(game.level)
    $("#level-thumb"+bef).click()

    // saveData()

    swiperThumbs.updateContainerSize()
    swiperThumbs.updateSlidesSize()
	Lobibox.notify("success", {
		
		
		
		delayIndicator: true,
		msg: 'removed page done'
	});
}

function deletePoint(object) {
    object.parentNode.parentNode.removeChild(object.parentNode)
    object.parentNode.parentNode.removeChild(object.parentNode.parentNode.childNodes.getAttribute("data-index"))
}


function updateCurrentpointDataWord(word) {
    object = game.level[game.levelIndex][game.activePointer]
    object.word = word


}
function updateCurrentpointDataP(Point) {
    object = game.level[game.levelIndex][game.activePointer]

    object.p.x = Point.left / ($(".gameContent").width() / 100);
    object.p.y = Point.top / ($(".gameContent").height() / 100)


}
function updateCurrentpointDataTOPLEFT(position) {
    object = game.level[game.levelIndex][game.activePointer]
    object.top = position.top / ($(".gameContent").height() / 100)
    object.left = position.left / ($(".gameContent").width() / 100)


}

function updateCurrentpointDatabackground(url) {
    object = game.backgroundLevel[game.levelIndex]
    object = url;
}

function resizeGame() {
    var gameArea = document.getElementById('gameContent');
    var widthToHeight = 4 / 3;
    var newWidth = $(".gameContainer").width();
    var newHeight = $(".gameContainer").height();
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

    var gameCanvas = document.getElementById('gameContent');
    gameCanvas.style.width = newWidth + 'px';
    gameCanvas.style.height = newHeight + 'px';

    resizeGameCustome("body", ".gameContainer", (4/3),1)
    resizeGameCustome(".gameContainer", ".gameContent", (4/3),1.3)
    reCalculatePoints()
}


function reCalculatePoints() {
    $("path").each(function (index) {


        var ident = $(this).data("index");
        var levelIndex = $(this).data("indexlevel");
        spanBox = $("#span-" + ident + "-L" + levelIndex)
        pointBox = $("#point-" + ident + "-L" + levelIndex)
        var Spanattr = spanBox.offset();
        var point = pointBox.offset();

        var parentPos = $(".gameContent").offset();
        direction = getDirection(pointBox, spanBox, point)
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


function getDirection(container, object, point) {

    containerInfo = {
        top: container.offset().top,
        left: container.offset().left,
        width: container.width(),
        height: container.height(),
        midWidth: container.width() / 2,
        midHeight: container.height() / 2,
    }


    objectInfo = {
        top: object.offset().top - containerInfo.top,
        left: object.offset().left - containerInfo.left,
        width: object.width(),
        height: object.height()

    }

    pointInfo = {
        top: point.top - containerInfo.top,
        left: point.left - containerInfo.left,


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


saveType = "save"
function previewGame() {

    saveType = "preview"

    ajaxPHP(config.rootPath + "/js/", "", "JsonFile", "game.js", "saveJson", "");


}

function readyToPreview() {

    if ($('.iframeContainerP').length)$('.iframeContainerP').remove()
    str = '<div class="iframeContainerP">' +
        '<div class="iframeWrapper">' +
        '<iframe class="iframeEditor" src="' + config.rootPath + '/index.html?' + Math.random() + '"></iframe>' +
        '</div>' +
        '<img class="closeBtn" onclick="closeIframeGameP()" src="images/close.png">' +
        '</div>'

    $(str).appendTo('body');
    $(".closeBtn").hide()
}

function selectType(){

}
