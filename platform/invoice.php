<?php

$cuerrentpage="invoice.php";
$bredcrumb = "Invoice";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["user"])) {
    header('Location: login.php');
}elseif($_SESSION["user"]['permession']!="1" &&$_SESSION["user"]['permession']!="5"  ) {
    header('Location: logout.php');
}
include_once('config.php');
include_once('includes/language.php');
?>
<?php
include_once('includes/function.php');
include_once('../includes/function.php');

$bredcrumb = '<li class="floating-left"><a href="invoice.php" class="floating-left active">'.$Lang->invoices.'</a></li>';

include_once "includes/header.php";
?>
    <div class="books-container">
        <input type="text" class="txt-a floating-left book-serach" id="invoice_search" name="invoice_search" placeholder="<?= $Lang->search ?>" value="<?= $Lang->search ?>">
        <input type="button" class="btn-default-b floating-left" value="<?= $Lang->search ?>">
        <div class="display-table">
            <!--start table caption-->
            <div class="disply-table-caption table-title">
                <div class="display-table-cell quiz-number"><?=$Lang->No?></div>
                <div class="display-table-cell quiz-user"><?=$Lang->Invoicenumber?></div>
                <div class="display-table-cell quiz-category"><?=$Lang->EMail?></div>
                <div class="display-table-cell quiz-book-title"><?=$Lang->GrandTotal?></div>
                <div class="display-table-cell quiz-created-at"><?=$Lang->Status?></div>
                <div class="display-table-cell quiz-action"><?=$Lang->Action?></div>
            </div>
            <!--end table caption-->
            <!--start table rows-->
            <?php
            $keyword_filter="";
            $keywords="";
            if(isset($_GET['keywords']) && $_GET['keywords']!=""){
                $keywords="keywords=".$_GET['keywords'];
                $keyword_filter=" AND `name` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%'  AND `email` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%' AND `address` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%' AND `shippingmethod` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%' AND `country` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%' AND `productname` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%'";
            }
            $sql = " SELECT * FROM `invoices`  WHERE `id` >0 " . $keyword_filter."   ";
            $result = $con->query($sql);
            $url="invoice.php?".$keywords;
            $result = $con->query($sql);

            $num_rows=mysqli_num_rows($result);
            $pagination=getPagination($url,$num_rows);
            $sql = "SELECT * FROM `invoices`  WHERE `id` >0  ".$keyword_filter.$pagination[0];
            $result = $con->query($sql);
            if(isset($_GET["page"]) && $_GET["page"]>1){
                $reset_counter=BooksPerPage*($_GET["page"]-1);
            }
            $data = '';
            if (mysqli_num_rows($result) > 0) {
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                        $data .= "<div class='display-table-row'>";
                        $data .= "<div class='display-table-cell quiz-number'>".$i."</div>";
                        $data .= "<div class='display-table-cell quiz-user'>".$row['number']."</div>";
                        $data .= "<div class='display-table-cell quiz-category'>".$row['email']."</div>";
                        $data .= "<div class='display-table-cell quiz-book-title'>".$row['price']."</div>";
                        $data .= "<div class='display-table-cell quiz-created-at'>".$row['status']."</div>";
                        $data .= "<div class='display-table-cell quiz-action'>";
                        $data .= "<div class='butons-container'>";
                        $data .= " <a href='editinvoice.php?id=".$row['id']."' title='".$Lang->Delete."'>";
                        $data .= "<i class='flaticon-info27'></i></a>";
                        $data .= "<a href='javascript:deleteinvoice(".$row['id'].")' title='".$Lang->Delete."'>";
                        $data .= "<i class='flaticon-delete96'></i> </a>";
                        $data .= "</div></div></div>";
                    $i++;
                }
            }
            echo $data;
            ?>



            <!--end table rows-->
        </div>
        <a href="editinvoice.php?id=new" class="btn-default floating-right"><?=$Lang->addinvoice;?></a>
    </div>
    <section class="paging">
        <div class="content">
<!--            --><?php
//            echo $pagination[1];
//            ?>
        </div>
    </section>
<?php
include "includes/footer.php";
?>