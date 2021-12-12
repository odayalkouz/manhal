<?php
$currentTab="index";
include_once "includes/function.php";
include_once "includes/header.php";
?>
    <script src="<?=SITE_URL;?>js/jquery.ui.touch-punch.min.js<?=$cash;?>" type="text/javascript"></script>
    <script src="<?=SITE_URL;?>js/allinone_carousel.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/css/home.css<?=$cash;?>">
<?php
if($detect->isMobile() || $detect->isTablet())
{
    ?>
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $css_code; ?>/css/prohome.css<?=$cash;?>">
    <?php
}
?>
 <?php
if(!$detect->isMobile() || $detect->isTablet()){
    $shsql = "Select * From events where eventid=28";
    $shresult = $con->query($shsql);
    $shrow = mysqli_fetch_assoc($shresult);
    $sharja=SITE_URL.$lang_code."/events/".$shrow['eventid']."/".str_replace(" ","-",$shrow['title_'.$_SESSION["lang"]]);

    ?>

    <section class="section-main-container jq-section-first" style="background:#cccccc;">
        <div class="arrow-container">
            <svg class="arrow">
                <path class="a1" d="M0 0 L30 32 L60 0"></path>
                <path class="a2" d="M0 20 L30 52 L60 20"></path>
                <path class="a3" d="M0 40 L30 72 L60 40"></path>
            </svg>
        </div>
        <div class="Modern-Slider">

            <div class="item">
                <a class="img-fill" href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a1/أصدقاء العربية">
                    <div class="img" style="background-image:url(<?= SITE_URL; ?>themes/main-Light-green-<?= $css_code; ?>/images/slider/ads/ads2.jpg);background-size: 100% 100% !important;"></div>
                    <div class="info">
                        <a class="position" href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a1/أصدقاء العربية">
                        </a>
                    </div>
                </a>
            </div>
            <div class="item">
                <a class="img-fill" href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/4/حكايات صبا">
                    <div class="img" style="background-image:url(<?= SITE_URL; ?>themes/main-Light-green-<?= $css_code; ?>/images/slider/ads/ads4.jpg);background-size: 100% 100% !important;"></div>
                    <div class="info">
                        <a class="position"href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/4/حكايات صبا">
                        </a>
                    </div>
                </a>
            </div>
            <div class="item">
                <a class="img-fill" href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f1/Call to Faith 1">
                    <div class="img"  style="background-image:url(<?= SITE_URL; ?>themes/main-Light-green-<?= $css_code; ?>/images/slider/ads/ads1.jpg);background-size: 100% 100% !important;"></div>
                    <div class="info">
                        <a class="position" href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f1/Call to Faith 1">
                        </a>
                    </div>
                </a>
            </div>

            <div class="item">
                <a class="img-fill"  href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/2/حكايات الحروف">
                    <div class="img" style="background-image:url(<?= SITE_URL; ?>themes/main-Light-green-<?= $css_code; ?>/images/slider/ads/ads3.jpg);background-size: 100% 100% !important;"></div>
                    <div class="info">
                        <a class="position" href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/2/حكايات الحروف">
                        </a>
                    </div>
                </a>
            </div>


            <div class="item">
                <a class="img-fill" href="https://www.manhal.com/ar/imanhal">
                    <div class="img" style="background-image:url(<?= SITE_URL; ?>themes/main-Light-green-<?= $css_code; ?>/images/slider/slider14/bg.jpg);background-size: 100% 100% !important;"></div>
                    <div class="info">
                        <a class="position" href="https://www.manhal.com/ar/imanhal">>
                        </a>
                    </div>
                </a>
            </div>

            <div class="item">
                <div class="img-fill">
                    <div class="img" style="background-image:url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/slider/slider11/bg.png)"></div>
                    <div class="info">
                        <div class="position">
                            <div class="slide3-text-container ebook">
                                <label class="text1 text-left"><?=$Lang->EShop;?></label>
                                <label class="text2 text-left"><?=$Lang->Slider2Text2;?></label>
                                <a class="btn-more-sliderestories"  href="<?=SITE_URL.$lang_code;?>/books"><?=$Lang->View;?></a>
                                <div class="circle1"></div>
                                <div class="circle2"></div>
                                <div class="circle3"></div>
                            </div>
                            <div class="slide11-image1"></div>
                            <div class="slide11-image2"></div>
                            <div class="slide11-image3"></div>
                            <div class="slide11-image4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="img-fill">
                    <div class="img" style="background-image:url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/slider/slider8/bg.jpg)"></div>
                    <div class="info">
                        <div class="position">
                            <div class="slide3-text-container ebook">
                                <label class="text1 text-left"><?=$Lang->ebook;?></label>
                                <label class="text2 text-left"><?=$Lang->Thejoyoflearning;?></label>
                                <a class="btn-more-sliderestories"  href="<?=SITE_URL.$lang_code;?>/electronic-books"><?=$Lang->ReadMore;?></a>
                                <div class="circle1"></div>
                                <div class="circle2"></div>
                                <div class="circle3"></div>
                            </div>
                                <div class="slide8-image1"></div>
                                <div class="slide8-image2"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="img-fill">
                    <div class="img" style="background-image:url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/slider/slider9/bg.jpg)"></div>
                    <div class="info">
                        <div class="position">
                            <div class="slide3-text-container ebook">
                                <label class="text1 text-left"><?=$Lang->EStories;?></label>
                                <label class="text2 text-left"><?=$Lang->Aworldofwonders;?></label>
                                <a class="btn-more-sliderebook"  href="<?=SITE_URL.$lang_code;?>/electronic-stories"><?=$Lang->View;?></a>
                                <div class="circle1"></div>
                                <div class="circle2"></div>
                                <div class="circle3"></div>
                            </div>
                            <div class="slide9-image1"></div>
                            <div class="slide9-image2"></div>
                            <div class="slide9-image3"></div>
                            <div class="slide9-image4"></div>
                            <div class="slide9-image5"></div>
                            <div class="slide9-image6"></div>
                            <div class="slide9-image7"></div>
                            <div class="slide9-image8"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="img-fill">
                    <div class="img" style="background-image:url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/slider/slider12/bg.png)"></div>
                    <div class="info">
                        <div class="position">
                            <div class="slide3-text-container ebook">
                                <label class="text1 text-left"><?=$Lang->EducationalGames;?></label>
                                <label class="text2 text-left"><?=$Lang->newvisioninlearning;?></label>
                                <a class="btn-more-sliderestories"  href="<?=SITE_URL.$lang_code;?>/games"><?=$Lang->View;?></a>
                                <div class="circle1"></div>
                                <div class="circle2"></div>
                                <div class="circle3"></div>
                            </div>
                            <div class="slide12-image1"></div>
                            <div class="slide12-image2"></div>
                            <div class="slide12-image3"></div>
                            <div class="slide12-image4"></div>
                            <div class="slide12-image5"></div>
                            <div class="slide12-image6"></div>
                            <div class="slide12-image7"></div>
                            <div class="slide12-image8"></div>
                            <div class="slide12-image9"></div>
                            <div class="slide12-image10"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="img-fill">
                    <div class="img" style="background-image:url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/slider/slider10/bg.png)"></div>
                    <div class="info">
                        <div class="position">
                            <div class="slide3-text-container ebook">
                                <label class="text1 text-left"><?=$Lang->Videos;?></label>
                                <label class="text2 text-left"><?=$Lang->Watchandlearn;?></label>
                                <a class="btn-more-sliderestories"  href="<?=SITE_URL.$lang_code;?>/video"><?=$Lang->View;?></a>
                                <div class="circle1"></div>
                                <div class="circle2"></div>
                                <div class="circle3"></div>
                            </div>
                            <div class="slide10-image1"></div>
                            <div class="slide10-image2"></div>
                            <div class="slide10-image3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}else{
    ?>
    <script>
        $(document).ready(function ()
        {
            setTimeout(function()
            {
                $('.slidephone .ui-tab1 .multiple-items').slick({
                    infinite: true,
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    autoplay: false,
                    speed: 100,

                    cssEase: 'ease-in-out'
                });
            },250);
            $(document).on("click", ".ui-tab2", function ()
            {
                setTimeout(function(){
                    $('.slidephone .ui-tab2 .multiple-items').slick({
                        infinite: true,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: false,
                        speed: 100,
                        cssEase: 'ease-in-out'
                    });
                },50);
            });
            $(document).on("click", ".ui-tab3", function ()
            {
                setTimeout(function(){
                    $('.slidephone .ui-tab3 .multiple-items').slick({
                        infinite: true,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        autoplay: false,
                        speed: 100,
                        cssEase: 'ease-in-out'
                    });
                },50);
            });
        });
    </script>
    <?php
}
?>
    <section class="section-main-container jq-section-s parallax-container" data-parallax="scroll" data-position="top" speed="1.9" data-bleed="0" data-natural-width="1400" data-natural-height="1000" data-image-src="<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/sectionBg/block-binfits.png">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="content-container">
                        <div class="benifits-container">
                            <div class="top-container">
                                <div class="center-piece">
                                    <h2 class="reveal-top"><?=$Lang->Benefits;?></h2>
                                    <p class="reveal-bottom"><?=$Lang->BenefitSsubTitle;?></p>
                                </div>
                            </div>
                            <div class="bottom-container">
                                <div class="display-table">
                                    <div class="display-row">
                                        <div class="display-cell">
                                            <div class="center-piece">
                                                <p><?=$Lang->benifitsIntro;?></p>
                                                <div class="item-container reveal-rotate">
                                                    <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                                                        <div class="flipper">
                                                            <div class="front">
                                                                <div class="icon-bg-container">
                                                                    <div class="icon-bg image-a"></div>
                                                                </div>
                                                                <h3><?=$Lang->BooksStories;?></h3>
                                                            </div>
                                                            <div class="back">
                                                                <label><?=$Lang->BooksStoriesDesc;?></label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                if(!$detect->isMobile() || $detect->isTablet()){
                                                ?>
                                                <div class="item-container reveal-rotate">
                                                    <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                                                        <div class="flipper">
                                                            <div class="front">
                                                                <div class="icon-bg-container">
                                                                    <div class="icon-bg image-b"></div>
                                                                </div>
                                                                <h3><?=$Lang->EBooksEStories;?></h3>
                                                            </div>
                                                            <div class="back">
                                                                <label><?=$Lang->EBooksEStoriesDesc;?></label>
                                                                <a class="floating-right" href="<?=SITE_URL.$lang_code;?>/products#ebooks"><?=$Lang->More;?></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-container reveal-rotate">
                                                    <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                                                        <div class="flipper">
                                                            <div class="front">
                                                                <div class="icon-bg-container">
                                                                    <div class="icon-bg image-c"></div>
                                                                </div>
                                                                <h3><?=$Lang->EducationalGames;?></h3>
                                                            </div>
                                                            <div class="back">
                                                                <label><?=$Lang->EducationalGamesDesc;?></label>
                                                                <a class="floating-right" href="<?=SITE_URL.$lang_code;?>/products#ebooks"><?=$Lang->More;?></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                }
                                                ?>
                                                <div class="item-container reveal-rotate">
                                                    <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                                                        <div class="flipper">
                                                            <div class="front">
                                                                <div class="icon-bg-container">
                                                                    <div class="icon-bg image-d"></div>
                                                                </div>
                                                                <h3><?=$Lang->EducationalTools;?></h3>
                                                            </div>
                                                            <div class="back">
                                                                <label><?=$Lang->EducationalToolsDesc;?></label>
                                                                <a class="floating-right" href="<?=SITE_URL.$lang_code;?>/products#ebooks"><?=$Lang->More;?></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="item-container reveal-rotate">
                                                    <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                                                        <div class="flipper">
                                                            <div class="front">
                                                                <div class="icon-bg-container">
                                                                    <div class="icon-bg image-e"></div>
                                                                </div>
                                                                <h3><?=$Lang->Application;?></h3>
                                                            </div>
                                                            <div class="back">
                                                                <label><?=$Lang->ApplicationDesc;?></label>
                                                                <a class="floating-right" href="<?=SITE_URL.$lang_code;?>/products#ebooks"><?=$Lang->More;?></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                                if(!$detect->isMobile() || $detect->isTablet()){
                                                ?>
                                                <div class="item-container reveal-rotate">
                                                    <div class="flip-container" ontouchstart="this.classList.toggle('hover');">
                                                        <div class="flipper">
                                                            <div class="front">
                                                                <div class="icon-bg-container">
                                                                    <div class="icon-bg image-f"></div>
                                                                </div>
                                                                <h3><?=$Lang->Furniture;?></h3>
                                                            </div>
                                                            <div class="back">
                                                                <label><?=$Lang->FurnitureDesc;?></label>
                                                                <a class="floating-right" href="<?=SITE_URL.$lang_code;?>/products#ebooks"><?=$Lang->More;?></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="display-block clear-both">
                                                    <a class="floating-right all" href="<?=SITE_URL.$lang_code;?>/products"><?=$Lang->More;?></a>
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
        </div>
    </section>
<?php
if(!$detect->isMobile() || $detect->isTablet()) {
    ?>
    <section class="section-main-container jq-section books-main-container parallax-container" data-parallax="scroll" data-position="top" speed="1.9" data-bleed="0" data-natural-width="1400" data-natural-height="1000" data-image-src="<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/sectionBg/book-bg.png">
    <?php
}else{
    ?>
        <section class="section-main-container jq-section books-main-container parallax-container" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/sectionBg/story-bg.png);background-repeat: no-repeat" data-parallax="scroll" data-position="top" speed="1.9" data-bleed="0" data-natural-width="1400" data-natural-height="1000" data-image-src="<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/sectionBg/book-bg.png">
    <?php
}
    ?>

        <div class="center-piece">
            <div class="display-table">
                <div class="display-row">
                    <div class="display-cell">
                        <div class="content-container">
                            <div class="section-title reveal-top">
                                <h2 class="special"><?=$Lang->Books;?></h2>
                                <span></span>
                            </div>
                            <div class="container theme-cactus">
                                <div class="ui-tabgroup">
                                    <input class="ui-tab1" type="radio" id="tgroup_c1_tab1" name="tgroup_c1" checked/>
                                    <input class="ui-tab2" type="radio" id="tgroup_c1_tab2" name="tgroup_c1"/>
                                    <input class="ui-tab3" type="radio" id="tgroup_c1_tab3" name="tgroup_c1"/>
                                    <input class="ui-tab4" type="radio" id="tgroup_c1_tab4" name="tgroup_c1"/>
                                    <input class="ui-tab5" type="radio" id="tgroup_c1_tab5" name="tgroup_c1"/>
                                    <div class="ui-tabs">
                                        <label class="ui-tab1" for="tgroup_c1_tab1"><?=$Lang->NewBooks;?></label>
                                        <label class="ui-tab2" for="tgroup_c1_tab2"><?=$Lang->BestSeller;?></label>
                                        <label class="ui-tab3" for="tgroup_c1_tab3"><?=$Lang->Popular;?></label>
                                        <label class="ui-tab4" for="tgroup_c1_tab4"><?=$Lang->TopRated;?></label>
                                        <label class="ui-tab5" for="tgroup_c1_tab5"><?=$Lang->TopFavorite;?></label>
                                    </div>
                                    <div class="ui-panels desktopslide">
                                        <div class="ui-tab1">
                                          <?php
