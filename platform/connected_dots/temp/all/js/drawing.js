function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}
function getRandomFloat(min, max) {
    return Math.random() * (max - min) + min;
}
$.fn.ShowDrawing = function(index,ColorList)
{
    $(".fotterGame").hide();
    //if(ColorList=="disable" && $('#canavsContainer'+index).length && $('#indexTools'+index)){
    //    $('#indexTools'+index).css({
    //        'pointer-events':'none'
    //    });
    //    $('#canavsContainer'+index).css({
    //        'pointer-events':'none'
    //    });
    //    $('#canvasBack'+index).css({
    //        'pointer-events':'none'
    //    });
    //    $('#canvasLayer'+index).css({
    //        'pointer-events':'none'
    //    });
    //
    //    return
    //}
    //else if(ColorList=="enable" && $('#canavsContainer'+index).length && $('#indexTools'+index)){
    //
    //    $('#indexTools'+index).css({
    //        'pointer-events':'auto'
    //    });
    //    $('#canavsContainer'+index).css({
    //        'pointer-events':'auto'
    //    });
    //    $('#canvasBack'+index).css({
    //        'pointer-events':'auto'
    //    });
    //    $('#canvasLayer'+index).css({
    //        'pointer-events':'auto'
    //    });
    //
    //    return
    //}
    //
    //
    //$('.DrawingTools').hide();





    var clientX, clientY, timeout;
    var density = 80;
    colorsStr=""

    for (i = 0; i < ColorList.length; i++) {
        if(i==0)
        {
            cls="selected-colors";
        }
        else
        {
            cls="";
        }
        colorsStr+="<div index='"+index+"' class='colorsClass "+cls+"' color='"+ColorList[i]+"' style='background-color:"+ColorList[i]+"'></div>"
    }
    drawingMode="pen";
    mouseDownType="normal";
    strTools="<div id='indexTools"+index+"' attrIndex='indexTools"+index+"' class='DrawingTools'>" +
        "<div class='left floating-left'></div> " +
        "<div class='content-container-tools floating-left'>" +
        "<div class='face-container floating-left' style='margin-right: 2%'>"+
        "<img src='images/logonormal.svg' class='face animated fadeIn'>"+
        "</div>"+
        "<div index='"+index+"' class='sizeContainer floating-left' align='center'>" +
        "<div index='"+index+"' class='sizeClass floating-left selected-size' size='8'><i class='pen-size-1'></i></div>" +
        "<div index='"+index+"' class='sizeClass floating-left' size='12'><i class='pen-size-2'></i></div>" +
        "<div index='"+index+"' class='sizeClass floating-left' size='20'><i class='pen-size-3'></i></div>" +
        "<div index='"+index+"' class='sizeClass floating-left' size='25'><i class='pen-size-4'></i></div>" +
        "</div>" +
        "<div class='part-container floating-left'></div> " +
        "<div class='ColorContainer floating-left'>" +
        "<i class='pointer'></i>" +
        colorsStr
        +
        "</div>" +
        "<div class='part-container floating-left'></div> " +
        "<div class='toolsPenCont floating-left' style='position: relative'>" +
        "<a id='pen"+index+"' index='"+index+"'class='pen selected-icons floating-left'><i></i></a>" +
        "<a id='erazer"+index+"' index='"+index+"' class='erazer floating-left'><i></i></a>" +
        "</div>" +
        "<div class='part-container floating-left'></div> " +
        "<div class='clear-container floating-left'>" +
        "<a id='clear"+index+"' index='"+index+"'><i></i></a>" +
        "</div>" +
        "</div>" +
        "<div class='right floating-left'></div> " +
        "</div>"
    var colorFill=ColorList[0]
    size=10
    if($(".canvasLayes"+index).length)$(".canvasLayes"+index).remove();

    $('<div attrIndex="indexTools'+index+'" mouseDownMode="normal" color="'+ColorList[0]+'"  id="canavsContainer'+index+'" size="'+25+'" class="canavsContainer">' +

        '<canvas attrIndex="indexTools'+index+'" index="'+index+'" class"canvasLayes'+index+'" id="canvasBack'+index+'"></canvas>' +

        '<canvas attrIndex="indexTools'+index+'" index="'+index+'"  id="canvasLayer'+index+'"></canvas>' +
        '' +
        '' +
        '' +
        '' +

            // .appendTo(this);
    //
    ////$( strTools).appendTo(body);



    '</div> '+strTools).appendTo(this);

    $('.DrawingTools').css({


        position:'absolute',
        "z-index":99999

    });

    // $('.colorsClass').css({
    //     width:'40px',
    //     height:'40px',
    //     top:'-0px',
    //     margin:'6px 7px 5px 7px',
    //     float:'left',
    //     'border-radius':'100%',
    //     cursor:'pointer'
    // });
    // $('.sizeClass').css({
    //     top:'-0px',
    //     'border-radius':'100%',
    //     cursor:'pointer',
    //
    // });

    $(this).find('.canavsContainer').css({
        width:'100%',
        height:"100%",
        position:"relative",
        top:0,
        left:0,
        //margin:"0px 0px 0px 8px"
    });

    $(".toolsPenCont a").click(function () {
        $(".toolsPenCont a").removeClass("selected-icons");
        $(this).addClass("selected-icons");
    })
    $('#pen'+index).click(function(){
        drawingMode="pen";
        mouseDownType="normal"

        index=($(this).attr('index'))

        $('#canavsContainer'+index).attr('mouseDownMode',mouseDownType)
    })
    $('#erazer'+index).click(function(){
        drawingMode="erazer"
        mouseDownType="normal"
    });

    var canvasContainer=$(this).find('.canavsContainer')
    $(canvasContainer).find('canvas').css({
        width:'100%',
        height:"100%",
        position:"absolute",
        top:0,left:0,
    });

    var canvasBack=document.getElementById('canvasBack'+index);
    var canvasLayer=document.getElementById('canvasLayer'+index);
    //$( window ).on("orientationchange", function(event)
    //{
    //    setTimeout(function ()
    //    {
    //
    //
    //
    //    },700);
    //});
    canvasBack.width = canvasBack.offsetWidth;
    canvasBack.height = canvasBack.offsetHeight;

    canvasLayer.width = canvasLayer.offsetWidth;
    canvasLayer.height = canvasLayer.offsetHeight;


    var  ctxBack=canvasBack.getContext('2d')
    var  ctxLayer=canvasLayer.getContext('2d');


    $('#clear'+index).click(function(){

        ctxBack.clearRect(0, 0, canvasLayer.width, canvasLayer.height);
        ctxLayer.clearRect(0, 0, canvasLayer.width, canvasLayer.height);
    });





    $('#spray'+index).click(function(){
        mouseDownType="spray"
        index=($(this).attr('index'))

        $('#canavsContainer'+index).attr('mouseDownMode',mouseDownType)
    });



    $('canvas').mousedown(function(){

        $('.DrawingTools').hide();

        attrIndex=$(this).attr('attrIndex');

        tools= $("#"+attrIndex)
        tools.show();
        $('.canavsContainer').removeClass("borderclass");
        $(this).parent().addClass("borderclass");
    });
    if(drawingMode=="pen")
    {
        ctxActiveLayer = ctxLayer;
    }
    else if(drawingMode=="erazer")
    {
        ctxActiveLayer = ctxBack;
    }
    ctxActiveLayer.lineWidth = 5;
    ctxActiveLayer.lineJoin = ctxActiveLayer.lineCap = 'round';
    ctxActiveLayer.lineWidth = 5;
    ctxActiveLayer.lineJoin = ctxActiveLayer.lineCap = 'round';
    $('.colorsClass').click(function(){
        var obj = $(this);
        var childPos = obj.offset();
        var parentPos = obj.parent().offset();
        var childOffset = {
            top: childPos.top - parentPos.top,
            left: childPos.left - parentPos.left
        }
        colorFill=$(this).attr('color')
        index=($(this).attr('index'))
        $('#canavsContainer'+index).attr('color',colorFill);
        $(".pointer").show()
        $(".pointer").animate({left:childOffset.left+ "px"})
    })



    $('.sizeClass').click(function(){

        $(".sizeClass").removeClass("selected-size")
        $(this).addClass("selected-size")
        size=$(this).attr('size');
        index=($(this).attr('index'))

        $('#canavsContainer'+index).attr('size',size)
    });
    $(this).mousedown(function(){



    });


    var isDrawing, points = [ ];

    canvasLayer.onmousedown = function(e) {
        e.stopPropagation();
        e.preventDefault()
        parent2=$(this).parent()
        console.log(parent2)
        console.log(parent2.attr('color'))


        if(parent2.attr('mouseDownMode')=="normal"){
            onMouseDownHandle(e,parent2)
        }
        else if(parent2.attr('mouseDownMode')=="spray"){
            mouseDownSpray(e,parent2)
        }


    };


    canvasLayer.onmousemove = function(e) {
        e.stopPropagation()
        parent2=$(this).parent()
        e.preventDefault()


        if(parent2.attr('mouseDownMode')=="normal"){
            onMouseMoveHandle(e,parent2)
        }
        else if(parent2.attr('mouseDownMode')=="spray"){
            mouseMoveSpray(e,parent2)
        }

    };

    canvasLayer.onmouseup = function(e) {
        clearTimeout(timeout);
        onMouseUpHandle(e)
    };

    canvasLayer.onmouseleave= function(e) {
        clearTimeout(timeout);
        onMouseUpHandle(e)
    };

    //Touch Devices
    canvasLayer.ontouchstart = function(e) {
        parent2=$(this).parent()
        e.preventDefault()
        if(parent2.attr('mouseDownMode')=="normal"){
            onMouseDownHandle(e,parent2)
        }
        else if(parent2.attr('mouseDownMode')=="spray"){
            mouseDownSpray(e,parent2)
        }
    };


    canvasLayer.ontouchmove = function(e) {
        parent2=$(this).parent()
        e.preventDefault()
        if(parent2.attr('mouseDownMode')=="normal"){
            onMouseMoveHandle(e,parent2)
        }
        else if(parent2.attr('mouseDownMode')=="spray"){
            mouseMoveSpray(e,parent2)
        }
    };

    canvasLayer.ontouchend = function(e) {
        clearTimeout(timeout);
        e.preventDefault()
        onMouseUpHandle(e)
    };
    canvasLayer.ontouchcancel = function(e) {
        clearTimeout(timeout);
        onMouseUpHandle(e)
    };


    function onMouseDownHandle(e,parent2){


        isDrawing = true;
        if(drawingMode=="pen") {
            ctxActiveLayer = ctxLayer;
        }
        else if(drawingMode=="erazer"){
            ctxActiveLayer = ctxBack;
        }

        if (!isDrawing) return;




        if(drawingMode=="pen") {
            ctxActiveLayer.globalCompositeOperation = 'source-over';
            ctxActiveLayer.fillStyle=parent2.attr('color')
            ctxActiveLayer.strokeStyle=parent2.attr('color')
            ctxActiveLayer.lineWidth=parent2.attr('size')
            ctxActiveLayer.globalAlpha=.9
            //ctxActiveLayer.shadowColor="black";
            //ctxActiveLayer.shadowBlur=5;
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

    } ;


    function onMouseMoveHandle(e,parent2){
        if(drawingMode=="pen") {
            ctxActiveLayer = ctxLayer;
        }
        else if(drawingMode=="erazer"){
            ctxActiveLayer = ctxBack;
        }
        if (!isDrawing) return;




        if(drawingMode=="pen") {
            ctxActiveLayer.globalCompositeOperation = 'source-over';
            ctxActiveLayer.fillStyle=parent2.attr('color')
            ctxActiveLayer.strokeStyle=parent2.attr('color')
            ctxActiveLayer.lineWidth=parent2.attr('size')
            ctxActiveLayer.globalAlpha=.9
            //ctxActiveLayer.shadowColor="black";
            //ctxActiveLayer.shadowBlur=10;
            points.push({ x: getPosition(e).x, y: getPosition(e).y });

            ctxActiveLayer.clearRect(0, 0, canvasLayer.width, canvasLayer.height);

        }
        else if(drawingMode=="erazer"){
            ctxActiveLayer.globalCompositeOperation = 'destination-out';
            ctxActiveLayer.fillStyle = 'rgba(0,0,0,1)';
            ctxActiveLayer.strokeStyle = 'rgba(0,0,0,1)';
            ctxActiveLayer.lineWidth=parent2.attr('size')
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



    function mouseDownSpray(e,parent2){
        ctxActiveLayer.shadowColor='rgba(0,0,0,0)';
        ctxActiveLayer.shadowBlur=0;
        ctxActiveLayer.lineJoin = ctxActiveLayer.lineCap = 'round';
        clientX = getPosition(e).x;
        clientY = getPosition(e).y;
        ctxActiveLayer.globalCompositeOperation = 'source-over';
        ctxActiveLayer.fillStyle=parent2.attr('color')
        ctxActiveLayer.strokeStyle=parent2.attr('color')
        ctxActiveLayer.lineWidth=parent2.attr('size')
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