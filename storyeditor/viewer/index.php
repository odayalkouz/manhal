<?php
include_once "platform/config.php";
//if($story["seriesid"]==-1 || $story["seriesid"]==0){
    $story_path="platform/stories/".$story["storyid"];
//}else{
//    $story_path="platform/stories/".$story["seriesid"]."/story/".$story["storyid"];
//}
//if($story["awidth"]==0){
//    $story["awidth"]=1024;
//}
//
//if($story["aheight"]==0){
//    $story["aheight"]=768;
//}
if($story["awidth"]>0){
    $width=$story["awidth"];
}else{
    $width=1033;
}
if($story["aheight"]>0){
    $height=$story["aheight"];
}else{
    $height=785;
}
$p=785/$height;
$height=785;
$width=$width*$p;
$settings=json_decode($story["settings"],true);
$cache=2;


if(session_status()==PHP_SESSION_NONE){
    session_start();
}
$userid=-1;
if(isset($_SESSION['user'])){
    $userid=$_SESSION['user']['userid'];
}

$real_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(isset($_GET['scorm']) && $_GET['scorm']=='true'){
    $scorm=true;
}

switch ($story["viewtype"]){
    case 3://slider
        $sql = "INSERT INTO `users_views`(`userid`, `media`, `type`, `date`,`href`) VALUES ($userid,".$story["storyid"].",'Slider',NOW(),'".mysqli_real_escape_string($con,$real_link)."')";
        $con->query($sql);
        include_once "storyeditor/viewer/slider.php";
        break;
    case 1://one page flipping
    case 2://tow page flipping
    $sql = "INSERT INTO `users_views`(`userid`, `media`, `type`, `date`,`href`) VALUES ($userid,".$story["storyid"].",'story',NOW(),'".mysqli_real_escape_string($con,$real_link)."')";
    $con->query($sql);
        include_once "storyeditor/viewer/flipping.php";
        break;
}
?>