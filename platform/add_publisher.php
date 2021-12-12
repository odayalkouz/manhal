<?php
/**
 * User: khalid alomiri
 * Date: 1/4/2016
 * Time: 1:17 PM
 */
$cuerrentpage="publishers.php";

if(session_status()==PHP_SESSION_NONE){ session_start();}

include_once('config.php') ;
include_once('includes/language.php') ;

if(isset($_GET['id']) && $_GET['id']=="new"){
    $sql ="INSERT INTO publishers (pid) VALUES ('')";
    $con->query($sql);
    $id=mysqli_insert_id($con);

    header("location: add_publisher.php?id=".$id);
    exit();
}


$sql ="SELECT * FROM publishers WHERE pid=".$_GET['id'];
$result = $con->query($sql);
if (mysqli_num_rows($result) > 0) {
    $data='';
    $row = mysqli_fetch_assoc($result);
}
?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<!--<script type="text/javascript" src="js/ajax.js"></script>-->
<script type="text/javascript" >

    function savepublisher(){
        // showloader();
        var data={
            publisher_id:$("#publisher_id").val(),
            pnamear:$("#category_namear").val(),
            pnameen:$("#category_nameen").val(),
            TypeProcesses:'updatepublisher'
        };

        $.ajax({
            url: "ajax/function.php",
            type: "POST",
            data: data,
            cache: false,
            dataType: 'html',
            success: function (html) {
                console.log("result",html);
                if(html==1){
                    window.location.href="publishers.php"
                }else{
                    // hideloader();
                    alert("error");
                }
            }
        });
    }


</script>


<?php

$bredcrumb = '<li class="floating-left"><a href="store_brands.php" class="floating-left">'.$Lang->publisher.'</a></li><span class="floating-left">/</span><li class="floating-left"><a class="floating-left active">'.$Lang->EditPublisher.'</a></li>';

include "includes/header.php";
?>

<div class="edit-book">
    <div class="form-container">
        <form id="editbook">
            <input type="hidden" name="publisher_id" id="publisher_id" value="<?= $_GET['id']; ?>">
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->arabicname ?></label>
                <input type="text" class="txt-a floating-left" id="category_namear" name="category_namear" placeholder="<?= $Lang->arabicname ?>" value="<?=$row["pname_ar"]; ?>">
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->englishname ?></label>
                <input type="text" class="txt-a floating-left" id="category_nameen" name="category_nameen" placeholder="<?= $Lang->englishname ?>" value="<?=$row["pname_en"]; ?>"></form>
    </div>
    <div class="line-row">
        <input name="commit" onclick="savepublisher()" type="button" value="<?= $Lang->Save ?>" class="btn-default-a floating-left">
    </div>
</div>
</div>
<?php
include "includes/footer.php";
?>
