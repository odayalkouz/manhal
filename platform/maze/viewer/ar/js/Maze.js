var canvas;
var context;
var sec = 0;
var seconds=0;
var minutes=0;
var spendTime;
// The current face position.
var x = 0;
var y = 0;
var W1=15;
var H1=15;
// The current face speed (in both direction).
var dx = 0;
var dy = 0;
// function checkIsMobile(){
//     if(mobilecheck==true){
//         $(".arrow-container").fadeIn();
//     }else{
//         $(".arrow-container").fadeOut();
//     }
// }

function checkIsMobile(){
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        $(".arrow-container").fadeIn();

    }else {
        $(".arrow-container").fadeOut();
    }
    // if(navigator.userAgent.indexOf("Mobile") > 0){
    //     return true;
    // }else{
    //
    //     return false;
    // }
}
if(getUrlParameter('scorm')=='true'){
    var isLMS=true;
}else{
    var isLMS=false;
}

$(window).resize(function () {
    resizeGame();
});
$(document).ready(function () {
    checkIsMobile()
    //scorm
    GetAPI(window);
    if(API!=null){
        if(API.Initialize("")){
            LMSStatus=true;
            API.SetValue("cmi.score.min",0);//to set min score in the game
            API.SetValue("cmi.score.max",100);//to set max score in the game
        }
    }
    // checkIsMobile()



    $('body').manhalLoader({
        splashID: "#jSplash",
        splashVPos: '50%',
        loaderVPos: '90%',
        addFiles: [
            {type: 'image', url: "../../../games/" + config.id+"/images/maze.png"}
        ],
        splashFunction: function () {
            $('<div class="manhal-main-loader"><div class="loader-effect"><div class="checkmark draw"></div>' +
                '</div><div class="logo-loader"></div></div>').appendTo('#manhalpreOverlay');
            if (!isLMS) {
                if(typeof (parent.bookid)=="undefined"){
                    resizeGame();
                    spendTime =setInterval(spendTimer,1000);
                }else {
                    $(".headerGame").hide();
                    spendTime =setInterval(spendTimer,1000);
                    $(".game-container").css({"height":"100%","top":"0","box-shadow":"none","border":"none"})
                }
            }else {

                resizeGame();
                spendTime =setInterval(spendTimer,1000);
            }
        },
        onLoading: function (per) {

        },
    }, function () {
        $("#manhalpreOverlay").fadeOut(0);

    });

    $(".titleText").text(title);

    $(".reload").click(function () {
        $(".main-message-container").fadeOut();
        minutes=0;
        seconds=0;
        sec=0;
        spendTime =setInterval(spendTimer,1000);
    })

});
function spendTimer(){
    seconds=pad(++sec%60);
    minutes=pad(parseInt(sec/60,10));
}
function replyGame() {
    flag=false
    drawMaze("../../../games/" + config.id+"/images/maze.png", x1, y1);
};
window.onload = function() {
    x1=parseInt(game[0][0].leftp)+3;
    y1=parseInt(game[0][0].topp)+3;
    W1=parseInt(String(game[0][0].w).split(" ").join(''));
    H1=parseInt(String(game[0][0].h).split(" ").join(''));


    $('#face').width(W1);
    $('#face').height(H1);
    // Set up the canvas.
    canvas = document.getElementById("canvas");
    context = canvas.getContext("2d");
    // ** New code for local storage. **
    var x = x1;
    var y = y1;
    if (localStorage) {
        var savedX = localStorage.getItem("mazeGame_currentX");
        var savedY = localStorage.getItem("mazeGame_currentY");
        if (savedX != null) x = Number(savedX);
        if (savedY != null) y = Number(savedY);
    }

    // Draw the maze background.
    drawMaze("../../../games/" + config.id+"/images/maze.png", x, y);

    // When the user presses a key, run the processKey() function.
    window.onkeydown = processKey;
};

window.onbeforeunload = function(e) {
    if (localStorage) {
        if (confirm("Do you want to save your current position in the maze, for next time?")) {
            localStorage.setItem("mazeGame_currentX", x);
            localStorage.setItem("mazeGame_currentY", y);
        }
    }
}

// Keep track of the current timer, so the drawing can be
// easily stopped and restarted if a new maze is loaded.
var timer;

function drawMaze(mazeFile, startingX, startingY) {
    // Stop drawing (if it's taking place).
    clearTimeout(timer);

    // Stop the happy face (if it's moving).
    dx = 0;
    dy = 0;

    // Load the maze picture.
     imgMaze = new Image();
    imgMaze.onload = function() {
        // Resize the canvas to match the maze picture.
        //imgMaze.width=1024;
        //imgMaze.height=768;


        imgMaze.width=1024;
        imgMaze.height=768;

        canvas.width = imgMaze.width;
        canvas.height = imgMaze.height;

        // Draw the maze.
        context.drawImage(imgMaze, 0,0);

        // Draw the face.
        x = startingX;
        y = startingY;

        var imgFace = document.getElementById("face");
        $("#face").width(W1);
        $("#face").height(H1);

        context.drawImage(imgFace,x, y,W1,H1);


        // Draw the next frame in 10 milliseconds.
        timer = setTimeout("drawFrame()", 10);
    };
    imgMaze.src = mazeFile;
}


