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
                        <h1><?= $Lang->StoriesEditor;?></h1>
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
                    <div class="display-block-a" id="storyeditor">
                        <div class="item-container">
                            <div class="inner-item-container">
                                <p class="inner-paragraph floating-left">
                                    <?=$Lang->EditorsIllustratedDesc1?>
                                </p>
                                <label class="floating-left"></label>
                                <div class="container-to-open">
                                    <h3><?=$Lang->Features;?></h3>
                                    <div class="dots-container-editor">
                                        <h4><?=$Lang->Editor;?></h4>
                                        <ul>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures1?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures2?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures3?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures4?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures5?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures6?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures7?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures8?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures9?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures10?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures11?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures12?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures13?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures14?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures15?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures16?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures17?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures18?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures19?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures20?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures21?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures22?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->Editorsllustratedfeatures23?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="note rounded" >
                                <h2 class="floating-left title"><?=$Lang->OnlineStoriesEditor?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>
