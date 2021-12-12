<?php
$currentTab = "quizresult";
include_once "platform/config.php";
include_once "includes/function.php";
mustLogin();
include_once "platform/includes/function.php";
include_once "includes/header.php";


    $sql = "SELECT quiz.*,categories.`name_ar`,categories.name_en FROM `quiz` LEFT OUTER JOIN categories ON quiz.category=categories.catid WHERE quiz.`quizid`=".$_GET['id'];
    $result = $con->query($sql);
    $row=mysqli_fetch_assoc($result);

?>
    <link rel="stylesheet" type="text/css"
          href="<?= SITE_URL; ?>themes/main-Light-green-<?= $_SESSION['lang']; ?>/css/quizresult.css<?= $cash; ?>">
    <div class="inner-pages-main-container-a order-main-container">
<?= $breadCrumbs; ?>
    <div class="center-piece">
    <div class="quizresult-container-moving floating-left">
    <div class="top-info">
        <div class="line-row-top floating-left"><label class="floating-left"><?=$Lang->QuizTitle;?> :</label><span class="floating-left"><?=$row['title']?></span></div>
        <div class="line-row-top floating-left"><label class="floating-left"><?=$Lang->categoryname;?> :</label><span class="floating-left"><?=$row['name_'.$cat_code]?></span></div>
    </div>
    <div class="display-table manhal">
        <div class="disply-table-caption table-title">
            <div class="display-table-cell username"><?= $Lang->UserName; ?></div>
            <div class="display-table-cell quiztime"><?= $Lang->Quiztime; ?></div>
            <div class="display-table-cell quizdate"><?= $Lang->Date; ?></div>
            <div class="display-table-cell action"><?= $Lang->Action;?></div>
        </div>
    </div>
    <div class="table-card-container scrollable">


            <?php
            $sql = "SELECT  * FROM `quiz_result` WHERE `quizid`=".$_GET['id'];
            $result = $con->query($sql);

            while( $row2=mysqli_fetch_assoc($result)){
                echo '<div class="display-table"><div class="display-table-row bg-row table-title">';
                echo '<div class="display-table-cell username">'.$row2['name'].'</div>';
                echo '<div class="display-table-cell quiztime">'.$row2['quiz_time'].'</div>';
                echo '<div class="display-table-cell quizdate">'.$row2['date'].'</div>';
                echo '<div class="display-table-cell action  editquiz_item-style">';
                echo '<a href="'.SITE_URL.$lang_code.'/quiz-result-details/'.$_GET['id'].'/'.$row['title'].'/'.$row2['id'].'/'.str_replace(" ","-",$row2['name']).'" class="editquiz_carts_item" title="information"></a></div> </div></div>';
            }

            ?>




    </div>
<?php
include_once "includes/footer.php";
?>