<html>
<header>
    <meta charset="UTF-8">

    <link href="css/shapes.css" rel="stylesheet" type="text/css">
    <link href="../all/css/animate.css" rel="stylesheet" type="text/css">
    <link href="../all/css/hover.css" rel="stylesheet" type="text/css">
    <link href="css/styleDrawing.css" rel="stylesheet" type="text/css">
    <link href="../all/css/messageBox.css" rel="stylesheet" type="text/css">
    <link href="../all/css/timer.css" rel="stylesheet" type="text/css">
    <link href="css/manhalloader.css" rel="stylesheet" type="text/css">


    <script type="text/javascript" src="../all/js/jquery.js"></script>

    <!--<script type="text/javascript" src="../all/js/game.js"></script>-->
    <script>
//        if (document.location.host != 'www.manhal.com') {
//            window.location.href='https://www.manhal.com/';
//        }
        config = {};
        //config.location = parseURLParams(location.href);
        config.id =<?=$_GET["id"];?>;
        config.srcLink = "../../../games/" + config.id + "/all/js/game.js?v=" + Date.now();
        var stringLink = "<script type='text/javascript' src='" + config.srcLink + "'><\/script>"
        document.write(stringLink);

        langStory = "ar"
    </script>
    <script type="text/javascript" src="../all/js/manhalLoader.js"></script>
    <script type="text/javascript" src="../all/js/index.js"></script>
    <script type="text/javascript" src="../all/js/connect-the-dots.js"></script>
    <script type="text/javascript" src="../all/js/drawing.js"></script>
    <script type="text/javascript" src="../all/js/timerN.js"></script>
    <script type="text/javascript" src="../all/js/msg.js"></script>
    <script type="text/javascript" src="../all/js/sound.js"></script>
    <script type="text/javascript" src="../all/js/scorm.js"></script>


</header>
<title>توصيل النقاط</title>
<body>

<div class="loader"></div>
<div class="main-container" id="main-container">
    <div class="inner-container" id="inner-container">
        <div class="instructions-container" style="display: none">
            <div class="instructions-main">
                <div class="instructions-text-container">
                    <div class="image-paper paper-1"></div>
                    <div class="image-paper paper-2"></div>
                    <div class="instructions-text-container-box">
                        <div class="label-game"></div>
                        <div class="instructions-text-inner-container-box">
                            <div class="instructions-image-container floating-left"></div>
                            <div class="text-container floating-left"><span></span></div>
                        </div>
                        <a class="play-btn"><i></i></a>
                    </div>
                    <div class="instructions-footer">
                        <div class="image-footer image-1"></div>
                        <div class="image-footer image-2"></div>
                        <div class="image-footer image-3"></div>
                        <div class="image-footer image-4"></div>
                        <span class="copy-right"></span>
                    </div>
                </div>
            </div>
            <span class="powerBy floating-left"></span>
        </div>
        <img id="pointerhand" src="../all/images/30895.png" style="

">
            <div id="gameContainer" class="gameContainer gameContainer animated lightSpeedIn">
                <div class="headerGame">
                    <div class="inner-headerGame">
                        <label class="lbl-qustion">The rules and instructions to games can often be misplaced
                            and?</label>
                    </div>
                </div>
                <div class="inner-game-container">
                    <div class="gameContentContainer">
                        <div id="canvas" class="gameContent clip-animation">


                            <canvas id="canvasDrawing">not Support</canvas>


                        </div>
                    </div>
                </div>


                <div class="fotterGame">
                    <div class="left-footer floating-left"></div>
                    <div class="center-footer floating-left">
                        <a class="MuteCont floating-right"><i class="muteIcon"></i></a>
                        <a id="helpIcon" class="hvr-bounce-in bounceInLeft animated floating-right"
                           onclick="helpConnect(this)"><i></i></a>
                        <img id="hear" onclick="listen()" src="../all/images/ear_button.png" style="display: none;">
                        <div id="Try" class="try floating-right">
                            <div class="try-icon floating-left"></div>
                            <div class="star-container floating-right">
                                <span class="floating-right"><img id="tryCounter0"
                                                                  class="hvr-rotate star slideInLeft animated"
                                                                  onclick="" src="../all/images/star.svg"></span>
                                <span class="floating-right"><img id="tryCounter1"
                                                                  class="hvr-rotate star slideInUp animated" onclick=""
                                                                  src="../all/images/star.svg"></span>
                                <span class="floating-right"><img id="tryCounter2"
                                                                  class=" hvr-rotate star slideInUp animated" onclick=""
                                                                  src="../all/images/star.svg"></span>
                                <span class="floating-right"><img id="tryCounter3"
                                                                  class="hvr-rotate star slideInRight animated"
                                                                  onclick="" src="../all/images/star.svg"></span>
                            </div>
                        </div>


                        <!--<img id="helpIcon" class="hvr-bounce-in bounceInLeft animated" onclick="helpConnect(this)"-->
                        <!--src="images/help.png">-->
                        <div class="face-container floating-left">
                            <img src='../all/images/logonormal.svg' class='face animated'>
                        </div>
                        <div id="score" class="floating-left">
                            <div class="scor-icon"><i></i></div>
                            <div class="scor-number-container floating-right">
                                <span class="resizeText">0</span>
                            </div>
                        </div>
                        <div id="scoreFail" class="floating-left">
                            <div class="scor-icon"><i></i></div>
                            <div class="scor-number-container floating-right">
                                <span class="resizeText">0</span>
                            </div>
                        </div>
                    </div>
                    <div class="right-footer floating-left"></div>


                </div>
            </div>
        </div>
    </div>
</div>


<audio id="good">
    <source src="../all/sound/cor_1.wav" type="audio/mpeg">
</audio>
<audio id="goodFinl">
    <source src="../all/sound/win.mp3" type="audio/mpeg">
</audio>
<audio id="error1">
    <source src="../all/sound/error.mp3" type="audio/mpeg">
</audio>

</body>
</html>