<?php


$cuerrentpage = "editmedia.php";


if (session_status() == PHP_SESSION_NONE) {


    session_start();


}


include_once('config.php');


include_once('includes/language.php');


include_once('../includes/function.php');


if (isset($_GET['id']) && $_GET['id'] == "new") {


    $random = md5(uniqid());


    $sql = "INSERT INTO media (id,category,userid,filename) VALUES ('',0," . $_SESSION["user"]["userid"] . ",'" . $random . "')";


    $con->query($sql);


    $id = mysqli_insert_id($con);


    @mkdir("media/" . $id);


    header("location: editmedia.php?id=" . $id);


    exit();


}


$sql = "SELECT * FROM media WHERE id=" . $_GET['id'];


$result = $con->query($sql);


if (mysqli_num_rows($result) > 0) {


    $data = '';


    $row = mysqli_fetch_assoc($result);


}


$bredcrumb = '<li class="floating-left"><a href="media.php" class="floating-left">' . $Lang->media . '</a></li><span class="floating-left">/</span><li class="floating-left"><a class="floating-left active">' . $Lang->EditMedia . '</a></li>';


include "includes/header.php";


?>


<div class="edit-book">

    <div class="form-container">


        <form id="editbook">


            <input type="hidden" name="media_id" id="media_id" value="<?= $_GET['id']; ?>">


            <div class="display-inline-block floating-left">


                <div class="line-row">


                    <label class="lbl-data-a floating-left"><?= $Lang->arabictitle ?></label>


                    <input type="text" class="txt-a floating-left" id="title_ar" name="title_ar"


                           placeholder="<?= $Lang->arabictitle ?>" value="<?= $row["title_ar"]; ?>">


                </div>


                <div class="line-row">


                    <label class="lbl-data-a floating-left"><?= $Lang->englishtitle ?></label>


                    <input type="text" class="txt-a floating-left" id="title_en" name="title_en"


                           placeholder="<?= $Lang->englishtitle ?>" value="<?= $row["title_en"]; ?>">


                </div>


                <div class="line-row">


                    <label class="lbl-data-a floating-left">


                        <?= $Lang->Grade; ?>


                    </label>


                    <select class="txt-a floating-left" id="media_grade" name="media_grade">


                        <option value="-1" <?php if ($row["grade"] == -1) {


                            echo 'selected';


                        } ?> ><?= $Lang->all; ?></option>

                        <option value="20" <?php if ($row["grade"] == 20) {
                            echo 'selected';
                        } ?> ><?= $Lang->prek; ?></option>

                        <option value="0" <?php if ($row["grade"] == 0) {


                            echo 'selected';


                        } ?> ><?= $Lang->Kindergarten; ?></option>


                        <option value="1" <?php if ($row["grade"] == 1) {


                            echo 'selected';


                        } ?> >1


                        </option>


                        <option value="2" <?php if ($row["grade"] == 2) {


                            echo 'selected';


                        } ?> >2


                        </option>


                        <option value="3" <?php if ($row["grade"] == 3) {


                            echo 'selected';


                        } ?> >3


                        </option>


                        <option value="4" <?php if ($row["grade"] == 4) {


                            echo 'selected';


                        } ?> >4


                        </option>


                        <option value="5" <?php if ($row["grade"] == 5) {


                            echo 'selected';


                        } ?> >5


                        </option>


                        <option value="6" <?php if ($row["grade"] == 6) {


                            echo 'selected';


                        } ?> >6


                        </option>


                        <option value="7" <?php if ($row["grade"] == 7) {


                            echo 'selected';


                        } ?> >7


                        </option>


                        <option value="8" <?php if ($row["grade"] == 8) {


                            echo 'selected';


                        } ?> >8


                        </option>


                        <option value="9" <?php if ($row["grade"] == 9) {


                            echo 'selected';


                        } ?> >9


                        </option>


                        <option value="10" <?php if ($row["grade"] == 10) {


                            echo 'selected';


                        } ?> >10


                        </option>


                    </select>


                </div>


                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?= $Lang->Age; ?>
                    </label>
                    <select class="txt-a floating-left" id="media_age" name="media_age">
                        <option value="-1" <?php if ($row["age"] == -1) {
                            echo 'selected';
                        } ?> ><?= $Lang->all; ?></option>
                        <option value="20" <?php if ($row["age"] == 20) {
                            echo 'selected';
                        } ?> >3
                        <option value="1" <?php if ($row["age"] == 1) {
                            echo 'selected';
                        } ?> >4-5
                        </option>
                        <option value="2" <?php if ($row["age"] == 2) {
                            echo 'selected';
                        } ?> >6-8
                        </option>
                        <option value="3" <?php if ($row["age"] == 3) {
                            echo 'selected';
                        } ?> >9-11
                        </option>
                        <option value="4" <?php if ($row["age"] == 4) {
                            echo 'selected';
                        } ?> >12-15
                        </option>
                        <option value="5" <?php if ($row["age"] == 5) {
                            echo 'selected';
                        } ?> >+22
                        </option>
                    </select>
                </div>


                <div class="line-row">


                    <label class="lbl-data-a floating-left"><?= $Lang->Price; ?></label>


                    <input type="text" class="txt-a floating-left" id="media_price" name="media_price"


                           placeholder="<?= $Lang->Price; ?>" value="<?= $row["price"]; ?>">


                </div>


                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Book; ?></label>
                    <div id="book_container" class="add-items-container floating-left">
                        <?php
                        $sqllink = "SELECT * FROM medialinked WHERE idmedia=" . $_GET['id'];
                        $resultlink = $con->query($sqllink);
                        if (mysqli_num_rows($resultlink) > 0) {
                            $data = '';
                            while ($rowlink = mysqli_fetch_assoc($resultlink)) {
                                if ($rowlink['type'] == 0) {
                                    echo '<div id="book_' . $rowlink['id'] . '" idbook="' . $rowlink['idbook'] . '" type="' . $rowlink['type'] . '" title="' . $rowlink['title'] . '" class="item-added floating-left"><label>' . $rowlink['title'] . '</label><span><i onclick="removeitem(this)" class="flaticon-delete96"></i></span></div>';
                                } else if ($rowlink['type'] == 1) {
                                    $data .= '<div id="story_' . $rowlink['id'] . '" idbook="' . $rowlink['idbook'] . '" type="' . $rowlink['type'] . '" title="' . $rowlink['title'] . '" class="item-added floating-left"><label>' . $rowlink['title'] . '</label><span><i onclick="removeitem(this)" class="flaticon-delete96"></i></span></div>';
                                }
                            }
                        }
                        ?>
                    </div>
                    <a onclick='$("#popup_action").fadeIn();$("#getpage").attr("src","searchbook.php")'
                       class="add-button floating-left"><i class="flaticon-add64"></i></a>
                </div>


                <div class="line-row">


                    <label class="lbl-data-a floating-left"><?= $Lang->Story; ?></label>


                    <div id="story_container" class="add-items-container floating-left">


                        <?php echo $data; ?>


                    </div>


                    <a onclick='$("#popup_action").fadeIn();$("#getpage").attr("src","searchstories.php")'
                       class="add-button floating-left"><i class="flaticon-add64"></i></a>


                </div>


            </div>


            <div class="display-inline-block floating-left">


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


                    <label class="lbl-data-a floating-left">


                        <?= $Lang->Language; ?>


                    </label>


                    <select class="txt-a floating-left" id="language" name="language">


                        <option <?php if ($row["language"] == 'Ar') {


                            echo "selected='selected'";


                        } ?> value='Ar'><?= $Lang->Arabic; ?></option>


                        <option <?php if ($row["language"] == 'En') {


                            echo "selected='selected'";


                        } ?> value='En'><?= $Lang->English; ?></option>


                        <option <?php if ($row["language"] == 'Fr') {


                            echo "selected='selected'";


                        } ?> value='Fr'><?= $Lang->France; ?></option>


                    </select>


                </div>


                <div class="line-row">


                    <label class="lbl-data-a floating-left">


                        <?= $Lang->Type; ?>


                    </label>


                    <select class="txt-a floating-left" id="mediatype" name="mediatype">


                        <option <?php if ($row["type"] == '0') {


                            echo "selected='selected'";


                        } ?> value='0'><?= $Lang->worksheets; ?></option>


                        <option <?php if ($row["type"] == '1') {


                            echo "selected='selected'";


                        } ?> value='1'><?= $Lang->coloringsheets; ?></option>


                        <option <?php if ($row["type"] == '2') {


                            echo "selected='selected'";


                        } ?> value='2'><?= $Lang->lessons; ?></option>


                        <option <?php if ($row["type"] == '3') {


                            echo "selected='selected'";


                        } ?> value='3'><?= $Lang->sound; ?></option>


                        <option <?php if ($row["type"] == '4') {


                            echo "selected='selected'";


                        } ?> value='4'><?= $Lang->video; ?></option>


                        <option <?php if ($row["type"] == '5') {


                            echo "selected='selected'";


                        } ?> value='5'><?= $Lang->teachersbook; ?></option>


                        <option <?php if ($row["type"] == '6') {


                            echo "selected='selected'";


                        } ?> value='6'><?= $Lang->quize; ?></option>


                        <option <?php if ($row["type"] == '7') {


                            echo "selected='selected'";


                        } ?> value='7'><?= $Lang->CD; ?></option>


                        <option <?php if ($row["type"] == '8') {


                            echo "selected='selected'";


                        } ?> value='8'><?= $Lang->flash; ?></option>


                        <option <?php if ($row["type"] == '9') {


                            echo "selected='selected'";


                        } ?> value='9'><?= $Lang->flashcard; ?></option>


                        <option <?php if ($row["type"] == '10') {


                            echo "selected='selected'";


                        } ?> value='10'><?= $Lang->lectures; ?></option>


                        <option <?php if ($row["type"] == '11') {


                            echo "selected='selected'";


                        } ?> value='11'><?= $Lang->Games; ?></option>


                        <option <?php if ($row["type"] == '12') {


                            echo "selected='selected'";


                        } ?> value='12'><?= $Lang->worksheetinteractive; ?></option>


                        <option <?php if ($row["type"] == '13') {
                            echo "selected='selected'";
                        } ?> value='13'><?= $Lang->educationtools; ?></option>
                        <option <?php if ($row["type"] == '14') {
                            echo "selected='selected'";
                        } ?> value='14'><?= $Lang->TeachersGuide; ?></option>
                        <option <?php if ($row["type"] == '15') {
                            echo "selected='selected'";
                        } ?> value='15'><?= $Lang->ministryapprovals; ?></option>
                        <option <?php if ($row["type"] == '16') {
                            echo "selected='selected'";
                        } ?> value='16'><?= $Lang->curriculumplans; ?></option>
                    </select>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->BookDescriptionAr; ?></label>
                    <textarea class="floating-left txt-b" name="mediadescription_ar" id="mediadescription_ar"
                              placeholder="<?= $Lang->BookDescriptionAr; ?>"><?= $row['description_ar']; ?></textarea>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->BookDescriptionEn; ?></label>
                    <textarea class="floating-left txt-b" name="mediadescription_en" id="mediadescription_en"
                              placeholder="<?= $Lang->BookDescriptionEn; ?>"><?= $row['description_en']; ?></textarea>
                </div>
                <?php
                if (!isset($row["path"]) || $row["path"] == '' || is_null($row["path"])){
                ?>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Thumbnail; ?></label>
                    <div class="fu-container-a floating-left">
                        <label class="floating-left flaticon-cloud148 label-a"></label>
                        <label class="label-b " id="lblbook_cover"></label>
                        <input onchange="readImg(this,'thumbnail_small_img')" class="txt-a floating-left" id="thumbnail_small" type="file" name="thumbnail_small" placeholder="<?= $Lang->Thumbnail; ?>" value="">
                    </div>
                    <?php
                    if (is_file("media/" . $_GET["id"] . "/thumbnail_small.jpg")) {
                        $src = "media/" . $_GET["id"] . "/thumbnail_small.jpg";
                    } else {
                        $src = "";
                    }
                    ?>
                    <a id='filemedia_tumb' class='floating-left'><span onclick='remoimage("thumbnail_small.jpg")'><i
                                    class='flaticon-delete96'></i></span><img class="book-cover-img floating-left"
                                                                              id="thumbnail_small_img"
                                                                              src="<?= $src; ?>"></a>
                    <?php
                    if (is_file("media/" . $_GET["id"] . "/" . $row['filename'] . "image_larg.jpg")) {
                        $src = "media/" . $_GET["id"] . "/" . $row['filename'] . "image_larg.jpg";
                    } else if (is_file("media/" . $_GET["id"] . "/thumbnail.jpg")) {
                        $src = "media/" . $_GET["id"] . "/thumbnail.jpg";
                    } else {
                        $src = "";
                    }
                    ?>


                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->image_larg; ?></label>
                    <div class="fu-container-a floating-left">
                        <label class="floating-left flaticon-cloud148 label-a"></label>
                        <label class="label-b floating-left" id="lblback_cover"></label>
                        <input onchange="readImg(this,'image_larg_img')" class="txt-a floating-left" id="image_larg"
                               type="file" name="image_larg" placeholder="<?= $Lang->image_larg; ?>" value="">
                    </div>
                    <a id='filemedia_tumb' class='floating-left'><span
                                onclick='remoimage("<?= $row['filename'] ?>image_larg.jpg")'><i
                                    class='flaticon-delete96'></i></span> <img class="book-cover-img floating-left"
                                                                               id="image_larg_img"
                                                                               src="<?= $src; ?>"></a>
                </div>
        </form>


        <form id="media_form"  action="ajax/platform.php?process=mediafile&id=<?= $row['id']; ?>&filename=<?= $row['filename']; ?>"
              method="post" target="hidden_iframe" enctype="multipart/form-data">


            <input id="dtitle_en" name="dtitle_en" type="hidden" value="<?= $row['title_en']; ?>">


            <div class="line-row">


                <label class="lbl-data-a floating-left"><?= $Lang->Filemedia; ?></label>


                <div class="fu-container-a floating-left">


                    <label class="floating-left flaticon-cloud148 label-a"></label>


                    <label class="label-b floating-left" id="lblbook_shoots"></label>


                    <input class="txt-a floating-left" id="Filemedia" type="file" name="Filemedia"


                           placeholder="<?= $Lang->Filemedia; ?>" value="">


                </div>


            </div>


        </form>


        <?php


        }


        ?>


        <div class="screen-shots-container">


            <?php


            if (is_file("media/" . $_GET["id"] . "/" . $row["filename"] . "." . $extanshen)) {


                $src = $icon;


            } else {


                $src = "";


            }


            echo "<a id='filemedia_tumb'  class='floating-left'  ><span onclick='removefile(" . chr(34) . $row["filename"] . chr(34) . ")'><i class='flaticon-delete96'></i></span><img onclick='viewfile()'  src='" . $src . "' ></a> ";


            ?>


        </div>


        <div class="line-row">
            <label class="lbl-data-a floating-left"><?= $Lang->isPublished; ?></label>
            <input class="floating-left check-box" type="checkbox" name="ispublished" id="ispublished"
                   value='<?= $row['status']; ?>' <?php if ($row['status'] == 1) {
                echo 'checked="checked"';
            } ?>><label class="floating-left lbl-data-b" for="ispublished"><?= $Lang->isPublished; ?></label>
        </div>

        <div class="line-row">
            <label class="lbl-data-a floating-left"><?= $Lang->newTab; ?></label>
            <input class="floating-left check-box" type="checkbox" name="isnewtab" id="isnewtab"
                   value='<?= $row['is_newtab']; ?>' <?php if ($row['is_newtab'] == 1) {
                echo 'checked="checked"';
            } ?>><label class="floating-left lbl-data-b" for="isnewtab"><?= $Lang->newTab; ?></label>
        </div>

        <div class="line-row">
            <label class="lbl-data-a floating-left"><?= $Lang->PlayList; ?></label>
            <input class="floating-left check-box" type="checkbox" name="is_playlist" id="is_playlist"
                   value='<?= $row['is_playlist']; ?>' <?php if ($row['is_playlist'] == 1) {
                echo 'checked="checked"';
            } ?>><label class="floating-left lbl-data-b" for="is_playlist"><?= $Lang->PlayList; ?></label>
        </div>

        <div class="line-row" id="playlist_container" <?php if ($row['is_playlist'] == 0) {
            echo 'style="display:none;"';
        } ?>>
            <label class="lbl-data-a floating-left"><?= $Lang->media; ?></label>
            <div id="media_container" class="add-items-container floating-left">
                <?php
                $sqllink = "SELECT * FROM `playlist_media` WHERE playlistid=" . $_GET['id'] . " ORDER BY `play_media_id`";
                $resultlink = $con->query($sqllink);
                if (mysqli_num_rows($resultlink) > 0) {
                    while ($rowlink = mysqli_fetch_assoc($resultlink)) {
                        echo '<div id="media_' . $rowlink['play_media_id'] . '" idmedia="' . $rowlink['mediaid'] . '" type="' . $rowlink['type'] . '" title="' . $rowlink['title'] . '" class="item-added floating-left"><label>' . $rowlink['title'] . '</label><span><i class="flaticon-delete96"></i></span></div>';
                    }
                }
                ?>
            </div>
            <a onclick='$("#popup_action").fadeIn();$("#getpage").attr("src","playlist_media.php")'
               class="add-button floating-left"><i class="flaticon-add64"></i></a>
        </div>

        <div class="line-row">
            <label class="lbl-data-a floating-left"><?= $Lang->fakeID; ?></label>
            <input type="text" class="txt-a floating-left" id="fakevalue" name="fakevalue"
                   placeholder="<?= $Lang->fakeID; ?>" value="<?= $row['fakeid']; ?>">
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
                                <iframe id="getpage" src="" style="width:1000px;height:670px;"></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).on("click", ".flaticon-delete96", function () {
            $(this).closest(".item-added").remove();
        });
    });

    function insertPlaylistMedia(_array, type) {
        $("#popup_action").fadeOut();
        for (var i = 0; i < _array.length; i++) {
            $("#media_container").append('<div id="book_' + _array[i].id + '" idmedia="' + _array[i].id + '" type="0" title="' + _array[i].name + '" class="item-added floating-left"><label>' + _array[i].name + '</label><span><i class="flaticon-delete96"></i></span></div>');
        }
    }
