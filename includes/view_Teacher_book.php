<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 25/8/2016
 * Time: 1:11 PM
 */


$sql="UPDATE `books` SET `views`=`views`+1 WHERE `bookid`=".$_GET['id'];
$con->query($sql);

$sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status`=1 AND `books`.`isteacherbook`=1 AND `books`.`bookid` =".$_GET['id'];
$result = $con->query($sql);
$row=mysqli_fetch_assoc($result);



$id=uniqid(rand(10000,99999), true);
$canRead=getReadingOption("book",$_GET['id']);


include("includes/header.php");
?>
    <script  src="<?=SITE_URL;?>js/jquery.ui.touch-punch.min.js<?=$cash;?>" type="text/javascript"></script>
    <script  src="<?=SITE_URL;?>js/allinone_carousel.js" type="text/javascript"></script>
<?php
if (!$detect->isMobile() || $detect->isTablet())
{
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
<script src="<?=SITE_URL;?>js/js.js"></script>
    <?php
}
?>
    <script type="text/javascript" src="<?=SITE_URL;?>js/jquery.tmpl.min.js"></script>
    <script type="text/javascript" src="<?=SITE_URL;?>js/jquery.elastislide.js"></script>
<script type="text/javascript" src="<?=SITE_URL;?>js/gallery.js"></script>
<?php
if(!$detect->isMobile() || $detect->isTablet())
{
    ?>
    <script src="<?=SITE_URL;?>js/tra.js"></script>
<script>
    $(document).on('ready', function()
    {
        $(".screenshot").click(function () {
            $(".popup-content-c").fadeIn();
        });
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
                    <div class="popup-content-c Popupscreenshots">
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
    <div class="popup-main-container-b" style="display: none;">
        <div class="popup-tabel-b">
            <div class="popup-row-b">
                <div class="popup-cell-b">
                    <div class="popup-container-b">
                        <div class="popup-content fadeInDownBig animated1">
                            <div class="activate-container">
                                <div class="close-container">
                                    <a class="close floating-right jq_close_download"><i></i></a>
                                </div>
                                <div class="main-title"><?=$Lang->Activatecode;?></div>
                                <p><?=$Lang->Activatecodeis;?></p>
                                <div class="input-row"><input type="text" placeholder="code" id="activation_code"></div>
                                <input type="submit" value="<?=$Lang->Download;?>" class="activ-code clear-both jq_downloadteacherbook" data-id="<?=$row["bookid"];?>">
                                <div class="line-div"></div>
                                <label><?=$Lang->Noactivation?></label>
                                <p><?=$Lang->ifyounothave?></p>
                                <input type="submit" value="Purchase" class="activ-code clear-both" id="view_buy_now1">
                                <div class="footer-container"></div>
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
                        <h1 class="floating-left"><?=$row["name"];?></h1>
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
                <li class="floating-left"><?=$Lang->Related?></li>
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
                                        <span><?=$Lang->Rating;?></span>
                                        <div class="number floating-right">(<?=$row['rate_count'];?>)</div>
                                        <div class="stars floating-right">
                                            <form action="">
                                                <!-- first khalid 5-9-2016 -->
                                                <input <?=disableRate($row['bookid'],$row,$_GET['type']);?> rate="5" bookid="<?=$row['bookid']?>" <?=calcRate($row['rate'],5);?> class="star star-5" id="star-5-<?=$id?>" prodect="book" type="radio" name="star"/>
                                                <label class="<?=msglogin(disableRate($row['bookid'],$row,$_GET['type']));?>  star star-5" for="star-5-<?=$id?>"></label>
                                                <input <?=disableRate($row['bookid'],$row,$_GET['type']);?> rate="4" bookid="<?=$row['bookid']?>" <?=calcRate($row['rate'],4);?> class="star star-4" id="star-4-<?=$id?>"  prodect="book" type="radio" name="star"/>
                                                <label class="<?=msglogin(disableRate($row['bookid'],$row,$_GET['type']));?> star star-4" for="star-4-<?=$id?>"></label>
                                                <input <?=disableRate($row['bookid'],$row,$_GET['type']);?>  rate="3" bookid="<?=$row['bookid']?>" <?=calcRate($row['rate'],3);?> class="star star-3" id="star-3-<?=$id?>"  prodect="book" type="radio" name="star"/>
                                                <label class="<?=msglogin(disableRate($row['bookid'],$row,$_GET['type']));?> star star-3" for="star-3-<?=$id?>"></label>
                                                <input <?=disableRate($row['bookid'],$row,$_GET['type']);?> rate="2" bookid="<?=$row['bookid']?>" <?=calcRate($row['rate'],2);?> class="star star-2" id="star-2-<?=$id?>"  prodect="book" type="radio" name="star"/>
                                                <label class="<?=msglogin(disableRate($row['bookid'],$row,$_GET['type']));?> star star-2" for="star-2-<?=$id?>"></label>
                                                <input <?=disableRate($row['bookid'],$row,$_GET['type']);?> rate="1" bookid="<?=$row['bookid']?>" <?=calcRate($row[  'rate'],1);?> class="star star-1" id="star-1-<?=$id?>"  prodect="book" type="radio" name="star"/>
                                                <label class="<?=msglogin(disableRate($row['bookid'],$row,$_GET['type']));?> star star-1" for="star-1-<?=$id?>"></label>
                                                <!-- end khalid 5-9-2016 -->
                                            </form>
                                        </div>
                                    </div>
                                    <div class="cover-image-container floating-left">
                                        <div class="ribbon3">
                                            <label><?=$Lang->ElectronicBooks;?></label>
                                        </div>
                                        <div id="stage" class="stage animate container">
                                            <ul class="cube bookfaces">
                                                <li class="bookface_front">
                                                    <img src="<?=SITE_URL;?>platform/books/<?=$row["bookid"];?>/cover.jpg">
                                                </li>
                                                <li class="bookface_bottom"></li>
                                                <li class="bookface_top"></li>
                                                <?php

                                                if($row["language"]=="En"){
?>
                                                    <li class="bookface_left" style="background-color:#<?=$row["color"];?>;"></li>
                                                    <li class="bookface_right"></li>
                                                <?php
                                                }else{
                                                 ?>
                                                    <li class="bookface_left" style="background-color:#fff;"></li>
                                                    <li class="bookface_right" style="background-color:#<?=$row["color"];?>;"></li>
                                                <?php
                                                }
                                                ?>
                                                <li class="bookface_back">
                                                    <img src="<?=SITE_URL;?>platform/books/<?=$row["bookid"];?>/back.jpg">
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
                                            if($row["booktype"]>1){
                                                $hrf="href='".SITE_URL.'platform/books/'.$row["bookid"].'/index.html'."'";
                                                $disabled='';
                                            }


                                            $sql="SELECT `payments`.*,`payments_books`.* FROM `payments` INNER JOIN `payments_books` ON `payments`.`paymentid`=`payments_books`.`paymentid` WHERE `payments_books`.`itemtype`='book' AND  `payments_books`.`bookid`=".$row["bookid"]." AND `payments`.`userid`=".$_SESSION["user"]["userid"];
                                            $result=$con->query($sql);
                                            if(mysqli_num_rows($result)>1){
                                                $_SESSION["allow_download"]["book"]=$row["bookid"];
                                            }else{
                                                $sql="SELECT `codes_user`.*,`apps_codes`.* FROM `apps_codes` INNER JOIN `codes_user` ON `apps_codes`.`codeid`=`codes_user`.`codeid` WHERE `apps_codes`.`type`='teacherbook' AND `apps_codes`.`refid`=".$row["bookid"]." AND startdate < CURDATE() AND  enddate>CURDATE() AND `codes_user`.`userid`=".$_SESSION["user"]["userid"];
                                                $result=$con->query($sql);
                                                if(mysqli_num_rows($result)>0){
                                                    $_SESSION["allow_download"]["book"]=$row["bookid"];
                                                }
                                            }


                                            if(isset($_SESSION["allow_download"]["book"]) && $_SESSION["allow_download"]["book"]==$row["bookid"]){
                                                ?>

                                                <?php
                                                if($detect->isMobile() && !$detect->isTablet()) {
                                                    ?>
                                                    <a id="view_buy_now" class="floating-right" data-type="book" data-id="<?=$row["bookid"];?>"><?=$Lang->BuyNow;?></a>
                                                    <?php
                                                }
                                                ?>

                                                <a class="with-icon floating-right" href="<?=SITE_URL.$lang_code."/download?downloadtype=teacherbook&bookid=".$row["bookid"]."&type=pdf";?>"><label class="Download"><?=$Lang->DownloadPDF;?></label></a>
                                                <a class="with-icon floating-right" href="<?=SITE_URL.$lang_code."/download?downloadtype=teacherbook&bookid=".$row["bookid"]."&type=exe";?>"><label class="Download"><?=$Lang->DownloadEXE;?></label></a>
                                            <?php
                                            }else{
                                                ?>
                                            <?php
                                            if(!$detect->isMobile() || $detect->isTablet())
                                            {
                                                ?>
                                                <a class="with-icon floating-right" id="download_teacher_bookpdf"><label class="Download"><?=$Lang->DownloadPDF;?></label></a>
                                                <a class="with-icon floating-right" id="download_teacher_bookexe"><label class="Download"><?=$Lang->DownloadEXE;?></label></a>
                                                <?php
                                            }
                                                ?>
                                            <?php
                                            }
                                            ?>


                                            <a data-type="Containersscreenshots" class="with-icon floating-right btn-popup-a"   id="show_screenshots" bookid="<?=$row['bookid'];?>" data-type="book"><label class="screenshot"><?=$Lang->ScreenShots;?></label></a>
                                            <?php
                                            if(!$detect->isMobile() || $detect->isTablet())
                                            {
                                            ?>
                                            <a class="without-icon floating-right show_comment "  title="<?=$Lang->Comment;?>"><label class="comment"></label></a>
                                            <a class="without-icon floating-right add_favorite <?=isWished($row["bookid"],"book");?>"  data-id="<?=$row["bookid"];?>" data-type="book" title="<?=$Lang->Addtofavorite;?>"><label class="fav"></label></a>
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
                                        <div class="number floating-left"><?=$row["views"];?></div>
                                    </div>
                                    <div class="item-container floating-left">
                                        <div class="icon2 floating-left"></div>
                                        <div class="number floating-left"><?=$row["favorites"];?></div>
                                    </div>
                                    <div class="item-container floating-left">
                                        <div class="icon3 floating-left"></div>
                                        <div class="number floating-left"><?=$row["sales"];?></div>
                                    </div>
                                    <div class="item-container floating-left">
                                        <div class="icon4 floating-left"></div>
                                        <div class="number floating-left"><?=$row["comments"];?></div>
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
                        <li class="tab-li">
                            <div class="content__wrapper fourth-tab-content">
                               <div class="related-row disable">
                                   <label class="floating-left text-left">
                                       <?=$Lang->ApprovalsoftheMinistryofEducation;?>
                                   </label>
                                   <a class="download-icon floating-right"><i></i></a>
                               </div>
                                <div class="related-row disable">
                                    <label class="floating-left text-left">
                                        <?=$Lang->StudysPlans;?>
                                    </label>
                                    <a class="download-icon floating-right"><i></i></a>
                                </div>
                                <div class="related-row disable">
                                    <label class="floating-left text-left">
                                        <?=$Lang->StudentsBook;?>
                                    </label>
                                    <a class="view-icon floating-right"><i></i></a>
                                </div>
                                <div class="related-row disable">
                                    <label class="floating-left text-left">
                                        <?=$Lang->Programs;?>

                                    </label>
                                    <a class="view-icon floating-right"><i></i></a>
                                </div>
                                <div class="related-row disable">
                                    <label class="floating-left text-left">
                                        <?=$Lang->CD;?>
                                    </label>
                                    <a class="view-icon floating-right"><i></i></a>
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
                            if($canRead>=4){
                                $p=calcItemPrice($row,1);
                            }elseif($canRead>=2){
                                if($row["booktype"]>=4){
                                    $p=calcItemPrice($row,5);
                                }else{
                                    $p=calcItemPrice($row,1);
                                }
                            }else{
                                $p=calcItemPrice($row,$row["booktype"]);
                            }

                            ?>
                            <span class="floating-left" id="total_price"><?=$p;?></span></div>
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
                        <div class="main-container-table-type">
                            <div class="display-table">
                                <div class="display-row <?php if(!isPaperCopy($row["booktype"])){echo 'disabled';}?>">
                                    <div class="display-cell">
                                        <div class="availablety-book">
                                            <label class="<?php if(isPaperCopy($row["booktype"])){echo 'true';}else{ echo 'false';}?>"></label>
                                        </div>
                                    </div>
                                    <div class="display-cell">
                                        <div class="type-container">
                                            <label for="typeBook" class="icon book floating-left"></label>
                                            <label for="typeBook" class="text floating-left"><?=$Lang->CDcopy;?></label>
                                        </div>
                                    </div>
                                    <div class="display-cell">
                                        <label class="price">
                                            <span class="floating-left">$</span>
                                            <span class="floating-left"><?=$row["price"];?></span>
                                        </label>
                                    </div>
                                    <div class="display-cell">
                                        <div class="section-check-row">
                                            <label class="input-control checkbox floating-left">
                                                <input  type="checkbox" name="enrichment" class="input_price"  price="<?=$row["price"];?>" id="typeBook" value="4" <?php if(isPaperCopy($row["booktype"])){echo 'checked="checked"';}else{ echo 'disabled';}?>><span class="check"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="display-row <?php if(!isElectronicCopy($row["booktype"])){echo 'disabled';}?>">
                                    <div class="display-cell">
                                        <div class="availablety-book">
                                            <label class="<?php if(isElectronicCopy($row["booktype"])){echo 'true';}else{ echo 'false';}?>"></label>
                                        </div>
                                    </div>
                                    <div class="display-cell">
                                        <div class="type-container">
                                            <label for="typeEBook" class="icon e-book floating-left"></label>
                                            <label for="typeEBook" class="text floating-left"><?=$Lang->ElectronicCopy;?></label>
                                        </div>
                                    </div>
                                    <?php
                                    if($canRead>=2){
                                        ?>
                                        <div class="display-cell">
                                            <a <?=$hrf;?> class="view"><?=$Lang->View;?></a>
                                        </div>
                                    <?php
                                    }else{
?>
                                        <div class="display-cell">
                                            <label class="price">
                                                <span class="floating-left">$</span>
                                                <span class="floating-left"><?=$row["eprice"];?></span>
                                            </label>
                                        </div>
                                        <div class="display-cell">
                                            <div class="section-check-row">
                                                <label class="input-control checkbox floating-left">
                                                    <input  type="checkbox" name="enrichment"  class="input_price" price="<?=$row["eprice"];?>" <?php if(isElectronicCopy($row["booktype"])){echo 'checked="checked"';}else{ echo 'disabled';}?> id="typeEBook" value="4"><span class="check"></span>
                                                </label>
                                            </div>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                </div>
                                <div class="display-row <?php if(!isInteractiveCopy($row["booktype"])){echo 'disabled';}?> "">
                                    <div class="display-cell">
                                        <div class="availablety-book">
                                            <label class="<?php if(isInteractiveCopy($row["booktype"])){echo 'true';}else{ echo 'false';}?>"></label>
                                        </div>
                                    </div>
                                    <div class="display-cell">
                                        <div class="type-container">
                                            <label for="typeInteractive" class="icon interactive floating-left"></label>
                                            <label for="typeInteractive" class="text floating-left"><?=$Lang->InteractiveCopy;?></label>
                                        </div>
                                    </div>
                                <?php
                                if($canRead>=4){
                                    ?>
                                    <div class="display-cell">
                                        <a <?=$hrf;?> class="view"><?=$Lang->View;?></a>
                                    </div>
                                    <?php
                                }else {
                                    ?>
                                    <div class="display-cell">
                                        <label class="price">
                                            <span class="floating-left">$</span>
                                            <span class="floating-left"><?= $row["iprice"]; ?></span>
                                        </label>
                                    </div>
                                    <div class="display-cell">
                                        <div class="section-check-row">
                                            <label class="input-control checkbox floating-left">
                                                <input type="checkbox" name="enrichment" id="typeInteractive"
                                                       class="input_price" price="<?= $row["iprice"]; ?>"
                                                       value="4" <?php if (isInteractiveCopy($row["booktype"])) {
                                                    echo 'checked="checked"';
                                                } else {
                                                    echo 'disabled';
                                                } ?>><span class="check"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                </div>
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
                                <a id="view_buy_now" data-type="book" data-id="<?=$row["bookid"];?>"><?=$Lang->BuyNow;?></a>
                            <?php
                            if(inCart("book",$row["bookid"])) {
?>
                                <a id="add_to_cart" data-type="book" data-id="<?=$row["bookid"];?>"><?=$Lang->RemoveFromCart;?></a>
                                <?php
                            }else{
                                ?>
                                <a id="add_to_cart" data-type="book" data-id="<?=$row["bookid"];?>"><?=$Lang->AddCart;?></a>
                                <?php
                            }
                            ?>

                        </div>
                        <?php
                    }
                    ?>
                    </div>
                <div class="approval-container">
                    <div class="approval-icon floating-left">
                        <i></i>
                    </div>
                    <div class="approval-lbl floating-left">
                        <label class="text-left">
                            <?=$Lang->ApprovalsoftheMinistryofEducation;?>
                        </label>
                    </div>
                    <a class="download-icon floating-right"><i></i></a>
                </div>
                <div class="approval-container">
                    <div class="plan-icon floating-left"><i></i></div>
                    <div class="approval-lbl floating-left">
                        <label class="text-left">
                            <?=$Lang->StudysPlans;?>
                        </label>
                    </div>
                    <a class="download-icon floating-right"><i></i></a>
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