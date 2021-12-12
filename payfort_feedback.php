<?php
/**
 * Created by Dar Al-Manhal -Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 3/1/2017
 * Time: 9:43 AM
 */
if(session_status()==PHP_SESSION_NONE){
    session_start();
}

include_once "platform/config.php";
include_once "includes/function.php";
$msg="";

if(isset($_GET["status"]) && $_GET["status"]!=""){
    if(isset($_GET["signature"]) && $_GET["signature"]!=""){
        if(isset($_GET["command"]) && $_GET["command"]=="PURCHASE"){//Payment Success Response
            $data=getPayfortData($_GET);
            $signature=calculateSignature($data,"response");
            if($signature==$_GET["signature"]){
                if($_GET["status"]==14){
                    $sql="SELECT * FROM `payment_temp` WHERE `payment_ref`='".$_GET["merchant_reference"]."'";
                    $result=$con->query($sql);
                    if(mysqli_num_rows($result)>0){
                        $row=mysqli_fetch_assoc($result);
                        $_SESSION=json_decode($row["data"],true);
                        $data=$_SESSION["payfort"];
                        $data["success"]=$_GET;
                        $data=json_encode($data);
                        savePaymentToDB($data);
                        $sql="Update `payment_temp` SET `status`=1 WHERE `payment_ref`='".$_GET["merchant_reference"]."'";
                        $con->query($sql);
                        file_put_contents("payfort.txt","Done");
                    }else{
                        $msg="Error_Unexpected_Error_0203171126_Session_not_found_ib_db".$_GET["merchant_reference"];
                    }
                }else{
                    $msg="Error_Unexpected_Error_222170405_".$_GET["status"]."_".$_GET["response_message"];
                }
            }else{
                $msg="Error_Security_Issue_222170404";
            }
        }else{
            $msg="Error_Data_Missing_222170936";
        }
    }else{
        $msg="Error_Data_Missing_222170941";
    }
}else{
    $msg="Error_Data_Missing_222170934";
}
if($msg!=""){
    logError("4");//location 4
    echo $msg;
    file_put_contents("payfort.txt",$msg);
}


?>

