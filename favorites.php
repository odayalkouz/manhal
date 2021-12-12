<?php
$currentTab = "favorites";
include_once "includes/function.php";
mustLogin();
include_once "platform/includes/function.php";
include_once "includes/header.php";
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/books.css<?=$cash;?>">
<?php
if($detect->isMobile() || $detect->isTablet())
{
    ?>
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/probooks.css<?=$cash;?>">
    <?php
}
?>
<div class="inner-pages-main-container-books">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                        <form class="books-search text-left" METHOD="GET">
                            <div class="right-col-3 floating-left">
                                <div class="books-main-container-page clear-both">
                                    <div class="top-black-col">
                                        <label class="lbl-data-a floating-left"><?=$Lang->Type;?></label>
                                        <div class="wrapper-demo floating-left">
                                            <div id="subjectfav" class="jq_bookdropdown wrapper-dropdown-3" tabindex="2">
                                                <?php
                                                if(isset($_GET['product_type']) && $_GET['product_type']=="book"){
                                                    $thumb=SITE_URL."themes/main-Light-green-En/images/cat/product/books.svg";
                                                }elseif(isset($_GET['product_type']) && $_GET['product_type']=="story"){
                                                    $thumb=SITE_URL."themes/main-Light-green-En/images/cat/product/story.svg";
                                                }else{
                                                    $thumb=SITE_URL."themes/main-Light-green-En/images/cat/books/all.svg";
                                                }
                                                ?>
                                                <span style="background-image: url(<?=$thumb;?>);" class="floating-left"><?php if(isset($_GET['product_type']) && $_GET['product_type']=="book"){echo $Lang->Books;}else if(isset($_GET['product_type']) && $_GET['product_type']=="story"){echo $Lang->Stories;}else{echo $Lang->All;}?></span>
                                                <!--//start khalid 21-9-2016-->
                                                <ul class="dropdown submit">
                                                    <input type="hidden" class="hidden_input" name="product_type"  value="<?= $_GET['product_type'] ?>">
                                                    <li catid="0" class="sub-0 no-image"><a href="#"><i class="icon-truck icon-large"><?= $Lang->All; ?></i></a></li>
                                                    <li catid="book"><a style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-En/images/cat/product/books.svg)" class="<?php if(isset($_GET['product_type']) && $_GET['product_type']=="book"){echo 'selected';}?>"  href="#"><i class="icon-truck icon-large"><?=$Lang->Books;?></i></a></li>
                                                    <li catid="story"><a style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-En/images/cat/product/story.svg) " class="<?php if (isset($_GET['product_type']) && $_GET['product_type']=="story"){echo 'selected';}?>"  href="#"><i class="icon-truck icon-large"><?=$Lang->Stories;?></i></a></li>
                                               <!-- //start khalid 21-9-2016 -->
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                <?php
                                $filter=" WHERE `wishs`.`userid`=".$_SESSION['user']['userid'];
                                if(isset($_GET['product_type']) && $_GET['product_type']!="0"){
                                    $filter.=" AND `wishs`.`type` ='".$_GET['product_type']."' ";
                                }
                                $sql = "SELECT `wishs`.*,`wishs`.`type` as item_type, `books`.`bookid`,`books`.`name`,`books`.`category`,`books`.`views`,`books`.`sales`, `books`.`favorites`, `books`.`booktype`,
                                IF(`wishs`.`type`='book',`books`.`description_en`,`story`.`description_en`) as `description_en`,
                                IF(`wishs`.`type`='book',`books`.`description_ar`,`story`.`description_ar`) as `description_ar`,
                                IF(`wishs`.`type`='book',`books`.`author_ar`,`story`.`author_ar`) as `author_ar`,
                                IF(`wishs`.`type`='book',`books`.`author_en`,`story`.`author_en`) as `author_en`,
                                IF(`wishs`.`type`='book',`books`.`price`,`story`.`price`) as `price`,
                                IF(`wishs`.`type`='book',`books`.`rate`,`story`.`rate`) as `rate`,
                                IF(`wishs`.`type`='book',`books`.`isbn`,`story`.`isbn`) as `isbn`,
                                IF(`wishs`.`type`='book',`books`.`filling`,`story`.`filling`) as `filling`,
                                IF(`wishs`.`type`='book',`books`.`color`,`story`.`color`) as `color`,
                                IF(`wishs`.`type`='book',`books`.`eprice`,`story`.`eprice`) as `eprice`,
                                IF(`wishs`.`type`='book',`books`.`iprice`,`story`.`iprice`) as `iprice`,
                                IF(`wishs`.`type`='book',`books`.`comments`,`story`.`comments`) as `comments`,
                                IF(`wishs`.`type`='book',`books`.`rating_count`,`story`.`rating_count`) as `rate_count`,
                                `story`.`storyid`,`story`.`seriesid`,`story`.`add_date`,`story`.`catid`,`story`.`favorite_count`,`story`.`likes_count`,`story`.`sales_count`,`story`.`thumb`,`story`.`title`,`story`.`type`,
                                `story`.`view_count`,
                                IF(`wishs`.`type`='book',`categories`.`name_".$cat_code."`,`stories_cat`.`name_".$cat_code."`) as name_".$cat_code.",
                                IF(`wishs`.`type`='book',`books`.`language`,`story`.`language`) As `language`
                                FROM `wishs` LEFT OUTER JOIN `books` ON `wishs`.`bookid`=`books`.`bookid` LEFT OUTER JOIN `story` ON `wishs`.`bookid`=`story`.`storyid`
                                LEFT OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` LEFT OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` ".$filter;
                                $result = $con->query($sql);
                                $num_rows = mysqli_num_rows($result);

                                $url = "favorites?";
                                if (isset($_GET['product_type']) && $_GET['product_type'] != "0") {
                                    $url .= "product_type=" . $_GET['product_type'] . "&";
                                }
                                $pagination = getPagination($url, $num_rows);
                                $sql = "SELECT `wishs`.*,`wishs`.`type` as item_type, `books`.`bookid`,`books`.`name`,`books`.`category`,`books`.`views`,`books`.`sales`, `books`.`favorites`, `books`.`booktype`,
                                IF(`wishs`.`type`='book',`books`.`description_en`,`story`.`description_en`) as `description_en`,
                                IF(`wishs`.`type`='book',`books`.`description_ar`,`story`.`description_ar`) as `description_ar`,
                                IF(`wishs`.`type`='book',`books`.`author_ar`,`story`.`author_ar`) as `author_ar`,
                                IF(`wishs`.`type`='book',`books`.`author_en`,`story`.`author_en`) as `author_en`,
                                IF(`wishs`.`type`='book',CAST(`books`.`price` AS DECIMAL(10,2)),CAST(`story`.`price` AS DECIMAL( 10, 2 )))  as`price`,
                                IF(`wishs`.`type`='book',`books`.`rate`,`story`.`rate`) as `rate`,
                                IF(`wishs`.`type`='book',`books`.`isbn`,`story`.`isbn`) as `isbn`,
                                IF(`wishs`.`type`='book',`books`.`filling`,`story`.`filling`) as `filling`,
                                IF(`wishs`.`type`='book',`books`.`color`,`story`.`color`) as `color`,
                                IF(`wishs`.`type`='book',`books`.`eprice`,`story`.`eprice`) as `eprice`,
                                IF(`wishs`.`type`='book',`books`.`iprice`,`story`.`iprice`) as `iprice`,
                                IF(`wishs`.`type`='book',`books`.`comments`,`story`.`comments`) as `comments`,
                                IF(`wishs`.`type`='book',`books`.`rating_count`,`story`.`rating_count`) as `rate_count`,
                                `story`.`storyid`,`story`.`seriesid`,`story`.`add_date`,`story`.`catid`,`story`.`favorite_count`,`story`.`likes_count`,`story`.`sales_count`,`story`.`thumb`,`story`.`title`,`story`.`type`,
                                `story`.`view_count`,
                                IF(`wishs`.`type`='book',`categories`.`name_".$cat_code."`,`stories_cat`.`name_".$cat_code."`) as name_".$cat_code.",
                                IF(`wishs`.`type`='book',`books`.`language`,`story`.`language`) As `language`
                                FROM `wishs` LEFT OUTER JOIN `books` ON `wishs`.`bookid`=`books`.`bookid` LEFT OUTER JOIN `story` ON `wishs`.`bookid`=`story`.`storyid`
                                LEFT OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` LEFT OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` ".$filter.$pagination[0];
                                $result = $con->query($sql);
                                ?>

                                <div class="ui-panels">
                                    <?php
                                    while($row=mysqli_fetch_assoc($result))
                                    {
                                        switch($row["item_type"])
                                        {
                                            case "book":
                                               // echo $row["price"]."<br>";
                                                echo PaintBook($row,"StudentBook");
                                                break;
                                            case "story":
                                                echo PaintStory($row);
                                                break;
                                        }
                                    }
                                    ?>
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
<?php
include_once "includes/footer.php";
?>