//                                          getRecentBooks(4);
                                          ?>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f4/Call To Faith 4" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#f17778"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/f4/slider/0.jpg">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f4/Call To Faith 4" class="text-left title" style="direction:rtl;">Call To Faith 4</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f4/Call To Faith 4" class="text-left cat"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1536']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1536" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1536" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1536" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1536" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1536" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="13.2" bookid="1536"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f4/Call To Faith 4" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/d2/هيا إلى الإيمان 1" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#765790"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/d2/slider/0.jpg" alt="أصدقاء العربية - البستان">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/d2/هيا إلى الإيمان 1" class="text-left title" style="direction:rtl;" title="أحب الإسلام">هيا إلى الإيمان 1</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/d2/هيا إلى الإيمان 1" class="text-left cat" title="Islamic"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1519']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1519" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1519" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1519" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1519" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1519" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="6.6" bookid="1519"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/d2/هيا إلى الإيمان 1" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a2/أصدقاء العربية تمهيدي" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#52c1b1"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/a2/slider/0.jpg" alt="أصدقاء العربية - البستان">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a2/أصدقاء العربية تمهيدي" class="text-left title" style="direction:rtl;" title="أحب الإسلام">أصدقاء العربية تمهيدي</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a2/أصدقاء العربية تمهيدي" class="text-left cat" title="Islamic"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1489']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1489" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1489" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1489" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1489" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1489" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="11" bookid="1489"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a2/أصدقاء العربية تمهيدي" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/b2/براعم العربية 2" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#e3f3f3"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/b2/slider/0.jpg">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/b2/براعم العربية 2" class="text-left title" style="direction:rtl;">براعم العربية 2</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/b2/براعم العربية 2" class="text-left cat"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1511']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1511" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1511" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1511" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1511" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1511" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="7.5" bookid="1511"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/b2/براعم العربية 2" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="ui-tab2">
                                            <?php
                                            //getBestSellerBooks(4);//
                                            ?>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a6/أصدقاء العربية 4" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#ff6f49"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/a6/slider/0.jpg" alt="أصدقاء العربية - البستان">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a6/أصدقاء العربية 4" class="text-left title" style="direction:rtl;" title="أحب الإسلام">أصدقاء العربية 4</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a6/أصدقاء العربية 4" class="text-left cat" title="Islamic"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1505']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1505" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1505" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1505" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1505" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1505" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="11" bookid="1505"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a6/أصدقاء العربية 4" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/d1/هيا إلى الإيمان - تمهيدي" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#0099dc"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/d1/slider/0.jpg" alt="أصدقاء العربية - البستان">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/d1/هيا إلى الإيمان - تمهيدي" class="text-left title" style="direction:rtl;" title="أحب الإسلام">هيا إلى الإيمان - تمهيدي</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/d1/هيا إلى الإيمان - تمهيدي" class="text-left cat" title="Islamic"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1518']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1518" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1518" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1518" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1518" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1518" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="6.6" bookid="1518"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/d1/هيا إلى الإيمان - تمهيدي" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/b1/" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#bbe5f2"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/b1/slider/0.jpg">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/b1/" class="text-left title" style="direction:rtl;">براعم العربية 1</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/b1/" class="text-left cat"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1509']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1509" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1509" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1509" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1509" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1509" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="6.5" bookid="1509"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/b1/" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f1/Call To Faith 1" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#657fbf"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/f1/slider/0.jpg" alt="أصدقاء العربية - البستان">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f1/Call To Faith 1" class="text-left title" style="direction:rtl;">Call To Faith 1</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f1/Call To Faith 1" class="text-left cat"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1527']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1527" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1527" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1527" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1527" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1527" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="13.2" bookid="1527"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f1/Call To Faith 1" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ui-tab3">
                                            <?php
                                            //getPopularBooks(4);//
                                            ?>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a3/أصدقاء العربية 1" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#0269ac"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/a3/slider/0.jpg" alt="أصدقاء العربية - البستان">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a3/أصدقاء العربية 1" class="text-left title" style="direction:rtl;">أصدقاء العربية 1</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a3/أصدقاء العربية 1" class="text-left cat" title="Islamic"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1493']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1493" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1493" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1493" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1493" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1493" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="13.2" bookid="1493"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a1/أصدقاء العربية 3" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/c1/العب وتعلم مع الحروف" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#1d99d5"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/c1/slider/0.jpg" alt="أصدقاء العربية - البستان">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/c1/العب وتعلم مع الحروف" class="text-left title" style="direction:rtl;" title="أحب الإسلام">العب وتعلم مع الحروف</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/c1/العب وتعلم مع الحروف" class="text-left cat" title="Islamic"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1515']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1515" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1515" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1515" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1515" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1515" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="7" bookid="1515"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/c1/العب وتعلم مع الحروف" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/e1/1 براعم الإسلام" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#abdde1"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/e1/slider/0.jpg">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/e1/1 براعم الإسلام" class="text-left title" style="direction:rtl;">براعم الإسلام 1</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/e1/براعم الإسلام 1" class="text-left cat"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1524']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1524" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1524" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1524" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1524" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1524" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="5" bookid="1524"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/e1/براعم الإسلام 1" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f3/Call To Faith 3" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#25bdc5"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/f3/slider/0.jpg" alt="أصدقاء العربية - البستان">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f3/Call To Faith 3" class="text-left title" style="direction:rtl;">Call To Faith 3</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f3/Call To Faith 3" class="text-left cat"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1533']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1533" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1533" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1533" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1533" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1533" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="13.2" bookid="1533"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f3/Call To Faith 3" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ui-tab4">
                                            <?php
                                            //getTopRatedBooks(4);//
                                            ?>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a1/أصدقاء العربية - البستان" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#f78b7d"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/a1/slider/0.jpg" alt="أصدقاء العربية - البستان">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a1/أصدقاء العربية - البستان" class="text-left title" style="direction:rtl;">أصدقاء العربية - البستان</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a1/أصدقاء العربية - البستان" class="text-left cat" title="Islamic"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1485']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1485" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1485" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1485" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1485" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1485" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="11" bookid="1485"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a1/أصدقاء العربية - البستان" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/e1/1 براعم الإسلام" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#bae3e6"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/e1/slider/0.jpg">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/e1/1 براعم الإسلام" class="text-left title" style="direction:rtl;">براعم الإسلام 1</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/e1/براعم الإسلام 1" class="text-left cat"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1524']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1524" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1524" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1524" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1524" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1524" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="5" bookid="1524"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/e1/براعم الإسلام 1" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f2/Call To Faith 5" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#30a5dd"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/f2/slider/0.jpg" alt="أصدقاء العربية - البستان">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f2/Call To Faith 2" class="text-left title" style="direction:rtl;">Call To Faith 3</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f2/Call To Faith 2" class="text-left cat"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1530']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1530" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1530" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1530" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1530" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1530" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="13.2" bookid="1530"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f2/Call To Faith 2" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/c1/العب وتعلم مع الحروف" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#1d99d5"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/c1/slider/0.jpg" alt="أصدقاء العربية - البستان">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/c1/العب وتعلم مع الحروف" class="text-left title" style="direction:rtl;" title="أحب الإسلام">العب وتعلم مع الحروف</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/c1/العب وتعلم مع الحروف" class="text-left cat" title="Islamic"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1515']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1515" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1515" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1515" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1515" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1515" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="7" bookid="1515"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/c1/العب وتعلم مع الحروف" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="ui-tab5">
                                            <?php
                                            //getTopFavoriteBooks(4);//
                                            ?>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a5/أصدقاء العربية 3" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#7b2b84"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/a5/slider/0.jpg" alt="أصدقاء العربية - البستان">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a5/أصدقاء العربية 3" class="text-left title" style="direction:rtl;">أصدقاء العربية 3</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a5/أصدقاء العربية 3" class="text-left cat" title="Islamic"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1505']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1485" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1485" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1485" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1485" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1485" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="13.2" bookid="1505"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/a5/أصدقاء العربية 3" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/d1/هيا إلى الإيمان - تمهيدي" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#00a4e6"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/d1/slider/0.jpg" alt="أصدقاء العربية - البستان">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/d1/هيا إلى الإيمان - تمهيدي" class="text-left title" style="direction:rtl;" title="أحب الإسلام">هيا إلى الإيمان - تمهيدي</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/d1/هيا إلى الإيمان - تمهيدي" class="text-left cat" title="Islamic"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1518']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1485" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1485" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1485" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1485" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1485" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="6.6" bookid="1518"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/d1/هيا إلى الإيمان - تمهيدي" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/b1/" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#b1e1f3"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/b1/slider/0.jpg">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/b1/" class="text-left title" style="direction:rtl;">براعم العربية 1</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/b1/" class="text-left cat"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1509']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1509" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1509" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1509" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1509" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1509" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="6.5" bookid="1509"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/b1/" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-container-ar jq_item_container book floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f1/Call To Faith 1" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#627cbc"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/books/f1/slider/0.jpg" alt="أصدقاء العربية - البستان">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f1/Call To Faith 1" class="text-left title" style="direction:rtl;">Call To Faith 1</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f1/Call To Faith 1" class="text-left cat"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Arabic</label></a>
                                                    <div class="floating-right display-inline-block ">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['1527']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>  </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(25)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="book" rate="5" bookid="1527" class="checked star star-5" id="star-5-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="4" bookid="1527" class="star star-4" id="star-4-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="3" bookid="1527" class="star star-3" id="star-3-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="2" bookid="1527" class="star star-2" id="star-2-5133761715122387d02" type="radio" name="star">
                                                                    <label class="star star-2" for="star-2-5133761715122387d02"></label>
                                                                    <input disabled="" prodect="book" rate="1" bookid="1527" class="star star-1" id="star-1-5133761715122387d02" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-5133761715122387d02"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                        <div class="hover-container floating-right">
                                                            <div class="buttons-container floating-left">
                                                                <a class="buy book_addtocart floating-left" booktype="3" price="13.2" bookid="1527"></a>
                                                            </div>
                                                            <div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/books/f1/Call To Faith 1" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ui-panels slidephone">
                                        <div class="ui-tab1 tabi">
                                            <section class="section-main-container jq-section clientsay">
                                                <div class="center-piece">
                                                    <div class="display-table">
                                                        <div class="display-row">
                                                            <div class="display-cell">
                                                                <div class="content-container">
                                                                    <div class="content">
                                                                        <div class="slider multiple-items reveal-bottom">
                                                                            <?php
                                                                            getRecentBooks(4);
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="ui-tab2 tabi">
                                            <section class="section-main-container jq-section clientsay">
                                                <div class="center-piece">
                                                    <div class="display-table">
                                                        <div class="display-row">
                                                            <div class="display-cell">
                                                                <div class="content-container">
                                                                    <div class="content">
                                                                        <div class="slider multiple-items reveal-bottom">
                                                                            <?php
                                                                            getBestSellerBooks(4);
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                        <div class="ui-tab3 tabi">
                                            <section class="section-main-container jq-section clientsay">
                                                <div class="center-piece">
                                                    <div class="display-table">
                                                        <div class="display-row">
                                                            <div class="display-cell">
                                                                <div class="content-container">
                                                                    <div class="content">
                                                                        <div class="slider multiple-items reveal-bottom">
                                                                            <?php
                                                                            getPopularBooks(4);
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <a class="all floating-right" href="<?=SITE_URL.$lang_code;?>/books"><?=$Lang->AllBooks;?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-main-container jq-section-s stories-main-container" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/sectionBg/story-bg.png);background-repeat: no-repeat">
        <div class="center-piece">
            <div class="display-table">
                <div class="display-row">
                    <div class="display-cell">
                        <div class="content-container" >
                            <div class="top-container-description" style="position: relative">
                                <div class="multi-parallex-effect parallax-layer image-a reveal-bottom"></div>
                                <div class="multi-parallex-effect parallax-layer image-b reveal-top"></div>
                                <div class="multi-parallex-effect parallax-layer image-c reveal-right"></div>
                                <div class="multi-parallex-effect parallax-layer image-d reveal-right"></div>
                                <div class="multi-parallex-effect parallax-layer image-e reveal-bottom"></div>
                                <div class="multi-parallex-effect parallax-layer image-f reveal-top"></div>
                                <div class="left-container floating-left">
                                    <h2 class="reveal-top"><?=$Lang->Stories;?></h2>
                                    <p class="reveal-left"><?=$Lang->storyIntro1;?></p>
                                    <p class="reveal-left"><?=$Lang->storyIntro2;?></p>
                                    <p class="reveal-left"><?=$Lang->storyIntro3;?></p>
                                    <a href="<?=SITE_URL.$lang_code;?>/stories" class="button floating-left reveal-bottom"><?=$Lang->AllStories;?></a>
                                </div>
                            </div>
                            <div class="container theme-cactus">
                                <div class="ui-tabgroup">
                                    <input class="ui-tab1" type="radio" id="tgroup_c12_tab1" name="tgroup_c12" checked/>
                                    <input class="ui-tab2" type="radio" id="tgroup_c12_tab2" name="tgroup_c12"/>
                                    <input class="ui-tab3" type="radio" id="tgroup_c12_tab3" name="tgroup_c12"/>
                                    <input class="ui-tab4" type="radio" id="tgroup_c12_tab4" name="tgroup_c12"/>
                                    <input class="ui-tab5" type="radio" id="tgroup_c12_tab5" name="tgroup_c12"/>
                                    <div class="ui-tabs">
                                        <label class="ui-tab1 new" title="<?=$Lang->NewStories;?>" for="tgroup_c12_tab1"></label>
                                        <label class="ui-tab3 popular" title="<?=$Lang->Popular;?>" for="tgroup_c12_tab3"></label>
                                        <label class="ui-tab4 toprated" title="<?=$Lang->TopFavorite;?>" for="tgroup_c12_tab4"></label>
                                        <label class="ui-tab5 topfavorite" title="<?=$Lang->TopRated;?>" for="tgroup_c12_tab5"></label>
                                    </div>
                                    <div class="ui-panels">
                                        <div class="ui-tab1 reveal-left">
