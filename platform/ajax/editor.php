<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/7/2016
 * Time: 8:29 AM
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


function updatesound(){
    global $Lang;
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    $title="";
    if(isset($_POST["soundtitle"]) && $_POST["soundtitle"]!=""){
        $title=$_POST["soundtitle"];
    }
    echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['sound_id'].'").find("audio").first().attr("title","'.$title.'");
                           });</script>';

    if(isset($_FILES["sound"]) && !empty($_FILES["sound"])){
        $dir="books/".$_GET['bookid']."/";
        $ext=array("mp3");
        $fileName=uploadFile("sound",$ext,"../".$dir,false);


        if($fileName!==false){
            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['sound_id'].'").find("source").first().attr("src","'.$dir.$fileName.'");
                            window.parent.$("#'.$_POST['sound_id'].'").find("source").first().addClass("jq_multi_file");
                            window.parent.$("#'.$_POST['sound_id'].'").find("source").first().attr("editor","'.$dir.$fileName.'");
                            window.parent. $("#'.$_POST['sound_id'].'").find("source").first().attr("publish","'.$fileName.'");
                            window.parent. $("#'.$_POST['sound_id'].'").find("audio").first()[0].load();
                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>';
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }else{
        echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->PleaseSelectFile."');});</script>";
    }
}
function removebg(){
    if(isset($_POST["img"]) && $_POST["img"]!=""){
        $file="../books/".$_GET['bookid']."/".$_POST["img"];
        if(is_file($file)){
            @unlink($file);
        }
    }

}
function updatequizsound(){
    global $Lang;
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';

    if(isset($_FILES["sound"]) && !empty($_FILES["sound"])){
        $dir="quiz/".$_GET['quizid']."/";
        if(!is_dir("../".$dir)){
            @mkdir("../".$dir);
        }
        $ext=array("mp3");

        $path_parts = pathinfo($_FILES['sound']['name']);
        $extension = strtolower($path_parts['extension']);
        $fileName=false;
        if(in_array($extension,$ext)){
            $newName=$_GET['sound_id'].".".$extension;
            if(move_uploaded_file($_FILES['sound']['tmp_name'],"../".$dir.$newName)){
                $fileName=$newName;
            }else{
                $fileName='sound'."-".$dir.$newName;
            }
        }


        if($fileName!==false){
            echo "<script>console.log(1);</script>";
            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_GET['sound_id'].'").find("source").first().attr("src","'.SITE_URL."platform/".$dir.$fileName.'");
                            window.parent.$("#'.$_GET['sound_id'].'").find("source").first().addClass("jq_multi_file");
                            window.parent.$("#'.$_GET['sound_id'].'").find("source").first().attr("editor","'.SITE_URL."platform/".$dir.$fileName.'");
                            window.parent. $("#'.$_GET['sound_id'].'").find("source").first().attr("publish","'.SITE_URL."platform/".$dir.$fileName.'");
                            window.parent. $("#'.$_GET['sound_id'].'").find("audio").first()[0].load();
                            window.parent.closePopup();
                            window.parent.hideLoader();
                           });</script>';
        }else{
            echo "<script>console.log(0);</script>";
            echo "<script>$(document).ready(function(){window.parent.hideLoader();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }else{
        echo "<script>console.log(2);</script>";
        echo "<script>$(document).ready(function(){window.parent.hideLoader();window.parent.showMsg('error','".$Lang->Error."','".$Lang->PleaseSelectFile."');});</script>";
    }
}
function updatequizasound(){
    global $Lang;
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';

    if(isset($_FILES["asound"]) && !empty($_FILES["asound"])){
        $dir="quiz/".$_GET['quizid']."/";
        if(!is_dir("../".$dir)){
            @mkdir("../".$dir);
        }
        $ext=array("mp3");

        $path_parts = pathinfo($_FILES['asound']['name']);
        $extension = strtolower($path_parts['extension']);
        $fileName=false;
        if(in_array($extension,$ext)){
            $newName=$_GET['sound_id'].".".$extension;
            if(move_uploaded_file($_FILES['asound']['tmp_name'],"../".$dir.$newName)){
                $fileName=$newName;
            }else{
                $fileName='sound'."-".$dir.$newName;
            }
        }
        $file_id="audio_".$_GET['sound_id'];
        $html="<audio class='jq_audio' controls style='display: none;' id='".$file_id."' status='play'><source src='".SITE_URL."platform/".$dir.$fileName."' type='audio/mpeg'></audio>";


        if($fileName!==false){
            echo "<script>console.log(1);</script>";
            echo '<script>$(document).ready(function(){
                            window.parent.$("#question_contents").append("'.$html.'");
                            window.parent.$("#'.$_GET['sound_id'].'").attr("asound","'.$file_id.'");
                            window.parent.$("#'.$_GET['sound_id'].'").addClass("asound");
                            window.parent. $("#'.$file_id.'").first()[0].load();
                            window.parent.closePopup();
                            window.parent.hideLoader();
                           });</script>';
        }else{
            echo "<script>console.log(0);</script>";
            echo "<script>$(document).ready(function(){window.parent.hideLoader();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }else{
        echo "<script>console.log(2);</script>";
        echo "<script>$(document).ready(function(){window.parent.hideLoader();window.parent.showMsg('error','".$Lang->Error."','".$Lang->PleaseSelectFile."');});</script>";
    }
}
function updatequizimage(){
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    global $Lang;
    if(isset($_FILES["image"]) && !empty($_FILES["image"])){
        $dir="quiz/".$_GET['quizid']."/";
        if(!is_dir("../".$dir)){
            @mkdir("../".$dir);
        }
        $ext=array("jpg","jpeg","png","gif","bmp");

        $path_parts = pathinfo($_FILES['image']['name']);
        $extension = strtolower($path_parts['extension']);
        $fileName=false;
        if(in_array($extension,$ext)){
            $newName=$_GET['image_id'].".".$extension;
            if(move_uploaded_file($_FILES['image']['tmp_name'],"../".$dir.$newName)){
                $fileName=$newName;
            }else{
                $fileName='image'."-".$dir.$newName;
            }
        }

        $rand=rand();

        if($fileName!==false){
            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_GET['image_id'].'").find("img").first().attr("src","'.SITE_URL."platform/".$dir.$fileName.'?'.$rand.'");
                            window.parent.$("#'.$_GET['image_id'].'").find("img").first().addClass("jq_multi_file");
                            window.parent.$("#'.$_GET['image_id'].'").find("img").first().attr("editor","'.SITE_URL."platform/".$dir.$fileName.'?'.$rand.'");
                            window.parent.$("#'.$_GET['image_id'].'").find("img").first().attr("publish","'.SITE_URL."platform/".$dir.$fileName.'?'.$rand.'");
                            window.parent.$("#image_form")[0].reset();
                            window.parent.$("#lblimage_txt").html("");
                            window.parent.closePopup();
                            window.parent.hideLoader();
                           });</script>';
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoader();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }else{
        echo "<script>$(document).ready(function(){window.parent.hideLoader();window.parent.showMsg('error','".$Lang->Error."','".$Lang->PleaseSelectFile."');});</script>";
    }
}
function updatebgsound(){
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    global $Lang;
    if(isset($_FILES["bgsound"]) && !empty($_FILES["bgsound"])){
        $dir="quiz/".$_GET['quizid']."/";
        if(!is_dir("../".$dir)){
            @mkdir("../".$dir);
        }
        $ext=array("mp3");

        $path_parts = pathinfo($_FILES['bgsound']['name']);
        $extension = strtolower($path_parts['extension']);
        $fileName=false;
        if(in_array($extension,$ext)){
            $newName="bgsound".$_GET['widget_id'].".".$extension;
            if(move_uploaded_file($_FILES['bgsound']['tmp_name'],"../".$dir.$newName)){
                $fileName=$newName;
            }
        }

        $rand=rand();

        if($fileName!==false){
            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_GET['widget_id'].'").attr("bgsound","'.SITE_URL."platform/".$dir.$fileName.'?'.$rand.'");
                            window.parent.$("#'.$_GET['widget_id'].'").addClass("jq_bgsound");                    
                            window.parent.$("#sound_formb")[0].reset();
                            window.parent.closePopup();
                            window.parent.hideLoader();
                           });</script>';
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoader();window.parent.showMsg('error1','1".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }else{
        echo "<script>$(document).ready(function(){window.parent.hideLoader();window.parent.showMsg('error2','2".$Lang->Error."','".$Lang->PleaseSelectFile."');});</script>";
    }
}
function updatequizimagec(){
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    global $Lang;
    if(isset($_FILES["image"]) && !empty($_FILES["image"])){
        $dir="quiz/".$_GET['quizid']."/";
        if(!is_dir("../".$dir)){
            @mkdir("../".$dir);
        }
        $ext=array("jpg","jpeg","png","gif","bmp");

        $path_parts = pathinfo($_FILES['image']['name']);
        $extension = strtolower($path_parts['extension']);
        $fileName=false;
        if(in_array($extension,$ext)){
            $newName=$_GET['image_id'].".".$extension;
            if(move_uploaded_file($_FILES['image']['tmp_name'],"../".$dir.$newName)){
                $fileName=$newName;
            }else{
                $fileName='image'."-".$dir.$newName;
            }
        }

        $rand=rand();

        if($fileName!==false){
            echo '<script>$(document).ready(function(){
                            window.parent.$("#map_image").attr("src","'.SITE_URL."platform/".$dir.$fileName.'?'.$rand.'");
                            window.parent.closePopup();
                            window.parent.hideLoader();
                           });</script>';
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoader();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }else{
        echo "<script>$(document).ready(function(){window.parent.hideLoader();window.parent.showMsg('error','".$Lang->Error."','".$Lang->PleaseSelectFile."');});</script>";
    }
}
function updatetrace(){
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    global $Lang;
    $picture="";
    $thumb="";
    $title="";
    $word="";
    if(isset($_POST['isPopup']) && $_POST['isPopup']==1) {
        if(!is_dir("../books/".$_GET['bookid']."/".$_GET['pageid'])){
            @mkdir("../books/".$_GET['bookid']."/".$_GET['pageid']);
        }
        $picture="";
        if(isset($_FILES["tracepicture"]) && !empty($_FILES["tracepicture"])) {
            $dir = "books/" . $_GET['bookid'] . "/".$_GET['pageid']."/";
            $ext = array("jpg", "jpeg", "png", "gif", "bmp");
            $picture = $_GET['pageid']."/".uploadFile("tracepicture", $ext, "../" . $dir, false);
        }
        $thumb="";
        if(isset($_FILES["tracethump"]) && !empty($_FILES["tracethump"])) {
            $dir = "books/" . $_GET['bookid'] . "/".$_GET['pageid']."/";
            $ext = array("jpg", "jpeg", "png", "gif", "bmp");
            $thumb = $_GET['pageid']."/".uploadFile("tracethump", $ext, "../" . $dir, false);
        }
        $title="";
        if(isset($_POST['trace_title']) && $_POST['trace_title']!="") {
            $title=$_POST['trace_title'];
        }
        $word="";
        if(isset($_POST['trace_word']) && $_POST['trace_word']!="") {
            $word=$_POST['trace_word'];
        }
        echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['widget_id'].'").find(".doaction").first().attr("data-word","'.$word.'");
                            window.parent.$("#'.$_POST['widget_id'].'").find(".doaction").first().attr("title","'.$title.'");
                            window.parent.$("#'.$_POST['widget_id'].'").find(".doaction").first().attr("data-thumb","'.$thumb.'");
                            window.parent.$("#'.$_POST['widget_id'].'").find(".doaction").first().attr("data-value","'.$picture.'");
                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>';
    } else{
        echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->PleaseSelectFile."');});</script>";
    }
}
function updateimage(){
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    $title="";
    if(isset($_POST["imagetitle"]) && $_POST["imagetitle"]!=""){
        $title=$_POST["imagetitle"];
    }
    echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['image_id'].'").find("img").first().attr("title","'.$title.'");
                           });</script>';

    global $Lang;
    if(isset($_FILES["image"]) && !empty($_FILES["image"])){
        $dir="books/".$_GET['bookid']."/";
        $ext=array("jpg","jpeg","png","gif","bmp");
        $fileName=uploadFile("image",$ext,"../".$dir,false);
$rand=rand();

        if($fileName!==false){
            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['image_id'].'").find("img").first().attr("src","'.$dir.$fileName.'?'.$rand.'");
                            window.parent.$("#'.$_POST['image_id'].'").find("img").first().addClass("jq_multi_file");
                            window.parent.$("#'.$_POST['image_id'].'").find("img").first().attr("editor","'.$dir.$fileName.'");
                            window.parent. $("#'.$_POST['image_id'].'").find("img").first().attr("publish","'.$fileName.'");
                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>';
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }else{
        echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->PleaseSelectFile."');});</script>";
    }
}
function updateaimage(){
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    $title="";
    if(isset($_POST["aimagetitle"]) && $_POST["aimagetitle"]!=""){
        $title=$_POST["aimagetitle"];
    }
    echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['aimage_id'].'").find(".doaction").first().attr("title","'.$title.'");
                           });</script>';
    global $Lang;

   // uploadIcon("aimage");
    if(isset($_FILES["aimage"]) && !empty($_FILES["aimage"])){
        $dir="books/".$_GET['bookid']."/";
        $ext=array("jpg","jpeg","png","gif","bmp");
        $fileName=uploadFile("aimage",$ext,"../".$dir,false);



        if($fileName!==false){
            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['aimage_id'].'").find(".doaction").first().attr("data_src","'.$dir.$fileName.'");
                            window.parent.$("#'.$_POST['aimage_id'].'").find(".doaction").first().addClass("jq_multi_file");
                            window.parent.$("#'.$_POST['aimage_id'].'").find(".doaction").first().attr("editor","'.$dir.$fileName.'");
                            window.parent. $("#'.$_POST['aimage_id'].'").find(".doaction").first().attr("publish","'.$fileName.'");
                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>';
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }
}
function updateaurlimage(){
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    $title="";
    if(isset($_POST["aimagetitle"]) && $_POST["aimagetitle"]!=""){
        $title=$_POST["aimagetitle"];
    }
    $url="";
    if(isset($_POST["aurlvalue"]) && $_POST["aurlvalue"]!=""){
        $url=$_POST["aurlvalue"];
    }
    echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['aimage_id'].'").find(".doaction").first().attr("title","'.$title.'");
                            window.parent.$("#'.$_POST['aimage_id'].'").find(".doaction").first().attr("data_src","'.$url.'");
                           });</script>';
    global $Lang;

   // uploadIcon("aimage");
    if(isset($_FILES["aimage"]) && !empty($_FILES["aimage"])){
        $dir="books/".$_GET['bookid']."/";
        $ext=array("jpg","jpeg","png","gif","bmp");
        $fileName=uploadFile("aimage",$ext,"../".$dir,false);



        if($fileName!==false){
            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['aimage_id'].'").find("img").first().attr("data_src","'.$dir.$fileName.'");
                            window.parent.$("#'.$_POST['aimage_id'].'").find("img").first().addClass("jq_multi_file");
                            window.parent.$("#'.$_POST['aimage_id'].'").find("img").first().attr("editor","'.$dir.$fileName.'");
                            window.parent. $("#'.$_POST['aimage_id'].'").find("img").first().attr("publish","'.$fileName.'");
                            window.parent. $("#'.$_POST['aimage_id'].'").find("img").first().attr("src","'.$dir.$fileName.'");
                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>';
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }
}
function updateimagelink(){
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    $title="";
    if(isset($_POST["aimagetitle"]) && $_POST["aimagetitle"]!=""){
        $title=$_POST["aimagetitle"];
    }
    $url="";
    if(isset($_POST["aurlvalue"]) && $_POST["aurlvalue"]!=""){
        $url=$_POST["aurlvalue"];
    }
    echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['aimage_id'].'").find(".doaction").first().attr("title","'.$title.'");
                            window.parent.$("#'.$_POST['aimage_id'].'").find(".doaction").first().attr("href","'.$url.'");
                           });</script>';
    global $Lang;

   // uploadIcon("aimage");
    if(isset($_FILES["aimage"]) && !empty($_FILES["aimage"])){
        $dir="books/".$_GET['bookid']."/";
        $ext=array("jpg","jpeg","png","gif","bmp");
        $fileName=uploadFile("aimage",$ext,"../".$dir,false);



        if($fileName!==false){
            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['aimage_id'].'").find("img").first().attr("data_src","'.$dir.$fileName.'");
                            window.parent.$("#'.$_POST['aimage_id'].'").find("img").first().addClass("jq_multi_file");
                            window.parent.$("#'.$_POST['aimage_id'].'").find("img").first().attr("editor","'.$dir.$fileName.'");
                            window.parent. $("#'.$_POST['aimage_id'].'").find("img").first().attr("publish","'.$fileName.'");
                            window.parent. $("#'.$_POST['aimage_id'].'").find("img").first().attr("src","'.$dir.$fileName.'");
                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>';
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }
}
function updatedouknow(){
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    $title="";
    if(isset($_POST["doyouknowtitle"]) && $_POST["doyouknowtitle"]!=""){
        $title=$_POST["doyouknowtitle"];
    }
    echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['douknowimage_id'].'").find(".doaction").first().attr("title","'.$title.'");
                           });</script>';
    $desc="";
