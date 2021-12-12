<?php
$currentTab = "CancelledOrders";
include_once '../includes/breadcrumb.php';
$bredcrumb="<li class='breadcrumb-item'><a href='../index.php'>".$Breadcrumbs->getlang('Dashboard')."</a></li><li class='breadcrumb-item active' aria-current='page'>".$Breadcrumbs->getlang('CancelledOrders')."</li>";
include_once "../includes/header.php";
?>
<form id="manhlform1" class="app-main__inner">
    <div class="col-lg-12 text-center">
        <div class="main-card mb-3 card">
            <div class="card-body ">
                <div class="row">
                    <div class="col-lg-3 float-right">
                        <h5 class="card-title text-left"><?=$prosses->getlang('CancelledOrders');?></h5>
                    </div>
                    <div class="col-lg-4 float-right margin-t-3">
                        <div class="col-lg-3 float-left">
                            <label class="label-withinput text-left float-right"><?=$prosses->getlang('ShippingOrder');?></label>
                        </div>
                        <div class="col-lg-9 float-left">
                            <select class="form-control-sm form-control" onchange="changeshippingorder(this)"  id="shipping_order">
                                <option <?php if($_GET['shipping']==-1){echo 'selected ';}?> value="-1"><?=$prosses->getlang('All');?></option>
                                <option <?php if($_GET['shipping']=='manhal'){echo 'selected ';}?> value="manhal"><?=$prosses->getlang('Manhal');?></option>
                                <option <?php  if($_GET['shipping']=='DHL'){echo 'selected ';}?> value="DHL"><?=$prosses->getlang('DHL');?></option>
                                <option <?php if($_GET['shipping']=='ARAMEX'){echo 'selected ';}?> value="ARAMEX"><?=$prosses->getlang('Aramex');?></option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-4 float-right margin-t-3">
                        <div class="col-lg-3 float-left">
                            <label class="label-withinput text-left float-right"><?=$prosses->getlang('Date');?></label>
                        </div>
                        <div class="col-lg-9 float-left">
                            <input type="text" id="daterange" class=" form-control-sm form-control" name="date"/>
                        </div>
                    </div>
                    <div class="col-lg-1 float-right">
                        <div class="d-inline-block dropdown float-right ml-2 mr-2">
                            <a data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="mb-2 btn  float-right icon-with-color1" title="<?=$prosses->getlang('Print');?>">
                                <i class="metismenu-icon pe-7s-print"></i>
                            </a>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-left append_printins">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="mb-0 table table-hover js-exportable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th><?=$prosses->getlang('OrderID');?></th>
                            <th><?=$prosses->getlang('Custumer');?></th>
                            <th><?=$prosses->getlang('Email');?></th>
                            <th><?=$prosses->getlang('UserPhone');?></th>
                            <th><?=$prosses->getlang('Usercountry');?></th>
                            <th><?=$prosses->getlang('Status');?></th>
                            <th><?=$prosses->getlang('Action');?></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php echo $prosses->GetAllCanceledOrder();?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="text-center d-inline-block m-auto">
            <nav class="" aria-label="Page navigation example justify-content-center align-items-center">
                <ul class="pagination">
                    <?php echo $prosses->Pagination(); ?>
                </ul>
            </nav>
        </div>
    </div>
</form>
<?php
include_once "../includes/footer.php";
?>




