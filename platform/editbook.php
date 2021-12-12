<?php
/**
 * User: khalid alomiri
 * Date: 1/4/2016
 * Time: 1:17 PM
 */
$cuerrentpage="index.php";
if(session_status()==PHP_SESSION_NONE){ session_start();}

include_once('config.php') ;
include_once('includes/language.php') ;
include_once('../includes/function.php');

if(isset($_GET['id']) && $_GET['id']=="new"){
    if($_SESSION["user"]['permession']==1 ||$_SESSION["user"]['permession']==6) {
        $sql ="INSERT INTO books (bookid,category,userid) VALUES ('',0,".$_SESSION["user"]["userid"].")";
        $con->query($sql);
        $id=mysqli_insert_id($con);
 
        @mkdir("books/".$id);
        header("location: editbook.php?id=".$id);
        exit();
    }else{
        header("location: index.php");
        exit();
    }

}



$sql ="SELECT * FROM books WHERE bookid=".$_GET['id'];
$result = $con->query($sql);
if (mysqli_num_rows($result) > 0) {
    $data='';
    $row = mysqli_fetch_assoc($result);

}
?>

<!--//start khalid 19-9-2016-->
<!--<script type="text/javascript" src="js/ajax.js"></script>-->



<?php
$bredcrumb = '<li class="floating-left"><a href="index.php" class="floating-left">'.$Lang->Books.'</a></li><span class="floating-left">/</span><li class="floating-left"><a href="editbook.php" class="floating-left">'.$Lang->EditBook.'</a></li>';

include "includes/header.php";
?>
<link rel="stylesheet" type="text/css" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/fonts/font-awesome/css/font-awesome.min.css"/>
<script type="text/javascript" src="../js/jquery.popline.min.js"></script>
<link rel="stylesheet" type="text/css" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/css/default.css">


<script type="text/javascript" >
    $(document).ready(function() {

        $(".poplineable").popline();
        $("#Category").val(<?=$row['category']?>);
    });

    //end  khalid 19-9-2016
    function savebook(){
        var msg="";
        if($("#book_name").val().trim()==""){
            msg+=window.Lang.PleaseInsertBookName;
        }else if($("#book_width").val().trim()==""){
            msg+=window.Lang.PleaseInsertBookWidth;
        }else if(!isNumeric($("#book_width").val().trim())){
            msg+=window.Lang.InvalidBookWidth;
        }else if($("#book_height").val().trim()==""){
            msg+=window.Lang.PleaseInsertBookHeight;
        }else if(!isNumeric($("#book_height").val().trim())){
            msg+=window.Lang.InvalidBookHeight;
        }


        btype=0;
        package=0;
        if($("#package")[0].checked){
            package=1;
        }
        if($("#paperbook")[0].checked){
            btype+=1;
        }
        if($("#ebook")[0].checked){
            btype+=2;
        }
        if($("#enrichmentbook")[0].checked){
            btype+=4;
        }
        if($("#ispublished").prop("checked")){
            isPublished=1;
        }else{
            isPublished=0;
        }
        if($("#teacherbook").prop("checked")){
            teacherbook=1;
        }else{
            teacherbook=0;
        }

        if($("#curriculum").prop("checked")){
            curriculum=1;
        }else{
            curriculum=0;
        }


        if($("#Store").prop("checked")){
            store=1;
        }else{
            store=0;
        }
        if(msg==""){
            var data={
                book_id:$("#book_id").val(),
                package:package,
                book_series:$("#book_series").val(),
                book_name:$("#book_name").val(),
                book_width:$("#book_width").val(),
                book_height:$("#book_height").val(),
                book_cover:$("#book_cover_img").attr("src"),
                book_lang:$("#language").val(),
                Category:$("#Category").val(),
                description_ar:$("#bookdescription_ar").html(),
                description_en:$("#bookdescription_en").html(),
                seodescription_en:$("#seodescription_en").val(),
                seodescription_ar:$("#seodescription_ar").val(),
                oldprice:$("#oldbook_price").val(),
                awidth:$("#actual_width").val(),
                aheight:$("#actual_height").val(),
                weight:$("#book_weight").val(),
                author_en:$("#book_authoren").val(),
                author_ar:$("#book_authorar").val(),
                isbn:$("#book_isbn").val(),
                binding:$("#book_binding").val(),
                grade:$("#book_grade").val(),
                age:$("#book_age").val(),
                year:$("#publish_year").val(),
                price:$("#book_price").val(),
                iprice:$("#book_iprice").val(),
                eprice:$("#book_eprice").val(),
                semester:$("#semester").val(),
                book_register:$("#book_register").val(),
                book_pagescount:$("#book_pagescount").val(),
                back_cover:$("#back_cover_img").attr("src"),
                publisher:$("#Publishers").val(),

                booktype:btype,
                ispublished:isPublished,
                teacherbook:teacherbook,
                curriculum:curriculum,
                store:store,
                TypeProcesses:'updatebook'
            };

            setdatafunction('updatebook',data);
            $("#screenshots_form").submit();
        }else{
            swal(window.Lang['Error'],msg,'error');
        }

    }
    ////start khalid 26-9-2016
    function removeimage(image){

        $(image).parent().find('#scrimg').hide();
        setdata = {TypeProcesses: 'deletefile',file:"../"+ $(image).parent().find('#scrimg').attr('src')};
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

////end khalid 19-9-2016


    }
