<?php
/**
 * Created by PhpStorm.
 * User: New Dept5
 * Date: 1/4/2016
 * Time: 1:19 PM
 */
if(session_status()==PHP_SESSION_NONE){
    session_start();
}


if(isset($_GET['lang']) && $_GET['lang']=="En"){
    $langURL="lang=En";
    setcookie("lang","En",time()+COOKIE_EXPIRE,"/");
    $_SESSION["lang"]="En";
}elseif(isset($_GET['lang']) && $_GET['lang']=="Ar"){
    $langURL="lang=Ar";
    setcookie("lang","Ar",time()+COOKIE_EXPIRE,"/");
    $_SESSION["lang"]="Ar";
}elseif(isset($_GET['lang']) && $_GET['lang']=="Fr"){
    $langURL="lang=Fr";
    setcookie("lang","Fr",time()+COOKIE_EXPIRE,"/");
    $_SESSION["lang"]="Fr";
}else{
    if(isset($_COOKIE['lang']) && $_COOKIE['lang']=="Ar") {
        $langURL="lang=Ar";
        setcookie("lang","Ar",time()+COOKIE_EXPIRE,"/");
        $_SESSION["lang"]="Ar";
    }elseif(isset($_COOKIE['lang']) && $_COOKIE['lang']=="Fr") {
        $langURL="lang=Fr";
        setcookie("lang","Fr",time()+COOKIE_EXPIRE,"/");
        $_SESSION["lang"]="Fr";
    }else{
        $langURL="lang=En";
        setcookie("lang","En",time()+COOKIE_EXPIRE,"/");
        $_SESSION["lang"]="En";
    }
}
$Lang = simplexml_load_file("../language/".$_SESSION["lang"].".xml");
$lang_code=strtolower($_SESSION["lang"]);
?>