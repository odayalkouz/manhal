<?php
$currentTab="profile";
include_once "includes/header.php";
?>
<div class="app-main__inner">
    <div class="col-lg-12">
        <div class="main-card mb-3 card">
            <div class="card-body">
                <h5 class="card-title"><?=$Lang->privacyPolicy;?></h5>
                <p><?=$Lang->privacyPolicy1?></p>
                <h6><B><?=$Lang->Whatinformationwecollectaboutyou?></B></h6>
                <p><?=$Lang->privacyPolicy2?></p>
                <p><?=$Lang->privacyPolicy3?></p>
                <P><?=$Lang->privacyPolicy4?></P>
                <P><?=$Lang->privacyPolicy5?></P>
                <h6><B><?=$Lang->Sharingwiththirdparties?></B></h6>
                <p><?=$Lang->privacyPolicy6?></p>
                <p><?=$Lang->privacyPolicy7?></p>
                <h6><B><?=$Lang->Thirdpartysites?></B></h6>
                <ul>
                    <li><div class="cirlce floating-left"></div><span class="auto floating-left"><?=$Lang->privacyPolicLI1?></span><a target="_blank" href="https://support.google.com/analytics/answer/6004245?hl=en" class="floating-left"><?=$Lang->here?></a></li>
                    <li><div class="cirlce floating-left"></div><span class="auto floating-left"><?=$Lang->privacyPolicLI2?></span><a target="_blank" href="https://www.paypal.com/us/webapps/mpp/public-policy" class="floating-left"><?=$Lang->here?></a></li>
                </ul>
                <h6><B><?=$Lang->Dataretentionpolicy?></B></h6>
                 <p><?=$Lang->privacyPolicy9?></p>
                <h6><B><?=$Lang->DataSecurity?></B></h6>
                 <p><?=$Lang->privacyPolicy10?></p>
                 <p><?=$Lang->privacyPolicy11?></p>
                <h6><B><?=$Lang->Changestothisprivacypolicy?></B></h6>
                 <p><?=$Lang->privacyPolicy12?></p>
                <h6><B><?=$Lang->ContectUs?></B></h6>
                 <p><?=$Lang->privacyPolicy13?></p>
                 <h3 class="text-left"><?=$Lang->DarAlManhalPublishers?></h3>
                 <div><?=$Lang->TitleOne?></div>
                 <div><?=$Lang->Titletwo?></div>
                 <div><?=$Lang->Titlethree?></div>
                 <div><?=$Lang->Titlefour?></div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "includes/footer.php";
?>
