

function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function getRandomFloat(min, max) {
    return Math.random() * (max - min) + min;
}



$.fn.ShowDrawing = function(index) {


    var clientX, clientY, timeout;
    var density = 80;

drawingMode="pen";
mouseDownType="normal"
    strTools="<div class='DrawingTools'>" +
        "<div class='toolsPenCont' style='position: relative'>" +
        "<button id='pen"+index+"' >pen</button>" +
        "<button id='spray"+index+"' >spray</button>" +
        "<button id='erazer"+index+"'>Erazer</button>" +
        "<button id='clear"+index+"'>clear</button>" +
        "</div>" +
        "<div class='ColorContainer' > " +

        "<div class='colorsClass' color='#ff2217' style='background:#ff2217'></div>" +
        "<div class='colorsClass' color='#3f7808' style='background:#3f7808'></div>" +
        "<div class='colorsClass' color='#2572bb' style='background:#2572bb'></div>" +
        "<div class='colorsClass' color='#b517ff' style='background:#b517ff'></div>" +
        "<div class='colorsClass' color='#f6912e' style='background:#f6912e'></div>" +
        "<div class='colorsClass' color='#fcff00' style='background:#fcff00'></div>" +
        "<div class='colorsClass' color='#000000' style='background:#000000'></div>" +
        "</div>" +


        "<div class='sizeContainer'  style='position: absolute;top:80px'  align='center'> " +

        "<div class='sizeClass' size='7' style='background:black;width:20px;height:20px'></div>" +
        "<div class='sizeClass' size='5' style='background:black;width:15px;height:15px'></div>" +
        "<div class='sizeClass' size='3' style='background:black;width:10px;height:10px'></div>" +
        "<div class='sizeClass' size='2' style='background:black;width:5px;height:5px'></div>" +

        "</div>" +

        "</div>"
   var colorFill="red"
    size=10
    if($(".canvasLayes"+index).length)$(".canvasLayes"+index).remove();

    $('<div class="canavsContainer">' +
        strTools +
    '<canvas class"canvasLayes'+index+'" id="canvasBack'+index+'"></canvas>' +

    '<canvas id="canvasLayer'+index+'"></canvas>' +
    '' +
    '' +
    '' +
    '' +
    '</div>').appendTo(this);
    $('.DrawingTools').css({

        top:'-0px',
        position:'relative',
        "z-index":99999

    });

    $('.colorsClass').css({
         width:'40px',
         height:'40px',
         top:'-0px',
         margin:'5px',
         float:'left',
        'border-radius':'100%',
         cursor:'pointer'
    });
    $('.sizeClass').css({

        top:'-0px',
        margin:'5px',

        'border-radius':'100%',
        cursor:'pointer',

    });

    $(this).find('.canavsContainer').css({
        width:'100%',
        height:"100%",
        position:"relative",
        top:0,left:0


    });


    $('#pen'+index).click(function(){
        drawingMode="pen";
        mouseDownType="normal"
    })
      $('#erazer'+index).click(function(){
        drawingMode="erazer"
          mouseDownType="normal"
    })



  var canvasContainer=$(this).find('.canavsContainer')
    $(canvasContainer).find('canvas').css({
        width:'100%',
        height:"100%",
        position:"absolute",
        top:0,left:0,
        //cursor:'pointer'
    });



var canvasBack=document.getElementById('canvasBack'+index);
var canvasLayer=document.getElementById('canvasLayer'+index);

    canvasBack.width = canvasBack.offsetWidth;
    canvasBack.height = canvasBack.offsetHeight;

    canvasLayer.width = canvasLayer.offsetWidth;
    canvasLayer.height = canvasLayer.offsetHeight;


   var  ctxBack=canvasBack.getContext('2d')
   var  ctxLayer=canvasLayer.getContext('2d');


    $('#clear'+index).click(function(){

        ctxBack.clearRect(0, 0, canvasLayer.width, canvasLayer.height);
        ctxLayer.clearRect(0, 0, canvasLayer.width, canvasLayer.height);
    })

    $('#spray'+index).click(function(){
        mouseDownType="spray"

    })


    if(drawingMode=="pen") {
        ctxActiveLayer = ctxLayer;
    }
    else if(drawingMode=="erazer"){
        ctxActiveLayer = ctxBack;
    }



    ctxActiveLayer.lineWidth = 5;
    ctxActiveLayer.lineJoin = ctxActiveLayer.lineCap = 'round';

    ctxActiveLayer.lineWidth = 5;

    ctxActiveLayer.lineJoin = ctxActiveLayer.lineCap = 'round';
    $('.colorsClass').click(function(){

        colorFill=$(this).attr('color')

})

    $('.sizeClass').click(function(){

        size=$(this).attr('size')

    });


    var isDrawing, points = [ ];

    canvasLayer.onmousedown = function(e) {
e.preventDefault()

        if(mouseDownType=="normal"){
            onMouseDownHandle(e)
        }
        else if(mouseDownType=="spray"){
            mouseDownSpray(e)
        }


    };


    canvasLayer.onmousemove = function(e) {
e.preventDefault()


        if(mouseDownType=="normal"){
            onMouseMoveHandle(e)
        }
        else if(mouseDownType=="spray"){
            mouseMoveSpray(e)
        }

    };

    canvasLayer.onmouseup = function(e) {
        clearTimeout(timeout);
        onMouseUpHandle(e)
    };

    canvasLayer.onmouseleave= function(e) {
       // onMouseUpHandle(e)
    };

    //Touch Devices
    canvasLayer.ontouchstart = function(e) {
e.preventDefault()
        if(mouseDownType=="normal"){
            onMouseDownHandle(e)
        }
        else if(mouseDownType=="spray"){
            mouseDownSpray(e)
        }
    };


    canvasLayer.ontouchmove = function(e) {
e.preventDefault()
        if(mouseDownType=="normal"){
            onMouseMoveHandle(e)
        }
        else if(mouseDownType=="spray"){
            mouseMoveSpray(e)
        }
    };

    canvasLayer.ontouchend = function(e) {
        clearTimeout(timeout);
e.preventDefault()
        onMouseUpHandle(e)
    };
    canvasLayer.ontouchcancel = function(e) {
        onMouseUpHandle(e)
    };


    function onMouseDownHandle(e){
        isDrawing = true;
        points.push({ x: getPosition(e).x, y: getPosition(e).y });
    } ;



    function onMouseMoveHandle(e){



        if(drawingMode=="pen") {
            ctxActiveLayer = ctxLayer;
        }
        else if(drawingMode=="erazer"){
            ctxActiveLayer = ctxBack;
        }
        if (!isDrawing) return;




        if(drawingMode=="pen") {
            ctxActiveLayer.globalCompositeOperation = 'source-over';
            ctxActiveLayer.fillStyle=colorFill
            ctxActiveLayer.strokeStyle=colorFill
            ctxActiveLayer.lineWidth=size
            ctxActiveLayer.globalAlpha=.5
            ctxActiveLayer.shadowColor="black";
            ctxActiveLayer.shadowBlur=10;
            points.push({ x: getPosition(e).x, y: getPosition(e).y });

            ctxActiveLayer.clearRect(0, 0, canvasLayer.width, canvasLayer.height);

        }
        else if(drawingMode=="erazer"){
            ctxActiveLayer.globalCompositeOperation = 'destination-out';
            ctxActiveLayer.fillStyle = 'rgba(0,0,0,1)';
            ctxActiveLayer.strokeStyle = 'rgba(0,0,0,1)';
            ctxActiveLayer.lineWidth=size
            points.push({ x: getPosition(e).x, y: getPosition(e).y });



        }




        var p1 = points[0];
        var p2 = points[1];

        ctxActiveLayer.beginPath();
        ctxActiveLayer.moveTo(p1.x, p1.y);

        for (var i = 1, len = points.length; i < len; i++) {
            // we pick the point between pi+1 & pi+2 as the
            // end point and p1 as our control point
            var midPoint = midPointBtw(p1, p2);
            ctxActiveLayer.quadraticCurveTo(p1.x, p1.y, midPoint.x, midPoint.y);
            p1 = points[i];
            p2 = points[i+1];
        }
        // Draw last line as a straight line while
        // we wait for the next point to be able to calculate
        // the bezier control point
        ctxActiveLayer.lineTo(p1.x, p1.y);
        ctxActiveLayer.stroke();
    };

    function onMouseUpHandle(e){
        if(drawingMode=="pen") {
            ctxBack.globalCompositeOperation = 'source-over';
            ctxBack.drawImage(canvasLayer, 0, 0);
            ctxActiveLayer.clearRect(0, 0, canvasLayer.width, canvasLayer.height);
        }
        isDrawing = false;
        points.length = 0;
    };



    function mouseDownSpray(e){
        ctxActiveLayer.shadowColor='rgba(0,0,0,0)';
        ctxActiveLayer.shadowBlur=0;
        ctxActiveLayer.lineJoin = ctxActiveLayer.lineCap = 'round';
        clientX = getPosition(e).x;
        clientY = getPosition(e).y;
        ctxActiveLayer.globalCompositeOperation = 'source-over';
        ctxActiveLayer.fillStyle=colorFill
        ctxActiveLayer.strokeStyle=colorFill
        ctxActiveLayer.lineWidth=size
        timeout = setTimeout(function draw() {
            for (var i = density; i--; ) {
                var angle = getRandomFloat(0, Math.PI*2);
                var radius = getRandomFloat(0, 20);
                ctxActiveLayer.fillRect(
                    clientX + radius * Math.cos(angle),
                    clientY + radius * Math.sin(angle),
                    1, 1);
            }
            if (!timeout) return;
            timeout = setTimeout(draw, 50);
        }, 50);
    }


    function mouseMoveSpray(e){
        clientX = getPosition(e).x;
        clientY = getPosition(e).y;
    }

};

