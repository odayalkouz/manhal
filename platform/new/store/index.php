<?php
$currentTab = "Store";

include_once "../includes/header.php";
?>
<div class="app-main__inner">
    <div class="col-lg-12 text-center">
        <div class="main-card mb-3 card">
            <div class="card-body ">
                <div class="row">
                    <a href="<?=$URL;?>/store/department/index.php" class="col-md-6 col-xl-3 item-anchor">
                        <div class="card mb-3 widget-content bg-midnight-bloom">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Department</div>
                                    <div class="widget-subheading">description description description </div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="<?=$URL;?>/store/report/index.php" class="col-md-6 col-xl-3 item-anchor">
                        <div class="card mb-3 widget-content bg-arielle-smile">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Report</div>
                                    <div class="widget-subheading">description description description</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="<?=$URL;?>/store/category/index.php" class="col-md-6 col-xl-3 item-anchor">
                        <div class="card mb-3 widget-content bg-grow-early">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Category</div>
                                    <div class="widget-subheading">description description description</div>
                                </div>
                            </div>
                        </div>
                    </a>
                    <a href="<?=$URL;?>/store/brand/index.php" class="col-md-6 col-xl-3 item-anchor">
                        <div class="card mb-3 widget-content bg-midnight-bloom">
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading">Brand</div>
                                    <div class="widget-subheading">description description description</div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "../includes/footer.php";
?>