function processKey(e) {
    // If the face is moving, stop it.
    dx = 0;
    dy = 0;

    // If an arrow key was pressed, and adjust the speed accordingly.
    // (Ignore any other key.)

    // The up arrow was pressed, so move up.
    if (e.keyCode == 38) {
        dy = -1;
    }

    // The down arrow was pressed, so move down.
    if (e.keyCode == 40) {
        dy = 1;
    }

    // The left arrow was pressed, so move left.
    if (e.keyCode == 37) {
        dx = -1;
    }

    // The right arrow was pressed, so move right.
    if (e.keyCode == 39) {
        dx = 1;
    }
}

function checkForCollision() {
    // Grab the block of pixels where the happy face is, but extend the edges just a bit.
    var imgData = context.getImageData(x-1, y-1,(W1+2),(H1+2));
    var pixels = imgData.data;

    // Check these pixels.
    for (var i = 0; n = pixels.length, i < n; i += 4) {
        var red = pixels[i];
        var green = pixels[i+1];
        var blue = pixels[i+2];
        var alpha = pixels[i+3];

        // Look for black walls (which indicates a collision).
        if (red == 0 && green == 0 && blue == 0) {
            return true;
        }

        // Look for gray edge space (which indicates a collision).
        if (red == 169 && green == 169 && blue == 169) {
            return true;
        }
        if (red == 191 && green == 191 && blue == 191) {
            return true;
        }
        if (red == 255 && green == 201 && blue == 14) {
            flag=true;
            return true;
        }
    }
    // There was no collision.
    return false;
}

flag=false
function drawFrame() {
    // Only draw a new frame if the face is moving.
    if (dx != 0 || dy != 0) {
        // Clear away the previous face position (but leave a yellow patch there,
        // to create the "trail" effect.)
       // context.beginPath();
       // context.fillStyle = "rgb(254,244,207,0.1)";
       // context.rect(x,y,W1,H1);
       // context.fill()

        // Increment the face's position.
        x += dx;
        y += dy;

        // Stop the face if it hit a wall, and move it back to the old position.
        if (checkForCollision()) {
            x -= dx;
            y -= dy;
            dx = 0;
            dy = 0;
        }
        context.drawImage(imgMaze, 0,0);
        // Draw the face at its new position.
        var imgFace = document.getElementById("face");
        $("#face").width(W1);
        $("#face").height(H1);

        context.drawImage(imgFace, x, y,W1,H1);

        // Check if the user has finished the maze (reached the bottom edge).
        // If so, show a message and return from the function, so no more frames are drawn.
        if (flag) {
            //scorm
            clearInterval(SetTimerScorm);
            SetTimerScorm=null;
            var Result='unknown';
            var per=100;
            Result='passed';
            if (!isLMS) {
                if(typeof (parent.bookid)=="undefined"){
                    normalMessag();
                    clearInterval(spendTime);
                    console.log("--------------------------------");
                    console.log(minutes+":"+seconds);
                }else{
                    BookMessage();
                }
            }

            if(LMSStatus){

                API.SetValue("cmi.score.raw",per.toFixed(2));//return text true or false | to set student mark
                API.SetValue("cmi.completion_status","completed");//when complete game
                API.SetValue("cmi.success_status",Result);//when complete game set value to one of ("passed","failed","unknown")
                API.SetValue("cmi.session_time",TimeScorm);//to set Amount of seconds that the learner has spent

                API.Commit("");//return text true or false | to save student mark to DB
            }
            TimeScorm=0;
            return;
        }
    }

    // Draw a new frame in 10 milliseconds.
    timer = setTimeout("drawFrame()", 10);
}

function normalMessag() {

    $("#feedback").attr("class","");
    $("#message-icone").attr("class","");
    $(".result-container span").html(minutes+":"+seconds);
    $("#feedback").addClass("wellDonw");
    $("#message-icone").addClass("wellDonw-icon");
    $(".main-message-container").fadeIn();
}

function BookMessage() {
    window.parent.showBookMsg("أحسنت","<span style='display: block;font-size: 2vmin;'>نتيجتك هي</span ><span style='font-size: 2vmin;font-weight: bold;'>%100</span>",window.parent.$('iframe[src="'+window.location.href+'"]').closest(".element").attr("id"));
}


function resizeGame() {
    var gameArea = document.getElementById('gameConainer');
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
    var gameCanvas = document.getElementById('inner-gameContainer');
    gameCanvas.style.width = newWidth + 'px';
    gameCanvas.style.height = newHeight + 'px';
}




function pad ( val ) { return val > 9 ? val : "0" + val; }
