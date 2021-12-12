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
<html >
<body>
<script>
    config={}
    UserId =<?=$row["userid"];?>;
    GameID =<?=$_GET["id"];?>;
    rootPath = "../games/<?=$_GET["id"];?>/";

    langStory=lang="<?=$row["language"];?>".toLowerCase()

    config.id=<?=$_GET["id"];?>

</script>
<header>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html>
     <meta content="fa">
    <link href="css/swiper.min.css" rel="stylesheet" type="text/css">
    <link href="css/manhalloader.css" rel="stylesheet" type="text/css">
    <link href="css/lobibox.css" rel="stylesheet" type="text/css">

    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/flaticon.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/manhalLoader.js"></script>
    <script type="text/javascript" src="js/swiper.min.js"></script>
    <script type="text/javascript" src="js/upload.js"></script>
    <script type="text/javascript" src="js/editorUI.js"></script>
    <script type="text/javascript" src="js/js.js"></script>
    <script type="text/javascript" src="js/ajax.js"></script>
    <script type="text/javascript" src="js/ui.js"></script>
    <script type="text/javascript" src="js/colorPicker.js"></script>
    <script type="text/javascript" src="js/lobibox.js"></script>
    <script type="text/javascript" src="js/notifications.js"></script>
    <script type="text/javascript" src="js/messageboxes.js"></script>
    <link rel="stylesheet" href="css/audioplayer.css" />
    <script src="js/audioplayer.js"></script>
</header>


<style>
    body {
        /*background: #FF7AAD;*/
    }

    #gameContainer {
        /*background: #49e2df;*/
        position: absolute;
        width: 100%;
        height: 100%;
        text-align: center;
        /*display: flex;*/
        justify-content: center;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        margin: auto;
        /*background: #424242;*/
        /*border : 3px solid black !important;*/
        background: url("../images/pattern-grey.png") repeat;

    }

    .right-container {
        display: block;
        overflow: hidden;
        width: calc(100% - 109px);
        height: calc(100% - 120px);
        background: url("images/pattern-grey.png") repeat;
        position: relative;
    }

    .gameContent {
        display: block;
        background: #fff;
        width: 100%;
        height: calc(100% - 215px);
        margin: auto;
        /* background: url(../images/garden.jpg) no-repeat; */
        background-size: 100% 100%;
        box-shadow: 0 0 10px gray;
        /*border-radius: 5px;*/
        /*border: none;*/
        /*border-width: thin thick;*/

        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }

    .coloring {
        float: left;
        margin-left: 10px;
    }

    div.colorPicker-picker {
        height: 100%;
        width: 100%;
        padding: 0 !important;
        border: 0;
        background: url("../arrow.gif") no-repeat top right;
        cursor: pointer;
        line-height: 16px;
        font-size: 0.75em;
        font-weight: bold;
        text-align: center;
    }
</style>

<title>Labeling</title>
<div id="gameContainer" class="gameContainer noselect">
    <div class="button-container">
        <span class="title-editor floating-left"></span>
        <span class="line-title floating-left"></span>
        <div class="top-tools-container floating-right">
            <div class="button-tools floating-left"><a class="setting" onclick="setting()" title="Proprties"></a></div>
<!--            <div class="separator floating-left"></div>-->
            <div class="button-tools floating-left"><a class="save" onclick="saveData()" title="Save"></a></div>
<!--            <div class="separator floating-left"></div>-->
            <div class="button-tools floating-left"><a class="preview" onclick="previewGame()" title="Preview"></a></div>
            <div class="upload-container inputContainer floating-left" onclick="simulateUpload($('#uploadBackground'))">
                <i></i>

            </div>
            <div class="button-tools floating-left"><a class="add-title" onclick="addTitleQustion()" title="Add Title"></a></div>
        </div>
    </div>
    <div class="work-place">
        <div class="right-container floating-right">
            <div class="gameContent" id="gameContent"></div>
        </div>

        <div class="btn-container floating-left">
<!--            <div class="tools-header">-->
<!--                <span>Tools</span>-->
<!--            </div>-->
<!--            <div class="dash-top"></div>-->
            <div class="button-tools-container"><a class="btn add-Label" onclick="addobject()" title="Add Label"></a></div>
            <div class="button-tools-container"><a class="btn delete-label" onclick="removeLabel()" title="Delete Label"></a></div>
            <div class="button-tools-container"><a class="btn hid-show-points" onclick="labelJustChecked()"
                                                   title="hide/show points"></a></div>
<!--            <div class="button-tools-container"><a class="btn add-title" onclick="addTitleQustion()" title="Add Title"></a></div>-->
<!--            <div class="button-tools-container"><a class="btn Change-Type" onclick="addTitleQustion()"-->
<!--                                                   title="Change Type"></a></div>-->



        </div>
        <span class="logo clear floating-right"></span>
        <div class="main-footer-container">
            <div class="inner-footer-container">
                <div class="line-footer"></div>
                <div class="butn-container floating-left">
                    <a class="floating-left add-level" onclick="addLevel()" title="Add Levle"><i></i></a>
                    <a class="floating-left remove-level" onclick="removePage()" title="Remove Levle"><i></i></a>
                </div>
                <div class="page-slider floating-left">
                    <a onclick="$('.swiper-button-prev').click()" class="next-btn floating-left" title="Previous"><i></i></a>
                    <div class="slider-container floating-left">

                        <div class="swiper-container">
                            <div class="swiper-wrapper">

                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev "></div>
                        </div>


                    </div>
                    <a onclick="$('.swiper-button-next').click()" class="prev-btn floating-left" title="Next"><i></i></a>
                </div>
            </div>

        </div>

        <div style="display: none" class="inputContainer">




            <input type="file" class="inputHide" id="uploadBackgroundSound" UploadType="BackgroundSound"
                   onchange="UploadType='BackgroundSound';getImageLocal(this)" name="upload" accept="audio/*">

            <input type="file" class="inputHide floating-left" id="uploadBackground" UploadType="uploadBackground"
                   onchange="UploadType='uploadBackground';getImageLocal(this)" name="upload" accept="image/*">


        </div>
    </div>
</div>
</body>
</html>
