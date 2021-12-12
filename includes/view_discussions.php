<?php
$currentTab = "books";
include_once "platform/config.php";
include_once "includes/function.php";
include_once "platform/includes/function.php";
include_once "includes/header.php";
?>

<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/discussions.css<?=$cash;?>">
<div class="inner-pages-main-container-innerdiscussions">
    <?= $breadCrumbs; ?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">

                    <div class="right-col-3 floating-left">
                        <?php

                        $sql = "UPDATE `educationalinquiries` SET `views`=`views`+1 WHERE id=" . $_GET['id'];
                        $con->query($sql);
                        $sql = "Select users.fullname, users.permession, users.avatar, educationalinquiries.* From educationalinquiries Left Join users On educationalinquiries.iduser = users.userid Where educationalinquiries.id =" . $_GET["id"];
                        $result_Q = $con->query($sql);
                        $row_Q = mysqli_fetch_assoc($result_Q);
                        $sql_A = "Select users.fullname, users.avatar, users.permession, q_comment.* From q_comment Inner Join users On q_comment.iduser = users.userid Where q_comment.qid = " . $_GET["id"];

                        $result_A = $con->query($sql_A);
                        $num_rows = mysqli_num_rows($result_A);


                        ?>
                        <div class="innerdiscussions-main-container-page clear-both">

                            <div class="content__wrapper">
                                <div class="top-black-col">
                                    <label class="floating-left jq_comments_count"><?= $num_rows ?></label>
                                    <label class="floating-left">Comments Found</label>
                                    <div class="view-commint floating-left">
                                        <span><?= $row_Q['views'] ?></span>
                                    </div>
                                    <?php
                                    if ($row_Q['state_q'] == 2) {
                                        ?>
                                        <div class="lock-lable floating-right">
                                            <span><?= $Lang->CLOSED; ?></span>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="write-comment-container">
                                    <div class="post-comment-container">


                                        <div class="item-container">
                                            <div class="left-content floating-left">
                                                <div class="avatar-container">
                                                    <label
                                                        style="background-image: url(<?php

                                                        $avatar=""  ;

                                                        if($row_Q["avatar"]!=""){
                                                            $avatar=getAvatar($row_Q["avatar"]);
                                                        }

                                                        echo $avatar; ?>); "
                                                        class=""></label>
                                                </div>
                                            </div>
                                            <div class="right-content floating-left">
                                                <div class="top floating-left">
                                                    <label class="floating-left"><?= $row_Q["fullname"] ?></label>
                                                    <div class="time-container floating-left">
                                                        <span class="floating-left"><?= $row_Q["date"] ?></span>
                                                    </div>
                                                    <?php
                                                    if (isset($_SESSION["user"]["userid"]) && $_SESSION["user"]["userid"] != "") {
                                                        if (isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"] == 4 || isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"] == 1) {
                                                    ?>
                                                            <a id="control_<?=$_GET['id']?>" class="post-setting-btn floating-right"></a>
                                                            <?php
                                                        }
                                                    }
                                                    ?>


                                                </div>
                                                <?php echo ControlQuestions("main",$_GET['id'],$row_Q['state_q'],$row_Q['iduser']); ?>
                                                <div class="titleQustion"><?= $row_Q["title"] ?> </div>
                                                <div class="bottom"><?= $row_Q["qustion"] ?></div>
                                            </div>

                                        </div>

                                        <?php

                                        while ($row_A = mysqli_fetch_assoc($result_A)) {

                                            if($row_A['state_q']==1 ||(isset($_SESSION["user"]["userid"]) && $_SESSION["user"]["userid"] != ""&&isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"] == 4 || isset($_SESSION["user"]["userid"]) && $_SESSION["user"]["userid"] != ""&&isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"] == 1) ){

                                                   if ($row_A['permession'] == 1 || $row_A['permession'] == 4) {
                                                       $avatar=""  ;

                                                       if($row_A["avatar"]!=""){
                                                            $avatar=getAvatar($row_A["avatar"]);
                                                        }
                                                                    echo '<div class="reply-container">
 <div class="inner-reply-container">
                                            <div class="top floating-left">
                                                <label class="title-raply floating-left">' . $Lang->Raply . '</label>
                                                <label class="floating-left">' . $row_A['fullname'] . '</label>
                                                <div class="time-container floating-left">
                                                    <span class="floating-left">' . $row_A['date'] . '</span>
                                                </div>
                                                 '.drawiconsetting($row_A).'

                                            </div>
                                             '.ControlQuestions("sub",$row_A['qid']."_".$row_A['id'],$row_A['state_q'],$row_A['iduser']).'
                                            <div id="text_'.$row_A['qid']."_".$row_A['id'].'"  class="bottom">
                                                ' . $row_A['comment'] . '
                                            </div>
                                            <a style="display:none" id="buttnsavetxtQ_'.$row_A['qid']."_".$row_A['id'].'" onclick="updateDiscussions('.chr(39).$row_A['qid']."_".$row_A['id'].chr(39).')" class="save-edit-btn floating-right">Save</a>
                                        </div> </div>';


                                            } else  {

                                                echo '<div class="item-container">
                                            <div class="left-content floating-left">
                                                <div class="avatar-container">
                                                    <label style="background-image: url(' . $avatar . ');" class=""></label>
                                                </div>
                                            </div>
                                            <div class="right-content floating-left">
                                                <div class="top floating-left">
                                                    <label class="floating-left">' . $row_A['fullname'] . '</label>
                                                    <div class="time-container floating-left">
                                                        <span class="floating-left">' . $row_A['date'] . '</span>
                                                    </div>
                                                    '.drawiconsetting($row_A).'



                                                </div>
                                                '.ControlQuestions("sub",$row_A['qid']."_".$row_A['id'],$row_A['state_q'],$row_A['iduser']).'
                                                <div class="bottom">' . $row_A['comment'] . '</div>
                                            </div>
                                        </div>';
                                            }
                                        }
                                        }

                                        ?>


                                    </div>

                                    <?php
                                    if (isset($_SESSION["user"]) && !empty($_SESSION["user"])) {
                                        if ($row_Q['state_q'] == 1) {
                                            ?>
                                            <h2 class="text-left"><?= $Lang->yourComment; ?></h2>
                                            <textarea id="Qustion" class="textaria"
                                                      placeholder="<?= $Lang->AddPostQustion; ?>"></textarea>
                                            <a id="addqustionanswer" data-type="discussionsA"
                                               data-id="<?= $_GET["id"] ?>"
                                               class="floating-right comment"><?= $Lang->AddPost; ?></a>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <a class="floating-right comment login-btn btn-popup"
                                           data-type="Container"><?= $Lang->SignInToAddComment; ?></a>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "includes/footer.php";
?>

