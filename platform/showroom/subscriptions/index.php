<?php
$currentTab = "subscriptions";
include_once '../includes/breadcrumb.php';
$bredcrumb="<li class='breadcrumb-item'><a href='../index.php'>".$Breadcrumbs->getlang('Dashboard')."</a></li><li class='breadcrumb-item active' aria-current='page'>".$Breadcrumbs->getlang('subscriptions')."</li>";
include_once "../includes/header.php";
$AllSubscripation=$prosses->GetTotalSubscription();


?>
<form  id="manhlform1" class="app-main__inner">
    <div class="col-lg-12 text-center">
        <div class="main-card mb-3 card">
            <div class="card-body ">
                <div class="row">
                    <div class="col-lg-8 float-right">
                        <h5 class="card-title text-left"><?=$prosses->getlang('subscriptions');?></h5>
                    </div>
                    <div class="col-lg-4 float-right margin-t-3">
                        <div class="col-lg-3 float-left">
                            <label class="label-withinput text-left float-right"><?=$prosses->getlang('Date');?></label>
                        </div>
                        <div class="col-lg-9 float-left">
                            <input type="text" id="daterange" class=" form-control-sm form-control" name="date"/>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-3 col-xl-3 item-anchor">
                        <div class="card mb-3 widget-content bg-tempting-azure1">
                            <div class="font-icon-wrapper font-icon-lg"><i class="pe-7s-map-marker text-white"></i></div>
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading"><?=$prosses->getlang('Family');?></div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span class="float-left">$</span><span class="float-left"><?=number_format((float)$AllSubscripation['Total_Family'], 2, '.', '');?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xl-3 item-anchor">
                        <div class="card mb-3 widget-content bg-mean-fruit">
                            <div class="font-icon-wrapper font-icon-lg"><i class="pe-7s-map-marker text-white"></i></div>
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading"><?=$prosses->getlang('Schools');?></div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span class="float-left">$</span><span class="float-left"><?=number_format((float)$AllSubscripation['Total_School'], 2, '.', '');?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xl-3 item-anchor">
                        <div class="card mb-3 widget-content bg-ripe-malin">
                            <div class="font-icon-wrapper font-icon-lg"><i class="pe-7s-shopbag text-white"></i></div>
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading"><?=$prosses->getlang('monthlysubscriptions');?></div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white"><span class="float-left">#</span><span class="float-left"> <?=$AllSubscripation['Total_Month']?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xl-3 item-anchor">
                        <div class="card mb-3 widget-content bg-tempting-azure">
                            <div class="font-icon-wrapper font-icon-lg"><i class="pe-7s-shopbag text-white"></i></div>
                            <div class="widget-content-wrapper text-white">
                                <div class="widget-content-left">
                                    <div class="widget-heading"><?=$prosses->getlang('Yearlysubscriptions');?></div>
                                </div>
                                <div class="widget-content-right">
                                    <div class="widget-numbers text-white">
                                        <span class="float-left">#</span><span class="float-left"><?=$AllSubscripation['Total_Anyal']?></span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-6">
                        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                        <script type="text/javascript">
                            google.charts.load("current", {packages:['corechart']});
                            google.charts.setOnLoadCallback(drawChart);
                            function drawChart() {
                                var data = google.visualization.arrayToDataTable([
                                    ["Element", "Density", { role: "style" } ],
                                    ["<?=$prosses->getlang('Family');?>", <?=number_format((float)$AllSubscripation['Total_Family'], 2, '.', '');?>, "#00aed9"],
                                    ["<?=$prosses->getlang('Schools');?>", <?=number_format((float)$AllSubscripation['Total_School'], 2, '.', '');?>, "#fdc178"],
                                ]);
                                var view = new google.visualization.DataView(data);
                                view.setColumns([0, 1,
                                    { calc: "stringify",
                                        sourceColumn: 1,
                                        type: "string",
                                        role: "annotation" },
                                    2]);
                                var options = {
                                    title: "<?=$prosses->getlang('Number_of_sales_by_type_of_shipment');?>",
                                    bar: {groupWidth: "95%"},
                                    legend: { position: "none" },
                                };
                                var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                                chart.draw(view, options);
                            }
                        </script>
                        <div id="columnchart_values" style="width:100%; height:450px;"></div>
                    </div>
                    <div class="col-lg-6">
                        <script type="text/javascript">
                        google.charts.load('current', {
                            'packages':['geochart'],
                            'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
                        });
                        google.charts.setOnLoadCallback(drawRegionsMap);
                        function drawRegionsMap() {
                            var data = google.visualization.arrayToDataTable([
                                ['Country', "<?=$prosses->getlang('totalsales');?>"],
                                <?php
                               echo $prosses->GetCuntryOfSubscription();
                                ?>

                            ]);
                            var options = {
                                title: "<?=$prosses->getlang('Number_of_sales_by_country');?>",
                                colorAxis: {colors: ['#86e4bf', '#00ad68']}
                            };
                            var chart = new google.visualization.GeoChart(document.getElementById('regions_div'));
                            chart.draw(data, options);
                        }
                    </script>
                        <div id="regions_div" style="width: 100%; height: 450px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php
include_once "../includes/footer.php";
?>




