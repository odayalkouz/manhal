<?php
/*
 * Created by Dar Almanhal - Hussam Abu Khadijeh .
 * User: Hussam Abu Khadijeh
 * Date: 2/10/2016
 * Time: 10:26 AM
 */
include_once "config.php";
include_once "includes/language.php";
if ($_SESSION['user']['permession'] == 1) {
    $weruser = '';
} else {
    $weruser = "WHERE quiz.userid=" . $_SESSION['user']['userid'];
}
$sql = "Select * FROM `quiz` ".$weruser;
$result = $con->query($sql);
?>

<div class="external-widget-container-popup">
    <div class="line-row-d">
        <label class="lbl-data-a floating-left">Quiz</label>
        <select class="ddl-animation-action txt-a floating-left" id="select_quiz">
            <?php
            while($row=mysqli_fetch_assoc($result)) {
                ?>
                <option lang="<?=$row['language'];?>" value="<?=$row['quizid'];?>"><?=$row['title'];?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="line-row-d">
        <a class="floating-right update-external-widget-btn" widget_id="<?=$_GET['id'];?>" id="update_quiz">Update</a>
    </div>
</div>
