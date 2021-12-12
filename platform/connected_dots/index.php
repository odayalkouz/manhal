<?php
session_start();
/*
 * Created by Dar Almanhal - Hussam Abu Khadijeh .
 * User: Hussam Abu Khadijeh
 * Date: 21/12/2016
 * Time: 8:47 AM
 */
include_once "../config.php";
include_once "../includes/function.php";

$sql = "SELECT * FROM `editors` WHERE `editors`.`gameid`=" . $_GET["id"];

$result = $con->query($sql);
if (mysqli_num_rows($result) < 1) {
    exit("Incorrect game id");
}
$row = mysqli_fetch_assoc($result);
if (!canEditGame($row)) {
    exit("You don not have permesiion to edit this game");
}

if (!is_dir("../games/" . $_GET["id"])) {
    @mkdir("../games/" . $_GET["id"]);
}
if (!is_dir("../games/" . $_GET["id"] . "/all")) {
    copyDirectory("temp", "../games/" . $_GET["id"]);
}

?>
<html>
<body>
<script>
    UserId =<?=$row["userid"];?>;
    GameID =<?=$_GET["id"];?>;
    rootPath = "../games/<?=$_GET["id"];?>/";
    langStory="<?=$row["language"];?>".toLowerCase()

</script>
<head>

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link href="css/shapes.css" rel="stylesheet" type="text/css">
    <link href="css/jquerycss.css" rel="stylesheet" type="text/css">
    <link href="css/animate.css" rel="stylesheet" type="text/css">
    <link href="css/hover.css" rel="stylesheet" type="text/css">
    <link href="css/manhalloader.css" rel="stylesheet" type="text/css">
    <link href="css/lobibox.css" rel="stylesheet" type="text/css">


    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/manhalLoader.js"></script>
    <script type="text/javascript" src="js/index.js"></script>
    <script type="text/javascript" src="js/upload.js"></script>
    <script type="text/javascript" src="js/editorUI.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript" src="js/colorPicker.js"></script>
    <script type="text/javascript" src="js/lobibox.js"></script>
    <script type="text/javascript" src="js/notifications.js"></script>
    <script type="text/javascript" src="js/messageboxes.js"></script>
    <link rel="stylesheet" href="css/audioplayer.css" />
    <script src="js/audioplayer.js"></script>

</head>

<title>Connect Dots</title>


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

    <div class="work-area">
        <div class="leftPanelTools">
            <div class="tools-header">
                <span>Tools</span>
            </div>
            <div class="dash-top"></div>
            <a class="btn add-dot" onclick="addDot()" title="Add point"><i></i></a>
            <a class="btn remove-dot" onclick="removeFile()" title="Add point"><i></i></a>
            <a class="btn add-title" onclick="addTitle()" title="Add Title Qustion"><i></i></a>
            <a class="btn line-option" onclick="lineOpction()" title="Line Opction"><i></i></a>
            <a class="btn point-opction" onclick="pointOpction()" title="point Opction"><i></i></a>
            <a class="btn settings-image" onclick="settingsImage()" title="Image Setting"><i></i></a>
            <a class="btn draw" onclick="DrawingColorsBox()" title="Drawing Box"><i></i></a>
            <a class="btn removeAll" onclick="removeAllDots()" title="Remove All Points"><i></i></a>
            <a class="btn removeAll" onclick="Arabicletters()" title="Active Arabic numbers"><i></i></a>
        </div>
        <div id="gameContainer" class="gameContainer">

            <div class="gameContent">


            </div>

        </div>

        <div class="inputContainer">


            <input type="file" class="inputHide" id="uploadBackground" UploadType="uploadBackground"
                   onchange="UploadType='uploadBackground';getImageLocal(this)" name="upload" accept="image/*">
            <input type="file" class="inputHide" id="uploadBackgroundFull" UploadType="uploadBackgroundFull"
                   onchange="UploadType='uploadBackgroundFull';getImageLocal(this)" name="upload" accept="image/*">
            <input type="file" class="inputHide" id="uploadImageObject" UploadType="uploadImageObject"
                   onchange="UploadType='uploadImageObject';getImageLocal(this)" name="upload" accept="image/*">
            <input type="file" class="inputHide" id="uploadBackgroundSound" UploadType="BackgroundSound"
                   onchange="UploadType='BackgroundSound';getImageLocal(this)" name="upload" accept="audio/*">
            <input type="file" class="inputHide" id="uploadsoundObject" UploadType="uploadsoundObject"
                   onchange="UploadType='uploadsoundObject';getImageLocal(this)" name="upload" accept="audio/*">
            <input type="file" class="inputHide" id="uploadsoundWin" UploadType="uploadsoundWin"
                   onchange="UploadType='uploadsoundWin';getImageLocal(this)" name="upload" accept="audio/*">

            <input type="file" class="inputHide" id="uploadIconTitle" UploadType="uploadIconTitle" onchange="UploadType='uploadIconTitle';getImageLocal(this)" name="upload" accept="image/*">
        </div>
    </div>

</div>
</body>
</html>