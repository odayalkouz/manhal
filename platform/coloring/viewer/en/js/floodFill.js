var DomManhal = {
    get: function (id) {
        return document.getElementById(id);
    },
    create: function (type) {
        return document.createElement(type);
    }
};


var finishSelectArea = false
var imgBrush = new Image();

var timeComp = {
    new: 0,
    old: 0
}
imgBrush.src = 'http://www.tricedesigns.com/wp-content/uploads/2012/01/brush2.png';

function checkIFPc() {


    if (navigator.userAgent.match(/Android/i) ||
        navigator.userAgent.match(/webOS/i) ||
        navigator.userAgent.match(/iPhone/i) ||
        navigator.userAgent.match(/iPad/i) ||
        navigator.userAgent.match(/iPod/i) ||
        navigator.userAgent.match(/BlackBerry/) ||
        navigator.userAgent.match(/Windows Phone/i) ||
        navigator.userAgent.match(/ZuneWP7/i)
    ) {
        return false

    } else {
        return true

    }
}

function log(msg) {

    return console.log(msg)
}

function floodfill(x, y, fillcolor, ctx, W, H) {

    log("fillStart")
    if (stillFill == true) return

    if (compareColor(x, y, ctx, fillcolor)) {

        // $(".filling-main-container").css("pointer-events", "auto")
        clickDisabledCanvas = false
        stillFill = false
        fillArea()
        return

    }

    xArr.length = 0
    yArr.length = 0;

    if (CheckIfBlack(x, y, ctx) == false) {
        setTimeout(function () {
            fillArea()
            $(".filling-main-container").css("pointer-events", "auto")
            clickDisabledCanvas = false
            stillFill = false


            console.log("click in black")

        }, 100);

    }

    // Putting the offsets in such an order as to minimize the
    // possibility of cache miss during array access.
    var dx = [0, -1, +1, 0],
        dy = [-1, 0, 0, +1];
    var clickColor = getColor(x, y, ctx, color)
    var compare = {r: 85, g: 85, b: 85}
    var x = Math.round(x),
        y = Math.round(y),
        img = ctx.getImageData(0, 0, W, H),
        imgData = img.data,
        hitColor = getPixelColor(imgData, x, y),
        stack = [];
    if (clickColor.r >= 254 && clickColor.g >= 254 && clickColor.b >= 254) {
        compare = {r: 85, g: 85, b: 85}
    } else {
        compare = {
            a: ((hitColor >> 32) & 0xFF),
            r: ((hitColor >> 24) & 0xFF),
            g: ((hitColor >> 16) & 0xFF),
            b: ((hitColor >> 8) & 0xFF)
        }
    }
    stack.push(x);
    stack.push(y);

    fillcolor = (fillcolor.r << 24) | (fillcolor.g << 16) | (fillcolor.b << 8);

    // halt if attempting to fill with the same color ...
    if (Math.abs(hitColor) == fillcolor)
        return false;


    while (stack.length > 0) {

        var curPointY = stack.pop(),
            curPointX = stack.pop();

        for (var i = 0; i < 4; i++) {

            var nextPointX = curPointX + dx[i],
                nextPointY = curPointY + dy[i];

            // skip this point if we're out of bounds ....
            if (nextPointX < 0 || nextPointY < 0 || nextPointX >= W || nextPointY >= H)
                continue;

            // Inline implementation of isSameColor.
            var nextPointOffset = (nextPointY * W + nextPointX) * 4;

            if (clickColor.r >= 254 && clickColor.g >= 254 && clickColor.b >= 254) {


                if ((imgData[nextPointOffset + 0] >= compare.r)
                    && imgData[nextPointOffset + 1] >= compare.g
                    && imgData[nextPointOffset + 2] >= compare.b
                    && imgData[nextPointOffset + 3] > 50

                ) {

                    // Inline implementation of setPixelColor.
                    imgData[nextPointOffset + 0] = (fillcolor >> 24) & 0xFF;
                    imgData[nextPointOffset + 1] = (fillcolor >> 16) & 0xFF;
                    imgData[nextPointOffset + 2] = (fillcolor >> 8) & 0xFF;
                    imgData[nextPointOffset + 3] = 1;

                    stack.push(nextPointX);
                    stack.push(nextPointY);
                    xArr.push(nextPointX)
                    yArr.push(nextPointY)
                }

            } else {


                if (imgData[nextPointOffset + 0] == ((hitColor >> 24) & 0xFF)
                    && imgData[nextPointOffset + 1] == ((hitColor >> 16) & 0xFF)
                    && imgData[nextPointOffset + 2] == ((hitColor >> 8) & 0xFF)) {

                    // Inline implementation of setPixelColor.
                    imgData[nextPointOffset + 0] = (fillcolor >> 24) & 0xFF;
                    imgData[nextPointOffset + 1] = (fillcolor >> 16) & 0xFF;
                    imgData[nextPointOffset + 2] = (fillcolor >> 8) & 0xFF;
                    imgData[nextPointOffset + 3] = 1;

                    stack.push(nextPointX);
                    stack.push(nextPointY);
                    xArr.push(nextPointX)
                    yArr.push(nextPointY)
                }


            }

        }
    }

    if (penType == 'fill')
        ctx.putImageData(img, 0, 0);


    finishSelectArea = true
    setTimeout(function () {
        if (penType != "magic") {
            fillArea()
        }
        clickDisabledCanvas = false
        $(".filling-main-container").css("pointer-events", "auto")
        stillFill = false

    }, 100);

    finishSelectArea = true

    function getPixelColor(imgData, x, y) {
        var offset = (x + y * W) * 4,
            result = imgData[offset + 0] << 24; // r
        result |= imgData[offset + 1] << 16; // g
        result |= imgData[offset + 2] << 8; // b
        // result |= imgData[offset + 3]; // a
        return result;
    }
}


