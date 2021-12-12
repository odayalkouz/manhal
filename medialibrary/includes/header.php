<?php
$URL = $_SERVER['DOCUMENT_ROOT'].'/manhal/medialibrary';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["username"])) {
    header('Location:'.$URL.'/login.php');
    exit();
}
include_once $URL."/function.php";
?>
<!doctype html>
<html lang="en">
<head>
    <title><?= $prosses->lang('title_heder'); ?></title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="icon" type="image/png" sizes="96x96" href="themes/<?= $prosses->Sessionlang(); ?>/img/favicon.png">
    <link rel="apple-touch-icon" sizes="76x76" href="themes/<?= $prosses->Sessionlang(); ?>/img/favicon.png">
    <link rel="stylesheet" href="themes/all/vendor/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="themes/all/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="themes/all/vendor/linearicons/style.css">
    <link rel="stylesheet" href="themes/all/vendor/jquery.fancybox.min.css">
    <link rel="stylesheet" href="themes/all/vendor/bootstrap-multiselect.css" type="text/css"/>
    <link rel="stylesheet" href="themes/<?= $prosses->Sessionlang(); ?>/css/main.css">

    <link rel="stylesheet" href="themes/all/vendor/colorpicker.css" type="text/css"/>
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <script type="text/javascript" src="js/jquery.js"></script>

    <script>
        var lan = "<?=$prosses->Sessionlang();?>";
        var msgjavascript =<?=$prosses->lang("msgjavascript")?>;
        var URL__ = '<?=$prosses->URL?>';

    </script>

    <script type="text/javascript" src="js/jscolor.js"></script>
    <script type="text/javascript" src="js/backend.js"></script>

</head>
<body  <?php if($prosses->GetOpenFilter()=='non'){echo 'class="layout-fullwidth"';}?>>
<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid navbar-back-with-menu" style="display: none;">
            <ul class="nav navbar-nav">
                <?php echo $prosses->Data_Type(); ?>
            </ul>
            <ul class="nav navbar-nav pull-right">
                <li><a href="privacypolicy.php"><span><?=$prosses->lang('privacy_policy');?></span></a></li>
                <li><a href="termsconditions.php"><span><?=$prosses->lang('terms_conditions');?></span></a></li>
            </ul>
        </div>
        <div class="container-fluid">
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pull-left">
                <div class="brand">
                    <a href="index.php"><img src="themes/en/img/logo.svg" alt="dar almanhal logo"
                                             class="img-responsive logo"></a>
                </div>
                <?php
                if ((isset($show_filters_option) && $show_filters_option == true)) {
                ?>
                    <div class="navbar-btn">
                            <button type="button"  class="btn-toggle-fullwidth" title="More Filters"><i id="More_Filters" class="lnr lnr-funnel"></i></button>
                          </div>


                <form class="navbar-form navbar-left ddl-multiselect">
                    <div class="input-group">
                        <?php
                        if($prosses->CanEdit()==='true') {
                            ?>
                            <a href="type.php" class="btn shadow-none btn-primary pull-right" title="Edit & Add Type"><i class="lnr lnr-cog"></i><span style="margin: 0 0 0 9px">Type</span></a>
                            <?php
                        }
                        ?>

                        <div class="input-group-btn search-panel">
                            <select onchange="selectedtype()" class="multiselect-container dropdown-menu" id="multiple_select_menu">
                                  <?php echo $prosses->DataSearch_Type(); ?>
                            </select>
                        </div>

                        <input type="hidden" name="filter_color" value="<?=$prosses->GetColor()?>" id="filter_color">
                        <input type="hidden" name="page" value="<?=$prosses->GetPages()?>" id="page">
                        <input type="hidden" name="pages" value="<?=$prosses->GetPage()?>" id="pages">
                        <input type="hidden" name="filter_type" value="<?=$prosses->GetIdType()?>" id="filter_type">
                        <input type="hidden" name="filter_lan" value="<?=$prosses->Sessionlang();?>" id="filter_lan">
                        <input type="hidden" name="filter_keyword" value="<?=$prosses->GetKeywords()?>" id="filter_keyword">
                        <input type="hidden" name="filter_cat" value="<?=$prosses->GetIdCategory()?>" id="filter_cat">
                        <input type="hidden" name="filter_open" value="<?=$prosses->GetOpenFilter()?>" id="filter_open">

                        <input type="text" class="form-control search-container" value="<?=$prosses->GetKeywords()?>" name="filter_keyword" placeholder="Media Search">
                        <span class="input-group-btn"><button type="button" class="btn-sm btn-primary btn-search"><span
                                        class="lnr lnr-magnifier"></span></button></span>
                    </div>
                </form>
                    <?php
                }
                ?>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 pull-left">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="themes/en/img/language.svg" class="img-circle" alt="language">
                            <span>Ar</span><i class="icon-submenu lnr lnr-chevron-down"></i></a>
                        <ul class="dropdown-menu"><li><a id="change_lang" href="#"><span>En</span></a></li></ul>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right" style="display: ">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="themes/en/img/login.svg" class="img-circle" alt="Avatar"><span><?php echo $prosses->UserName() ?></span><i class="icon-submenu lnr lnr-chevron-down"></i></a>
                        <ul class="dropdown-menu">
                            <li><a href="profile.php"><i class="lnr lnr-user"></i> <span><?=$prosses->lang('profile');?></span></a></li>
                            <li><a href="privacypolicy.php"><i class="lnr lnr-lock"></i><span><?=$prosses->lang('privacy_policy');?></span></a></li>
                            <li><a href="termsconditions.php"><i class="lnr lnr-exit"></i><span><?=$prosses->lang('terms_conditions');?></span></a></li>
                            <li><a href="api.php?process=logout"><i class="lnr lnr-exit"></i> <span><?=$prosses->lang('sign_out');?></span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
