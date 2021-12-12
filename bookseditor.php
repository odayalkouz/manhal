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
                        <h1><?= $Lang->bookEditor;?></h1>
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
                    <div class="display-block-a" id="bookeditor">
                        <div class="item-container">
                            <div class="inner-item-container">
                                <p class="inner-paragraph floating-left">
                                    <?=$Lang->EditorsEBookDesc1?>
                                </p>
                                <label class="floating-left"></label>
                                <div class="container-to-open">
                                    <h3><?=$Lang->Features;?></h3>
                                    <div class="dots-container-editor">
                                        <h4><?=$Lang->Editor;?></h4>
                                        <ul>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookfeatures1?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookfeatures2?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookfeatures3?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookfeatures4?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookfeatures5?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookfeatures6?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookfeatures7?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookfeatures8?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookfeatures9?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookfeatures10?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookfeatures11?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="dots-container-editor">
                                        <h4><?=$Lang->Viewer;?></h4>
                                        <ul>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookViewer1?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookViewer2?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookViewer3?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookViewer4?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookViewer5?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookViewer6?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookViewer7?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookViewer8?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookViewer9?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookViewer10?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookViewer11?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsEBookViewer12?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="note rounded" >
                                <h2 class="floating-left title"><?=$Lang->onlinebookEditor?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>