function pixelCompare(i, targetcolor, targettotal, fillcolor, data, length, tolerance) {
    if (i < 0 || i >= length) return false; //out of bounds
    if (data[i + 3] === 0) return true;  //surface is invisible

    if (
        (targetcolor[3] === fillcolor.a) &&
        (targetcolor[0] === fillcolor.r) &&
        (targetcolor[1] === fillcolor.g) &&
        (targetcolor[2] === fillcolor.b)
    ) return false; //target is same as fill

    if (
        (targetcolor[3] === data[i + 3]) &&
        (targetcolor[0] === data[i]) &&
        (targetcolor[1] === data[i + 1]) &&
        (targetcolor[2] === data[i + 2])
    ) return true; //target matches surface

    if (
        Math.abs(targetcolor[3] - data[i + 3]) <= (255 - tolerance) &&
        Math.abs(targetcolor[0] - data[i]) <= tolerance &&
        Math.abs(targetcolor[1] - data[i + 1]) <= tolerance &&
        Math.abs(targetcolor[2] - data[i + 2]) <= tolerance
    ) return true; //target to surface within tolerance

    return false; //no match
}

var xArr = []
var yArr = []

function pixelCompareAndSet(i, targetcolor, targettotal, fillcolor, data, length, tolerance) {

    if (pixelCompare(i, targetcolor, targettotal, fillcolor, data, length, tolerance)) {
        //fill the color
        data[i] = fillcolor.r;
        data[i + 1] = fillcolor.g;
        data[i + 2] = fillcolor.b;
        data[i + 3] = fillcolor.a;

        var xx = (i / 4) % canvas1.width;
        var yy = Math.floor((i / 4) / canvas1.width);


        xArr.push(xx)
        yArr.push(yy)

        return true;
    }

    return false;
}


function isSameColor(img, x, y, color) {
    var data = img.data;
    var offset = ((y * (img.width * 4)) + (x * 4));
    if ((data[offset + 0]) != ((color >> 24) & 0xFF)
        || (data[offset + 1]) != ((color >> 16) & 0xFF)
        || (data[offset + 2]) != ((color >> 8) & 0xFF)) {
        return false;
    }
    return true;
}

// The CanvasPixelArray object indicates the color components of each pixel of an image,
// first for each of its three RGB values in order (0-255) and then its alpha component (0-255),
// proceeding from left-to-right, for each row (rows are top to bottom).
// That's why we have to assign each color component separately.


function setPixelColor(img, x, y, color) {
    var data = img.data;
    var offset = ((y * (img.width * 4)) + (x * 4));
    data[offset + 0] = (color >> 24) & 0xFF;
    data[offset + 1] = (color >> 16) & 0xFF;
    data[offset + 2] = (color >> 8) & 0xFF;
}


function hexToRgbNew(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}


function CheckIfBlack(x, y, ctx) {

    var img = ctx.getImageData(x, y, 1, 1);
    var data = img.data;
    //var rgba = 'rgba(' + data[0] + ',' + data[1] +
    //    ',' + data[2] + ',' + data[3] + ')';
    // console.log(color.r + " " + color.g + " " + color.b + " " + color.a)
    console.log(data[0] + " " + data[1] + " " + data[2] + " " + data[3])

    if (data[0] == 0 && data[1] == 0 && data[2] == 0) {
        console.log("isBlack")

        return false
    }
    console.log(data[0] + " " + data[1] + " " + data[2] + " " + data[3])
    console.log("isNotBlack")

    return true

}

