<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 10/04/2018
 * Time: 10:36 PM
 */
include_once "config.php";
include_once "includes/language.php";

$sql="SELECT * FROM `units_lessons` WHERE `type`='unit' AND `bookid`=".$_GET['bookid'];
$result = $con->query($sql);
?>
<div class="line-row">
    <label for="units">Unit</label>
    <select id="units" class="txt-a" name="unites">
        <option value="-1">-------</option>
        <?php
        $unit=-1;
        while($row = mysqli_fetch_assoc($result)){
            if($unit==-1){
                $unit=$row["ulid"];
            }
            ?>
            <option pageid="<?=$row["pageid"];?>" value="<?=$row["ulid"];?>"><?=$row["title"];?></option>
            <?php
        }
        ?>
    </select>
</div>
<?php
$sql="SELECT * FROM `units_lessons` WHERE `type`='lesson' AND `bookid`=".$_GET['bookid'];
$result = $con->query($sql);
?>
<div class="line-row">
    <label for="lessons">Lesson</label>
    <select id="lessons" class="txt-a" name="lessons">
        <option value="-1">-------</option>
        <?php
        while($row = mysqli_fetch_assoc($result)){
            ?>
            <option pageid="<?=$row["pageid"];?>" value="<?=$row["ulid"];?>"><?=$row["title"];?></option>
            <?php
        }
        ?>
    </select>
</div>
<div class="line-row">
    <a class="jq_updateindex btn-default" widgetid="<?=$_GET["id"];?>">Update</a>
</div>

