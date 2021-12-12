


$.fn.msgBox = function(data) {
    if(typeof data == undefined){
        data.msgText1="";
        data.msgText2="";
        data.imgSrc="";
        data.confirmFn=function(){};
        data.cancelFn=function(){};
        data.game1=function(){};
        data.game2=function(){};
        data.game3=function(){};
    }
    {
        str = '<div id="messageContainer" class="message-main-container" style="display: none">' +
            ' <div id="message-container" class="message-container animated animated-1 tada">' +
            '<div class="message-inner-container" id="message-inner-container">' +
            '<div class="message-main-content">' +
            ' <div class="line-row-message">' +
            ' <div id="messageData" class="lbl-data-message floating-right">' +
            ' <span id="lbl-data1">' + data.msgText1 + '</span>' +
            ' <span id="lbl-data2">' + data.msgText2 + '</span>' +
            '  </div>' +
            '  <img id="message-img" src="' + data.imgSrc + '" class="message-img floating-right">' +
            '  </div>' +
            '  <a class="colse-btn" ></a>' +
            '  </div>' +
            '  </div>' +
            '  </div>' +
            ' </div>'
        if($('#messageContainer').length)$('#messageContainer').remove();
        $(str).appendTo(this).show();
    }
    setTimeout(function(){

        $('#aa').click(function(){
            //parent.soundEffect("sound/click.mp3")
            data.confirmFn()
        })
        $('.colse-btn').click(function(){
            //parent.soundEffect("sound/click.mp3")
            data.cancelFn()
        })
    },500);

    resizeMessage()
};




function resizeMessage() {
    var gameArea = document.getElementById('message-container');
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

    var gameCanvas = document.getElementById('message-inner-container');
    gameCanvas.style.width = newWidth + 'px';
    gameCanvas.style.height = newHeight + 'px';
}