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
<div class="invoice-header">
    <div class="display-block" style="width:100%">
        <img class="floating-left"  src="themes/Light-green-En/images/logoAr.png">
        <h1><?= $Lang->Invoice?></h1>
        <h4 class="text-muted">NO: <?= $payments_row['paymentid']; ?> | Date: <?= date("Y-m-d", strtotime($payments_row['payment_date'])) ; ?></h4>
    </div>
        <div class="left-side floating-left">
            <div class="display-block floating-left left" >
                <div class="head"><?= $Lang->Billto?></div>
                <fieldset class="floating-left">
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->Name?></label>
                        <span class="floating-left"><?= $payments_row['billing_fullname']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->country?></label>
                        <span class="floating-left"><?= $payments_row['billing_country']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->City?></label>
                        <span class="floating-left"><?= $payments_row['billing_city']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->State?></label>
                        <span class="floating-left"><?= $payments_row['StateProvince'];?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->Address1?></label>
                        <span class="floating-left"><?= $payments_row['billing_address1']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->Address2?></label>
                        <span class="floating-left"><?= $payments_row['billing_address2']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->Tel?></label>
                        <span class="floating-left"><?= $payments_row['billing_telephone']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->Mob?></label>
                        <span class="floating-left"><?php if(isset($payments_row['billing_mobile'])){echo $payments_row['billing_mobile'];} ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->Fax?></label>
                        <span class="floating-left"><?=$payments_row['billing_fax']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->EMail?></label>
                        <span class="floating-left"><?= $payments_row['billing_email']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->postalcode?></label>
                        <span class="floating-left"><?= $payments_row['billing_zipcode'];?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->Contents?></label>
                        <span class="floating-left">Contents</span>
                    </div>
                </fieldset>
            </div>
            <div class="display-block floating-left left">
                <div class="head"><?= $Lang->Shipto?></div>
                <fieldset class="floating-left">
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->Name?></label>
                        <span class="floating-left"><?= $payments_row['RecieverAttention']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->country?></label>
                        <span class="floating-left"><?= $payments_row['Country']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->City ?></label>
                        <span class="floating-left"><?= $payments_row['City']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->State ?></label>
                        <span class="floating-left"><?= $payments_row['StateProvince'];?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->Address1 ?></label>
                        <span class="floating-left"><?= $payments_row['Address1']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->Address2 ?></label>
                        <span class="floating-left"><?= $payments_row['Address2']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->Tel?></label>
                        <span class="floating-left"><?= $payments_row['Phone']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->Mob?></label>
                        <span class="floating-left"><?= $payments_row['telephone']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->Fax?></label>
                        <span class="floating-left"><?=$payments_row['fax']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->EMail ?></label>
                        <span class="floating-left"><?= $payments_row['billing_email'];?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->postalcode ?></label>
                    <span class="floating-left"><?=$row["Postcode"];?></span>

                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left"><?= $Lang->Contents ?></label>
                    <span class="floating-left"><?=$row["Contents"];?></span>
                    </div>
                </fieldset>
            </div>
            <div class="display-block floating-left left">
                <div class="head"><?= $Lang->information?></div>
                <fieldset class="floating-left">
                    <div class="line-row-bill">
                        <label class="floating-left">Account No.</label>
                        <span class="floating-left"><?= $payments_row['userid']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Invoice Type</label>
                        <span class="floating-left"><?php if($payments_row['payment_type']=="cod"){echo "ذمم"." / ".$payments_row['shipping'];

                            }else{
                                echo 'online';
                            } ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Due Date</label>
                        <span class="floating-left">
                            <?php if($payments_row['payment_type']=="cod"){
                                $date= strtotime(date("Y-m-d", strtotime($payments_row['payment_date'])) . " +10 days");
                                echo date("Y-m-d", $date);
                            }else{
                                echo date("Y-m-d", strtotime($payments_row['payment_date'])) ;
                            } ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Order No.</label>
                        <span class="floating-left"><?= $payments_row['paymentid']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Page No.</label>
                        <span class="floating-left">1</span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Point of Sale</label>
                        <span class="floating-left">www.manhal.com </span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">VAT No.</label>
                        <span class="floating-left">91190</span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Sales Rep.</label>
                        <span class="floating-left">www.manhal.com </span>
                    </div>
                </fieldset>
            </div>
        </div>
