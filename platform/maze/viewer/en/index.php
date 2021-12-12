<html>
<head>
    <title>find Difference object</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <link rel="stylesheet" type="text/css" href="css/animate.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <link rel="stylesheet" type="text/css" href="css/manhalloader.css"/>
    <script src="https://www.manhal.com/js/scorm.js"></script>
    <script src="js/jquery.js"></script>
    <script src="js/manhal.js"></script>
    <script src="js/sound.js"></script>
    <script src="js/tock.js"></script>
    <script src="js/manhalLoader.js"></script>
    <link rel="stylesheet" href="css/Maze.css">

    <script>
        config={};
        config.location = parseURLParams(location.href);
        config.srcLink = "../../../games/" + <?=$_GET["id"];?> + "/js/games.js?v=" + Date.now();
        config.id=<?=$_GET["id"];?>;
        var stringLink = "<script type='text/javascript' src='" + config.srcLink + "'><\/script>";
        document.write(stringLink);

    </script>

    <script src="js/Maze.js"></script>
</head>
<body onunload="disconnetLMS();">
<div id="gameConainer" class="main-container">
    <div id="inner-gameContainer">
        <div class="headerGame">
<!--            <div class="question-icon"></div>-->
            <div class="titleContainer">
                <span class="titleText resizeText"></span>
            </div>
        </div>
        <div class="game-container">
            <div class="canvas-container">
                <canvas style="width: 100%;height: 100%" id="canvas"></canvas>
            </div>
            <img id="face" src="../../../games/<?=$_GET["id"];?>/images/face.png?v=<?=time()?>">
            <img id="finished" src="images/star.png" value="100">
            <div class="arrow-container">
                <a class="top" onclick="javascript:dy = -1;"></a>
                <a class="bottom" onclick="javascript:dy = 1;"></a>
                <a class="left" onclick="javascript:dx = -1;"></a>
                <a class="right" onclick="javascript:dx = 1;"></a>
            </div>
        </div>
        <a class="powerdBy" href="https://www.manhal.com/"></a>
        <div class="main-message-container">
            <div class="inner-message-container">
                <span id="message-icone" class=""></span>
                <span id="feedback" class=""></span>
                <span class="result-text"></span>
                <div class="result-container">
                    <span></span>
                </div>
                <a class="reload" onclick="replyGame()"></a>
            </div>
        </div>
    </div>
</div>
</body>
</html>