function compareColor(x, y, ctx, color) {

    var img = ctx.getImageData(x, y, 1, 1);
    var data = img.data;
    //var rgba = 'rgba(' + data[0] + ',' + data[1] +
    //    ',' + data[2] + ',' + data[3] + ')';


    console.log(data[0] + " " + data[1] + " " + data[2] + " " + data[3])

    if (data[0] == color.r && data[1] == color.g && data[2] == color.b) {

        return true
    }


    return false

}

function getColor(x, y, ctx, color) {
    var img = ctx.getImageData(x, y, 1, 1);
    var data = img.data;

    return {r: data[0], g: data[1], b: data[2]}
}

function clickGetPixle() {
    resetCanvasEvent()


    var isDrawing;

    canvas.onmousedown = function (e) {
        isDrawing = true;


        Xaxis = getPosition(event).x
        Yaxis = getPosition(event).y


        ctxFill1.moveTo(Xaxis, Yaxis);


    };
    canvas.onmousemove = function (e) {
        if (isDrawing) {
            if (xArr.contains(getPosition(event).x) && yArr.contains(getPosition(event).y)) {
                Xaxis = getPosition(event).x
                Yaxis = getPosition(event).y
                ctxFill1.lineTo(Xaxis, Yaxis);
                ctxFill1.stroke();
            }

        }
    };
    canvas.onmouseup = function () {
        canvas.onmousemove = function (e) {
        }
        isDrawing = false;
    };


}


Array.prototype.contains = function (obj) {
    var i = this.length;
    while (i--) {
        if (this[i] === obj) {
            return true;
        }
    }
    return false;
}


function setPixel(imageData, x, y, r, g, b, a) {
    index = (x + y * imageData.width) * 4;
    imageData.data[index + 0] = r;
    imageData.data[index + 1] = g;
    imageData.data[index + 2] = b;
    imageData.data[index + 3] = a;
}


tmp_canvasFillFill = ""


tmp_canvasFill = DomManhal.create('canvas')
tmpCtx = tmp_canvasFill.getContext("2d")
tmp_canvasFill1 = DomManhal.create('canvas')
tmpCtx1 = tmp_canvasFill1.getContext("2d")


function createTmpCanvas() {


    removeCanvas()
    tmp_canvasFill = DomManhal.create('canvas')
    tmp_canvasFill.id = "canvasT1"
    tmp_canvasFill.className = "canvasClassTmp"
    tmp_canvasFill.width = canvas.width
    tmp_canvasFill.height = canvas.height
    tmpCtx = tmp_canvasFill.getContext("2d")

    tmp_canvasFill1 = DomManhal.create('canvas')
    tmp_canvasFill1.width = canvas.width
    tmp_canvasFill1.height = canvas.height
    tmpCtx1 = tmp_canvasFill1.getContext("2d")
    tmp_canvasFill1.id = "canvasT2"
    tmp_canvasFill1.className = "canvasClassTmp"


    tmpCtx.mozImageSmoothingEnabled = true;
    tmpCtx.webkitImageSmoothingEnabled = true;
    tmpCtx.msImageSmoothingEnabled = true;
    tmpCtx.imageSmoothingEnabled = true;

    tmpCtx1.mozImageSmoothingEnabled = true;
    tmpCtx1.webkitImageSmoothingEnabled = true;
    tmpCtx1.msImageSmoothingEnabled = true;
    tmpCtx1.imageSmoothingEnabled = true;
}


var clientX, clientY, timeout;
var density = 50;
var radiusBoxSpray = 30
penType = 'magic'
var clickDisabled = false;
var clickDisabledCanvas = false;

var stillFill = false

