

TopColor=""
BottomColor=""
function addColoumn() {





    text1 = "<div colType='top' swipetype='swaptop' class='matching-top coloumnTop column'>" +
        "<span>" +
        "Coloumn top" +
        "</span>" +
        "</div>"


    text2 = "<div colType='bottom' swipetype='swapbottom' class='matching-bottom coloumnBottom column'>" +
        "<span>" +
        "Coloumn bottom" +
        "</span>" +
        "</div>"


    canvasText = "<canvas id='canvasColumn' class='canvasColumn'>" +

        "</canvas>"


    $(".gameContent").append(canvasText)

    $(".gameContent").append(text1)
    $(".gameContent").append(text2)


    resizeCanvas()

    $(".column").droppable({
        greedy: true,
        tolerance: "touch",
        drop: function (event, ui) {
            console.log("drop")
            var self = this


            // if(game[0].typeEdit == "TrueAndFalse") {
            //     checkAnswer(this,ui.draggable)
            // }

        },
        over: function (event, ui) {
            var self = this
            var isDisabled = ui.draggable.draggable('option', 'revert');

            colType = $(this).attr("colType")

            ui.draggable.attr("columnType", colType)
            ActiveElement.matching.column = colType
            if (isDisabled) {
                $(this).css("background", "red")

                setTimeout(function () {
                    $(self).css("background", "#4e4e4e")
                }, 1000)

            }


        },
        out: function (event, ui) {
            $(this).css("background", "#4e4e4e")

        }
    });

    setupMatchingDirection()

    drawLineFromColumnToElement()
    drawConnected()

}




function getColumnPoints() {

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
        },
        bottomPoint: {
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


    top_col = $(".matching-top")
    bottom_col = $(".matching-bottom")

    var position_top_col = top_col.offset();
    var position_bottom_col = bottom_col.offset();

    var targ = document.getElementById("canvasColumn");




    points.topPoint.width = parseInt(top_col.css("width"))
    points.topPoint.height = parseInt(top_col.css("height"))
    points.topPoint.x = position_top_col.left - ($(targ).offset().left )
    points.topPoint.y = position_top_col.top - ($(targ).offset().top )
    points.topPoint.centerX = parseInt(top_col.css("width")) / 2
    points.topPoint.centerY = parseInt(top_col.css("height")) / 2

    points.topPoint.relativeCenterX = points.topPoint.x + points.topPoint.centerX
    points.topPoint.relativeCenterY = points.topPoint.y + points.topPoint.centerY


    points.bottomPoint.x = position_bottom_col.left - $(targ).offset().left
    points.bottomPoint.y = position_bottom_col.top - $(targ).offset().top
    points.bottomPoint.width = parseInt(bottom_col.css("width"))
    points.bottomPoint.height = parseInt(bottom_col.css("height"))
    points.bottomPoint.centerX = parseInt(bottom_col.css("width")) / 2
    points.bottomPoint.centerY = parseInt(bottom_col.css("height")) / 2

    points.bottomPoint.relativeCenterX =  points.bottomPoint.x + points.bottomPoint.centerX
    points.bottomPoint.relativeCenterY =  points.bottomPoint.y + points.bottomPoint.centerY


    return points

}

var column

function initMatching() {

    if (game.typeEdit != "matching") {
        return
    }
    TopColor=getRandomColor()
    BottomColor=getRandomColor()
    addColoumn()
    column = getColumnPoints()

    refeshCanvas()


    drawConnected()
    drawLineFromColumnToElement()
}


function drawLineFromColumnToElement() {

    if (game.typeEdit != "matching") {
        return
    }

    var canvas = document.getElementById("canvasColumn")
    var ctx = canvas.getContext("2d");
    canvas.width = canvas.width
    column = getColumnPoints()


    game.objects.forEach(function (element) {

        if (element != "removed") {

            var conve = fromPercentToPx(element)
            pointElement = {
                x: conve.x,
                y: conve.y
            }


            //console.log(pointElement.x,pointElement.y)
            if (element.matching.column == "top") {
                drawLine(column.topPoint, pointElement, element)
            } else {

                drawLine(column.bottomPoint, pointElement, element)
            }
        }

    });


}

