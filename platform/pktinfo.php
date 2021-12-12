<?php
/**
 * Created by PhpStorm.
 * User: khalid alomiri
 * Date: 24/09/2016
 * Time: 09:19 ص
 */
$cuerrentpage="shippingwarehouse.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["user"])) {
    header('Location: login.php');
}
include_once('config.php');
include_once('includes/language.php');
?>
<?php
include_once('includes/function.php');
include_once('../includes/function.php');

$bredcrumb = '<li class="floating-left"><a href="infopayment.php" class="floating-left active">'.$Lang->Packetinformation.'</a></li>';

include "includes/header.php";
?>
<div class="books-container">
<div class="display-table">
    <!--start table caption-->
    <div class="disply-table-caption table-title">
        <div class="display-table-cell carton-25"><?= $Lang->NumberOfCartons?></div>
        <div class="display-table-cell carton-25"><?= $Lang->Totalweight?></div>
        <div class="display-table-cell carton-25"><?= $Lang->Shippingaddress?></div>
        <div class="display-table-cell carton-25"><?= $Lang->shipingmethod?></div>
    </div>
    <!--end table caption-->
    <!--start table rows-->
    <?php
    $edit = true;
    $sql = "Select payments.billing_fullname, payments.shipping, pkt.*, payments.billing_country, payments.billing_city From pkt Inner Join payments On pkt.idpayment = payments.paymentid Where pkt.idpayment = " . $_GET['id'] ;

    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        $edit = false;

        while ($row = mysqli_fetch_assoc($result)) {

            echo "<div  class='display-table-row'>
        <div class='display-table-cell carton-25'>".$row['cartons']."</div>
        <div class='display-table-cell carton-25'>".$row['weightcartons']."</div>
        <div class='display-table-cell carton-25'>".$row['billing_country']."   ".$row['billing_city']."</div>
        <div class='display-table-cell carton-25'>".$row['shipping']."</div>
    </div>";
        }
    }


    ?>


</div>
</div>
<?php
include "includes/footer.php";
?>

<div class="container" id="viewinfo_container" style="display: none;overflow: auto;;min-height:300px;border: 1px solid #00AB67;padding: 20px;background: #fff">
</div>