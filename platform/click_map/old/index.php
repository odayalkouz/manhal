<?php
session_start();
/*
 * Created by Dar Almanhal - Hussam Abu Khadijeh .
 * User: Hussam Abu Khadijeh
 * Date: 18/12/2016
 * Time: 3:30 AM
 */
include_once "../config.php";
include_once "../includes/function.php";

$sql = "SELECT * FROM `editors` WHERE `editors`.`gameid`=".$_GET["id"];

$result = $con->query($sql);
if(mysqli_num_rows($result)<1){
    exit("Incorrect game id");
}
$row=mysqli_fetch_assoc($result);
if(!canEditGame($row)){
    exit("You don not have permesiion to edit this game");
}

if(!is_file("../games/".$_GET["id"]."/index.html")){
    copyDirectory("temp","../games/".$_GET["id"]);
}

?>
<html>
<body>
<script>
    UserId=<?=$row["userid"];?>;
    GameID=<?=$_GET["id"];?>;
    rootPath="../games/<?=$_GET["id"];?>/";
</script>
<header>
    <link href="css/shapes.css" rel="stylesheet" type="text/css">
    <link href="css/jquerycss.css" rel="stylesheet" type="text/css">
    <link href="css/manhalloader.css" rel="stylesheet" type="text/css">
    <link href="css/animate.css" rel="stylesheet" type="text/css">
    <link href="css/hover.css" rel="stylesheet" type="text/css">

    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/manhalLoader.js"></script>
    <script type="text/javascript" src="js/shapes.js"></script>
    <script type="text/javascript" src="js/library.js"></script>
    <script type="text/javascript" src="js/upload.js"></script>

    <script type="text/javascript" src="js/ajax.js"></script>
    <link rel="stylesheet" href="css/reset.css" />
    <link rel="stylesheet" href="css/audioplayer.css" />

    <script src="js/audioplayer.js"></script>
    <script>
        (function(doc){var addEvent='addEventListener',type='gesturestart',qsa='querySelectorAll',scales=[1,1],meta=qsa in doc?doc[qsa]('meta[name=viewport]'):[];function fix(){meta.content='width=device-width,minimum-scale='+scales[0]+',maximum-scale='+scales[1];doc.removeEventListener(type,fix,true);}if((meta=meta[meta.length-1])&&addEvent in doc){fix();scales=[.25,1.6];doc[addEvent](type,fix,true);}}(document));
    </script>
    <script type="text/javascript" src="js/editorUI.js"></script>
</header>

<title>Find Object</title>
<div class="ContainerEditor">
    <div class="headerEditor">
        <span class="title-editor floating-left"></span>
        <div class="top-tools-container floating-right">
            <a class="setting floating-left" onclick="showSetting()" title="Setting"><i></i></a>
            <div class="separator floating-left"></div>
            <a class="save floating-left" onclick="saveData()" title="Save"><i></i></a>
            <div class="separator floating-left"></div>
            <a class="preview floating-left" onclick="previewGame()" title="Preview"><i></i></a>
        </div>
    </div>
    <div class="setting-popup">
        <div class="header-popup">
            <i class="floating-left"></i>
            <label class="floating-left">Properties</label>
        </div>
        <div class="tools-container">
            <div class="line-row opacity">
                <div class="icon-tools floating-left"></div>
                <div class="toolsContainer floating-left">
                    <input class="floating-left" type="range" id="opacityObject" min=".1" max="1" step=".1"  onchange="onOpacityChange(this)" oninput="onOpacityChange(this)">
                    <div class="rang-number floating-left"><span>35%</span></div>
                </div>
            </div>
<!--            <div class="line-row flipObject">-->
<!--                <div class="icon-tools floating-left"></div>-->
<!--                <div class="toolsContainer floating-left">-->
<!--                    -->
<!--                    <a class="btn flip-object-Vertical floating-left"><i></i></a>-->
<!--                </div>-->
<!--            </div>-->
            <div class="line-row front-back">
                <div class="icon-tools floating-left"></div>
                <div class="toolsContainer floating-left">
                    <div class="btn-container"><a class="btn bringTo-front floating-left" onclick="BringToFront()" title="Bring To Front"><i></i></a><label class="floating-left">Bring To Front</label></div>
                    <div class="btn-container"><a class="btn bringTo-forward floating-left" onclick="BringForward()" title="Bring Forward"><i></i></a><label class="floating-left">Bring Forward</label></div>
                    <div class="btn-container"><a class="btn sendTo-back floating-left" onclick="SendToBack()" title="Send To Back"><i></i></a><label class="floating-left">Send To Back</label></div>
                    <div class="btn-container"><a class="btn send-backward floating-left" onclick="SendBackward()" title="Send Backward"><i></i></a><label class="floating-left">Send Backward</label></div>
                    <div class="btn-container"><a class="btn flip-object-horizontal floating-left" onclick="flipObject()" title="Flip Object"><i></i></a><label class="floating-left">Flip Object</label></div>
                </div>
            </div>
            <div class="setting-popup-footer">
                <a class="btn dub" onclick="copyObject()" title="Duplicate"><i></i></a>
                <a class="btn remove" onclick="removeFile(this)" title="Remove"><i></i></a>
                <a class="btn setting" onclick="showProprties()" title="Point Setting"><i></i></a>
            </div>
<!--            <input type="checkbox" onclick="NoSound()" id="NoSound" name="NoSound" value="sound"> No sound<br>-->
<!--            <input type="checkbox" onclick="NoHelp()"  id="NoHelp" name="NoHelp" value="help" checked> No help<br>-->

        </div>
    </div>
    <div class="work-area">
        <div class="leftPanelTools">
            <div class="tools-header">
                <span>Tools</span>
            </div>
            <div class="dash-top"></div>
            <a title="Add qustion title to game ." class="btn add-title" onclick="addtitle()"><i></i></a>
            <a title="Change background image."class="btn background-image" onclick="bgEditBackground()"><i></i></a>
            <a title="Upload new object from your pc." class="btn upload-image" onclick="simulateUpload($('#uploadImageObject'))"><i></i></a>
            <a title="Add empty area object." class="btn add-area" onclick="addTransparentLayer()"><i></i></a>
            <a title="Add object from Almanhal library." class="btn library" onclick="createThumbs()"><i></i></a>
        </div>
        <div id="gameContainer" class="gameContainer" >
            <div class="gameContent" >
            </div>
        </div>
        <span class="logo clear floating-right"></span>
    </div>

<div class="inputContainer">


    <input type="file" class="inputHide" id="uploadBackground" UploadType="uploadBackground" onchange="UploadType='uploadBackground';getImageLocal(this)" name="upload" accept="image/*">
    <input type="file" class="inputHide" id="uploadImageObject" UploadType="uploadImageObject"onchange="UploadType='uploadImageObject';getImageLocal(this)" name="upload" accept="image/*">
    <input type="file" class="inputHide" id="uploadIconTitle" UploadType="uploadIconTitle" onchange="UploadType='uploadIconTitle';getImageLocal(this)" name="upload" accept="image/*">
    <input type="file" class="inputHide" id="uploadBackgroundSound" UploadType="BackgroundSound" onchange="UploadType='BackgroundSound';getImageLocal(this)" name="upload" accept="audio/*">
    <input type="file" class="inputHide" id="uploadsoundObject" UploadType="uploadsoundObject"onchange="UploadType='uploadsoundObject';getImageLocal(this)" name="upload" accept="audio/*">
</div>
</div>
</body>
</html>