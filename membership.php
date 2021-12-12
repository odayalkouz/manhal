<?php
$currentTab = "cart";
include_once "platform/config.php";
include_once "includes/function.php";
include_once "platform/includes/function.php";
mustLogin();
include_once "includes/header.php";
?>
<link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?=$session_lang;?>/css/cart.css<?=$cash;?>">
<link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?=$session_lang;?>/css/membership.css<?=$cash;?>">
<div class="inner-pages-main-container-a cart-main-container">
    <?= $breadCrumbs; ?>
    <div class="center-piece">
        <?php
        $sql="SELECT `payments`.*,`payment_subscribe`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`userid`=".$_SESSION['user']['userid']." ORDER BY `payments`.`paymentid` DESC";
        $result=$con->query($sql);
        if(mysqli_num_rows($result)>0){
            $row=mysqli_fetch_assoc($result);
?>

            <div class="shipping-main-container floating-left">
                <div class="information-container floating-left ">
                    <div class="floating-left payment-method">
                        <h2><?= $Lang->Subscriptionstatus;?></h2>
                        <div class="credit-card-inner">
                            <div class="line-membership">
                                <label class="floating-left text-left"><?=$Lang->Status;?></label>
                                <?php
                                if(strtotime($row["expire_date"]) > time() && $row["status"]==1){
                                    echo '<span class="floating-left text-left active">'.$Lang->Active.'</span>';
                                }else{
                                    echo '<span class="floating-left text-left end">'.$Lang->Expired.'</span>';
                                }
                                ?>
                            </div>
                            <div class="line-membership-b">
                                <label class="floating-left text-left"><?= $Lang->BillingDate;?></label>
                                <span class="floating-left text-left"><?=$row["payment_date"];?></span>
                                <label class="floating-left text-left"><?= $Lang->ExpirationDate;?></label>
                                <span class="floating-left text-left"><?=$row["expire_date"];?></span>
                            </div>
                        </div>
                    </div>

                    <?php
                    if(strtolower($row["subscribe_usertype"])=="parents") {
                        ?>
                        <div class="floating-left payment-method membership">
                            <h2><?= $Lang->MemberDetails; ?></h2>
                            <div class="credit-card-inner">
                                <div class="line-membership">
                                    <span class="floating-left text-left without"><div
                                            class="floating-left"><?= $Lang->Numberofmember; ?></div> <div
                                            class="floating-left"><?= $row["students_allowed"]; ?></div></span>
                                </div>
                                <div class="line-membership-b">
                                    <label class="floating-left text-left"><?= $Lang->MemberActive; ?></label>
                                    <span class="floating-left text-left"><?= $row["students_active"]; ?></span>
                                    <label class="floating-left text-left"><?= $Lang->MemberAvailable; ?></label>
                                    <span
                                        class="floating-left text-left"><?= $row["students_allowed"] - $row["students_active"]; ?></span>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="viewer-container floating-left">
                    <div class="bill-table-container">
                        <div class="bill-row">
                            <h1><?=$Lang->YourMembership;?></h1>
                        </div>
                        <div class="membership-lines">
                            <label class="floating-left"><?= $Lang->TypeofMembership;?></label>
                            <span class="floating-left"><div class="floating-left"><?= $Lang->{$row["subscribe_usertype"]};?></div><div class="floating-left"> / </div><div class="floating-left"><?= $Lang->{$row["subscribe_type"]};?></div></span>
                        </div>
                        <?php
                        if(strtolower($row["subscribe_usertype"])=="parents") {
                        ?>
                            <div class="membership-lines">
                                <label class="floating-left"><?= $Lang->ActivationCode;?> :</label>
                                <span class="floating-left"><?=$row["users_code"];?></span>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="membership-lines">
                            <label class="floating-left"><?= $Lang->Cost;?> :</label>
                            <span class="floating-left">$<?=$row["total_price"];?></span>
                        </div>
                        <div class="membership-lines-a">
                            <label class="floating-left"><?= $Lang->costperusers;?> :</label>
                            <span class="floating-left">$<?=$row["price"];?></span>
                        </div>
                        <div class="membership-lines-a">
                            <label class="floating-left"><?=$Lang->UsersAccounts;?> :</label>
                            <span class="floating-left"><div class="floating-left"><?=$row["students_allowed"];?></div><div class="floating-left">X</div><div class="floating-left">$<?=$row["price"];?></div></span>
                        </div>
                    </div>
                </div>


<?php
if(strtolower($row["subscribe_usertype"])=="schools"){
?>


                <div class="shipping-main-container floating-left">
                    <h3 class="full-width-title"><?= $Lang->MemberDetails;?></h3>
                    <div class="information-container floating-left">
                        <div class="floating-left payment-method membershipA">
                            <h2><?= $Lang->Teachers;?></h2>
                            <div class="credit-card-inner">
                                <div class="line-membership">
                                    <span class="floating-left text-left without"><div class="floating-left"><?= $Lang->NumberofTeacher;?></div><div class="floating-left"><?=$row["teachers_allowed"];?></div></span>
                                </div>
                                <div class="line-membership-b">
                                    <label class="floating-left text-left"><?= $Lang->TeacherActive;?></label>
                                    <span class="floating-left text-left"><?=$row["teachers_active"];?></span>
                                    <label class="floating-left text-left"><?= $Lang->TeacherAvailable;?></label>
                                    <span class="floating-left text-left"><?=$row["teachers_allowed"]-$row["teachers_active"];?></span>
                                </div>
                                <div class="line-membership-c">
                                    <label class="floating-left text-left"><div class="floating-left"><?=$Lang->ActivationNO;?></div><div class="floating-left"><?=$row["teachers_code"];?></div></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="information-container floating-left">
                        <div class="floating-left payment-method membership">
                            <h2><?= $Lang->Students;?></h2>
                            <div class="credit-card-inner">
                                <div class="line-membership">
                                    <span class="floating-left text-left without"><div class="floating-left"><?= $Lang->NumberofStudent;?></div> <div class="floating-left"><?=$row["students_allowed"];?></div></span>
                                </div>
                                <div class="line-membership-b">
                                    <label class="floating-left text-left"><?= $Lang->StudentActive;?></label>
                                    <span class="floating-left text-left"><?=$row["students_active"];?></span>
                                    <label class="floating-left text-left"><?= $Lang->StudentAvailable;?></label>
                                    <span class="floating-left text-left"><?=$row["students_allowed"]-$row["students_active"];?></span>
                                </div>
                                <div class="line-membership-c">
                                    <label class="floating-left text-left"><div class="floating-left"><?=$Lang->ActivationNO;?></div><div class="floating-left"><?=$row["users_code"];?></div></label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    }


                    if(strtotime($row["expire_date"]) > time() && $row["status"]==1){
                       ?>
                        <a href="<?=SITE_URL.$lang_code."/subscribe?type=renew";?>" class="floating-right button BtnNext"><?=$Lang->renew;?></a>
                        <a href="<?=SITE_URL.$lang_code."/subscribe?type=upgrade";?>" class="floating-right button BtnNext"><?=$Lang->upgrade;?></a>
                    <?php
                    }else{
                        ?>
                        <a href="<?=SITE_URL.$lang_code."/subscribe";?>" class="floating-right button BtnNext"><?=$Lang->renew;?></a>
                    <?php
                    }
                    ?>

            </div>
        <?php
        }else{//no subscription
        ?>
        <div class="movings animated slideInRight" style="width: 100%;">
                <div class="step4-main-conainer">
                    <div class="step4-left-conaioner floating-left">
                        <div class="line-row-step4">
                            <label class="floating-left display-block"><?= $Lang->youDontHaveMembership; ?>
        .</label>
    </div>

        <div class="line-row-step4">
            <label class="floating-left"><?= $Lang->toUseOurServiceSubsc; ?></label>
        </div>

        <div class="line-row-step4">
            <a class="floating-left"
               href="<?= SITE_URL . $lang_code; ?>/subscribe"><?= $Lang->clickHeretosub;?></a>
        </div>


        </div>
    <div class="step4-right-conaioner floating-left">

    </div>
    </div>
</div>
        <?php
        }
        ?>

</div>
<?php
include_once "includes/footer.php";
?>
