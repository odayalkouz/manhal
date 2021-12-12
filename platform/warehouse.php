<?php
/**
 * Created by PhpStorm.
 * User: khalid alomiri
 * Date: 24/09/2016
 * Time: 09:19 ص
 */
$cuerrentpage="warehouse.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["user"])) {
    header('Location: login.php');
}elseif($_SESSION["user"]['permession']!="1" &&$_SESSION["user"]['permession']!="3"  ) {
    header('Location: logout.php');
}
include_once('config.php');
include_once('includes/language.php');
?>
<?php
include_once('includes/function.php');
include_once('../includes/function.php');

$bredcrumb = '<li class="floating-left"><a href="warehouse.php" class="floating-left active">'.$Lang->Warehouse.'</a></li>';

include_once "includes/header.php";
?>
<div class="books-container">
    <?php
    $keywords=''; $company=-1;$status=-1;
    if(isset($_GET["keywords"])){ $keywords=$_GET["keywords"]; }
    if(isset($_GET["company"])){ $company=$_GET["company"]; }
    if(isset($_GET["status"])){ $status=$_GET["status"]; }

    ?>


    <label class="lbl-data-a floating-left"><?= $Lang->Status ?></label>
    <select class="txt-a floating-left" id="warehouseStatus" name="warehouseStatus">
        <option <?php if($status==-1){echo 'selected';} ?> value='-1'>All</option>
        <option <?php if($status==0){echo 'selected';} ?> value='0'><?= $Lang->Open ?></option>
        <option <?php if($status==1){echo 'selected';} ?> value='1'><?= $Lang->Close ?></option>

    </select>
    <label class="lbl-data-a floating-left"><?= $Lang->shippingCompany ?></label>
    <select class="txt-a floating-left" id="shippingCompany" name="shippingCompany">
        <option <?php if($company==-1){echo 'selected';} ?> value='-1'>All</option>
        <option <?php if($company==0){echo 'selected';} ?> value='0'>Aramex</option>
        <option <?php if($company==1){echo 'selected';} ?> value='1'>DHL</option>

    </select>
    <input type="text" class="txt-a floating-left book-serach" id="warehouse_search" name="warehouse_search" placeholder="<?= $Lang->search ?>" value="<?=$keywords;?>">
    <input type="button" class="btn-default-b floating-left" value="<?= $Lang->search ?>" onclick="searchwaerhouse();">


