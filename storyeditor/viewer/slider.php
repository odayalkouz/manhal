<?php
//$width=$width/2;
?>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title><?=$title;?></title>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no,shrink-to-fit=yes">
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>/storyeditor/viewer/slick/slick.css?<?=$cache;?>"/>
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>/storyeditor/viewer/slick/slick-theme.css?<?=$cache;?>"/>
    <link href="<?=SITE_URL;?>storyeditor/css/sweetalert.css?<?=$cache;?>" rel="stylesheet" type="text/css">
    <link href="<?=SITE_URL;?>storyeditor/css/buttons.css?<?=$cache;?>" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="<?=SITE_URL;?>storyeditor/viewer/js/howler.core.js?<?=$cache;?>"></script>
    <script type="text/javascript" src="<?=SITE_URL?>viedoplayer/dist/plyr.js?<?=$cache;?>"></script>
    <link rel="stylesheet" href="<?=SITE_URL?>viedoplayer/dist/plyr1.css?<?=$cache;?>">
    <link href="<?=SITE_URL;?>/storyeditor/viewer/themes/<?=$lang_code;?>/css/manhalloader1.css?<?=$cache;?>" rel="stylesheet" type="text/css">
</head>
<style>
    @font-face {
        font-family: myFirstFont;
        src: url(<?=SITE_URL;?>storyeditor/viewer/themes/en/fonts/abo-thar.ttf);
    }
    .symbol_font
    {
        font-family: myFirstFont;
    }
    .element {
        display: block!important;
    }
    .slider {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        margin: auto;
        text-align: center;
    }
    .slide-item {
        width: 100%;
        height: 100%;
    }
    .content-of-index {
        display: none;
    }
    .element{
        border: none!important;
        display: none;
    }
    .story-content-container {
        background-size: 100% 100% !important;
        background-position: center !important;
        transform-origin: 0 0;
    }
    .highlight {
        color:#FF9800;
    }
    .rtlA {
        direction: rtl !important;
    }
</style>
<script type="text/javascript">
    var soundsArr={};
    var SpeakPause=false;
    var scale=1.0;
    window.isMobile=false;
    window.contetnType="slider";
    window.realWidth=<?=$width;?>;
    window.bookWidth=<?=$width;?>;
    window.bookHeight=<?=$height;?>;
    window.realHeight=<?=$height;?>;
    var bgSound=new Howl({	src: [window.SITE_URL+window.storyPath+'/sound/']});
    bgSound.on('load', function(){
        // do something
        bgSound.play();
    });
    window.storyPath='<?=$story_path;?>';
    window.SITE_URL='<?=SITE_URL;?>';
    window.lang='<?=strtolower($story["language"]);?>';


    function  calcBookDimentions(){
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            isMobile=true;
            if($(window).width()>$(window).height()){
                window.bookHeight=$(window).height()-$(window).height()*0.15;
                p=window.bookHeight/window.realHeight;
                window.bookWidth=window.realWidth*p;
            }else{
                window.bookWidth=$(window).width()-$(window).width()*0.15;
                p=window.bookWidth/window.realWidth;
                window.bookHeight=window.realHeight*p;
            }
        }else{
            if($(window).width()>$(window).height()){
                window.bookHeight=$(window).height()-$(window).height()*0.15;
                p=window.bookHeight/window.realHeight;
                window.bookWidth=window.realWidth*p;
            }else{
                window.bookWidth=$(window).width()-$(window).width()*0.15;
                p=window.bookWidth/window.realWidth;
                window.bookHeight=window.realHeight*p;
            }
        }
        scale=p;
        rescaleSlider();
        $(".slider").css("width",(window.bookWidth).toString()+"px");
        // $(".story-content-container").css("width",(window.bookWidth).toString()+"px");
        $(".slider").css("height",(window.bookHeight).toString()+"px");

        console.log(window.bookWidth);

        $(".story-content-container").css("width",(window.realWidth).toString()+"px");
        $(".story-content-container").css("height",(window.realHeight).toString()+"px");
    }

    function rescaleSlider() {
         $(".story-content-container").css("transform","scale("+scale+")");
    }
