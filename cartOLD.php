<?php

$currentTab = "cart";
include_once "platform/config.php";
include_once "includes/function.php";
include_once "platform/includes/function.php";
include_once "includes/header.php";
?>
    <style>
        .display-none-important {
            display: none !important;
        }
    </style>
    <script>
        $(document).ready(function () {
            var steps = $("#stepsbar a");
            var contentsA = $(".steps-container div.movings");
            i = 0;
            $(".BtnNext").click(function () {
                formdata = {};
                if (i == 0) {
                    formdata["i"] = 0
                } else if (i == 1) {
                    if ($("#cart_country option:selected").attr("id") != undefined) {
                        formdata["cart_country_code"] = $("#cart_country option:selected").attr("id").replace("aramex_country_", "");
                    } else {
                        formdata["cart_country_code"] = 'undefined';
                    }
                    formdata["i"] = 1;
                    formdata["cart_fullname"] = $("#cart_fullname").val();
                    formdata["cart_email"] = $("#cart_email").val();
                    formdata["cart_phone"] = $("#cart_phone").val();
                    formdata["cart_mobile"] = $("#cart_mobile").val();
                    formdata["cart_country"] = $("#cart_country").val();
                    formdata["cart_city"] = $("#cart_city").val();
                    formdata["cart_state"] = $("#state").val();
                    formdata["cart_post"] = $("#post").val();
                    formdata["cart_address1"] = $("#cart_address1").val();
                    formdata["cart_address2"] = $("#cart_address2").val();
                } else if (i == 2) {
                    formdata["i"] = 2
                }

                $.ajax({
                    url: window.SITE_URL + "platform/ajax/platform.php?process=savedatacard",
                    type: "POST",
                    data: {'form': formdata},
                    cache: false,
                    dataType: 'html',
                    success: function (html) {

                    }
                });

                if (!$(this).hasClass("btn-popup")) {
                    if (i == 0 && window.total == 0) {
                        Lobibox.notify('error', {
                            title: window.Lang.NoItems,
                            msg: window.Lang.msgNoItems
                        });
                    } else if (i == 1) {

                        var msg = "";
                        if (($("#cart_fullname").val().trim()).length < 2) {
                            msg = window.Lang.FullNameTooShort + "<br>";
                            $("#cart_fullname").addClass("error-feild").focus();
                        }

                        if ($("#cart_mobile").val().trim() == "") {
                            msg += window.Lang.Pleaseenterphone + "<br>";
                            $("#cart_mobile").addClass("error-feild").focus();
                        }
                        if ($("#cart_country").val() == -1) {
                            msg += window.Lang.pleaseChoseCountry + "<br>";
                            $("#cart_country").addClass("error-feild").focus();
                        }
                        if ($("#cart_city").val() == '') {
                            msg += window.Lang.pleaseEnterCity + "<br>";
                            $("#cart_city").addClass("error-feild").focus();
                        }
                        if ($("#cart_address1").val().trim() == "") {
                            msg += window.Lang.PleaseInsertAddress1 + "<br>";
                            $("#cart_address1").addClass("error-feild").focus();
                        }
                        if ($("#ship_same_address").prop("checked") != true) {
                            if (($("#shipping_fullname").val().trim()).length < 2) {
                                msg = window.Lang.FullNameTooShort + "<br>";
                                $("#shipping_fullname").addClass("error-feild").focus();
                            }

                            if ($("#shipping_mobile").val().trim() == "") {
                                msg += window.Lang.Pleaseenterphone + "<br>";
                                $("#shipping_mobile").addClass("error-feild").focus();
                            }
                            if ($("#shipping_country").val() == -1) {
                                msg += window.Lang.pleaseChoseCountry + "<br>";
                                $("#shipping_country").addClass("error-feild").focus();
                            }
                            if ($("#shipping_city").val().trim() == "") {
                                msg += window.Lang.pleaseEnterCity + "<br>";
                                $("#shipping_city").addClass("error-feild").focus();
                            }
                            if ($("#shipping_address1").val().trim() == "") {
                                msg += window.Lang.PleaseInsertAddress1 + "<br>";
                                $("#shipping_address1").addClass("error-feild").focus();
                            }

                        }
                        if (msg == "") {
                            //$("#cart_paymentmethod_paypal").click();
                            calcShippingPrice(window.productsWeight);
                            steps.eq(i).removeClass().addClass('active').next().removeClass().addClass('active');
                            contentsA.eq(i).removeClass('display-none').addClass('display-none').next().removeClass('display-none');
                            contentsA.eq(i).removeClass('slideInRight').addClass('slideInLeft').next().addClass('slideInRight');
                            contentsA.eq(i).css("width", "0%").next().css("width", "100%");
                            i++;
                        } else {
                            Lobibox.notify('error', {
                                title: window.Lang.WrongInfo,
                                msg: msg
                            });
                        }
                    } else if (i == 2) {
                        checkOut();
                    } else {
                        $('html, body').animate({scrollTop: 0}, 1000);
                        if (i <= steps.length) {
                            steps.eq(i).removeClass().addClass('active').next().removeClass().addClass('active');
                            contentsA.eq(i).removeClass('display-none').addClass('display-none').next().removeClass('display-none');
                            contentsA.eq(i).removeClass('slideInRight').addClass('slideInLeft').next().addClass('slideInRight');
                            contentsA.eq(i).css("width", "0%").next().css("width", "100%");
                            i++;
                        }
                    }
                }

                if (i > 0) {
                    $(".BtnBack").show();
                }
            });
            $(".BtnBack").click(function () {
                $('html, body').animate({scrollTop: 0}, 1000);
                if (i <= steps.length && i > 0) {
                    steps.eq(i).removeClass();
                    contentsA.eq(i).removeClass('display-none').addClass('display-none').prev().removeClass('display-none');
                    contentsA.eq(i).removeClass('slideInRight').addClass('slideInLeft');
                    contentsA.eq(i).css("width", "0%").prev().css("width", "100%");
                    i--;
                }
                if (i > 0) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
            $(".shipping-main-container .section-check-row").click(function () {
                if ($("#ship_same_address").prop("checked")) {
                    $("#ShippingAdress").slideUp();
                }
                else {
                    $("#ShippingAdress").slideDown();
                }
            });
            $(".section-check-row").click(function () {
                if ($("#cart_paymentmethod_credit").prop("checked")) {
                    $(".credit-card-inner").slideDown();
                }
                else {
                    $(".credit-card-inner").slideUp();
                }
            });
        })
    </script>
<link rel="stylesheet" type="text/css"
      href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/cart.css<?= $cash; ?>">
<div class="inner-pages-main-container-a cart-main-container">
    <?= $breadCrumbs; ?>
    <div class="center-piece">
        <div class="message-number-of-book-can-buy">
            <div class="display-block">
                <i class="starnote floating-left"></i>
                <label class="text floating-left"><?= $Lang->messagenumberofbookcanbuy;?></label>
                <a  href="<?=SITE_URL.$lang_code?>/note" class="floating-left more"><?= $Lang->More;?></a>
            </div>
        </div>
        <div id="stepsbar-wrap">
            <div id="stepsbar" class="stepsbar">
                <a class="active"><?= $Lang->ChooseProducts; ?></a>
                <a <?php if (isset($_SESSION["checkout"]) && $_SESSION["checkout"] == "success") {
                    echo 'class="active"';
                } ?>><?= $Lang->ShippingAddress; ?></a>
                <a <?php if (isset($_SESSION["checkout"]) && $_SESSION["checkout"] == "success") {
                    echo 'class="active"';
                } ?>><?= $Lang->PaymentMethod; ?></a>
                <a <?php if (isset($_SESSION["checkout"]) && $_SESSION["checkout"] == "success") {
                    echo 'class="active"';
                } ?>><?= $Lang->Done; ?></a>
            </div>
        </div>
        <?php
        $items = [];
        if (isset($_COOKIE['items']) && $_COOKIE['items'] != "") {
            $items = json_decode($_COOKIE['items'], true);
        }
        if (!isset($items["book"]) || !is_array($items["book"])) {
            $items["book"] = [];
        }
        if (!isset($items["story"]) || !is_array($items["story"])) {
            $items["story"] = [];
        }

        $values = array_keys($items["book"]);
        $itemsList = implode(',', $values);

        $sql = "SELECT `books`.*,`categories`.* FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `bookid` IN(" . $itemsList . ")";
        $result = $con->query($sql);
        $total_price = 0;
        $total_Items = 0;
        ?>
        <div class="steps-container">
            <div class="movings animated <?php if (isset($_SESSION["checkout"]) && $_SESSION["checkout"] == "success") {
                echo 'display-none';
            } else {
                echo "slideInRight";
            } ?>" style="width: 100%;">
                <div class="cat-container-moving floating-left">
                    <div class="display-table manhal">
                        <div class="disply-table-caption table-title">
                            <div class="display-table-cell number-thump"><?= $Lang->No; ?></div>
                            <div class="display-table-cell title"><?= $Lang->title; ?></div>
                            <div class="display-table-cell category"><?= $Lang->Category; ?></div>
                            <div class="display-table-cell price"><?= $Lang->Price; ?></div>
                            <div class="display-table-cell quantity"><?= $Lang->Quantity; ?></div>
                            <div class="display-table-cell total-price"><?= $Lang->TotalPrice; ?></div>
                            <div class="display-table-cell delete_carts_item-style"></div>
                        </div>
                    </div>
                    <div class="table-card-container scrollable">
                        <div class="display-table">
                            <?php
                            $total_weight = 0;
                            $peices = 0;
                            $shipping_cart = '';
                            if (count($items["book"]) > 0) {
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $canRead=getReadingOption("book",$row["bookid"]);
                                    $i++;
                                    $total_Items++;
                                    $item_price = calcItemPrice($row,$items["book"][$row["bookid"]]["type"]);
                                    $item_total_price = $item_price * ($items["book"][$row["bookid"]]["quantity"]);
                                    $total_price += $item_total_price;
                                    $def_qty=25;
                                    if($row["isteacherbook"] || !$row["curriculum"]){
                                        $def_qty=1;
                                    }

                                    $shipping_cart.='<div class="row-container" id="order_book_'.$row["bookid"].'">
                        <div class="cell-container floating-left No" title="'.$total_Items.'"><label class="number">'.$total_Items.'</label></div>
                        <div class="cell-container floating-left Product" title="'.$row['name'].'">'.$row['name'].'</div>
                        <div class="cell-container floating-left Type" title=""><label class="floating-left">'.getTypeText($items["book"][$row["bookid"]]["type"],$row["bookid"],"book").'</label></div>
                        <div class="oreder_quantity cell-container floating-left QTY" title="'.$items["book"][$row["bookid"]]["quantity"].'">'.$items["book"][$row["bookid"]]["quantity"].'</div>
                        <div class="order_subtotal cell-container floating-left subTotal" title="'.$item_price.'"><label><span class="floating-left">$</span><span class="floating-left">'.$item_price.'</span></label></div>
                    </div>';
                                    $viewLink=SITE_URL.$lang_code.'/books/'.$row['bookid'].'/'.str_replace(" ","-",$row['name']);
                                    ?>
                                    <div class="display-table-row bg-row table-title cart_row " data-weight="<?=$row["weight"];?>"  data-type="book"  data-id="<?= $row["bookid"]; ?>">
                                        <div class="display-table-cell number-thump">
                                            <div class="number"><?= $total_Items; ?></div>
                                            <a class="thump-container" href="<?=$viewLink;?>">
                                                <div class="thump"
                                                     style="background-image:url(<?=SITE_URL;?>platform/books/<?=$row['bookid'];?>/cover.jpg );">
                                                </div>
                                            </a>
                                            <a href="<?=$viewLink;?>" class="title1" title="<?= $row['name']; ?>"><?= $row['name']; ?></a>
                                        </div>
                                        <div class="display-table-cell type">
                                            <div class="line-row-type">
                                                <div class="section-check">
                                                    <ul>
                                                        <?php
                                                        $enable="disabled";
                                                        $checked="";
                                                        if($row['booktype']==1 || $row['booktype']==3 || $row['booktype']==5 || $row['booktype']==7){
                                                            $enable="";
                                                            if($items["book"][$row["bookid"]]["type"]==1 || $items["book"][$row["bookid"]]["type"]==3 || $items["book"][$row["bookid"]]["type"]==5 || $items["book"][$row["bookid"]]["type"]==7){
                                                                $checked="checked";
                                                                $total_weight+=$row["weight"]*$items["book"][$row["bookid"]]["quantity"];
                                                                $peices+=$items["book"][$row["bookid"]]["quantity"];
                                                            }
                                                        }
                                                        ?>
                                                        <li weight="<?=$row['weight'];?>"  price="<?=$row['price'];?>"  class="floating-left <?=$enable;?>">
                                                            <label class="input-control checkbox floating-left">
                                                                <input data-type="paper" type="checkbox" <?=$enable;?> class="jq_cart_type" name="Language" id="isPaper<?=$i;?>" value="Paper" <?=$checked;?>><span class="check"></span>
                                                            </label>
                                                            <label for="isPaper<?=$i;?>" class="image-a floating-left"><i></i></label>
                                                            <label for="isPaper<?=$i;?>" class="text floating-left"><?= $Lang->Paper; ?></label>
                                                            <label class="text1 floating-left"><span>(</span><span>$</span><span><?=$row['price'];?></span><span>)</span></label>
                                                        </li>
                                                        <?php

                                                        $enable="disabled";
                                                        $checked="";
                                                        if($row['booktype']==2 || $row['booktype']==3 || $row['booktype']==6 || $row['booktype']==7) {
                                                            $enable="";
                                                            if($items["book"][$row["bookid"]]["type"]==2 || $items["book"][$row["bookid"]]["type"]==3 || $items["book"][$row["bookid"]]["type"]==6 || $items["book"][$row["bookid"]]["type"]==7){
                                                                $checked="checked";
                                                            }
                                                        }


//                                                        if($canRead<2){
                                                            ?>
                                                            <li weight="<?= $row['weight']; ?>" price="<?= $row['eprice']; ?>"
                                                                class="floating-left <?=$enable;?>">
                                                                <label class="input-control checkbox floating-left">
                                                                    <input data-type="electronic" type="checkbox" class="jq_cart_type" <?=$enable;?> name="Language" disabled id="isElectronic<?= $i; ?>" value="Electronic" <?=$checked;?>><span class="check"></span>
                                                                </label>
                                                                <label for="isElectronic<?= $i; ?>" class="image-b floating-left"><i></i></label>
                                                                <label for="isElectronic<?= $i; ?>" class="text floating-left"><?= $Lang->Electronic; ?></label>
                                                                <label
                                                                        class="text1 floating-left"><span>(</span><span>$</span><span><?= $row['eprice']; ?></span><span>)</span></label>
                                                            </li>
                                                            <?php
//                                                        }
                                                        ?>


                                                        <?php

                                                        $enable="disabled";
                                                        $checked="";
                                                        if($row['booktype']==4 || $row['booktype']==5 || $row['booktype']==6 || $row['booktype']==7) {
                                                            $enable="";
                                                            if($items["book"][$row["bookid"]]["type"]==4 || $items["book"][$row["bookid"]]["type"]==5 || $items["book"][$row["bookid"]]["type"]==6 || $items["book"][$row["bookid"]]["type"]==7){
                                                                $checked="checked";
                                                            }
                                                        }

                                                        if($canRead<4){
                                                            ?>
                                                            <li weight="<?= $row['weight']; ?>" price="<?= $row['iprice']; ?>"
                                                                class="floating-left <?=$enable;?>">
                                                                <label class="input-control checkbox floating-left">
                                                                    <input data-type="enrichment" type="checkbox"  <?=$enable;?>
                                                                           class="jq_cart_type" name="Language"
                                                                           id="isEnrichment<?= $i; ?>" value="Enrichment"  <?=$checked;?>><span
                                                                            class="check"></span>
                                                                </label>
                                                                <label for="isEnrichment<?= $i; ?>" class="image-c floating-left"><i></i></label>
                                                                <label for="isEnrichment<?= $i; ?>"
                                                                       class="text floating-left"><?= $Lang->Enrichment; ?></label>
                                                                <label
                                                                        class="text1 floating-left"><span>(</span><span>$</span><span><?= $row['iprice']; ?></span><span>)</span></label>
                                                            </li>
                                                        <?php }?>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                        <div
                                                class="display-table-cell category"><?= $row["name_" . strtolower($_SESSION["lang"])]; ?></div>
                                        <div class="display-table-cell price"><div class="display-inline-block"><span class="floating-left">$</span><span class="floating-left row_price"><?=$item_price;?></span></div></div>
                                        <div class="display-table-cell quantity">
                                            <input type="number" class="book_qty <?php if($row["store"]==1){echo "store";}?>" data-type="book" data-id="<?=$row["bookid"];?>" default-val="<?=$def_qty;?>" item_type="book" item_id="<?= $row['bookid']; ?>" item_price="<?=$item_price; ?>" value="<?=$items["book"][$row["bookid"]]["quantity"]; ?>">
                                        </div>

                                        <div class="display-table-cell price"><div class="display-inline-block"><span class="floating-left">$</span><span class="floating-left carts_row_sum"><?=$item_total_price;?></span></div></div>

                                        <div class="display-table-cell  delete_carts_item-style"><a class="delete_carts_item" title="<?=$Lang->Delete;?>"></a></div>
                                    </div>
                                    <?php
                                }
                            }

                            $gram_weight = (float)number_format($total_weight / 1000, 2);
                            $temp = json_decode(getShippingPrice($gram_weight), true);
                            $shipping = $temp["shipping"];

                            ///get stories Info
                            $values = array_keys($items["story"]);
                            $itemsList = implode(',', $values);
                            $sql = "SELECT `story`.*,`stories_cat`.* FROM `story` INNER JOIN `stories_cat` on `story`.`catid`=`stories_cat`.`catid` WHERE `storyid` IN(" . $itemsList . ")";
                            $result = $con->query($sql);
                            if (count($items["story"]) > 0) {
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $canRead = getReadingOption("story", $row['storyid']);
                                    $i++;
                                    $total_Items++;
                                    $item_price = calcItemPrice($row, $items["story"][$row["storyid"]]["type"]);
                                    $item_total_price = $item_price * $items["story"][$row["storyid"]]["quantity"];
                                    $total_price += $item_total_price;

                                    $total_weight += $row["weight"] * $items["story"][$row["storyid"]]["quantity"];
                                    $peices += $items["story"][$row["storyid"]]["quantity"];


                                    $viewLink = SITE_URL . $lang_code . '/stories/' . $row['storyid'] . '/' . str_replace(" ", "-", $row['title']);
                                    $shipping_cart .= '<div class="row-container" id="order_story_' . $row["storyid"] . '">
                        <div class="cell-container floating-left No"><label class="number">' . $total_Items . '</label></div>
                        <div class="cell-container floating-left Product">' . $row['title'] . '</div>
                        <div class="oreder_quantity cell-container floating-left QTY">' . $items["story"][$row["storyid"]]["quantity"] . '</div>
                        <div class="order_subtotal cell-container floating-left  subTotal"><label><span class="floating-left">$</span><span class="floating-left">' . $item_price . '</span></label></div>
                    </div>';
                                    ?>
                                    <div class="display-table-row bg-row table-title cart_row" data-type="story"
                                         data-id="<?= $row["storyid"]; ?>" data-weight="<?= $row["weight"]; ?>">
                                        <div class="display-table-cell number-thump">
                                            <div class="number"><?= $total_Items; ?></div>
                                            <a class="thump-container" href="<?= $viewLink; ?>">
                                                <div class="thump"
                                                     style="background-image:url(<?= SITE_URL; ?>platform/stories/<?= $row['seriesid']; ?>/story/<?= $row['storyid']; ?>/images/pic.jpg);">
                                                </div>
                                            </a>
                                            <a href="<?= $viewLink; ?>" class="title1" title="<?= $row['title']; ?>"><?= $row['title']; ?></a>
                                        </div>
                                        <div  class="title display-table-cell"></div>
                                        <div
                                            class="display-table-cell category"><?= $row["name_" . $cat_code]; ?></div>
                                        <div class="display-table-cell price">
                                            <div class="display-inline-block"><span class="floating-left">$</span><span
                                                    class="floating-left"><?= $item_price; ?></span></div>
                                        </div>
                                        <div class="display-table-cell quantity">
                                            <input type="number" class="book_qty" item_type="story"
                                                   item_id="<?= $row['storyid']; ?>" item_price="<?= $item_price; ?>"
                                                   value="<?= $items["story"][$row["storyid"]]["quantity"]; ?>">
                                        </div>
                                        <div class="display-table-cell total-price">
                                            <div class="display-inline-block"><span class="floating-left">$</span><span
                                                    class="floating-left carts_row_sum"><?= $item_total_price; ?></span></div>
                                        </div>
                                        <div class="display-table-cell delete_carts_item-style"><a
                                                class="delete_carts_item" title="<?= $Lang->Delete; ?>"></a></div>
                                    </div>
                                    <?php
                                }
                            }

                            $gram_weight = (float)number_format($total_weight / 1000, 2);
                            $temp = json_decode(getShippingPrice($gram_weight), true);
                            $shipping = $temp["shipping"];



                            ///get Toys Info
                            $values = array_keys($items["toy"]);
                            $itemsList = implode(',', $values);
                            $sql = "SELECT `products`.* FROM `products` WHERE `productid` IN(" . $itemsList . ")";
                            $result = $con->query($sql);
                            if (count($items["toy"]) > 0) {
                                $i = 0;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $canRead = true;
                                    $i++;
                                    $total_Items++;
                                    $item_price = $row["Price"];
                                    $item_total_price = $item_price * $items["toy"][$row["productid"]]["quantity"];
                                    $total_price += $item_total_price;

                                    $total_weight += $row["Weight"] * $items["toy"][$row["productid"]]["quantity"];
                                    $peices += $items["toy"][$row["productid"]]["quantity"];

                                    $viewLink = SITE_URL . $lang_code . '/store/toys/' . $row['productid'] . '/' . str_replace(" ", "-", $row['name_' . $cat_code])."?s=1";

                                    $shipping_cart .= '<div class="row-container" id="order_toy_' . $row["productid"] . '">
                        <div class="cell-container floating-left No"><label class="number">' . $total_Items . '</label></div>
                        <div class="cell-container floating-left Product">' . $row['name_' . $cat_code] . '</div>
                        <div class="oreder_quantity cell-container floating-left QTY">' . $items["toy"][$row["productid"]]["quantity"] . '</div>
                        <div class="order_subtotal cell-container floating-left  subTotal"><label><span class="floating-left">$</span><span class="floating-left">' . $item_price . '</span></label></div>
                    </div>';
                                    ?>
                                    <div class="display-table-row bg-row table-title cart_row" data-type="toy"
                                         data-id="<?= $row["productid"]; ?>" data-weight="<?= $row["Weight"]; ?>">
                                        <div class="display-table-cell number-thump">
                                            <div class="number"><?= $total_Items; ?></div>
                                            <a class="thump-container" href="<?= $viewLink; ?>">
                                                <div class="thump"
                                                     style="background-image:url(<?= SITE_URL; ?>platform/products/<?= $row['productid']; ?>/thumbnail_small.jpg);">
                                                </div>
                                            </a>
                                            <a href="<?= $viewLink; ?>" class="title1" title="<?= $row["name_" . $cat_code];?>"><?= $row["name_" . $cat_code];?></a>
                                        </div>
                                        <div  class="title display-table-cell"><?= $row["name_" . $cat_code];?></div>
                                        <div
                                            class="display-table-cell category"><?= $row["name_" . $cat_code]; ?></div>
                                        <div class="display-table-cell price">
                                            <div class="display-inline-block"><span class="floating-left">$</span><span
                                                    class="floating-left"><?= $item_price; ?></span></div>
                                        </div>
                                        <div class="display-table-cell quantity">
                                            <input type="number" class="book_qty" item_type="toy"
                                                   item_id="<?= $row['productid']; ?>" item_price="<?= $item_price; ?>"
                                                   value="<?= $items["toy"][$row["productid"]]["quantity"]; ?>">
                                        </div>




                                        <div class="display-table-cell total-price">
                                            <div class="display-inline-block"><span class="floating-left">$</span><span
                                                    class="floating-left carts_row_sum"><?= $item_total_price; ?></span></div>
                                        </div>
                                        <div class="display-table-cell delete_carts_item-style"><a
                                                class="delete_carts_item" title="<?= $Lang->Delete; ?>"></a></div>
                                    </div>
                                    <?php
                                }
                            }

                            $gram_weight = (float)number_format($total_weight / 1000, 2);
                            $temp = json_decode(getShippingPrice($gram_weight), true);
                            $shipping = $temp["shipping"];

                            ?>
                        </div>
                    </div>
                    <?php
                    if ($total_price == 0) {
                        echo "<div class='no-result-conainer'>" .
                            $Lang->msgNoItems . "
                        </div>";


                    } else {
                        ?>
                        <div class="bottom-container-main">
                            <div class="silver-section">
                                <div class="left-section-card floating-right">
                                    <div class="line-row-card">
                                        <label class="lbl-data-a floating-left"><?= $Lang->TotalPrice; ?> : </label>
                                        <div class="lbl-data-b floating-left ">
                                            <div class="display-inline-block"><span class="floating-left">$</span><span
                                                    class="floating-left cart_grand_total1"
                                                    id="main_cart_grand_total"><?= $total_price; ?></span></div>
                                        </div>
                                    </div>
                                </div>


                                <form METHOD="POST" id="cart_form" action="paypal/functions.php">
                                    <input type="hidden" name="weight" id="cart_weight"
                                           value="<?= round($gram_weight / 1000, 2); ?>">
                                    <input type="hidden" name="cart_country_val" id="cart_country_val">
                                    <input type="hidden" name="contents" id="cart_contents" value="docs">
                                    <input type="hidden" name="data" id="cart_data">
                                    <input type="hidden" name="country_code" id="country_code">
                                    <input type="hidden" name="paymentmethod" id="paymentmethod" value="creditcard">
                                </form>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                </div>
            </div>
            <div class="movings animated display-none" style="width: 100%;">
                <div class="shipping-main-container floating-left">
                    <div class="information-container floating-left ">
                        <div class="floating-left billing-adress">
                            <div class="display-block">
                                <h1 class="floating-left"><?= $Lang->BillingAddress; ?></h1>
                                <span class="floating-right"><?= $Lang->requiedinformation; ?></span>
                            </div>
                            <div class="inputs-container">
                                <div class="line-row">
                                    <div class="display-inline-block relative floating-left ">
                                        <input class="floating-left" title="<?= $Lang->FullName; ?>" type="text"
                                               name="cart_fullname" value="<?php if (isset($_SESSION["user"])) {
                                            echo $_SESSION["user"]["cart_fullname"];
                                        } ?>" id="cart_fullname" placeholder="<?= $Lang->FullName; ?>">
                                        <label class="required"></label>
                                    </div>
                                    <div class="display-inline-block relative floating-right">
                                        <input class="floating-left required" title="<?= $Lang->EMail; ?>" type="email"
                                               name="cart_email" id="cart_email"
                                               value="<?php if (isset($_SESSION["user"])) {
                                                   echo $_SESSION["user"]["email"];
                                               } ?>" placeholder="<?= $Lang->EMail; ?>">
                                    </div>
                                </div>
                                <div class="line-row">
                                    <input class="floating-left" title="<?= $Lang->Phone; ?>" type="tel"
                                           name="cart_phone" id="cart_phone"
                                           value="<?php if (isset($_SESSION["user"])) {
                                               echo $_SESSION["user"]["phone"];
                                           } ?>" placeholder="<?= $Lang->Phone; ?>">
                                    <div class="display-inline-block relative floating-right">
                                        <input class="floating-left required" title="<?= $Lang->Mobile; ?>" type="tel"
                                               name="cart_mobile" id="cart_mobile"
                                               value="<?php if (isset($_SESSION["user"])) {
                                                   echo $_SESSION["user"]["mobile"];
                                               } ?>" placeholder="<?= $Lang->Mobile; ?>">
                                        <label class="required"></label>
                                    </div>
                                </div>

                                <label class="address"><?= $Lang->Address; ?></label>
                                <div class="line-row">
                                    <div class="ddl-container-a floating-left" title="<?= $Lang->ChoseCountry; ?>">
                                        <label class="texr-left" id="lblcart_country"></label>
                                        <select id="cart_country" name="cart_country" class="cart_country">
                                            <option value="-1"><?= $Lang->ChoseCountry; ?></option>
                                            <?php
                                            include "includes/aramex_countries_" . $session_lang . ".php";
                                            ?>
                                            <label class="required"></label>
                                        </select>
                                    </div>
                                    <div class="display-inline-block relative floating-right" title="<?= $Lang->City; ?>">
                                        <input class="floating-left required" title="<?= $Lang->City; ?>" type="text"
                                               id="cart_city" name="cart_city" placeholder="<?= $Lang->City; ?>">
                                        <label class="required"></label>
                                    </div>
                                </div>
                                <div class="line-row">
                                    <div class="display-inline-block relative floating-left">
                                        <input class="floating-left required" style="display: none;" title="<?= $Lang->State; ?>" type="text"
                                               name="state" id="state" placeholder="<?= $Lang->State; ?>">
                                    </div>
                                    <div class="display-inline-block relative floating-right">
                                        <input class="floating-left required" style="display: none;"  title="<?= $Lang->PostCode; ?>"
                                               type="text" name="post" id="post" placeholder="<?= $Lang->PostCode; ?>">
                                    </div>
                                </div>
                                <div class="line-row">
                                    <div class="display-block relative">
                                        <textarea class="floating-left address-area-a required"
                                                  title="<?= $Lang->Address1; ?>" name="cart_address1"
                                                  id="cart_address1"
                                                  placeholder="<?= $Lang->Address1; ?>"><?php if (isset($_SESSION["user"])) {
                                                echo $_SESSION["user"]["address"];
                                            } ?></textarea>
                                        <label class="required"></label>
                                    </div>
                                </div>
                                <div class="line-row">
                                    <textarea class="floating-left address-area-b" title="<?= $Lang->Address2; ?>" name="cart_address2" id="cart_address2" placeholder="<?= $Lang->Address2; ?>"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="floating-left payment-method borders">
                            <div class="section-check-row floating-left">
                                <label class="input-control checkbox floating-left">
                                    <input class="floating-left" checked type="checkbox" name="ship_address"
                                           id="ship_same_address" value="address"><span class="check"></span>
                                </label>
                                <label for="ship_same_address"
                                       class="text floating-left"><?= $Lang->Shiptothesameaddress; ?></label>
                            </div>
                        </div>
                        <div id="ShippingAdress" class="floating-left billing-adress">
                            <h1><?= $Lang->ShippingAddress; ?></h1>
                            <div class="inputs-container">
                                <div class="line-row">
                                    <div class="display-inline-block relative floating-left">
                                        <input class="floating-left" title="<?= $Lang->FullName; ?>" type="text"
                                               name="shipping_fullname" value="<?php if (isset($_SESSION["user"])) {
                                            echo $_SESSION["user"]["shipping_fullname"];
                                        } ?>" id="shipping_fullname" placeholder="<?= $Lang->FullName; ?>">
                                        <label class="required"></label>
                                    </div>
                                    <div class="display-inline-block relative floating-right">
                                        <input class="floating-left required" title="<?= $Lang->EMail; ?>" type="email"
                                               name="shipping_email" id="shipping_email"
                                               value="<?php if (isset($_SESSION["user"])) {
                                                   echo $_SESSION["user"]["email"];
                                               } ?>" placeholder="<?= $Lang->EMail; ?>">
                                    </div>
                                </div>
                                <div class="line-row">
                                    <input class="floating-left" title="<?= $Lang->Phone; ?>" type="tel"
                                           name="shipping_phone" id="shipping_phone"
                                           value="<?php if (isset($_SESSION["user"])) {
                                               echo $_SESSION["user"]["phone"];
                                           } ?>" placeholder="<?= $Lang->Phone; ?>">
                                    <div class="display-inline-block relative floating-right">
                                        <input class="floating-left required" title="<?= $Lang->Mobile; ?>" type="tel"
                                               name="shipping_mobile" id="shipping_mobile"
                                               value="<?php if (isset($_SESSION["user"])) {
                                                   echo $_SESSION["user"]["mobile"];
                                               } ?>" placeholder="<?= $Lang->Mobile; ?>">
                                    </div>
                                </div>
                                <label class="address"><?= $Lang->Address; ?></label>
                                <div class="line-row">
                                    <div class="ddl-container-a floating-left" title="<?= $Lang->ChoseCountry; ?>">
                                        <label class="texr-left" id="lblshipping_country"></label>
                                        <select id="shipping_country" name="shipping_country" class="cart_country">
                                            <option value="-1"><?= $Lang->ChoseCountry; ?></option>
                                            <?php
                                            include "includes/aramex_countries_" . $session_lang . ".php";
                                            ?>
                                        </select>
                                    </div>
                                    <div class="display-inline-block relative floating-right" title="<?= $Lang->City; ?>">
                                        <input class="floating-left required" title="<?= $Lang->City; ?>" type="text"
                                               id="shipping_city" name="shipping_city" placeholder="<?= $Lang->City; ?>">
                                        <label class="required"></label>
                                    </div>
                                </div>
                                <div class="line-row">
                                    <div class="display-inline-block relative floating-left">
                                        <input class="floating-left required" style="display: none;" title="<?= $Lang->State; ?>" type="text"
                                               name="shipping_state" id="shipping_state"
                                               placeholder="<?= $Lang->State; ?>">
                                    </div>
                                    <div class="display-inline-block relative floating-right" >
                                        <input class="floating-left required" style="display: none;" title="<?= $Lang->PostCode; ?>"
                                               type="text" name="shipping_post" id="shipping_post"
                                               placeholder="<?= $Lang->PostCode; ?>">
                                    </div>
                                </div>
                                <div class="line-row">
                                    <div class="display-block relative">
                                        <textarea class="floating-left address-area-a required"
                                                  title="<?= $Lang->Address1; ?>" name="shipping_address1"
                                                  id="shipping_address1"
                                                  placeholder="<?= $Lang->Address1; ?>"><?php if (isset($_SESSION["user"])) {
                                                echo $_SESSION["user"]["address"];
                                            } ?></textarea>
                                        <label class="required"></label>
                                    </div>
                                </div>
                                <div class="line-row">
                                    <textarea class="floating-left address-area-b" title="<?= $Lang->Address2; ?>"
                                              name="shipping_address2" id="shipping_address2"
                                              placeholder="<?= $Lang->Address2; ?>"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="viewer-container floating-left">
                        <div class="viewer-container-background">
                            <div class="ReviewYourOrder"><?= $Lang->ReviewYourOrder; ?></div>
                            <div class="table-container-scroll scrollable">
                                <div class="table-container">
                                    <?= $shipping_cart; ?>
                                </div>
                            </div>
                            <div class="info-container-table floating-right">
                                <?php

                                ?>
                                <div class="line-content">
                                    <label class="floating-left"><?= $Lang->GrandTotal; ?></label>
                                    <span class="order_grandtotal_price floating-right"><div class="floating-left">$
                                        </div><div
                                            class="floating-left cart_grand_total1"><?=$total_price;?></div></span>
                                </div>
                                <input type="hidden" id="shipping_sweight" value="<?=$total_weight;?>">
                            </div>
                        </div>
                        <div class="note-container">
                            <div class="display-block">
                                <i class="starnote floating-left"></i>
                                <label class="text floating-left"><?= $Lang->WeeksDeleverNote; ?></label>
                            </div>
                            <div class="display-block">
                                <i class="starnote floating-left"></i>
                                <label class="text floating-left"><?= $Lang->WeeksDeleverNote2; ?></label>
                            </div>
                        </div>


                    </div>
                    <?php
                    //}
                    ?>
                </div>
            </div>
            <div class="movings animated display-none">
                <div class="shipping-main-container floating-left">
                    <div class="information-container floating-left ">
                        <div class="floating-left payment-method">
                            <h1><?= $Lang->PaymentMethod; ?></h1>
                            <?php
                            //if(isset($_GET["pass"]) && $_GET["pass"]=="yth79785"){
                            ?>
                            <div class="section-check-row floating-left" id="dhl_option">
                                <label class="input-control checkbox floating-left">
                                    <input class="floating-left" type="radio" name="cart_paymentmethod"
                                           id="cart_paymentmethod_credit" value="credit" checked="checked"><span
                                        class="check radius"></span>
                                </label>
                                <label for="cart_paymentmethod_credit" class="image-c floating-left"></label>
                                <label for="cart_paymentmethod_credit"
                                       class="text floating-left"><?= $Lang->CreditCards; ?></label>
                            </div>
                            <div class="credit-card-inner">
                                <form action="<?= Payfort_token_URL; ?>" METHOD="POST" id="card_form" name="card_form">
                                    <div class="line-row">
                                        <label
                                            class="lbl-data-a floating-left text-left"><?= $Lang->CardNumber; ?></label>
                                        <input class="floating-left" maxlength="16" type="text" name="card_number"
                                               value="" id="card_number" placeholder="<?= $Lang->CardNumber; ?>">
                                    </div>
                                    <div class="line-row">
                                        <label
                                            class="lbl-data-a floating-left text-left"><?= $Lang->ExpDate; ?></label>
                                        <div class="ddl-container-b floating-left">
                                            <label class="texr-left" id="lblcart_exp_month">01</label>
                                            <select id="cart_exp_month">
                                                <option value="01">01</option>
                                                <option value="02">02</option>
                                                <option value="03">03</option>
                                                <option value="04">04</option>
                                                <option value="05">05</option>
                                                <option value="06">06</option>
                                                <option value="07">07</option>
                                                <option value="08">08</option>
                                                <option value="09">09</option>
                                                <option value="10">10</option>
                                                <option value="11">11</option>
                                                <option value="12">12</option>
                                            </select>
                                        </div>
                                        <div class="ddl-container-b floating-left">
                                            <label class="texr-left" id="lblcart_exp_year">2017</label>
                                            <select id="cart_exp_year">
                                                <option value="17">2017</option>
                                                <option value="18">2018</option>
                                                <option value="19">2019</option>
                                                <option value="20">2020</option>
                                                <option value="21">2021</option>
                                                <option value="22">2022</option>
                                                <option value="23">2023</option>
                                                <option value="24">2024</option>
                                                <option value="25">2025</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="line-row" style="overflow: visible">
                                        <label class="lbl-data-a floating-left text-left"
                                               style="overflow: visible"><?= $Lang->CVCNumber; ?>
                                            <a class="tooltip">
                                                <div class="images-click"></div>
                                            <span class="custom help" style="display:none;">
                                                <label><?= $Lang->TheCVVtext; ?></label>
                                                <div class="big-help-image"></div>
                                            </span>
                                            </a>
                                        </label>
                                        <input class="floating-left" type="text" name="card_security_code" value=""
                                               id="cart_cvv" placeholder="<?= $Lang->CVCNumber; ?>">
                                    </div>
                                    <input type="hidden" name="service_command" id="service_command" value="">
                                    <input type="hidden" name="access_code" id="access_code" value="">
                                    <input type="hidden" name="merchant_identifier" id="merchant_identifier"
                                           value="">
                                    <input type="hidden" name="merchant_reference" id="merchant_reference" value="">
                                    <input type="hidden" name="language" id="language" value="">
                                    <input type="hidden" name="signature" id="signature" value="">
                                    <input type="hidden" name="expiry_date" id="expiry_date" value="">
                                    <input type="hidden" name="token_name" id="token_name" value="">
                                    <input type="hidden" name="return_url" id="return_url" value="">
                                </form>
                                <input type="hidden" id="device_fingerprint" name="device_fingerprint"/>
                                <script type="text/javascript">
                                    var io_bbout_element_id = 'device_fingerprint';
                                    //the input id will be used to collect the device finger
                                    //print value
                                    var io_install_stm = false;
                                    var io_exclude_stm = 0;
                                    //prevent the iovation Active X control from running on either Windows

                                    var io_install_flash = false;
                                    var io_enable_rip = true; // collect real ip information
                                </script>
                                <script type="text/javascript" src="https://mpsnare.iesnare.com/snare.js"></script>
                            </div>

                            <?php
                            //}
                            ?>
                            <div class="section-check-row floating-left" id="paypal_option">
                                <label class="input-control checkbox floating-left">
                                    <input class="floating-left" type="radio" name="cart_paymentmethod"
                                           id="cart_paymentmethod_paypal" value="paypal"><span
                                        class="check radius"></span></label>
                                <label for="cart_paymentmethod_paypal" class="image-a floating-left"></label>
                                <label for="cart_paymentmethod_paypal"
                                       class="text floating-left"><?= $Lang->Paypal; ?></label>
                            </div>
                            <?php


                            if (isset($_GET["pass2"]) && $_GET["pass"] == "yth5634") {
                            ?>
                            <div class="section-check-row floating-left">
                                <label class="input-control checkbox floating-left">
                                    <input class="floating-left" type="radio" name="cart_paymentmethod"
                                           id="cart_paymentmethod_sadad" value="sadad"><span
                                        class="check radius"></span>
                                </label>
                                <label for="cart_paymentmethod_sadad" class="image-d floating-left"></label>
                                <label for="cart_paymentmethod_sadad"
                                       class="text floating-left"><?= $Lang->Sadad; ?></label>
                            </div>
                            <div class="section-check-row floating-left">
                                <label class="input-control checkbox floating-left">
                                    <input class="floating-left" type="radio" name="cart_paymentmethod"
                                           id="cart_paymentmethod_Installments" value="Installments"><span
                                        class="check radius"></span></label>
                                <label for="cart_paymentmethod_Installments" class="image-e floating-left"></label>
                                <label for="cart_paymentmethod_Installments"
                                       class="text floating-left"><?= $Lang->Installments; ?></label>
                            </div>
                            <div class="section-check-row floating-left">
                                <label class="input-control checkbox floating-left">
                                    <input class="floating-left" type="radio" name="cart_paymentmethod"
                                           id="cart_paymentmethod_NAPS" value="NAPS"><span
                                        class="check radius"></span></label>
                                <label for="cart_paymentmethod_NAPS" class="image-f floating-left"></label>
                                <label for="cart_paymentmethod_NAPS"
                                       class="text floating-left"><?= $Lang->NAPS; ?></label>
                            </div>

                            <?php
                            }

                            ?>

                            <div class="section-check-row floating-left" id="cod_option">
                                <label class="input-control checkbox floating-left">
                                    <input class="floating-left" type="radio" name="cart_paymentmethod"  id="cart_paymentmethod_CashOnDelivery" value="CashOnDelivery"><span class="check radius"></span>
                                </label>
                                <label for="cart_paymentmethod_CashOnDelivery" class="image-b floating-left"></label>
                                <label for="cart_paymentmethod_CashOnDelivery"  class="text floating-left">
                                    <?= $Lang->CashOnDelivery;?>
                                    <span><?=$Lang->Extrachargingonyourinvoice;?></span></label>
                            </div>
                        </div>

                    </div>
                    <div class="viewer-container floating-left">
                        <div class="bill-table-container">
                            <div class="bill-row">
                                <h1>Your Order</h1>
                            </div>
                            <div class="bill-row">
                                <label class="floating-left"><?= $Lang->TotalPrice; ?></label>
                                <span class="floating-right"><div class="floating-left">$</div><div
                                        class="floating-left cart_total_price"><?= $total_price; ?></div class="floating-left"><span>
                            </div>
                            <div class="bill-row">
                                <label class="floating-left"><?= $Lang->Shipping; ?></label>
                                <span class="floating-right"><div class="floating-left">$</div><div
                                        class="floating-left order_shipping"><?= $shipping; ?></div class="floating-left"><span>
                            </div>
                            <div class="bill-row">
                                <label class="floating-left"><?= $Lang->CachOnDeliveryCost; ?></label>
                                <span class="floating-right"><div class="floating-left">$</div><div
                                        class="floating-left cash_cost">0
                                    </div class="floating-left"><span>
                            </div>
                            <div class="bill-row">
                                <label class="floating-left"><?= $Lang->Tax; ?></label>
                                <span class="floating-right"><div class="floating-left">$</div><div
                                        class="floating-left cart_tax"><?= ($total_price + $shipping) * TAX; ?></div class="floating-left"><span>
                            </div>

                            <label class="bill-row">
                                <label class="floating-left" for="donate"><?= $Lang->donateForAlhussain;?></label>
                                <a class="floating-left" target="_blank" href="http://www.khcc.jo/en"><?= $Lang->KingHussein;?></a>
                                <span class="floating-left">($1)</span>
                                <input class="floating-left" type="checkbox" value="1" id="donate" name="donate">
                            </label>
                            <div class="bill-row">
                                <label class="floating-left"><?= $Lang->GrandTotal; ?></label>
                                <span class="floating-right"><div class="floating-left">$</div><div
                                        class="floating-left cart_grand_total"><?= $total_price + ($total_price + $shipping) * TAX + $shipping; ?></div class="floating-left"><span>
                            </div>
                        </div>
                        <?php
                        if (!$detect->isMobile() || $detect->isTablet()) {
                        ?>
                        <div class="safe-secure-container">
                            <div class="text-container">
                                <label><?= $Lang->SafeSecure; ?></label>
                                <p><?= $Lang->SafeSecureP; ?></p>
                            </div>
                            <div class="bottom-container floating-right">
                                <!--                                <div class="images images-a floating-right"></div>-->
                                <!--                                <div class="images images-b floating-right"></div>-->
                                <!--                                <div class="images images-c floating-right"></div>-->
                                <div class="images images-d floating-right"></div>
                                <div class="images images-e floating-right"></div>
                                <div class="images images-f floating-right"></div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="movings animated <?php if (isset($_SESSION["checkout"]) && $_SESSION["checkout"] == "success") {
            echo 'slideInRight';
            } else {
            echo "display-none";
            } ?> " style="width: 100%;">
                <div class="step4-main-conainer">
                    <div class="step4-left-conaioner floating-left">
                        <?php
                        if(isset($_GET["type"]) && $_GET["type"]=="subscribe"){
                            ?>
                            <div class="line-row-step4">
                                <label class="floating-left display-block"><?= $Lang->Purchasedhasbeendonesuccessfully1; ?>
                                    .</label>
                            </div>
                            <div class="line-row-step4">
                                <label class="floating-left"><?= $Lang->clickHereToActivate;?></label>
                                <a class="floating-left"
                                   href="<?= SITE_URL . $lang_code; ?>/membership"><?= $Lang->clickhere;?></a>
                            </div>
                        <?php
                        }elseif(isset($_GET["type"]) && $_GET["type"]=="invoice"){
                            ?>
                            <div class="line-row-step4">
                                <label class="floating-left display-block"><?= $Lang->PurchaseInvoiceSuccess; ?>
                                    .</label>
                            </div>
                            <?php
                        }else{
                            ?>
                            <div class="line-row-step4">
                                <label class="floating-left display-block"><?= $Lang->Purchasedhasbeendonesuccessfully; ?>
                                    .</label>
                            </div>
                            <div class="line-row-step4">
                                <label class="floating-left"><?= $Lang->Toviewordersclickon; ?></label>
                                <a class="floating-left"
                                   href="<?= SITE_URL . $lang_code; ?>/orders"><?= $Lang->ordersA; ?></a>
                            </div>

                            <div class="line-row-step4">
                                <label class="floating-left"><?= $Lang->Toviewpurchasedproductsclickon; ?></label>
                                <a class="floating-left"
                                   href="<?= SITE_URL . $lang_code; ?>/purchased"><?= $Lang->Purchased; ?></a>
                            </div>
                        <?php

                        }
                        ?>

                    </div>
                    <div class="step4-right-conaioner floating-left">

                    </div>
                </div>
            </div>
        </div>


        <a class="floating-right button BtnNext  <?php if ((isset($_SESSION["checkout"]) && $_SESSION["checkout"] == "success") || $total_price == 0) {
        echo 'display-none-important ';
        }
        if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
        echo 'btn-popup" data-type="ContainerA"';
        } else {
        echo 'checkout"';
        } ?>><?= $Lang->Continue; ?></a>
             <a class=" floating-right button BtnBack " style="display:none;"><?= $Lang->Back; ?></a>
    </div>
