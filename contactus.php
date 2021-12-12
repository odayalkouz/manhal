<?php
$currentTab="aboutus";
include_once "includes/function.php";
include_once("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/css/contactus.css<?=$cash;?>">
<script src='https://www.google.com/recaptcha/api.js'></script>
<div class="inner-pages-main-container-a">
    <?=$breadCrumbs;?>
    <div class="center-piece">
        <div class="display-table">
            <div class="display-row">
                <div class="display-cell">
                   <div class="about-us-main-container">
                       <div class="image-header-container">
                           <h1><?=$Lang->ContectUs?></h1>
                       </div>
                       <div class="display-block">
                           <div class="info-container floating-left">
                               <h2><?=$Lang->ContactInfo?></h2>
                               <div class="bottom-container">
                                   <div class="item-container floating-left ">
                                       <div class="office-position">
                                           <label class="floating-left"><?= $Lang->Elearningoffice;?></label>
                                           <span class="floating-left"><?= $Lang->AmmanKhalda;?></span>
                                       </div>
                                       <div class="row"><span class="floating-left text-left"><?= $Lang->Elearningofficepos;?></span></div>
                                       <div class="row"><label class="floating-left text-left"><?= $Lang->EMail;?></label><span class="floating-left text-left">support@manhal.com</span></div>
                                       <div class="row"><label class="floating-left text-left"><?= $Lang->Mobileandwhatsapp;?></label><span class="floating-left text-left">+962 (78) 7000522</span></div>
                                       <div class="row opening floating-left"><label class="floating-left text-left"><?= $Lang->opening;?></label><span class="floating-left text-left"><?= $Lang->workingtimeC;?></span></div>
                                       <a title="<?= $Lang->AmmanKhalda;?>" class="view-map" data-value="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3383.7703594214586!2d35.86237523445274!3d31.99424013078969!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151ca1c5673ecdad%3A0xd568fc5988b6be8!2z2YXYrNmF2Lkg2KfZhNij2LHZitisINin2YTYqtis2KfYsdmK!5e0!3m2!1sar!2sjo!4v1556526311531!5m2!1sar!2sjo"></a>
                                   </div>
                                   <div class="item-container floating-left">
                                       <div class="office-position">
                                           <label class="floating-left"><?= $Lang->Headoffice;?></label>
                                           <span class="floating-left"><?= $Lang->AmmanKhalda;?></span>
                                       </div>
                                       <div class="row"><span class="floating-left text-left"><?= $Lang->MainOfficep1;?></span></div>
                                       <div class="row"><label class="floating-left text-left"><?= $Lang->EMail;?></label><span class="floating-left text-left">info@manhal.com</span></div>
                                       <div class="row"><label class="floating-left text-left"><?= $Lang->Phone;?></label><span class="floating-left text-left">+962 (6) 5698308</span><div class="floating-left separate-between">-</div><label class="floating-left text-left"><?= $Lang->Fax;?></label><span class="floating-left text-left">+962 (6) 5639185</span></div>
                                       <div class="row opening floating-left"><label class="floating-left text-left"><?= $Lang->opening;?></label><span class="floating-left text-left"><?= $Lang->workingtimeA;?></span></div>
                                       <a title="<?= $Lang->Ammanalabdali;?>" class="view-map" data-value="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3383.7703594214586!2d35.86237523445274!3d31.99424013078969!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151ca1c5673ecdad%3A0xd568fc5988b6be8!2z2YXYrNmF2Lkg2KfZhNij2LHZitisINin2YTYqtis2KfYsdmK!5e0!3m2!1sar!2sjo!4v1556526311531!5m2!1sar!2sjo"></a>
                                   </div>
                                   <div class="item-container floating-left clear-both">
                                       <div class="office-position">
                                           <label class="floating-left"><?= $Lang->Showroom1;?></label>
                                           <span class="floating-left"><?= $Lang->Ammanalabdali;?></span>
                                       </div>
                                       <div class="row"><span class="floating-left text-left"><?= $Lang->Showroom1pos;?></span></div>
                                       <div class="row"><label class="floating-left text-left"><?= $Lang->EMail;?></label><span class="floating-left text-left">A-bookshop@manhal.com</span></div>
                                       <div class="row"><label class="floating-left text-left"><?= $Lang->Phone;?></label><span class="floating-left text-left">+962 (6) 5687739</span></div>
                                       <div class="row"><label class="floating-left text-left"><?= $Lang->Mobileandwhatsapp;?></label><span class="floating-left text-left">+962 (78) 7000429</span></div>

                                       <div class="row opening floating-left"><label class="floating-left text-left"><?= $Lang->opening;?></label><span class="floating-left text-left"><?= $Lang->workingtimeB;?></span></div>
                                       <a title="<?= $Lang->Ammanalabdali;?>" class="view-map" data-value="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1296.8495459984867!2d35.915068689061336!3d31.96094099705625!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151ca0762863bc6d%3A0x825b488567d87153!2z2K_Yp9ixINin2YTZhdmG2YfZhCAtINmF2LnYsdi2INin2YTYudio2K_ZhNmKIERhciBBbC1tYW5oYWwgLSBBYmRhbGkgU2hvd3Jvb20!5e1!3m2!1sen!2sjo!4v1531813554132"></a>
                                   </div>
                                   <div class="item-container floating-left">
                                       <div class="office-position">
                                           <label class="floating-left"><?= $Lang->Showroom2;?></label>
                                           <span class="floating-left"><?= $Lang->AmmanKhalda;?></span>
                                       </div>
                                       <div class="row"><span class="floating-left text-left"><?= $Lang->Showroom2pos;?></span></div>
                                       <div class="row"><label class="floating-left text-left"><?= $Lang->EMail;?></label><span class="floating-left text-left">K-bookshop@manhal.com</span></div>
                                       <div class="row"><label class="floating-left text-left"><?= $Lang->Phone;?></label><span class="floating-left text-left">+962 (6) 5533889</span></div>
                                       <div class="row"><label class="floating-left text-left"><?= $Lang->Mobileandwhatsapp;?></label><span class="floating-left text-left">+962 (78) 9993335</span></div>
                                       <div class="row opening floating-left"><label class="floating-left text-left"><?= $Lang->opening;?></label><span class="floating-left text-left"><?= $Lang->workingtimeD;?></span></div>
                                       <a title="<?= $Lang->AmmanKhalda;?>" class="view-map" data-value="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1481.5016798367283!2d35.85010704805419!3d31.997114282869536!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x151ca1c297124075%3A0x54f606d612130aee!2z2YXZg9iq2KjYqSDYr9in2LEg2KfZhNmF2YbZh9mEIC0g2YHYsdi5INiu2YTYr9in!5e1!3m2!1sen!2sjo!4v1531813412655"></a>
                                   </div>
                               </div>
                           </div>
                           <div class="iframe-container" style="margin-bottom: 20px">
                               <div class="manhal-loader-main-container" style="display: block;position: absolute">
                                   <div class="manhal-loader-content">
                                       <div class="sk-cube-grid">
                                           <div class="sk-cube sk-cube1"></div>
                                           <div class="sk-cube sk-cube2"></div>
                                           <div class="sk-cube sk-cube3"></div>
                                           <div class="sk-cube sk-cube4"></div>
                                           <div class="sk-cube sk-cube5"></div>
                                           <div class="sk-cube sk-cube6"></div>
                                           <div class="sk-cube sk-cube7"></div>
                                           <div class="sk-cube sk-cube8"></div>
                                           <div class="sk-cube sk-cube9"></div>
                                       </div>
                                   </div>
                               </div>
                               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3384.9098250623506!2d35.90108511566878!3d31.963342981225296!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb36d0195fa54aba4!2sDar+Al+Manhal+Publishers!5e0!3m2!1sen!2s!4v1475992468506" class="map-container" frameborder="0" allowfullscreen></iframe>
                           </div>
                           <form id="contact_form" style="display: none">
                               <div class="contact-form">
                               <h2><?=$Lang->Contactform?></h2>
                               <div class="line-row">
                                   <input type="text" name="name" id="name" placeholder="<?= $Lang->Name;?>" class="txt-a floating-left">
                                   <input type="email" name="email" id="email" placeholder="<?= $Lang->EMail;?>" class="txt-a floating-left">
                                   <input type="text" name="Subject" id="subject" placeholder="<?= $Lang->Subject;?>" class="txt-a floating-left">
                               </div>
                               <div class="line-row">
                                   <textarea name="message" id="message" placeholder="<?= $Lang->Message; ?>" class="txt-area-a floating-left"></textarea>
                               </div>
                               <div class="line-row">
                                   <input type="reset" class="floating-right btn-a btnreset" value="<?= $Lang->Reset;?>">
                                   <input type="button" class="floating-right btn-a btnsend" value="<?= $Lang->Send;?>">
                                   <div class="g-recaptcha" data-sitekey="6Lfnvj8UAAAAAOp7R2hIx7LfMaDNcQDGrIc6aS7N"></div>
                               </div>
                           </div>
                           </form>
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include("includes/footer.php");?>
