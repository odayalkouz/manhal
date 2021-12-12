isDown = false;
var deleteLink
activeIndex = {
    id: "",
    index: "",
    answer: "",
    color: ""
}

MatchingOOP.prototype.canvasInit=function () {

    this.deleteLink = document.querySelectorAll('[name='+this.names+']');

    console.log("kk==",this.deleteLink)

    document.body.onmousemove = function () {

        event.preventDefault();
        event.stopPropagation();
        event.stopImmediatePropagation();

        MatchingOOP.prototype.mouseMove()
    }
    MatchingOOP.prototype.mouseUp=function()  {
        if (!isDown)return;
        isDown = false;


        if (!$(event.target).hasClass('colEl2')) {
            ctxCanvas.clearRect(0, 0, canvas.width, canvas.height);
            redrawLines()
            return
        }
        ;


        for (var j = 0; j < linesArray.length; j++) {

            if (linesArray[j].indexEndtBox == event.target.id) {
                ctxCanvas.clearRect(0, 0, canvas.width, canvas.height);
                redrawLines()
                return
            }
        }

        var xT = (event.pageX - $('#canvas').offset().left);
        var yT = (event.pageY - $('#canvas').offset().top);
        ctxCanvas.beginPath();
        ctxCanvas.strokeStyle = activeIndex.color
        ctxCanvas.arc(xT, yT, 10, 0, 2 * Math.PI);
        ctxCanvas.stroke();
        ctxCanvas.closePath();

        //if (linesArray.length > 0) {
        //    if (activeIndex.id == linesArray[linesArray.length - 1].indexStartBox) return
        //}


        linesArray.push({
            x1: x,
            y1: y,
            x2: xT,
            y2: yT,
            indexStartBox: activeIndex.id,
            indexEndtBox: event.target.id,
            color: activeIndex.color

        })
        ctxCanvas.clearRect(0, 0, canvas.width, canvas.height);
        redrawLines()
    }


}
MatchingOOP.prototype.mouseMove=function () {
    if($(event.target).attr('canvas')==undefined){
        return
    }
    console.log(this)



    var xENd = (event.pageX - $("#"+$(event.target).attr('canvas')).offset().left);
    var yEnd = (event.pageY - $("#"+$(event.target).attr('canvas')).offset().top);
    event.preventDefault();
    event.stopPropagation();
    event.stopImmediatePropagation();
    if (!isDown)return;
    ctxCanvas=$("#"+$(event.target).attr('canvas'));
    ctxCanvas= ctxCanvas.getContext('2d')
    ctxCanvas.strokeStyle = activeIndex.color;
    ctxCanvas.shadowBlur = 20;
    ctxCanvas.shadowColor = "black";
    ctxCanvas.clearRect(0, 0, $("#"+$(event.target).attr('canvas')).width, $("#"+$(event.target).attr('canvas')).height);
    ctxCanvas.lineWidth = 3


    ctxCanvas.beginPath();
    ctxCanvas.arc(x, y, 10, 0, 2 * Math.PI);
    ctxCanvas.stroke();
    ctxCanvas.closePath();

    ctxCanvas.beginPath();
    ctxCanvas.moveTo(x, y);

    //ctxCanvas.quadraticCurveTo(getRandomInt(min, max), 179, xENd, yEnd);
    ctxCanvas.lineTo(xENd, yEnd);

    ctxCanvas.stroke();


    redrawLines()
}

    for (var i = 0; i < this.deleteLink.length; i++) {
        document.getElementById(this.deleteLink[i].id).onmousedown = function (e) {
            $('div label').css('pointer-events', 'none')
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            isDown = true
            x = event.pageX;
            y = event.pageY;
            console.log(e.target.id,$(e.target).attr('canvas'))
            this.x = (x - $("#"+$(e.target).attr('canvas')).offset().left);
            this.y = (y - $("#"+$(e.target).attr('canvas')).offset().top);

            this.activeIndex = {
                id: this.id,
                index: $('#' + this.id).attr('attrindex'),
                color: getRandomColor()
            }
            for (var j = 0; j < linesArray.length; j++) {
                if (linesArray[j].indexStartBox == this.activeIndex.id) {
                    linesArray.splice(j, 1);
                }
            }
        }





}

MatchingOOP.prototype.redrawLines=function () {

    console.log('ko',this.canvas)

    dx = $(this.canvas).offset().left;
    dy = $(this.canvas).offset().top;
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


var answerArray = []
var linesArray = []


function checkAnswer() {
    if ($('.imageCheckAnswer').length)$('.imageCheckAnswer').remove()
    count = 0

    for (var i = 0; i < linesArray.length; i++) {
        startPoint = $("#" + linesArray[i].indexStartBox).attr('attrindex');
        endPoint = $("#" + linesArray[i].indexEndtBox).attr('attrindex');

        coordinate = getCorrectpositionToCheckAnswer(linesArray[i].indexStartBox, linesArray[i].indexEndtBox);
        if (startPoint == endPoint) {

            $('<img class="imageCheckAnswer" src="img/checkright.png">').appendTo('#' + linesArray[i].indexStartBox)
            count++
        }
        else {
            $('<img class="imageCheckAnswer" src="img/wrong.png">').appendTo('#' + linesArray[i].indexStartBox)


        }

        $("#" + linesArray[i].indexStartBox).attr('checkedValue', 'yes');
    }

    addXToAllNoneAnswerd();
    alert("Score : " + count + "/" + matchingArray.length)
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

function addXToAllNoneAnswerd() {

    var divs = $(".colEl1");

    divs.each(function (index) {

        if ($(this).attr('checkedValue') == 'yes') {

        }
        else {
            $('<img class="imageCheckAnswer" src="img/wrong.png">').appendTo(this)
        }
    });
}


function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}