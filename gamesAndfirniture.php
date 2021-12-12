<?php
$currentTab = "gamesAndfirniture";
include_once "platform/config.php";
include_once "includes/function.php";
include_once "platform/includes/function.php";
include_once "includes/header.php";
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/gamesAndfirniture.css<?=$cash;?>">
<div class="inner-pages-main-container-gamesAndfirniture">
    <?= $breadCrumbs; ?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                    <form class="gamesAndfirniture-search" METHOD="GET" id="books_search">
                        <input type="hidden" name="search" value="simple">
                        <div class="right-col-3 floating-left">
                            <div class="books-main-container-page clear-both">
                                <div class="top-black-col">
                                    <div class="floating-left">
                                        <label class="lbl-data-a floating-left"><?= $Lang->Bysubject; ?></label>
                                        <div class="wrapper-demo">
                                            <div id="subject" class="jq_bookdropdown wrapper-dropdown-3" tabindex="2">
                                                <span
                                                    style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-En/images/cat/books/all.svg);"
                                                    class="floating-left"><?= $Lang->All; ?></span>
                                                <ul class="dropdown submit scrollable">
                                                    <input class="hidden_input" type="hidden" name="category"
                                                           value="<?php if(isset($_GET['category'])){ echo $_GET['category'];} ?>" id="hidden_category_book">
                                                    <li class="catli sub-0 no-image" catid="0"><a href="#"><i
                                                                class="icon-truck icon-large"><?= $Lang->All; ?></i></a>
                                                    </li>
                                                    <?php
                                                    $cat_sql = "Select * From  categories WHERE `parent`=0";
                                                    $cat_result = $con->query($cat_sql);
                                                    if (mysqli_num_rows($cat_result) > 0) {
                                                        while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                                                            echo getCategoriesDropDown($cat_row['catid'], "categories");
                                                        }
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                    if (isset($_SESSION["user"]["userid"]) && $_SESSION["user"]["userid"] != "") {

                                    ?>
                                    <div class="floating-left">
                                        <label class="lbl-data-a floating-left"><?= $Lang->favpurch; ?></label>
                                        <div class="wrapper-demo floating-left">
                                            <div id="favpurch" class="wrapper-dropdown-3" tabindex="3">

                                                <span
                                                    class="floating-left"><?php if (!isset($_GET['favpurch_t']) || $_GET['favpurch_t'] == -1 || $_GET['favpurch_t'] == '') {
                                                        echo $Lang->all;
                                                    } elseif (isset($_GET['favpurch_t'])&&$_GET['favpurch_t'] == 0) {
                                                        echo $Lang->Favorites;
                                                    } elseif (isset($_GET['favpurch_t'])&&$_GET['favpurch_t'] == 1) {
                                                        echo $Lang->Purchased;
                                                    } ?></span>
                                                <ul class="dropdown submit scrollable ">
                                                    <input type="hidden" class="hidden_input" name="favpurch_t"
                                                           id="favpurch_t"
                                                           value="<?php if (!isset($_GET['favpurch_t']) || $_GET['favpurch_t'] == -1 || $_GET['favpurch_t'] == '') {
                                                               echo -1;
                                                           } else {
                                                               echo $_GET['favpurch_t'];
                                                           } ?>">
                                                    <li class="catli " catid="-1"><a href="#"><i
                                                                class="icon-truck icon-large"><?= $Lang->all; ?></i></a>
                                                    </li>
                                                    <li <?php if (isset($_GET['favpurch_t'])&&$_GET['favpurch_t'] == 0) {
                                                        echo 'selected';
                                                    } ?> class="catli " catid="0"><a href="#"><i
                                                                class="icon-truck icon-large"><?= $Lang->Favorites; ?></i></a>
                                                    </li>
                                                    <li <?php if (isset($_GET['favpurch_t'])&& $_GET['favpurch_t'] == 1) {
                                                        echo 'selected';
                                                    } ?> class="catli" catid="1"><a href="#"><i
                                                                class="icon-truck icon-large"><?= $Lang->Purchased; ?></i></a>
                                                    </li>

                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <div class="right-search-container floating-right">
                                        <input type="text" class="txt-a floating-left" name="keywords"
                                               placeholder="<?= $Lang->SearchYourItem; ?>"
                                               value="<?php if (isset($_GET['keywords'])) {
                                                   echo $_GET['keywords'];
                                               } ?>">
                                        <input type="submit" class="btn btn-search floating-left" value="">
                                    </div>
                                    <div class="floating-right sort-by-list-container">
                                        <label class="lbl-data-b floating-left"><?= $Lang->SortBy; ?></label>
                                        <div class="wrapper-demo">
                                            <div id="sortby" class="wrapper-dropdown-3" tabindex="1">
                                                <span class="floating-left"><?= $Lang->Sortalphabetically; ?></span>
                                                <ul class="dropdown scrollable">
                                                    <li><a href="#"><i
                                                                class="icon-truck icon-large"></i><?= $Lang->DefaultSorting ?>
                                                        </a></li>
                                                    <li><a href="#"><i
                                                                class="icon-plane icon-large"></i><?= $Lang->Sortalphabetically; ?>
                                                        </a></li>
                                                    <li><a href="#"><i
                                                                class="icon-plane icon-large"></i><?= $Lang->Sortbypopularity; ?>
                                                        </a></li>
                                                    <li><a href="#"><i
                                                                class="icon-plane icon-large"></i><?= $Lang->Sortbyaveragerating; ?>
                                                        </a></li>
                                                    <li><a href="#"><i
                                                                class="icon-plane icon-large"></i><?= $Lang->Sortbynewness; ?>
                                                        </a></li>
                                                    <li><a href="#"><i
                                                                class="icon-plane icon-large"></i><?= $Lang->Sortbypricelowtohigh; ?>
                                                        </a></li>
                                                    <li><a href="#"><i
                                                                class="icon-plane icon-large"></i><?= $Lang->Sortbypricehightolow; ?>
                                                        </a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ui-panels-gamesAndfirniture">
                                    <div class="item-container jq_item_container floating-left">
                                        <div class="inner-item-container">
                                            <div class="display-block top-container">
                                                <div class="rating-container floating-left">
                                                    <div class="number floating-right">(0)</div>
                                                    <div class="stars floating-right">
                                                        <input disabled="" rate="5" prodect="worksheet" bookid="79" class="star star-5" id="star-584413587b83852849c5" type="radio" name="star">
                                                        <label class="msgerrorlogin star star-5" for="star-584413587b83852849c5"></label>
                                                        <input disabled="" rate="4" prodect="worksheet" bookid="79" class="star star-4" id="star-484413587b83852849c5" type="radio" name="star">
                                                        <label class="msgerrorlogin star star-4" for="star-484413587b83852849c5"></label>
                                                        <input disabled="" rate="3" prodect="worksheet" bookid="79" class="star star-3" id="star-384413587b83852849c5" type="radio" name="star">
                                                        <label class="msgerrorlogin star star-3" for="star-384413587b83852849c5"></label>
                                                        <input disabled="" rate="2" prodect="worksheet" bookid="79" class="star star-2" id="star-284413587b83852849c5" type="radio" name="star">
                                                        <label class="msgerrorlogin star star-2" for="star-284413587b83852849c5"></label>
                                                        <input disabled="" rate="1" prodect="worksheet" bookid="79" class="star star-1" id="star-184413587b83852849c5" type="radio" name="star">
                                                        <label class="msgerrorlogin star star-1" for="star-184413587b83852849c5"></label>
                                                    </div>
                                                </div>
                                                <a class="addtofav  floating-left" title="Add to Favorite" floating-left"="" onclick="sendprocess({'TypeProcesses':'settofavorit',id:'79' ,type:'worksheet',random:'84413587b83852849c5'})">
                                                <i class="" id="worksheet79_84413587b83852849c5"></i>
                                                </a>
                                                <a class="download-btn floating-left" bookid="79" href="http://localhost/Manhal/platform/media/79/853a7a6f88a3ac7a4cfdb3fd561d86b2.pdf" target="_blank">
                                                    <i></i>
                                                </a>
                                            </div>
                                            <a class="gamesAndfirniture-thump libro" href="http://localhost/Manhal/en/video/79/Count-and-write-1-5" style="background-image: url(http://localhost/Manhal/platform/media/77/thumbnail_small.png)"></a>
                                            <div class="display-block secound-container">
                                                <div class="title-sub-container clear-both floating-left">
                                                    <div class="floating-left display-inline-block">
                                                        <a class="text-left title" title="Count and write 1-5">Count and write 1-5</a>
                                                        <a class="text-left cat" title="Math">Math</a>
                                                    </div>
                                                </div>
                                                <div class="price floating-right">
                                                    <label>Free</label>
                                                </div>
                                            </div>
                                            <div class="display-block">
                                                <div class="download-view-container">
                                                    <div class="download floating-left">
                                                        <label class="floating-left"></label>
                                                        <span class="floating-left text-left download-view_span79">0</span>
                                                    </div>
                                                    <div class="view floating-left">
                                                        <label class="floating-left"></label>
                                                        <span class="floating-left text-left">29</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="paging">
                                        <div class="content">
                                        <?php
                                        echo $pagination[1];
                                        ?>
                                    </div></div>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(".jq_bookdropdown span").css("background-image", $(".catli.active").children("a").css("background-image"));
    $(".jq_bookdropdown span").html($(".catli.active").find("i").html());
</script>

<?php
include_once "includes/footer.php";
?>

