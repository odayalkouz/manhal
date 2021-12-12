var DomSema = {
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

function floodfill(x, y, fillcolor, ctx, W, H) {

    xArr.length = 0
    yArr.length = 0;

    if (CheckIfBlack(x, y, ctx) == false)return;

    // Putting the offsets in such an order as to minimize the
    // possibility of cache miss during array access.
    var dx = [0, -1, +1, 0],
        dy = [-1, 0, 0, +1];

    var x = Math.round(x),
        y = Math.round(y),
        img = ctx.getImageData(0, 0, W, H),
        imgData = img.data,
        hitColor = getPixelColor(imgData, x, y),
        stack = [];

    stack.push(x);
    stack.push(y);

    fillcolor = (fillcolor.r << 24) | (fillcolor.g << 16) | (fillcolor.b << 8);

    // halt if attempting to fill with the same color ...
    if (Math.abs(hitColor) == fillcolor)
        return false;

    //console.log('try to fill : ', hitColor, ' with ', fillcolor);

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

            if (imgData[nextPointOffset + 0] == ((hitColor >> 24) & 0xFF)
                && imgData[nextPointOffset + 1] == ((hitColor >> 16) & 0xFF)
                && imgData[nextPointOffset + 2] == ((hitColor >> 8) & 0xFF)) {

                // Inline implementation of setPixelColor.
                imgData[nextPointOffset + 0] = (fillcolor >> 24) & 0xFF;
                imgData[nextPointOffset + 1] = (fillcolor >> 16) & 0xFF;
                imgData[nextPointOffset + 2] = (fillcolor >> 8) & 0xFF;

                stack.push(nextPointX);
                stack.push(nextPointY);
                xArr.push(nextPointX)
                yArr.push(nextPointY)
            }
        }
    }

    if (penType == 'fill')     ctx.putImageData(img, 0, 0);
    //  console.log(' === > done fill');
    finishSelectArea = true
    console.log("filleDone: " + finishSelectArea)
    function getPixelColor(imgData, x, y) {
        var offset = (x + y * W) * 4,
            result = imgData[offset + 0] << 24; // r
        result |= imgData[offset + 1] << 16; // g
        result |= imgData[offset + 2] << 8; // b
        // result |= imgData[offset + 3]; // a
        return result;
    }
}
//function floodfill(x,y,fillcolor,ctx,width,height,tolerance) {
//    xArr.length=0
//    yArr.length=0
//    if(CheckIfBlack(x,y,ctx)==false)return
//
//    var img = ctx.getImageData(0,0,width,height);
//    var data = img.data;
//    var length = data.length;
//    var Q = [];
//    var i = (x+y*width)*4;
//    var e = i, w = i, me, mw, w2 = width*4;
//    var targetcolor = [data[i],data[i+1],data[i+2],data[i+3]];
//    var targettotal = data[i]+data[i+1]+data[i+2]+data[i+3];
//
//    if(!pixelCompare(i,targetcolor,targettotal,fillcolor,data,length,tolerance)) { return false; }
//    Q.push(i);
//    while(Q.length) {
//        i = Q.pop();
//        if(pixelCompareAndSet(i,targetcolor,targettotal,fillcolor,data,length,tolerance)) {
//            e = i;
//            w = i;
//            mw = parseInt(i/w2)*w2; //left bound
//            me = mw+w2;	//right bound
//            while(mw<(w-=4) && pixelCompareAndSet(w,targetcolor,targettotal,fillcolor,data,length,tolerance)); //go left until edge hit
//            while(me>(e+=4) && pixelCompareAndSet(e,targetcolor,targettotal,fillcolor,data,length,tolerance)); //go right until edge hit
//
//            for(var j=w;j<e;j+=4) {
//                if(j-w2>=0 		&& pixelCompare(j-w2,targetcolor,targettotal,fillcolor,data,length,tolerance)) Q.push(j-w2); //queue y-1
//                if(j+w2<length	&& pixelCompare(j+w2,targetcolor,targettotal,fillcolor,data,length,tolerance)) Q.push(j+w2); //queue y+1
//            }
//        }
//    }
//   // if(penType=='fill')     ctx.putImageData(img,0,0);
//}

