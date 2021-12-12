<?php


$cuerrentpage = "addeducationallessons.php";


if (session_status() == PHP_SESSION_NONE) {

    session_start();

}



include_once('config.php');

include_once('includes/language.php');

include_once('../includes/function.php');

$bredcrumb = '<li class="floating-left"><a href="educationallessons.php" class="floating-left">'.$Lang->EducationalLessons.'</a></li><span class="floating-left">/</span><li class="floating-left"><a href="addeducationallessons.php" class="floating-left active">'.$Lang->AddEducationalLesson.'</a></li>';

include "includes/header.php";



?>




<div class="edit-book">
    <div class="form-container">
        <form id="editbook">
            <input type="hidden" name="media_id" id="media_id" value="<?= $_GET['id']; ?>">
            <div class="display-inline-block floating-left">
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->arabicname ?></label>
                    <input type="text" class="txt-a floating-left" id="title_ar" name="title_ar" placeholder="<?= $Lang->arabicname ?>" value="احمد">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->englishname ?></label>
                    <input type="text" class="txt-a floating-left" id="title_en" name="title_en" placeholder="<?= $Lang->englishname ?>" value="Ahmad">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"> <?= $Lang->Grade; ?> </label>
                    <select class="txt-a floating-left" id="book_grade" name="book_grade">
                        <option value="-1" <?php if($row["grade"]==-1){echo 'selected';}?> ><?=$Lang->all;?></option>
                        <option value="0" <?php if($row["grade"]==0){echo 'selected';}?> ><?=$Lang->Kindergarten;?></option>
                        <option value="1" <?php if($row["grade"]==1){echo 'selected';}?> >1</option>
                        <option value="2" <?php if($row["grade"]==2){echo 'selected';}?> >2</option>
                        <option value="3" <?php if($row["grade"]==3){echo 'selected';}?> >3</option>
                        <option value="4" <?php if($row["grade"]==4){echo 'selected';}?> >4</option>
                        <option value="5" <?php if($row["grade"]==5){echo 'selected';}?> >5</option>
                        <option value="6" <?php if($row["grade"]==6){echo 'selected';}?> >6</option>
                        <option value="7" <?php if($row["grade"]==7){echo 'selected';}?> >7</option>
                        <option value="8" <?php if($row["grade"]==8){echo 'selected';}?> >8</option>
                        <option value="9" <?php if($row["grade"]==9){echo 'selected';}?> >9</option>
                        <option value="10" <?php if($row["grade"]==10){echo 'selected';}?> >10</option>
                    </select>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Price; ?></label>
                    <input type="text" class="txt-a floating-left" id="media_price" name="media_price" placeholder="<?= $Lang->Price; ?>" value="100">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->OldPrice; ?></label>
                    <input type="text" class="txt-a floating-left" id="media_price" name="media_price" placeholder="<?= $Lang->OldPrice; ?>" value="100">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->CompanyName; ?></label>
                    <input type="text" class="txt-a floating-left" name="Comp-Name" placeholder="<?= $Lang->CompanyName; ?>" value="Dar almanhal">
                </div>
                <div class="line-row">

                    <label class="lbl-data-a floating-left"><?= $Lang->BookDescriptionAr; ?></label>

                    <textarea class="floating-left txt-b" name="mediadescription_ar" id="mediadescription_ar"

                              placeholder="<?= $Lang->BookDescriptionAr; ?>">AAAAAAAAAAAA</textarea>

                </div>
                <div class="line-row">

                    <label class="lbl-data-a floating-left"><?= $Lang->BookDescriptionEn; ?></label>

                    <textarea class="floating-left txt-b" name="mediadescription_en" id="mediadescription_en"

                              placeholder="<?= $Lang->BookDescriptionEn; ?>">AAAAAAAAAAAAA</textarea>

                </div>
                <div class="line-row">

                    <label class="lbl-data-a floating-left"><?= $Lang->SEODescriptionAr; ?></label>

                    <textarea class="floating-left txt-b" name="mediadescription_ar" id="mediadescription_ar"

                              placeholder="<?= $Lang->SEODescriptionAr; ?>">AAAAAAAAAAAA</textarea>

                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->SEODescriptionEn; ?></label>
                    <textarea class="floating-left txt-b" name="mediadescription_en" id="mediadescription_en" placeholder="<?= $Lang->SEODescriptionEn; ?>">AAAAAAAAAAAAA</textarea>
                </div>

            </div>
            <div class="display-inline-block floating-left">
                <div class="line-row">

                    <label class="lbl-data-a floating-left"><?= $Lang->GuidedlessonAr; ?></label>

                    <textarea class="floating-left txt-b" name="mediadescription_ar" id="mediadescription_ar"

                              placeholder="<?= $Lang->GuidedlessonAr; ?>">AAAAAAAAAAAA</textarea>

                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->GuidedlessonEn; ?></label>
                    <textarea class="floating-left txt-b" name="mediadescription_en" id="mediadescription_en" placeholder="<?= $Lang->GuidedlessonEn; ?>">AAAAAAAAAAAAA</textarea>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?= $Lang->Color ?>
                    </label>
                    <div id="colorSelector" class="floating-left"><div id="getvalue" style="background-color: #00a951"></div></div>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?= $Lang->Category ?>
                    </label>
                    <select class="txt-a floating-left" id="Category" name="Category">
                        <option value='0'>---------------</option>
                        <?php
                        $cat_sql = "Select * From  categories WHERE `parent`=0";
                        $cat_result = $con->query($cat_sql);
                        if (mysqli_num_rows($cat_result) > 0) {
                            while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                                echo getCategories($cat_row['catid'], "categories");
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?=$Lang->Thumbnail;?></label>
                    <div class="fu-container-a floating-left">
                        <label class="floating-left flaticon-cloud148 label-a"></label>
                        <label class="label-b " id="lblbook_cover"></label>
                        <input onchange="readImg(this,'thumbnail_small_img')" class="txt-a floating-left" id="thumbnail_small" type="file" name="thumbnail_small" placeholder="<?= $Lang->Thumbnail; ?>" value="">
                    </div>
                    <a id='filemedia_tumb'  class='floating-left'  ><span onclick='remoimage("thumbnail_small.jpg")'><i class='flaticon-delete96'></i></span><img class="book-cover-img floating-left" id="thumbnail_small_img" src="<?= $src; ?>"></a>
                </div>
        </form>
        <form id="screenshots_form" action="ajax/platform.php?process=screenshots&bookid=<?=$row['bookid'];?>" method="post" target="hidden_iframe" enctype="multipart/form-data">
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->ScreenShoots;?></label>
                <div class="fu-container-a floating-left">
                    <label class="floating-left flaticon-cloud148 label-a"></label>
                    <label class="label-b floating-left" id="lblbook_shoots"></label>
                    <input class="txt-a floating-left" id="book_shoots" type="file" name="book_shoots[]" multiple placeholder="<?= $Lang->ScreenShoots;?>" value="">
                </div>
            </div>
        </form>
        <div class="screen-shots-container">
            <?php
            ////start khalid 19-9-2016
            $dir="books/".$_GET["id"]."/screenshoots/";
            if (file_exists($dir)) {
                foreach (scandir($dir) as $item) {
                    if ($item == '.' || $item == '..') continue;
//khalid 26-9-2016
                    echo "<a class='floating-left' ><span onclick='removeimage(this);'><i class='flaticon-delete96'></i></span><img id='scrimg'  src='" . $dir . "/" . $item . "' ></a> ";
                }
            }
            ////end khalid 19-9-2016
            ?>
        </div>
        <div class="line-row">

            <label class="lbl-data-a floating-left"><?= $Lang->isPublished; ?></label>

            <input class="floating-left check-box" type="checkbox" name="ispublished" id="ispublished" value=''>
            <label class="floating-left lbl-data-b" for="ispublished"><?= $Lang->isPublished; ?></label>

        </div>
    </div>

    <iframe id="hidden_iframe" name="hidden_iframe" style="width: 0px;height: 0px;"></iframe>

    <input name="commit" onclick="savemedia()" type="button" value="<?= $Lang->Update; ?>"

           class="btn-default-a floating-right clear-both">

</div>

</div>

<div class="admin-login" id="popup_action" style="display:none ;">

    <div class="popup-main-container">

        <div class="popup-tabel">

            <div class="popup-row">

                <div class="popup-cell">

                    <div class="popup-container">

                        <label class="close-container">

                            <i class="flaticon-x floating-right close" onclick='$("#popup_action").fadeOut();'></i>

                        </label>

                        <div class="popup-content">

                            <div class="containers" id="action_containerb">

                                <iframe id="getpage" src="" style="width:1000px;height:600px;"></iframe>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
<script>
    $('#colorSelector').ColorPicker({
        color: '#0000ff',
        onShow: function (colpkr) {
            $(colpkr).fadeIn(500);
            return false;
        },
        onHide: function (colpkr) {
            $(colpkr).fadeOut(500);
            return false;
        },
        onChange: function (hsb, hex, rgb) {
            $('#colorSelector div').css('backgroundColor', '#' + hex);
        }
    });
</script>


<?php

include "includes/footer.php";

?>

