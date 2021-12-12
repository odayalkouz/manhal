<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel='stylesheet prefetch' href='../all/css/jquery-ui.css'>
    <link rel='stylesheet prefetch' href='../all/css/manhalloader.css'>
    <link rel='stylesheet prefetch' href='../all/css/animate.css'>
    <script src="https://manhal.com/js/scorm.js"></script>
    <script src="../all/js/js.js"></script>
    <script src='../all/js/jquery.min.js'></script>
    <script src='../all/js/jquery-ui.min.js'></script>
    <script src='../all/js/jquery.ui.touch-punch.min.js'></script>
    <script src="../all/js/sound.js"></script>
    <script src="../all/js/manhalLoader.js"></script>
    <link rel='stylesheet prefetch' href='../all/css/swiper.min.css'>

    <script>
        config={};
        config.location = parseURLParams(location.href);
        config.path="../../../games/" + <?=$_GET["id"];?>+"/"
        config.srcLink = "../../../games/" + <?=$_GET["id"];?> + "/all/js/game.js?v=" + Date.now();
        var stringLink = "<script type='text/javascript' src='" + config.srcLink + "'><\/script>";
        stringLink +="<link rel='stylesheet' href='css/style.css'>";
        document.write(stringLink);
        langStory="en";
        <?php
        $helptitle="";
        $helpText="";
        $gameTitl="";
        $wellDone="";

                    $gameTitl="Fill in the blank";
                    $helptitle="Instructions";
                    $helpText="Read the text and put the cards in the right place.";
                    $wellDone="Well Done";

        ?>
        $(document).ready(function () {
            $('body').manhalLoader({
                splashID: "#jSplash",
                splashVPos: '50%',
                loaderVPos: '50%',
                addFiles: [],
                splashFunction: function () {
                    //passing Splash Screen script to jPreLoader
//                    resizeGame();
                    $('<div class="loder-bg">').appendTo('#manhalpreOverlay');
                },
                onLoading: function (per) {
                },
            }, function () {
            });
            $(".button-animation").mouseover(function ()
            {
                $(this).removeClass("rotateIn");
                $(this).addClass("animated tada");
            });
            $(".button-animation").mouseleave(function ()
            {
                $(this).removeClass("animated tada");
                $(this).removeClass("rotateIn");
            });
            $(".play").click(function ()
            {
//                BackgroundSound("../all/sound/bgMusic.mp3")
//
//                var quastion_sounds= new manhalsound('../../../games/<?//=$_GET["id"];?>// /all/sound/exercise_title.mp3', false);
//                quastion_sounds.Play();
//                $(".play").fadeOut("fast");
//                $("#manhalpreOverlay").fadeOut();
//                $(".green-title-bg").fadeOut("fast");
//                $(".green-title-bg .title-white").fadeOut("fast");
//                $(".plane").fadeOut("fast");
//                $(".smal-1,.smal-2,.smal-3,.smal-4,.smal-5").fadeOut("fast");
//                $(".big-1,.big-2,.big-3,.big-4,.big-5").fadeOut("fast");
//                $(".test").fadeIn();

            });
            resizeGame();
            $(window).resize(function ()
            {
                resizeGame();
            });
        });
    </script>
    <script src="../all/js/index.js"></script>
</head>
<body onunload="disconnetLMS();">
<section class="drag-drop-quiz gameContainer" id="gameContainer">
    <div class="quiz-wrapper" id="innerGame">
        <a class="play button-animation"></a>
        <div class="help-container-popup">
            <div class="help-content">
                <a class="close"></a>
                <div class="title"><?php echo $helptitle ;?></div>
                <div class="desc"><?php echo $helpText ;?></div>
            </div>
        </div>
        <div class="win-container-popup">
            <div class="win-content">
                <div class="title"><?php echo $wellDone ;?></div>
                <a onclick="javascript:Funreload();" class="replay"></a>
            </div>
        </div>
        <div class="view-img-container-popup">
            <div class="view-container">
                <a class="close"></a>
                <img src="">
            </div>
        </div>
        <div class="green-title-bg">
            <div class="title-white"></div>
        </div>
        <div class="plane"></div>
        <div class="smal-1 animated slideInRight"></div>
        <div class="smal-2 animated slideInDown"></div>
        <div class="smal-3 animated fadeIn"></div>
        <div class="smal-4 animated slideInLeft"></div>
        <div class="smal-5 animated slideInRight"></div>
        <div class="big-1 animated fadeIn"></div>
        <div class="big-2 animated fadeIn"></div>
        <div class="big-3 animated fadeIn"></div>
        <div class="big-4 animated fadeIn"></div>
        <header>
            <div class="white-container">
                <div id="tiotle_question" class="text subTitle">أكون جملاً مما يلي:</div>
            </div>
            <div class="underastand"></div>
        </header>
        <div class="content-main-game">
            <div class="options-main-container">
                <ul id="question" class="options floating-right"></ul>
            </div>
            <div class="answers floating-right swiper-container">
                <ol id="all_question" class="swiper-wrapper"></ol>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>
        </div>
        <footer>
            <div class="left-container"></div>
            <div class="center-container"><div id="wrong">0</div>
            <div class="close"></div>
            </div>
            <div class="right-container">
                <a class="help"></a>
                <a  class="sound-mute"></a>
            </div>
        </footer>
    </div>
</section>
<script src="../all/js/swiper.min.js"></script>
<script>
    $(document).ready(function () {
        myswiper = new Swiper('.swiper-container', {
        pagination: '.swiper-pagination',
        paginationClickable: true,
        nextButton: '.swiper-button-next',
        prevButton: '.swiper-button-prev',
        spaceBetween: 30
    });
    });
</script>
</body>
</html>
