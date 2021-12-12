strLeft='<div class="floating-left match-box dropable vresizable leftbox ui-resizable" style="height: 164px;"> <div id="dl" class="resizable draggable element ui-resizable ui-draggable" style="width: 163px; height: 98px; position: absolute; top: 15px; left: 15px;"> <div class="delete_widget floating-right flaticon-x"></div> <div class="move_handler flaticon-more9 ui-draggable-handle"></div><div class="real-content"><span class="poplinable" contenteditable="true">Text This is Data</span></div> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div id="widget_fI9uR2Y" class="resizable draggable element ui-resizable ui-draggable" style="width: 142px; height: 127px; position: absolute; top: 3.6036%; left: 54.2725%;"><div class="move_handler flaticon-more9 ui-draggable-handle"></div><div class="delete_widget floating-right flaticon-x"></div><div class="edit_widget flaticon-pencil43" widget_type="image"></div><div class="real-content remove-margin"><img src="image.jpg" style="width:100%;height: 100%"></div><div></div><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div></div>'
strRight='<div class="floating-right match-box dropable vresizable rightbox ui-resizable selected_dropable" style="height: 168px;"> <div id="dr" class="resizable draggable element ui-resizable ui-draggable" style="width: 146px; height: 126px; position: absolute; top: 15px; left: 15px;"> <div class="delete_widget floating-right flaticon-x"></div> <div class="move_handler flaticon-more9 ui-draggable-handle"></div> <div class="real-content"><span class="poplinable" contenteditable="true">Text</span></div> <div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div> <div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div id="widget_ZKwo5Pg" class="resizable draggable element ui-resizable ui-draggable" style="width: 179px; height: 137px; position: absolute; top: 1.96078%; left: 41.5741%;"><div class="move_handler flaticon-more9  ui-draggable-handle"></div><div class="delete_widget floating-right flaticon-x"></div><div class="edit_widget flaticon-pencil43" widget_type="video"></div><div class="real-content remove-margin"><iframe width="100%" height="100%" src="https://www.youtube.com/embed/sxUQsKxcOYM" frameborder="0" allowfullscreen=""></iframe></div><div></div><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div></div></div>'
var matchingArray=[]
var pushedLineArray=[]

canvas="";
ctxCanvas=""
function callmathing(){


    canvas=document.getElementById('canvas')
    ctxCanvas=canvas.getContext('2d')
    fitToContainer();
    expandArray();
    canvasInit()
    RefreshDivs()
}



$( window ).resize(function() {
    RefreshDivs()
    fitToContainer()
    ctxCanvas.clearRect(0, 0, canvas.width, canvas.height);
    redrawLines()

});



