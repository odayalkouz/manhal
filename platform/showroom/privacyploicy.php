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
                        <h5 class="card-title"><?= $Lang->privacyPolicy; ?></h5>
                        <p><?= $Lang->privacyPolicy1 ?></p>
                        <h6><B><?= $Lang->Whatinformationwecollectaboutyou ?></B></h6>
                        <p><?= $Lang->privacyPolicy2 ?></p>
                        <p><?= $Lang->privacyPolicy3 ?></p>
                        <P><?= $Lang->privacyPolicy4 ?></P>
                        <P><?= $Lang->privacyPolicy5 ?></P>
                        <h6><B><?= $Lang->Sharingwiththirdparties ?></B></h6>
                        <p><?= $Lang->privacyPolicy6 ?></p>
                        <p><?= $Lang->privacyPolicy7 ?></p>
                        <h6><B><?= $Lang->Thirdpartysites ?></B></h6>
                        <ul>
                            <li>
                                <div class="cirlce floating-left"></div>
                                <span class="auto floating-left"><?= $Lang->privacyPolicLI1 ?></span><a target="_blank"
                                                                                                        href="https://support.google.com/analytics/answer/6004245?hl=en"
                                                                                                        class="floating-left"><?= $Lang->here ?></a>
                            </li>
                            <li>
                                <div class="cirlce floating-left"></div>
                                <span class="auto floating-left"><?= $Lang->privacyPolicLI2 ?></span><a target="_blank"
                                                                                                        href="https://www.paypal.com/us/webapps/mpp/public-policy"
                                                                                                        class="floating-left"><?= $Lang->here ?></a>
                            </li>
                        </ul>
                        <h6><B><?= $Lang->Dataretentionpolicy ?></B></h6>
                        <p><?= $Lang->privacyPolicy9 ?></p>
                        <h6><B><?= $Lang->DataSecurity ?></B></h6>
                        <p><?= $Lang->privacyPolicy10 ?></p>
                        <p><?= $Lang->privacyPolicy11 ?></p>
                        <h6><B><?= $Lang->Changestothisprivacypolicy ?></B></h6>
                        <p><?= $Lang->privacyPolicy12 ?></p>
                        <h6><B><?= $Lang->ContectUs ?></B></h6>
                        <p><?= $Lang->privacyPolicy13 ?></p>
                        <h3 class="text-left"><?= $Lang->DarAlManhalPublishers ?></h3>
                        <div><?= $Lang->TitleOne ?></div>
                        <div><?= $Lang->Titletwo ?></div>
                        <div><?= $Lang->Titlethree ?></div>
                        <div><?= $Lang->Titlefour ?></div>
                    </div>
                </div>
            </div>
        </div>

    <?php
}
else{
    $currentTab="";
    include_once 'includes/breadcrumb.php';
    $bredcrumb="<li class='breadcrumb-item'><a href='../index.php'>".$Breadcrumbs->getlang('Dashboard')."</a></li><li class='breadcrumb-item active' aria-current='page'>".$Breadcrumbs->getlang('privacyPolicy')."</li>";
    include_once "includes/header.php";
    ?>
    <div class="app-main__inner">
        <div class="col-lg-12">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title"><?=$prosses->getlang('privacyPolicy');?></h5>
                    <p><?=$prosses->getlang('privacyPolicy1');?></p>
                    <h6><B><?=$prosses->getlang('Whatinformationwecollectaboutyou');?></B></h6>
                    <p><?=$prosses->getlang('privacyPolicy2');?></p>
                    <p><?=$prosses->getlang('privacyPolicy3');?></p>
                    <P><?=$prosses->getlang('privacyPolicy4');?></P>
                    <P><?=$prosses->getlang('privacyPolicy5');?></P>
                    <h6><B><?=$prosses->getlang('Sharingwiththirdparties');?></B></h6>
                    <p><?=$prosses->getlang('privacyPolicy6');?></p>
                    <p><?=$prosses->getlang('privacyPolicy7');?></p>
                    <h6><B><?=$prosses->getlang('Thirdpartysites');?></B></h6>
                    <ul>
                        <li>
                            <div class="cirlce floating-left"></div>
                            <span class="auto floating-left"><?=$prosses->getlang('privacyPolicLI1');?></span><a target="_blank"
                                                                                                    href="https://support.google.com/analytics/answer/6004245?hl=en"
                                                                                                    class="floating-left"><?=$prosses->getlang('here');?></a>
                        </li>
                        <li>
                            <div class="cirlce floating-left"></div>
                            <span class="auto floating-left"><?=$prosses->getlang('privacyPolicLI2');?></span><a target="_blank"
                                                                                                    href="https://www.paypal.com/us/webapps/mpp/public-policy"
                                                                                                    class="floating-left"><?=$prosses->getlang('here');?></a>
                        </li>
                    </ul>
                    <h6><B><?=$prosses->getlang('Dataretentionpolicy');?></B></h6>
                    <p><?=$prosses->getlang('privacyPolicy9');?></p>
                    <h6><B><?=$prosses->getlang('DataSecurity');?></B></h6>
                    <p><?=$prosses->getlang('privacyPolicy10');?></p>
                    <p><?=$prosses->getlang('privacyPolicy11');?></p>
                    <h6><B><?=$prosses->getlang('Changestothisprivacypolicy');?></B></h6>
                    <p><?=$prosses->getlang('privacyPolicy12');?></p>
                    <h6><B><?=$prosses->getlang('ContectUs');?></B></h6>
                    <p><?=$prosses->getlang('privacyPolicy13');?></p>
                    <h3 class="text-left"><?=$prosses->getlang('DarAlManhalPublishers');?></h3>
                    <div><?=$prosses->getlang('TitleOne');?></div>
                    <div><?=$prosses->getlang('Titletwo');?></div>
                    <div><?=$prosses->getlang('Titlethree');?></div>
                    <div><?=$prosses->getlang('Titlefour');?></div>
                </div>
            </div>
        </div>
    </div>
    <?php
    include_once "includes/footer.php";

}
?>


