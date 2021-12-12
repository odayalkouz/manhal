<?php
$currentTab = "Courses";
include_once "../../includes/header.php";
?>
<div class="app-main__inner">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 float-right m-b-10">
                        <h5 class="card-title text-left"><?=$Lang->Units;?></h5>
                    </div>
                    <div class="col-lg-4 float-left">
                        <div class="position-relative form-group top-container">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="Category" class="float-left"><?=$Lang->Domains;?></label>
                                </div>
                                <div class="col-lg-9">
                                    <select name="Category" id="Category" class="form-control">
                                        <option  value="1">1</option>
                                        <option  value="2">2</option>
                                        <option  value="3">3</option>
                                        <option  value="4">4</option>
                                        <option  value="5">5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 float-left">
                        <div class="position-relative form-group top-container">
                            <div class="row">
                                <div class="col-lg-3">
                                    <label for="Category" class="float-left"><?=$Lang->Pivots;?></label>
                                </div>
                                <div class="col-lg-9">
                                    <select name="Category" id="Category" class="form-control">
                                        <option  value="1">1</option>
                                        <option  value="2">2</option>
                                        <option  value="3">3</option>
                                        <option  value="4">4</option>
                                        <option  value="5">5</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="form-row units-main-container">
                        <div class="row" style="width: 100%">
                            <div class="col-lg-6">
                                <h6 class="display-block pl-2 pr-2 mb-2 text-primary">All Units</h6>
                            </div>
                            <div class="col-lg-6">
                                <h6 class="display-block pl-4 pr-4 mb-2 text-primary">Couses Units</h6>
                            </div>
                        </div>
                        <section id="connected">
                           <ul class="connected list no1">
                               <li>Item 1</li>
                               <li>Item 2</li>
                               <li>Item 3</li>
                               <li>Item 4</li>
                               <li>Item 5</li>
                               <li>Item 6</li>
                           </ul>
                            <ul class="connected list no2">
                                <li class="highlight">Item 7</li>
                                <li class="highlight">Item 8</li>
                                <li class="highlight">Item 9</li>
                                <li class="highlight">Item 10</li>
                                <li class="highlight">Item 11</li>
                                <li class="highlight">Item 12</li>
                            </ul>
                        </section>
                        <div class="col-md-12">
                            <button class="mt-2 btn btn-primary float-right"><?=$Lang->Save;?></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        $('.connected').sortable({
            connectWith: '.connected'
        });
    });

</script>
<style>

</style>
<?php
include_once "../../includes/footer.php";
?>
