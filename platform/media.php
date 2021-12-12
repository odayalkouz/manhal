<?php
$cuerrentpage="media.php";
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

$bredcrumb = '<li class="floating-left"><a href="media.php" class="floating-left active">'.$Lang->media.'</a></li>';

include "includes/header.php";
?>
    <div class="books-container">
        <label class="lbl-data-a floating-left"><?= $Lang->Category ?></label>
        <select class="txt-a floating-left" id="Category_media" name="Category_media">
            <option value='0'>---------------</option>
            <?php
            $cat_sql = "Select * From  categories WHERE `parent`=0";
            $cat_result = $con->query($cat_sql);
            if (mysqli_num_rows($cat_result) > 0) {
                while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                    echo getCategories($cat_row['catid'],"categories");
                }
            }
            ?>
        </select>
        <input type="text" class="txt-a floating-left media-serach" id="media_search" name="media_search" placeholder="<?= $Lang->search ?>" value="">
        <input class="floating-left btn-default-b" type="button" value="<?= $Lang->search ?>" onclick="searchmedia();">


        <div class="display-table">
            <!--start table caption-->
            <div class="disply-table-caption table-title">
                <div class="display-table-cell number"><?= $Lang->No ?></div>
                <div class="display-table-cell user"><?= $Lang->User ?></div>
                <div class="display-table-cell category"><?= $Lang->Category ?></div>
                <div class="display-table-cell book-title"><?= $Lang->mediaTitle ?></div>
                <div class="display-table-cell created-at"><?= $Lang->CreatedDate ?></div>
                <div class="display-table-cell book-thumb"><?= $Lang->Thumb;?></div>
                <div class="display-table-cell action"><?= $Lang->Action ?></div>
            </div>
            <!--end table caption-->
            <!--start table rows-->
            <?php
            if ($_SESSION['user']['permession'] == 1 || $_SESSION['user']['permession'] == 6) {
                $weruser = '';
            } else {
                $weruser = "and media.userid=" . $_SESSION['user']['userid'];
            }
            $keyword_filter="";
            $keywords="";
            if(isset($_GET['keywords']) && $_GET['keywords']!=""){
                $keywords="keywords=".$_GET['keywords'];
                $keyword_filter=" AND `title_ar` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%'  OR `title_en` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%'";
            }
            $cat_filter="";
            if(isset($_GET['category']) && $_GET['category']!=0){
                $keywords.="&category=".$_GET['category'];
                $cat_filter=" AND `catid` = ".$_GET['category'];
            }
            $sql = " Select media.*, categories.name_ar, categories.name_en, users.fullname From media Left Join categories On media.category = categories.catid Left Join users On media.userid = users.userid WHERE `id` >0 " . $weruser .$keyword_filter.$cat_filter."   ";
            $result = $con->query($sql);
            $url="media.php?".$keywords;
            $result = $con->query($sql);
            $num_rows=mysqli_num_rows($result);

            $pagination=getPagination($url,$num_rows);


            $sql = "Select media.*, categories.name_ar, categories.name_en, users.fullname From media Left Join categories On media.category = categories.catid Left Join users On media.userid = users.userid WHERE `id` >0  ".$weruser.$keyword_filter.$cat_filter.$pagination[0];
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
                    $extanshen='';
                    $icon='';
                    switch ($row['type']) {
                        case 0:
                        case 1:
                            $extanshen = 'pdf';
                            $icon="icons/pdf.png";
                            break;
                        case 2:
                            $extanshen = 'doc';
                            $icon="icons/lesson.png";
                            break;
                        case 3:
                            $extanshen = 'mp3';
                            $icon="icons/mp3.png";
                            break;
                        case 4:
                            $extanshen = 'mp4';
                            $icon="icons/video.png";
                            break;
                        case 5:
                            $extanshen = 'html';

                            $icon="icons/teachersbook.png";
                            break;
                        case 6:
                            $extanshen = 'html';

                            $icon="icons/quiz_1.png";
                            break;
                        case 8:
                            $extanshen = 'swf';
                            $icon="icons/flash.png";
                            break;
                        case 10:
                            $extanshen = 'html';
                            $icon="icons/lecture.png";
                            break;
                        case 11:
                            $extanshen = 'html';
                            $icon="icons/games.png";
                            break;
                        case 12:
                            $extanshen = 'html';
                            $icon="icons/worksheet.png";
                            break;
                        case 13:
                            $extanshen = 'pdf';
                            $icon="icons/educationtools.png";
                            break;
                        case 14:
                            $extanshen = 'pdf';
                            $icon="icons/TeachersGuide.png";
                            break;
                        case 15:
                            $extanshen = 'pdf';
                            $icon="icons/approved.png";
                            break;
                        case 16:
                            $extanshen = 'pdf';
                            $icon="icons/curriculumplans.png";
                            break;
                    }
                    $data .= "<div id='mediaidd_".$row['id']."' class='display-table-row #class#'>";
                    $data .= "<div class='display-table-cell number' >".$page_number."</div>";
                    $data .= "<div class='display-table-cell user'>".$row['fullname']."</div>";
                    $data .= "<div class='display-table-cell category'>".$row['name_'.strtolower($_SESSION["lang"])]."</div>";
                    $data .= "<div class='display-table-cell book-title'>".$row['title_'.strtolower($_SESSION["lang"])]."</div>";
                    $data .= "<div class='display-table-cell created-at'>".$row['cdate']."</div>";

                    if($row["path"]==''){
                        $icon="media/".$row["id"]."/thumbnail_small.jpg";
                    }else{
                        $icon="games/".$row["productid"]."/images/thumb.jpg";
                    }
                    $data .= "<div class='display-table-cell book-thumb'><a class='preview' title='".$row['title_'.strtolower($_SESSION["lang"])]."'><img src='".$icon."' alt='gallery thumbnail' /></a></div>";
                    $data .= "<div class='display-table-cell action'>";
                    $data .= "<div class='butons-container'>";
                    $data .= " <a title='".$Lang->mediaInfo."' href='editmedia.php?id=".$row['id']."'>";
                    $data .= " <i class='flaticon-info27'></i></a>";
                    if (canEditmedia($row['id'])) {
                        if($i%2==0) {
                            $data = str_replace("#class#", 'bg-row-a', $data);
                        }else{
                            $data = str_replace("#class#", 'bg-row', $data);
                        }
                        $data .= " <a title='" . $Lang->Delete . "' href='javascript:deletemedia(".$row['id'].")' >";
                        $data .= " <i class='flaticon-delete96'></i> </a>";
                        $data .= '<a title="' . $Lang->Download . '" class="download" mediaid="'.$row["id"].'" >';

                        if($row["is_playlist"]==1){
                            https://www.manhal.com/en/playlist/6645/Cards-Game-test
                           $href=SITE_URL.$lang_code."/playlist/".$row["id"]."/".str_replace(" ","-",$row["title_".$lang_code]);
                        }else{
                            $href='media/'.$row["id"].'/'.$row["filename"].'.'.$extanshen.'?v='.rand();
                        }

                        $data .= '<a target="_blank" title="' . $Lang->View . '" href="'.$href.'" >';
                        $data .= " <i class='flaticon-eye106'></i></a>";


                    }
                    $data .= "</div></div></div>";
                    $i++;
                }
            }
            echo $data;
            ?>
            <!--end table rows-->
        </div>
        <a href="editmedia.php?id=new" class="btn-default floating-right"><?=$Lang->Addmedia;?></a>
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