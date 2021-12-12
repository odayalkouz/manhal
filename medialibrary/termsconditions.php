<?php
$currentTab="Privacy Policy";
include_once "includes/header.php";
?>
<script>
    $("body").addClass("layout-fullwidth")
</script>
<div class="container-fluid">
    <h3 class="page-title">Terms &amp; Conditions</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="panel withshadow">
                <div class="panel-body">
                    <div class="row">
                        <p><?=$prosses->lang('paragraphterms');?></p>

                        <h6><b><?=$prosses->lang('titleterms1');?></b></h6>
                        <p><?=$prosses->lang('paragraphterms1');?></p>

                        <h6><b><?=$prosses->lang('titleterms2');?></b></h6>
                        <p><?=$prosses->lang('paragraphterms2');?></p>

                        <h6><b><?=$prosses->lang('titleterms3');?></b></h6>
                        <p><?=$prosses->lang('paragraphterms3');?></p>

                        <h6><b><?=$prosses->lang('titleterms4');?></b></h6>
                        <p><?=$prosses->lang('paragraphterms4');?></p>

                        <h6><b><?=$prosses->lang('titleterms5');?></b></h6>
                        <p><?=$prosses->lang('paragraphterms5');?></p>

                        <h6><b><?=$prosses->lang('titleterms6');?></b></h6>
                        <p><?=$prosses->lang('paragraphterms6');?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "includes/footer.php";
?>
