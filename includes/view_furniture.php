<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 25/8/2016
 * Time: 1:11 PM
 */
include("includes/header.php");
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
  "image": "<?=SITE_URL.'platform/books/'.$row['bookid'].'/cover.jpg';?>",
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

<?php
if($detect->isMobile() || $detect->isTablet())
{
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
<section class="inner-pages-main-container-view-item">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="top-header">
                        <?php
                        if($row["language"]=="En"){
                            $title=$row["name"]." book";
                        }else{
                            $title="كتاب ".$row["name"];
                        }
                        ?>
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
                                        <div class="cover-image-container floating-left" style="padding: 6px;">
                                            <div class="inner" style="background-image:url(https://www.manhal.com/platform/media/186/thumbnail.jpg); background-size: contain;background-position: center ;width: 100%;height: 100% ;display: block;overflow: hidden;"></div>
                                        </div>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <div class="view-inner">
                                        <?php
                                        echo PaintBook($row);
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
                                            if($row["booktype"]>1)
                                            {
                                                $hrf="href='".SITE_URL.'platform/books/'.$row["bookid"].'/index.html'."'";
                                                $disabled='';
                                            }
                                            ?>
                                            <?php
                                            if($detect->isMobile() && !$detect->isTablet()) {
                                            ?>
                                                <?php
                                            }
                                            ?>
                                            <a data-type="Containersscreenshots" class="with-icon floating-right btn-popup-a"   id="show_screenshots" bookid="<?=$row['bookid'];?>" data-type="book"><label class="screenshot"><?=$Lang->ScreenShots;?></label></a>
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
                            </div>
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

                                ?>
                                <span class="floating-left" id="total_price">100</span></div>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="content-right">
                        <ul>
                            <li><label class="floating-left"><?=$Lang->Category;?> :</label><span title="Category">Category</span> </li>
                            <li><label class="floating-left"><?=$Lang->company;?> :</label class="floating-left"><span title="Company">Company</span></li>
                            <li><label class="floating-left"><?=$Lang->Age;?> :</label><span title="<?=getProductAge($row["age"]);?>"><?=getProductAge($row["age"]);?> <?=$Lang->Year;?></span> </li>
                            <li><label class="floating-left"><?=$Lang->Color;?> :</label class="floating-left"><span title="Color">Color</span></li>
                            <li><label class="floating-left"><?=$Lang->Ref;?> :</label class="floating-left"><span title="Ref">Ref</span></li>
                            <li><label class="floating-left"><?=$Lang->size;?> :</label class="floating-left"><span title="size">size</span></li>
                        </ul>
                        </div>
                    <?php
                    if(!$detect->isMobile() || $detect->isTablet()) {
                        ?>
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
                        getRelatedProduct($row,"book");
                        ?>
                </section>
            </div>
        </div>
        <?php
        }
        ?>
</section>
<?php
?>













































