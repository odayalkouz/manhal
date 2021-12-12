<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/28/2016
 * Time: 11:10 AM
 */
include_once "config.php";
include_once "includes/language.php";
$sql="SELECT * FROM `books` WHERE `bookid`=".$_GET['bookid'];
$result=$con->query($sql);
$row=mysqli_fetch_assoc($result);
if($row['fonts']==""){
    $current_fonts=array();
}else{
    $current_fonts=json_decode($row['fonts'],true);
}
?>
<form id="fonts_form">
    <div class="section-check-font">
        <ul>
    <?php
      foreach($fonts as $font=>$val){
        if(array_search($font,$current_fonts)===false){
            $checked="";
        }else{
            $checked="checked";
        }
        $id="check_".rand();
        ?>



        <li class="floating-left">
            <label class="input-control checkbox floating-left">
                <input type="checkbox" id="<?=$id;?>" name="font[]" value="<?=$font;?>" <?=$checked;?>/>
                <span class="check"></span>
            </label>
        <label for="<?=$id;?>" class="text floating-left"><?=$font;?></label>
        </li>
    <?php
      }
    ?>
    <div class="line-row clear-both">
        <input type="button" class="btn-default floating-right" id="update_font" value="<?=$Lang->Update;?>">
        <input type="hidden" id="bookid" name="bookid" value="<?=$_GET['bookid'];?>">
    </div>
        </ul>
    </div>
</form>