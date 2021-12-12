<?php


$cuerrentpage = "furniture.php";

if(session_status()==PHP_SESSION_NONE){ session_start();}

include_once('config.php') ;
include_once('includes/language.php') ;
include_once('../includes/function.php');

if(isset($_GET['id']) && $_GET['id']=="new"){
    if($_SESSION["user"]['permession']==1 ||$_SESSION["user"]['permession']==6) {
        $sql ="INSERT INTO `products`(`productid`, `name_ar`, `name_en`,`ISBN`, `thumbnail`, `count`, `color`, `Width`, `Height`, `Weight`, `Price`, `brand`, `description_en`, `description_ar`, `status`, `department`, `age`) VALUES (null,'','','','','','','','','','','','','','','','')";
        $con->query($sql);
        $id=mysqli_insert_id($con);

        @mkdir("products/".$id);
        header("location: editfurniture.php?id=".$id);
        exit();
    }else{
        header("location: index.php");
        exit();
    }

}



$sql ="SELECT * FROM products WHERE productid=".$_GET['id'];
$result = $con->query($sql);
if (mysqli_num_rows($result) > 0) {
    $data='';
    $row = mysqli_fetch_assoc($result);

}



include_once('config.php');

include_once('includes/language.php');

include_once('../includes/function.php');
$bredcrumb = '<li class="floating-left"><a href="furniture.php" class="floating-left">'.$Lang->Furniture.'</a></li><span class="floating-left">/</span><li class="floating-left"><a href="editfurniture.php" class="floating-left active">'.$Lang->EditFurniture.'</a></li>';

include "includes/header.php";

?>




