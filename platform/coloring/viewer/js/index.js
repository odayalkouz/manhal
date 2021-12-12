
arrayOfImages = ["1.png"]


arrayOfImagesLoaded = []
imgCreate = ""

function showloading(o) {
    $("<div class='loading'></div>").hide().appendTo(o).fadeIn("slow");
}
function hideloading() {
    $(".loading").fadeOut("slow", function () {
        $(".loading").remove();
    });
}

var DomManhal = {
    get: function (id) {
        return document.getElementById(id);
    },
    create: function (type) {
        return document.createElement(type);
    }
};

function is_touch_device() {
    return 'ontouchstart' in window;
}
function getPosition(e) {

    e.stopPropagation()
    var targ;
    if (!e)
        e = window.event;
    if (e.target)
        targ = e.target;
    else if (event.srcElement)
        targ = e.srcElement;
    if (targ.nodeType == 3)
        targ = targ.parentNode;

    if (!is_touch_device()) {

        var x = event.pageX - $(targ).offset().left;
        var y = event.pageY - $(targ).offset().top;
    }
    else {
        var x = event.touches[0].pageX - $(targ).offset().left;
        var y = event.touches[0].pageY - $(targ).offset().top;

    }

    return {"x": x, "y": y};
};

var canvas, ctxFill, containerDiv, containerDivAll = "";


function resizeCanvasToScreen() {
    canvasResize = [canvas, canvas1, tmp_canvasFill, canvasBackTmpMask, FillCanvasFlood]
    // containerDivAll.style.width = window.innerWidth + 'px'
    // containerDivAll.style.height = window.innerHeight + 'px'


    for (var i = 0; i < canvasResize.length; i++) {
        if (canvasResize[i]) {
            canvasResize[i].style.width = '97%'
            canvasResize[i].style.height = '97%'
            canvasResize[i].width = canvasResize[i].offsetWidth;
            canvasResize[i].height = canvasResize[i].offsetHeight;
        }
    }

}


function loadNewImage(src) {
    arr = []
    arr.push(src)
    preload(arr)

}


function preload(arrayOfImages) {
    $(arrayOfImages).each(function (i) {

        imgCreate = DomManhal.create("img");
        imgCreate.src = this
        arrayOfImagesLoaded[0] = imgCreate
        imgCreate.onload = function () {

            DrawImageOnCanvas()
        }
    });


}


function DrawImageOnCanvas() {

    canvasArraysCTX = [ctxFill1, ctxFill]
    resizeCanvasToScreen()
    var coord = calculateAspectRatioFit(arrayOfImagesLoaded[0].width, arrayOfImagesLoaded[0].height, canvas1.width, canvas1.height)
    ctxCanvasBackTmpMask.drawImage(arrayOfImagesLoaded[0], canvas1.width / 2 - coord.width / 2, canvas1.height / 2 - coord.height / 2, coord.width, coord.height)

    for (var i = 0; i < canvasArraysCTX.length; i++) {
        canvasArraysCTX[i].mozImageSmoothingEnabled = true;
        canvasArraysCTX[i].webkitImageSmoothingEnabled = true;
        canvasArraysCTX[i].msImageSmoothingEnabled = true;
        canvasArraysCTX[i].imageSmoothingEnabled = true;


        canvasArraysCTX[i].fillStyle = 'white'
        canvasArraysCTX[i].fillRect(0, 0, tmp_canvasFill1.width, tmp_canvasFill1.height)
        canvasArraysCTX[i].drawImage(arrayOfImagesLoaded[0], canvas1.width / 2 - coord.width / 2, canvas1.height / 2 - coord.height / 2, coord.width, coord.height)

        canvasArraysCTX[i].save()
        canvasArraysCTX[i].lineWidth = 5
        canvasArraysCTX[i].rect(canvas1.width / 2 - coord.width / 2, canvas1.height / 2 - coord.height / 2, coord.width, coord.height);
        canvasArraysCTX[i].stroke();
        canvasArraysCTX[i].restore()


    }

    cPush()
    // hideloading()
}


function resizeDW() {

    data = canvas1.toDataURL()
    canvasFillData = tmp_canvasFill.toDataURL()
    tmpCtx.globalCompositeOperation = "source-over";
    imgResize.src = data
    imgResizeMask.src = canvasFillData
    resizeCanvasToScreen()

    imgResize.onload = function () {
        var coord = calculateAspectRatioFit(arrayOfImagesLoaded[0].width, arrayOfImagesLoaded[0].height, canvas1.width, canvas1.height)
        canvasArraysCTX = [ctxFill1, ctxFill,ctxCanvasBackTmpMask,]
        for (var i = 0; i < canvasArraysCTX.length; i++) {
            canvasArraysCTX[i].fillStyle = 'white'
            canvasArraysCTX[i].fillRect(0, 0, tmp_canvasFill1.width, tmp_canvasFill1.height)
            canvasArraysCTX[i].mozImageSmoothingEnabled = true;
            canvasArraysCTX[i].webkitImageSmoothingEnabled = true;
            canvasArraysCTX[i].msImageSmoothingEnabled = true;
            canvasArraysCTX[i].imageSmoothingEnabled = true;

            canvasArraysCTX[i].drawImage(arrayOfImagesLoaded[0], canvas1.width / 2 - coord.width / 2, canvas1.height / 2 - coord.height / 2, coord.width, coord.height)


            canvasArraysCTX[i].save()
            canvasArraysCTX[i].lineWidth = 5
            canvasArraysCTX[i].rect((canvas1.width / 2 - coord.width / 2), (canvas1.height / 2 - coord.height / 2), coord.width, coord.height);
            canvasArraysCTX[i].stroke();
            canvasArraysCTX[i].restore()

        }
    }

}


