<?php
session_start();
/*
 * Created by Dar Almanhal - Hussam Abu Khadijeh .
 * User: khalid alomiri
 * Date: 16/5/2017
 * Time: 1:50 AM
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

<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link href="css/style<?=$row["language"]?>.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/js.js"></script><script type="text/javascript" src="js/upload.js"></script><script type="text/javascript" src="js/ajax.js"></script>
    <script>

        UserId=<?=$row["userid"];?>;
        GameID=<?=$_GET["id"];?>;
        rootPath="../games/<?=$_GET["id"];?>/";

        var game =<?php if($row["data"]!=""){echo  (str_replace("\n","",$row["data"]));}else{echo "''";} ?>;
        var config = {
            GameID: GameID,
            UserId: UserId,
            lang:'<?=$row["language"];?>',
            rootPath: rootPath
        }

    </script>
    </head>
    <body>
    <div id="gameContainer" class="gameContainer noselect">
        <div class="button-container">
            <span class="title-editor floating-right"></span>
            <span class="line-title floating-right"></span>
            <div class="top-tools-container floating-left">
                <div class="button-tools floating-right"><a onclick="savedata();" class="save" title="Save"></a></div>
<!--                <div class="separator floating-right"></div>-->
                <div class="button-tools floating-right"><a onclick="window.open('viewer/<?=strtolower($row["language"])?>/index.php?id=' + config.GameID, '_blank')" class="preview" title="Preview"></a></div>
            </div>
        </div>
        <div class="work-place">

            <div class="right-container floating-right">
                <div class="guestion-title floating-right">
                    <span title_="أَدْخُلُ عنوان التمرين " sound="" id="exercise_title" class="question-title-container floating-right"> أَدْخُلُ عنوان التمرين </span>
                    <a onclick="editText('exercise_title')"  class="edit-question-title floating-right"></a>
                </div>
                    <div class="gameContent" id="gameContent">

                </div>
            </div>
            <div class="btn-container floating-left">
                <div class="tools-header">
                    <span>Tools</span>
                </div>
                <div class="dash-top"></div>
                <div class="button-tools-container"><a class="btn add-title" title="Add Title"></a></div>
            </div>
        </div>
    </div>
    <div class="proprties addTitle" index="" style="display: none">
        <div class="proprtiesContainer" style="height: 571px">
            <div class="headProprties">
                <label>Proprties</label>
                <a onclick="$('.addTitle').hide()" class="closePng"></a>
            </div>
            <div class="bodyProprties">
                <section class="section settingSection text">
                    <textarea class="titleText" placeholder="Enter title text" type="text" value="" id="titleText" style="top: 5%;"></textarea>
                    <textarea class="titleText" placeholder="Enter title text" type="text" value="" id="wrong_chr" style="top: 53%;"></textarea>
                </section>
                <section class="section settingSection icon">
                    <div class="soundUpload-container">
                        <a class="soundUpload floating-left" onclick="getImageLocal(this)" id="sound"><i></i><input type="file" class="inputHide" filename="" id="uploadSound" UploadType="sound" onchange="UploadType='sound';getImageLocal(this)" name="upload" accept="audio/*"></a>
                        <a class="soundDelete floating-left" onclick="removesound();"><i></i></a>
                        <div id="wrapper" class="audio-container"><audio  id="audioPreview" controls=""><source src=""></audio>

                        </div>
                        <div class="upload-icon floating-right">
                            <div class="iconContainerTitle">
                                <img class="iconTitle" onclick="removeimage();" id="iconimages" src="">
                            </div>
                        </div>
                        <div class="tools-container floating-right">
                            <a class="upload-btn" type="button" ><i></i>
                                <input class="floating-left upload-image-a" readonly="" type="file" value="images"   filename="" id="uploadImage" UploadType="images" onchange="UploadType='images';getImageLocal(this)" name="upload">
                            </a>
                            <a class="delete-img" onclick="removeimage()"><i></i></a>
                        </div>
                        <div class="checkbox-container floating-left">
                            <input class="floating-left" type="checkbox" name="spaces" id="spaces">
                            <label class="floating-left" for="spaces">delete space</label>
                        </div>
                    </div>
                </section>
            </div>
            <div class="footerProprties">
                <div class="btn-save-container floating-left"><a onclick="donEdit();" class="ok-btn" id="bgEditt"><label>Save</label></a></div>
            </div>
        </div>
    </div>
    <iframe id="hidden_iframe" name="hidden_iframe" style="width: 0px;height: 0px;"></iframe>
    </body>
</html>
