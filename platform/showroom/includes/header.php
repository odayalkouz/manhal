<?php
include_once "functions.php";
$prosses->AreYouAllowedIn();
$cash=1;
?>
<!doctype html>
<html lang="en">
<head>
    <script> var SiteURL='<?=$prosses->URL?>';</script>
    <title>Dar Al-Manhal</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="description" content="Contracts">
    <meta name="msapplication-tap-highlight" content="no">
    <link data-type="favicon" href="<?=$prosses->URL;?>/themes/all/images/favicon.ico" type="image/x-icon" rel="icon">
    <link rel="stylesheet" href="<?=$prosses->URL;?>/themes/<?=$_SESSION["lang"];?>/css/main.css?<?=$cash;?>"/>
    <link rel="stylesheet" href="<?=$prosses->URL;?>/themes/all/css/jquery-ui.css" />
    <link rel="stylesheet" href="<?=$prosses->URL;?>/themes/all/css/lobibox.min.css"/>
    <link rel="stylesheet" href="<?=$prosses->URL;?>/themes/all/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?=$prosses->URL;?>/themes/all/css/jquery.fancybox.min.css"/>
    <link rel="stylesheet" href="<?=$prosses->URL;?>/themes/all/css/dataTables.bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="<?=$prosses->URL;?>/themes/all/css/bootstrap-multiselect.css" type="text/css"/>
    <link rel="stylesheet" href="<?=$prosses->URL;?>/themes/all/css/daterangepicker.css" type="text/css"/>
    <script type="text/javascript" src="<?=$prosses->URL;?>/js/jquery.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.2.4/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.2.4/firebase-messaging.js"></script>
    <script type="text/javascript" src="<?=$prosses->URL;?>/js/init-firebase.js"></script>
    <script type="text/javascript" src="<?=$prosses->URL;?>/js/library.js"></script>
    <script type="text/javascript" src="<?=$prosses->URL;?>/js/jquery-ui.js"></script>
    <script type="text/javascript" src="<?=$prosses->URL;?>/js/lobibox.min.js"></script>
    <script type="text/javascript" src="<?=$prosses->URL;?>/js/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="<?=$prosses->URL;?>/js/bootstrap-multiselect.js"></script>
    <script type="text/javascript" src="<?=$prosses->URL;?>/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="<?=$prosses->URL;?>/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="<?=$prosses->URL;?>/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="<?=$prosses->URL;?>/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="<?=$prosses->URL;?>/js/manhal-ui.js?<?=$cash;?>"></script>
    <script type="text/javascript" src="<?=$prosses->URL;?>/js/store.js?<?=$cash;?>"></script>
    <script type="text/javascript" src="<?=$prosses->URL;?>/js/moment.min.js"></script>
    <script type="text/javascript" src="<?=$prosses->URL;?>/js/daterangepicker.min.js"></script>

    <script language="JavaScript"> var lang_getmassage=<?=$prosses->getlang('msgjavascript');?>;
        var $url='<?=$prosses->URL?>';
    </script>
</head>
<body>
<div class="container" id="viewinfo_container" style="display: none;overflow: auto;min-height:300px;border: 1px solid #00AB67;padding: 20px;background: #fff"></div>
<form  class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <input type="hidden" name="lang" value="<?php if(isset($_GET['lang']) && $_GET['lang']!=''){echo $_GET['lang'];$_SESSION["lang"]=$_GET['lang'];}else{echo $_SESSION["lang"]; $_GET['lang']=$_SESSION["lang"];} ?>">
    <input type="hidden" name="page" value="<?php if(isset($_GET['page']) && $_GET['page']!=''){echo $_GET['page'];}?>" >
    <input type="hidden" id="date" name="date" value="<?php if(isset($_GET['date']) && $_GET['date']!=''){echo $_GET['date'];}else{echo date('Y-m-d').' - '.date('Y-m-d') ;}?>" >
    <input type="hidden" id="shipping" name="shipping" value="<?php if(isset($_GET['shipping']) && $_GET['shipping']!=''){echo $_GET['shipping'];}else{echo -1;$_GET['shipping']=-1;}?>" >
    <input type="hidden" id="search" name="search" value="<?php if(isset($_GET['search']) && $_GET['search']!=''){echo $_GET['search'];}?>" >
    <input type="hidden" id="groub" name="groub" value="<?php if(isset($_GET['groub']) && $_GET['groub']!=''){echo $_GET['groub'];}else{echo '';$_GET['groub']='';}?>" >
    <input type="hidden" id="web_token" name="token" value="<?php if(isset($_SESSION['user']['token']) && $_SESSION['user']['token']!=''){echo $_SESSION['user']['token'];}?>">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?=$prosses->getlang('MoreDetails');?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body ">

            </div>
<!--            <div class="modal-footer">-->
<!--                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
<!--                <button type="button" class="btn btn-primary">Save changes</button>-->
<!--            </div>-->
        </div>
    </div>
