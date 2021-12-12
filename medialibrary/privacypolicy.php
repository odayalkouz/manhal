<?php
$currentTab="Privacy Policy";
include_once "includes/header.php";
?>
<script>
    $("body").addClass("layout-fullwidth")
</script>
<div class="container-fluid">
    <h3 class="page-title">Privacy Policy</h3>
    <div class="row">
        <div class="col-md-12">
            <div class="panel withshadow">
                <div class="panel-body">
                    <div class="row">
                        <p><?=$prosses->lang('privacyPolicy1');?></p>

                        <h6><b><?=$prosses->lang('Whatinformationwecollectaboutyou');?></b></h6>
                        <p><?=$prosses->lang('paragraph1');?></p>
                        <p><?=$prosses->lang('paragraph2');?></p>
                        <p><?=$prosses->lang('paragraph3');?></p>
                        <p><?=$prosses->lang('paragraph4');?></p>

                        <h6><b><?=$prosses->lang('titleB');?></b></h6>
                        <p><?=$prosses->lang('paragraph5');?></p>

                        <h6><b><?=$prosses->lang('titleC');?></b></h6>
                        <p><?=$prosses->lang('paragraph6');?></p>
                        <p><?=$prosses->lang('paragraph7');?></p>

                        <h6><b><?=$prosses->lang('titleD');?></b></h6>
                        <p><?=$prosses->lang('paragraph8');?></p>

                        <h6><b><?=$prosses->lang('titleE');?></b></h6>
                        <p><?=$prosses->lang('paragraph9');?></p>
                        <p><?=$prosses->lang('paragraph10');?></p>

                        <h6><b><?=$prosses->lang('titleF');?></b></h6>
                        <p><?=$prosses->lang('paragraph11');?></p>

                        <h6><b><?=$prosses->lang('titleG');?></b></h6>
                        <p><?=$prosses->lang('paragraph12');?></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "includes/footer.php";
?>
