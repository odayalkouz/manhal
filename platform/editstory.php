<?php
/**
 * User: Hussam Abu Khadijeh    Dar Al-Manhal
 * Date: 1/4/2016
 * Time: 1:17 PM
 */
$cuerrentpage="stories.php";
if(session_status()==PHP_SESSION_NONE){ session_start();}

include_once('config.php') ;
include_once('includes/language.php') ;
include_once('includes/function.php') ;

if(isset($_GET['id']) && $_GET['id']=="new"){
    $sql ="INSERT INTO story (storyid,seriesid,userid) VALUES ('',0,".$_SESSION["user"]["userid"].")";
    $con->query($sql);
    $id=mysqli_insert_id($con);

    $path="stories/0/story/".$id;
    if(!is_dir($path)){
        //add user
        @mkdir($path);
        copyDirectory("../templates/temp_story",$path."/");
    }
    header("location: editstory.php?id=".$id);
    exit();
}


$sql ="SELECT * FROM story WHERE storyid=".$_GET['id'];
$result = $con->query($sql);
//if (mysqli_num_rows($result) > 0) {
    $data='';
    $row = mysqli_fetch_assoc($result);
//}
?>
<!--<script type="text/javascript" src="js/jquery.js"></script>-->
<!--<script type="text/javascript" src="js/ajax.js"></script>-->



<?php

$bredcrumb = '<li class="floating-left"><a href="stories.php" class="floating-left">'.$Lang->Stories.'</a></li><span class="floating-left">/</span><li class="floating-left"><a href="editstory.php" class="floating-left">'.$Lang->EditPageStory.'</a></li>';

include "includes/header.php";
?>
<link rel="stylesheet" type="text/css" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/fonts/font-awesome/css/font-awesome.min.css"/>
<script type="text/javascript" src="../js/jquery.popline.min.js"></script>
<link rel="stylesheet" type="text/css" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/css/default.css">
<script type="text/javascript" >
    $(document).ready(function() {
        $(".poplineable").popline();
    });
    ////start khalid 19-9-2016
    function removeimage(image) {


        $(image).parent().find('#scrimg').hide();
        setdata = {TypeProcesses: 'deletefile',file:"../"+ $(image).parent().find('#scrimg').attr('src')};
        $.ajax({
            url: "ajax/function.php",
            type: "POST",
            data: setdata,
            cache: false,
            dataType: 'html',

            success: function (html) {
                console.clear();
                console.log(html);

            }
        });
    }
    function removesound(sound) {

        setdata = {TypeProcesses: 'deletefile',file:"../"+sound};
        $.ajax({
            url: "ajax/function.php",
            type: "POST",
            data: setdata,
            cache: false,
            dataType: 'html',

            success: function (html) {
                console.clear();
                console.log(html);

            }
        });
    }

    ////end khalid 19-9-2016
