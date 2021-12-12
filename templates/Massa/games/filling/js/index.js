//var srcSt = getSrcImageStoryBuilder();
//arrayOfImages=['images/a.png']
arrayOfImages=[localStorage['fillingSrcImage']]
//arrayOfImages="../../images/story/st6/images/1.png"
//alert(localStorage['fillingSrcImage'])
arrayOfImagesLoaded=[]
imgCreate=""

function showloading(o){$("<div class='loading'></div>").hide().appendTo(o).fadeIn("slow");}
function hideloading(){$(".loading").fadeOut("slow",function(){$(".loading").remove();});}

var DomSema={
    get:function(id)
    {
        return document.getElementById(id);
    },
    create:function(type)
    {
        return document.createElement(type);
    }
};


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

    if (checkIFPc()) {

        var x = event.pageX - $(targ).offset().left;
        var y = event.pageY - $(targ).offset().top;
    }
    else{
        var x = event.touches[0].pageX - $(targ).offset().left;
        var y = event.touches[0].pageY - $(targ).offset().top;

    }

    return {"x": x, "y": y};
};

var canvas,ctxFill,containerDiv,containerDivAll="";


function resizeCanvasToScreen() {
    canvasResize = [canvas,canvas1,tmp_canvasFill,canvasBackTmpMask,FillCanvasFlood]
    containerDivAll.style.width=window.innerWidth+'px'
    containerDivAll.style.height =window.innerHeight+'px'


    for (var i = 0; i < canvasResize.length; i++) {
        if(canvasResize[i]) {
            canvasResize[i].style.width = '100%'
            canvasResize[i].style.height = '100%'
            canvasResize[i].width = canvasResize[i].offsetWidth;
            canvasResize[i].height = canvasResize[i].offsetHeight;
        }
    }

}


function DrawImageOnCanvas(){


    //ctxFill1.mozImageSmoothingEnabled = false;
    //ctxFill1.webkitImageSmoothingEnabled = false;
    //ctxFill1.msImageSmoothingEnabled = false;
    //ctxFill1.imageSmoothingEnabled = false;

    var coord=calculateAspectRatioFit(arrayOfImagesLoaded[0].width, arrayOfImagesLoaded[0].height, canvas1.width, canvas1.height)

    ctxFill.mozImageSmoothingEnabled = false;
    ctxFill.webkitImageSmoothingEnabled = false;
    ctxFill.msImageSmoothingEnabled = false;
    ctxFill.imageSmoothingEnabled = false;

    var coord=calculateAspectRatioFit(arrayOfImagesLoaded[0].width, arrayOfImagesLoaded[0].height, canvas1.width, canvas1.height)

    //ctxCanvasBackTmpMask.mozImageSmoothingEnabled = false;
    //ctxCanvasBackTmpMask.webkitImageSmoothingEnabled = false;
    //ctxCanvasBackTmpMask.msImageSmoothingEnabled = false;
    //ctxCanvasBackTmpMask.imageSmoothingEnabled = false;

    ctxCanvasBackTmpMask.drawImage(arrayOfImagesLoaded[0],canvas1.width / 2 - coord.width / 2, canvas1.height / 2 - coord.height / 2,coord.width,coord.height)


    ctxFill1.fillStyle = 'white'
    ctxFill.fillStyle = 'white'
    ctxFill.fillRect(0, 0, tmp_canvasFill1.width, tmp_canvasFill1.height)
    ctxFill1.fillRect(0, 0, tmp_canvasFill1.width, tmp_canvasFill1.height)
    ctxFill.drawImage(arrayOfImagesLoaded[0],canvas1.width / 2 - coord.width / 2, canvas1.height / 2 - coord.height / 2,coord.width,coord.height)
    ctxFill1.drawImage(arrayOfImagesLoaded[0],canvas1.width / 2 - coord.width / 2, canvas1.height / 2 - coord.height / 2,coord.width,coord.height)


    cPush()
    hideloading()
}




