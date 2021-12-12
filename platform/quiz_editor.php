<?php
/**
 * Created by Dar Almanhal - Hussam.
 * User: Hussam Abu Khadijeh
 * Date: 1/4/2016
 * Time: 12:49 PM
 */
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
include_once "config.php";
include_once "includes/function.php";

if(!isset($_GET['quizid']) || $_GET['quizid']==''){
    header("location:index.php");
    exit();
}else{
    if(!canEditQ($_GET['quizid'])){
        header("location:index.php");
        exit();
    }
}

$sql="SELECT * FROM `quiz` WHERE `quizid`=".$_GET['quizid'];
$result=$con->query($sql);
$row=mysqli_fetch_assoc($result);
$quiz=$row;

if(isset($_GET['type']) && $_GET['type']=="new"){
    $sql="SELECT max(`quiz_sort`) as sorting FROM `questions` WHERE `quizid`=".$_GET['quizid'];
    $result=$con->query($sql);
    $row=mysqli_fetch_assoc($result);
    $quiz_sort=$row['sorting']+1;
    $answer_container='<div class="answer vresizable jq_multi_file" publish="" editor="" id="answer_container"></div>';
    $question_container='<div class="question vresizable jq_multi_file dropable" publish="" editor="" id="question_container"><span class="poplinable" contenteditable="true">Type Your Question ?</span></div>';
    $sql="INSERT INTO `questions`(`quistionid`, `quizid`, `cdate`, `quiz_sort`, `question`,`answer_html`) VALUES ('',".$_GET['quizid'].", CURDATE(),".$quiz_sort.",'".mysqli_real_escape_string($con,$question_container)."','".mysqli_real_escape_string($con,$answer_container)."');";
    $con->query($sql);
    $questionid=$con->insert_id;
    header("location:quiz_editor.php?quizid=".$_GET['quizid']."&questionid=".$questionid);
    exit();
}elseif(isset($_GET['questionid']) && $_GET['questionid']!=''){
    $questionid=$_GET['questionid'];
}else{
    $sql="SELECT `quistionid` FROM `questions` WHERE `quizid`=".$_GET['quizid']." ORDER BY `quiz_sort` DESC";
    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        $questionid=$row['quistionid'];
    }else{
        header("location:quiz_editor.php?type=new&quizid=".$_GET['quizid']);
        exit();
    }

}

$sql="SELECT * FROM `questions` WHERE `quizid`=".$_GET['quizid']." AND quistionid=".$questionid;
    $result=$con->query($sql);
$row=mysqli_fetch_assoc($result);
$question=$row;


include_once "includes/language.php";
?>
<html>
<head>
    <script src="../js/jquery.js"></script>
    <script type="text/javascript">
        // showLoading();
        window.quizid=<?=$_GET['quizid'];?>;
        window.questionid=<?=$questionid;?>;
        window.questionType="<?=$question['type'];?>";
    </script>
    <script src="../js/lang.js"></script>
    <script src="../js/quiz.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <link href="../js/jquery-ui.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="themes/Light-green-<?=$_SESSION["lang"];?>/fonts/font-awesome/css/font-awesome.min.css" />
    <script type="text/javascript" src="../js/jquery.popline.min.js"></script>
    <link rel="stylesheet" type="text/css" href="themes/Light-green-<?=$_SESSION["lang"];?>/css/default.css">
    <link rel="stylesheet" type="text/css" href="themes/Light-green-<?=$_SESSION["lang"];?>/css/icons.css">
    <link rel="stylesheet" type="text/css" href="themes/Light-green-<?=$_SESSION["lang"];?>/fonts/fonts.css">
    <link rel="stylesheet" type="text/css" href="themes/Light-green-<?=$_SESSION["lang"];?>/css/editor.css">
    <script type="text/javascript"  src="../js/manhal-ui-<?=$_SESSION["lang"];?>.js"></script>
    <script type="text/javascript" src="../js/sweetalert-dev.js"></script>
    <link rel="stylesheet" type="text/css" href="themes/Light-green-<?=$_SESSION["lang"];?>/css/sweetalert.css">
    <script type="text/javascript" src="../js/html2canvas.js"></script>

    <style>
        .delete_widget{
            z-index: 0;
        }
        .edit_widget{
            z-index: 1;
        }
    </style>

</head>
<body>
<div class="loader-table" style="display: none">
    <div class="loader-cell">
        <div id="loader">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
    </div>
</div>

