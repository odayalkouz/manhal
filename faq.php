<?php
$currentTab = "faq";
include_once "platform/config.php";
include_once "includes/function.php";
include_once "platform/includes/function.php";
include_once "includes/header.php";
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/faq.css<?=$cash;?>">
<section class="inner-pages-main-container-faq">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="image-header-container">
                        <h1><?=$Lang->Frequentlyaskedquestions;?></h1>
                    </div>
                    <form class="faq-search" method="GET" id="faq_search">
                        <div class="right-col-3 floating-left">
                            <div class="faq-main-container-page clear-both">
                                <div class="top-black-col">
                                    <div class="floating-left">
                                        <label class="lbl-data-a floating-left"><?=$Lang->Bysubject;?></label>
                                        <div class="wrapper-demo">
                                            <div id="subject" class="jq_bookdropdown wrapper-dropdown-3" tabindex="2">
                                                <span style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-En/images/cat/books/all.svg);" class="floating-left"><?=$Lang->All;?></span>
                                                <ul class="dropdown submit scrollable">
                                                    <input class="hidden_input" type="hidden" name="faq_categories" value="<?php if(isset($_GET['faq_categories'])){ echo $_GET['faq_categories'];} ?>" id="hidden_faq_categories">
                                                    <li class="catli sub-0 no-image" catid="0">
                                                        <a href="#"><i class="icon-truck icon-large"><?=$Lang->All;?></i> </a>
                                                    </li>

                                                    <?php

                                                    $cat_sql = "Select * From  faq_categories WHERE `parent`=0";

                                                    $cat_result = $con->query($cat_sql);

                                                    if (mysqli_num_rows($cat_result) > 0) {

                                                        while ($cat_row = mysqli_fetch_assoc($cat_result)) {

                                                            echo getCategoriesDropDown($cat_row['catid'], "faq_categories");

                                                        }

                                                    }

                                                    ?>


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-search-container floating-right">
                                        <input type="text" class="txt-a floating-left" name="keywords" placeholder="Search" value="

<?php if (isset($_GET['keywords'])) {

                                            echo $_GET['keywords'];

                                        } ?>

">
                                        <input type="submit" class="btn btn-search floating-left" value="" title="Search">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="accordion">


                <?php

                $keyword_filter = "";

                $cat_filter = "";

                if (isset($_GET['keywords']) && $_GET['keywords'] != "") {

                    $keyword_filter = " AND ( `title_ar` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `title_en` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `Q_ar` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `Q_en` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%'  )";

                }

                if (isset($_GET['faq_categories']) && $_GET['faq_categories'] != 0) {

                    $cat_filter = " AND `catid` = " . $_GET['faq_categories'];

                }




                $sql = "SELECT * FROM `faq` WHERE  id>0 ". $keyword_filter . $cat_filter;
                $result = $con->query($sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)){
                        echo'<div class="accordion-item">';
                        echo'<a>'.$row['Q_'.strtolower($session_lang)].'</a>';
                        echo'<div class="content"><p>'.$row['A_'.strtolower($session_lang)].'</p></div></div>';

                    }
                }
                ?>






            </div>
            <div class="email-us-container">
                <label><?=$Lang->Stillhavequestions;?></label>
                <a><?=$Lang->EmailUs;?></a>
            </div>
        </div>
    </div>
</section>
<?php
include_once "includes/footer.php";
?>

