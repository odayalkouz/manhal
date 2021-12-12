var t = 1;
var AnimiationPoint=""
function assignEventToCircleMatching(elementID) {

    if (game[0].typeEdit != "matching") {
        return
    }

    var element = document.getElementById(elementID)


    element.onmousedown = function (event) {
        mouseDownCircle(element, event)
    }


    element.ontouchstart = function (event) {
        event.preventDefault()
        mouseDownCircle(element, event)
    }


}


function mouseDownCircle(element, event) {
    event.stopPropagation()
    points = getElementRect("#" + element.id)


    assignEventToCanvasMatching(points, element)


}


function assignEventToCanvasMatching(points, elem) {

    if (game[0].typeEdit != "matching") {
        return
    }

    var element = document.getElementById("canvasColumn")
    var container = document.querySelector(".gameContentContainer")


    container.onmousemove = function (event) {
        onmouseMoveContainer(points, container, elem, event)
    }

    container.onmouseup = function (event) {
        onmouseUpContainer(points, container, elem, event)
    }


// touch screen


    container.ontouchmove = function (event) {
        event.preventDefault()
        event.stopPropagation();
        onmouseMoveContainer(points, container, elem, event)
    }

    container.ontouchend = function (event) {
        event.preventDefault()
        event.stopPropagation();
        onmouseUpContainer(points, container, elem, event)
    }


    document.body.ontouchstart = function (event) {
        event.preventDefault()
        event.preventDefault()

    }
    document.body.ontouchmove = function (event) {
        event.preventDefault()
        event.preventDefault()

    }


    // $("#gameContent").on('touchleave',"#gameContent", function(e){
    //     event.preventDefault()
    //     event.stopPropagation();
    //
    //     container.ontouchmove=null
    //     container.ontouchend=null
    //
    //     refeshCanvas()
    // });
    //
    // $("#gameContent").on('touchcancel',"#gameContent", function(e){
    //     event.preventDefault()
    //     event.stopPropagation();
    //
    //     container.ontouchmove=null
    //     container.ontouchend=null
    //
    //     refeshCanvas()
    // });


}


var targetTouchElement = ""

function onmouseMoveContainer(pointsCircle, container, elem, event) {
    refeshCanvas()


    mouseX = getPosition(event, container).x
    mouseY = getPosition(event, container).y
    NmouseY = getPosition(event, container).x_Native
    NmouseY = getPosition(event, container).y_Native


    var xcoord = event.touches ? event.touches[0].pageX : event.pageX;
    var ycoord = event.touches ? event.touches[0].pageY : event.pageY;
    // get element in coordinates:
    targetTouchElement = document.elementFromPoint(xcoord, ycoord);


    var relativeStartpoints = getPositionRelativeToCanvas(pointsCircle)

    var point = {
        x1: relativeStartpoints.x,
        y1: relativeStartpoints.y,
        x2: mouseX,
        y2: mouseY
    }

    drawLinkLine(point)

    drawConnectedLine()
}


