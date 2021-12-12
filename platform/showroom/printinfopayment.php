
<?php
$URL="http://localhost/Manhal/platform/showroom";
include_once 'includes/functions.php';
$payments_row=$prosses->GetMoreInformationCompletedOrder();

?>
<link rel="stylesheet"  href="<?=$URL;?>/themes/En/css/invoice.css"/>

<section class="invoice-container">
    <div class="invoice-header">
        <div class="display-block" style="width:100%">
            <img class="floating-left"  src="<?=$URL;?>/themes/all/images/logoAr.png">
            <h1>طلب اصدار فاتوره</h1>
            <h4 class="text-muted">NO: <?= $payments_row['paymentid']; ?> | Date: <?= date("Y-m-d", strtotime($payments_row['payment_date'])) ; ?></h4>
        </div>
        <div class="left-side floating-left">
            <div class="display-block floating-left left" >
                <div class="head">Bill to</div>
                <fieldset class="floating-left">
                    <div class="line-row-bill">
                        <label class="floating-left">Name</label>
                        <span class="floating-left"><?= $payments_row['billing_fullname']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">country</label>
                        <span class="floating-left"><?= $payments_row['billing_country']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">City</label>
                        <span class="floating-left"><?= $payments_row['billing_city']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">State</label>
                        <span class="floating-left"><?= $payments_row['StateProvince'];?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Address1</label>
                        <span class="floating-left"><?= $payments_row['billing_address1']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Address2</label>
                        <span class="floating-left"><?= $payments_row['billing_address2']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Tel</label>
                        <span class="floating-left"><?= $payments_row['billing_telephone']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Mobile</label>
                        <span class="floating-left"><?php if(isset($payments_row['billing_mobile'])){echo $payments_row['billing_mobile'];} ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Fax</label>
                        <span class="floating-left"><?=$payments_row['billing_fax']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Email</label>
                        <span class="floating-left"><?= $payments_row['billing_email']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">postal code</label>
                        <span class="floating-left"><?= $payments_row['billing_zipcode'];?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Contents</label>
                        <span class="floating-left">Contents</span>
                    </div>
                </fieldset>
            </div>
            <div class="display-block floating-left left">
                <div class="head">Ship to</div>
                <fieldset class="floating-left">
                    <div class="line-row-bill">
                        <label class="floating-left">Name</label>
                        <span class="floating-left"><?= $payments_row['RecieverAttention']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">country</label>
                        <span class="floating-left"><?= $payments_row['Country']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">City</label>
                        <span class="floating-left"><?= $payments_row['City']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">State</label>
                        <span class="floating-left"><?= $payments_row['StateProvince'];?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Address1</label>
                        <span class="floating-left"><?= $payments_row['Address1']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Address2</label>
                        <span class="floating-left"><?= $payments_row['Address2']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Tel></label>
                        <span class="floating-left"><?= $payments_row['Phone']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Mobile</label>
                        <span class="floating-left"><?= $payments_row['telephone']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Fax</label>
                        <span class="floating-left"><?=$payments_row['fax']; ?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">EMail</label>
                        <span class="floating-left"><?= $payments_row['billing_email'];?></span>
                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">postal code</label>
                        <span class="floating-left"><?=$row["Postcode"];?></span>

                    </div>
                    <div class="line-row-bill">
                        <label class="floating-left">Contents</label>
                        <span class="floating-left"><?=$row["Contents"];?></span>
                    </div>
                </fieldset>
            </div>
            <div class="display-block floating-left left">
                <div class="head">information?</div>
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
                <div class="display-table-cell number">No</div>
                <div class="display-table-cell ISBN category">ISBN</div>
                <div class="display-table-cell Quantity1">Quantity</div>
                <div class="display-table-cell book-title2">Title</div>
                <div class="display-table-cell book-title1">Pub</div>
                <div class="display-table-cell Quantity1">UPrice</div>
                <div class="display-table-cell Quantity1">disc</div>
                <div class="display-table-cell Quantity1">VAT</div>
                <div class="display-table-cell WEIGHT1">Net Value</div>
            </div>
            <!--end table caption-->
            <!--start table rows-->
            <?php
            $result = $prosses->GetinformationOrder();
            $data = '';
            $reset_counter = 0;
            $Quantity=0;
            $netweight=0;
            $subtotal=0;
            $sum=0;
            if (mysqli_num_rows($result) > 0) {
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {

                    switch ($row["itemtype"]){
                        case "book":
                            $name=$row["name"];
                            $isbn=$row["book_isbn"];
                            $carton=1;
                            $weight=$row["book_weight"];
                            break;
                        case "story":
                            $name=$row["title"];
                            $isbn=$row["story_isbn"];
                            $carton=1;
                            $weight=$row["story_weight"];
                            break;
                        case "toy":
                            $name=$row["name_ar"];
                            $isbn=$row["toy_isbn"];
                            $carton=1;
                            $weight=$row["toy_weight"];
                            break;
                    }
                    $data .= "<div  class='display-table-row #class#'>";
                    $data .= "<div class='display-table-cell number'>$i</div>";
                    $data .= "<div class='display-table-cell ISBN category'>" . $isbn . "</div>";
                    $data .= "<div class='display-table-cell Quantity1'>" . $row['quantity'] . "</div>";
                    $Quantity+=$row['quantity'];
                    $sum=$row['quantity']*$row['book_price'];



                    $data .= "<div class='display-table-cell book-title2'>" . $name . "</div>";
                    $data .= "<div class='display-table-cell book-title1'>دار المنهل ناشرون </div>";
                    $data .= "<div class='display-table-cell Quantity1'>" . $row['book_price'] . "</div>";
                    $subtotal+=$sum;
                    $data .= "<div class='display-table-cell Quantity1'>0</div>";
                    $data .= "<div class='display-table-cell Quantity1'>0</div>";
                    $data .= "<div class='display-table-cell WEIGHT1'>" . $sum . "</div>";
                    $netweight+=$weight;
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
    <img class="floating-right" style="max-width: 150px;min-height: 40px;"  src="<?=$URL;?>/themes/all/images/poweredby.svg">
</section>

