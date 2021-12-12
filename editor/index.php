<?php
include_once "includes/function.php";
mustLogin();

if (strtolower($session_lang) == "ar") {
    $right = "left";
    $left = "right";
}else{
    $right = "right";
    $left = "left";
}
$cashr=15;

//get story info from database
if (isset($_GET["id"]) && $_GET["id"] != "") {
    if ($_GET["id"] == "new") {//create new media
        $sql = "INSERT INTO `media` (`category`, `grade`,`userid`, `cdate`, `status`, `type`, `price`)
VALUES (1,1,". $_SESSION["user"]["userid"] . ",NOW(),0,13,1)";
        $con->query($sql);
        $id = mysqli_insert_id($con);
        $media_path = "platform/media/".$id;
        if (!is_dir($media_path)) {
            mkdir($media_path);
        }
        header("location:" . SITE_URL . $lang_code . "/editor?id=" . $id);
    }else{//get media info from database
        $sql = "SELECT * FROM `media` WHERE `id`=" . $_GET["id"];
        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $media = mysqli_fetch_assoc($result);
            if ($media["userid"] == $_SESSION["user"]["userid"] || $_SESSION["user"]["permession"] <= 6 || $_SESSION["user"]["userid"] <= 5){
                $media_path = "platform/media/" . $media["id"];
            }else{
                header('location: ' . WEBSITE_URL);
                exit();
            }
            if($media["template"]!=0){
                $tempPath=SITE_URL."editor/editors/".$media["template"]."/index.php?id=".$_GET["id"];
            }else{
                $tempPath="https://www.manhal.com/platform/media/15496/719d387a85b59ba8e3313bc8b68e2519.html";
            }
            $_SESSION["gameData"][$_GET["id"]]=$media["data"];


        }else{//Invalide URL
            header('location: ' . WEBSITE_URL);
            exit();
        }
    }
}else{// invalid URL
    header('location: ' . WEBSITE_URL);
    exit();
}
//$settings=json_decode($media["settings"],true);

