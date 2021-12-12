<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 22/8/2016
 * Time: 8:29 AM
 */
$cuerrentpage="stories.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user"])) {
    header('Location: login.php');

}
include_once('config.php');
include_once('includes/language.php');

?>
<?php
include_once('includes/function.php');
include_once('../includes/function.php');
?>
    <!DOCTYPE html>
    <html>
<head>
    <title>Books</title>
    <meta content="utf-8" http-equiv="encoding">
    <meta http-equiv="Cache-Control" content="no-cache"/>
    <meta http-equiv="Pragma" content="no-cache"/>
    <meta http-equiv="Expires" content="0"/>
    <script type="text/javascript" src="<?=SITE_URL ?>js/jquery.js"></script>
    <script type="text/javascript" src="<?=SITE_URL ?>js/lang.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL ?>platform/themes/Light-green-<?=$_SESSION["lang"];?>/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL ?>platform/themes/Light-green-<?=$_SESSION["lang"];?>/css/icons.css">
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL ?>platform/themes/Light-green-<?=$_SESSION["lang"];?>/fonts/fonts.css">
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL ?>platform/themes/Light-green-<?=$_SESSION["lang"];?>/css/animate.css">
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL ?>platform/themes/Light-green-<?=$_SESSION["lang"];?>/css/matching.css">

    <script type="text/javascript" src="<?=SITE_URL ?>js/ajax.js"></script>
    <script type="text/javascript" src="<?=SITE_URL ?>js/jquery.nu-context-menu.js"></script>
    <script type="text/javascript" src="<?=SITE_URL ?>js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="<?=SITE_URL ?>js/jquery.popline.min.js"></script>
    <script type="text/javascript" src="<?=SITE_URL ?>js/editor.js"></script>
    <script type="text/javascript" src="<?=SITE_URL ?>js/sweetalert-dev.js"></script>
    <script type="text/javascript" src="<?=SITE_URL ?>js/jquery.nestable.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL ?>platform/themes/Light-green-<?=$_SESSION["lang"];?>/css/sweetalert.css">
    <link rel="icon" href="<?=SITE_URL ?>img/favicon.png">
    <link rel="icon" sizes="16x16" href="<?=SITE_URL ?>platform/themes/Light-green-<?=$_SESSION["lang"];?>/images/favicon.ico" type="image/x-icon"/>
    <meta http-equiv="content-language" content="<?=strtolower($_SESSION["lang"]);?>"/>
</head>
    <div class="books-container playlist-container">
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
        <label class="lbl-data-a floating-left"><?= $Lang->Series ?></label>
        <select class="txt-a floating-left submit_form" id="series" name="series">
            <option value='0'>---------------</option>
            <?php
            $series_filter="";
            if(isset($_GET["category"]) && $_GET["category"]!=0){
                $series_filter=" WHERE category=".$_GET["category"];
            }

            $sql = "Select * From  series".$series_filter;
            $result = $con->query($sql);
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <option value="<?=$row['seriesid'];?>" <?php if(isset($_GET["series"]) && $_GET["series"]==$row['seriesid']){echo "selected";}?>><?=$row['name'];?></option>
                    <?php
                }
            }
            ?>
        </select>
        <input type="text" class="txt-a floating-left book-serach" id="keywords" name="keywords" placeholder="<?= $Lang->search ?>" value="<?php if(isset($_GET['keywords']) && $_GET['keywords']!=""){echo $_GET['keywords'];}?>">
        <input class="floating-left btn-default-b" type="submit" value="<?= $Lang->search ?>">
    </form>

        <div class="display-table">
            <!--start table caption-->
            <div class="disply-table-caption1 table-title">
                <div class="display-table-cell number"><?=$Lang->No;?></div>
                <div class="display-table-cell book-title"><?=$Lang->Title;?></div>

                <div class="display-table-cell category"><?=$Lang->Category;?></div>
                <div class="display-table-cell category"><?=$Lang->Series;?></div>

                <div class="display-table-cell book-thumb"><?=$Lang->Thumb;?></div>

            </div>
            <!--end table caption-->
            <!--start table rows-->
            <?php
            if ($_SESSION['user']['permession'] == 1) {
                $weruser = '';
            } else {
                $weruser = "and story.userid=" . $_SESSION['user']['userid'];
            }
            $keyword_filter="";
            $keywords="";
            if(isset($_GET['keywords']) && $_GET['keywords']!=""){
                $keywords="keywords=".$_GET['keywords'];
                $keyword_filter=" AND `title` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%'";
            }
            $cat_filter="";
            if(isset($_GET['category']) && $_GET['category']!=0){
                $keywords.="&category=".$_GET['category'];
                $cat_filter=" AND `story`.`catid` = ".$_GET['category'];
            }
            if(isset($_GET['series']) && $_GET['series']!=0){
                $keywords.="&series=".$_GET['series'];
                $cat_filter=" AND `story`.`seriesid` = ".$_GET['series'];
            }
            $sql = "SELECT `story`.*,`users`.*,`stories_cat`.*,`series`.*,`story`.`rating_count` as rate_count FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid`  left OUTER JOIN `users` on `story`.`userid`=`users`.`userid` WHERE `story`.`storyid` >0 " . $weruser .$keyword_filter.$cat_filter;
            $result = $con->query($sql);
            $url="searchstories.php?".$keywords;
            $result = $con->query($sql);
            $num_rows=mysqli_num_rows($result);

            $pagination=getPagination($url,$num_rows);


            $sql = "SELECT `story`.*,`stories_cat`.*,`users`.*,`series`.*,`story`.`rating_count` as rate_count FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid`  left OUTER JOIN `users` on `story`.`userid`=`users`.`userid`  WHERE `story`.`storyid` >0 ".$weruser.$keyword_filter.$cat_filter.$pagination[0];
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
                    $data .= "<div id='storyidd_".$row['storyid']."' class='display-table-row #class#'>";
                    $data .='<input class="floating-left check-box1" type="checkbox" name="insertbooks" bookid="'.$row['storyid'].'"  booktitle="'.$row['title'].'" value="0">';
                    $data .= "<div class='display-table-cell number' >".$page_number."</div>";
                    $data .= "<div class='display-table-cell book-title'>".$row['title']."</div>";

                    $data .= "<div class='display-table-cell category'>".$row['name_'.strtolower($_SESSION["lang"])]."</div>";
                    $data .= "<div class='display-table-cell category'>".$row['name']."</div>";

                    $data .= "<div class='display-table-cell book-thumb'><img  src='stories/".$row['seriesid']."/story/".$row['storyid']."/images/pic.jpg' /></div>";


                    if (canEditStory($row['storyid'])) {
                        if($i%2==0) {
                            $data = str_replace("#class#", 'bg-row-a', $data);
                        }else{
                            $data = str_replace("#class#", 'bg-row', $data);
                        }

                    }
                    $data .= "</div>";
                    $i++;
                }
            }
            echo $data;
            ?>
            <!--end table rows-->
        </div>
    </div>
<div>
    <input class="floating-right check-box btn-default-b" type="button" onclick='insertAll();' value="insert story">
</div>
<script type="text/javascript">
    function insertAll(){
        var _array=[];
        $('input[type=checkbox]').each(function () {
            if (this.checked) {
                var object={id:$(this).attr("bookid"),name:$(this).attr("booktitle")}
                _array.push(object);

            }
        });

        parent.insertid(_array,1);
    }
</script>
    <section class="paging">
        <div class="content">
            <?php
            echo $pagination[1];
            ?>
        </div>
    </section>