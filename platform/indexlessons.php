<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 30/05/2017
 * Time: 4:15 PM
 */
include_once "config.php";
include_once "includes/language.php";

$sql="SELECT * FROM `units_lessons` WHERE `type`='unit' AND `bookid`=".$_GET['bookid'];
$result = $con->query($sql);
?>
<div class="line-row">
    <select id="units" class="txt-a" name="unites">
    <?php
    $unit=-1;
    while($row = mysqli_fetch_assoc($result)){
        if($unit==-1){
            $unit=$row["ulid"];
        }
        ?>
        <option value="<?=$row["ulid"];?>"><?=$row["title"];?></option>
        <?php
    }
    ?>
</select>
    <a class="jq_editeunit btn-default-d floating-left">Edit</a>
    <a class="jq_deleteunit btn-default-d floating-left">delete</a>

</div>
<?php
$sql="SELECT * FROM `units_lessons` WHERE `type`='lesson' AND `bookid`=".$_GET['bookid'];
$result = $con->query($sql);
?>
<div class="line-row">
    <select id="lessons" class="txt-a" name="lessons">
    <?php
    while($row = mysqli_fetch_assoc($result)){
        ?>
        <option value="<?=$row["ulid"];?>"><?=$row["title"];?></option>
        <?php
    }
    ?>
</select>
    <a class="jq_editelesson btn-default-d floating-left">Edit</a>
    <a class="jq_deletelesson btn-default-d floating-left">delete</a>

</div>
<div class="line-row">
    <a class="jq_addunit btn-default">Add Unit</a>
    <a class="jq_addlesson btn-default">Add Lesson</a>
</div>
<div class="line-row">
    <div id="jq_unitdiv" style="display: none">
        <input type="text" class="txt-d floating-left" id="jq_unittitle">
        <a class="jq_updateunit btn-default-d floating-left">Save</a>
    </div>
</div>
<div class="line-row">
    <div id="jq_lessondiv" style="display: none">
        <input type="text" class="txt-d floating-left" id="jq_lessontitle">
        <a class="jq_updatelesson btn-default-d floating-left">Save</a>
    </div>
</div>
