<?php
$show_filters_option = true;
$URL = $_SERVER['DOCUMENT_ROOT'].'/manhal/medialibrary';
include_once $URL."/includes/header.php";

?>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <div class="row result-row-container category-filters-addition" id="tabs-category-addition-filter">
            <div id="buttonfilterindex" class="nav flex-row justify-content-start w-100">
                <?php echo $prosses->GetCatFilterDrow(); ?>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 pull-right" style="display: none;">
        <div class="tile-list-container pull-right">
            <a class="tile"><span class="lnr lnr-dice"></span></a>
            <a class="list active"><span class="lnr lnr-list"></span></a>
        </div>
        <?php

        if($prosses->CanEdit()==='true'){
            ?>
        <a href="editmedia.php" class="btn shadow-none btn-primary pull-right" title="Add Media">Add Media</a>
        <?php } ?>
    </div>

    <div class="panel panel-headline" style="clear: both">
        <div class="panel-body" >
            <div class="row">

                <?php echo $prosses->GetMedia(); ?>

                <div class="text-center d-inline-block m-auto">
                    <nav class="" aria-label="Page navigation example justify-content-center align-items-center">
                        <ul class="pagination">
                            <?php echo $prosses->Pagination(); ?>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>
    </div>

<?php
include_once "includes/footer.php";
?>