function onmouseUpContainer(pointsCircle, container, elem, event) {

    var vertices = [];


    canvas.width = canvas.width
    refeshCanvas()


    if (!is_touch_device()) {
        mouseX = getPosition(event, container).x
        mouseY = getPosition(event, container).y


        targetTouchElement = event.target;


    } else {


    }

    var relativeStartpoints = getPositionRelativeToCanvas(pointsCircle)

    var point = {
        x1: relativeStartpoints.x,
        y1: relativeStartpoints.y,
        x2: mouseX,
        y2: mouseY
    }


    drawLinkLine(point)

    container.onmousemove = null
    container.onmouseup = null


    container.ontouchmove = null
    container.ontouchend = null


    colTypeDestination = $("#" + targetTouchElement.id).attr("colType")
    colTypeSource = $("#" + elem.id).attr("colType")
    isConnect = $("#" + targetTouchElement.id).attr("isConnect")
    connectToID = $("#" + targetTouchElement.id).attr("connectTo")
    idSource = $(elem).attr("id")

    if (
        targetTouchElement.id == elem.id

    ) {
        canvas.width = canvas.width
        drawConnectedLine()
        return
    }


    if (
        (colTypeDestination == "top"
            || colTypeDestination == "bottom")

        && (colTypeSource == "top"
        || colTypeSource == "bottom")

    ) {

        canvas.width = canvas.width
       drawConnectedLine()
        if (MatchingMapArray[idSource].answer.includes(targetTouchElement.id)  // if tow element already connected

            || MatchingMapArray[targetTouchElement.id].answer.includes(idSource)
        ) {
            canvas.width = canvas.width
            drawConnectedLine()
            return
        }


        //
        if (isConnect == "true") { //check if connect
            //
            // if (MatchingMapArray[connectToID].answer.includes(targetTouchElement.id)) { ///remove from top elemtent if connect
            //
            //    i= MatchingMapArray[connectToID].answer.indexOf(targetTouchElement.id)
            //     MatchingMapArray[connectToID].answer.splice(i, 1);
            //
            // }
        }


        linkElementToSource = getElementInfoByID(targetTouchElement.id) //json of target


        targetElemntJSon = getElementInfoByID(idSource)   // json of source

        // if (colTypeDestination == "top") {
        //     MatchingMapArray[idSource].answer.push(targetTouchElement.id) // push to source
        // } else if (colTypeSource == "top") {
        //
        // }


        checkAnswer=newCheckMatching(idSource,targetTouchElement.id)

        if(!checkAnswer){
            return
        }


        MatchingMapArray[targetTouchElement.id].answer.push(idSource) // push to target

        $("#" + targetTouchElement.id).attr("isConnect", "true")
        $("#" + idSource).attr("isConnect", "true")


        var targ = document.getElementById("canvasColumn");


      sourceJSon=  getElementRect("#" +idSource)
      targetJSon=  getElementRect("#" + targetTouchElement.id)



        var pointFinal = {
            x1: sourceJSon.relativeCenterX - $(targ).offset().left,
            y1: (sourceJSon.relativeCenterY) - $(targ).offset().top,
            x2: targetJSon.relativeCenterX - $(targ).offset().left,
            y2: (targetJSon.y + targetJSon.height / 2) - $(targ).offset().top
        }


        vertices.push({
            x: pointFinal.x1,
            y:pointFinal.y1
        });

        vertices.push({
            x: pointFinal.x2,
            y:pointFinal.y2
        });

        t = 1;
        AnimiationPoint=""
        AnimiationPoint = calcWaypoints(vertices);
// extend the line from start to finish with animation
        animate();



    } else {

        canvas.width = canvas.width
        drawConnectedLine()
    }





    // refeshCanvas()
}



function newCheckMatching(obj1ID,obj2ID){

    var checkAnswer=false

    obj1=$("#"+obj1ID)
    obj2=$("#"+obj2ID)
    colTypeObj1=obj1.attr("coltype")
    colTypeObj2=obj2.attr("coltype")
    arrayAnswer=""
    bottomObject=""
    if(colTypeObj1=="top"){

        fetchAnswers=$(obj1).attr("answer")


        bottomObject=obj2ID




    }else if(colTypeObj2=="top"){

        fetchAnswers=$(obj2).attr("answer")

        bottomObject=obj1ID



    }




        arrayAnswer =  fetchAnswers.split(',');



    arrayAnswer.forEach(function(element) {
        if(element==bottomObject){
            checkAnswer=true

            countCorrectAnswersByUser++
            $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer)

            if (countCorrectAnswersByUser >= countOfcorrectAnswer) {
                per = Math.round((countCorrectAnswersByUser / (countCorrectAnswersByUser + countOfcorrectAnswer)) * (100 / 1));
                setTimeout(function () {
                    win()
                }, 2000)
            } else {
                per = Math.round((countCorrectAnswersByUser / (countCorrectAnswersByUser + countOfcorrectAnswer)) * (100 / 1));
                correctAnswer()
            }

        }

    });

    if(!checkAnswer){
        $('#score span').html(countCorrectAnswersByUser + " / " + countOfcorrectAnswer)
        failAnswerCounter++

        tryAgain()
    }