<!--                                            --><?//=getRecentStories(4);?>
                                            <div class="item-container-ar jq_item_container story floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/2/حكايات الحروف" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#f0f0f0"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/stories/2/slider/1.jpg">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/2/حكايات الحروف" class="text-left title" style="direction:rtl;" title="نادي القراءة جميع المستويات">حكايات الحروف</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/2/حكايات الحروف" class="text-left cat" title="Education Stories"><label class="floating-left">Story</label><label class="floating-left">/</label><label class="floating-left">Education Stories</label></a>
                                                    <div class="floating-right display-inline-block jq_hideprice">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['3456']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>
                                                </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(50)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="story" rate="5" bookid="3456" class="star star-5" id="star-5-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-856716171687b5acdf1"></label>
                                                                    <input disabled="" prodect="story" rate="4" bookid="3456" class="star star-4" id="star-4-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-856716171687b5acdf1"></label>
                                                                    <input disabled="" prodect="story" rate="3" bookid="3456" class="star star-3" id="star-3-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-856716171687b5acdf1"></label>
                                                                    <input disabled="" prodect="story" rate="2" bookid="3456" class="star star-2" id="star-2-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-2" for="star-2-856716171687b5acdf1"></label>
                                                                    <input disabled="" prodect="story" rate="1" bookid="3456" class="star star-1" id="star-1-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-856716171687b5acdf1"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div><div class="hover-container floating-right"> <div class="buttons-container floating-left">
                                                                <a class="buy story_addtocart  floating-left" booktype="1" bookid="3456"></a>
                                                            </div><div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/2/حكايات الحروف" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>
                                            <div class="item-container-ar jq_item_container story floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/3/حكايات الزرافة" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#f0f0f0"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/stories/3/slider/1.jpg">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/3/حكايات الزرافة" class="text-left title" style="direction:rtl;">حكايات الزرافة</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/3/حكايات الزرافة" class="text-left cat" title="Education Stories"><label class="floating-left">Story</label><label class="floating-left">/</label><label class="floating-left">Education Stories</label></a>
                                                    <div class="floating-right display-inline-block jq_hideprice">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['3451']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>
                                                </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(50)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="story" rate="5" bookid="3451" class="star star-5" id="star-5-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-856716171687b5acdf1"></label>
                                                                    <input disabled="" prodect="story" rate="4" bookid="3451" class="star star-4" id="star-4-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-856716171687b5acdf1"></label>
                                                                    <input disabled="" prodect="story" rate="3" bookid="3451" class="star star-3" id="star-3-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-856716171687b5acdf1"></label>
                                                                    <input disabled="" prodect="story" rate="2" bookid="3451" class="star star-2" id="star-2-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-2" for="star-2-856716171687b5acdf1"></label>
                                                                    <input disabled="" prodect="story" rate="1" bookid="3451" class="star star-1" id="star-1-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-856716171687b5acdf1"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div><div class="hover-container floating-right"> <div class="buttons-container floating-left">
                                                                <a class="buy story_addtocart  floating-left" booktype="1" bookid="3451"></a>
                                                            </div><div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/3/حكايات الزرافة" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="item-container-ar jq_item_container story floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/4/حكايات صبا" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#f0f0f0"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/stories/4/slider/1.jpg">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/4/حكايات صبا" class="text-left title" style="direction:rtl;">حكايات صبا</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/4/حكايات صبا" class="text-left cat" title="Education Stories"><label class="floating-left">Story</label><label class="floating-left">/</label><label class="floating-left">Education Stories</label></a>
                                                    <div class="floating-right display-inline-block jq_hideprice">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['3457']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>
                                                </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(60)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="story" rate="5" bookid="3457" class="star star-5" id="star-5-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-856716171687b5acdf1"></label>
                                                                    <input disabled="" prodect="story" rate="4" bookid="3457" class="star star-4" id="star-4-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-856716171687b5acdf1"></label>
                                                                    <input disabled="" prodect="story" rate="3" bookid="3457" class="star star-3" id="star-3-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-856716171687b5acdf1"></label>
                                                                    <input disabled="" prodect="story" rate="2" bookid="3457" class="star star-2" id="star-2-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-2" for="star-2-856716171687b5acdf1"></label>
                                                                    <input disabled="" prodect="story" rate="1" bookid="3457" class="star star-1" id="star-1-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-856716171687b5acdf1"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div><div class="hover-container floating-right"> <div class="buttons-container floating-left">
                                                                <a class="buy story_addtocart  floating-left" booktype="1" bookid="3457"></a>
                                                            </div><div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/4/حكايات صبا" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                            <div class="item-container-ar jq_item_container story floating-left reveal-bottom">
                                                <div class="book-container">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/5/نادي القراءة" class="libro floating-left" title="">
                                                        <div class="backcover" style="background-color:#f0f0f0"></div>
                                                        <span></span>
                                                        <img src="<?=SITE_URL;?>products/stories/5/slider/1.jpg">
                                                    </a>
                                                </div>
                                                <div class="title-sub-container clear-both">
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/5/نادي القراءة" class="text-left title" style="direction:rtl;">نادي القراءة</a>
                                                    <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/5/نادي القراءة" class="text-left cat" title="Education Stories"><label class="floating-left">Story</label><label class="floating-left">/</label><label class="floating-left">Education Stories</label></a>
                                                    <div class="floating-right display-inline-block jq_hideprice">
                                                        <div class="right floating-right"><div class="display-inline-block"><span class="floating-right"><?=$campainPrice['3458']['new'];?></span><span class="floating-right">$</span></div></div>
                                                    </div>
                                                </div>
                                                <div class="bottom-container">
                                                    <div class="center floating-left">
                                                        <div class="rating-container floating-left">
                                                            <div class="number floating-right">(60)</div>
                                                            <div class="stars floating-right">
                                                                <form action="">
                                                                    <input disabled="" prodect="story" rate="5" bookid="3458" class="star star-5" id="star-5-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-5" for="star-5-856716171687b5acdf1"></label>
                                                                    <input disabled="" prodect="story" rate="4" bookid="3458" class="star star-4" id="star-4-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-4" for="star-4-856716171687b5acdf1"></label>
                                                                    <input disabled="" prodect="story" rate="3" bookid="3458" class="star star-3" id="star-3-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-3" for="star-3-856716171687b5acdf1"></label>
                                                                    <input disabled="" prodect="story" rate="2" bookid="3458" class="star star-2" id="star-2-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-2" for="star-2-856716171687b5acdf1"></label>
                                                                    <input disabled="" prodect="story" rate="1" bookid="3458" class="star star-1" id="star-1-856716171687b5acdf1" type="radio" name="star">
                                                                    <label class="msgerrorlogin star star-1" for="star-1-856716171687b5acdf1"></label>
                                                                </form>
                                                            </div>
                                                        </div><div class="addtofav floating-left text-left flag-Arabic"></div><div class="hover-container floating-right"> <div class="buttons-container floating-left">
                                                                <a class="buy story_addtocart  floating-left" booktype="1" bookid="3458"></a>
                                                            </div><div class="view-container floating-right">
                                                                <a href="<?=SITE_URL;?><?=strtolower($_SESSION['lang']);?>/product/stories/5/نادي القراءة" title="Views" class="view-icon floating-left"></a>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>

                                            </div>

                                        </div>
                                        <div class="ui-tab3 reveal-left">
                                            <?=getPopularStories(4);?>
                                        </div>
                                        <div class="ui-tab4 reveal-left">
                                            <?=getTopRatedStories(4);?>
                                        </div>
                                        <div class="ui-tab5 reveal-left">
                                            <?=getTopFavoriteStories(4);?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