</script>

<div class="edit-book">
    <div class="form-container">
        <form id="editbook">
            <input type="hidden" name="book_id" id="book_id" value="<?= $_GET['id']; ?>">
            <div class="display-inline-block floating-left">
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->BookName ?></label>
                    <input type="text" class="txt-a floating-left" id="book_name" name="book_name" placeholder="<?= $Lang->BookName ?>" value="<?=$row["name"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->BookWidth ?></label>
                    <input type="text" class="txt-a floating-left" id="book_width" name="book_width" placeholder="<?= $Lang->BookWidth ?>" value="<?=$row["width"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->BookHeight ?></label>
                    <input type="text" class="txt-a floating-left" id="book_height" name="book_height" placeholder="<?= $Lang->BookHeight ?>" value="<?=$row["height"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->BookRWidth ?></label>
                    <input type="text" class="txt-a floating-left" id="actual_width" name="actual_width" placeholder="<?= $Lang->BookRWidth ?>" value="<?=$row["awidth"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->BookRHeight ?></label>
                    <input type="text" class="txt-a floating-left" id="actual_height" name="actual_height" placeholder="<?= $Lang->BookRHeight ?>" value="<?=$row["aheight"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->BookWeight?></label>
                    <input type="text" class="txt-a floating-left" id="book_weight" name="book_weight" placeholder="<?= $Lang->BookWeight ?>" value="<?=$row["weight"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->AuthorEn ?></label>
                    <input type="text" class="txt-a floating-left" id="book_authoren" name="book_authoren" placeholder="<?= $Lang->AuthorEn;?>" value="<?=$row["author_en"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->AuthorAr ?></label>
                    <input type="text" class="txt-a floating-left" id="book_authorar" name="book_authorar" placeholder="<?= $Lang->AuthorAr;?>" value="<?=$row["author_ar"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->ISBN ?></label>
                    <input type="text" class="txt-a floating-left" id="book_isbn" name="book_isbn" placeholder="<?= $Lang->ISBN;?>" value="<?=$row["isbn"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->NoFiling ?></label>
                    <input type="text" class="txt-a floating-left" id="book_register" name="book_register" placeholder="<?= $Lang->NoFiling;?>" value="<?=$row["filling"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Numberofpages ?></label>
                    <input type="text" class="txt-a floating-left" id="book_pagescount" name="book_pagescount" placeholder="<?= $Lang->Numberofpages;?>" value="<?=$row["pages_count"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?=$Lang->Binding;?>
                    </label>
                    <select class="txt-a floating-left" id="book_binding" name="book_binding">
                        <option value="0" <?php if($row["covertype"]==0){echo 'selected';}?> ><?=$Lang->SoftCover;?></option>
                        <option value="1" <?php if($row["covertype"]==1){echo 'selected';}?> ><?=$Lang->HardCover;?></option>
                    </select>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?=$Lang->Grade;?>
                    </label>
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
                    <label class="lbl-data-a floating-left">
                        <?=$Lang->Age;?>
                    </label>
                    <select class="txt-a floating-left" id="book_age" name="book_age">
                        <option value="-1" <?php if($row["age"]==-1){echo 'selected';}?> ><?=$Lang->all;?></option>
                        <option value="1" <?php if($row["age"]==1){echo 'selected';}?> >4-5</option>
                        <option value="2" <?php if($row["age"]==2){echo 'selected';}?> >6-8</option>
                        <option value="3" <?php if($row["age"]==3){echo 'selected';}?> >9-11</option>
                        <option value="4" <?php if($row["age"]==4){echo 'selected';}?> >12-15</option>
                        <option value="5" <?php if($row["age"]==5){echo 'selected';}?> >+22</option>
                    </select>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->PublishYear;?></label>
                    <input type="text" class="txt-a floating-left" id="publish_year" name="publish_year" placeholder="<?= $Lang->PublishYear;?>" value="<?=$row["year"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Price;?></label>
                    <input type="text" class="txt-a floating-left" id="book_price" name="book_price" placeholder="<?= $Lang->Price;?>" value="<?=$row["price"]; ?>">

                </div>
                <div class="line-row">

                    <label class="lbl-data-a floating-left">oldprice</label>

                    <input type="text" class="txt-a floating-left" id="oldbook_price" name="oldbook_price" placeholder="oldprice" value="<?=$row["oldprice"]; ?>">

                </div>
            </div>
            <div class="display-inline-block floating-left">
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->eprice;?></label>
                    <input type="text" class="txt-a floating-left" id="book_eprice" name="book_eprice" placeholder="<?= $Lang->eprice;?>" value="<?=$row["eprice"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">Series id</label>
                    <input type="text" class="txt-a floating-left" id="book_series" name="book_series" placeholder="book series id " value="<?=$row["seriesid"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->iprice;?></label>
                    <input type="text" class="txt-a floating-left" id="book_iprice" name="book_iprice" placeholder="<?= $Lang->iprice;?>" value="<?=$row["iprice"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?=$Lang->Semester;?>
                    </label>
                    <select class="txt-a floating-left" id="semester" name="semester">
                        <option value="0" <?php if($row["semester"]==0){echo 'selected';}?> ><?=$Lang->all;?></option>
                        <option value="1" <?php if($row["semester"]==1){echo 'selected';}?> ><?=$Lang->One;?></option>
                        <option value="2" <?php if($row["semester"]==2){echo 'selected';}?> ><?=$Lang->Tow;?></option>
                    </select>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?= $Lang->Category ?>
                    </label>
                    <select class="txt-a floating-left" id="Category" name="Category" >
                        <option value='0'>---------------</option>
                        <?php
                        $cat_sql = "Select * From  categories WHERE `parent`=0";
                        $cat_result = $con->query($cat_sql);
                        if (mysqli_num_rows($cat_result) > 0) {
                            while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                                echo getCategories($cat_row['catid'],"categories");
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?=$Lang->Language;?>
                    </label>
                    <select class="txt-a floating-left" id="language" name="language">
                        <option <?php if($row["language"]=='Ar'){echo "selected='selected'";}?> value='Ar'><?=$Lang->Arabic;?></option>
                        <option <?php if($row["language"]=='En'){echo "selected='selected'";}?> value='En'><?=$Lang->English;?></option>
                        <option <?php if($row["language"]=='Fr'){echo "selected='selected'";}?> value='Fr'><?=$Lang->France;?></option>
                    </select>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->BookType;?></label>
                    <input class="floating-left check-box" type="checkbox" name="paperbook" id="paperbook" value='1' <?php if($row['booktype']==1 || $row['booktype']==3 || $row['booktype']==5 || $row['booktype']==7){echo 'checked="checked"';}?>><label class="floating-left lbl-data-b" for="paperbook"><?=$Lang->PaperBook;?></label>
                    <input class="floating-left check-box" type="checkbox" name="ebook" id="ebook" value='2' <?php if($row['booktype']==2 || $row['booktype']==3 || $row['booktype']==6 || $row['booktype']==7){echo 'checked="checked"';}?>><label class="floating-left floating-left lbl-data-b" for="ebook"><?=$Lang->ebook;?></label>
                    <input class="floating-left check-box" type="checkbox" name="enrichmentbook" id="enrichmentbook" value='4' <?php if($row['booktype']==4 || $row['booktype']==5 || $row['booktype']==6 || $row['booktype']==7){echo 'checked="checked"';}?>><label class="floating-left floating-left lbl-data-b" for="enrichmentbook"><?=$Lang->EnrichmentBook;?></label>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">Package</label>
                    <input class="floating-left check-box" type="checkbox" name="package" id="package" value='<?=$row['package']?>' <?php if($row['package']==1){echo 'checked="checked"';}?>><label class="floating-left lbl-data-b" for="package">Package</label>

                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->BookDescriptionAr;?></label>
                    <div contenteditable="true" class="floating-left txt-b poplineable" name="bookdescription_ar" id="bookdescription_ar"><?=$row['description_ar'];?></div>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->BookDescriptionEn;?></label>
                    <div contenteditable="true" class="floating-left txt-b poplineable" name="bookdescriptionen_en" id="bookdescription_en"><?=$row['description_en'];?></div>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->SEODescriptionAr;?></label>
                    <textarea class="floating-left txt-b" name="seodescription_ar" id="seodescription_ar" placeholder="<?= $Lang->SEODescriptionAr;?>"><?=$row['seodescription_ar'];?></textarea>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->SEODescriptionEn;?></label>
                    <textarea class="floating-left txt-b" name="seodescription_en" id="seodescription_en" placeholder="<?= $Lang->SEODescriptionEn;?>"><?=$row['seodescription_en'];?></textarea>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->BookCover;?></label>
                    <div class="fu-container-a floating-left">
                        <label class="floating-left flaticon-cloud148 label-a"></label>
                        <label class="label-b " id="lblbook_cover"></label>
                        <input onchange="readImg(this,'book_cover_img')" class="txt-a floating-left" id="book_cover" type="file" name="book_cover" placeholder="<?= $Lang->BookCover;?>" value="">
                    </div>
                    <?php
                    if(is_file("books/".$_GET["id"]."/cover.jpg")){
                        $src="books/".$_GET["id"]."/cover.jpg";
                    }else{
                        $src="";
                    }
                    ?>
                    <img class="book-cover-img floating-left" id="book_cover_img" src="<?=$src;?>">
                    <?php
                    if(is_file("books/".$_GET["id"]."/back.jpg")){
                        $src="books/".$_GET["id"]."/back.jpg";
                    }else{
                        $src="";
                    }
                    ?>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->BackCover;?></label>
                    <div class="fu-container-a floating-left">
                        <label class="floating-left flaticon-cloud148 label-a"></label>
                        <label class="label-b floating-left" id="lblback_cover"></label>
                        <input onchange="readImg(this,'back_cover_img')" class="txt-a floating-left" id="back_cover" type="file" name="back_cover" placeholder="<?= $Lang->BackCover;?>" value="">
                    </div>
                    <img class="book-cover-img floating-left" id="back_cover_img" src="<?=$src;?>">
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



        <form id="media_form" action="ajax/platform.php?process=Approvals&id=<?= $_GET['id']; ?>&filename=Approvals" method="post" target="hidden_iframe" enctype="multipart/form-data">
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->Approvals; ?></label>
                <div class="fu-container-a floating-left">
                    <label class="floating-left flaticon-cloud148 label-a"></label>
                    <label class="label-b floating-left" id="lblApprovals"></label>
                    <input onchange=' $("#media_form").submit();' class="txt-a floating-left" id="Filemedia" type="file" name="Filemedia"
                           placeholder="<?= $Lang->Approvals; ?>" value="">
                </div>
            </div>
        </form>
        <div class="line-row" style="display: inline-block">
        <?php

            $dir="books/".$_GET["id"]."/relatedbook/Approvals.pdf";
            if (file_exists($dir)) {
                 echo "<a href='".$dir."' target='_blank' class='floating-left' >".$Lang->Approvals."</a> ";
            }
        ?>
        </div>
        <form id="media_form2" action="ajax/platform.php?process=Lessonplans&id=<?= $_GET['id']; ?>&filename=Lessonplan" method="post" target="hidden_iframe" enctype="multipart/form-data">
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->Lessonplans; ?></label>
                <div class="fu-container-a floating-left">
                    <label class="floating-left flaticon-cloud148 label-a"></label>
                    <label class="label-b floating-left" id="lblFilemedia2"></label>
                    <input onchange=' $("#media_form2").submit();' class="txt-a floating-left" id="Filemedia2" type="file" name="Filemedia2"
                           placeholder="<?= $Lang->Lessonplans; ?>" value="">

                </div>
            </div>

        </form>
        <div class="line-row" style="display: inline-block">
            <?php
            $dir="books/".$_GET["id"]."/relatedbook/Lessonplan.pdf";
            if (file_exists($dir)) {
                echo "<a href='".$dir."' target='_blank' class='floating-left' >".$Lang->Lessonplans."</a> ";
            }
            ?>
        </div>
        <form id="media_form3" action="ajax/platform.php?process=teacherpdf&id=<?= $_GET['id']; ?>&filename=teacher" method="post" target="hidden_iframe" enctype="multipart/form-data">
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->TeacherPDF; ?></label>
                <div class="fu-container-a floating-left">
                    <label class="floating-left flaticon-cloud148 label-a"></label>
                    <label class="label-b floating-left" id="lblFilemedia3"></label>
                    <input onchange=' $("#media_form3").submit();' class="txt-a floating-left" id="Filemedia3" type="file" name="Filemedia3"
                           placeholder="<?= $Lang->TeacherPDF; ?>" value="">

                </div>
            </div>

        </form>
        <div class="line-row" style="display: inline-block">
            <?php
            $dir="books/secured/".$_GET["id"]."/teacher.pdf";
            if (file_exists($dir)) {
                echo "<a href='".$dir."' target='_blank' class='floating-left' >".$Lang->TeacherPDF."</a> ";
            }
            ?>
        </div>
        <form id="media_form4" action="ajax/platform.php?process=teacherexe&id=<?= $_GET['id']; ?>&filename=teacher" method="post" target="hidden_iframe" enctype="multipart/form-data">
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->TeacherEXE; ?></label>
                <div class="fu-container-a floating-left">
                    <label class="floating-left flaticon-cloud148 label-a"></label>
                    <label class="label-b floating-left" id="lblFilemedia4"></label>
                    <input onchange=' $("#media_form4").submit();' class="txt-a floating-left" id="Filemedia4" type="file" name="Filemedia4"
                           placeholder="<?= $Lang->TeacherEXE; ?>" value="">

                </div>
            </div>

        </form>
        <div class="line-row" style="display: inline-block">
            <?php
            $dir="books/secured/".$_GET["id"]."/teacher.exe";
            if (file_exists($dir)) {
                echo "<a href='".$dir."' target='_blank' class='floating-left' >".$Lang->TeacherEXE."</a> ";
            }
            ?>
        </div>
        <iframe id="hidden_iframe" name="hidden_iframe" style="width: 0px;height: 0px;"></iframe>


        <div class="line-row">
            <label class="lbl-data-a floating-left"><?= $Lang->isPublished;?></label>
            <input class="floating-left check-box" type="checkbox" name="ispublished" id="ispublished" value='<?=$row['status'];?>' <?php if($row['status']==1){echo 'checked="checked"';}?>><label class="floating-left lbl-data-b" for="ispublished"><?=$Lang->isPublished;?></label>
        </div>
        <div class="line-row">
            <label class="lbl-data-a floating-left"><?=$Lang->TeacherBook;?></label>
            <input class="floating-left check-box" type="checkbox" name="teacherbook" id="teacherbook" value='<?=$row['isteacherbook'];?>' <?php if($row['isteacherbook']==1){echo 'checked="checked"';}?>><label class="floating-left lbl-data-b" for="teacherbook"><?=$Lang->TeacherBook;?></label>
        </div>
        <div class="line-row">
            <label class="lbl-data-a floating-left"><?=$Lang->Curriculum;?></label>
            <input class="floating-left check-box" type="checkbox" name="curriculum" id="curriculum" value='<?=$row['curriculum'];?>' <?php if($row['curriculum']==1){echo 'checked="checked"';}?>><label class="floating-left lbl-data-b" for="curriculum"><?=$Lang->Curriculum;?></label>
        </div>
        <div class="line-row">
            <label class="lbl-data-a floating-left" ><?=$Lang->BookStore;?></label>
            <input class="floating-left check-box" type="checkbox" name="Store" id="Store" value='<?=$row['store'];?>' <?php if($row['store']==1){echo 'checked="checked"';}?>><label class="floating-left lbl-data-b" for="Store"><?=$Lang->BookStore;?></label>
        </div>

        <div class="line-row">
            <label class="lbl-data-a floating-left">
                <?=$Lang->Publishers;?>
            </label>
            <select class="txt-a floating-left" id="Publishers" name="Publishers">
                <option value="0">------------</option>
                <?php
                $cat_sql = "Select * From  publishers";
                $cat_result = $con->query($cat_sql);
                if (mysqli_num_rows($cat_result) > 0) {
                    while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                        if($row["publisher"]==$cat_row["pid"]){
                            $selected='selected';
                        }else{
                            $selected='';
                        }
                        echo "<option " . $selected . " value='" . $cat_row['pid'] . "'>" . $cat_row['pname_' . $cat_code] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
    </div>
        <iframe id="hidden_iframe" name="hidden_iframe" style="width: 0px;height: 0px;"></iframe>
        <input name="commit" onclick="savebook()" type="button" value="<?= $Lang->Update;?>" class="btn-default-a floating-right clear-both">
</div>
</div>
<?php
include "includes/footer.php";
?>
