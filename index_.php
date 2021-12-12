<?php
//$cuerrentpage="index.php";
//if(session_status()== PHP_SESSION_NONE)
//{
//    session_start();
//}
//?>
<?php
$currentTab="index";
include "includes/function.php";
include "includes/header.php";
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
                <div class="img-fill">
                    <div class="img" style="background-image:url(themes/main-Light-green-En/images/slider/1.jpg)"></div>
                    <div class="info">
                        <div class="position">
                            <div class="slide1-image1"></div>
                            <div class="slide1-image2"></div>
                            <div class="slide1-image3"></div>
                            <div class="slide1-text1"><a><?=$Lang->Slider1Text1;?></a></div>
                            <div class="slide1-text2"><?=$Lang->Slider1Text2;?></div>
                            <div class="slide1-text3"><a><?=$Lang->Slider1Text3;?></a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="img-fill">
                    <div class="img" style="background-image:url(themes/main-Light-green-En/images/slider/2.jpg)"></div>
                    <div class="info">
                        <div class="position">
                            <div class="slide2-image1-home"></div>
                            <div class="slide2-image1-rectangle">
                                <div class="stars"></div>
                                <div class="text1"><?=$Lang->Slider2Text1;?></div>
                                <div class="text2"><?=$Lang->Slider2Text2;?></div>
                            </div>
                            <div class="slide2-image1-gif"></div>
                            <div class="slide2-image1-mony1"></div>
                            <div class="slide2-image1-mony2"></div>
                            <div class="slide2-image1-mony3"></div>
                            <div class="slide2-image1-mony4"></div>
                            <div class="slide2-image1-mony5"></div>
                            <div class="slide2-image1-mony6"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="img-fill">
                    <div class="img" style="background-image:url(themes/main-Light-green-En/images/slider/3.jpg)"></div>
                    <div class="info">
                        <div class="position">
                            <div class="slide3-text-container">
                                <label class="text1 text-left"><?=$Lang->Slider3Text1;?></label>
                                <label class="text2 text-left"><?=$Lang->Slider3Text2;?></label>
                                <label class="text3 text-left"><?=$Lang->Slider3Text3;?></label>
                            </div>
                            <div class="slide3-image1"></div>
                            <div class="slide3-image2"></div>
                            <div class="slide3-image3"></div>
                            <div class="slide3-image4"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="img-fill">
                    <div class="img" style="background-image:url(themes/main-Light-green-En/images/slider/4.jpg)"></div>
                    <div class="info">
                        <div class="position">
                            <div class="slide4-left-square"></div>
                            <label class="text"><?=$Lang->Slider4Text1;?></label>
                            <div class="slide4-image1"></div>
                            <div class="slide4-image2"></div>
                            <div class="slide4-image3"></div>
                            <div class="slide4-image4"></div>
                            <div class="slide4-image5"></div>
                            <div class="slide4-image6"></div>
                            <div class="slide4-image7"></div>
                            <div class="slide4-image8"></div>
                            <div class="slide4-image9"></div>
                            <div class="slide4-image10"></div>
                            <div class="slide4-image11"></div>
                            <div class="slide4-image12"></div>
                            <div class="slide4-image13"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="img-fill">
                    <div class="img" style="background-image:url(themes/main-Light-green-En/images/slider/5.jpg)"></div>
                    <div class="info">
                        <div class="position">
                            <div class="slide5-image1"></div>
                            <label class="slide5-text1"><?=$Lang->Slider5Text1;?></label>
                            <label class="slide5-text2"><?=$Lang->Slider5Text2;?></label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="item">
                <div class="img-fill">
                    <div class="img" style="background-image:url(themes/main-Light-green-En/images/slider/6.jpg)"></div>
                    <div class="info">
                        <div class="position">
                            <div class="slide6-image1"></div>
                            <label class="slide6-text1"><?=$Lang->Slider6Text1;?></label>
                            <label class="slide6-text2"><?=$Lang->Slider6Text2;?></label>
                            <label class="slide6-text3"><?=$Lang->Slider6Text3;?></label>
                            <label class="slide6-text4"><?=$Lang->Slider6Text4;?></label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-main-container jq-section parallax-container" data-parallax="scroll" data-position="top" speed="1.9" data-bleed="0" data-natural-width="1400" data-natural-height="1000" data-image-src="themes/main-Light-green-En/images/sectionBg/block-binfits.png">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <div class="content-container">
                        <div class="benifits-container">
                            <div class="top-container">
                                <div class="center-piece">
                                    <h1 class="reveal-top"><?=$Lang->Benefits;?></h1>
                                    <p class="reveal-bottom"><?=$Lang->BenefitSsubTitle;?></p>
                                </div>
                            </div>
                            <div class="bottom-container">
                                <div class="center-piece" style="overflow:visible;">
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
                                                    <a class="floating-right" href="benifits.php"><?=$Lang->More;?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <a class="floating-right" href="benifits.php"><?=$Lang->More;?></a>
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
                                                    <a class="floating-right" href="benifits.php"><?=$Lang->More;?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <a class="floating-right" href="benifits.php"><?=$Lang->More;?></a>
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
                                                    <a class="floating-right" href="benifits.php"><?=$Lang->More;?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                                    <a class="floating-right" href="benifits.php"><?=$Lang->More;?></a>
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
    <section class="section-main-container jq-section books-main-container">
        <div class="center-piece">
            <div class="display-table">
                <div class="display-row">
                    <div class="display-cell">
                        <div class="content-container">
                            <div class="section-title reveal-top">
                                <h1>Books</h1>
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
                                    <div class="ui-panels">
                                        <div class="ui-tab1 ">
                                            <?php
                                            getRecentBooks(4);
                                            ?>
                                        </div>
                                        <div class="ui-tab2 ">
                                            <?php
                                            getBestSellerBooks(4);
                                            ?>
                                        </div>
                                        <div class="ui-tab3 ">
                                            <?php
                                            getPopularBooks(4);
                                            ?>
                                        </div>
                                        <div class="ui-tab4 ">
                                            <?php
                                            getTopRatedBooks(4);
                                            ?>
                                        </div>
                                        <div class="ui-tab5 ">
                                            <?php
                                            getTopFavoriteBooks(4);
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
    </section>
    <section class="section-main-container jq-section makemony-main-container" style="background-image: url(themes/main-Light-green-En/images/sectionBg/make-mony-bg.png);background-repeat: no-repeat">
        <div class="left-side-image"></div>
        <div class="center-piece">
            <div class="display-table">
                <div class="display-row">
                    <div class="display-cell">
                        <div class="content-container">
                            <div class="section-title-white-makemony reveal-top">
                                <h1><?=$Lang->MakeMoney;?></h1>
                                <span></span>
                            </div>
                            <div class="right-side-text">
                                <h1 class="reveal-left"><?=$Lang->MakeMoneyTitle1;?></h1>
                                <h3 class="reveal-left"><?=$Lang->MakeMoneyTitle2;?></h3>
                                <p class="reveal-left"><?=$Lang->MakeMoneyParagraph1;?></p>
                                <p class="reveal-left"><?=$Lang->MakeMoneyParagraph2;?></p>
                                <p class="reveal-left"><?=$Lang->MakeMoneyParagraph3;?></p>
                                <p class="reveal-left"><?=$Lang->MakeMoneyParagraph4;?></p>
                                <p class="last-p reveal-left"><?=$Lang->MakeMoneyParagraph5;?></p>
                                <a href="makemony.php" class="button floating-right reveal-left"><?=$Lang->ReadMore;?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-main-container jq-section parallax-container" data-parallax="scroll" data-position="top"
             speed="1.9" data-bleed="0" data-natural-width="1400" data-natural-height="1000"
             data-image-src="themes/main-Light-green-En/images/sectionBg/tab-bg.png">
        <div class="center-piece">
            <div class="display-table">
                <div class="display-row">
                    <div class="display-cell">
                        <div class="content-container">
                            <div class="features-container">
                                <div class="top-container">
                                    <h1 class="reveal"><?=$Lang->FeaturesTitle;?></h1>
                                    <p class="reveal"><?=$Lang->FeaturesParagraph;?></p>
                                </div>
                                <div class="bottom-container">
                                    <div class="item-container reveal">
                                        <div class="left floating-left">
                                            <a>
                                                <label class="icon-bg-a"></label>
                                                <span></span>
                                            </a>
                                        </div>
                                        <div class="right floating-left ">
                                            <h3><?=$Lang->CrossPlatform;?></h3>
                                            <p><?=$Lang->CrossPlatformDesc;?></p>
                                            <a class="floating-right" href="features.php"><?=$Lang->ReadMore;?></a>
                                        </div>
                                    </div>
                                    <div class="item-container reveal">
                                        <div class="left floating-left">
                                            <a>
                                                <label class="icon-bg-b"></label>
                                                <span></span>
                                            </a>
                                        </div>
                                        <div class="right floating-left">
                                            <h3><?=$Lang->ReadingOnline;?></h3>
                                            <p><?=$Lang->ReadingOnlineDesc;?></p>
                                            <a class="floating-right" href="features.php"><?=$Lang->ReadMore;?></a>
                                        </div>
                                    </div>
                                    <div class="item-container reveal">
                                        <div class="left floating-left">
                                            <a>
                                                <label class="icon-bg-c"></label>
                                                <span></span>
                                            </a>
                                        </div>
                                        <div class="right floating-left">
                                            <h3><?=$Lang->EShop;?></h3>
                                            <p><?=$Lang->EShopDesc;?></p>
                                            <a class="floating-right" href="features.php"><?=$Lang->ReadMore;?></a>
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
    <section class="section-main-container jq-section stories-main-container" style="background-image: url(themes/main-Light-green-En/images/sectionBg/story-bg.png);background-repeat: no-repeat">
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
                                    <h1 class="reveal-top">Stories</h1>
                                    <p class="reveal-left"><?=$Lang->storyIntro1;?></p>
                                    <p class="reveal-left"><?=$Lang->storyIntro2;?></p>
                                    <p class="reveal-left"><?=$Lang->storyIntro3;?></p>
                                    <a href="stories.php" class="button floating-left reveal-bottom">MORE  ALL PRODUCTS</a>
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
                                        <label class="ui-tab4 toprated" title="<?=$Lang->TopRated;?>" for="tgroup_c12_tab4"></label>
                                        <label class="ui-tab5 topfavorite" title="<?=$Lang->TopFavorite;?>" for="tgroup_c12_tab5"></label>
                                    </div>
                                    <div class="ui-panels">
                                        <div class="ui-tab1 reveal-left">
                                            <?=getRecentStories(4);?>
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
    <section class="section-main-container jq-section whatweoffer-main-container" style="background-image: url(themes/main-Light-green-En/images/sectionBg/whatoffer-bg.png);background-repeat: no-repeat">
        <div class="center-piece">
            <div class="display-table">
                <div class="display-row">
                    <div class="display-cell">
                        <div class="content-container">
                            <div class="section-title reveal-top">
                                <h1><?=$Lang->Whatweoffer;?></h1>
                                <span></span>
                            </div>
                            <div class="left-container floating-left reveal-zoom"></div>
                            <div class="right-container floating-left">
                                <div class="top-side reveal-left">
                                    <p><?=$Lang->WhatweofferParagraph1;?></p>
                                    <p><?=$Lang->WhatweofferParagraph2;?></p>
                                </div>
                                <div class="center-side">
                                    <nav>
                                        <li class="floating-left reveal-right"><span class="floating-left"></span><a href="whatweoffer.php" class="floating-left"><?=$Lang->Schools;?></a></li>
                                        <li class="floating-left reveal-right"><span class="floating-left"></span><a href="whatweoffer.php" class="floating-left"><?=$Lang->Families;?></a></li>
                                        <li class="floating-left reveal-right"><span class="floating-left"></span><a href="whatweoffer.php" class="floating-left"><?=$Lang->Publishers;?></a></li>
                                        <li class="floating-left reveal-right"><span class="floating-left"></span><a href="whatweoffer.php" class="floating-left"><?=$Lang->Authors;?></a></li>
                                        <li class="floating-left reveal-right"><span class="floating-left"></span><a href="whatweoffer.php" class="floating-left"><?=$Lang->IpadandMobileApps;?></a></li>
                                    </nav>
                                </div>
                                <div class="bottom-side">
                                    <label class="floating-left reveal-left"><?=$Lang->WhatweofferParagraph3;?></label>