</div>
<div class="books-container">
<div class="display-table">
    <!--start table caption-->
    <div class="disply-table-caption table-title">
        <div class="display-table-cell number"><?= $Lang->No ?></div>
        <div class="display-table-cell ISBN category"><?= $Lang->ISBN ?></div>
        <div class="display-table-cell Quantity1"><?= $Lang->Quantity?></div>
        <div class="display-table-cell book-title2"><?= $Lang->Title ?></div>
        <div class="display-table-cell book-title1"><?= $Lang->Pub ?></div>
        <div class="display-table-cell Quantity1"><?= $Lang->UPrice ?></div>
        <div class="display-table-cell Quantity1"><?= $Lang->disc ?></div>
        <div class="display-table-cell Quantity1"><?= $Lang->VAT ?></div>
        <div class="display-table-cell WEIGHT1">Net Value</div>
    </div>
    <!--end table caption-->
    <!--start table rows-->
    <?php
    $sql = "SELECT `payments_books`.*,`payments_books`.`type` as item_type,  `books`.`booktype`,
                                IF(`payments_books`.`itemtype`='book',`books`.`description_en`,`story`.`description_en`) as `description_en`,
                                IF(`payments_books`.`itemtype`='book',`books`.`description_ar`,`story`.`description_ar`) as `description_ar`,
                                IF(`payments_books`.`itemtype`='book',`books`.`author_ar`,`story`.`author_ar`) as `author_ar`,
                                IF(`payments_books`.`itemtype`='book',`books`.`author_en`,`story`.`author_en`) as `author_en`,
                                IF(`payments_books`.`itemtype`='book',`books`.`price`,`story`.`price`) as `price`,
                                IF(`payments_books`.`itemtype`='book',`books`.`rate`,`story`.`rate`) as `rate`,
                                IF(`payments_books`.`itemtype`='book',`books`.`isbn`,`story`.`isbn`) as `isbn`,
                                IF(`payments_books`.`itemtype`='book',`books`.`filling`,`story`.`filling`) as `filling`,
                                IF(`payments_books`.`itemtype`='book',`books`.`color`,`story`.`color`) as `color`,
                                IF(`payments_books`.`itemtype`='book',`books`.`eprice`,`story`.`eprice`) as `eprice`,
                                IF(`payments_books`.`itemtype`='book',`books`.`iprice`,`story`.`iprice`) as `iprice`,
                                IF(`payments_books`.`itemtype`='book',`books`.`comments`,`story`.`comments`) as `comments`,
                                IF(`payments_books`.`itemtype`='book',`books`.`rating_count`,`story`.`rating_count`) as `rate_count`,
IF(`payments_books`.`itemtype`='book',`books`.`name`,`story`.`title`) as `name`,
IF(`payments_books`.`itemtype`='book',`books`.`weight`,`story`.`weight`) as `weight`,
                                IF(`payments_books`.`itemtype`='book',`categories`.`name_en`,`stories_cat`.`name_en`) as name_en,

                                IF(`payments_books`.`itemtype`='book',`books`.`language`,`story`.`language`) As `language`
                                FROM `payments_books` LEFT OUTER JOIN `books` ON `payments_books`.`bookid`=`books`.`bookid` LEFT OUTER JOIN `story` ON `payments_books`.`bookid`=`story`.`storyid`
                                LEFT OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` LEFT OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid`  where payments_books.paymentid=".$_GET['id']." and ( payments_books.`type`=1 or payments_books.`type`=3 or payments_books.`type`=5 or payments_books.`type`=7 )"; ;

    $result = $con->query($sql);
    $data = '';
    $reset_counter = 0;
    $Quantity=0;
    $netweight=0;
    $subtotal=0;
    $sum=0;
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {
            switch($row["payment_type"]){
                case "paypal":
                    $transaction=json_decode($row["transaction"]);
                    $transactionID=$transaction["transactions"]["related_resources"]["sale"]["id"];
                    break;
                case "VISA":
                case "MASTERCARD":
                    $transaction=json_decode($row["transaction"]);
                    $transactionID=$transaction["success"]["fort_id"];
                    break;
                default :
                    $transactionID=$row["manhal_ref"];
                    break;
            }


            $data .= "<div  class='display-table-row #class#'>";
            $data .= "<div class='display-table-cell number'>$i</div>";
            $data .= "<div class='display-table-cell ISBN category'>" . $row['isbn'] . "</div>";
            $data .= "<div class='display-table-cell Quantity1'>" . $row['quantity'] . "</div>";
            $Quantity+=$row['quantity'];
            $sum=$row['quantity']*$row['book_price'];



            $data .= "<div class='display-table-cell book-title2'>" . $row['name'] . "</div>";
            $data .= "<div class='display-table-cell book-title1'>دار المنهل ناشرون </div>";
            $data .= "<div class='display-table-cell Quantity1'>" . $row['book_price'] . "</div>";
            $subtotal+=$sum;
            $data .= "<div class='display-table-cell Quantity1'>0</div>";
            $data .= "<div class='display-table-cell Quantity1'>0</div>";
            $data .= "<div class='display-table-cell WEIGHT1'>" . $row['book_price']. "</div>";
            $netweight+=$row['weight'];
            if ($i % 2 == 0) {
                $data = str_replace("#class#", 'bg-row-a', $data);
            } else {
                $data = str_replace("#class#", 'bg-row', $data);
            }
            $data .= "</div>";
            $i++;
        }
    }
    echo $data;
    ?>
    <!--end table rows-->
