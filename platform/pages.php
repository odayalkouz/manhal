<?php
$cuerrentpage="index.php";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user"])) {
    header('Location: login.php');
}else if($_SESSION["user"]['permession']==3){
    header('Location:warehouse.php');
}else if($_SESSION["user"]['permession']==4){
    header('Location:shippingwarehouse.php');
}
include_once('config.php');
include_once('includes/language.php');
include_once('includes/function.php');
include "includes/header.php";

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
                <div class="display-table-cell number"><?= $Lang->No ?></div>
                <div class="display-table-cell user-pages"><?= $Lang->TitlePage  ?></div>
                <div class="display-table-cell category-pages"><?= $Lang->SubTitle ?></div>
                <div class="display-table-cell width"><?= $Lang->Width ?></div>
                <div class="display-table-cell height"><?= $Lang->Height ?></div>
                <div class="display-table-cell height"><?= $Lang->BackgroundPage ?></div>
                <div class="display-table-cell action"><?= $Lang->Action ?></div>
            </div>
            <!--end table caption-->
            <!--start table rows-->
            <?php



            $sql = "SELECT * FROM `pages` WHERE `pageid` >0 AND `bookid`=".$_GET['id']."  ORDER BY `page_sort`  " ;
            $result = $con->query($sql);
            $data = '<ul id="sortable">';
            $i = 0;
            if (mysqli_num_rows($result) > 0) {
                // output data of each row

                while ($row = mysqli_fetch_assoc($result)) {
                    $data .= "<li sort='".$row['pageid']."' class='ui-state-default'><span class='ui-icon ui-icon-arrowthick-2-n-s'></span>";
                    $data .= "<div id='pageidd_".$row['pageid']."' class='display-table-row-sorting #class#'>";
                    $data .= "<div class='display-table-cell number' >".$i."</div>";
                    $data .= "<div class='display-table-cell user-pages'>".$row['title']."</div>";
                    $data .= "<div class='display-table-cell category-pages'>".$row['subtitle']."</div>";
                    $data .= "<div class='display-table-cell width'>".$row['width']."px</div>";
                    $data .= "<div class='display-table-cell height'>".$row['height']."px</div>";
                    if(is_file("books/".$_GET['id'].'/'.$row['pageid'].".jpg")){
                        $page_thumb="books/".$_GET['id'].'/'.$row['pageid'].".jpg";
                    }else{
                        $page_thumb="images/backgroun.png";
                    }

                    $data .= "<div class='display-table-cell height'><img class='height-pages' src='".$page_thumb."'/></div>";
                    $data .= "<div class='display-table-cell action'>";
                    $data .= "<div class='butons-container'>";
                    $data .= " <a href='editor.php?bookid=".$_GET['id']."&pageid=".$row['pageid']."'>";
                    $data .= " <i class='flaticon-pencil43' title='".$Lang->Edit."'></i></a>";

                    if ($_SESSION['user']['permession'] == 1) {
                        $data .= " <a href='javascript:deletepage(".$_GET['id'].",".$row['pageid'].")' >";
                        $data .= " <i class='flaticon-delete96' title='" . $Lang->Delete . "'></i> </a>";

                    }
                    $data .= "</div></div></div></li>";
                    $i++;

                }

            }
            $data.="</ul>";
            echo $data;
            ?>

            <!--end table rows-->
        </div>
        <a href="editor.php?bookid=<?php echo $_GET['id'] ?>&type=new" class="btn-default floating-right"><?=$Lang->AddPage;?></a>
        <?php
        if($i>0){
            ?>
            <a href="javascript:savesortpage(<?php echo $_GET['id'] ?>)" class="btn-default floating-right"><?=$Lang->Save;?></a>

            <?php
        }
        ?>
    </div>

<?php
include "includes/footer.php";
?>