//    if(isset($_POST["doyouknowdesc"]) && $_POST["doyouknowdesc"]!=""){
//        $desc=$_POST["doyouknowdesc"];
//    }
//    echo '<script>$(document).ready(function(){
//                            window.parent.$("#'.$_POST['douknowimage_id'].'").find(".enr-data").first().html("'.$desc.'");
//                           });</script>';
    global $Lang;

   // uploadIcon("aimage");
    if(file_exists($_FILES['douknowimage']['tmp_name']) && is_uploaded_file($_FILES['douknowimage']['tmp_name'])) {
   // if(isset($_FILES["douknowimage"]) && !empty($_FILES["douknowimage"])){
        $dir="books/".$_GET['bookid']."/";
        $ext=array("jpg","jpeg","png","gif","bmp");
        $fileName=uploadFile("douknowimage",$ext,"../".$dir,false);



        if($fileName!==false){
            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['douknowimage_id'].'").find(".doaction").first().attr("data_src","'.$dir.$fileName.'");
                            window.parent.$("#'.$_POST['douknowimage_id'].'").find(".doaction").first().addClass("jq_multi_file");
                            window.parent.$("#'.$_POST['douknowimage_id'].'").find(".doaction").first().attr("editor","'.$dir.$fileName.'");
                            window.parent. $("#'.$_POST['douknowimage_id'].'").find(".doaction").first().attr("publish","'.$fileName.'");
                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>';
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }else{
        echo '<script>$(document).ready(function(){

                            window.parent.$("#'.$_POST['douknowimage_id'].'").find(".doaction").first().addClass("jq_multi_file");

                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>';
    }
}
function updateaurl(){
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    $title="";
    if(isset($_POST["aurltitle"]) && $_POST["aurltitle"]!=""){
        $title=$_POST["aurltitle"];
    }
    echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['aurl_id'].'").find(".doaction").first().attr("title","'.$title.'");
                           });</script>';
    global $Lang;

   // uploadIcon("aurl");
    if(isset($_POST['aurlvalue']) && $_POST['aurlvalue']!=""){
        echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['aurl_id'].'").find(".doaction").first().attr("data_src","'.$_POST['aurlvalue'].'");
                            $("#action_containerb").html("");
                            $("#popup_action").fadeOut();
                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>';

    }else{
        echo '<script>$(document).ready(function(){
                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>';
    }
}
function updatetextlink(){
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    $title="";
    if(isset($_POST["aurltitle"]) && $_POST["aurltitle"]!=""){
        $title=$_POST["aurltitle"];
    }
    echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['aurl_id'].'").find(".doaction").first().attr("title","'.$title.'");
                           });</script>';
    global $Lang;

   // uploadIcon("aurl");
    if(isset($_POST['aurlvalue']) && $_POST['aurlvalue']!=""){
        echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['aurl_id'].'").find(".doaction").first().attr("href","'.$_POST['aurlvalue'].'");
                            $("#action_containerb").html("");
                            $("#popup_action").fadeOut();
                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>';

    }else{
        echo '<script>$(document).ready(function(){
                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>';
    }
}
function updateavideo(){
    global $Lang;
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    $title="";
    if(isset($_POST["avideotitle"]) && $_POST["avideotitle"]!=""){
        $title=$_POST["avideotitle"];
    }
    echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['avideo_id'].'").find(".doaction").first().attr("title","'.$title.'");
                           });</script>';
    //uploadIcon("avideo");
    if(isset($_POST['ayoutube']) && $_POST['ayoutube']!=""){
        echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['avideo_id'].'").find(".doaction").first().attr("data_src","'.$_POST['ayoutube'].'");
                            $("#action_containerb").html("");
                            $("#popup_action").fadeOut();
                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>';

    }else{
        echo '<script>$(document).ready(function(){
                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>';
    }
}
function updateasound(){
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    global $Lang;

    $title="";
    if(isset($_POST["soundtitle"]) && $_POST["soundtitle"]!=""){
        $title=$_POST["soundtitle"];
    }
    echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['asound_id'].'").find(".doaction").first().attr("title","'.$title.'");
                           });</script>';


    if(isset($_FILES["asound"]) && !empty($_FILES["asound"])){
        $dir="books/".$_GET['bookid']."/";
        $ext=array("mp3");
        $fileName=uploadFile("asound",$ext,"../".$dir,false);
        if($fileName!==false){
            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['asound_id'].'").find(".doaction").first().attr("data_src","'.$dir.$fileName.'");
                            window.parent.$("#'.$_POST['asound_id'].'").find(".doaction").first().addClass("jq_multi_file");
                            window.parent.$("#'.$_POST['asound_id'].'").find(".doaction").first().attr("editor","'.$dir.$fileName.'");
                            window.parent.$("#'.$_POST['asound_id'].'").find(".doaction").first().attr("publish","'.$fileName.'");
                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>';
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }
}
function updateasoundhighlight(){
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    global $Lang;

    $title="";
    if(isset($_POST["soundtitle"]) && $_POST["soundtitle"]!=""){
        $title=$_POST["soundtitle"];
    }

    if(isset($_FILES["asound"]) && !empty($_FILES["asound"])){
        $dir="books/".$_GET['bookid']."/";
        $ext=array("mp3");
        $fileName=uploadFile("asound",$ext,"../".$dir,false);
        if($fileName!==false){
            echo '<script>$(document).ready(function(){
                            window.parent.parent.$("#'.$_POST['asound_id'].'").find(".doaction").first().attr("data_src","'.$dir.$fileName.'");
                            window.parent.parent.$("#'.$_POST['asound_id'].'").find(".doaction").first().addClass("jq_multi_file");
                            window.parent.parent.$("#'.$_POST['asound_id'].'").find(".doaction").first().attr("editor","'.$dir.$fileName.'");
                            window.parent.parent.$("#'.$_POST['asound_id'].'").find(".doaction").first().attr("publish","'.$fileName.'");
                            window.parent.parent.closePopup();
                            window.parent.parent.hideLoading();
                           });</script>';
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }
}
function uploadFile($name,$ext,$dir,$multible=false){
    if($multible==false){
        $path_parts = pathinfo($_FILES[$name]['name']);
        $extension = strtolower($path_parts['extension']);
        if(in_array($extension,$ext)){
            $newName=$_POST[$name.'_id'].".".$extension;
            if(move_uploaded_file($_FILES[$name]['tmp_name'], $dir.$newName)){
                return $newName;
            }else{
                return $name."-".$dir.$newName;
                return false;
            }
        }else{
            return false;
        }
    }
}
function updateapage(){
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';

    global $Lang;
    global $con;
    if(isset($_FILES["bg"]) && !empty($_FILES["bg"])) {
        $dir = "../books/" . $_POST['bookid'] . "/";
        $ext = array("jpg","jpeg","gif","png","bmp");
        $path_parts = pathinfo($_FILES['bg']['name']);
        $extension = strtolower($path_parts['extension']);
        if (in_array($extension, $ext)) {
            if (move_uploaded_file($_FILES['bg']['tmp_name'], $dir . $_POST['pageid'] . ".".$extension)) {
                echo '<script>$(document).ready(function(){
                            window.parent.$(".page_container").attr("editor","url(books/' . $_POST['bookid'] . '/' . $_POST['pageid'] . '.'.$extension.'?' . uniqid() . ') no-repeat");
                            window.parent.$(".page_container").attr("publish","'.$_POST['pageid'].'.'.$extension.'");
                           });</script>';
            }else{
            }
        }else{
        }
    }else{
    }

    if(isset($_FILES["negativebg"]) && !empty($_FILES["negativebg"])) {
        $dir = "../books/".$_POST['bookid']."/".$_POST['pageid']."/";
        if(!is_dir()){
            @mkdir($dir);
        }

        $ext = array("jpg","jpeg","gif","png","bmp");
        $path_parts = pathinfo($_FILES['negativebg']['name']);
        $extension = strtolower($path_parts['extension']);
        if (in_array($extension, $ext)) {
            if (move_uploaded_file($_FILES['negativebg']['tmp_name'], $dir . "negative.".$extension)) {
                $n='<div class="negative  negative-container" style="background: url() no-repeat;"></div>';
                echo '<script>$(document).ready(function(){
                            if(window.parent.$(".negative")[0]==undefined){
                                window.parent.$(".page").append('."'".$n."'".');
                            }
                                window.parent.$(".negative").css("background","url(books/' . $_POST['bookid'] . '/' . $_POST['pageid'] . '/negative.'.$extension.'?' . uniqid() . ') no-repeat");
                           });</script>';
            }else{
            }
        }else{
        }
    }else{
    }

    if(isset($_POST['isindex']) && $_POST['isindex']==1){
        $isIndex=1;
    }else{
        $isIndex=0;
    }
        $sql="UPDATE `pages` SET `title`='".mysqli_real_escape_string($con,$_POST['title'])."',`subtitle`='".mysqli_real_escape_string($con,$_POST['subtitle'])."',`height`=".$_POST['height'].",`width`=".$_POST['width'].", `is_index`=$isIndex WHERE `bookid`=".$_POST['bookid']." AND `pageid`=".$_POST['pageid'];
        $con->query($sql);

            echo '<script>$(document).ready(function(){
                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>';
}
function deletepage(){
    global $con;
    if(canEdit($_GET['bookid'])){
        $sql="DELETE FROM `pages` WHERE `pageid`=".$_GET['pageid']." AND `bookid`=".$_GET['bookid'];
        $con->query($sql);
    }
}
function savepage(){
    global $con;
    if(canEdit($_GET['bookid']) && $_POST['contents']!=''){
        $sql="UPDATE `pages` SET `html`='".mysqli_real_escape_string($con,$_POST['contents'])."' WHERE `pageid`=".$_GET['pageid']." AND `bookid`=".$_GET['bookid'];
        $con->query($sql);
    }
}
//start khalid [000001-7-9-2016]
function publishstory(){
    global $con;
    $sql = "SELECT * FROM `storypages` WHERE `idstory`=" . $_GET['storyid'] . " ORDER BY `sort` ASC";
    $result = $con->query($sql);
    $dir = "../stories/".$_GET['seriesid']."/story/".$_GET['storyid']."/publish";
    if(is_dir($dir)){

    }
    deleteDirectory($dir);
    @mkdir($dir);
    @mkdir($dir.'/images');
    @mkdir($dir.'/sound');
    @mkdir($dir.'/js');

    while($row=mysqli_fetch_assoc($result)){
        file_put_contents($dir."/images/".$row['sort'].'.jpg',file_get_contents("../stories/".$_GET['seriesid']."/story/".$_GET['storyid'].'/'."images/".$row['id'].".jpg"));
        file_put_contents($dir."/sound/".$row['sort'].'.mp3',file_get_contents("../stories/".$_GET['seriesid']."/story/".$_GET['storyid'].'/'."sound/".$row['id'].".mp3"));
    }
    file_put_contents($dir."/sound/".'title.mp3',file_get_contents("../stories/".$_GET['seriesid']."/story/".$_GET['storyid'].'/'."sound/"."title.mp3"));
    file_put_contents($dir."/sound/".'childsound.mp3',file_get_contents("../stories/".$_GET['seriesid']."/story/".$_GET['storyid'].'/'."sound/"."childsound.mp3"));
}
function publishAllbooks(){
    global $con;
    $_GET['view']=0;
    $limit="";
    if(isset($_GET["step"])){
        $begin=($_GET["step"]*10)+1;
        $limit="LIMIT ".$begin.",10";
    }
    $sql="SELECT * FROM `books` where `booktype`>1 ".$limit;
    $result=$con->query($sql);
    while($book=mysqli_fetch_assoc($result)){
        $_GET['bookid']=$book["bookid"];
        echo "<br>publish book ". $_GET['bookid'];
            publish();
    }
    echo "<br>done";
}
function publish(){
    global $con;
    $sql = "SELECT `books`.*,`categories`.* FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`bookid`=".$_GET['bookid'];
    $result=$con->query($sql);
    $book=mysqli_fetch_assoc($result);
    if($book['booktype']<2){
        return false;
    }

    $sql="SELECT * FROM `pages` WHERE `bookid`=".$_GET['bookid']." ORDER BY `page_sort` ASC";
    $result=$con->query($sql);
    if($book["language"]=="Ar"){
        copyDirectory("../books/temp-ar/files","../books/".$_GET['bookid']);
        $pagesData=file_get_contents("../books/temp-ar/files/js/bookbrowser.js");
    }else{
        copyDirectory("../books/temp/files","../books/".$_GET['bookid']);
        $pagesData=file_get_contents("../books/temp/files/js/bookbrowser.js");
//        if((int)$_GET['bookid']==700){
//            $pagesData=file_get_contents("../books/bookbrowser.js");
//        }
    }

    if(){
        copyDirectory("../books/temp/together","../books/".$_GET['bookid']);
    }

    $searchData=file_get_contents("../books/data.js");

    if($book["width"]>980){
        $bookSize="width";
    }else{
        $bookSize="height";
    }

    $xml= new DOMDocument("1.0","UTF-8");
    $xml->loadXML(file_get_contents("../books/temp/book.xml"));

    //$xmlpages=$xml->getElementsByTagName("bookdata")[0];
    $xmlpages=$xml->getElementsByTagName("bookdata")->item(0);
    //$xmlpages=$xml->getElementsByTagName("bookdata");

    //$xmlBook=$xml->getElementsByTagName("bookbrowser")[0];
    $xmlBook=$xml->getElementsByTagName("bookbrowser")->item(0);
    //$xmlBook=$xml->getElementsByTagName("bookbrowser");

    $page_number=0;
    $pages="";
    while($page=mysqli_fetch_assoc($result)){
        $page_name="p".str_pad($page_number, 4, '0', STR_PAD_LEFT);
        $pages.=$page_name."@@//@@";


        $data_value=str_replace("\\","&#92;",str_replace("<br>","",str_replace("'","&apos;",removeHarakat(strip_tags(str_replace(">","> ",$page_name))))));
        $cdata_pageName=$xmlpages->ownerDocument->createCDATASection($data_value);

        $data_value=str_replace("\\","&#92;",str_replace("<br>","",removeHarakat(strip_tags(str_replace(">","> ",$page['title'])))));
        $cdata_pageTitle=$xmlpages->ownerDocument->createCDATASection($data_value);

        $data_value=str_replace("\\","&#92;",str_replace("'","&apos;",removeHarakat(strip_tags(str_replace(">","> ",$page['html'])))));
        $cdata_pageContents=$xmlpages->ownerDocument->createCDATASection($data_value);

        $pageName=$xml->createElement("pagename");
        $pageName->appendChild($cdata_pageName);

        $pageTitle=$xml->createElement("pagetitle");
        $pageTitle->appendChild($cdata_pageTitle);

        $pageData=$xml->createElement("pagedata");
        $pageData->appendChild($cdata_pageContents);

        $newPage=$xml->createElement("pagesearch");
        $newPage->appendChild($pageName);
        $newPage->appendChild($pageTitle);
        $newPage->appendChild($pageData);



        if($page['is_index']==1){
            $index=$xml->createElement("index");
            $index->appendChild($pageName);
            $xmlBook->appendChild($index);
        }
        $tempData=str_replace("#daralmanhal_page_contents#",$page['html'],file_get_contents("../books/temp/page.html"));
        file_put_contents("../books/".$_GET['bookid']."/".$page_name.".html",$tempData);
        if(is_file("../books/".$_GET['bookid']."/".$page['pageid']."/negative.jpg")){
            resize_image("../books/".$_GET['bookid']."/".$page['pageid']."/negative.jpg",115,140,"../books/".$_GET['bookid']."/".$page_name."_thumb.jpg");
        }

        //for Timeline
        $doc = new DOMDocument("1.0","UTF-8");
        @$doc->loadHTML(mb_convert_encoding($tempData, 'HTML-ENTITIES', 'UTF-8'));
        $anchors=$doc->getElementsByTagName("a");
        foreach($anchors as $anchor){
            if(strpos($anchor->getAttribute('class'),"doaction")!==false){
                $Enrichment=$xml->createElement("enrichment");

                foreach ($anchor->attributes as $attr) {
                    $name = $attr->nodeName;
                    $value=str_replace("'","&apos;",$attr->nodeValue);
                    $Etitle = $xml->createAttribute($name);
                    $Etitle->value = $value;
                    $Enrichment->appendChild($Etitle);
                }

//                $Etitle = $xml->createAttribute('title');
//                $Etitle->value = $anchor->getAttribute('title');
//                $Enrichment->appendChild($Etitle);
//
//                $Etype = $xml->createAttribute('type');
//                $Etype->value = $anchor->getAttribute('actiontype');
//                $Enrichment->appendChild($Etype);
//
//                $Edata = $xml->createAttribute('data_src');
//                $Edata->value = $anchor->getAttribute('data_src');
//                $Enrichment->appendChild($Edata);

                $newPage->appendChild($Enrichment);
            }
        }
        $xmlpages->appendChild($newPage);

        $page_number++;
    }
    $cdatePages=$xmlpages->ownerDocument->createCDATASection($pages);
    $pages_names=$xml->createElement("pages");
    $pages_names->appendChild($cdatePages);
    $xmlBook->appendChild($pages_names);

    //$sql="SELECT * FROM `books` WHERE `bookid`=".$_GET['bookid'];


    $cdata_width=$xmlpages->ownerDocument->createCDATASection($book['width']);
    $book_width=$xml->createElement("width");
    $book_width->appendChild($cdata_width);
    $xmlBook->appendChild($book_width);

    $cdata_height=$xmlpages->ownerDocument->createCDATASection($book['height']);
    $book_height=$xml->createElement("height");
    $book_height->appendChild($cdata_height);
    $xmlBook->appendChild($book_height);

    $cdata_color=$xmlpages->ownerDocument->createCDATASection($book['color']);
    $book_color=$xml->createElement("color");
    $book_color->appendChild($cdata_color);
    $xmlBook->appendChild($book_color);

    $cdata_title=$xmlpages->ownerDocument->createCDATASection(str_replace("'","&apos;",$book['name']));
    $book_title=$xml->createElement("booktitle");
    $book_title->appendChild($cdata_title);
    $xmlBook->appendChild($book_title);

    $cdata_title=$xmlpages->ownerDocument->createCDATASection($book['bookid']);
    $book_id=$xml->createElement("bookid");
    $book_id->appendChild($cdata_title);
    $xmlBook->appendChild($book_id);




    $sql="SELECT * FROM `units_lessons` WHERE `bookid`=".$_GET['bookid']." AND `type`='unit'";
    $result=$con->query($sql);
    $xmlUnits=$xml->getElementsByTagName("units")->item(0);
    while($unit=mysqli_fetch_assoc($result)){
        $new_unit=$xml->createElement("unit");

        $cdata_unitname=$xmlUnits->ownerDocument->createCDATASection(str_replace("<br>","",str_replace("'","&apos;",removeHarakat(strip_tags(str_replace(">","> ",$unit['title']))))));
        $new_unitname=$xml->createElement("unitname");
        $new_unitname->appendChild($cdata_unitname);
        $new_unit->appendChild($new_unitname);

        $cdata_unitnumber=$xmlUnits->ownerDocument->createCDATASection($unit['pageid']);
        $new_unitnumber=$xml->createElement("pagenumber");
        $new_unitnumber->appendChild($cdata_unitnumber);
        $new_unit->appendChild($new_unitnumber);

        $lessons=$xml->createElement("lessons");
        $sql_lessons="SELECT * FROM `units_lessons` WHERE `bookid`=".$_GET['bookid']." AND `type`='lesson' AND unitid=".$unit["ulid"];
        $result_lessons=$con->query($sql_lessons);
        while($lesson=mysqli_fetch_assoc($result_lessons)){
            $new_lesson=$xml->createElement("lesson");

            $cdata_lessonname=$xmlUnits->ownerDocument->createCDATASection(str_replace("<br>","",str_replace("'","&apos;",removeHarakat(strip_tags(str_replace(">","> ",$lesson['title']))))));
            $new_lessonname=$xml->createElement("lessonname");
            $new_lessonname->appendChild($cdata_lessonname);
            $new_lesson->appendChild($new_lessonname);

            $cdata_lessonnumber=$xmlUnits->ownerDocument->createCDATASection($lesson['pageid']);
            $new_lessonnumber=$xml->createElement("pagenumber");
            $new_lessonnumber->appendChild($cdata_lessonnumber);
            $new_lesson->appendChild($new_lessonnumber);

            $lessons->appendChild($new_lesson);
        }
        $new_unit->appendChild($lessons);
        $xmlUnits->appendChild($new_unit);
    }










    $xmlData=$xml->saveXML();

    $xmlData=str_replace("\n","",$xmlData);
    $xmlData=str_replace("\r","",$xmlData);
    $xmlData=str_replace("'","&quot;",$xmlData);
    $pagesData=str_replace("#daralmanhal_xml_data#",$xmlData,$pagesData);
    $searchData=str_replace("#daralmanhal_xml_data#",$xmlData,$searchData);//for new viewer 1-12-2019 by Hussam
    $pagesData=str_replace("#manhal#booksize#",$bookSize,$pagesData);
    file_put_contents("../books/".$_GET['bookid']."/js/bookbrowser.js",$pagesData);
    file_put_contents("../books/".$_GET['bookid']."/js/data.js",$searchData);//for new viewer 1-12-2019 by Hussam

    $index=file_get_contents("../books/".$_GET['bookid']."/index.html");
    $index=str_replace("@manhal@meta@title@",$book['name'],$index);
    $index=str_replace("@manhal@meta@booktype@","كتاب الطالب",$index);
    $index=str_replace("@manhal@meta@author@",$book['author_'.strtolower($book['language'])],$index);
    $arr=explode(",",$book['author_'.strtolower($book['language'])]);
    $author_html="";
    foreach($arr as $author){
        $author_html.='<div class="text-data-a floating-right">'.$author.'</div>';
    }
    $index=str_replace("@manhal@author@html@",$author_html,$index);
    $index=str_replace("@manhal@publish@year@",$book['year'],$index);

    if($book['language']=="Ar"){
        $index=str_replace("@manhal@book@languag@","اللغة العربية",$index);
    }elseif($book['language']=="En"){
        $index=str_replace("@manhal@book@languag@","English",$index);
    }else{
        $index=str_replace("@manhal@book@languag@","French",$index);
    }

    $index=str_replace("@manhal@meta@desc@",$book['name'].",Dar Almanhal E-book,E-Book,Online Book,كتاب الكتروني,كتب الكترونية,دار المنهل",$index);
    $index=str_replace("@manhal@meta@Keywords@",$book['name'].",Dar Almanhal E-book,E-Book,Online Book,كتاب الكتروني,كتب الكترونية,دار المنهل",$index);
    $index=str_replace("@manhal@meta@thumb@",WEBSITE_URL."books/".$book['bookid']."/cover.jpg",$index);
    $index=str_replace("@manhal@meta@url@",WEBSITE_URL."/platform/books/".$book['bookid']."/index.html",$index);
    $index=str_replace("@manhal@book@url@",WEBSITE_URL.strtolower($book["language"])."/books/".$book['bookid']."/".str_replace(" ","-", $book['title_' . strtolower($book['language'])]),$index);
    $index=str_replace("@manhal@meta@category@", $book['name_' . strtolower($book['language'])],$index);
    file_put_contents("../books/".$_GET['bookid']."/index.html",$index);


    if(isset($_GET['view']) && $_GET['view']==1){
        $page_number--;
        header("location:../books/".$_GET['bookid']."/index.html#page=".$page_number);
        exit();
    }else{
    }
}
function uploadIcon($widget){
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    global $Lang;
    //for icon Start
    if(isset($_FILES["iconf"]) && !empty($_FILES["iconf"])){
        $dir="books/".$_GET['bookid']."/";
        $ext=array("jpg","jpeg","png","gif","bmp");
        $fileName=uploadFile("iconf",$ext,"../".$dir,false);

        if($fileName!==false){
            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST[$widget.'_id'].'").find(".aicon ").first().attr("data_src","'.$dir.$fileName.'");
                            window.parent.$("#'.$_POST[$widget.'_id'].'").find(".aicon ").first().addClass("jq_multi_file");
                            window.parent.$("#'.$_POST[$widget.'_id'].'").find(".aicon ").first().attr("editor","'.$dir.$fileName.'");
                            window.parent.$("#'.$_POST[$widget.'_id'].'").find(".aicon ").first().attr("publish","'.$fileName.'");
                            window.parent.$("#'.$_POST[$widget.'_id'].'").find(".aicon ").first().attr("src","'.$dir.$fileName.'");
                           });</script>';
        }
    }
