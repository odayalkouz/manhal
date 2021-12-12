<?php
$sql="Select media.*, categories.name_ar, categories.name_en From media Inner Join categories On media.category = categories.catid   where   media.type=0 and  media.status=1 and media.id=".$_GET['id'];
$result = $con->query($sql);
$row=mysqli_fetch_assoc($result);
$id=uniqid(rand(10000,99999), true);

if($row['price']>0 && Areyousubscribe()==0) {
    header("location:".SITE_URL.strtolower($session_lang).'/subscribe');
    die();
}
$sql="UPDATE `media` SET `views`=`views`+1 WHERE id=".$_GET['id'];
$con->query($sql);
include("includes/header.php");
?>
    <section class="inner-pages-main-container-view-item">
    <?=$breadCrumbs;?>
    </section>
<style>
    .site-container {
        position:relative;
    }
    .center-piece
    {
        overflow:visible;
        position:relative;
    }
</style>
<?php
$hrf=SITE_URL . 'platform/media/' . $row['id'] . '/thumbnail.jpg';
if($row['price']==0 || Areyousubscribe()==1)
{
    $hrf = "" . SITE_URL .'ViewerJS/index.html#../'. 'platform/media/' . $row['id'] . '/' . $row['filename'] . ".pdf";
}
else
{
    $hrf = "" . SITE_URL .'platform/media/' . $row['id'] . '/' . "indexmark.jpg";
}
?>
<div class="center-piece">
    <div class="top-container-games">
        <div class="worksheet-image"></div>
        <label class="game-title floating-left"><?=$row["title_".$cat_code];?></label>
    </div>
    <div class="Game-play-main-container">
        <iframe class="Game-play-iframe"  src="<?=$hrf?>" frameborder="0px"></iframe>
    </div>
</div>
<!--ViewerJS/#../test.pdf-->