return checkAnswer
}


function drawLinkLine(points) {
    var canvas = document.getElementById("canvasColumn")
    var ctx = canvas.getContext("2d");

    canvas.width = canvas.width

    ctx.save()

    ctx.beginPath();
    ctx.arc(points.x1, points.y1, 4, 0, 2 * Math.PI);
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo(points.x1, points.y1);
    //
    ctx.lineTo(points.x2, points.y2);
    ctx.shadowColor = '#999';
    ctx.shadowBlur = 2;
    ctx.lineWidth = 3;
    ctx.strokeStyle = '#016ab1';
    ctx.stroke();
    ctx.restore()

    ctx.beginPath();
    ctx.arc(points.x2, points.y2, 4, 0, 2 * Math.PI);
    ctx.stroke();

    drawConnectedLine()
}


function drawConnectedLine() {

    var targ = document.getElementById("canvasColumn");

    for (var key in MatchingMapArray) {

        sourceID = key
        sourceJson = getElementRect("#" + sourceID)

        answers = MatchingMapArray[key].answer

        //  console.log(answers)


        if (typeof answers !== undefined || typeof answers != "undefined") {

            if (answers.length > 0) {

                for (j = 0; j < answers.length; j++) {

                    distinationJson = getElementRect("#" + answers[j])

                    var point = {
                        x1: sourceJson.relativeCenterX - $(targ).offset().left,
                        y1: (sourceJson.relativeCenterY) - $(targ).offset().top,
                        x2: distinationJson.relativeCenterX - $(targ).offset().left,
                        y2: (distinationJson.y + distinationJson.height / 2) - $(targ).offset().top
                    }


                    drawLineBetweenRelatedObject(point)


                    var mid = getMidLine(point)


                    // if ($("#unconnect_" + sourceID + answers[j]).length > 0) {
                    //
                    //     $("#unconnect_" + sourceID + answers[j]).remove()
                    // }


                    // var text = "<img target='" + answers[j] + "' source='" + sourceID + "' id='unconnect_" + sourceID + answers[j] + "' style='cursor:pointer;width:auto;height:auto;position:absolute;max-width:4%;max-height:4%;z-index: 9999999999999' class='stopUnconnect' src='../all/images/icons8-no-entry-64.png'>"
                    //
                    // // $(".gameContent").append(text)
                    //
                    //
                    // var _width = parseInt($("#unconnect_" + sourceID + answers[j]).css("width")) / 2
                    // var _height = parseInt($("#unconnect_" + sourceID + answers[j]).css("width")) / 2
                    //
                    // document.getElementById("unconnect_" + sourceID + answers[j]).ontouchend=function() {
                    //     targetID_ = $(this).attr("target")
                    //     sourceID_ = $(this).attr("source")
                    //
                    //
                    //     if (MatchingMapArray[sourceID_].answer.includes(targetID_)) { ///remove from top elemtent if connect
                    //
                    //         i = MatchingMapArray[sourceID_].answer.indexOf(targetID_)
                    //         MatchingMapArray[sourceID_].answer.splice(i, 1);
                    //
                    //     }
                    //
                    //
                    //     $(this).remove()
                    //     var canvas = document.getElementById("canvasColumn")
                    //     var ctx = canvas.getContext("2d");
                    //
                    //     canvas.width = canvas.width
                    //     drawConnectedLine()
                    // }


                    // $("#unconnect_" + sourceID + answers[j]).click(function () {
                    //
                    //     targetID_ = $(this).attr("target")
                    //     sourceID_ = $(this).attr("source")
                    //
                    //
                    //     if (MatchingMapArray[sourceID_].answer.includes(targetID_)) { ///remove from top elemtent if connect
                    //
                    //         i = MatchingMapArray[sourceID_].answer.indexOf(targetID_)
                    //         MatchingMapArray[sourceID_].answer.splice(i, 1);
                    //
                    //     }
                    //
                    //
                    //     $(this).remove()
                    //     var canvas = document.getElementById("canvasColumn")
                    //     var ctx = canvas.getContext("2d");
                    //
                    //     canvas.width = canvas.width
                    //     drawConnectedLine()
                    // }).css({
                    //     left: eval(mid.x - _width) + "px",
                    //     top: eval(mid.y - _height) + "px",
                    // })

                }

            }
        }
    }


}


