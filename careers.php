<?php
$currentTab="careers";
include "includes/function.php";
include("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/careers.css<?=$cash;?>">
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
                <p class="paragraph title"><?=$Lang->careersParagraph1;?></p>
                <p class="paragraph"><?=$Lang->careersParagraph2;?></p>
                <div class="items-main-container">
                    <div class="display-block-a" id="books">
                        <div class="item-container">
                            <div class="inner-item-container">
                                <p class="inner-paragraph"><?=$Lang->careersDesc?></p>
                                <div class="careers-container">


                                    <?php
                                    $sql = "SELECT * FROM `careers` WHERE `state`=0";
                                    $result = $con->query($sql);
                                    while ($careers = mysqli_fetch_assoc($result)) {
                                        if($careers['state']==0){
                                            $viewLink = SITE_URL . $lang_code . "/careers/" . $careers['id'] . "/" . str_replace(" ", "-", $careers['jobtitle_' .strtolower($_SESSION["lang"])]);
                                            echo '<div class="careers-item">
                                        <a href="'.$viewLink.'" class="title-career visted">'.$careers['jobtitle_'.strtolower($_SESSION["lang"])].'</a>
                                        <div class="line-row-career">
                                            <span class="career-location title floating-left">'.$Lang->location.':</span>
                                            <span class="career-location location floating-left">'.$careers['location_'.strtolower($_SESSION["lang"])].'</span>
                                            <span class="working-time floating-left">'.$careers['workhours_'.strtolower($_SESSION["lang"])].'</span>
                                        </div>
                                    </div>' ;
                                        }

                                    }
                                    ?>




                                </div>
                            </div>
                            <div class="note rounded" >
                                <label class="image floating-left"></label>
                                <h2 class="floating-left title"><?=$Lang->CurrentOpenings;?></h2>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>

