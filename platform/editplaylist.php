<?php

/**
 * User: Hussam Abu Khadijeh    Dar Al-Manhal
 * Date: 13/12/2016
 * Time: 2:27 PM
 */

$cuerrentpage = "playlist.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include_once('config.php');
include_once('includes/language.php');
include_once('includes/function.php');

if (isset($_GET['id']) && $_GET['id'] == "new") {
    $sql = "INSERT INTO playlist (id,userid,cdate) VALUES (''," . $_SESSION["user"]["userid"] . ",NOW())";
    $con->query($sql);
    $id = mysqli_insert_id($con);
    header("location: editplaylist.php?id=" . $id);
    exit();
}

$sql = "SELECT `playlist`.*,`categories`.* FROM `playlist` left OUTER JOIN `categories` ON `playlist`.`category`=`categories`.`catid`  WHERE `playlist`.`id`=" . $_GET["id"];

$result = $con->query($sql);
//if (mysqli_num_rows($result) > 0) {
$data = '';
$row = mysqli_fetch_assoc($result);

//}

?>

<!--<script type="text/javascript" src="js/jquery.js"></script>-->

<!--<script type="text/javascript" src="js/ajax.js"></script>-->


<?php
$bredcrumb = '<li class="floating-left"><a href="playlist.php" class="floating-left active">' . $Lang->PlayList . '</a></li><span class="floating-left">/</span><li class="floating-left"><a class="floating-left active">' . $Lang->EditPlaylist . '</a></li>';

include "includes/header.php";

?>

<script type="text/javascript">

    ////start khalid 19-9-2016

    $(document).ready(function () {
        $(document).on("click",".flaticon-delete96",function(){
            $(this).closest(".item-added").remove();
        });
    });

    function removeimage(image) {

        $(image).parent().find('#scrimg').hide();

        setdata = {TypeProcesses: 'deletefile', file: "../" + $(image).parent().find('#scrimg').attr('src')};

        $.ajax({

            url: "ajax/function.php",

            type: "POST",

            data: setdata,

            cache: false,

            dataType: 'html',


            success: function (html) {

                console.clear();

                console.log(html);


            }

        });

    }

    function removesound(sound) {
        setdata = {TypeProcesses: 'deletefile', file: "../" + sound};
        $.ajax({
            url: "ajax/function.php",
            type: "POST",
            data: setdata,
            cache: false,
            dataType: 'html',
            success: function (html) {
                console.clear();
                console.log(html);
            }
        });
    }


    function insertid(_array, type) {
        $("#popup_action").fadeOut();
        for (var i = 0; i < _array.length; i++) {
            $("#media_container").append('<div id="book_' + _array[i].id + '" idmedia="' + _array[i].id + '" type="0" title="' + _array[i].name + '" class="item-added floating-left"><label>' + _array[i].name + '</label><span><i class="flaticon-delete96"></i></span></div>');
        }
    }

</script>