</script>


<script>


    function savemedia() {
        var msg = "";
        if ($("#title_ar").val().trim() == "") {
            msg += window.Lang.PleaseInsertTitle_ar;
        } else if ($("#title_en").val().trim() == "") {
            msg += window.Lang.PleaseInsertTitle_en;
        }
        if ($("#ispublished").prop("checked")) {
            isPublished = 1;
        } else {
            isPublished = 0;
        }
        if ($("#isnewtab").prop("checked")) {
            isNewtab = 1;
        } else {
            isNewtab = 0;
        }
        if ($("#is_playlist").prop("checked")) {
            is_playlist = 1;
        } else {
            is_playlist = 0;
        }
        if (msg == "") {
            var book_array = [];
            var story_array = [];
            var playlist_array = [];
            if ($("#is_playlist").prop("checked")) {
                for (var i = 0; i < $('#media_container').children().length; i++) {
                    playlist_array.push({
                        mediaid: $($('#media_container').children()[i]).attr('idmedia'),
                        title: $($('#media_container').children()[i]).attr('title'),
                        type: $($('#media_container').children()[i]).attr('type')
                    });
                }
            }


            for (var i = 0; i < $('#book_container').children().length; i++) {
                book_array.push({
                    idbook: $($('#book_container').children()[i]).attr('idbook'),
                    title: $($('#book_container').children()[i]).attr('title')
                });
            }

            for (var i = 0; i < $('#story_container').children().length; i++) {
                story_array.push({
                    idbook: $($('#story_container').children()[i]).attr('idbook'),
                    title: $($('#story_container').children()[i]).attr('title')
                });
            }


            if (story_array.length == 0) {
                story_array = null;
            }

            if (book_array.length == 0) {
                book_array = null;
            }

            var data = {
                media_id: $("#media_id").val(),
                title_ar: $("#title_ar").val(),
                title_en: $("#title_en").val(),
                grade: $("#media_grade").val(),
                age: $("#media_age").val(),
                media_price: $("#media_price").val(),
                Category: $("#Category").val(),
                mediatype: $("#mediatype").val(),
                description_ar: $("#mediadescription_ar").val(),
                description_en: $("#mediadescription_en").val(),
                lang: $("#language").val(),
                thumbnail_small: $("#thumbnail_small_img").attr("src"),
                image_larg: $("#image_larg_img").attr("src"),
                price: $("#media_price").val(),
                fakeid: $("#fakevalue").val(),
                ispublished: isPublished,
                isnewtab: isNewtab,
                is_playlist: is_playlist,
                book: book_array,
                story: story_array,
                plsylist_media: JSON.stringify(playlist_array),
                TypeProcesses: 'updatemedia',
                filename: '<?=$row["filename"]?>'
            };

            setdatafunction('updatemedia', data);
            $("#dtitle_en").val($("#title_en").val());
            $("#media_form").submit();
        } else {
            swal(window.Lang['Error'], msg, 'error');
        }
    }


    $(document).ready(function () {
        $("#Category").val(<?=$row['category']?>);
    });


    function removefile(name) {
        <?php
        $extanshen = 'jpg';
        switch ($row['type']) {
            case 0:
            case 1:


                $extanshen = 'pdf';


                $icon = "icons/pdf.png";


                break;


            case 2:


                $extanshen = 'doc';


                $icon = "icons/lesson.png";


                break;


            case 3:


                $extanshen = 'mp3';


                $icon = "icons/mp3.png";


                break;


            case 4:


                $extanshen = 'mp4';


                $icon = "icons/video.png";


                break;


            case 5:


                $extanshen = 'html';


                $icon = "icons/teachersbook.png";


                break;


            case 6:


                $extanshen = 'html';


                $icon = "icons/quiz_1.png";


                break;


            case 8:


                $extanshen = 'swf';


                $icon = "icons/flash.png";


                break;


            case 10:


                $extanshen = 'html';


                $icon = "icons/lecture.png";


                break;


            case 11:


                $extanshen = 'html';


                $icon = "icons/games.png";


                break;


            case 12:


                $extanshen = 'html';


                $icon = "icons/worksheet.png";


                break;


            case 13:


                $extanshen = 'pdf';


                $icon = "icons/educationtools.png";


                break;


            case 14:


                $extanshen = 'pdf';


                $icon = "icons/TeachersGuide.png";


                break;


            case 15:


                $extanshen = 'pdf';


                $icon = "icons/approved.png";


                break;


            case 16:


                $extanshen = 'pdf';


                $icon = "icons/curriculumplans.png";


                break;


        }



        ?>







        setdata = {
            TypeProcesses: 'deletefile',
            file: '../media/<?=$_GET["id"]?>/<?=$row["filename"]?>.<?=$extanshen?>'
        };


        $.ajax({


            url: "ajax/function.php",


            type: "POST",


            data: setdata,


            cache: false,


            dataType: 'html',


            success: function (html) {


                console.clear();


                $('#filemedia_tumb').hide();


                console.log(html);


            }


        });


    }


    function removeitem(object) {


        setdata = {
            TypeProcesses: 'removebooklinked',
            type: $(object).parent().parent().attr("type"),
            idbook: $(object).parent().parent().attr("idbook"),
            media_id: <?=$_GET["id"]?>
        };


        $.ajax({


            url: "ajax/function.php",


            type: "POST",


            data: setdata,


            cache: false,


            dataType: 'html',


            success: function (html) {


                console.clear();


                $(object).parent().parent().remove();


            }


        });


    }


    function remoimage(name) {


        setdata = {TypeProcesses: 'deletefile', file: '../media/<?=$_GET["id"]?>/' + name};
        $.ajax({
            url: "ajax/function.php",
            type: "POST",
            data: setdata,
            cache: false,
            dataType: 'html',
            success: function (html) {
                console.clear();
                $('#filemedia_tumb').hide();
                console.log(html);
            }
        });
    }

    function viewfile() {
        window.open('media/<?=$_GET["id"]?>/<?=$row["filename"]?>.<?=$extanshen?>?v=' + Math.random(), '_blank');
    }

    function insertid(_array, type) {
        $("#popup_action").fadeOut();
        switch (type) {
            case 0:
                for (var i = 0; i < _array.length; i++) {
                    $("#media_book").val(_array[i].id);
                    $("#book_container").append('<div id="book_' + _array[i].id + '" idbook="' + _array[i].id + '" type="0" title="' + _array[i].name + '" class="item-added floating-left"><label>' + _array[i].name + '</label><span><i class="flaticon-delete96"></i></span></div>');
                }
                break;
            case 1:
                for (var i = 0; i < _array.length; i++) {
                    $("#media_story").val(_array[i].id);
                    $("#story_container").append('<div id="story_' + _array[i].id + '" idbook="' + _array[i].id + '" type="1" title="' + _array[i].name + '" class="item-added floating-left"><label>' + _array[i].name + '</label><span><i class="flaticon-delete96"></i></span></div>');
                }
                break;
        }
    }

</script>

<?php
include "includes/footer.php";


?>



