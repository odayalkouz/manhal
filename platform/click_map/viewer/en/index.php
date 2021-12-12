<?php
header("Access-Control-Allow-Origin: *");
?>

<html>
<header>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta charset="UTF-8">
    <link href="css/manhalloader.css?random=<?php echo uniqid(); ?>" rel="stylesheet" type="text/css">
    <link href="css/shapes.css" rel="stylesheet" type="text/css">
    <link href="css/animate.css" rel="stylesheet" type="text/css">
<!--    <link href="css/hover.css" rel="stylesheet" type="text/css">-->
    <link href="../all/css/jquerycss.css" rel="stylesheet" type="text/css">
    <link href="../all/css/keyboard.css" rel="stylesheet" type="text/css">

    <script src="https://manhal.com/js/scorm.js?random=<?php echo uniqid(); ?>"></script>


    <script type="text/javascript" src="../all/js/jquery.js"></script>

<!--    <script-->
<!--            src="../all/js/jquery-ui.js"-->
<!--            integrity="sha256-tXuytmakTtXe6NCDgoePBXiKe1gB+VA3xRvyBs/sq94="-->
<!--            crossorigin="anonymous"></script>-->
    <script
            src="../all/js/jquery-ui.js"
            crossorigin="anonymous"></script>
    <script type="text/javascript" src="../all/js/jquery.keyboard.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="../all/js/arabic.min.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="../all/js/jquery.keyboard.extension-all.min.js"></script>

    <script type="text/javascript" src="../all/js/touchpunch.js"></script>
    <script type="text/javascript" src="../all/js/iBounce.js"></script>

    <script type="text/javascript" >
        config={};
        //config.location = parseURLParams(location.href);
        config.id=<?=$_GET["id"]?>;
        config.srcLink = "../../../games/" + <?=$_GET["id"];?> + "/all/js/game.js?v=" + Date.now();
        var stringLink = "<script type='text/javascript' src='" + config.srcLink + "'><\/script>";
        document.write(stringLink);

        langStory="";
        setTimeout(function () {
            langStory=game[0].langauge;
            console.log(langStory);
        },500);
    </script>



    <script src="../all/js/matching.js?random=<?php echo uniqid(); ?>" type="text/javascript"></script>
    <script src="../all/js/lottie.js?random=<?php echo uniqid(); ?>" type="text/javascript"></script>
    <script type="text/javascript" src="../all/js/manhalLoader.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="../all/js/circleAnimate.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="../all/js/dragDrop.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="../all/js/index.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="../all/js/getType.js?random=<?php echo uniqid(); ?>"></script>
<!--    <script type="text/javascript" src="../all/js/scorm.js?random=--><?php //echo uniqid(); ?><!--"></script>-->

</header>
<title>Find Object</title>
<body onunload="disconnetLMS();">
<div class="loader"></div>
<div id="help-main-container" class="help-main-container" style="display: none">
    <div id="help-inner-container">
        <div class="help-inner-container" style="display: none">
            <div class="text-container">
                <h1>Dear student</h1>
                <p>Read the question then look to the picture and click on the correct answer.</p>
            </div>
            <a class="play-btn"><i></i></a>
        </div>
        <div class="boy" style="display: none"></div>
        <div class="char-help" style="display: none"></div>
        <div class="logo"></div>
    </div>

</div>
<div id="gameContainer" class="gameContainer">
    <div class="play-container">
        <a class="play-bt"></a>
    </div>
    <div class="headerGame">
        <div class="question-icon"></div>
        <div class="titleContainer marquee">
            <span class="titleText resizeText"></span>
            <!--<img class="textIcon">-->
        </div>
    </div>
    <div class="gameContentContainer">
        <div id="gameContent" class="gameContent"></div>
        <div class="trueImage animated shake"><img src="../all/images/correct/correct.png"></div>
        <a class="poweredBy" href="https://www.manhal.com"></a>
    </div>
    <div class="inner-footer-right floating-right"></div>

    <div class="fotterGame">
        <div class="inner-footer">
            <div class="head-img"></div>
            <div class="inner-footer-left floating-left">
                <!--<img id="hear" onclick="liSendBackward()sten()" src="images/ear_button.png">-->
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
                <div class="separator floating-right" style="right: 0; left: auto"></div>
                <a class="floating-right" id="help" onclick="helpQustion()" style="display: none"><i></i></a>
                <div class="MuteCont floating-right"><i class="muteIcon textIcon"></i></div>
                <div class="play-again"></div>
                <div class="separator floating-right"></div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
