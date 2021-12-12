<?php
include "includes/function.php";
include_once("includes/header.php");
?>


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
                <input type="number" class="" value="1" min="1">
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                <button class="btn btn-long cart1 floating-left" data-type="book" data-id="106"><?=$Lang->AddCart;?></button>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid mt-2 mb-3 text-left">
    <div class="row">
        <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12 order-1">
            <div class="card">
                <div class="demo zoom-box">
                    <ul id="lightSlider">
                        <li data-thumb="https://www.manhal.com/platform/books/710/cover.jpg" class=""><img  class="image-slider1 xzoom" src="https://www.manhal.com/platform/books/710/13790.jpg" xoriginal="https://www.manhal.com/platform/books/710/13790.jpg"/></li>
                        <li data-thumb="https://www.manhal.com/platform/books/710/cover.jpg" class=""><img  class="image-slider1 xzoom" src="https://www.manhal.com/platform/books/710/13790.jpg" xoriginal="https://www.manhal.com/platform/books/710/13790.jpg"/></li>
                        <li data-thumb="https://www.manhal.com/platform/books/710/cover.jpg" class=""><img  class="image-slider1 xzoom" src="https://www.manhal.com/platform/books/710/13790.jpg" xoriginal="https://www.manhal.com/platform/books/710/13790.jpg"/></li>
                        <li data-thumb="https://www.manhal.com/platform/books/710/cover.jpg" class=""><img  class="image-slider1 xzoom" src="https://www.manhal.com/platform/books/710/13790.jpg" xoriginal="https://www.manhal.com/platform/books/710/13790.jpg"/></li>
                        <li data-thumb="https://www.manhal.com/platform/books/710/cover.jpg" class=""><img  class="image-slider1 xzoom" src="https://www.manhal.com/platform/books/710/13790.jpg" xoriginal="https://www.manhal.com/platform/books/710/13790.jpg"/></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12 order-2">
            <div class="card">
                <div class="about">
                    <h4 class="" style="font-family:'Droid Arabic Kufi';text-align: right">كتاب نادي العربية المستوى الأول</h4>
                    <span class="font-weight-bold current-price" style="float: right">$10</span>
                    <span class="old-price " style="float: right">$20</span>
                    <label class="font-weight-bold sale1 " style="float: right"><?=$Lang->sale;?></label>
                </div>
                <div class="Type-content">
                    <label><?=$Lang->Type;?></label>
                    <a class="item-varient active" Oprice="$20" Bprice="$10"><?=$Lang->StudentBook_EBook;?></a>
                    <a class="item-varient" Oprice="$30" Bprice="$20"><?=$Lang->ActivityBook_EBook;?></a>
                    <a class="item-varient" Oprice="$40" Bprice="$30"><?=$Lang->TeacherBook;?></a>
                    <a class="item-varient" Oprice="$50" Bprice="$50"><?=$Lang->StudentBook_ActivityBook_EBook;?></a>
                </div>
                <div class="row">
                    <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 offset-lg-4 offset-lg-4">
                        <div class="quantity-content">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 quatitly11">
                                    <label style="color: transparent"><?=$Lang->QTY;?></label>
                                    <button class="btn btn-long cart1 floating-left" id="add_to_cart" data-type="book" data-id="106"><?=$Lang->AddCart;?></button>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 quatitly22">
                                    <label><?=$Lang->QTY;?></label>
                                    <input type="number" value="1" min="1">
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
                                        <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text">Buy Tow Item or more and get Free Shipping.</span> </div>
                                        <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text">Over 5,500+ Happy Customers.</span> </div>
                                        <div class="d-flex align-items-center"> <span class="dot"></span> <span class="bullet-text">100% Secure Payments.</span> </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="product-description">
                                        <div class="mt-2"> <span class="title"><?=$Lang->AboutSeries;?></span>
                                            <p><?=$Lang->AboutSeriesparagraph;?></p>
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
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <p><?=$Lang->AboutLevelOne;?></p>
                            </div>
                            <div class="col-md-6">
                                <img class="thumb-item" src="<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/qqqqq.png">
                            </div>
                        </div>
                        <div class="row mt-5">

                            <div class="col-md-6">
                                <img class="thumb-item" src="<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/SharedScreenshot111.jpg">
                            </div>
                            <div class="col-md-6">
                                <p><?=$Lang->AboutLevelTow;?></p>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-6">
                                <p><?=$Lang->AboutLevelthree;?></p>
                            </div>
                            <div class="col-md-6">
                                <img class="thumb-item" src="<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/SharedScreenshot111.jpg">
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
                                    <div class="owl-item">
                                        <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                            <a class="bbb_viewed_image"><img src="https://www.manhal.com/platform/books/216/8463.jpg" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="bbb_viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                            <a class="bbb_viewed_image"><img src="https://www.manhal.com/platform/books/710/13790.jpg" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="bbb_viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                            <a class="bbb_viewed_image"><img src="https://www.manhal.com/platform/books/710/13790.jpg" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="bbb_viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                            <a class="bbb_viewed_image"><img src="https://www.manhal.com/platform/books/710/13790.jpg" alt=""></a>
                                        </div>
                                    </div>
                                    <div class="owl-item">
                                        <div class="bbb_viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                            <a class="bbb_viewed_image"><img src="https://www.manhal.com/platform/books/710/13790.jpg" alt=""></a>
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
            slider.goToSlide($(this).index()-1);
            var bprice1=$(this).attr("bprice");
            var Oprice1=$(this).attr("Oprice");
            $(".current-price").html(bprice1);
            $(".old-price").html(Oprice1);
            $(this).addClass("active").siblings().removeClass("active");
        });
        if($('.bbb_viewed_slider').length) {
            var viewedSlider = $('.bbb_viewed_slider');
            viewedSlider.owlCarousel( {
                    loop:true,
                    margin:20,
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
                            1199:{items:6}
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












