</script>
<body style="color: #52697e;overflow:hidden;">
<div class="disss" style="background: #fff;position: fixed;top: 0;left: 0;width: 100%;height: 100%;z-index: 9999999;"><div id="manhalpreSlide" style="position: absolute; top: 50%; left: 25%;"></div><div class="manhal-main-loader"><div class="logo-loader"></div></div><div id="manhalloader" style="position: absolute; top: 90%; left: 30%; display: none;"><div id="manhalpreBar" style="width: 99%; height: 100%;"></div><div id="manhalprePercentage" style="position: relative; height: 100%; direction: ltr;">100%</div></div></div>
<?php
if(isset($settings["drawing"]) && $settings["drawing"]==1){
    ?>
    <div class=" nav-pin-main  coloring-main-container animated pulse"  id="navbar-collapse">
        <ul class="nav-pin nav navbar-nav navbar-right">
            <li class="dropdown user-info-headernew">
                <a class="dropdown-toggle">
                    <i class="icon-draw"></i>
                </a>
                <ul class="dropdown-menu no-close dropdown-pin">
                    <li class="no-close row-a">
                        <a class="float-left jq_color color-1 active" color="#000000"><i></i></a>
                        <a class="float-left jq_color color-2" color="#ec008c"><i></i></a>
                        <a class="float-left jq_color color-3" color="#f7941d"><i></i></a>
                        <a class="float-left jq_color color-4" color="#28abe2"><i></i></a>
                        <a class="float-left jq_color color-5" color="#33b451"><i></i></a>
                        <a class="float-left jq_color color-6" color="#ed1e25"><i></i></a>
                    </li>
                    <li role="seperator" class="divider"></li>
                    <li class="no-close row-b">
                        <a class="float-left jq_canvas_width bg-a active" line-width="5"><i></i></a>
                        <a class="float-left jq_canvas_width bg-b" line-width="10"><i></i></a>
                        <a class="float-left jq_canvas_width bg-c" line-width="15"><i></i></a>
                        <a class="float-left jq_canvas_width bg-d" line-width="20"><i></i></a>
                        <a class="float-left jq_canvas_width bg-e" line-width="25"><i></i></a>
                        <a class="float-left jq_canvas_width bg-f" line-width="30"><i></i></a>
                    </li>
                    <li role="seperator" class="divider"></li>
                    <li class="no-close row-c">
                        <a class="float-left erazer active"><i></i></a>
                        <a class="float-left clear-all "><i></i></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
<?php
}
?>

<div class="doyouknow-popup-container" style="display: none">
    <div class="doyouknow-popup-content" style="display: none">
        <div class="head">
            <a class="close-info-popup floating-left"></a>
            <div class="title1">Do you know</div>
        </div>
        <!--            <div class="content-of-doyouknow">Text text text</div>-->
        <div class="last-content">
            <div class="text-container floating-right tow-a">
                <p id="douknow_txt_view"></p>
            </div>
            <div class="image-container floating-right tow-b">
                <img id="douknow_img_view" src="../thems/images/colorpicker_background.png" alt="cover">
            </div>
        </div>



    </div>
</div>
<div class="action-popup-container" style="display: none">
    <div class="action-popup-content" style="display: none">
        <div class="head">
            <a class="close-info-popup floating-left"></a>
            <a class="fullscreen-info-popup floating-left"></a>
            <div class="title1"><?=$Lang->Action;?></div>
        </div>
        <div class="last-contentA " id="Jq_append_Action">
            <a class="closefullAction" style="display:none;"></a>
            <div class="Jq_content-action">oday alkouz</div>
        </div>
    </div>
</div>
<div class="slider responsive" style="width: <?=$width;?>px; height:<?=$height;?>px;">

    <?php
    //get story pages
    if(is_dir($story_path."/pages")){
        $jsonPath=$story_path."/pages.json";
        if(is_file($jsonPath)) {
            $pages=json_decode(file_get_contents($jsonPath),true);
        }else{
            $pages=array();
        }
        $i=0;
        $tempPages=array();
        //foreach(scandir($story_path."/pages") as $page){
        $dots='';
        $javaPages=array();
        $selected="true";
        foreach($pages as $pageid=>$page){

            $class="page-".($i);
            $i++;
//                        echo $page."<br>";
            //  $pageid=str_replace(".str","",$page);
            if($pages[$pageid]["thumb"]==""){
                $pages[$pageid]["thumb"]=SITE_URL."storyeditor/thems/En/images/folder.svg";
            }else{
                $pages[$pageid]["thumb"]=SITE_URL.$story_path."/images/".$pages[$pageid]["thumb"];
            }
            $dots.='<li class="jq_slide"  aria-hidden="true" role="presentation" aria-selected="'.$selected.'" aria-controls="navigation'.$i.'" id="slick-slide'.$i.'"><button type="button" data-role="none" role="button" tabindex="0">'.$i.'</button></li>';
            echo "<div class='slide-item' bg_sound='".$pages[$pageid]["bg_sound"]."' >".file_get_contents(SITE_URL.$story_path."/pages/".$pageid.".str")."</div>";
            $selected="false";
        }
        //exit();
    }else{
        echo "not dir ".$story_path."/pages";
        exit();
    }

    ?>

