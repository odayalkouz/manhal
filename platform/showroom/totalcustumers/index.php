<?php
$currentTab = "TotalCustomers";
include_once '../includes/breadcrumb.php';
$bredcrumb="<li class='breadcrumb-item'><a href='../index.php'>".$Breadcrumbs->getlang('Dashboard')."</a></li><li class='breadcrumb-item active' aria-current='page'>".$Breadcrumbs->getlang('TotalCustomers')."</li>";
include_once "../includes/header.php";
?>
<form id="manhlform" class="app-main__inner">
    <div class="col-lg-12 text-center">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="row">
                        <div class="col-lg-8 float-right">
                            <h5 class="card-title text-left"><?=$prosses->getlang('TotalCustomers');?></h5>
                        </div>
                        <div class="col-lg-4 float-right margin-t-3">
                            <div class="col-lg-2 float-left">
                                <label class="label-withinput float-right"><?=$prosses->getlang('Date');?></label>
                            </div>
                            <div class="col-lg-8 float-left">
                                <input type="text" id="daterange" class=" form-control-sm form-control"   name="date"/>
                            </div>
                            <div class="col-lg-2 float-right">
                                <div class="d-inline-block dropdown float-right ml-2 mr-2">
                                    <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="mb-2 btn  float-right icon-with-color1" title="<?=$prosses->getlang('Print');?>">
                                        <i class="metismenu-icon pe-7s-print"></i>
                                    </a>
                                    <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left append_printins"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="table-responsive">
                    <table class="mb-0 table table-hover js-exportable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?=$prosses->getlang('UserId');?></th>
                            <th><?=$prosses->getlang('Username');?></th>
                            <th><?=$prosses->getlang('Email');?></th>
                            <th><?=$prosses->getlang('UserPhone');?></th>
                            <th><?=$prosses->getlang('Usercountry');?></th>
                            <th><?=$prosses->getlang('Number_of_purchases');?></th>
                        </tr>
                        </thead>
                        <tbody>
                            <?php
                            echo $prosses->GetdataCustomers();?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center d-inline-block m-auto">
            <nav class="" aria-label="Page navigation example justify-content-center align-items-center">
                <ul att="manhlform" class="pagination">
                    <?php echo $prosses->Pagination(); ?>
                </ul>
            </nav>
        </div>
    </div>
</form>

<?php
include_once "../includes/footer.php";
?>