function preload(arrayOfImages)
{
    $(arrayOfImages).each(function(i){

        imgCreate=DomSema.create("img");
        imgCreate.src=this
        arrayOfImagesLoaded[0]= imgCreate
        imgCreate.onload=function(){

            DrawImageOnCanvas()
        }
    });




}




function resizeDW(){
    /*  myScroll = new IScroll('#controlPanel', {
     mouseWheel: true,
     scrollbars: true,
     bounceEasing: 'elastic', bounceTime: 1200
     });*/
    data= canvas1.toDataURL()
    canvasFillData= tmp_canvasFill.toDataURL()


    tmpCtx.globalCompositeOperation="source-over";




    imgResize.src=data
    imgResizeMask.src=canvasFillData
    resizeCanvasToScreen()
    imgResize.onload=function(){



    }
    imgResize.onload=function(){
        ctxCanvasBackTmpMask.fillStyle = 'white'
        ctxFill1.fillStyle = 'white'
        ctxFill.fillStyle = 'white'
        ctxFill.fillRect(0, 0, tmp_canvasFill1.width, tmp_canvasFill1.height)
        ctxFill1.fillRect(0, 0, tmp_canvasFill1.width, tmp_canvasFill1.height)
        ctxCanvasBackTmpMask.fillRect(0, 0, tmp_canvasFill1.width, tmp_canvasFill1.height)

        ctxFill1.mozImageSmoothingEnabled = false;
        ctxFill1.webkitImageSmoothingEnabled = false;
        ctxFill1.msImageSmoothingEnabled = false;
        ctxFill1.imageSmoothingEnabled = false;

        var coord=calculateAspectRatioFit(arrayOfImagesLoaded[0].width, arrayOfImagesLoaded[0].height, canvas1.width, canvas1.height)
        ctxFill1.drawImage(arrayOfImagesLoaded[0],canvas1.width / 2 - coord.width / 2, canvas1.height / 2 - coord.height / 2,coord.width,coord.height)

        ctxFill.mozImageSmoothingEnabled = false;
        ctxFill.webkitImageSmoothingEnabled = false;
        ctxFill.msImageSmoothingEnabled = false;
        ctxFill.imageSmoothingEnabled = false;

        var coord=calculateAspectRatioFit(arrayOfImagesLoaded[0].width, arrayOfImagesLoaded[0].height, canvas1.width, canvas1.height)
        ctxFill.drawImage(arrayOfImagesLoaded[0],canvas1.width / 2 - coord.width / 2, canvas1.height / 2 - coord.height / 2,coord.width,coord.height)


        ctxCanvasBackTmpMask.mozImageSmoothingEnabled = false;
        ctxCanvasBackTmpMask.webkitImageSmoothingEnabled = false;
        ctxCanvasBackTmpMask.msImageSmoothingEnabled = false;
        ctxCanvasBackTmpMask.imageSmoothingEnabled = false;

        ctxCanvasBackTmpMask.drawImage(arrayOfImagesLoaded[0],canvas1.width / 2 - coord.width / 2, canvas1.height / 2 - coord.height / 2,coord.width,coord.height)

    }

}


function loadNewImage(src){
    arr=[]
    arr.push(src)
    preload(arr)

}



var timeOutBrush = true;
var colorChoose=colorsCollection[1]
var mouseMoveAllow=false
function floodFillAction(tmp_canvas){

    removeCanvas()
    resetCanvasEvent()
    removeWhite()
    tmp_canvasFill.onmousedown=function(event){
        alert()
        event.preventDefault()
        tmp_canvasFill.onmousemove=function(event){console.log('mouseMove2')}
        tmp_canvasFill.onmouseup=function(event){ event.preventDefault()}
        if(timeOutBrush){

            color=hexToRgbNew(colorChoose)

            color.a=256
            timeOutBrush=false
            console.log(color)
            floodfill(getPosition(event).x,getPosition(event).y,color,ctxFill,tmp_canvasFill1.width,tmp_canvasFill1.height,0);
            cPush()

            setTimeout(function(){ timeOutBrush=true;mouseMoveAllow=true;  },50);
        }
    }


}