function checkAnswerMatching() {
    var validAnswer = []
    var wrongAnswer = []
    var Allchecked = 0

    var checked = 0
    for (var key in MatchingMapArray) {

        sourceID = key
        sourceJson = getElementRect("#" + sourceID)

        answers = MatchingMapArray[key].answer
        correct = MatchingMapArray[key].correct
        typeCol = MatchingMapArray[key].type

        //  console.log(answers)

        if (typeCol == "top") {
            for (j = 0; j < correct.length; j++) {

                Allchecked++
            }

        }

        if (typeof answers !== undefined || typeof answers != "undefined") {


            if (answers.length > 0) {

                for (j = 0; j < answers.length; j++) {


                    if (correct.includes(answers[j])) {


                        validAnswer.push(answers[j])
                        checked++


                        $("#" + answers[j]).attr("validated", "true")
                        $("#" + answers[j]).attr("checkAnswer", "true")


                        lottieValid(answers[j])


                    } else {
                        wrongAnswer.push(answers[j])


                        lottieWrong(answers[j])


                        $("#" + answers[j]).attr("validated", "true")
                        $("#" + answers[j]).attr("checkAnswer", "false")
                    }

                }

            }


        }


    }


    // if (validAnswer.length != 0) {
    //
    //     $(".elementsObject").each(function () {
    //
    //         isValidated = $(this).attr("validated")
    //         isBottom = $(this).attr("colType")
    //         answer = $(this).attr("answer")
    //         id = $(this).attr("id")
    //
    //         if($("#" + answers).attr("validated")!="true") {
    //             if (answer != "") {
    //                 wrongAnswer.push(id)
    //                 lottieWrong(id)
    //                 $("#" + id).attr("validated", "true")
    //                 $("#" + id).attr("checkAnswer", "false")
    //             }
    //         }
    //
    //     })
    // }


    if (validAnswer.length == 0 && wrongAnswer.length == 0) {
        alert("please put your answer")
        return

    }


    setTimeout(function () {

        if (wrongAnswer.length == 0 && (checked == Allchecked)) {

            // initGame() // new level

            win();

        } else {

            loss()

        }

    }, 2000)

}


function loss() {
    str = '<div class="hintContainerWin final">' +
        '<div class="hintWin final animated bounce" >' +
        '<label class="labelWin lose" >' + finalMessageEror + '</label>' +
        '<img class="imgShapes animated shake" src="../all/images/loser.png">' +
        '<a class="relodeImg playAgain" onclick="again()"><i></i></a>' +

        '</div>' +
        '</div>'

    $(str).appendTo("body")
}


function lottieValid(id) {


    var path = '../all/done.json'
    var animation = bodymovin.loadAnimation({
        container: document.getElementById(id), // Required

        path: path,
        renderer: 'svg/canvas/html', // Required
        loop: false, // Optional
        autoplay: true, // Optional
        name: "checked", // Name for future reference. Optional.
        end: function (data) {
            // alert()
        }

    })
}

