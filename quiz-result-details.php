<?php
$currentTab = "quiz-result-details";
include_once "platform/config.php";
include_once "includes/function.php";
mustLogin();
include_once "platform/includes/function.php";
include_once "includes/header.php";


$sql = "SELECT quiz_result.*,quiz.title FROM `quiz_result` LEFT OUTER JOIN quiz ON quiz_result.quizid=quiz.quizid   WHERE quiz_result.`quizid`=" . $_GET['id']." AND quiz_result.id=".$_GET['userid'];

$result = $con->query($sql);
$row = mysqli_fetch_assoc($result)

?>
    <link rel="stylesheet" type="text/css"
          href="<?= SITE_URL; ?>themes/main-Light-green-<?= $_SESSION['lang']; ?>/css/quizresult.css<?= $cash; ?>">
    <div class="inner-pages-main-container-a order-main-container">
<?= $breadCrumbs; ?>
    <div class="center-piece">
    <div class="quizresult-container-moving floating-left">
    <div class="top-info">
        <div class="line-row-top floating-left"><label class="floating-left"><?= $Lang->QuizTitle; ?> :</label><span
                    class="floating-left"><?= $row['title'] ?></span></div>
        <div class="line-row-top floating-left"><label class="floating-left"><?= $Lang->UserName; ?> :</label><span
                    class="floating-left"><?= $row['name'] ?></span></div>
    </div>
    <div class="display-table manhal">
        <div class="disply-table-caption table-title">
            <div class="display-table-cell No"><?= $Lang->No; ?></div>
            <div class="display-table-cell qustiontype"><?= $Lang->QustionType; ?></div>
            <div class="display-table-cell yourscore"><?= $Lang->YourScore; ?></div>
            <div class="display-table-cell qustionscore"><?= $Lang->QustionScore; ?></div>
        </div>
    </div>
    <div class="table-card-container scrollable">
        <div class="display-table">
            <?php



            $result = [];
            $result = json_decode($row['result'], true);
            $i = 0;
            foreach ($result as $key => $value) {
                echo '<div class="display-table-row bg-row table-title">';

                echo '<div class="display-table-cell No"><div class="number">' . $i . '</div></div>';
                  echo '<div class="display-table-cell qustiontype">'.$value['Type'].'</div>';
                echo '<div class="display-table-cell yourscore">' . $value['YourScore'] . '</div>';
                echo '<div class="display-table-cell qustionscore">' . $value['QustionScore'] . '</div></div>';
                $i++;
            }


            ?>


        </div>
    </div>
<?php
include_once "includes/footer.php";
?>