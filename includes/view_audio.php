<?php




$sql="UPDATE `media` SET `views`=`views`+1 WHERE id=".$_GET['id'];
$con->query($sql);
$sql="Select media.*, categories.name_ar, categories.name_en From media Inner Join categories On media.category = categories.catid   where   media.type=3 and  media.status=1 and media.id=".$_GET['id'];
$result = $con->query($sql);
$row=mysqli_fetch_assoc($result);
$id=uniqid(rand(10000,99999), true);
include("includes/header.php");
?>
    <script  src="<?=SITE_URL;?>js/jquery.ui.touch-punch.min.js<?=$cash;?>" type="text/javascript"></script>
<?php
if(!$detect->isMobile() || $detect->isTablet()) {
    ?>
    <script src="<?= SITE_URL; ?>js/allinone_carousel.js" type="text/javascript"></script>
    <script src='<?= SITE_URL; ?>js/slick.js<?= $cash; ?>'></script>
    <?php
}
    ?>
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/view.css<?=$cash;?>">
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/worksheet.css<?=$cash;?>">

<?php
if($detect->isMobile() || $detect->isTablet())
{
    ?>
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/proview.css<?=$cash;?>">
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/proworksheet.css<?=$cash;?>">
    <?php
}
?>
<style>.plyr {
        height: auto !important;
        bottom: 0;
    }</style>
