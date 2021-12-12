<?php
/**
 * User: khalid alomiri
 * Date: 1/4/2016
 * Time: 1:17 PM
 */

if(session_status()==PHP_SESSION_NONE){ session_start();}
include_once('config.php') ;
include_once('includes/language.php') ;
if(isset($_GET['id']) && $_GET['id']!=""){
    $sql ="SELECT * FROM quiz WHERE quizid=".$_GET['id'];
    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        $data='';
        $row = mysqli_fetch_assoc($result);
    }
    $a=json_decode($row['result'],true);

}

?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<!--<script type="text/javascript" src="js/ajax.js"></script>-->
<script type="text/javascript" >
    function savequiz(){

        var object_aar=[$("#quiz_title"),$("#quiz_Introduction"),$("#quiz_passing_rate"),$("#question_Passed"),$("#question_Failed"),$("#quiz_Pass"),$("#quiz_Failed")]
        for (var a in object_aar) {

            if(object_aar[a].val()=='' || object_aar[a].val()==null){
                swal(window.Lang['error'],window.Lang['Youmustfillinallfields'],'error');
                return;
            }

        }

        var result=[{"Pass":$("#quiz_Pass").val(),"Failed":$("#quiz_Failed").val()}];
              var data={
            quiz_id:$("#quiz_id").val(),
            quiz_title:$("#quiz_title").val(),
            quiz_Introduction:$("#quiz_Introduction").val(),
            quiz_age:$("#quiz_age").val(),
            quiz_passing_rate:$("#quiz_passing_rate").val(),
            quiz_result:JSON.stringify(result),
            question_Passed:$("#question_Passed").val(),
            question_Failed:$("#question_Failed").val(),
            Category:$("#Category").prop("selectedIndex")+1,
            TypeProcesses:'updatequiz'
        };
        setdatafunction('updatequiz',data);
    }
</script>
<?php
$bredcrumb = '<li class="floating-left"><a href="quiz.php" class="floating-left">'.$Lang->Quiz.'</a><span class="floating-left">/</span></li><li class="floating-left"><a href="editquiz.php" class="floating-left active">'.$Lang->AddQuiz.'</a></li>';

include "includes/header.php";
?>
<div class="edit-book">
    <div class="form-container">
        <form id="editquiz">
            <input type="hidden" name="quiz_id" id="quiz_id" value="<?= $_GET['id']; ?>">
        <div class="line-row">
        <label class="lbl-data-a floating-left"><?= $Lang->QuizTitle ?></label>
        <input type="text" class="txt-a floating-left" id="quiz_title" name="quiz_title" placeholder="<?=$Lang->QuizTitle;?>" value="<?php if(isset($row)){ echo $row["title"];} ?>">
    </div>
        <div class="line-row">
        <label class="lbl-data-a floating-left"><?= $Lang->Introduction ?></label>
        <input type="text" class="txt-a floating-left" id="quiz_Introduction" name="quiz_Introduction" placeholder="<?= $Lang->Introduction ?>" value="<?php if(isset($row)){ echo $row["Introduction"];} ?>">
    </div>
        <div class="line-row">
        <label class="lbl-data-a floating-left"><?= $Lang->Age ?></label>
        <input type="text" class="txt-a floating-left" id="quiz_age" name="quiz_age" placeholder="<?= $Lang->Age ?>" value="<?php if(isset($row)){ echo $row["age"];} ?>">
    </div>
    </div>
    <div class="line-row">
        <label class="lbl-data-a floating-left"><?= $Lang->PassingRate ?></label>
        <input type="text" class="txt-a floating-left" id="quiz_passing_rate" name="quiz_passing_rate" placeholder="<?= $Lang->PassingRate ?>" value="<?php if(isset($row)){ echo $row["passing_rate"];} ?>">
    </div>
    <div class="line-row">
        <label class="lbl-data-a-color floating-left"><?= $Lang->QuizResult ?></label>
        <div class="border-green floating-left"></div>
    </div>
    <div class="line-row">
        <label class="lbl-data-a floating-left"><?= $Lang->QuizPass ?></label>
        <input type="text" class="txt-a floating-left" id="quiz_Pass" name="quiz_Pass" placeholder="<?= $Lang->QuizPass ?>" value="<?php if(isset($a)){ echo $a[0]["Pass"];} ?>">
    </div>
    <div class="line-row">
        <label class="lbl-data-a floating-left"><?= $Lang->QuizFailed ?></label>
        <input type="text" class="txt-a floating-left" id="quiz_Failed" name="quiz_Failed" placeholder="<?= $Lang->QuizFailed ?>" value="<?php if(isset($row)){ echo $a[0]["Failed"];} ?>">
    </div>

    <div class="line-row">
        <label class="lbl-data-a-color floating-left"><?= $Lang->QuizFeedback ?></label>
        <div class="border-green floating-left"></div>
    </div>
    <div class="line-row">
        <label class="lbl-data-a floating-left"><?= $Lang->Passed ?></label>
        <input type="text" class="txt-a floating-left" id="question_Passed" name="question_Passed" placeholder="<?= $Lang->Passed ?>" value="<?php if(isset($row)){ echo $row["passed"];} ?>">
    </div>
    <div class="line-row">
        <label class="lbl-data-a floating-left"><?= $Lang->Failed ?></label>
        <input type="text" class="txt-a floating-left" id="question_Failed" name="question_Failed" placeholder="<?= $Lang->Failed ?>" value="<?php if(isset($row)){ echo $row["failed"];} ?>">
    </div>


        <div class="line-row">
            <label class="lbl-data-a floating-left">
                Category
            </label>
            <select class="txt-a floating-left" id="Category" name="Category">

                <?php
                $cat_sql = "Select * From  categories ";
                $cat_result = $con->query($cat_sql);
                if (mysqli_num_rows($cat_result) > 0) {
                    while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                        $selected='';
                        if(isset($row)) {
                            if ($cat_row['catid'] == $row["category"]) {
                                $selected = 'selected';
                            }
                        }
                        echo "<option ".$selected." value='".$cat_row['catid']."'>".$cat_row['name_'.$lang_code]."</option>";

                    }
                }
                ?>


            </select>
        </div>
    </form>
    <?php
     if(isset($_GET["id"]) && $_GET["id"]!=""){
         ?>
         <input name="commit" onclick="savequiz()" type="button" value="<?= $Lang->Save ?>" class="btn-default-c floating-left">
    <?php
     }else{
         ?>
         <input name="commit" id="save_new_quiz" type="button" value="<?= $Lang->Save ?>" class="btn-default-c floating-left">
         <?php
     }
    ?>

    </div>
</div>
<?php
include "includes/footer.php";
?>