//for icon End
}
function base64_to_jpeg($base64_string, $output_file) {
    file_put_contents("res.txt",$base64_string);
    $img = str_replace('data:image/png;base64,', '', $base64_string);
    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);
   file_put_contents($output_file, $data);
}
//For Quiz
function quiz_updatesound(){
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    global $Lang;
    if(isset($_FILES["sound"]) && !empty($_FILES["sound"])){
        $dir="quiz/".$_GET['quizid']."/";
        $ext=array("mp3");
        $fileName=uploadFile("sound",$ext,"../".$dir,false);


        if($fileName!==false){
            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['sound_id'].'").find("source").first().attr("src","'.$dir.$fileName.'");
                            window.parent.$("#'.$_POST['sound_id'].'").find("source").first().addClass("jq_multi_file");
                            window.parent.$("#'.$_POST['sound_id'].'").find("source").first().attr("editor","'.$dir.$fileName.'");
                            window.parent. $("#'.$_POST['sound_id'].'").find("source").first().attr("publish","'.$fileName.'");
                            window.parent. $("#'.$_POST['sound_id'].'").find("audio").first()[0].load();
                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>';
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }else{
        echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->PleaseSelectFile."');});</script>";
    }
}
function quiz_updatevideo(){
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';

    global $Lang;
    if(isset($_FILES["video"]) && !empty($_FILES["video"])){
        $dir="quiz/".$_GET['quizid']."/";
        $ext=array("mp4");
        $fileName=uploadFile("video",$ext,"../".$dir,false);
        if($fileName!==false){
            $data='<video width="100%" height="100%" controls><source src="'.$dir.$fileName.'" type="video/mp4" class="jq_multi_file" editor="'.$dir.$fileName.'" publish="'.$fileName.'"></video>';

            echo "<script>$(document).ready(function(){
                            window.parent.$('#".$_POST['video_id']."').find('.real-content').first().html('".$data."');
                            window.parent. $('#".$_POST['video_id']."').find('video').first()[0].load();
                            window.parent.closePopup();
                            window.parent.hideLoading();
                           });</script>";
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }else{
        echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->PleaseSelectFile."');});</script>";
    }
}
function removeHarakat($str){
    $x=array(
        "َ",
        "ً",
        "ُ",
        "ٌ",
        "ٍ",
        "",
        "ِ",
        "ّ",
        "ْ",
        "ـ",
    );

    $str= str_replace($x,"",$str)."<br>";
    $x=array(
        "إ",
        "أ",
        "آ"
    );

    return str_replace($x,"ا",$str)."<br>";

}
function updatefont(){
    global $con;
    $sql="UPDATE `books` SET `fonts`='".json_encode($_POST['font'])."' WHERE `bookid`=".$_GET['bookid'];
    $con->query($sql);
    $css="";
//    foreach($_POST['font'] as $font){
//        $css.=file_get_contents("../books/temp/fonts/".$font.".css");
//    }
//    if(!is_dir("../books/".$_GET['bookid']."/files")){
//        @mkdir("../books/".$_GET['bookid']."/files");
//    }
   // copyDirectory("../books/temp/files","../books/".$_GET['bookid']."/files/");
    //file_put_contents("../books/".$_GET['bookid']."/files/css/editor-fonts.css",$css);
}
function savequestion(){

    global $con;
    switch($_POST["type"]){
        case 1:
            $ans[0]=array("A"=>$_POST['answer1'],"C"=>$_POST["correct1"]);
            $ans[1]=array("A"=>$_POST['answer2'],"C"=>$_POST["correct2"]);
           // $answer=json_encode(utf8_encode($ans));
            $answer=json_encode($ans, 1);
            $sql="UPDATE `questions` SET `type`=".$_POST['type'].",`question`='".mysqli_real_escape_string($con,$_POST['question'])."',`answer`='".mysqli_real_escape_string($con,$answer)."',`feedback_correct`='".mysqli_real_escape_string($con,$_POST['cfeedback'])."',`feedback_incorrect`='".mysqli_real_escape_string($con,$_POST['ifeedback'])."',`point_correct`=".$_POST['cpoints'].",`point_incorrect`=".$_POST['ipoints'].",`answer_html`='".mysqli_real_escape_string($con,$_POST['answer_html'])."' WHERE quistionid=".$_GET['questionid'];
            break;
        case 2:
        case 3:
        case 6:
            $answers=explode("manhal@answer@seperator",$_POST['answer']);
            foreach($answers as $answer){
                $items=explode("manhal@item@seperator",$answer);
                foreach($items as $item){
                    $bairs=explode("manhal@bair@seperator",$item);
                    $bairs_arr[str_replace('"',"",$bairs[0])]=$bairs[1];
                }
                $items_arr[]=$bairs_arr;
                $bairs_arr=array();
            }
            $answer=json_encode($items_arr,1);

            $sql="UPDATE `questions` SET `type`=".$_POST['type'].",`question`='".mysqli_real_escape_string($con,$_POST['question'])."',`answer`='".mysqli_real_escape_string($con,$answer)."',`feedback_correct`='".mysqli_real_escape_string($con,$_POST['cfeedback'])."',`feedback_incorrect`='".mysqli_real_escape_string($con,$_POST['ifeedback'])."',`point_correct`=".$_POST['cpoints'].",`point_incorrect`=".$_POST['ipoints'].",`answer_html`='".mysqli_real_escape_string($con,$_POST['answer_html'])."' WHERE quistionid=".$_GET['questionid'];
            break;
        case 4:
            $answers=explode("manhal@answer@seperator",$_POST['answer']);
            foreach($answers as $answer){
                $items_arr[]=$answer;
            }
            $answer=json_encode($items_arr);
            $sql="UPDATE `questions` SET `type`=".$_POST['type'].",`question`='".mysqli_real_escape_string($con,$_POST['question'])."',`answer`='".mysqli_real_escape_string($con,$answer)."',`feedback_correct`='".mysqli_real_escape_string($con,$_POST['cfeedback'])."',`feedback_incorrect`='".mysqli_real_escape_string($con,$_POST['ifeedback'])."',`point_correct`=".$_POST['cpoints'].",`point_incorrect`=".$_POST['ipoints'].",`answer_html`='".mysqli_real_escape_string($con,$_POST['answer_html'])."' WHERE quistionid=".$_GET['questionid'];
            break;
        case 5:
            $answers=explode("manhal@answer@seperator",$_POST['answer']);
            foreach($answers as $answer){
                $cols=explode("manhal@column@seperator",$answer);
                $temp['col1']=$cols[0];
                $temp['col2']=$cols[1];
                $items_arr[]=$temp;
            }
            $answer=json_encode($items_arr);
            $sql="UPDATE `questions` SET `type`=".$_POST['type'].",`question`='".mysqli_real_escape_string($con,$_POST['question'])."',`answer`='".mysqli_real_escape_string($con,$answer)."',`feedback_correct`='".mysqli_real_escape_string($con,$_POST['cfeedback'])."',`feedback_incorrect`='".mysqli_real_escape_string($con,$_POST['ifeedback'])."',`point_correct`=".$_POST['cpoints'].",`point_incorrect`=".$_POST['ipoints'].",`answer_html`='".mysqli_real_escape_string($con,$_POST['answer_html'])."' WHERE quistionid=".$_GET['questionid'];
            break;
        case 7:
            $answers=explode("manhal@answer@seperator",$_POST['answer']);
            $items_arr[0]=array("B"=>$_POST["image"],"width"=>$_POST["image_width"],"height"=>$_POST["image_height"],"left"=>$_POST["image_left"]);
            foreach($answers as $answer){
                $cols=explode("manhal@parameter@seperator",$answer);
                $temp['W']=str_replace("px","",$cols[0]);
                $temp['H']=str_replace("px","",$cols[1]);
                $temp['T']=str_replace("px","",$cols[2]);
                $temp['L']=str_replace("px","",$cols[3]);
                $items_arr[]=$temp;
            }
            $answer=json_encode($items_arr);
            $sql="UPDATE `questions` SET `type`=".$_POST['type'].",`question`='".mysqli_real_escape_string($con,$_POST['question'])."',`answer`='".mysqli_real_escape_string($con,$answer)."',`feedback_correct`='".mysqli_real_escape_string($con,$_POST['cfeedback'])."',`feedback_incorrect`='".mysqli_real_escape_string($con,$_POST['ifeedback'])."',`point_correct`=".$_POST['cpoints'].",`point_incorrect`=".$_POST['ipoints'].",`answer_html`='".mysqli_real_escape_string($con,$_POST['answer_html'])."' WHERE quistionid=".$_GET['questionid'];
            break;
        case 8:
            $items_arr["A"]=$_POST['answer'];
            $answer=json_encode($items_arr);
            $sql="UPDATE `questions` SET `type`=".$_POST['type'].",`question`='".mysqli_real_escape_string($con,$_POST['question'])."',`answer`='".mysqli_real_escape_string($con,$answer)."',`feedback_correct`='".mysqli_real_escape_string($con,$_POST['cfeedback'])."',`feedback_incorrect`='".mysqli_real_escape_string($con,$_POST['ifeedback'])."',`point_correct`=".$_POST['cpoints'].",`point_incorrect`=".$_POST['ipoints'].",`answer_html`='".mysqli_real_escape_string($con,$_POST['answer_html'])."' WHERE quistionid=".$_GET['questionid'];
            break;
        case 9:
            $answers=explode("manhal@answer@seperator",$_POST['answer']);
            foreach($answers as $answer){
                $cols=explode("manhal@parameter@seperator",$answer);
                $temp["A"]=$cols[0];
                $temp["C"]=$cols[1];
                $items_arr[]=$temp;
            }
            $answer=json_encode($items_arr);
            $sql="UPDATE `questions` SET `type`=".$_POST['type'].",`question`='".mysqli_real_escape_string($con,$_POST['question'])."',`answer`='".mysqli_real_escape_string($con,$answer)."',`feedback_correct`='".mysqli_real_escape_string($con,$_POST['cfeedback'])."',`feedback_incorrect`='".mysqli_real_escape_string($con,$_POST['ifeedback'])."',`point_correct`=".$_POST['cpoints'].",`point_incorrect`=".$_POST['ipoints'].",`answer_html`='".mysqli_real_escape_string($con,$_POST['answer_html'])."' WHERE quistionid=".$_GET['questionid'];
            break;
        case 10:
            $answers=explode("manhal@answer@seperator",$_POST['answer']);
            $items_arr[0]=array("P"=>$_POST['paragraph']);
            foreach($answers as $answer){
                $temp=[];
                $cols=explode("manhal@parameter@seperator",$answer);
                $temp[$cols[0]]=$cols[1];
                $items_arr[]=$temp;
            }
            $answer=json_encode($items_arr);
            $sql="UPDATE `questions` SET `type`=".$_POST['type'].",`question`='".mysqli_real_escape_string($con,$_POST['question'])."',`answer`='".mysqli_real_escape_string($con,$answer)."',`feedback_correct`='".mysqli_real_escape_string($con,$_POST['cfeedback'])."',`feedback_incorrect`='".mysqli_real_escape_string($con,$_POST['ifeedback'])."',`point_correct`=".$_POST['cpoints'].",`point_incorrect`=".$_POST['ipoints'].",`answer_html`='".mysqli_real_escape_string($con,$_POST['answer_html'])."' WHERE quistionid=".$_GET['questionid'];
            break;
    }

    if($con->query($sql)){
        echo 1;
    }else{
        echo $sql;
    }
}
function publishquiz(){
    global $con;
    global $Lang;
    $sql="SELECT * FROM `quiz` WHERE `quizid`=".$_GET['quizid'];
    $result=$con->query($sql);
    $quizData=mysqli_fetch_assoc($result);
    if($quizData["language"]=="Ar"){
        $quiz_lang="ar";
        $Lang = simplexml_load_file("../../language/Ar.xml");
        copyDirectory("../quiz/temp-ar","../quiz/".$_GET['quizid']);
    }elseif($quizData["language"]=="Fr"){
        $quiz_lang="fr";
        $Lang = simplexml_load_file("../../language/Fr.xml");
        copyDirectory("../quiz/temp-fr","../quiz/".$_GET['quizid']);
    }else{
        $quiz_lang="en";
        $Lang = simplexml_load_file("../../language/En.xml");
        copyDirectory("../quiz/temp","../quiz/".$_GET['quizid']);
    }


    $xml= new DOMDocument("1.0","UTF-8");
    $xml->loadXML(file_get_contents("../quiz/temp/quiz.xml"));

    //$xmlPro=$xml->getElementsByTagName("properties")[0];
    $xmlPro=$xml->getElementsByTagName("properties")->item(0);

    $xmlQuiz=$xml->createElement("quizinfo");

    $cdata=$xmlQuiz->ownerDocument->createCDATASection("quiz");
    $Node=$xml->createElement("type");
    $Node->appendChild($cdata);
    $xmlQuiz->appendChild($Node);

    $cdata=$xmlQuiz->ownerDocument->createCDATASection($quizData['title']);
    $Node=$xml->createElement("title");
    $Node->appendChild($cdata);
    $xmlQuiz->appendChild($Node);

    $cdata=$xmlQuiz->ownerDocument->createCDATASection($quizData['quiz_time']);
    $Node=$xml->createElement("time");
    $Node->appendChild($cdata);
    $xmlQuiz->appendChild($Node);

    $cdata=$xmlQuiz->ownerDocument->createCDATASection($quizData['Introduction']);
    $Node=$xml->createElement("instructions");
    $Node->appendChild($cdata);
    $xmlQuiz->appendChild($Node);

    $cdata=$xmlQuiz->ownerDocument->createCDATASection($Lang->Submit);
    $Node=$xml->createElement("buttoncorrect");
    $Node->appendChild($cdata);
    $xmlQuiz->appendChild($Node);

    $cdata=$xmlQuiz->ownerDocument->createCDATASection($Lang->Reset);
    $Node=$xml->createElement("buttonreset");
    $Node->appendChild($cdata);
    $xmlQuiz->appendChild($Node);

    $cdata=$xmlQuiz->ownerDocument->createCDATASection($Lang->TotalQuestion);
    $Node=$xml->createElement("totalquestion");
    $Node->appendChild($cdata);
    $xmlQuiz->appendChild($Node);

    $cdata=$xmlQuiz->ownerDocument->createCDATASection($Lang->fullscore);
    $Node=$xml->createElement("fullscore");
    $Node->appendChild($cdata);
    $xmlQuiz->appendChild($Node);

    $cdata=$xmlQuiz->ownerDocument->createCDATASection($Lang->PassingRate);
    $Node=$xml->createElement("passingrate");
    $Node->appendChild($cdata);
    $xmlQuiz->appendChild($Node);

    $cdata=$xmlQuiz->ownerDocument->createCDATASection($Lang->passingscore);
    $Node=$xml->createElement("passingscore");
    $Node->appendChild($cdata);
    $xmlQuiz->appendChild($Node);

    $cdata=$xmlQuiz->ownerDocument->createCDATASection($Lang->YourScore);
    $Node=$xml->createElement("yourscore");
    $Node->appendChild($cdata);
    $xmlQuiz->appendChild($Node);

    $cdata=$xmlQuiz->ownerDocument->createCDATASection($Lang->elapsed);
    $Node=$xml->createElement("elapsed");
    $Node->appendChild($cdata);
    $xmlQuiz->appendChild($Node);

    $xmlPro->appendChild($xmlQuiz);

    $cdata=$xmlQuiz->ownerDocument->createCDATASection($quizData['passed']);
    $pass=$xml->createElement("pass");
    $pass->appendChild($cdata);

    $cdata=$xmlQuiz->ownerDocument->createCDATASection($quizData['failed']);
    $fail=$xml->createElement("fail");
    $fail->appendChild($cdata);

    $passset=$xml->createElement("passset");
    $passset->setAttribute("value",$quizData['passing_rate']);

    $passset->appendChild($pass);
    $passset->appendChild($fail);

    $quizsettings=$xml->createElement("quizsettings");
    $quizsettings->setAttribute("age",$quizData['age']);

    $quizsettings->appendChild($passset);

    $xmlPro->appendChild($quizsettings);

    $sql="SELECT * FROM `questions` WHERE `questions`.`quizid`=".$_GET['quizid']." ORDER BY `quiz_sort` ASC";
    $result=$con->query($sql);
    //$xmlItems=$xml->getElementsByTagName("items")[0];
    $xmlItems=$xml->getElementsByTagName("items")->item(0);

    while($question=mysqli_fetch_assoc($result)){
        $Item=$xml->createElement("item");

        $Item->setAttribute("type",$question['type']);
        $Item->setAttribute("point_correct",$question['point_correct']);
        $Item->setAttribute("point_incorrect",$question['point_incorrect']);

        $cdata=$Item->ownerDocument->createCDATASection(removeQuizRabish($question['question']));
        $q=$xml->createElement("question");
        $q->appendChild($cdata);

        $Item->appendChild($q);

        $aitems=$xml->createElement("aitems");
       // echo "<br>------------".$question['type']."------------<br>";
        switch($question['type']){
            case "1":
            case "2":
            case "3":
            case "6":
            case "9":
                if($question['type']==9){
                    $answers=json_decode($question['answer'],1);
                }else{
                    $answers=json_decode($question['answer'],1);
                }

                foreach($answers as $answer){

                    $aitem=$xml->createElement("aitem");
                    $aitem->setAttribute("correct",$answer["C"]);

                    $cdata=$aitems->ownerDocument->createCDATASection(removeQuizRabish(str_replace("\\","",$answer['A'])));
                    $XMLanswer=$xml->createElement("answer");
                    $XMLanswer->appendChild($cdata);

                    $aitem->appendChild($XMLanswer);
                    $aitems->appendChild($aitem);
                }
                break;
            case "4":
                $answers=json_decode($question['answer'],1);
                foreach($answers as $answer){
                    $aitem=$xml->createElement("aitem");
                    $cdata=$aitems->ownerDocument->createCDATASection(removeQuizRabish($answer));
                    $XMLanswer=$xml->createElement("answer");
                    $XMLanswer->appendChild($cdata);
                     $aitem->appendChild($XMLanswer);
                    $aitems->appendChild($aitem);
                }
                break;
            case "5":
                $answers=json_decode($question['answer'],true);
//                echo $question['answer']."<br><br><br>";
//                print_r($answers);
//                exit();
                //$answers=json_decode($question['answer']);
                foreach($answers as $answer){
                    $colA=$xml->createElement("columA");
                    $colA->setAttribute("type","html");
                    $cdata=$aitems->ownerDocument->createCDATASection(removeQuizRabish($answer['col1']));
                    $colA->appendChild($cdata);

                    $colB=$xml->createElement("columB");
                    $colB->setAttribute("type","html");
                    $cdata=$aitems->ownerDocument->createCDATASection(removeQuizRabish($answer['col2']));
                    $colB->appendChild($cdata);

                    $aitem=$xml->createElement("aitem");
                    $aitem->appendChild($colA);
                    $aitem->appendChild($colB);
                    $aitems->appendChild($aitem);
                }
                break;
            case "7":
                $answers=json_decode($question['answer'],true);
                $aitems->setAttribute("background",$answers[0]["B"]);
                $aitems->setAttribute("width",$answers[0]["width"]);
                $aitems->setAttribute("height",$answers[0]["height"]);
                $aitems->setAttribute("left",$answers[0]["left"]);
                foreach($answers as $answer){
                    if(isset($answer["L"]) && $answer["L"]!=""){
                        $c=$xml->createElement("answer");
                        $c->setAttribute("L",removeQuizRabish($answer["L"]));
                        $c->setAttribute("T",removeQuizRabish($answer["T"]));
                        $c->setAttribute("W",removeQuizRabish($answer["W"]));
                        $c->setAttribute("H",removeQuizRabish($answer["H"]));
                        $aitems->appendChild($c);
                    }
                }
                break;
            case "8":
                $answers=json_decode($question['answer'],true);
                $aitem=$xml->createElement("aitem");
                $answer=$xml->createElement("answer");
                $cdata=$aitems->ownerDocument->createCDATASection(removeQuizRabish($answers['A']));
                $answer->appendChild($cdata);
                $aitem->appendChild($answer);
                $aitems->appendChild($aitem);
                break;
            case "10":
                $answers=json_decode($question['answer'],1);
               print(htmlentities($question['answer'])."aaaa");
                print_r($answers);
                $aitem=$xml->createElement("essay");
                $cdata=$aitems->ownerDocument->createCDATASection(str_replace("\\","",removeQuizRabish($answers['0']["P"])));
                $aitem->appendChild($cdata);
                $aitems->appendChild($aitem);
                $answersA=$xml->createElement("answers");
                foreach($answers as $answer){
                    print("<br>");
                    print_r($answer);
                    print("<br>");
                    if(!isset($answer["P"])){
                        $answerXML=$xml->createElement("answer");
                        $answerXML->setAttribute("id",key($answer));
                        $cdata=$aitems->ownerDocument->createCDATASection(str_replace("\\","",removeQuizRabish($answer[key($answer)])));
                        $answerXML->appendChild($cdata);
                        $answersA->appendChild($answerXML);
                    }
                }
                $aitems->appendChild($answersA);
                break;
        }
        $Item->appendChild($aitems);

        $cdata=$aitems->ownerDocument->createCDATASection($question['feedback_correct']);
        $correct=$xml->createElement("correct");
        $correct->appendChild($cdata);

        $cdata=$aitems->ownerDocument->createCDATASection($question['feedback_incorrect']);
        $incorrect=$xml->createElement("incorrect");
        $incorrect->appendChild($cdata);

        $feedback=$xml->createElement("feedback");
        $feedback->appendChild($correct);
        $feedback->appendChild($incorrect);

        $Item->appendChild($feedback);

        $note=$xml->createElement("note");

        $Item->appendChild($note);

        $xmlItems->appendChild($Item);
    }

    file_put_contents("../quiz/".$_GET['quizid']."/quiz.xml",$xml->saveXML());
    if(isset($_GET['view']) && $_GET['view']==1){
        header("location:../quiz/view/".$quiz_lang."/index.php?id=".$_GET['quizid']);
        exit();
    }
}
function savenewquiz(){
    global $con;
    $date = date("Y/m/d H:i:s", time());
    $result="[".json_encode(array("Pass"=>$_POST["quiz_Pass"],"Failed"=>$_POST["quiz_Failed"]))."]";
    if( $con->query("INSERT INTO `quiz`(`category`,`title`,`Introduction`,`age`,`passing_rate`,`result`,`passed`,`failed`,`userid`,`status`,`cdate`) VALUES('".$_POST['Category']."','".$_POST['quiz_title']."','".$_POST['quiz_Introduction']."','".$_POST['quiz_age']."','".$_POST['quiz_passing_rate']."','".mysqli_real_escape_string($con,$result)."','".$_POST['question_Passed']."','".$_POST['question_Failed']."',".$_SESSION['user']['userid'].",1,'".$date."')")){
       @mkdir("../quiz/".$con->insert_id);
        echo 1;
    }
}
function savecircle(){

    if(!is_dir("../books/".$_GET["bookid"]."/".$_GET['pageid'])){
        @mkdir("../books/".$_GET["bookid"]."/".$_GET['pageid']);
    }
    if(isset($_POST["thumbs"]) && $_POST["thumbs"]!=""){
        $thumbs=json_decode($_POST["thumbs"]);
        $temp_thumb="";
        foreach($thumbs as $thumb){
            $temp_thumb.=saveImage64($thumb)."@manhal@seperator@";
        }
        echo $temp_thumb;
    }
}
function saveImage64($thumb){
    $types=explode(";",$thumb);
    $data=$types[1];
    $types=explode("/",$types[0]);
    if($types[1]=="jpeg") {
        $ext = "jpg";
    }else{
        $ext =$types[1];
    }

    $data = str_replace('base64,', '', $data);
    $data = str_replace(') no-repeat;,', '', $data);
    $data = str_replace(')no-repeat;,', '', $data);
    $data = str_replace(' ', '+', $data);
    $data = base64_decode($data);
    $picture_name=$_GET["pageid"]."/circle_".uniqid().".".$ext;
    file_put_contents('../books/'.$_GET["bookid"]."/".$picture_name, $data);
    return $picture_name;
}
function uploadSoundEffect(){
    global $Lang;
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    if(isset($_FILES["sound_effect"]) && !empty($_FILES["sound_effect"])){
        $dir="books/".$_GET['bookid']."/".$_GET['pageid']."/";
        if(!is_dir("../".$dir)){
            @mkdir("../".$dir);
        }
        $ext=array("mp3");
        $fileName="sound_".uniqid().".mp3";
        $path_parts = pathinfo($_FILES["sound_effect"]['name']);
        $extension = strtolower($path_parts['extension']);
        if(in_array($extension,$ext)){
            if(move_uploaded_file($_FILES["sound_effect"]['tmp_name'], "../".$dir.$fileName)){
                $uploaded=true;
            }else{
                $uploaded=false;
            }
        }else{
            $uploaded=false;
        }
        if($uploaded){
            echo '<script>$(document).ready(function(){
                            window.parent.UpdateSoundEffect("'.$dir.$fileName.'");
                            window.parent.hideLoading();
                           });</script>';
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload.$dir.$fileName."');});</script>";
        }
    }else{
        echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->PleaseSelectFile."');});</script>";
    }
}
function uploadvideo(){
    global $Lang;
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    if(isset($_FILES["uvideo"]) && !empty($_FILES["uvideo"]) && file_exists($_FILES['uvideo']['tmp_name'])){
        $dir="books/".$_GET['bookid']."/".$_GET['pageid']."/";
        if(!is_dir("../".$dir)){
            @mkdir("../".$dir);
        }
        $ext=array("mp4");
        $fileName="video_".uniqid().".mp4";
        $path_parts = pathinfo($_FILES["uvideo"]['name']);
        $extension = strtolower($path_parts['extension']);
        if(in_array($extension,$ext)){
            if(move_uploaded_file($_FILES["uvideo"]['tmp_name'], "../".$dir.$fileName)){
                $uploaded=true;
            }else{
                $uploaded=false;
            }
        }else{
            $uploaded=false;
        }
        if($uploaded){
            echo '<script>$(document).ready(function(){
                            window.parent.UpdateVideo("'.$dir.$fileName.'","'.$_GET['pageid']."/".$fileName.'");
                            window.parent.hideLoading();
                           });</script>';
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload.$dir.$fileName."');});</script>";
        }
    }elseif($_POST["youtube"] && $_POST["youtube"]!=""){
        echo '<script>$(document).ready(function(){
                            window.parent.updateYoutube();
                            window.parent.hideLoading();
                           });</script>';
    }else{
        echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->PleaseSelectFile."');});</script>";
    }
}
function updatescrathcer(){
    $dir = "books/" . $_GET['bookid'] . "/" .$_POST['scratcher_id'] . "/";
    if (!is_dir("../" . $dir)) {
        @mkdir("../" . $dir);
    }
    copyDirectory("../widgets/scratcher","../books/" . $_GET['bookid'] . "/" . $_POST['scratcher_id']);

    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    $title="";
    if(isset($_POST["scratchertitle"]) && $_POST["scratchertitle"]!=""){
        $title=$_POST["scratchertitle"];
    }

    echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['scratcher_id'].'").find(".real-content").first().attr("title","'.$title.'");
                           });</script>';
    global $Lang;

    // uploadIcon("aimage");
    if(isset($_FILES["fgimage"]) && isset($_FILES["fgimage"])){
        $dir="books/".$_GET['bookid']."/".$_POST['scratcher_id']."/";
        $ext=array("jpg","jpeg","png","gif","bmp");

        $path_parts = pathinfo($_FILES["fgimage"]['name']);
        $extension = strtolower($path_parts['extension']);
        if(in_array($extension,$ext)){
            $newName="bg.".$extension;
            if(move_uploaded_file($_FILES["fgimage"]['tmp_name'], "../".$dir.$newName)){
                $bg_fileName=$newName;
            }else{
                $bg_fileName=false;
            }
        }else{
            $bg_fileName=false;
        }

        $path_parts = pathinfo($_FILES["bgimage"]['name']);
        $extension = strtolower($path_parts['extension']);
        if(in_array($extension,$ext)){
            $newName="fg.".$extension;
            if(move_uploaded_file($_FILES["bgimage"]['tmp_name'], "../".$dir.$newName)){
                $fg_fileName=$newName;
            }else{
                $fg_fileName=false;
            }
        }else{
            $fg_fileName=false;
        }

        list($width, $height) = getimagesize("../".$dir.$bg_fileName);
        if($bg_fileName!==false && $fg_fileName!==false){
            $html='<canvas id="'.$_POST['scratcher_id'].'" bg="'.$bg_fileName.'" fg="'.$fg_fileName.'" class="demo-canvas shadow1light scratcher" width="'.$width.'" height="'.$height.'" style="width: '.$width.'px; height: '.$height.'px;"></canvas>';
            $html=str_replace("#manhal_scratcher#",$html,file_get_contents("../widgets/scratcher/index.html"));
            $html=str_replace("#manhal_fontSize#",$_POST['fontsize'],$html);
            file_put_contents("../books/" . $_GET['bookid'] . "/" . $_POST['scratcher_id']."/index.html",$html);
            echo "<script>$(document).ready(function(){
                            window.parent.UpdateScratcher('".$dir."index.html','". $_POST['scratcher_id']."/index.html');
                            window.parent.hideLoading();
                           });</script>";
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }else{
        echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
    }

}
function updatepopout(){
    $dir = "books/" . $_GET['bookid'] . "/" .$_POST['popout_id'] . "/";
    if (!is_dir("../" . $dir)) {
        @mkdir("../" . $dir);
    }

    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    $title="";
    if(isset($_POST["poptitle"]) && $_POST["poptitle"]!=""){
        $title=$_POST["poptitle"];
    }

    echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['popout_id'].'").find(".real-content").first().attr("title","'.$title.'");
                           });</script>';
    global $Lang;

    // uploadIcon("aimage");
    if(isset($_FILES["bgimage"]) && isset($_FILES["fgimage"])){
        $ext=array("jpg","jpeg","png","gif","bmp");

        $path_parts = pathinfo($_FILES["bgimage"]['name']);
        $extension = strtolower($path_parts['extension']);
        if(in_array($extension,$ext)){
            $newName="bg.".$extension;
            if(move_uploaded_file($_FILES["bgimage"]['tmp_name'], "../".$dir.$newName)){
                $bg_fileName=$newName;
            }else{
                $bg_fileName=false;
            }
        }else{
            $bg_fileName=false;
        }

        $path_parts = pathinfo($_FILES["fgimage"]['name']);
        $extension = strtolower($path_parts['extension']);
        if(in_array($extension,$ext)){
            $newName="fg.".$extension;
            if(move_uploaded_file($_FILES["fgimage"]['tmp_name'], "../".$dir.$newName)){
                $fg_fileName=$newName;

            }else{
                $fg_fileName=false;
            }
        }else{
            $fg_fileName=false;
        }

        if($bg_fileName!==false && $fg_fileName!==false){

            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['popout_id'].'").find(".image-popup-no-margins").first().attr("href","'.SITE_URL."platform/".$dir.$bg_fileName.'");
                            window.parent.$("#'.$_POST['popout_id'].'").find(".manhal-popoutimage").first().attr("src","'.SITE_URL."platform/".$dir.$fg_fileName.'");
                            window.parent.$("#'.$_POST['popout_id'].'").find(".manhal-popoutimage-fg").first().attr("src","'.SITE_URL."platform/".$dir.$bg_fileName.'");
                            window.parent.closePopup();
                            window.parent.hideLoading();
                            window.parent.animatePopOutImage();});</script>';
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }else{
        echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
    }

}
function updatevt(){
    $dir = "books/" . $_GET['bookid'] . "/";


    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    $title="";
    if(isset($_POST["vttitle"]) && $_POST["vttitle"]!=""){
        $title=$_POST["vttitle"];
    }

    echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['vt_id'].'").find(".real-content").first().attr("title","'.$title.'");
                           });</script>';
    global $Lang;

    // uploadIcon("aimage");
    if(isset($_FILES["vtvideo"])){
        $ext=array("mp4");

        $path_parts = pathinfo($_FILES["vtvideo"]['name']);
        $extension = strtolower($path_parts['extension']);
        if($extension=="mp4"){
            $newName=$_POST['vt_id'].".mp4";
            if(move_uploaded_file($_FILES["vtvideo"]['tmp_name'], "../".$dir.$newName)){
                $fileName=$newName;
            }else{
                $fileName=false;
            }
        }else{
            $fileName=false;
        }

        if($fileName!==false){

            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['vt_id'].'").find(".manhal_videosrc").first().attr("src","'.SITE_URL."platform/".$dir.$fileName.'");
                            window.parent.playTransVideo();
                            window.parent.closePopup();
                            window.parent.hideLoading();
                            });</script>';
        }else{
            echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
        }
    }else{
        echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->CanNotUpload."');});</script>";
    }

}
function uploadslider(){
    global $Lang;
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    if(isset($_FILES["sliderimage"]) && !empty($_FILES["sliderimage"])) {
        $folder=$_POST["slider_id"];
        $dir = "books/" . $_GET['bookid'] . "/" . $folder . "/";
        if (!is_dir("../" . $dir)) {
            @mkdir("../" . $dir);
        }
        copyDirectory("../widgets/slider","../books/" . $_GET['bookid'] . "/" . $folder);
        $ext = array("jpg", "jpeg", "gif", "png", "bmp");
        $uploaded = false;
        $html = "";
        foreach ($_FILES["sliderimage"]["tmp_name"] as $key => $tmp_name) {
            $path_parts = pathinfo($_FILES["sliderimage"]['name'][$key]);
            $extension = strtolower($path_parts['extension']);
            $fileName = "slider_" . $_POST["slider_id"] . $key . "." . $extension;
            if (in_array($extension, $ext)) {
                if (move_uploaded_file($_FILES["sliderimage"]['tmp_name'][$key], "../" . $dir . $fileName)) {
                    $uploaded = true;
                    $html .= '<div><img  style="width:100%;height:100%;" src="'.$fileName.'"></div>';
                }
            }
        }
        if ($uploaded) {
            $html=str_replace("#Manhal_Slider#",$html,file_get_contents("../widgets/slider/index.html"));
            file_put_contents("../books/" . $_GET['bookid'] . "/" . $folder."/index.html",$html);
            echo "<script>$(document).ready(function(){
                            window.parent.UpdateSlider('".$dir."index.html','".$folder."/index.html');
                            window.parent.hideLoading();
                             window.parent.closePopup();
                           });</script>";
        } else {
            echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','" . $Lang->Error . "','" . $Lang->CanNotUpload . $dir . $fileName . "');});</script>";
        }
    }else{
        echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->PleaseSelectFile."');});</script>";
    }
}
function updateimage360(){
    global $Lang;
    echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    if(isset($_FILES["image360images"]) && !empty($_FILES["image360images"])) {
        $dir = "books/" . $_GET['bookid'] . "/" . $_POST['image360_id'] . "/";
        if (!is_dir("../" . $dir)) {
            @mkdir("../" . $dir);
        }
        $ext = array("jpg", "jpeg", "gif", "png", "bmp");
        $uploaded = false;
        $script ="'";
        $script.='<div class="jq_manhal360" id="'.$_POST["image360_id"].'"></div>';
        $script.='<script>$(function(){ var frames'.$_POST["image360_id"].' = [';
        foreach ($_FILES["image360images"]["tmp_name"] as $key => $tmp_name) {
            $path_parts = pathinfo($_FILES["image360images"]['name'][$key]);
            $extension = strtolower($path_parts['extension']);
            $fileName = "image360_".$key.".".$extension;
            if (in_array($extension, $ext)) {
                if (move_uploaded_file($_FILES["image360images"]['tmp_name'][$key], "../" . $dir . $fileName)) {
                    $uploaded = true;
                    $script.=  '"'.$_POST['image360_id'].'/'.$fileName.'",';
                }
            }
        }
        $script.='];';
         $script.='var container'.$_POST["image360_id"].'="'.$_POST['image360_id'].'";';
         $script.='var img360id'.$_POST["image360_id"].'=$("#"+container'.$_POST["image360_id"].').find(".jq_manhal360").attr("id");';
         $script.='$("#"+img360id'.$_POST["image360_id"].').spritespin({';
         $script.='width :  $("#'.$_POST["image360_id"].'").width(),';
         $script.='height: $("#'.$_POST["image360_id"].'").height(),';
         $script.='frames: frames'.$_POST["image360_id"].'.length,';
         $script.='behavior: "drag",';
         $script.='module: "360",';
         $script.='sense : -1,';
         $script.='source: frames'.$_POST["image360_id"].',';
         $script.='animate : true,';
         $script.='loop: true,';
         $script.='frameWrap : true,';
         $script.='frameStep : 1,';
         $script.='frameTime : 180,';
         $script.='enableCanvas : true,';
         $script.='responsive:true';
         $script.='});';
         $script.='});';
        $script.="<\/script>'";
        if ($uploaded) {
            echo '<script>$(document).ready(function(){
                            window.parent.$("#'.$_POST['image360_id'].'").find(".real-content").html('.$script.');
                             window.parent.hideLoading();
                             window.parent.closePopup();
                           });</script>';
        } else {
            echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','" . $Lang->Error . "','" . $Lang->CanNotUpload . $dir . $fileName . "');});</script>";
        }
    }else{
        echo "<script>$(document).ready(function(){window.parent.hideLoading();window.parent.showMsg('error','".$Lang->Error."','".$Lang->PleaseSelectFile."');});</script>";
    }
}
function removeQuizRabish($data){
    $data = preg_replace('/<label\b[^>]*>/', '', $data);
    $data = preg_replace('/<\/label\b[^>]*>/', '', $data);
    $data = preg_replace('/<input type="radio" \b[^>]*>/', '', $data);
    $data=str_replace('<input type="hidden">',"",$data);
    $data=str_replace('id="dr"' ,"",$data);
    $data=str_replace('id="dl"',"",$data);
    $data=str_replace('class="resizable draggable element"',"",$data);
    $data=str_replace('<span class="check"></span>',"",$data);
    return $data;
}
function deletequistion(){
    global $con;
    if ($_SESSION['user']['permession'] == 1) {
        $weruser = '';
    } else {
        $weruser = " and userid=".$_SESSION['user']['userid'];
    }
    $sql = "Select * FROM `quiz` WHERE `quizid`=".$_POST['quizid'].$weruser;
    $result = $con->query($sql);
    $num_rows=mysqli_num_rows($result);
    if($num_rows>0){
        if($con->query("DELETE FROM `questions` WHERE `quistionid`=".$_POST['questionid'])){
            echo 1;
        }else{
            echo 0;
        }
    }else{
        echo "Secured";
    }
}
function copyquiz(){
    $src="../quiz/".$_GET['quizid'];
    $dest="../books/".$_GET['bookid']."/quiz";
    if(!is_dir($dest)){
      @mkdir($dest);
    }
    $dest=$dest."/".$_GET['quizid'];
    if(!is_dir($dest)){
        @mkdir($dest);
    }
    copyDirectory($src,$dest);
    echo "quiz/".$_GET['quizid'];
}
function copygame(){
    global $con;
//    $src="../games/".$_GET['gameid'];
//    $dest="../books/".$_GET['bookid']."/games";
//    if(!is_dir($dest)){
//      @mkdir($dest);
//    }
//    $dest=$dest."/".$_GET['gameid'];
//    if(!is_dir($dest)){
//        @mkdir($dest);
//    }
//    copyDirectory($src,$dest);
//    echo "games/".$_GET['gameid'];
    $sql = "Select * FROM `editors` WHERE gameid=".$_GET['gameid'];
    $result = $con->query($sql);
    $row=mysqli_fetch_assoc($result);
    echo SITE_URL."platform/".$row["editor"]."/viewer/".strtolower($row["language"])."/index.php?id=".$_GET['gameid'];
}
function sortcategories(){
    global $con;
    $data=json_decode($_POST['cats']);
    foreach($data as $key=>$value){
        $sql="UPDATE `categories` SET `parent`=".$value." WHERE `catid`=".$key;
        $con->query($sql);
    }
}
//first khalid [000001-7-9-2016]
function sortcategoriesstory(){
    global $con;
    $data=json_decode($_POST['cats']);
    foreach($data as $key=>$value){
        $sql="UPDATE `stories_cat` SET `parent`=".$value." WHERE `catid`=".$key;
        $con->query($sql);
    }
}

