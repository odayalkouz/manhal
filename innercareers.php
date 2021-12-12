<?php
$currentTab="careers";
include "includes/function.php";
include("includes/header.php");
$sql = "SELECT * FROM `careers` WHERE `id`=".$_GET["id"];
$result = $con->query($sql);
$careers = mysqli_fetch_assoc($result);
if($careers['state']!=0){
exit;
}
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/careers.css<?=$cash;?>">
<script type="text/javascript" src="<?=SITE_URL ?>js/lang.js"></script>
<script type="text/javascript" src="<?=SITE_URL ?>js/CV.js"></script>
<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="inner-pages-main-container-careers">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="image-header-container">
                        <h1><?= $Lang->careers;?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="careers-content">
        <div class="center-piece" style="overflow: visible">
            <div class="inner-container">
                <div class="items-main-container inner-career">
                    <div class="display-block-a" id="books">
                        <div class="item-container">
                            <div class="inner-item-container">
                                <h2 class="career-title"><?= $careers['jobtitle_'.strtolower($_SESSION["lang"])]?></h2>
                                <span class="career-location title floating-left"><?=$Lang->location;?> :</span>
                                <span class="career-location location floating-left"><?=$careers['location_'.strtolower($_SESSION["lang"])] ?></span>
                                <span class="working-time floating-left"><?=$careers['workhours_'.strtolower($_SESSION["lang"])]?></span>
                                <div class="career-dec">
                                    <?=$careers['jobdescription_'.strtolower($_SESSION["lang"])]?>
                                </div>

                                <form class="career-contact-us" id="media_form" action="<?=SITE_URL;?>platform/ajax/platform.php?process=uploadcvfile&id=<?= $_GET['id']; ?>&filename=file_cv" method="post"target="hidden_iframe" enctype="multipart/form-data">

                                    <input type="hidden" name="lastname_" id="lastname_" value="">
                                    <input type="hidden" name="firstname_" id="firstname_" value="">
                                    <input type="hidden" name="emailaddress_" id="emailaddress_" value="">
                                    <input type="hidden" name="Phone_" id="Phone_" value="">
                                    <div class="line-row">
                                        <span  class="title floating-left"><?=$Lang->FirstName;?></span><span class="star floating-left">*</span>
                                        <input id="firstname" class="floating-left" type="text">
                                    </div>
                                    <div class="line-row">
                                        <span class="title floating-left"><?=$Lang->LastName;?></span>
                                        <input id="lastname" class="floating-left" type="text">
                                    </div>
                                    <div class="line-row">
                                        <span class="title floating-left"><?=$Lang->EmailAddress;?></span><span class="star floating-left">*</span>
                                        <input id="emailaddress" class="floating-left" type="text">
                                    </div>
                                    <div class="line-row">
                                        <span class="title floating-left"><?=$Lang->Phone;?></span><span class="star floating-left">*</span>
                                        <input id="phone" class="floating-left" type="text">
                                    </div>
                                    <div class="line-row">
                                        <span class="title floating-left"><?=$Lang->Resume;?></span><span class="star floating-left">*</span>
                                        <input class="floating-left" id="Filemedia" type="file" name="Filemedia">
                                    </div>
                                    <div class="line-row">
                                        <div class="g-recaptcha" data-sitekey="6Lfnvj8UAAAAAOp7R2hIx7LfMaDNcQDGrIc6aS7N"></div>
                                        <a href='javascript:sendCV()' class="  button floating-left"><?=$Lang->Send;?></a>
                                        <a href="javascript:reset()" class="button floating-left"><?=$Lang->Reset;?></a>
                                    </div>
                                </form>


                            </div>
                            <div class="note rounded" >
                                <label class="image floating-left"></label>
                                <h2 class="floating-left title"><?=$Lang->CurrentOpenings;?></h2>
                                <!-- AddToAny BEGIN -->
                                <div class="a2a_kit a2a_kit_size_32 a2a_default_style share-side floating-right">
                                    <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                    <a class="a2a_button_facebook"></a>
                                    <a class="a2a_button_twitter"></a>
                                    <a class="a2a_button_google_plus"></a>
                                    <a class="a2a_button_linkedin"></a>
                                    <a class="a2a_button_pinterest"></a>
                                </div>
                                <script>
                                    var a2a_config = a2a_config || {};
                                    a2a_config.onclick = 1;
                                    a2a_config.color_main = "D7E5ED";
                                    a2a_config.color_border = "AECADB";
                                    a2a_config.color_link_text = "333333";
                                    a2a_config.color_link_text_hover = "333333";
                                </script>
                                <script async src="<?= SITE_URL; ?>js/shared.js"></script>
                                <!-- AddToAny END -->
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<iframe id="hidden_iframe" name="hidden_iframe" style="width: 0px;height: 0px;"></iframe>
<?php include("includes/footer.php"); ?>

