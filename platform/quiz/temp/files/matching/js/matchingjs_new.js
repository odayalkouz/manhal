isDown=false
mouseMove = function (e) {

    if ($(e.target).attr('object_match') != undefined) {
        e.target.widget = $(e.target).attr('object_match')
    } else if (e.target.widget != undefined) {

    } else {
        return
    }


    if(e.touches==undefined) {

        var xENd = (e.pageX - $(eval(e.target.widget).canvas).offset().left);
        var yEnd = (e.pageY - $(eval(e.target.widget).canvas).offset().top);
    }else{

        var xENd = (e.touches[0].pageX - $(eval(e.target.widget).canvas).offset().left);
        var yEnd = (e.touches[0].pageY - $(eval(e.target.widget).canvas).offset().top);

    }






    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    if (!isDown)return;
    eval(e.target.widget).ctxCanvas = eval(e.target.widget).canvas.getContext('2d')
    eval(e.target.widget).ctxCanvas.strokeStyle = eval(e.target.widget).activeIndex.color;
    eval(e.target.widget).ctxCanvas.shadowBlur = 20;
    eval(e.target.widget).ctxCanvas.shadowColor = "black";
    eval(e.target.widget).ctxCanvas.clearRect(0, 0, eval(e.target.widget).canvas.width, eval(e.target.widget).canvas.height);
    eval(e.target.widget).ctxCanvas.lineWidth = 3


    eval(e.target.widget).ctxCanvas.beginPath();
    eval(e.target.widget).ctxCanvas.arc(x, y, 10, 0, 2 * Math.PI);
    eval(e.target.widget).ctxCanvas.stroke();
    eval(e.target.widget).ctxCanvas.closePath();

    eval(e.target.widget).ctxCanvas.beginPath();
    eval(e.target.widget).ctxCanvas.moveTo(x, y);

    //ctxCanvas.quadraticCurveTo(getRandomInt(min, max), 179, xENd, yEnd);
    eval(e.target.widget).ctxCanvas.lineTo(xENd, yEnd);

    eval(e.target.widget).ctxCanvas.stroke();


    eval(e.target.widget).redrawLines()
}
mouse_up = function (e) {


    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();
    if(e.touches==undefined) {
        var elem =e.target;
    }else{
        var changedTouch = e.changedTouches[0];
        var elem = document.elementFromPoint(changedTouch.clientX, changedTouch.clientY);

    }
    if(elem.widget==undefined){
        elem.widget=$(elem).attr('object_match')
    }
    if (!isDown)return;
    isDown = false;
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




    if(e.touches==undefined) {
        var xT = (e.pageX - $(eval(elem.canvas)).offset().left);
        var yT = (e.pageY - $(eval(elem.canvas)).offset().top);
    }else{

        var xT = (e.changedTouches[0].pageX - $(eval(elem.canvas)).offset().left);
        var yT = (e.changedTouches[0].pageY - $(eval(elem.canvas)).offset().top);


    }



    eval(elem.widget).ctxCanvas.beginPath();
    eval(elem.widget).ctxCanvas.strokeStyle = eval(elem.widget).activeIndex.color
    eval(elem.widget).ctxCanvas.arc(xT, yT, 10, 0, 2 * Math.PI);
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


}
mouse_down =function (e) {

    if ($(e.target).hasClass('colEl2')) return
    $('div label').css('pointer-events', 'none')
    e.preventDefault();
    e.stopPropagation();
    e.stopImmediatePropagation();
    isDown = true


if(e.touches==undefined) {
    x = e.pageX;
    y = e.pageY;
}else{

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
    var letters = '0123456789ABCDEF'.split('');
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}
function MatchingOOP(widget,id, name,length) {
    this.canvas_id = id;
    this.lengthDiv=length
    this.canvas = document.getElementById('canvas' + this.canvas_id);
    this.ctxCanvas = this.canvas.getContext('2d');
    this.name = name;
    this.widget = widget;
    this.linesArray = [];
    this.activeIndex = {
        id: "",
        index: "",
        answer: "",
        color: ""
    }
    this.canvasInit()
    this.fitToContainer()
    document.body.ontouchend = function (e) {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
        mouse_up(e)
    }
    document.body.ontouchmove = function (e) {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
        mouseMove(e)
    }
    document.body.onmouseup = function (e) {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
        mouse_up(e)
    }
    document.body.onmousemove = function (e) {
        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();
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
    object_match.RefreshDivs()
    object_match.fitToContainer()
    object_match.ctxCanvas.clearRect(0, 0, object_match.canvas.width, object_match.canvas.height);
    object_match.redrawLines()

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
            this.ctxCanvas.lineWidth = 3
            this.ctxCanvas.strokeStyle = this.linesArray[i].color
            var p = $("#" + this.linesArray[i].indexStartBox);
            var positionStart = p.offset();
            var p = $("#" + this.linesArray[i].indexEndtBox);
            widthDivs = parseInt($("#" + this.linesArray[i].indexEndtBox).css('width'))
            var positionEnd = p.offset();
            heightDiv = parseInt($("#" + this.linesArray[i].indexEndtBox).css('height'))

            this.ctxCanvas.beginPath();
            this.ctxCanvas.arc(positionStart.left - dx, (positionStart.top + heightDiv / 2) - dy, 10, 0, 2 * Math.PI);
            this.ctxCanvas.stroke();
            this.ctxCanvas.closePath();
            this.ctxCanvas.beginPath();

            this.ctxCanvas.moveTo(positionStart.left - dx, (positionStart.top + heightDiv / 2) - dy);
            this.ctxCanvas.lineTo((positionEnd.left + widthDivs) - dx, (positionEnd.top + heightDiv / 2) - dy);
            this.ctxCanvas.closePath();
            this.ctxCanvas.stroke();
            this.ctxCanvas.closePath();

            this.ctxCanvas.beginPath();
            this.ctxCanvas.arc((positionEnd.left + widthDivs) - dx, (positionEnd.top + heightDiv / 2) - dy, 10, 0, 2 * Math.PI);
            this.ctxCanvas.stroke();
            this.ctxCanvas.closePath();
        }

    }

}
MatchingOOP.prototype.RefreshDivs = function () {

    //this.lengthDiv = this.matchingArray.length;
    this.heightDiv = parseInt($('.coloumn1Element').css('height')) / this.lengthDiv;
    $('.elemMatch').css('height', eval(this.heightDiv - 12) + 'px');
    //$('.elemMatch').css('line-height',eval(heightDiv-12)+'px');
}
MatchingOOP.prototype.fitToContainer = function () {
    // Make it visually fill the positioned parent
    this.canvas.style.width = '100%';
    this.canvas.style.height = '100%';
    // ...then set the internal size to match
    this.canvas.width = this.canvas.offsetWidth;
    this.canvas.height = this.canvas.offsetHeight;
}
