<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Matching</title>
    <script src="https://manhal.com/js/scorm.js"></script>
    <link href="../all/css/manhalloader.css" rel="Stylesheet" type="text/css"/>
    <script src="../all/js/jquery.js" type="text/javascript"></script>
    <script  type="text/javascript">
    var config={};

   config.id=<?=$_GET["id"];?>;
config.root="../../../games/" + config.id + "/all"
    config.srcLink = "../../../games/" + config.id + "/all/js/game.js?v=" + Date.now();
    var stringLink = "<script type='text/javascript' src='" + config.srcLink + "'><\/script>"
        document.write(stringLink);
        langStory="en";
    </script>

    <script src="../all/js/manhalLoader.js" type="text/javascript"></script>
    <script type="text/javascript" language="JavaScript" src="../all/js/sound.js"></script>
    <script type="text/javascript" language="JavaScript" src="../all/js/matchingjs_new.js"></script>
    <script type="text/javascript" language="JavaScript" src="../all/js/drawMatching.js"></script>
    <script type="text/javascript" language="JavaScript" src="../all/js/index.js"></script>
    <link href="css/matching.css" rel="Stylesheet" type="text/css"/>
    <link rel="stylesheet" href="../all/css/animate.css"/>
</head>
<body onunload="disconnetLMS();">
<div class="background-play"></div>
<div class='matching-container-horizental' id="matching-content">
    <div class="matching-content" id='gameConainer'>

        <div class="help-main-container">
            <div class="help-content">
                <a class="close button-animation"></a>
                <h1 class="title"></h1>
                <div class="text"></div>
            </div>
        </div>
        <div class="message-main-container" id="message-good">
            <div class="message-content">
                <h1 class="title-1" style="background-image: url(images/good.svg)"></h1>
                <div class="image-a"></div>
                <div class="replay-in-popup button-animation" onclick="questionreset (object_match)"></div>
            </div>
        </div>
        <div class="message-main-container" id="message-faild">
            <div class="message-content-a">
                <h1 class="title-1" style="background-image: url(images/try-agine.svg)"></h1>
                <div class="image-b"></div>
                <div class="replay-in-popup button-animation" onclick="questionreset (object_match)"></div>
            </div>
        </div>
        <a class="play button-animation"></a>
<!--        <div class="game-title animated"></div>-->
<!--        <div class="game-title-image animated"></div>-->
<!--        <span class="powerby-1"></span>-->
        <div class='gameConainer'>
            <div class="headPart">
                <div class="white-container">
                    <div class="textQustion">The letter originates with the word it contains :</div>
                </div>
                <div class="underastand"></div>
            </div>
            <div class="game-main-container">
                <canvas id="canvas1" width="694" height="777" style="width:100%;height:100%;"></canvas>
                <div class='insideDiv'>
                    <div id="column1" class='coloumn1'>
                        <div object_match="object_match" class='coloumn1Element'>
                            <div object_match="object_match" class="element-container">
                                <div class="display-table-row">
                                    <div class="dot-container button-animation">
                                        <div style="cursor:pointer ; " object_match="object_match" activ="true"
                                             attrindex="0" answer="a" name="col1A" id="col10"
                                             class="dot-class colEl1 floating-right object_match-dot"></div>
                                    </div>
                                    <div dot="col10" class="floating-right main-image  infinite"
                                         style="background: url(images/1.svg);background-repeat: no-repeat;background-size:100% 100%"></div>
                                </div>
                            </div>
                            <div object_match="object_match" class="element-container">
                                <div class="display-table-row">
                                    <div class="dot-container button-animation">
                                        <div style="cursor:pointer ; " object_match="object_match" activ="true"
                                             attrindex="2" answer="a" name="col1A" id="col12"
                                             class="dot-class colEl1 floating-right object_match-dot"></div>
                                    </div>
                                    <div dot="col12" class="floating-right main-image  infinite"
                                         style="background: url(images/3.svg);background-repeat: no-repeat;background-size:100% 100%"></div>
                                </div>
                            </div>
                            <div object_match="object_match" class="element-container">
                                <div class="display-table-row">
                                    <div class="dot-container button-animation">
                                        <div style="cursor:pointer;" object_match="object_match" activ="true"
                                             attrindex="1" answer="a" name="col1A" id="col11"
                                             class="dot-class colEl1 floating-right object_match-dot"></div>
                                    </div>
                                    <div dot="col11" class="floating-right main-image  infinite"
                                         style="background: url(images/2.svg);background-repeat: no-repeat;background-size: 100% 100%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div object_match="object_match" class='coloumn2'>
                        <div class='coloumn2Element object_match-coloumn2Element'>
                            <div class="element-container">
                                <div class="display-table-row">
                                    <div dot="col20" id="image_A" class="main-image"
                                         style=" background: url(images/A1.svg);background-repeat: no-repeat;background-size:100% 100%; ">

                                    </div>
                                    <div class="dot-container-b">
                                        <div attrindex="0" answer="a" name="col1A" id="col20"
                                             class="dot-class colEl2"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="element-container">
                                <div class="display-table-row">
                                    <div dot="col21" id="image_B" class="main-image"
                                         style="background: url(images/B1.svg);background-repeat: no-repeat;background-size:100% 100%; ">

                                    </div>
                                    <div class="dot-container-b">
                                        <div attrindex="1" answer="b " name="col1A" id="col21"
                                             class="dot-class colEl2 "></div>
                                    </div>
                                </div>
                            </div>
                            <div class="element-container">
                                <div class="display-table-row">
                                    <div dot="col22" id="image_C" class="main-image"
                                         style="background: url(images/C1.svg);background-repeat: no-repeat;background-size: 100% 100%">

                                    </div>
                                    <div class="dot-container-b">
                                        <div attrindex="2" answer="c " name="col1A" id="col22"
                                             class="dot-class colEl2"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a class="help-button button-animation"></a>
    <div class="footer">
        <div class="button-container">
            <input style="display: block" class="buttons button-animation" type="button" value="" onclick="checkAnswer(object_match)">
        </div>
        <a class="powerby"></a>
    </div>
</div>
<script  type="text/javascript">
    directionOrientation=game[0].oriPage
    if(directionOrientation=="verticle"){
        $("#matching-content").addClass("matching-container-vertical").removeClass("matching-container-horizental")

    }else{
        $("#matching-content").addClass("matching-container-horizental").removeClass("matching-container-vertical")

    }
</script>
</body>
</html>