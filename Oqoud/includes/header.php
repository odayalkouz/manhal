<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["username"])) {
    header('Location: login.php');
    exit();
}
include_once "function.php";







?>
<!doctype html>
<html lang="en">
<head>
    <title>Dar Al-Manhal Oqoud</title>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="description" content="Contracts">
    <meta name="msapplication-tap-highlight" content="no">
    <link data-type="favicon" href="<?=$prosses->URL?>Oqoud/themes/all/images/favicon.ico" type="image/x-icon" rel="icon">
    <link rel="stylesheet" href="<?=$prosses->URL?>Oqoud/themes/<?= $prosses->Sessionlang(); ?>/css/main.css">
    <link rel="stylesheet" href="<?=$prosses->URL?>Oqoud/themes/all/css/jquery-ui.css">
    <link rel="stylesheet" href="<?=$prosses->URL?>Oqoud/themes/all/css/lobibox.min.css"/>
    <link rel="stylesheet" href="<?=$prosses->URL?>Oqoud/themes/all/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?=$prosses->URL?>Oqoud/themes/all/css/jquery.fancybox.min.css" />
    <script type="text/javascript" src="js/library.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery-ui.js"></script>
    <script type="text/javascript" src="js/lobibox.min.js"></script>
    <script type="text/javascript" src="js/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="js/manhal-ui.js"></script>
    <script type="text/javascript" src="js/backend.js"></script>





    <script>var lan="<?=$prosses->Sessionlang();?>";
    var Page='<?=$prosses->GetPage()?>';
    var Cat='<?=$prosses->GetIdCategory()?>';
    var Keyword='<?=$prosses->GetSearch()?>';
    var msgjavascript=<?=$prosses->lang("msgjavascript")?>;
    var URL__='<?=$prosses->URL?>';

    </script>
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
    <div class="app-header header-shadow">
        <div class="app-header__logo">
            <a href="index.php" class="logo-src"></a>
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
        <div class="app-header__content">
            <div class="app-header-left">
                <div class="search-wrapper">
                    <div class="input-holder">
                        <input type="text" class="search-input" placeholder="search" value="<?=$prosses->GetSearch()?>">
                        <button  class="search-icon"><span></span></button>
                    </div>
                    <button class="close"></button>
                </div>
                <ul class="header-menu nav" style="display: none">
                    <li class="nav-item">
                        <a href="javascript:void(0);" class="nav-link"><i class="nav-link-icon fa fa-database"> </i>page1</a>
                    </li>
                    <li class="btn-group nav-item">
                        <a href="javascript:void(0);" class="nav-link"><i class="nav-link-icon fa fa-edit"></i>page2</a>
                    </li>
                    <li class="dropdown nav-item">
                        <a href="javascript:void(0);" class="nav-link"><i class="nav-link-icon fa fa-cog"></i>page3</a>
                    </li>
                </ul>
            </div>
            <div class="app-header-right">
                <div class="header-btn-lg pr-0">
                    <div class="widget-content p-0">
                        <div class="widget-content-wrapper">
                            <div class="widget-content-left">
                                <div class="btn-group">
                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                       class="p-0 btn">
                                        <img width="35" class="rounded-circle" src="themes/en/images/login.svg" alt="">

                                        <i class="fa fa-angle-down ml-2 opacity-8"></i>
                                    </a>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                        <a type="button" tabindex="0" class="dropdown-item" href="profile.php"><?=$prosses->lang('profile');?></a>
                                        <div tabindex="-1" class="dropdown-divider"></div>
                                        <a type="button" tabindex="0" class="dropdown-item" href="privacypolicy.php"><?=$prosses->lang('privacy_policy');?></a>
                                        <div tabindex="-1" class="dropdown-divider"></div>
                                        <a type="button" tabindex="0" class="dropdown-item" href="termsconditions.php"><?=$prosses->lang('terms_conditions');?></a>
                                        <div tabindex="-1" class="dropdown-divider"></div>
                                        <form method="get" action="api.php" target="_self">
                                            <input type="hidden" name="process" value="logout">
                                            <input class="dropdown-item" type="submit" value="<?=$prosses->lang('sign_out');?>"/>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="widget-content-left ml-3 header-user-info" style="cursor: pointer">

                                <div class="widget-heading" id="change_lang"><?=$prosses->lang('lang');?></div>

                            </div>
                            <div class="widget-content-left  ml-3 header-user-info">
                                <div class="widget-heading"><?php echo($prosses->informationUser()['data'][0]['fullname'])?></div>

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
                        <div style="display: none" class="app-sidebar__heading">pages / <?php echo $currentTab ?></div>
                        <li>
                            <a class="<?php if ($currentTab == "Home") {
                                echo 'mm-active';
                            } ?>" href="index.php">
                                <i class="metismenu-icon pe-7s-home"></i><?=$prosses->lang('home');?>
                            </a>
                        </li>
                        <li>
                            <a class="<?php if ($currentTab == "Categories") {
                                echo 'mm-active';
                            } ?>" href="category.php"><i class="metismenu-icon pe-7s-plugin"></i><?=$prosses->lang('categories');?></a>
                        </li>

                        <li class="bs-example" style="display: none;">
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
