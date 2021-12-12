<?php
//echo $_GET["media_id"];
//exit();
include_once "includes/function.php";
$sql="SELECT `media`.*, `categories`.* FROM `media` JOIN `categories` ON `media`.`category`=`categories`.`catid` WHERE `media`.`id`=".$_GET["media_id"];
$result=$con->query($sql);
if(mysqli_num_rows($result)<1){
    header("location: ".SITE_URL);
    exit();
}

$playlist=mysqli_fetch_assoc($result);
if($playlist["price"]!=0 && !Areyousubscribe()){
    //check if app web view
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,SITE_URL."APIs/manhal/secret.php");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "process=secret");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $server_secret = curl_exec ($ch);
    if(isset($_GET["secret"]) && $_GET["secret"]==$server_secret && isset($_GET["userid"])){
        if(!isSubscribed($_GET["userid"])){
            echo isSubscribed($_GET["userid"])."sub";
            exit();
            if(isset($_SESSION["lang"]) && $_SESSION["lang"]=="Ar"){
                header("location:".SITE_URL.strtolower($_SESSION["lang"]));
            }else{
                header("location:".SITE_URL);
            }
            exit();
        }
    }else{
//        echo $server_secret."<br>";
//        echo $_GET["secret"];
//        exit();
        if(isset($_SESSION["lang"]) && $_SESSION["lang"]=="Ar"){
            header("location:".SITE_URL.strtolower($_SESSION["lang"]));
        }else{
            header("location:".SITE_URL);
        }
        exit();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="DBQJWUrSssgyrqwlbkvxH8Ovt4CZbvlWcqxDhneX">
    <title><?=$playlist["title_".$cat_code];?></title>
    <link rel="icon" href="https://lms.manhal.com/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&amp;subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <link href="<?= SITE_URL; ?>themes/main-Light-green-En/css/playlistEn.css" rel="stylesheet">
    <script src="<?= SITE_URL; ?>js/jquery.js"></script>
    <script src="<?= SITE_URL; ?>js/playlistviwer.js"></script>
</head>
<body class="theme-manhalgreen overlay-open ls-closed">
<!--Page Loader-->
<div class="page-loader-wrapper" style="display:none;">
    <div class="loader">
        <div class="preloader">
            <div class="spinner-layer pl-red">
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>please wait...</p>
    </div>
</div>
<!-- #END# Page Loader -->
<!-- Overlay For Sidebars -->
<div class="overlay"></div>
<!-- #END# Overlay For Sidebars -->
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid homework" id="homework-viewer" homeworkid="51">
        <div class="col-sm-12 col-lg-12 col-md-12">
            <div class="col-sm-5 col-lg-5 col-md-5 float-left">
                <div class="category-icon-container float-left" title="Homeworks" style="background-image:url(<?=SITE_URL;?>themes/main-Light-green-<?=ucfirst($lang_code);?>/images/cat/books/<?=$playlist["category"];?>.svg);">

                </div>
                <h1 class="lesson-title-container float-left" title="<?=$playlist["title_".$cat_code];?>"><?=$playlist["title_".$cat_code];?></h1>
                <div class="separateing-line-container float-left"></div>
                <label class="level-title-container float-left" title="<?=$playlist["name_".$cat_code];?>"><?=$playlist["name_".$cat_code];?></label>
            </div>
            <div class="col-sm-7 col-lg-7 col-md-7 float-right">
                <div class="float-right">
                    <div class="points-awards-container float-left" title="<?=$Lang->Points;?>">
                        <div class="imagepoints floating-left"></div>
                        <div class="num floating-left user-points">
                            0%
                        </div>
                    </div>
                    <div class="separateing-line-container float-left"></div>
                    <div class="points-awards-container float-left" title="<?=$Lang->Awards;?>">
                        <div class="imageawards floating-left"></div>
                        <div class="num floating-left user-awards">
                            0
                        </div>
                    </div>
                    <div class="separateing-line-container float-left"></div>
                    <div class="rate-container float-left" title="<?=$Lang->Progressrate;?>">
                        <div class="imagerate floating-left"></div>
                        <div class="num floating-left user-progress">
                            0%
                        </div>
                    </div>
                    <div class="separateing-line-container float-left"></div>
                    <div class="exit-container float-left homework-exit"></div>
                </div>
            </div>
        </div>
    </div>
</nav>
<section class="content" style="height: 913px;">
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar lesson-viewer" lessonid="51">
            <a class="bars"></a>
            <div class="vertical-slider-viewer" style="height: 862px;">
                <input type="hidden" id="homeworkid" value="51">
                <ul class="hide-bullets" id="lesson_item_container">
                    <?php
                    $sql="SELECT `playlist_media`.*,`media`.* from `playlist_media` INNER JOIN `media` ON `playlist_media`.`mediaid`=`media`.`id` WHERE `playlist_media`.`playlistid`=".$_GET["media_id"]." ORDER BY `playlist_media`.`play_media_id` ";
                    $result=$con->query($sql);
                    $i=0;
                    while($media=mysqli_fetch_assoc($result)){
                        if($media["path"] == "") {
                            $hrf =SITE_URL.'platform/media/' . $media['id'] . '/' . $media['filename'] .".".getEXT($media["type"]);
                        } else {
                            $hrf =SITE_URL.$media["path"];
                        }
                        if($media["type"]==3){
                            $hrf=SITE_URL."mediaviewer.php?type=audio&path=".urlencode($hrf);
                        }elseif($media["type"]==4){
                            $hrf=SITE_URL."mediaviewer.php?type=video&path=".urlencode($hrf);
                        }
                        $selected="";
                        if(isset($_GET["selected"]) && $media["id"]==$_GET["selected"]){
                            $selected="selected";
                            $selected_href=$hrf;
                        }elseif(!isset($_GET["selected"]) && $i==0){
                            $selected="selected";
                            $selected_href=$hrf;
                        }




                        ?>
                        <li class="col-sm-12 col-md-12 col-lg-12 jq_media_item    <?=$selected;?>" id="media_<?=$media["id"];?>" score="0" src-attr="<?=$hrf;?>">
                                <div class="item-seen  float-right" id="seen_<?=$media["id"];?>"></div>
                            <a class="thumbnail jq_media_title" id="carousel-selector-1" title="<?=$media["title_".$cat_code];?>">
                                <img src="<?=getThumb($media);?>">
                            </a>
                        </li>
                    <?php
                        $i++;
                    }
                    ?>
                </ul>
            </div>
            <div class="legal">
                <div class="copyright">
                    <div class="version"></div>
                </div>
            </div>
        </aside>
        <!-- #END# Left Sidebar --></section>
    <div class="row clearfix">
        <div class="button-wrap">
            <div class="button">
                <a class="arrow-next"></a>
            </div>
            <div class="tool-tip">Next</div>
        </div>
        <iframe class="lesson-viewer-iframe" src="<?=$selected_href;?>" style="height: 913px;" media_id="1128"></iframe>
        <a class="arrow-prev pause"></a>
    </div>
</section>


</body>
<script>
//    $(document).ready(function(){
//        $(".lesson-viewer .vertical-slider-viewer").animate({scrollTop: parseInt($(".vertical-slider-viewer ul li.selected").offset().top - 103)});
//    });
    $(window).load(function(){
        $(".lesson-viewer .vertical-slider-viewer").animate({scrollTop: parseInt($(".vertical-slider-viewer ul li.selected").offset().top - 103)});
    });
</script>
</html>