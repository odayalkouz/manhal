<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html>
     <meta content="fa">

    <title>label exrcise - Dar Almanhal</title>
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="css/timer.css"/>
    <link rel="stylesheet" type="text/css" href="css/msg.css"/>
    <link rel="stylesheet" type="text/css" href="css/manhalloader.css"/>
    <link rel="stylesheet" type="text/css" href="css/swiper.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/animate.css"/>
    <script src="js/jquery-1.11.2.min.js"></script>
    <script src="js/jquery-ui.min.js"></script>
    <script src="js/timerN.js"></script>
    <script src="js/msg.js"></script>
    <script type="text/javascript" src="js/js.js"></script>
    <script>
        config={};
        config.location = parseURLParams(location.href)

        config.srcLink = "../../games/" + <?=$_GET["id"];?> + "/js/game.js?v=" + Date.now()
        var stringLink = "<script type='text/javascript' src='" + config.srcLink + "'><\/script>"
        document.write(stringLink);


    </script>
    <script type="text/javascript" src="js/manhalLoader.js"></script>
    <script type="text/javascript" src="js/timerN.js"></script>
    <script type="text/javascript" src="js/swiper.js"></script>
    <script type="text/javascript" src="js/scorm.js"></script>
</head>
<body>
<div class="main-container" id="main-container">
    <div class="inner-container" id="inner-container">
        <div class="instructions-container">
            <div class="instructions-main">
                <div class="game-logo animated infinite pulse"></div>
                <div class="instructions-text-container" style="display: none">
                    <div class="instructions-text-container-box">
                        <div class="instrucions-text"></div>
                        <a class="play-btn animated"><i></i></a>
                    </div>
                </div>
            </div>
            <span class="powerBy floating-left"></span>
        </div>
        <div class="game-container">
            <div class="main-container-games" id="main-container-games">
                <div class="header-container">
                    <div class="logo-ques floating-left"></div>
                    <label class="floating-left">How are the balloons of each pair different?</label>
                </div>
                <div class="work-area">
                    <div id="level-container" class="level-container animated"></div>
                </div>
            </div>
            <div class="footer-container">
                <div class="left-footer floating-left">
                    <div class="top"></div>
                    <div class="continer">
                        <div class="inner">
                            <a class="btn helpe floating-left animated" onclick="showHwlp()"><i></i></a>
                            <a class="btn sound muteIcon floating-left animated"><img
                                    src="images/sound-on.svg"></img></a>
                        </div>
                    </div>
                </div>
                <div class="center-footer floating-left">
                    <div class="inner">
                        <div class="slider-container slidesLabel">
                        </div>
                    </div>
                </div>
                <div class="right-footer floating-left">
                    <div class="top"></div>
                    <div class="continer">
                        <div class="inner">
                            <div class="state correct floating-left"><span>0</span></div>
                            <div class="state wrong floating-left"><span>0</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>