<header>
    <a href="quiz.php">
        <img class="floating-left" src="themes/Light-green-<?=$_SESSION["lang"];?>/images/logo1.png">
    </a>
    <nav class="floating-left">
        <a class="floating-left flaticon-pages" id="newquestion" title="<?=$Lang->NewQuestion;?>"></a>
        <a class="floating-left flaticon-document26" id="deletequestion" title="<?=$Lang->DeleteQuestion;?>"></a>
        <a class="floating-left flaticon-gear39" title="<?=$Lang->QuestionType;?>" id="qtype"></a>
        <div class="floating-left goto-container">
            <label class="floating-left" ><?=$Lang->goTo;?></label>
            <select id="goto">
                <?php
                $sql="SELECT * FROM `questions` WHERE `quizid`=".$_GET['quizid']." ORDER BY `quiz_sort` ASC ";
                $result=$con->query($sql);
                while($row=mysqli_fetch_assoc($result)){
                    if($row['quistionid']==$questionid){
                        $selected='selected="selected"';
                    }else{
                        $selected='';
                    }
                    ?>
                    <option value="<?=$row['quistionid'];?>" <?=$selected;?>><?=$row['quiz_sort'];?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div class="floating-right display-inline-block">
            <a class="floating-left flaticon-note5 widget" id="wtext" title="<?=$Lang->AddText;?>"></a>
            <a class="floating-left flaticon-camera142 widget" id="wvideo" title="<?=$Lang->AddVideo;?>"></a>
            <a class="floating-left flaticon-plus11 widget" id="wsound" title="<?=$Lang->AddSound;?>"></a>
            <a class="floating-left flaticon-books67 widget" id="wimage" title="<?=$Lang->AddImage;?>"></a>
            <a href="ajax/editor.php?process=publishquiz&quizid=<?=$_GET['quizid'];?>&quistionid=<?=$questionid;?>&view=1" target="_blank" class="floating-left flaticon-eye106" title="<?=$Lang->View;?>" id="view"></a>
            <a class="floating-left flaticon-save31" title="<?=$Lang->Save;?>" id="save"></a>
            <a class="floating-left flaticon-direction237" href="quiz.php" id="exit" title="<?=$Lang->Exit;?>"></a>
        </div>
    </nav>
</header>
<div class="site-container">
    <div class="quiz-content-container">
        <?=$question['question'];?>
    <div class="quiz-answer-container">
        <a id="add_answer" class="quiz-add-answer" title="<?=$Lang->AddAnswer;?>"><i class="flaticon-add64"></i></a>
        <?=$question['answer_html'];?>
    </div>
    </div>



<div id="types" style="display: none">
    <div class="quiz-types-container">
    <?php
    $sql="SELECT * FROM `quiztype`";
    $result=$con->query($sql);
    while($row=mysqli_fetch_assoc($result)){
        ?>
        <a class="jq_changetype text-left" qtype="<?=$row['id'];?>"><?=$row['name_'.strtolower($_SESSION["lang"])];?></a>
        <?php
    }
    ?>
    </div>
    </div>
</div>
<footer>
    <div class="correct">
        <label class="lbl-data-a floating-left"><?=$Lang->Correct;?></label>
        <textarea class="txtaria floating-left" name="correctfeedback" id="correctfeedback" title="<?=$Lang->CorrectFeedBack;?>"><?=$question['feedback_correct'];?></textarea>
        <label class="lbl-data-a floating-left "><?=$Lang->Points;?></label>
        <input class="floating-left" name="correctpoints" id="correctpoints" type="text" size="3" value="<?=$question['point_correct'];?>">
    </div>
    <div class="incorrect">
        <label class="lbl-data-a floating-left"><?=$Lang->InCorrect;?></label>
        <textarea class="txtaria floating-left" name="incorrectfeedback" id="incorrectfeedback" title="<?=$Lang->InCorrectFeedBack;?>"><?=$question['feedback_incorrect'];?></textarea>
        <label class="lbl-data-a floating-left"><?=$Lang->Points;?></label>
        <input class="floating-left" name="incorrectpoints" id="incorrectpoints" type="text" size="3" value="<?=$question['point_incorrect'];?>">
    </div>
</footer>
<iframe style="border:0px;width:0px;height:0px;" id="upload_target" name="upload_target"></iframe>
<canvas id="queImg" width="115" height="140" style="display: none;"></canvas>
<div class="admin-login" id="popup" style="display: none;">
    <div class="popup-main-container">
        <div class="popup-tabel">
            <div class="popup-row">
                <div class="popup-cell">
                    <div class="popup-container">
                        <label class="close-container">
                            <i class="flaticon-x floating-right close"></i>
                        </label>
                        <div class="popup-content">
                            <div class="container" id="action_container">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="admin-login" id="popup_action" style="display: none;">
    <div class="popup-main-container">
        <div class="popup-tabel">
            <div class="popup-row">
                <div class="popup-cell">
                    <div class="popup-container">
                        <label class="close-container">
                            <i class="flaticon-x floating-right close"></i>
                        </label>
                        <div class="popup-content">
                            <div class="containers" id="action_containerb">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