if(!$detect->isMobile() || $detect->isTablet()) {
    ?>
    <section class="section-main-container jq-section-s event-main-container" style="display: none" data-parallax="scroll" data-position="top" speed="1.9" data-bleed="0" data-natural-width="1400" data-natural-height="1000" data-image-src="<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/sectionBg/our-news-bg.png">
        <div class="center-piece">
            <div class="display-table">
                <div class="display-row">
                    <div class="display-cell">
                        <div class="content-container">
                            <div class="section-title-white-event reveal-top">
                                <h2><?=$Lang->OurEvent;?></h2>
                                <span></span>
                            </div>
                            <div class="paragraph reveal-top"><?=$Lang->OurEventParagraph;?></div>
                            <div class="things-container">
                                <div class="year-box reveal-top">
                                    <?php echo date("Y") ?>
                                </div>
                                <?php
                                $sql = "Select * From events where `startdate` LIKE  '%".date("Y")."%' ORDER BY  `events`.`startdate` ASC LIMIT 3  ";
                                $result = $con->query($sql);
                                $i=0;
                                if (mysqli_num_rows($result) > 0)
                                {
                                while ($row = mysqli_fetch_assoc($result))
                                {
                                    $viewLink=SITE_URL.strtolower($cat_code).'/events/'.$row['eventid']."/".str_replace(" ","-",$row['title_' . ucfirst($cat_code)]);

                                    if($i==0 ) {
                                        echo '<div class="left-container floating-left"> <div class="row-container left first-row reveal-left"> <div class="rectangle floating-left"> <div class="square floating-left"> <a class="event-anchor">';
                                        echo '<label>' . date('d', strtotime($row['startdate'])) . '</label>';
                                        echo '<span>' . date('M', strtotime($row['startdate'])) . '</span>';
                                        echo '</a>';
                                        echo '<a class="event-img"  href="'.$viewLink.'"  style="background-image: url(' . $row['thumb'] . ')"></a></div>';
                                        echo '<div class="right">';
                                        echo '<a class="event-anchor" href="'.$viewLink.'" >' . $row['title_' . ucfirst($cat_code)] . '</a>';
                                        echo '<p>' . $row['description_' . ucfirst($cat_code)] . '</p><a class="floating-right" href="'.$viewLink. '">'.$Lang->ReadMore.'</a></div></div>';
                                    }else if($i==1){
                                        echo '<div class="line floating-left"></div><div class="circle floating-left"></div></div>';
                                        echo '<div class="row-container left third-row reveal-left"><div class="rectangle floating-left"><div class="square floating-left">';
                                        echo '<a class="event-anchor" href="'.$viewLink. '"><label>'. date('d', strtotime($row['startdate'])) .'</label>';
                                        echo '<span>'.date('M', strtotime($row['startdate'])).'</span></a>';
                                        echo '<a class="event-img" href="'.$viewLink. '" style="background-image: url(' . $row['thumb'] . ')"></a></div>';
                                        echo '<div class="right"><a href="'.$viewLink. '" >'.$row['title_' .ucfirst($cat_code)].'</a><p>'.$row['description_' . ucfirst($cat_code)].'</p><a class="floating-right" href="'.$viewLink. '">'.$Lang->ReadMore.'</a></div></div><div class="line floating-left"></div><div class="circle floating-left"></div>';
                                        echo '</div></div>';
                                    }else if($i==2){
                                        echo '<div class="center-container floating-left"></div>' ;
                                        echo'<div class="right-container floating-left"><div class="row-container right scound-row reveal-right"><div class="rectangle floating-right"> <div class="square floating-left">';
                                        echo'<a class="event-anchor" href="'.$viewLink. '"><label>'.date('d', strtotime($row['startdate'])).'</label>';
                                        echo'<span>'.date('M', strtotime($row['startdate'])).'</span></a>';
                                        echo'<a class="event-img" href="'.$viewLink. '" style="background-image: url(' . $row['thumb'] . ')"></a></div>';
                                        echo'<div class="right">';
                                        echo'<a href="'.$viewLink. '">'.$row['title_' . ucfirst($cat_code)].'</a>';
                                        echo'<p>'.$row['description_' . ucfirst($cat_code)].'</p><a class="floating-right" href="'.$viewLink. '">'.$Lang->ReadMore.'</a></div> </div>';
                                        echo'<div class="line floating-right"></div><div class="circle floating-right"></div></div>';
                                        echo'<a href="'.SITE_URL.$lang_code.'/events" class="button reveal-top"  >'.$Lang->ViewMoreEvents.'</a></div>';
                                    }
                                    $i++;
                                }
                                }
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>
<?php
if(!$detect->isMobile() || $detect->isTablet()) {
    ?>
    <section class="section-main-container jq-section clientsay" data-parallax="scroll" data-position="top" speed="1.9" data-bleed="0" data-natural-width="1400" data-natural-height="1000" data-image-src="<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/sectionBg/our-clients.png">
        <div class="center-piece">
            <div class="display-table">
                <div class="display-row">
                    <div class="display-cell">
                        <div class="content-container">
                            <div class="section-title-white reveal-top">
                                <h2><?=$Lang->WhatClientsSay;?></h2>
                                <span></span>
                            </div>
                            <div class="content">
                                <div class="slider single-item reveal-bottom">
                                    <div class="quote-container">
                                        <div class="portrait"><img src="<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/macmilanlogo.jpg" alt="MacMilan"/></div>
                                        <div class="quote">
                                            <span style="text-align: right">Dar Al Manhal has been our business partners in Jordan for over 20 years, advising us on the needs of the market. We are proud to work with them.</span>
                                            <a target="_blank" href="http://www.macmillaneducation.com/" class="JacquelineSabri">Jacqueline Sabri<br>
                                                Country Manager – Macmillan Education, Jordan. </a>
                                        </div>
                                    </div>
                                    <div class="quote-container">
                                        <div class="portrait"><img src="<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/jarirlogo.jpg" alt="MacMilan"/></div>
                                        <div class="quote">
                                            <span style="text-align: right;direction: rtl">يسعدنا دائماً التعامل مع شركائنا في دار المنهل – عمان حيث التعامل الاحترافي والالتزام بالمواعيد وتلبية رغبة عملائنا هي ما يميز علاقتنا المشتركة.</span>
                                            <a target="_blank" href="http://www.macmillaneducation.com/" class="jarer"> ناصر عبدالعزيز <br> الرئيس التنفيذي للعمليات <br> مكتبة جرير </a>
                                        </div>
                                    </div>
                                    <div class="quote-container">
                                        <div class="portrait"><img src="<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/lana.png" alt="لانا"/></div>
                                        <div class="quote">
                                            <span style="text-align: right;direction: rtl"><?=$Lang->WhatClientsSayparagraph;?></span>
                                            <a class="lana-maming" target="_blank" href="https://ar.wikipedia.org/wiki/%D9%84%D8%A7%D9%86%D8%A7_%D9%85%D8%A7%D9%85%D9%83%D8%BA"><?=$Lang->WhatClientsSayparagraph3;?></a>
                                        </div>
                                    </div>
                                    <div class="quote-container">
                                        <div class="portrait"><img src="<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/issamurad.png" alt="عيسى"/></div>
                                        <div class="quote">
                                            <span style="text-align: right;direction: rtl">دار المنهل من أهم دور النشر العربية المختصة بانتاج المواد التربوية التعليمية للأطفال، بكفائة علمية وخبرات متقدمة، ويمتاز منتجها بالتنوع ومراعاة البيئات المختلفة للأطفال، فهي بذلك تسهم بفاعلية عاليه في تطوير التربية والتعليم في الدول العربية . كما تتفرد هذه الدار بانتاج كتب التعليم العربية لغير الناطقين بها في مجموعة من الدول الأجنبية .</span>
                                            <a target="_blank" class="isarashed" href="http://www.albabtainprize.org/encyclopedia/poet/0553.htm">د. راشد عيسى</a>
                                        </div>
                                    </div>
                                    <div class="quote-container">
                                        <div class="portrait"><img src="<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/reta.png" alt="ريتا"/></div>
                                        <div class="quote">
                                            <span style="text-align: right;direction: rtl;float: right">المنهل تاريخ طويل في نشر الثقافة بالمصادر المتنوعة بجودة عالية.<br> المنهل عالم يحتضن الطفولة والمبدعين للطفولة.<br> هو منصة للتعلم واللعب والمتعة  للطفل. المنهل انتم لؤلؤة في عالم الطفولة. </span>
                                            <a  target="_blank" class="reta" href="https://ar.wikipedia.org/wiki/%D9%84%D8%A7%D9%86%D8%A7_%D9%85%D8%A7%D9%85%D9%83%D8%BA" >المؤلفة: ريتا زيادة</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
}
?>
<section class="section-main-container jq-section our-partner-container" style="background:#fff">
        <div class="center-piece">
            <div class="display-table">
                <div class="display-row">
                    <div class="display-cell">
                        <div class="content-container">
                            <div class="left-container floating-left">
                                <div class="section-title-left floating-left reveal-left">
                                    <h2><?=$Lang->OurPartners;?></h2>
                                    <span></span>
                                </div>
                                <p class="clear-both text-left reveal-left"><?=$Lang->OurPartnersParagraph;?></p>
                                <a href="<?=SITE_URL.$lang_code;?>/our-partners" class="button floating-left reveal-left"><?=$Lang->ViewAll;?></a>
                            </div>
                            <div class="right-container floating-left reveal-right">
                                <div class="slider">
                                    <input type="radio" name="slider" title="slide1" checked="checked" class="slider__nav"/>
                                    <input type="radio" name="slider" title="slide2" class="slider__nav"/>
                                    <input type="radio" name="slider" title="slide3" class="slider__nav"/>
                                    <div class="slider__inner">
                                        <div class="slider__contents">
                                            <div class="line-row">
                                                <a href="http://www.macmillaneducation.com/" target="_blank" class="floating-left slider__image" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/partners/Macmillan.svg)"></a>
                                                <a href="http://dictionary.cambridge.org/" target="_blank" class="floating-left slider__image" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/partners/b.svg)"></a>
                                                <a href="http://www.cengage.co.uk/" target="_blank" class="floating-left slider__image" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/partners/d.svg)"></a>
                                            </div>
                                            <div class="line-row">
                                                <a href=http://corporate.harpercollins.com/us/" target="_blank" class="floating-left slider__image" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/partners/e.svg)"></a>
                                                <a href="http://www.penguin.com/" target="_blank" class="floating-left slider__image" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/partners/n.svg)"></a>
                                                <a href="https://www.iis.edu.jo/default.aspx?lang=en" target="_blank" class="floating-left slider__image" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/partners/iis.jpg)"></a>

                                            </div>
                                        </div>
                                        <div class="slider__contents">
                                            <div class="line-row">
                                                <a href="http://www.hoddereducation.co.uk/" target="_blank" class="floating-left slider__image" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/partners/h.svg)"></a>
                                                <a href="http://www.barrons.com/" target="_blank" class="floating-left slider__image" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/partners/a.svg)"></a>
                                                <a href="http://mycapstonelibrary.com/login/index.html" target="_blank" class="floating-left slider__image" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/partners/c.svg)"></a>
                                            </div>
                                            <div class="line-row">
                                                <a href="http://www.ibid.com.au/" target="_blank" class="floating-left slider__image" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/partners/i.svg)"></a>
                                                <a href="http://www.letterland.com/" target="_blank" class="floating-left slider__image" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/partners/j.svg)"></a>
                                                <a href="http://www.mheducation.com/" target="_blank" class="floating-left slider__image" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/partners/k.svg)"></a>
                                            </div>
                                        </div>
                                        <div class="slider__contents">
                                            <div class="line-row">
                                                <a href="http://www.ldoceonline.com/" target="_blank" class="floating-left slider__image" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/partners/m.svg)"></a>
                                                <a href="http://www.haeseandharris.co.nz/nz/home.asp" target="_blank" class="floating-left slider__image" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/partners/f.svg)"></a>
                                                <a href="http://emea.scholastic.com/en" target="_blank" class="floating-left slider__image" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/partners/o.svg)"></a>
                                            </div>
                                            <div class="line-row">
                                                <a href="http://www.hmhco.com/" target="_blank" class="floating-left slider__image" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/partners/g.svg)"></a>
                                                <a href="http://global.oup.com/?cc=jo" target="_blank" class="floating-left slider__image" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$css_code;?>/images/partners/l.svg)"></a>
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
    </section>
<?php
include "includes/footer.php";
?>