</div>
    <div class="invoice-center">
        <div class="left-table floating-left">
            <div class="display-table">
                <!--start table caption-->
                <div class="disply-table-caption table-title">
                    <div class="display-table-cell Quantity">Order Lines</div>
                    <div class="display-table-cell Quantity">Qty</div>
                    <div class="display-table-cell Quantity">Net Weight</div>
                    <div class="display-table-cell Quantity">Shipped  Via</div>
                    <div class="display-table-cell Quantity">Currency</div>
                </div>
                <div  class='display-table-row'>
                    <div class='display-table-cell Quantity'><?=$i-1?></div>
                    <div class='display-table-cell Quantity'><?=$Quantity?></div>
                    <div class='display-table-cell Quantity'><?=$netweight?></div>
                    <div class='display-table-cell Quantity'><?=$payments_row['shipping']?></div>
                    <div class='display-table-cell Quantity'>دولار امريكي</div>
                </div>
            </div>
        </div>
        <div class="right-table floating-right">
            <fieldset class="floating-left">

                <div class="line-row-bill">
                    <label class="floating-left">Subtotal :</label>
                    <div class="floating-left"><?=$subtotal?></div>
                </div>
                <div class="line-row-bill">
                    <label class="floating-left">Discount :</label>
                    <div class="floating-left">0</div>
                </div>
                <div class="line-row-bill">
                    <label class="floating-left">Shipping:</label>
                    <div class="floating-left"><?=$payments_row['shippingprice']?></div>
                </div>
                <?php
            if($payments_row['payment_type']=='cod'){

            ?>
                <div class="line-row-bill">
                    <label class="floating-left">Delivery Cost:</label>
                    <div class="floating-left"><?=$payments_row['cod']?></div>
                </div>
<?php } ?>
                <div class="line-row-bill">
                    <label class="floating-left">Total Invoice :</label>
                    <div class="floating-left"><?=$payments_row['total_price']?></div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="invoice-bottom">
        <div class="receiver-container">
            <div class="line-row-bill floating-left">
                <label class="floating-left">Receiver</label>
                <div class="floating-left">------------------</div>
            </div>
            <div class="line-row-bill floating-left">
                <label class="floating-left">Signature</label>
                <div class="floating-left">------------------</div>
            </div>
            <div class="line-row-bill floating-left">
                <label class="floating-left">Created By</label>
                <div class="floating-left">www.manhal.com</div>
            </div>
        </div>
        <div class="last-paragraph"><p>استلمت البضاعة سليمة وكاملة, وأتعهد بدفع قيمتها عند الطلب,وتعتبر هذه الفاتورة وصلاً رسمياً ومن يوقع على استلام البضاعة يعتبر مفوضاً من قبل الجهة ذات العلاقة</p></div>    </div>
</div>
<img class="floating-right" style="max-width: 150px;min-height: 40px;"  src="../themes/main-Light-green-En/images/poweredby.svg">
</section>
</html>
