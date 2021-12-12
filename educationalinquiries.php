<?php
$currentTab = "educationalinquiries";
include_once "platform/config.php";
include_once "includes/function.php";
include_once "platform/includes/function.php";
include_once "includes/header.php";
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/discussions.css<?=$cash;?>">
<div class="inner-pages-main-container-discussions">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <form class="discussions-search" METHOD="GET" id="books_search">
                        <?php


                        $categoryN = $Lang->AllDiscussions;
                        $val = -1;
                        if (isset($_SESSION["user"]["userid"]) && $_SESSION["user"]["userid"] != "") {
                            if ($_SESSION["user"]["permession"] == 4 || $_SESSION["user"]["permession"] == 1) {
                                if (isset($_GET['category']) && $_GET['category'] != "") {
                                    if ($_GET['category'] == 5) {
                                        $categoryN = $Lang->AllDiscussions;
                                        $val = 5;
                                    } else if ($_GET['category'] == 1) {
                                        $categoryN = $Lang->OpenDiscussions;
                                        $val = 1;
                                    } else if ($_GET['category'] == 2) {
                                        $categoryN = $Lang->CloseDiscussions;
                                        $val = 2;
                                    } else if ($_GET['category'] == 3) {
                                        $categoryN = $Lang->posthidden;
                                        $val = 3;
                                    } else if ($_GET['category'] == 4) {
                                        $categoryN = $Lang->notificationDiscussions;
                                        $val = 4;
                                    }
                                } else {
                                    $categoryN = $Lang->AllDiscussions;
                                    $val = 5;
                                }
                            } else if ($_SESSION["user"]["permession"] == 0) {
                                if (isset($_GET['category']) && $_GET['category'] != "") {
                                    if ($_GET['category'] == 6) {
                                        $categoryN = $Lang->AllDiscussions;
                                        $val = 6;
                                    } else if ($_GET['category'] == 0) {
                                        $categoryN = $Lang->postme;
                                        $val = 0;
                                    } else if ($_GET['category'] == 1) {
                                        $categoryN = $Lang->OpenDiscussions;
                                        $val = 1;
                                    } else if ($_GET['category'] == 2) {
                                        $categoryN = $Lang->CloseDiscussions;
                                        $val = 2;
                                    }
                                } else {
                                    $categoryN = $Lang->AllDiscussions;
                                    $val = 6;

                                }
                            }

                        } else {

                            if (isset($_GET['category']) && $_GET['category'] != "") {
                                if ($_GET['category'] == -1) {
                                    $categoryN = $Lang->AllDiscussions;
                                    $val = -1;
                                } else if ($_GET['category'] == 1) {
                                    $categoryN = $Lang->OpenDiscussions;
                                    $val = 1;
                                } else if ($_GET['category'] == 2) {
                                    $categoryN = $Lang->CloseDiscussions;
                                    $val = 2;
                                }
                            } else {
                                $categoryN = $Lang->AllDiscussions;
                                $val = -1;
                            }
                        }

                        ?>
                        <div class="right-col-3 floating-left">
                            <?php

                            $keyword_filter = "";
                            $cat_filter = "";
                            if (isset($_GET['keywords']) && $_GET['keywords'] != "") {
                                $keyword_filter = " AND ( `qustion` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%'   )";
                            }

                            if (isset($_GET['category']) && $_GET['category'] != "" && $val != -1) {

                                if ($val == 1 || $val == 2) {
                                    $cat_filter = " AND `state_q` = " . $val;
                                } else if ($val == 3 && ($_SESSION["user"]["permession"] == 4) || $val == 3 && $_SESSION["user"]["permession"] == 1) {
                                    $cat_filter = " AND `state_q` = " . $val;
                                } else if ($val == 0) {
                                    $cat_filter = " AND iduser = " . $_SESSION["user"]['userid'] . " AND `state_q` !=3 ";
                                } else if ($val == 4) {
                                    $cat_filter = " AND views = 0 ";
                                } else if ($val == 6) {
                                    $cat_filter = " AND ( `state_q` = 1 || `state_q` = 2 ||  iduser = " . $_SESSION["user"]['userid'] . " )  AND `state_q` !=3 ";
                                } else if ($_SESSION["user"]["permession"] != 4 && $_SESSION["user"]["permession"] != 1) {
                                    $cat_filter = " AND  `state_q` !=3 ";
                                }
                            } else if (isset($_SESSION["user"]) && $_SESSION["user"]["permession"] != 4 && $_SESSION["user"]["permession"] != 1) {
                                $cat_filter = " AND  `state_q` !=3 ";
                            } else {
                                $cat_filter = " AND  `state_q` !=3 ";
                            }
                            $sql = "Select educationalinquiries.*,users.fullname, users.avatar From educationalinquiries Inner Join users On educationalinquiries.iduser = users.userid WHERE  id > 0  " . $keyword_filter . $cat_filter . " ORDER BY educationalinquiries.date DESC ";
                            $result = $con->query($sql);
                            $num_rows = mysqli_num_rows($result);
                            if ($page == "last") {
                                $page = ceil($num_rows / 10);
                            }
                            $link = $real_link;
                            if (isset($_GET["page"]) && $_GET["page"] != "") {
                                $link = str_replace("&page=" . $_GET["page"], "", $link);
                            }

                            $url = "educationalinquiries?";
                            if (strpos($link, "?") === false) {
                                $url = "educationalinquiries?";
                            } else {
                                $arr = explode("?", $link);
                                $getData = explode("&", $arr[1]);
                                $url = "educationalinquiries?" . $arr[1];
                            }
                            $pagination = getPagination($url,$num_rows);

                            $sql = "Select educationalinquiries.*,users.fullname, users.avatar From educationalinquiries Inner Join users On educationalinquiries.iduser = users.userid WHERE  id > 0  " . $keyword_filter . $cat_filter ." ORDER BY educationalinquiries.date DESC ". $pagination[0];

                            $result = $con->query($sql);

                            ?>
                            <div class="discussions-main-container-page clear-both">
                                <div class="top-black-col">
                                    <div class="floating-left">
                                        <label class="lbl-data-a floating-left"><?= $Lang->filter;?></label>
                                        <div class="wrapper-demo">
                                            <div id="subject" class="jq_bookdropdown wrapper-dropdown-3" tabindex="2">
                                                <span style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-En/images/cat/books/all.svg);" class="floating-left"><?= $categoryN?> </span>
                                                <ul class="dropdown submit scrollable">
                                                    <input class="hidden_input" type="hidden" name="category" value="<?=$val?>" id="hidden_category_discussions">

                                                    <?php if (isset($_SESSION["user"]["userid"]) && $_SESSION["user"]["userid"] != "" && $_SESSION["user"]["permession"] == 0) { ?>
                                                        <li class="catli sub-0 no-image" catid="6"><a href="#"><i class="icon-truck icon-large"><?= $Lang->AllDiscussions; ?></i></a>                                                        </li>
                                                        <li class="catli sub-0 no-image" catid="0"> <a href="#"><i class="icon-truck icon-large"><?= $Lang->postme; ?></i></a> </li>
                                                        <li class="catli sub-0 no-image" catid="1"><a href="#"><i class="icon-truck icon-large"><?= $Lang->OpenDiscussions; ?></i></a></li>
                                                        <li class="catli sub-0 no-image" catid="2"><a href="#"><i class="icon-truck icon-large"><?= $Lang->CloseDiscussions; ?></i></a></li>
                                                        <?php }else if(isset($_SESSION["user"]["userid"]) && $_SESSION["user"]["userid"] != "" && $_SESSION["user"]["permession"] == 4 ||(isset($_SESSION["user"]["userid"]) && $_SESSION["user"]["userid"] != "" && $_SESSION["user"]["permession"] == 1)){ ?>
                                                        <li class="catli sub-0 no-image" catid="5"><a href="#"><i class="icon-truck icon-large"><?= $Lang->AllDiscussions; ?></i></a></li>
                                                        <li class="catli sub-0 no-image" catid="4"><a href="#"><i class="icon-truck icon-large"><?= $Lang->notificationDiscussions; ?></i></a></li>
                                                        <li class="catli sub-0 no-image" catid="1"><a href="#"><i class="icon-truck icon-large"><?= $Lang->OpenDiscussions; ?></i></a></li>
                                                        <li class="catli sub-0 no-image" catid="2"><a href="#"><i class="icon-truck icon-large"><?= $Lang->CloseDiscussions; ?></i></a></li>
                                                        <li class="catli sub-0 no-image" catid="3"> <a href="#"><i class="icon-truck icon-large"><?= $Lang->posthidden; ?></i></a></li>
                                                        <?php }else{ ?>
                                                    <li class="catli sub-0 no-image" catid="-1"><a href="#"><i class="icon-truck icon-large"><?= $Lang->AllDiscussions; ?></i></a></li>
                                                    <li class="catli sub-0 no-image" catid="1"><a href="#"><i class="icon-truck icon-large"><?= $Lang->OpenDiscussions; ?></i></a></li>
                                                    <li class="catli sub-0 no-image" catid="2"><a href="#"><i class="icon-truck icon-large"><?= $Lang->CloseDiscussions; ?></i></a></li>
                                                       <?php } ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-search-container floating-left">
                                        <input type="text" class="txt-a floating-left" id="keywords" name="keywords"
                                               placeholder="<?= $Lang->SearchYourItem; ?>"
                                               value="<?php if (isset($_GET['keywords'])) {
                                                   echo $_GET['keywords'];
                                               } ?>">
                                        <input type="submit" class="btn btn-search floating-left" value="">
                                    </div>
                                </div>

                                <div class="content__wrapper">
                                    <div class="write-comment-container">



                                        <?php
                                        if (isset($_SESSION["user"]["userid"]) && $_SESSION["user"]["userid"] != ""  ) {
                                            if($_SESSION["user"]["permession"] == 0){
                                        ?>
                                        <h2 class="text-left"><?= $Lang->PostyourQuestion; ?></h2> <textarea id="textariatitle" class="textaria title" placeholder="<?= $Lang->title; ?>"></textarea> <textarea id="Qustion" class="textaria" placeholder="<?= $Lang->AddPostQustion; ?>"></textarea> <a id="addqustion" data-type="discussions"  class="floating-right comment"><?= $Lang->AddPost; ?></a> <div class="floating-left number-of-comments"> <label class="floating-left jq_comments_count"><?= $num_rows; ?></label> <label class="floating-left"><?= $Lang->Discussions; ?></label> </div>
                                        <?php
                                        }}
                                        else
                                        {
                                            ?>
                                            <a class="floating-right comment login-btn btn-popup" data-type="Container"><?=$Lang->SignInToAddComment;?></a>
                                            <?php
                                        }
                                        ?>
                                        <div class="post-comment-container scrollable">
                                            <?php

                                            while ($question = mysqli_fetch_assoc($result)) {
                                                echo PaintEducationalInquiries($question);
                                            }

                                            ?>


                                        </div>

                                    </div>
                                </div>

                            </div>
                            <div class="paging">
                                <div class="content">
                                    <?php
                                 echo $pagination[1];
                                    ?>
                                </div>
                            </div>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once "includes/footer.php";
?>

