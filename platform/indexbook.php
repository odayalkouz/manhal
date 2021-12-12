<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/11/2016
 * Time: 4:15 PM
 */
include_once "config.php";
include_once "includes/language.php";

$sql="SELECT * FROM `pages` WHERE `bookid`=".$_GET['bookid']." ORDER BY `page_sort` ASC";
$result = $con->query($sql);
$page_number=0;
while($row = mysqli_fetch_assoc($result)){
    $page_name="p".str_pad($page_number, 4, '0', STR_PAD_LEFT);
    $page_number++;
    ?>
    <a class="jq_index" subtitle="<?=$row['subtitle'];?>" page_name="<?=$page_name;?>"><?=$row['title'];?></a>
<?php
}
?>

