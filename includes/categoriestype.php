<?php
/**
 * Created by PhpStorm.
 * User: khalid
 * Date: 30/08/2018
 * Time: 02:03 م
 */
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
if(isset($_GET["lang"]) && $_GET["lang"]!=""){
    $_SESSION["lang"]=ucfirst($_GET["lang"]);
}elseif(!isset($_SESSION["lang"])){
    $_SESSION["lang"]="En";
}

include_once '../platform/config.php';
$lang_code=strtolower($_SESSION["lang"]);

   // $Lang= simplexml_load_file("../language/".$_SESSION["lang"].".xml");



if(isset($_POST['TypeProcesses'])){
    $_POST['TypeProcesses']();
}
function getCategoriescount()
{
    if(!isset($_POST['type'])){
        return;
    }
     $type=$_POST['type'];
    global $con;
    global $lang_code;
    if($lang_code!="ar" && $lang_code!="en"){
        $cat_code="ar";
    }else{
        $cat_code=$lang_code;
    }
    $data='';
    $select='';
    switch ($type) {
        case 'books':
            $sql = "SELECT * FROM `categories` WHERE `count`>0 ORDER BY `categories`.`name_" . $cat_code . "`";
            $result = $con->query($sql);
            while ($category = mysqli_fetch_assoc($result)) {
                $data.='<a class="item-container hussam_'.$cat_code.' floating-left"';
                $data.='href="'.SITE_URL . $lang_code.'/books/category/'. $category['catid'].'/'. strtolower(str_replace(" ", "-", $category['name_'.$cat_code])).'">';
                $data.='<label class="floating-left " ';
                $data.='style="background-image: url('.SITE_URL.'themes/main-Light-green-'. $_SESSION["lang"].'/images/cat/books/'. $category['catid'].'.svg)"></label>';
                $data.='<div class="floating-left title">'.$category['name_' . $cat_code].'</div>';
                $data.='<span><div>'.$category['count'].'</div></span></a>';
            }
            $data.='';
            echo $data;

            break;
        case 'stories':
            $sql = "SELECT * FROM `stories_cat` WHERE `count`>0  ORDER BY `stories_cat`.`name_" . $cat_code . "`";
            $result = $con->query($sql);
            while ($category = mysqli_fetch_assoc($result)) {
                $data.='<a class="item-container floating-left"';
                $data.='href="'.SITE_URL . $lang_code.'/stories/category/'.$category['catid'].'/'. str_replace(" ", "-", $category['name_'.$cat_code]).'">';
                $data.='<label class="floating-left " ';
                $data.='style="background-image: url('.SITE_URL.'themes/main-Light-green-'.$_SESSION["lang"].'/images/cat/stories/'.$category['catid'].'.svg)"></label>';
                $data.='<div class="floating-left title">'.$category['name_' . $cat_code].'</div>';
                $data.='<span><div>'.$category['count'].'</div></span></a>';
            }
            echo $data;
            break;
        case 'worksheet':
            $sql = "SELECT * FROM `categories` WHERE `wcount`>0 ORDER BY `categories`.`name_".$cat_code."`";
            $result = $con->query($sql);
            while ($category = mysqli_fetch_assoc($result)) {
                $data.='<a class="item-container floating-left"';
                $data.='href="'.SITE_URL . $lang_code.'/worksheet/category/'. $category['catid'].'/'. strtolower(str_replace(" ", "-", $category['name_'.$cat_code])).'">';
                $data.='<label class="floating-left" style="background-image: url('.SITE_URL.'themes/main-Light-green-'. $_SESSION["lang"].'/images/cat/books/'. $category['catid'].'.svg)"></label>';
                $data.='<div class="floating-left title">'.$category['name_' . $cat_code].'</div>';
                $data.='<span><div>'. $category['wcount'].'</div></span></a>';
            }
            echo $data;
            break;
        case 'games':
            $sql = "SELECT * FROM `categories` WHERE `wcount`>0 ORDER BY `categories`.`name_" . $cat_code . "`";
            $result = $con->query($sql);
            while ($category = mysqli_fetch_assoc($result)) {
            if($category['Gcount']>0){
                $data.='<a class="item-container floating-left"';
                $data.='href="'.SITE_URL . $lang_code.'/games/category/'. $category['catid'].'/'. strtolower(str_replace(" ", "-", $category['name_'.$cat_code])).'">';
                $data.='<label class="floating-left" style="background-image: url('. SITE_URL.'themes/main-Light-green-'. $_SESSION["lang"].'/images/cat/books/'. $category['catid'].'.svg)"></label>';
                $data.='<div class="floating-left title">'. $category['name_' . $cat_code].'</div>';
                $data.='<span><div>'.$category['Gcount'].'</div></span></a>';
            }}
            echo $data;
            break;
        case 'video':
                $sql = "SELECT * FROM `categories` WHERE `wcount`>0 ORDER BY `categories`.`name_" . $cat_code . "`";
                $result = $con->query($sql);
                while ($category = mysqli_fetch_assoc($result)) {
                    if($category['Vcount']>0){
                        $data.='<a class="item-container floating-left"';
                        $data.='href="'. SITE_URL . $lang_code.'/video/category/'. $category['catid'].'/'. strtolower(str_replace(" ", "-", $category['name_'.$cat_code])).'">';
                        $data.='<label class="floating-left" style="background-image: url('. SITE_URL.'themes/main-Light-green-'. $_SESSION["lang"].'/images/cat/books/'. $category['catid'].'.svg)"></label>';
                        $data.='<div class="floating-left title">'. $category['name_' . $cat_code].'</div>';
                        $data.='<span><div>'. $category['Vcount'].'</div></span> </a>';
                }}
            echo $data;
            break;
        default:
            $data.=' ';
            echo $data;
            break;
    }

}