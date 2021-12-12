var cPushArray = new Array();
var cStep = -1;



function cPush() {
    cStep++;
    if (cStep < cPushArray.length) { cPushArray.length = cStep; }
    cPushArray.push(canvas1.toDataURL());
}


function cUndo() {
    parent.soundEffect("sound/slidemenu.mp3")
    removeCanvas()
    if (cStep > 0) {
        cStep--;
        var canvasPic = new Image();
        canvasPic.src = cPushArray[cStep];
        canvasPic.onload = function () { ctxFill1.drawImage(canvasPic, 0, 0); }
    }
    fillArea()
}


function cRedo() {
    parent.soundEffect("sound/slidemenu.mp3")
    removeCanvas()
    if (cStep < cPushArray.length-1) {
        cStep++;
        var canvasPic = new Image();
        canvasPic.src = cPushArray[cStep];
        canvasPic.onload = function () { ctxFill1.drawImage(canvasPic, 0, 0); }
    }
    fillArea()
}