isDown = false;
allobject_array = [];
mouseMove = function (e) {



    if ($(e.target).attr('object_match') != undefined) {
        e.target.widget = $(e.target).attr('object_match')
    }else if(elemwidget!=null&&elemwidget == 'object_match'){
        e.target.widget =object_match;
    } else if (e.target.widget != undefined) {

    } else {
        return
    }

    if (e.touches == undefined) {
        var xENd = (e.pageX - $(eval(e.target.widget).canvas).offset().left);
        var yEnd = (e.pageY - $(eval(e.target.widget).canvas).offset().top);
    } else {
        var xENd = (e.touches[0].pageX - $(eval(e.target.widget).canvas).offset().left);
        var yEnd = (e.touches[0].pageY - $(eval(e.target.widget).canvas).offset().top);
    }

    if (!isDown)return;
    eval(e.target.widget).ctxCanvas = eval(e.target.widget).canvas.getContext('2d')
    eval(e.target.widget).ctxCanvas.strokeStyle = eval(e.target.widget).activeIndex.color;
    eval(e.target.widget).ctxCanvas.shadowBlur = 0;
    eval(e.target.widget).ctxCanvas.shadowColor = "black";
    eval(e.target.widget).ctxCanvas.clearRect(0, 0, eval(e.target.widget).canvas.width, eval(e.target.widget).canvas.height);
    eval(e.target.widget).ctxCanvas.lineWidth = 5
    eval(e.target.widget).ctxCanvas.beginPath();
    eval(e.target.widget).ctxCanvas.moveTo(x, y);
    eval(e.target.widget).ctxCanvas.lineTo(xENd, yEnd);
    eval(e.target.widget).ctxCanvas.stroke();
    eval(e.target.widget).redrawLines();
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();

}








