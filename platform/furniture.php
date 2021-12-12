<?php
$cuerrentpage = "furniture.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION["user"])) {
    header('Location: login.php');
    exit();
}else if($_SESSION["user"]['permession']==""||$_SESSION["user"]['permession']==NULL){
    header('Location:logout.php');
    die();

}elseif($_SESSION["user"]['permession']>2 && $_SESSION["user"]['permession']!=6) {
    header('Location: logout.php');
    exit();
}
include_once('config.php');
include_once('includes/language.php');
?>
<?php
include_once('includes/function.php');
include_once('../includes/function.php');

$bredcrumb = '<li class="floating-left"><a href="furniture.php" class="floating-left active">'.$Lang->Furniture.'</a></li>';

include "includes/header.php";
?>
    <div class="books-container">
        <label class="lbl-data-a floating-left">Department</label>
        <select class="txt-a floating-left" id="departments" name="departments">
            <option value='0'>---------------</option>
            <?php
            $cat_sql = "Select * From  departments WHERE `parent`=0";
            $cat_result = $con->query($cat_sql);
            if (mysqli_num_rows($cat_result) > 0) {
                while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                    echo getCategories($cat_row['catid'],"departments");
                }
            }
            ?>
        </select>
        <label class="lbl-data-a floating-left"><?= $Lang->CompanyName ?></label>
        <select class="txt-a floating-left" id="brand" name="brand">
            <option value='0'>---------------</option>
            <?php
            $cat_sql = "Select * From  brand WHERE `parent`=0";
            $cat_result = $con->query($cat_sql);
            if (mysqli_num_rows($cat_result) > 0) {
                while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                    echo getCategories($cat_row['catid'],"brand");
                }
            }
            ?>
        </select>
        <input type="text" class="txt-a floating-left book-serach" id="product_search" name="product_search" placeholder="<?= $Lang->search ?>" value="<?php if(isset($_GET['keywords']) && $_GET['keywords']!=""){echo $_GET['keywords'];}?>">
        <input class="floating-left btn-default-b" type="button" value="<?= $Lang->search ?>" onclick="searchProducts();">
        <div class="display-table">
            <!--start table caption-->
            <div class="disply-table-caption table-title">
                <div class="display-table-cell sub-5"><?= $Lang->No?></div>

                <div class="display-table-cell sub-10"><?= $Lang->arabicname?></div>
                <div class="display-table-cell sub-10"><?= $Lang->englishname?></div>

                <div class="display-table-cell book-thumb"><?= $Lang->Thumb;?></div>
                <div class="display-table-cell sub-5"><?= $Lang->Color?></div>

                <div class="display-table-cell action sub-10"><?= $Lang->Action?></div>

            </div>
            <!--end table caption-->
            <!--start table rows-->

            <?php
         
             $weruser = '';
            $keyword_filter="";
            $keywords="";
            if(isset($_GET['keywords']) && $_GET['keywords']!=""){
                $keywords="keywords=".$_GET['keywords'];
                $keyword_filter=" AND (products.`name_ar` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%'  OR products.`name_en` LIKE '%".mysqli_real_escape_string($con,$_GET['keywords'])."%')";
            }
            $brand_filter="";
            if(isset($_GET['brand']) && $_GET['brand']!=0){
                $keywords.="&brand=".$_GET['brand'];
                $brand_filter=" AND `brand` = ".$_GET['brand'];
            }
            $department_filter="";
            if(isset($_GET['department']) && $_GET['department']!=0){
                $keywords.="&department=".$_GET['department'];
                $department_filter=" AND `department` = ".$_GET['department'];
            }



            $sql = " Select products.*, brand.name_ar as brand_ar, brand.name_en as brand_en From products Left Join brand On products.brand = brand.catid WHERE `productid` >-1 " . $keyword_filter.$brand_filter.$department_filter."   ";



            $result = $con->query($sql);
            $url="furniture.php?".$keywords;
            $result = $con->query($sql);

            $num_rows=mysqli_num_rows($result);
            $pagination=getPagination($url,$num_rows);
            $sql = "Select products.*, brand.name_ar as brand_ar, brand.name_en as brand_en From products Left Join brand On products.brand = brand.catid  WHERE `productid` >-1 ".$keyword_filter.$brand_filter.$department_filter.' ORDER BY `products`.`productid` ASC'.$pagination[0];

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
                    $data .= "<div id='productidd_".$row['productid']."' class='display-table-row'>";
                    $data .= "<div class='display-table-cell sub-5'>".$page_number."</div>";
                    $data .= "<div class='display-table-cell sub-10'>".$row['name_ar']."</div>";
                    $data .= "<div class='display-table-cell sub-10'>".$row['name_en']."</div>";
                    $data .= "<div class='display-table-cell book-thumb'><a title='title' class='preview'><img src='products/".$row['productid']."/thumbnail_small.jpg' alt='title'/></a></div>";
                    $data .= "<div class='display-table-cell sub-5'><div class='color-box-result' style='background:".$row['color']."'></div></div>";
                    $data .= "<div class='display-table-cell action sub-10 '>";
                    $data .= "<div class='butons-container'>";
                    $data .= "<a href='editfurniture.php?id=".$row['productid']."'><i class='flaticon-pencil43'></i></a> <a href='javascript:deleteproduct(".$row['productid'].")'> <i class='flaticon-delete96'></i> </a>";
                    $data .= "</div></div></div>";
                    $i++;
                    }

                }

            echo $data;
            ?>























            <!--end table rows-->
        </div>
        <a href="editfurniture.php?id=new" class="btn-default floating-right"><?= $Lang->Add;?></a>
    </div>
    <section class="paging">
        <div class="content">
<?php
            echo $pagination[1];
            ?>
        </div>
    </section>
<script>

    $(document).ready(function(){
        $("#departments").val(<?php if(isset($_GET['department']) ){echo $_GET['department'];}?>)
        $("#brand").val(<?php if(isset($_GET['brand']) ){echo $_GET['brand'];}?>)



    });

</script>
<?php
include "includes/footer.php";
?>