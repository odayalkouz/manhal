<?php
/*
 * Created by Dar Almanhal - khalid alomiri .
 * User: khalid alomiri
 * Date: 31/10/2018
 * Time: 3:30 AM
 */
session_start();
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="css/shapes.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/shapes.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script src="js/edit_ui.js" ></script>
    <script>
        (function(doc){var addEvent='addEventListener',type='gesturestart',qsa='querySelectorAll',scales=[1,1],meta=qsa in doc?doc[qsa]('meta[name=viewport]'):[];function fix(){meta.content='width=device-width,minimum-scale='+scales[0]+',maximum-scale='+scales[1];doc.removeEventListener(type,fix,true);}if((meta=meta[meta.length-1])&&addEvent in doc){fix();scales=[.25,1.6];doc[addEvent](type,fix,true);}}(document));
        UserId=<?=$row["userid"];?>;
        GameID=<?=$_GET["id"];?>;
        rootPath="../games/<?=$_GET["id"];?>/";
        var game =<?php if($row["data"]!=""){echo  (($row["data"]));}else{echo "''";} ?>;
        var config = {
            GameID: GameID,
            UserId: UserId,
            lang:'<?=$row["language"];?>',
            rootPath: rootPath
        }
    </script>
    <title>Differents</title>
</head>
<body>
<div class="ContainerEditor">
    <div class="headerEditor">
        <span class="title-editor floating-left">Spot the Differences Between Two Pictures</span>
        <div class="top-tools-container floating-right">
            <a class="save floating-left"  title="Save"><i></i></a>
<!--            <div class="separator floating-left"></div>-->
            <a class="preview floating-left"  title="Preview"><i></i></a>
        </div>
        <div class="viewerType-container">
            <span class="title-text">layout</span>
            <div class="label-container" style=" margin-top: 10px;">

                <input type="radio" id="layoutH" name="layout" checked="checked">
                <label for="layoutH"><span></span><span>عامودي</span></label>
            </div>
            <div class="label-container">
                <input type="radio" id="layoutV" name="layout">
                <label for="layoutV"><span></span><span>أفقي</span></label>
            </div>
        </div>
    </div>
    <div class="work-area">
        <div class="leftPanelTools">
<!--            <div class="tools-header">-->
<!--                <span>Tools</span>-->
<!--            </div>-->
<!--            <div class="dash-top"></div>-->
            <a title="Add empty area object." class="btn add-area" onclick="addTransparentLayer()"><i></i></a>
        </div>
        <div id="gameContainer" class="gameContainer" >
            <div class="gameContent" >
                <div class="img-main-container floating-left">
                    <img id="add-image-1"  class="img-container" ></img>
                    <div class="AreaDifference"></div>

                </div>

                <div class="img-main-container floating-left">
                    <img id="add-image-2" class="img-container" ></img>

                </div>

                <div class="footer-container">
                    <div class="add-image-container-1">
                        <span>Add Image</span>
                        <form id="image_left" style="width:300px;height:300px" enctype="multipart/form-data" method="post" action="image_upload_script.php?imagename=left" target="hidden_iframe">
                            <input name="URL_" class="add-image-1 URL_" type="hidden"  />
                            <input name="uploaded_file" class="add-image-1" type="file"  />
                        </form>
                    </div>
                    <div class="add-image-container-2">
                        <span>Add Image</span>
                        <form id="image_right" style="width: 300px;height: 300px" enctype="multipart/form-data" method="post" action="image_upload_script.php?imagename=right" target="hidden_iframe">
                            <input name="URL_" class="add-image-1 URL_" type="hidden"  />
                            <input name="uploaded_file" class="add-image-2" type="file"/>
                        </form>
                    </div>
                    <div class="trueFalse">
                        <div class="icon true">
                            <input type="radio" id="iconTrue" name="iconType" checked="checked">
                            <label for="iconTrue"><span></span><i class="trueIcon"></i></label>
                        </div>
                        <div class="icon false">
                            <input type="radio" id="iconFalse" name="iconType">
                            <label for="iconFalse"><span></span><i class="falseIcon"></i></label>
                        </div>
                    </div>
                </div>

            </div>


            </div>
        </div>
        <span class="logo clear floating-right"></span>
    </div>
</div>
<iframe id="hidden_iframe" name="hidden_iframe" src="image_upload_script.php"  style="width: 0px;height: 0px;background: transparent;border: 0;"></iframe>
</body>
</html>
