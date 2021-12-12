<?php
/**
 * Created by PhpStorm.
 * User: khalid alomiri
 * Date: 24/09/2016
 * Time: 09:19 ص
 */
$cuerrentpage="warehouse.php";

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

$bredcrumb = '<li class="floating-left"><a href="warehouse.php" class="floating-left">'.$Lang->Warehouse.'</a></li><span class="floating-left">/</span><li class="floating-left"><a href="warehouse.php" class="floating-left active">'.$Lang->paymentinformation.'</a></li>';

include "includes/header.php";
?>

<script type="text/javascript">
    function printinpkt(){
        $("#viewinfo_container").load("printpickandpackorder.php?id=<?=$_GET['id']?>&ref=<?=$_GET['ref']?>");
        setTimeout(function (){
        var contents = $("#viewinfo_container").html();
        var frame1 = $('<iframe />');
        frame1[0].name = "frame1";
        frame1.css({ "position": "absolute", "top": "-1000000px" });
        $("body").append(frame1);
        var frameDoc = frame1[0].contentWindow ? frame1[0].contentWindow : frame1[0].contentDocument.document ? frame1[0].contentDocument.document : frame1[0].contentDocument;
        frameDoc.document.open();
        frameDoc.document.write('<html><head><title><?=$_GET['ref'];?></title>');
        frameDoc.document.write('</head><body>');
        frameDoc.document.write(contents);
        frameDoc.document.write('</body></html>');
        frameDoc.document.close();

        setTimeout(function () {
            window.frames["frame1"].focus();
            window.frames["frame1"].print();
            frame1.remove();
        }, 200);
        },700)
    }

</script>

<div class="books-container">
<div class="display-table">
    <!--start table caption-->
    <div class="disply-table-caption table-title">
        <div class="display-table-cell number"><?= $Lang->No ?></div>
        <div class="display-table-cell user"><?= $Lang->Type ?></div>
        <div class="display-table-cell book-title"><?= $Lang->Title ?></div>
        <div class="display-table-cell Quantity"><?= $Lang->Quantity ?></div>
        <div class="display-table-cell ISBN category"><?= $Lang->ISBN ?></div>
        <div class="display-table-cell WEIGHT"><?= $Lang->Weight ?></div>
        <div class="display-table-cell width"><?= $Lang->Width ?></div>
        <div class="display-table-cell height"><?= $Lang->Height ?></div>
    </div>




    <!--end table caption-->
    <!--start table rows-->
    <?php
    if (isset($_SESSION["user"]) && $_SESSION["user"]['permession'] == 1||isset($_SESSION["user"]) && $_SESSION["user"]['permession'] > 2) {
        $sql = "Select payments_books.*, books.*,(story.isbn)as story_isbn,(story.weight)as story_weight,(story.awidth)as story_awidth,(story.aheight)as story_aheight From payments_books Left Join books On payments_books.bookid = books.bookid Left Join
  story On payments_books.bookid = story.storyid  where payments_books.paymentid=".$_GET['id'] ." and ( payments_books.`type`=1 or payments_books.`type`=3 or payments_books.`type`=5 or payments_books.`type`=7 )";

        $result = $con->query($sql);
        $url = "infopayment.php?id=".$_GET['id']."&ref=".$_GET['ref'];
        $result = $con->query($sql);
        $num_rows = mysqli_num_rows($result);
        $pagination = getPagination($url,$num_rows);


        $sql = "Select payments_books.*,books.*,(story.isbn)as story_isbn,(story.weight)as story_weight,(story.awidth)as story_awidth,(story.aheight)as story_aheight,story.title From payments_books Left Join books On payments_books.bookid = books.bookid Left Join
  story On payments_books.bookid = story.storyid  where payments_books.paymentid=".$_GET['id']." and ( payments_books.`type`=1 or payments_books.`type`=3 or payments_books.`type`=5 or payments_books.`type`=7 ) " . $pagination[0];





        $result = $con->query($sql);
        $data = '';
        $reset_counter = 0;
        if (isset($_GET["page"]) && $_GET["page"] > 1) {
            $reset_counter = 12 * ($_GET["page"] - 1);
        }

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            $i = 1;

            while ($row = mysqli_fetch_assoc($result)) {
                $page_number = $reset_counter + $i;
                $data .= "<div  class='display-table-row #class#'>";
                $data .= "<div class='display-table-cell number' >" . $page_number . "</div>";
                $data .= "<div class='display-table-cell user'>" . $row['itemtype'] . "</div>";
                $title=$row['name'];
                $quantity=$row['quantity'];
                $isbn=$row['isbn'];
                $weight=$row['weight'];
                $awidth=$row['awidth'];
                $aheight=$row['aheight'];
                if($row['itemtype']=='story'){
                    $title=$row['title'];
                    $isbn=$row['story_isbn'];
                    $weight=$row['story_weight'];
                    $awidth=$row['story_awidth'];
                    $aheight=$row['story_aheight'];
                }

                $data .= "<div class='display-table-cell book-title'>" . $title . "</div>";
                $data .= "<div class='display-table-cell Quantity'>" . $quantity . "</div>";
                $data .= "<div class='display-table-cell ISBN category'>" . $isbn . "</div>";
                $data .= "<div class='display-table-cell WEIGHT'>" . $weight . "</div>";
                $data .= "<div class='display-table-cell width'>" . $awidth . "</div>";
                $data .= "<div class='display-table-cell height'>" . $aheight . "</div>";
                    if ($i % 2 == 0) {
                        $data = str_replace("#class#", 'bg-row-a', $data);
                    } else {
                        $data = str_replace("#class#", 'bg-row', $data);
                    }
                $data .= "</div>";
                $i++;
                }
        }
        echo $data;
    }
    ?>
    <!--end table rows-->
</div>

</div>
<?php
$sql = "SELECT * FROM `payments` WHERE `paymentid`=" . $_GET['id'];
$result = $con->query($sql);
$payments_row = mysqli_fetch_assoc($result);
 if ($payments_row['store_close_user']==-1) { ?>
    <a onclick="printinpkt();" class="btn-default floating-right"><?= $Lang->Printpickandpackorder ;?></a>
<?php }?>
    <a href="pkt.php?id=<?=$_GET['id']?>&ref=<?=$_GET['ref']?>" class="btn-default floating-right"><?= $Lang->PKT;?></a>



<section class="paging">
    <div class="content">
        <?php
if (isset($_SESSION["user"]) && $_SESSION["user"]['permession'] == 1||isset($_SESSION["user"]) && $_SESSION["user"]['permession'] > 2) {
    echo $pagination[1];
}
        ?>
    </div>
</section>

<?php
include "includes/footer.php";
?>

<div class="container" id="viewinfo_container" style="display: none;overflow: auto;;min-height:300px;border: 1px solid #00AB67;padding: 20px;background: #fff">
</div>