mouse_up = function (e) {
	e.preventDefault();
	e.stopPropagation();
	e.stopImmediatePropagation();
    if (e.touches == undefined) {
        var elem = e.target;
    } else {
        var changedTouch = e.changedTouches[0];
        var elem = document.elementFromPoint(changedTouch.clientX, changedTouch.clientY);
    }
    if (elem.widget == undefined) {
        elem.widget = $(elem).attr('object_match');
    }
    if (e.touches == undefined) {
        var elem = e.target;
    } else {
        var changedTouch = e.changedTouches[0];
        var elem = document.elementFromPoint(changedTouch.clientX, changedTouch.clientY);

    }
    if (!isDown)return;
    isDown = false;
	e.preventDefault();
	e.stopPropagation();
	e.stopImmediatePropagation();
    elem.widget = elemwidget;
    if (eval(elem.widget).activ == false) {
        return
    }
    if (!$(elem).hasClass('colEl2')) {
        eval(elem.widget).ctxCanvas.clearRect(0, 0, eval(elem.widget).canvas.width, eval(elem.widget).canvas.height);
        eval(elem.widget).redrawLines()
        return
    }
    for (var j = 0; j < eval(elem.widget).linesArray.length; j++) {
        if (eval(elem.widget).linesArray[j].indexEndtBox == elem.id) {
            eval(elem.widget).ctxCanvas.clearRect(0, 0, eval(elem.canvas).width, eval(elem.canvas).height);
            eval(elem.widget).redrawLines()
            return
        }
    }
    if (e.changedTouches == undefined) {
        var xT = (e.pageX - $(eval(elem.canvas)).offset().left);
        var yT = (e.pageY - $(eval(elem.canvas)).offset().top);
    } else {
        var xT = (e.changedTouches[0].pageX - $(eval(elem.canvas)).offset().left);
        var yT = (e.changedTouches[0].pageY - $(eval(elem.canvas)).offset().top);
    }
    eval(elem.widget).ctxCanvas.beginPath();
    eval(elem.widget).ctxCanvas.strokeStyle = eval(elem.widget).activeIndex.color
    eval(elem.widget).ctxCanvas.stroke();
    eval(elem.widget).ctxCanvas.closePath();
    eval(elem.widget).linesArray.push({
        x1: x,
        y1: y,
        x2: xT,
        y2: yT,
        indexStartBox: eval(elem.widget).activeIndex.id,
        indexEndtBox: elem.id,
        color: eval(elem.widget).activeIndex.color

    })
    eval(elem.widget).ctxCanvas.clearRect(0, 0, eval(elem.widget).canvas.width, eval(elem.widget).canvas.height);
    eval(elem.widget).redrawLines()
    mouseup_sound.Play();
   $(".buttons").css({"opacity":"1","pointer-events":"auto"})
}
elemwidget=null;
mouse_down = function (e) {
    elemwidget = e.target.widget;
    if ($(e.target).hasClass('colEl2')) {
        errorMatching2.Play();
        return;
    } else if ($(e.target).attr('activ') != 'true') {
        errorMatching2.Play();
        return;
    }
    $('div label').css('pointer-events', 'none')
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    isDown = true;
    mousedown_sound.Stop();
    mousedown_sound.Play();
    if (e.touches == undefined) {
        x = ( e.pageX ) - $(this.canvas).offset().left;
        y = (e.pageY) - $(this.canvas).offset().top;
    } else {
        x = e.touches[0].pageX;
        y = e.touches[0].pageY;
    }
    this.x = (x - $(this.canvas).offset().left);
    this.y = (y - $(this.canvas).offset().top);
    eval(e.target.widget).activeIndex = {
        id: this.id,
        index: $('#' + this.id).attr('attrindex'),
        color: getRandomColor()
    }
    for (var j = 0; j < eval(e.target.widget).linesArray.length; j++) {
        if (eval(e.target.widget).linesArray[j].indexStartBox == eval(e.target.widget).activeIndex.id) {
            eval(e.target.widget).linesArray.splice(j, 1);
        }
    }
}
function getRandomColor() {

    return '#0070bb';
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
function randomelement(length, object) {
    this.arrays = randomarray(length);
    this.myArray = $("." + object + "-coloumn2Element  .element-container");
    for (var i = 0; i < length - 1; i++) {
        $("." + object + "-coloumn2Element").append(this.myArray[this.arrays[i]])
    }
}

function MatchingOOP(widget, id, name, length, sounfile,flag) {
    this.canvas_id = id;
    this.lengthDiv = length
    this.canvas = document.getElementById('canvas' + this.canvas_id);
    this.ctxCanvas = this.canvas.getContext('2d');
    this.name = name;
    this.widget = widget;
    this.linesArray = [];
    this.soundfile = new manhalsound(sounfile);
    if(flag){
        randomelement(length, widget);
    }
    this.activeIndex = {
        id: "",
        index: "",
        answer: "",
        color: ""
    }
    this.canvasInit()
    this.fitToContainer()
    document.body.ontouchend = function (e) {
	    e.preventDefault();
	    e.stopPropagation();
	    e.stopImmediatePropagation();
        mouse_up(e)
    }
    document.body.ontouchmove = function (e) {
	    e.preventDefault();
	    e.stopPropagation();
	    e.stopImmediatePropagation();
        mouseMove(e)
    }

    document.body.onmouseup = function (e) {
	    e.preventDefault();
	    e.stopPropagation();
	    e.stopImmediatePropagation();
        mouse_up(e)
    }
    document.body.onmousemove = function (e) {
	    e.preventDefault();
	    e.stopPropagation();
	    e.stopImmediatePropagation();
        mouseMove(e)
    }
}
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

$(window).resize(function () {
    resizeGame()

});

MatchingOOP.prototype.canvasInit = function () {

    this.deleteLink = document.querySelectorAll('[name=' + this.name + ']');
    for (var i = 0; i < this.deleteLink.length; i++) {
        this.deleteLink[i].canvas = this.canvas;
        this.deleteLink[i].widget = this.widget;
        this.deleteLink[i].addEventListener('mousedown', mouse_down);
        this.deleteLink[i].addEventListener('mouseup', mouse_up);
        this.deleteLink[i].addEventListener('touchstart', mouse_down);
    }
}
MatchingOOP.prototype.redrawLines = function () {

    var dx = $(this.canvas).offset().left;
    var dy = $(this.canvas).offset().top;
    for (var i = 0; i < this.linesArray.length; i++) {
        if (this.linesArray[i] == "undefined × 1") {
        } else {
            this.ctxCanvas.lineWidth = 5
            this.ctxCanvas.strokeStyle = this.linesArray[i].color
            var p = $("#" + this.linesArray[i].indexStartBox);
            var positionStart = p.offset();
            var p = $("#" + this.linesArray[i].indexEndtBox);
            widthDivs = parseInt($("#" + this.linesArray[i].indexEndtBox).css('width'));
            var positionEnd = p.offset();
            heightDiv = parseInt($("#" + this.linesArray[i].indexEndtBox).css('height'));
            this.ctxCanvas.beginPath();
            this.ctxCanvas.stroke();
            this.ctxCanvas.closePath();
            this.ctxCanvas.beginPath();
            this.ctxCanvas.moveTo(positionStart.left - dx + 15, (positionStart.top + (heightDiv / 2)) - dy);
            this.ctxCanvas.lineTo((positionEnd.left + (widthDivs / 2)) - dx, ((positionEnd.top) + (heightDiv / 2)) - dy);
            this.ctxCanvas.closePath();
            this.ctxCanvas.stroke();
            this.ctxCanvas.closePath();
            this.ctxCanvas.beginPath();
            this.ctxCanvas.stroke();
            this.ctxCanvas.closePath();
        }
    }
}
MatchingOOP.prototype.RefreshDivs = function () {
    this.heightDiv = parseInt($('.coloumn1Element').css('height')) / this.lengthDiv;
    $('.elemMatch').css('height', eval(this.heightDiv - 12) + 'px');
}
MatchingOOP.prototype.fitToContainer = function () {
    this.canvas.style.width = '100%';
    this.canvas.style.height = '100%';
    this.canvas.width = this.canvas.offsetWidth;
    this.canvas.height = this.canvas.offsetHeight;
}

function getCorrectpositionToCheckAnswer(startId, endId) {
    var p = $("#" + startId);
    var positionStart = p.offset();
    var p = $("#" + endId);
    widthDivs = parseInt($("#" + endId).css('width'))
    var positionEnd = p.offset();
    return {
        corrdStart: positionStart,
        coord: positionEnd
    }


}
function addXToAllNoneAnswerd(object) {
    var checkvalue = true;
    var divs = $(".colEl1");
    divs.each(function (index) {
        var dd = '#col2' + $(this).attr('id').split('col1')[1]
        if ($(this).attr('checkedValue') == 'yes') {

            if ($(".matching-container-vertical")[0] != undefined) {
               $('<div class="true main-check ' + object.widget + '-imageCheckAnswer  imageCheckAnswer floating-right"><div class="true"></div></div>').appendTo($(this).parent());
            }
            else if ($(".matching-container-horizental")[0] != undefined) {
               $('<div class="true main-check ' + object.widget + '-imageCheckAnswer  imageCheckAnswer floating-right"><div class="True"></div></div>').appendTo($(dd).parent().parent());
            }
        }
        else {
            checkvalue = false;
            if ($(".matching-container-vertical")[0] != undefined) {
               $('<div class="false main-check ' + object.widget + '-imageCheckAnswer imageCheckAnswer floating-right"><div class="false"></div></div>').appendTo($(this).parent())
            }
            else if ($(".matching-container-horizental")[0] != undefined) {
                $('<div class="false main-check ' + object.widget + '-imageCheckAnswer imageCheckAnswer floating-right"><div class="false"></div></div>').appendTo($(dd).parent().parent());
            }
        }
    });
  /*  if (checkvalue == true) {
        winMatching1.Play();
        winMatching2.Play();
    }
    else {
        errorMatching1.Play();
        errorMatching2.Play();
    }*/
}
function randomarray(Length) {
    var shuffle_Array = [];
    for ($x = 0; $x < Length; $x++) {
        shuffle_Array.push($x);
    }
    return shuffleArray(shuffle_Array);
}
function shuffleArray(array) {
    for (var i = array.length - 1; i > 0; i--) {
        var j = Math.floor(Math.random() * (i + 1));
        var temp = array[i];
        array[i] = array[j];
        array[j] = temp;
    }
    return array;
}

function resizeGame()
{
    var gameArea = document.getElementById('matching-content');
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

    var gameCanvas = document.getElementById('gameConainer');
    gameCanvas.style.width = newWidth + 'px';
    gameCanvas.style.height = newHeight + 'px';
    for (var i = 0; i < allobject_array.length; i++) {
        allobject_array[i].RefreshDivs()
        allobject_array[i].fitToContainer()
        allobject_array[i].ctxCanvas.clearRect(0, 0, allobject_array[i].canvas.width, allobject_array[i].canvas.height);
        allobject_array[i].redrawLines()
    }
}