function drawLine(pointColumn, pointElement, element) {
    var canvas = document.getElementById("canvasColumn")
    var ctx = canvas.getContext("2d");


    var sizeElement = fromPercentToPxSize({width: element.width, height: element.height})



    if(game.matchingDirection=="rightToLeft" || game.matchingDirection=="LeftToRight") {
        var point = {
            x1: pointColumn.relativeCenterX,
            y1: pointColumn.relativeCenterY,
            x2: pointElement.x + (sizeElement.width / 2),
            y2: pointElement.y + (sizeElement.height / 2)
        }
    }else {
        var point = {
            x1: pointColumn.relativeCenterX,
            y1: pointColumn.relativeCenterY,
            x2: pointElement.x + (sizeElement.width / 2),
            y2: pointElement.y + (sizeElement.height / 2)
        }
    }

    // if (element.matching.column == "top") {
    //     if (pointElement.x <= pointColumn.relativeCenterX) {
    //         point.x2 = point.x2 + (sizeElement.width / 2);
    //
    //         if (pointElement.y <= point.y1) {
    //             point.x2 = point.x2 + (sizeElement.width / 2);
    //         }
    //
    //     } else {
    //         point.x2 = point.x2 + (sizeElement.width / 2);
    //
    //         if (pointElement.y <= point.y1) {
    //             point.x2 = point.x2 - (sizeElement.width / 2);
    //         }
    //     }
    //
    //
    // } else {
    //
    //     if (pointElement.x <= pointColumn.relativeCenterX) {
    //         point.y2 = point.y2 + (sizeElement.height);
    //         point.x2 = point.x2 + (sizeElement.width / 2);
    //     } else {
    //         point.y2 = point.y2 + (sizeElement.height);
    //         point.x2 = point.x2 + (sizeElement.width / 2);
    //
    //     }
    // }


    ctx.save()
    ctx.beginPath();

        ctx.moveTo(getPointRelativeToCanvas(point.x1, "left").val, getPointRelativeToCanvas(point.y1, "top").val);
        ctx.lineTo(getPointRelativeToCanvas(point.x2, "left").val, getPointRelativeToCanvas(point.y1, "top").val);
        ctx.lineTo(getPointRelativeToCanvas(point.x2, "left").val, getPointRelativeToCanvas(point.y2, "top").val);


    ctx.shadowColor = '#999';
    ctx.shadowBlur = 2;
    if (element.matching.column == "top") {
        ctx.shadowOffsetX = 1;
        ctx.shadowOffsetY = 2;
        ctx.lineWidth = 5;
        ctx.strokeStyle = TopColor;
    } else {
        ctx.shadowOffsetX = 2;
        ctx.shadowOffsetY = 1;
        ctx.lineWidth = 5;
        ctx.strokeStyle = BottomColor;
    }

    ctx.stroke();


    ctx.beginPath();

    ctx.shadowColor = "rgba(0,0,0,0)";
    ctx.arc(getPointRelativeToCanvas(point.x2, "left").val, getPointRelativeToCanvas(point.y2, "top").val, 4, 0, 2 * Math.PI);
    ctx.stroke();

    ctx.fillStyle = '#4e4e4e';
    ctx.fill();
    ctx.restore()
}


function assignEventToCircleMatching(circleID) {

    if (game.typeEdit != "matching") {
        return
    }

    var element = document.getElementById(circleID)

    var getDirection = $("#" + $(element).attr("target")).attr("columntype")


    if (getDirection == "top") {

        //element.addEventListener("contextmenu", function(e){ e.preventDefault();}, false);


    }


    element.onmousedown = function () {
        mouseDownCircle(element)
    }
}

function mouseDownCircle(element) {
    event.stopPropagation()
    points = getElementRect("#" + element.id)

    console.log(points)
    assignEventToCanvasMatching(points, element)


}

function assignEventToCanvasMatching(points, elem) {

    if (game.typeEdit != "matching") {
        return
    }

    var element = document.getElementById("canvasColumn")
    var container = document.getElementById("gameContainer")


    container.onmousemove = function () {
        onmouseMoveContainer(points, container, elem)
    }

    container.onmouseup = function () {
        onmouseUpContainer(points, container, elem)
    }


}


