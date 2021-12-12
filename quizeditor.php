<?php
$currentTab="editors";
include "includes/function.php";
include("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/editor.css<?=$cash;?>">
<div class="inner-pages-main-container-editor">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="image-header-container">
                        <h1><?= $Lang->QuizCreator;?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="editor-content">
        <div class="center-piece" style="overflow: visible">
            <div class="inner-container">
                <p class="paragraph"><?=$Lang->EditorsParagraph1;?></p>
                <div class="items-main-container">
                    <div class="display-block-a" id="quizeditor">
                        <div class="item-container">
                            <div class="inner-item-container">
                                <p class="inner-paragraph floating-left">
                                    <?=$Lang->EditorsQuizDesc1?>
                                </p>
                                <label class="floating-left"></label>
                                <div class="container-to-open">
                                    <h3><?=$Lang->Features;?></h3>
                                    <div class="dots-container-editor">
                                        <h4><?=$Lang->Editor;?></h4>
                                        <ul>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsQuizfeatures1?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsQuizfeatures2?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsQuizfeatures3?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsQuizfeatures4?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsQuizfeatures5?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsQuizfeatures6?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsQuizfeatures7?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsQuizfeatures8?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsQuizfeatures9?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsQuizfeatures10?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsQuizfeatures11?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsQuizfeatures12?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsQuizfeatures13?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsQuizfeatures14?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="note rounded" >
                                <h2 class="floating-left title"><?=$Lang->OnlineQuizCreator?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>
