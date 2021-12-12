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
                        <h1><?= $Lang->Editors;?></h1>
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
                                <a class="floating-left button">
                                    <div class="floating-left"><i></i></div>
                                    <div class="floating-left"><?=$Lang->More1;?></div>
                                </a>
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
                                <h2 class="floating-left title"><?=$Lang->bookEditor?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a" id="storyeditor">
                        <div class="item-container">
                            <div class="inner-item-container">
                                <p class="inner-paragraph floating-left">
                                    <?=$Lang->EditorsIllustratedDesc1?>
                                </p>
                                <label class="floating-left"></label>
                                <a class="floating-left button">
                                    <div class="floating-left"><i></i></div>
                                    <div class="floating-left"><?=$Lang->More1;?></div>
                                </a>
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
                                <h2 class="floating-left title"><?=$Lang->StoriesEditor?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a" id="quizeditor">
                        <div class="item-container">
                            <div class="inner-item-container">
                                <p class="inner-paragraph floating-left">
                                    <?=$Lang->EditorsQuizDesc1?>
                                </p>
                                <label class="floating-left"></label>
                                <a class="floating-left button">
                                    <div class="floating-left"><i></i></div>
                                    <div class="floating-left"><?=$Lang->More1;?></div>
                                </a>
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
                                <h2 class="floating-left title"><?=$Lang->QuizCreator?></h2>
                            </div>
                        </div>
                    </div>
                    <div class="display-block-a" id="gameeditor">
                        <div class="item-container">
                            <div class="inner-item-container">
                                <p class="inner-paragraph floating-left">
                                    <?=$Lang->EditorsInteractiveStoriesDesc1?>
                                </p>
                                <label class="floating-left"></label>
                                <a class="floating-left button">
                                    <div class="floating-left"><i></i></div>
                                    <div class="floating-left"><?=$Lang->More1;?></div>
                                </a>
                                <div class="container-to-open">
                                    <h3><?=$Lang->Features;?></h3>
                                    <div class="dots-container-editor">
                                        <h4><?=$Lang->Editor;?></h4>
                                        <ul>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures1?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures2?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures3?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures4?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures5?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures6?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures7?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures8?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures9?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures10?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures11?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures12?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures13?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures14?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures15?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures16?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures17?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures18?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures19?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures20?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures21?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures22?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                            <li>
                                                <div class="cirlce floating-left"></div>
                                                <span class="floating-left"><?=$Lang->EditorsInteractiveStoriesfeatures23?></span>
                                                <a class="floating-left"></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="note rounded" >
                                <h2 class="floating-left title"><?=$Lang->InteractiveStoriesBuilder?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>
