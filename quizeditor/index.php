<?php
include_once "includes/function.php";
mustLogin();
if(!($_SESSION['user']["permession"]>0 && $_SESSION['user']["permession"]<13)){
    header("location:".SITE_URL.$lang_code."/subscribe");
    exit();
}

if(isset($_GET["id"]) && $_GET["id"]=="new"){
    $sql="INSERT INTO `quiz`(`quizid`, `userid`, `category`, `title`, `Introduction`, `age`, `passing_rate`, `cdate`, `status`, `note`,`quiz_time`)
    VALUES ('',".$_SESSION["user"]["userid"].",0,'','',0,0,CURDATE(),0,'',60)";
    $con->query($sql);
    $id=mysqli_insert_id($con);

    $question='<div class="vresizable droppable" id="question_contents"><div class="text floating-left"><div class="question"><span><div class="text-left"><div class=" vresizable jq_multi_file dropable poplinable jq_mainquestiontext" contenteditable="true" publish="" editor=""  src="" data_src="" default="0">'.$Lang->writeYourquestion.'</div></div></div></span></div></div>';
    $answerHTML='<div class="vresizable droppable ui-resizable" id="answer_contents"><div class="true-false floating-left"> <ul><li class="answer1"><input att="1" type="radio" name="Quastion8" id="Quastion8_0" checked=""> <label for="Quastion8_0"> <div class="image-true"></div>  </label> <div class="bullet"> <div class="line zero"></div><div class="line one"></div> <div class="line two"></div><div class="line three"></div> <div class="line four"></div><div class="line five"></div> <div class="line six"></div><div class="line seven"></div></div></li><li class="answer2"> <input att="0" type="radio" name="Quastion8" id="Quastion8_1"><label for="Quastion8_1"><div class="image-false"></div> </label><div class="bullet"> <div class="line zero"></div><div class="line one"></div><div class="line two"></div><div class="line three"></div><div class="line four"></div><div class="line five"></div> <div class="line six"></div> <div class="line seven"></div></div></li></ul></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div></div>';
    $sql="INSERT INTO `questions`(`quistionid`,`id_user`,`quizid`, `cdate`, `quiz_sort`, `question`,`answer_html`,`type`,`point_correct`)
VALUES ('',".$_SESSION["user"]["userid"].",".$id.", CURDATE(),1,'".mysqli_real_escape_string($con,$question)."','".mysqli_real_escape_string($con,$answerHTML)."',1,10);";
    $con->query($sql);
    $_SESSION["showquizsetting"]=true;
    header("location:".SITE_URL.$lang_code."/quiz-editor?id=".$id);
    exit();
}elseif(isset($_GET["id"]) && $_GET["id"]!=""){
    $sql="SELECT * FROM `quiz` WHERE `quizid`=".$_GET["id"];
    $result=$con->query($sql);
    $row=mysqli_fetch_assoc($result);
}else {//error

}

if(strtolower($session_lang)=="ar"){
    $right="left";
    $left="right";
}else{
    $right="right";
    $left="left";
}