<!--                                    <a href="whatweoffer.php" class="button floating-right reveal-right">Read More</a>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-main-container jq-section" data-parallax="scroll" data-position="top" speed="1.9" data-bleed="0" data-natural-width="1400" data-natural-height="1000" data-image-src="themes/main-Light-green-En/images/sectionBg/statistics-bg.png">
        <?php
        $sql = "Select   Count(users.userid) As user,  SubQuery.book,  SubQuery1.series,  SubQuery2.story From   users,  (Select     Count(books.bookid) As book   From     books) As SubQuery,  (Select     Count(series.seriesid) As series   From     series) As SubQuery1,  (Select     Count(story.storyid) As story   From     story) As SubQuery2" ;
        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0)
        {
            $row = mysqli_fetch_assoc($result);
        }
        ?>
        <div class="center-piece">
            <div class="display-table">
                <div class="display-row">
                    <div class="display-cell">
                        <div class="content-container statistics-container">
                            <div class="item-container reveal-left">
                                <div class="top-container">
                                    <div class="line"></div>
                                    <div class="circle"><label></label></div>
                                </div>
                                <div class="bottom-container">
                                    <label class="title"><?=$Lang->Users;?></label>
                                    <label class="number"><?=$row['user'];?></label>
                                </div>
                            </div>
                            <div class="item-container reveal-left">
                                <div class="top-container">
                                    <div class="line"></div>
                                    <div class="circle"><label></label></div>
                                </div>
                                <div class="bottom-container">
                                    <label class="title"><?=$Lang->Books;?></label>
                                    <label class="number"><?=$row['book'];?></label>
                                </div>
                            </div>
                            <div class="item-container reveal-right">
                                <div class="top-container">
                                    <div class="line"></div>
                                    <div class="circle"><label></label></div>
                                </div>
                                <div class="bottom-container">
                                    <label class="title"><?=$Lang->Series;?></label>
                                    <label class="number"><?=$row['series'];?></label>
                                </div>
                            </div>
                            <div class="item-container reveal-right">
                                <div class="top-container">
                                    <div class="line"></div>
                                    <div class="circle"><label></label></div>
                                </div>
                                <div class="bottom-container">
                                    <label class="title"><?=$Lang->Stories;?></label>
                                    <label class="number"><?=$row['story'];?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <section class="section-main-container jq-section" style="background-image:url(themes/main-Light-green-En/images/sectionBg/apps-bg.png);">
        <div class="center-piece">
            <div class="display-table">
                <div class="display-row">
                    <div class="display-cell">
                        <div class="content-container our-apps-container">
                            <div class="section-title reveal-top">
                                <h1><?=$Lang->Application;?></h1>
                                <span></span>
                            </div>
                            <div id="bannerBg">
                                <div id="containingDiv">
                                    <div id="allinone_carousel_sweet">
                                        <div class="myloader"></div>
                                        <!-- CONTENT -->
                                        <ul class="allinone_carousel_list">
                                            <li data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit"
                                                data-bottom-thumb="themes/main-Light-green-En/images/appslider/1.jpg">
                                                <img src="themes/main-Light-green-En/images/appslider/1.jpg" alt=""/>
                                            </li>
                                            <li data-title="Curabitur at enim a sem posuere consequat vel in lectus"
                                                data-bottom-thumb="themes/main-Light-green-En/images/appslider/2.jpg">
                                                <img src="themes/main-Light-green-En/images/appslider/2.jpg" alt=""/>
                                            </li>
                                            <l data-target="_blank"
                                               data-title="Donec sagittis nisi nec ante molestie lobortis"
                                               data-bottom-thumb="themes/main-Light-green-En/images/appslider/3.jpg">
                                                <img src="themes/main-Light-green-En/images/appslider/3.jpg" alt=""/>
                                            </l>
                                            <li data-title="Cras pellentesque fermentum pellentesque"
                                                data-bottom-thumb="themes/main-Light-green-En/images/appslider/4.jpg">
                                                <img src="themes/main-Light-green-En/images/appslider/4.jpg" alt=""/>
                                            </li>
                                            <li data-title="Nunc fringilla sapien id arcu mattis pulvinar"
                                                data-bottom-thumb="themes/main-Light-green-En/images/appslider/1.jpg">
                                                <img src="themes/main-Light-green-En/images/appslider/1.jpg" alt=""/>
                                            </li>
                                            <li data-title="Lorem ipsum dolor sit amet, consectetur adipiscing elit"
                                                data-bottom-thumb="themes/main-Light-green-En/images/appslider/1.jpg">
                                                <img src="themes/main-Light-green-En/images/appslider/1.jpg" alt=""/>
                                            </li>
                                            <li data-title="Curabitur at enim a sem posuere consequat vel in lectus"
                                                data-bottom-thumb="themes/main-Light-green-En/images/appslider/2.jpg">
                                                <img src="themes/main-Light-green-En/images/appslider/2.jpg" alt=""/>
                                            </li>
                                            <li data-target="_blank"
                                                data-title="Donec sagittis nisi nec ante molestie lobortis"
                                                data-bottom-thumb="themes/main-Light-green-En/images/appslider/3.jpg">
                                                <img src="themes/main-Light-green-En/images/appslider/3.jpg" alt=""/>
                                            </li>
                                            <li data-title="Cras pellentesque fermentum pellentesque"
                                                data-bottom-thumb="themes/main-Light-green-En/images/appslider/4.jpg">
                                                <img src="themes/main-Light-green-En/images/appslider/4.jpg" alt=""/>
                                            </li>
                                            <li data-title="Nunc fringilla sapien id arcu mattis pulvinar"
                                                data-bottom-thumb="themes/main-Light-green-En/images/appslider/1.jpg">
                                                <img src="themes/main-Light-green-En/images/appslider/1.jpg" alt=""/>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <p class="reveal-left"><?=$Lang->applicationParagraph;?></p>
                            <a href="applications.php" class="button reveal-right"><?=$Lang->MOREALLPRODUCTS;?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-main-container jq-section news-main-container" data-parallax="scroll" data-position="top" speed="1.9" data-bleed="0" data-natural-width="1400" data-natural-height="1000" data-image-src="themes/main-Light-green-En/images/sectionBg/our-news-bg.png">
        <div class="center-piece">
            <div class="display-table">
                <div class="display-row">
                    <div class="display-cell">
                        <div class="content-container">
                            <div class="section-title-white-news reveal-top">
                                <h1><?=$Lang->OurNews;?></h1>
                                <span></span>
                            </div>
                            <div class="paragraph reveal-top"><?=$Lang->OurNewsParagraph;?></div>
                            <div class="things-container">
                                <div class="year-box reveal-top">
                                    <?=$Lang->newsyear;?>
                                </div>
                                <div class="left-container floating-left">
                                    <div class="row-container left first-row reveal-left">
                                        <div class="rectangle floating-left">
                                            <div class="square floating-left">
                                                <a>
                                                    <label><?=$Lang->firstday;?></label>
                                                    <span><?=$Lang->firstMonth;?></span>
                                                </a>
                                            </div>
                                            <div class="right">
                                                <a><?=$Lang->firstTitle;?></a>
                                                <p><?=$Lang->firstDesc;?></p>
                                            </div>
                                        </div>
                                        <div class="line floating-left"></div>
                                        <div class="circle floating-left"></div>
                                    </div>
                                    <div class="row-container left third-row reveal-left">
                                        <div class="rectangle floating-left">
                                            <div class="square floating-left">
                                                <a>
                                                    <label><?=$Lang->thirdday;?></label>
                                                    <span><?=$Lang->thirdMonth;?></span>
                                                </a>
                                            </div>
                                            <div class="right">
                                                <a><?=$Lang->thirdTitle;?></a>
                                                <p><?=$Lang->thirdDesc;?></p>
                                            </div>
                                        </div>
                                        <div class="line floating-left"></div>
                                        <div class="circle floating-left"></div>
                                    </div>
                                </div>
                                <div class="center-container floating-left"></div>
                                <div class="right-container floating-left">
                                    <div class="row-container right scound-row reveal-right">
                                        <div class="rectangle floating-right">
                                            <div class="square floating-left">
                                                <a>
                                                    <label><?=$Lang->secoundday;?></label>
                                                    <span><?=$Lang->secoundMonth;?></span>
                                                </a>
                                            </div>
                                            <div class="right">
                                                <a><?=$Lang->secoundTitle;?></a>
                                                <p><?=$Lang->secoundDesc;?></p>
                                            </div>
                                        </div>
                                        <div class="line floating-right"></div>
                                        <div class="circle floating-right"></div>
                                    </div>
                                    <a class="button reveal-top" href="news.php" ><?=$Lang->ViewMoreNews;?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-main-container jq-section editor-main-container">
        <div class="content-container">
            <div class="top-container">
                <div class="center-piece" style="overflow: visible">
                    <div class="display-table" style="overflow: visible">
                        <div class="display-row" style="overflow: visible">
                            <div class="display-cell" style="overflow: visible">
                                <div class="left-container floating-left">
                                    <div class="image reveal-left"></div>
                                </div>
                                <div class="right-container floating-left">
                                    <div class="top-side">
                                        <h1 class="reveal-top"><?=$Lang->Editors;?></h1>
                                        <p class="reveal-top"><?=$Lang->EditorsParagraph;?></p>
                                    </div>
                                    <div class="bottom-side">
                                        <a class="item-container floating-left reveal-left">
                                            <div class="image img-a floating-left reveal-rotate"></div>
                                            <div class="right-side floating-left">
                                                <h3><?=$Lang->Addingcontent;?></h3>
                                                <label><?=$Lang->isfastandeasy;?></label>
                                            </div>
                                        </a>
                                        <a class="item-container floating-left reveal-left">
                                            <div class="image img-b floating-left reveal-rotate"></div>
                                            <div class="right-side floating-left">
                                                <h3><?=$Lang->Draganddrop;?></h3>
                                                <label><?=$Lang->editors ;?></label>
                                            </div>
                                        </a>
                                        <a class="item-container floating-left reveal-left">
                                            <div class="image img-c floating-left reveal-rotate"></div>
                                            <div class="right-side floating-left">
                                                <h3><?=$Lang->Optimizedfor;?></h3>
                                                <label><?=$Lang->everyplatform;?></label>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bottom-container" style="background: url(themes/main-Light-green-En/images/editor/bottom-bg.png) no-repeat;">
                <div class="center-piece">
                    <div class="display-table">
                        <div class="display-row">
                            <div class="display-cell">
                                <a class="item-container reveal-right">
                                    <div class="image-container image-a"></div>
                                    <label>Isometric Perspective Mock-Up</label>
                                </a>
                                <a class="item-container reveal-right">
                                    <div class="image-container image-a"></div>
                                    <label>Isometric Perspective Mock-Up</label>
                                </a>
                                <a class="item-container reveal-right">
                                    <div class="image-container image-a"></div>
                                    <label>Isometric Perspective Mock-Up</label>
                                </a>
                                <a  href="editors.php" class="button reveal-bottom">MORE  ALL PRODUCTS</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section-main-container jq-section" data-parallax="scroll" data-position="top" speed="1.9" data-bleed="0" data-natural-width="1400" data-natural-height="1000" data-image-src="themes/main-Light-green-En/images/sectionBg/our-clients.png">
        <div class="center-piece">
            <div class="display-table">
                <div class="display-row">
                    <div class="display-cell">
                        <div class="content-container">
                            <div class="section-title-white reveal-top">
                                <h1>What Clients Say?</h1>
                                <span></span>
                            </div>
                            <div class="content">
                                <div class="slider single-item reveal-bottom">
                                    <div class="quote-container">
                                        <div class="portrait"><img src="themes/main-Light-green-En/images/avater.png" alt=""/></div>
                                        <div class="quote">
                                            <span>Bespoke occupy cred seitan. Austin street art freegan Truffaut leggings aesthetic, salvia chia Brooklyn flexitarian. Single-origin coffee before they sold out health goth, cornhole irony keffiyeh Austin taxidermy mlkshk blog trust fund banh mi you probably haven't heard of them.</span>
                                        </div>
                                    </div>
                                    <div class="quote-container">
                                        <div class="portrait"><img src="themes/main-Light-green-En/images/avater.png" alt=""/></div>
                                        <div class="quote">
                                            <span>Bespoke occupy cred seitan. Austin street art freegan Truffaut leggings aesthetic, salvia chia Brooklyn flexitarian. Single-origin coffee before they sold out health goth, cornhole irony keffiyeh Austin taxidermy mlkshk blog trust fund banh mi you probably haven't heard of them.</span>
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
    <section class="section-main-container jq-section our-partner-container" data-parallax="scroll" data-position="top" speed="1.9" data-bleed="0" data-natural-width="1400" data-natural-height="1000" data-image-src="themes/main-Light-green-En/images/sectionBg/partner-bg.png">
        <div class="center-piece">
            <div class="display-table">
                <div class="display-row">
                    <div class="display-cell">
                        <div class="content-container">
                            <div class="left-container floating-left">
                                <div class="section-title-left floating-left reveal-left">
                                    <h1><?=$Lang->OurPartners;?></h1>
                                    <span></span>
                                </div>
                                <p class="clear-both text-left reveal-left"><?=$Lang->OurPartnersParagraph;?></p>
                                <a href="ourpartners.php" class="button floating-left reveal-left"><?=$Lang->ViewAll;?></a>
                            </div>
                            <div class="right-container floating-left reveal-right">
                                <div class="slider">
                                    <input type="radio" name="slider" title="slide1" checked="checked" class="slider__nav"/>
                                    <input type="radio" name="slider" title="slide2" class="slider__nav"/>
                                    <input type="radio" name="slider" title="slide3" class="slider__nav"/>
                                    <input type="radio" name="slider" title="slide4" class="slider__nav"/>
                                    <div class="slider__inner">
                                        <div class="slider__contents">
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/a.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/b.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/c.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/a.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/b.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/c.png)no-repeat"></div>
                                        </div>
                                        <div class="slider__contents">
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/a.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/b.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/c.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/a.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/b.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/c.png)no-repeat"></div>
                                        </div>
                                        <div class="slider__contents">
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/a.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/b.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/c.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/a.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/b.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/c.png)no-repeat"></div>
                                        </div>
                                        <div class="slider__contents">
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/a.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/b.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/c.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/a.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/b.png)no-repeat"></div>
                                            <div class="floating-left slider__image" style="background: url(themes/main-Light-green-En/images/partner-logos/c.png)no-repeat"></div>
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