<div class="edit-book">
    <div class="form-container">
        <form id="editbroduct" action="ajax/platform.php?process=mediafile&id=<?= $row['id']; ?>" method="post" target="hidden_iframe" enctype="multipart/form-data">
            <input type="hidden" name="product_id" id="product_id" value="<?= $_GET['id']; ?>">
            <div class="display-inline-block floating-left">
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->arabicname ?></label>
                    <input type="text" class="txt-a floating-left" id="title_ar" name="title_ar" placeholder="<?= $Lang->arabicname ?>" value="<?=$row['name_ar']?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->englishname ?></label>
                    <input type="text" class="txt-a floating-left" id="title_en" name="title_en" placeholder="<?= $Lang->englishname ?>" value="<?=$row['name_en']?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Width; ?></label>
                    <input type="text" class="txt-a floating-left" id="product_width" name="product_width" placeholder="<?= $Lang->Width; ?>" value="<?=$row['Width']?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Height; ?></label>
                    <input type="text" class="txt-a floating-left" id="product_height" name="product_height" placeholder="<?= $Lang->Height; ?>" value="<?=$row['Height']?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Weight; ?></label>
                    <input type="text" class="txt-a floating-left" id="product_weight" name="product_weight" placeholder="<?= $Lang->Weight; ?>" value="<?=$row['Weight']?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->ISBN; ?></label>
                    <input type="text" class="txt-a floating-left" id="product_ISBN" name="product_weight" placeholder="<?= $Lang->ISBN; ?>" value="<?=$row['ISBN']?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?= $Lang->Age; ?>
                    </label>
                    <select class="txt-a floating-left" id="product_age" name="product_age">
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
                    <input type="text" class="txt-a floating-left" id="product_price" name="product_price" placeholder="<?= $Lang->Price; ?>" value="<?=$row['Price']?>">
                </div>
                               <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->CompanyName; ?></label>
                    <select class="txt-a floating-left" id="product_brand" name="product_brand">
                        <option value='0'>---------------</option>
                        <?php
                        $cat_sql = "Select * From  brand WHERE `parent`=0";
                        $cat_result = $con->query($cat_sql);
                        if (mysqli_num_rows($cat_result) > 0) {
                            while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                                echo getCategories($cat_row['catid'], "brand");
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="line-row">

                    <label class="lbl-data-a floating-left"><?= $Lang->BookDescriptionAr; ?></label>

                    <textarea class="floating-left txt-b" name="productdescription_ar" id="productdescription_ar"

                              placeholder="<?= $Lang->BookDescriptionAr; ?>"><?=$row['description_ar']?></textarea>

                </div>
                <div class="line-row">

                    <label class="lbl-data-a floating-left"><?= $Lang->BookDescriptionEn; ?></label>

                    <textarea class="floating-left txt-b" name="productdescription_en" id="productdescription_en"

                              placeholder="<?= $Lang->BookDescriptionEn; ?>"><?=$row['description_en']?></textarea>

                </div>

            </div>
            <div class="display-inline-block floating-left">
                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?= $Lang->Color ?>
                    </label>
                    <div id="colorSelector" class="floating-left"><div id="getvalue" style="background-color: <?=$row['color']?>"></div></div>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?= $Lang->Category ?>
                    </label>
                    <select class="txt-a floating-left" id="departments" name="departments">
                        <option value='0'>---------------</option>
                        <?php
                        $cat_sql = "Select * From  departments WHERE `parent`=0";
                        $cat_result = $con->query($cat_sql);
                        if (mysqli_num_rows($cat_result) > 0) {
                            while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                                echo getCategories($cat_row['catid'], "departments");
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Thumbnail; ?></label>
                    <div class="fu-container-a floating-left">
                        <label class="floating-left flaticon-cloud148 label-a"></label>
                        <label class="label-b " id="lblbook_cover"></label>
                        <input onchange="readImg(this,'thumbnail_small_img')" class="txt-a floating-left" id="thumbnail_small" type="file" name="thumbnail_small" placeholder="<?= $Lang->Thumbnail; ?>" value="">
                    </div>
                    <?php
                    if (is_file("products/" . $_GET["id"] . "/thumbnail_small.jpg")) {
                        $src = "products/" . $_GET["id"] . "/thumbnail_small.jpg?v=".rand();
                    } else {
                        $src = "";
                    }
                    ?>
                    <a id='filemedia_tumb' class='floating-left'><span onclick='remoimage("thumbnail_small.jpg")'><i class='flaticon-delete96'></i></span><img class="book-cover-img floating-left"  id="thumbnail_small_img"  src="<?= $src; ?>"></a>



                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->image_larg; ?></label>
                    <div class="fu-container-a floating-left">
                        <label class="floating-left flaticon-cloud148 label-a"></label>
                        <label class="label-b floating-left" id="lblback_cover"></label>
                        <input onchange="readImg(this,'image_larg_img')" class="txt-a floating-left" id="image_larg" type="file" name="image_larg" placeholder="<?= $Lang->image_larg; ?>" value="">
                    </div>
                    <?php
                    if (is_file("products/" . $_GET["id"] . "/image_larg.jpg")) {
                        $src = "products/" . $_GET["id"] . "/image_larg.jpg?v=".rand();
                    } else {
                        $src = "";
                    }
                    ?>
                    <a id='filemedia_tumb' class='floating-left'><span  onclick='remoimage("<?= $row['productid'] ?>image_larg.jpg")'><i class='flaticon-delete96'></i></span> <img class="book-cover-img floating-left"  id="image_larg_img"  src="<?= $src; ?>"></a>
                </div>
        </form>

        <div class="line-row">

            <label class="lbl-data-a floating-left"><?= $Lang->isPublished; ?></label>

            <input class="floating-left check-box" type="checkbox" name="ispublished" id="ispublished" value='<?= $row['status']; ?>' <?php if ($row['status'] == 1) {
                echo 'checked="checked"';
            } ?>'>
            <label class="floating-left lbl-data-b" for="ispublished"><?= $Lang->isPublished; ?></label>

        </div>
    </div>

    <iframe id="hidden_iframe" name="hidden_iframe" style="width: 0px;height: 0px;"></iframe>

    <input name="commit" onclick="saveproduct()" type="button" value="<?= $Lang->Update; ?>"

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
    $(document).ready(function () {
        $("#product_brand").val(<?=$row['brand']?>);
        $("#departments").val(<?=$row['department']?>);




    });
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


    function saveproduct() {
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

        if (msg == "") {


           var data = {
                product_id: $("#product_id").val(),
                title_ar: $("#title_ar").val(),
                title_en: $("#title_en").val(),
                product_width: $("#product_width").val(),
                product_height: $("#product_height").val(),
               product_weight: $("#product_weight").val(),
               product_ISBN: $("#product_ISBN").val(),
                product_price: $("#product_price").val(),
               product_brand: $("#product_brand").val(),
                product_age: $("#product_age").val(),
               product_color: $("#getvalue").css( "background-color" ),
                departments: $("#departments").val(),
                description_ar: $("#productdescription_ar").val(),
                description_en: $("#productdescription_en").val(),
                thumbnail_small: $("#thumbnail_small_img").attr("src"),
                image_larg: $("#image_larg_img").attr("src"),
                price: $("#product_price").val(),
                ispublished: isPublished,

                TypeProcesses: 'updateproducts'
            };
        
            setdatafunction('updateproduct', data);

            //$("#editbroduct").submit();
        } else {
            swal(window.Lang['Error'], msg, 'error');
        }
    }


</script>


<?php

include "includes/footer.php";

?>

