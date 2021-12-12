<?php
/**
 * Created by Dar Almanhal publishers - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 01/02/2018
 * Time: 03:35 م
 */


include_once "../platform/config.php";
include_once "../includes/function.php";

$sql="SELECT * FROM `payment_subscribe` WHERE `status`=1 AND `expire_date`< CURDATE()";
$result=$con->query($sql);
while($row=mysqli_fetch_assoc($result)){
    $sql="UPDATE `payment_subscribe` SET `status`=0 WHERE `psid`=".$row["psid"];
    $con->query($sql);

    $sql="UPDATE `users` SET `permession`=0 WHERE `userid`=".$row["userid"];
    $con->query($sql);

    $sql="UPDATE `users` SET `permession`=0 WHERE `activation_code`=".$row["users_code"];
    $con->query($sql);

    $sql="UPDATE `users` SET `permession`=0 WHERE `activation_code`=".$row["teachers_code"];
    $con->query($sql);

}

?>