$cashr=4;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$row["title"];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no, maximum-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="icon" data-type="favicon" sizes="24" href="" type="image/x-icon">
    <link rel="stylesheet" href="<?=SITE_URL?>quizeditor/thems/<?= $session_lang; ?>/css/style.css?v=<?=$cashr?>">
    <link href="<?=SITE_URL?>quizeditor/thems/En/css/animate.css" rel="Stylesheet" type="text/css"/>
    <link href="<?=SITE_URL?>quizeditor/thems/<?= $session_lang; ?>/css/size.css" rel="Stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL?>quizeditor/thems/En/css/default.css?v=<?=$cashr?>">
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL?>quizeditor/thems/En/css/font-awesome.min.css" />
    <script type="text/javascript" src="<?=SITE_URL?>quizeditor/js/jquery.js"></script>
    <script src="<?=SITE_URL?>quizeditor/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?=SITE_URL?>quizeditor/js/manhal-ui.js?v=<?=$cashr?>" type="text/javascript"></script>
    <script src="<?=SITE_URL?>quizeditor/js/quiz-editor.js?v=<?=$cashr?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?=SITE_URL?>quizeditor/js/jquery.popline.min.js"></script>
    <link rel="stylesheet" href="<?=SITE_URL?>quizeditor/thems/En/css/jquery-ui.min.css">
    <script type="text/javascript" src="<?=SITE_URL?>quizeditor/js/jquery.ui.touch-punch.min.js"></script>
    <script type="text/javascript" src="<?=SITE_URL?>quizeditor/js/Event.js"></script>
    <script type="text/javascript" src="<?=SITE_URL?>quizeditor/js/Dragdrop.js"></script>
    <script type="text/javascript" src="<?=SITE_URL?>quizeditor/js/RulersGuides.js"></script>
    <script type="text/javascript" src="<?=SITE_URL?>quizeditor/js/context.js"></script>
    <script>
        window.left='<?=$right;?>';
        window.right='<?=$left;?>';
        window.quizid=<?=$_GET["id"];?>;
        <?php
        if(isset($_SESSION["showquizsetting"]) &&  $_SESSION["showquizsetting"]==true){
            $_SESSION["showquizsetting"]=false;
            ?>
        $(document).ready(function(){
            setTimeout(function(){
                console.log("aaaa");
                showsettingpopup();
            },300);
//            getQuestionName($(".q_questioni").attr(title))
        });
        <?php
        }
        ?>
    </script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-74397962-2', 'auto');
        ga('send', 'pageview');


    </script>
    <!-- Global site tag (gtag.js) - Google AdWords: 836956915 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-836956915"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'AW-836956915');
    </script>
</head>
<body>
<!--<ul class='custom-menu'>-->
<!--    <li data-action="Bringtofront">Bring to Front</li>-->
<!--    <li data-action="Sendtoback">Send to Back</li>-->
<!--</ul>-->

<div class="nu-context-menu" >
    <ul>
        <li data-key="Bringtofront"><i class="fa fa-Bringtofront"></i><?=$Lang->Bringtofront;?></li>
        <li data-key="Sendtoback"><i class="fa fa-Sendtoback"></i><?=$Lang->Sendtoback;?></li>
    </ul>
</div>