function expandArray(){

lengthDiv=matchingArray.length;
heightDiv=parseInt($('.coloumn1Element').css('height'))/lengthDiv;

    for (i = 0; i < matchingArray.length; i++) {
        if(matchingArray[i].col1.type=='text')
     var  str= '<div attrindex="'+i+'"  answer="'+matchingArray[i].col1.Element+' " id="col1'+i+'" class="elemMatch colEl1"><label class="lbl-data-matching">'+matchingArray[i].col1.Element+'</label></div>'

        if(matchingArray[i].col1.type=='image')
            var  str= '<div attrindex="'+i+'"  answer="'+matchingArray[i].col1.Element+' " id="col1'+i+'" class="elemMatch colEl1"><img class="imageElem" src="'+matchingArray[i].col1.Element+'"></div>'

        if(matchingArray[i].col1.type=='sound')
            var  str= '<div attrindex="'+i+'"  answer="'+matchingArray[i].col1.Element+' " id="col1'+i+'" class="elemMatch colEl1 ">' +
                ' <audio id="audio'+i+'" src="' + matchingArray[i].col1.Element + '" class="media" preload="auto"  ></audio>'+
                '<div class="btn-container"><button class="audio-btn flaticon-stop48" indexAudio="'+i+'" id="stop'+i+'"></button>'+
                '<button class="audio-btn flaticon-start4" indexAudio="'+i+'" id="play'+i+'"></button></div>'+
                '</div>'


        if(matchingArray[i].col1.type=='html')
            str=matchingArray[i].col1.Element

            $(str).appendTo('.coloumn1Element');

        $('#play'+i).click(function(){
            stopAllMedia()
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            index=$(this).attr('indexAudio')
            $('#audio'+index).trigger('play')



        })
        $('#stop'+i).click(function(){
            stopAllMedia()
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            index=$(this).attr('indexAudio')
            $('#audio'+index).trigger('pause');


        })





        //***********************************************
if(matchingArray[i].col2.type=='text') {
    var str = '<div  attrindex="' + i + '"  answer="' + matchingArray[i].col2.Element + ' " id="col2' + i + '" class="elemMatch colEl2"><label class="lbl-data-matching">' + matchingArray[i].col2.Element + '</label> </div>'

}

        if(matchingArray[i].col2.type=='image') {
    var str = '<div  attrindex="' + i + '"  answer="' + matchingArray[i].col2.Element + ' " id="col2' + i + '" class="elemMatch colEl2"><img class="imageElem" src="' + matchingArray[i].col2.Element + '"></div>'

}



        if(matchingArray[i].col2.type=='sound') {
            var str = '<div  attrindex="' + i + '"  answer="' + matchingArray[i].col2.Element + ' " id="col2' + i + '" class="elemMatch colEl2">' +
                ' <audio id="audio2'+i+'" src="' + matchingArray[i].col1.Element + '" class="media" preload="auto"  ></audio>'+
                '<button class="audio-btn" indexAudio="'+i+'" id="stop2'+i+'">Stop</button>'+
                '<button class="audio-btn" indexAudio="'+i+'" id="play2'+i+'">Play</button>'+
                '</div>'
        }

        if(matchingArray[i].col2.type=='html')
            str=matchingArray[i].col2.Element


        $(str).appendTo('.coloumn2Element');


        $('#play2'+i).click(function(){
            stopAllMedia()
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            index=$(this).attr('indexAudio')
            $('#audio2'+index).trigger('play')



        })
        $('#stop2'+i).click(function(){
            stopAllMedia()
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            index=$(this).attr('indexAudio')
            $('#audio2'+index).trigger('pause');


        })
        
        $('.elemMatch').css('height',eval(heightDiv)+'px')
        
    }

    shuffleDivs()
}




function fitToContainer(){
    // Make it visually fill the positioned parent
    canvas.style.width ='100%';
    canvas.style.height='100%';
    // ...then set the internal size to match
    canvas.width  = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;
}


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
        return false

    }else{
        return true

    }
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

function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++ ) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

function getWindowRelativeOffset(parentWindow, elem) {
    var offset = {
        left : 0,
        top : 0
    };
    // relative to the target field's document
    offset.left = elem.getBoundingClientRect().left;
    offset.top = elem.getBoundingClientRect().top;
    // now we will calculate according to the current document, this current
    // document might be same as the document of target field or it may be
    // parent of the document of the target field
    var childWindow = elem.document.frames.window;
    while (childWindow != parentWindow) {
        offset.left = offset.left + childWindow.frameElement.getBoundingClientRect().left;
        offset.top = offset.top + childWindow.frameElement.getBoundingClientRect().top;
        childWindow = childWindow.parent;
    }
    return offset;
};

function shuffleDivs(){
    var parent = $(".coloumn1Element");
    var divs = parent.children();
    while (divs.length) {
        parent.append(divs.splice(Math.floor(Math.random() * divs.length), 1)[0]);
    };


    var parent = $(".coloumn2Element");
    var divs = parent.children();
    while (divs.length) {
        parent.append(divs.splice(Math.floor(Math.random() * divs.length), 1)[0]);
    }
}

function RefreshDivs(){
    lengthDiv=matchingArray.length;
    heightDiv=parseInt($('.coloumn1Element').css('height'))/lengthDiv ;
    $('.elemMatch').css('height',eval(heightDiv-12)+'px');
    //$('.elemMatch').css('line-height',eval(heightDiv-12)+'px');
}


function stopAllMedia() {
    var media = document.getElementsByClassName('media'),
        i = media.length;

    while (i--) {
        media[i].pause();
    }
}