<div class="display-table">
    <!--start table caption-->
    <div class="disply-table-caption table-title">
        <div class="display-table-cell number"><?= $Lang->No ?></div>
        <div class="display-table-cell status"><?= $Lang->Ref ?></div>
        <div class="display-table-cell status"><?= $Lang->billnumber ?></div>
        <div class="display-table-cell status"><?= $Lang->Status ?></div>
        <div class="display-table-cell companyname"><?= $Lang->CustomerName ?></div>
        <div class="display-table-cell shippingCompany shipping"><?= $Lang->shippingCompany ?></div>
        <div class="display-table-cell Address"><?= $Lang->country ?></div>
        <div class="display-table-cell City"><?= $Lang->City ?></div>
        <div class="display-table-cell City"><?= $Lang->Action ?></div>
    </div>




    <!--end table caption-->
    <!--start table rows-->
    <?php
    if (isset($_SESSION["user"]) && $_SESSION["user"]['permession'] == 1||isset($_SESSION["user"]) && $_SESSION["user"]['permession'] == 3) {
        $company_filter="";
        if($company==0) {
            $company_filter = " AND `shipping` = 'Aramex' ";
        }else if($company==1){
            $company_filter = " AND `shipping` = 'DHL' ";
        }
        $status_filter="";
        if($status==0) {
            $status_filter = " AND `store_close_user` = -1 ";
        }else if($status==1){
            $status_filter = " AND `store_close_user` = '2' ";
        }
        $keyword_filter="";
        if(isset($_GET['keywords']) && $_GET['keywords']!=""){
            $keyword_filter=" AND ( (`paymentid` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%' ".$company_filter.")  OR ( `City` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%' ".$company_filter." )) OR (`manhal_ref` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%' ".$company_filter.") OR  (`billing_fullname` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%' ".$company_filter." )";
        }else if($company_filter!=""){
            $keyword_filter=$company_filter;
        }
        $sql = "Select payments.* From payments  Where payments.shipping<>'none' AND payments.store_close_user AND payments.status!=-1 ".$keyword_filter.$status_filter."  ORDER BY `store_close_user` ASC ";

        $result = $con->query($sql);
        $url = "warehouse.php?";
        $result = $con->query($sql);
        $num_rows = mysqli_num_rows($result);
        $pagination = getPagination($url,$num_rows);

        $sql = "Select payments.* From payments  Where payments.shipping<>'none' AND  payments.store_close_user AND payments.status!=-1 ".$keyword_filter.$status_filter."  ORDER BY `store_close_user` ASC " . $pagination[0];

        $result = $con->query($sql);
        $data = '';
        $reset_counter = 0;
        if (isset($_GET["page"]) && $_GET["page"] > 1) {
            $reset_counter = BooksPerPage * ($_GET["page"] - 1);
        }

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $i = 1;

            while ($row = mysqli_fetch_assoc($result)) {
                $page_number = $reset_counter + $i;
                $data .= "<div id='stokidd_" . $row['manhal_ref'] . "' class='display-table-row #class#'>";
                $data .= "<div class='display-table-cell number' >" . $page_number . "</div>";
                $data .= "<div class='display-table-cell status'><a title='" . $Lang->BookInfo . "' href='infopayment.php?id=" . $row['paymentid'] . "&ref=" . $row['manhal_ref'] . "' >" . $row['manhal_ref'] . "</a></div>";

                $status=$Lang->Open;
                if($row['store_close_user']!=-1){
                    $status=$Lang->Close;
                    $data = str_replace("#class#", 'bg-row-green', $data);
                }else{
                    $data = str_replace("#class#", 'bg-row-yellow', $data);
                }
                $data .= "<div class='display-table-cell status'>" . $row['paymentid'] . "</div>";
                $data .= "<div class='display-table-cell status'>" . $status . "</div>";

                $data .= "<div class='display-table-cell companyname'>" . $row['RecieverCompanyName'] . "</div>";
                $data .= "<div class='display-table-cell shippingCompany'>" . $row['shipping'] . "</div>";
                $data .= "<div class='display-table-cell Address'>" . $row['Country'] . "</div>";
                $data .= "<div class='display-table-cell City'>" . $row['City'] . "</div>";
                $data .= "<div class='display-table-cell City'>";
                $data .= "<div class='butons-container'>";

//                    if ($i % 2 == 0) {
//
//                    } else {
//
//                    }
                    $data .= " <a title='" . $Lang->BookInfo . "' href='infopayment.php?id=" . $row['paymentid'] . "&ref=" . $row['manhal_ref'] . "' >";
                    $data .= " <i class='flaticon-info27'></i></a>";




                $data .= "</div></div></div>";
                $i++;
                }




        }

        echo $data;



    }
    ?>
    <div class="floating-left pending">
        <i class="floating-left"></i>
        <label class="floating-left">
            <?php
            $sql="SELECT * FROM `payments`  where  payments.shipping<>'none' AND payments.status!=-1  AND  `payments`.`store_close_user` =-1";
            $result = $con->query($sql);
            $num_rows = mysqli_num_rows($result);
            echo $Lang->Open.'= '. $num_rows;
            ?>
        </label>
    </div>
    <!--end table rows-->
</div>
</div>
<section class="paging">
    <div class="content">
        <?php
        if (isset($_SESSION["user"]) && $_SESSION["user"]['permession'] == 1||isset($_SESSION["user"]) && $_SESSION["user"]['permession'] == 3) {
            echo $pagination[1];
        }
        ?>
    </div>
</section>






<script type="text/javascript">

    function closepayment(id) {
       swal({
            title: window.Lang['Areyousureshipping'],
            text: window.Lang['Youwillnotbeabletorecoverthisbook'],
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: window.Lang['Yesdeleteit'],
            cancelButtonText: window.Lang['Nocancel'],
            closeOnConfirm: true,
            closeOnCancel: true
        }, function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "ajax/process.php",
                    type: "POST",
                    cache: false,
                    dataType: 'html',
                    data: {
                        TypeProcesses: "CloseStock",
                        id: id
                    },
                    success: function (html) {

                        window.location=window.location
                    }
                });

            }else{

            }
        });




    }

</script>

<?php
include "includes/footer.php";
?>