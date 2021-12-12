

isDown=false;
var deleteLink

activeIndex={
    id:"",
    index:"",
    answer:"",
    color:""
}
function canvasInit() {

    deleteLink = document.querySelectorAll('.colEl1');

    for (var i = 0; i < deleteLink.length; i++) {

        document.getElementById(deleteLink[i].id).onmousedown = function () {
            $('div label').css('pointer-events','none')
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            isDown = true
            x = event.pageX;
            y = event.pageY;

             x = (x - $('#canvas').offset().left) ;
             y=  (y - $('#canvas').offset().top) ;
            //console.log(this.id)
            activeIndex = {
                id: this.id,
                index: $('#' + this.id).attr('attrindex'),
                color:getRandomColor()

            }

            for (var j = 0; j < linesArray.length; j++) {

                if(linesArray[j].indexStartBox==activeIndex.id){
                    linesArray.splice(j, 1);
                }
            }
        }


        document.getElementById(deleteLink[i].id).ontouchstart = function () {
            $('div label').css('pointer-events','none')
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            isDown = true
            x = event.touches[0].pageX;
            y = event.touches[0].pageY;

            x = (x - $('#canvas').offset().left) ;
            y=  (y - $('#canvas').offset().top) ;
            activeIndex = {
                id: this.id,
                index: $('#' + this.id).attr('attrindex'),
                color:getRandomColor()

            }

            for (var j = 0; j < linesArray.length; j++) {

                if(linesArray[j].indexStartBox==activeIndex.id){
                    linesArray.splice(j, 1);
                }
            }
        }


        document.body.onmousemove = function () {

            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            mouseMove()
        }


        document.body.ontouchmove = function () {
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            var xENd = (event.touches[0].pageX - $('#canvas').offset().left) ;
            var yEnd=  (event.touches[0].pageY - $('#canvas').offset().top) ;
            if (!isDown)return;
            ctxCanvas.strokeStyle=activeIndex.color;
            ctxCanvas.shadowBlur=20;
            ctxCanvas.shadowColor="black";
            ctxCanvas.clearRect(0, 0, canvas.width, canvas.height);
            ctxCanvas.lineWidth = 3


            ctxCanvas.beginPath();
            ctxCanvas.arc(x, y, 10, 0, 2 * Math.PI);
            ctxCanvas.stroke();
            ctxCanvas.closePath();

            ctxCanvas.beginPath();
            ctxCanvas.moveTo(x, y);
            //ctxCanvas.lineTo(event.touches[0].pageX, event.touches[0].pageY);
            ctxCanvas.lineTo(xENd, yEnd);
            ctxCanvas.closePath();
            ctxCanvas.stroke();
            ctxCanvas.closePath();


            redrawLines()
        }





        document.body.ontouchend = function () {
            stopAllMedia()
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            var changedTouch = event.changedTouches[0];
            var elem = document.elementFromPoint(changedTouch.clientX, changedTouch.clientY);

            if (!isDown)return;
            isDown = false;


            if(!$(elem).hasClass('colEl2')){
                ctxCanvas.clearRect(0, 0, canvas.width, canvas.height);
                redrawLines()
                return};


            for (var j = 0; j < linesArray.length; j++) {

                if(linesArray[j].indexEndtBox==elem.id){
                    ctxCanvas.clearRect(0, 0, canvas.width, canvas.height);
                    redrawLines()
                    return
                }
            }

            ctxCanvas.beginPath();
            ctxCanvas.strokeStyle=activeIndex.color
            ctxCanvas.arc(changedTouch.clientX, changedTouch.clientY, 10, 0, 2 * Math.PI);
            ctxCanvas.stroke();
            ctxCanvas.closePath();

            //if (linesArray.length > 0) {
            //    if (activeIndex.id == linesArray[linesArray.length - 1].indexStartBox) return
            //}

            linesArray.push({
                x1: x,
                y1: y,
                x2: changedTouch.clientX,
                y2: changedTouch.clientY,
                indexStartBox: activeIndex.id,
                indexEndtBox: elem.id,
                color:activeIndex.color

            })
            redrawLines()
            $('div label').css('pointer-events','auto')
        }






        function mouseMove(){


            var xENd = (event.pageX - $('#canvas').offset().left) ;
            var yEnd=  (event.pageY - $('#canvas').offset().top) ;
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            if (!isDown)return;
            ctxCanvas.strokeStyle=activeIndex.color;
            ctxCanvas.shadowBlur=20;
            ctxCanvas.shadowColor="black";
            ctxCanvas.clearRect(0, 0, canvas.width, canvas.height);
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







        document.body.onmouseup = function () {
            stopAllMedia();
            event.preventDefault();
            event.stopPropagation();
            event.stopImmediatePropagation();
            mouseUp()
            $('div label').css('pointer-events','auto')
        }


        function mouseUp(){
            if (!isDown)return;
            isDown = false;


            if(!$(event.target).hasClass('colEl2') ){
                ctxCanvas.clearRect(0, 0, canvas.width, canvas.height);
                redrawLines()
                return};


            for (var j = 0; j < linesArray.length; j++) {

                if(linesArray[j].indexEndtBox==event.target.id){
                    ctxCanvas.clearRect(0, 0, canvas.width, canvas.height);
                    redrawLines()
                    return
                }
            }
            
            var xT = (event.pageX - $('#canvas').offset().left) ;
            var yT=  (event.pageY - $('#canvas').offset().top) ;
            ctxCanvas.beginPath();
            ctxCanvas.strokeStyle=activeIndex.color
            ctxCanvas.arc(xT, yT, 10, 0, 2 * Math.PI);
            ctxCanvas.stroke();
            ctxCanvas.closePath();

            //if (linesArray.length > 0) {
            //    if (activeIndex.id == linesArray[linesArray.length - 1].indexStartBox) return
            //}


            linesArray.push({
                x1: x,
                y1: y,
                x2:xT,
                y2: yT,
                indexStartBox: activeIndex.id,
                indexEndtBox: event.target.id,
                color:activeIndex.color

            })
            ctxCanvas.clearRect(0, 0, canvas.width, canvas.height);
            redrawLines()
        }




    }
}

    function redrawLines(){
dx=$('#canvas').offset().left ;
dy=$('#canvas').offset().top ;
        for (var i = 0; i < linesArray.length; i++) {
            if (linesArray[i] == "undefined × 1") {
            } else {
                ctxCanvas.lineWidth = 3
                ctxCanvas.strokeStyle=linesArray[i].color
                var p = $( "#"+linesArray[i].indexStartBox );
                var positionStart = p.offset();

                var p = $( "#"+linesArray[i].indexEndtBox );
                widthDivs=parseInt($( "#"+linesArray[i].indexEndtBox).css('width'))
                var positionEnd = p.offset();

                ctxCanvas.beginPath();
                ctxCanvas.arc(positionStart.left-dx, (positionStart.top+heightDiv/2)-dy, 10, 0, 2 * Math.PI);
                ctxCanvas.stroke();
                ctxCanvas.closePath();
                ctxCanvas.beginPath();

                ctxCanvas.moveTo(positionStart.left-dx,(positionStart.top+heightDiv/2)-dy);
                ctxCanvas.lineTo((positionEnd.left+widthDivs)-dx, (positionEnd.top+heightDiv/2)-dy);
                ctxCanvas.closePath();
                ctxCanvas.stroke();
                ctxCanvas.closePath();

                ctxCanvas.beginPath();
                ctxCanvas.arc((positionEnd.left+widthDivs)-dx, (positionEnd.top+heightDiv/2)-dy, 10, 0, 2 * Math.PI);
                ctxCanvas.stroke();
                ctxCanvas.closePath();
            }

        }

}






var answerArray=[]
var linesArray=[]




function checkAnswer(){
    if($('.imageCheckAnswer').length)$('.imageCheckAnswer').remove()
count=0

    for (var i = 0; i < linesArray.length; i++) {
        startPoint=$("#"+linesArray[i].indexStartBox).attr('attrindex');
        endPoint=$("#"+linesArray[i].indexEndtBox).attr('attrindex');

       coordinate= getCorrectpositionToCheckAnswer(linesArray[i].indexStartBox,linesArray[i].indexEndtBox);
        if(startPoint==endPoint){

            $('<img class="imageCheckAnswer" src="img/checkright.png">').appendTo('#'+linesArray[i].indexStartBox)
            count++
        }
        else{
            $('<img class="imageCheckAnswer" src="img/wrong.png">').appendTo('#'+linesArray[i].indexStartBox)


        }

        $("#"+linesArray[i].indexStartBox).attr('checkedValue','yes');
    }

    addXToAllNoneAnswerd();
alert("Score : "+count+"/"+matchingArray.length)
}


function getCorrectpositionToCheckAnswer(startId,endId){

    var p = $( "#"+startId );
    var positionStart = p.offset();

    var p = $( "#"+endId );
    widthDivs=parseInt($( "#"+endId).css('width'))
    var positionEnd = p.offset();


    return {
        corrdStart:positionStart,
        coord:positionEnd

    }
}

function addXToAllNoneAnswerd(){

    var divs = $(".colEl1");

    divs.each(function( index ) {

        if($(this).attr('checkedValue')=='yes'){

        }
        else
        {
            $('<img class="imageCheckAnswer" src="img/wrong.png">').appendTo(this)
        }
    });
}


function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}