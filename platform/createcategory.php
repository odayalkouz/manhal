<?php
/**
 * User: khalid alomiri
 * Date: 1/4/2016
 * Time: 1:17 PM
 */
$cuerrentpage="category.php";

if(session_status()==PHP_SESSION_NONE){ session_start();}

include_once('config.php') ;
include_once('includes/language.php') ;


?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<!--<script type="text/javascript" src="js/ajax.js"></script>-->
<script type="text/javascript" >
    function savecategory(){
        if($("#categoryname_ar").val()==''||$("#categoryname_en").val()==''){
            swal(window.Lang['error'],window.Lang['Youmustfillinallfields'],'error');
            return ;
        }
        var data={
            categoryname_ar:$("#categoryname_ar").val(),
            categoryname_en:$("#categoryname_en").val(),
            <?php if(isset($_GET['type'])&&$_GET['type']=='stories') {
            echo "TypeProcesses:'createcategorystories'};";
            echo "setdatafunction('createcategorystories',data);";
            }else if(isset($_GET['type'])&&$_GET['type']=='department'){
                echo "TypeProcesses:'createdepartment'};";
                echo "setdatafunction('createdepartment',data);";
            }else if(isset($_GET['type'])&&$_GET['type']=='brand'){
                echo "TypeProcesses:'createbrand'};";
                echo "setdatafunction('createbrand',data);";
        }else{
            echo "TypeProcesses:'createcategory'};";
            echo "setdatafunction('createcategory',data);";
        }
            ?>

//end khalid [000001-7-9-2016]

    }


</script>


<?php

if(isset($_GET['type'])&&$_GET['type']=='stories'){
    $goto='stories_cat.php';
}else if(isset($_GET['type'])&&$_GET['type']=='department'){
    $goto='store_dep.php';
}else if(isset($_GET['type'])&&$_GET['type']=='brand'){
    $goto='store_brands.php';
}else{
    $goto='createcategory.php';
}

$bredcrumb = '<li class="floating-left"><a href="'.$goto.'" class="floating-left">'.$Lang->Category.'</a></li><span class="floating-left">/</span><li class="floating-left"><a href="'.$goto.'" class="floating-left active">'.$Lang->AddCategory.'</a></li>';

include "includes/header.php";
?>

<div class="edit-book">
    <div class="form-container">
        <form id="editcategory">
            <input type="hidden" name="category_id" id="category_id" value="">
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->categoryname_ar ?></label>
                <input type="text" class="txt-a floating-left" id="categoryname_ar" name="categoryname_ar" placeholder="<?= $Lang->categoryname_ar ?>" value="">
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->categoryname_en ?></label>
                <input type="text" class="txt-a floating-left" id="categoryname_en" name="categoryname_en" placeholder="<?= $Lang->categoryname_en ?>" value="">
            </div>

        </form>
        <input name="commit" onclick="savecategory()" type="button" value="<?= $Lang->Save ?>" class="btn-default-a floating-left">
    </div>
</div>
<?php
include "includes/footer.php";
?>