if(!isset($media["temp_color"]) || $media["temp_color"]==''){
    $media["temp_color"]='#c3e3ff';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $media["title_ar"]; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no, maximum-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="icon" data-type="favicon" sizes="24"
          href="<?= SITE_URL ?>editor/thems/<?= $session_lang; ?>/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="<?= SITE_URL ?>editor/thems/<?= $session_lang; ?>/css/style.css?v=<?= $cashr ?>">
    <link href="<?= SITE_URL ?>editor/thems/animate.css" rel="Stylesheet" type="text/css"/>
    <link href="<?= SITE_URL ?>editor/thems/<?= $session_lang; ?>/css/size.css" rel="Stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL ?>editor/thems/<?= ucfirst($lang_code); ?>/css/font-awesome.min.css"/>
    <script type="text/javascript" src="<?= SITE_URL ?>editor/js/jquery.js"></script>
    <script src="<?= SITE_URL ?>editor/js/editor.js?v=<?= $cashr ?>" type="text/javascript"></script>
    <script src="//cdn.ckeditor.com/4.14.1/full/ckeditor.js"></script>
    <script src="<?= SITE_URL ?>editor/js/manhal-ui.js?v=<?= $cashr ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?= SITE_URL ?>editor/js/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="<?= SITE_URL ?>editor/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= SITE_URL ?>editor/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?= SITE_URL ?>editor/js/slick.min.js"></script>
    <script>
        window.left = '<?=$right;?>';
        window.right = '<?=$left;?>';
        window.id = '<?=$media["id"];?>';
        window.storyPath = '<?=$media_path;?>';
        window.selectedTemplate = '<?=$media["template"];?>';
    </script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-836956915"></script>
</head>
<body>
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
    <div class="absolute-index-page-popup setting" style="display: none;">
        <div class="popup-tabel">
            <div class="popup-row">
                <div class="popup-cell">
                    <div class="index-page-popup jq_noclose animated slideInDown">
                        <div class="head">
                            <div class="title floating-left"><?= $Lang->choosetemplate;?></div>
                            <a class="close floating-right"></a>
                        </div>
                        <div class="index-container" id="index-thumbs">
                            <div class="wrapper" style="display: none">
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/1/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->WordGame1;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/1/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="1"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/2/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->WordGame2;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/2/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="2"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/3/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->WordGame1;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/3/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="3"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/4/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->selctWord;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/4/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="4"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb" style="display: none">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/5/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->fillblank;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/5/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="5"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/6/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->Circle;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/6/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="6"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/7/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->truefalse;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/7/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="7"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb" style="display: none">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/8/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->fillblank;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/8/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="8"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/9/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->sortingWord;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/9/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="9"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb" style="display: none">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/10/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->sorting;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/10/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="10"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/11/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->matching;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/11/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="11"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/12/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->sorting;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/12/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="12"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb"style="display: none">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/13/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->fillblank;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/13/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="13"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/14/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->fillblankShort;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/14/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="14"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/15/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->fillblank;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/15/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="15"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/16/thumb/SMALL.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->sortingWordVertical;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/16/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="16"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/17/thumb/SMALL.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->sortingWordHorizontal;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/17/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="17"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/18/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->ExtractParagraph;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/18/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="18"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/19/thumb/SMALL.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->matching;?> <?= $Lang->English;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/19/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="19"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/20/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->WordGame1;?> <?= $Lang->English;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/20/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="20"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/21/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->fillblank;?> <?= $Lang->English;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/21/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="21"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/22/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->Circle;?>  <?= $Lang->English;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/22/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="22"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/23/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->truefalse;?>  <?= $Lang->English;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/23/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="23"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/24/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->numberGame;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/24/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="24"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                                <div id="thumb">
                                    <img id="thumb-img" src="<?=SITE_URL."editor/templates/25/thumb/small.png";?>"/>
                                    <div class="thumb-title"><?= $Lang->WordGame1;?> <?= $Lang->English;?></div>
                                    <div class="edit-view-container">
                                        <a class="view" href="<?=SITE_URL."editor/templates/25/index.html";?>" target="_blank"><?= $Lang->View;?></a>
                                        <a class="edit jq_edit_template" templateid="25"><?= $Lang->Edit;?></a>
                                    </div>
                                </div>
                            </div>
                            <div class="wrapper-settings" style="display: none">
                                <div class="line-row">
                                    <label class="lbl-data"><?= $Lang->arabictitle;?></label>
                                    <input name="title" id="arabic_title" type="text" placeholder="<?= $Lang->arabictitle;?>" value="<?=$media["title_ar"];?>">
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data"><?= $Lang->englishtitle;?></label>
                                    <input name="title" id="english_title" type="text" placeholder="<?= $Lang->englishtitle;?>" value="<?=$media["title_en"];?>">
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data"><?= $Lang->BookDescriptionAr;?></label>
                                    <textarea name="seodescription_en" id="seodescription_ar" placeholder="<?= $Lang->BookDescriptionAr;?>" class="desc"><?=$media["description_ar"];?></textarea>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data"><?= $Lang->BookDescriptionEn;?></label>
                                    <textarea name="seodescription_en" id="seodescription_en" class="desc" placeholder="<?= $Lang->BookDescriptionEn;?>"><?=$media["description_en"];?></textarea>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data"><?= $Lang->level;?></label>
                                    <select id="level" name="binding" class="ddl-content small-width">
                                        <option value="-1" <?php if($media["grade"]==-1){echo 'selected';}?> ><?=$Lang->all;?></option>
                                        <option value="0" <?php if($media["grade"]==0){echo 'selected';}?> ><?=$Lang->Kindergarten;?></option>
                                        <option value="1" <?php if($media["grade"]==1){echo 'selected';}?> >1</option>
                                        <option value="2" <?php if($media["grade"]==2){echo 'selected';}?> >2</option>
                                        <option value="3" <?php if($media["grade"]==3){echo 'selected';}?> >3</option>
                                        <option value="4" <?php if($media["grade"]==4){echo 'selected';}?> >4</option>
                                        <option value="5" <?php if($media["grade"]==5){echo 'selected';}?> >5</option>
                                        <option value="6" <?php if($media["grade"]==6){echo 'selected';}?> >6</option>
                                        <option value="7" <?php if($media["grade"]==7){echo 'selected';}?> >7</option>
                                        <option value="8" <?php if($media["grade"]==8){echo 'selected';}?> >8</option>
                                        <option value="9" <?php if($media["grade"]==9){echo 'selected';}?> >9</option>
                                        <option value="10" <?php if($media["grade"]==10){echo 'selected';}?> >10</option>
                                    </select>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data"><?= $Lang->Category;?></label>
                                    <select id="category" name="binding" class="ddl-content small-width">
                                        <?php
                                        $cat_sql = "Select * From  categories WHERE `parent`=0";
                                        $cat_result = $con->query($cat_sql);
                                        while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                                            if($cat_row["catid"]==$media["category"]){
                                                $selected='selected';
                                            }else{
                                                $selected='';
                                            }
                                            echo "<option " . $selected . " value='" . $cat_row['catid'] . "'>" . $cat_row['name_'.$lang_code] . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data"><?= $Lang->Language;?></label>
                                    <select id="language" name="language" class="ddl-content small-width">
                                        <option value="ar" <?php if($media["language"]=="ar"){echo 'selected="selected"';} ?>><?= $Lang->Arabic;?></option>
                                        <option value="en" <?php if($media["language"]=="en"){echo 'selected="selected"';} ?>><?= $Lang->English;?></option>
                                    </select>
                                </div>
                                <?php
                                $style='';
                                if(!(isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"] > 0 && $_SESSION["user"]["permession"] <= 5)){
                                   $style='display:none;';
                                }
                                ?>

                                <div class="line-row" style="<?=$style;?>">
                                    <label for="isPublished" class="lbl-data"><?= $Lang->isPublish;?></label>
                                    <input class="floating-left checkbox" id="isPublished"  name="isPublished" value="1" type="checkbox" <?php if($media["status"]==1){echo 'checked';} ?>>
                                </div>


                                <?php
                                if(is_file('platform/media/'.$media["id"].'/thumbnail_small.jpg')){
                                    $thumb='platform/media/'.$media["id"].'/thumbnail_small.jpg';
                                }else{
                                    $thumb='editor/editors/tempid/thumb/big.png';
                                }
                                ?>

                                <div class="line-row">
                                    <label for="isPublished" class="lbl-data"><?= $Lang->Small_Thumbnail;?></label>
                                    <div class="right-container floating-left text-left">
                                        <img src="<?= SITE_URL.$thumb;?>" id="default-thumb" class="default-image floating-left" style="background-size: contain;background-position: center">
                                        <div class="fu-container-a floating-left custom-margin">
                                            <label class="floating-left flaticon-cloud148 label-a"></label>
                                            <label class="floating-left label-b" id="lblimage_txt"></label>
                                            <input onchange="readURL(this,'default-thumb');" type="file" name="frontcover" id="frontcover">
                                        </div>
                                        <a class="delete-image floating-left custom-margin"></a>
                                    </div>
                                </div>

                                <?php
                                if(is_file('platform/media/'.$media["id"].'/thumbnail.jpg')){
                                    $thumb='platform/media/'.$media["id"].'/thumbnail.jpg';
                                }else{
                                    $thumb='editor/editors/tempid/thumb/big.png';
                                }
                                ?>

                                <div class="line-row">
                                    <label for="isPublished" class="lbl-data"><?= $Lang->Big_Thumbnail;?></label>
                                    <div class="right-container floating-left text-left">
                                        <img src="<?= SITE_URL.$thumb; ?>" id="default-thumb-big" class="default-image floating-left" style="background-size:contain; background-position:center">
                                        <div class="fu-container-a floating-left custom-margin">
                                            <label class="floating-left flaticon-cloud148 label-a"></label>
                                            <label class="floating-left label-b" id="lblimage_txt_big"></label>
                                            <input onchange="readURL(this,'default-thumb-big');" type="file" name="frontcover" id="frontcover">
                                        </div>
                                        <a class="delete-image floating-left custom-margin"></a>
                                    </div>
                                </div>
                                <div class="line-row">
                                    <label class="lbl-data"><?= $Lang->Help;?></label>
                                    <input name="help" id="help" type="text" placeholder="<?= $Lang->Help;?>" value="<?=$media["help"];?>">
                                </div>
                                <div class="line-row floating-right" style="width: 100%">
                                    <a class="save-settings"><?= $Lang->Save;?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="absolute-index-page-popup help" style="display: none;">
            <div class="popup-tabel">
                <div class="popup-row">
                    <div class="popup-cell">
                        <div class="index-page-popup jq_noclose animated slideInDown">
                            <div class="head">
                                <div class="title floating-left"><?= $Lang->Help;?></div>
                                <a class="close floating-right"></a>
                            </div>
                            <div class="index-container" style="margin:0;">
                                <div class="wrapper-settings" style="margin:0;">
                                    <textarea style="display: none" id="ckeditor" name="text"> </textarea>
                                    <div class="line-row floating-right" style="width: 100%">
                                        <a class="save-settings-help">Save</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="activate-choose-thumb-state" style="display: none">
        <a class="closeA">close</a>
    </div>
    <div class="activate-choose-object-state" style="display: none">
        <a class="closeA">close</a>
    </div>
    <div class="hide-tools-button">
        <svg width="28" height="18" preserveAspectRatio="xMidYMid" viewBox="0 0 28 18" class="symbol symbol-hideToolsArrow hide-tools-symbol">
            <path id="path-1" fill-rule="evenodd" d="M14.037 17.979c-.976 0-1.91-.396-2.578-1.099L.95 5.877A3.459 3.459 0 0 1 1.1.937a3.572 3.572 0 0 1 5.005.147l7.932 8.303 7.931-8.303a3.573 3.573 0 0 1 5.006-.147 3.459 3.459 0 0 1 .149 4.94L16.615 16.88a3.555 3.555 0 0 1-2.578 1.099z" class="cls-2"></path>
        </svg>
    </div>
    <header>
        <div class="choose-color-container">
            <a class="colors-in active" style="background: #c3e3ff;" color="#c3e3ff"><i>&#10003;</i></a>
            <a class="colors-in" style="background: #9ccf8d;" color="#9ccf8d"><i>&#10003;</i></a>
            <a class="colors-in" style="background: #40beba;" color="#40beba"><i>&#10003;</i></a>
            <a class="colors-in" style="background: #be9bca;" color="#be9bca"><i>&#10003;</i></a>
        </div>
        <a class="editor-logo floating-left" href="<?= SITE_URL . $lang_code . "/my-activities"; ?>" title="<?= $Lang->DarAlManhalPublishers;?>"></a>
        <div class="editor-title floating-left">
            <label class="floating-left" id="games_top_title"><?=$media["title_ar"];?></label>
        </div>
        <div class="options-icons floating-right">
            <a title="<?= $Lang->Exit;?>" class="floating-right exit" href="<?= SITE_URL . $lang_code . "/my-activities";?>"><?= $Lang->Exit;?></a>
            <a title="<?= $Lang->Preview;?>" id="jq_preview" class="floating-right view" target="_blank"><?= $Lang->Preview;?></a>
            <a title="<?= $Lang->Save; ?>" id="save_temp" class="floating-right save"><?= $Lang->Save;?></a>
            <a title="<?= $Lang->Setting1;?>" class="floating-right jq_setting"><?= $Lang->Setting1;?></a>
            <a title="<?= $Lang->Help;?>" class="floating-right jq_help"><?= $Lang->Help;?></a>
            <a title="<?= $Lang->Color;?>" class="floating-right jq_choose_color"><label style="cursor: pointer" class="floating-left"><?= $Lang->Color;?></label><i style="background: <?=$media["temp_color"];?>" color="<?=$media["temp_color"];?>" class="jq_color floating-left"></i></a>
        </div>
    </header>
    <section class="story-container">
        <section class="story-main-container" style="display: block">
            <div class="content-container">
                <div class="story-content-container " id="story-content-container" style="height: 100%;position: relative">
                    <iframe id="iframe_template" style="background: #FFF;width: 100%;height: 100%;" src="<?=$tempPath;?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div>
            </div>
        </section>
    </section>
    <footer style="display: none;">
        <div class="content">
            <div class="hamburger hamburger--spring js-hamburger">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                </div>
            </div>
            <div class="manhallearning" style="display: none"></div>
            <div class="rectangle-items-container">
                <div class="slider slider-nav">
                    <div class="slider-item slick-active">
                        <img src="<?= SITE_URL ?>editor/thems/<?= $session_lang; ?>/images/image.png" alt="thumb">
                        <div class="edit-containers">
                            <i class="delete jq_deletetemplate floating-right" title="<?= $Lang->Delete;?>"></i>
                            <i class="edit jq_edittemplate floating-right" title="<?= $Lang->Edit;?>"></i>
                            <i class="jq_movequestion floating-right ui-sortable-handle" title="<?= $Lang->Move;?>"></i>
                        </div>
                    </div>
                    <div class="slider-item">
                        <img src="https://www.manhal.com/platform/games/9258/images/thumb.jpg" alt="thumb">
                        <div class="edit-containers">
                            <i class="delete jq_deletetemplate floating-right" title="<?= $Lang->Delete; ?>"></i>
                            <i class="edit jq_edittemplate floating-right" title="<?= $Lang->Edit; ?>"></i>
                            <i class="jq_movequestion floating-right ui-sortable-handle" title="<?= $Lang->Move;?>"></i>
                        </div>
                    </div>
                    <div class="slider-item">
                        <img src="https://www.manhal.com/platform/media/15495/thumbnail_small.jpg" alt="thumb">
                        <div class="edit-containers">
                            <i class="delete jq_deletetemplate floating-right" title="<?= $Lang->Delete; ?>"></i>
                            <i class="edit jq_edittemplate floating-right" title="<?= $Lang->Edit; ?>"></i>
                            <i class="jq_movequestion floating-right ui-sortable-handle" title="<?= $Lang->Move;?>"></i>
                        </div>
                    </div>
                    <div class="slider-item">
                        <img src="https://www.manhal.com/platform/media/15496/thumbnail_small.jpg" alt="thumb">
                        <div class="edit-containers">
                            <i class="delete jq_deletetemplate floating-right" title="<?= $Lang->Delete; ?>"></i>
                            <i class="edit jq_edittemplate floating-right" title="<?= $Lang->Edit; ?>"></i>
                            <i class="jq_movequestion floating-right ui-sortable-handle" title="<?= $Lang->Move;?>"></i>
                        </div>
                    </div>

                    <div class="slider-item">
                        <img src="https://www.manhal.com/platform/media/15479/thumbnail_small.jpg" alt="thumb">
                        <div class="edit-containers">
                            <i class="delete jq_deletetemplate floating-right" title="<?= $Lang->Delete; ?>"></i>
                            <i class="edit jq_edittemplate floating-right" title="<?= $Lang->Edit; ?>"></i>
                            <i class="jq_movequestion floating-right ui-sortable-handle" title="<?= $Lang->Move;?>"></i>
                        </div>
                    </div>
                    <div class="slider-item">
                        <img src="<?= SITE_URL ?>editor/thems/<?= $session_lang; ?>/images/image.png" alt="thumb">
                        <div class="edit-containers">
                            <i class="delete jq_deletetemplate floating-right" title="<?= $Lang->Delete; ?>"></i>
                            <i class="edit jq_edittemplate floating-right" title="<?= $Lang->Edit; ?>"></i>
                            <i class="jq_movequestion floating-right ui-sortable-handle" title="<?= $Lang->Move;?>"></i>
                        </div>
                    </div>
                    <div class="slider-item">
                        <img src="<?= SITE_URL ?>editor/thems/<?= $session_lang; ?>/images/image.png" alt="thumb">
                        <div class="edit-containers">
                            <i class="delete jq_deletetemplate floating-right" title="<?= $Lang->Delete; ?>"></i>
                            <i class="edit jq_edittemplate floating-right" title="<?= $Lang->Edit; ?>"></i>
                            <i class="jq_movequestion floating-right ui-sortable-handle" title="<?= $Lang->Move;?>"></i>
                        </div>
                    </div>
                    <div class="slider-item">
                        <img src="<?= SITE_URL ?>editor/thems/<?= $session_lang; ?>/images/image.png" alt="thumb">
                        <div class="edit-containers">
                            <i class="delete jq_deletetemplate floating-right" title="<?= $Lang->Delete; ?>"></i>
                            <i class="edit jq_edittemplate floating-right" title="<?= $Lang->Edit; ?>"></i>
                            <i class="jq_movequestion floating-right ui-sortable-handle" title="<?= $Lang->Move;?>"></i>
                        </div>
                    </div>
                    <div class="slider-item">
                        <img src="<?= SITE_URL ?>editor/thems/<?= $session_lang; ?>/images/image.png" alt="thumb">
                        <div class="edit-containers">
                            <i class="delete jq_deletetemplate floating-right" title="<?= $Lang->Delete; ?>"></i>
                            <i class="edit jq_edittemplate floating-right" title="<?= $Lang->Edit; ?>"></i>
                            <i class="jq_movequestion floating-right ui-sortable-handle" title="<?= $Lang->Move;?>"></i>
                        </div>
                    </div>
                    <div class="slider-item">
                        <img src="<?= SITE_URL ?>editor/thems/<?= $session_lang; ?>/images/image.png" alt="thumb">
                        <div class="edit-containers">
                            <i class="delete jq_deletetemplate floating-right" title="<?= $Lang->Delete; ?>"></i>
                            <i class="edit jq_edittemplate floating-right" title="<?= $Lang->Edit; ?>"></i>
                            <i class="jq_movequestion floating-right ui-sortable-handle" title="<?= $Lang->Move;?>"></i>
                        </div>
                    </div>
                    <div class="slider-item">
                        <img src="<?= SITE_URL ?>editor/thems/<?= $session_lang; ?>/images/image.png" alt="thumb">
                        <div class="edit-containers">
                            <i class="delete jq_deletetemplate floating-right" title="<?= $Lang->Delete; ?>"></i>
                            <i class="edit jq_edittemplate floating-right" title="<?= $Lang->Edit; ?>"></i>
                            <i class="jq_movequestion floating-right ui-sortable-handle" title="<?= $Lang->Move;?>"></i>
                        </div>
                    </div>
                </div>
                <div id="addtemplate" class="addQuestion tooltip1"></div>
            </div>
        </div>
    </footer>
</section>
</body>
</html>
