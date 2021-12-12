<?php
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
//remove session parameters
$_SESSION["user"] = "";

unset($_SESSION['user']);

session_unset();
session_destroy();

header("Location:login.php");
exit;
?>
