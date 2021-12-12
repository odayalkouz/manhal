<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if(isset($_GET['id'])) {
    $sql = "Select * From news where `newsid` =".$_GET['id'];
    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0)
    {
        $row = mysqli_fetch_assoc($result);
    }
}
include_once "includes/function.php";
include_once("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/newsevent.css<?=$cash;?>">

<?php
if($detect->isMobile() || $detect->isTablet())
{
    ?>
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/pronewsevent.css<?=$cash;?>">
    <?php
}
?>

<div class="inner-pages-main-container-innernews-event">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="image-header-container">
                        <h1><?php if(isset($row)){echo $row['title_'.$cat_code];} ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="innernews-event-content">
        <div class="center-piece">
            <div class="time-share-top-container">
                <div class="inner-silver-container">
                    <div class="time-side floating-left">
                        <span class="floating-left"><?=date('H:i:s',strtotime($row['news_date']))?></span>
                        <span class="floating-left"><?=date('D',strtotime($row['news_date']))?></span>
                        <span class="floating-left"><?=date('d-M',strtotime($row['news_date']))?></span>
                    </div>
                    <div class="left-button floating-right">
                            <div class="a2a_kit a2a_kit_size_32 a2a_default_style share-side floating-right">
                                <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                                <a class="a2a_button_facebook"></a>
                                <a class="a2a_button_twitter"></a>
                                <a class="a2a_button_google_plus"></a>
                                <a class="a2a_button_linkedin"></a>
                                <a class="a2a_button_pinterest"></a>
                            </div>
                            <script>
                                var a2a_config = a2a_config || {};
                                a2a_config.onclick = 1;
                                a2a_config.color_main = "D7E5ED";
                                a2a_config.color_border = "AECADB";
                                a2a_config.color_link_text = "333333";
                                a2a_config.color_link_text_hover = "333333";
                            </script>
                            <script async src="<?=SITE_URL;?>js/shared.js"></script>
                    </div>


                </div>
            </div>
            <div class="main-news-container">
                <?php
                if($row["newsid"]!=23){
                    ?>
                    <img class=" floating-right" src="<?php if(isset($row)){echo SITE_URL.$row['image'];} ?>">
                    <?php
                }
                ?>
                <p>
                    <?php if(isset($row)){echo $row['news_'.$cat_code];} ?>
                </p>
            </div>
            <div class="write-comment-container">
                <?php
                if(isset($_SESSION["user"]) && !empty($_SESSION["user"]))
                {
                    ?>
                    <h1><?=$Lang->Leaveyourcomments;?></h1>
                    <div class="textaria" contenteditable="true" ><?=$Lang->writecomment;?></div>
                    <a id="addcomment" data-type="news" data-id="<?=$_GET["id"];?>" class="floating-right comment" ><?=$Lang->Comment;?></a>
                <?php } ?>
                <div class="floating-left number-of-comments">
                    <label class="floating-left"><?=$Lang->Comments;?></label>
                    <?php
                    if(isset($_GET["id"])&& is_numeric($_GET["id"]))
                    {
                        $result = $con->query("SELECT `comments`.*,`users`.* FROM `comments` INNER JOIN `users` ON `comments`.`userid`=`users`.`userid` WHERE `comments`.`productid`=" . $_GET["id"] . " AND `comments`.`type`='news'");
                        $num_rows = mysqli_num_rows($result);
                    }
                    else
                    {
                        $num_rows=0;
                    }
                    ?>
                    <label class="floating-left">(<?=$num_rows;?>)</label>
                </div>
                <div class="post-comment-container scrollable">
                    <?php
                    if(isset($_GET["id"])&& is_numeric($_GET["id"]))
                    {
                        $coment_array=getComments("news",$_GET["id"],1);
                        echo $coment_array[0];
                    }
                    ?>
                </div>
                <div class="pagination-container">
                    <div class="paging">
                        <div class="content" data-type="news" data-id="<?=$_GET["id"];?>">
                            <?php
                            if(isset($_GET["id"])&& is_numeric($_GET["id"]))
                            {
                                echo $coment_array[1];
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php"); ?>