function sortcategoriesdepartment(){
    global $con;
    $data=json_decode($_POST['cats'], true);


    foreach($data as $key=>$value){

        $sql="UPDATE `departments` SET `sort`=".$value['sort'].", `parent`=".$value['parent']."  WHERE `catid`=".$key;
        $con->query($sql);
    }
}
function sortcategoriesbrand(){
    global $con;
    $data=json_decode($_POST['cats'], true);


    foreach($data as $key=>$value){

        $sql="UPDATE `brand` SET `sort`=".$value['sort'].", `parent`=".$value['parent']."  WHERE `catid`=".$key;
        $con->query($sql);
    }
}


//end khalid [000001-7-9-2016]
function deletestory(){
    global $con;
    if(canEditStory($_GET['storyid'])){
        if ($con->query("DELETE FROM story WHERE storyid=".$_GET['storyid'])) {
            if(isset($_GET['storyid']) && $_GET['storyid']!=""){
                removeDirectory('../stories/'.$_GET['seriesid']."/story/".$_GET['storyid']);
                echo 1;
            }else{
                echo 0;
            }
        }
    }else{
        echo "secured 210820161219";
    }
}
function deleteunit(){
    global $con;
    if(canEdit($_GET["bookid"])){
        if ($con->query("DELETE FROM `units_lessons` WHERE `ulid`=".$_GET["unitid"]." AND `bookid`=".$_GET["bookid"]." AND `type`='unit'")) {
      //      $con->query("DELETE FROM `units_lessons` WHERE `unitid`=".$_GET["unitid"]." AND `bookid`=".$_GET["bookid"]." AND `type`='lesson'");
            echo 1;
        }else{
            echo "error sql 0511181244";
        }
    }else{
        echo "secured 0511181245";
    }
}
function deletelesson(){
    global $con;
    if(canEdit($_GET["bookid"])){
        if ($con->query("DELETE FROM `units_lessons` WHERE `ulid`=".$_GET["lessonid"]." AND `bookid`=".$_GET["bookid"]." AND `type`='lesson'")) {
            echo 1;
        }else{
            echo "error sql 0511181254";
        }
    }else{
        echo "secured 0511181246";
    }
}
function deletegame(){
    global $con;

    $sql = "SELECT `editors`.*,`users`.*,`categories`.* FROM `editors` left OUTER JOIN `categories` ON `editors`.`category`=`categories`.`catid` left OUTER JOIN `users` on `editors`.`userid`=`users`.`userid` WHERE `editors`.`gameid`=".$_GET['gameid'];
    $result = $con->query($sql);
    $row=mysqli_fetch_assoc($result);

    if(canEditGame($row)){
        if ($con->query("DELETE FROM editors WHERE gameid=".$_GET['gameid'])) {
            if(isset($_GET['gameid']) && $_GET['gameid']!=""){
                removeDirectory('../games/'.$_GET['gameid']);
                echo 1;
            }else{
                echo 0;
            }

        }
    }else{
        echo "secured 1412160419";
    }
}
//start khalid [000001-7-9-2016]
function deletestorypage(){
    global $con;
    if(canEditStory($_GET['storyid'])){
        if ($con->query("DELETE FROM storypages WHERE id=".$_GET['pageid'])) {
            $arrextantion=['jpg','gif','png'];
            $arrextantionsound=['mp3','mp4'];
            foreach ($arrextantion as $value) {
                $file = '../stories/'.$_GET['seriesid']."/story/".$_GET['storyid'].'/images/'.$_GET['pageid']. ".".$value;
                if(is_file($file)) {
                    if (!unlink($file)) {
                        echo("Error deleting $file");
                    }
                }
            }
            foreach ($arrextantionsound as $value){
                $file = '../stories/'.$_GET['seriesid']."/story/".$_GET['storyid'].'/sound/'.$_GET['pageid']. ".".$value;
                if(is_file($file)){
                    if (!unlink($file)) {
                        echo("Error deleting $file");
                    }
                }
            }
            echo 1;
        }
    }else{
        echo "secured 210820161219";
    }
}
//end //start khalid [000001-7-9-2016]
function deleteseries(){
    global $con;
    if(isset($_GET['seriesid']) && $_GET["seriesid"]!="" && $_GET["seriesid"]!="." && $_GET["seriesid"]!=".."){
        if(canEditSeries($_GET['seriesid'])){
            if ($con->query("DELETE FROM series WHERE seriesid=".$_GET['seriesid'])) {
                $con->query("DELETE FROM story WHERE seriesid=".$_GET['seriesid']);
                removeDirectory('../stories/'.$_GET['seriesid']);
                echo 1;
            }
        }else{
            echo "secured 230820161025";
        }
    }

}
//first khalid [000001-7-9-2016]
function pagestory(){
    if (isset($_FILES['page_image'])) {
            $target_path = "../stories/".$_GET["seriesid"]."/story/".$_GET["idstory"]."/images/";     // Declaring Path for uploaded images.
            $validextensions = array("jpeg", "jpg", "png","gif","svg");      // Extensions which are allowed.
            $ext = explode('.', basename($_FILES['page_image']['name']));   // Explode file name from dot(.)
            $file_extension = end($ext); // Store extensions in the variable.
            $target_path = $target_path .$_GET["pageid"] . "." . $ext[count($ext) - 1];
            if (in_array($file_extension, $validextensions)) {
                move_uploaded_file($_FILES['page_image']['tmp_name'], $target_path);
        }
    }
    $validextensions = array('mp3');
    if (isset($_FILES['page_sound']) && !empty($_FILES['page_sound'])) {
        $target_path = "../stories/".$_GET["seriesid"]."/story/".$_GET["idstory"]."/sound/";     // Declaring Path for uploaded images.
        $ext = explode('.', basename($_FILES['page_sound']['name']));   // Explode file name from dot(.)
        $file_extension = end($ext); // Store extensions in the variable.
        $target_path = $target_path .$_GET["pageid"] . "." . $ext[count($ext) - 1];     // Declaring Path for uploaded images.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['page_sound']['tmp_name'], $target_path);
        }
    }
}
//start khalid 19-9-2016
function screenshotsstory(){
    if (isset($_FILES['story_shoots'])) {
        $target_path = "../stories/".$_GET["seriesid"]."/story/".$_GET["storyid"]."/images/screenshoots/";     // Declaring Path for uploaded images.
        if(!is_dir($target_path)){
            mkdir($target_path);
        }
       // removeDirectory($target_path);
       // mkdir($target_path);
        for ($i = 0; $i < count($_FILES['story_shoots']['name']); $i++) {
            $target_path = "../stories/".$_GET["seriesid"]."/story/".$_GET["storyid"]."/images/screenshoots/";     // Declaring Path for uploaded images.
            $validextensions = array("jpeg", "jpg", "png","gif","svg");      // Extensions which are allowed.
            $ext = explode('.', basename($_FILES['story_shoots']['name'][$i]));   // Explode file name from dot(.)
            $file_extension = end($ext); // Store extensions in the variable.
            $target_path = $target_path . (uniqid()).$i . "." . $ext[count($ext) - 1];     // Set the target path with a new name of image.
            if (in_array($file_extension, $validextensions)) {
                move_uploaded_file($_FILES['story_shoots']['tmp_name'][$i], $target_path);
            }
        }
    }
    if (isset($_FILES['paint_pictures'])) {
        $target_path = "../stories/".$_GET["seriesid"]."/story/".$_GET["storyid"]."/images/";     // Declaring Path for uploaded images.
        if(!is_dir($target_path)){
            mkdir($target_path);
        }
       // removeDirectory($target_path);
       // mkdir($target_path);
        for ($i = 0; $i < count($_FILES['paint_pictures']['name']); $i++) {
            $target_path = "../stories/".$_GET["seriesid"]."/story/".$_GET["storyid"]."/images/";     // Declaring Path for uploaded images.
            $validextensions = array("jpeg", "jpg", "png","gif","svg");      // Extensions which are allowed.
            $ext = explode('.', basename($_FILES['paint_pictures']['name'][$i]));   // Explode file name from dot(.)
            $file_extension = end($ext); // Store extensions in the variable.
            $target_path = $target_path.($i+1).".png";     // Set the target path with a new name of image.
            if (in_array($file_extension, $validextensions)) {
                move_uploaded_file($_FILES['paint_pictures']['tmp_name'][$i], $target_path);
            }
        }
    }
    if (isset($_FILES['games_pictures'])) {
        $target_path = "../stories/".$_GET["seriesid"]."/story/".$_GET["storyid"]."/images/";     // Declaring Path for uploaded images.
        if(!is_dir($target_path)){
            mkdir($target_path);
        }
        // removeDirectory($target_path);
        // mkdir($target_path);
        for ($i = 0; $i < count($_FILES['games_pictures']['name']); $i++) {
            $target_path = "../stories/".$_GET["seriesid"]."/story/".$_GET["storyid"]."/images/";     // Declaring Path for uploaded images.
            $validextensions = array("jpeg", "jpg", "png","gif","svg");      // Extensions which are allowed.
            $ext = explode('.', basename($_FILES['games_pictures']['name'][$i]));   // Explode file name from dot(.)
            $file_extension = end($ext); // Store extensions in the variable.
            $target_path = $target_path."0".($i+1).".jpg";     // Set the target path with a new name of image.
            if (in_array($file_extension, $validextensions)) {
                move_uploaded_file($_FILES['games_pictures']['tmp_name'][$i], $target_path);
            }
        }
    }

    //end khalid 19-9-2016
    $validextensions = array('mp3');
    if (isset($_FILES['parent_sound']) && !empty($_FILES['parent_sound'])) {
        $target_path = "../stories/".$_GET["seriesid"]."/story/".$_GET["storyid"]."/sound/parent.mp3";     // Declaring Path for uploaded images.
        $ext = explode('.', basename($_FILES['parent_sound']['name']));   // Explode file name from dot(.)
        $file_extension = end($ext); // Store extensions in the variable.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['parent_sound']['tmp_name'], $target_path);
        }
    }
    if (isset($_FILES['kids_sound']) && !empty($_FILES['kids_sound'])) {
        $target_path = "../stories/".$_GET["seriesid"]."/story/".$_GET["storyid"]."/sound/kids.mp3";     // Declaring Path for uploaded images.
        $ext = explode('.', basename($_FILES['kids_sound']['name']));   // Explode file name from dot(.)
        $file_extension = end($ext); // Store extensions in the variable.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['kids_sound']['tmp_name'], $target_path);
        }
    }
    if (isset($_FILES['title_sound']) && !empty($_FILES['title_sound'])) {
        $target_path = "../stories/".$_GET["seriesid"]."/story/".$_GET["storyid"]."/sound/title.mp3";     // Declaring Path for uploaded images.
        $ext = explode('.', basename($_FILES['title_sound']['name']));   // Explode file name from dot(.)
        $file_extension = end($ext); // Store extensions in the variable.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['title_sound']['tmp_name'], $target_path);
        }
    }
    if (isset($_FILES['bgsound']) && !empty($_FILES['bgsound'])) {
        $target_path = "../stories/".$_GET["seriesid"]."/story/".$_GET["storyid"]."/sound/bgsound.mp3";     // Declaring Path for uploaded images.
        $ext = explode('.', basename($_FILES['bgsound']['name']));   // Explode file name from dot(.)
        $file_extension = end($ext); // Store extensions in the variable.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['bgsound']['tmp_name'], $target_path);
        }
    }
    if (isset($_FILES['childsound']) && !empty($_FILES['childsound'])) {
        $target_path = "../stories/".$_GET["seriesid"]."/story/".$_GET["storyid"]."/sound/childsound.mp3";     // Declaring Path for uploaded images.
        $ext = explode('.', basename($_FILES['childsound']['name']));   // Explode file name from dot(.)
        $file_extension = end($ext); // Store extensions in the variable.
        if (in_array($file_extension, $validextensions)) {
            move_uploaded_file($_FILES['childsound']['tmp_name'], $target_path);
        }
    }
