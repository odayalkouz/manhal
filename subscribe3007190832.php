<?php
$currentTab = "books";
include_once "platform/config.php";
include_once "includes/function.php";
include_once "platform/includes/function.php";
include_once "includes/header.php";

$sql="SELECT * FROM `cost_subscribe`";
$result=$con->query($sql);
$costs=[];
while($row=mysqli_fetch_assoc($result)){
    $costs[$row["type_user"]][$row["type_cost"]]=$row["cost"];
}
$disableUseres='';
$disableMonths='';
$months=1;
if(isset($_GET["type"]) && $_GET["type"]=="renew"){
    $_SESSION["subscribe_type"]="renew";
    $disableUseres="disabled";
    $sql="SELECT `payments`.*,`payment_subscribe`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`userid`=".$_SESSION['user']['userid']." ORDER BY `payments`.`paymentid` DESC";
    $result=$con->query($sql);
    $oldsubscribe=mysqli_fetch_assoc($result);




    ?>
    <script>
        window.renew=1;
        window.upgrade=0;
    </script>
<?php
}elseif(isset($_GET["type"]) && $_GET["type"]=="upgrade"){
    $_SESSION["subscribe_type"]="upgrade";
    $disableMonths="disabled";
    $sql="SELECT `payments`.*,`payment_subscribe`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`userid`=".$_SESSION['user']['userid']." ORDER BY `payments`.`paymentid` DESC";
    $result=$con->query($sql);
    $oldsubscribe=mysqli_fetch_assoc($result);

    $qtyDays=$_SESSION["subscribe_data"]["months_years"]*30;
    $datediff=strtotime($oldsubscribe["expire_date"])-time();
    $days = floor($datediff/(60*60*24));
    $months=floor($days/30);


    ?>
    <script>
        window.renew=0;
        window.upgrade=1;
    </script>

    <?php
}else{
    $_SESSION["subscribe_type"]="normal";
    ?>
    <script>
    window.renew=0;
    window.upgrade=0;
    </script>
<?php
}


?>
<script>

    cost=<?=json_encode($costs);?>;
    </script>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/subscriptions.css<?=$cash;?>">
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/faq.css<?=$cash;?>">
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/contactus.css<?=$cash;?>">
<script type="text/javascript" src="<?= SITE_URL; ?>js/subscribe.js<?= $cash; ?>"></script>


