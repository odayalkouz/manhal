<?php
include "includes/function.php";
include_once("includes/header.php");
?>

<div class="modal fade" style="display: none" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?=$Lang->HotOfferOFF;?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p class="first"><span class="sell-arb floating-left">يباع</span><span class="up-sell-book-title floating-left">نادي القراءة</span><span class="floating-left"><?=$Lang->upsalemessage1;?></span></p>
                <p class="first"><?=$Lang->upsalemessage2;?></p>
                <div class="row">
                    <div class="col-md-12">
                        <div class="bbb_viewed_slider_container">
                            <div class="owl-carousel owl-theme upsell_viewed_slider owl-drag">
                                <div class="owl-item" title="حكايات صبا">
                                    <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <a href="<?=SITE_URL;?>en/product/stories/4/حكايات-صبا">
                                            <img src="<?=SITE_URL;?>products/stories/4/slider/0.jpg" alt="">
                                            <div class="about1">
                                                <span class="font-weight-bold current-price " style="float: right">$<?=$campainPrice['3457']['new'];?></span>
                                                <span class="old-price" style="float: right">$<?=$campainPrice['3457']['old'];?></span>
                                            </div>
                                            <div class="owl-item-title"><h5>حكايات صبا</h5></div>
                                        </a>
                                        <button class="btn btn-long cart1 floating-left jq_addcart_upsell" data-type="story" data-id="3457"><?=$Lang->Add;?></button>
                                    </div>
                                </div>
                                <div class="owl-item" title="حكايات الحروف">
                                    <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <a href="<?=SITE_URL;?>en/product/stories/2/حكايات-الحروف">
                                            <img src="<?=SITE_URL;?>products/stories/2/slider/0.jpg" alt="">
                                            <div class="about1">
                                                <span class="font-weight-bold current-price " style="float: right">$<?=$campainPrice['3456']['new'];?></span>
                                                <span class="old-price" style="float: right">$<?=$campainPrice['3456']['old'];?></span>
                                            </div>
                                            <div class="owl-item-title"><h5>حكايات الحروف</h5></div>
                                        </a>
                                        <button class="btn btn-long cart1 floating-left jq_addcart_upsell" data-type="story" data-id="3456"><?=$Lang->Add;?></button>
                                    </div>
                                </div>
                                <div class="owl-item" title="حكايات الزرافة">
                                    <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <a href="<?=SITE_URL;?>en/product/stories/3/حكايات-الزرافة">
                                            <img src="<?=SITE_URL;?>products/stories/3/slider/0.jpg" alt="">
                                            <div class="about1">
                                                <span class="font-weight-bold current-price " style="float: right">$<?=$campainPrice['3451']['new'];?></span>
                                                <span class="old-price" style="float: right">$<?=$campainPrice['3451']['old'];?></span>
                                            </div>
                                            <div class="owl-item-title"><h5>حكايات الزرافة</h5></div>
                                        </a>
                                        <button class="btn btn-long cart1 floating-left jq_addcart_upsell" data-type="story" data-id="3451"><?=$Lang->Add;?></button>
                                    </div>
                                </div>
                                <div class="owl-item" title="العب وتعلم مع الحروف">
                                    <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <a href="<?=SITE_URL;?>en/product/books/c1/العب-وتعلم-مع-الحروف">
                                            <img src="<?=SITE_URL;?>products/books/c1/slider/0.jpg" alt="">
                                            <div class="about1">
                                                <span class="font-weight-bold current-price " style="float: right">$<?=$campainPrice['1515']['new'];?></span>
                                                <span class="old-price" style="float: right">$<?=$campainPrice['1515']['old'];?></span>
                                            </div>
                                            <div class="owl-item-title"><h5>العب وتعلم مع الحروف</h5></div>
                                        </a>
                                        <button class="btn btn-long cart1 floating-left jq_addcart_upsell" data-type="book" data-id="1515"><?=$Lang->Add;?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<div class="center-piece-series">
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>js/new/bootstrap.min.css">
    <script type="text/javascript" src="<?=SITE_URL;?>js/new/bootstrap.bundle.min.js"></script>
    <link rel='stylesheet' href='<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/css/lightslider.css'>
    <link rel="stylesheet" href="<?=SITE_URL;?>js/new/owl.carousel.min.css">
    <link rel="stylesheet" href="<?=SITE_URL;?>js/new/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/css/series.css<?=$cash;?>">
    <script src="<?=SITE_URL;?>js/new/owl.carousel.js"></script>
    <script src='<?=SITE_URL;?>js/new/lightslider.js'></script>
    <script src='<?=SITE_URL;?>js/new/bootstrap-input-spinner.js'></script>
    <div class="fixed-bottom addto-card-fixed-container">
        <div class="center-piece-series custom">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 fixed-hide1">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6 fixed-hide">
                    <input type="number" id="qty-2" value="1" min="1">
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                    <button class="btn btn-long cart1 floating-left" data-type="story" data-id="3458"><?=$Lang->AddCart;?></button>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-2 mb-3 text-left">
        <div class="row">
            <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 ">
                <div class="card">
                    <div class="demo zoom-box">
                        <ul id="lightSlider">
                            <li data-thumb="<?=SITE_URL;?>products/stories/5/slider/0.jpg" class=""><img  class="image-slider1 xzoom" src="<?=SITE_URL;?>products/stories/5/slider/0.jpg" xoriginal="<?=SITE_URL;?>products/stories/5/slider/0.jpg"/></li>
                            <li data-thumb="<?=SITE_URL;?>products/stories/5/slider/6.jpg" class=""><img  class="image-slider1 xzoom" src="<?=SITE_URL;?>products/stories/5/slider/6.jpg" xoriginal="<?=SITE_URL;?>products/stories/5/slider/6.jpg"/></li>
                            <li data-thumb="<?=SITE_URL;?>products/stories/5/slider/7.jpg" class=""><img  class="image-slider1 xzoom" src="<?=SITE_URL;?>products/stories/5/slider/7.jpg" xoriginal="<?=SITE_URL;?>products/stories/5/slider/7.jpg"/></li>
                            <li data-thumb="<?=SITE_URL;?>products/stories/5/slider/8.jpg" class=""><img  class="image-slider1 xzoom" src="<?=SITE_URL;?>products/stories/5/slider/8.jpg" xoriginal="<?=SITE_URL;?>products/stories/5/slider/8.jpg"/></li>
                            <li data-thumb="<?=SITE_URL;?>products/stories/5/slider/1.jpg" class=""><img  class="image-slider1 xzoom" src="<?=SITE_URL;?>products/stories/5/slider/1.jpg" xoriginal="<?=SITE_URL;?>products/stories/5/slider/1.jpg"/></li>
                            <li data-thumb="<?=SITE_URL;?>products/stories/5/slider/2.jpg" class=""><img  class="image-slider1 xzoom" src="<?=SITE_URL;?>products/stories/5/slider/2.jpg" xoriginal="<?=SITE_URL;?>products/stories/5/slider/2.jpg"/></li>
                            <li data-thumb="<?=SITE_URL;?>products/stories/5/slider/3.jpg" class=""><img  class="image-slider1 xzoom" src="<?=SITE_URL;?>products/stories/5/slider/3.jpg" xoriginal="<?=SITE_URL;?>products/stories/5/slider/3.jpg"/></li>
                            <li data-thumb="<?=SITE_URL;?>products/stories/5/slider/4.jpg" class=""><img  class="image-slider1 xzoom" src="<?=SITE_URL;?>products/stories/5/slider/4.jpg" xoriginal="<?=SITE_URL;?>products/stories/5/slider/4.jpg"/></li>
                            <li data-thumb="<?=SITE_URL;?>products/stories/5/slider/5.jpg" class=""><img  class="image-slider1 xzoom" src="<?=SITE_URL;?>products/stories/5/slider/5.jpg" xoriginal="<?=SITE_URL;?>products/stories/5/slider/5.jpg"/></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 order-2">
                <div class="card">
                    <div class="about">
                        <h4 class="" style="font-family:'Droid Arabic Kufi';text-align: right">نادي القراءة</h4>
                        <span class="font-weight-bold current-price" style="float: right"><label>$</label><label><?=$campainPrice['3458']['new'];?></label></span>
                        <span class="old-price" style="float: right"><label>$</label><label><?=$campainPrice['3458']['old'];?></label></span>
                        <label class="font-weight-bold sale1" style="float: right"><?=$Lang->sale;?></label>
                    </div>
                    <div class="Type-content">
                        <label><?=$Lang->Type;?></label>
                        <a class="item-varient active" productid="3458" Oprice="<?=$campainPrice['3458']['old'];?>" Bprice="<?=$campainPrice['3458']['new'];?>" onclick="slider.goToSlide(0);"><?=$Lang->levelStart;?></a>
                        <a class="item-varient"  productid="3459" Oprice="<?=$campainPrice['3459']['old'];?>" Bprice="<?=$campainPrice['3459']['new'];?>" onclick="slider.goToSlide(4);"><?=$Lang->levelOne;?></a>
                        <a class="item-varient"  productid="3460" Oprice="<?=$campainPrice['3460']['old'];?>" Bprice="<?=$campainPrice['3460']['new'];?>" onclick="slider.goToSlide(5);"><?=$Lang->levelTow;?></a>
                        <a class="item-varient"  productid="3461" Oprice="<?=$campainPrice['3461']['old'];?>" Bprice="<?=$campainPrice['3461']['new'];?>" onclick="slider.goToSlide(6);"><?=$Lang->levelThree;?></a>
                        <a class="item-varient"  productid="3462" Oprice="<?=$campainPrice['3462']['old'];?>" Bprice="<?=$campainPrice['3462']['new'];?>" onclick="slider.goToSlide(7);"><?=$Lang->levelFour;?></a>
                        <a class="item-varient"  productid="3463" Oprice="<?=$campainPrice['3463']['old'];?>" Bprice="<?=$campainPrice['3463']['new'];?>" onclick="slider.goToSlide(8);"><?=$Lang->AllLevel;?></a>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 offset-lg-4 offset-lg-4">
                            <div class="quantity-content">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 quatitly11">
                                        <label style="color: transparent"><?=$Lang->QTY;?></label>
                                        <button class="btn btn-long cart1 floating-left" id="add_to_cart" data-type="story" data-id="3458"><?=$Lang->AddCart;?></button>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 quatitly22">
                                        <label><?=$Lang->QTY;?></label>
                                        <input type="number" id="qty-1" value="1" min="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="br-dashed">
                                <div class="row">
                                    <div class="col-md-12 col-xs-10">
                                        <div class="bullets">
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text"><?=$Lang->addsstoriesFive4;?></span> </div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text"><?=$Lang->addsstoriesFive1;?></span> </div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text"><?=$Lang->addsstoriesFive2;?></span> </div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text"><?=$Lang->addsstoriesFive3;?></span> </div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text"><?=$Lang->addsstoriesFive5;?></span> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="product-description">
                                            <div class="mt-2"> <span class="title"><?=$Lang->AboutSeries;?></span>
                                                <p><?=$Lang->AboutSeriesparagraphS5English;?></p>
                                                <p><?=$Lang->AboutSeriesparagraphS5Arabic;?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="product-description">
                    <div class="mt-2">
                        <div class="row mt-lg-5 mt-sm-0 mt-md-0">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <span class="title"><?=$Lang->levelStart1;?></span>
                                <p><?=$Lang->LevelStratdesc;?></p>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="bullets" style="float: right">
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">أمي الحنونة</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">أختي الكبيرة</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">أخي الصغير</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">الرسامون الصغار</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">عندي حفلة</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi';text-decoration: line-through">نعمل لتتعلموا</span></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="bullets" style="float: right">
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">في مدينة الالعاب</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">أريد ان العب</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">أبي الحبيب</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi';text-decoration: line-through">فلفل وفلة</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi';text-decoration: line-through">ماذا نعمل في المدرسة</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">ماذا نعمل في العطلة</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 text-center">
                                <img style="width: 88%" class="thumb-item" src="<?=SITE_URL;?>products/stories/5/content/1.jpg">
                            </div>
                        </div>
                        <div class="row mt-lg-5 mt-sm-0 mt-md-0">
                            <div class="col-lg-6 col-md-12 col-sm-12 text-center order-1">
                                <img style="width: 88%" class="thumb-item" src="<?=SITE_URL;?>products/stories/5/content/2.jpg">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 order-2">
                                <span class="title"><?=$Lang->levelOne1;?></span>
                                <p><?=$Lang->LevelOnedesc;?></p>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="bullets" style="float: right">
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">أسنان سارة</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi';text-decoration: line-through">ألبس وحدي</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">الدجاجة النشيطة</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">الضفدعان</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi';text-decoration: line-through">العصفور الصغير</span></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="bullets" style="float: right">
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi';text-decoration: line-through">حمودة في المدرسة</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">فأر القرع</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">لا أحد يلعب معي</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">نزهة سلوى</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-lg-5 mt-sm-0 mt-md-0">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <span class="title"><?=$Lang->levelTow1;?></span>
                                <p><?=$Lang->LevelTowdesc;?></p>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="bullets" style="float: right">
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">أنا قصير</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">الدب البني</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">المهرجون الثلاثة</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">سارة الكسولة</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">صغيرة أم كبيرة</span></div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="bullets" style="float: right">
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi';text-decoration: line-through">في الاتحاد قوة</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">أحلام المدينة</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">الذئب الصغير</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">المشجع الرائع</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">نظارة سارة</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 text-center">
                                <img style="width: 88%" class="thumb-item" src="<?=SITE_URL;?>products/stories/5/content/3.jpg">
                            </div>
                        </div>
                        <div class="row mt-lg-5 mt-sm-0 mt-md-0">
                            <div class="col-lg-6 col-md-12 col-sm-12 text-center order-1">
                                <img style="width: 88%" class="thumb-item" src="<?=SITE_URL;?>products/stories/5/content/4.jpg">
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 order-2">
                                <span class="title"><?=$Lang->levelThree1;?></span>
                                <p><?=$Lang->LevelThreedesc;?></p>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="bullets" style="float: right">
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">الذئب والماعزان الصغيران</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">الهدية العجيبة</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">الولد الشقي</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">من لا يعمل لا يأكل</span></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="bullets" style="float: right">
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">الكاتب الصغير</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi';text-decoration: line-through">ولد ... بنت</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">أكره اسمي</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">سنسون المسكين</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-lg-5 mt-sm-0 mt-md-0">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <span class="title"><?=$Lang->levelFour1;?></span>
                                <p><?=$Lang->LevelFourdesc;?></p>
                                <div class="row">
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="bullets" style="float: right">
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">بنطالي المبلل</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">جرس العدالة</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">الفيل الأبيض</span></div>

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 col-sm-12">
                                        <div class="bullets" style="float: right">
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">الفتاة الأمينة</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">حكيم القرية</span></div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">الاعتراف بالذنب فضيلة</span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 text-center">
                                <img style="width: 88%" class="thumb-item" src="<?=SITE_URL;?>products/stories/5/content/5.jpg">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="viewed">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="bbb_viewed_title_container">
                                    <h3 class="bbb_viewed_title"><?=$Lang->RelatedProduct;?></h3>
                                    <div class="bbb_viewed_nav_container">
                                        <div class="bbb_viewed_nav bbb_viewed_prev"><i class="fas fa-chevron-left"></i></div>
                                        <div class="bbb_viewed_nav bbb_viewed_next"><i class="fas fa-chevron-right"></i></div>
                                    </div>
                                </div>
                                <div class="bbb_viewed_slider_container">
                                    <div class="owl-carousel owl-theme bbb_viewed_slider">
                                        <div class="owl-item" title="أشبال الأقصى">
                                            <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                <a href="<?=SITE_URL;?><?=$_SESSION['lang'];?>/product/stories/1/أشبال-الأقص" class="bbb_viewed_image">
                                                    <img src="<?=SITE_URL;?>products/stories/1/slider/0.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="owl-item" title="حكايات الحروف">
                                            <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                <a href="<?=SITE_URL;?><?=$_SESSION['lang'];?>/product/stories/2/حكايات-الحروف" class="bbb_viewed_image">
                                                    <img src="<?=SITE_URL;?>products/stories/2/slider/0.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="owl-item" title="حكايات الزرافة">
                                            <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                <a href="<?=SITE_URL;?><?=$_SESSION['lang'];?>/product/stories/3/حكايات-الزراف" class="bbb_viewed_image">
                                                    <img src="<?=SITE_URL;?>products/stories/3/slider/0.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        <div class="owl-item" title="حكايات صبا">
                                            <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                <a href="<?=SITE_URL;?><?=$_SESSION['lang'];?>/product/stories/4/حكايات-صبا" class="bbb_viewed_image">
                                                    <img src="<?=SITE_URL;?>products/stories/4/slider/0.jpg" alt="">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
        <script>
            $("input[type='number']").inputSpinner();
            var slider = $('#lightSlider').lightSlider({
                gallery:true,
                item:1,
                vertical:false,
                vThumbWidth:60,
                thumbItem:4,
                thumbMargin:6,
                slideMargin:0,
                verticalHeight:360,
                adaptiveHeight:true,
                onSliderLoad: function() {}
            });
            $(document).ready(function() {
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 100) {
                        $(".addto-card-fixed-container").show()
                    }
                    else {
                        $(".addto-card-fixed-container").hide()
                    }
                });
                $(".Type-content a").click(function () {
                    $("#add_to_cart").attr('data-id',$(this).attr("productid"));

                    var bprice1=$(this).attr("bprice");
                    var Oprice1=$(this).attr("Oprice");
                    $(".about .current-price").html('<label>$</label><label>'+(bprice1*$("#qty-1").val()).toFixed(2)+'</label>');
                    $(".about .old-price").html('<label>$</label><label>'+(Oprice1*$("#qty-1").val()).toFixed(2)+'</label>');
                    $(this).addClass("active").siblings().removeClass("active");
                });
                $("#qty-1").change(function () {
                    $("#qty-2").val($("#qty-1").val());
                    $(".about .current-price label:last-child").html(($(this).val()*$(".item-varient.active").attr("bprice")).toFixed(2));
                    $(".about .old-price  label:last-child").html(($(this).val()*$(".item-varient.active").attr("oprice")).toFixed(2));
                });
                $("#qty-2").change(function () {
                    $("#qty-1").val($("#qty-2").val());
                    $(".about .current-price label:last-child").html(($(this).val()*$(".item-varient.active").attr("bprice")).toFixed(2));
                    $(".about .old-price  label:last-child").html(($(this).val()*$(".item-varient.active").attr("oprice")).toFixed(2));
                });


                if($('.bbb_viewed_slider').length) {
                    var viewedSlider = $('.bbb_viewed_slider');
                    viewedSlider.owlCarousel( {
                        loop:true,
                        margin:40,
                        autoplay:true,
                        autoplayTimeout:6000,
                        nav:false,
                        dots:false,
                        responsive:
                            {
                                0:{items:2},
                                575:{items:2},
                                768:{items:3},
                                991:{items:4},
                                1199:{items:4}
                            }
                    });
                    if($('.bbb_viewed_prev').length)
                    {
                        var prev = $('.bbb_viewed_prev');
                        prev.on('click', function()
                        {
                            viewedSlider.trigger('prev.owl.carousel');
                        });
                    }
                    if($('.bbb_viewed_next').length)
                    {
                        var next = $('.bbb_viewed_next');
                        next.on('click', function() {
                            viewedSlider.trigger('next.owl.carousel');
                        });
                    }
                }
            });

        </script>
        <style>
            #feedback_form{
                display: none;
            }
        </style>
        <?php
        include_once("includes/footer.php");
        ?>












