function lottieWrong(id) {
    var path = '../all/failed.json'
    var animation = bodymovin.loadAnimation({
        container: document.getElementById(id), // Required

        path: path,
        renderer: 'svg/canvas/html', // Required
        loop: false, // Optional
        autoplay: true, // Optional
        name: "checked", // Name for future reference. Optional.
        end: function (data) {
            // alert()
        }

    })
}

function checkIfElementConnnected(elem) {


}

function print(msg) {
    console.log(msg)
}


function drawLineBetweenRelatedObject(points) {
    // print(points)
    var canvas = document.getElementById("canvasColumn")
    var ctx = canvas.getContext("2d");
    ctx.beginPath();
    ctx.arc(points.x1, points.y1, 4, 0, 2 * Math.PI);
    ctx.stroke();

    ctx.beginPath();
    ctx.moveTo(points.x1, points.y1);
    //
    ctx.lineTo(points.x2, points.y2);
    ctx.shadowColor = '#999';
    ctx.shadowBlur = 2;
    ctx.lineWidth = 3;
    ctx.strokeStyle = '#016ab1';
    ctx.stroke();
    ctx.restore()

    ctx.beginPath();
    ctx.arc(points.x2, points.y2, 4, 0, 2 * Math.PI);
    ctx.stroke();


}


function checkIFPc() {

    if (is_touch_device()) {

        return false
    }else{

        return false

    }

}

function getPositionRelativeToCanvas(points) {


    var targ = document.getElementById("canvasColumn");

    var x = (points.relativeCenterX) - $(targ).offset().left;
    var y = (points.relativeCenterY) - $(targ).offset().top;


    return {"x": x, "y": y};
};

function is_touch_device() {
    return 'ontouchstart' in window;
}
function getPosition(event, targ) {

    event.stopPropagation()
    var targ = document.getElementById("canvasColumn");
    if (!event)
        e = window.event;
    // if (e.target)
    //     targ = e.target;
    // else if (event.srcElement)
    //     targ = e.srcElement;
    // if (targ.nodeType == 3)
    //     targ = targ.parentNode;

    if (!is_touch_device()) {

        var x = event.pageX - $(targ).offset().left;
        var y = event.pageY - $(targ).offset().top;
        var nativeX = event.pageX
        var nativeY = event.pageY
    }
    else {


        if (!event)
            var e = window.event;
        event.preventDefault();
        var touch = event.touches[0];

        var x = touch.pageX - $(targ).offset().left;
        var y = touch.pageY - $(targ).offset().top;
        var nativeX = touch.pageX
        var nativeY = touch.pageY

    }

    return {"x": x, "y": y, x_Native: nativeX, y_Native: nativeY};
};


function refeshCanvas() {
    if (game[0].typeEdit != "matching") {
        // drawLineFromColumnToElement()
        // drawConnected()
    }
}

function resizeCanvas() {

    if ($(".canvasColumn").length == 0) {
        return
    }


    canvas = document.getElementById("canvasColumn")


    $(".canvasColumn").css(
        {
            width: "100%",
            height: "100%"
        }
    )


    // aspect = canvas.height/canvas.width,
    widthElem = canvas.offsetWidth
    heightElem = canvas.offsetHeight

    canvas.width = widthElem;
    canvas.height = heightElem


    refeshCanvas()
    drawConnectedLine()
}


function getElementRect(selector) {

    top_col = $(selector)


    points = {
        topPoint: {
            x: 0,
            y: 0,
            width: 0,
            height: 0,
            centerX: 0,
            centerY: 0,
            relativeCenterX: 0,
            relativeCenterY: 0
        }
    }


    if (top_col.length == 0) {
        return points.topPoint
    }


    var position_top_col = top_col.offset();
    // var position_bottom_col = bottom_col.offset();


    points.topPoint.x = position_top_col.left
    points.topPoint.y = position_top_col.top
    points.topPoint.width = parseInt(top_col.css("width"))
    points.topPoint.height = parseInt(top_col.css("height"))
    points.topPoint.centerX = parseInt(top_col.css("width")) / 2
    points.topPoint.centerY = parseInt(top_col.css("height")) / 2

    points.topPoint.relativeCenterX = points.topPoint.x + points.topPoint.centerX
    points.topPoint.relativeCenterY = points.topPoint.y + points.topPoint.centerY


    return points.topPoint

}