//----------------------------------------------------------------------------------
function fillArea() {

    log("StartFillingFunction")


    if (penType == 'fill') {


    }

    // console.log("laod")
    resetCanvasEvent()
    createTmpCanvas()
    ctx = ctxFill1

    el = tmp_canvasFill
    var points = []

    var isDrawing, lastPoint;


    function StartAction() {

        $(".color-container").addClass("active")
        // $(".color-container").slideUp("slow", function () {

            // Animation complete.
        // });

        $(el).attr("disabled", "disabled");


        if (penType != "normal") {

            //if (clickDisabledCanvas == true) return false

            clickDisabledCanvas = true

            if (stillFill == true) return false

            stillFill = false
        }


        event.preventDefault()
        if (clickDisabled)
            return;
        onMouseDown(20)
        clickDisabled = true;
        setTimeout(function () {
            clickDisabled = false;
        }, 100);

        setTimeout(function () {
            el.onmousemove = function (e) {
                e.preventDefault()
                mouseMove()
            }

            el.ontouchmove = function (e) {
                e.preventDefault()
                mouseMove()
            }
        }, 100)


    }


    el.onmousedown = function (e) {

        StartAction()
    };


    el.onmouseup = function (e) {

        timeComp.old = new Date().getTime();
        e.preventDefault()
        el.onmousemove = function (e) {
        }
        mouseUp()
    };


    el.ontouchstart = function (e) {
        StartAction()
    };


    el.ontouchend = function (e) {
        timeComp.old = new Date().getTime();
        el.ontouchmove = function (e) {
            e.preventDefault()
        };
        e.preventDefault()
        mouseUp()
    };

    containerDiv.appendChild(tmp_canvasFill)


    var fillDone = "";

    function onMouseDown(value) {
        log("mouseDown")


        $(".main-color-container").hide()
        $('.flaticon-return13,.flaticon-arrows110').css({
            'pointer-events': 'auto'
        })
        finishSelectArea = false
        ctx.lineWidth = LineWidth;
        clearInterval(fillDone)


        if (penType == 'fill' && DrawMode != "erazer") {


            xArr.length = 0
            yArr.length = 0


            if (CheckIfBlack(getPosition(event).x, getPosition(event).y, ctx) == false) {
                mouseUp()

                return
            }

            removeWhiteFillMode()
            color = hexToRgbNew(colorChoose)
            console.log(color)

            color.a = 256
            timeOutBrush = false
            if (!finishSelectArea) {
                floodfill(getPosition(event).x, getPosition(event).y, color, ctxFill, canvas.width, canvas.height, 0);
            }


            fillDone = setInterval(function () {
                timeOutBrush = true;
                mouseMoveAllow = true;
                if (finishSelectArea) {
                    var imageData = ctxFill1.createImageData(canvas.width, canvas.height);

                    color = hexToRgbNew(colorChoose);
                    var r = color.r;
                    var g = color.g;
                    var b = color.b;


                    for (var i = 0; i < xArr.length; i++) {
                        setPixel(imageData, xArr[i], yArr[i], r, g, b, 255);
                    }


                    FillCanvasFloodCtx.putImageData(imageData, 0, 0);
                    soundEffect("sound/fillingClick.mp3")

                    ctxFill1.drawImage(FillCanvasFlood, 0, 0);
                    finishSelectArea = false
                    clearInterval(fillDone)
                }
            }, 0)
        }


        if (penType == 'magic') {
            soundEffectLoop("sound/penMove.mp3")
            xArr.length = 0
            yArr.length = 0
            if (CheckIfBlack(getPosition(event).x, getPosition(event).y, ctxFill) == false) return
            if (timeOutBrush) {

                color = hexToRgbNew(colorChoose)

                color.a = 256
                timeOutBrush = false

                floodfill(getPosition(event).x, getPosition(event).y, color, ctxFill, canvas.width, canvas.height, 0);


                setTimeout(function () {
                    timeOutBrush = true;
                    mouseMoveAllow = true;

                    var imageData = ctxFill1.createImageData(canvas.width, canvas.height);

                    color = hexToRgbNew(colorChoose);
                    var r = 10;
                    var g = 255;
                    var b = 255;


                    for (var i = 0; i < xArr.length; i++) {
                        setPixel(imageData, xArr[i], yArr[i], r, g, b, 255);
                    }


                    tmpCtx1.putImageData(imageData, 0, 0);
                    tmpCtx.fillStyle = 'white'
                    tmpCtx.fillRect(0, 0, tmp_canvasFill1.width, tmp_canvasFill1.height)
                    tmpCtx.drawImage(canvas1, 0, 0, tmp_canvasFill1.width, tmp_canvasFill1.height)

                    if (penType == 'magic') {
                        tmpCtx.globalCompositeOperation = "destination-out";
                    }

                    tmpCtx.drawImage(tmp_canvasFill1, 0, 0);


                }, value);
            }

            swapPenToEraze(ctx)
            isDrawing = true;
            ctx.lineWidth = LineWidth;


        }


        else if (penType == 'normal') {
            soundEffectLoop("sound/penMove.mp3")
            tmpCtx.clearRect(0, 0, canvas.width, canvas.height);
            removeWhite()
            isDrawing = true;
            ctx.lineWidth = LineWidth;
            swapPenToEraze(ctx)
        }


        ctx.lineJoin = ctx.lineCap = 'round';
        // swapPenToEraze(ctx)


        if (DrawingType == 'pen') {
            //Pen code mouseDown
            ctx.beginPath()
            ctx.moveTo(getPosition(event).x, getPosition(event).y);
        }


    }


    function mouseMove() {

        //Pen code mouseDown
        if (DrawingType == 'pen') {

            if (isDrawing) {


                ctx.lineTo(getPosition(event).x, getPosition(event).y);
                ctx.stroke();
            }
        }

    }


    function mouseUp() {


        if ($('.SoundEffect').length > 0)
            $('.SoundEffect').remove();
        UiMouseDown.ShowOnMouseDown()
        clearTimeout(timeout);
        ctx.closePath()
        //ctx.shadowColor = 'rgba(0, 20, 0,0)';
        tmpCtx.globalCompositeOperation = "source-over";
        ctxFill1.globalCompositeOperation = "source-over";

        ctxFill1.drawImage(tmp_canvasFill, 0, 0, canvas.width, canvas.height)


        cPush()

        isDrawing = false;
        points.length = 0;

        fillArea()


    }

}