var timeOutBrush = true;
var colorChoose = colorsCollection[1]
var mouseMoveAllow = false








function resetCanvasEvent() {
    canvas.onclick = function (e) {
        e.preventDefault()
    }
    canvas.onmousedown = function (e) {
        e.preventDefault()
    }
    canvas.onmousemove = function (e) {
        e.preventDefault()
    }
    canvas.onmouseup = function (e) {
        e.preventDefault()
    }

    canvas.ontouchend = function (e) {
        e.preventDefault()
    }
    canvas.ontouchmove = function (e) {
        e.preventDefault()
    }
    canvas.ontouchstart = function (e) {
        e.preventDefault()
    }

    tmp_canvasFill.onclick = function (e) {
        e.preventDefault()
    }
    tmp_canvasFill.onmousedown = function (e) {
        e.preventDefault()
    }
    tmp_canvasFill.onmousemove = function (e) {
        e.preventDefault()
    }
    tmp_canvasFill.onmouseup = function (e) {
        e.preventDefault()
    }

    tmp_canvasFill.ontouchend = function (e) {
        e.preventDefault()
    }
    tmp_canvasFill.ontouchmove = function (e) {
        e.preventDefault()
    }
    tmp_canvasFill.ontouchstart = function (e) {
        e.preventDefault()
    }

}








function calculateAspectRatioFit(srcWidth, srcHeight, maxWidth, maxHeight) {

    var ratio = Math.min(maxWidth / srcWidth, maxHeight / srcHeight);

    return {width: srcWidth * ratio, height: srcHeight * ratio};
}

var imgResize = new Image()
var imgResizeMask = new Image()
var doit = ""
window.onresize = function (event) {

    clearTimeout(doit);
    doit = setTimeout(resizeDW, 100);
    resizeGameInner("#inner-colorPicker", ".background-colorPicker", (4 / 3), 3)




};



DrawingType = 'pen'
sprayType = 'circle'
canvasBackTmpMask = ""
ctxCanvasBackTmpMask = ""

var LineWidth = 30
myScroll = ""


$(document).ready(function () {


    $('#size4').addClass('select_wrapper')
    containerDivAll = DomManhal.get("gameConainer");
    canvas = DomManhal.get("canvas");
    canvas1 = DomManhal.get("canvas1");


    canvasBackTmpMask = DomManhal.get("canvasBackTmpMask");

    containerDiv = DomManhal.get("canvasContainer");
    ctxFill = canvas.getContext("2d");
    ctxFill1 = canvas1.getContext("2d");
    ctxCanvasBackTmpMask = canvasBackTmpMask.getContext("2d");
    resizeCanvasToScreen()
    preload(arrayOfImages)
    //floodFillAction(canvas1)
    //loadColor()

    fillArea()

    $('#penselect').click(function () {
        magicPen()
    })
    $('.sound-btn-story,.help-back-icon,.color-item').click(function () {
        soundEffect("sound/slidemenu.mp3")
    })

    $('#normal_pen').click()

});




function magicPen(object) {
    soundEffect("sound/slidemenu.mp3")
    event.stopPropagation();
    event.preventDefault();
    penType = 'magic'
    flipSound();
    DrawMode = 'pen';
    $('#penselect').css('background', 'url(images/icons/7.png) no-repeat')
    $('#penselect').css('background-size', '100%')

    DrawingType = 'pen'

    setTimeout(function () {
        fillArea()
        $(".filling-main-container").css("pointer-events", "auto")
        clickDisabledCanvas = false
        stillFill = false

    }, 100);
    $('#penselect').unbind('click')
    $('#penselect').click(function () {

        $('.iconsMenu').removeClass('active_equation')
        $('#penselect').addClass('active_equation')

        magicPen()
    })
    if (DrawMode == "erazer") {
        fillArea()
    }
}

