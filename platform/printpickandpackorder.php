<?php
/**
 * Created by PhpStorm.
 * User: khalid alomiri
 * Date: 24/09/2016
 * Time: 09:19 ص
 */
//include "includes/header.php";
include_once('config.php');
include_once('includes/language.php');
include_once('includes/function.php');
include_once('../includes/function.php');

?>

<?php
$sql = "SELECT * FROM `payments` WHERE `paymentid`=".$_GET['id'];
$result = $con->query($sql);
$payments_row = mysqli_fetch_assoc($result)


?>
<html>
<head>
   <script type="text/javascript" src="<?=SITE_URL ?>js/lang.js"></script>
   <link rel="stylesheet" type="text/css" href="themes/Light-green-<?=$_SESSION["lang"];?>/css/style.css">
   <link rel="stylesheet" type="text/css" href="themes/Light-green-<?=$_SESSION["lang"];?>/fonts/fonts.css">
   <link rel="stylesheet" type="text/css" href="themes/Light-green-<?=$_SESSION["lang"];?>/css/matching.css">
</head>
<section class="invoice-container">
    <?=$Lang->pickandpackorder;?>
<div class="books-container">

    <div class="invoice-bottom" style="margin: 0px 0px 20px 0px">
        <div class="receiver-container">
            <div class="line-row-bill floating-left">
                <label class="floating-left"><?= $Lang->INVNumber?></label>
                <div class="floating-left"><?=$_GET['id']?></div>
            </div>
            <div class="line-row-bill floating-left">
                <label class="floating-left"><?= $Lang->Name?></label>
                <div class="floating-left"><?=$payments_row['billing_firstname']." ".$payments_row['billing_lastname']?></div>
            </div>
            <div class="line-row-bill floating-left">
                <label class="floating-left"><?= $Lang->Shippingmethod?></label>
                <div class="floating-left"><?=$payments_row['shipping']?></div>
            </div>
        </div>
    </div>
    <div class="display-table pktprint">
    <!--start table caption-->
    <div class="disply-table-caption table-title ">
        <div class="display-table-cell number1"><?= $Lang->No?></div>
        <div class="display-table-cell quantity"><?= $Lang->Quantity?></div>
        <div class="display-table-cell title1"><?= $Lang->Title?></div>
        <div class="display-table-cell ispn"><?= $Lang->ISBN?></div>
        <div class="display-table-cell type"><?= $Lang->Type?></div>
        <div class="display-table-cell stock"><?= $Lang->stock?></div>
    </div>
    <!--end table caption-->
    <!--start table rows-->









        <?php
        $sql = "Select payments_books.*, books.*,story.* From payments_books Left Join books On payments_books.bookid = books.bookid Left Join
  story On payments_books.bookid = story.storyid  where payments_books.paymentid=".$_GET['id']." and ( payments_books.`type`=1 or payments_books.`type`=3 or payments_books.`type`=5 or payments_books.`type`=7 )"; ;

        $result = $con->query($sql);
        $data = '';
        $Quantity=0;

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $i = 1;
            while ($row = mysqli_fetch_assoc($result)) {
                $data .= "<div  class='display-table-row #class#'>";
                $data .= "<div class='display-table-cell number1'>".$i."</div>";
                $data .= "<div class='display-table-cell quantity'>" . $row['quantity'] . "</div>";
                $data .= "<div class='display-table-cell title1'>" . $row['title'] . "</div>";
                $data .= "<div class='display-table-cell ispn'>" . $row['isbn'] . "</div>";
                $data .= "<div class='display-table-cell type'>" . $row['itemtype'] . "</div>";
                $data .= "<div class='display-table-cell stock'>0</div> </div>";
                $i++;
            }
        }
        echo $data;
        ?>
    <!--end table rows-->
</div>
    <div class="invoice-bottom" style="margin: 20px 0px 0px 0px">
        <div class="receiver-container">
            <div class="line-row-bill special floating-left">
                <label class="floating-left"><?= $Lang->EmployeeName?></label>
                <div class="floating-left">------------------------------------</div>
            </div>
        </div>
    </div>

</div>
<img class="floating-right" style="max-width: 150px;min-height: 40px;"  src="../themes/main-Light-green-En/images/poweredby.svg">
</section>
</html>