<section class="editor-main-container">
    <div class="loader-main-container">
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
    <div class="popup-delete-container noclose">
        <div class="delete-container">
            <h1><?=$Lang->Confirmation;?></h1>
            <p><?=$Lang->Areshuredeletequestion;?></p>
            <div class="row">
                <a id="delete_question" class="yes floating-right"><?=$Lang->Yes;?></a>
                <a class="no floating-right"><?=$Lang->Cancel;?></a>
            </div>
        </div>
    </div>
    <div class="popup-questiontype-container noclose">
        <div class="questiontype-container">
            <h1><?=$Lang->QuestionType;?></h1>
            <a class="close"></a>
            <p><?=$Lang->Selectitemnewquestion;?></p>
            <div class="items-container">
                <a class="item-container active editor-true-false" qtype="1"></a>
                <a class="item-container editor-multible-choises" qtype="2"></a>
                <a class="item-container editor-multiple-response" qtype="3"></a>
                <a class="item-container editor-fill-in-the-blank" qtype="4"></a>
                <a class="item-container editor-matching" qtype="5"></a>
                <a class="item-container editor-word-bank" qtype="6"></a>
                <a class="item-container editor-click-map" qtype="7"></a>
                <a class="item-container editor-short-essay" qtype="8"></a>
                <a class="item-container editor-sequence" qtype="9"></a>
                <div class="btn-save-container floating-right" >
                    <a class="save" id="save_question" ><label><?=$Lang->Save;?></label></a>
                </div>
            </div>
        </div>
    </div>

    <div class="popup-settings-container noclose">
        <div class="settings-container">
            <h1><?=$Lang->Setting1;?></h1>
            <a class="close"></a>
            <p><?=$Lang->EditQuiz;?></p>
            <div class="row-container">
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->QuizTitle;?></div>
                    </div>
                    <input id="quiz_title" type="text" value="<?=$row["title"];?>" class="right floating-right" placeholder="<?=$Lang->QuizTitle;?>">
                </div>
                <div class="line-row" style="display: none">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->Introduction;?></div>
                    </div>
                    <input type="text"  id="quiz_introduction" value="<?=$row["Introduction"];?>" class="right floating-right" placeholder="<?=$Lang->Introduction;?>">
                </div>
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->Language;?></div>
                    </div>
                    <select id="quiz_language" class="right floating-right">
                        <option value="En" <?php if($row["language"]=="En"){echo 'selected="selected"';} ?>><?=$Lang->English;?></option>
                        <option value="Ar"  <?php if($row["language"]=="Ar"){echo 'selected="selected"';} ?>><?=$Lang->Arabic;?></option>
                    </select>                </div>
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->Category;?></div>
                    </div>
                    <select id="quiz_category" class="right floating-right">
                        <?php
                        $sql2="SELECT * FROM `categories`";
                        $result2=$con->query($sql2);
                        while($cat=mysqli_fetch_assoc($result2)){
                            ?>
                            <option value="<?=$cat["catid"];?>" <?php if($cat["catid"]==$row["category"]){echo 'selected="selected"'; }?>><?=$cat["name_".$lang_code];?></option>
                            <?php
                        }

                        ?>
                    </select>
                </div>

                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->Age;?></div>
                    </div>
                    <input type="text" id="quiz_age"  value="<?=$row["age"];?>" class="right floating-right" placeholder="<?=$Lang->Age;?>">
                </div>
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->Quiztime;?></div>
                    </div>
                    <input type="number" id="quiz_time" min="5" max="300" value="<?=$row["quiz_time"];?>" class="right floating-right" placeholder="<?=$Lang->timeInMinutes;?>">
                </div>
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->Published;?></div>
                    </div>
                    <label class="floating-left first" for="private"><?=$Lang->private;?></label>
                    <input type="radio"  <?php if($row["is_public"]==0){echo 'checked="checked"';} ?> name="Published" class="floating-left" id="private" placeholder="private">
                    <label class="floating-left" for="Public"><?=$Lang->Public;?></label>
                    <input type="radio" <?php if($row["is_public"]==1){echo 'checked="checked"';} ?> name="Published" class="floating-left" id="Public" placeholder="Public">
                </div>
            </div>
            <p><?=$Lang->QuizFeedback;?></p>
            <div class="row-container">
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->Passed;?></div>
                    </div>
                    <input type="text"  id="quiz_passed"  value="<?=$row["passed"];?>" class="right floating-right" placeholder="<?=$Lang->PassedPlaceholder;?>">
                </div>
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->Faild;?></div>
                    </div>
                    <input type="text"  id="quiz_failed"  value="<?=$row["failed"];?>" class="right floating-right" placeholder="<?=$Lang->FailedPlaceHolder;?>">
                </div>

                    </div>
            <p style="display: none"><?=$Lang->QuizResult;?></p>
            <div class="row-container" style="display: none">
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->PassingRate;?></div>
                    </div>
                    <input type="text" id="passing_rate" value="<?=$row["passing_rate"];?>" class="right floating-right" placeholder="<?=$Lang->PassingRate;?>">
                </div>

                <?php
                $pass_falid["Pass"]='';
                $pass_falid["Failed"]='';
                if($row["result"]!=""){
                    $pass_falid=json_decode($row["result"],true);
                }
                ?>
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->QuizPass;?></div>
                    </div>
                    <input type="text" id="quiz_passedj" value="<?=$pass_falid["Pass"];?>" class="right floating-right" placeholder="<?=$Lang->QuizPass;?>">
                </div>
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->QuizFaild;?></div>
                    </div>
                    <input type="text" id="quiz_failedj"  value="<?=$pass_falid["Failed"];?>"  class="right floating-right" placeholder="<?=$Lang->QuizFaild;?>">
                </div>
            </div>
            <div class="btn-save-container floating-right">
                <a class="save" id="quiz_update"><label><?=$Lang->Save;?></label></a>
            </div>
        </div>
    </div>
    <div class="popup-edit-video-container noclose">
        <div class="edit-video-container">
            <h1><?=$Lang->Edit;?></h1>
            <a class="close"></a>
            <form id="video_form" method="POST" action="" enctype="multipart/form-data" target="upload_target">
                <div class="row-container">
                    <div class="line-row">
                        <div class="point floating-left"></div>
                        <label class="lbl-data-a floating-left"><?=$Lang->URL;?></label>
                        <input class="txt-a floating-left" type="text" name="youtube" id="youtube" placeholder="URL">
                    </div>
                </div>
                <div class="btn-save-container floating-right" id="update_video" >
                    <a class="save"><label><?=$Lang->Save;?></label></a>
                </div>
            </form>
        </div>
    </div>
    <div class="popup-edit-image-container clickmap-1 noclose">
        <div class="edit-image-container">
            <h1><?=$Lang->Editimage;?></h1>
            <a class="close"></a>
            <form id="image_formc" method="POST" action="" enctype="multipart/form-data" target="upload_target">
                <div class="row-container">
                    <div class="line-row-a">
                        <div class="point floating-left"></div>
                        <label class="lbl-data-a floating-left"><?=$Lang->uploadImage;?></label>
                        <div class="fu-container-a floating-left">
                            <label class="floating-left flaticon-cloud148 label-a"></label>
                            <label class="floating-left label-b" id="lblimagec"></label>
                            <input id="imagec" type="file" name="image">
                        </div>
                    </div>
                </div>
                <div class="btn-save-container floating-right" id="update_imagec" >
                    <a class="save"><label><?=$Lang->Save;?></label></a>
                </div>
            </form>
        </div>
    </div>
    <div class="popup-edit-image-container itemA noclose">
        <div class="edit-image-container">
            <h1><?=$Lang->Editimage;?></h1>
            <a class="close"></a>
            <form id="image_form" method="POST" action="" enctype="multipart/form-data" target="upload_target">
                <div class="row-container">
                    <div class="line-row-a">
                        <div class="point floating-left"></div>
                        <label class="lbl-data-a floating-left"><?=$Lang->uploadImage;?></label>
                        <div class="fu-container-a floating-left">
                            <label class="floating-left flaticon-cloud148 label-a"></label>
                            <label class="floating-left label-b" id="lblimage_txt"></label>
                            <input id="image_txt" type="file" name="image">
                        </div>
                    </div>
                </div>
                <div class="btn-save-container floating-right" id="update_image" >
                    <a class="save"><label><?=$Lang->Save;?></label></a>
                </div>
            </form>
        </div>
    </div>
    <div class="popup-edit-image-container itemB noclose">
        <div class="edit-image-container">
            <h1><?=$Lang->Editimage;?></h1>
            <a class="close"></a>
            <form id="asound_form" method="POST" action="" enctype="multipart/form-data" target="upload_target">
                <div class="row-container">
                    <div class="line-row-a">
                        <div class="point floating-left"></div>
                        <label class="lbl-data-a floating-left"><?=$Lang->uploadSound;?></label>
                        <div class="fu-container-a floating-left">
                            <label class="floating-left flaticon-cloud148 label-a"></label>
                            <label class="floating-left label-b" id="lblimage_txt"></label>
                            <input id="asound_txt" type="file" name="asound">
                        </div>
                    </div>
                </div>
                <div class="btn-save-container floating-right" id="update_asound" >
                    <a class="save"><label><?=$Lang->Save;?></label></a>
                </div>
            </form>
        </div>
    </div>
    <div class="popup-edit-sound-container">
        <div class="edit-sound-container">
            <h1><?=$Lang->EditSound;?></h1>
            <a class="close"></a>
            <form id="sound_form" method="POST" action="" enctype="multipart/form-data" target="upload_target">
                <div class="row-container">
                    <div class="line-row-a">
                        <div class="point floating-left"></div>
                        <label class="lbl-data-a floating-left"><?=$Lang->uploadSound;?></label>
                        <div class="fu-container-a floating-left">
                            <label class="floating-left flaticon-cloud148 label-a"></label>
                            <label class="label-b floating-left" id="lblsound1"></label>
                            <input id="sound1" type="file" name="sound">
                        </div>
                    </div>
                </div>
                <div class="btn-save-container floating-right" id="update_sound" >
                    <a class="save"><label><?=$Lang->Save;?></label></a>
                </div>
            </form>
        </div>
    </div>
    <header>
        <div class="editor-logo floating-left"></div>
        <div class="editor-title floating-left">
            <label class="floating-left"><?=$Lang->Title;?> :</label><label class="floating-left" id="quiz_top_title"><?=$row["title"];?></label>
        </div>
        <div class="options-icons floating-right">
            <a class="floating-left settings tooltip" data-balloon-length="medium" data-balloon-pos="down" data-balloon="<?=$Lang->helpSetting;?>"></a>
            <a title="<?=$Lang->Save;?>" class="floating-left save jq_topsave"></a>
            <a title="<?=$Lang->Preview;?>" class="floating-left view" id="topview" target="_blank" href="<?=SITE_URL;?>platform/ajax/editor.php?process=publishquiz&quizid=<?=$row["quizid"];?>&view=1"></a>

            <?php
            if(strtolower($session_lang)=="en"){
                $session_lang="ar";
                echo'<a class="floating-left tooltip language-a" href="'.SITE_URL.$session_lang.'/quiz-editor?id='.$_GET['id'] .'">Ar</a>';
            }else{
                $session_lang="en";
                echo'<a class="floating-left tooltip language-a" href="'.SITE_URL.$session_lang.'/quiz-editor?id='.$_GET['id'] .'">En</a>';
            }
        ?>
        </div>
    </header>
    <div class="editor-main-menu-container">
        <div class="nav floating-left">
            <a id="Page_menu" class="noclose tooltip" data-balloon-pos="<?=$right;?>" data-balloon="<?=$Lang->helpDrag;?>"></a>
            <a id="feedback_menu" class="noclose tooltip" data-balloon-pos="<?=$right;?>" data-balloon="<?=$Lang->helpfeed;?>"></a>
            <a class="tutorial-icon" data-balloon-pos="<?=$right;?>" data-balloon="<?=$Lang->helptutorial;?>"></a>
        </div>
        <div class="nav-content noclose" id="page-content" style="display: none">
            <div class="header">
                <a class="floating-left title"><?=$Lang->Draganddrop;?></a>
                <a class="floating-right close-menu"><i
                        class="flaticon-x"></i></a>
            </div>
            <div class="content">
                <div class="row floating-left draggable-w" id="text">
                    <a class="floating-left icon text"> <i class="flaticon-pages"></i></a>
                    <a class="floating-left title"><?=$Lang->Text;?></a>
                </div>
                <div class="row floating-left draggable-w" id="video">
                    <a class="floating-left icon video"><i class="flaticon-document26"></i></a>
                    <a class="floating-left title"><?=$Lang->video;?></a>
                </div>
                <div class="row floating-left draggable-w" id="sound">
                    <a class="floating-left icon sound"><i class="flaticon-fon"></i></a>
                    <a class="floating-left title"><?=$Lang->sound;?></a>
                </div>
                <div class="row floating-left draggable-w" id="image">
                    <a class="floating-left icon image"><i class="flaticon-gear39"></i></a>
                    <a class="floating-left title"><?=$Lang->Image;?></a>
                </div>
            </div>
        </div>
        <div class="nav-content noclose" id="action-content" style="display: none">
            <div class="content contentB">
                <a class="floating-left title-a"><?=$Lang->CorrectFeedBack;?></a>
                <textarea type="text" class="input-incorect" id="correctfeedback" placeholder="<?=$Lang->correctqfeedback;?>"></textarea>
                <a class="floating-left title-a"><?=$Lang->InCorrectFeedBack;?></a>
                <textarea type="text" class="input-incorect" id="incorrectfeedback" placeholder="<?=$Lang->incorrectqfeedback;?>"></textarea>
                <div class="correct-point">
                    <div class="line-row">
                        <label class="floating-left"><?=$Lang->Correctpoint;?></label>
                        <input class="floating-left" id="correctpoints" type="number" min="0" value="10" placeholder="10">
                    </div>
                    <div class="line-row" style="display: none">
                        <label class="floating-left"><?=$Lang->Incorrectpoint;?></label>
                        <input class="floating-left" id="incorrectpoints" type="number" min="0">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="quiz-container">
        <section class="questions-main-container" style="display: block">
            <div class="content-container" id="content-container1">
                <div class="slider-main-container">
                    <div class="question-answer-container active question">
                        <div class="question-view" id="question_container"  publish="" editor=""  src="" data_src="">
                            <div class="question-title"></div>
                            <div class="vresizable droppable" id="question_contents">
                            <div class="num floating-left"></div>
                            <div class="text floating-left">
                                <div class=" vresizable jq_multi_file dropable poplinable" contenteditable="true" publish="" editor=""  src="" data_src="">
                                    <?=$Lang->writeYourquestion;?>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="answer overflow" id="answer_container">
                            <div class="answer-title"><?=$Lang->AnswerQusetion;?></div>
                            <div class="vresizable droppable" id="answer_contents">
                                <div class="true-false floating-left">
                                <ul>
                                    <li class="answer1">
                                        <input att="1" type="radio" name="Quastion8" id="Quastion8_0" checked>
                                        <label for="Quastion8_0">
                                            <div class="image-true"></div>
                                        </label>
                                        <div class="bullet">
                                            <div class="line zero"></div>
                                            <div class="line one"></div>
                                            <div class="line two"></div>
                                            <div class="line three"></div>
                                            <div class="line four"></div>
                                            <div class="line five"></div>
                                            <div class="line six"></div>
                                            <div class="line seven"></div>
                                        </div>
                                    </li>
                                    <li class="answer2">
                                        <input att="0" type="radio" name="Quastion8" id="Quastion8_1">
                                        <label for="Quastion8_1">
                                            <div class="image-false"></div>
                                        </label>
                                        <div class="bullet">
                                            <div class="line zero"></div>
                                            <div class="line one"></div>
                                            <div class="line two"></div>
                                            <div class="line three"></div>
                                            <div class="line four"></div>
                                            <div class="line five"></div>
                                            <div class="line six"></div>
                                            <div class="line seven"></div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>
    <footer class="active">
        <div class="content">
            <div class="hamburger hamburger--spring js-hamburger is-active">
                <div class="hamburger-box">
                    <div class="hamburger-inner"></div>
                </div>
            </div>
            <div class="num-of-question">
                <div class="num-of-question-content">
                    <label class="floating-left">1</label><label class="floating-left">-</label>
                    <input type="text" class="floating-left" id="jq_questionindex" value="0">
                </div>
            </div>
            <div class="manhallearning"></div>
            <div class="rectangle-items-container">
                <a class="control_next"></a>
                <a class="control_prev"></a>
                <div class="white-content">
                    <div id="slider">
                        <ul id="questions_slider">
                            <?php
                            function getQuestionName($type){

                                global $Lang;
                                $title='';
                                switch ($type) {
                                    case "1":
                                        $title=$Lang->Trueorfalse;
                                        break;
                                    case "2":
                                        $title=$Lang->MultipleChoice;
                                        break;
                                    case "3":
                                        $title=$Lang->MultipleResponse;
                                        break;
                                    case "4":
                                        $title=$Lang->Fillintheblank;
                                        break;
                                    case "5":
                                        $title=$Lang->Matching;
                                        break;
                                    case "6":
                                        $title=$Lang->DragAnswer;
                                        break;
                                    case "7":
                                        $title=$Lang->ClickMap;
                                        break;
                                    case "8":
                                        $title=$Lang->ShortEssay;
                                        break;
                                    case "9":
                                        $title=$Lang->Sequence;
                                        break;
                                    case "10":
                                        $title=$Lang->WordBank;
                                        break;
                                    case "11":
                                        $title=$Lang->Fillintheblank;
                                        break;
                                }
                                echo $title;
                            }
                            $sql="SELECT * FROM `questions` WHERE `quizid`=".$_GET["id"]." ORDER BY `quiz_sort` ASC ";
                            $result=$con->query($sql);
                            $i=0;
                            while($row=mysqli_fetch_assoc($result)){
                                $i++;
                                ?>
                                <li class="jq_questioni"  title="<?php getQuestionName($row["type"])?>" questionid="<?=$row["quistionid"];?>"><a>Q<?=$i;?></a>
                                    <label class="floating-right">
                                        <i class="edit jq_editquestion floating-left" title="<?= $Lang->Edit; ?>"></i>
                                        <i class="delete jq_deletequestion floating-left" title="<?= $Lang->Delete; ?>"></i>
                                        <i class="jq_movequestion floating-left" title="<?= $Lang->Move; ?>"></i>
                                    </label>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div class="addQuestion tooltip" data-balloon-pos="<?=$left;?>" data-balloon="<?=$Lang->helpaddquestion;?>"></div>
                </div>
            </div>
        </div>
    </footer>
</section>
<iframe style="border:0px;width:0px;height:0px;" id="upload_target" name="upload_target"></iframe>
</body>
</html>