</div>
<?php
if (isset($_SESSION["checkout"]) && $_SESSION["checkout"] == "success") {
$_SESSION["checkout"] = "Done";
unset($_SESSION["checkout"]);
    ?>
<!--    code for google conversation ads By Hussam Abu Khadijeh-->
    <!-- Event snippet for manhal conversion page -->
    <script>
        gtag('event', 'conversion', {
            'send_to': 'AW-836956915/WzYGCPHhvH0Q8-WLjwM',
            'value': 20.0,
            'currency': 'USD',
            'transaction_id': ''
        });
    </script>

    <script>
        totalprice=10;
        paymentid='ad1';
        fbq('track', 'Purchase', {
            value: totalprice,
            content_ids: paymentid,
        });
    </script>




    <?php
}else{
    ?>
    <script>
        fbq('track', 'InitiateCheckout');
    </script>

<?php
}

?>
<script>
    $(document).ready(function () {

        $(".jq_cart_type").change(function () {
            if($(this).attr("data-type")=="paper" && $(this).prop("checked")==false && $(this).closest(".section-check").find(".jq_cart_type[data-type='enrichment']").prop("checked")==false){
                $(this).closest(".section-check").find(".jq_cart_type[data-type='enrichment']").click();
                //calcbookPrice();
            }else if($(this).attr("data-type")=="enrichment" && $(this).prop("checked")==false && $(this).closest(".section-check").find(".jq_cart_type[data-type='paper']").prop("checked")==false){
                $(this).closest(".section-check").find(".jq_cart_type[data-type='paper']").click();
                //calcbookPrice();
            }else{
                calcbookPrice();
            }
        });


        // $(".book_qty").val(1);
        $(".book_qty").on("change",function () {
            if($(this).attr("item_type")=="book" && $(this).val()<$(this).attr("default-val") && !$(this).hasClass("store")){
                $(this).val($(this).attr("default-val"));
            }
        });

        $(document).on("change",".input_price",function(){
            if($(this).prop("checked")){
                $("#total_price").html(parseFloat(parseFloat($("#total_price").html())+parseFloat($(this).attr("price"))).toFixed(2));
                if($(this).attr("id")=="typeBook" && $("#typeEBook").prop("checked")==false){
                    $("#typeEBook").prop("checked",true);
                }
            }else{
                $("#total_price").html(parseFloat(parseFloat($("#total_price").html())-parseFloat($(this).attr("price"))).toFixed(2));
                if($(this).attr("id")=="typeBook" && $("#typeEBook").prop("checked")){
                    $("#typeEBook").prop("checked",false);

                }
            }
        });
    });
    window.productsWeight =<?=$gram_weight;?>;
    window.pieces =<?=$peices;?>;
    window.total =<?=$total_price;?>;
    window.Tax =<?=TAX;?>;
    window.GrandTotal =<?= $total_price + ($total_price + $shipping) * TAX + $shipping;?>;
    window.Shipping =<?=$shipping;?>;
    window.cod = 0;
    window.TaxValue =<?=($total_price + $shipping) * TAX;?>
</script>
<?php
include_once "includes/footer.php";
?>
