<?php
$currentTab = "Dashboard";
include_once 'includes/breadcrumb.php';
$bredcrumb="<li class='breadcrumb-item active' aria-current='page'>".$Breadcrumbs->getlang('Dashboard')."</li>";
include_once "includes/header.php";
?>
<div class="app-main__inner">
    <div class="col-lg-12 text-center">
        <div class="row">
            <a href="<?=$prosses->URL;?>/totalcustumers/index.php" class="col-md-6 col-xl-4 item-anchor">
                <div class="card mb-3 widget-content bg-heavy-rain">
                    <div class="font-icon-wrapper font-icon-lg"><i class="pe-7s-users text-white"></i></div>
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading"><?=$prosses->getlang('TotalCustomers');?></div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span class="float-left">#</span><span class="float-left"><?=$prosses->GetDashboardStatistic('totlalCustomer');?></span></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?=$prosses->URL;?>/totalsubscriptions/index.php" class="col-md-6 col-xl-4 item-anchor">
                <div class="card mb-3 widget-content bg-tempting-azure1">
                    <div class="font-icon-wrapper font-icon-lg"><i class="pe-7s-shopbag text-white"></i></div>
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading"><?=$prosses->getlang('totalsubscriptions');?></div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span class="float-left">$</span><span class="float-left"><?=$prosses->GetDashboardStatistic('totalsubscription');?></span></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?=$prosses->URL;?>/completed/index.php" class="col-md-6 col-xl-4 item-anchor">
                <div class="card mb-3 widget-content bg-tempting-azure">
                    <div class="font-icon-wrapper font-icon-lg"><i class="pe-7s-check text-white"></i></div>
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading"><?=$prosses->getlang('TotalBookingscompleted');?></div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span class="float-left">#</span><span class="float-left"><?=$prosses->GetDashboardStatistic('TotalBookingscompleted');?></span></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?=$prosses->URL;?>/cancelled/index.php" class="col-md-6 col-xl-4 item-anchor">
                <div class="card mb-3 widget-content  bg-warm-flame">
                    <div class="font-icon-wrapper font-icon-lg"><i class="pe-7s-close-circle text-white"></i></div>
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading"><?=$prosses->getlang('Numberofcanceledrequests');?></div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span class="float-left">#</span><span class="float-left"><?=$prosses->GetDashboardStatistic('Numberofcanceledrequests');?></span></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?=$prosses->URL;?>/inprogress/index.php" class="col-md-6 col-xl-4 item-anchor">
                <div class="card mb-3 widget-content bg-mean-fruit">
                    <div class="font-icon-wrapper font-icon-lg"><i class="pe-7s-hourglass text-white"></i></div>
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading"><?=$prosses->getlang('TotalOrdersinprogress');?></div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span class="float-left">#</span><span class="float-left"><?=$prosses->GetDashboardStatistic('TotalOrdersinprogress');?></span></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?=$prosses->URL;?>/inshipping/index.php" class="col-md-6 col-xl-4 item-anchor">
                <div class="card mb-3 widget-content bg-vicious-stance">
                    <div class="font-icon-wrapper font-icon-lg"><i class="pe-7s-cart text-white"></i></div>
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading"><?=$prosses->getlang('Inshippingorders');?></div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span class="float-left">#</span><span class="float-left"><?=$prosses->GetDashboardStatistic('Inshippingorders');?></span></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?=$prosses->URL;?>/totalsales/index.php" class="col-md-6 col-xl-4 item-anchor">
                <div class="card mb-3 widget-content bg-malibu-beach">
                    <div class="font-icon-wrapper font-icon-lg"><i class="pe-7s-cash text-white"></i></div>
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading"><?=$prosses->getlang('totalsales');?></div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span class="float-left">$</span><span class="float-left"><?=$prosses->GetDashboardStatistic('Totalsales');?></span></div>
                        </div>
                    </div>
                </div>
            </a>
            <a class="col-md-6 col-xl-4 item-anchor" style="cursor: default">
                <div class="card mb-3 widget-content bg-deep-blue">
                    <div class="font-icon-wrapper font-icon-lg"><i class="pe-7s-cash text-white"></i></div>
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading"><?=$prosses->getlang('TotalsalesCurrentWeek');?></div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span class="float-left">$</span><span class="float-left"><?=$prosses->GetDashboardStatistic('TotalsalesCurrentWeek');?></span></div>
                        </div>
                    </div>
                </div>
            </a>
            <a class="col-md-6 col-xl-4 item-anchor" style="cursor: default">
                <div class="card mb-3 widget-content bg-ripe-malin">
                    <div class="font-icon-wrapper font-icon-lg"><i class="pe-7s-cash text-white"></i></div>
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading"><?=$prosses->getlang('TotalsalesCurrenMonth');?></div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span class="float-left">$</span><span class="float-left"><?=$prosses->GetDashboardStatistic('TotalsalesCurrentMonth');?></span></div>
                        </div>
                    </div>
                </div>
            </a>
            <a class="col-md-6 col-xl-4 item-anchor" style="cursor: default">
                <div class="card mb-3 widget-content bg-arielle-smile">
                    <div class="font-icon-wrapper font-icon-lg"><i class="pe-7s-cash text-white"></i></div>
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading"><?=$prosses->getlang('TotalsalesCurrenToday');?></div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span class="float-left">$</span><span class="float-left"><?=$prosses->GetDashboardStatistic('TotalsalesCurrenToday');?></span></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?=$prosses->URL;?>/index.php" class="col-md-6 col-xl-4 item-anchor" style="pointer-events: none;opacity: 0.3">
                <div class="card mb-3 widget-content bg-night-fade">
                    <div class="font-icon-wrapper font-icon-lg"><i class="pe-7s-plugin text-white"></i></div>
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading"><?=$prosses->getlang('Thenumberofdrivers');?></div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span class="float-left">#</span>1</span></div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="<?=$prosses->URL;?>/index.php" class="col-md-6 col-xl-4 item-anchor" style="pointer-events: none;opacity: 0.3">
                <div class="card mb-3 widget-content bg-sunny-morning">
                    <div class="font-icon-wrapper font-icon-lg"><i class="pe-7s-plugin text-white"></i></div>
                    <div class="widget-content-wrapper text-white">
                        <div class="widget-content-left">
                            <div class="widget-heading"><?=$prosses->getlang('Numberofdriversavailable');?></div>
                        </div>
                        <div class="widget-content-right">
                            <div class="widget-numbers text-white"><span class="float-left">#</span>1</span></div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="row" style="display: ">
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                            <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                            <?=$prosses->getlang('ordersreport');?>
                        </div>
                    </div>
                    <div class="card-body">
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            google.charts.load("current", {packages:["corechart"]});
                            google.charts.setOnLoadCallback(drawChart);
                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['Orders', 'Counts'],
                                    ["<?=$prosses->getlang('TotalBookingscompleted');?>",     <?=$prosses->GetDashboardStatistic('TotalBookingscompleted');?>],
                                    ["<?=$prosses->getlang('Numberofcanceledrequests');?>",      <?=$prosses->GetDashboardStatistic('Numberofcanceledrequests');?>],
                                    ["<?=$prosses->getlang('TotalOrdersinprogress');?>",  <?=$prosses->GetDashboardStatistic('TotalOrdersinprogress');?>],
                                    ["<?=$prosses->getlang('Inshippingorders');?>",  <?=$prosses->GetDashboardStatistic('Inshippingorders');?>],
                                ]);
                                var options = {
                                    is3D: true,
                                    colors: ['#6bc58d', '#ff9a9e', '#fdc178', '#656565'],
                                };
                                var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
                                chart.draw(data, options);
                            }
                        </script>
                        <div id="piechart_3d" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="main-card mb-3 card">
                    <div class="card-header-tab card-header-tab-animation card-header">
                        <div class="card-header-title">
                            <i class="header-icon lnr-apartment icon-gradient bg-love-kiss"> </i>
                            <?=$prosses->getlang('salesreport');?>
                        </div>
                    </div>
                    <div class="card-body">
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            google.charts.load('current', {'packages':['corechart']});
                            google.charts.setOnLoadCallback(drawChart);
                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ['Year', 'Sales'],
                                    ['2016',  10],
                                    ['2017',  90],
                                    ['2018',  150],
                                    ['2019',  300],
                                    ['2020',  800],
                                    ['2021',  2200]
                                ]);

                                var options = {
                                    curveType: 'function',
                                    legend: { position: 'bottom' },
                                    colors: ['#f5576c','#6bc58d'],

                                };

                                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                                chart.draw(data, options);
                            }
                        </script>
                        <div id="curve_chart" style="width: 100%; height: 400px"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "includes/footer.php";
?>




