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

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/ConfirmMsg.js"></script>
    <script type="text/javascript" src="js/colorPicker.js"></script>
    <script type="text/javascript" src="js/floodFill.js"></script>
    <script type="text/javascript" src="js/index.js?random=<?php echo uniqid(); ?>"></script>
    <script type="text/javascript" src="js/ui.js"></script>
    <script type="text/javascript" src="js/udno_redo.js"></script>
    <script src="js/velocity.js"></script>
    <script type="text/javascript" src="js/fastclick.js"></script>
    <script type="text/javascript" src="js/manhalLoader.js"></script>


</head>
<body>

<div class="gameConainer" id="gameConainer">
    <div id="colorPicker" class="translate3dT" onclick="">
        <div id="inner-colorPicker">
            <div class="background-colorPicker">
                <span id="closep" onclick=" $('#colorPicker').hide();"><i></i></span>
                <img id="colorPickerType" src="images/black-white.png" onclick="blackAndWhiteColors()"
                     style="width: 10%; z-index: 100; position: absolute;right: 3%; cursor: pointer; bottom: 3%;">
                <div class="screw-a top-left"></div>
                <div class="screw-a bottom-left"></div>
                <div class="colorPicker-inner-container">
                    <div id="circlePciker"></div>
                    <div id="colorPickerCont"></div>
                    <canvas id="canvas_picker" width="200" height="200"></canvas>
                </div>
            </div>

        </div>
    </div>
    <div id="inner-gameConainer">
        <div class="filling-main-container">
            <div class="tools-container floating-left">
                <a class="Pail-colors filing-btn button-animation-2" id="fill_pen" onclick="fillPen(this);fillArea()"><i></i></a>
                <a class="Coloring-Brush filing-btn selected button-animation-2" id="normal_pen" onclick="normalPen(this);fillArea()"><i></i></a>
                <a class="Magic-brush filing-btn button-animation-2" id="" onclick="magicPen(this);fillArea()"><i></i></a>
                <a class="eraser filing-btn button-animation-2" onclick="DrawMode='erazer';fillArea();selectErazer()"><i></i></a>
                <a class="clear filing-btn button-animation-2" onclick="resizeDW()"><i></i></a>

                <a class="print filing-btn button-animation-2" onclick="printCanvas()"><i></i></a>
            </div>
            <div class="color-container floating-right">
                <div class="color-item floating-left button-animation-2" onclick="getColorEss(this)" style="background-color: #d20012" colorChoo="#d20012" data-color="#d20012"><i class="animated-flip flip"></i></div>
                <div class="color-item floating-left button-animation-2" onclick="getColorEss(this)" style="background-color: #ef5a23" colorChoo="#ef5a23" data-color="#ef5a23"><i class="animated-flip flip" style="display: none"></i></div>
                <div class="color-item floating-left button-animation-2" onclick="getColorEss(this)" style="background-color: #f8d000" colorChoo="#f8d000" data-color="#f8d000"><i class="animated-flip flip" style="display: none"></i></div>
                <div class="color-item floating-left button-animation-2" onclick="getColorEss(this)" style="background-color: #85b800" colorChoo="#85b800" data-color="#85b800"><i class="animated-flip flip" style="display: none"></i></div>
                <div class="color-item floating-left button-animation-2" onclick="getColorEss(this)" style="background-color: #29abe1" colorChoo="#29abe1" data-color="#29abe1"><i class="animated-flip flip" style="display: none"></i></div>
                <div class="color-item floating-left button-animation-2" onclick="getColorEss(this)" style="background-color: #92278f" colorChoo="#92278f" data-color="#92278f"><i class="animated-flip flip" style="display: none"></i></div>
                <div class="color-item floating-left button-animation-2" onclick="getColorEss(this)" style="background-color: #b8004b" colorChoo="#b8004b" data-color="#b8004b"><i class="animated-flip flip" style="display: none"></i></div>
                <!--<div class="color-item floating-left" onclick="getColorEss(this)" colorChoo="#3277b5" data-color="#3277b5"></div>-->

                <div class="color-item floating-left colorPickerThumnail button-animation-2" onclick="colorPicker()" colorChoo="#2572bb" data-color="#2572bb" style=""></div>
            </div>

            <div class="drawing-area floating-right">

                <div class="canvasContainer">
                    <div id="colorpickerNew"></div>
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
    arrayOfImages = ["../../games/<?=$_GET["id"];?>/images/Coloring_image.png"]
    if ('addEventListener' in document) {
        document.addEventListener('DOMContentLoaded', function () {
            FastClick.attach(document.body);
        }, false);
    }

</script>

</body>
</html>