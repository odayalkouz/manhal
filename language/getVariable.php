<?php
/**
 * Created by Dar Almanhal Publishers - Hussam Abu Khadijeh.
 * User: hussam
 * Date: 23/03/2015
 * Time: 11:46 ص
 */
if(session_status()==PHP_SESSION_NONE){
    session_start();
}

if(isset($_SESSION["lang"]) && $_SESSION["lang"]!=""){
    $Lang = simplexml_load_file(ucfirst($_SESSION["lang"]).".xml");
}else{
    $Lang = simplexml_load_file("En.xml");
}
echo json_encode($Lang);
?>