function onmouseMoveContainer(pointsCircle, container, elem) {
    refeshCanvas()


    mouseX = getPosition(event, container).x
    mouseY = getPosition(event, container).y


    var relativeStartpoints = getPositionRelativeToCanvas(pointsCircle)

    var point = {
        x1: relativeStartpoints.x,
        y1: relativeStartpoints.y,
        x2: mouseX,
        y2: mouseY
    }

    drawLinkLine(point)


}

function onmouseUpContainer(pointsCircle, container, elem) {
    refeshCanvas()
    mouseX = getPosition(event, container).x
    mouseY = getPosition(event, container).y

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

    linkElementToSource = getElementInfoByID(event.target.id)
    idElement = $(elem).attr("target")


    colType = $(event.target).attr("columntype")   // columntType of destination


    colTypeSource = $("#" + idElement).attr("columntype") // columntType of source

    convertToType = $(event.target).attr("coltype")


    targetElemntJSon = getElementInfoByID(idElement)   // json of source

    swipetype = $(event.target).attr("swipetype")




    if(convertToType==colTypeSource){

        refeshCanvas()
        return

    }

    if (colType == colTypeSource) {
        alert("cant match element to same type !")
        refeshCanvas()
        return
    }






    if (swipetype == "swaptop" || swipetype == "swapbottom" ) {

        if (swipetype == "swaptop") {

            targetElemntJSon.matching.column = "top"
            idsource=targetElemntJSon.matching.linkWith[0]
            $("#"+idElement).attr("columntype","top")


            if(typeof idsource !=  "undefined"){


            $.grep(game.objects, function (e) {
                if (e.id == idsource) {



                    if(typeof game.objects[game.objects.indexOf(e)] == "object" || game.objects[game.objects.indexOf(e)] != "removed"){


                        if (typeof game.objects[game.objects.indexOf(e)].matching.linkWith != "undefined" || typeof game.objects[game.objects.indexOf(e)].matching.linkWith !== undefined) {

                            if (game.objects[game.objects.indexOf(e)].matching.linkWith.length>0){
                                arr = game.objects[game.objects.indexOf(e)].matching.linkWith
                                for (var i in arr) {

                                    if (arr[i] == idElement) {

                                        arr.splice(i, 1);
                                        break;
                                    }
                                }
                            }
                        }

                    }


            }
            });

            targetElemntJSon.matching.linkWith = []
            }

        } else if (swipetype == "swapbottom") {

            targetElemntJSon.matching.column = "bottom"
            $("#"+idElement).attr("columntype","bottom")
        }




    }

    else {





        if (checkIfElementConnected(event.target)) {

            refeshCanvas()
            alert("This element connected to another one !")
            return

        }





        if (colType == "bottom") {

            // alert($(event.target).attr("id"))


            if (!targetElemntJSon.matching.linkWith.includes($(event.target).attr("id"))) {
                targetElemntJSon.matching.linkWith.push($(event.target).attr("id"))
                linkElementToSource.matching.linkWith.push(idElement)
            }
        }


    }

    refeshCanvas()
}


function checkIfElementConnected(elem) {

    id = elem.id

check=false
    game.objects.forEach(function (element) {

        if (element != "removed") {


            for (i = 0; i < element.matching.linkWith.length; i++) {

                if (element.matching.linkWith.includes(id)) {
                    check=true
                }
            }


        }

    })

    return check
}


function drawLinkLine(points) {
    var canvas = document.getElementById("canvasColumn")
    var ctx = canvas.getContext("2d");
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
    ctx.lineWidth = 1;
    ctx.strokeStyle = '#016ab1';
    ctx.stroke();
    ctx.restore()

    ctx.beginPath();
    ctx.arc(points.x2, points.y2, 4, 0, 2 * Math.PI);
    ctx.stroke();
}


