<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 25/8/2016
 * Time: 1:11 PM
 */

    $sql="UPDATE `books` SET `views`=`views`+1 WHERE `bookid`=".$_GET['id'];
    $con->query($sql);
    $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status`=1 AND `books`.`bookid` =".$_GET['id'];
    $result = $con->query($sql);
    $row=mysqli_fetch_assoc($result);
    $id=uniqid(rand(10000,99999), true);
    $canRead=getReadingOption("book",$_GET['id']);
    $bg=SITE_URL."platform/books/".$row["bookid"]."/cover.jpg";



$qty = 1;



include("includes/header.php");
?>


<?php
if($row["language"]=="En"){
    $title=$row["name"]." book";
}else{
    $title="كتاب ".$row["name"];
}
?>
<script type="application/ld+json">
{
  "@context":  "http://schema.org/",
  "@id": "#book<?=$row["bookid"];?>",
  "@type": "Book",
  "additionalType": "Product",
  "name": "<?=$row["name"];?>",
  "author": "<?=$row["author_".$cat_code];?>",
  "bookFormat": "http://schema.org/Paperback",
  "datePublished": "<?=$row["year"];?>-06-01",
  "image": "<?=$bg;?>",
  "inLanguage": "<?=getEnglishWord($row['language']);?>",
  "isbn": "<?=$row['isbn'];?>",
  "numberOfPages": "<?=$row['pages_count'];?>",
  "offers": {
            "@type": "Offer",
            "availability": "http://schema.org/InStock",
            "price": "<?=$row['price'];?>",
            "priceCurrency": "USD"
          },
  "publisher": "<?=$Lang->DarAlManhalPublishers;?>",
  "isFamilyFriendly": "true",
  "bookFormat": "http://schema.org/Paperback",
  "about":"<?=$row['seodescription_'.$cat_code];?>"
}
</script>
<script src="<?= SITE_URL; ?>js/jquery.ui.touch-punch.min.js<?= $cash; ?>" type="text/javascript"></script>
<script src="<?= SITE_URL; ?>js/allinone_carousel.js" type="text/javascript"></script>
<?php
if(!$detect->isMobile() || $detect->isTablet()) {
    ?>
    <script src='<?= SITE_URL; ?>js/slick.js<?= $cash; ?>'></script>
    <?php
}
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/view.css<?=$cash;?>">
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/worksheet.css<?=$cash;?>">


<?php
if($detect->isMobile() || $detect->isTablet()) {
    ?>
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/proview.css<?=$cash;?>">
    <?php
}
?>
<?php
if(!$detect->isMobile() || $detect->isTablet()) {
    ?>
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/slick.css<?=$cash;?>">
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/slick-theme.css<?=$cash;?>">

    <script async src="<?=SITE_URL;?>js/js.js"></script>
    <?php
}
?>
<script async type="text/javascript" src="<?=SITE_URL;?>js/jquery.tmpl.min.js"></script>
<script async type="text/javascript" src="<?=SITE_URL;?>js/jquery.elastislide.js"></script>
<script async type="text/javascript" src="<?=SITE_URL;?>js/gallery.js"></script>
<?php
if(!$detect->isMobile() || $detect->isTablet()) {
    ?>
    <script async src="<?= SITE_URL; ?>js/tra.js"></script>

    <script>
        $(document).on('ready', function()
        {
            $('.regular').slick({
                dots: true,
                speed: 550,
                slidesToShow: 4,
                slidesToScroll: 4,
                autoplay: true,
                infinite: true
            });
        });
    </script>

    <?php
}
?>
<div class="popup-main-container-a">
    <div class="popup-tabel-a">
        <div class="popup-row-a">
            <div class="popup-cell-a">
                <div class="popup-container-a change-prop">
                    <div class="popup-content-b Popupscreenshots">
                        <div class="close-container floating-right">
                            <a class="close floating-right"><i></i></a>
                        </div>
                        <script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">
                            <div class="rg-image-wrapper">
                                {{if itemsCount > 1}}
                                    <div class="rg-image-nav">
                                        <a href="#" class="rg-image-nav-prev">Previous Image</a>
                                        <a href="#" class="rg-image-nav-next">Next Image</a>
                                    </div>
                                {{/if}}
                                <div class="rg-image"></div>
                                <div class="rg-loading"></div>
                                <div class="rg-caption-wrapper">
                                    <div class="rg-caption" style="display:none;">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                        </script>
                        <div id="rg-gallery" class="rg-gallery">
                            <div class="rg-thumbs">
                                <div class="es-carousel-wrapper">
                                    <div class="es-carousel">
                                        <ul>
                                            <?php
                                            $path="platform/books/".$row["bookid"]."/screenshoots/";
                                            $thumbs='';
                                            if(is_dir($path)){
                                                $files=scandir($path);
                                                $i=0;
                                                foreach($files as $file){
                                                    if($file!="." && $file!=".."){
                                                        echo '<li><a href="#"><img class="screenschoots-image" data-src="'.SITE_URL.$path.$file.'" data-large="'.SITE_URL.$path.$file.'" alt="image0'.$i.'"/></a></li>';
                                                    }
                                                    $i++;
                                                }
                                            }
                                            ?>
                                        </ul>
                                    </div>
                                    <div class="es-nav">
                                        <span class="es-nav-prev"></span>
                                        <span class="es-nav-next"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="popup-main-container-c">
    <div class="popup-tabel-c">
        <div class="popup-row-c">
            <div class="popup-cell-c">
                <div class="popup-container-c">
                    <div class="popup-content-c">
                        <div class="close-container floating-right">
                            <a class="close floating-right"><i></i></a>
                            <label><?=$title?></label>
                        </div>
                        <div class="items-series-container scrollable">

                            <?php
                            if($row["package"]==1){
                                $sql="SELECT `books`.* FROM `books` WHERE `books`.`booktype`>1 AND `books`.`seriesid`=".$row['seriesid'];
                                $resultseries = $con->query($sql);

                                while ($rowseries = mysqli_fetch_assoc($resultseries)) {
                                    if($row["bookid"]!=$rowseries['bookid']){
                                        echo '<a href="'.SITE_URL.'platform/books/'.$rowseries['bookid'].'/index.html" target="_blank" class="item-series-container floating-left"><img src="'.$bg.'"></a>';

                                    }

                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="inner-pages-main-container-view-item">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="top-header">

                        <h1 class="floating-left"><?=$title;?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <ul class="tabs">
            <div class="center-piece">
                <li class="floating-left active"><?=$Lang->Book;?></li>
                <li class="floating-left"><?=$Lang->Description;?></li>
                <li class="floating-left" id="comment_tab"><?=$Lang->Comments;?></li>
                <li class="floating-left"><?=$Lang->Related;?></li>
            </div>
        </ul>
        <div class="center-content">
            <div class="center-piece">
                <div class="left-container floating-left">
                    <ul class="tab__content">
                        <li class="tab-li active">
                            <div class="content__wrapper first-tab-content">
                                <div class="top-container-a">
                                    <?php
                                    if(!$detect->isMobile() || $detect->isTablet())
                                    {
                                        ?>
                                        <div class="rating-container floating-left">
                                            <span><?= $Lang->Rating; ?></span>
                                            <div class="number floating-right">(<?= $row['rate_count']; ?>)</div>
                                            <div class="stars floating-right">
                                                <form action="">
                                                    <!-- first khalid 5-9-2016 -->
                                                    <input <?= disableRate($row['bookid'], $row, $_GET['type']); ?> rate="5" bookid="<?= $row['bookid'] ?>" <?= calcRate($row['rate'], 5); ?> class="star star-5" id="star-5-<?= $id ?>" prodect="book" type="radio" name="star"/>
                                                    <label class="<?= msglogin(disableRate($row['bookid'], $row, $_GET['type'])); ?>  star star-5" for="star-5-<?= $id ?>"></label>
                                                    <input <?= disableRate($row['bookid'], $row, $_GET['type']); ?> rate="4" bookid="<?= $row['bookid'] ?>" <?= calcRate($row['rate'], 4); ?> class="star star-4" id="star-4-<?= $id ?>" prodect="book" type="radio" name="star"/>
                                                    <label class="<?= msglogin(disableRate($row['bookid'], $row, $_GET['type'])); ?> star star-4" for="star-4-<?= $id ?>"></label>
                                                    <input <?= disableRate($row['bookid'], $row, $_GET['type']); ?> rate="3" bookid="<?= $row['bookid'] ?>" <?= calcRate($row['rate'], 3); ?> class="star star-3" id="star-3-<?= $id ?>" prodect="book" type="radio" name="star"/>
                                                    <label class="<?= msglogin(disableRate($row['bookid'], $row, $_GET['type'])); ?> star star-3" for="star-3-<?= $id ?>"></label>
                                                    <input <?= disableRate($row['bookid'], $row, $_GET['type']); ?>
                                                            rate="2"
                                                            bookid="<?= $row['bookid'] ?>" <?= calcRate($row['rate'], 2); ?>
                                                            class="star star-2" id="star-2-<?= $id ?>" prodect="book"
                                                            type="radio" name="star"/>
                                                    <label class="<?= msglogin(disableRate($row['bookid'], $row, $_GET['type'])); ?> star star-2"
                                                           for="star-2-<?= $id ?>"></label>
                                                    <input <?= disableRate($row['bookid'], $row, $_GET['type']); ?>
                                                            rate="1"
                                                            bookid="<?= $row['bookid'] ?>" <?= calcRate($row['rate'], 1); ?>
                                                            class="star star-1" id="star-1-<?= $id ?>" prodect="book"
                                                            type="radio" name="star"/>
                                                    <label class="<?= msglogin(disableRate($row['bookid'], $row, $_GET['type'])); ?> star star-1"
                                                           for="star-1-<?= $id ?>"></label>
                                                    <!-- end khalid 5-9-2016 -->
                                                </form>
                                            </div>
                                        </div>
                                        <div class="cover-image-container floating-left">
                                            <div id="stage" class="stage animate container">
                                                <ul class="cube bookfaces">
                                                    <li class="bookface_front">
                                                        <img src="<?=$bg;?>">
                                                    </li>
                                                    <li class="bookface_bottom"></li>
                                                    <li class="bookface_top"></li>
                                                    <?php

                                                    if ($row["language"] == "En") {
                                                        ?>
                                                        <li class="bookface_left"
                                                            style="background-color:#<?= $row["color"]; ?>;"></li>
                                                        <li class="bookface_right"></li>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <li class="bookface_left" style="background-color:#fff;"></li>
                                                        <li class="bookface_right"
                                                            style="background-color:#<?= $row["color"]; ?>;"></li>
                                                        <?php
                                                    }
                                                    ?>
                                                    <li class="bookface_back">
                                                        <img src="<?=$bg;?>">
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="view-inner">
                                            <?php
                                            echo PaintBook($row,'StudentBook');
                                            ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="buttons-container">
                                        <div class="left-button floating-left">
                                            <label class="floating-left"><?=$Lang->Share;?></label>
                                            <div class="icons-container floating-left">
                                                <!-- AddToAny BEGIN -->
                                                <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
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
                                                <!-- AddToAny END -->
                                            </div>
                                        </div>
                                        <div class="right-button floating-right">
                                            <?php
                                            $disabled='disabled';
                                            $hrf='';
                                            $viewseries='';
                                            if($row["booktype"]>1)
                                            {
                                                $hrf="href='".SITE_URL.'platform/books/'.$row["bookid"].'/index.html'."'";

                                                $disabled='';
                                                $viewseries='viewseries';

                                            }
                                            ?>
                                            <?php
                                            if($detect->isMobile() && !$detect->isTablet()) {
                                                ?>
                                                <a id="view_buy_now" default-qty="<?=$qty;?>" class="floating-right" data-type="book" data-id="<?= $row["bookid"]; ?>"><?= $Lang->BuyNow; ?></a>
                                                <?php
                                            }




                                            ?>


                                            <?php
                                            if(!$detect->isMobile() || $detect->isTablet())
                                            {
                                                ?>
                                                <a class="without-icon floating-right show_comment "
                                                   title="<?= $Lang->Comment; ?>"><label class="comment"></label></a>
                                                <a class="without-icon floating-right add_favorite <?= isWished($row["bookid"], "book"); ?>"
                                                   data-id="<?= $row["bookid"]; ?>" data-type="book"
                                                   title="<?= $Lang->Addtofavorite; ?>"><label class="fav"></label></a>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if(!$detect->isMobile() || $detect->isTablet()) {
                                    ?>
                                    <div class="bottom-container">
                                        <div class="item-container floating-left">
                                            <div class="icon1 floating-left"></div>
                                            <div class="number floating-left"><?= $row["views"]; ?></div>
                                        </div>
                                        <div class="item-container floating-left">
                                            <div class="icon2 floating-left"></div>
                                            <div class="number floating-left"><?= $row["favorites"]; ?></div>
                                        </div>
                                        <div class="item-container floating-left">
                                            <div class="icon3 floating-left"></div>
                                            <div class="number floating-left"><?= $row["sales"]; ?></div>
                                        </div>
                                        <div class="item-container floating-left">
                                            <div class="icon4 floating-left"></div>
                                            <div class="number floating-left"><?= $row["comments"]; ?></div>
                                        </div>
                                    </div>
                                    <?php
                                }
?>
                        </li>
                        <li class="tab-li">
                            <div class="content__wrapper secound-tab-content">
                                <p><?=$row["description_".$cat_code];?></p>
                                <div class="line-row-desc">
                                    <label class="floating-left"><?=$Lang->Numberofpages;?> : </label>
                                    <span class="floating-left"><?=$row["pages_count"];?></span>
                                </div>
                                <div class="line-row-desc">
                                    <label class="floating-left"><?=$Lang->Binding;?> : </label>
                                    <span class="floating-left"><?=getBinding($row["covertype"]);?></span>
                                </div>
                                <div class="line-row-desc">
                                    <div class="title floating-left"><?=$Lang->ProductDimensions;?></div>
                                </div>
                                <div class="line-row-desc">
                                    <label class="floating-left"><?=$Lang->Height;?> : </label>
                                    <span class="floating-left"><?=$row["awidth"];?> <?=$Lang->Cm;?></span>
                                </div>
                                <div class="line-row-desc">
                                    <label class="floating-left"><?=$Lang->Width;?> : </label>
                                    <span class="floating-left"><?=$row["aheight"];?> <?=$Lang->Cm;?></span>
                                </div>
                                <div class="line-row-desc">
                                    <label class="floating-left"><?=$Lang->Weight;?> : </label>
                                    <span class="floating-left"><?=$row["weight"];?> <?=$Lang->Gm;?></span>
                                </div>
                                <div class="line-row-desc">
                                    <label class="floating-left"><?=$Lang->NoFiling;?> : </label>
                                    <span class="floating-left"><?=$row["filling"];?></span>
                                </div>
                                <div class="line-row-desc">
                                    <label class="floating-left"><?=$Lang->Grade;?> : </label>
                                    <span class="floating-left"><?=getGrade($row["grade"]);?></span>
                                </div>
                                <div class="line-row-desc">
                                    <label class="floating-left"><?=$Lang->Semester;?> : </label>
                                    <span class="floating-left"><?=getSemester($row["semester"]);?></span>
                                </div>
                            </div>
                        </li>
                        <li class="tab-li">
                            <div class="content__wrapper third-tab-content">
                                <div class="write-comment-container">
                                    <?php
                                    if(isset($_SESSION["user"]) && !empty($_SESSION["user"]))
                                    {
                                        ?>
                                        <textarea class="textaria" placeholder="<?=$Lang->writecomment;?>"></textarea>
                                        <a id="addcomment" data-type="book" data-id="<?=$row["bookid"];?>" class="floating-right comment"><?=$Lang->Comment;?></a>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <a class="floating-right comment login-btn btn-popup" data-type="Container"><?=$Lang->SignInToAddComment;?></a>
                                        <?php
                                    }
                                    ?>
                                    <div class="floating-left number-of-comments">
                                        <label class="floating-left"><?=$Lang->Comments;?></label>
                                        <label class="floating-left jq_comments_count">(<?=$row["comments"];?>)</label>
                                    </div>

                                    <div class="post-comment-container scrollable">
                                        <?php

                                        $coment_array=getComments("book",$row["bookid"],1);
                                        echo $coment_array[0];
                                        ?>
                                    </div>

                                    <div class="pagination-container">
                                        <div class="paging">
                                            <div class="content" data-type="book" data-id="<?=$row["bookid"];?>">
                                                <?php
                                                echo $coment_array[1];
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="tab-li">
                            <div class="content__wrapper fourth-tab-content">


                                <?php
                                $dir="platform/books/".$row["bookid"]."/relatedbook/Approvals.pdf";
                                $Approvals="";
                                if (file_exists($dir)) {
                                    $Approvals=SITE_URL.$dir;

                                    if(isset($_SESSION["user"]) && !empty($_SESSION["user"])) {
                                        $class='';
                                        $Cl2='';
                                        $hrefApprovals="href='".$Approvals."'";
                                    }else{
                                        $class='btn-popup';
                                        $Cl2='data-type="Container"';
                                        $hrefApprovals='';
                                    }
                                    echo "<div class='related-row'> <label class='floating-left text-left'>".$Lang->ApprovalsoftheMinistryofEducation."</label><a ".$Cl2."  ".$hrefApprovals." target='_blank' class='download-icon floating-right ".$class."' ><i></i></a> </div> ";
                                }

                                $dir="platform/books/".$row["bookid"]."/relatedbook/Lessonplan.pdf";
                                $Lessonplan="";
                                if (file_exists($dir)) {
                                    $Lessonplan=SITE_URL.$dir;
                                    echo " <div class='related-row'><label class='floating-left text-left'> ".$Lang->StudyPlans."</label><a href='".$Lessonplan."' target='_blank' class='download-icon floating-right' ><i></i></a>  </div>";
                                }
                                ?>


                                <!--<div class="related-row">
                                    <label class="floating-left text-left"><$Lang->Teachersbook;?> </label>
                                    <a class="view-icon floating-right"><i></i></a>
                                </div>-->
                                <!-- <div class="related-row">
                                    <label class="floating-left text-left"><$Lang->Programs;?> </label>
                                     <a class="view-icon floating-right"><i></i></a>
                                </div>-->
                                <!--   <div class="related-row">
                                    <label class="floating-left text-left"><$Lang->CD;?> </label>
                                    <a class="view-icon floating-right"><i></i></a>
                                </div>-->
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="right-container floating-right">
                    <?php
                    if(!$detect->isMobile() || $detect->isTablet()) {
                        ?>
                        <div class="header-right">
                            <div class="display-inline-block"><span class="floating-left">$</span>
                                <?php
                                if ($canRead >= 4) {
                                    $p = calcItemPrice($row, 1);
                                } elseif ($canRead >= 2) {
                                    if ($row["booktype"] >= 4) {
                                        $p = calcItemPrice($row, 5);
                                    } else {
                                        $p = calcItemPrice($row, 1);
                                    }
                                } else {
                                    $p = calcItemPrice($row, $row["booktype"]);
                                }
                                $p=$row["price"];
                                ?>
                                <span class="floating-left" id="total_price"><?= $p; ?></span></div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="content-right">
                        <ul>
                            <li><label class="floating-left"><?=$Lang->Category;?> :</label><span title="<?=$row["name_".$cat_code];?>"><?=$row["name_".$cat_code];?></span>
                            </li>
                            <li><label class="floating-left"><?=$Lang->Author;?>
                                    :</label class="floating-left"><span title="<?=$row["author_".$cat_code];?>"><?=$row["author_".$cat_code];?></span></li>
                            <li><label class="floating-left"><?=$Lang->PublishYear;?>
                                    :</label class="floating-left"><span title="<?=$row["year"];?>"><?=$row["year"];?></span></li>
                            <li><label class="floating-left"><?=$Lang->Language;?>
                                    <?php
                                    if($row["language"]=="Ar"){
                                        $language=$Lang->Arabic;
                                    }elseif($row["language"]=="En"){
                                        $language=$Lang->English;
                                    }elseif($row["language"]=="Fr"){
                                        $language=$Lang->France;
                                    }
                                    ?>
                                    :</label class="floating-left"><span title="<?=$language;?>"><?=$language;?></span></li>
                            <li><label class="floating-left"><?=$Lang->Age;?> :</label><span title="<?=getProductAge($row["age"]);?>"><?=getProductAge($row["age"]);?> <?=$Lang->Year;?></span>
                            </li>
                        </ul>
                        <div class="quantity">
                            <input type="checkbox" style="display: none" id="typeBook" checked price="<?=$row["price"];?>">
                            <label class="floating-left"><?=$Lang->Quantity;?></label>
                            <input class="floating-left" id="book_quantity" type="number" default-val="<?=$qty;?>" value="<?=$qty;?>">
                            <span class="floating-left one">x</span>
                            <div class="floating-left">
                                <span class="floating-left tow">$</span><span class="floating-left tow" id="grand_price"><?= $row["price"]*$qty;?></span>
                            </div>
                        </div>
                        <div class="ispn-content">
                            <label class="image"><?=$Lang->ISBNNo;?></label>
                            <label class="text"><?=$row["isbn"];?></label>
                        </div>
                        <?php
                        if(!$detect->isMobile() || $detect->isTablet()) {
                            ?>
                            <div class="buttons-container">

                                <a id="view_buy_now" default-qty="<?=$qty;?>" data-type="book"
                                   data-id="<?= $row["bookid"]; ?>"><?= $Lang->BuyNow; ?></a>
                                <?php
                                if (inCart("book", $row["bookid"])) {
                                    ?>
                                    <a id="add_to_cart" data-type="book"
                                       data-id="<?= $row["bookid"]; ?>"><?= $Lang->RemoveFromCart; ?></a>
                                    <?php
                                } else {
                                    ?>
                                    <a id="add_to_cart" data-type="book"
                                       data-id="<?= $row["bookid"]; ?>"><?= $Lang->AddCart; ?></a>
                                    <?php
                                }
                                ?>

                            </div>
                            <?php
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
        <?php
        if(!$detect->isMobile() || $detect->isTablet()) {
            ?>
            <div class="related-title-container">
                <div class="center-piece">
                    <div class="floating-left title"><?=$Lang->RelatedProduct;?></div>
                </div>
            </div>
            <div class="related-content-container">
                <div class="center-piece">
                    <section class="regular slider frame" id="slider">
                        <?php
                        getRelatedProduct($row,"storebook");
                        ?>
<!--                        <article class="item tsc_ribbon_wrap slick-slide slick-current slick-active" style="left: 0px; width: 293px;" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide00"><div class="inset">-->
<!--                                <div class="inner-items">-->
<!--                                    <a href="http://localhost/Manhal/en/games/1116/Cards Game - Picture and Letter" tabindex="0"></a>-->
<!--                                    <div class="games-item">-->
<!--                                        <a href="http://localhost/Manhal/en/games/1116/Cards Game - Picture and Letter" tabindex="0">-->
<!--                                            <div class="game-thumb" style="background-image: url(https://www.manhal.com/platform/media/6450/thumbnail_small.jpg)"></div>-->
<!--                                            <div class="game-title">-->
<!--                                                <label>Cards Game - Picture and Letter</label>-->
<!--                                            </div>-->
<!--                                        </a>-->
<!--                                        <div class="display-block secound-container">-->
<!--                                            <a href="http://localhost/Manhal/en/games/1116/Cards Game - Picture and Letter" tabindex="0"></a>-->
<!--                                            <div class="title-sub-container clear-both floating-left">-->
<!--                                                <a href="http://localhost/Manhal/en/games/1116/Cards Game - Picture and Letter" tabindex="0"></a>-->
<!--                                                <div class="floating-left display-inline-block"><a href="http://localhost/Manhal/en/games/1116/Cards Game - Picture and Letter" tabindex="0"></a>-->
<!--                                                    <a class="text-left type" tabindex="0">Games</a>-->
<!--                                                </div>-->
<!--                                                <div class="price floating-left">-->
<!--                                                    <div class="display-inline-block">-->
<!--                                                        <span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="English">English</span>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                </div>-->
<!--                        </article>-->
<!--                        <article class="item tsc_ribbon_wrap slick-slide slick-current books-class" style="left: 0px; width: 293px;" data-slick-index="0" aria-hidden="false" tabindex="-1" role="option" aria-describedby="slick-slide00"><div class="inset">-->
<!--                                <div class="inner-items">-->
<!--                                    <a href="http://localhost/Manhal/en/games/1116/Cards Game - Picture and Letter" tabindex="0"></a>-->
<!--                                    <div class="games-item">-->
<!--                                        <a href="http://localhost/Manhal/en/games/1116/Cards Game - Picture and Letter" tabindex="0">-->
<!--                                            <div class="game-thumb" style="background-image: url(https://www.manhal.com/platform/books/97/cover.jpg)"></div>-->
<!--                                            <div class="game-title">-->
<!--                                                <label>Cards Game - Picture and Letter</label>-->
<!--                                            </div>-->
<!--                                        </a>-->
<!--                                        <div class="display-block secound-container">-->
<!--                                            <a href="http://localhost/Manhal/en/games/1116/Cards Game - Picture and Letter" tabindex="0"></a>-->
<!--                                            <div class="title-sub-container clear-both floating-left">-->
<!--                                                <a href="http://localhost/Manhal/en/games/1116/Cards Game - Picture and Letter" tabindex="0"></a>-->
<!--                                                <div class="floating-left display-inline-block"><a href="http://localhost/Manhal/en/games/1116/Cards Game - Picture and Letter" tabindex="0"></a>-->
<!--                                                    <a class="text-left type" tabindex="0">Games</a>-->
<!--                                                </div>-->
<!--                                                <div class="price floating-left">-->
<!--                                                    <div class="display-inline-block">-->
<!--                                                        <span class="floating-left text-left cat">/</span><span class="floating-left text-left cat" title="English">English</span>-->
<!--                                                    </div>-->
<!--                                                </div>-->
<!--                                            </div>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!---->
<!--                                </div>-->
<!--                        </article>-->
                    </section>
                </div>
            </div>
            <?php
        }
        ?>
</section>
<?php


?>
<script type="text/javascript">
    $(document).ready(function () {
        $(".input_price").change(function () {
            if($(this).attr("id")=="typeBook" && $(this).prop("checked")==false && $("#typeInteractive").prop("checked")==false){
                $("#typeInteractive").click();
                //calcbookPrice();
            }else if($(this).attr("id")=="typeInteractive" && $(this).prop("checked")==false && $("#typeBook").prop("checked")==false){
                $("#typeBook").click();
                //calcbookPrice();
            }else{
                calcbookPrice();
            }
        });
    });

</script>












