<?php
if(!$detect->isMobile() || $detect->isTablet()) {
    ?>
    <link rel="stylesheet" type="text/css"
          href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/slick.css<?= $cash; ?>">
    <link rel="stylesheet" type="text/css"
          href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/slick-theme.css<?= $cash; ?>">
    <script src="<?= SITE_URL; ?>js/js.js"></script>
    <script src="<?= SITE_URL; ?>js/tra.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('audio').bind('contextmenu', function () {
                return false;
            });
            $('.regular').slick({
                dots: true,
                speed: 550,
                slidesToShow: 4,
                slidesToScroll: 4,
                autoplay: true,
                infinite: true
            });
            $(".regular1").slick({
                dots: true,
                infinite: false,
                slidesToShow: 4,
                slidesToScroll: 4
            });
        });
    </script>
    <?php
}
    ?>
    <section class="inner-pages-main-container-view-item">
        <?=$breadCrumbs;?>
        <div class="center-piece">
            <div class="display-table">
                <div class="display-row">
                    <div class="display-cell">
                        <div class="top-header">
                            <h1 class="floating-left"><?=$row["title_".$cat_code];?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wrapper">
            <ul class="tabs">
                <div class="center-piece">
                    <li class="floating-left active"><?=$Lang->Sound;?></li>
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
                                        <div class="rating-container floating-left">
                                            <span><?=$Lang->Rating;?></span>
                                            <div class="number floating-right">(<?=$row['rating_count'];?>)</div>
                                            <div class="stars floating-right">
                                                <form action="">
                                                    <!-- first khalid 5-9-2016 -->
                                                    <input <?=disableRate($row['id'],$row,'audio');?> rate="5" bookid="<?=$row['id']?>" <?=calcRate($row['rate'],5);?> class="star star-5" id="star-5-<?=$id?>" prodect="audio" type="radio" name="star" />
                                                    <label class="<?=msglogin(disableRate($row['id'],$row,'audio'));?>  star star-5" for="star-5-<?=$id?>"></label>
                                                    <input <?=disableRate($row['id'],$row,'audio');?> rate="4" bookid="<?=$row['id']?>" <?=calcRate($row['rate'],4);?> class="star star-4" id="star-4-<?=$id?>"  prodect="audio" type="radio" name="star" />
                                                    <label class="<?=msglogin(disableRate($row['id'],$row,'audio'));?> star star-4" for="star-4-<?=$id?>"></label>
                                                    <input <?=disableRate($row['id'],$row,'audio');?>  rate="3" bookid="<?=$row['id']?>" <?=calcRate($row['rate'],3);?> class="star star-3" id="star-3-<?=$id?>"  prodect="audio" type="radio" name="star" />
                                                    <label class="<?=msglogin(disableRate($row['id'],$row,'audio'));?> star star-3" for="star-3-<?=$id?>"></label>
                                                    <input <?=disableRate($row['id'],$row,'audio');?> rate="2" bookid="<?=$row['id']?>" <?=calcRate($row['rate'],2);?> class="star star-2" id="star-2-<?=$id?>"  prodect="audio" type="radio" name="star" />
                                                    <label class="<?=msglogin(disableRate($row['id'],$row,'audio'));?> star star-2" for="star-2-<?=$id?>"></label>
                                                    <input <?=disableRate($row['id'],$row,'audio');?> rate="1" bookid="<?=$row['id']?>" <?=calcRate($row[  'rate'],1);?> class="star star-1" id="star-1-<?=$id?>"  prodect="audio" type="radio" name="star" />
                                                    <label class="<?=msglogin(disableRate($row['id'],$row,'audio'));?> star star-1" for="star-1-<?=$id?>"></label>
                                                    <!-- end khalid 5-9-2016 -->
                                                </form>
                                            </div>
                                        </div>
                                        <?php
                                        $hrf="";
                                       $style='display:none';
                                        $subscr='onclick="window.location='."'".SITE_URL.strtolower($session_lang).'/subscribe'."'".'"';
                                        if(($row['price']==0 || Areyousubscribe()==1) && $row['is_playlist']==0){
                                            $hrf=SITE_URL . 'platform/media/' . $row['id'] . '/'.$row['filename'].".mp3?".rand();
                                            $sql="UPDATE `media` SET `download`=`download`+1 WHERE id=".$_GET['id'];
                                            $con->query($sql);
                                            $style='';
                                            $subscr='';
                                        }
                                        ?>
                                        <div class="cover-image-container floating-left">
                                            <div class="media-view-demo">
                                                <div  class="inner-media-view-demo audio">
                                                    <div <?=$subscr?>  class="media-thumb-view" style="background-image: url(<?php echo SITE_URL . 'platform/media/' . $row['id'] . '/thumbnail.jpg' ;?>)" ></div>
                                                    <script type="text/javascript" src="<?=SITE_URL?>viedoplayer/dist/plyr.js"></script>
                                                    <link rel="stylesheet" href="<?=SITE_URL?>viedoplayer/dist/plyr.css">
                                                    <audio id="manhal_video" poster="<?=SITE_URL . 'platform/media/' . $row['id'] . '/thumbnail.jpg'?>" crossorigin="" class="plyr--setup">
                                                        <source src="<?=$hrf?>" type="audio/mp3">
                                                    </audio>
                                                    <script>
                                                        $(document).ready(function(){
                                                            player = new Plyr('#manhal_video');
                                                        });

                                                    </script>
                                                </div>
                                            </div>
                                            <a class="play-media"></a>
                                        </div>

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

                                                <a class="without-icon floating-right show_comment "  title="<?=$Lang->Comment;?>"><label class="comment"></label></a>
                                                <a class="without-icon floating-right add_favorite <?=isWished($row["id"],"audio");?>"  data-id="<?=$row["id"];?>" data-type="audio" title="<?=$Lang->Addtofavorite;?>"><label class="fav"></label></a>
                                                <?php
                                                if($row["is_playlist"]==1){
                                                    if(Areyousubscribe()){
                                                        $playlist_link =SITE_URL.$lang_code.'/playlist/'.$row['id'].'/'.str_replace(" ","-",$row['title_'.$cat_code]);
                                                        ?>
                                                        <a class="jq_viewplaylist viewplaylist-icon without-icon" data-href="<?=$playlist_link;?>" title="<?=$Lang->PlayList;?>"></a>
                                                        <?php
                                                    }else{
                                                        $playlist_link =SITE_URL.$lang_code.'/subscribe';
                                                        ?>
                                                        <a class=" viewplaylist-icon without-icon" href="<?=$playlist_link;?>" title="<?=$Lang->PlayList;?>"></a>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </li>
                            <li class="tab-li">
                                <div class="content__wrapper secound-tab-content">
                                    <p><?=$row["description_".$cat_code];?></p>

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
                                            <a id="addcomment" data-type="audio" data-id="<?=$row["id"];?>" class="floating-right comment"><?=$Lang->Comment;?></a>
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

                                            $coment_array=getComments("audio",$row["id"],1);
                                            echo $coment_array[0];
                                            ?>
                                        </div>

                                        <div class="pagination-container">
                                            <div class="paging">
                                                <div class="content" data-type="audio" data-id="<?=$row["id"];?>">
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
                                <div class="display-inline-block">
                                    <?=$Lang->Sound;?>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="content-right">
                            <ul>
                                <li>
                                    <label class="floating-left"><?=$Lang->Category;?> :</label><span title="<?=$row["name_".$cat_code];?>"><?=$row["name_".$cat_code];?></span>
                                </li>
                                <li>
                                    <label class="floating-left"><?=$Lang->Age;?> :</label><span title="<?=getProductAge($row["age"]);?>"><?=getProductAge($row["age"]);?> <?=$Lang->Year;?></span>
                                </li>
                                <li>
                                    <label class="floating-left"><?=$Lang->Language;?>
                                        <?php
                                        if($row["language"]=="Ar"){
                                            $language=$Lang->Arabic;
                                        }elseif($row["language"]=="En"){
                                            $language=$Lang->English;
                                        }elseif($row["language"]=="Fr"){
                                            $language=$Lang->France;
                                        }
                                        ?>
                                        :</label class="floating-left"><span title="<?=$language;?>"><?=$language;?></span>
                                </li>

                            </ul>
                            <?php
                            if(!$detect->isMobile() || $detect->isTablet()) {
                                ?>
                                <div class="bottom-container">
                                    <div class="item-container">
                                        <div class="icon1 floating-left"></div>
                                        <div class="number floating-left"><?= $row["views"]; ?></div>
                                    </div>
                                    <div class="item-container">
                                        <div class="icon2 floating-left"></div>
                                        <div class="number floating-left"><?= $row["favorites"]; ?></div>
                                    </div>
                                    <div class="item-container">
                                        <div class="icon3 floating-left"></div>
                                        <div class="number floating-left"><?= $row["sales"]; ?></div>
                                    </div>
                                    <div class="item-container">
                                        <div class="icon4 audio floating-left"></div>
                                        <div class="number floating-left"><?= $row["download"]; ?></div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>




                        </div>


                    </div>

                    <?php
                    if($row["is_playlist"]==1){
                    ?>
                    <div class="related-title-container playlist" style="clear: both">
                        <div class="center-piece">
                            <div class="floating-left title"><?=$Lang->PlayList;?></div>
                        </div>
                    </div>
                    <div class="related-content-container playlist" style="clear: both">
                        <div class="center-piece">
                            <section class="regular1 slider frame" id="slider">
                                <?php
                                getPlaylistMedia($row);
                                ?>
                            </section>
                        </div>
                        <?php
                        }
                        ?>
                </div>
            </div>
        </div>
        <?php
        if(!$detect->isMobile() || $detect->isTablet()) {
            ?>
            <div class="related-title-container">
                <div class="center-piece">
                    <div class="floating-left title"><?= $Lang->RelatedProduct; ?></div>
                </div>
            </div>
            <div class="related-content-container">
                <div class="center-piece">
                    <section class="regular slider frame media" id="slider">
                        <?php
                        getRelatedProduct($row, "audio");
                        ?>
                    </section>
                </div>
            </div>
            <?php
        }
        ?>
        </div>
    </section>
<div id="Game-play-iframe">
    <div class="manhal-loader-main-container" style="display: none;">
        <div class="manhal-loader-content">
            <div class="sk-cube-grid">
                <div class="sk-cube sk-cube1"></div>
                <div class="sk-cube sk-cube2"></div>
                <div class="sk-cube sk-cube3"></div>
                <div class="sk-cube sk-cube4"></div>
                <div class="sk-cube sk-cube5"></div>
                <div class="sk-cube sk-cube6"></div>
                <div class="sk-cube sk-cube7"></div>
                <div class="sk-cube sk-cube8"></div>
                <div class="sk-cube sk-cube9"></div>
            </div>
        </div>
    </div>
    <iframe id="jq-iframe" onload="hidePopLoader();" class="Game-play-iframe" src="" width="100%" height="100%" frameborder="0px"></iframe>
    <div class="exit-full-screen"></div>
</div>
<?php
?>