function drawConnected() {
    var targ = document.getElementById("canvasColumn");
    game.objects.forEach(function (element) {

        if (element != "removed" ) {

            var pointsSource = getElementRect("#" + element.id)


            for (i = 0; i < element.matching.linkWith.length; i++) {

                if (element.matching.column == "top"){
                    console.log(element.matching.linkWith[i])
                var pointsDestination = getElementRect("#" + element.matching.linkWith[i])


                var point = {
                    x1: pointsSource.relativeCenterX - $(targ).offset().left,
                    y1: (pointsSource.relativeCenterY + pointsSource.height / 2) - $(targ).offset().top,
                    x2: pointsDestination.relativeCenterX - $(targ).offset().left,
                    y2: (pointsDestination.relativeCenterY ) - $(targ).offset().top
                }


                drawLineBetweenRelatedObject(point)
            }
            }


        }

    })

}


function drawLineBetweenRelatedObject(points) {

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
    ctx.strokeStyle = getRandomColor();
    ctx.stroke();
    ctx.restore()

    ctx.beginPath();
    ctx.arc(points.x2, points.y2, 4, 0, 2 * Math.PI);
    ctx.stroke();
}


function deconnectLine(idElement){

   json= getElementInfoByID(idElement)

    sourceID=json.matching.linkWith[0];


   if(json.matching.column=="bottom") {

       $.grep(game.objects, function (e) {
           if (e.id == sourceID) {

               // if (game.objects[game.objects.indexOf(e)].matching.linkWith != undefined || typeof game.objects[game.objects.indexOf(e)].matching.linkWith != "undefined" || game.objects[game.objects.indexOf(e)].matching.linkWith != "")
               // {

               if(typeof game.objects[game.objects.indexOf(e)].matching!="undefined") {
                   arr = game.objects[game.objects.indexOf(e)].matching.linkWith
                   for (var i in arr) {

                       if (arr[i] == idElement) {

                           arr.splice(i, 1);
                           break;
                       }
                   }
               }
               // }
               // else{
               //
               //     refeshCanvas()
               //
               // }
           }
       });

       json.matching.linkWith = []
   }
refeshCanvas()

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

function resizeCanvas() {

    if ($(".canvasColumn").length == 0) {
        return
    }


    canvas=document.getElementById("canvasColumn")




          $(".canvasColumn").css(
            {
                width:"100%",
                height:"100%"
            }
        )


        // aspect = canvas.height/canvas.width,
        widthElem = canvas.offsetWidth
        heightElem = canvas.offsetHeight

    canvas.width = widthElem;
    canvas.height = heightElem


    refeshCanvas()
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
    var position_bottom_col = bottom_col.offset();


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


function refeshCanvas() {
    if(game.typeEdit=="matching") {
        drawLineFromColumnToElement()
        drawConnected()
    }
}

function getPosition(e, targ) {

    e.stopPropagation()
    var targ = document.getElementById("canvasColumn");
    if (!e)
        e = window.event;
    // if (e.target)
    //     targ = e.target;
    // else if (event.srcElement)
    //     targ = e.srcElement;
    // if (targ.nodeType == 3)
    //     targ = targ.parentNode;

    if (checkIFPc()) {

        var x = event.pageX - $(targ).offset().left;
        var y = event.pageY - $(targ).offset().top;
    }
    else {
        var x = event.touches[0].pageX - $(targ).offset().left;
        var y = event.touches[0].pageY - $(targ).offset().top;

    }

    return {"x": x, "y": y};
};


function getPositionRelativeToCanvas(points) {


    var targ = document.getElementById("canvasColumn");

    var x = (points.relativeCenterX) - $(targ).offset().left;
    var y = (points.relativeCenterY) - $(targ).offset().top;


    return {"x": x, "y": y};
};


function getPointRelativeToCanvas(p, dir) {


    // var targ=document.getElementById("canvasColumn");
    //
    // if(dir=="top")
    // var x = (p) - $(targ).offset().top;
    //
    // if(dir=="left")
    //     var x = (p) - $(targ).offset().left;


    return {"val": p};
};


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

function getElementInfoByID(id) {
    json = ""
    $.grep(game.objects, function (e) {
        if (e.id == id) {
            //console.log(game.objects.indexOf(e))
            json = {
                Element: e,
                index: game.objects.indexOf(e),
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



