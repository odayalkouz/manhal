<?php
/**
 * Created by PhpStorm.
 * User: New Dept5
 * Date: 16/03/2017
 * Time: 04:38 م
 */
if(session_status()==PHP_SESSION_NONE){
    session_start();
}

$_SESSION["counter1"]=0;
$_SESSION["start_counter"]=0;
//$_SESSION["start_url"]="https://www.manhal.com/";
//$_SESSION["main_url"]="https://www.manhal.com/";
$_SESSION["start_url"]="http://localhost/Manhal/";
$_SESSION["main_url"]="http://localhost/Manhal/";
$_SESSION["scanned"] = array ();
if(is_file("sitemap.xml")){
    unlink("sitemap.xml");
}
?>