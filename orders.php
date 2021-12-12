<?php

$currentTab = "orders";

include_once "platform/config.php";

include_once "includes/function.php";

mustLogin();

include_once "platform/includes/function.php";

include_once "includes/header.php";

?><link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/css/orders.css<?=$cash;?>">

<div class="inner-pages-main-container-a order-main-container">

    <?= $breadCrumbs; ?>

    <div class="center-piece">

        <div class="order-container-moving floating-left">

            <div class="display-table manhal">

                <div class="disply-table-caption table-title">

                    <div class="display-table-cell number-thump"><?= $Lang->No; ?></div>

                    <div class="display-table-cell title"><?= $Lang->ordernum;?></div>

                    <div class="display-table-cell title"><?= $Lang->Created;?></div>

                    <div class="display-table-cell title"><?= $Lang->Status;?></div>

                    <div class="display-table-cell title"><?= $Lang->Recipient;?></div>

                    <div class="display-table-cell title"><?= $Lang->Shippingmethod;?></div>

                    <div class="display-table-cell title"><?= $Lang->Shipment;?></div>

                    <div class="display-table-cell title"><?= $Lang->Total;?></div>

                    <div class="display-table-cell delete_carts_item-style"></div>

                </div>

            </div>

            <div class="table-card-container scrollable">

                <div class="display-table">

                    <?php



                    $sql="SELECT * FROM `payments` WHERE `userid`=".$_SESSION["user"]['userid'];

                    $result = $con->query($sql);

                    $data='';

                    $i=0;

                if(isset($_SESSION["user"]) && !empty($_SESSION["user"]) ) {

                    while ($row = mysqli_fetch_assoc($result)) {

                        if($row['status']!=-1){

                        $data .= '<div class="display-table-row bg-row table-title cart_row">';

                        $data .= '<div class="display-table-cell number-thump">';

                        $data .= '<div class="number">'.$i.'</div></div>';

                        $data .= '<div class="display-table-cell title">'.$row['paymentid'].'</div>';

                        $data .= ' <div class="display-table-cell title">'.$row['payment_date'].'</div>';

                        $data .= '<div class="display-table-cell title"><ul>';

                        $then = $row['payment_date'];

                        $now = time();

                        $thenTimestamp = strtotime($then);

                        $difference = ($now - $thenTimestamp);



                        $Green='background:#00a951;color:#fff';

                        $red='background:#fd991c;color:#fff';

                        $defult='border:solid 1px #626161;';

                         if($row['payment_type']=='cod'&&$difference<0 ) {

                             $step1 = $red;

                             $step2=$defult;

                             $step3=$defult;

                             $step4=$defult;

                             $step5=$defult;

                         }else if($row['store_close_user']==-1){

                             $step1 = $Green;

                             $step2 = $red;

                             $step3=$defult;

                             $step4=$defult;

                             $step5=$defult;

                        }else if($row['store_close_user']==2 && $row['shipping_close_user']==-1){

                             $step1 = $Green;

                             $step2 = $Green;

                             $step3=$red;

                             $step4=$defult;

                             $step5=$defult;

                         }else if($row['shipping_close_user']==2){

                             $step1 = $Green;

                             $step2 = $Green;

                             $step3=$Green;

                             $step4=$red;

                             $step5=$defult;

                         }

                        $data .= '<li style="'.$step1.'" title="'.$Lang->orderstep1.'">1</li>';

                        $data .= '<li style="'.$step2.'" title="'.$Lang->orderstep2.'">2</li>';

                        $data .= '<li style="'.$step3.'" title="'.$Lang->orderstep3.'">3</li>';

                        $data .= '<li style="'.$step4.'" title="'.$Lang->orderstep3.'">4</li>';

                        $data .= '<li style="'.$step5.'" title="'.$Lang->orderstep3.'">5</li>';

                        $data .= '</ul></div>';

                        $data .= '<div class="display-table-cell title">'.$row['RecieverCompanyName'].'</div>';

                        $data .= '<div class="display-table-cell title">'.$row['shipping'].'</div>';

                        $data .= '<div class="display-table-cell title">'.$row['shipping_ref'].'</div>';

                        $data .= '<div class="display-table-cell title">'.$row['total_price'].'</div>';

                        if($row['store_close_user']!=2) {

                            if (date('Y', strtotime($row['payment_date'])) == date("Y") && date('m', strtotime($row['payment_date'])) == date("m") && date('d', strtotime($row['payment_date'])) == date("d")) {

                                if ($difference < 0) {

                                    $data .= '<div  class="display-table-cell  delete_order_item-style"><a data-id="'.$row['paymentid'].'"  class="delete_order_item" title="Delete"></a></div>';

                                }

                            }



                            $i++;

                        }
                            $data .= '</div>';
                    }

                }

                }

                    echo $data;

                    ?>





    </div>

</div>

<?php

include_once "includes/footer.php";

?>