//$('.exercise-image-a').ShowDrawing()
function midPointBtw(p1, p2) {
    return {
        x: p1.x + (p2.x - p1.x) / 2,
        y: p1.y + (p2.y - p1.y) / 2
    };
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

    var cssScaleX = targ.width / targ.offsetWidth;
    var cssScaleY = targ.height / targ.offsetHeight;

    if (checkIFPc()) {

        var x = event.pageX - $(targ).offset().left*cssScaleX;
        var y = event.pageY - $(targ).offset().top*cssScaleY;
    }
    else{
        var x = event.touches[0].pageX - $(targ).offset().left*cssScaleX;
        var y = event.touches[0].pageY - $(targ).offset().top*cssScaleY;

    }

    return {"x": x, "y": y};
};

function checkIFPc(){


    if (navigator.userAgent.match(/Android/i) ||
        navigator.userAgent.match(/webOS/i) ||
        navigator.userAgent.match(/iPhone/i) ||
        navigator.userAgent.match(/iPad/i) ||
        navigator.userAgent.match(/iPod/i) ||
        navigator.userAgent.match(/BlackBerry/) ||
        navigator.userAgent.match(/Windows Phone/i) ||
        navigator.userAgent.match(/ZuneWP7/i)
    ){
        return false;

    }else{
        return true;

    }
};