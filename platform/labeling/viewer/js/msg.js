


$.fn.msgBox = function(data) {
    if(typeof data == undefined){
        data.msgText1="";
        data.msgText2="";
        data.msgText3="";
        data.imgSrc="";
        data.confirmFn=function(){};
        data.cancelFn=function(){};
        data.game1=function(){};
        data.game2=function(){};
        data.game3=function(){};

    }
    if(data.type=="download"){
        str = '<div id="messageContainer" class="message-main-container" style="display: none">' +
            '<div id="inner-message">' +
            ' <div id="message-container"  class="message-container">' +
            ' <div class="line-row-message">' +
            ' <div id="messageData" class="lbl-data-message floating-right">' +
            ' <span id="lbl-data1">' + data.msgText1 + '</span>' +
            ' <span id="lbl-data2">' + data.msgText2 + '</span>' +
            '  </div>' +
            '  <img id="message-img" src="' + data.imgSrc + '" class="message-img floating-right">' +
            '  </div>' +
            '  <div id="aa"  class="ok-btn"></div>' +
            '  </div>' +
            '  </div>' +
            ' </div>'
        if($('#messageContainer').length)$('#messageContainer').remove();
        $(str).appendTo(this).show();
        return
    }

    if(data.type=="timeOut"){
        str = '<div id="messageContainer" class="message-main-container" style="display: none">' +
            '<div id="inner-message">' +
            ' <div id="message-container" class="message-container">' +
            ' <div class="line-row-message">' +
            ' <div id="messageData" class="lbl-data-message floating-right">' +
            ' <span id="lbl-data1">' + data.msgText1 + '</span>' +
            ' <span id="lbl-data2">' + data.msgText2 + '</span>' +
            ' <span id="lbl-data2">' + data.msgText3 + '</span>' +
            ' </div>' +
            ' </div>' +
            ' <div id="aa"  class="ok-btn" style="display: inline-block"></div>' +
            ' </div>' +
            ' </div>' +
            ' </div>';
        if($('#messageContainer').length)$('#messageContainer').remove();
        $(str).appendTo(this).show();
        return
    }

if(data.type=="multi") {

    str = '<div id="messageContainer" class="message-main-container" style="display: none">' +
        '<div id="inner-message">' +
        ' <div id="message-container"  class="message-container">' +
        ' <div class="line-row-message">' +
        ' <span class="lbl-data-sort-msg">اختر طريقة اللعب</span>' +
        '<a id="game1"  class="sort-btn floating-right shakeit" >3x3</a>' +
        '<a id="game2" class="sort-btn floating-right shakeit" >4x4</a>' +
        '<a id="game3" class="sort-btn floating-right shakeit" >5x5</a>'+
        '</div>'+
        '</div>'+
        '</div>'+
        ' </div>';


    if($('#messageContainer').length)$('#messageContainer').remove();
    $(str).appendTo(this).show();
    setTimeout(function(){

        $('#game1').click(function(){

            $('#source_image').snapPuzzle('destroy');
            timerStart({min:1,sec:30},false)
            numberPeace=3
            resize()

            document.getElementById("messageContainer").style.display="none";
        })
        $('#game2').click(function(){
            $('#source_image').snapPuzzle('destroy');
            timerStart({min:2,sec:00},false)
            numberPeace=4
            resize()

            document.getElementById("messageContainer").style.display="none";
        });
        $('#game3').click(function(){
            $('#source_image').snapPuzzle('destroy');
            timerStart({min:3,sec:00},false)
            numberPeace=5
            resize()

            document.getElementById("messageContainer").style.display="none";
        });

    },500);
    return
}
{
        str ='<div id="messageContainer" class="message-main-container" style="display: none">' +
            '<div id="inner-message">' +
            '<div class="message-container showSweetAlert">' +
            '<div class="line-row-message">' +
            '<div id="messageData" class="lbl-data-message floating-left">' +
            '<span id="lbl-data1" style="background-image: url(' + data.msgText1 + ')"></span>' +
            '</div>' +
            '<img id="message-img" src="' + data.imgSrc + '" class="message-img floating-right">' +
            '</div>' +
            '<div id="aa"  class="ok-btn animated"><i></i></div>' +
            '</div>' +
            '</div>' +
            '</div>';
    if($('#messageContainer').length)$('#messageContainer').remove();
    $(str).appendTo(this).show();
    resizeMessage()
    }
    setTimeout(function(){
    $('#aa').click(function(){
        parent.soundEffect("sound/click.mp3")
        data.confirmFn()
    })
    $('.colse-btn').click(function(){
        parent.soundEffect("sound/click.mp3")
        data.cancelFn()
    })
    },500);
};


function resizeMessage() {
    var gameArea = document.getElementById('messageContainer');
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
    var gameCanvas = document.getElementById('inner-message');
    gameCanvas.style.width = newWidth + 'px';
    gameCanvas.style.height = newHeight + 'px';
}