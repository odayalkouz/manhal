<?php
/*
 * Created by Dar Almanhal - Hussam Abu Khadijeh .
 * User: Hussam Abu Khadijeh
 * Date: 26/12/2016
 * Time: 10:26 AM
 */
include_once "config.php";
include_once "includes/language.php";
//if ($_SESSION['user']['permession'] == 1 || $_SESSION['user']['userid']==6) {
//    $weruser = '';
//} else {
//    $weruser = " AND editors.userid=" . $_SESSION['user']['userid'];
//}
$weruser = '';
if(isset($_GET["gametype"]) && $_GET["gametype"]!=""){
    $wereeditor = " AND editors.editor='".$_GET["gametype"]."'";
}else{
    $wereeditor = "";
}

if(isset($_GET["grade"]) && $_GET["grade"]!=""){
    $weregrade = " AND editors.grade=".$_GET["grade"];
}else{
    $weregrade = "";
}

$sql = "Select * FROM `editors` WHERE  editors.userid >0 ".$weruser.$wereeditor.$weregrade;
$result = $con->query($sql);
?>

<div class="external-widget-container-popup">
    <div class="line-row-d">
        <label class="lbl-data-a floating-left">
            <?=$Lang->GameType;?>
        </label>
        <select class="txt-a floating-left" id="gametype" name="gametype">
            <option value=''>---------------------------</option>
            <option <?php if(isset($_GET["gametype"]) && $_GET["gametype"]=='labeling'){echo "selected='selected'";}?> value='labeling'>Labeling</option>
            <option <?php if(isset($_GET["gametype"]) && $_GET["gametype"]=='connected_dots'){echo "selected='selected'";}?> value='connected_dots'>Connected Dots</option>
            <option <?php if(isset($_GET["gametype"]) && $_GET["gametype"]=='find_object'){echo "selected='selected'";}?> value='find_object'>Find Objects</option>
            <option <?php if(isset($_GET["gametype"]) && $_GET["gametype"]=='fll_in_the_blanks'){echo "selected='selected'";}?> value='fill_in_the_blanks'>fill in the blanks</option>
            <option <?php if(isset($_GET["gametype"]) && $_GET["gametype"]=='matching'){echo "selected='selected'";}?> value='matching'>Matching</option>
            <option <?php if(isset($_GET["gametype"]) && $_GET["gametype"]=='click_map'){echo "selected='selected'";}?> value='click_map'>Click Map</option>
            <option <?php if(isset($_GET["gametype"]) && $_GET["gametype"]=='coloring'){echo "selected='selected'";}?> value='coloring'>coloring</option>
        </select>
    </div>
    <div class="line-row-d">
        <label class="lbl-data-a floating-left">
            <?=$Lang->Age;?>
        </label>
        <select class="txt-a floating-left" id="gamegrade" name="gamegrade">
            <option value="" ><?=$Lang->all;?></option>
            <option value="1" <?php if(isset($_GET["grade"]) && $_GET["grade"]==1){echo 'selected';}?> >4-5</option>
            <option value="2" <?php if(isset($_GET["grade"]) && $_GET["grade"]==2){echo 'selected';}?> >6-8</option>
            <option value="3" <?php if(isset($_GET["grade"]) && $_GET["grade"]==3){echo 'selected';}?> >9-11</option>
            <option value="4" <?php if(isset($_GET["grade"]) && $_GET["grade"]==4){echo 'selected';}?> >12-15</option>
        </select>
    </div>
    <div class="line-row-d">
        <label class="lbl-data-a floating-left">Quiz</label>
        <select class="ddl-animation-action txt-a floating-left" id="select_game">
            <?php
            while($row=mysqli_fetch_assoc($result)) {
                ?>
                <option value="<?=$row['gameid'];?>"><?=$row['title_en'];?></option>
                <?php
            }
            ?>
        </select>
    </div>
    <div class="line-row-d">
        <a class="floating-right update-external-widget-btn" widget_id="<?=$_GET['id'];?>" id="update_game">Update</a>
    </div>
</div>