function removeCanvas() {
    if ($('.canvasClassTmp')) $('.canvasClassTmp').remove()

}

DrawMode = 'pen'

function swapPenToEraze(ctx) {

    if (DrawMode == "erazer") {
        ctx.globalCompositeOperation = "destination-out";
    } else {
        color = hexToRgbNew(colorChoose)
        ctx.globalCompositeOperation = 'source-over';

        ctx.fillStyle = "rgba(" + color.r + "," + color.g + "," + color.b + ',' + 0.2 + ")";
        ctx.strokeStyle = "rgba(" + color.r + "," + color.g + "," + color.b + ',' + 0.2 + ")";
    }
}


function removeWhite() {
    tmpCtx.drawImage(canvasBackTmpMask, 0, 0, canvas.width, canvas.height)
    var imageData = tmpCtx.getImageData(0, 0, canvas.width, canvas.height);
    var data = imageData.data;

    // iterate over all pixels
    for (var i = 0, n = data.length; i < n; i += 4) {


        var red = data[i];
        var green = data[i + 1];
        var blue = data[i + 2];
        var alpha = data[i + 3];

        if (red >= 0 && green >= 88 && blue >= 88) {
            data[i + 3] = 0

        }
    }

    tmpCtx.putImageData(imageData, 0, 0);
}


function distanceBetween(point1, point2) {
    return Math.sqrt(Math.pow(point2.x - point1.x, 2) + Math.pow(point2.y - point1.y, 2));
}

function angleBetween(point1, point2) {
    return Math.atan2(point2.x - point1.x, point2.y - point1.y);
}

function getRandomFloat(min, max) {
    return Math.random() * (max - min) + min;
}

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function midPointBtw(p1, p2) {
    return {
        x: p1.x + (p2.x - p1.x) / 2,
        y: p1.y + (p2.y - p1.y) / 2
    };
}


function getPixel(pixelData, x, y) {
    if (x < 0 || y < 0 || x >= pixelData.width || y >= pixelData.height) {
        return -1;  // impossible color
    } else {
        return pixelData.data[y * pixelData.width + x];
    }
}

function floodFillNew(ctx, x, y, fillColor) {
    // read the pixels in the canvas
    const imageData = ctx.getImageData(0, 0, ctx.canvas.width, ctx.canvas.height);

    // make a Uint32Array view on the pixels so we can manipulate pixels
    // one 32bit value at a time instead of as 4 bytes per pixel
    const pixelData = {
        width: imageData.width,
        height: imageData.height,
        data: new Uint32Array(imageData.data.buffer),
    };

    // get the color we're filling
    const targetColor = getPixel(pixelData, x, y);

    // check we are actually filling a different color
    if (targetColor !== fillColor) {

        const pixelsToCheck = [x, y];
        while (pixelsToCheck.length > 0) {
            const y = pixelsToCheck.pop();
            const x = pixelsToCheck.pop();

            const currentColor = getPixel(pixelData, x, y);
            if (currentColor === targetColor) {
                pixelData.data[y * pixelData.width + x] = fillColor;
                pixelsToCheck.push(x + 1, y);
                pixelsToCheck.push(x - 1, y);
                pixelsToCheck.push(x, y + 1);
                pixelsToCheck.push(x, y - 1);
            }
        }

        // put the data back
        ctx.putImageData(imageData, 0, 0);
    }
}
