<?php

$real_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(session_status()==PHP_SESSION_NONE)
{
    session_start();
}

if(!isset($_SESSION["user"]) || $_SESSION["user"]['permession']<1)

{

    if(basename($_SERVER['PHP_SELF'])!="login.php" )

    {

        header('Location: login.php');

        exit();

    }

}

include_once "includes/language.php";

?>

<!DOCTYPE html>

<html>

<head  lang="ar">

    <title>Books</title>

    <meta content="utf-8" http-equiv="encoding">
    <meta http-equiv="Cache-Control" content="no-cache"/>

    <meta http-equiv="Pragma" content="no-cache"/>

    <meta http-equiv="Expires" content="0"/>

    <script type="text/javascript" src="<?=SITE_URL ?>js/jquery.js"></script>

    <script type="text/javascript" src="<?=SITE_URL ?>js/lang.js"></script>

    <link rel="stylesheet" type="text/css" href="<?=SITE_URL ?>platform/themes/Light-green-<?=$_SESSION["lang"];?>/css/style.css">

    <link rel="stylesheet" type="text/css" href="<?=SITE_URL ?>platform/themes/Light-green-<?=$_SESSION["lang"];?>/css/icons.css">

    <link rel="stylesheet" type="text/css" href="<?=SITE_URL ?>platform/themes/Light-green-<?=$_SESSION["lang"];?>/fonts/fonts.css">

    <link rel="stylesheet" type="text/css" href="<?=SITE_URL ?>platform/themes/Light-green-<?=$_SESSION["lang"];?>/css/animate.css">

    <link rel="stylesheet" type="text/css" href="<?=SITE_URL ?>platform/themes/Light-green-<?=$_SESSION["lang"];?>/css/matching.css">

    <script type="text/javascript" src="<?=SITE_URL ?>js/ajax.js"></script>

    <script type="text/javascript" src="<?=SITE_URL ?>js/jquery.nu-context-menu.js"></script>

    <script type="text/javascript" src="<?=SITE_URL ?>js/jquery-ui.min.js"></script>

    <script type="text/javascript" src="<?=SITE_URL ?>js/jquery.popline.min.js"></script>

    <script type="text/javascript" src="<?=SITE_URL ?>js/editor.js"></script>

    <script type="text/javascript" src="<?=SITE_URL ?>js/sweetalert-dev.js"></script>

    <script type="text/javascript" src="<?=SITE_URL ?>js/jquery.nestable.js"></script>

    <script type="text/javascript" src="<?=SITE_URL ?>js/admin.js"></script>

    <link rel="stylesheet" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/css/colorpicker.css" type="text/css" />

    <link rel="stylesheet" type="text/css" href="<?=SITE_URL ?>platform/themes/Light-green-<?=$_SESSION["lang"];?>/css/layout.css">



    <script type="text/javascript" src="<?=SITE_URL ?>js/colorpicker.js"></script>

    <link rel="stylesheet" type="text/css" href="<?=SITE_URL ?>platform/themes/Light-green-<?=$_SESSION["lang"];?>/css/sweetalert.css">

    <link rel="icon" href="<?=SITE_URL ?>img/favicon.png">

    <link rel="icon" sizes="16x16" href="<?=SITE_URL ?>platform/themes/Light-green-<?=$_SESSION["lang"];?>/images/favicon.ico" type="image/x-icon"/>

    <meta http-equiv="content-language" content="<?=strtolower($_SESSION["lang"]);?>"/>

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

</head>

<div class="loader-table" style="display:none;">

    <div class="loader-cell">

        <div id="loader">

            <div class="bar"></div>

            <div class="bar"></div>

            <div class="bar"></div>

            <div class="bar"></div>

            <div class="bar"></div>

            <div class="bar"></div>

            <div class="bar"></div>

            <div class="bar"></div>

        </div>

    </div>

</div>

