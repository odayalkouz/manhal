<?php
include_once "includes/function.php";
mustLogin();

if (strtolower($session_lang) == "ar") {
    $right = "left";
    $left = "right";
} else {
    $right = "right";
    $left = "left";
}
$cashr = 9;
//get story info from database
if (isset($_GET["id"]) && $_GET["id"] != "") {
    if ($_GET["id"] == "new") {//create new story
        $sql = "INSERT INTO `story`(`storyid`, `userid`, `type`,`add_date`, `catid`,`status`, `is_playlist`,`language`)
VALUES (''," . $_SESSION["user"]["userid"] . ",2,NOW(),0,0,0,'en')";
        $con->query($sql);
        $id = mysqli_insert_id($con);
        $story_path = "platform/stories/" . $id;
        if (!is_dir($story_path)) {
            mkdir($story_path);
        }
        if (!is_dir($story_path . "/pages")) {
            mkdir($story_path . "/pages");
        }
        if (!is_dir($story_path . "/sound")) {
            mkdir($story_path . "/sound");
        }
        if (!is_dir($story_path . "/images")) {
            mkdir($story_path . "/images");
            mkdir($story_path . "/images/screenshoots");
        }

        $page_id = uniqid();
        file_put_contents($story_path . "/pages/" . $page_id . ".str", '<div class="story-content-container droppable" id="story-content-container" style="position: relative;width: 100%;height:100%;background-size: 100% 100% !important;"></div>');
        $pages = array($page_id => array("bg_sound" => "", "bg_image" => "", "thumb" => "", "page_id" => $page_id));
        file_put_contents($story_path . "/pages.json", json_encode($pages), true);
        header("location:" . SITE_URL . $lang_code . "/story-editor?id=" . $id);
    } else {//get story info from database
        $sql = "SELECT * FROM `story` WHERE `storyid`=" . $_GET["id"];
        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $story = mysqli_fetch_assoc($result);
            if ($story["userid"] == $_SESSION["user"]["userid"] || $_SESSION["user"]["permession"] <= 6 || $_SESSION["user"]["userid"] <= 5) {
//            if($story["seriesid"]==-1 || $story["seriesid"]==0){
                $story_path = "platform/stories/" . $story["storyid"];
//            }else{
//                $story_path="platform/stories/".$story["seriesid"]."/story/".$story["storyid"];
//            }
            } else {
                header('location: ' . WEBSITE_URL);
                exit();
            }

        } else {//Invalide URL
            header('location: ' . WEBSITE_URL);
            exit();
        }
    }
} else {// invalid URL
    header('location: ' . WEBSITE_URL);
    exit();
}


if ($story["viewtype"] == 1 || $story["viewtype"] == 3) {//one page
    if ($story["width"] > 0) {
        $width = $story["width"];
        $height = $story["height"];
    } else {
        $width = 900;
        $height = 785;
    }
} else {
    if ($story["width"] > 0) {
        $width = $story["width"] / 2;
        $height = $story["height"];
    } else {
        $width = 450;
        $height = 785;
    }
}

//        if($height>785){
$scale = 785 / $height;
$height = 785;
$width = $width * $scale;
//        }

$settings = json_decode($story["settings"], true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $story["title"]; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no, maximum-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="icon" data-type="favicon" sizes="24"
          href="<?= SITE_URL ?>storyeditor/thems/<?= $session_lang; ?>/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?= SITE_URL ?>storyeditor/thems/<?= $session_lang; ?>/css/style.css?v=<?= $cashr ?>">
    <link href="<?= SITE_URL ?>storyeditor/thems/animate.css" rel="Stylesheet" type="text/css"/>
    <link href="<?= SITE_URL ?>storyeditor/thems/<?= $session_lang; ?>/css/size.css" rel="Stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css"
          href="<?= SITE_URL ?>storyeditor/thems/<?= ucfirst($lang_code); ?>/css/default.css?v=<?= $cashr ?>">
    <link rel="stylesheet" type="text/css"
          href="<?= SITE_URL ?>storyeditor/thems/<?= ucfirst($lang_code); ?>/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="<?= SITE_URL ?>storyeditor/thems/<?= $session_lang; ?>/css/colorpicker.css"
          type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL ?>storyeditor/thems/<?= $session_lang; ?>/css/layout.css">
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL ?>storyeditor/css/buttons.css">
    <script type="text/javascript" src="<?= SITE_URL ?>storyeditor/js/jquery.js"></script>
    <script src="<?= SITE_URL ?>storyeditor/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?= SITE_URL ?>storyeditor/js/story-editor.js?v=<?= $cashr ?>" type="text/javascript"></script>
    <script src="<?= SITE_URL ?>storyeditor/js/manhal-ui.js?v=<?= $cashr ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?= SITE_URL ?>storyeditor/js/jquery.popline.min.js"></script>
    <link rel="stylesheet" href="<?= SITE_URL ?>storyeditor/thems/<?= ucfirst($lang_code); ?>/css/jquery-ui.min.css">
    <script type="text/javascript" src="<?= SITE_URL ?>storyeditor/js/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="<?= SITE_URL ?>storyeditor/js/jscolor.js"></script>
    <script src="../js/jquery.ui.rotatable.js"></script>
    <script type="text/javascript" src="<?= SITE_URL; ?>storyeditor/viewer/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="<?= SITE_URL ?>storyeditor/js/Event.js"></script>
    <script type="text/javascript" src="<?= SITE_URL ?>storyeditor/js/Dragdrop.js"></script>
    <script type="text/javascript" src="<?= SITE_URL ?>storyeditor/js/RulersGuides.js"></script>
    <script type="text/javascript" src="<?= SITE_URL; ?>storyeditor/js/context.js"></script>
    <link href="<?= SITE_URL; ?>storyeditor/css/sweetalert.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?= SITE_URL ?>viedoplayer/dist/plyr.js"></script>
    <script src="<?= SITE_URL ?>storyeditor/js/WebAudioRecorder.min.js"></script>
    <link rel="stylesheet" href="<?= SITE_URL ?>viedoplayer/dist/plyr1.css">
    <script>
        window.left = '<?=$right;?>';
        window.right = '<?=$left;?>';
        window.storyid = '<?=$story["storyid"];?>';
        window.bookid = '<?=$story["storyid"];?>';
        window.storyPath = '<?=$story_path;?>';
        window.storyHeight =<?=$height;?>;

        <?php
        if($story["title"] == ""){
        ?>
        $(document).ready(function () {
            setTimeout(function () {
                showsettingpopup();
            }, 300);
        });
        <?php
        }
        ?>


        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-74397962-2', 'auto');
        ga('send', 'pageview');

        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }

        gtag('js', new Date());
        gtag('config', 'AW-836956915');
    </script>
    <!-- Global site tag (gtag.js) - Google AdWords: 836956915 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-836956915"></script>

</head>
<body>
<div class="nu-context-menu">
    <ul>
        <li data-key="Bringtofront"><i class="fa fa-Bringtofront"></i><?= $Lang->Bringtofront; ?></li>
        <li data-key="Sendtoback"><i class="fa fa-Sendtoback"></i><?= $Lang->Sendtoback; ?></li>
    </ul>
