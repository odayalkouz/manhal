<?php
include_once "includes/function.php";
mustLogin();

if(isset($_GET["id"]) && $_GET["id"]=="new"){
    $sql="INSERT INTO `quiz`(`quizid`, `userid`, `category`, `title`, `Introduction`, `age`, `passing_rate`, `cdate`, `status`, `note`)
    VALUES ('',".$_SESSION["user"]["userid"].",0,'','',0,0,CURDATE(),0,'')";
    $con->query($sql);
    $id=mysqli_insert_id($con);
    header("location:".SITE_URL.$lang_code."/quiz-editor?id=".$id);
}elseif(isset($_GET["id"]) && $_GET["id"]!=""){
    $sql="SELECT * FROM `quiz` WHERE `quizid`=".$_GET["id"];
    $result=$con->query($sql);
    $row=mysqli_fetch_assoc($result);
}else{//error

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$row["title"];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no, maximum-scale=1.0">
    <meta http-equiv="Cache-Control" content="no-cache">
    <link rel="icon" data-type="favicon" sizes="24" href="" type="image/x-icon">
    <link rel="stylesheet" href="<?=SITE_URL?>quizeditor/thems/En/css/style.css">
    <link href="<?=SITE_URL?>quizeditor/thems/En/css/animate.css" rel="Stylesheet" type="text/css"/>
    <link href="<?=SITE_URL?>quizeditor/thems/En/css/size.css" rel="Stylesheet" type="text/css"/>
    <link href="<?=SITE_URL?>quizeditor/thems/En/css/swiper.min.css" rel="Stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL?>quizeditor/thems/En/css/default.css">
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL?>quizeditor/thems/En/css/font-awesome.min.css" />
    <script type="text/javascript" src="<?=SITE_URL?>quizeditor/js/jquery.js"></script>
    <script src="<?=SITE_URL?>quizeditor/js/jquery-ui.min.js" type="text/javascript"></script>
    <script src="<?=SITE_URL?>quizeditor/js/manhal-ui.js" type="text/javascript"></script>
    <script src="<?=SITE_URL?>quizeditor/js/quiz-editor.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?=SITE_URL?>quizeditor/js/jquery.popline.min.js"></script>
    <link rel="stylesheet" href="<?=SITE_URL?>quizeditor/thems/En/css/jquery-ui.min.css">
    <script type="text/javascript" src="<?=SITE_URL?>quizeditor/js/jquery.ui.touch-punch.min.js"></script>
    <script>
        window.quizid=<?=$_GET["id"];?>;
    </script>

</head>
<body>
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
                <a class="yes floating-right"><?=$Lang->Yes;?></a>
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
                    <input type="text" class="right floating-right" placeholder="Quiz Title">
                </div>
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->Introduction;?></div>
                    </div>
                    <input type="text" class="right floating-right" placeholder="Introduction">
                </div>
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->Language;?></div>
                    </div>
                    <select class="right floating-right">
                        <option><?=$Lang->English;?></option>
                        <option><?=$Lang->Arabic;?></option>
                    </select>                </div>
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->Age;?></div>
                    </div>
                    <input type="text" class="right floating-right" placeholder="Age">
                </div>
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->Published;?></div>
                    </div>
                    <label class="floating-left first" for="private"><?=$Lang->private;?></label>
                    <input type="radio" checked="checked" name="Published" class="floating-left" id="private" placeholder="private">
                    <label class="floating-left" for="Public"><?=$Lang->Public;?></label>
                    <input type="radio" name="Published" class="floating-left" id="Public" placeholder="Public">
                </div>
            </div>
            <p><?=$Lang->QuizFeedback;?></p>
            <div class="row-container">
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->Passed;?></div>
                    </div>
                    <input type="text" class="right floating-right" placeholder="Passed">
                </div>
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->Faild;?></div>
                    </div>
                    <input type="text" class="right floating-right" placeholder="Faild">
                </div>
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->Category;?></div>
                    </div>
                    <select class="right floating-right">
                        <option><?=$Lang->Setting1;?>Math</option>
                        <option><?=$Lang->Setting1;?>English</option>
                        <option><?=$Lang->Setting1;?>Arabic</option>
                    </select>
                </div>
            </div>
            <p><?=$Lang->QuizResult;?></p>
            <div class="row-container">
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->PassingRate;?></div>
                    </div>
                    <input type="text" class="right floating-right" placeholder="Pass Rate">
                </div>
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->QuizPass;?></div>
                    </div>
                    <input type="text" class="right floating-right" placeholder="Quiz Pass">
                </div>
                <div class="line-row">
                    <div class="left floating-left">
                        <div class="point floating-left"></div>
                        <div class="text floating-left"><?=$Lang->QuizFaild;?></div>
                    </div>
                    <input type="text" class="right floating-right" placeholder="Quiz Faild">
                </div>
            </div>
            <div class="btn-save-container floating-right">
                <a class="save"><label><?=$Lang->Save;?></label></a>
            </div>
        </div>
    </div>
    <div class="popup-edit-video-container noclose">
        <div class="edit-video-container">
            <h1><?=$Lang->Editvideo;?></h1>
            <a class="close"></a>
            <form id="video_form" method="POST" action="" enctype="multipart/form-data" target="upload_target">
                <div class="row-container">
                    <div class="line-row">
                    <div class="point floating-left"></div>
                    <label class="lbl-data-a floating-left"><?=$Lang->YoutubeURL;?></label>
                    <input class="txt-a floating-left" type="text" name="youtube" id="youtube" placeholder="Youtube URL">
                </div>
                </div>
                <div class="btn-save-container floating-right" id="update_video" >
                    <a class="save"><label><?=$Lang->Save;?></label></a>
                </div>
            </form>

        </div>
    </div>
    <div class="popup-edit-image-container noclose">
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
                            <label class="floating-left label-b" id="lblimage"></label>
                            <input id="image" type="file" name="image">
                        </div>
                    </div>
                </div>
                <div class="btn-save-container floating-right" id="update_video" >
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
            <label class="floating-left"><?=$Lang->Title;?> :</label><label class="floating-left"><?=$Lang->QuestionAndanswer;?></label>
        </div>
        <div class="options-icons floating-right">
            <a title="Settings" class="floating-left settings"></a>
            <a title="Save" class="floating-left save jq_topsave"></a>
            <a title="View" class="floating-left view" target="_blank" href="#"></a>
            <a title="Publish" class="floating-left publish"></a>
        </div>
    </header>
    <div class="editor-main-menu-container">
        <div class="nav floating-left">
            <a id="Page_menu" class="noclose"></a>
            <a id="feedback_menu" class="noclose"></a>
        </div>
        <div class="nav-content noclose" id="page-content" style="display: none">
            <div class="header">
                <a class="floating-left title"><?=$Lang->Draganddrop;?></a>
                <a class="floating-right close-menu"><i
                        class="flaticon-x"></i></a>
            </div>
            <div class="content">
                <div class="row floating-left draggable" id="text">
                    <a class="floating-left icon text"> <i class="flaticon-pages"></i></a>
                    <a class="floating-left title"><?=$Lang->Text;?></a>
                </div>
                <div class="row floating-left draggable" id="video">
                    <a class="floating-left icon video"><i class="flaticon-document26"></i></a>
                    <a class="floating-left title"><?=$Lang->video;?></a>
                </div>
                <div class="row floating-left draggable" id="sound">
                    <a class="floating-left icon sound"><i class="flaticon-fon"></i></a>
                    <a class="floating-left title"><?=$Lang->sound;?></a>
                </div>
                <div class="row floating-left draggable" id="image">
                    <a class="floating-left icon image"><i class="flaticon-gear39"></i></a>
                    <a class="floating-left title"><?=$Lang->Image;?></a>
                </div>
            </div>
        </div>
        <div class="nav-content noclose" id="action-content" style="display: none">
            <div class="content contentB">
                <a class="floating-left title-a"><?=$Lang->InCorrectFeedBack;?></a>
                <textarea type="text" class="input-incorect" id="incorrectfeedback"></textarea>
                <a class="floating-left title-a"><?=$Lang->CorrectFeedBack;?></a>
                <textarea type="text" class="input-incorect" id="correctfeedback"></textarea>
                <div class="correct-point">
                    <div class="line-row">
                        <label class="floating-left"><?=$Lang->Correctpoint;?></label>
                        <input class="floating-left" id="correctpoints" type="number" min="0">
                    </div>
                    <div class="line-row">
                        <label class="floating-left"><?=$Lang->Incorrectpoint;?></label>
                        <input class="floating-left" id="incorrectpoints" type="number" min="0">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="quiz-container">
        <section class="questions-main-container" style="display: block">
            <div class="content-container">
                <div class="slider-main-container">
                    <div style="display: none" class="question-answer-container active">
                        <div class="question-view resizable-box-content droppable">
                            <div class="num floating-left"></div>
                            <div class="text floating-left">
                                <div class="question">
                                    <span>
                                        <a class="text-left"><?=$Lang->MultipleChoice;?></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="answer overflow">
                            <div class="multible-choises floating-left">
                                <ul>
                                    <li class="ans">
                                        <div class="floating-right action-hover">
                                            <i class="save floating-left"></i>
                                            <i class="edit floating-left"></i>
                                            <i class="delete floating-left"></i>
                                        </div>
                                        <input type="radio" name="Quastion0" id="Quastion0_2">
                                        <label for="Quastion0_2">
                                            <div><?=$Lang->One;?></div>
                                            <textarea></textarea>
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
                                <div class="additem"></div>
                            </div>
                        </div>
                    </div>
                    <div style="display: none" class="question-answer-container ">
                        <div class="question-view resizable-box-content droppable">
                            <div id="CorQuastion1"></div>
                            <div class="num floating-left"></div>
                            <div class="text floating-left">
                                <div class="question">
                                    <span><?=$Lang->Fillintheblank;?></span>
                                </div>
                            </div>
                        </div>
                        <div class="answer">
                            <div class="fill-in-the-blank floating-left ">
                                <div class="title" placeholder="Enter your Answer"><?=$Lang->EnteryourAnswer;?></div>
                                <div class="box-text ans">
                                    <div class="floating-right action-hover">
                                        <i class="save floating-left"></i>
                                        <i class="edit floating-left"></i>
                                        <i class="delete floating-left"></i>
                                    </div>
                                    <span></span>
                                    <input id="inputtextQuastion3" type="text" value=" ">
                                </div>
                                <div class="additem"></div>
                            </div>
                        </div>
                    </div>
                    <div style="display: none" class="question-answer-container">
                        <div class="question-view resizable-box-content droppable">
                            <div id="CorQuastion2"></div>
                            <div class="num floating-left"></div>
                            <div class="text floating-left">
                                <div class="question vresizable">
                                    <span><a><?=$Lang->ShortEssay;?></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="answer">
                            <div class="short-essay floating-left">
                                <div class="paper-background ">
                                    <section contenteditable="true" class="paper-content essay_answer"></section>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display: none" class="question-answer-container">
                        <div class="question-view resizable-box-content droppable">
                            <div class="num floating-left"></div>
                            <div class="text floating-left">
                                <div class="question">
                                    <span><a><?=$Lang->Sequence;?></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="answer">
                            <div class="sequence floating-left">
                                <ul class="ui-sortable">
                                    <li class="line-row ans">
                                        <div class="floating-right action-hover">
                                            <i class="save floating-left"></i>
                                            <i class="edit floating-left"></i>
                                            <i class="delete floating-left"></i>
                                        </div>
                                        <label class="box-number floating-left">0</label>
                                        <span class="floating-left"><?=$Lang->Item0;?> </span>
                                        <textarea></textarea>
                                    </li>
                                </ul>
                                <div class="additem"></div>
                            </div>
                        </div>
                    </div>
                    <div style="display: none" class="question-answer-container">
                        <div class="question-view resizable-box-content droppable">
                            <div class="num floating-left"></div>
                            <div class="text floating-left">
                                <div class="question">
                                    <span><a class="text-left"><?=$Lang->WordBank;?></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="answer">
                            <div class="word-bank floating-left">
                                <div class="box-drag-in"><?=$Lang->Dragyouranswer;?></div>
                                <ul>
                                    <li class="ans">
                                        <div class="floating-right action-hover">
                                            <i class="save floating-left"></i>
                                            <i class="edit floating-left"></i>
                                            <i class="delete floating-left"></i>
                                        </div>
                                        <input type="radio" name="Quastion0" id="Quastion0_2">
                                        <label for="Quastion0_2">
                                            <div><?=$Lang->One;?></div>
                                            <textarea></textarea>
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
                                <div class="additem"></div>
                            </div>
                        </div>
                    </div>
                    <div style="display: none" class="question-answer-container">
                        <div class="question-view resizable-box-content droppable">
                            <div class="num floating-left"></div>
                            <div class="text floating-left">
                                <div class="question">
                                    <span>
                                        <a class="text-left">
                                            <span>Match and learn- Animal eggs</span>
                                        </a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="answer">
                            <div class="matching floating-left">
                                <div class="left-container floating-left">
                                    <div class="box-container droppable ans_left">
                                        <!--<div class="image">-->
                                            <!--<div class="real-content remove-margin">-->
                                                <!--<img src="thems/En/images/1.jpg" style="width:100%;height: 100%">-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    </div>
                                    <div class="box-container droppable ans_left">
                                        <!--<div class="image">-->
                                           <!--<div class="real-content remove-margin">-->
                                               <!--<img src="thems/En/images/1.jpg" style="width:100%;height: 100%">-->
                                           <!--</div>-->
                                        <!--</div>-->
                                    </div>
                                    <div class="box-container droppable ans_left">
                                        <!--<div class="image">-->
                                            <!--<div class="real-content remove-margin">-->
                                                <!--<img src="thems/En/images/1.jpg" style="width:100%;height: 100%">-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                                <div class="center-container floating-left">
                                    <div class="left floating-left">
                                        <div class="item">
                                            <div class="button">1</div>
                                        </div>
                                        <div class="item">
                                            <div class="button">2</div>
                                        </div>
                                        <div class="item">
                                            <div class="button">3</div>
                                        </div>
                                    </div>
                                    <div class="right floating-right">
                                        <div class="item">
                                            <select class="text-box">
                                                <option value="0">1</option>
                                                <option value="1">2</option>
                                                <option value="2">3</option>
                                            </select>
                                        </div>
                                        <div class="item">
                                            <select class="text-box">
                                                <option value="0">1</option>
                                                <option value="1">2</option>
                                                <option value="2">3</option>
                                            </select>
                                        </div>
                                        <div class="item">
                                            <select class="text-box">
                                                <option value="0">1</option>
                                                <option value="1">2</option>
                                                <option value="2">3</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="left-container floating-right">
                                    <div class="box-container droppable ans_right">
                                        <!--<div class="image">-->
                                            <!--<div class="real-content remove-margin">-->
                                                <!--<img src="thems/En/images/1.jpg" style="width:100%;height: 100%">-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    </div>
                                    <div class="box-container droppable ans_right">
                                        <!--<div class="image">-->
                                            <!--<div class="real-content remove-margin">-->
                                                <!--<img src="thems/En/images/1.jpg" style="width:100%;height: 100%">-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    </div>
                                    <div class="box-container droppable ans_right">
                                        <!--<div class="image">-->
                                            <!--<div class="real-content remove-margin">-->
                                                <!--<img src="thems/En/images/1.jpg" style="width:100%;height: 100%">-->
                                            <!--</div>-->
                                        <!--</div>-->
                                    </div>
                                </div>
                                <div class="additem"></div>
                            </div>
                        </div>
                    </div>
                    <div style="display: none" class="question-answer-container">
                        <div class="question-view resizable-box-content droppable">
                            <div class="num floating-left"></div>
                            <div class="text floating-left">
                                <div class="question">
                                    <span>
                                        <a class="text-left"><?=$Lang->ClickMap;?></a>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="answer">
                            <div class="red circle-map"
                                 style="width:50px; height:50px;position:absolute; left:295px; top: 123.296875px; z-index: 9">
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
                            </div>
                            <div class="click-map floating-left">
                                <div class="pointer-click"></div>
                                <div class="box-map-main">
                                    <div class="box-map-inner" id="ClickMap6">
                                        <div id="ErrorClickMap6"></div>
                                        <img id="map_image" att="6" src="thems/En/images/image.png" publish="thems/En/images/image.png"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="display: none" class="question-answer-container">
                        <div class="question-view resizable-box-content droppable">
                            <div class="num floating-left"></div>
                            <div class="text floating-left">
                                <div class="question vresizable jq_multi_file dropable">
                                    <span><a class="jq_changetype text-left"><?=$Lang->MultipleResponse;?></a></span>
                                </div>
                            </div>
                        </div>
                        <div class="answer">
                            <div class="multiple-response floating-left ans">
                                <div class="line-row">
                                    <div class="floating-right action-hover">
                                        <i class="save floating-left"></i>
                                        <i class="edit floating-left"></i>
                                        <i class="delete floating-left"></i>
                                    </div>
                                    <input att="0" type="checkbox" id="Quastion7_0">
                                    <label for="Quastion7_0" class="check-box v3 floating-left"></label>
                                    <label for="Quastion7_0" class="floating-left option-text">
                                        <div class="vresizable dropable selected_dropable"><?=$Lang->Three;?></div>
                                    </label>
                                    <textarea></textarea>
                                </div>
                            </div>
                            <div class="multiple-response floating-left ans">
                                <div class="line-row">
                                    <div class="floating-right action-hover">
                                        <i class="save floating-left"></i>
                                        <i class="edit floating-left"></i>
                                        <i class="delete floating-left"></i>
                                    </div>
                                    <input att="0" type="checkbox" id="Quastion7_1">
                                    <label for="Quastion7_1" class="check-box v3 floating-left"></label>
                                    <label for="Quastion7_1" class="floating-left option-text">
                                        <div class="vresizable dropable"><?=$Lang->Four;?></div>
                                    </label>
                                    <textarea></textarea>
                                </div>
                            </div>
                            <div class="multiple-response floating-left ans">
                                <div class="line-row">
                                    <div class="floating-right action-hover">
                                        <i class="save floating-left"></i>
                                        <i class="edit floating-left"></i>
                                        <i class="delete floating-left"></i>
                                    </div>
                                    <input att="0" type="checkbox" id="Quastion7_2">
                                    <label for="Quastion7_2" class="check-box v3 floating-left"></label>
                                    <label for="Quastion7_2" class="floating-left option-text">
                                        <div class="vresizable dropable"><?=$Lang->One;?></div>
                                    </label>
                                    <textarea></textarea>
                                </div>
                            </div>
                            <div class="multiple-response floating-left ans">
                                <div class="line-row">
                                    <div class="floating-right action-hover">
                                        <i class="save floating-left"></i>
                                        <i class="edit floating-left"></i>
                                        <i class="delete floating-left"></i>
                                    </div>
                                    <input att="0" type="checkbox" id="Quastion7_3">
                                    <label for="Quastion7_3" class="check-box v3 floating-left"></label>
                                    <label for="Quastion7_3" class="floating-left option-text">
                                        <div class="vresizable dropable"><?=$Lang->Two;?></div>
                                    </label>
                                    <textarea></textarea>
                                </div>
                                <div class="additem"></div>
                            </div>
                        </div>
                    </div>
                    <div style="display: none" class="question-answer-container">
                        <div class="question-view resizable-box-content droppable">
                            <div id="CorQuastion8"></div>
                            <div class="num floating-left"></div>
                            <div class="text floating-left">
                                <div class="question vresizable jq_multi_file dropable" publish=""
                                     editor="" id="question_container" src="" data_src=""><span
                                        class="poplinable" contenteditable="false"><a
                                        class="jq_changetype text-left" qtype="1"
                                        style="display: block; overflow: hidden; width: 680px; height: 40px; line-height: 40px; padding: 0px 0px 0px 10px; color: rgb(0, 171, 103);"><?=$Lang->Setting1;?>True / False</a></span>
                                </div>
                            </div>
                        </div>
                        <div class="answer overflow" id="answer_container">
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
                    <input type="text" class="floating-left" value="10">
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
                            $sql="SELECT * FROM `questions` WHERE `quizid`=".$_GET["id"];
                            $result=$con->query($sql);
                            $active="active";
                            $i=0;
                            while($row=mysqli_fetch_assoc($result)){
                                $i++;
                                if( $active=="active"){
                                    ?>
                                <script>
                                    window.questionid=<?=$row["quistionid"];?>;
                                </script>

                                    <?php
                                }
                                ?>

                                <li class="jq_questioni <?=$active;?>" questionid="<?=$row["quistionid"];?>"><a>Q<?=$i;?></a><label class="floating-right"><i class="edit jq_editquestion floating-left"></i><i class="delete jq_deletequestion floating-left"></i></label></li>
                            <?php
                                $active="";
                            }

                            ?>
                        </ul>
                    </div>
                    <div class="addQuestion"></div>
                </div>
            </div>
        </div>
    </footer>
</section>
</body>
</html>