<div class="center-peice">

    <header>

        <div class="hamburger hamburger--arrow js-hamburger floating-left">

            <div class="hamburger-box">

                <div class="hamburger-inner"></div>

            </div>

        </div>

        <a href="index.php">

            <img class="floating-left" src="themes/Light-green-<?=$_SESSION["lang"];?>/images/logo.svg">

        </a>

        <a href="logout.php" class="floating-right signout-button"><?=$Lang->SignOut;?></a>

        <?php

        if(basename($_SERVER['PHP_SELF'])!="login.php")

        {

            ?>

            <?php

            if(!isset($_SESSION["lang"]) || $_SESSION["lang"]=="")

            {

                $_SESSION["lang"]="En";

                $_SESSION["session_style"]="Light-green";

            }

            $_GET['lang']=$_SESSION["lang"];

            if($_SESSION["lang"]=="Ar")

            {

                if(strpos($real_link,"?")!==false && isset($_GET['lang']))

                {

                    $real_link=str_replace("lang=Ar","lang=En",$real_link);

                    echo "<a href='".$real_link."' class='floating-right' id='English'>En</a>";

                }

                elseif(strpos($real_link,"?")!=false)

                {

                    echo "<a href='".$real_link."&lang=En' class='floating-right' id='English'>En</a>";

                }

                else

                {

                    echo "<a href='".$real_link."?lang=En' class='floating-right' id='English'>En</a>";

                }

            }

            else

            {

                if(strpos($real_link,"?")!==false && isset($_GET['lang']))

                {

                    $real_link=str_replace("lang=En","lang=Ar",$real_link);

                    echo "<a href='".$real_link."' class='floating-right' id='Arabic'>Ar</a>";

                }

                elseif(strpos($real_link,"?")!=false)

                {

                    echo "<a href='".$real_link."&lang=".$_GET['lang']."' class='floating-right' id='Arabic'>Ar</a>";

                }

                else

                {



                    echo "<a href='".$real_link."?lang=".$_GET['lang']."' class='floating-right' id='Arabic'>Ar</a>";

                }

            }

            ?>

            <sapn class='floating-right user-name'><?=$_SESSION["user"]['uname'];?></sapn>



            <?php



        }

        ?>

        <div class="bottom-header clear-both"></div>

    </header>

    <div class="left-menu">

        <?php



        if(basename($_SERVER['PHP_SELF'])!="login.php")

        {

            ?>

            <nav class="floating-left">

                <?php

                if($_SESSION["user"]['permession']<3  || $_SESSION["user"]['permession']==6){

                    ?>

                    <li class="floating-left main">

                        <a href="index.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="index.php"){echo 'selected';}?>"><?=$Lang->Books;?></a>

                        <span class="flaticon-right-arrow26"></span>

                        <ul>

                            <li class="sub1 floating-left"><a href="category.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="category.php"){echo 'selected';}?>"><?=$Lang->Categories;?></a></li>

                        </ul>

                    </li>

                    <li class="floating-left main"><a href="quiz.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="quiz.php"){echo 'selected';}?>"><?=$Lang->Quiz;?></a></li>

                <?php }

                ?>

                <?php

                if($_SESSION["user"]['permession']=="1"){

                    ?>

                    <li class="floating-left main"><a href="user.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="user.php"){echo 'selected';}?>"><?=$Lang->Users;?></a></li>

                    <?php

                }

                ?>

                <?php

                if($_SESSION["user"]['permession']<3 || $_SESSION["user"]['permession']==6 ){

                    ?>

                    <li class="floating-left main">

                        <a href="stories.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="stories.php"){echo 'selected';}?>"><?=$Lang->Stories;?></a>

                        <span class="flaticon-right-arrow26"></span>

                        <ul>

                            <li class="sub1 floating-left"><a href="series.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="stories.php"){echo 'selected';}?>"><?=$Lang->Series;?></a></li>

                            <li class="sub2 floating-left"><a href="stories_cat.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="stories.php"){echo 'selected';}?>"><?=$Lang->Categories;?></a></li>

                        </ul>

                    </li>

                    <?php

                }

                ?>



                <?php

                if($_SESSION["user"]['permession']<3 || $_SESSION["user"]['permession']==6 ){

                    ?>

                    <li class="floating-left main">

                        <a href="media.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="media.php"){echo 'selected';}?>"><?=$Lang->media;?></a>



                    </li>

                    <li class="floating-left main">

                        <a href="games.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="games.php"){echo 'selected';}?>"><?=$Lang->Games;?></a>



                    </li>

                    <?php

                }

                ?>



                <?php

                if($_SESSION["user"]['permession']=="1" ||$_SESSION["user"]['permession']=="3"  ){

                    ?>

                    <li class="floating-left main">

                        <a href="warehouse.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="warehouse.php"){echo 'selected';}?>"><?=$Lang->Warehouse;?></a>



                    </li>

                    <?php

                }

                ?>

                <?php

                if($_SESSION["user"]['permession']=="1" ||$_SESSION["user"]['permession']=="4"  ){

                    ?>

                    <li class="floating-left main">

                        <a href="shippingwarehouse.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="shippingwarehouse.php"){echo 'selected';}?>"><?=$Lang->Shippingwarehouse;?></a>

                    </li>

                    <?php

                }

                ?>

                <li class="floating-left main"><a href="invoice.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="invoice.php"){echo 'selected';}?>" ><?=$Lang->Invoice;?></a></li>

                <li class="floating-left main"><a href="subscription.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="subscription.php"){echo 'selected';}?>" ><?=$Lang->subscription;?></a></li>

                <li class="floating-left main">


                    <a href="furniture.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="furniture.php"){echo 'selected';}?> " ><?=$Lang->Furniture;?></a>
                    <span class="flaticon-right-arrow26"></span>

                    <ul>

                        <li class="sub1 floating-left"><a href="store_dep.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="category.php"){echo 'selected';}?>">Departments</a></li>
                        <li class="sub1 floating-left"><a href="store_brands.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="category.php"){echo 'selected';}?>">Brands</a></li>
                    </ul>

                </li>

                <li class="floating-left main"><a href="educationaltools.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="educationaltools.php"){echo 'selected';}?> " ><?=$Lang->EducationalTools;?></a></li>

                <li class="floating-left main"><a href="educationallessons.php?lang=<?=$_GET['lang']?>" class="floating-left <?php if($cuerrentpage=="educationallessons.php"){echo 'selected';}?> " ><?=$Lang->EducationalLessons;?></a></li>
                <li class="floating-left main"><a href="publishers.php" class="floating-left <?php if($cuerrentpage=="publishers.php"){echo 'selected';}?> " ><?=$Lang->Publishers;?></a></li>
            </nav>
            <?php
        }
        ?>
    </div>

    <div class="site-container">
        <div class="content-container floating-left">
        </div>

        <ul class="bredcrump floating-left">
            <li class="floating-left"><a href="index.php"><?=$Lang->Home;?></a></li>
            <span class="floating-left">/</span>
            <?php echo $bredcrumb?>
        </ul>