//end  khalid [000001-7-9-2016]
echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    echo '<script>$(document).ready(function(){
                            window.parent.hideLoading();
                           });</script>';
}
function soundseries(){
    if (isset($_FILES['parent_sound']) && !empty($_FILES['parent_sound'])) {
        $target_path = "../stories/".$_GET["seriesid"]."/sound/adviceChild.mp3";     // Declaring Path for uploaded images.
        $ext = explode('.', basename($_FILES['parent_sound']['name']));   // Explode file name from dot(.)
        $file_extension = end($ext); // Store extensions in the variable.
        if ($file_extension=="+") {
            move_uploaded_file($_FILES['parent_sound']['tmp_name'], $target_path);
        }
    }
    if (isset($_FILES['bgsound']) && !empty($_FILES['bgsound'])) {
        $target_path = "../stories/".$_GET["seriesid"]."/sound/bgstory.mp3";     // Declaring Path for uploaded images.
        $ext = explode('.', basename($_FILES['bgsound']['name']));   // Explode file name from dot(.)
        $file_extension = end($ext); // Store extensions in the variable.
        if ($file_extension=="mp3") {
            move_uploaded_file($_FILES['bgsound']['tmp_name'], $target_path);
        }
    }

echo '<script type="text/javascript" src="../../js/jquery.js"></script>';
    echo '<script>$(document).ready(function(){
                            window.parent.hideLoading();
                           });</script>';

}
//first khalid [000001-7-9-2016]
function updatepagestory()
{
    global $con;
    $date = date("Y/m/d H:i:s", time());
   $text='';
   if(isset($_POST['text']) && $_POST['text']!=''){
       $text=',`text`="'.$_POST['text'].'"';
   }
     $sound='';
    if(isset($_POST['sound'])&&$_POST['sound']!=''){
        $sound=',`sound`="'.$_POST['sound'].'"';
    }
    $image='';
    if(isset($_POST['image']) &&$_POST['image']!=''){
        $image=',`image`="'.$_POST['image'].'"';
    }
    $textAligner='';
    if(isset($_POST['textAligner']) && $_POST['textAligner']!=''){
        $textAligner=',`textAligner`="'.$_POST['textAligner'].'"';
    }
    $jsonpage='';
    if(isset($_POST['jsonpage']) &&$_POST['jsonpage']!=''){
        $jsonpage=',`jsonpage`="'.$_POST['jsonpage'].'"';
    }
    $sort='';
    if(isset($_POST['sort']) &&$_POST['sort']!=''){
        $sort=',`sort`="'.$_POST['sort'].'"';
    }


    $sql="UPDATE `storypages` SET  `cdate`='".$date."' ".$text.$sound.$image.$textAligner.$jsonpage.$sort."  WHERE `id`=".$_POST['pageid'];
    if($con->query($sql)){
        echo 1;
    }else{
        echo $sql;
    }
}
//end khalid [000001-7-9-2016]
function updatestory(){
    global $con;
    if($_POST["seriesid"]!=$_POST["oldseriesid"] && $_POST["seriesid"]!=-1 && $_POST["oldseriesid"]!=-1){
        copyDirectory("../stories/".$_POST["oldseriesid"]."/story/".$_POST["storyid"],"../stories/".$_POST["seriesid"]."/story/".$_POST["storyid"]);
        //removeDirectory("../stories/".$_POST["oldseriesid"]."/story/".$_POST["storyid"]);
    }

    if(!is_dir("../stories/".$_POST["seriesid"]."/story/".$_POST["storyid"])){
        mkdir("../stories/".$_POST["seriesid"]."/story/".$_POST["storyid"]);
    }
    if(isset($_POST["front_cover"]) && $_POST["front_cover"]!=""){


        saveImageBase64($_POST["front_cover"],"../stories/".$_POST["seriesid"]."/story/".$_POST["storyid"]."/images/pic.jpg");
        $sql="UPDATE `story` set color='".getImageColor("../stories/".$_POST["seriesid"]."/story/".$_POST["storyid"]."/images/pic.jpg")."' WHERE storyid=".$_POST['storyid'];
        $con->query($sql);
    }

    if(isset($_POST["back_cover"]) && $_POST["back_cover"]!=""){
        saveImageBase64($_POST["back_cover"],"../stories/".$_POST["seriesid"]."/story/".$_POST["storyid"]."/images/back.jpg");
    }
    if(isset($_POST["demo_cover"]) && $_POST["demo_cover"]!=""){
        saveImageBase64($_POST["demo_cover"],"../stories/".$_POST["seriesid"]."/story/".$_POST["storyid"]."/images/demo_cover.jpg");
    }
    $sql="UPDATE `story` SET `seriesid`=".$_POST["seriesid"].",`author_en`='".mysqli_real_escape_string($con,$_POST["author_en"])."',`author_ar`='".mysqli_real_escape_string($con,$_POST["author_ar"])."',`catid`=".$_POST["category"].",`description_ar`='".mysqli_real_escape_string($con,$_POST["descriptionar"])."',`description_en`='".mysqli_real_escape_string($con,$_POST["descriptionen"])."',`parenttext`='".mysqli_real_escape_string($con,$_POST["parenttext"])."',
          `price`=".$_POST["price"].",`title`='".mysqli_real_escape_string($con,$_POST["title"])."',`type`=".$_POST["booktype"].",`isbn`='".mysqli_real_escape_string($con,$_POST["isbn"])."',`covertype`=".$_POST["binding"].",`weight`=".$_POST["weight"].",
          `language`='".$_POST["language"]."',`eprice`=".$_POST["eprice"].",`iprice`=".$_POST["iprice"].",`awidth`=".$_POST["awidth"].",`aheight`=".$_POST["aheight"].",`age`=".$_POST["age"].",
          `year`=".$_POST["year"].",`status`=".$_POST["ispublished"].",`filling`='".$_POST["story_register"]."',`pages_count`=".$_POST["story_pagescount"].",range_first=".$_POST["firstpage"].",range_end=".$_POST["lastpage"]."
          ,kidstext='".mysqli_real_escape_string($con,$_POST["kidstext"])."',
           `sseodescription_en`='".mysqli_real_escape_string($con,$_POST['seodescription_en'])."',
           `sseodescription_ar`='".mysqli_real_escape_string($con,$_POST['seodescription_ar'])."',`oldprice`=".$_POST["oldprice"].",`package`=".$_POST["package"].",`store`=".$_POST['store']." ,`publisher`=".$_POST['publisher']."
           WHERE storyid=".$_POST["storyid"];
    if($con->query($sql)){
        echo 1;
    }else{
        echo $sql;
    }
}
function updategame(){
    global $con;
    if(isset($_POST["thumb"]) && $_POST["thumb"]!=""){
        if(!is_dir("../games/".$_GET["gameid"])){
            @mkdir("../games/".$_GET["gameid"]);
        }
        if(!is_dir("../games/".$_GET["gameid"]."/images")){
            @mkdir("../games/".$_GET["gameid"]."/images");
        }

        saveImageBase64($_POST["thumb"],"../games/".$_GET["gameid"]."/images/thumb.jpg");
    }
    if(isset($_POST["largethumb"]) && $_POST["largethumb"]!=""){
        if(!is_dir("../games/".$_GET["gameid"])){
            @mkdir("../games/".$_GET["gameid"]);
        }
        if(!is_dir("../games/".$_GET["gameid"]."/images")){
            @mkdir("../games/".$_GET["gameid"]."/images");
        }

        saveImageBase64($_POST["largethumb"],"../games/".$_GET["gameid"]."/images/image_larg.jpg");
    }
    if(isset($_POST["Coloring_image"]) && $_POST["Coloring_image"]!=""){
        if(!is_dir("../games/".$_GET["gameid"])){
            @mkdir("../games/".$_GET["gameid"]);
        }
        if(!is_dir("../games/".$_GET["gameid"]."/images")){
            @mkdir("../games/".$_GET["gameid"]."/images");
        }

        saveImageBase64($_POST["Coloring_image"],"../games/".$_GET["gameid"]."/images/Coloring_image.png");
    }

    $sql="UPDATE `editors` SET `title_ar`='".mysqli_real_escape_string($con,$_POST["title_ar"])."',`title_en`='".mysqli_real_escape_string($con,$_POST["title_en"])."',
        `description_ar`='".mysqli_real_escape_string($con,$_POST["descriptionar"])."',`description_en`='".mysqli_real_escape_string($con,$_POST["descriptionen"])."',
        `category`=".$_POST["category"].",`grade`=".$_POST["game_age"].",`status`=".$_POST["ispublished"].",`editor`='".$_POST["editor"]."',`price`=".$_POST["price"].",
        `language`='".$_POST["language"]."',`bookid`=".$_POST["refbook"]." WHERE gameid=".$_GET["gameid"];


    if($con->query($sql)){
        if($_POST["editor"]=="connected_dots" || $_POST["editor"]=="labeling"|| $_POST["editor"]=="click_map" || $_POST["editor"]=="fill_in_the_blanks"|| $_POST["editor"]=="matching"|| $_POST["editor"]=="coloring" || $_POST["editor"]=="difference_between" || $_POST["editor"]=="maze" || $_POST["editor"]=="tracing"){
            $path="platform/".$_POST["editor"]."/viewer/".strtolower($_POST["language"])."/index.php?id=".$_GET["gameid"];
        }else{
            $path="platform/".$_POST["editor"]."/viewer/index.php?id=".$_GET["gameid"];
        }

        $sql="SELECT * FROM `media` WHERE `type`=11 AND `productid`=".$_GET["gameid"];
        $result=$con->query($sql);
        if(mysqli_num_rows($result)>0){
            $sql="UPDATE `media` SET `title_ar`='".mysqli_real_escape_string($con,$_POST["title_ar"])."',`title_en`='".mysqli_real_escape_string($con,$_POST["title_en"])."',`category`=".$_POST["category"].",
            `userid`=".$_SESSION["user"]["userid"].",`cdate`=CURDATE(),`status`=".$_POST["ispublished"].",`language`='".$_POST["language"]."',`description_en`='".mysqli_real_escape_string($con,$_POST["descriptionen"])."',
            `description_ar`='".mysqli_real_escape_string($con,$_POST["descriptionar"])."',`price`=".$_POST["price"].",`grade`=".$_POST["game_age"].",`path`='".$path."'  WHERE `type`=11 AND `productid`=".$_GET["gameid"];
            $con->query($sql);
        }else{
            $sql="INSERT INTO `media`(`id`, `title_ar`, `title_en`, `category`, `userid`, `cdate`, `status`, `language`, `description_en`, `description_ar`, `price`, `grade`, `type`,`path`, `productid`) VALUES
            ('','".mysqli_real_escape_string($con,$_POST["title_ar"])."','".mysqli_real_escape_string($con,$_POST["title_en"])."',".$_POST["category"].",".$_SESSION["user"]["userid"].",CURDATE(),".$_POST["ispublished"].",
            '".$_POST["language"]."','".mysqli_real_escape_string($con,$_POST["descriptionen"])."','".mysqli_real_escape_string($con,$_POST["descriptionar"])."',".$_POST["price"].",".$_POST["game_age"].",11,'".$path."',
            ".$_GET["gameid"].")";
            $con->query($sql);
        }
        echo 1;
    }else{
        echo $sql;
    }
}
function updateplaylist(){
    global $con;
    if(isset($_POST["thumb"]) && $_POST["thumb"]!=""){
        saveImageBase64($_POST["thumb"],"../playlist/thumbs/".$_GET["id"].".jpg");
    }
    if(isset($_POST["largethumb"]) && $_POST["largethumb"]!=""){
        saveImageBase64($_POST["largethumb"],"../playlist/thumbs/".$_GET["id"]."_larg.jpg");
    }

    $sql="UPDATE `playlist` SET `title_ar`='".mysqli_real_escape_string($con,$_POST["title_ar"])."',`title_en`='".mysqli_real_escape_string($con,$_POST["title_en"])."',
        `description_ar`='".mysqli_real_escape_string($con,$_POST["descriptionar"])."',`description_en`='".mysqli_real_escape_string($con,$_POST["descriptionen"])."',
        `category`=".$_POST["category"].",`grade`=".$_POST["playlist_age"].",`status`=".$_POST["ispublished"].",`type`=".$_POST["type"].",`price`=".$_POST["price"].",
        `language`='".$_POST["language"]."' WHERE id=".$_GET["id"];


    if($con->query($sql)){
        $sql="DELETE FROM `playlist_media` WHERE playlistid=".$_GET["id"];
        $con->query($sql);
        $media_arr=json_decode($_POST["media"]);
        foreach($media_arr as $media){
            $sql="INSERT INTO `playlist_media`(`playlistid`, `mediaid`,`title`,`type`) VALUES (".$_GET["id"].",".$media["mediaid"].",'".mysqli_real_escape_string($con,$media["title"])."',".$media["type"].")";
            $con->query($sql);
        }
        echo 1;
    }else{
        echo $sql;
    }
}
function updatestorypage(){
    global $con;
    if(isset($_POST["thumbnail"]) && $_POST["thumbnail"]!=""){
        saveImageBase64($_POST["thumbnail"],"../stories/".$_POST["seriesid"]."/story/".$_POST["storyid"]."/images/".$_POST["pageid"]."-compressed.jpg");
    }

    $sql="UPDATE `storypages` SET `text`='".mysqli_real_escape_string($con,$_POST["text"])."',`sound`='sound/".$_POST["pageid"].".mp3',`image`='".mysqli_real_escape_string($con,"stories/".$_POST["seriesid"]."/story/".$_POST["storyid"]."/images/".$_POST["pageid"]."-compressed.jpg")."' WHERE `id`=".$_POST["pageid"];
    if($con->query($sql)){
        echo 1;
    }else{
        echo $sql;
    }
}
function uploadpagesound(){

    if (isset($_FILES['sound']) && !empty($_FILES['sound'])) {
        $target_path = "../stories/".$_POST["seriesid"]."/story/".$_POST["storyid"]."/sound/";     // Declaring Path for uploaded images.
        $ext = explode('.', strtolower(basename($_FILES['sound']['name'])));   // Explode file name from dot(.)
        $file_extension = end($ext); // Store extensions in the variable.
        $target_path = $target_path .$_POST["pageid"] . "." . $ext[count($ext) - 1];     // Declaring Path for uploaded images.
        if (in_array($file_extension, array("mp3"))) {
            move_uploaded_file($_FILES['sound']['tmp_name'], $target_path);
        }
    }
}
function updateseries(){
    global $con;
    if(isset($_POST["thumbnail"]) && $_POST["thumbnail"]!=""){
        saveImageBase64($_POST["thumbnail"],"../stories/".$_GET["seriesid"]."/images/Thumb.png");
    }
    $sql="UPDATE `series` SET `name`='".$_POST["title"]."',`description`='".$_POST["description"]."',`advice`='".$_POST["advice"]."',`category`=".$_POST["category"]." WHERE `seriesid`=".$_GET["seriesid"];
    if($con->query($sql)){
        echo 1;
    }else{
        echo $sql;
    }
}
//start khalid [000001-7-9-2016]
function deleteDirectory($dir){

    if (!file_exists($dir)) return true;
    if (!is_dir($dir) || is_link($dir)) return unlink($dir);
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') continue;
        if (!deleteDirectory($dir . "/" . $item)) {
            chmod($dir . "/" . $item, 0777);
            if (!deleteDirectory($dir . "/" . $item)) return false;
        };
    }
    return @rmdir($dir);
}
//end khalid [000001-7-9-2016]
function savesurfsound(){
    global $con;
    $data=json_decode($_POST["sound"],true);
    $sql="UPDATE `storypages` SET textAligner='".mysqli_real_escape_string($con,json_encode($data['textAligner']))."' WHERE `id`=".$data["pageid"];
    if($con->query($sql)){
        echo 1;
    }else{
        echo $sql;
    }
}
function updatestorypagesort(){
    global $con;
    $data=json_decode($_POST["pages"],true);
    foreach($data as $id=>$sort){
        $sql="UPDATE `storypages` SET sorting=".$sort." WHERE `id`=".$id;
        $con->query($sql);
    }
    echo 1;
}
function resize_image($file, $w, $h,$dest) {
    list($width, $height) = getimagesize($file);
    $r = $width / $height;
    if ($w/$h > $r) {
        $newwidth = $h*$r;
        $newheight = $h;
    }else{
        $newheight = $w/$r;
        $newwidth = $w;
    }
    $src = imagecreatefromjpeg($file);
    $img = imagecreatetruecolor($newwidth, $newheight);
    imagecopyresampled($img, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    imagejpeg($img, $dest);
}
function updateunit(){
    global $con;
    if(isset($_GET["unitid"]) && $_GET["unitid"]=="new"){
        $sql="INSERT INTO `units_lessons`(`ulid`, `bookid`, `pageid`, `type`, `title`) VALUES ('',".$_GET["bookid"].",".$_GET["pagenumber"].",'unit','".mysqli_real_escape_string($con,$_GET["unitname"])."')";
        if($con->query($sql)){
            echo 1;
        }else{
            echo $sql;
        }
    }else{
        $sql="UPDATE `units_lessons` SET `bookid`=".$_GET["bookid"].", `pageid`=".$_GET["pagenumber"].", `title`='".mysqli_real_escape_string($con,$_GET["unitname"])."' WHERE `ulid`=".$_GET["unitid"];
        if($con->query($sql)){
            echo 1;
        }else{
            echo $sql;
        }
    }

}
function updatelesson(){
    global $con;
    if(isset($_GET["lessonid"]) && $_GET["lessonid"]=="new"){
        $sql="INSERT INTO `units_lessons`(`ulid`, `bookid`, `pageid`, `type`, `title`, `unitid`) VALUES ('',".$_GET["bookid"].",".$_GET["pagenumber"].",'lesson','".mysqli_real_escape_string($con,$_GET["lessonname"])."',".$_GET["unitid"].")";
        if($con->query($sql)){
            echo 1;
        }else{
            echo $sql;
        }
    }else{
        $sql="UPDATE `units_lessons` SET `bookid`=".$_GET["bookid"].", `pageid`=".$_GET["pagenumber"].", `title`='".mysqli_real_escape_string($con,$_GET["lessonname"])."',`unitid`=".$_GET["unitid"]." WHERE `ulid`=".$_GET["lessonid"];
        if($con->query($sql)){
            echo 1;
        }else{
            echo $sql;
        }
    }
}
function addquesttion(){
    global $con;
    global $Lang;

    $sql="SELECT max(`quiz_sort`) as sorting FROM `questions` WHERE `quizid`=".$_POST['quizid'];
    $result=$con->query($sql);
    $row=mysqli_fetch_assoc($result);
    $quiz_sort=$row['sorting']+1;

    $sql="INSERT INTO `questions`(`quistionid`,`id_user`,`quizid`, `cdate`, `quiz_sort`, `question`,`answer_html`,`type`,`point_correct`) VALUES ('',".$_SESSION["user"]["userid"].",".$_POST['quizid'].", CURDATE(),".$quiz_sort.",'".mysqli_real_escape_string($con,$_POST["question"])."','".mysqli_real_escape_string($con,$_POST["answer_html"])."',".$_POST["type"].",10);";
    $con->query($sql);
    $questionid=$con->insert_id;
    $dataResult["result"]=1;
    $dataResult["id"]=$questionid;
    $dataResult["sql"]=$sql;
    echo json_encode($dataResult);
}
function getquesttion(){
    global $con;
    global $Lang;

    $sql="SELECT * FROM `quiz` WHERE `quizid`=".$_POST['quizid'];
    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        if($row["userid"]==$_SESSION["user"]["userid"] || $_SESSION["user"]["permession"]==1){
            $sql="SELECT * FROM `questions` WHERE `quistionid`=".$_POST['questionid'];
            $result=$con->query($sql);
            $row=mysqli_fetch_assoc($result);
            $dataResult=$row;
            $dataResult["result"]=1;
        }else{
            $dataResult["result"]=-2;
            $dataResult["msg"]="no permession";
        }
    }else{
        $dataResult["result"]=-1;
        $dataResult["msg"]="invalid quiz id";
    }
    echo json_encode($dataResult);
}
function sortquestions(){
    global $con;
    global $Lang;

    foreach($_POST["order"] as $order=>$id){
        $sql="UPDATE `questions` SET `quiz_sort`=$order WHERE `quistionid`=".$id;
        $con->query($sql);
    }
    $dataResult["result"]=1;
    $dataResult["sql"]=$sql;
    echo json_encode($dataResult);
}
function updatequiz(){
    global $con;
    $pass_failed=json_encode(array("Pass"=>$_POST["quiz_passedj"],"Failed"=>$_POST["quiz_failedj"]));
    $sql="UPDATE `quiz` SET `category`='".$_POST['Category']."',`title`='".mysqli_real_escape_string($con,$_POST['title'])."',`Introduction`='".mysqli_real_escape_string($con,$_POST['introduction'])."',
    `age`='".$_POST['age']."',`passing_rate`='".$_POST['passing_rate']."',`result`='".mysqli_real_escape_string($con,$pass_failed)."',`passed`='".$_POST['passed']."',`failed`='".$_POST['failed']."',
    `language`='".$_POST['language']."',`is_public`=".$_POST['is_public'].",`quiz_time`=".$_POST["quiz_time"]." WHERE quizid='".$_POST['quizid']."'";
    if ($con->query($sql)) {
        $dataResult["result"]=1;
    }else{
        $dataResult["result"]=0;
        $dataResult["sql"]=$sql;
    }
    echo json_encode($dataResult);
}
function setresult()
{
    global $con;
    $userid = -1;
    if (isset($_SESSION["user"])) {
        $userid = $_SESSION["user"]["userid"];
    }

    $sql = "INSERT INTO `quiz_result`(`id`, `userid`, `name`, `quizid`, `result`, `quiz_time`, `quiz_q_result`, `date`) VALUES (null," . $userid . ",'" . ($_POST['username']) . "'," .$_POST['id'] . ",'" . ($_POST['result']) . "','" . $_POST["quiz_time"] . "'," . $_POST["quiz_q_result"] . ", NOW())";
   echo $sql;
    if ($con->query($sql)) {
        echo 1;
    } else {
        echo 0;
    }
}
function createiOSbook($bookid=815,$book=false){
    global $con;
    if($book===false){
        $sql = "SELECT `books`.*,`categories`.* FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`bookid`=".$bookid;
        $result=$con->query($sql);
        $book=mysqli_fetch_assoc($result);
    }

    $dir="../books/".$bookid."_iOS";
    if(is_dir($dir)){
        removeDirectory($dir);
    }
    copyDirectory("../books/".$bookid,$dir);
    copyDirectory("../books/yearly",$dir);

    $pages_aray=array();
    $pages = scandir($dir);
    $pre='<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<link rel="stylesheet" type="text/css" href="style.css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="main.js"></script>
</head><body>';
    $suff='</body></html>';
    $page_count=0;
    foreach($pages as $key=>$page) {
        if(!($page == '.' || $page == '..')) {
            if(substr($page,0,1)=="p" && substr($page,5)==".html"){
                $contents=$pre.file_get_contents($dir."/".$page).$suff;
                file_put_contents($dir."/".$page,$contents);
                $page_count++;
            }
        }
    }
    $book["pages_count"]=$page_count;
    file_put_contents($dir."/info.json",json_encode($book));
}

?>

