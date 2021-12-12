<?php
/**
 * User: Hussam Abu Khadijeh    Dar Al-Manhal
 * Date: 23/8/2016
 * Time: 10:32 AM
 */
$cuerrentpage="stories.php";
if(session_status()==PHP_SESSION_NONE){ session_start();}

include_once('config.php') ;
include_once('includes/language.php') ;
include_once('includes/function.php') ;

if(isset($_GET['id']) && $_GET['id']=="new"){
    $sql ="INSERT INTO series (seriesid,userid,cdate) VALUES ('',".$_SESSION["user"]["userid"].",CURRENT_DATE)";
    $con->query($sql);
    $id=mysqli_insert_id($con);

    $path="stories/".$id;
    if(!is_dir($path)){
        @mkdir($path);
        copyDirectory("../templates/temp_series",$path."/");
    }
    header("location: editseries.php?id=".$id);
    exit();
}

$sql ="SELECT * FROM `series` WHERE seriesid=".$_GET['id'];
$result = $con->query($sql);
if (mysqli_num_rows($result) > 0) {
    $data='';
    $row = mysqli_fetch_assoc($result);
}
?>
<?php
$bredcrumb = '<li class="floating-left"><a href="series.php" class="floating-left">'.$Lang->Series.'</a></li><span class="floating-left">/</span><li class="floating-left"><a href="editseries.php" class="floating-left active">'.$Lang->EditSeries.'</a></li>';

include "includes/header.php";
?>
<div class="edit-book">
    <div class="form-container">
        <form id="editbook">
            <input type="hidden" name="seriesid" id="seriesid" value="<?= $_GET['id']; ?>">
            <div class="display-inline-block floating-left">
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Title ?></label>
                    <input type="text" class="txt-a floating-left" id="title" name="title" placeholder="<?= $Lang->Title ?>" value="<?=$row["name"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Description;?></label>
                    <textarea class="floating-left txt-b" name="description" id="description" placeholder="<?= $Lang->Description;?>"><?=$row['description'];?></textarea>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?= $Lang->Category ?>
                    </label>
                    <select class="txt-a floating-left" id="category" name="category">
                        <?php
                        $cat_sql = "Select * From  stories_cat";
                        $cat_result = $con->query($cat_sql);
                        if (mysqli_num_rows($cat_result) > 0) {
                            while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                                $selected='';
                                if($cat_row['catid']==$row["category"]){
                                    $selected='selected';
                                }
                                echo "<option ".$selected." value='".$cat_row['catid']."'>".$cat_row['name_'.$lang_code]."</option>";
                            }
                        }
                        ?>


                    </select>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->ParentAdvice;?></label>
                    <textarea class="floating-left txt-b" name="parenttext" id="parenttext" placeholder="<?= $Lang->ParentAdvice;?>"><?=$row['advice'];?></textarea>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Thumbnail;?></label>
                    <div class="fu-container-a floating-left">
                        <label class="floating-left flaticon-cloud148 label-a"></label>
                        <label class="label-b floating-left" id="lblbook_cover"></label>
                        <input onchange="readImg(this,'book_cover_img')" class="txt-a floating-left" id="story_cover" type="file" name="story_cover" placeholder="<?= $Lang->FrontCover;?>" value="">
                    </div>
                </div>
        </form>
        <form id="series_form" action="ajax/editor.php?process=soundseries&seriesid=<?=$row['seriesid'];?>" method="post" target="hidden_iframe" enctype="multipart/form-data">
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->AdviceSound;?></label>
                <div class="fu-container-a floating-left">
                    <label class="floating-left flaticon-cloud148 label-a"></label>
                    <label class="label-b floating-left" id="lblparent_sound"></label>
                    <input class="txt-a floating-left" id="parent_sound" type="file" name="parent_sound" placeholder="<?= $Lang->AdviceSound;?>" value="">
                </div>
                <audio controls>
                    <source src="stories/<?=$row["seriesid"];?>/sound/adviceChild.mp3" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->BackgroundSound;?></label>
                <div class="fu-container-a floating-left">
                    <label class="floating-left flaticon-cloud148 label-a"></label>
                    <label class="label-b floating-left" id="lbltitle_sound"></label>
                    <input class="txt-a floating-left" id="bgsound" type="file" name="bgsound" placeholder="<?= $Lang->BackgroundSound;?>" value="">
                </div>
                <audio controls>
                    <source src="stories/<?=$row["seriesid"];?>/sound/bgstory.mp3" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
            </div>
        </form>
    </div>
    <iframe id="hidden_iframe" name="hidden_iframe" style="width: 0px;height: 0px;"></iframe>
    <div class="line-row">
        <?php
        if(is_file("stories/".$row["seriesid"]."/images/Thumb.png")){
            $src="stories/".$row["seriesid"]."/images/Thumb.png";
        }else{
            $src="";
        }
        ?>
        <img class="book-cover-img" id="book_cover_img" src="<?=$src;?>">
    </div>
    <input name="commit" id="update_series" type="button" value="<?= $Lang->Update;?>" class="btn-default-a floating-right clear-both">
</div>
</div>
<?php
include "includes/footer.php";
?>