function resetCanvas(){
    showloading(document.body)
    ctxFill1.globalCompositeOperation = 'source-over';
    ctxFill.globalCompositeOperation = 'source-over';
    ctxFill.clearRect(0,0,canvas.width,canvas.height)
    ctxFill1.clearRect(0,0,canvas1.width,canvas1.height)
    preload(arrayOfImages)
    floodFillAction(canvas1)
    toggleShow()
}



function eraze_tool()
{


    resetCanvasEvent()
    function midPointBtw(p1, p2) {
        return {
            x: p1.x + (p2.x - p1.x) / 2,
            y: p1.y + (p2.y - p1.y) / 2
        };
    }

    ctxFill1.lineWidth=5
    ctxFill1.lineJoin = ctxFill1.lineCap = 'round';

    var isDrawing, points = [ ];

    canvas.ontouchstart=function(e){
        e.preventDefault()
        isDrawing = true;
        points.push({ x: getPosition(e).x, y: getPosition(e).y });
    };

    canvas.onmousedown=function(e){
        e.preventDefault()
        isDrawing = true;
        points.push({ x: getPosition(e).x, y: getPosition(e).y });
    };

    canvas.ontouchmove=function(e){
        e.preventDefault()
        if (!isDrawing) return;

        points.push({ x: getPosition(e).x, y: getPosition(e).y });



        var p1 = points[0];
        var p2 = points[1];

        ctxFill1.beginPath();
        ctxFill1.moveTo(p1.x, p1.y);

        ctxFill1.globalCompositeOperation = 'destination-out';
        ctxFill1.fillStyle = 'rgba(0,0,0,1)';
        ctxFill1.strokeStyle = 'rgba(0,0,0,1)';
        for (var i = 1, len = points.length; i < len; i++) {
            // we pick the point between pi+1 & pi+2 as the
            // end point and p1 as our control point
            var midPoint = midPointBtw(p1, p2);
            ctxFill1.quadraticCurveTo(p1.x, p1.y, midPoint.x, midPoint.y);
            p1 = points[i];
            p2 = points[i+1];
        }
        // Draw last line as a straight line while
        // we wait for the next point to be able to calculate
        // the bezier control point
        ctxFill1.lineTo(p1.x, p1.y);
        ctxFill1.stroke();
    };


    canvas.onmousemove=function(e){
        e.preventDefault()
        if (!isDrawing) return;

        points.push({ x: getPosition(e).x, y: getPosition(e).y });





        var p1 = points[0];
        var p2 = points[1];

        ctxFill1.beginPath();
        ctxFill1.moveTo(p1.x, p1.y);

        ctxFill1.globalCompositeOperation = 'destination-out';
        ctxFill1.fillStyle = 'rgba(0,0,0,1)';
        ctxFill1.strokeStyle = 'rgba(0,0,0,1)';
        for (var i = 1, len = points.length; i < len; i++) {
            // we pick the point between pi+1 & pi+2 as the
            // end point and p1 as our control point
            var midPoint = midPointBtw(p1, p2);
            ctxFill1.quadraticCurveTo(p1.x, p1.y, midPoint.x, midPoint.y);
            p1 = points[i];
            p2 = points[i+1];
        }
        // Draw last line as a straight line while
        // we wait for the next point to be able to calculate
        // the bezier control point
        ctxFill1.lineTo(p1.x, p1.y);
        ctxFill1.stroke();
    };
    canvas.ontouchend = function(e) {
        e.preventDefault()
        isDrawing = false;

        points.length = 0;

    };

    canvas.onmouseup = function(e) {
        e.preventDefault()
        isDrawing = false;

        points.length = 0;

    };

}



