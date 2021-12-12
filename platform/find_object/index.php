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
    <link href="css/animate.css" rel="stylesheet" type="text/css">
    <link href="css/hover.css" rel="stylesheet" type="text/css">



    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/shapes.js"></script>
    <script type="text/javascript" src="js/library.js"></script>
    <script type="text/javascript" src="js/upload.js"></script>
    <script type="text/javascript" src="js/editorUI.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>


</header>

<title>Find Object</title>
<a id="userID"></a>
<a id="gameID"></a>
<a id="root"></a>
<button type="button" onclick="createThumbs()">library</button>
<button type="button" onclick="addTransparentLayer()">layer</button>
<!--<button type="button" onclick="simulateUpload($('#uploadBackground'))">background</button>-->
<button type="button" onclick="simulateUpload($('#uploadImageObject'))">uploadImageObject</button>
<!--<button type="button" onclick="simulateUpload($('#uploadBackgroundSound'))">uploadBackgroundSound</button>-->
<!--<button type="button" onclick="simulateUpload($('#uploadsoundObject'))">uploadsoundObject</button>-->
<!--<button type="button" onclick="AddText()">Text</button>-->
<button type="button" onclick="showSetting()">setting</button>
<button type="button" onclick="saveData()">Save</button>
<button type="button" onclick="previewGame()">preview</button>
<button type="button" onclick="BringToFront()">Bring To Front</button>
<button type="button" onclick="SendToBack()">Send To Back</button>
<button type="button" onclick="BringForward()">Bring Forward</button>
<button type="button" onclick="SendBackward()">Send backward</button>
<button type="button" onclick="flipObject()">flip</button>
<button type="button" onclick="copyObject()">dub</button>

opacity<input type="range" id="opacityObject" min=".1" max="1" step=".1"  onchange="onOpacityChange(this)" oninput="onOpacityChange(this)">
<div id="gameContainer" class="gameContainer" >

<div class="gameContent" >


</div>

</div>

<div class="inputContainer">


    <input type="file" class="inputHide" id="uploadBackground" UploadType="uploadBackground" onchange="UploadType='uploadBackground';getImageLocal(this)" name="upload" accept="image/*">
    <input type="file" class="inputHide" id="uploadImageObject" UploadType="uploadImageObject"onchange="UploadType='uploadImageObject';getImageLocal(this)" name="upload" accept="image/*">
    <input type="file" class="inputHide" id="uploadBackgroundSound" UploadType="BackgroundSound" onchange="UploadType='BackgroundSound';getImageLocal(this)" name="upload" accept="audio/*">
    <input type="file" class="inputHide" id="uploadsoundObject" UploadType="uploadsoundObject"onchange="UploadType='uploadsoundObject';getImageLocal(this)" name="upload" accept="audio/*">
</div>
</body>
</html>