<section class="inner-pages-main-container-faq-item">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <h1><?=$Lang->Plansandpricing;?></h1>
        <div class="top-box">
            <label><?=$Lang->Accesstomillionsofresources;?></label>
            <span><?=$Lang->GamesExercisesVideosSoundsWorksheetsEBook;?></span>
            <a href="<?= SITE_URL . $lang_code; ?>/products"><?=$Lang->More;?></a>
        </div>
        <div class="wrapper">
        <ul class="tabs">
            <?php
            if(isset($_GET["type"]) && ($_GET["type"]=="renew" || $_GET["type"]=="upgrade") && $oldsubscribe["subscribe_usertype"]=="Parents"){
                $tabfamily="active";
                $tabschool="";
                ?>
                <li class="floating-left active"><i class="families"></i><a><?=$Lang->Families1;?></a></li>
            <?php
            }elseif(isset($_GET["type"]) && ($_GET["type"]=="renew" || $_GET["type"]=="upgrade") && $oldsubscribe["subscribe_usertype"]=="Schools"){
                $tabfamily="";
                $tabschool="active";
                ?>
                <li class="floating-left active"><i class="schools"></i><a><?=$Lang->Schools;?></a></li>
            <?php
            }else{
                $tabfamily="active";
                $tabschool="";
                ?>
                <li class="floating-left active"><i class="families"></i><a><?=$Lang->Families1;?></a></li>
                <li class="floating-left"><i class="schools"></i><a><?=$Lang->Schools;?></a></li>
            <?php
            }
            ?>
            <a href="<?= SITE_URL . $lang_code; ?>/subscribe-tutorial" class="floating-right howtosubscribe"><?=$Lang->subscribe?></a>

        </ul>
        <div class="center-content">
            <div class="left-container floating-left">
                <ul class="tab__content">
                    <li class="tab-li <?=$tabfamily;?>">
                        <div class="content__wrapper first-tab-content">
                           <div class="blue-offer-container">
                               <div class="item-container">
                                   <div class="title">
                                       <h3 class="floating-left"><?=$Lang->Monthly;?></h3>
                                       <span class="floating-left">$<?=$costs[0][0];?> <?=$Lang->perUser;?></span>
                                   </div>

                                   <div class="user-account-row">
                                       <div class="text floating-left"><?=$Lang->UsersAccounts;?></div>
                                       <div class="right floating-left">
                                           <input id="sum_typeuser0" type="number" min="1" max="3" class="floating-left" value="<?php if(isset($_GET["type"]) && ($_GET["type"]=="renew") || $_GET["type"]=="upgrade"){echo $oldsubscribe["students_allowed"];}else{ echo 1;}?>" <?=$disableUseres;?> >
                                           <div class="hit floating-left">X</div>
                                           <div class="number floating-left">
                                               <label class="floating-left">$</label>
                                               <label id="cost_0"  class="floating-left"><?=$costs[0][0];?></label>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="user-account-row">
                                       <div class="text floating-left"><?=$Lang->NumberOfMonths;?></div>
                                       <div class="right floating-left">
                                           <input id="sum_month0" type="number" min="1" max="11" class="floating-left" value="<?=$months;?>" <?=$disableMonths;?> >
                                           <div class="hit floating-left">X</div>
                                           <div class="number floating-left">
                                               <label class="floating-left">$</label>
                                               <label id="cost_month_0"  class="floating-left"><?=$costs[0][0];?></label>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="total-row">
                                       <div class="text floating-left"><?=$Lang->Total;?></div>
                                       <div class="right floating-left">
                                           <div class="number floating-left">
                                               <div class="display-inline-block floating-left">
                                                   <label class="floating-left">$</label>
                                                   <label id="total_0" class="floating-left"><?=$costs[0][0];?></label>
                                               </div>
                                               <span class="floating-left">/ <?=$Lang->Month;?></span>
                                           </div>
                                       </div>
                                   </div>

                                   <?php
                                   $att='';
                                   $datatype='t="Parents" p="Monthly"';
                                   if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
                                       $att='btn-popup';
                                       $datatype='data-type="ContainerA"';
                                   }
                                   ?>
                                   <a <?=$datatype?>  class=" button-join floating-right <?=$att?>"><?=$Lang->Join;?></a>
                               </div>
                               <?php
                               if(!isset($_GET["type"]) || $_GET["type"]!="upgrade"){
                                   ?>
                               <div class="item-container ">
                                   <div class="title">
                                       <h3 class="floating-left"><?=$Lang->Annual;?></h3>
                                       <span class="floating-left">$<?=$costs[0][1];?> <?=$Lang->perUser;?></span>
                                   </div>

                                   <div class="user-account-row">
                                       <div class="text floating-left"><?=$Lang->UsersAccounts;?></div>
                                       <div class="right floating-left">
                                           <input id="sum_typeuser01" type="number" min="1" max="3" type="number" class="floating-left" value="<?php if(isset($_GET["type"]) && ($_GET["type"]=="renew") || $_GET["type"]=="upgrade"){echo $oldsubscribe["students_allowed"];}else{ echo 1;}?>" <?=$disableUseres;?> >
                                           <div class="hit floating-left">X</div>
                                           <div class="number floating-left">
                                               <label class="floating-left">$</label>
                                               <label id="cost_01" class="floating-left"><?=$costs[0][1];?></label>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="user-account-row">
                                       <div class="text floating-left"><?=$Lang->NumberOfYears;?></div>
                                       <div class="right floating-left">
                                           <input id="sum_year01" type="number" min="1" max="5" type="number" class="floating-left" value="1" <?=$disableMonths;?> >
                                           <div class="hit floating-left">X</div>
                                           <div class="number floating-left">
                                               <label class="floating-left">$</label>
                                               <label id="cost_year_01" class="floating-left"><?=$costs[0][1];?></label>
                                           </div>
                                       </div>
                                   </div>
                                   <div class="total-row">
                                       <div class="text floating-left"><?=$Lang->Total;?></div>
                                       <div class="right floating-left">
                                           <div class="number floating-left">
                                               <div class="display-inline-block floating-left">
                                                   <label class="floating-left">$</label>
                                                   <label id="total_01" class="floating-left"><?=$costs[0][1];?></label>
                                               </div>
                                               <span class="floating-left">/ <?=$Lang->Year;?></span>
                                           </div>
                                       </div>
                                   </div>

                                   <?php
                                   $att='';
                                   $datatype='t="Parents" p="Annual"';
                                   if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
                                       $att='btn-popup';
                                       $datatype='data-type="ContainerA"';

                                   }
                                   ?>
                                   <a <?=$datatype?>  class=" button-join floating-right <?=$att?>"><?=$Lang->Join;?></a>





                               </div>
                                   <?php
                               }
                               ?>
                           </div>
                        </div>
                    </li>
                    <li class="tab-li <?=$tabschool;?>">
                        <div class="content__wrapper secound-tab-content">
                            <div class="orange-offer-container">
                                <div class="item-container">
                                    <div class="title">
                                        <h3 class="floating-left"><?=$Lang->Monthly;?></h3>
                                        <span class="floating-left">$<?=$costs[1][0];?> <?=$Lang->perUser;?></span>
                                    </div>

                                    <div class="user-account-row">
                                        <div class="text floating-left"><?=$Lang->UsersAccounts;?></div>
                                        <div class="right floating-left">
                                            <input id="sum_typeuser10" type="number" min="10"  type="number" class="floating-left" value="<?php if(isset($_GET["type"]) && ($_GET["type"]=="renew") || $_GET["type"]=="upgrade"){echo $oldsubscribe["students_allowed"];}else{ echo 10;}?>" <?=$disableUseres;?> >
                                            <div class="hit floating-left">X</div>
                                            <div class="number floating-left">
                                                <label class="floating-left">$</label>
                                                <label id="cost_10" class="floating-left"><?=$costs[1][0];?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-account-row">
                                        <div class="text floating-left"><?=$Lang->NumberOfMonths;?></div>
                                        <div class="right floating-left">
                                            <input id="sum_month10" type="number" min="1" max="11"  type="number" class="floating-left" value="<?=$months?>" <?=$disableMonths;?>>
                                            <div class="hit floating-left">X</div>
                                            <div class="number floating-left">
                                                <label class="floating-left">$</label>
                                                <label id="cost_month_10" class="floating-left"><?=$costs[1][0];?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="user-account-row">
                                        <div class="text floating-left"><?=$Lang->TeachersAccounts;?></div>
                                        <div class="right floating-left">
                                            <div class="number floating-left">
                                                <div class="display-inline-block floating-left">
                                                    <label id="teacher_0" class="floating-left">1</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="total-row">
                                        <div class="text floating-left"><?=$Lang->Total;?></div>
                                        <div class="right floating-left">
                                            <div class="number floating-left">
                                                <div class="display-inline-block floating-left">
                                                    <label class="floating-left">$</label>
                                                    <label id="total_10" class="floating-left"><?=$costs[1][0]*10;?></label>
                                                </div>
                                                <span class="floating-left">/<?=$Lang->Month;?></span>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    $att='';
                                    $datatype='t="Schools" p="Monthly"';
                                    if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
                                        $att='btn-popup';
                                        $datatype='data-type="ContainerA"';

                                    }
                                    ?>
                                    <a <?=$datatype?>  class=" button-join floating-right <?=$att?>"><?=$Lang->Join;?></a>




                                </div>
                                <?php
                                if(!isset($_GET["type"]) || $_GET["type"]!="upgrade"){
                                ?>
                                <div class="item-container ">
                                    <div class="title">
                                        <h3 class="floating-left"><?=$Lang->Annual;?></h3>
                                        <span class="floating-left">$<?=$costs[1][1];?> <?=$Lang->perUser;?></span>
                                    </div>

                                    <div class="user-account-row">
                                        <div class="text floating-left"><?=$Lang->UsersAccounts;?></div>
                                        <div class="right floating-left">
                                            <input id="sum_typeuser11" type="number" min="10"  type="number" class="floating-left" value="<?php if(isset($_GET["type"]) && ($_GET["type"]=="renew") || $_GET["type"]=="upgrade"){echo $oldsubscribe["students_allowed"];}else{ echo 10;}?>" <?=$disableUseres;?> >
                                            <div class="hit floating-left">X</div>
                                            <div class="number floating-left">
                                                <label class="floating-left">$</label>
                                                <label id="cost_11" class="floating-left"><?=$costs[1][1];?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="user-account-row">
                                        <div class="text floating-left"><?=$Lang->NumberOfYears;?></div>
                                        <div class="right floating-left">
                                            <input id="sum_year11" type="number" min="1" max="5" type="number" class="floating-left" value="1" <?=$disableMonths;?>>
                                            <div class="hit floating-left">X</div>
                                            <div class="number floating-left">
                                                <label class="floating-left">$</label>
                                                <label id="cost_year_11" class="floating-left"><?=$costs[1][1];?></label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="user-account-row">
                                        <div class="text floating-left"><?=$Lang->TeachersAccounts;?></div>
                                        <div class="right floating-left">
                                            <div class="number floating-left">
                                                <div class="display-inline-block floating-left">
                                                    <label id="teacher_1" class="floating-left">1</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="total-row">
                                        <div class="text floating-left"><?=$Lang->Total;?></div>
                                        <div class="right floating-left">
                                            <div class="number floating-left">
                                                <div class="display-inline-block floating-left">
                                                    <label class="floating-left">$</label>
                                                    <label id="total_11" class="floating-left"><?=$costs[1][1]*10;?></label>
                                                </div>
                                                <span class="floating-left">/ <?=$Lang->Year;?></span>
                                            </div>
                                        </div>
                                    </div>
                                   <?php
                                   $att='';
                                   $datatype='t="Schools" p="Annual"';
                                    if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
                                        $att='btn-popup';
                                        $datatype='data-type="ContainerA"';

                                    }
                                    ?>
                                    <a <?=$datatype?>  class=" button-join floating-right <?=$att?>"><?=$Lang->Join;?></a>

                                </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
      </div>
    </div>