<div id="wrapper">
    <?php
    if ((isset($show_filters_option) && $show_filters_option == true))
    {
        ?>
        <div id="sidebar-nav" class="sidebar">
                        <div class="sidebar-scroll filters-main-container">
                            <div class="panel">
                                <div class="panel-heading btn-toggle-collapse">
                                    <h3 class="panel-title">
                                        <i class="lnr lnr-funnel floating-left" style="font-weight: bold"></i>
                                        <span class="floating-left"
                                              style="font-weight: bold"><?= $prosses->lang('Filters'); ?>

                                            <?php
                                            if($prosses->CanEdit()==='true') {
                                                ?>
                                                <a style="margin: -7px -15px 0 0px;font-weight: normal" href="category.php" class="btn-sm shadow-none btn-primary pull-right" title="Edit & Add Category"><i class="lnr lnr-cog"></i><span style="margin: 0 0 0 9px">Category</span></a>
                                                <?php
                                            }
                                            ?>
                                        </span>
                                    </h3>
                                </div>
                            </div>
                            <?php if ($prosses->GetOpenFilter() == 'active') { ?>

                                <div class="panel">
                                    <div class="panel-heading btn-toggle-collapse">
                                        <h3 class="panel-title"><i class="lnr lnr-list floating-left"></i><span
                                                    class="floating-left"><?= $prosses->lang('Category'); ?></span>
                                        </h3>
                                        <div class="right">
                                            <button type="button"><i class="lnr lnr-chevron-up"></i></button>
                                        </div>
                                    </div>
                                    <div class="panel-body caregoies-checkboxes">
                                        <ul class="nav">
                                            <li>
                                                <label class="fancy-checkbox" for="LevelAll">

                                                    <?php
                                                    $selected = '';
                                                    if ($prosses->GetIdCategory() == 'all') {
                                                        $selected = 'checked';
                                                    };
                                                    ?>

                                                    <input <?php echo $selected ?> type="checkbox" id="LevelAll">
                                                    <span>All </span>
                                                </label>
                                                <ul>

                                                    <?php echo $prosses->DataCategories(); ?>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel">
                                    <div class="panel-heading btn-toggle-collapse">
                                        <h3 class="panel-title"><i class="lnr lnr-tag floating-left"></i><span
                                                    class="floating-left"> Tags</span></h3>
                                        <div class="right">
                                            <button type="button"><i class="lnr lnr-chevron-up"></i></button>
                                        </div>
                                    </div>
                                    <div class="panel-body tags-container">

                                    </div>
                                </div>
                            <?php }
                            if ($prosses->GetIdType() == 2) {

                                ?>
                                <div class="panel">
                                    <div class="panel-heading btn-toggle-collapse">
                                        <h3 class="panel-title"><i class="lnr lnr-eye floating-left"></i><span
                                                    class="floating-left"><?= $prosses->lang('Colors'); ?></span></h3>
                                        <div class="right">
                                            <button type="button" class=""><i class="lnr lnr-chevron-up"></i></button>
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <input class="jscolor form-control" id="jscolor"
                                               att="#<?php echo $prosses->GetColor() ?>"
                                               style="background-color:#<?php echo $prosses->GetColor() ?>;width: 50%"/>

                                        <a class="pull-right clear-colors"><?= $prosses->lang('Clear'); ?></a>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
        <?php
    }
    ?>
    <aside id="sidebar-nav-right" class="sidebar-right">
        <div class="sidebar-scroll filters-main-container">
            <div class="panel">
                <div class="panel-heading btn-toggle-collapse">
                    <h3 class="panel-title">
                        <i class="lnr lnr-question-circle floating-left" style="font-weight: bold"></i>
                        <span class="floating-left" style="font-weight: bold"><?=$prosses->lang('Informations');?></span>
                    </h3>
                </div>
            </div>
            <div class="display-block appendimage" style="padding: 5px">


                <ul class="list-group">
                    <li class="list-group-item"><div class="row"><div class="col-lg-5"><?=$prosses->lang('Title');?></div><div class="col-lg-7"><span class="badge" id="jq_title_ar">Videos</span></div></div></li>
                    <li class="list-group-item"><div class="row"><div class="col-lg-5"><?=$prosses->lang('Type');?></div><div class="col-lg-7"><span class="badge" id="jq_types">url</span></div></div></li>
                    <li class="list-group-item"><div class="row"><div class="col-lg-5"><?=$prosses->lang('Category');?></div><div class="col-lg-7"><span class="badge" id="jq_category"></span></div></div></li>
                    <li class="list-group-item"><div class="row"><div class="col-lg-5"><?=$prosses->lang('Extension');?></div><div class="col-lg-7"><span class="badge" id="jq_extension"></span></div></div></li>
                </ul>
                <ul class="list-group">
                    <li class="list-group-item">
                        <div class="row">
                            <div class="col-lg-12"><b><?=$prosses->lang('Description');?></b></div>
                            <div class="col-lg-12" id="jq_descraption"></div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </aside>







    <div class="main">
        <div class="main-content">
            <div class="container-fluid">