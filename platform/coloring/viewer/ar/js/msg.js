


$.fn.msgBox = function(data) {


    if(typeof data == undefined){
        data.msgText1="";
        data.msgText2="";
        data.imgSrc=""
        data.confirmFn=function(){};
        data.cancelFn=function(){};
        data.game1=function(){};
        data.game2=function(){};
        data.game3=function(){};

    }
    if(data.type=="download"){
        str = '<div id="messageContainer" class="message-main-container" style="display: none">' +
            ' <div id="message-container"  class="message-container animated animated-1 tada">' +
            '<div class="message-inner-container" id="message-inner-container">' +
            '<div class="message-main-content" style="background-image: url(images/message-popup.svg)">' +
            ' <div class="line-row-message">' +
            ' <div id="messageData" class="lbl-data-message floating-right">' +
            ' <span id="lbl-data1">' + data.msgText1 + '</span>' +
            ' <span id="lbl-data2">' + data.msgText2 + '</span>' +
            '  </div>' +
            '  <img id="message-img" src="' + data.imgSrc + '" class="message-img floating-right">' +
            '  </div>' +
            '  </div>' +
            '  </div>' +
            '  </div>' +
            ' </div>'
        if($('#messageContainer').length)$('#messageContainer').remove();
        $(str).appendTo(this).show();
        resizeMessage()
        return
    }

if(data.type=="multi") {

    str = '<div id="messageContainer" class="message-main-container" style="display: none;">' +
        ' <div id="message-container"  class="message-container animated animated-1 tada">' +
        '<div class="message-inner-container" id="message-inner-container">' +
        '<div class="message-main-content" style="background-image: url(images/message-templet.svg)">' +
        ' <div class="line-row-message" style="height: 40%;">' +
        ' <span class="lbl-data-sort-msg" style="height: 43%;line-height: 2.5em;background-image: url(images/lbl-4.svg);width: 69%;display: inline-block;"></span>' +
        '<div class="line-row-message" style="height: 50%">' +
        '<a id="game1"  class="sort-btn floating-right shakeit" ></a>' +
        '<a id="game2" class="sort-btn floating-right shakeit" ></a>' +
        '<a id="game3" class="sort-btn floating-right shakeit" ></a>'+
        '</div>'+
        '</div>'+
        '</div>'+
        '</div>'+
        '</div>'+
        ' </div>';

    if($('#messageContainer').length)$('#messageContainer').remove();
    $(str).appendTo(this).show();
    setTimeout(function(){

        $('#game1').click(function(){
            setTimeout(function () {
                $('#source_image').snapPuzzle('destroy');
                resize()
            }, 300);

            timerStart({min:1,sec:30},false)
            numberPeace=3
            resize()


            $(".message-container").removeClass("tada");
            $(".message-container").removeClass("animated-1");
            $(".message-container").addClass("zoomOutDown");
            $(".message-container").addClass("animated-haf");
            setTimeout(function () {
                $("#messageContainer").css("display","none")
            }, 500);
        })
        $('#game2').click(function(){
            setTimeout(function () {
                $('#source_image').snapPuzzle('destroy');
                resize()
            }, 300);
            timerStart({min:2,sec:00},false)
            numberPeace=4
            resize()

            $(".message-container").removeClass("tada");
            $(".message-container").removeClass("animated-1");
            $(".message-container").addClass("zoomOutDown");
            $(".message-container").addClass("animated-haf");
            setTimeout(function () {
                $("#messageContainer").css("display","none")
            }, 500);
        });
        $('#game3').click(function(){
            setTimeout(function () {
                $('#source_image').snapPuzzle('destroy');
                resize()
            }, 300);
            timerStart({min:3,sec:00},false)
            numberPeace=5
            resize()

            $(".message-container").removeClass("tada");
            $(".message-container").removeClass("animated-1");
            $(".message-container").addClass("zoomOutDown");
            $(".message-container").addClass("animated-haf");
            setTimeout(function () {
                $("#messageContainer").css("display","none")
            }, 500);
        });

    },500);
    resizeMessage()
    return

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
            '  <div id="aa"  class="ok-btn shakeit"><i></i></div>' +
            '  <a class="colse-btn shakeit" ><i></i></a>' +
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