function normalPen(object) {
    soundEffect("sound/slidemenu.mp3")
    event.stopPropagation();
    event.preventDefault();
    penType = 'normal';
    DrawingType = 'pen'
    flipSound();
    DrawMode = 'pen';
    $('#penselect').css('background', 'url(images/icons/17.png) no-repeat')
    $('#penselect').css('background-size', '100%')


    setTimeout(function () {
        fillArea()
        $(".filling-main-container").css("pointer-events", "auto")
        clickDisabledCanvas = false
        stillFill = false

    }, 100);
    $('#penselect').unbind('click')
    $('#penselect').click(function () {
        $('.iconsMenu').removeClass('active_equation')
        $('#penselect').addClass('active_equation')
        normalPen()
    })
    if (DrawMode == "erazer") {
        fillArea()
    }
}

FillCanvasFlood = FillCanvasFloodCtx = ""
function fillPen(object) {
    soundEffect("sound/slidemenu.mp3")
    event.stopPropagation();
    event.preventDefault();

    if ($('#FillCanvasFlood')) $('#FillCanvasFlood').remove()
    FillCanvasFlood = DomManhal.create('canvas')
    FillCanvasFlood.id = "FillCanvasFlood"
    FillCanvasFlood.className = "canvasClassTmp2"
    FillCanvasFlood.width = canvas.width
    FillCanvasFlood.height = canvas.height
    FillCanvasFloodCtx = FillCanvasFlood.getContext("2d")
    removeWhiteFillMode()

    document.getElementById('canvasContainer').appendChild(FillCanvasFlood)

    penType = 'fill';
    DrawingType = 'pen'
    flipSound();
    DrawMode = 'fill';
    $('#penselect').css('background', 'url(images/icons/12.png) no-repeat')
    $('#penselect').css('background-size', '100%')

    setTimeout(function () {
        fillArea()
        $(".filling-main-container").css("pointer-events", "auto")
        clickDisabledCanvas = false
        stillFill = false

    }, 100);

    $('#penselect').unbind('click')
    $('#penselect').click(function () {
        $('.iconsMenu').removeClass('active_equation')
        $('#penselect').addClass('active_equation')
        fillPen()
    })
    if (DrawMode == "erazer") {
        fillArea()
    }

}



function stopDraw(object) {
    event.stopPropagation();
    event.preventDefault();
    penType = 'stop'
    flipSound();
    DrawMode = 'stop';
    $('#penselect').css('background', 'url(images/icons/9.png) no-repeat')
    $('#penselect').css('background-size', '100%')



    $('#penselect').unbind('click')
    $('#penselect').click(function () {
        $('.iconsMenu').removeClass('active_equation')
        $('#penselect').addClass('active_equation')
        stopDraw()
    })

    resetCanvasEvent()
}


function pointInCircle(x, y, cx, cy, radius) {
    var distancesquared = (x - cx) * (x - cx) + (y - cy) * (y - cy);
    return distancesquared <= radius * radius;
}


function removeWhiteFillMode() {
    FillCanvasFloodCtx.drawImage(canvasBackTmpMask, 0, 0, canvas.width, canvas.height)

}


function selectErazer() {
    soundEffect("sound/slidemenu.mp3")
    $('.iconsMenu').removeClass('active_equation')
    $('#erazer').addClass('active_equation')
}





var Orginal = ""





function getColorEss(obj) {
    $(".color-item").find("i").hide()
    $(obj).find("i").show()
    DrawMode = 'pen'
    soundEffect("sound/colorClick.mp3")
    colorChoose = $(obj).attr('colorChoo')
    fillArea()
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

function resizecolorPicker() {
    var gameArea = document.getElementById('colorPicker');
    var widthToHeight = 4 / 3;
    var newWidth = $(".canvasContainer").width();
    var newHeight = $(".canvasContainer").height();
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

    var gameCanvas = document.getElementById('inner-colorPicker');
    gameCanvas.style.width = newWidth + 'px';
    gameCanvas.style.height = newHeight + 'px';
    //autoSizeText
}
function resizefilling() {
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

    //gameArea.style.marginTop = (-newHeight / 2) + 'px';
    //gameArea.style.marginLeft = (-newWidth / 2) + 'px';

    var gameCanvas = document.getElementById('inner-gameConainer');
    gameCanvas.style.width = newWidth + 'px';
    gameCanvas.style.height = newHeight + 'px';
    //autoSizeText
}

function resizeGameInner(container, inner, aspectRatio,divid) {

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
        width: newWidth /divid + "px",
        height: newHeight /divid + "px"
    })

    console.log({
        width: newWidth,
        height: newHeight
    })

}

function printCanvas()
{

    var KK3 = document.getElementById('canvas1');
    var image3 = new Image();
    var data3 = KK3.toDataURL(); // base 64
    image3.src = data3;
    image3.id='khalid3' // js
    $("#colorpickerNew").append(image3); // append canvas base64 to container

    var printWindow = window.open('', 'to_print', 'height=768,width=1024');
    var html = '<html><head><title></title></head><body style="width: 100%; padding: 0; margin: 0;" >' + $("#colorpickerNew").html()+ '</body></html>';
    printWindow.document.write(html);
    printWindow.document.close();

    setTimeout(function(){
        printWindow.print();
        $("#khalid3").remove();
        printWindow.document.write("");

    },150);

}