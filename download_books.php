<?php
/**
 * Created by Dar Al-Manhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 13/04/2017
 * Time: 08:45 ص
 */
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
$msg="";
if(isset($_GET["downloadtype"]) && $_GET["downloadtype"]=="teacherbook"){
    if(isset($_GET["type"]) && $_GET["type"]=="pdf"){
        if(isset($_GET["bookid"]) && $_SESSION["allow_download"]["book"]==$_GET["bookid"]){
            downloadPDF("platform/books/secured/".$_GET["bookid"]."/teacher.pdf");
        }else{
            $msg="You don't have permession to download this file";
        }
    }elseif(isset($_GET["type"]) && $_GET["type"]=="exe"){
        if(isset($_GET["bookid"]) && $_SESSION["allow_download"]["book"]==$_GET["bookid"]){
            downloadEXE("platform/books/secured/".$_GET["bookid"]."/teacher.exe");
        }else{
            $msg="You don't have permession to download this file";
        }
    }else{
        $msg="else";
    }
}
echo $msg;

function downloadPDF($PDF){
    header('Content-Description: File Transfer');
    header("Content-type:application/pdf");
    //header("Content-Transfer-Encoding: Binary");
    header("Content-Disposition:attachment;filename=".basename($PDF));
    header('Content-Length:' . filesize($PDF));
    ob_clean();
    readfile($PDF);
    exit();
}
function downloadEXE($EXE){
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary");
    header("Content-Disposition:attachment;filename='".basename($EXE)."'");
    header('Content-Length:' . filesize($EXE));
    ob_clean();
    readfile($EXE);
    exit();
}
?>