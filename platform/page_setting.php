<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/10/2016
 * Time: 8:10 AM
 */
include_once "config.php";
include_once "includes/language.php";
if(is_file("books/".$_GET['bookid']."/".$_GET['pageid'].".jpg")){
    $currentBG="books/".$_GET['bookid']."/".$_GET['pageid'].".jpg";
}else{
    $currentBG="";
}
$sql="SELECT * FROM `pages` WHERE `pageid`=".$_GET['pageid']." AND `bookid`=".$_GET['bookid'];
$result = $con->query($sql);
$row = mysqli_fetch_assoc($result);

if($row['is_index']==1){
    $isIndex="checked";
}else{
    $isIndex="";
}

?>

<form id="sound_form" onsubmit="javascript:showLoading();" method="POST" action="ajax/editor.php?process=updateapage" enctype="multipart/form-data" target="upload_target">
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->uploadBackground;?></label>
        <div class="fu-container-a floating-left">
            <label class="floating-left flaticon-cloud148 label-a"></label>
            <label class="label-b floating-left" id="lblbg"></label>
            <input id="bg" type="file" name="bg">
            <img src="<?=$currentBG;?>">
        </div>
    </div>
    <a id="romve_bg">remove Background</a>
    <div class="line-row-b">
        <label class="lbl-data-a floating-left"><?=$Lang->uploadNegative;?></label>
        <div class="fu-container-a floating-left">
            <label class="floating-left flaticon-cloud148 label-a"></label>
            <label class="label-b floating-left" id="lblnegativebg"></label>
            <input id="negativebg" type="file" name="negativebg">
        </div>
    </div>
        <div class="line-row-b">
            <label class="lbl-data-a floating-left"><?=$Lang->Title;?></label>
            <input class="txt-a floating-left" type="text" name="title" id="title" placeholder="<?=$Lang->Title;?>" value="<?=$row['title'];?>">
        </div>
        <div class="line-row-b">
            <label class="lbl-data-a floating-left"><?=$Lang->SubTitle;?></label>
            <input class="txt-a floating-left" type="text" name="subtitle" id="subtitle" placeholder="<?=$Lang->SubTitle;?>" value="<?=$row['subtitle'];?>">
        </div>
        <div class="line-row-b">
            <label class="lbl-data-a floating-left"><?=$Lang->Height;?></label>
            <input class="txt-a floating-left" type="text" name="height" id="height" placeholder="<?=$Lang->Height;?>" value="<?=$row['height'];?>">
        </div>
        <div class="line-row-b">
            <label class="lbl-data-a floating-left"><?=$Lang->Width;?></label>
            <input class="txt-a floating-left" type="text" name="width" id="width" placeholder="<?=$Lang->Width;?>"  value="<?=$row['width'];?>">
        </div>
        <div class="line-row-b">
            <label class="lbl-data-a floating-left" for="isindex"><?=$Lang->Index;?></label>
            <div class="section-check">
                <ul>
                    <li class="floating-left">
                        <label class="input-control checkbox floating-left">
                            <input type="checkbox" name="isindex" id="isindex" value="1" <?=$isIndex;?>>
                            <span  class="check"></span>
                        </label>
                        <label for="answer_3" class="text floating-left"></label>
                    </li>
                </ul>
            </div>
        </div>
        <div class="line-row-b">
            <input type="submit" class="btn-default floating-right" id="update_page" value="<?=$Lang->Update;?>">
            <input type="hidden" id="pageid" name="pageid" value="<?=$_GET['pageid'];?>">
            <input type="hidden" id="bookid" name="bookid" value="<?=$_GET['bookid'];?>">
        </div>
</form>