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
                <p class="first"><span class="sell-arb floating-left">يباع</span><span class="up-sell-book-title floating-left">حكايات الحروف</span><span class="floating-left"><?=$Lang->upsalemessage1;?></span></p>
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
                                <div class="owl-item" title="أشبال الأقصى">
                                    <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <a href="<?=SITE_URL;?>en/product/stories/1/أشبال-الأقصى">
                                            <img src="<?=SITE_URL;?>products/stories/1/slider/0.jpg" alt="">
                                            <div class="about1">
                                                <span class="font-weight-bold current-price " style="float: right">$<?=$campainPrice['3455']['new'];?></span>
                                                <span class="old-price" style="float: right">$<?=$campainPrice['3455']['old'];?></span>
                                            </div>
                                            <div class="owl-item-title"><h5>أشبال الأقصى</h5></div>
                                        </a>
                                        <button class="btn btn-long cart1 floating-left jq_addcart_upsell" data-type="story" data-id="3455"><?=$Lang->Add;?></button>
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
                    <button class="btn btn-long cart1 floating-left" data-type="story" data-id="3456"><?=$Lang->AddCart;?></button>
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
                            <li data-thumb="<?=SITE_URL;?>products/stories/2/slider/0.jpg" class=""><img  class="image-slider1 xzoom" src="<?=SITE_URL;?>products/stories/2/slider/0.jpg" xoriginal="<?=SITE_URL;?>products/stories/2/slider/0.jpg"/></li>
                            <li data-thumb="<?=SITE_URL;?>products/stories/2/slider/1.jpg" class=""><img  class="image-slider1 xzoom" src="<?=SITE_URL;?>products/stories/2/slider/1.jpg" xoriginal="<?=SITE_URL;?>products/stories/2/slider/1.jpg"/></li>
                            <li data-thumb="<?=SITE_URL;?>products/stories/2/slider/2.jpg" class=""><img  class="image-slider1 xzoom" src="<?=SITE_URL;?>products/stories/2/slider/2.jpg" xoriginal="<?=SITE_URL;?>products/stories/2/slider/2.jpg"/></li>
                            <li data-thumb="<?=SITE_URL;?>products/stories/2/slider/3.jpg" class=""><img  class="image-slider1 xzoom" src="<?=SITE_URL;?>products/stories/2/slider/3.jpg" xoriginal="<?=SITE_URL;?>products/stories/2/slider/3.jpg"/></li>
                            <li data-thumb="<?=SITE_URL;?>products/stories/2/slider/4.jpg" class=""><img  class="image-slider1 xzoom" src="<?=SITE_URL;?>products/stories/2/slider/4.jpg" xoriginal="<?=SITE_URL;?>products/stories/2/slider/4.jpg"/></li>
                            <li data-thumb="<?=SITE_URL;?>products/stories/2/slider/5.jpg" class=""><img  class="image-slider1 xzoom" src="<?=SITE_URL;?>products/stories/2/slider/5.jpg" xoriginal="<?=SITE_URL;?>products/stories/2/slider/5.jpg"/></li>
                            <li data-thumb="<?=SITE_URL;?>products/stories/2/slider/6.jpg" class=""><img  class="image-slider1 xzoom" src="<?=SITE_URL;?>products/stories/2/slider/6.jpg" xoriginal="<?=SITE_URL;?>products/stories/2/slider/6.jpg"/></li>
                            <li data-thumb="<?=SITE_URL;?>products/stories/2/slider/7.jpg" class=""><img  class="image-slider1 xzoom" src="<?=SITE_URL;?>products/stories/2/slider/7.jpg" xoriginal="<?=SITE_URL;?>products/stories/2/slider/7.jpg"/></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 order-2">
                <div class="card">
                    <div class="about">
                        <h4 class="" style="font-family:'Droid Arabic Kufi';text-align: right">حكايات الحروف</h4>
                        <span class="font-weight-bold current-price" style="float: right"><label>$</label><label><?=$campainPrice['3456']['new'];?></label></span>
                        <span class="old-price " style="float: right"><label>$</label><label><?=$campainPrice['3456']['old'];?></label></span>
                        <label class="font-weight-bold sale1" style="float: right"><?=$Lang->sale;?></label>
                    </div>
                    <div class="Type-content" style="display: none">
                        <label><?=$Lang->Type;?></label>
                        <a class="item-varient active" Oprice="<?=$campainPrice['3456']['old'];?>" Bprice="<?=$campainPrice['3456']['new'];?>"><?=$Lang->stories30;?></a>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 offset-lg-4 offset-lg-4">
                            <div class="quantity-content">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 quatitly11">
                                        <label style="color: transparent"><?=$Lang->QTY;?></label>
                                        <button class="btn btn-long cart1 floating-left" id="add_to_cart" data-type="story" data-id="3456"><?=$Lang->AddCart;?></button>
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
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text"><?=$Lang->addsstoriesTow4;?></span> </div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text"><?=$Lang->addsstoriesTow1;?></span> </div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text"><?=$Lang->addsstoriesTow2;?></span> </div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text"><?=$Lang->addsstoriesTow3;?></span> </div>
                                            <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text"><?=$Lang->addsstoriesTow5;?></span> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="product-description">
                                            <div class="mt-2"> <span class="title"><?=$Lang->AboutSeries;?></span>
                                                <p><?=$Lang->AboutSeriesparagraphS2English;?></p>
                                                <p><?=$Lang->AboutSeriesparagraphS2Arabic;?></p>
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
                            <div class="col-lg-7 col-md-12 col-sm-12">
                                <div class="bullets">
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">خزانة رامي (حرف الألف)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">ندى والحلوى (الألف المقصورة)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">أرنب أسماء (الهمزة)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">ثوب رباب (حرف الباء)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">تالا والفراشة (حرف التاء)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">مثلثات ليث (حرف الثاء)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">مزرعة جدي (حرف الجيم)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">أحب الفلاح (حرف الحاء)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">كوخ خالد (حرف الخاء)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">دراجة زياد (حرف الدال)</span> </div>
                                </div>
                                <div class="bullets">
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">القنفذ والذئب (حرف الذال)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">إشارة المرور (حرف الراء)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">الزرافة والغزال (حرف الزاي)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">فرس فراس (حرف السين)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">دجاجة راضي (حرف الضاد)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">بركة طارق (حرف الطاء)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">ظافر والفصول (حرف الظاء)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">ضفدع سعيد (حرف العين)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">غازي والغراب (حرف الغين)</span> </div>
                                    <div class="d-flex align-items-center">  <span class="bullet-text" style="font-family:'Droid Arabic Kufi';color: transparent" >غازي والغراب (حرف الغين)</span> </div>
                                </div>
                                <div class="bullets">
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">خروف فادي (حرف الفاء)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">ذكاء قرد (حرف القاف)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">كواك.. كواك (حرف الكاف)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">عسل النحل (حرف اللام)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">مرام في المطعم (حرف الميم)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">يوميات حنان (حرف النون)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">لعبة الهدف (حرف الهاء)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">بالون نور (حرف الواو)</span> </div>
                                    <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text" style="font-family:'Droid Arabic Kufi'">الأرنب والفيل (حرف الياء)</span> </div>
                                    <div class="d-flex align-items-center">  <span class="bullet-text" style="font-family:'Droid Arabic Kufi';color: transparent">الأرنب والفيل (حرف الياء)</span> </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12 col-sm-12 text-center text-center">
                                <img class="thumb-item" src="<?=SITE_URL;?>products/stories/2/content/1.jpg">
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
                                        <div class="owl-item" title="حكايات الزرافة">
                                            <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                <a href="<?=SITE_URL;?><?=$_SESSION['lang'];?>/product/stories/3/حكايات-الزرافة" class="bbb_viewed_image">
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
                                        <div class="owl-item"  title="نادي القراءة">
                                            <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                                <a href="<?=SITE_URL;?><?=$_SESSION['lang'];?>/product/stories/5/نادي-القراءة" class="bbb_viewed_image">
                                                    <img src="<?=SITE_URL;?>products/stories/5/slider/0.jpg" alt="">
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












































