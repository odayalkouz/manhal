<?php
$currentTab="products";
include "includes/function.php";
include("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/products.css<?=$cash;?>">
<div class="inner-pages-main-container-products">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="image-header-container">
                        <h1><?= $Lang->Products;?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="products-content">
        <div class="center-piece" style="overflow: visible">
            <div class="inner-container">
                <p class="paragraph"><?=$Lang->ProductsParagraph1;?></p>
                <p class="paragraph"><?=$Lang->ProductsParagraph2;?></p>
                <div class="items-main-container">
                    <div class="display-block-a floating-left" id="books">
                        <div class="item-container">
                            <div class="inner-item-container">
                                <p class="inner-paragraph"><?=$Lang->ProductsBookDesc?></p>
                            </div>
                            <div class="note rounded" >
                                <label class="image"></label>
                                <h2 class="title"><?=$Lang->Book?></h2>
                            </div>
                            <div class="products-link">
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/books-info"><?=$Lang->ReadMore?></a>
                                <div class="sproter floating-right"></div>
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/books"><?=$Lang->EXPLORE?></a>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a floating-left" id="ebooks">
                        <div class="item-container">
                            <div class="inner-item-container" >
                                <p class="inner-paragraph"><?=$Lang->ProductsEbookDesc?></p>
                            </div>
                            <div class="note rounded">
                                <label class="image"></label>
                                <h2 class="title"><?=$Lang->ebook?></h2>
                            </div>
                            <div class="products-link">
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/electronic-books-info"><?=$Lang->ReadMore?></a>
                                <div class="sproter floating-right"></div>
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/books"><?=$Lang->EXPLORE?></a>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a floating-left" id="interactive_books">
                        <div class="item-container">
                            <div class="inner-item-container" >
                                <p class="inner-paragraph"><?=$Lang->ProductsInteractiveBooksDesc?></p>
                            </div>
                            <div class="note rounded">
                                <label class="image"></label>
                                <h2 class="title"><?=$Lang->InteractiveBooks?></h2>
                            </div>
                            <div class="products-link">
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/interactive-books-info"><?=$Lang->ReadMore?></a>
                                <div class="sproter floating-right"></div>
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/books"><?=$Lang->EXPLORE?></a>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a floating-left" id="stories">
                        <div class="item-container" >
                            <div class="inner-item-container" >
                                <p class="inner-paragraph"><?=$Lang->ProductsStoriesDesc?></p>
                            </div>
                            <div class="note rounded">
                                <label class="image"></label>
                                <h2 class="title"><?=$Lang->Stories?></h2>
                            </div>
                            <div class="products-link">
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/stories-info"><?=$Lang->ReadMore?></a>
                                <div class="sproter floating-right"></div>
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/stories"><?=$Lang->EXPLORE?></a>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a floating-left" id="estories">
                        <div class="item-container">
                            <div class="inner-item-container">
                                <p class="inner-paragraph"><?=$Lang->ProductsEstoriesDesc?></p>
                            </div>
                            <div class="note rounded">
                                <label class="image"></label>
                                <h2 class="title"><?=$Lang->estories?></h2>
                            </div>
                            <div class="products-link">
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/electronic-stories-info"><?=$Lang->ReadMore?></a>
                                <div class="sproter floating-right"></div>
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/stories"><?=$Lang->EXPLORE?></a>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a floating-left" id="interactive_stories">
                        <div class="item-container" >
                            <div class="inner-item-container" >
                                <p class="inner-paragraph"><?=$Lang->ProductsInteractivestoriesDesc?></p>
                            </div>
                            <div class="note rounded">
                                <label class="image"></label>
                                <h2 class="title"><?=$Lang->InteractiveStories?></h2>
                            </div>
                            <div class="products-link">
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/interactives-stories-info"><?=$Lang->ReadMore?></a>
                                <div class="sproter floating-right"></div>
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/stories"><?=$Lang->EXPLORE?></a>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a floating-left" id="educational_game">
                        <div class="item-container" >
                            <div class="inner-item-container" >
                                <p class="inner-paragraph"><?=$Lang->ProductsEducationalgamesDesc?></p>
                            </div>
                            <div class="note rounded" >
                                <label class="image"></label>
                                <h2 class="title"><?=$Lang->EducationalGames?></h2>
                            </div>
                            <div class="products-link">
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/educational-games-info"><?=$Lang->ReadMore?></a>
                                <div class="sproter floating-right"></div>
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/games"><?=$Lang->EXPLORE?></a>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a floating-left" id="educational_tools">
                        <div class="item-container" >
                            <div class="inner-item-container" >
                                <p class="inner-paragraph"><?=$Lang->ProductsEducationalToolsDesc?></p>
                            </div>
                            <div class="note rounded" >
                                <label class="image"></label>
                                <h2 class="title"><?=$Lang->EducationalTools?></h2>
                            </div>
                            <div class="products-link">
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/educational-tools-info"><?=$Lang->ReadMore?></a>
                                <div class="sproter floating-right"></div>
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/educational-tools-info"><?=$Lang->EXPLORE?></a>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a floating-left" id="applications">
                        <div class="item-container" >
                            <div class="inner-item-container" >
                                <p class="inner-paragraph"><?=$Lang->applicationinfoDesc1?></p>
                            </div>
                            <div class="note rounded" >
                                <label class="image"></label>
                                <h2 class="title"><?=$Lang->Applications?></h2>
                            </div>
                            <div class="products-link">
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/application-info"><?=$Lang->ReadMore?></a>
                                <div class="sproter floating-right"></div>
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/Applicationdesc1"><?=$Lang->EXPLORE?></a>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a floating-left" id="childrens_furniture">
                        <div class="item-container" >
                            <div class="inner-item-container" >
                                <p class="inner-paragraph"><?=$Lang->ProductsFurnitureDesc?></p>
                            </div>
                            <div class="note rounded" >
                                <label class="image"></label>
                                <h2 class="title"><?=$Lang->Furniture?></h2>
                            </div>
                            <div class="products-link">
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/childrens-furniture-info"><?=$Lang->ReadMore?></a>
                                <div class="sproter floating-right"></div>
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/childrens-furniture-info"><?=$Lang->EXPLORE?></a>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a floating-left" id="worksheets">
                        <div class="item-container" >
                            <div class="inner-item-container" >
                                <p class="inner-paragraph"><?=$Lang->worksheetsinfoDesc1?></p>
                            </div>
                            <div class="note rounded" >
                                <label class="image"></label>
                                <h2 class="title"><?=$Lang->worksheets?></h2>
                            </div>
                            <div class="products-link">
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/worksheets-info"><?=$Lang->ReadMore?></a>
                                <div class="sproter floating-right"></div>
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/worksheet"><?=$Lang->EXPLORE?></a>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a floating-left" id="interactive-worksheets">
                        <div class="item-container" >
                            <div class="inner-item-container" >
                                <p class="inner-paragraph"><?=$Lang->interactiveworksheetsinfoDesc1?></p>
                            </div>
                            <div class="note rounded" >
                                <label class="image"></label>
                                <h2 class="title"><?=$Lang->InteractiveWorksheets?></h2>
                            </div>
                            <div class="products-link">
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/interactive-worksheets-info"><?=$Lang->ReadMore?></a>
                                <div class="sproter floating-right"></div>
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/worksheet"><?=$Lang->EXPLORE?></a>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a floating-left" id="sound">
                        <div class="item-container" >
                            <div class="inner-item-container" >
                                <p class="inner-paragraph"><?=$Lang->soundinfoDesc1?></p>
                            </div>
                            <div class="note rounded" >
                                <label class="image"></label>
                                <h2 class="title"><?=$Lang->Sounds?></h2>
                            </div>
                            <div class="products-link">
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/sound-info"><?=$Lang->ReadMore?></a>
                                <div class="sproter floating-right"></div>
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/audio"><?=$Lang->EXPLORE?></a>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a floating-left" id="video">
                        <div class="item-container" >
                            <div class="inner-item-container" >
                                <p class="inner-paragraph"><?=$Lang->videoinfoDesc1?></p>
                            </div>
                            <div class="note rounded" >
                                <label class="image"></label>
                                <h2 class="title"><?=$Lang->Videos?></h2>
                            </div>
                            <div class="products-link">
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/video-info"><?=$Lang->ReadMore?></a>
                                <div class="sproter floating-right"></div>
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/video"><?=$Lang->EXPLORE?></a>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a floating-left" id="curricula-requirements">
                        <div class="item-container" >
                            <div class="inner-item-container" >
                                <p class="inner-paragraph"><?=$Lang->teachersguidesinfoDesc1?></p>
                            </div>
                            <div class="note rounded" >
                                <label class="image"></label>
                                <h2 class="title"><?=$Lang->TeachersGuides?></h2>
                            </div>
                            <div class="products-link">
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/teachers-guides-info"><?=$Lang->ReadMore?></a>
                                <div class="sproter floating-right"></div>
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/teachers-guides-info"><?=$Lang->EXPLORE?></a>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a floating-left" id="exercises">
                        <div class="item-container" >
                            <div class="inner-item-container" >
                                <p class="inner-paragraph"><?=$Lang->exercisesinfoDesc1?></p>
                            </div>
                            <div class="note rounded" >
                                <label class="image"></label>
                                <h2 class="title"><?=$Lang->quize?></h2>
                            </div>
                            <div class="products-link">
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/exercises-info"><?=$Lang->ReadMore?></a>
                                <div class="sproter floating-right"></div>
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/exercises-info"><?=$Lang->EXPLORE?></a>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a floating-left" id="coloring-worksheet">
                        <div class="item-container" >
                            <div class="inner-item-container" >
                                <p class="inner-paragraph"><?=$Lang->coloringworksheetinfoDesc1?></p>
                            </div>
                            <div class="note rounded" >
                                <label class="image"></label>
                                <h2 class="title"><?=$Lang->ColoringWorksheet?></h2>
                            </div>
                            <div class="products-link">
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/coloring-worksheet-info"><?=$Lang->ReadMore?></a>
                                <div class="sproter floating-right"></div>
                                <a class="floating-right" href="<?= SITE_URL . $lang_code; ?>/worksheet/category/11/coloring?category=11"><?=$Lang->EXPLORE?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>