</form>

<div class="loader-main-container">
    <svg class="loader" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 340 340">
        <circle cx="170" cy="170" r="160" stroke="#00ad68"/>
        <circle cx="170" cy="170" r="135" stroke="#ffffff"/>
        <circle cx="170" cy="170" r="110" stroke="#00ad68"/>
        <circle cx="170" cy="170" r="85" stroke="#ffffff"/>
    </svg>
</div>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <div class="app-header header-shadow">
        <div class="app-header__logo">
            <a href="index.php" class="logo-src"></a>
            <div class="header__pane ml-auto">
                <div>
                    <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                            <span class="hamburger-box">
                                <span class="hamburger-inner"></span>
                            </span>
                    </button>
                </div>
            </div>
        </div>
        <div class="app-header__mobile-menu">
            <div>
                <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                        <span class="hamburger-box">
                            <span class="hamburger-inner"></span>
                        </span>
                </button>
            </div>
        </div>
        <div class="app-header__menu">
                <span>
                    <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                        <span class="btn-icon-wrapper">
                            <i class="fa fa-ellipsis-v fa-w-6"></i>
                        </span>
                    </button>
                </span>
        </div>
        <div class="app-header__content">
            <div class="app-header-left">
                <div class="search-wrapper">
                    <div class="input-holder">
                        <input type="text" class="search-input" id="header_keyword" placeholder="search" value="<?php if(isset($_GET["search"]) && $_GET["search"]!=""){echo $_GET["search"];}?>">
                        <button onclick="Funsearch()" class="search-icon" id="header_search"><span></span></button>
                    </div>
                    <button class="close"></button>
                </div>
                <ul class="header-menu nav" style="display: none">

                </ul>
            </div>
            <div class="app-header-right">
                <div class="header-btn-lg pr-0">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="btn-group pr-2 pl-2">
                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                        <img width="25" class="rounded-circle" src="<?=$prosses->URL;?>/themes/en/images/login.svg" alt="">
                                        Manhal
                                        <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                    </a>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
