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
include_once "includes/header.php";
?>
    <link rel="stylesheet" href="css/jquery-ui.css">

    <script src="../js/jquery-ui.js"></script>

    <style>
        #sortable { list-style-type: none; margin: 0; padding: 0; }
        #sortable li { margin: 0 0px 3px 0px;cursor: move;background: #FFFCFC}
        #sortable li span { position: absolute; margin-left: -1.3em; color: #464646}
    </style>
    <script>
        $(function() {
            $( "#sortable" ).sortable();
            $( "#sortable" ).disableSelection();
        });
    </script>
    <div class="books-container">
        <div class="display-table">
            <!--start table caption-->
            <div class="disply-table-caption table-title">
                <div class="display-table-cell number"><?=$Lang->No;?></div>
                <div class="display-table-cell book-title"><?=$Lang->Title;?></div>
                <div class="display-table-cell created-at"><?=$Lang->CreatedDate;?></div>
                <div class="display-table-cell book-thumb"><?=$Lang->Thumb;?></div>
                <div class="display-table-cell action"><?=$Lang->Action;?></div>
            </div>
            <!--end table caption-->
            <!--start table rows-->
            <?php
            $sql = "SELECT `storypages`.* FROM `storypages` WHERE `storypages`.`idstory`=".$_GET["id"]." ORDER BY `storypages`.`sorting` ASC";
            $result = $con->query($sql);
            $data = '';

            $reset_counter=0;

            if (mysqli_num_rows($result) > 0) {
                // output data of each row
                $i = 1;
                ?>
                <ul id="sortable">
                <?php
                while ($row = mysqli_fetch_assoc($result)) {
                    $page_number=$reset_counter+$i;
                    $data .= "<li><div id='storyidd_".$row['id']."' class='display-table-row #class#' data-id='".$row['id']."'>";
                    $data .= "<div class='display-table-cell number' >".$page_number."</div>";
                    $data .= "<div class='display-table-cell book-title'>".$row['text']."</div>";
                    $data .= "<div class='display-table-cell created-at'>".$row['cdate']."</div>";
                    $data .= "<div class='display-table-cell book-thumb'><img src='stories/".$_GET["seriesid"]."/story/".$row['idstory']."/images/pic.jpg' /></div>";
                    $data .= "<div class='display-table-cell action'>";
                    $data .= "<div class='butons-container'>";
                    if (canEditStory($row['idstory'])) {
                        if($i%2==0) {
                            $data = str_replace("#class#", 'bg-row-a', $data);
                        }else{
                            $data = str_replace("#class#", 'bg-row', $data);
                        }
                        $data .= " <a title='" . $Lang->Delete . "'  class='delete_story_page' pageid='".$row["id"]."' storyid='".$row["idstory"]."' seriesid='".$_GET["seriesid"]."' >";
                        $data .= " <i class='flaticon-delete96'></i> </a>";
                        $data .= '<a title="' . $Lang->Edit . '" href="editstorypage.php?pageid='.$row["id"].'&storyid='.$row["idstory"].'&seriesid='.$_GET["seriesid"].'">';
                        $data .= " <i class='flaticon-pencil43'></i></a>";
                    }
                    $data .= "</div></div></div></li>";
                    $i++;
                }
            }
            echo $data;
            ?>
                </ul>
            <!--end table rows-->
        </div>
        <a href="editstorypage.php?pageid=new&storyid=<?=$_GET["id"];?>&seriesid=<?=$_GET["seriesid"];?>" class="btn-default floating-right"><?=$Lang->AddPage;?></a>
        <a id="update_story_page_sort" class="btn-default floating-right"><?=$Lang->Save;?></a>
    </div>
<?php
include "includes/footer.php";
?>