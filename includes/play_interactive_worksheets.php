<?php

$sql="Select media.*, categories.name_ar, categories.name_en From media Inner Join categories On media.category = categories.catid   where   media.type=12 and  media.status=1 and media.id=".$_GET['id'];
$result = $con->query($sql);
$row=mysqli_fetch_assoc($result);
$id=uniqid(rand(10000,99999), true);

if($row['price']>0 && Areyousubscribe()==0) {
    header("location:".SITE_URL.strtolower($session_lang).'/subscribe');
    die();
}
$sql="UPDATE `media` SET `download`=`download`+1 WHERE id=".$_GET['id'];
$con->query($sql);
include("includes/header.php");


?>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-74397962-2', 'auto');
    ga('send', 'pageview');

</script>
    <script src="<?=SITE_URL;?>js/js.js"></script>
    <script src="<?=SITE_URL;?>js/tra.js"></script>
    <script src="<?=SITE_URL;?>js/jquery.full.screen.js"></script>
<section class="inner-pages-main-container-view-item">
    <?=$breadCrumbs;?>
    </section>
<?php
if($row["path"]==""){
    $hrf = "" . SITE_URL . 'platform/media/' . $row['id'] . '/' . $row['filename'] . ".html";
}else{
    $hrf = "" . SITE_URL . '/'.$row["path"];
}
?>
<style>
    .site-container {
        background: url(<?=SITE_URL;?>themes/main-Light-green-<?=$session_lang;?>/images/pattern-viewgame.svg) repeat;
        position: relative;
    }
</style>

<div class="center-piece">
    <div class="top-container-games">
        <div class="game-image"></div>
        <div  class="full-screen-icon"></div>
        <label class="game-title floating-left"><?=$row["title_".$cat_code];?></label>
    </div>
    <div class="Game-play-main-container" data-target=".demo">

        <iframe class="Game-play-iframe" src="<?=$hrf?>" frameborder="0px"></iframe>
    </div>
</div>
<script>
    var t = $('.full-screen-icon').text();
    $('.full-screen-icon').fullscreen({
        onenter: function()
        {
            $('.full-screen-icon').text();
        },
        onexit: function()
        {
            $('.full-screen-icon').text(t);
        }
    });
</script>


