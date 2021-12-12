<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 24/06/2019
 * Time: 10:36 AM
 */
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
if(!(isset($_SESSION['user']['permession']) && ($_SESSION['user']['permession']==1 || $_SESSION['user']['permession']==2 || $_SESSION['user']['permession']==6 || $_SESSION['user']['permession']==10 || $_SESSION['user']['permession']==11 ))){
    echo "Secured";
    exit();
}

include_once "../config.php";
include_once('../includes/colors.inc.php');
include_once "../includes/function.php";

$Lang = simplexml_load_file("../../language/".$_SESSION["lang"].".xml");

if(isset($_GET['process']) && $_GET['process']!=""){
    $_GET['process']();
}

function generalsettings(){
    global $con;
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';

//    if($_POST["series"]==-1 || $_POST["series"]==0){
        $story_path="../stories/".$_POST["storyid"];
        $absolute_path=SITE_URL."platform/stories/".$_POST["storyid"];
//    $story_path="../".str_replace("platform/","",$_POST["storypath"])."/";

//    }else{
//        $story_path="../stories/".$_POST["series"]."/story/".$_POST["storyid"];
//        if($_POST["series"]!=$_POST["oldseriesid"]){
//            copyDirectory("../stories/".$_POST["oldseriesid"]."/story/".$_POST["storyid"],"../stories/".$_POST["series"]."/story/".$_POST["storyid"]);
//            //removeDirectory("../stories/".$_POST["oldseriesid"]."/story/".$_POST["storyid"]);
//        }
//    }
    if(!is_dir($story_path)){
        mkdir($story_path);
    }
    if(!is_dir($story_path."/images")){
        mkdir($story_path."/images");
    }
    if(!is_dir($story_path."/sound")){
        mkdir($story_path."/sound");
    }
//    if(file_exists($_FILES['frontcover']['tmp_name']) && is_uploaded_file($_FILES['frontcover']['tmp_name'])) {
//        $ext = array("jpg","jpeg","png","gif");
//        $fileName =uploadFile("frontcover",$ext,$story_path."/images/",$multible=false,"pic.jpg ");
//        $sql="UPDATE `story` set color='".getImageColor($story_path."/images/pic.jpg")."' WHERE storyid=".$_POST['storyid'];
//        $con->query($sql);
//    }
    $validextensions = array("jpeg", "jpg", "png","gif","svg");
    if(file_exists($_FILES['frontcover']['tmp_name']) && is_uploaded_file($_FILES['frontcover']['tmp_name'])) {
        $target_path = $story_path."/images/pic.jpg";     // Declaring Path for uploaded images.
        $ext = explode('.', basename($_FILES['frontcover']['name']));   // Explode file name from dot(.)
        $file_extension = strtolower(end($ext)); // Store extensions in the variable.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['frontcover']['tmp_name'], $target_path);
        }
    }



//
//    if(file_exists($_FILES['backcover']['tmp_name']) && is_uploaded_file($_FILES['backcover']['tmp_name'])) {
//        $ext = array("jpg","jpeg","png","gif");
//        $fileName =uploadFile("backcover",$ext,$story_path."/images/",$multible=false,"back.jpg ");
//        $sql="UPDATE `story` set color='".getImageColor($story_path."/images/back.jpg")."' WHERE storyid=".$_POST['storyid'];
//        $con->query($sql);
//    }

    if(file_exists($_FILES['backcover']['tmp_name']) && is_uploaded_file($_FILES['backcover']['tmp_name'])) {
        $target_path = $story_path."/images/back.jpg";     // Declaring Path for uploaded images.
        $ext = explode('.', basename($_FILES['backcover']['name']));   // Explode file name from dot(.)
        $file_extension = strtolower(end($ext)); // Store extensions in the variable.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['backcover']['tmp_name'], $target_path);
        }
    }