<div class="edit-book">
    <div class="form-container">

        <form id="editbook">

            <input type="hidden" name="playlist_id" id="playlist_id" value="<?= $_GET['id']; ?>">

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

                        <?= $Lang->Age; ?>

                    </label>

                    <select class="txt-a floating-left" id="playlist_age" name="playlist_age">

                        <option value="-1" <?php if ($row["grade"] == -1) {
                            echo 'selected';
                        } ?> ><?= $Lang->all; ?></option>

                        <option value="1" <?php if ($row["grade"] == 1) {
                            echo 'selected';
                        } ?> >4-5
                        </option>

                        <option value="2" <?php if ($row["grade"] == 2) {
                            echo 'selected';
                        } ?> >6-8
                        </option>

                        <option value="3" <?php if ($row["grade"] == 3) {
                            echo 'selected';
                        } ?> >9-11
                        </option>

                        <option value="4" <?php if ($row["grade"] == 4) {
                            echo 'selected';
                        } ?> >12-15
                        </option>

                    </select>

                </div>

                <div class="line-row">

                    <label class="lbl-data-a floating-left"><?= $Lang->Price; ?></label>

                    <input type="text" class="txt-a floating-left" id="playlist_price" name="playlist_price"
                           placeholder="<?= $Lang->Price; ?>" value="<?= $row["price"]; ?>">

                </div>

                <div class="line-row">

                    <label class="lbl-data-a floating-left">

                        <?= $Lang->Category ?>

                    </label>

                    <select class="txt-a floating-left" id="category" name="category">

                        <?php

                        $cat_sql = "Select * From  categories";

                        $cat_result = $con->query($cat_sql);

                        if (mysqli_num_rows($cat_result) > 0) {

                            while ($cat_row = mysqli_fetch_assoc($cat_result)) {

                                $selected = '';

                                if ($cat_row['catid'] == $row["catid"]) {

                                    $selected = 'selected';

                                }

                                echo "<option " . $selected . " value='" . $cat_row['catid'] . "'>" . $cat_row['name_' . $lang_code] . "</option>";

                            }

                        }

                        ?>

                    </select>

                </div>

                <div class="line-row">

                    <label class="lbl-data-a floating-left">

                        <?= $Lang->PlaylistType ?>

                    </label>


                    <select class="txt-a floating-left" id="type" name="type">
                        <option <?php if ($row["type"] == '-1') {
                            echo "selected='selected'";
                        } ?> value='-1'><?= $Lang->All; ?></option>

                        <option <?php if ($row["type"] == '0') {
                            echo "selected='selected'";
                        } ?> value='0'><?= $Lang->worksheets; ?></option>

                        <option <?php if ($row["type"] == '12') {
                            echo "selected='selected'";
                        } ?> value='12'><?= $Lang->worksheetinteractive; ?></option>

                        <option <?php if ($row["type"] == '3') {
                            echo "selected='selected'";
                        } ?> value='3'><?= $Lang->Sounds1; ?></option>

                        <option <?php if ($row["type"] == '4') {
                            echo "selected='selected'";
                        } ?> value='4'><?= $Lang->Videos1; ?></option>
                        <option <?php if ($row["type"] == '11') {
                            echo "selected='selected'";
                        } ?> value='11'><?= $Lang->Games; ?></option>

                    </select>
                </div>
            </div>

            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->Book; ?></label>
                <div id="media_container" class="add-items-container floating-left">
                    <?php
                    $sqllink = "SELECT * FROM playlist_media WHERE playlistid=" . $_GET['id'];
                    $resultlink = $con->query($sqllink);
                    if (mysqli_num_rows($resultlink) > 0) {
                        while ($rowlink = mysqli_fetch_assoc($resultlink)) {
                            echo '<div id="media_' . $rowlink['id'] . '" idmedia="' . $rowlink['mediaid'] . '" type="' . $rowlink['type'] . '" title="' . $rowlink['title'] . '" class="item-added floating-left"><label>' . $rowlink['title'] . '</label><span><i class="flaticon-delete96"></i></span></div>';
                        }
                    }
                    ?>
                </div>
                <a onclick='$("#popup_action").fadeIn();$("#getpage").attr("src","playlist_media.php")'
                   class="add-button floating-left"><i class="flaticon-add64"></i></a>
            </div>

            <div class="display-inline-block floating-left">


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
                    <label class="lbl-data-a floating-left"><?= $Lang->DescriptionAr; ?></label>
                    <textarea class="floating-left txt-b" name="descriptionar" id="descriptionar"
                              placeholder="<?= $Lang->DescriptionAr; ?>"><?= $row['description_ar']; ?></textarea>

                </div>

                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->DescriptionEn; ?></label>
                    <textarea class="floating-left txt-b" name="descriptionen" id="descriptionen"
                              placeholder="<?= $Lang->DescriptionEn; ?>"><?= $row['description_en']; ?></textarea>

                </div>


                <div class="line-row">

                    <label class="lbl-data-a floating-left"><?= $Lang->Thumb; ?></label>

                    <div class="fu-container-a floating-left">
                        <label class="floating-left flaticon-cloud148 label-a"></label>
                        <label class="label-b floating-left" id="lblbook_cover"></label>
                        <input onchange="readImg(this,'thumb_img')" class="txt-a floating-left" id="thumb" type="file"
                               name="thumb" placeholder="<?= $Lang->Thumb; ?>" value="">
                    </div>

                    <?php

                    if (is_file("playlist/thumbs/". $row["id"] .".jpg")) {
                        $src = "playlist/thumbs/" . $row["id"] . ".jpg";
                    } else {
                        $src = "";
                    }

                    ?>
                    <img class="book-cover-img floating-left" id="thumb_img" src="<?= $src; ?>">

                </div>
                <div class="line-row">

                    <label class="lbl-data-a floating-left"><?= $Lang->image_larg;?></label>

                    <div class="fu-container-a floating-left">

                        <label class="floating-left flaticon-cloud148 label-a"></label>

                        <label class="label-b floating-left" id="lblbook_cover"></label>

                        <input onchange="readImg(this,'image_larg_img')" class="txt-a floating-left" id="image_larg" type="file" name="image_larg" placeholder="<?= $Lang->image_larg;?>" value="">

                    </div>

                    <?php

                    if(is_file("playlist/thumbs/".$row["id"]."_larg.jpg")){
                        $src="playlist/thumbs/".$row["id"]."_larg.jpg";
                    }else{
                        $src="";
                    }
                    ?>

                    <img class="book-cover-img floating-left" id="image_larg_img" src="<?=$src;?>">

                </div>
        </form>

        <div class="line-row">
            <label class="lbl-data-a floating-left"><?= $Lang->isPublished; ?></label>
            <input class="floating-left check-box" type="checkbox" name="ispublished" id="ispublished"
                   value='<?= $row['status']; ?>' <?php if ($row['status'] == 1) {
                echo 'checked="checked"';
            } ?>><label class="floating-left lbl-data-b" for="ispublished"><?= $Lang->isPublished; ?></label>
        </div>

    </div>
    <input name="commit" id="update_playlist" type="button" value="<?= $Lang->Update; ?>"
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
<?php

include "includes/footer.php";

?>

