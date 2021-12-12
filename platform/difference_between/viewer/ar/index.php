<html>
<head>
    <title>find Difference object</title>
    <link rel="stylesheet" type="text/css" href="css/animate.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" href="css/manhalloader.css"/>
    <link rel="stylesheet" type="text/css" href="css/timer.css"/>
    <script src="https://www.manhal.com/js/scorm.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/manhal.js"></script>
    <script src="js/sound.js"></script>
    <script src="js/tock.js"></script>
    <script src="js/timerN.js"></script>
    <script src="js/manhalLoader.js"></script>
    <script>
        config={};
        config.location = parseURLParams(location.href);
        config.srcLink = "../../../games/" + <?=$_GET["id"];?> + "/js/games.js?v=" + Date.now();
        var stringLink = "<script  type='text/javascript' src='" + config.srcLink + "'><\/script>";
        config.id=<?=$_GET["id"];?>;
            document.write(stringLink);
    </script>
    <script src="js/game.js"></script>
</head>
<body onunload="disconnetLMS();">
<div id="gameConainer" class="main-container">
    <div id="inner-gameContainer">
        <div class="game-container">
            <div class="header-container">
                <span>ابحث عن الفروق بين الصورتين.</span>
            </div>
            <div class="stars-container">

            </div>
            <div class="center-container">
                <div class="image-container imag1">
                    <img class="animated" id="imag1" width="420" height="462" src="../../../games/<?=$_GET["id"];?>/images/left.jpg?v=<?=time()?>" usemap="#map1">

                </div>
                <div class="image-container imag2" style="float: right">
                    <img class="animated" id="imag2" width="420" height="462" src="../../../games/<?=$_GET["id"];?>/images/right.jpg?v=<?=time()?>" usemap="#map2">


                </div>
            </div>
            <div class="footer">
                <div class="title"></div>
                <div class="bee-2"></div>
                <div class="timer-container"></div>
                <a class="sound-btn"><i></i></a>
                <a class="reload-btn" onclick="reset()"><i></i></a>
            </div>
            <a class="powerdBy" href="https://www.manhal.com/"></a>
            <div class="message-main-container-feedBack">
                <div class="message-inner-container-feedBack">
                    <span class="good-text"></span>
                    <a class="reload-btn-message"><i></i></a>
                </div>
            </div>
            <div class="message-main-container-timeOut">
                <div class="message-inner-container-timeOut">
                    <span class="try-again"></span>
                    <a class="reload-btn-message"><i></i></a>
                </div>
            </div>
        </div>

    </div>
</div>
</body>
</html>