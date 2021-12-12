<?php
$currentTab = "Standards";
include_once "../../includes/header.php";
?>
<div class="app-main__inner">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"><?=$Lang->SortBy;?></h5>
                <div>
                    <div class="form-row">
                        <div class="col-md-12">
                            <div class="dd nestable-with-handle">
                                <ol id="sortable" class="dd-list">
                                    <li class="dd-item dd3-item">
                                        <div class="dd-handle dd3-handle"><i>&#x2195;</i></div>
                                        <div class="dd3-content">1</div>
                                    </li>
                                    <li class="dd-item dd3-item">
                                        <div class="dd-handle dd3-handle"><i>&#x2195;</i></div>
                                        <div class="dd3-content">2</div>
                                    </li>
                                    <li class="dd-item dd3-item">
                                        <div class="dd-handle dd3-handle"><i>&#x2195;</i></div>
                                        <div class="dd3-content">3</div>
                                    </li>
                                    <li class="dd-item dd3-item">
                                        <div class="dd-handle dd3-handle"><i>&#x2195;</i></div>
                                        <div class="dd3-content">4</div>
                                    </li>
                                    <li class="dd-item dd3-item">
                                        <div class="dd-handle dd3-handle"><i>&#x2195;</i></div>
                                        <div class="dd3-content">5</div>
                                    </li>
                                </ol>
                            </div>
                        </div>
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
        $( "#sortable" ).sortable();
        $( "#sortable" ).disableSelection();
    });

</script>
<?php
include_once "../../includes/footer.php";
?>
