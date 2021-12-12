<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 23/8/2016
 * Time: 8:29 AM
 */
$cuerrentpage="stories.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user"])) {
    header('Location: login.php');
}else if($_SESSION["user"]['permession']==""||$_SESSION["user"]['permession']==NULL){
    header('Location:logout.php');
    die();

}elseif($_SESSION["user"]['permession']>6 ) {
    header('Location: logout.php');
    exit();
}
include_once('config.php');
include_once('includes/language.php');

?>

<?php
include_once('includes/function.php');
include_once('../includes/function.php');

$bredcrumb = '<li class="floating-left"><a href="series.php" class="floating-left active">'.$Lang->Series.'</a></li>';

include_once "includes/header.php";
?>
    <div class="books-container">
        <form>
            <label class="lbl-data-a floating-left"><?= $Lang->Category ?></label>
            <select class="txt-a floating-left submit_form" id="category" name="category">
                <option value='0'>---------------</option>
                <?php
                $cat_sql = "Select * From  stories_cat WHERE `parent`=0";
                $cat_result = $con->query($cat_sql);
                if (mysqli_num_rows($cat_result) > 0) {
                    while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                        echo getCategories($cat_row['catid'],"stories_cat");
                    }
                }
                ?>
            </select>
            <input type="text" class="txt-a floating-left book-serach" id="keywords" name="keywords" placeholder="<?= $Lang->search ?>" value="<?php if(isset($_GET['keywords']) && $_GET['keywords']!=""){echo $_GET['keywords'];}?>">
            <input class="floating-left btn-default-b" type="submit" value="<?= $Lang->search ?>">
        </form>

        <div class="display-table">
            <!--start table caption-->
            <div class="disply-table-caption table-title">
                <div class="display-table-cell number"><?=$Lang->No;?></div>
                <div class="display-table-cell book-title"><?=$Lang->Title;?></div>
                <div class="display-table-cell user"><?=$Lang->User;?></div>
                <div class="display-table-cell category"><?=$Lang->Category;?></div>
                <div class="display-table-cell created-at"><?=$Lang->Description;?></div>
                <div class="display-table-cell created-at"><?=$Lang->CreatedDate;?></div>
                <div class="display-table-cell book-thumb"><?=$Lang->Thumb;?></div>
                <div class="display-table-cell action"><?=$Lang->Action;?></div>
            </div>
            <!--end table caption-->
            <!--start table rows-->
            <?php
            $keyword_filter="";
            $keywords="";
            if(isset($_GET['keywords']) && $_GET['keywords']!=""){
                $keywords="keywords=".$_GET['keywords'];
                $keyword_filter=" AND `series`.`name` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%' OR `series`.`description` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%'";
            }
            $cat_filter="";
            if(isset($_GET['category']) && $_GET['category']!=0){
                $keywords.="&category=".$_GET['category'];
                $cat_filter=" AND ``series`.`category` = ".$_GET['category'];
            }
            $sql = "SELECT `stories_cat`.*,`users`.*,`series`.* FROM `series` left OUTER JOIN `stories_cat` ON `stories_cat`.`catid`=`series`.`category` left OUTER JOIN `users` ON `series`.`userid`=`users`.`userid` WHERE `series`.`seriesid` >0 ".$keyword_filter.$cat_filter;
            $result = $con->query($sql);
            $url="series.php?".$keywords;
            $result = $con->query($sql);
            $num_rows=mysqli_num_rows($result);

            $pagination=getPagination($url,$num_rows);


            $sql = "SELECT `stories_cat`.*,`users`.*,`series`.* FROM `series` left OUTER JOIN `stories_cat` ON `stories_cat`.`catid`=`series`.`category` left OUTER JOIN `users` ON `series`.`userid`=`users`.`userid` WHERE `series`.`seriesid` >0 ".$keyword_filter.$cat_filter.$pagination[0];
            $result = $con->query($sql);
            $data = '';

            $reset_counter=0;

            if(isset($_GET["page"]) && $_GET["page"]>1){
                $reset_counter=BooksPerPage*($_GET["page"]-1);
            }

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $i = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    $page_number=$reset_counter+$i;
                    $data .= "<div id='seriesid_".$row['seriesid']."' class='display-table-row #class#'>";
                    $data .= "<div class='display-table-cell number' >".$page_number."</div>";
                    $data .= "<div class='display-table-cell book-title'><a href='stories.php?series=".$row['seriesid']."'>".$row['name']."</a></div>";
                    $data .= "<div class='display-table-cell user'>".$row['fullname']."</div>";
                    $data .= "<div class='display-table-cell category'>".$row['name_'.strtolower($_SESSION["lang"])]."</div>";
                    $data .= "<div class='display-table-cell category'>".$row['description']."</div>";
                    $data .= "<div class='display-table-cell created-at'>".$row['cdate']."</div>";
                    $data .= "<div class='display-table-cell book-thumb'><img src='stories/".$row['seriesid']."/images/Thumb.png' /></div>";
                    $data .= "<div class='display-table-cell action'>";
                    $data .= "<div class='butons-container'>";
                        if($i%2==0) {
                            $data = str_replace("#class#", 'bg-row-a', $data);
                        }else{
                            $data = str_replace("#class#", 'bg-row', $data);
                        }
                        $data .= " <a title='".$Lang->Delete."'  class='deleteseries' seriesid='".$row["seriesid"]."' >";
                        $data .= " <i class='flaticon-delete96'></i> </a>";
                        $data .= '<a title="' . $Lang->Edit.'" href="editseries.php?id='.$row["seriesid"].'">';
                        $data .= " <i class='flaticon-pencil43'></i></a>";
                    $data .= '<a title="' . $Lang->Publish . '" class="jq_publishseries" data-download="stories/published/'.$row["seriesid"].'.zip" data-href="ajax/stories_functions.php?process=publishseries&seriesid='.$row["seriesid"].'">';
                    $data .= " <i class='flaticon-arrow73'></i></a>";
                    $data .= "</div></div></div>";
                    $i++;
                }
            }
            echo $data;
            ?>
            <!--end table rows-->
        </div>
        <a href="editseries.php?id=new" class="btn-default floating-right"><?=$Lang->AddSeries;?></a>
    </div>
    <section class="paging">
        <div class="content">
            <?php
            echo $pagination[1];
            ?>
        </div>
    </section>
<?php
include "includes/footer.php";
  ?>