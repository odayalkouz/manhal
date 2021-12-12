<?php
/**
 * User: khalid alomiri
 * Date: 1/4/2016
 * Time: 1:17 PM
 */
$cuerrentpage="index.php";
$bredcrumb = "Add Book";

if(session_status()==PHP_SESSION_NONE){ session_start();}
if($_SESSION["user"]['permession']!=1 && $_SESSION["user"]['permession']!=6) {

    header("location: index.php");
    exit();
}
include_once('config.php') ;
include_once('includes/language.php') ;

if(isset($_GET['copy']) && $_GET['copy']!=""){
    $isCopy=$_GET['copy'];
}else{
    $isCopy="";
}
?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<!--<script type="text/javascript" src="js/ajax.js"></script>-->
<script type="text/javascript" >
    function savebook(){
        if($("#book_name").val()==''||$("#book_width").val()==''||$("#book_height").val()=='')
        {
            swal(window.Lang['error'],window.Lang['Youmustfillinallfields'],'error');
            return ;
        }

        btype=0;
        if($("#paperbook")[0].checked){
            btype+=1;
        }
        if($("#ebook")[0].checked){
            btype+=2;
        }
        if($("#enrichmentbook")[0].checked){
            btype+=4;
        }
        var data=
        {
            book_id:$("#book_id").val(),
            book_name:$("#book_name").val(),
            book_width:$("#book_width").val(),
            book_height:$("#book_height").val(),
            book_cover:$("#book_cover_img").attr("src"),
            book_lang:$("#language").val(),
            Category:$("#Category").val(),
            description:$("#bookdescription").val(),
            booktype:btype,
            TypeProcesses:'createbook',
            iscopy:"<?=$isCopy;?>",
            bookweight:$("#book_weight").val(),
            author:btype,
            price:btype,
            isbn:btype,
            covertype:btype

        };
        setdatafunction('createbook',data);
    }
</script>
<?php
include "includes/header.php";
?>
<div class="edit-book">
    <div class="title-pages text-left">
        <h1><?= $Lang->AddBook ?></h1>
    </div>
    <div class="form-container floating-left">
        <div class="left-container floating-left">
        <form id="editbook">
            <input type="hidden" name="book_id" id="book_id">
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->BookName?></label>
                <input type="text" class="txt-a floating-left" id="book_name" name="book_name" placeholder="<?= $Lang->BookName ?>" value="">
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->BookWidth ?></label>
                <input type="text" class="txt-a floating-left" id="book_width" name="book_width" placeholder="<?= $Lang->BookWidth ?>" value="">
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->BookHeight ?></label>
                <input type="text" class="txt-a floating-left" id="book_height" name="book_height" placeholder="<?= $Lang->BookHeight ?>" value="">
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->BookWeight ?></label>
                <input type="text" class="txt-a floating-left" id="book_weight" name="book_weight" placeholder="<?= $Lang->BookWeight ?>" value="">
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left">
                    <?=$Lang->Category;?>
                </label>
                <select class="txt-a floating-left" id="Category" name="Category">

                    <?php
                    $cat_sql = "Select * From  categories ";
                    $cat_result = $con->query($cat_sql);
                    if (mysqli_num_rows($cat_result) > 0) {
                        while ($cat_row = mysqli_fetch_assoc($cat_result))
                        {
                            echo "<option  value='".$cat_row['catid']."'>".$cat_row['name_'.$lang_code]."</option>";
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
                  <option value='Ar'><?=$Lang->Arabic;?></option>
                  <option value='En'><?=$Lang->English;?></option>
                  <option value='Fr'><?=$Lang->France;?></option>
                </select>
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->BookType;?></label>
                        <input class="floating-left check-box" type="checkbox" name="paperbook" id="paperbook" value='1'><label class="floating-left lbl-data-b" for="paperbook"><?=$Lang->PaperBook;?></label>
                        <input class="floating-left check-box" type="checkbox" name="ebook" id="ebook" value='2'><label class="floating-left lbl-data-b" for="ebook"><?=$Lang->ebook;?></label>
                        <input class="floating-left check-box" type="checkbox" name="enrichmentbook" id="enrichmentbook" value='4'><label class="floating-left lbl-data-b" for="enrichmentbook"><?=$Lang->EnrichmentBook;?></label>
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->BookDescription;?></label>
                   <textarea class="txt-b floating-left" name="bookdescription" id="bookdescription" placeholder="<?= $Lang->BookDescription;?>"></textarea>
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->Author ?></label>
                <input type="text" class="txt-a floating-left" id="book_author" name="book_author" placeholder="<?= $Lang->Author;?>" value="">
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->Price ?></label>
                <input type="text" class="txt-a floating-left" id="book_price" name="book_price" placeholder="<?= $Lang->Price
                ;?>" value="">
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->ISBN ?></label>
                <input type="text" class="txt-a floating-left" id="book_isbn" name="book_isbn" placeholder="<?= $Lang->ISBN;?>" value="">
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left">
                    <?=$Lang->CoverType;?>
                </label>
                <select class="txt-a floating-left" id="covertype" name="covertype">
                    <option value='1'><?=$Lang->PaperCover;?></option>
                    <option value='2'><?=$Lang->English;?></option>
                    <option value='3'><?=$Lang->France;?></option>
                </select>
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->BookCover;?></label>
                <div class="fu-container-a floating-left">
                    <label class="floating-left flaticon-cloud148 label-a"></label>
                    <label class="label-b floating-left" id="lblbook_cover"></label>
                    <input onchange="readImg(this,'book_cover_img')" class="txt-a floating-left" id="book_cover" type="file" name="book_cover" placeholder="<?= $Lang->BookCover;?>" value="">
                </div>
            </div>
        </form>
            <form id="screenshots_form" action="ajax/platform.php?process=screenshots&bookid=new" method="post" target="hidden_iframe" enctype="multipart/form-data">
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->ScreenShoots;?></label>
                    <div class="fu-container-a floating-left">
                        <label class="floating-left flaticon-cloud148 label-a"></label>
                        <label class="label-b floating-left" id="lblbook_shoots"></label>
                        <input class="txt-a floating-left" id="book_shoots" type="file" name="book_shoots[]" multiple placeholder="<?= $Lang->ScreenShoots;?>" value="">
                    </div>
                </div>
            </form>
            <iframe id="hidden_iframe" name="hidden_iframe" style="width: 0px;height: 0px;"></iframe>
        <input name="commit" onclick="savebook()" type="button" value="<?= $Lang->Save ?>" class="btn-default-a floating-left clear-both">
        </div>
        <div class="right-container floating-left" >
            <div class="line-row">
                <img class="book-cover-img" id="book_cover_img">
            </div>
            </div>
        </div>
</div>
<?php
include "includes/footer.php";
?>
