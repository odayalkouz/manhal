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
    exit();
}else if($_SESSION["user"]['permession']==3){

    header('Location:warehouse.php');
    exit();
}else if($_SESSION["user"]['permession']==4) {

    header('Location:shippingwarehouse.php');
    exit();
}else if($_SESSION["user"]['permession']==5) {
    header('Location:invoice.php');
    exit();
}else if($_SESSION["user"]['permession']=="" || $_SESSION["user"]['permession']==NULL || $_SESSION["user"]['permession']<1 || $_SESSION["user"]['permession']>9 ){

    header('Location:logout.php');

    exit();

}

include_once('config.php');

include_once('includes/language.php');



?>



<?php

include_once('includes/function.php');

include_once('../includes/function.php');

$bredcrumb = '<li class="floating-left"><a href="stories.php" class="floating-left">'.$Lang->Stories.'</a></li>';

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

            <div class="disply-table-caption table-title">

                <div class="display-table-cell number"><?=$Lang->No;?></div>

                <div class="display-table-cell book-title"><?=$Lang->Title;?></div>

                <div class="display-table-cell user"><?=$Lang->User;?></div>

                <div class="display-table-cell category"><?=$Lang->Category;?></div>

                <div class="display-table-cell category"><?=$Lang->Series;?></div>

                <div class="display-table-cell created-at"><?=$Lang->CreatedDate;?></div>

                <div class="display-table-cell book-thumb"><?=$Lang->Thumb;?></div>

                <div class="display-table-cell action"><?=$Lang->Action;?></div>

            </div>

            <!--end table caption-->

            <!--start table rows-->

            <?php

            if ($_SESSION['user']['permession'] == 1 || $_SESSION['user']['permession'] == 6) {

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

            $url="stories.php?".$keywords;

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

                    $data .= "<div class='display-table-cell number' >".$page_number."</div>";

                    $data .= "<div class='display-table-cell book-title'><a href='storypages.php?id=".$row['storyid']."&seriesid=".$row['seriesid']."'>".$row['title']."</a></div>";

                    $data .= "<div class='display-table-cell user'>".$row['fullname']."</div>";

                    $data .= "<div class='display-table-cell category'>".$row['name_'.strtolower($_SESSION["lang"])]."</div>";

                    $data .= "<div class='display-table-cell category'>".$row['name']."</div>";

                    $data .= "<div class='display-table-cell created-at'>".$row['add_date']."</div>";

                    $data .= "<div class='display-table-cell book-thumb'><a class='preview' title='".$row['title']."'><img src='stories/".$row['seriesid']."/story/".$row['storyid']."/images/pic.jpg' alt='".$row['title']."' /></a></div>";

                    $data .= "<div class='display-table-cell action'>";

                    $data .= "<div class='butons-container'>";



                    if (canEditStory($row['storyid'])) {

                        if($i%2==0) {

                            $data = str_replace("#class#", 'bg-row-a', $data);

                        }else{

                            $data = str_replace("#class#", 'bg-row', $data);

                        }

                        $data .= " <a href='storypages.php?id=".$row["storyid"]."&seriesid=".$row["seriesid"]."'>";

                        $data .= " <i class='flaticon-stationery1' title='".$Lang->Pages."'></i></a>";

                        $data .= " <a title='" . $Lang->Delete . "'  class='deletestory' storyid='".$row["storyid"]."' seriesid='".$row["seriesid"]."' >";

                        $data .= " <i class='flaticon-delete96'></i> </a>";

                        $data .= '<a title="' . $Lang->Download . '" class="" target="_blank" href="ajax/download.php?storyid='.$row["storyid"].'&seriesid='.$row["seriesid"].'">';

                        $data .= " <i class='flaticon-download195'></i></a>";

                        $data .= '<a title="' . $Lang->Publish . '" class="jq_publishstory" data-href="ajax/stories_functions.php?process=publishstory&storyid='.$row["storyid"].'&seriesid='.$row["seriesid"].'">';

                        $data .= " <i class='flaticon-arrow73'></i></a>";

                        $data .= '<a title="' . $Lang->View . '" href="stories/demo/index.php?storyid='.$row["storyid"].'" >';

                        $data .= " <i class='flaticon-eye106'></i></a>";

                        $data .= '<a title="' . $Lang->Edit . '" href="editstory.php?id='.$row["storyid"].'">';

                        $data .= " <i class='flaticon-pencil43'></i></a>";

                    }

                    $data .= "</div></div></div>";

                    $i++;

                }

            }

            echo $data;

            ?>

            <!--end table rows-->

        </div>

        <a href="editstory.php?id=new" class="btn-default floating-right"><?=$Lang->AddStory;?></a>

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