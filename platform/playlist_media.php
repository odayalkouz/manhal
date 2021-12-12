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
include_once('includes/function.php');
include_once('../includes/function.php');
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
        <select class="txt-a floating-left" id="Category_playlist" name="Category_playlist">
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
        <label class="lbl-data-a floating-left"><?= $Lang->Type ?></label>
        <select class="txt-a floating-left" id="media_type" name="media_type">
            <option <?php if (isset($_GET["type"]) && $_GET["type"] == '-1') {
                echo "selected='selected'";
            } ?> value='-1'><?= $Lang->All; ?></option>

            <option <?php if (isset($_GET["type"]) && $_GET["type"] == '0') {
                echo "selected='selected'";
            } ?> value='0'><?= $Lang->worksheets; ?></option>

            <option <?php if (isset($_GET["type"]) && $_GET["type"] == '12') {
                echo "selected='selected'";
            } ?> value='12'><?= $Lang->worksheetinteractive; ?></option>

            <option <?php if (isset($_GET["type"]) && $_GET["type"] == '3') {
                echo "selected='selected'";
            } ?> value='3'><?= $Lang->Sounds1; ?></option>

            <option <?php if (isset($_GET["type"]) && $_GET["type"] == '4') {
                echo "selected='selected'";
            } ?> value='4'><?= $Lang->Videos1; ?></option>
            <option <?php if (isset($_GET["type"]) && $_GET["type"] == '11') {
                echo "selected='selected'";
            } ?> value='11'><?= $Lang->Games; ?></option>
        </select>
        <input type="text" class="txt-a floating-left book-serach" id="book_search" name="book_search" placeholder="<?= $Lang->search ?>" value="<?php if(isset($_GET['keywords']) && $_GET['keywords']!=""){echo $_GET['keywords'];}?>">
        <input class="floating-left btn-default-b" type="button" value="<?= $Lang->search ?>" onclick="searchMediab();">


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

            $keyword_filter="";
            $keywords="";
            if(isset($_GET['keywords']) && $_GET['keywords']!=""){
                $keywords="keywords=".$_GET['keywords'];
                $keyword_filter=" AND (`media`.`title_ar` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%' OR `media`.`title_en` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%' )";
            }
            $cat_filter="";
            if(isset($_GET['category']) && $_GET['category']!=0 && $_GET['category']!=''){
                $keywords.="&category=".$_GET['category'];
                $cat_filter=" AND `catid` = ".$_GET['category'];
            }

            $type_filter="";
            if(isset($_GET['type']) && $_GET['type']!='' && $_GET['type']!='-1'){
                $keywords.="&type=".$_GET['type'];
                $type_filter=" AND `media`.`type` = ".$_GET['type'];
            }
            $sql = "Select   media.*,  categories.name_ar,  categories.name_en,  users.fullname From  media Left Join  categories On media.category = categories.catid LEFT Join  users On media.userid = users.userid   WHERE `media`.`id` >0  " .$keyword_filter.$cat_filter.$type_filter."   ";
            $result = $con->query($sql);
            $url="playlist_media.php?".$keywords;
            $result = $con->query($sql);
            //echo $sql;
            $num_rows=mysqli_num_rows($result);

            $pagination=getPagination($url,$num_rows);


            $sql = "Select   media.*,  categories.name_ar,  categories.name_en,  users.fullname From  media Left Join  categories On media.category = categories.catid LEFT Join  users On media.userid = users.userid   WHERE `media`.`id` >0  ".$keyword_filter.$cat_filter.$type_filter.$pagination[0];
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
                    $data .= "<div id='media_".$row['id']."' class='display-table-row #class#'>";
                    $data .='<input class="floating-left check-box1" type="checkbox" name="insertmedia" mediaid="'.$row['id'].'"  mediatitle="'.$row['title_'.strtolower($_SESSION["lang"])].'" value="0">';
                    $data .= "<div class='display-table-cell number' >".$page_number."</div>";
                    $data .= "<div class='display-table-cell category'>".$row['name_'.strtolower($_SESSION["lang"])]."</div>";
                    $data .= "<div class='display-table-cell book-title'>".$row['title_'.strtolower($_SESSION["lang"])]."</div>";
                    $data .= "<div class='display-table-cell book-thumb'><img  src='media/".$row['id']."/thumbnail_small.jpg' /></div>";
                    $data .= "<div class='display-table-cell action'>";
                    $data .= "<div class='butons-container'>";

                        if($i%2==0) {
                            $data = str_replace("#class#", 'bg-row-a', $data);
                        }else{
                            $data = str_replace("#class#", 'bg-row', $data);
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
    <input class="floating-right check-box btn-default-b" type="button" onclick='insertMedia();' value="insert Media">
</div>
<script type="text/javascript">
    function insertMedia(){
        var _array=[];
        $('input[type=checkbox]').each(function () {
            if (this.checked) {
                var object={id:$(this).attr("mediaid"),name:$(this).attr("mediatitle")}
                _array.push(object);

            }
        });

        parent.insertPlaylistMedia(_array,0);
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