function pixelCompare(i, targetcolor, targettotal, fillcolor, data, length, tolerance) {
    if (i < 0 || i >= length) return false; //out of bounds
    if (data[i + 3] === 0)  return true;  //surface is invisible

    if (
        (targetcolor[3] === fillcolor.a) &&
        (targetcolor[0] === fillcolor.r) &&
        (targetcolor[1] === fillcolor.g) &&
        (targetcolor[2] === fillcolor.b)
    ) return false; //target is same as fill

    if (
        (targetcolor[3] === data[i + 3]) &&
        (targetcolor[0] === data[i]  ) &&
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


    if (data[1] == 0 && data[1] == 0 && data[2] == 0 && data[3] == 255) {

        return false
    }

    return true

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


tmp_canvasFill = DomSema.create('canvas')
tmpCtx = tmp_canvasFill.getContext("2d")
tmp_canvasFill1 = DomSema.create('canvas')
tmpCtx1 = tmp_canvasFill1.getContext("2d")


function createTmpCanvas() {
    removeCanvas()
    tmp_canvasFill = DomSema.create('canvas')
    tmp_canvasFill.id = "canvasT1"
    tmp_canvasFill.className = "canvasClassTmp"
    tmp_canvasFill.width = canvas.width
    tmp_canvasFill.height = canvas.height
    tmpCtx = tmp_canvasFill.getContext("2d")

    tmp_canvasFill1 = DomSema.create('canvas')
    tmp_canvasFill1.width = canvas.width
    tmp_canvasFill1.height = canvas.height
    tmpCtx1 = tmp_canvasFill1.getContext("2d")
    tmp_canvasFill1.id = "canvasT2"
    tmp_canvasFill1.className = "canvasClassTmp"


    tmpCtx.mozImageSmoothingEnabled = false;
    tmpCtx.webkitImageSmoothingEnabled = false;
    tmpCtx.msImageSmoothingEnabled = false;
    tmpCtx.imageSmoothingEnabled = false;

    tmpCtx1.mozImageSmoothingEnabled = false;
    tmpCtx1.webkitImageSmoothingEnabled = false;
    tmpCtx1.msImageSmoothingEnabled = false;
    tmpCtx1.imageSmoothingEnabled = false;
}


var clientX, clientY, timeout;
var density = 50;
var radiusBoxSpray = 30
penType = 'magic'
var clickDisabled = false;


//----------------------------------------------------------------------------------
function fillArea() {

    resetCanvasEvent()
    createTmpCanvas()
    ctx = ctxFill1

    el = tmp_canvasFill
    var points = []

    var isDrawing, lastPoint;

    el.onmousedown = function (e) {


        dur = timeComp.old - timeComp.new;
        console.log("lllll" + dur)
        if (dur < 150 && timeComp.old > timeComp.new)return
        timeComp.new = new Date().getTime();
        e.preventDefault()
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
        }, 100)
    };


    el.onmouseup = function (e) {

        timeComp.old = new Date().getTime();
        e.preventDefault()
        el.onmousemove = function (e) {
        }
        mouseUp()
    };


    el.ontouchstart = function (e) {
        e.preventDefault()
        dur = timeComp.old - timeComp.new;
        console.log(dur)
        if (dur < 150 && timeComp.old > timeComp.new)return
        timeComp.new = new Date().getTime();
        e.preventDefault()
        if (clickDisabled)
            return;
        onMouseDown(20)
        clickDisabled = true;
        setTimeout(function () {
            clickDisabled = false;
        }, 100);
        setTimeout(function () {
            el.ontouchmove = function (e) {
                e.preventDefault()
                mouseMove()
            }
        }, 100)
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
        $(".main-color-container").hide()
        $('.flaticon-return13,.flaticon-arrows110').css({
            'pointer-events': 'auto'
        })
        finishSelectArea = false
        // UiMouseDown.hideOnMouseDown()
        // hideAllPobup()
        // hideColor()
        ctx.lineWidth = LineWidth;
        clearInterval(fillDone)


        if (penType == 'fill' && DrawMode!="erazer") {


            xArr.length = 0
            yArr.length = 0
            if (CheckIfBlack(getPosition(event).x, getPosition(event).y, ctxFill) == false)return

            // console.log('TimeoutDone')
            removeWhiteFillMode()
            color = hexToRgbNew(colorChoose)

            color.a = 256
            timeOutBrush = false
            //console.log(color)
            if (!finishSelectArea) {
                console.log("getArea")
                floodfill(getPosition(event).x, getPosition(event).y, color, ctxFill, canvas.width, canvas.height, 0);
            }


            fillDone = setInterval(function () {
                timeOutBrush = true;
                mouseMoveAllow = true;
                console.log("checkIfDone")
                if (finishSelectArea) {
                    console.log("done_______________________________")
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
            }, 50)
        }


        if (penType == 'magic') {
            soundEffectLoop("sound/penMove.mp3")
            xArr.length = 0
            yArr.length = 0
            if (CheckIfBlack(getPosition(event).x, getPosition(event).y, ctxFill) == false)return
            if (timeOutBrush) {

                color = hexToRgbNew(colorChoose)

                color.a = 256
                timeOutBrush = false

                floodfill(getPosition(event).x, getPosition(event).y, color, ctxFill, canvas.width, canvas.height, 0);


                setTimeout(function () {
                    timeOutBrush = true;
                    mouseMoveAllow = true;

                    /*
                     var minX = Math.min.apply(null, xArr),
                     maxX = Math.max.apply(null, xArr);


                     var minY = Math.min.apply(null, yArr),
                     maxY = Math.max.apply(null, yArr);

                     bounding = {
                     width: maxX - minX,
                     height: maxY - minY,
                     y: minY,
                     x: minX
                     }*/

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


            // console.log('mouseDown')
            isDrawing = true;
            ctx.lineWidth = LineWidth;

        }
        else if (penType == 'normal') {
            soundEffectLoop("sound/penMove.mp3")
            tmpCtx.clearRect(0, 0, canvas.width, canvas.height);
            removeWhite()
            //  console.log('mouseDown')
            isDrawing = true;
            ctx.lineWidth = LineWidth;

        }


        ctx.lineJoin = ctx.lineCap = 'round';
        swapPenToEraze(ctx)


        if (DrawingType == 'pen') {
            //Pen code mouseDown
            ctx.beginPath()
            ctx.moveTo(getPosition(event).x, getPosition(event).y);
        }

        if (DrawingType == 'withimage') {
            //Pen code mouseDown
            lastPoint = {x: getPosition(event).x, y: getPosition(event).y};
        }


        if (DrawingType == 'spray') {

            //Spray
            //code
            //mouseDown
            clientX = getPosition(event).x;
            clientY = getPosition(event).y;
            timeout = setTimeout(function draw() {
                for (var i = density; i--;) {

                    if (sprayType == 'circle')
                        var angle = getRandomFloat(0, Math.PI * 2);
                    var radius = getRandomFloat(0, radiusBoxSpray);

                    ctx.fillRect(
                        clientX + radius * Math.cos(angle),
                        clientY + radius * Math.sin(angle),
                        1, 1);
                }
                if (sprayType == 'square') {
                    var offsetX = getRandomInt(-radiusBoxSpray, radiusBoxSpray);
                    var offsetY = getRandomInt(-radiusBoxSpray, radiusBoxSpray);
                    ctx.fillRect(clientX + offsetX, clientY + offsetY, 1, 1);
                }


                if (!timeout) return;
                timeout = setTimeout(draw, 50);
            }, 50);
        }
    }


    function mouseMove() {

        //Pen code mouseDown
        if (DrawingType == 'pen') {

            if (isDrawing) {


                // console.log('mouseDown')
                ctx.lineTo(getPosition(event).x, getPosition(event).y);
                ctx.stroke();
            }
        }
        if (DrawingType == 'spray') {
            //Spary code mouseDown
            clientX = getPosition(event).x;
            clientY = getPosition(event).y;
        }

        if (DrawingType == 'withimage') {
            if (!isDrawing) return;

            var currentPoint = {x: getPosition(event).x, y: getPosition(event).y};
            var dist = distanceBetween(lastPoint, currentPoint);
            var angle = angleBetween(lastPoint, currentPoint);

            for (var i = 0; i < dist; i++) {
                x = lastPoint.x + (Math.sin(angle) * i) - 25;
                y = lastPoint.y + (Math.cos(angle) * i) - 25;
                ctx.drawImage(imgBrush, x, y);
            }

            lastPoint = currentPoint;
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
        if (penType == 'fill') {

            //  ctxFill1.drawImage(FillCanvasFlood, 0, 0, canvas.width, canvas.height)
        }
        else {
            ctxFill1.drawImage(tmp_canvasFill, 0, 0, canvas.width, canvas.height)
        }
        cPush()
        // removeCanvas()
        isDrawing = false;
        points.length = 0;
    }

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

function removeCanvas() {
    if ($('.canvasClassTmp'))$('.canvasClassTmp').remove()

}

DrawMode = 'pen'
function swapPenToEraze(ctx) {

    if (DrawMode == 'pen' || DrawMode == 'fill') {
        color = hexToRgbNew(colorChoose)
        ctx.globalCompositeOperation = 'source-over';

        ctx.fillStyle = "rgba(" + color.r + "," + color.g + "," + color.b + ',' + 0.2 + ")";
        ctx.strokeStyle = "rgba(" + color.r + "," + color.g + "," + color.b + ',' + 0.2 + ")";
        if (DrawingType == 'spray') {

            ctx.fillStyle = colorChoose
            ctx.strokeStyle = colorChoose
        }


    } else {

        console.log('erazerCho')
        selectErazer()
        ctx.globalCompositeOperation = 'destination-out';
        ctx.fillStyle = 'rgba(0,0,0,1)';
        ctx.strokeStyle = 'rgba(0,0,0,1)';


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

        if (red >= 000 && green >= 100 && blue >= 100) {
            data[i + 3] = 0

        }
    }

    tmpCtx.putImageData(imageData, 0, 0);
}
