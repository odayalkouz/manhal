<?php
/**
 * Created by PhpStorm.
 * User: khalid alomiri
 * Date: 24/09/2016
 * Time: 09:19 ص
 */
$cuerrentpage="infopayment.php";

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
$bredcrumb = '<li class="floating-left"><a href="infopayment.php" class="floating-left active">'.$Lang->PackageInfo.'</a></li>';

include "includes/header.php";
?>

<script type="text/javascript">
    function printinpkt(){
        $("#viewinfo_container").load("printinfopayment.php?id=<?=$_GET['id']?>&ref=<?=$_GET['ref']?>");
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
        <div class="display-table-cell WEIGHT"><?= $Lang->Countcartons ?></div>

    </div>




    <!--end table caption-->
    <!--start table rows-->
    <?php
    if (isset($_SESSION["user"]) && $_SESSION["user"]['permession'] == 1||isset($_SESSION["user"]) && $_SESSION["user"]['permession'] > 2) {


        $sql = "SELECT `payments_books`.*,`payments_books`.`type` as item_type,  `books`.`booktype`,
                                IF(`payments_books`.`itemtype`='book',`books`.`description_en`,`story`.`description_en`) as `description_en`,
                                IF(`payments_books`.`itemtype`='book',`books`.`description_ar`,`story`.`description_ar`) as `description_ar`,
                                IF(`payments_books`.`itemtype`='book',`books`.`author_ar`,`story`.`author_ar`) as `author_ar`,
                                IF(`payments_books`.`itemtype`='book',`books`.`author_en`,`story`.`author_en`) as `author_en`,
                                IF(`payments_books`.`itemtype`='book',`books`.`price`,`story`.`price`) as `price`,
                                IF(`payments_books`.`itemtype`='book',`books`.`rate`,`story`.`rate`) as `rate`,
                                IF(`payments_books`.`itemtype`='book',`books`.`isbn`,`story`.`isbn`) as `isbn`,
                                IF(`payments_books`.`itemtype`='book',`books`.`filling`,`story`.`filling`) as `filling`,
                                IF(`payments_books`.`itemtype`='book',`books`.`color`,`story`.`color`) as `color`,
                                IF(`payments_books`.`itemtype`='book',`books`.`eprice`,`story`.`eprice`) as `eprice`,
                                IF(`payments_books`.`itemtype`='book',`books`.`iprice`,`story`.`iprice`) as `iprice`,
                                IF(`payments_books`.`itemtype`='book',`books`.`comments`,`story`.`comments`) as `comments`,
                                IF(`payments_books`.`itemtype`='book',`books`.`rating_count`,`story`.`rating_count`) as `rate_count`,
IF(`payments_books`.`itemtype`='book',`books`.`name`,`story`.`title`) as `name`,
IF(`payments_books`.`itemtype`='book',`books`.`weight`,`story`.`weight`) as `weight`,
                                IF(`payments_books`.`itemtype`='book',`categories`.`name_en`,`stories_cat`.`name_en`) as name_en,

                                IF(`payments_books`.`itemtype`='book',`books`.`language`,`story`.`language`) As `language`
                                FROM `payments_books` LEFT OUTER JOIN `books` ON `payments_books`.`bookid`=`books`.`bookid` LEFT OUTER JOIN `story` ON `payments_books`.`bookid`=`story`.`storyid`
                                LEFT OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` LEFT OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid`  where payments_books.paymentid=".$_GET['id']." and ( payments_books.`type`=1 or payments_books.`type`=3 or payments_books.`type`=5 or payments_books.`type`=7 )"; ;


       // $sql = "Select cartoons.prodecttype,cartoons.quantity,cartoons.carton, IF(cartoons.prodecttype='book',`books`.`isbn`,`story`.`isbn`) as `isbn`, IF(cartoons.prodecttype='book',`books`.`name`,`story`.`title`) As `name` From cartoons INNER Join books On cartoons.`idprodect` = `books`.`bookid` INNER Join story On cartoons.`idprodect` = story.storyid Where cartoons.idpayments =".$_GET['id'];
      
        $result = $con->query($sql);
        $url = "infoprodectpkt.php?id=".$_GET['id'];
        $result = $con->query($sql);
        $num_rows = mysqli_num_rows($result);
        $pagination = getPagination($url,$num_rows);

       // $sql = "Select cartoons.prodecttype,cartoons.quantity,cartoons.carton, IF(cartoons.prodecttype='book',`books`.`isbn`,`story`.`isbn`) as `isbn`, IF(cartoons.prodecttype='book',`books`.`name`,`story`.`title`) As `name` From cartoons INNER Join books On cartoons.`idprodect` = `books`.`bookid` INNER Join story On cartoons.`idprodect` = story.storyid Where cartoons.idpayments  = ".$_GET['id']." ". $pagination[0];

        $sql = "SELECT `payments_books`.*,`payments_books`.`type` as item_type,  `books`.`booktype`,
                                IF(`payments_books`.`itemtype`='book',`books`.`description_en`,`story`.`description_en`) as `description_en`,
                                IF(`payments_books`.`itemtype`='book',`books`.`description_ar`,`story`.`description_ar`) as `description_ar`,
                                IF(`payments_books`.`itemtype`='book',`books`.`author_ar`,`story`.`author_ar`) as `author_ar`,
                                IF(`payments_books`.`itemtype`='book',`books`.`author_en`,`story`.`author_en`) as `author_en`,
                                IF(`payments_books`.`itemtype`='book',`books`.`price`,`story`.`price`) as `price`,
                                IF(`payments_books`.`itemtype`='book',`books`.`rate`,`story`.`rate`) as `rate`,
                                IF(`payments_books`.`itemtype`='book',`books`.`isbn`,`story`.`isbn`) as `isbn`,
                                IF(`payments_books`.`itemtype`='book',`books`.`filling`,`story`.`filling`) as `filling`,
                                IF(`payments_books`.`itemtype`='book',`books`.`color`,`story`.`color`) as `color`,
                                IF(`payments_books`.`itemtype`='book',`books`.`eprice`,`story`.`eprice`) as `eprice`,
                                IF(`payments_books`.`itemtype`='book',`books`.`iprice`,`story`.`iprice`) as `iprice`,
                                IF(`payments_books`.`itemtype`='book',`books`.`comments`,`story`.`comments`) as `comments`,
                                IF(`payments_books`.`itemtype`='book',`books`.`rating_count`,`story`.`rating_count`) as `rate_count`,
IF(`payments_books`.`itemtype`='book',`books`.`name`,`story`.`title`) as `name`,
IF(`payments_books`.`itemtype`='book',`books`.`weight`,`story`.`weight`) as `weight`,
                                IF(`payments_books`.`itemtype`='book',`categories`.`name_en`,`stories_cat`.`name_en`) as name_en,

                                IF(`payments_books`.`itemtype`='book',`books`.`language`,`story`.`language`) As `language`
                                FROM `payments_books` LEFT OUTER JOIN `books` ON `payments_books`.`bookid`=`books`.`bookid` LEFT OUTER JOIN `story` ON `payments_books`.`bookid`=`story`.`storyid`
                                LEFT OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` LEFT OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid`  where payments_books.paymentid=".$_GET['id']." and ( payments_books.`type`=1 or payments_books.`type`=3 or payments_books.`type`=5 or payments_books.`type`=7 )" . $pagination[0];


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
                $data .= "<div class='display-table-cell user'>" . $row['prodecttype'] . "</div>";



                $data .= "<div class='display-table-cell book-title'>" . $row['name'] . "</div>";
                $data .= "<div class='display-table-cell Quantity'>" . $row['quantity'] . "</div>";
                $data .= "<div class='display-table-cell ISBN category'>" . $row['isbn'] . "</div>";
                $data .= "<div class='display-table-cell WEIGHT'>" . $row['carton'] . "</div>";

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
 ?>

<a onclick="printinpkt();" class="btn-default floating-right"><?= $Lang->Print ;?></a>
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

