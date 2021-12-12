<?php
$cuerrentpage="searchstoryes.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user"])) {
    header('Location: login.php');
}else if($_SESSION["user"]['permession']==3){
    header('Location:warehouse.php');
}else if($_SESSION["user"]['permession']==4) {
    header('Location:shippingwarehouse.php');
}else if($_SESSION["user"]['permession']==""||$_SESSION["user"]['permession']==NULL){
    header('Location:logout.php');
   die();
}
include_once('config.php');
include_once('includes/language.php');

?>

<?php
include_once('includes/function.php');
include_once('../includes/function.php');

?>

<?php
$real_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
if(session_status()==PHP_SESSION_NONE)
{
    session_start();
}
if(!isset($_SESSION["user"]))
{
    if(basename($_SERVER['PHP_SELF'])!="login.php")
    {
        header('Location: login.php');
        exit();
    }
}
include_once "includes/language.php";
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
        <label class="lbl-data-a floating-left"><?= $Lang->Category ?></label>
        <select class="txt-a floating-left" id="Category_b" name="Category_b">
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
        <input type="text" class="txt-a floating-left book-serach" id="book_search" name="book_search" placeholder="<?= $Lang->search ?>" value="">
        <input class="floating-left btn-default-b" type="button" value="<?= $Lang->search ?>" onclick="searchBookb();">


        <div class="display-table">
            <!--start table caption-->
            <div class="disply-table-caption1 table-title">
                <div class="display-table-cell number"><?= $Lang->No ?></div>
                <div class="display-table-cell category"><?= $Lang->Category ?></div>
                <div class="display-table-cell book-title"><?= $Lang->BookTitle ?></div>
                <div class="display-table-cell book-thumb"><?= $Lang->Thumb;?></div>

            </div>
            <!--end table caption-->
            <!--start table rows-->
            <?php
            if ($_SESSION['user']['permession'] == 1) {
                $weruser = '';
            } else {
                $weruser = "and books.userid=" . $_SESSION['user']['userid'];
            }
            $keyword_filter="";
            $keywords="";
            if(isset($_GET['keywords']) && $_GET['keywords']!=""){
                $keywords="keywords=".$_GET['keywords'];
                $keyword_filter=" AND `name` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%'";
            }
            $cat_filter="";
            if(isset($_GET['category']) && $_GET['category']!=0){
                $keywords.="&category=".$_GET['category'];
                $cat_filter=" AND `catid` = ".$_GET['category'];
            }
            $sql = "Select   books.*,  categories.name_ar,  categories.name_en,  users.fullname From  books Left Join  categories On books.category = categories.catid LEFT Join  users On books.userid = users.userid   WHERE `bookid` >0  " . $weruser .$keyword_filter.$cat_filter."   ";
            $result = $con->query($sql);
            $url="searchbook.php?".$keywords;
            $result = $con->query($sql);
            $num_rows=mysqli_num_rows($result);

            $pagination=getPagination($url,$num_rows);


            $sql = "Select   books.*,  categories.name_ar,  categories.name_en,  users.fullname From  books Left Join  categories On books.category = categories.catid LEFT Join  users On books.userid = users.userid   WHERE `bookid` >0  ".$weruser.$keyword_filter.$cat_filter.$pagination[0];
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
                    $data .= "<div id='bookidd_".$row['bookid']."' class='display-table-row #class#'>";
                    $data .='<input class="floating-left check-box1" type="checkbox" name="insertbooks" bookid="'.$row['bookid'].'"  booktitle="'.$row['name'].'" value="0">';
                    $data .= "<div class='display-table-cell number' >".$page_number."</div>";
                    $data .= "<div class='display-table-cell category'>".$row['name_'.strtolower($_SESSION["lang"])]."</div>";
                    $data .= "<div class='display-table-cell book-title'>".$row['name']."</div>";
                    $data .= "<div class='display-table-cell book-thumb'><img  src='books/".$row['bookid']."/cover.jpg' /></div>";
                    $data .= "<div class='display-table-cell action'>";
                    $data .= "<div class='butons-container'>";


                    if (canEdit($row['bookid'])) {
                        if($i%2==0) {
                            $data = str_replace("#class#", 'bg-row-a', $data);
                        }else{
                            $data = str_replace("#class#", 'bg-row', $data);
                        }

                    }
                    $data .= "</div></div></div>";
                    $i++;
                }
            }
            echo $data;
            ?>
            <!--end table rows-->
        </div>

    </div>
<div>
    <input class="floating-right btn-default-b check-box" type="button" onclick='insertAll();' value="insert book">
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

        parent.insertid(_array,0);
    }
</script>
    <section class="paging">
        <div class="content">
            <?php
            echo $pagination[1];
            ?>
        </div>
    </section>
<?php

?>