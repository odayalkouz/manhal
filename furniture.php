<?php
$currentTab = "furniture";
include_once "platform/config.php";
include_once "includes/function.php";
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
                    <form class="books-search" METHOD="GET" id="books_search">
                        <input type="hidden" name="search" value="simple">
                        <div class="right-col-3 floating-left">
                            <div class="books-main-container-page clear-both">
                                <div class="top-black-col">
                                    <div class="floating-left">
                                        <label class="lbl-data-a floating-left"><?= $Lang->Bysubject;?></label>
                                        <div class="wrapper-demo">
                                            <div id="subject" class="jq_bookdropdown wrapper-dropdown-3" tabindex="2">
                                                <span style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-En/images/cat/books/all.svg);" class="floating-left"><?= $Lang->All; ?></span>
                                                <ul class="dropdown submit scrollable">
                                                    <input class="hidden_input" type="hidden" name="category" value="0" id="hidden_category_book">
                                                    <li class="catli sub-0 no-image" catid="0"><a href="#"><i class="icon-truck icon-large"><?= $Lang->All; ?></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <label class="floating-left lbl-data-furniture"><?= $Lang->company;?></label>
                                        <div class="wrapper-demo">
                                            <div id="subject" class="jq_bookdropdown wrapper-dropdown-3" tabindex="2">
                                                <span style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-En/images/cat/books/all.svg);" class="floating-left"><?= $Lang->All1; ?></span>
                                                <ul class="dropdown submit scrollable">
                                                    <input class="hidden_input" type="hidden" name="category" value="0" id="hidden_category_book">
                                                    <li class="catli sub-0 no-image" catid="0"><a href="#"><i class="icon-truck icon-large"><?= $Lang->All1; ?></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="right-search-container floating-right">
                                        <input type="text" class="txt-a floating-left" name="keywords"
                                               placeholder="<?= $Lang->SearchYourItem; ?>"
                                               value="<?php if (isset($_GET['keywords'])) {
                                                   echo $_GET['keywords'];
                                               } ?>">
                                        <input type="submit" class="btn btn-search floating-left" value="" title="<?= $Lang->search;?>">
                                    </div>
                                    <div class="floating-right sort-by-list-container">
                                        <label class="lbl-data-b floating-left"><?= $Lang->SortBy;?></label>
                                        <div class="wrapper-demo">
                                            <div id="sortby" class="wrapper-dropdown-3" tabindex="1">
                                                <span class="floating-left"><?= $Lang->Sortalphabetically;?></span>
                                                <ul class="dropdown scrollable">
                                                    <li><a href="#"><i class="icon-truck icon-large"></i><?= $Lang->DefaultSorting?></a></li>
                                                    <li><a href="#"><i class="icon-plane icon-large"></i><?= $Lang->Sortalphabetically;?></a></li>
                                                    <li><a href="#"><i class="icon-plane icon-large"></i><?= $Lang->Sortbypopularity;?></a></li>
                                                    <li><a href="#"><i class="icon-plane icon-large"></i><?= $Lang->Sortbyaveragerating;?></a></li>
                                                    <li><a href="#"><i class="icon-plane icon-large"></i><?= $Lang->Sortbynewness;?></a></li>
                                                    <li><a href="#"><i class="icon-plane icon-large"></i><?= $Lang->Sortbypricelowtohigh;?></a></li>
                                                    <li><a href="#"><i class="icon-plane icon-large"></i><?= $Lang->Sortbypricehightolow;?></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ui-panels">
                                    <div class="item-container jq_item_container book book-a floating-left reveal-bottom reveal_visible">
                                        <div class="book-container book-container-a">
                                            <div class="media-thump-container game" style="background-image: url(https://www.manhal.com/platform/media/186/thumbnail_small.jpg)">
                                                <a class="media-thump libro" href="http://localhost/manhal/en/furniture/93/واحة-الإيمان-المستوى-الأول"></a>
                                                <div class="bottom-thump"></div>
                                            </div>
                                        </div>
                                        <div class="title-sub-container clear-both">
                                            <a href="http://localhost/manhal/en/furniture/93/واحة-الإيمان-المستوى-الأول" class="text-left title" style="direction:rtl;" title="واحة الإيمان المستوى الأول">واحة الإيمان المستوى الأول</a>
                                            <a href="http://localhost/manhal/en/furniture/93/واحة-الإيمان-المستوى-الأول" class="text-left cat" title="Islamic"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Islamic</label></a>
                                            <div class="floating-right display-inline-block ">
                                                <div class="right floating-right"><div class="display-inline-block"><span class="floating-right">3.95</span><span class="floating-right">$</span></div></div>
                                            </div><div class="floating-right display-inline-block split"> - </div>
                                            <div class="floating-right display-inline-block old-price">
                                                <div class="right floating-right"><div class="display-inline-block"><span class="floating-right">4.4</span><span class="floating-right">$</span></div></div>
                                            </div>  </div>
                                        <div class="bottom-container">
                                            <div class="center floating-left">
                                                <div class="rating-container floating-left">
                                                    <div class="number floating-right">(4)</div>
                                                    <div class="stars floating-right">

                                                        <input disabled="" prodect="book" rate="5" bookid="93" class=" star star-5" id="star-5-806945a3bae4187dd54" type="radio" name="star">
                                                        <label class="msgerrorlogin star star-5" for="star-5-806945a3bae4187dd54"></label>
                                                        <input disabled="" prodect="book" rate="4" bookid="93" class="star star-4" id="star-4-806945a3bae4187dd54" type="radio" name="star">
                                                        <label class="msgerrorlogin star star-4" for="star-4-806945a3bae4187dd54"></label>
                                                        <input disabled="" prodect="book" rate="3" bookid="93" class="star star-3" id="star-3-806945a3bae4187dd54" type="radio" name="star">
                                                        <label class="msgerrorlogin star star-3" for="star-3-806945a3bae4187dd54"></label>
                                                        <input disabled="" prodect="book" rate="2" bookid="93" checked="" class="star star-2" id="star-2-806945a3bae4187dd54" type="radio" name="star">
                                                        <label class="star star-2" for="star-2-806945a3bae4187dd54"></label>
                                                        <input disabled="" prodect="book" rate="1" bookid="93" class="star star-1" id="star-1-806945a3bae4187dd54" type="radio" name="star">
                                                        <label class="msgerrorlogin star star-1" for="star-1-806945a3bae4187dd54"></label>

                                                    </div>
                                                </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                <div class="hover-container floating-right">
                                                    <div class="buttons-container floating-left">
                                                        <a class="buy book_addtocart floating-left" booktype="1" price="3.95" bookid="93"></a>
                                                    </div>
                                                    <div class="view-container floating-right">
                                                        <a href="http://localhost/manhal/en/furniture/93/واحة-الإيمان-المستوى-الأول" title="Views" class="view-icon floating-left"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="item-container-ar jq_item_container book book-a floating-left reveal-bottom reveal_visible">
                                        <div class="book-container book-container-a">
                                            <div class="media-thump-container game" style="background-image: url(https://www.manhal.com/platform/media/186/thumbnail_small.jpg)">
                                                <a class="media-thump libro" href="http://localhost/manhal/en/furniture/93/واحة-الإيمان-المستوى-الأول"></a>
                                                <div class="bottom-thump"></div>
                                            </div>
                                        </div>
                                        <div class="title-sub-container clear-both">
                                            <a href="http://localhost/manhal/en/furniture/93/واحة-الإيمان-المستوى-الأول" class="text-left title" style="direction:rtl;" title="واحة الإيمان المستوى الأول">واحة الإيمان المستوى الأول</a>
                                            <a href="http://localhost/manhal/en/furniture/93/واحة-الإيمان-المستوى-الأول" class="text-left cat" title="Islamic"><label class="floating-left">Book</label><label class="floating-left">/</label><label class="floating-left">Islamic</label></a>
                                            <div class="floating-right display-inline-block ">
                                                <div class="right floating-right"><div class="display-inline-block"><span class="floating-right">3.95</span><span class="floating-right">$</span></div></div>
                                            </div><div class="floating-right display-inline-block split"> - </div>
                                            <div class="floating-right display-inline-block old-price">
                                                <div class="right floating-right"><div class="display-inline-block"><span class="floating-right">4.4</span><span class="floating-right">$</span></div></div>
                                            </div>  </div>
                                        <div class="bottom-container">
                                            <div class="center floating-left">
                                                <div class="rating-container floating-left">
                                                    <div class="number floating-right">(4)</div>
                                                    <div class="stars floating-right">

                                                        <input disabled="" prodect="book" rate="5" bookid="93" class=" star star-5" id="star-5-806945a3bae4187dd54" type="radio" name="star">
                                                        <label class="msgerrorlogin star star-5" for="star-5-806945a3bae4187dd54"></label>
                                                        <input disabled="" prodect="book" rate="4" bookid="93" class="star star-4" id="star-4-806945a3bae4187dd54" type="radio" name="star">
                                                        <label class="msgerrorlogin star star-4" for="star-4-806945a3bae4187dd54"></label>
                                                        <input disabled="" prodect="book" rate="3" bookid="93" class="star star-3" id="star-3-806945a3bae4187dd54" type="radio" name="star">
                                                        <label class="msgerrorlogin star star-3" for="star-3-806945a3bae4187dd54"></label>
                                                        <input disabled="" prodect="book" rate="2" bookid="93" checked="" class="star star-2" id="star-2-806945a3bae4187dd54" type="radio" name="star">
                                                        <label class="star star-2" for="star-2-806945a3bae4187dd54"></label>
                                                        <input disabled="" prodect="book" rate="1" bookid="93" class="star star-1" id="star-1-806945a3bae4187dd54" type="radio" name="star">
                                                        <label class="msgerrorlogin star star-1" for="star-1-806945a3bae4187dd54"></label>

                                                    </div>
                                                </div><div class="addtofav floating-left text-left flag-Arabic"></div>
                                                <div class="hover-container floating-right">
                                                    <div class="buttons-container floating-left">
                                                        <a class="buy book_addtocart floating-left" booktype="1" price="3.95" bookid="93"></a>
                                                    </div>
                                                    <div class="view-container floating-right">
                                                        <a href="http://localhost/manhal/en/furniture/93/واحة-الإيمان-المستوى-الأول" title="Views" class="view-icon floating-left"></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="paging">
                                <div class="content">
<!--                                    --><?php
//                                    echo $pagination[1];
//                                    ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".jq_bookdropdown span").css("background-image",$(".catli.active").children("a").css("background-image"));
    $(".jq_bookdropdown span").html($(".catli.active").find("i").html());
</script>

<?php
include_once "includes/footer.php";
?>