function fromPercentToPx(point) {
    var wrapper = $('.gameContent');

    leftObject = (point.left) * (wrapper.width() / 100)
    topObject = (point.top) * (wrapper.height() / 100)

    var pont = {x: leftObject, y: topObject}

    return pont
}


function fromPercentToPxSize(point) {
    var wrapper = $('.gameContent');

    leftObject = (point.width) * (wrapper.width() / 100)
    topObject = (point.height) * (wrapper.height() / 100)

    var pont = {width: leftObject, height: topObject}

    return pont
}


function getElementInfoByID(id) {
    json = ""
    $.grep(game[0].objects, function (e) {
        if (e.id == id) {
            //console.log(game.objects.indexOf(e))
            json = {
                Element: e,
                index: game[0].objects.indexOf(e),
                id: e.id,
                src: e.src,
                sound: e.sound,
                text: e.text,
                setAsTrue: e.setAsTrue,
                trueOrFalse: e.trueOrFalse,
                matching: e.matching,

            }

        }
    });


    return json
}


function getMidLine(point) {

    var dx = point.x2 - point.x1;
    var dy = point.y2 - point.y1
    var midX = point.x1 + dx * 0.5;
    var midY = point.y1 + dy * 0.5;

    return {x: midX, y: midY}
}



function calcWaypoints(vertices) {

    var waypoints = [];
    for (var i = 1; i < vertices.length; i++) {
        var pt0 = vertices[i - 1];
        var pt1 = vertices[i];
        var dx = pt1.x - pt0.x;
        var dy = pt1.y - pt0.y;
        for (var j = 0; j < 100; j++) {
            var x = pt0.x + dx * j / 100;
            var y = pt0.y + dy * j / 100;
            waypoints.push({
                x: x,
                y: y
            });
        }
    }
    return (waypoints);
}


function animate() {



    var canvas = document.getElementById("canvasColumn")
    var ctx = canvas.getContext("2d");

    if (t < AnimiationPoint.length - 1) {
        requestAnimationFrame(animate);
    }else{
        canvas.width = canvas.width
        drawConnectedLine()
    }
    // draw a line segment from the last waypoint
    // to the current waypoint
    ctx.beginPath();
    ctx.moveTo(AnimiationPoint[t - 1].x, AnimiationPoint[t - 1].y);
    ctx.lineTo(AnimiationPoint[t].x, AnimiationPoint[t].y);
    ctx.shadowColor = '#999';
    ctx.shadowBlur = 2;
    ctx.lineWidth = 3;
    ctx.strokeStyle = '#05b100';
    ctx.stroke();
    // increment "t" to get the next waypoint
    t++;
}

(function () {
    var lastTime = 0;
    var vendors = ['ms', 'moz', 'webkit', 'o'];
    for (var x = 0; x < vendors.length && !window.requestAnimationFrame; ++x) {
        window.requestAnimationFrame = window[vendors[x] + 'RequestAnimationFrame'];
        window.cancelAnimationFrame = window[vendors[x] + 'CancelAnimationFrame'] || window[vendors[x] + 'CancelRequestAnimationFrame'];
    }

    if (!window.requestAnimationFrame) window.requestAnimationFrame = function (callback, element) {
        var currTime = new Date().getTime();
        var timeToCall = Math.max(0, 16 - (currTime - lastTime));
        var id = window.setTimeout(function () {
                callback(currTime + timeToCall);
            },
            timeToCall);
        lastTime = currTime + timeToCall;
        return id;
    };

    if (!window.cancelAnimationFrame) window.cancelAnimationFrame = function (id) {
        clearTimeout(id);
    };
}());