function resetCanvasEvent(){
    canvas.onclick=function(e){ e.preventDefault()}
    canvas.onmousedown=function(e){ e.preventDefault()}
    canvas.onmousemove=function(e){ e.preventDefault()}
    canvas.onmouseup=function(e){ e.preventDefault()}

    canvas.ontouchend=function(e){ e.preventDefault()}
    canvas.ontouchmove=function(e){ e.preventDefault()}
    canvas.ontouchstart=function(e){ e.preventDefault()}

    tmp_canvasFill.onclick=function(e){ e.preventDefault()}
    tmp_canvasFill.onmousedown=function(e){ e.preventDefault()}
    tmp_canvasFill.onmousemove=function(e){ e.preventDefault()}
    tmp_canvasFill.onmouseup=function(e){ e.preventDefault()}

    tmp_canvasFill.ontouchend=function(e){ e.preventDefault()}
    tmp_canvasFill.ontouchmove=function(e){ e.preventDefault()}
    tmp_canvasFill.ontouchstart=function(e){ e.preventDefault()}

}



function print_img() {
    var win = window.open();
    win.document.write("<img src='" + canvas1.toDataURL() + "'/>");
    win.print();
    // win.location.reload();
    hideColor();
    if($('.downloadBox'))$('.downloadBox').remove()
}






function downloadImage(){

    hideColor()
    if($('.downloadBox'))$('.downloadBox').remove()

    strDownloadBox=''
    strDownloadBox+='<div class="downloadBox"> <span id="closeD">X</span></div>'

    imgStr="<img style='width:50%;height:50%' src='" + canvas1.toDataURL() + "'/>"
    $(strDownloadBox).appendTo(document.body)
    $(imgStr).appendTo('.downloadBox').hide().show('fast')

    $('<a id="linkDownload" ></a>').appendTo('.downloadBox').hide().show('fast')
    link=DomSema.get("linkDownload");
    link.innerHTML = 'Download';
    link.addEventListener('click', function(ev) {
        link.href = canvas1.toDataURL();
        link.download = "semaFillStory.png";
        if($('.downloadBox'))$('.downloadBox').remove()
    }, false);
    closeD=DomSema.get("closeD");
    closeD.addEventListener('click', function(ev) {
        if($('.downloadBox'))$('.downloadBox').remove()
    }, false);


}


function calculateAspectRatioFit(srcWidth, srcHeight, maxWidth, maxHeight) {

    var ratio = Math.min(maxWidth / srcWidth, maxHeight / srcHeight);

    return { width: srcWidth*ratio, height: srcHeight*ratio };
}

var imgResize=new Image()
var imgResizeMask=new Image()
var doit=""
window.onresize = function(event) {

    clearTimeout(doit);
    doit = setTimeout(resizeDW, 100);

    startColorPicker()

};
DrawingType = 'pen'
sprayType='circle'
canvasBackTmpMask=""
ctxCanvasBackTmpMask=""
var LineWidth=30
myScroll=""
$( document ).ready(function() {
    BackgroundSound('sound/drawing.mp3');
    showloading(document.body)
    $('#size4').addClass('select_wrapper')
    console.log( "ready!" );
    containerDivAll=DomSema.get("gameConainer");
    canvas = DomSema.get("canvas");
    canvas1 = DomSema.get("canvas1");


    canvasBackTmpMask =DomSema.get("canvasBackTmpMask");

    containerDiv=DomSema.get("canvasContainer");
    ctxFill = canvas.getContext("2d");
    ctxFill1 = canvas1.getContext("2d");
    ctxCanvasBackTmpMask=canvasBackTmpMask.getContext("2d");
    resizeCanvasToScreen()
    preload(arrayOfImages)
    //floodFillAction(canvas1)
    //loadColor()

    fillArea()
    startColorPicker()


    $('#penselect').click( function(){
        magicPen()
    })

    $(".sizeCtx").css('background',colorChoose);
    $(".sizeCtx").click(function(){
        flipSound()
        $(".sizeCtx").removeClass('select_wrapper')
        $(this).addClass('select_wrapper')

        if($(this).attr('id')=='size5'){

            LineWidth=45
            radiusBoxSpray = 55
        }
        if($(this).attr('id')=='size4'){
            LineWidth=35
            radiusBoxSpray = 40
        }
        if($(this).attr('id')=='size3'){
            LineWidth=25
            radiusBoxSpray = 29
        }
        if($(this).attr('id')=='size2'){
            LineWidth = 20
            radiusBoxSpray= 25
        }
        if($(this).attr('id')=='size1'){
            LineWidth=12
            radiusBoxSpray = 15
        }
        change_Image_color()

    })
    loadorgIcon()

});