</section>
<section class="right-resources-container">
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <h1><?=$Lang->Findtherightresourcesforyou;?></h1>
                    <div class="content-container">
                        <div class="left-container floating-left">
                            <h2><?=$Lang->LearningResources;?></h2>
                            <ul>
                                <li class="floating-left"><i class="floating-left"></i><label class="floating-left"><?=$Lang->LearningResourcesB;?></label></li>
                                <li class="floating-left"><i class="floating-left"></i><label class="floating-left"><?=$Lang->LearningResourcesC;?></label></li>
                                <li class="floating-left"><i class="floating-left"></i><label class="floating-left"><?=$Lang->LearningResourcesE;?></label></li>
                                <li class="floating-left"><i class="floating-left"></i><label class="floating-left"><?=$Lang->LearningResourcesF;?></label></li>
                                <li class="floating-left"><i class="floating-left"></i><label class="floating-left"><?=$Lang->LearningResourcesg;?></label></li>
                                <li class="floating-left"><i class="floating-left"></i><label class="floating-left"><?=$Lang->LearningResourcesk;?></label></li>
                                <h2><?=$Lang->ComingSoon;?></h2>
                                <li class="floating-left"><i class="floating-left"></i><label class="floating-left"><?=$Lang->LearningResourcesi;?></label></li>
                                <li class="floating-left"><i class="floating-left"></i><label class="floating-left"><?=$Lang->LearningResourcesj;?></label></li>
                                <li class="floating-left"><i class="floating-left"></i><label class="floating-left"><?=$Lang->LearningResourcesl;?></label></li>
                            </ul>
                        </div>
                        <div class="right-container floating-left"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="inner-pages-main-container-faq" style="display:none;">
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="image-header-container">
                        <h1><?=$Lang->Frequentlyaskedquestions;?></h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="accordion">
                <?php
                $sql = "SELECT * FROM `faq` ";
                $result = $con->query($sql);
                if (mysqli_num_rows($result) > 0)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                    echo'<div class="accordion-item">';
                    echo'<a>'.$row['Q_'.strtolower($session_lang)].'</a>';
                    echo'<div class="content"><p>'.$row['A_'.strtolower($session_lang)].'</p></div></div>';
                    }
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="center-piece">
    <div class="email-us-container">
        <label><?=$Lang->NeedNoorcomforyourschooldistrictorgroup;?></label>
        <a class="toggle-form"><?=$Lang->EmailUs;?></a>
    </div>
    <div class="about-us-main-container">
        <form id="contact_form" style="display: none">
            <div class="contact-form">
                <h1><?=$Lang->ContactUsforMoreInfo;?></h1>
                <div class="line-row">
                    <input type="text" name="name" id="name" placeholder="<?=$Lang->Name;?>" class="txt-a floating-left">
                    <input type="email" name="email" id="email" placeholder="<?=$Lang->EMail;?>" class="txt-a floating-left">
                </div>
                <div class="line-row">
                    <input type="text" name="job" id="job" placeholder="<?=$Lang->JobTitle;?>" class="txt-a floating-left">
                    <input type="email" name="phone" id="phone" placeholder="<?=$Lang->Phone;?>" class="txt-a floating-left">
                </div>
                <div class="line-row">
                    <input style="width: 100%" type="text" name="school" id="school" placeholder="<?=$Lang->SchoolorOrganizationName;?>" class="txt-a floating-left">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?=$Lang->AccountType;?></label>
                    <select class="input-type-number floating-left" name="orgtype" id="orgtype">
                        <option value="<?=$Lang->Schools;?>"><?=$Lang->Schools;?></option>
                        <option value="<?=$Lang->Families;?>"><?=$Lang->Families;?></option>
                    </select>
                    <label class="lbl-data-b floating-left"><?=$Lang->NumberofStudents;?></label>
                    <input class="floating-left input-type-number" type="number" value="1"  min="1">
                </div>
                <div class="line-row">
                    <textarea name="message" id="message" placeholder="<?= $Lang->Message; ?>" class="txt-area-a floating-left"></textarea>
                </div>
                <div class="line-row">
                    <input type="reset" class="floating-right btn-a btnreset" value="<?= $Lang->Reset;?>">
                    <input type="button" id="subscribe_email" class="floating-right btn-a" value="<?= $Lang->Send;?>">
                </div>
            </div>
        </form>
    </div>
</section>
<?php
include_once "includes/footer.php";
?>

