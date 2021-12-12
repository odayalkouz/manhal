<html>
<header>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <meta charset="UTF-8">
    <link href="css/shapes.css" rel="stylesheet" type="text/css">
    <link href="css/animate.css" rel="stylesheet" type="text/css">
    <link href="css/hover.css" rel="stylesheet" type="text/css">
    <link href="../all/css/manhalloader.css" rel="stylesheet" type="text/css">
    <script src="https://manhal.com/js/scorm.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="../all/js/touchpunch.js"></script>
    <script type="text/javascript" src="../all/js/iBounce.js"></script>

    <script type="text/javascript" >
        config={};
        //config.location = parseURLParams(location.href);
        config.id=<?=$_GET["id"];?>;
        config.srcLink = "../../../games/" + config.id + "/all/js/game.js?v=" + Date.now();
        var stringLink = "<script type='text/javascript' src='" + config.srcLink + "'><\/script>"
        document.write(stringLink);

        langStory="ar"
    </script>

    <script type="text/javascript" src="../all/js/jquery.keyboard.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="../all/js/arabic.min.js?random=<?php echo uniqid(); ?>"></script>

    <script src="../all/js/matching.js?random=<?php echo uniqid(); ?>" type="text/javascript"></script>

    <script src="../all/js/lottie.js?random=<?php echo uniqid(); ?>" type="text/javascript"></script>
    <script type="text/javascript" src="../all/js/manhalLoader.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="../all/js/circleAnimate.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="../all/js/dragDrop.js?random=<?php echo uniqid(); ?>"></script>

    <script type="text/javascript" src="../all/js/index.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="../all/js/getType.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="../all/js/scorm.js?random=<?php echo uniqid(); ?>"></script>

</header>
<title>Find Object</title>
<body onunload="disconnetLMS();">
<div class="loader"></div>
<div id="help-main-container" class="help-main-container" style="display: none">
    <div id="help-inner-container">
        <div class="help-inner-container" style="display: none">
            <div class="text-container">
                <h1>عزيزي الطالب</h1>
                <p>اقرأ السؤال ثم انظر إلى الصورة واضغط على مكان الإجابة الصحيحة</p>
            </div>
            <a class="play-btn"><i></i></a>
        </div>
        <div class="boy" style="display: none"></div>
        <div class="char-help" style="display: none"></div>
        <div class="logo"></div>
    </div>

</div>
<div id="gameContainer" class="gameContainer">
    <div class="headerGame">
        <div class="question-icon"></div>
        <div class="titleContainer marquee">
            <span class="titleText resizeText"></span>
            <!--<img class="textIcon">-->
        </div>
    </div>
    <div class="gameContentContainer">
        <div id="gameContent" class="gameContent"></div>
        <a class="poweredBy" href="https://www.manhal.com"></a>
    </div>
    <div class="inner-footer-right floating-right"></div>

    <div class="fotterGame">
        <div class="inner-footer">
            <div class="head-img"></div>
            <div class="inner-footer-left floating-left">
                <!--<img id="hear" onclick="listen()" src="images/ear_button.png">-->
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
                <div class="separator floating-right" style="left: 0; right: auto"></div>
                <a class="floating-right" id="help" onclick="helpQustion()" style="display: none"><i></i></a>
                <div class="MuteCont floating-right"><i class="muteIcon textIcon"></i></div>
                <div class="separator floating-right"></div>
            </div>

        </div>
    </div>
</div>
</body>
</html>