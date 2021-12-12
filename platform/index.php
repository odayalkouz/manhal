<?php

$cuerrentpage="index.php";
$bredcrumb = "Books";


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

$bredcrumb = '<li class="floating-left"><a href="index.php" class="floating-left">'.$Lang->Books.'</a></li>';


include "includes/header.php";

?>

    <div class="books-container">

        <label class="lbl-data-a floating-left"><?= $Lang->Category ?></label>

        <select class="txt-a floating-left" id="Category" name="Category">

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

        <input class="floating-left btn-default-b" type="button" value="<?= $Lang->search ?>" onclick="searchBook();">





        <div class="display-table">

            <!--start table caption-->

            <div class="disply-table-caption table-title">

                <div class="display-table-cell number"><?= $Lang->No ?></div>

                <div class="display-table-cell user"><?= $Lang->User ?></div>

                <div class="display-table-cell category"><?= $Lang->Category ?></div>

                <div class="display-table-cell book-title"><?= $Lang->BookTitle ?></div>

                <div class="display-table-cell created-at"><?= $Lang->CreatedDate ?></div>

                <div class="display-table-cell width"><?= $Lang->Width ?></div>

                <div class="display-table-cell height"><?= $Lang->Height ?></div>

                <div class="display-table-cell book-thumb"><?= $Lang->Thumb;?></div>

                <div class="display-table-cell action"><?= $Lang->Action ?></div>

            </div>

            <!--end table caption-->

            <!--start table rows-->

            <?php

            if ($_SESSION['user']['permession'] == 1 || $_SESSION['user']['permession'] == 6) {

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

            $url="index.php?".$keywords;

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

                    $data .= "<div class='display-table-cell number' >".$page_number."</div>";

                    $data .= "<div class='display-table-cell user'>".$row['fullname']."</div>";

                    $data .= "<div class='display-table-cell category'>".$row['name_'.strtolower($_SESSION["lang"])]."</div>";

                    $data .= "<div class='display-table-cell book-title'>".$row['name']."</div>";

                    $data .= "<div class='display-table-cell created-at'>".$row['cdate']."</div>";

                    $data .= "<div class='display-table-cell width'>".$row['width']."px</div>";

                    $data .= "<div class='display-table-cell height'>".$row['height']."px</div>";

                    $data .= "<div class='display-table-cell book-thumb'><a href='pages.php?id=".$row['bookid']."' class='preview' title='".$row['name']."'><img src='books/".$row['bookid']."/cover.jpg' alt='".$row['name']."' /></a></div>";

                    $data .= "<div class='display-table-cell action'>";

                    $data .= "<div class='butons-container'>";

                    $data .= " <a href='pages.php?id=".$row['bookid']."'>";

                    $data .= " <i class='flaticon-stationery1' title='".$Lang->Pages."'></i></a>";

                    $data .= " <a title='".$Lang->BookInfo."' href='editbook.php?id=".$row['bookid']."'>";

                    $data .= " <i class='flaticon-info27'></i></a>";

                    if (canEdit($row['bookid'])) {

                        if($i%2==0) {

                            $data = str_replace("#class#", 'bg-row-a', $data);

                        }else{

                            $data = str_replace("#class#", 'bg-row', $data);

                        }

                        $data .= " <a title='" . $Lang->Delete . "' href='javascript:deletebooks(".$row['bookid'].")' >";

                        $data .= " <i class='flaticon-delete96'></i> </a>";

                        $data .= '<a title="' . $Lang->Download . '" class="download" bookid="'.$row["bookid"].'" >';

                        $data .= " <i class='flaticon-download195'></i></a>";

                        $data .= '<a title="' . $Lang->Publish . '" class="publish" bookid="'.$row["bookid"].'" >';

                        $data .= " <i class='flaticon-arrow73'></i></a>";

                        $data .= '<a target="_blank" title="' . $Lang->View . '" href="books/'.$row["bookid"].'/index.html" >';

                        $data .= " <i class='flaticon-eye106'></i></a>";

                        $data .= '<a title="' . $Lang->Edit . '" href="editor.php?bookid='.$row["bookid"].'">';

                        $data .= " <i class='flaticon-pencil43'></i></a>";

                        $data .= '<a title="' . $Lang->Copy . '" href="createbook.php?copy='.$row["bookid"].'">';

                        $data .= " <i class='flaticon-copy20'></i></a>";
                    }

                    $data .= "</div></div></div>";

                    $i++;

                }

            }

            echo $data;

            ?>

            <!--end table rows-->

        </div>

        <?php
        if($_SESSION["user"]['permession']==1|| $_SESSION["user"]['permession']==6){
            ?>
            <a href="editbook.php?id=new" class="btn-default floating-right"><?=$Lang->AddBook;?></a>
            <?php
        }
        ?>


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