function morePen(){
    event.stopPropagation();
    event.preventDefault();
    flipSound()

    $('#morePenCont').toggle()
    $('#morePen').hide()
    // $("penselect").click()
}

function magicPen(object){
    soundEffect("sound/slidemenu.mp3")
    event.stopPropagation();
    event.preventDefault();
    penType='magic'
    flipSound();DrawMode='pen';
    $('#penselect').css('background','url(images/icons/7.png) no-repeat')
    $('#penselect').css('background-size','100%')

    DrawingType='pen'
    morePen()
    $('#morePen').show()
    $('#morePenCont').hide()
    $('#penselect').unbind('click')
    $('#penselect').click( function(){

        $('.iconsMenu').removeClass('active_equation')
        $('#penselect').addClass('active_equation')

        magicPen()
    })
    if(DrawMode=="erazer")
    { fillArea()}
}

function normalPen(object){
    soundEffect("sound/slidemenu.mp3")
    event.stopPropagation();
    event.preventDefault();
    penType='normal';
    DrawingType='pen'
    flipSound();DrawMode='pen';
    $('#penselect').css('background','url(images/icons/17.png) no-repeat')
    $('#penselect').css('background-size','100%')

    morePen()
    $('#morePen').show()
    $('#morePenCont').hide()
    $('#penselect').unbind('click')
    $('#penselect').click( function(){
        $('.iconsMenu').removeClass('active_equation')
        $('#penselect').addClass('active_equation')
        normalPen()
    })
    if(DrawMode=="erazer")
    { fillArea()}
}

FillCanvasFlood=FillCanvasFloodCtx=""
function fillPen(object){
    soundEffect("sound/slidemenu.mp3")
    event.stopPropagation();
    event.preventDefault();

    if($('#FillCanvasFlood'))$('#FillCanvasFlood').remove()
    FillCanvasFlood = DomSema.create('canvas')
    FillCanvasFlood.id = "FillCanvasFlood"
    FillCanvasFlood.className = "canvasClassTmp2"
    FillCanvasFlood.width = canvas.width
    FillCanvasFlood.height = canvas.height
    FillCanvasFloodCtx = FillCanvasFlood.getContext("2d")

    removeWhiteFillMode()

    document.getElementById('canvasContainer').appendChild(FillCanvasFlood)

    penType='fill';
    DrawingType='pen'
    flipSound();DrawMode='fill';
    $('#penselect').css('background','url(images/icons/12.png) no-repeat')
    $('#penselect').css('background-size','100%')

    morePen()
    $('#morePen').show()
    $('#morePenCont').hide()
    $('#penselect').unbind('click')
    $('#penselect').click( function(){
        $('.iconsMenu').removeClass('active_equation')
        $('#penselect').addClass('active_equation')
        fillPen()
    })
    if(DrawMode=="erazer")
    { fillArea()}

}