<!--                                        <div tabindex="-1" class="dropdown-divider"></div>-->
<!--                                        <a type="button" tabindex="0" class="dropdown-item" href="privacypolicy.php">Privacy Policy</a>-->
<!--                                        <div tabindex="-1" class="dropdown-divider"></div>-->
<!--                                        <a type="button" tabindex="0" class="dropdown-item" href="termsconditions.php">Terms &amp; Conditions</a>-->
<!--                                        <div tabindex="-1" class="dropdown-divider"></div>-->
                                        <div>
                                            <input class="dropdown-item" onclick="logout();" type="button" value="Sign Out">
                                        </div>
                                    </div>
                                </div>
                                <div class="btn-group">
                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="p-0 btn">
                                        <img width="25" class="rounded-circle" src="<?=$prosses->URL;?>/themes/all/images/language.svg" alt="">
                                        <?=$_GET['lang'];?>
                                        <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                    </a>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                        <diva type="button" onclick="changelanguage(this);" att="<?php if($_SESSION["lang"]=='En'){echo 'Ar';$title='Ar';}else{echo 'En';$title='En';};?>" tabindex="0" class="dropdown-item" href=""><?=$title;?></diva>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left  ml-3 header-user-info">
                                <div class="widget-heading"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="app-main">
        <div class="app-sidebar sidebar-shadow">
            <div class="app-header__logo">
                <div class="logo-src"></div>
                <div class="header__pane ml-auto">
                    <div>
                        <button type="button" class="hamburger close-sidebar-btn hamburger--elastic"
                                data-class="closed-sidebar">
                                    <span class="hamburger-box">
                                        <span class="hamburger-inner"></span>
                                    </span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="app-header__mobile-menu">
                <div>
                    <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                                <span class="hamburger-box">
                                    <span class="hamburger-inner"></span>
                                </span>
                    </button>
                </div>
            </div>
            <div class="app-header__menu">
                        <span>
                            <button type="button"
                                    class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                                <span class="btn-icon-wrapper">
                                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                                </span>
                            </button>
                        </span>
            </div>
            <div class="scrollbar-sidebar">
                <div class="app-sidebar__inner">
                    <ul class="vertical-nav-menu">
                        <li class="app-sidebar__heading"><?=$prosses->getlang('Store');?></li>
                        <li>
                            <a class="<?php if ($currentTab == "Dashboard") {
                                echo 'mm-active';
                            } ?>" href="<?=$prosses->URL;?>/index.php">
                                <i class="metismenu-icon pe-7s-server"></i>
                                <?=$prosses->getlang('Dashboard');?>
                            </a>
                        </li>
                        <li>
                            <a href="#" aria-expanded="false">
                                <i class="metismenu-icon pe-7s-cash"></i>
                                <?=$prosses->getlang('totalsales');?>
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul class="mm-collapse">
                                <li>
                                    <a class="<?php if ($currentTab == "TotalCustomers") {
                                        echo 'mm-active';
                                    } ?>" href="<?=$prosses->URL;?>/totalcustumers/index.php">
                                        <i class="metismenu-icon pe-7s-users"></i><?=$prosses->getlang('TotalCustomers');?></a>
                                </li>
                                <li>
                                    <a class="<?php if ($currentTab == "CompletedOrders") {
                                        echo 'mm-active';
                                    } ?>" href="<?=$prosses->URL;?>/completed/index.php">
                                        <i class="metismenu-icon pe-7s-check"></i><?=$prosses->getlang('CompletedOrders');?>
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if ($currentTab == "CancelledOrders") {
                                        echo 'mm-active';
                                    } ?>" href="<?=$prosses->URL;?>/cancelled/index.php">
                                        <i class="metismenu-icon pe-7s-close-circle"></i>
                                        <?=$prosses->getlang('CancelledOrders');?>
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if ($currentTab == "inprogressorders") {
                                        echo 'mm-active';
                                    } ?>" href="<?=$prosses->URL;?>/inprogress/index.php">
                                        <i class="metismenu-icon pe-7s-hourglass"></i>
                                        <?=$prosses->getlang('inprogressorders');?>
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if ($currentTab == "inshipping") {
                                        echo 'mm-active';
                                    } ?>" href="<?=$prosses->URL;?>/inshipping/index.php">
                                        <i class="metismenu-icon pe-7s-cart"></i>
                                        <?=$prosses->getlang('Inshippingorders');?>
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if ($currentTab == "totalsales") {
                                        echo 'mm-active';
                                    } ?>" href="<?=$prosses->URL;?>/totalsales/index.php">
                                        <i class="metismenu-icon pe-7s-cash"></i>
                                        <?=$prosses->getlang('salesbyShippingCo');?>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#" aria-expanded="false">
                                <i class="metismenu-icon pe-7s-shopbag"></i>
                                <?=$prosses->getlang('subscriptions');?>
                                <i class="metismenu-state-icon pe-7s-angle-down caret-left"></i>
                            </a>
                            <ul class="mm-collapse">
                                <li>
                                    <a class="<?php if ($currentTab == "totalsubscriptions") {
                                        echo 'mm-active';
                                    } ?>" href="<?=$prosses->URL;?>/totalsubscriptions/index.php">
                                        <i class="metismenu-icon pe-7s-shopbag"></i>
                                        <?=$prosses->getlang('totalsubscriptions');?>
                                    </a>
                                </li>
                                <li>
                                    <a class="<?php if ($currentTab == "subscriptions") {
                                        echo 'mm-active';
                                    } ?>" href="<?=$prosses->URL;?>/subscriptions/index.php">
                                        <i class="metismenu-icon pe-7s-shopbag"></i>
                                        <?=$prosses->getlang('subscriptions1');?>
                                    </a>
                                </li>
                            </ul>
                        </li>





                        <li>
                            <a class="<?php if ($currentTab == "booksstack") {echo 'mm-active';} ?>" href="<?=$prosses->URL;?>/booksstack/index.php?groub=1">
                                <i class="metismenu-icon pe-7s-albums"></i>
                                <?=$prosses->getlang('Stack');?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if ($currentTab == "booksstackout") {echo 'mm-active';} ?>" href="<?=$prosses->URL;?>/booksstackout/index.php?groub=1">
                                <i class="metismenu-icon pe-7s-attention"></i>
                                <?=$prosses->getlang('OutOfStack');?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if ($currentTab == "groups") {
                                echo 'mm-active';
                            } ?>" href="<?=$prosses->URL;?>/groups/index.php">
                                <i class="metismenu-icon pe-7s-network"></i>
                                <?=$prosses->getlang('groups');?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if ($currentTab == "publishers") {
                                echo 'mm-active';
                            } ?>" href="<?=$prosses->URL;?>/publishers/index.php">
                                <i class="metismenu-icon pe-7s-news-paper"></i>
                                <?=$prosses->getlang('publishers');?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if ($currentTab == "settings") {
                                echo 'mm-active';
                            } ?>" href="<?=$prosses->URL;?>/settings/index.php">
                                <i class="metismenu-icon pe-7s-settings"></i>
                                <?=$prosses->getlang('settings');?>
                            </a>
                        </li>
                        <li class="bs-example" style="display: none">
                            <button id="basicInfoAnimation" class="btn btn-info">Info message</button>
                            <button id="basicWarningAnimation" class="btn btn-warning">Warning message</button>
                            <button id="basicErrorAnimation" class="btn btn-danger">Error message</button>
                            <button id="basicSuccessAnimation" class="btn btn-success">Success message</button>
                            <button id="confirmAnimation" class="btn btn-circle">Confirm message</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="app-main__outer">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb"><?php echo $bredcrumb?></ol>
            </nav>