</script>
<div class="edit-book">
    <div class="form-container">
        <form id="editbook">
            <input type="hidden" name="story_id" id="story_id" value="<?= $_GET['id']; ?>">
            <input type="hidden" name="series_id" id="series_id" value="<?=$row["seriesid"];?>">
            <div class="display-inline-block floating-left">
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Title ?></label>
                    <input type="text" class="txt-a floating-left" id="title" name="title" placeholder="<?= $Lang->Title ?>" value="<?=$row["title"];?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->BookRWidth ?></label>
                    <input type="text" class="txt-a floating-left" id="actual_width" name="actual_width" placeholder="<?= $Lang->BookRWidth ?>" value="<?=$row["awidth"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->BookRHeight ?></label>
                    <input type="text" class="txt-a floating-left" id="actual_height" name="actual_height" placeholder="<?= $Lang->BookRHeight ?>" value="<?=$row["aheight"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->StoryWeight?></label>
                    <input type="text" class="txt-a floating-left" id="story_weight" name="story_weight" placeholder="<?= $Lang->StoryWeight ?>" value="<?=$row["weight"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->AuthorEn ?></label>
                    <input type="text" class="txt-a floating-left" id="story_author_en" name="story_author_en" placeholder="<?= $Lang->AuthorEn;?>" value="<?=$row["author_en"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->AuthorAr ?></label>
                    <input type="text" class="txt-a floating-left" id="story_author_ar" name="story_author_ar" placeholder="<?= $Lang->AuthorAr;?>" value="<?=$row["author_ar"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->ISBN ?></label>
                    <input type="text" class="txt-a floating-left" id="story_isbn" name="story_isbn" placeholder="<?= $Lang->ISBN;?>" value="<?=$row["isbn"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->NoFiling ?></label>
                    <input type="text" class="txt-a floating-left" id="story_register" name="story_register" placeholder="<?= $Lang->NoFiling;?>" value="<?=$row["filling"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Numberofpages ?></label>
                    <input type="text" class="txt-a floating-left" id="story_pagescount" name="story_pagescount" placeholder="<?= $Lang->Numberofpages;?>" value="<?=$row["pages_count"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?=$Lang->Binding;?>
                    </label>
                    <select class="txt-a floating-left" id="book_binding" name="book_binding">
                        <option value="0" <?php if($row["covertype"]==0){echo 'selected';}?> ><?=$Lang->SoftCover;?></option>
                        <option value="1" <?php if($row["covertype"]==1){echo 'selected';}?> ><?=$Lang->HardCover;?></option>
                    </select>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?=$Lang->Age;?>
                    </label>
                    <select class="txt-a floating-left" id="book_age" name="book_age">
                        <option value="-1" <?php if($row["age"]==-1){echo 'selected';}?> ><?=$Lang->all;?></option>
                        <option value="1" <?php if($row["age"]==1){echo 'selected';}?> >4-5</option>
                        <option value="2" <?php if($row["age"]==2){echo 'selected';}?> >6-8</option>
                        <option value="3" <?php if($row["age"]==3){echo 'selected';}?> >9-11</option>
                        <option value="4" <?php if($row["age"]==4){echo 'selected';}?> >12-15</option>
                    </select>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->PublishYear;?></label>
                    <input type="text" class="txt-a floating-left" id="publish_year" name="publish_year" placeholder="<?= $Lang->PublishYear;?>" value="<?=$row["year"]; ?>">
                </div>
                <div class="line-row">

                    <label class="lbl-data-a floating-left">oldPrice</label>

                    <input type="text" class="txt-a floating-left" id="oldbook_price" name="oldbook_price" placeholder="oldPrice" value="<?=$row["oldprice"]; ?>">

                </div>
                <div class="line-row">

                    <label class="lbl-data-a floating-left"><?= $Lang->Price;?></label>
                    <input type="text" class="txt-a floating-left" id="book_price" name="book_price" placeholder="<?= $Lang->Price;?>" value="<?=$row["price"]; ?>">
                </div>

                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->eprice;?></label>
                    <input type="text" class="txt-a floating-left" id="book_eprice" name="book_eprice" placeholder="<?= $Lang->eprice;?>" value="<?=$row["eprice"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->iprice;?></label>
                    <input type="text" class="txt-a floating-left" id="book_iprice" name="book_iprice" placeholder="<?= $Lang->iprice;?>" value="<?=$row["iprice"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->FirstPage;?></label>
                    <input type="text" class="txt-a floating-left" id="firstpage" name="firstpage" placeholder="<?= $Lang->FirstPage;?>" value="<?=$row["range_first"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->LastPage;?></label>
                    <input type="text" class="txt-a floating-left" id="lastpage" name="lastpage" placeholder="<?= $Lang->LastPage;?>" value="<?=$row["range_end"]; ?>">
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?= $Lang->Category ?>
                    </label>
                    <select class="txt-a floating-left" id="category" name="Category">
                        <?php
                        $cat_sql = "Select * From  stories_cat";
                        $cat_result = $con->query($cat_sql);
                        if (mysqli_num_rows($cat_result) > 0) {
                            while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                                $selected='';
//start khalid 19-9-2016
                                if($cat_row['catid']==$row["catid"]){
                                    $selected='selected';
                                }
                                echo "<option ".$selected." value='".$cat_row['catid']."'>".$cat_row['name_'.$lang_code]."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?= $Lang->Series ?>
                    </label>
                    <select class="txt-a floating-left" id="series" name="series">
                        <?php
                        $sql = "SELECT * FROM `series`";
                        $result = $con->query($sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($series_row = mysqli_fetch_assoc($result)) {
                                $selected='';
                                if($series_row['seriesid']==$row["seriesid"]){
                                    $selected='selected';
                                }
                                echo "<option ".$selected." value='".$series_row['seriesid']."'>".$series_row['name']."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="display-inline-block floating-left">

                <div class="line-row">
                    <label class="lbl-data-a floating-left">
                        <?=$Lang->Language;?>
                    </label>
                    <select class="txt-a floating-left" id="language" name="language">
                        <option <?php if($row["language"]=='Ar'){echo "selected='selected'";}?> value='Ar'><?=$Lang->Arabic;?></option>
                        <option <?php if($row["language"]=='En'){echo "selected='selected'";}?> value='En'><?=$Lang->English;?></option>
                        <option <?php if($row["language"]=='Fr'){echo "selected='selected'";}?> value='Fr'><?=$Lang->France;?></option>
                    </select>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->Type;?></label>
                    <input class="floating-left check-box" type="checkbox" name="paper" id="paper" value='1' <?php if($row['type']==1 || $row['type']==3 || $row['type']==5 || $row['type']==7){echo 'checked="checked"';}?>><label class="floating-left lbl-data-b" for="paper"><?=$Lang->PaperCopy;?></label>
                    <input class="floating-left check-box" type="checkbox" name="estory" id="estory" value='2' <?php if($row['type']==2 || $row['type']==3 || $row['type']==6 || $row['type']==7){echo 'checked="checked"';}?>><label class="floating-left floating-left lbl-data-b" for="estory"><?=$Lang->ElectronicCopy;?></label>
                    <input class="floating-left check-box" type="checkbox" name="interactive" id="interactive" value='4' <?php if($row['type']==4 || $row['type']==5 || $row['type']==6 || $row['type']==7){echo 'checked="checked"';}?>><label class="floating-left floating-left lbl-data-b" for="interactive"><?=$Lang->InteractiveCopy;?></label>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left">Package</label>
                    <input class="floating-left check-box" type="checkbox" name="package" id="package" value='<?=$row['package']?>' <?php if($row['package']==1){echo 'checked="checked"';}?>><label class="floating-left lbl-data-b" for="package">Package</label>

                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->DescriptionAr;?></label>
                    <div contenteditable="true" class="floating-left txt-b poplineable" name="descriptionar" id="descriptionar"><?=$row['description_ar'];?></div>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->DescriptionEn;?></label>
                    <div contenteditable="true" class="floating-left txt-b poplineable" name="descriptionen" id="descriptionen"><?=$row['description_en'];?></div>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->SEODescriptionAr;?></label>
                    <textarea class="floating-left txt-b" name="seodescription_ar" id="seodescription_ar" placeholder="<?= $Lang->SEODescriptionAr;?>"><?=$row['sseodescription_ar'];?></textarea>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?=$Lang->SEODescriptionEn;?></label>
                    <textarea class="floating-left txt-b" name="seodescription_en" id="seodescription_en" placeholder="<?= $Lang->SEODescriptionEn;?>"><?=$row['sseodescription_en'];?></textarea>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->ParentAdvice;?></label>
                    <textarea class="floating-left txt-b" name="parenttext" id="parenttext" placeholder="<?= $Lang->ParentAdvice;?>"><?=$row['parenttext'];?></textarea>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->KidsAdvice;?></label>
                    <textarea class="floating-left txt-b" name="kidstext" id="kidstext" placeholder="<?= $Lang->KidsAdvice;?>"><?=$row['kidstext'];?></textarea>
                </div>


                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->FrontCover;?></label>
                    <div class="fu-container-a floating-left">
                        <label class="floating-left flaticon-cloud148 label-a"></label>
                        <label class="label-b floating-left" id="lblbook_cover"></label>
                        <input onchange="readImg(this,'book_cover_img')" class="txt-a floating-left" id="story_cover" type="file" name="story_cover" placeholder="<?= $Lang->FrontCover;?>" value="">
                    </div>
                    <?php
                    if(is_file("stories/".$row["seriesid"]."/story/".$_GET["id"]."/images/pic.jpg")){
                        $src="stories/".$row["seriesid"]."/story/".$_GET["id"]."/images/pic.jpg";
                    }else{
                        $src="";
                    }
                    ?>
                    <img class="book-cover-img floating-left" id="book_cover_img" src="<?=$src;?>">
                    <?php
                    if(is_file("stories/".$row["seriesid"]."/story/".$_GET["id"]."/images/back.jpg")){
                        $src="stories/".$row["seriesid"]."/story/".$_GET["id"]."/images/back.jpg";
                    }else{
                        $src="";
                    }
                    ?>
                </div>
                <div class="line-row">
                    <label class="lbl-data-a floating-left"><?= $Lang->BackCover;?></label>
                    <div class="fu-container-a floating-left">
                        <label class="floating-left flaticon-cloud148 label-a"></label>
                        <label class="label-b floating-left" id="lblback_cover"></label>
                        <input onchange="readImg(this,'back_cover_img')" class="txt-a floating-left" id="back_cover" type="file" name="back_cover" placeholder="<?= $Lang->BackCover;?>" value="">
                    </div>
                    <img class="book-cover-img floating-left" id="back_cover_img" src="<?=$src;?>">
                </div>






                <div class="line-row">
                    <label class="lbl-data-a floating-left">Demo Cover</label>
                    <div class="fu-container-a floating-left">
                        <label class="floating-left flaticon-cloud148 label-a"></label>
                        <label class="label-b floating-left" id="lbldemo_cover"></label>
                        <input onchange="readImg(this,'demo_cover_img')" class="txt-a floating-left" id="demo_cover" type="file" name="demo_cover" placeholder="Demo Cover" value="">
                    </div>
                    <?php
                    if(is_file("stories/".$row["seriesid"]."/story/".$_GET["id"]."/images/demo_cover.jpg")){
                        $src="stories/".$row["seriesid"]."/story/".$_GET["id"]."/images/demo_cover.jpg";
                    }else{
                        $src="";
                    }
                    ?>
                    <img class="demo-cover-img floating-left" id="demo_cover_img" src="<?=$src;?>">


                </div>

        </form>
        <form id="screenshots_form" action="ajax/editor.php?process=screenshotsstory&storyid=<?=$row['storyid'];?>&seriesid=<?=$row['seriesid'];?>" method="post" target="hidden_iframe" enctype="multipart/form-data">
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->ScreenShoots;?></label>
                <div class="fu-container-a floating-left">
                    <label class="floating-left flaticon-cloud148 label-a"></label>
                    <label class="label-b floating-left" id="lblstory_shoots"></label>
                    <input class="txt-a floating-left" id="story_shoots" type="file" name="story_shoots[]" multiple placeholder="<?= $Lang->ScreenShoots;?>" value="">
                </div>
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->PaintPicture;?></label>
                <div class="fu-container-a floating-left">
                    <label class="floating-left flaticon-cloud148 label-a"></label>
                    <label class="label-b floating-left" id="lblpaint_pictures"></label>
                    <input class="txt-a floating-left" id="paint_pictures" type="file" name="paint_pictures[]" multiple placeholder="<?= $Lang->PaintPicture;?>" value="">
                </div>
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->GamesPictures;?></label>
                <div class="fu-container-a floating-left">
                    <label class="floating-left flaticon-cloud148 label-a"></label>
                    <label class="label-b floating-left" id="lblgames_pictures"></label>
                    <input class="txt-a floating-left" id="games_pictures" type="file" name="games_pictures[]" multiple placeholder="<?= $Lang->GamesPictures;?>" value="">
                </div>
            </div>
            <div class="screen-shots-container">
                <?php
                ////start khalid 19-9-2016
                $dir="stories/".$row["seriesid"]."/story/".$_GET["id"]."/images/screenshoots/";
                if (file_exists($dir)) {
                    foreach (scandir($dir) as $item) {
                        if ($item == '.' || $item == '..') continue;

                        echo "<a class='floating-left' ><span onclick='removeimage(this);'><i class='flaticon-delete96'></i></span><img id='scrimg' src='".$dir . "/" . $item."' ></a> ";
                    }
                }
                ////end khalid 19-9-2016
                ?>
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->ParentAdviceSound;?></label>
                <div class="fu-container-a floating-left">
                    <label class="floating-left flaticon-cloud148 label-a"></label>
                    <label class="label-b floating-left" id="lblparent_sound"></label>
                    <input class="txt-a floating-left" id="parent_sound" type="file" name="parent_sound" placeholder="<?= $Lang->ParentAdviceSound;?>" value="">
                </div>
                <audio controls>
                    <source src="stories/<?=$row["seriesid"];?>/story/<?=$_GET["id"];?>/sound/parent.mp3" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
                <a class='floating-left' ><span onclick='removesound("stories/<?=$row["seriesid"];?>/story/<?=$_GET["id"];?>/sound/parent.mp3");'><i style="font-size: 24px !important;" class='flaticon-delete96'></i></span></a>
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->KidsAdviceSound;?></label>
                <div class="fu-container-a floating-left">
                    <label class="floating-left flaticon-cloud148 label-a"></label>
                    <label class="label-b floating-left" id="lblkids_sound"></label>
                    <input class="txt-a floating-left" id="kids_sound" type="file" name="kids_sound" placeholder="<?= $Lang->KidsAdviceSound;?>" value="">
                </div>
                <audio controls>
                    <source src="stories/<?=$row["seriesid"];?>/story/<?=$_GET["id"];?>/sound/kids.mp3" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
                <a class='floating-left' ><span onclick='removesound("stories/<?=$row["seriesid"];?>/story/<?=$_GET["id"];?>/sound/kids.mp3");'><i style="font-size: 24px !important;" class='flaticon-delete96'></i></span></a>
            </div>
            <div class="line-row">
                <label class="lbl-data-a floating-left"><?= $Lang->TitleSound;?></label>
                <div class="fu-container-a floating-left">
                    <label class="floating-left flaticon-cloud148 label-a"></label>
                    <label class="label-b floating-left" id="lbltitle_sound"></label>
                    <input class="txt-a floating-left" id="title_sound" type="file" name="title_sound" placeholder="<?= $Lang->TitleSound;?>" value="">

                </div>
                <audio controls>
                    <source src="stories/<?=$row["seriesid"];?>/story/<?=$_GET["id"];?>/sound/title.mp3" type="audio/mpeg">
                    Your browser does not support the audio element.
                </audio>
                <a class='floating-left' ><span onclick='removesound("stories/<?=$row["seriesid"];?>/story/<?=$_GET["id"];?>/sound/title.mp3");'><i style="font-size: 24px !important;" class='flaticon-delete96'></i></span></a>
            </div>
        </form>
        <div class="line-row">
            <label class="lbl-data-a floating-left"><?= $Lang->isPublished;?></label>
            <input class="floating-left check-box" type="checkbox" name="ispublished" id="ispublished" value='<?=$row['status'];?>' <?php if($row['status']==1){echo 'checked="checked"';}?>><label class="floating-left lbl-data-b" for="ispublished"><?=$Lang->isPublished;?></label>
        </div>
        <div class="line-row">
            <label class="lbl-data-a floating-left" ><?=$Lang->BookStore;?></label>
            <input class="floating-left check-box" type="checkbox" name="Store" id="Store" value='<?=$row['store'];?>' <?php if($row['store']==1){echo 'checked="checked"';}?>><label class="floating-left lbl-data-b" for="Store"><?=$Lang->BookStore;?></label>
        </div>

        <div class="line-row">
            <label class="lbl-data-a floating-left">
                <?=$Lang->Publishers;?>
            </label>
            <select class="txt-a floating-left" id="Publishers" name="Publishers">
                <option value="0">------------</option>
                <?php
                $cat_sql = "Select * From  publishers";
                $cat_result = $con->query($cat_sql);
                if (mysqli_num_rows($cat_result) > 0) {
                    while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                        if($row["publisher"]==$cat_row["pid"]){
                            $selected='selected';
                        }else{
                            $selected='';
                        }
                        echo "<option " . $selected . " value='" . $cat_row['pid'] . "'>" . $cat_row['pname_ar'] . "</option>";
                    }
                }
                ?>
            </select>
        </div>
    </div>
    <iframe id="hidden_iframe" name="hidden_iframe" style="width: 0px;height: 0px;"></iframe>
    <input name="commit" id="update_story" type="button" value="<?= $Lang->Update;?>" class="btn-default-a floating-right clear-both">
</div>
</div>
<?php
include "includes/footer.php";
?>