function stopDraw(object){
    event.stopPropagation();
    event.preventDefault();
    penType='stop'
    flipSound();DrawMode='stop';
    $('#penselect').css('background','url(images/icons/9.png) no-repeat')
    $('#penselect').css('background-size','100%')

    morePen()
    $('#morePen').show()
    $('#morePenCont').hide()
    $('#penselect').unbind('click')
    $('#penselect').click( function(){
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



function removeWhiteFillMode(){
    FillCanvasFloodCtx.drawImage(canvasBackTmpMask, 0, 0, canvas.width, canvas.height)
    /*   var imageData = FillCanvasFloodCtx.getImageData(0, 0, canvas.width, canvas.height);
     var data = imageData.data;

     // iterate over all pixels
     for(var i = 0, n = data.length; i < n; i += 4) {


     var red = data[i];
     var green = data[i + 1];
     var blue = data[i + 2];
     var alpha = data[i + 3];

     if(red>=250 && green>=250 && blue>=250 ){
     data[i + 3]=0

     }
     }

     FillCanvasFloodCtx.putImageData(imageData,0,0);*/
}


function selectErazer(){
    soundEffect("sound/slidemenu.mp3")
    $('.iconsMenu').removeClass('active_equation')
    $('#erazer').addClass('active_equation')
}

function getSrcImageStoryBuilder(){
    var loc = window.location.toString();
    var Parameters_pass_frame = loc.split('?')[1];
    var Parameters_pass_frame_part2= Parameters_pass_frame.split("|");
    var d0 =Parameters_pass_frame_part2[0].split("=");
    d0 = d0[1];
    d0 = "../"+d0;

    return d0;
}



$( document ).ready(function() {

    $('.colorPicker').colorPicker({
        buildCallback: function($elm) {

            $elm.prepend('<div class="cp-disp"></div>');

        },
        cssAddon:
        '.cp-disp {padding:10px; margin-bottom:6px; font-size:15px; height:20px; line-height:0px}' +
        '.cp-xy-slider {width:200px; height:200px;}' +
        '.cp-xy-cursor {width:16px; height:16px; border-width:2px; margin:-8px}' +
        '.cp-z-slider {height:200px; width:40px;}' +
        '.cp-z-cursor {border-width:8px; margin-top:-8px;}' +
        '.cp-alpha {height:40px;}' +
        '.cp-alpha-cursor {border-width:8px; margin-left:-8px;}',

        renderCallback: function($elm, toggled) {
            var colors = this.color.colors,
                rgb = colors.RND.rgb;
            colorChoose=colors.HEX

            $('.colorPicker').css({
                backgroundColor: "transparent",
            })




            $('.flaticon-artist').addRule({

                color: '#' + colors.HEX+"!important",

            });

            $('.cp-disp').css({
                backgroundColor: '#' + colors.HEX,
                color: colors.RGBLuminance > 0.22 ? '#222' : '#ddd'
            }).text('rgba(' + rgb.r + ', ' + rgb.g + ', ' + rgb.b +
                ', ' + (Math.round(colors.alpha * 100) / 100) + ')');
        }
    }); // that's it


    loadorgIcon()
    startColorPicker()
})
var Orginal=""

function loadorgIcon(){
    str=arrayOfImages[0]
    base =  arrayOfImages[0].slice(-4)
    str=  arrayOfImages[0].slice(0,-4)
    src=str +"O"+base
    $('.imgOrgIcon').attr('src',src+"?"+Math.random())

}

function showOrginalImage(src){


    UiMouseDown.hideOnMouseDown()
    if($('.orginalContainer'))$('.orginalContainer').remove()
    str=arrayOfImages[0]
    base =  arrayOfImages[0].slice(-4)
    str=  arrayOfImages[0].slice(0,-4)
    src=str +"O"+base


    $('<div class="orginalContainer hideAll"><img id="imgOrg" onclick="hidePobUpJus(); UiMouseDown.ShowOnMouseDown()" src="'+src+'"></div>').appendTo('#canvasContainer').hide().show('fast')
    imgOrg=document.getElementById('imgOrg')
    var coord=calculateAspectRatioFit(imgOrg.width, imgOrg.height, window.innerWidth, window.innerHeight)
    $('.imgOrgIcon').attr('src',imgOrg.src+"?"+Math.random())
    $('#imgOrg').css('width',coord.width+'px')
    $('#imgOrg').css('height',coord.height+'px');




}


function getColorEss(obj){
    DrawMode = 'pen'
    soundEffect("sound/colorClick.mp3")
    colorChoose=$(obj).attr('colorChoo')

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
    var newHeight =$(".canvasContainer").height();
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