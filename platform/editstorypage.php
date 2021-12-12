<?php
/**
 * User: Hussam Abu Khadijeh    Dar Al-Manhal
 * Date: 26/10/2016
 * Time: 2:17 PM
 */
$cuerrentpage="stories.php";
if(session_status()==PHP_SESSION_NONE){ session_start();}

include_once('config.php') ;
include_once('includes/language.php') ;
include_once('includes/function.php') ;

if(isset($_GET['pageid']) && $_GET['pageid']=="new"){

    $sql ="SELECT max(`sorting`) as sortindex FROM `storypages` WHERE `idstory`=".$_GET["storyid"];
    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        $sortIndex=$row["sortindex"]+1;
    }else{
        $sortIndex=1;
    }

    $sql ="INSERT INTO `storypages`(`id`, `idstory`, `cdate`,`sorting`) VALUES ('',".$_GET["storyid"].",CURDATE(),".$sortIndex.")";
    $con->query($sql);
    $id=mysqli_insert_id($con);

    header("location: editstorypage.php?storyid=".$_GET["storyid"]."&pageid=".$id."&seriesid=".$_GET["seriesid"]);
    exit();
}


$sql ="SELECT * FROM storypages WHERE id=".$_GET['pageid'];
$result = $con->query($sql);
//if (mysqli_num_rows($result) > 0) {
$data='';
$row = mysqli_fetch_assoc($result);
//}
?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<!--<script type="text/javascript" src="js/ajax.js"></script>-->



<?php
include "includes/header.php";
?>
<div class="edit-book">
    <div class="title-pages text-left">
        <h1><?= $Lang->EditPage ?></h1>
    </div>
    <div class="form-container">
        <form id="editstorypage" action="ajax/editor.php?process=uploadpagesound" enctype="multipart/form-data" METHOD="POST" target="hidden_iframe">
            <input type="hidden" name="storyid" id="storyid" value="<?=$_GET['storyid'];?>">
            <input type="hidden" name="seriesid" id="seriesid" value="<?=$_GET['seriesid'];?>">
            <input type="hidden" name="pageid" id="pageid" value="<?=$_GET['pageid'];?>">
            <div class="display-inline-block floating-left">
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Text;?></label>
                    <textarea class="txt-d floating-left" id="text" name="text" placeholder="<?= $Lang->Text;?>"><?=$row["text"];?></textarea>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?=$Lang->Thumb;?></label>
                    <div class="fu-container-a floating-left">
                        <label class="floating-left flaticon-cloud148 label-a"></label>
                        <label class="label-b floating-left" id="story_cover"></label>
                        <input onchange="readImg(this,'page_thumb')" class="txt-a floating-left" id="story_cover" type="file" name="story_cover" placeholder="<?= $Lang->Thumb;?>" value="">
                    </div>
                    <?php
                    if(is_file($row["image"])){
                        $src=$row["image"];
                    }else{
                        $src="";
                    }
                    ?>
                    <img class="book-cover-img floating-left" id="page_thumb" src="<?=$src;?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Sound;?></label>
                    <div class="fu-container-a floating-left">
                        <label class="floating-left flaticon-cloud148 label-a"></label>
                        <label class="label-b floating-left" id="lblsound"></label>
                        <input class="txt-a floating-left" id="sound" type="file" name="sound" placeholder="<?= $Lang->Sound;?>" value="">
                    </div>
                    <audio controls>
                        <?php
                        if(strpos($row["sound"],"sound/")===false){
?>
                            <source src="stories/<?=$_GET["seriesid"];?>/story/<?=$_GET['storyid'];?>/sound/<?=$row["sound"];?>" type="audio/mpeg">
                        <?php
                        }else{
                            ?>
                            <source src="stories/<?=$_GET["seriesid"];?>/story/<?=$_GET['storyid'];?>/sound/<?=$_GET['pageid'];?>.mp3" type="audio/mpeg">
                        <?php
                        }
                        ?>

                        Your browser does not support the audio element.
                    </audio>

                    <?php
                     ?>
                </div>
        </form>
    </div>
    <iframe id="hidden_iframe" name="hidden_iframe" style="width: 0px;height: 0px;border-width: 0px;"></iframe>
    <input name="commit" id="update_story_page" type="button" value="<?= $Lang->Update;?>" class="btn-default-a floating-right clear-both">
    <a name="soundAligner" target="_blank" id="sound_aligner" type="button" value="<?= $Lang->Sound;?>" href="waveSurf/index.php?pageid=<?=$_GET['pageid'];?>&storyid=<?=$_GET['storyid'];?>&seriesid=<?=$_GET['seriesid'];?>" class="btn-default-a floating-right clear-both"><?= $Lang->Sound;?></a>
</div>
</div>

<?php
include "includes/footer.php";
?>
