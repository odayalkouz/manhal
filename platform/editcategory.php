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

$sql ="SELECT * FROM categories WHERE catid=".$_GET['id'];
$result = $con->query($sql);
if (mysqli_num_rows($result) > 0) {
    $data='';
    $row = mysqli_fetch_assoc($result);
}
?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<!--<script type="text/javascript" src="js/ajax.js"></script>-->
<script type="text/javascript" >

    function savecategory(){


        var data={
            category_id:$("#category_id").val(),
            category_namear:$("#category_namear").val(),
            category_nameen:$("#category_nameen").val(),

            TypeProcesses:'updatecategory'
        };

        setdatafunction('updatecategory',data);
    }


</script>


<?php

$bredcrumb = '<li class="floating-left"><a href="category.php" class="floating-left">'.$Lang->Category.'</a></li><span class="floating-left">/</span><li class="floating-left"><a class="floating-left active">'.$Lang->EditCategory.'</a></li>';

include "includes/header.php";
?>

<div class="edit-book">
    <div class="form-container">
        <form id="editbook">
            <input type="hidden" name="category_id" id="category_id" value="<?= $_GET['id']; ?>">
        <div class="line-row">
        <label class="lbl-data-a floating-left"><?= $Lang->arabicname ?></label>
        <input type="text" class="txt-a floating-left" id="category_namear" name="category_namear" placeholder="<?= $Lang->arabicname ?>" value="<?=$row["name_ar"]; ?>">
    </div>
        <div class="line-row">
        <label class="lbl-data-a floating-left"><?= $Lang->englishname ?></label>
        <input type="text" class="txt-a floating-left" id="category_nameen" name="category_nameen" placeholder="<?= $Lang->englishname ?>" value="<?=$row["name_en"]; ?>"></form>
        </div>
    <div class="line-row">
        <input name="commit" onclick="savecategory()" type="button" value="<?= $Lang->Save ?>" class="btn-default-a floating-left">
    </div>
</div>
</div>
<?php
include "includes/footer.php";
?>