</div>






<script type="text/javascript" src="<?=SITE_URL;?>/storyeditor/viewer/js/jquery.js?<?=$cache;?>"></script>
<script type="text/javascript" src="<?=SITE_URL;?>/storyeditor/viewer/slick/jquery-migrate-1.2.js?<?=$cache;?>"></script>
<script type="text/javascript" src="<?=SITE_URL;?>/storyeditor/viewer/js/slick.min.js?<?=$cache;?>"></script>
<script type="text/javascript" src="<?=SITE_URL;?>/storyeditor/viewer/js/magazine.js?<?=$cache;?>"></script>
<script type="text/javascript" src="<?=SITE_URL;?>storyeditor/viewer/js/howler.core.js?<?=$cache;?>"></script>
<script type="text/javascript" src="<?=SITE_URL;?>storyeditor/viewer/js/sweetalert.min.js?<?=$cache;?>"></script>
<script type="text/javascript" src="<?=SITE_URL;?>storyeditor/viewer/js/manhalLoader1.js?<?=$cache;?>"></script>
<link href="<?=SITE_URL;?>/storyeditor/viewer/css/animate.css?<?=$cache;?>" rel="stylesheet" type="text/css">
<script src="<?=SITE_URL;?>storyeditor/viewer/js/manhal-ui.js?<?=$cache;?>"></script>
<script src="<?= SITE_URL ?>storyeditor/js/WebAudioRecorder.min.js?<?=$cache;?>"></script>



