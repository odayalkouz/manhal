<?php
if(isset($_GET['app']) && $_GET['app']==1) {

    $server_root = $_SERVER['DOCUMENT_ROOT'] . "/manhal/";
//    $server_root = $_SERVER['DOCUMENT_ROOT'] . "/";
    include_once($server_root . 'platform/config.php');
    include_once $server_root . "platform/showroom/includes/db.php";
    include_once $server_root . "platform/showroom/includes/functions.php";
    $URL = "http://localhost/Manhal/platform/showroom";
//    $real_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//    $URL = "https://manhal.com/platform/showroom";

    if (isset($_SESSION["lang"]) && $_SESSION["lang"] != "") {
        $db_lang = strtolower($_SESSION["lang"]);
        $Lang = simplexml_load_file($server_root . "language/" . ucfirst($_SESSION["lang"]) . ".xml");
    } else {
        $db_lang = "En";
        $_SESSION["lang"] = "En";
        $Lang = simplexml_load_file($server_root . "language/En.xml");
    }
    ?>
    <link data-type="favicon" href="<?=$URL;?>/themes/all/images/favicon.ico" type="image/x-icon" rel="icon">
    <link rel="stylesheet" href="<?=$URL;?>/themes/<?=$_SESSION["lang"];?>/css/main.css">
    <link rel="stylesheet" href="<?=$URL;?>/themes/all/css/jquery-ui.css">
    <link rel="stylesheet" href="<?=$URL;?>/themes/all/css/lobibox.min.css"/>
    <link rel="stylesheet" href="<?=$URL;?>/themes/all/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?=$URL;?>/themes/all/css/jquery.fancybox.min.css"/>
    <link rel="stylesheet" href="<?=$URL;?>/themes/all/css/dataTables.bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?=$URL;?>/themes/all/css/bootstrap-multiselect.css" type="text/css"/>
    <div class="app-main__inner">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title"><?=$Lang->TermsConditions;?></h5>
                    <p><?=$Lang->TermsConditionsp1?></p>
                    <h6><b><?=$Lang->Copyrightandownership?></b></h6>
                    <p><?=$Lang->TermsConditionsp2?></p>
                    <h6><b><?=$Lang->Siteaccesslicense?></b></h6>
                    <p><?=$Lang->TermsConditionsp3?></p>
                    <h6><b><?=$Lang->Corporateidentificationtrademarks?></b></h6>
                    <p><?=$Lang->TermsConditionsp4?></p>
                    <h6><b><?=$Lang->Linkstothirdpartiesnoendorsement?></b></h6>
                    <p><?=$Lang->TermsConditionsp5?></p>
                    <h6><b><?=$Lang->Fees?></b></h6>
                    <p><?=$Lang->TermsConditionsp6?></p>
                    <h6><b><?=$Lang->privacyPolicy?></b></h6>
                    <p><?=$Lang->TermsConditionsp7?></p>
                    <h6><b><?=$Lang->Usersubmissions?></b></h6>
                    <p><?=$Lang->TermsConditionsp8?></p>
                    <p><?=$Lang->TermsConditionsp9?></p>
                    <ul>
                        <li><span class="floating-left"><?=$Lang->TermsConditionsp10?></span></a></li>
                        <li><span class="floating-left"><?=$Lang->TermsConditionsp11?></span></a></li>
                        <li><span class="floating-left"><?=$Lang->TermsConditionsp12?></span></a></li>
                        <li><span class="floating-left"><?=$Lang->TermsConditionsp13?></span></a></li>
                        <li><span class="floating-left"><?=$Lang->TermsConditionsp14?></span></a></li>
                        <li><span class="floating-left"><?=$Lang->TermsConditionsp15?></span></a></li>
                        <li><span class="floating-left"><?=$Lang->TermsConditionsp16?></span></a></li>
                    </ul>
                    <p><?=$Lang->TermsConditionsp17?></p>
                    <h6><b><?=$Lang->Removalofusersubmissions?></b></h6>
                    <p><?=$Lang->TermsConditionsp18?></p>
                    <h6><b><?=$Lang->Accountregistrationandsecurity?></b></h6>
                    <p><?=$Lang->TermsConditionsp19?></p>
                    <h6><b><?=$Lang->Termination?></b></h6>
                    <p><?=$Lang->TermsConditionsp20?></p>
                    <h6><b><?=$Lang->Forcemajeure?></b></h6>
                    <p><?=$Lang->TermsConditionsp21?></p>
                    <h6><b><?=$Lang->Entireagreement?></b></h6>
                    <p><?=$Lang->TermsConditionsp22?></p>
                </div>
            </div>
        </div>
    </div>
    <?php
}
else{
$currentTab="";
    include_once 'includes/breadcrumb.php';
    $bredcrumb="<li class='breadcrumb-item'><a href='../index.php'>".$Breadcrumbs->getlang('Dashboard')."</a></li><li class='breadcrumb-item active' aria-current='page'>".$Breadcrumbs->getlang('termsconditions')."</li>";
include_once "includes/header.php";
?>
    <div class="app-main__inner">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title"><?=$prosses->getlang('TermsConditions');?></h5>
                    <p><?=$prosses->getlang('TermsConditionsp1');?></p>
                    <h6><b><?=$prosses->getlang('Copyrightandownership');?></b></h6>
                    <p><?=$prosses->getlang('TermsConditionsp2');?></p>
                    <h6><b><?=$prosses->getlang('Siteaccesslicense');?></b></h6>
                    <p><?=$prosses->getlang('TermsConditionsp3');?></p>
                    <h6><b><?=$prosses->getlang('Corporateidentificationtrademarks');?></b></h6>
                    <p><?=$prosses->getlang('TermsConditionsp4');?></p>
                    <h6><b><?=$prosses->getlang('Linkstothirdpartiesnoendorsement');?></b></h6>
                    <p><?=$prosses->getlang('TermsConditionsp5');?></p>
                    <h6><b><?=$prosses->getlang('Fees');?></b></h6>
                    <p><?=$prosses->getlang('TermsConditionsp6');?></p>
                    <h6><b><?=$prosses->getlang('privacyPolicy');?></b></h6>
                    <p><?=$prosses->getlang('TermsConditionsp7');?></p>
                    <h6><b><?=$prosses->getlang('Usersubmissions');?></b></h6>
                    <p><?=$prosses->getlang('TermsConditionsp8');?></p>
                    <p><?=$prosses->getlang('TermsConditionsp9');?></p>
                    <ul>
                        <li><span class="floating-left"><?=$prosses->getlang('TermsConditionsp10');?></span></a></li>
                        <li><span class="floating-left"><?=$prosses->getlang('TermsConditionsp11');?></span></a></li>
                        <li><span class="floating-left"><?=$prosses->getlang('TermsConditionsp12');?></span></a></li>
                        <li><span class="floating-left"><?=$prosses->getlang('TermsConditionsp13');?></span></a></li>
                        <li><span class="floating-left"><?=$prosses->getlang('TermsConditionsp14');?></span></a></li>
                        <li><span class="floating-left"><?=$prosses->getlang('TermsConditionsp15');?></span></a></li>
                        <li><span class="floating-left"><?=$prosses->getlang('TermsConditionsp16');?></span></a></li>
                    </ul>
                    <p><?=$prosses->getlang('TermsConditionsp17');?></p>
                    <h6><b><?=$prosses->getlang('Removalofusersubmissions');?></b></h6>
                    <p><?=$prosses->getlang('TermsConditionsp18');?></p>
                    <h6><b><?=$prosses->getlang('Accountregistrationandsecurity');?></b></h6>
                    <p><?=$prosses->getlang('TermsConditionsp19');?></p>
                    <h6><b><?=$prosses->getlang('Termination');?></b></h6>
                    <p><?=$prosses->getlang('TermsConditionsp20');?></p>
                    <h6><b><?=$prosses->getlang('Forcemajeure');?></b></h6>
                    <p><?=$prosses->getlang('TermsConditionsp21');?></p>
                    <h6><b><?=$prosses->getlang('Entireagreement');?></b></h6>
                    <p><?=$prosses->getlang('TermsConditionsp22');?></p>
                </div>
            </div>
        </div>
    </div>
    <?php
    include_once "includes/footer.php";
}
?>

