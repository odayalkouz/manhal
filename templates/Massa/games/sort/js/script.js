//Path = "../../" + (parent.applicationPath + parent.storyArray[0].desc.folderName + "/")
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

if(checkIFPc() ||  localStorage['storyStatus']=="free" ){
    Path="../../"+(localStorage['applicationPath']+localStorage['folderName']+"/")

}
else{
    Path=(localStorage['applicationPath']+localStorage['folderName']+"/")

}

var wordList0 = [
    'images/01.jpg', 'images/02.jpg', 'images/03.jpg', 'images/04.jpg', 'images/05.jpg', 'images/06.jpg', 'images/07.jpg', 'images/08.jpg'];
word_true = 0;
word_f = 0;
var soundpath = '';
var win = 0
var lbl_data1 = "أحسنت ... ";
var lbl_data2 = "ألعب مرة أخرى";
var lbl_data3 = "رتب ";
var lbl_data4 = "أحداث القصة ";
var lbl_data5 = "هل تريد";
var lbl_data6 = "الخروج من اللعبة؟";
$(document).ready(function () {
    parent.onLoadIframeShow()
    BackgroundSound('sound/sort.mp3');

    $('#loaderStory').css("display", "none");
        speachSound("sound/rearrange.mp3")
        $(document.body).msgBox({
            msgText1: lbl_data3,
            msgText2: lbl_data4,
            imgSrc: "../../images/open-boock.svg",
            confirmFn: function () {
                //document.getElementById("messageContainer").className = "zoom-out";
                //document.getElementById("messageContainer").className = "";
                $(".message-container").removeClass("tada");
                $(".message-container").removeClass("animated-1");
                $(".message-container").addClass("zoomOutDown");
                $(".message-container").addClass("animated-haf");
                setTimeout(function () {
                    $("#messageContainer").css("display","none")
                }, 500);

                shuffleDivs();
                timerStart({min: 1, sec: 30}, false);

            },
            cancelFn: function () {
                //document.getElementById("messageContainer").style.display = "none";
                $(".message-container").removeClass("tada");
                $(".message-container").removeClass("animated-1");
                $(".message-container").addClass("zoomOutDown");
                $(".message-container").addClass("animated-haf");
                setTimeout(function () {
                    $("#messageContainer").css("display","none")
                }, 500);
                $(".back-btn-game").click()
            }
        })
        $("#message-img").css({width:"26%",height:"28%",right:"-4%",top:"15%"})

    !function (a) {
        function f(a, b) {
            if (!(a.originalEvent.touches.length > 1)) {
                a.preventDefault();
                var c = a.originalEvent.changedTouches[0], d = document.createEvent("MouseEvents");
                d.initMouseEvent(b, !0, !0, window, 1, c.screenX, c.screenY, c.clientX, c.clientY, !1, !1, !1, !1, 0, null), a.target.dispatchEvent(d)
            }
        }

        if (a.support.touch = "ontouchend" in document, a.support.touch) {
            var e, b = a.ui.mouse.prototype, c = b._mouseInit, d = b._mouseDestroy;
            b._touchStart = function (a) {
                var b = this;
                !e && b._mouseCapture(a.originalEvent.changedTouches[0]) && (e = !0, b._touchMoved = !1, f(a, "mouseover"), f(a, "mousemove"), f(a, "mousedown"))
            }, b._touchMove = function (a) {
                e && (this._touchMoved = !0, f(a, "mousemove"))
            }, b._touchEnd = function (a) {
                e && (f(a, "mouseup"), f(a, "mouseout"), this._touchMoved || f(a, "click"), e = !1)
            }, b._mouseInit = function () {
                var b = this;
                b.element.bind({
                    touchstart: a.proxy(b, "_touchStart"),
                    touchmove: a.proxy(b, "_touchMove"),
                    touchend: a.proxy(b, "_touchEnd")
                }), c.call(b)
            }, b._mouseDestroy = function () {
                var b = this;
                b.element.unbind({
                    touchstart: a.proxy(b, "_touchStart"),
                    touchmove: a.proxy(b, "_touchMove"),
                    touchend: a.proxy(b, "_touchEnd")
                }), d.call(b)
            }
        }
    }(jQuery);

    $('#sortable').sortable({

        opacity: 0.7,
        placeholder: 'ui-sortable-placeholder',
        start: function (event, ui) {
            soundEffect("../../sound/drag.mp3");
            win = 0
            //$(ui.item).css({
            //    border:"4px dashed #4176ba"
            //})


        },
        update: function (event, ui) {
            //$(ui.item).css({
            //    border:"4px dashed #4176ba"
            //})
        },
        out: function (event, ui) {

        },
        stop: function (event, ui) {

            //$("li").css({
            //    border:"4px dashed #e6e6e6"
            //})
          soundEffect("../../sound/move.mp3")
            $("li").each(function (index) {
                //console.log( index + ": " + $( this ).attr("indexx"));
                if (index == $(this).attr("indexx")) {
                    win++
                }
            });
            if (win == wordList0.length) {
                puaseTimer()
                soundEffect("../../sound/win.mp3")
                $(document.body).msgBox({
                    msgText1: lbl_data1,
                    msgText2: lbl_data2,
                    imgSrc: "../../images/good.svg",
                    confirmFn: function () {
                        timerStart({min: 1, sec: 30}, false)
                        //document.getElementById("messageContainer").style.display = "none";
                        $(".message-container").removeClass("tada");
                        $(".message-container").removeClass("animated-1");
                        $(".message-container").addClass("zoomOutDown");
                        $(".message-container").addClass("animated-haf");
                        setTimeout(function () {
                            $("#messageContainer").css("display","none")
                        }, 500);
                        shuffleDivs();
                    },
                    cancelFn: function () {
                        //document.getElementById("messageContainer").style.display = "none";
                        $(".message-container").removeClass("tada");
                        $(".message-container").removeClass("animated-1");
                        $(".message-container").addClass("zoomOutDown");
                        $(".message-container").addClass("animated-haf");
                        setTimeout(function () {
                            $("#messageContainer").css("display","none")
                        }, 500);
                        $(".back-btn-game").click()
                    },
                })
            }
            $('#messageContainer img').css({"top": "-2%", "height": "51%","right":"0","width":"43%"});
            $('#messageData').css("width","59%");
        }


    });
    for (var i = 0; i < wordList0.length; i++) {
        $('<li class="ui-sortable-handle" indexx="' + i + '" image="' + wordList0[i] + '" style="background-image: url(' + Path + wordList0[i] + ')"></li>').appendTo("#sortable");
    }
    //$('li[indexx="0"]').css({
    //    border: '4px dotted #d6aa64'
    //})

    shuffleDivs()
    resizeGame()
});
function callFunction() {
    soundEffect("../../sound/slidemenu.mp3")
    shuffleDivs()
    timerStart({min: 1, sec: 30}, false)
}
function shuffleDivs() {
    var parent = $("#sortable");
    var divs = parent.children();
    while (divs.length) {
        parent.append(divs.splice(Math.floor(Math.random() * divs.length), 1)[0]);
    }
}


function resizeGame() {
    var gameArea = document.getElementById('main-container');
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

    var gameCanvas = document.getElementById('inner-container');
    gameCanvas.style.width = newWidth + 'px';
    gameCanvas.style.height = newHeight + 'px';
    //autoSizeText
}






