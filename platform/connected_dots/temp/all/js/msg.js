


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
    if(data.type=="confirm"){
        str='<div id="messageContainer" class="message-main-container" style="display: none">'+
            ' <div  class="message-container">' +
            ' <div class="line-row-message">' +
            ' <span class="lbl-data-sort-msg" style="line-height: 130px;">هل أنت متاكد من إيقاف عملية التحميل؟</span>' +
            ' <div id="aa"  class="ok-btn"><i class="flaticon-mark"></i></div>' +
            ' </div>'+
            ' </div>'+
            ' </div>';
        if($('#messageContainer').length)$('#messageContainer').remove();
        $(str).appendTo(this).show();
        return
    }

if(data.type=="multi") {

    str = '<div id="messageContainer" class="message-main-container" style="display: none">' +
        ' <div  class="message-container">' +
        ' <div class="line-row-message">' +
        ' <span class="lbl-data-sort-msg">اختر طريقة اللعب</span>' +
        '<a id="game1"  class="sort-btn floating-right" >3x3</a>' +
        '<a id="game2" class="sort-btn floating-right" >4x4</a>' +
        '<a id="game3" class="sort-btn floating-right" >5x5</a>'+
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
        str = '<div id="messageContainer" class="message-main-container" style="display: none">' +
            ' <div  class="message-container">' +
            ' <div class="line-row-message">' +
            ' <div id="messageData" class="lbl-data-message floating-right">' +
            ' <span id="lbl-data1">' + data.msgText1 + '</span>' +
            ' <span id="lbl-data2">' + data.msgText2 + '</span>' +
            '  </div>' +
            '  <img id="message-img" src="' + data.imgSrc + '" class="message-img floating-right">' +
            '  </div>' +
            '  <div id="aa"  class="ok-btn"><i class="flaticon-play106"></i></div>' +
            '  <a class="colse-btn" ><i class="flaticon-indicator"></i></a>' +
            '  </div>' +
            ' </div>'
    if($('#messageContainer').length)$('#messageContainer').remove();
    $(str).appendTo(this).show();
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