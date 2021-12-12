<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 8/11/2016
 * Time: 8:29 AM
 */
if(session_status()==PHP_SESSION_NONE){
    session_start();
}

include_once "../config.php";
include_once "../includes/function.php";


if(isset($_GET['process']) && $_GET['process']!="") {
    $_GET['process']();
}
//https://www.manhal.com/platform/ajax/massa.php?email=mail&type=type&code=code&seriesid=0&storyid=0&process=register
function register(){
    if(isset($_GET["seriesid"]) && $_GET["seriesid"]!=0){
        $seriesid=$_GET["seriesid"];
    }else{
        $seriesid=0;
    }

    if(isset($_GET["storyid"]) && $_GET["storyid"]!=0){
        $storyid=$_GET["storyid"];
    }else{
        $storyid=0;
    }
    $msg="";
    if(isset($_GET["email"]) && $_GET["email"]!=""){
        if(isset($_GET["code"]) && $_GET["code"]!="" && is_numeric($_GET["code"])){
            registerCode($_GET["email"],$_GET["type"],$_GET["code"],$seriesid,$storyid);
        }else{
            $msg="Error invalide code number";
        }
    }else{
        $msg="Error Email cannot be Empty";
    }

    if($msg!=""){
        echo json_encode(array("result"=>0,"msg"=>$msg));
    }
}
function  checkseries(){
    global $con;
    $msg="";
    if(isset($_GET["seriesid"]) && $_GET["seriesid"]!=0 && $_GET["seriesid"]!=0){
        $seriesid=$_GET["seriesid"];
    }else{
        $msg="Error Invalid series ID";
    }

    if(isset($_GET["email"]) && $_GET["email"]!=""){
        $email=$_GET["email"];
    }else{
        $msg="Error Invalid email address";
    }
    if(isset($_GET["type"]) && $_GET["type"]!=""){
        $type=$_GET["type"];
    }else{
        $msg="Error Invalid type";
    }

    if($msg==""){
        $sql="SELECT * FROM `apps_codes` WHERE `email`='$email' AND type='$type' AND refid=".$seriesid;
        $result=$con->query($sql);
        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
            echo json_encode(array("result"=>1,"msg"=>"sucess","card"=>$row["code"],"activation_date"=>$row["activation_date"]));
        }else{
            echo json_encode(array("result"=>0,"msg"=>"Undefined user"));
        }
    }else{
        echo json_encode(array("result"=>0,"msg"=>$msg));
    }
}
function registerCode($email,$type,$code,$seriesid=0,$storyid=0){
    global $con;
    $msg="";

    $sql="SELECT * FROM `tries` WHERE email='".$email."'";
    $result=$con->query($sql);
    $datetime1 =  date('Y-m-d h:i:s a', time());
    if(mysqli_num_rows($result)>0){
        $try=mysqli_fetch_assoc($result);

        if($try['trytime']=="" || $try['trytime']=null){
            $datetime2 = '2011-10-10 10:00:00';
        }else{
            $datetime2 = $try['trytime'];
          }
        $interval  = abs($datetime2 - $datetime1);
        $minutes   = round($interval / 60);
        if($try['trynumber']>3){
            if($minutes<15){
                $msg="Try after ".$minutes." minutes";
                echo json_encode(array("result"=>-1,"msg"=>$msg));
                exit();
            }else{
                $sql="UPDATE `tries` trynumber=1,trytime='$datetime1' WHERE email='".$email."'";
                $con->query($sql);
            }
        }else{
            $sql="UPDATE `tries` trynumber=trynumber+1,trytime='$datetime1' WHERE email='".$email."'";
            $con->query($sql);
        }
    }else{
        $sql="INSERT INTO `tries`(`tryid`, `email`, `trynumber`, `trytime`) VALUES ('','".$email."',1,'$datetime1')";
        $con->query($sql);
    }

    switch($type){
        case "series":
            $sql="SELECT * FROM `apps_codes` WHERE `code`=$code AND refid=".$seriesid;
            break;
    }

    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        $card=mysqli_fetch_assoc($result);
        if($card["status"]==0){
            if($card["type"]==$type){
                $sql2="SELECT * FROM `users` WHERE `email`='".$email."'";
                $result2=$con->query($sql2);
                if(mysqli_num_rows($result2)>0){
                    $user=mysqli_fetch_assoc($result2);
                    $userid=$user["userid"];
                }else{
                    $sql2="INSERT INTO `users`(`userid`, `email`, `permession`, `cdate`, `status`) VALUES ('','$email',2,CURDATE(),1)";
                    $con->query($sql2);
                    $userid=mysqli_insert_id($con);
                }
                $sql="UPDATE `apps_codes` SET `userid`=$userid,`email`='$email', `activation_date`=CURDATE(),`status`=1 WHERE codeid=".$card['codeid'];
                //$sql="UPDATE `apps_codes` SET `userid`=$userid,`email`='$email', `activation_date`=CURDATE() WHERE codeid=".$card['codeid'];
                $con->query($sql);
            }else{
                $msg="Error Card number : ".$code." not valid for this product";
            }
        }else{
            $msg="Error Card number : ".$code." already used by another user";
        }
    }else{
        $msg="Error Card number : ".$code." Not exist";
    }

    if($msg!=""){
        echo json_encode(array("result"=>0,"msg"=>$msg));
    }else{
        echo json_encode(array("result"=>1,"msg"=>"success"));
    }

}

?>