<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" type="text/css" href="css/animate.css">
    <link rel="stylesheet" type="text/css" href="css/styleMsg.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/flaticon.css">
    <link rel="stylesheet" type="text/css" href="css/normalize.css">
    <link rel="stylesheet" type="text/css" href="css/hover.css">
    <link rel="stylesheet" type="text/css" href="css/styleMsg.css">
    <link rel="stylesheet" type="text/css" href="css/manhalloader.css">
    <script src="https://www.manhal.com/js/scorm.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/ConfirmMsg.js"></script>
    <script type="text/javascript" src="js/colorPicker.js"></script>
    <script type="text/javascript" src="js/floodFill.js"></script>
    <script type="text/javascript" src="js/index.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="js/html2canvas.js"></script>

    <script type="text/javascript" src="js/ui.js"></script>
    <script type="text/javascript" src="js/udno_redo.js"></script>
    <script src="js/velocity.js"></script>
    <script type="text/javascript" src="js/fastclick.js"></script>
    <script type="text/javascript" src="js/manhalLoader.js"></script>
</head>
<body onunload="disconnetLMS();">

<div class="gameConainer" id="gameConainer">
    <div class="color-container floating-right">
        <div class="arrow"></div>
        <div class="color-item color-1  floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#b22c6d" data-color="#b22c6d"><i class="animated-flip flip"></i></div>
        <div class="color-item color-2  floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#96b2a0" data-color="#96b2a0"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-3  floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#c22e34" data-color="#c22e34"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-4  floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#218d94" data-color="#218d94"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-5  floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#31517d" data-color="#31517d"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-6  floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#24ba66" data-color="#24ba66"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-7  floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#77402c" data-color="#77402c"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-8  floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#ef383f" data-color="#ef383f"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-9  floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#5a55a4" data-color="#5a55a4"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-10 floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#00b1a0" data-color="#00b1a0"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-11 floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#cb9f7a" data-color="#cb9f7a"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-12 floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#947fba" data-color="#947fba"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-13 floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#f47f38" data-color="#f47f38"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-14 floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#ef1e9a" data-color="#ef1e9a"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-15 floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#bad64a" data-color="#bad64a"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-16 floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#93489c" data-color="#93489c"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-17 floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#413d3e" data-color="#413d3e"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-18 floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#fcb833" data-color="#fcb833"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-19 floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#2483a8" data-color="#2483a8"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-20 floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#b16035" data-color="#b16035"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-21 floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#9a921e" data-color="#9a921e"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-22 floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#15a9d3" data-color="#15a9d3"><i class="animated-flip flip" style="display: none"></i></div>
        <div class="color-item color-23 floating-left button-animation-2" onclick="getColorEss(this)" colorChoo="#ffda26" data-color="#ffda26"><i class="animated-flip flip" style="display: none"></i></div>
<!--        <div class="color-item floating-left colorPickerThumnail button-animation-2" onclick="colorPicker()" colorChoo="#2572bb" data-color="#2572bb" style=""></div>-->
    </div>
<!--    <div id="colorPicker" class="translate3dT" onclick="">-->
<!--        <div id="inner-colorPicker">-->
<!--            <div class="background-colorPicker">-->
<!--                <span id="closep" onclick=" $('#colorPicker').hide();"><i></i></span>-->
<!--                <img id="colorPickerType" src="images/black-white.png" onclick="blackAndWhiteColors()"-->
<!--                     style="width: 10%; z-index: 100; position: absolute;right: 3%; cursor: pointer; bottom: 3%;">-->
<!--                <div class="screw-a top-left"></div>-->
<!--                <div class="screw-a bottom-left"></div>-->
<!--                <div class="colorPicker-inner-container">-->
<!--                    <div id="circlePciker"></div>-->
<!--                    <div id="colorPickerCont"></div>-->
<!--                    <canvas id="canvas_picker" width="200" height="200"></canvas>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--        </div>-->
<!--    </div>-->
    <div id="inner-gameConainer">
        <div class="filling-main-container">
            <div class="tools-container floating-left">
                <a class="Pail-colors filing-btn button-animation-2" id="fill_pen" onclick="fillPen(this);fillArea()"><i></i></a>
                <a class="Coloring-Brush filing-btn button-animation-2 selected" id="normal_pen" onclick="normalPen(this);fillArea()"><i></i></a>
                <a class="Magic-brush filing-btn button-animation-2" id="" onclick="magicPen(this);fillArea()"><i></i></a>
                <a class="eraser filing-btn button-animation-2" onclick="DrawMode='erazer';fillArea();selectErazer()"><i></i></a>
                <a class="clear filing-btn button-animation-2" onclick="resizeDW()"><i></i></a>

                <a class="print filing-btn button-animation-2" onclick="printCanvas()"><i></i></a>
                <div class="color-menu button-animation-2" ></div>
            </div>
            <div class="drawing-area floating-right">
                <div class="canvasContainer">
                    <div id="canvasContainer" align="center">
                        <canvas id="canvas1" width="640" height="480"></canvas>
                        <canvas id="canvas" width="640" height="480"></canvas>
                        <canvas id="canvasBackTmpMask" width="640" height="480"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer">
            <a class="undo-redo-btn undo button-animation" onclick="hidePobUpJus(false);cUndo()" style="display: none"><i></i></a>
            <a class="undo-redo-btn redo button-animation" onclick="hidePobUpJus(false);cRedo()" style="display: none"><i></i></a>
            <a class="help-back-icon button-animation"></a>
            <a class="sound-btn-story button-animation" data="0"></a>
            <a class="logo"></a>
        </div>
        <div class="help-main-container">
            <div class="help-inner-container animated fadeInDown">
                <a class="close"></a>
                <span class="help-text"></span>
                <span class="help-title"></span>
                <div class="help-text"></div>
            </div>
        </div>
    </div>
</div>
<script>
    arrayOfImages = ["../../../games/<?=$_GET["id"];?>/images/Coloring_image.png"]
    if ('addEventListener' in document) {
        document.addEventListener('DOMContentLoaded', function () {
            FastClick.attach(document.body);
        }, false);
    }
</script>
</body>
</html>