<script type="text/javascript">
    $(document).load(function () {
        $('.disss').remove();
    });
    $(document).ready(function () {
        $('body').manhalLoader({
            splashID: "#jSplash",
            splashVPos: '50%',
            loaderVPos: '90%',
            splashFunction: function () {
                $('<div class="manhal-main-loader"><div class="loader-effect"><div class="checkmark draw"></div>' +
                    '</div><div class="logo-loader"></div></div>').appendTo('#manhalpreOverlay');
            },

            onLoading: function (per) {
                $('.disss').hide();
            },
        }, function () {
            $("#manhalpreOverlay").fadeOut("fast");
            $('.disss').hide();
        });
    })
    calcBookDimentions();
    var AnimationClass="<?=$settings["transition"];?>";
    function Checkanimation() {
        switch (AnimationClass) {
            case "Curtains":
                $('.rnInner').remove();
                $('.slick-active.slick-slide').append("<div class='rnInner-left'><div class='rnUnit-left'></div> <div class='rnUnit-left'></div> <div class='rnUnit-left'></div> <div class='rnUnit-left'></div> <div class='rnUnit-left'></div> </div>");
                $('.slick-active.slick-slide').append("<div class='rnInner-right'><div class='rnUnit-right'></div> <div class='rnUnit-right'></div> <div class='rnUnit-right'></div> <div class='rnUnit-right'></div> <div class='rnUnit-right'></div> </div>");
                setTimeout(function () {
                    $('.rnInner-left,.rnInner-right').addClass("active");
                },100);
                break;
            case "CurtainsLeft":
                $('.rnInner-left').remove();
                $('.slick-active.slick-slide').append("<div class='rnInner'><div class='rnUnit'></div> <div class='rnUnit'></div> <div class='rnUnit'></div> <div class='rnUnit'></div> <div class='rnUnit'></div> <div class='rnUnit'></div> <div class='rnUnit'></div> <div class='rnUnit'></div> <div class='rnUnit'></div> <div class='rnUnit'></div> </div>");
                setTimeout(function () {
                    $('.rnInner').addClass("active");
                },100);
                break;
            case "CurtainsRight":
                $('.rnInner-right').remove();
                $('.slick-active.slick-slide').append("<div class='rnInner-OneWayRight'><div class='rnUnit-OneWayRight'></div> <div class='rnUnit-OneWayRight'></div> <div class='rnUnit-OneWayRight'></div> <div class='rnUnit-OneWayRight'></div> <div class='rnUnit-OneWayRight'></div> <div class='rnUnit-OneWayRight'></div> <div class='rnUnit-OneWayRight'></div> <div class='rnUnit-OneWayRight'></div> <div class='rnUnit-OneWayRight'></div> <div class='rnUnit-OneWayRight'></div> </div>");
                setTimeout(function () {
                    $('.rnInner-OneWayRight').addClass("active");
                },100);
                break;
        }
    }
    function applyHiddenClass() {
        $.each($('.slick-slide'), function() {
            if ($(this).attr('aria-hidden') == 'true') {
                $(this).find('.story-content-container').addClass('hidden');
            } else {
                $(this).find('.story-content-container').removeClass('hidden');
            }
        });
    }
    $(document).ready(function(){
        $('.slider').on('init', function(event, slick) {
            $('.slick-active').children(".story-content-container").hide();
            $('.slick-active .story-content-container').removeClass('hidden');
            $('.slick-active').next().children(".story-content-container").hide();
            $('.slick-active .story-content-container').show().addClass(AnimationClass +" animated");
            Checkanimation();
        });
<?php
        if((isset($settings["arrow"]) && $settings["arrow"]==1)  || !isset($settings["arrow"])){
            $arrow="true";
        }else{
            $arrow="false";
        }

        if((isset($settings["dots"]) && $settings["dots"]==1) || !isset($settings["dots"])){
            $dots="true";
        }else{
            $dots="false";
        }

        if(isset($settings["infinite"]) && $settings["infinite"]==1){
            $infinite="true";
        }else{
            $infinite="false";
        }

        if(isset($settings["autoplay"]) && $settings["autoplay"]==1){
            $autoplay="true";
        }else{
            $autoplay="false";
        }

        if($story["language"]=="ar"){
            $rtl="true";
        }else{
            $rtl="false";
        }


        ?>
            $('.slider').slick({
                arrows: <?=$arrow;?>,
                dots: <?=$dots;?>,
                infinite: <?=$infinite;?>,
                responsive: "unslick",
                slidesToScroll: 1,
                fade:true,
                rtl: <?=$rtl;?>,
                autoplay:<?=$autoplay;?>,
                <?php
                if(isset($settings["align"]) && $settings["align"]=="v"){
                    //Activate Vertical Options//
                    ?>
                     vertical:true,
                     verticalSwiping: true
                <?php
                }
                ?>
            });
            if(<?=$rtl;?>){
                $(".slick-next").css({"left":"1%","right":"auto","transform": "rotate(0deg)"});
                $(".slick-prev").css({"left":"auto","right":"1%","transform": "rotate(0deg)"});
                $(".slick-dots").addClass("rtlA");
                $("body").addClass("rtlA");
                $(".story-content-container").css("transform-origin","100% 0");
                $(".slick-slide").css("float","right");
            }

        var currSlide = 0;
        var nextSlide = 0;
        $('.slider').on('afterChange', function(event, slick, currentSlide) {
            nextSlide = currentSlide;
            if (nextSlide !== currSlide) {
                $('.slick-active .story-content-container').removeClass(AnimationClass+" animated");
                $('.slick-active .story-content-container').addClass('hidden');
                // alert("afterChange");
                $('.slick-active').prev().children(".story-content-container").hide();
                Checkanimation();
            }
            stopAllVideos();
            stopAllSubtitles();
            //$(".element").hide();
            // setTimeout(function () {
            //     animateWidgets(page);
            // },1);
            playBgSound($(".slider").slick("slickCurrentSlide")+1);
        });
        $('.slider').on('setPosition', function(event, slick, currentSlide) {
            if (nextSlide !== currSlide) {
                $('.slick-active .story-content-container').removeClass('hidden');
                $('.slick-active .story-content-container').show().addClass(AnimationClass +" animated");
                Checkanimation();
            }
            applyHiddenClass();
        });
        $('.slider').on('beforeChange', function(event, slick, currentSlide) {
            currSlide = currentSlide;
            $('.slick-active').next().children(".story-content-container").hide();

        });
        setTimeout(function () {
            playBgSound($(".slider").slick("slickCurrentSlide")+1);
            interactions();
        },1);
    });
</script>

</body>
</html>