//    if(file_exists($_FILES['democover']['tmp_name']) && is_uploaded_file($_FILES['democover']['tmp_name'])) {
//        $ext = array("jpg","jpeg","png","gif");
//        $fileName =uploadFile("democover",$ext,$story_path."/images/",$multible=false,"demo_cover.jpg ");
//        $sql="UPDATE `story` set color='".getImageColor($story_path."/images/demo_cover.jpg")."' WHERE storyid=".$_POST['storyid'];
//        $con->query($sql);
//    }
    if(file_exists($_FILES['democover']['tmp_name']) && is_uploaded_file($_FILES['democover']['tmp_name'])) {
        $target_path = $story_path."/images/demo_cover.jpg";     // Declaring Path for uploaded images.
        $ext = explode('.', basename($_FILES['democover']['name']));   // Explode file name from dot(.)
        $file_extension = strtolower(end($ext)); // Store extensions in the variable.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['democover']['tmp_name'], $target_path);
        }
    }

    //file_put_contents("screenshoots.txt",json_encode($_POST));
    if(isset($_FILES['screenshoots']['tmp_name'][0]) && is_uploaded_file($_FILES['screenshoots']['tmp_name'][0])) {
        if(!is_dir($story_path."/images/screenshoots/")){
            mkdir($story_path."/images/screenshoots/");
        }
        $target_path = $story_path."/images/screenshoots/";     // Declaring Path for uploaded images.
        // removeDirectory($target_path);
        // mkdir($target_path);
       // file_put_contents("screenshoots.txt",$_FILES['screenshoots']['name'][0]);
        $count=count($_FILES['screenshoots']['name']);
        $validextensions = array("jpeg", "jpg", "png","gif","svg");      // Extensions which are allowed.
        for ($i = 0; $i <$count;  $i++) {
            $target_path = $story_path."/images/screenshoots/";     // Declaring Path for uploaded images.
            $ext = explode('.', basename($_FILES['screenshoots']['name'][$i]));   // Explode file name from dot(.)
            $file_extension = strtolower(end($ext)); // Store extensions in the variable.
            $img_name=(uniqid()).$i . "." . $ext[count($ext) - 1];
            $target_path = $target_path .$img_name ;     // Set the target path with a new name of image.
            if (in_array($file_extension, $validextensions)) {
                move_uploaded_file($_FILES['screenshoots']['tmp_name'][$i], $target_path);
            }
        }


        if(is_dir($story_path."/images/screenshoots")){
            echo "<script>$(document).ready(function(){                          
                             window.parent.$('.screen-shoots').html('');
                           });</script>";
            foreach (scandir($story_path."/images/screenshoots/") as $image){
                if($image!="." && $image!=".."){
                    echo "<script>$(document).ready(function(){                          
                             window.parent.$('.screen-shoots').append('<div><img src=\"$absolute_path/images/screenshoots/$image\"/><span class=\"jq_delete_screenshot\" img=\".$image\">X</span></div>');
                           });</script>";
                }

            }
        }


    }

    if(isset($_FILES['paintpictures'][0]['tmp_name']) && file_exists($_FILES['paintpictures'][0]['tmp_name']) && is_uploaded_file($_FILES['paintpictures'][0]['tmp_name'])) {
        $target_path = $story_path."/images/";     // Declaring Path for uploaded images.
        for ($i = 0; $i < count($_FILES['paintpictures']['name']); $i++) {
            $target_path = $story_path."/images/";     // Declaring Path for uploaded images.
            $validextensions = array("jpeg", "jpg", "png","gif","svg");      // Extensions which are allowed.
            $ext = explode('.', basename($_FILES['paintpictures']['name'][$i]));   // Explode file name from dot(.)
            $file_extension = strtolower(end($ext)); // Store extensions in the variable.
            $target_path = $target_path.($i+1).".png";     // Set the target path with a new name of image.
            if (in_array($file_extension, $validextensions)) {
                move_uploaded_file($_FILES['paintpictures']['tmp_name'][$i], $target_path);
            }
        }
    }
    if(isset($_FILES['gamespictures'][0]['tmp_name']) && file_exists($_FILES['gamespictures'][0]['tmp_name']) && is_uploaded_file($_FILES['gamespictures'][0]['tmp_name'])) {
        $target_path = $story_path."/images/";     // Declaring Path for uploaded images.
        for ($i = 0; $i < count($_FILES['gamespictures']['name']); $i++) {
            $target_path = $story_path."/images/";     // Declaring Path for uploaded images.
            $validextensions = array("jpeg", "jpg", "png","gif","svg");      // Extensions which are allowed.
            $ext = explode('.', basename($_FILES['gamespictures']['name'][$i]));   // Explode file name from dot(.)
            $file_extension = strtolower(end($ext)); // Store extensions in the variable.
            $target_path = $target_path."0".($i+1).".jpg";     // Set the target path with a new name of image.
            if (in_array($file_extension, $validextensions)) {
                move_uploaded_file($_FILES['gamespictures']['tmp_name'][$i], $target_path);
            }
        }
    }
    $validextensions = array('mp3');
    if(file_exists($_FILES['parent_sound']['tmp_name']) && is_uploaded_file($_FILES['parent_sound']['tmp_name'])) {
        $target_path = $story_path."/sound/parent.mp3";     // Declaring Path for uploaded images.
        $ext = explode('.', basename($_FILES['parent_sound']['name']));   // Explode file name from dot(.)
        $file_extension = strtolower(end($ext)); // Store extensions in the variable.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['parent_sound']['tmp_name'], $target_path);
        }
    }
    if(file_exists($_FILES['kids_sound']['tmp_name']) && is_uploaded_file($_FILES['kids_sound']['tmp_name'])) {
        $target_path = $story_path."/sound/kids.mp3";     // Declaring Path for uploaded images.
        $ext = explode('.', basename($_FILES['kids_sound']['name']));   // Explode file name from dot(.)
        $file_extension = strtolower(end($ext)); // Store extensions in the variable.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['kids_sound']['tmp_name'], $target_path);
        }
    }
    if(file_exists($_FILES['title_sound']['tmp_name']) && is_uploaded_file($_FILES['title_sound']['tmp_name'])) {
        $target_path = $story_path."/sound/title.mp3";     // Declaring Path for uploaded images.
        $ext = explode('.', basename($_FILES['title_sound']['name']));   // Explode file name from dot(.)
        $file_extension = strtolower(end($ext)); // Store extensions in the variable.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['title_sound']['tmp_name'], $target_path);
        }
    }
    if(file_exists($_FILES['bgsound']['tmp_name']) && is_uploaded_file($_FILES['bgsound']['tmp_name'])) {
        $target_path = $story_path."/sound/bgsound.mp3";     // Declaring Path for uploaded images.
        $ext = explode('.', basename($_FILES['bgsound']['name']));   // Explode file name from dot(.)
        $file_extension = strtolower(end($ext)); // Store extensions in the variable.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['bgsound']['tmp_name'], $target_path);
        }
    }

    $isPublished=0;
    if(isset($_POST["isPublished"]) && $_POST["isPublished"]==1){
        $isPublished=1;
    }
    $package=0;
    if(isset($_POST["package"]) && $_POST["package"]==1){
        $package=1;
    }
    $isMedia=0;
    if(isset($_POST["isInteractiveW"]) && $_POST["isInteractiveW"]==1){
        $isMedia=1;
    }
    $story_type=0;
    if(isset($_POST["story_type_p"]) && $_POST["story_type_p"]==1 ){
        $story_type+=1;
    }
    if(isset($_POST["story_type_e"]) && $_POST["story_type_e"]==1 ){
        $story_type+=2;
    }
    if(isset($_POST["story_type_i"]) && $_POST["story_type_i"]==1 ){
        $story_type+=4;
    }

    $mediaid=$_POST["mediaid"];


    $settings=array(
        "arrow" => (isset($_POST["arrow"]) && $_POST["arrow"]==1)? "1" : "0",
        "dots" => (isset($_POST["dots"]) && $_POST["dots"]==1)? "1" : "0",
        "autoplay" => (isset($_POST["autoplay"]) && $_POST["autoplay"]==1)? "1" : "0",
        "infinite" => (isset($_POST["infinite"]) && $_POST["infinite"]==1)? "1" : "0",
        "align" => (isset($_POST["Align"]) && $_POST["Align"]=="h")? "h" : "v",
        "transition" => $_POST["transition"],
        "drawing" => (isset($_POST["drawing"]) && $_POST["drawing"]==1)?  "1" : "0"
    );

    if($isMedia){
        if($_POST["mediaid"]==0){
            $sql="INSERT INTO `media`(`title_ar`, `title_en`, `category`, `userid`, `cdate`, `status`, `language`, `description_en`, `description_ar`, `price`, `views`, `sales`, `favorites`, `rate`,
`rating_count`, `grade`, `age`, `type`, `filename`, `download`, `path`, `productid`, `fakeid`, `is_newtab`, `is_playlist`, `is_story`) VALUES (
'".mysqli_real_escape_string($con,$_POST["title"])."','".mysqli_real_escape_string($con,$_POST["title"])."',15,".$_SESSION['user']['userid'].",NOW(),".$isPublished.",
'".$_POST["language"]."','".mysqli_real_escape_string($con,$_POST["description_en"])."','".mysqli_real_escape_string($con,$_POST["description_ar"])."',0,0,0,0,0,0,".$_POST["age"].",".$_POST["age"].",
12,'".$_POST["storyid"]."',0,'',".$_POST["storyid"].",0,0,0,1)";
            $con->query($sql);
            $mediaid=$con->insert_id;
        }else{
            $sql="UPDATE `media` SET `title_ar`='".mysqli_real_escape_string($con,$_POST["title"])."',`title_en`='".mysqli_real_escape_string($con,$_POST["title"])."',`category`=15,
           `status`=".$isPublished.",`language`='".$_POST["language"]."',`description_en`='".mysqli_real_escape_string($con,$_POST["description_en"])."',
           `description_ar`='".mysqli_real_escape_string($con,$_POST["description_ar"])."',`grade`=".$_POST["age"].",`age`=".$_POST["age"].",`type`=12,`filename`='".$_POST["storyid"]."',
           `productid`=".$_POST["storyid"].",`is_story`=1 WHERE id=".$_POST["mediaid"];
            $con->query($sql);

        }
    }

    $sql="UPDATE `story` SET `seriesid`=".$_POST["series"].",`author_en`='".mysqli_real_escape_string($con,$_POST["author_en"])."',`author_ar`='".mysqli_real_escape_string($con,$_POST["author_ar"])."',`catid`=".$_POST["category"].",`description_ar`='".mysqli_real_escape_string($con,$_POST["description_ar"])."',`description_en`='".mysqli_real_escape_string($con,$_POST["description_en"])."',`parenttext`='".mysqli_real_escape_string($con,$_POST["parenttext"])."',
          `price`=".$_POST["price"].",`title`='".mysqli_real_escape_string($con,$_POST["title"])."',`type`=".$story_type.",`isbn`='".mysqli_real_escape_string($con,$_POST["isbn"])."',`covertype`=".$_POST["binding"].",`weight`=".$_POST["weight"].",
          `language`='".$_POST["language"]."',`age`=".$_POST["age"].",`width`=".$_POST["width"].",`height`=".$_POST["height"].",
          `year`=".$_POST["publish_year"].",`status`=".$isPublished.",`filling`='".$_POST["filling"]."',`pages_count`=".$_POST["pagescount"].",range_first=".$_POST["firstpage"].",range_end=".$_POST["lastpage"]."
          ,kidstext='".mysqli_real_escape_string($con,$_POST["kidstext"])."',
           `sseodescription_en`='".mysqli_real_escape_string($con,$_POST['seodescription_en'])."',
           `sseodescription_ar`='".mysqli_real_escape_string($con,$_POST['seodescription_ar'])."',`oldprice`=".$_POST["old_price"].",`package`=".$package.",`viewtype`=".$_POST["viewtype"].",`flipping`=".$_POST["pageflip"]."
           ,`is_media`=".$isMedia.",`mediaid`=".$mediaid.", `settings`='".mysqli_real_escape_string($con,json_encode($settings))."' WHERE storyid=".$_POST["storyid"];
    if($con->query($sql)){

        echo '<script>$(document).ready(function(){
                            window.parent.hideLoader();
                             window.parent.$("#mediaid").val("'.$mediaid.'");
                             window.parent.$(".close").click();
                           });</script>';
    }else{
        echo '<script>$(document).ready(function(){
                            window.parent.hideLoader();
                            window.parent.console.log("sql","'.$sql.'");
                          //  window.parent.alert("error");
                           });</script>';
    }
}
function deletestory(){
    global $con;
    if ($_SESSION['user']['permession'] == 1) {
        $weruser = '';
    } else {
        $weruser = " and userid=".$_SESSION['user']['userid'];
    }
    $sql = "Select * FROM `story` WHERE `storyid`=".$_POST['storyid'].$weruser;
    $result = $con->query($sql);
    $num_rows=mysqli_num_rows($result);
    if($num_rows>0){
        if($con->query("DELETE FROM `story` WHERE `storyid`=".$_POST['storyid'])){
            if(is_dir("../stories/".$_POST['storyid']."/")){
                removeDirectory("../stories/".$_POST['storyid']."/");
            }
            $resultData["result"]=1;
        }else{
            $resultData["result"]=0;
            $resultData["msg"]="sqlerror";
        }
    }else{
        $resultData["result"]=-1;
        $resultData["msg"]="no permession";
    }

    echo json_encode($resultData);
}
function deletebgsound(){
    $path="../".str_replace("platform/","",$_POST["storypath"])."/";
    $absolute_path=SITE_URL.$_POST["storypath"]."/";
    $target_path = $path."/sound/bgsound_".$_POST["pageid"].".mp3";
    if(is_file($target_path)){
        @unlink($target_path);
    }
    $JsonPath="../".str_replace("platform/","",$_POST["storypath"])."/pages.json";
    if(is_file($JsonPath)){
        $pages=json_decode(file_get_contents($JsonPath),true);
    }else{
        $pages=array();
    }
    $pages[$_POST["pageid"]]["bg_sound"]="";
    file_put_contents($JsonPath,json_encode($pages));
    echo 1;
}
function deletewidgetsound(){
    $path="../".str_replace("platform/","",$_POST["storypath"])."/";
    $absolute_path=SITE_URL.$_POST["storypath"]."/";
    $target_path = $path."/sound/".$_POST["widgetid"].".mp3";
    if(is_file($target_path)){
        @unlink($target_path);
    }
    echo 1;
}
function deletepagebg(){
    $path="../".str_replace("platform/","",$_POST["storypath"])."/";
    $target_path = $path."/images/".$_POST["img"];
    if(is_file($target_path)){
        @unlink($target_path);
    }
    $JsonPath="../".str_replace("platform/","",$_POST["storypath"])."/pages.json";
    if(is_file($JsonPath)){
        $pages=json_decode(file_get_contents($JsonPath),true);
    }else{
        $pages=array();
    }
    $pages[$_POST["pageid"]]["bg_image"]="";
    file_put_contents($JsonPath,json_encode($pages));
    echo 1;
}
function deletescreenshoot(){
    $path="../".str_replace("platform/","",$_POST["storypath"])."/";
    $target_path = $path."/images/screenshoots/".$_POST["img"];
    if(is_file($target_path)){
        @unlink($target_path);
    }
    echo 1;
}
function deletepagethumb(){
    $path="../".str_replace("platform/","",$_POST["storypath"])."/";
    $target_path = $path."/images/".$_POST["img"];
    if(is_file($target_path)){
        @unlink($target_path);
    }
    $JsonPath="../".str_replace("platform/","",$_POST["storypath"])."/pages.json";
    if(is_file($JsonPath)){
        $pages=json_decode(file_get_contents($JsonPath),true);
    }else{
        $pages=array();
    }
    $pages[$_POST["pageid"]]["thumb"]="";
    file_put_contents($JsonPath,json_encode($pages));
    echo 1;
}
function updatepagesettings(){
    $path="../".str_replace("platform/","",$_POST["storypath"])."/";
    $absolute_path=SITE_URL.$_POST["storypath"]."/";
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    $JsonPath="../".str_replace("platform/","",$_POST["storypath"])."/pages.json";
    $rand=rand(1,999999);
    if(is_file($JsonPath)){
        $pages=json_decode(file_get_contents($JsonPath),true);
    }else{
        $pages=array();
    }
    if(file_exists($_FILES['page_sound']['tmp_name']) && is_uploaded_file($_FILES['page_sound']['tmp_name'])) {
        $validextensions = array('mp3');
        $target_path = $path."/sound/bgsound_".$_POST["pageid"].".mp3";     // Declaring Path for uploaded images.
        $ext = explode('.', basename($_FILES['page_sound']['name']));   // Explode file name from dot(.)
        $file_extension = strtolower(end($ext)); // Store extensions in the variable.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['page_sound']['tmp_name'], $target_path);
            $file="bgsound_".$_POST["pageid"].".mp3";
            $pages[$_POST["pageid"]]["bg_sound"]=$file;
            echo '<script>$(document).ready(function(){
                            window.parent.$(".jq_questioni[pageid='."'".$_POST["pageid"]."'".']").attr("bg_sound","'.$file.'?v='.$rand.'");
                           });</script>';
        }
    }

    if(file_exists($_FILES['page_image']['tmp_name']) && is_uploaded_file($_FILES['page_image']['tmp_name'])) {
        $validextensions = array("jpeg", "jpg", "png","gif","svg");      // Extensions which are allowed.
        $ext = explode('.', basename($_FILES['page_image']['name']));   // Explode file name from dot(.)
        $file_extension = strtolower(end($ext)); // Store extensions in the variable.
        $target_path = $path."/images/bg_".$_POST["pageid"].".".$file_extension;     // Declaring Path for uploaded images.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['page_image']['tmp_name'], $target_path);
            $file="bg_".$_POST["pageid"].".".$file_extension;
            $pages[$_POST["pageid"]]["bg_image"]=$file;

            echo '<script>$(document).ready(function(){
                            if(window.parent.$(".jq_questioni.active").attr("pageid")=="'.$_POST["pageid"].'"){
                                window.parent.$(".story-content-container").css("background","#fff url('.$absolute_path."/images/".$file.'?v='.$rand.') no-repeat");
                                }
                            window.parent.$(".jq_questioni[pageid='."'".$_POST["pageid"]."'".']").attr("bg_image","'.$file.'?v='.$rand.'");
                           });</script>';
        }
    }


    if(file_exists($_FILES['page_thumb']['tmp_name']) && is_uploaded_file($_FILES['page_thumb']['tmp_name'])) {
        $validextensions = array("jpeg", "jpg", "png","gif","svg");      // Extensions which are allowed.
        $ext = explode('.', basename($_FILES['page_thumb']['name']));   // Explode file name from dot(.)
        $file_extension = strtolower(end($ext)); // Store extensions in the variable.
        $target_path = $path."/images/thumb_".$_POST["pageid"].".".$file_extension;     // Declaring Path for uploaded images.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['page_thumb']['tmp_name'], $target_path);
            $file="thumb_".$_POST["pageid"].".".$file_extension;
            $pages[$_POST["pageid"]]["thumb"]=$file;
            echo '<script>$(document).ready(function(){
                            window.parent.$(".jq_questioni[pageid='."'".$_POST["pageid"]."'".']").css("background","#fff url('.$absolute_path."/images/thumb_".$_POST["pageid"].".".$file_extension.'?v='.$rand.') no-repeat");
                           window.parent.$(".jq_questioni[pageid='."'".$_POST["pageid"]."'".']").attr("thumb","'.$file.'?v='.$rand.'");
                           });</script>';
        }
    }

    if(file_exists($_FILES['page_negative']['tmp_name']) && is_uploaded_file($_FILES['page_negative']['tmp_name'])) {
        $validextensions = array("jpeg", "jpg", "png","gif","svg");      // Extensions which are allowed.
        $ext = explode('.', basename($_FILES['page_negative']['name']));   // Explode file name from dot(.)
        $file_extension = strtolower(end($ext)); // Store extensions in the variable.
        $target_path = $path."/images/negative_".$_POST["pageid"].".".$file_extension;     // Declaring Path for uploaded images.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['page_negative']['tmp_name'], $target_path);
            $file="negative_".$_POST["pageid"].".".$file_extension;
            $pages[$_POST["pageid"]]["negative"]=$file;
            echo '<script>$(document).ready(function(){                          
                           window.parent.$(".jq_questioni[pageid='."'".$_POST["pageid"]."'".']").attr("negative","'.$file.'?v='.$rand.'");
                           if(window.parent.$(".jq_questioni.active").attr("pageid")=="'.$_POST["pageid"].'"){
                                window.parent.$(".story-content-container").css("background","#fff url('.$absolute_path."/images/".$file.'?v='.$rand.') no-repeat");
                                }
                           });</script>';
        }
    }


    file_put_contents($JsonPath,json_encode($pages));



    echo '<script>$(document).ready(function(){
    window.parent.$(".close").click();
                            window.parent.hideLoader();
                           });</script>';
}
function douknow_widget(){
    $rand=rand(1,999999);
    $path="../".str_replace("platform/","",$_POST["storypath"])."/";
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    if(file_exists($_FILES['douknow_icon']['tmp_name']) && is_uploaded_file($_FILES['douknow_icon']['tmp_name'])) {
        $validextensions = array("jpeg", "jpg", "png","gif","svg");      // Extensions which are allowed.
        $ext = explode('.', basename($_FILES['douknow_icon']['name']));   // Explode file name from dot(.)
        $file_extension = strtolower(end($ext)); // Store extensions in the variable.
        $target_path = $path."/images/".$_POST["widgetid"]."_icon.".$file_extension;     // Declaring Path for uploaded images.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['douknow_icon']['tmp_name'], $target_path);
            $file=$_POST["widgetid"]."_icon.".$file_extension;

            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST["widgetid"].'").attr("icon","'.SITE_URL.$_POST["storypath"]."/images/".$file.'?v='.$rand.'");
                            window.parent.$("#'.$_POST["widgetid"].'").find("img").attr("src","'.SITE_URL.$_POST["storypath"]."/images/".$file.'?v='.$rand.'");
                           });</script>';
        }
    }

    if(file_exists($_FILES['douknow_image']['tmp_name']) && is_uploaded_file($_FILES['douknow_image']['tmp_name'])) {
        $validextensions = array("jpeg", "jpg", "png","gif","svg");      // Extensions which are allowed.
        $ext = explode('.', basename($_FILES['douknow_image']['name']));   // Explode file name from dot(.)
        $file_extension = strtolower(end($ext)); // Store extensions in the variable.
        $target_path = $path."/images/".$_POST["widgetid"]."_image.".$file_extension;     // Declaring Path for uploaded images.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['douknow_image']['tmp_name'], $target_path);
            $file=$_POST["widgetid"]."_image.".$file_extension;

            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST["widgetid"].'").attr("img","'.SITE_URL.$_POST["storypath"]."/images/".$file.'?v='.$rand.'");
                           });</script>';
        }
    }

    echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST["widgetid"].'").attr("txt","'.$_POST["douknow_txt"].'");
                            window.parent.$(".close").click();
                            window.parent.hideLoader();
                           });</script>';


}
function imagewidget(){
    $rand=rand(1,999999);
    $path="../".str_replace("platform/","",$_POST["storypath"])."/";
    if(file_exists($_FILES['image_widget']['tmp_name']) && is_uploaded_file($_FILES['image_widget']['tmp_name'])) {
        $validextensions = array("jpeg", "jpg", "png","gif","svg");      // Extensions which are allowed.
        $ext = explode('.', basename($_FILES['image_widget']['name']));   // Explode file name from dot(.)
        $file_extension = strtolower(end($ext)); // Store extensions in the variable.
        $target_path = $path."/images/".$_POST["widgetid"].".".$file_extension;     // Declaring Path for uploaded images.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['image_widget']['tmp_name'], $target_path);
            $file=$_POST["widgetid"].".".$file_extension;
            echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST["widgetid"].'").attr("img","'.$file.'");
                            window.parent.$("#'.$_POST["widgetid"].'").find("img").attr("src","'.SITE_URL.$_POST["storypath"]."/images/".$file.'?v='.$rand.'");
                              window.parent.$(".close").click();
                            window.parent.hideLoader();
                           });</script>';
        }
    }
}
function audiowidget(){

    $rand=rand(1,999999);
    $path="../".str_replace("platform/","",$_POST["storypath"])."/";
    if(file_exists($_FILES['audio_file']['tmp_name']) && is_uploaded_file($_FILES['audio_file']['tmp_name'])) {
        $validextensions = array("mp3","wav");      // Extensions which are allowed.
        $ext = explode('.', basename($_FILES['audio_file']['name']));   // Explode file name from dot(.)
        $file_extension = strtolower(end($ext)); // Store extensions in the variable.
        $target_path = $path."/sound/".$_POST["widgetid"].".".$file_extension;     // Declaring Path for uploaded images.
        if (in_array($file_extension, $validextensions)) {

            move_uploaded_file($_FILES['audio_file']['tmp_name'], $target_path);
            $file=$_POST["widgetid"].".".$file_extension;
            if(isset($_POST["splitter"]) && $_POST["splitter"]==1){
                echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
                echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST["widgetid"].'").attr("voice","'.SITE_URL.$_POST["storypath"]."/sound/".$file.'?v='.$rand.'");
                             window.parent.$(".close").click();
                            window.parent.hideLoader();
                           });</script>';
            }else{
                if(isset($_GET["ajax"]) && $_GET["ajax"]==1){
                    $result["status"]=1;
                    $result["sound"]=$file;
                    $result["source"]=SITE_URL.$_POST["storypath"]."/sound/".$file.'?v='.$rand;
                    echo json_encode($result);
                    exit();
                }else{
                    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
                    echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST["widgetid"].'").attr("sound","'.$file.'");
                            window.parent.$("#'.$_POST["widgetid"].'").find("source").attr("src","'.SITE_URL.$_POST["storypath"]."/sound/".$file.'?v='.$rand.'");
                            window.parent.$("#'.$_POST["widgetid"].'").find("audio")[0].load();
                              window.parent.$(".close").click();
                            window.parent.hideLoader();
                           });</script>';
                }

            }

        }else{
            echo $file_extension."1";
            exit();
            echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
            echo '<script>$(document).ready(function(){
                            window.parent.hideLoader();
                           window.parent.showMsg("error","invalid extension");
                           });</script>';
        }
    }else{
        echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
        echo '<script>$(document).ready(function(){
                            window.parent.hideLoader();
                           window.parent.showMsg("error","please chose file");
                           });</script>';
    }
}
function syncupload(){
    $rand=rand(1,999999);
    $path="../".str_replace("platform/","",$_POST["storypath"])."/";
    if(file_exists($_FILES['audio_file']['tmp_name']) && is_uploaded_file($_FILES['audio_file']['tmp_name'])) {
        $validextensions = array("mp3");      // Extensions which are allowed.
        $ext = explode('.', basename($_FILES['audio_file']['name']));   // Explode file name from dot(.)
        $file_extension = strtolower(end($ext)); // Store extensions in the variable.
        $target_path = $path."/sound/".$_POST["widgetid"].".".$file_extension;     // Declaring Path for uploaded images.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['audio_file']['tmp_name'], $target_path);
            $file=$_POST["widgetid"].".".$file_extension;

            if(isset($_GET["ajax"]) && $_GET["ajax"]==1){
                $result["status"]=1;
                $result["sound"]=$file;
                $result["source"]=SITE_URL.$_POST["storypath"]."/sound/".$file.'?v='.$rand;
                echo json_encode($result);
                exit();
            }else{
                echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
                echo '<script>$(document).ready(function(){
                            window.parent.parent.$("#'.$_POST["widgetid"].'").attr("voice","'.SITE_URL.$_POST["storypath"]."/sound/".$file.'?v='.$rand.'");
                             //window.parent.$(".close").click();
                            window.parent.showEditor("'.SITE_URL.$_POST["storypath"]."/sound/".$file.'?v='.$rand.'");
                            //window.parent.hideLoader();
                           });</script>';

            }

        }
    }else{
        echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
        echo '<script>$(document).ready(function(){
                            window.parent.hideLoader();
                           window.parent.showMsg("error","please chose file");
                           });</script>';
    }
}
function videowidget(){
    $rand=rand(1,999999);
    $path="../".str_replace("platform/","",$_POST["storypath"])."/";
    if(file_exists($_FILES['video_file']['tmp_name']) && is_uploaded_file($_FILES['video_file']['tmp_name'])) {
        $validextensions = array("mp4","avi","webm","wmv","mov");      // Extensions which are allowed.
        $ext = explode('.', basename($_FILES['video_file']['name']));   // Explode file name from dot(.)
        $file_extension = strtolower(end($ext)); // Store extensions in the variable.
        $target_path = $path."/sound/".$_POST["widgetid"].".".$file_extension;     // Declaring Path for uploaded images.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['video_file']['tmp_name'], $target_path);
            $file=$_POST["widgetid"].".".$file_extension;

                echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
                echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST["widgetid"].'").attr("video","'.$file.'");
                            window.parent.$("#'.$_POST["widgetid"].'").find("source").attr("src","'.SITE_URL.$_POST["storypath"]."/sound/".$file.'?v='.$rand.'");
                            window.parent.$("#'.$_POST["widgetid"].'").find("video")[0].load();
                              window.parent.$(".close").click();
                            window.parent.hideLoader();
                           });</script>';


        }else{
            echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
            echo '<script>$(document).ready(function(){
                            window.parent.hideLoader();
                             window.parent.showMsg("error","file type is not supported");
                           });</script>';
        }
    }else{
        echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
        echo '<script>$(document).ready(function(){
                            window.parent.hideLoader();
                            window.parent.showMsg("error","please chose file");
                           });</script>';
    }
}
function addpage(){
    if(isset($_POST["storyid"]) && $_POST["storyid"]!="" && isset($_POST["storypath"]) && $_POST["storypath"]!="" ){
        $path="../".str_replace("platform/","",$_POST["storypath"])."/pages/";
        if(!is_dir($path)){
            mkdir($path);
        }
        $page_id=uniqid();
        file_put_contents($path.$page_id.".str",'<div class="story-content-container droppable" id="story-content-container" style="position: relative;width: 100%;height:100%px;background-size: 100% 100% !important;"></div>');
        $JsonPath="../".str_replace("platform/","",$_POST["storypath"])."/pages.json";

        if(is_file($JsonPath)){
            $pages=json_decode(file_get_contents($JsonPath),true);
            $pages[$page_id]=array("bg_sound"=>"","bg_image"=>"","thumb"=>"","page_id"=>$page_id);
        }else{
            $pages=array();
            $pages[$page_id]=array("bg_sound"=>"","bg_image"=>"","thumb"=>"","page_id"=>$page_id);
        }
        file_put_contents($JsonPath,json_encode($pages,true));
        echo json_encode(array("result"=>1,"page_id"=>$page_id));
    }else{
        echo json_encode(array("result"=>0,"msg"=>"missing post data"));
    }
}
function savepage(){
    global $con;
    $sql="UPDATE `story` set cache=cache+1 WHERE storyid=".$_POST['storyid'];
    $con->query($sql);

    if(isset($_POST["storyid"]) && $_POST["storyid"]!="" && isset($_POST["pageid"]) && $_POST["pageid"]!=""  && isset($_POST["storypath"]) && $_POST["storypath"]!="" ){
        $path="../".str_replace("platform/","",$_POST["storypath"])."/pages/";
        if(!is_dir($path)){
            mkdir($path);
        }
        file_put_contents($path.$_POST["pageid"].".str",$_POST["html"]);
        echo json_encode(array("result"=>1));
    }else{
        echo json_encode(array("result"=>0,"msg"=>"missing post data"));
    }
}
function getpage(){
    if(isset($_POST["storyid"]) && $_POST["storyid"]!="" && isset($_POST["pageid"]) && $_POST["pageid"]!=""  && isset($_POST["storypath"]) && $_POST["storypath"]!="" ){
        $path="../".str_replace("platform/","",$_POST["storypath"])."/pages/";
        $html=file_get_contents($path.$_POST["pageid"].".str");
        echo json_encode(array("result"=>1,"html"=>$html));
    }else{
        echo json_encode(array("result"=>0,"msg"=>"missing post data"));
    }
}
function deletepage(){
    if(isset($_POST["storyid"]) && $_POST["storyid"]!="" && isset($_POST["pageid"]) && $_POST["pageid"]!=""  && isset($_POST["storypath"]) && $_POST["storypath"]!="" ){
        $path="../".str_replace("platform/","",$_POST["storypath"])."/pages/".$_POST["pageid"].".str";
        if(is_file($path)){
            unlink($path);
        }
       // echo $path;
        $jsonPath="../".str_replace("platform/","",$_POST["storypath"])."/pages.json";
        $pages=json_decode(file_get_contents($jsonPath),true);
        unset($pages[$_POST["pageid"]]);

       // ksort($pages);

//        $i=0;
//        $path="../".str_replace("platform/","",$_POST["storypath"])."/pages/";
//        $new_arr=array();
//        foreach($pages as $key=>$page){
//            $page_path=$path.$key.".str";
//            if(is_file($page_path)){
//                rename($page_path,$path.$i.".str");
//            }
//            $new_arr[$i]=$page;
//            $i++;
//        }

        file_put_contents($jsonPath,json_encode($pages,true));

        echo json_encode(array("result"=>1,"pages"=>$pages));
    }else{
        echo json_encode(array("result"=>0,"msg"=>"missing post data"));
    }
}
function sortpages(){
    if(isset($_POST["storyid"]) && $_POST["storyid"]!="" && isset($_POST["storypath"]) && $_POST["storypath"]!="" ){
        $path="../".str_replace("platform/","",$_POST["storypath"])."/pages/";
        $jsonPath="../".str_replace("platform/","",$_POST["storypath"])."/pages.json";
        $pages=json_decode(file_get_contents($jsonPath),true);
        $newSort=array();
        foreach($_POST["order"] as $order=>$id){
            $newSort[$id]=$pages[$id];
        }
//        foreach($_POST["order"] as $order=>$id){
//            rename($path.$order.".strc",$path.$order.".str");
//        }
        file_put_contents($jsonPath,json_encode($newSort,true));

//
//        $path="../".str_replace("platform/","",$_POST["storypath"])."/pages/";
//        $new_arr=array();
//        $i=0;
//        foreach($pages as $key=>$page){
//            $page_path=$path.$key.".str";
//            if(is_file($page_path)){
//                rename($page_path,$path.$i.".str");
//            }
//            $new_arr[$i]=$page;
//            $i++;
//        }

        echo json_encode(array("result"=>1));
    }else{
        echo json_encode(array("result"=>0,"msg"=>"missing post data"));
    }
}
function uploadFile($name,$ext,$dir,$multible=false,$dest_name=""){
    if($multible==false){
        $path_parts = pathinfo($_FILES[$name]['name']);
        $extension = strtolower($path_parts['extension']);
        if(in_array($extension,$ext)){
            if($dest_name==""){
                $newName=$_POST[$name.'_id'].".".$extension;
            }else{
                $newName=$dest_name;
            }
            if(move_uploaded_file($_FILES[$name]['tmp_name'], $dir.$newName)){
                return $newName;
            }else{
                return $name."-".$dir.$newName;
            }
        }else{
            return false;
        }
    }
}
?>