</div>
<section class="editor-main-container">
    <div class="loader-main-container">
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
    <div class="activate-choose-thumb-state" style="display: none">
        <a class="closeA">close</a>
    </div>
    <div class="activate-choose-object-state" style="display: none">
        <a class="closeA">close</a>
    </div>
    <div class="popup-storytype-container noclose" id="Edit-page-popup">
        <div class="storytype-container">
            <h1><?= $Lang->EditPage; ?></h1>
            <a class="close"></a>
            <form id="page_settings_form" method="post" enctype="multipart/form-data"
                  action="../platform/ajax/storyeditor.php?process=updatepagesettings" target="hidden_iframe">
                <input type="hidden" id="page_settings_page" name="pageid" value="">
                <input type="hidden" id="page_settings_storypath" name="storypath" value="">
                <div class="edit-and-add">
                    <div class="line-row">
                        <label class="lbl-data floating-left text-left"><?= $Lang->BackgroundSound; ?></label>
                        <div class="radio-container floating-left with-out-width">
                            <audio id="audio-a" controls class="floating-left" id="audio-sound-edit-page">
                                <source id="source-a" src="horse.mp3" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            <div class="fu-container-c floating-left">
                                <label class="floating-left flaticon-cloud148 label-a"></label>
                                <label class="floating-left label-b" id="lblthump_txt"></label>
                                <input class="input-file-sound" id="input-sound-edit-page" type="file"
                                       name="page_sound">
                            </div>
                            <a class="delete-image-a floating-left jq_delete_page_sound"></a>
                        </div>
                    </div>
                    <div class="line-row">
                        <label class="lbl-data floating-left text-left custom-height"><?= $Lang->Image; ?></label>
                        <img src="<?= SITE_URL ?>storyeditor/thems/<?= ucfirst($lang_code); ?>/images/imagedef.svg"
                             id="default-image-edit-page" class="default-image floating-left"
                             style="background-size: contain;background-position: center"/>
                        <div class="fu-container-a floating-left">
                            <label class="floating-left flaticon-cloud148 label-a"></label>
                            <label class="floating-left label-b" id="lblimage_txt"></label>
                            <input onchange="readURL(this,'default-image-edit-page');" type="file" name="page_image">
                        </div>
                        <a class="delete-image floating-left jq_delete_pagebg"></a>
                    </div>
                    <div class="line-row">
                        <label class="lbl-data floating-left text-left custom-height"><?= $Lang->Thumb; ?></label>
                        <img src="<?= SITE_URL ?>storyeditor/thems/<?= ucfirst($lang_code); ?>/images/folder.svg"
                             id="default-thump-edit-page" class="default-thump floating-left"
                             style="background-size: contain;background-position: center"/>
                        <div class="fu-container-a floating-left">
                            <label class="floating-left flaticon-cloud148 label-a"></label>
                            <label class="floating-left label-b" id="lblthump_txt"></label>
                            <input onchange="readURL(this,'default-thump-edit-page');" type="file" name="page_thumb">
                        </div>
                        <a class="delete-image floating-left jq_delete_pagethumb"></a>
                    </div>
                    <div class="line-row">
                        <label class="lbl-data floating-left text-left custom-height"><?= $Lang->Negative; ?></label>
                        <img src="<?= SITE_URL ?>storyeditor/thems/<?= ucfirst($lang_code); ?>/images/folder.svg"
                             id="default-negative-edit-page" class="default-thump floating-left"
                             style="background-size: contain;background-position: center"/>
                        <div class="fu-container-a floating-left">
                            <label class="floating-left flaticon-cloud148 label-a"></label>
                            <label class="floating-left label-b" id="lblnegative_txt"></label>
                            <input onchange="readURL(this,'default-negative-edit-page');" type="file"
                                   name="page_negative">
                        </div>
                        <a class="delete-image floating-left jq_delete_pagethumb"></a>
                    </div>
                    <a id="save_page_settings" class="save floating-right"><label><?= $Lang->Save; ?></label></a>
                </div>
            </form>
        </div>
    </div>
    <div class="popup-storytype-container noclose" id="do-you-know-popup">
        <div class="storytype-container">
            <h1><?= $Lang->Edit; ?></h1>
            <a class="close"></a>
            <div class="edit-and-add">
                <form id="douknow_form" method="post" enctype="multipart/form-data"
                      action="../platform/ajax/storyeditor.php?process=douknow_widget" target="hidden_iframe">
                    <input type="hidden" class="jq_storypath" name="storypath" value="">
                    <input type="hidden" class="jq_widgetid" name="widgetid" value="">
                    <div class="line-row">
                        <label class="lbl-data floating-left text-left"><?= $Lang->uploadIcon; ?></label>
                        <img src="<?= SITE_URL ?>storyeditor/thems/<?= ucfirst($lang_code); ?>/images/imagedef.svg"
                             id="default-image-doyouknow-icon" class="default-image floating-left"
                             style="background-size: contain;background-position: center"/>
                        <div class="fu-container-a floating-left">
                            <label class="floating-left flaticon-cloud148 label-a"></label>
                            <label class="floating-left label-b" id="lblimage_txt"></label>
                            <input onchange="readURL(this,'default-image-doyouknow-icon');" type="file"
                                   name="douknow_icon">
                        </div>
                    </div>
                    <div class="line-row">
                        <label class="lbl-data floating-left text-left"><?= $Lang->Image; ?></label>
                        <img src="<?= SITE_URL ?>storyeditor/thems/<?= ucfirst($lang_code); ?>/images/imagedef.svg"
                             id="default-image-doyouknow" class="default-image floating-left"
                             style="background-size: contain;background-position: center"/>
                        <div class="fu-container-a floating-left">
                            <label class="floating-left flaticon-cloud148 label-a"></label>
                            <label class="floating-left label-b" id="lblimage_txt"></label>
                            <input onchange="readURL(this,'default-image-doyouknow');" type="file" name="douknow_image">
                        </div>
                    </div>
                    <div class="line-row">
                        <label class="lbl-data floating-left text-left"><?= $Lang->Text; ?></label>
                        <textarea class="floating-left" name="douknow_txt" id="douknow_txt">Text Text Text Text Text Text Text Text </textarea>
                    </div>
                    <a id="jq_savedouknow" class="save floating-right"><label><?= $Lang->Save; ?></label></a>
                </form>

            </div>
        </div>
    </div>


    <div class="popup-storytype-container noclose" id="do-you-know-view">
        <div class="storytype-container">
            <h1><?= $Lang->Edit; ?></h1>
            <a class="close"></a>
            <div class="edit-and-add">
                <div class="last-content">
                    <div class="text-container floating-right tow-a">
                        <p id="douknow_txt_view"></p>
                    </div>
                    <div class="image-container floating-right tow-b">
                        <img id="douknow_img_view" src="" alt="cover">
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="popup-storytype-container noclose" id="item-settings">
        <div class="storytype-container">
            <h1><?= $Lang->Setting1; ?></h1>
            <a class="close"></a>
            <form id="widget_setting_form">
                <div class="edit-and-add">
                    <div class="line-row">
                        <label class="lbl-data floating-left text-left"><?= $Lang->BackgroundPage; ?></label>
                        <div class="radio-container floating-left">
                            <input class="floating-left" checked="checked" id="no_backgroundp" name="background"
                                   type="radio">
                            <label class="floating-left" for="no_backgroundp"><?= $Lang->NoBackground; ?></label>
                        </div>
                        <div class="radio-container floating-left">
                            <input class="floating-left" type="radio" name="background" id="backgroundp">
                            <div id="backgroundvalue2" class="colorSelector floating-left" title="Background Color">
                                <input class="backgroundvalue2 target jscolor" id="bg_color2"
                                       style="background-color: #7dc04d" color="7dc04d"/>
                            </div>
                        </div>
                    </div>
                    <div class="line-row">
                        <label class="lbl-data floating-left text-left"><?= $Lang->Border; ?></label>
                        <div class="radio-container floating-left">
                            <input class="floating-left" id="no_border2" checked="checked" name="border2" type="radio">
                            <label class="floating-left" for="no_border2"><?= $Lang->NoBorder; ?></label>
                        </div>
                        <div class="radio-container floating-left with-out-width">
                            <input class="floating-left" type="radio" id="with_border2" name="border2">
                            <input type="number" value="1" title="Border Width" class="border-width floating-left"
                                   id="bordersize1" placeholder="1">
                            <div class="colorSelector colorSelectorBorder floating-left" title="Border Style">
                                <div class="border-value-color jscolor"
                                     style="background-color: transparent;border-width:1px;border-color:#7dc04d;border-style: solid"></div>
                                <select id="border-selectoption" class="selectoption jq_borderstyle2">
                                    <option value="solid">solid</option>
                                    <option value="dotted">dotted</option>
                                    <option value="dashed">dashed</option>
                                    <option value="double">double</option>
                                    <option value="groove">groove</option>
                                    <option value="ridge">ridge</option>
                                    <option value="inset">inset</option>
                                    <option value="outset">outset</option>
                                    <option value="hidden">hidden</option>
                                </select>
                            </div>
                            <div id="bordervalue" class="colorSelector floating-left" title="Border Color">
                                <input class="bordervalue jscolor" id="bordervalue2" style="background-color: #7dc04d"
                                       color="7dc04d"></input>
                            </div>
                        </div>
                    </div>
                    <div class="line-row">
                        <label class="lbl-data floating-left text-left"><?= $Lang->Appearance; ?></label>
                        <div class="radio-container floating-left with-out-width">
                            <input class="floating-left" id="no_Appearance2" name="background" type="checkbox">
                            <label class="floating-left"
                                   for="no_Appearance2"><?= $Lang->appearanceofobjectwithouttiming; ?></label>
                            <label class="floating-left clear-both daily"><?= $Lang->DailyTime; ?></label>
                            <input type="number" value="00" id="delay_item" class="secounds floating-left"
                                   placeholder="00">
                            <label class="floating-left daily"><?= $Lang->Sec; ?></label>
                        </div>
                    </div>
                    <a id="save_item_settings" class="save floating-right"><label><?= $Lang->Save; ?></label></a>
                </div>
            </form>
        </div>
    </div>


    <div class="popup-storytype-container noclose" id="item-settings-buttons">
        <div class="storytype-container">
            <h1><?= $Lang->Setting1; ?></h1>
            <a class="close"></a>
            <form id="widget_setting_form">
                <div class="edit-and-add">
                    <div class="line-row">
                        <label class="lbl-data floating-left text-left"><?= $Lang->BackgroundPage; ?></label>
                        <div class="radio-container floating-left">
                            <input class="floating-left" checked="checked" id="no_backgroundp_buttons" name="background"
                                   type="radio">
                            <label class="floating-left"
                                   for="no_backgroundp_buttons"><?= $Lang->NoBackground; ?></label>
                        </div>
                        <div class="radio-container floating-left">
                            <input class="floating-left" type="radio" name="background" id="backgroundp_buttons">
                            <div id="backgroundvalue2_buttons" class="colorSelector floating-left"
                                 title="Background Color">
                                <input class="backgroundvalue2 target jscolor" id="bg_color2_buttons"
                                       style="background-color: #7dc04d" color="7dc04d"/>
                            </div>
                        </div>
                    </div>
                    <a id="save_item_settings_buttons"
                       class="save floating-right"><label><?= $Lang->Save; ?></label></a>
                </div>
            </form>
        </div>
    </div>

    <div class="popup-storytype-container noclose" id="popup-edit-iframe">
        <div class="storytype-container">
            <h1><?= $Lang->Edit; ?></h1>
            <a class="close"></a>
            <div class="edit-and-add">
                <div class="line-row">
                    <label class="lbl-data floating-left text-left lbl-data-url"><?= $Lang->URL; ?></label>
                    <div class="radio-container floating-left with-out-width">
                        <input class="floating-left iframe-url" id="iframe_widget" placeholder="<?= $Lang->URL; ?>"
                               name="Iframe-url" type="text">
                    </div>
                </div>
                <a id="save_iframe" class="save floating-right"><label><?= $Lang->Save; ?></label></a>
            </div>
        </div>
    </div>
    <div class="popup-storytype-container noclose" id="popup-edit-sound-all-widget">
        <div class="storytype-container" style="display: none">
            <h1><?= $Lang->EditSound; ?></h1>
            <a class="close"></a>
            <div id="splitter"></div>
            <div class="edit-and-add" style="display: none!important;">
                <div class="content-top-Sound-chopping">
                    <img src="<?= SITE_URL ?>storyeditor/thems/<?= $session_lang; ?>/images/defaultsound.png">
                    <div class="buttons-content floating-left">
                        <div class="fu-container-d floating-left">
                            <label class="floating-left flaticon-cloud148 label-a"></label>
                            <label class="floating-left label-b" id="lblthump_txt"></label>
                            <input id="input-sound-edit-page" type="file" name="image">
                        </div>
                        <label class="line-separate  floating-left"></label>
                        <a class="play-image floating-left"></a>
                        <label class="line-separate  floating-left"></label>
                        <a class="backward-image floating-left"></a>
                        <a class="forward-image floating-left"></a>
                        <label class="line-separate floating-left"></label>
                        <a class="sound-image floating-left"></a>
                        <a class="delete-image floating-left"></a>
                    </div>
                </div>
                <div class="word-under-buttons">
                    <a>الأسد</a>
                </div>
                <div class="sound-setting-tabs-container">
                    <div class="tabs-buttons floating-left">
                        <ul>
                            <li class="preview floating-left"><a class="active">Priview</a></li>
                            <li class="Text floating-left"><a>Text</a></li>
                        </ul>
                    </div>
                    <div class="tabs-contents floating-left">
                        <div class="tab tabs-A floating-left" style="display: block">Preview Content</div>
                        <div class="tab tabs-B floating-left">Text Content</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="popup-delete-container noclose" style="display: none">
        <div class="delete-container" style="display: none">
            <h1><?= $Lang->Confirmation; ?></h1>
            <p><?= $Lang->Areshuredeletepage; ?></p>
            <div class="row">
                <a id="delete_question" class="yes floating-right"><?= $Lang->Yes; ?></a>
                <a class="no floating-right"><?= $Lang->Cancel; ?></a>
            </div>
        </div>
    </div>
    <div class="popup-confirm-container noclose" style="display: none">
        <div class="confirm-container" style="display: none">
            <h1><?= $Lang->information; ?></h1>
            <p><?= $Lang->Areshuredeletepage; ?></p>
            <div class="row">
                <a id="confirm_question" class="yes floating-right"><?= $Lang->ok; ?></a>
            </div>
        </div>
    </div>
    <div class="popup-settings-container noclose">
        <div class="settings-container">
            <a class="close"></a>
            <div class="Panel">
                <nav>
                    <ul class="Tabs">
                        <li class="Tabs__tab active Tab"><a><?= $Lang->General; ?></a></li>
                        <?php
                        if ($_SESSION['user']["permession"] > 0 && $_SESSION['user']["permession"] <= 6 || $_SESSION['user']["userid"] < 5) {
                            ?>
                            <li class="Tabs__tab Tab"><a><?= $Lang->PublishPrice; ?></a></li>

                            <li class="Tabs__tab Tab"><a><?= $Lang->Description; ?></a></li>
                            <?php
                        }
                        ?>
                        <!--                        <li class="Tabs__tab Tab"><a class="jq_screenshoots_tab">-->
                        <?php //=$Lang->CoverScreenshoots;?>
                        <!--</a></li>-->
                        <li class="Tabs__presentation-slider" role="presentation"></li>
                    </ul>
                </nav>
                <form id="settings_form" method="post" enctype="multipart/form-data"
                      action="../platform/ajax/storyeditor.php?process=generalsettings" target="hidden_iframe">
                    <input type="hidden" name="oldseriesid" value="<?= $story["seriesid"]; ?>">
                    <input type="hidden" name="storyid" value="<?= $story["storyid"]; ?>">
                    <div class="Panel__body">
                        <div class="content-of-tab General " style="display: block">
                            <div class="line-row">
                                <label class="lbl-data floating-left text-left"><?= $Lang->title; ?></label>
                                <div class="right-container floating-left text-left">
                                    <input name="title" id="general_title" type="text"
                                           placeholder="<?= $Lang->title; ?>" value="<?= $story["title"]; ?>">
                                </div>
                            </div>
                            <div class="line-row">
                                <label class="lbl-data floating-left text-left"><?= $Lang->Language; ?></label>
                                <div class="right-container floating-left">
                                    <div class="radio-container floating-left custom-width">
                                        <input class="floating-left" id="Arabic" <?php if ($story["language"] != "en") {
                                            echo 'checked="checked"';
                                        } ?> name="language" type="radio" value="ar">
                                        <label class="floating-left" for="Arabic"><?= $Lang->Arabic; ?></label>
                                    </div>
                                    <div class="radio-container floating-left custom-width">
                                        <input class="floating-left"
                                               id="English" <?php if ($story["language"] == "en") {
                                            echo 'checked="checked"';
                                        } ?> name="language" type="radio" value="en">
                                        <label class="floating-left" for="English"><?= $Lang->English; ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="line-row">
                                <label class="lbl-data floating-left text-left"><?= $Lang->Category; ?></label>
                                <div class="right-container floating-left text-left">
                                    <select class="ddl-content" name="category" id="category">
                                        <?php
                                        $sql = "SELECT * FROM `stories_cat`";
                                        $result = $con->query($sql);
                                        while ($cat = mysqli_fetch_assoc($result)) {
                                            if (isset($story["catid"]) && $story["catid"] == $cat["catid"]) {
                                                $selected = "selected";
                                            } else {
                                                $selected = "";
                                            }
                                            ?>
                                            <option <?= $selected; ?>
                                                    value="<?= $cat["catid"]; ?>"><?= $cat["name_" . $cat_code]; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="line-row">
                                <label class="lbl-data floating-left text-left"><?= $Lang->Age; ?></label>
                                <div class="right-container floating-left text-left">
                                    <select class="ddl-content" name="age" id="age">
                                        <option value="-1" <?php if ($story["age"] == -1) {
                                            echo 'selected';
                                        } ?> ><?= $Lang->all; ?></option>
                                        <option value="1" <?php if ($story["age"] == 1) {
                                            echo 'selected';
                                        } ?> >4-5
                                        </option>
                                        <option value="2" <?php if ($story["age"] == 2) {
                                            echo 'selected';
                                        } ?> >6-8
                                        </option>
                                        <option value="3" <?php if ($story["age"] == 3) {
                                            echo 'selected';
                                        } ?> >9-11
                                        </option>
                                        <option value="4" <?php if ($story["age"] == 4) {
                                            echo 'selected';
                                        } ?> >12-15
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="line-row">
                                <label class="lbl-data floating-left text-left"><?= $Lang->Width; ?></label>
                                <div class="right-container floating-left text-left">
                                    <input name="width" id="width" type="text" placeholder="<?= $Lang->Width; ?>"
                                           value="<?= $story["width"]; ?>">
                                </div>
                            </div>
                            <div class="line-row">
                                <label class="lbl-data floating-left text-left"><?= $Lang->Height; ?></label>
                                <div class="right-container floating-left text-left">
                                    <input name="height" id="height" type="text" placeholder="<?= $Lang->Height; ?>"
                                           value="<?= $story["height"]; ?>">
                                </div>
                            </div>
                            <div class="line-row">
                                <label class="lbl-data floating-left text-left"><?= $Lang->pageview; ?></label>
                                <div class="right-container floating-left">
                                    <div class="radio-container floating-left custom-width">
                                        <input class="floating-left" id="Onepage" name="viewtype" type="radio"
                                               value="1" <?php if ($story["viewtype"] == 1) {
                                            echo 'checked="checked"';
                                        } ?> >
                                        <label class="floating-left" for="Onepage"><?= $Lang->Onepage; ?></label>
                                    </div>
                                    <div class="radio-container floating-left custom-width">
                                        <input class="floating-left" id="Towpage" name="viewtype" type="radio"
                                               value="2" <?php if ($story["viewtype"] == 2) {
                                            echo 'checked="checked"';
                                        } ?>>
                                        <label class="floating-left" for="Towpage"><?= $Lang->Towpage; ?></label>
                                    </div>
                                    <div class="radio-container floating-left custom-width">
                                        <input class="floating-left" id="sliderview" name="viewtype" type="radio"
                                               value="3" <?php if ($story["viewtype"] == 3) {
                                            echo 'checked="checked"';
                                        } ?>>
                                        <label class="floating-left" for="sliderview"><?= $Lang->Slider; ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="line-row custom-margin-10" id="slider_option_show"
                                 style="display:none!important;">
                                <label class="lbl-data floating-left text-left"><?= $Lang->slideroptions; ?></label>
                                <div class="right-container floating-left" style="margin-top: 5px">
                                    <div class="radio-container floating-left small-height">
                                        <input class="floating-left" id="arrow" name="arrow" type="checkbox"
                                               value="1" <?php if (isset($settings["arrow"]) && $settings["arrow"] == 1) {
                                            echo "checked";
                                        } ?> >
                                        <label class="floating-left" for="arrow"><?= $Lang->Arrow; ?></label>
                                    </div>
                                    <div class="radio-container floating-left small-height">
                                        <input class="floating-left" id="dots" name="dots"
                                               type="checkbox"
                                               value="1" <?php if (isset($settings["dots"]) && $settings["dots"] == 1) {
                                            echo "checked";
                                        } ?> >
                                        <label class="floating-left" for="dots"><?= $Lang->Dots; ?></label>
                                    </div>
                                    <div class="radio-container floating-left small-height">
                                        <input class="floating-left" id="autoplay" name="autoplay" type="checkbox"
                                               value="1" <?php if (isset($settings["autoplay"]) && $settings["autoplay"] == 1) {
                                            echo "checked";
                                        } ?> >
                                        <label class="floating-left" for="autoplay"><?= $Lang->autoplay; ?></label>
                                    </div>
                                    <div class="radio-container floating-left small-height">
                                        <input class="floating-left" id="infinite" name="infinite" type="checkbox"
                                               value="1" <?php if (isset($settings["infinite"]) && $settings["infinite"] == 1) {
                                            echo "checked";
                                        } ?> >
                                        <label class="floating-left" for="infinite"><?= $Lang->infinite; ?></label>
                                    </div>
                                </div>
                                <label class="floating-left lbl-data clear-both text-left"><?= $Lang->Align; ?></label>
                                <div class="right-container floating-left" style="margin-top: 5px">
                                    <div class="radio-container floating-left custom-width">
                                        <input class="floating-left" id="Horizontal" name="Align" type="radio" value="h"
                                            <?php if ((isset($settings["align"]) && $settings["align"] == "h") || !isset($settings["align"])) {
                                                echo "checked";
                                            } ?> >
                                        <label class="floating-left" for="Horizontal"><?= $Lang->Horizontal; ?></label>
                                    </div>
                                    <div class="radio-container floating-left custom-width">
                                        <input class="floating-left" id="Vertical" name="Align" type="radio"
                                               value="v" <?php if ((isset($settings["align"]) && $settings["align"] == "v")) {
                                            echo "checked";
                                        } ?> >
                                        <label class="floating-left" for="Vertical"><?= $Lang->Vertical; ?></label>
                                    </div>
                                </div>
                                <label class="floating-left lbl-data clear-both text-left"><?= $Lang->transitions; ?></label>
                                <div class="right-container floating-left" style="margin-top: 5px">
                                    <div class="radio-container floating-left small-height">
                                        <select class="ddl-content" name="transition">
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "none")) {
                                                echo "selected";
                                            } ?> value="none">none
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "Curtains")) {
                                                echo "selected";
                                            } ?> value="Curtains">Curtains
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "CurtainsLeft")) {
                                                echo "selected";
                                            } ?> value="CurtainsLeft">Curtains Left
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "CurtainsRight")) {
                                                echo "selected";
                                            } ?> value="CurtainsRight">Curtains Right
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "puffIn")) {
                                                echo "selected";
                                            } ?> value="puffIn">puffIn
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "vanishIn")) {
                                                echo "selected";
                                            } ?> value="vanishIn">vanishIn
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "swap")) {
                                                echo "selected";
                                            } ?> value="swap">swap
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "pullUp")) {
                                                echo "selected";
                                            } ?> value="pullUp">pullUp
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "pullDown")) {
                                                echo "selected";
                                            } ?> value="pullDown">pullDown
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "stretchLeft")) {
                                                echo "selected";
                                            } ?> value="stretchLeft">stretchLeft
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "stretchRight")) {
                                                echo "selected";
                                            } ?> value="stretchRight">stretchRight
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "bigEntrance")) {
                                                echo "selected";
                                            } ?> value="bigEntrance">bigEntrance
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "bounce")) {
                                                echo "selected";
                                            } ?> value="bounce">bounce
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "flash")) {
                                                echo "selected";
                                            } ?> value="flash">flash
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "swing")) {
                                                echo "selected";
                                            } ?> value="swing">swing
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "jello")) {
                                                echo "selected";
                                            } ?> value="jello">jello
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "bounceInDown")) {
                                                echo "selected";
                                            } ?> value="bounceInDown">bounceInDown
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "bounceInLeft")) {
                                                echo "selected";
                                            } ?> value="bounceInLeft">bounceInLeft
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "bounceInUp")) {
                                                echo "selected";
                                            } ?> value="bounceInUp">bounceInUp
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "bounceInRight")) {
                                                echo "selected";
                                            } ?> value="bounceInRight">bounceInRight
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "fadeInDown")) {
                                                echo "selected";
                                            } ?> value="fadeInDown">fadeInDown
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "fadeInUp")) {
                                                echo "selected";
                                            } ?> value="fadeInUp">fadeInDown
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "fadeInLeft")) {
                                                echo "selected";
                                            } ?> value="fadeInLeft">fadeInDown
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "fadeInRight")) {
                                                echo "selected";
                                            } ?> value="fadeInRight">fadeInDown
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "flipInX")) {
                                                echo "selected";
                                            } ?> value="flipInX">flipInX
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "flipInY")) {
                                                echo "selected";
                                            } ?> value="flipInY">flipInY
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "lightSpeedIn")) {
                                                echo "selected";
                                            } ?> value="lightSpeedIn">lightSpeedIn
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "rotateIn")) {
                                                echo "selected";
                                            } ?> value="rotateIn">rotateIn
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "rollIn")) {
                                                echo "selected";
                                            } ?> value="rollIn">rollIn
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "slideInDown")) {
                                                echo "selected";
                                            } ?> value="slideInDown">slideInDown
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "slideInUp")) {
                                                echo "selected";
                                            } ?> value="slideInUp">slideInUp
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "slideInLeft")) {
                                                echo "selected";
                                            } ?> value="slideInLeft">slideInLeft
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "slideInRight")) {
                                                echo "selected";
                                            } ?> value="slideInRight">slideInRight
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "spaceInUp")) {
                                                echo "selected";
                                            } ?> value="spaceInUp">spaceInUp
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "spaceInDown")) {
                                                echo "selected";
                                            } ?> value="spaceInDown">spaceInDown
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "spaceInLeft")) {
                                                echo "selected";
                                            } ?> value="spaceInLeft">spaceInLeft
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "spaceInRight")) {
                                                echo "selected";
                                            } ?> value="spaceInRight">spaceInRight
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "tinRightIn")) {
                                                echo "selected";
                                            } ?> value="tinRightIn">tinRightIn
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "tinLeftIn")) {
                                                echo "selected";
                                            } ?> value="tinLeftIn">tinLeftIn
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "tinUpIn")) {
                                                echo "selected";
                                            } ?> value="tinUpIn">tinUpIn
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "tinDownIn")) {
                                                echo "selected";
                                            } ?> value="tinDownIn">tinDownIn
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "foolishIn")) {
                                                echo "selected";
                                            } ?> value="foolishIn">foolishIn
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "slideExpandUp")) {
                                                echo "selected";
                                            } ?> value="slideExpandUp">slideExpandUp
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "expandUp")) {
                                                echo "selected";
                                            } ?> value="expandUp">expandUp
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "expandOpen")) {
                                                echo "selected";
                                            } ?> value="expandOpen">expandOpen
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "twisterInDown")) {
                                                echo "selected";
                                            } ?> value="twisterInDown">twisterInDown
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "twisterInUp")) {
                                                echo "selected";
                                            } ?> value="twisterInUp">twisterInUp
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "hatch")) {
                                                echo "selected";
                                            } ?> value="hatch">hatch
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "floating")) {
                                                echo "selected";
                                            } ?> value="floating">floating
                                            </option>
                                            <option <?php if ((isset($settings["transition"]) && $settings["transition"] == "tossing")) {
                                                echo "selected";
                                            } ?> value="tossing">tossing
                                            </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="line-row" style="display: none">
                                <label class="lbl-data floating-left text-left"><?= $Lang->pageflip; ?></label>
                                <div class="right-container floating-left">
                                    <div class="radio-container floating-left custom-width">
                                        <input class="floating-left" id="Normal" name="pageflip" type="radio"
                                               value="0" <?php if ($story["flipping"] == 0) {
                                            echo 'checked="checked"';
                                        } ?> >
                                        <label class="floating-left" for="Normal"><?= $Lang->Normal; ?></label>
                                    </div>
                                    <div class="radio-container floating-left custom-width">
                                        <input class="floating-left" id="Flipping" name="pageflip" type="radio"
                                               value="1" <?php if ($story["flipping"] == 1) {
                                            echo 'checked="checked"';
                                        } ?>>
                                        <label class="floating-left" for="Flipping"><?= $Lang->Flipping; ?></label>
                                    </div>
                                </div>
                            </div>
                            <div class="line-row custom-margin-10">
                                <label class="lbl-data floating-left text-left"><?= $Lang->DrawingTool; ?></label>
                                <div class="right-container floating-left" style="margin-top: 5px">
                                    <div class="radio-container floating-left small-height">
                                        <input class="floating-left" id="Drawing_tool" value="1" name="drawing"
                                               type="checkbox" <?php if ((isset($settings["drawing"]) && $settings["drawing"] == "1")) {
                                            echo "checked";
                                        } ?> >
                                        <label class="floating-left" for="Drawing_tool"><?= $Lang->Enabled; ?></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-of-tab Publish-Price">
                            <div class="content-of-half-div floating-left">
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->NoFiling; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <input name="filling" id="filling" type="text" class="small-width"
                                               placeholder="<?= $Lang->NoFiling; ?>" value="<?= $story["filling"]; ?>">
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->ISBNNumber; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <input type="text" id="isbn" name="isbn" class="small-width"
                                               placeholder="<?= $Lang->ISBNNumber; ?>" value="<?= $story["isbn"]; ?>">
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->PublishYear; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <input type="text" name="publish_year" id="publish_year" class="small-width"
                                               placeholder="<?= $Lang->PublishYear; ?>" value="<?= $story["year"]; ?>">
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->StoryWeight; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <input type="text" id="weight" name="weight" class="small-width"
                                               placeholder="<?= $Lang->StoryWeight; ?>"
                                               value="<?= $story["weight"]; ?>">
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->Numberofpages; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <input type="text" name="pagescount" id="pagescount" class="small-width"
                                               placeholder="<?= $Lang->Numberofpages; ?>"
                                               value="<?= $story["pages_count"]; ?>">
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->FirstPage; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <input type="text" id="firstpage" name="firstpage" class="small-width"
                                               placeholder="<?= $Lang->FirstPage; ?>"
                                               value="<?= $story["range_first"]; ?>">
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->LastPage; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <input type="text" id="lastpage" name="lastpage" class="small-width"
                                               placeholder="<?= $Lang->LastPage; ?>"
                                               value="<?= $story["range_end"]; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="content-of-half-div floating-left">
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->OldPrice; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <input type="text" name="old_price" id="old_price" class="small-width"
                                               placeholder="<?= $Lang->OldPrice; ?>" value="<?= $story["oldprice"]; ?>">
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->Price; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <input type="text" name="price" id="price" class="small-width"
                                               placeholder="<?= $Lang->Price; ?>" value="<?= $story["price"]; ?>">
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->Series; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <select name="series" id="series" class="ddl-content small-width">
                                            <option value="-1">----------</option>
                                            <?php
                                            $sql = "SELECT * FROM `series`";
                                            $result = $con->query($sql);
                                            if (mysqli_num_rows($result) > 0) {
                                                while ($series_row = mysqli_fetch_assoc($result)) {
                                                    $selected = '';
                                                    if ($series_row['seriesid'] == $story["seriesid"]) {
                                                        $selected = 'selected';
                                                    }
                                                    echo "<option " . $selected . " value='" . $series_row['seriesid'] . "'>" . $series_row['name'] . "</option>";
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->Binding; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <select id="binding" name="binding" class="ddl-content small-width">
                                            <option value="0" <?php if ($story["covertype"] == 0) {
                                                echo 'selected';
                                            } ?> ><?= $Lang->SoftCover; ?></option>
                                            <option value="1" <?php if ($story["covertype"] == 1) {
                                                echo 'selected';
                                            } ?> ><?= $Lang->HardCover; ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="line-row custom-margin-10">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->Option; ?></label>
                                    <div class="right-container floating-left">
                                        <div class="radio-container floating-left small-height">
                                            <input class="floating-left"
                                                   id="PaperCopy" <?php if ($story['type'] == 1 || $story['type'] == 3 || $story['type'] == 5 || $story['type'] == 7 || $story['type'] == '' || $story['type'] == Null) {
                                                echo 'checked="checked"';
                                            } ?> name="story_type_p" type="checkbox" value="1">
                                            <label class="floating-left"
                                                   for="PaperCopy"><?= $Lang->PaperCopy; ?></label>
                                            <input class="floating-left clear-both"
                                                   id="iprice" <?php if ($story['type'] == 2 || $story['type'] == 3 || $story['type'] == 6 || $story['type'] == 7) {
                                                echo 'checked="checked"';
                                            } ?> name="story_type_e" type="checkbox" value="1">
                                            <label class="floating-left" for="iprice"><?= $Lang->eprice; ?></label>
                                            <input class="floating-left clear-both"
                                                   id="eprice" <?php if ($story['type'] == 4 || $story['type'] == 5 || $story['type'] == 6 || $story['type'] == 7) {
                                                echo 'checked="checked"';
                                            } ?> name="story_type_i" type="checkbox" value="1">
                                            <label class="floating-left" for="eprice"><?= $Lang->iprice; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="line-row custom-margin-5">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->Package; ?></label>
                                    <div class="right-container floating-left">
                                        <div class="radio-container floating-left">
                                            <input class="floating-left" id="Package" name="package"
                                                   type="checkbox" <?php if ($story["package"] == 1) {
                                                echo 'checked="checked"';
                                            } ?> >
                                            <label class="floating-left" for="Package"><?= $Lang->Package; ?></label>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if ($_SESSION["user"]["permession"] > 0 && $_SESSION["user"]["permession"] < 7) {
                                    ?>
                                    <div class="line-row custom-margin-0">
                                        <label class="lbl-data floating-left text-left"><?= $Lang->isPublished; ?></label>
                                        <div class="right-container floating-left">
                                            <div class="radio-container floating-left">
                                                <input class="floating-left" id="isPublished" name="isPublished"
                                                       value="1" type="checkbox" <?php if ($story['status'] == 1) {
                                                    echo 'checked="checked"';
                                                } ?>>
                                                <label class="floating-left"
                                                       for="isPublished"><?= $Lang->isPublished; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="line-row custom-margin-0">
                                        <label class="lbl-data floating-left text-left"><?= $Lang->InteractiveWorksheetsT; ?></label>
                                        <div class="right-container floating-left">
                                            <div class="radio-container floating-left">
                                                <input class="floating-left" id="isInteractiveW" name="isInteractiveW"
                                                       value="1" type="checkbox" <?php if ($story['is_media'] == 1) {
                                                    echo 'checked="checked"';
                                                } ?>>
                                                <label class="floating-left"
                                                       for="isInteractiveW"><?= $Lang->InteractiveWorksheetsT; ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="mediaid" id="mediaid" value="<?= $story['mediaid']; ?>">
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                        <div class="content-of-tab Description">
                            <div class="content-of-half-div floating-left">
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->AuthorEn; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <input type="text" name="author_en" id="author_en" class="small-width"
                                               value="<?= $story["author_en"]; ?>"
                                               placeholder="<?= $Lang->AuthorEn; ?>">
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->AuthorAr; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <input type="text" name="author_ar" id="author_ar" class="small-width"
                                               value="<?= $story["author_ar"]; ?>"
                                               placeholder="<?= $Lang->AuthorAr; ?>">
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->BookDescriptionEn; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <textarea name="description_en" id="description_en"
                                                  class="desc"><?= $story['description_en']; ?></textarea>
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->BookDescriptionAr; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <textarea id="description_ar" name="description_ar"
                                                  class="desc"><?= $story['description_ar']; ?></textarea>
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->SEODescriptionEn; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <textarea name="seodescription_en" id="seodescription_en"
                                                  class="desc"><?= $story['sseodescription_en']; ?></textarea>
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->SEODescriptionAr; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <textarea name="seodescription_ar" id="seodescription_ar"
                                                  class="desc"><?= $story['sseodescription_ar']; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="content-of-half-div floating-right">
                                <div class="line-row">
                                    <label class="lbl-data custom-height floating-left text-left"><?= $Lang->FrontCover; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <?php
                                        if (is_file($story_path . "/images/pic.jpg")) {
                                            $frontpic = SITE_URL . $story_path . "/images/pic.jpg";
                                        } else {
                                            $frontpic = SITE_URL . "storyeditor/thems/" . ucfirst($lang_code) . "/images/imagedef.svg";
                                        }
                                        ?>
                                        <img src="<?= $frontpic ?>" id="front-cover" class="default-image floating-left"
                                             style="background-size: contain;background-position: center"/>
                                        <div class="fu-container-a floating-left custom-margin">
                                            <label class="floating-left flaticon-cloud148 label-a"></label>
                                            <label class="floating-left label-b" id="lblimage_txt"></label>
                                            <input onchange="readURL(this,'front-cover');" type="file" name="frontcover"
                                                   id="frontcover">
                                        </div>
                                        <a class="delete-image floating-left custom-margin"></a>
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data custom-height floating-left text-left"><?= $Lang->BackCover; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <?php
                                        if (is_file($story_path . "/images/back.jpg")) {
                                            $frontpic = SITE_URL . $story_path . "/images/back.jpg";
                                        } else {
                                            $frontpic = SITE_URL . "storyeditor/thems/" . $lang_code . "/images/imagedef.svg";
                                        }
                                        ?>
                                        <img src="<?= $frontpic; ?>" id="back-cover" class="default-image floating-left"
                                             style="background-size: contain;background-position: center"/>
                                        <div class="fu-container-a floating-left custom-margin">
                                            <label class="floating-left flaticon-cloud148 label-a"></label>
                                            <label class="floating-left label-b" id="lblimage_txt"></label>
                                            <input onchange="readURL(this,'back-cover');" type="file" name="backcover"
                                                   id="backcover">
                                        </div>
                                        <a class="delete-image floating-left custom-margin"></a>
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data custom-height floating-left text-left"><?= $Lang->Democover; ?></label>
                                    <div class="right-container floating-left text-left">
                                        <?php
                                        if (is_file($story_path . "/images/demo_cover.jpg")) {
                                            $frontpic = SITE_URL . $story_path . "/images/demo_cover.jpg";
                                        } else {
                                            $frontpic = SITE_URL . "storyeditor/thems/" . $lang_code . "/images/imagedef.svg";
                                        }
                                        ?>
                                        <img src="<?= $frontpic; ?>" id="demo-cover" class="default-image floating-left"
                                             style="background-size: contain;background-position: center"/>
                                        <div class="fu-container-a floating-left custom-margin">
                                            <label class="floating-left flaticon-cloud148 label-a"></label>
                                            <label class="floating-left label-b" id="lblimage_txt"></label>
                                            <input onchange="readURL(this,'demo-cover');" type="file" name="democover"
                                                   id="democover">
                                        </div>
                                        <a class="delete-image floating-left custom-margin"></a>
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data floating-left text-left"><?= $Lang->ScreenShoots; ?></label>
                                    <div class="right-container margin-custom-bottom floating-left text-left">
                                        <div class="fu-container-a floating-left custom-margin-5">
                                            <label class="floating-left flaticon-cloud148 label-a"></label>
                                            <label class="floating-left label-b" id="lblimage_txt"></label>
                                            <input type="file" multiple id="screen-shoots-input" name="screenshoots[]">
                                        </div>
                                    </div>
                                    <div class="thumbs-container clear-both">
                                        <nav class="nav">
                                            <ul class="nav-list screen-shoots">
                                                <?php
                                                if (is_dir($story_path . "/images/screenshoots")) {
                                                    foreach (scandir($story_path . "/images/screenshoots/") as $image) {
                                                        if ($image != "." && $image != "..") {
                                                            echo '<div><img src="' . SITE_URL . $story_path . '/images/screenshoots/' . $image . '"/><span class="jq_delete_screenshot" img="' . $image . '" ></span></div>';
                                                        }

                                                    }
                                                } else {
                                                    ?>
                                                    <img src="<?= SITE_URL ?>storyeditor/thems/<?= ucfirst($lang_code); ?>/images/imagedef.svg"/>
                                                    <img src="<?= SITE_URL ?>storyeditor/thems/<?= ucfirst($lang_code); ?>/images/imagedef.svg"/>
                                                    <img src="<?= SITE_URL ?>storyeditor/thems/<?= ucfirst($lang_code); ?>/images/imagedef.svg"/>
                                                    <img src="<?= SITE_URL ?>storyeditor/thems/<?= ucfirst($lang_code); ?>/images/imagedef.svg"/>
                                                    <img src="<?= SITE_URL ?>storyeditor/thems/<?= ucfirst($lang_code); ?>/images/imagedef.svg"/>
                                                    <img src="<?= SITE_URL ?>storyeditor/thems/<?= ucfirst($lang_code); ?>/images/imagedef.svg"/>
                                                    <?php
                                                }
                                                ?>

                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--                    <div class="content-of-tab Cover-Screen-shoots" >-->

                        <!--                        <div class="content-of-half-div floating-left">-->
                        <!--                            <div class="line-row">-->
                        <!--                                <label class="lbl-data floating-left text-left">-->
                        <?php //=$Lang->PaintPicture; ?>
                        <!--</label>-->
                        <!--                                <div class="right-container margin-custom-bottom floating-left text-left">-->
                        <!--                                    <div class="fu-container-a floating-left custom-margin-5">-->
                        <!--                                        <label class="floating-left flaticon-cloud148 label-a"></label>-->
                        <!--                                        <label class="floating-left label-b" id="lblimage_txt"></label>-->
                        <!--                                        <input multiple id="paint-picture-input" type="file" name="paintpictures">-->
                        <!--                                    </div>-->
                        <!--                                    <a class="delete-image floating-left custom-margin-5"></a>-->
                        <!--                                </div>-->
                        <!--                                <div class="thumbs-container clear-both">-->
                        <!--                                    <nav class="nav">-->
                        <!--                                        <ul class="nav-list paint-picture">-->
                        <!--                                            <img src="-->
                        <?php //=SITE_URL?>
                        <!--storyeditor/thems/-->
                        <?php //=ucfirst($lang_code);?>
                        <!--/images/imagedef.svg"/>-->
                        <!--                                            <img src="-->
                        <?php //=SITE_URL?>
                        <!--storyeditor/thems/-->
                        <?php //=ucfirst($lang_code);?>
                        <!--/images/imagedef.svg"/>-->
                        <!--                                            <img src="-->
                        <?php //=SITE_URL?>
                        <!--storyeditor/thems/-->
                        <?php //=ucfirst($lang_code);?>
                        <!--/images/imagedef.svg"/>-->
                        <!--                                            <img src="-->
                        <?php //=SITE_URL?>
                        <!--storyeditor/thems/-->
                        <?php //=ucfirst($lang_code);?>
                        <!--/images/imagedef.svg"/>-->
                        <!--                                            <img src="-->
                        <?php //=SITE_URL?>
                        <!--storyeditor/thems/-->
                        <?php //=ucfirst($lang_code);?>
                        <!--/images/imagedef.svg"/>-->
                        <!--                                            <img src="-->
                        <?php //=SITE_URL?>
                        <!--storyeditor/thems/-->
                        <?php //=ucfirst($lang_code);?>
                        <!--/images/imagedef.svg"/>-->
                        <!--                                        </ul>-->
                        <!--                                    </nav>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                            <div class="line-row">-->
                        <!--                                <label class="lbl-data floating-left text-left">-->
                        <?php //=$Lang->GamesPictures;?>
                        <!--</label>-->
                        <!--                                <div class="right-container margin-custom-bottom floating-left text-left">-->
                        <!--                                    <div class="fu-container-a floating-left custom-margin-5">-->
                        <!--                                        <label class="floating-left flaticon-cloud148 label-a"></label>-->
                        <!--                                        <label class="floating-left label-b" id="lblimage_txt"></label>-->
                        <!--                                        <input multiple id="games-pictures-input" type="file" name="gamespictures">-->
                        <!--                                    </div>-->
                        <!--                                    <a class="delete-image floating-left custom-margin-5"></a>-->
                        <!--                                </div>-->
                        <!--                                <div class="thumbs-container clear-both">-->
                        <!--                                    <nav class="nav">-->
                        <!--                                        <ul class="nav-list games-pictures">-->
                        <!--                                            <img src="-->
                        <?php //=SITE_URL?>
                        <!--storyeditor/thems/-->
                        <?php //=ucfirst($lang_code);?>
                        <!--/images/imagedef.svg"/>-->
                        <!--                                            <img src="-->
                        <?php //=SITE_URL?>
                        <!--storyeditor/thems/-->
                        <?php //=ucfirst($lang_code);?>
                        <!--/images/imagedef.svg"/>-->
                        <!--                                            <img src="-->
                        <?php //=SITE_URL?>
                        <!--storyeditor/thems/-->
                        <?php //=ucfirst($lang_code);?>
                        <!--/images/imagedef.svg"/>-->
                        <!--                                            <img src="-->
                        <?php //=SITE_URL?>
                        <!--storyeditor/thems/-->
                        <?php //=ucfirst($lang_code);?>
                        <!--/images/imagedef.svg"/>-->
                        <!--                                            <img src="-->
                        <?php //=SITE_URL?>
                        <!--storyeditor/thems/-->
                        <?php //=ucfirst($lang_code);?>
                        <!--/images/imagedef.svg"/>-->
                        <!--                                            <img src="-->
                        <?php //=SITE_URL?>
                        <!--storyeditor/thems/-->
                        <?php //=ucfirst($lang_code);?>
                        <!--/images/imagedef.svg"/>-->
                        <!--                                        </ul>-->
                        <!--                                    </nav>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->

                        <!--                        <div class="content-of-half-div floating-right">-->
                        <!--                            <div class="line-row">-->
                        <!--                                <label class="lbl-data floating-left text-left big-width">-->
                        <?php //=$Lang->BackgroundSound; ?>
                        <!--</label>-->
                        <!--                                <div class="right-container">-->
                        <!--                                <div class="radio-container floating-left with-out-width">-->
                        <!--                                    <audio controls="" class="floating-left audio-sound-setting">-->
                        <!--                                        <source src="-->
                        <?php //=$story_path; ?>
                        <!--/sound/bgsound.mp3" type="audio/mpeg">-->
                        <!--                                        <source src="horse.mp3" type="audio/mpeg">-->
                        <!--                                        Your browser does not support the audio element.-->
                        <!--                                    </audio>-->
                        <!--                                    <div class="fu-container-a floating-left">-->
                        <!--                                        <label class="floating-left flaticon-cloud148 label-a"></label>-->
                        <!--                                        <label class="floating-left label-b" id="lblthump_txt"></label>-->
                        <!--                                        <input class="input-file-sound" type="file" name="bgsound" id="bgsound">-->
                        <!--                                    </div>-->
                        <!--                                    <a class="delete-image floating-left"></a>-->
                        <!--                                </div>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                            <div class="line-row custom-margin-0">-->
                        <!--                                <label class="lbl-data floating-left text-left big-width">-->
                        <?php //=$Lang->TitleSound; ?>
                        <!--</label>-->
                        <!--                                <div class="right-container">-->
                        <!--                                    <div class="radio-container floating-left with-out-width">-->
                        <!--                                        <audio controls="" class="floating-left audio-sound-setting">-->
                        <!--                                            <source src="-->
                        <?php //=$story_path; ?>
                        <!--/sound/title.mp3" type="audio/mpeg">-->
                        <!--                                            Your browser does not support the audio element.-->
                        <!--                                        </audio>-->
                        <!--                                        <div class="fu-container-a floating-left">-->
                        <!--                                            <label class="floating-left flaticon-cloud148 label-a"></label>-->
                        <!--                                            <label class="floating-left label-b" id="lblthump_txt"></label>-->
                        <!--                                            <input class="input-file-sound" type="file"  id="title_sound"  name="title_sound">-->
                        <!--                                        </div>-->
                        <!--                                        <a class="delete-image floating-left"></a>-->
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                            <div class="line-row custom-margin-0">-->
                        <!--                                <label class="lbl-data floating-left text-left big-width">-->
                        <?php //=$Lang->KidsAdvice; ?>
                        <!--</label>-->
                        <!--                                <div class="right-container floating-left text-left">-->
                        <!--                                    <textarea class="desc with-custom-margin" name="kidstext" id="kidstext">-->
                        <?php //=$story["kidstext"]; ?>
                        <!--</textarea>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                            <div class="line-row custom-margin-5">-->
                        <!--                                <div class="right-container">-->
                        <!--                                    <div class="radio-container floating-left with-out-width">-->
                        <!--                                    <audio controls="" class="floating-left audio-sound-setting">-->
                        <!--                                        <source src="-->
                        <?php //=$story_path; ?>
                        <!--/sound/kids.mp3" type="audio/mpeg">-->
                        <!--                                        Your browser does not support the audio element.-->
                        <!--                                    </audio>-->
                        <!--                                    <div class="fu-container-a floating-left">-->
                        <!--                                        <label class="floating-left flaticon-cloud148 label-a"></label>-->
                        <!--                                        <label class="floating-left label-b" id="lblthump_txt"></label>-->
                        <!--                                        <input class="input-file-sound"  id="kids_sound" name="kids_sound" type="file">-->
                        <!--                                    </div>-->
                        <!--                                    <a class="delete-image floating-left"></a>-->
                        <!--                                </div>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                            <div class="line-row custom-margin-0">-->
                        <!--                                <label class="lbl-data floating-left text-left big-width">-->
                        <?php //=$Lang->ParentAdvice; ?>
                        <!--</label>-->
                        <!--                                <div class="right-container floating-left text-left">-->
                        <!--                                    <textarea class="desc with-custom-margin" name="parenttext" id="parenttext">-->
                        <?php //=$story["parenttext"]; ?>
                        <!--</textarea>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                            <div class="line-row custom-margin-5">-->
                        <!--                                <div class="right-container">-->
                        <!--                                    <div class="radio-container floating-left with-out-width">-->
                        <!--                                    <audio controls="" class="floating-left audio-sound-setting">-->
                        <!--                                        <source src="-->
                        <?php //=$story_path; ?>
                        <!--/sound/parent.mp3" type="audio/mpeg">-->
                        <!--                                        Your browser does not support the audio element.-->
                        <!--                                    </audio>-->
                        <!--                                    <div class="fu-container-a floating-left">-->
                        <!--                                        <label class="floating-left flaticon-cloud148 label-a"></label>-->
                        <!--                                        <label class="floating-left label-b" id="lblthump_txt"></label>-->
                        <!--                                        <input class="input-file-sound"  name="parent_sound"  id="parent_sound" type="file">-->
                        <!--                                    </div>-->
                        <!--                                    <a class="delete-image floating-left"></a>-->
                        <!--                                </div>-->
                        <!--                                </div>-->
                        <!--                            </div>-->
                        <!--                        </div>-->
                        <!--                    </div>-->
                    </div>
                </form>
            </div>
            <a class="save floating-right" id="save_setting"><label><?= $Lang->Save; ?></label></a>
        </div>
    </div>
    <div class="popup-edit-video-container noclose">
        <div class="edit-video-container">
            <h1><?= $Lang->Edit; ?></h1>
            <a class="close"></a>
            <form id="youtube_form" method="POST" action="" enctype="multipart/form-data" target="upload_target">
                <div class="row-container">
                    <div class="line-row">
                        <div class="point floating-left"></div>
                        <label class="lbl-data-a floating-left"><?= $Lang->URL; ?></label>
                        <input class="txt-a floating-left" type="text" name="youtube" id="youtube" placeholder="URL">
                    </div>
                </div>
                <div class="btn-save-container floating-right" id="update_video">
                    <a class="save"><label><?= $Lang->Save; ?></label></a>
                </div>
            </form>
        </div>
    </div>
    <div class="popup-edit-image-container itemA noclose">
        <div class="edit-image-container">
            <h1><?= $Lang->Editimage; ?></h1>
            <a class="close"></a>
            <form id="image_form" method="post" enctype="multipart/form-data"
                  action="../platform/ajax/storyeditor.php?process=imagewidget" target="hidden_iframe">
                <input type="hidden" class="jq_storypath" name="storypath" value="">
                <input type="hidden" class="jq_widgetid" name="widgetid" value="">
                <div class="line-row">
                    <label class="lbl-data floating-left text-left"><?= $Lang->Image; ?></label>
                    <img src="<?= SITE_URL ?>storyeditor/thems/<?= ucfirst($lang_code); ?>/images/imagedef.svg"
                         id="default-image-widget" class="default-image floating-left"
                         style="background-size: contain;background-position: center"/>
                    <div class="fu-container-a floating-left">
                        <label class="floating-left flaticon-cloud148 label-a"></label>
                        <label class="floating-left label-b" id="lblimage_txt"></label>
                        <input type="file" onchange="readURL(this,'default-image-widget');" name="image_widget">
                    </div>
                </div>
                <a id="update_image_widget" class="save floating-right"><label><?= $Lang->Save; ?></label></a>
            </form>
        </div>
    </div>
    <div class="popup-edit-image-container itemB noclose">
        <div class="edit-image-container">
            <h1><?= $Lang->EditSound; ?></h1>
            <a class="close"></a>
            <form id="audio_form" method="post" enctype="multipart/form-data"
                  action="../platform/ajax/storyeditor.php?process=audiowidget" target="hidden_iframe">
                <input type="hidden" class="jq_storypath" name="storypath" value="">
                <input type="hidden" class="jq_widgetid" name="widgetid" value="">
                <input type="hidden" class="jq_is_splitter" name="splitter" value="0">
                <div class="line-row">
                    <label class="lbl-data floating-left text-left big-width"
                           style="width: 70px"><?= $Lang->Sound; ?></label>
                    <div class="right-container">
                        <div class="radio-container floating-left with-out-width" id="jq_record_cont">
                            <audio controls="" class="floating-left audio-sound-setting">
                                <source src="" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                            <div class="fu-container-a floating-left">
                                <label class="floating-left flaticon-cloud148 label-a"></label>
                                <label class="floating-left label-b" id="lblthump_txt"></label>
                                <input class="input-file-sound" type="file" name="audio_file" id="audio_file">
                            </div>
                            <a class="delete-image floating-left jq_delete_sound"></a>
                            <a class="record-sound floating-left jq_record_sound">
                                <span class="toolbar-button-state recording floating-left"></span><span
                                        class="floating-left stop-word">stop</span><i class="floating-left"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <a id="update_audio_widget" class="save floating-right"><label><?= $Lang->Save; ?></label></a>
        </div>
    </div>
    <div class="popup-edit-image-container itemSymbols noclose">
        <div class="edit-image-container">
            <h1><?= $Lang->Symbols; ?></h1>
            <a class="close"></a>
            <form id="audio_form" method="post" enctype="multipart/form-data"
                  action="../platform/ajax/storyeditor.php?process=audiowidget" target="hidden_iframe">
                <input type="hidden" class="jq_storypath" name="storypath" value="">
                <input type="hidden" class="jq_widgetid" name="widgetid" value="">
                <input type="hidden" class="jq_is_splitter" name="splitter" value="0">
                <div class="line-row" style="margin-top: 0">
                    <div class="symbols-container">
                        <a class="symbols-item floating-left symbol_font active">0</a>
                        <a class="symbols-item floating-left symbol_font">1</a>
                        <a class="symbols-item floating-left symbol_font">2</a>
                        <a class="symbols-item floating-left symbol_font">3</a>
                        <a class="symbols-item floating-left symbol_font">4</a>
                        <a class="symbols-item floating-left symbol_font">5</a>
                        <a class="symbols-item floating-left symbol_font">6</a>
                        <a class="symbols-item floating-left symbol_font">7</a>
                        <a class="symbols-item floating-left symbol_font">8</a>
                        <a class="symbols-item floating-left symbol_font">9</a>
                        <a class="symbols-item floating-left symbol_font">a</a>
                        <a class="symbols-item floating-left symbol_font">b</a>
                        <a class="symbols-item floating-left symbol_font">c</a>
                        <a class="symbols-item floating-left symbol_font">d</a>
                        <a class="symbols-item floating-left symbol_font">e</a>
                        <a class="symbols-item floating-left symbol_font">f</a>
                        <a class="symbols-item floating-left symbol_font">g</a>
                        <a class="symbols-item floating-left symbol_font">h</a>
                        <a class="symbols-item floating-left symbol_font">i</a>
                        <a class="symbols-item floating-left symbol_font">j</a>
                        <a class="symbols-item floating-left symbol_font">k</a>
                        <a class="symbols-item floating-left symbol_font">l</a>
                        <a class="symbols-item floating-left symbol_font">m</a>
                        <a class="symbols-item floating-left symbol_font">n</a>
                        <a class="symbols-item floating-left symbol_font">o</a>
                        <a class="symbols-item floating-left symbol_font">p</a>
                        <a class="symbols-item floating-left symbol_font">q</a>
                        <a class="symbols-item floating-left symbol_font">r</a>
                        <a class="symbols-item floating-left symbol_font">s</a>
                        <a class="symbols-item floating-left symbol_font">t</a>
                        <a class="symbols-item floating-left symbol_font">u</a>
                        <a class="symbols-item floating-left symbol_font">v</a>
                        <a class="symbols-item floating-left symbol_font">w</a>
                        <a class="symbols-item floating-left symbol_font">x</a>
                        <a class="symbols-item floating-left symbol_font">A</a>
                        <a class="symbols-item floating-left symbol_font">B</a>
                        <a class="symbols-item floating-left symbol_font">C</a>
                        <a class="symbols-item floating-left symbol_font">D</a>
                        <a class="symbols-item floating-left symbol_font">E</a>
                        <a class="symbols-item floating-left symbol_font">F</a>
                        <a class="symbols-item floating-left symbol_font">G</a>
                        <a class="symbols-item floating-left symbol_font">H</a>
                        <a class="symbols-item floating-left symbol_font">I</a>
                        <a class="symbols-item floating-left symbol_font">J</a>
                        <a class="symbols-item floating-left symbol_font">K</a>
                        <a class="symbols-item floating-left symbol_font">M</a>
                        <a class="symbols-item floating-left symbol_font">N</a>
                        <a class="symbols-item floating-left symbol_font">O</a>
                        <a class="symbols-item floating-left symbol_font">P</a>
                        <a class="symbols-item floating-left symbol_font">Q</a>
                        <a class="symbols-item floating-left symbol_font">R</a>
                        <a class="symbols-item floating-left symbol_font">S</a>
                    </div>
                    <a id="add_symbol_widget" class="save floating-right"
                       style="display: none"><label><?= $Lang->Save; ?></label></a>
                </div>
            </form>
        </div>
    </div>
    <div class="popup-edit-image-container itemButtons noclose">
        <div class="edit-image-container">
            <h1><?= $Lang->buttons; ?></h1>
            <a class="close"></a>
            <div class="line-row" style="margin-top: 0">
                <div class="buttons-container">
                    <div class="buttons-item floating-left active">
                        <button class="shrink-btn poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="lefttop-btn poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="gradient-btn poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="flat-btn poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="topshadow-btn poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="classic-btn poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="glitch-btn poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="picross-btn poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="pebble-btn poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="round-btn poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left ">
                        <button class="clear-btn poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left ">
                        <button class="clear-btn1 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="clear-btn2 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="clear-btn3 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="clear-btn5 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="clear-btn4 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="clear-btn6 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="clear-btn9 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="clear-btn7 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="clear-btn8 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="clear-btn-border1 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="clear-btn-border2 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left ">
                        <button class="clear-btn-border3 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="clear-btn-border4 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="clear-btn-border5 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left  ">
                        <button class="clear-btn-border6 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="circle1 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="circle2 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="circle3 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="circle4 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="circle5 poplinable"><?= $Lang->Button; ?></button>
                    </div>
                    <div class="buttons-item floating-left">
                        <button class="square_btn39 openBtn poplinable">Button</button>
                    </div>
                </div>
            </div>
            <a id="add_button_widget" style="display: none"
               class="save floating-right"><label><?= $Lang->Save; ?></label></a>
        </div>
    </div>


    <div class="popup-edit-image-container itemBgAnimation noclose">
        <div class="edit-image-container">
            <h1><?= $Lang->bgAnimation; ?></h1>
            <a class="close"></a>
            <div class="line-row" style="margin-top: 0">
                <div class="view-iframe-contntent">
                    <iframe frameborder="0" allowfullscreen
                            src="http://localhost/Manhal/storyeditor/BgAnimation/clouds/index.html?v=9"></iframe>
                </div>
                <div class="buttons-container">
                    <div class="buttons-item floating-left active"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/clouds/index.html?v=<?= $cashr ?>">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/clouds/thumb.png') no-repeat"></div>
                        <button class="poplinable">clouds</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/cloudsin/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/cloudsin/thumb.png') no-repeat"></div>
                        <button class="poplinable">clouds in</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/cloudssolid/index.html?v=<?= $cashr ?>">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/cloudssolid/thumb.png') no-repeat"></div>
                        <button class="poplinable">clouds solid</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/shapes/index.html?v=<?= $cashr ?>">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/shapes/thumb.png') no-repeat"></div>
                        <button class="poplinable">shapes</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/snow/index.html?v=<?= $cashr ?>">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/snow/thumb.png') no-repeat"></div>
                        <button class="poplinable">snow</button>
                    </div>

                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/wip/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/wip/thumb.png') no-repeat"></div>
                        <button class="poplinable">wip</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/snowbig/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/snowbig/thumb.png') no-repeat"></div>
                        <button class="poplinable">snow big</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/birds/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/birds/thumb.png') no-repeat"></div>
                        <button class="poplinable">birds</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/diamondsanimation/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/diamondsanimation/thumb.png') no-repeat"></div>
                        <button class="poplinable">diamonds animation</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/balloons/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/balloons/thumb.png') no-repeat"></div>
                        <button class="poplinable">balloons</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/rainslow/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/rainslow/thumb.png') no-repeat"></div>
                        <button class="poplinable">rain slow</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/rainfast/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/rainfast/thumb.png') no-repeat"></div>
                        <button class="poplinable">rain fast</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/rainfastfit/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/rainfastfit/thumb.png') no-repeat"></div>
                        <button class="poplinable">rain fast fit</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/coloringshapes/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/coloringshapes/thumb.png') no-repeat"></div>
                        <button class="poplinable">coloring shapes</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/fireworks/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/fireworks/thumb.png') no-repeat"></div>
                        <button class="poplinable">fireworks</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/fishy/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/fishy/thumb.png') no-repeat"></div>
                        <button class="poplinable">fishy</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/lightningwip/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/lightningwip/thumb.png') no-repeat"></div>
                        <button class="poplinable">lightning wip</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/butterflies/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/butterflies/thumb.png') no-repeat"></div>
                        <button class="poplinable">butterflies</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/smallbirds/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/smallbirds/thumb.png') no-repeat"></div>
                        <button class="poplinable">small birds</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/solarsystem/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/solarsystem/thumb.png') no-repeat"></div>
                        <button class="poplinable">solar system</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/particle/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/particle/thumb.png') no-repeat"></div>
                        <button class="poplinable">particle</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/floating-dust/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/floating-dust/thumb.png') no-repeat"></div>
                        <button class="poplinable">floating dust</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/parallax-sunset/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/parallax-sunset/thumb.png') no-repeat"></div>
                        <button class="poplinable">parallax sunset</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/fallingconfetti/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/fallingconfetti/thumb.png') no-repeat"></div>
                        <button class="poplinable">falling confetti</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/waves/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/waves/thumb.png') no-repeat"></div>
                        <button class="poplinable">waves</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/bubbles/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/bubbles/thumb.png') no-repeat"></div>
                        <button class="poplinable">bubbles</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/leavesfalling/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/leavesfalling/thumb.png') no-repeat"></div>
                        <button class="poplinable">leaves falling</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/leavesfalling1/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/leavesfalling1/thumb.png') no-repeat"></div>
                        <button class="poplinable">leavesfalling1</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/sunandnight/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/sunandnight/thumb.png') no-repeat"></div>
                        <button class="poplinable">sun and night</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/weekinmotion/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/weekinmotion/thumb.png') no-repeat"></div>
                        <button class="poplinable">week in motion</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/blureeffect/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/blureeffect/thumb.png') no-repeat"></div>
                        <button class="poplinable">blure effect</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/amusementpark/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/amusementpark/thumb.png') no-repeat"></div>
                        <button class="poplinable">amusement park</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/cityillustration/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/cityillustration/thumb.png') no-repeat"></div>
                        <button class="poplinable">city Illustration</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/sityshow/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/sityshow/thumb.png') no-repeat"></div>
                        <button class="poplinable">city show</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/ripplesbackground/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/ripplesbackground/thumb.png') no-repeat"></div>
                        <button class="poplinable">ripples background</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/rectanglesbackground/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/rectanglesbackground/thumb.png') no-repeat"></div>
                        <button class="poplinable">rectangles background</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/colordrops/index.html">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/colordrops/thumb.png') no-repeat"></div>
                        <button class="poplinable">color drops</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/triangletravelers/index.html"
                         style="display: none">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/triangletravelers/thumb.png') no-repeat"></div>
                        <button class="poplinable">triangle travelers</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/delight/index.html" style="display: none">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/delight/thumb.png') no-repeat"></div>
                        <button class="poplinable">delight</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/space1/index.html" style="display: none">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/space1/thumb.png') no-repeat"></div>
                        <button class="poplinable">space 1</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/space2/index.html" style="display: none">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/space2/thumb.png') no-repeat"></div>
                        <button class="poplinable">space 2</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/eveningforest/index.html"
                         style="display: none">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/eveningforest/thumb.png') no-repeat"></div>
                        <button class="poplinable">evening forest</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/coloringbackground/index.html"
                         style="display: none">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/coloringbackground/thumb.png') no-repeat"></div>
                        <button class="poplinable">coloring background</button>
                    </div>
                    <div class="buttons-item floating-left"
                         URLiframes="<?= SITE_URL ?>storyeditor/BgAnimation/floatingheart/index.html"
                         style="display: none">
                        <div class="img-thumb"
                             style="background: url('<?= SITE_URL ?>storyeditor/BgAnimation/floatingheart/thumb.png') no-repeat"></div>
                        <button class="poplinable">floating heart</button>
                    </div>
                </div>
            </div>
            <a id="add_bganimation_widget" class="save floating-right"><label><?= $Lang->Save; ?></label></a>
        </div>
    </div>
    <div class="popup-edit-image-container itemF noclose">
        <div class="edit-image-container jq_sync_div">
            <h1><?= $Lang->EditSound; ?></h1>
            <a class="close"></a>
            <iframe id="sync_iframe" style="width: 95%;height: 95.5%;"></iframe>
        </div>
    </div>
    <div class="popup-edit-image-container itemD noclose">
        <div class="edit-image-container">
            <h1><?= $Lang->Editvideo; ?></h1>
            <a class="close"></a>
            <form id="video_form" method="post" enctype="multipart/form-data"
                  action="../platform/ajax/storyeditor.php?process=videowidget" target="hidden_iframe">
                <input type="hidden" class="jq_storypath" name="storypath" value="">
                <input type="hidden" class="jq_widgetid" name="widgetid" value="">
                <input type="hidden" class="jq_is_splitter" name="splitter" value="0">
                <div class="line-row">
                    <label class="lbl-data floating-left text-left big-width"><?= $Lang->Video; ?></label>
                    <div class="radio-container floating-left with-out-width">
                        <!--                            <video controls="" class="floating-left audio-sound-setting">-->
                        <!--                                <source src="" type="audio/mpeg">-->
                        <!--                                Your browser does not support the audio element.-->
                        <!--                            </video>-->
                        <div class="fu-container-a floating-left">
                            <label class="floating-left flaticon-cloud148 label-a"></label>
                            <label class="floating-left label-b" id="lblthump_txt"></label>
                            <input class="input-file-sound" type="file" name="video_file" id="video_file">
                        </div>
                    </div>
                </div>
                <a id="update_video_widget" class="save floating-right"><label><?= $Lang->Save; ?></label></a>
            </form>
        </div>
    </div>
    <div class="popup-edit-image-container itemE noclose">
        <div class="edit-image-container animations-widget-contnet" style="display: none">
            <h1><?= $Lang->AnimationImage; ?></h1>
            <a class="close"></a>
            <div class="animation-image-container-popup">
                <div class="display-table">
                    <div class="display-row">
                        <div class="display-cell" id="animation_object">
                            <div id="demoImageAnimation" class="animated bounce" data-animation=""
                                 data-animation-timer="" default-animation="bounce"><span class="poplinable"
                                                                                          contenteditable="true">Text</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="animation-bottom-popup">
                    <div class="left-container floating-left">
                        <div class="content-container1" id="animation_container">
                            <a class="line-row-d jq_animation" data-animation-type="default" data-animation="bounce"
                               data-time="1000">
                                <label class="floating-left lbl-data-a">Animation</label>
                                <select class="ddl-animation-action txt-a jq_animation_type floating-left">
                                    <option value="default"><?= $Lang->DefaultSorting; ?></option>
                                    <option value="click">On Click</option>
                                    <option value="timer">Timer</option>
                                </select>
                                <div class="delete-animation"><i class="flaticon-delete96"></i></div>
                            </a>
                        </div>
                    </div>
                    <div class="right-container floating-right">
                        <div class="line-row-d">
                            <label class="floating-left lbl-data-a">Animation Type</label>
                            <select id="animation_action" class="ddl-animation-type txt-c floating-left">
                                <optgroup label="Attention Seekers">
                                    <option value="none">-------</option>
                                    <option value="bounce">bounce</option>
                                    <option value="flash">flash</option>
                                    <option value="pulse">pulse</option>
                                    <option value="rubberBand">rubberBand</option>
                                    <option value="shake">shake</option>
                                    <option value="swing">swing</option>
                                    <option value="tada">tada</option>
                                    <option value="wobble">wobble</option>
                                    <option value="jello">jello</option>
                                    <option value="holeOut">holeOut</option>
                                    <option value="holeOutIn">holeOutIn</option>
                                    <option value="swap">swap</option>
                                    <option value="bigEntrance">bigEntrance</option>
                                    <option value="hatch">hatch</option>
                                    <option value="floating">floating</option>
                                    <option value="tossing">tossing</option>
                                    <option value="menagerie">menagerie</option>
                                </optgroup>
                                <optgroup label="Bouncing Entrances">
                                    <option value="bounceIn">bounceIn</option>
                                    <option value="bounceInDown">bounceInDown</option>
                                    <option value="bounceInLeft">bounceInLeft</option>
                                    <option value="bounceInRight">bounceInRight</option>
                                    <option value="bounceInUp">bounceInUp</option>
                                </optgroup>
                                <optgroup label="Bouncing Exits">
                                    <option value="bounceOut">bounceOut</option>
                                    <option value="bounceOutIn">bounceOutIn</option>
                                    <option value="bounceOutDown">bounceOutDown</option>
                                    <option value="bounceOutDownUp">bounceOutDownUp</option>
                                    <option value="bounceOutLeft">bounceOutLeft</option>
                                    <option value="bounceOutLeftCenter">bounceOutLeftCenter</option>
                                    <option value="bounceOutRight">bounceOutRight</option>
                                    <option value="bounceOutRightCenter">bounceOutRightCenter</option>
                                    <option value="bounceOutUp">bounceOutUp</option>
                                    <option value="bounceOutUpDown">bounceOutUpDown</option>
                                    <option value="bounceToLeftStartFromRight">bounceToLeftStartFromRight</option>
                                    <option value="bounceToRightStartFromleft">bounceToRightStartFromleft</option>
                                    <option value="bounceToTopStartFromBottom">bounceToTopStartFromBottom</option>
                                    <option value="bounceToBottomStartFromTop">bounceToBottomStartFromTop</option>
                                </optgroup>
                                <optgroup label="Fading Entrances">
                                    <option value="fadeIn">fadeIn</option>
                                    <option value="fadeInDown">fadeInDown</option>
                                    <option value="fadeInDownBig">fadeInDownBig</option>
                                    <option value="fadeInLeft">fadeInLeft</option>
                                    <option value="fadeInLeftBig">fadeInLeftBig</option>
                                    <option value="fadeInRight">fadeInRight</option>
                                    <option value="fadeInRightBig">fadeInRightBig</option>
                                    <option value="fadeInUp">fadeInUp</option>
                                    <option value="fadeInUpBig">fadeInUpBig</option>
                                </optgroup>
                                <optgroup label="Fading Exits">
                                    <option value="fadeOut">fadeOut</option>
                                    <option value="fadeOutDown">fadeOutDown</option>
                                    <option value="fadeOutDownUp">fadeOutDownUp</option>
                                    <option value="fadeOutDownBig">fadeOutDownBig</option>
                                    <option value="fadeOutDownUpBig">fadeOutDownUpBig</option>
                                    <option value="fadeOutLeft">fadeOutLeft</option>
                                    <option value="fadeOutLeftRight">fadeOutLeftRight</option>
                                    <option value="fadeOutLeftBig">fadeOutLeftBig</option>
                                    <option value="fadeOutLeftRightBig">fadeOutLeftRightBig</option>
                                    <option value="fadeOutRight">fadeOutRight</option>
                                    <option value="fadeOutRightLeft">fadeOutRightLeft</option>
                                    <option value="fadeOutRightBig">fadeOutRightBig</option>
                                    <option value="fadeOutRightLeftBig">fadeOutRightLeftBig</option>
                                    <option value="fadeOutUp">fadeOutUp</option>
                                    <option value="fadeOutUpDown">fadeOutUpDown</option>
                                    <option value="fadeOutUpBig">fadeOutUpBig</option>
                                    <option value="fadeOutUpDownBig">fadeOutUpDownBig</option>
                                </optgroup>
                                <optgroup label="Flippers">
                                    <option value="flip">flip</option>
                                    <option value="flipInX">flipInX</option>
                                    <option value="flipInY">flipInY</option>
                                    <option value="flipOutX">flipOutX</option>
                                    <option value="flipOutInX">flipOutInX</option>
                                    <option value="flipOutY">flipOutY</option>
                                </optgroup>
                                <optgroup label="open">
                                    <option value="openDownLeft">openDownLeft</option>
                                    <option value="openUpLeft">openUpLeft</option>
                                    <option value="openDownRight">openDownRight</option>
                                    <option value="openUpLeft">openUpLeft</option>
                                    <option value="openUpRight">openUpRight</option>
                                    <option value="openDownLeftRetourn">openDownLeftRetourn</option>
                                    <option value="openDownRightRetourn">openDownRightRetourn</option>
                                    <option value="openUpLeftRetourn">openUpLeftRetourn</option>
                                    <option value="openUpRightRetourn">openUpRightRetourn</option>
                                    <option value="openDownLeftOut">openDownLeftOut</option>
                                    <option value="openDownRightOut">openDownRightOut</option>
                                    <option value="openUpLeftOut">openUpLeftOut</option>
                                    <option value="openUpRightOut">openUpRightOut</option>
                                </optgroup>
                                <optgroup label="Lightspeed">
                                    <option value="lightSpeedIn">lightSpeedIn</option>
                                    <option value="lightSpeedOut">lightSpeedOut</option>
                                    <option value="lightSpeedOutIn">lightSpeedOutIn</option>
                                </optgroup>
                                <optgroup label="puff">
                                    <option value="puffIn">puffIn</option>
                                    <option value="puffOut">puffOut</option>
                                    <option value="puffOutIn">puffOutIn</option>
                                </optgroup>
                                <optgroup label="expand">
                                    <option value="expandUp">expandUp</option>
                                    <option value="expandOpen">expandOpen</option>
                                </optgroup>
                                <optgroup label="twister">
                                    <option value="twisterInDown">twisterInDown</option>
                                    <option value="twisterInUp">twisterInUp</option>
                                </optgroup>
                                <optgroup label="vanish">
                                    <option value="vanishIn">vanishIn</option>
                                    <option value="vanishOut">vanishOut</option>
                                    <option value="vanishOutIn">vanishOutIn</option>
                                </optgroup>
                                <optgroup label="swash">
                                    <option value="swashOut">swashOut</option>
                                    <option value="swashOutIn">swashOutIn</option>
                                    <option value="swashIn">swashIn</option>
                                </optgroup>
                                <optgroup label="bomb">
                                    <option value="bombRightOut">bombRightOut</option>
                                    <option value="bombRightOutIn">bombRightOutIn</option>
                                    <option value="bombLeftOut">bombLeftOut</option>
                                    <option value="bombLeftOutIn">bombLeftOutIn</option>
                                </optgroup>
                                <optgroup label="boing">
                                    <option value="boingInUp">boingInUp</option>
                                    <option value="boingOutDown">boingOutDown</option>
                                    <option value="boingOutInDown">boingOutInDown</option>
                                </optgroup>
                                <optgroup label="pull">
                                    <option value="pullUp">pullUp</option>
                                    <option value="pullDown">pullDown</option>
                                </optgroup>
                                <optgroup label="stretch">
                                    <option value="stretchLeft">stretchLeft</option>
                                    <option value="stretchRight">stretchRight</option>
                                </optgroup>
                                <optgroup label="Rotating Entrances">
                                    <option value="rotateIn">rotateIn</option>
                                    <option value="rotateFullWithOclock">rotateFullWithOclock</option>
                                    <option value="rotateFullreverceOclock">rotateFullreverceOclock</option>
                                    <option value="rotateFullWithOclockAlternate">rotateFullWithOclockAlternate</option>
                                    <option value="rotateFullreverceOclockAlternate">rotateFullreverceOclockAlternate
                                    </option>
                                    <option value="rotateInDownLeft">rotateInDownLeft</option>
                                    <option value="rotateInDownRight">rotateInDownRight</option>
                                    <option value="rotateInUpLeft">rotateInUpLeft</option>
                                    <option value="rotateInUpRight">rotateInUpRight</option>
                                    <option value="rotateDown">rotateDown</option>
                                    <option value="rotateDownUp">rotateDownUp</option>
                                    <option value="rotateLeft">rotateLeft</option>
                                    <option value="rotateLeftRight">rotateLeftRight</option>
                                    <option value="rotateRight">rotateRight</option>
                                    <option value="rotateRightLeft">rotateRightLeft</option>
                                    <option value="rotateUp">rotateUp</option>
                                    <option value="rotateUpDown">rotateUpDown</option>
                                </optgroup>
                                <optgroup label="Rotating Exits">
                                    <option value="rotateOut">rotateOut</option>
                                    <option value="rotateOutDownLeft">rotateOutDownLeft</option>
                                    <option value="rotateOutDownRight">rotateOutDownRight</option>
                                    <option value="rotateOutUpLeft">rotateOutUpLeft</option>
                                    <option value="rotateOutUpRight">rotateOutUpRight</option>
                                </optgroup>
                                <optgroup label="Sliding Entrances">
                                    <option value="slideInUp">slideInUp</option>
                                    <option value="slideInDown">slideInDown</option>
                                    <option value="slideInLeft">slideInLeft</option>
                                    <option value="slideInRight">slideInRight</option>
                                    <option value="slideDown">slideDown</option>
                                    <option value="slideDownUp">slideDownUp</option>
                                    <option value="slideLeft">slideLeft</option>
                                    <option value="slideLeftRight">slideLeftRight</option>
                                    <option value="slideRight">slideRight</option>
                                    <option value="slideRightLeft">slideRightLeft</option>
                                    <option value="slideUp">slideUp</option>
                                    <option value="slideUpDown">slideUpDown</option>
                                    <option value="slideLeftRetourn">slideLeftRetourn</option>
                                    <option value="slideRightRetourn">slideRightRetourn</option>
                                    <option value="slideUpRetourn">slideUpRetourn</option>
                                    <option value="slideExpandUp">slideExpandUp</option>
                                </optgroup>
                                <optgroup label="Sliding Exits">
                                    <option value="slideOutUp">slideOutUp</option>
                                    <option value="slideOutDown">slideOutDown</option>
                                    <option value="slideOutLeft">slideOutLeft</option>
                                    <option value="slideOutRight">slideOutRight</option>
                                </optgroup>
                                <optgroup label="Zoom Entrances">
                                    <option value="zoomIn">zoomIn</option>
                                    <option value="zoomInDown">zoomInDown</option>
                                    <option value="zoomInLeft">zoomInLeft</option>
                                    <option value="zoomInRight">zoomInRight</option>
                                    <option value="zoomInUp">zoomInUp</option>
                                </optgroup>
                                <optgroup label="perspective">
                                    <option value="perspectiveDown">perspectiveDown</option>
                                    <option value="perspectiveDownUp">perspectiveDownUp</option>
                                    <option value="perspectiveLeft">perspectiveLeft</option>
                                    <option value="perspectiveLeftRight">perspectiveLeftRight</option>
                                    <option value="perspectiveRight">perspectiveRight</option>
                                    <option value="perspectiveRightLeft">perspectiveRightLeft</option>
                                    <option value="perspectiveUp">perspectiveUp</option>
                                    <option value="perspectiveUpDown">perspectiveUpDown</option>
                                    <option value="perspectiveDownRetourn">perspectiveDownRetourn</option>
                                    <option value="perspectiveLeftRetourn">perspectiveLeftRetourn</option>
                                    <option value="perspectiveRightRetourn">perspectiveRightRetourn</option>
                                    <option value="perspectiveUpRetourn">perspectiveUpRetourn</option>
                                </optgroup>
                                <optgroup label="space">
                                    <option value="spaceOutUp">spaceOutUp</option>
                                    <option value="spaceOutUpDown">spaceOutUpDown</option>
                                    <option value="spaceOutRight">spaceOutRight</option>
                                    <option value="spaceOutRightLeft">spaceOutRightLeft</option>
                                    <option value="spaceOutDown">spaceOutDown</option>
                                    <option value="spaceOutDownUp">spaceOutDownUp</option>
                                    <option value="spaceOutLeft">spaceOutLeft</option>
                                    <option value="spaceOutLeftRight">spaceOutLeftRight</option>
                                    <option value="spaceInUp">spaceInUp</option>
                                    <option value="spaceInRight">spaceInRight</option>
                                    <option value="spaceInDown">spaceInDown</option>
                                    <option value="spaceInLeft">spaceInLeft</option>
                                </optgroup>
                                <optgroup label="tin">
                                    <option value="tinRightOut">tinRightOut</option>
                                    <option value="tinLeftOut">tinLeftOut</option>
                                    <option value="tinUpOut">tinUpOut</option>
                                    <option value="tinDownOut">tinDownOut</option>
                                    <option value="tinRightIn">tinRightIn</option>
                                    <option value="tinLeftIn">tinLeftIn</option>
                                    <option value="tinUpIn">tinUpIn</option>
                                    <option value="tinDownIn">tinDownIn</option>
                                </optgroup>
                                <optgroup label="Zoom Exits">
                                    <option value="zoomOut">zoomOut</option>
                                    <option value="zoomOutIn">zoomOutIn</option>
                                    <option value="zoomOutDown">zoomOutDown</option>
                                    <option value="zoomOutLeft">zoomOutLeft</option>
                                    <option value="zoomOutRight">zoomOutRight</option>
                                    <option value="zoomOutUp">zoomOutUp</option>
                                </optgroup>
                                <optgroup label="Specials">
                                    <option value="hinge">hinge</option>
                                    <option value="rollIn">rollIn</option>
                                    <option value="rollOut">rollOut</option>
                                    <option value="rollOutIn">rollOutIn</option>
                                    <option value="magic">magic</option>
                                    <option value="magicUp">magicUp</option>
                                </optgroup>
                                <optgroup label="shake">
                                    <option value="shake">shake</option>
                                    <option value="shake-little">shake-little</option>
                                    <option value="shake-slow">shake-slow</option>
                                    <option value="shake-horizontal">shake-horizontal</option>
                                    <option value="shake-vertical">shake-vertical</option>
                                    <option value="shake-crazy">shake-crazy</option>
                                    <option value="shake-hard">shake-hard</option>
                                    <option value="shake-rotate">shake-rotate</option>
                                    <option value="shake-opacity">shake-opacity</option>
                                    <option value="shake-chunk">shake-chunk</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="line-row-d" style="display: none;" id="jq_timer">
                            <label class="lbl-data-a floating-left">Time</label>
                            <input type="number" placeholder="Time" value="1000" class="txt-a number floating-left"
                                   id="animation_time">
                        </div>
                        <div class="line-row-d">
                            <label class="lbl-data-a floating-left" for="isindex">Infinite</label>
                            <div class="section-check floating-left">
                                <ul>
                                    <li class="floating-left">
                                        <label class="input-control checkbox floating-left">
                                            <input type="checkbox" name="infinite" id="infinite" value="0">
                                            <span class="check"></span>
                                        </label>
                                        <label for="infinite" class="text floating-left"></label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="display-inline-block floating-right w-50">
                    <a class="floating-right update-animation-btn save" id="update_animation"><?= $Lang->Save; ?></a>
                </div>
                <div class="display-inline-block floating-right w-50">
                    <a class="add-animation-btn floating-right"><?= $Lang->Add; ?></a>
                </div>
            </div>
        </div>
    </div>


    <div class="popup-edit-image-container item_popup_animation noclose">
        <div class="edit-image-container" style="display: none">
            <h1><?= $Lang->Animation; ?></h1>
            <a class="close"></a>

            <div class="animation-image-container-popupnew">
                <ul class="slider-content-animation floating-left"></ul>
                <div class="right-slider-content">
                    <div class="line-row-animation jq_Show_Effect add-opacity">
                        <label class="ddl-label-content floating-left"><?= $Lang->ShowEffect; ?></label>
                        <div class="show-effect-content floating-left"></div>
                    </div>
                    <div class="line-row-animation">
                        <label class="ddl-label-content floating-left"><?= $Lang->Start; ?></label>
                        <select class="floating-left jq_animation_action">
                            <option value="OnClick"><?= $Lang->ClickorTab; ?></option>
                            <option value="WithPrevious"><?= $Lang->WithPrevious; ?></option>
                            <option value="AfterPrevious"><?= $Lang->AfterPrevious; ?></option>
                            <option value="Timer"><?= $Lang->Timer; ?></option>
                            <option value="ONShow"><?= $Lang->ONShow; ?></option>
                            <option value="without"><?= $Lang->without; ?></option>
                        </select>
                    </div>
                    <div class="line-row-animation">
                        <label class="ddl-label-content floating-left"><?= $Lang->Duration; ?></label>
                        <input type="text" value="0:0"/>
                    </div>
                    <div class="line-row-animation jq_timer_input" style="display: none">
                        <label class="ddl-label-content floating-left"><?= $Lang->Time; ?></label>
                        <input type="text" value="0:0"/>
                    </div>
                    <div class="line-row-animation">
                        <a class="save floating-right"><?= $Lang->Save; ?></a>
                    </div>
                </div>
            </div>
            <div class="animation-image-container-popup stage-content floating-left">
                <div class="display-table">
                    <div class="display-row">
                        <div class="display-cell" id="animation_object">
                            <div id="demoImageAnimation1" class="animated bounce" data-animation=""
                                 data-animation-timer="" default-animation="bounce"><span class="poplinable"
                                                                                          contenteditable="true">Text</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="animation-pane-container floating-left">
                <div class="header">
                    <div><?= $Lang->AnimationPane; ?><a class="add-animation"></a></div>
                </div>
                <div class="row-controls">
                    <a class="play-animation floating-left"><?= $Lang->play; ?></a>
                    <div class="navigation-animation floating-right">
                        <a class="arrow-down floating-right"></a>
                        <a class="arrow-up floating-right disabled"></a>
                    </div>
                </div>
                <ul class="row-animation-items jq_row_animation_items">
                    <li class="selected"><span class="floating-left">#1</span>
                        <div class="animation-img floating-left"
                             style="background-image:url(http://localhost/Manhal/storyeditor/thems/En/images/duplicate.svg)"></div>
                        <label class="floating-left">Animation Name</label><a
                                class="delete-row-animation floating-right"></a></li>
                    <li><span class="floating-left">#2</span>
                        <div class="animation-img floating-left"
                             style="background-image:url(http://localhost/Manhal/storyeditor/thems/En/images/duplicate.svg)"></div>
                        <label class="floating-left">Animation Name</label><a
                                class="delete-row-animation floating-right"></a></li>
                    <li><span class="floating-left">#3</span>
                        <div class="animation-img floating-left"
                             style="background-image:url(http://localhost/Manhal/storyeditor/thems/En/images/duplicate.svg)"></div>
                        <label class="floating-left">Animation Name</label><a
                                class="delete-row-animation floating-right"></a></li>
                    <li><span class="floating-left">#4</span>
                        <div class="animation-img floating-left"
                             style="background-image:url(http://localhost/Manhal/storyeditor/thems/En/images/duplicate.svg)"></div>
                        <label class="floating-left">Animation Name</label><a
                                class="delete-row-animation floating-right"></a></li>
                    <li><span class="floating-left">#5</span>
                        <div class="animation-img floating-left"
                             style="background-image:url(http://localhost/Manhal/storyeditor/thems/En/images/duplicate.svg)"></div>
                        <label class="floating-left">Animation Name</label><a
                                class="delete-row-animation floating-right"></a></li>
                    <li><span class="floating-left">#6</span>
                        <div class="animation-img floating-left"
                             style="background-image:url(http://localhost/Manhal/storyeditor/thems/En/images/duplicate.svg)"></div>
                        <label class="floating-left">Animation Name</label><a
                                class="delete-row-animation floating-right"></a></li>
                    <li><span class="floating-left">#7</span>
                        <div class="animation-img floating-left"
                             style="background-image:url(http://localhost/Manhal/storyeditor/thems/En/images/duplicate.svg)"></div>
                        <label class="floating-left">Animation Name</label><a
                                class="delete-row-animation floating-right"></a></li>
                    <li><span class="floating-left">#8</span>
                        <div class="animation-img floating-left"
                             style="background-image:url(http://localhost/Manhal/storyeditor/thems/En/images/duplicate.svg)"></div>
                        <label class="floating-left">Animation Name</label><a
                                class="delete-row-animation floating-right"></a></li>
                    <li><span class="floating-left">#9</span>
                        <div class="animation-img floating-left"
                             style="background-image:url(http://localhost/Manhal/storyeditor/thems/En/images/duplicate.svg)"></div>
                        <label class="floating-left">Animation Name</label><a
                                class="delete-row-animation floating-right"></a></li>
                    <li><span class="floating-left">#10</span>
                        <div class="animation-img floating-left"
                             style="background-image:url(http://localhost/Manhal/storyeditor/thems/En/images/duplicate.svg)"></div>
                        <label class="floating-left">Animation Name</label><a
                                class="delete-row-animation floating-right"></a></li>
                    <li><span class="floating-left">#11</span>
                        <div class="animation-img floating-left"
                             style="background-image:url(http://localhost/Manhal/storyeditor/thems/En/images/duplicate.svg)"></div>
                        <label class="floating-left">Animation Name</label><a
                                class="delete-row-animation floating-right"></a></li>
                    <li><span class="floating-left">#12</span>
                        <div class="animation-img floating-left"
                             style="background-image:url(http://localhost/Manhal/storyeditor/thems/En/images/duplicate.svg)"></div>
                        <label class="floating-left">Animation Name</label><a
                                class="delete-row-animation floating-right"></a></li>
                    <li><span class="floating-left">#13</span>
                        <div class="animation-img floating-left"
                             style="background-image:url(http://localhost/Manhal/storyeditor/thems/En/images/duplicate.svg)"></div>
                        <label class="floating-left">Animation Name</label><a
                                class="delete-row-animation floating-right"></a></li>
                    <li><span class="floating-left">#14</span>
                        <div class="animation-img floating-left"
                             style="background-image:url(http://localhost/Manhal/storyeditor/thems/En/images/duplicate.svg)"></div>
                        <label class="floating-left">Animation Name</label><a
                                class="delete-row-animation floating-right"></a></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="popup-export-content noclose">
        <ul>
            <li><a class="pdf"><i class="floating-left"></i><label
                            class="floating-left"><?= $Lang->ImportfromPDF; ?></label></a></li>
            <li><a class="import-epub"><i class="floating-left"></i><label
                            class="floating-left"><?= $Lang->ImportfromePUB; ?></label></a></li>
            <li><a class="export-epub"><i class="floating-left"></i><label
                            class="floating-left"><?= $Lang->ExportfromePUB; ?></label></a></li>
        </ul>
    </div>

    <div class="popup-edit-image-container itemC fontsize noclose">
        <div class="edit-image-container">
            <h1><?= $Lang->Edit; ?></h1>
            <a class="close"></a>
            <!--            <form id="audio_form" method="post" enctype="multipart/form-data" action="../platform/ajax/storyeditor.php?process=audiowidget" target="hidden_iframe">-->
            <div class="line-row">
                <label class="lbl-data floating-left text-left big-width"><?= $Lang->Fontfamily; ?></label>
                <div class="right-container floating-left text-left range">
                    <div class="radio-container floating-left">
                        <input class="floating-left Jq_font-family" checked="checked" id="Open" fonttype="OpenSans"
                               name="font_family" type="radio">
                        <label class="floating-left" for="Open">Open-Sans</label>
                    </div>
                    <div class="radio-container floating-left">
                        <input class="floating-left Jq_font-family" id="Amiri" name="font_family" fonttype="Amiri"
                               type="radio">
                        <label class="floating-left" for="Amiri">Amiri</label>
                    </div>
                    <div class="radio-container floating-left">
                        <input class="floating-left Jq_font-family" id="Kufi" name="font_family"
                               fonttype="Droid Arabic Kufi" type="radio">
                        <label class="floating-left" for="Kufi">Kufi</label>
                    </div>
                    <div class="radio-container floating-left">
                        <input class="floating-left Jq_font-family" id="Naskh" name="font_family"
                               fonttype="Droid Arabic Naskh" type="radio">
                        <label class="floating-left" for="Naskh">Naskh</label>
                    </div>
                    <div class="radio-container floating-left">
                        <input class="floating-left Jq_font-family" id="Lateef" name="font_family" fonttype="Lateef"
                               type="radio">
                        <label class="floating-left" for="Lateef">Lateef</label>
                    </div>
                    <div class="radio-container floating-left">
                        <input class="floating-left Jq_font-family" id="Scheherazade" name="font_family"
                               fonttype="Scheherazade" type="radio">
                        <label class="floating-left" for="Scheherazade">Scheherazade</label>
                    </div>
                    <div class="radio-container floating-left">
                        <input class="floating-left Jq_font-family" id="Thabit" name="font_family" fonttype="Thabit"
                               type="radio">
                        <label class="floating-left" for="Thabit">Thabit</label>
                    </div>
                    <div class="radio-container floating-left" style="display: none">
                        <input class="floating-left Jq_font-family" id="Ruqaa" name="font_family" fonttype=""
                               type="radio">
                        <label class="floating-left" for="Ruqaa">Ruqaa</label>
                    </div>

                </div>
            </div>
            <div class="line-row">
                <label class="lbl-data floating-left text-left big-width"><?= $Lang->FontSize; ?></label>
                <div class="right-container floating-left text-left range">
                    <input type="range" min="0" max="300" step="1" name="title" id="font_size"
                           placeholder="<?= $Lang->FontSize; ?>" value="15">
                    <input type="text" id="font-val" style="width: 50px;height: 30px" value="15">
                </div>
            </div>
            <div class="line-row">
                <label class="lbl-data floating-left text-left big-width"><?= $Lang->lineHeight; ?></label>
                <div class="right-container floating-left text-left range">
                    <input type="range" min="1" max="300" step="1" name="title" id="line_height"
                           placeholder="<?= $Lang->lineHeight; ?>" value="15">
                    <input type="text" id="line-height-val" style="width: 50px;height: 30px" value="1">
                </div>
            </div>

            <a id="update_fontsize_widget" class="save floating-right"><label><?= $Lang->Save; ?></label></a>
            <!--            </form>-->
        </div>
    </div>


    <header>
        <div class="editor-logo floating-left"></div>
        <div class="editor-title floating-left">
            <label class="floating-left"><?= $Lang->Title; ?> :</label><label class="floating-left"
                                                                              id="quiz_top_title"><?= $story["title"]; ?></label>
        </div>
        <div class="options-icons floating-right">
            <a class="floating-left export tooltip1 noclose" style="display: none;"></a>
            <a class="floating-left ruler-icon tooltip1"><i></i></a>
            <a class="floating-left settings tooltip1" data-balloon-length="medium" data-balloon-pos="down"
               data-balloon="<?= $Lang->helpSettingstory; ?>"></a>
            <a title="<?= $Lang->Save; ?>" class="floating-left save jq_topsave"></a>
            <?php
            if (!isset($story["language"]) || $story["language"] == "" || $story["language"] == null) {
                $story["language"] = "en";
            }

            ?>
            <a title="<?= $Lang->Preview; ?>" class="floating-left view" id="topview" target="_blank"
               href="<?= SITE_URL; ?><?= $story["language"]; ?>/story/<?= $story["storyid"]; ?>/<?= $story["title"]; ?>"></a>
            <a title="<?= $Lang->Exit; ?>" class="floating-left exit"
               href="<?= SITE_URL . $lang_code . "/mystories"; ?>"><i></i></a>
        </div>
    </header>
    <div class="editor-main-menu-container">
        <div class="nav floating-left">
            <a id="Page_menu" class="noclose tooltip1" data-balloon-pos="<?= $right; ?>"
               data-balloon="<?= $Lang->helpDragstory; ?>"></a>
            <a id="layers_manu" class="noclose"></a>
            <!--            <a id="buttons_manu" class="noclose"></a>-->
            <a id="fix_font" class="noclose" style="display: none"></a>
            <a id="fix_sound" class="noclose"></a>
            <a class="tutorial-icon noclose" data-balloon-pos="<?= $right; ?>"
               data-balloon="<?= $Lang->helptutorial; ?>"></a>
        </div>
        <div class="nav-content noclose" id="page-content" style="display: none">
            <div class="header">
                <a class="floating-left title"><?= $Lang->Draganddrop; ?></a>
                <a class="floating-right close-menu"><i class="flaticon-x"></i></a>
            </div>
            <div class="content">
                <div class="row floating-left draggable-w" id="text">
                    <a class="floating-left icon text"> <i class="flaticon-pages"></i></a>
                    <a class="floating-left title"><?= $Lang->Text; ?></a>
                </div>
                <div class="row floating-left draggable-w" id="youtube" style="display:none;">
                    <a class="floating-left icon video"><i class="flaticon-document26"></i></a>
                    <a class="floating-left title"><?= $Lang->youtube; ?></a>
                </div>
                <div class="row floating-left draggable-w" id="sound">
                    <a class="floating-left icon sound"><i class="flaticon-fon"></i></a>
                    <a class="floating-left title"><?= $Lang->sound; ?></a>
                </div>
                <div class="row floating-left draggable-w" id="video">
                    <a class="floating-left icon video"><i class="flaticon-fon"></i></a>
                    <a class="floating-left title"><?= $Lang->video; ?></a>
                </div>
                <div class="row floating-left draggable-w" id="image">
                    <a class="floating-left icon image"><i class="flaticon-gear39"></i></a>
                    <a class="floating-left title"><?= $Lang->Image; ?></a>
                </div>
                <div class="row floating-left draggable-w" id="DoyouKnow">
                    <a class="floating-left icon info"><i class="flaticon-gear39"></i></a>
                    <a class="floating-left title"><?= $Lang->DoyouKnow; ?></a>
                </div>
                <div class="row floating-left draggable-w" id="Iframe">
                    <a class="floating-left icon iframe"><i class="flaticon-gear39"></i></a>
                    <a class="floating-left title"><?= $Lang->Iframe; ?></a>
                </div>
                <div class="row floating-left draggable-w" id="LeftBallon">
                    <a class="floating-left icon left-ballon"><i class="flaticon-gear39"></i></a>
                    <a class="floating-left title"><?= $Lang->LeftBallon; ?></a>
                </div>
                <div class="row floating-left draggable-w" id="RightBallon">
                    <a class="floating-left icon right-ballon"><i class="flaticon-gear39"></i></a>
                    <a class="floating-left title"><?= $Lang->RightBallon; ?></a>
                </div>
                <div class="row floating-left draggable-w" id="Symbols">
                    <a class="floating-left icon Symbols"><i class="flaticon-gear39"></i></a>
                    <a class="floating-left title"><?= $Lang->Symbols; ?></a>
                </div>
                <div class="row floating-left draggable-w" id="Buttons_drag">
                    <a class="floating-left icon buttons"><i class="flaticon-gear39"></i></a>
                    <a class="floating-left title"><?= $Lang->buttons; ?></a>
                </div>
                <div class="row floating-left draggable-w" id="record_drag">
                    <a class="floating-left icon recordings"><i class="flaticon-gear39"></i></a>
                    <a class="floating-left title"><?= $Lang->voiceRecorder; ?></a>
                </div>
                <div class="row floating-left draggable-w" id="bganimation_drag" style="display: !important;">
                    <a class="floating-left icon buttons bganimation_drag"><i class="flaticon-gear39"></i></a>
                    <a class="floating-left title"><?= $Lang->bgAnimation; ?></a>
                </div>
            </div>
        </div>
        <div class="nav-content noclose" id="page-content-layers" style="display: none">
            <div class="header">
                <a class="floating-left title"><?= $Lang->Layers; ?></a>
                <a class="floating-right close-menu"><i class="flaticon-x"></i></a>
            </div>
            <div class="content">
                <div class="content layers">
                    <div class="row-layer active">
                        <a class="floating-left checkbox">
                            <input type="checkbox" class="jq_layer" checked="checked">
                        </a>
                        <a class="floating-left title">الدَّرْسُ الْحادي وَالْعِشْـرون</a>
                    </div>
                    <div class="row-layer">
                        <a class="floating-left checkbox">
                            <input type="checkbox" class="jq_layer" checked="checked">
                        </a>
                        <a class="floating-left title">الدَّرْسُ الْحادي وَالْعِشْـرون</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-content noclose" id="action-content" style="display: none">
            <div class="content contentB">
                <a class="floating-left title-a"><?= $Lang->CorrectFeedBack; ?></a>
                <textarea type="text" class="input-incorect" id="correctfeedback"
                          placeholder="<?= $Lang->correctqfeedback; ?>"></textarea>
                <a class="floating-left title-a"><?= $Lang->InCorrectFeedBack; ?></a>
                <textarea type="text" class="input-incorect" id="incorrectfeedback"
                          placeholder="<?= $Lang->incorrectqfeedback; ?>"></textarea>
                <div class="correct-point">
                    <div class="line-row">
                        <label class="floating-left"><?= $Lang->Correctpoint; ?></label>
                        <input class="floating-left" id="correctpoints" type="number" min="0" value="10"
                               placeholder="10">
                    </div>
                    <div class="line-row" style="display: none">
                        <label class="floating-left"><?= $Lang->Incorrectpoint; ?></label>
                        <input class="floating-left" id="incorrectpoints" type="number" min="0">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="action-main-menu-container right-menu" style="display: ;">
        <div class="nav floating-left">
            <a id="action_menu" class="noclose tooltip1 active" data-balloon-pos="<?= left; ?>"
               data-balloon="<?= $Lang->Action; ?>"></a>
        </div>
        <div class="nav-content" id="action-content-href">
            <div class="header">
                <a class="floating-left title"><i class="action-icon floating-left"></i><label
                            class="floating-left"><?= $Lang->addinginteractionstoyourstory; ?></label></a>
                <a class="add-action"></a>
            </div>
            <div class="content">
                <ul class="accordion jq_interaction_container">
                    <li class="accordion-item is-active ">
                        <h3 class="accordion-thumb"><label class="floating-left"><?= $Lang->Action; ?></label><span
                                    class="floating-left jq_li_no"> #1</span>
                            <div class="delecte_action floating-right"></div>
                            <div class="doublcate_action floating-right"></div>
                            <div class="openclose floating-right"></div>
                        </h3>
                        <div class="accordion-panel">
                            <div class="row-input jq_OnAction">
                                <label class="floating-left "><?= $Lang->On; ?></label>
                                <select class="floating-left jq_actionon">
                                    <option value="click"><?= $Lang->ClickorTab; ?></option>
                                    <option value="doubleclick"><?= $Lang->DoubleClick; ?></option>
                                    <option value="mouseover"><?= $Lang->MouseOver; ?></option>
                                    <option value="startanimate"><?= $Lang->StartAnimation; ?></option>
                                    <option value="endanimate"><?= $Lang->EndAnimation; ?></option>
                                </select>
                            </div>
                            <div class="row-input jq_doAction" style="">
                                <label class="floating-left"><?= $Lang->Do; ?></label>
                                <select class="floating-left jq_action_do">
                                    <option style="opacity: 0.5;"><?= $Lang->SelectAction; ?></option>
                                    <option value="Goto_Specific_Page"><?= $Lang->GotoSpecificPage; ?></option>
                                    <option value="Open_popup"><?= $Lang->Openpopup; ?></option>
                                    <option value="Goto_URL"><?= $Lang->GotoURL; ?></option>
                                    <option value="Goto_Next_Page"><?= $Lang->GotoNextPage; ?></option>
                                    <option value="Goto_Previous_Page"><?= $Lang->GotoPreviousPage; ?></option>
                                    <option value="Play_Object"><?= $Lang->PlayObject; ?></option>
                                    <option value="ِAnimate_Object"><?= $Lang->AnimateObject; ?></option>
                                    <option value="Show_Object"><?= $Lang->ShowObject; ?></option>
                                    <option value="Hide_Object"><?= $Lang->HideObject; ?></option>
                                    <option value="Show_message"><?= $Lang->Showmessage; ?></option>
                                </select>
                            </div>
                            <div class="row-input Jq_target_Specific_page" style="display:none;overflow:visible;">
                                <label class="floating-left"><?= $Lang->Target; ?></label>
                                <div class="target-thumbs-container noclose">
                                    <div class="select-thumb">
                                        <span class="floating-left"><?= $Lang->ThumbName; ?></span>
                                        <img src="" class="floating-right">
                                    </div>
                                </div>
                                <div class="thumb-container">
                                </div>
                            </div>
                            <a class="select-object" style="display: none"></a>
                            <div class="row-input Jq_select_object-thumb1" style="display:none">
                                <label class="floating-left"><?= $Lang->Target; ?></label>
                                <select class="floating-left jq_select_object">
                                </select>
                                <a class="Jq_select_object-thumb"></a>
                            </div>
                            <div class="row-input jq_Goto_URL" style="display:none">
                                <label class="floating-left"><?= $Lang->URL; ?></label>
                                <input type="url" class="jq_url_action" placeholder="https://">
                            </div>
                            <div class="row-input Jq_show_message" style="display: none">
                                <textarea class="jq_action_msg"><?= $Lang->TypeMessagehere; ?></textarea>
                            </div>
                            <div class="row-input jq_soundeffect" style="">
                                <label class="floating-left"><?= $Lang->SoundEffect; ?></label>
                                <select class="floating-left jq_sound_effect">
                                    <option value="without" style="opacity: 0.5;"><?= $Lang->without; ?></option>
                                    <option value="click"><?= $Lang->click; ?></option>
                                    <option value="arrow"><?= $Lang->arrow; ?></option>
                                    <option value="camera"><?= $Lang->camera; ?></option>
                                    <option value="laser"><?= $Lang->laser; ?></option>
                                </select>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <a class="floating-right update-interaction jq_update_interaction"><?= $Lang->Update; ?></a>
        </div>
    </div>
    <section class="story-container">

        <section class="story-main-container" style="display: block;width:<?= $width; ?>px;height:<?= $height; ?>px;">
            <div class="content-container">
                <div class="story-content-container droppable" id="story-content-container"
                     style="height: 100%;position: relative">
                </div>
            </div>
        </section>
    </section>
    <footer class="active">
        <div class="content">
            <div class="hamburger hamburger--spring js-hamburger is-active">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                </div>
            </div>
            <div class="num-of-question">
                <div class="num-of-question-content">
                    <label class="floating-left jq_pages_count">1</label><label class="floating-left">-</label>
                    <input type="text" class="floating-left" id="jq_questionindex" value="0">
                </div>
            </div>
            <div class="manhallearning"></div>
            <div class="rectangle-items-container">
                <a class="control_next"></a>
                <a class="control_prev"></a>
                <div class="white-content">
                    <div id="slider">
                        <ul id="questions_slider">
                            <?php
                            //get story pages
                            if (is_dir($story_path . "/pages")) {
                                $jsonPath = $story_path . "/pages.json";
                                if (is_file($jsonPath)) {
                                    $pages = json_decode(file_get_contents($jsonPath), true);
                                } else {
                                    $pages = array();
                                }
//                                foreach(scandir($story_path."/pages") as $page){
                                //$pageid=0;
                                foreach ($pages as $pageid => $pageData) {
                                    $page = $pageid . ".str";
                                    $style = "";

                                    if ($pageData["thumb"] != "") {
                                        $style = 'background:#fff url(' . SITE_URL . $story_path . "/images/" . $pageData["thumb"] . ') no-repeat';

                                    }

                                    if (isset($pageData["negative"])) {
                                        $negative = $pageData["negative"];
                                    } else {
                                        $negative = "";
                                    }

                                    ?>
                                    <li class="jq_questioni ui-sortable-handle" pageid="<?= $pageid; ?>"
                                        bg_sound="<?= $pageData["bg_sound"]; ?>"
                                        bg_image="<?= $pageData["bg_image"]; ?>" thumb="<?= $pageData["thumb"]; ?>"
                                        negative="<?= $negative; ?>" style="<?= $style; ?>">
                                        <label class="floating-right">
                                            <i class="delete jq_deletequestion floating-right" title="Delete"></i>
                                            <i class="edit jq_editquestion floating-right" title="Edit"></i>
                                            <i class="jq_movequestion floating-right" title="Move"></i>
                                        </label>
                                    </li>
                                    <?php
                                    //   $pageid++;
                                }
                            }
                            ?>
                        </ul>
                    </div>

                </div>
                <div id="addpage" class="addQuestion tooltip1" data-balloon-pos="<?= $left; ?>"
                     data-balloon="<?= $Lang->helpaddquestionstory; ?>"></div>

            </div>
        </div>
    </footer>
</section>
<iframe style="border:0px;width:0px;height:0px;" id="upload_target" name="upload_target"></iframe>
<iframe id="hidden_iframe" name="hidden_iframe" style="width: 0px;height: 0px;"></iframe>
<script type="text/javascript">
    var scale = ($(window).height() - ($("header").height() + $(".ruler.h").height() + $(".rectangle-items-container").height() + 50)) / window.storyHeight;
    $(".content-container").css("transform", "scale(" + scale + ")");
</script>
<div id="interaction_html" style="display: none;">
    <li class="accordion-item">
        <h3 class="accordion-thumb"><label class="floating-left"><?= $Lang->Action; ?></label><span
                    class="floating-left jq_li_no"> #1</span>
            <div class="delecte_action floating-right"></div>
            <div class="doublcate_action floating-right"></div>
            <div class="openclose floating-right"></div>
        </h3>
        <div class="accordion-panel">
            <div class="row-input jq_OnAction">
                <label class="floating-left "><?= $Lang->On; ?></label>
                <select class="floating-left jq_actionon">
                    <option value="click"><?= $Lang->ClickorTab; ?></option>
                    <option value="doubleclick"><?= $Lang->DoubleClick; ?></option>
                    <option value="mouseover"><?= $Lang->MouseOver; ?></option>
                    <option value="startanimate"><?= $Lang->StartAnimation; ?></option>
                    <option value="endanimate"><?= $Lang->EndAnimation; ?></option>
                </select>
            </div>
            <div class="row-input jq_doAction" style="">
                <label class="floating-left"><?= $Lang->Do; ?></label>
                <select class="floating-left jq_action_do">
                    <option style="opacity: 0.5;"><?= $Lang->SelectAction; ?></option>
                    <option value="Goto_Specific_Page"><?= $Lang->GotoSpecificPage; ?></option>
                    <option value="Open_popup"><?= $Lang->Openpopup; ?></option>
                    <option value="Goto_URL"><?= $Lang->GotoURL; ?></option>
                    <option value="Goto_Next_Page"><?= $Lang->GotoNextPage; ?></option>
                    <option value="Goto_Previous_Page"><?= $Lang->GotoPreviousPage; ?></option>
                    <option value="Play_Object"><?= $Lang->PlayObject; ?></option>
                    <option value="ِAnimate_Object"><?= $Lang->AnimateObject; ?></option>
                    <option value="Show_Object"><?= $Lang->ShowObject; ?></option>
                    <option value="Hide_Object"><?= $Lang->HideObject; ?></option>
                    <option value="Show_message"><?= $Lang->Showmessage; ?></option>
                </select>
            </div>
            <div class="row-input Jq_target_Specific_page" style="display:none;overflow:visible;">
                <label class="floating-left"><?= $Lang->Target; ?></label>
                <div class="target-thumbs-container noclose">
                    <div class="select-thumb">
                        <span class="floating-left"><?= $Lang->ThumbName; ?></span>
                        <img src="" class="floating-right">
                    </div>
                </div>
                <div class="thumb-container">
                </div>
            </div>
            <a class="select-object" style="display: none"></a>

            <div class="row-input Jq_select_object-thumb1" style="display:none">
                <label class="floating-left"><?= $Lang->Target; ?></label>
                <select class="floating-left jq_select_object">
                </select>
                <a class="Jq_select_object-thumb"></a>
            </div>
            <div class="row-input jq_Goto_URL" style="display:none">
                <label class="floating-left"><?= $Lang->URL; ?></label>
                <input type="url" class="jq_url_action" placeholder="https://">
            </div>

            <div class="row-input Jq_show_message" style="display: none">
                <textarea class="jq_action_msg"><?= $Lang->TypeMessagehere; ?></textarea>
            </div>
            <div class="row-input jq_soundeffect" style="">
                <label class="floating-left"><?= $Lang->SoundEffect; ?></label>
                <select class="floating-left jq_sound_effect">
                    <option value="without" style="opacity: 0.5;"><?= $Lang->without; ?></option>
                    <option value="click"><?= $Lang->click; ?></option>
                    <option value="arrow"><?= $Lang->arrow; ?></option>
                    <option value="camera"><?= $Lang->camera; ?></option>
                    <option value="laser"><?= $Lang->laser; ?></option>
                </select>
            </div>

        </div>
    </li>
</div>
</body>
</html>