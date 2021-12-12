<?php
/**
 * Created by PhpStorm.
 * User: khalid alomiri
 * Date: 24/09/2016
 * Time: 09:19 ص
 */
$cuerrentpage="shippingwarehouse.php";
$bredcrumb = "Shipping warehouse";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["user"])) {
    header('Location: login.php');
}elseif($_SESSION["user"]['permession']!="1" &&$_SESSION["user"]['permession']!="4"  ) {
    header('Location: logout.php');
}
include_once('config.php');
include_once('includes/language.php');
?>
<?php
include_once('includes/function.php');
include_once('../includes/function.php');
include "includes/header.php";
?>
    <div class="books-container">
        <?php
        $keywords=''; $company=-1;$status=-1;
        if(isset($_GET["keywords"])){ $keywords=$_GET["keywords"]; }
        if(isset($_GET["company"])){ $company=$_GET["company"]; }
        if(isset($_GET["status"])){ $status=$_GET["status"]; }

        ?>

        <label class="lbl-data-a floating-left"><?= $Lang->Status ?></label>
        <select class="txt-a floating-left" id="shippingwarehouseStatus" name="shippingwarehouseStatus">
            <option <?php if($status==-1){echo 'selected';} ?> value='-1'>All</option>
            <option <?php if($status==0){echo 'selected';} ?> value='0'><?= $Lang->Open ?></option>
            <option <?php if($status==1){echo 'selected';} ?> value='1'><?= $Lang->Close ?></option>

        </select>
        <label class="lbl-data-a floating-left"><?= $Lang->shippingCompany ?></label>
        <select class="txt-a floating-left" id="shippingwarehouseCompany" name="shippingwarehouseCompany">
            <option <?php if($company==-1){echo 'selected';} ?> value='-1'>All</option>
            <option <?php if($company==0){echo 'selected';} ?> value='0'>Aramex</option>
            <option <?php if($company==1){echo 'selected';} ?> value='1'>DHL</option>

        </select>
        <input type="text" class="txt-a floating-left book-serach" id="shippingwarehouse_search" name="shippingwarehouse_search" placeholder="<?= $Lang->search ?>" value="<?=$keywords;?>">
        <input type="button" class="btn-default-b floating-left" value="<?= $Lang->search ?>" onclick="searchshippingwarehouse();">





        <div class="display-table">
            <!--start table caption-->
            <div class="disply-table-caption table-title">
                <div class="display-table-cell number"><?= $Lang->No ?></div>
                <div class="display-table-cell status"><?= $Lang->Ref ?></div>
                <div class="display-table-cell CustomerName"><?=$Lang->CustomerName?></div>
                <div class='display-table-cell status'><?=$Lang->billnumber?></div>
                <div class='display-table-cell status'><?=$Lang->PKTnumber?></div>
                <div class="display-table-cell status"><?= $Lang->Status?></div>
                <div class="display-table-cell shippingCompany"><?= $Lang->shippingCompany ?></div>
                <div class="display-table-cell shippingCompany"><?= $Lang->ShippingNumber ?></div>
                <div class="display-table-cell Address"><?= $Lang->country ?></div>
                <div class="display-table-cell City"><?= $Lang->City ?></div>
                <div class="display-table-cell City"><?= $Lang->TotalPrice ?></div>
                <div class="display-table-cell City"><?= $Lang->Action ?></div>
            </div>
            <!--end table caption-->
            <!--start table rows-->
            <?php
            if (isset($_SESSION["user"]) && $_SESSION["user"]['permession'] == 1||isset($_SESSION["user"]) && $_SESSION["user"]['permession'] == 4) {


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


                $sql = "Select payments.* From payments  Where payments.shipping<>'none' AND payments.status!=-1 ".$keyword_filter.$status_filter." AND  payments.store_close_user  ORDER BY `shipping_close_user` ASC ";
                $result = $con->query($sql);
                $url = "shippingwarehouse.php?";
                $result = $con->query($sql);
                $num_rows = mysqli_num_rows($result);
                $pagination = getPagination($url,$num_rows);


                $sql = "Select payments.* From payments  Where payments.shipping<>'none' AND payments.status!=-1 ".$keyword_filter.$status_filter."  AND  payments.store_close_user ORDER BY `shipping_close_user` ASC " . $pagination[0];

                $result = $con->query($sql);
                $data = '';
                $reset_counter = 0;
                if (isset($_GET["page"]) && $_GET["page"] > 1) {
                    $reset_counter = BooksPerPage * ($_GET["page"] - 1);
                }

                if (mysqli_num_rows($result) > 0){
                    // output data of each row
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $page_number = $reset_counter + $i;
                        $data .= "<div id='stokidd_" . $row['manhal_ref'] . "' class='display-table-row #class#'>";
                        $data .= "<div class='display-table-cell number' >" . $page_number . "</div>";
                        $data .= "<div class='display-table-cell status'>" . $row['manhal_ref'] . "</div>";
                        $data .= "<div class='display-table-cell CustomerName'>" . $row['RecieverCompanyName'] . "</div>";
                        $data .= "<div class='display-table-cell status'>" . $row['paymentid'] . "</div>";

                        $status=$Lang->PROCESS;

                        if($row['store_close_user']!=-1 && $row['shipping_close_user']==-1) {
                            $status =$Lang->Open;
                            $data = str_replace("#class#", 'bg-row-yellow', $data);
                        }else if($row['store_close_user']!=-1 && $row['shipping_close_user']!=-1 && $row['exported']=='1' ){
                            $status = $Lang->Reserve;
                            $data = str_replace("#class#", 'bg-row-blue', $data);
                        }else if($row['store_close_user']!=-1 && $row['shipping_close_user']!=-1 && $row['exported']=='2' ){
                            $status = $Lang->Exported;
                            $data = str_replace("#class#", 'bg-row-Exported', $data);
                        }else if($row['store_close_user']!=-1 && $row['shipping_close_user']!=-1){
                            $status = $Lang->Close;
                            $data = str_replace("#class#", 'bg-row-green', $data);
                        }else
                        {
                            $data = str_replace("#class#", 'bg-row-orange', $data);
                        }
                        $data .= "<div class='display-table-cell status'>9565</div>";
                        $data .= "<div class='display-table-cell status'>" . $status . "</div>";
                        $data .= "<div class='display-table-cell shippingCompany'>" . $row['shipping'] . "</div>";
                        $data .= "<div class='display-table-cell shippingCompany'>" . $row['shipping_ref'] . "</div>";
                        $data .= "<div class='display-table-cell Address'>" . $row['Country'] . "</div>";
                        $data .= "<div class='display-table-cell City'>" . $row['City'] . "</div>";
                        $data .= "<div class='display-table-cell City'>" . $row['total_price'] . " </div>";
                        $data .= "<div class='display-table-cell City'>";
                        $data .= "<div class='butons-container'>";
//                        if ($i % 2 == 0) {
//                            $data = str_replace("#class#", 'bg-row-a', $data);
//                        } else {
//                            $data = str_replace("#class#", 'bg-row', $data);
//                        }
                        $data .= " <a title='" . $Lang->PackageInfo . "' href='infoprodectpkt.php?id=" . $row['paymentid'] . "&ref=".$row['manhal_ref']."' >";
                        $data .= " <i class='flaticon-info27'></i></a>";
                            $data .= " <a title='" . $Lang->Shippinginfo . "' href='shippinginfo.php?id=" . $row['paymentid'] . "' >";
                            $data .= " <i class='flaticon-info27'></i></a>";
                        $data .= " <a title='" . $Lang->PKTinfo . "' href='pktinfo.php?id=" . $row['paymentid'] . "&ref=".$row['manhal_ref']."' >";
                        $data .= " <i class='flaticon-info27'></i></a>";
                        if($row['shipping_close_user']==-1){
                            $data .= " <a title='" . $Lang->Close . "'" ;
                            $data .="href='javascript:CloseShipping(".$row['paymentid'].")";
                            $data .="' >";
                            $classtype='close-shop';
                            $data .= " <i class='".$classtype."'></i> </a>";
                        }else if($row['exported']==1 && $row['shipping']=='DHL'){
                            $data .= " <a title='" . $Lang->Reserve . "'" ;
                            $data .="href='javascript:ReserveShipping(".$row['paymentid'].")";
                            $data .="' >";
                            $classtype='Reserve-shop';
                            $data .= " <i class='".$classtype."'></i> </a>";
                        }
                        $data .= "</div></div></div>";
                        $i++;
                    }
                }
                echo $data;
            }
            ?>
            <a  onclick="exportCSV()"   class="btn-default floating-right"><?=$Lang->UploadDHL;?></a>
            <!--end table rows-->
        </div>
    </div>
    <section class="paging">
        <div class="content">
            <?php
            if (isset($_SESSION["user"]) && $_SESSION["user"]['permession'] == 1||isset($_SESSION["user"]) && $_SESSION["user"]['permession'] == 4) {
                echo $pagination[1];
            }
            ?>
        </div>
    </section>
    <script type="text/javascript">
        function exportCSV(){

            window.location.href ='ajax/exportCSV.php';
            setTimeout(function(){window.location.reload() ;},200)
           //
        }
        function ShippingExport(){
            $.ajax({
                url: "ajax/exportCSV.php",
                type: "POST",
                cache: false,
                dataType: 'html',
                data: '',
                success: function (html) {
                    window.location=window.location
                }
            });
        }
function ReserveShipping(id){
    swal({
        title: window.Lang['AreyousureReserveShipping'],
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
            TypeProcesses: "ReserveShipping",
            id: id
        },
        success: function (html) {
            window.location=window.location
        }
    });
        }
    });
}
        function CloseShipping(id) {
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
                            TypeProcesses: "CloseShipping",
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