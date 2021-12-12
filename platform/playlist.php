<?php

/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 07/04/2019
 * Time: 5:04 PM
 */

$cuerrentpage = "playlist.php";

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["user"])) {
    header('Location: login.php');
    exit();
} else if ($_SESSION["user"]['permession'] == 3) {
    header('Location:warehouse.php');
    exit();
} else if ($_SESSION["user"]['permession'] == 4) {
    header('Location:shippingwarehouse.php');
    exit();
} else if ($_SESSION["user"]['permession'] == 5) {
    header('Location:invoice.php');
    exit();
} else if ($_SESSION["user"]['permession'] == "" || $_SESSION["user"]['permession'] == NULL || $_SESSION["user"]['permession'] < 1 || $_SESSION["user"]['permession'] > 9) {
    header('Location:logout.php');
    exit();
}

include_once('config.php');
include_once('includes/language.php');
include_once('includes/function.php');
include_once('../includes/function.php');
$bredcrumb = '<li class="floating-left"><a href="games.php" class="floating-left active">'.$Lang->PlayList.'</a></li>';

include_once "includes/header.php";
?>
    <div class="books-container">
        <form>
            <label class="lbl-data-a floating-left"><?= $Lang->Category ?></label>
            <select class="txt-a floating-left submit_form" id="category" name="category">
                <option value='0'>---------------</option>
                <?php
                $cat_sql = "Select * From  `categories` WHERE `parent`=0";
                $cat_result = $con->query($cat_sql);
                if (mysqli_num_rows($cat_result) > 0) {
                    while ($cat_row = mysqli_fetch_assoc($cat_result)) {
                        echo getCategories($cat_row['catid'], "categories");
                    }
                }
                ?>
            </select>
            <input type="text" class="txt-a floating-left book-serach" id="keywords" name="keywords"
                   placeholder="<?= $Lang->search ?>"
                   value="<?php if (isset($_GET['keywords']) && $_GET['keywords'] != "") {
                       echo $_GET['keywords'];
                   } ?>">
            <input class="floating-left btn-default-b" type="submit" value="<?= $Lang->search ?>">
        </form>


        <div class="display-table">
            <!--start table caption-->
            <div class="disply-table-caption table-title">
                <div class="display-table-cell number"><?= $Lang->No; ?></div>
                <div class="display-table-cell book-title"><?= $Lang->Title; ?></div>
                <div class="display-table-cell user"><?= $Lang->User; ?></div>
                <div class="display-table-cell category"><?= $Lang->Category; ?></div>
                <div class="display-table-cell created-at"><?= $Lang->CreatedDate; ?></div>
                <div class="display-table-cell book-thumb"><?= $Lang->Thumb; ?></div>
                <div class="display-table-cell book-thumb"><?= $Lang->Type; ?></div>
                <div class="display-table-cell action"><?= $Lang->Action; ?></div>
            </div>

            <!--end table caption-->
            <!--start table rows-->

            <?php
            if ($_SESSION['user']['permession'] == 1 || $_SESSION['user']['permession'] == 6) {
                $weruser = '';
            } else {
                $weruser = "and playlist.userid=" . $_SESSION['user']['userid'];
            }

            $keyword_filter = "";
            $keywords = "";
            if (isset($_GET['keywords']) && $_GET['keywords'] != "") {
                $keywords = "keywords=" . $_GET['keywords'];
                $keyword_filter = " AND (`title_ar` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%' OR `title_en` LIKE '%" . mysqli_real_escape_string($con, $_GET['keywords']) . "%') ";
            }

            $cat_filter = "";

            if (isset($_GET['category']) && $_GET['category'] != 0) {
                $keywords .= "&category=" . $_GET['category'];
                $cat_filter = " AND `playlist`.`category` = " . $_GET['category'];
            }


            $sql = "SELECT `playlist`.*,`users`.*,`categories`.* FROM `playlist` left OUTER JOIN `categories` ON `playlist`.`category`=`categories`.`catid` left OUTER JOIN `users` on `playlist`.`userid`=`users`.`userid` WHERE `playlist`.`id` >0 " . $weruser . $keyword_filter . $cat_filter;

            $result = $con->query($sql);

            $url = "games.php?" . $keywords;

            $result = $con->query($sql);

            $num_rows = mysqli_num_rows($result);


            $pagination = getPagination($url, $num_rows);


            $sql = "SELECT `playlist`.*,`users`.*,`categories`.* FROM `playlist` left OUTER JOIN `categories` ON `playlist`.`category`=`categories`.`catid` left OUTER JOIN `users` on `playlist`.`userid`=`users`.`userid` WHERE `playlist`.`id` >0 " . $weruser . $keyword_filter . $cat_filter . $pagination[0];

            $result = $con->query($sql);

            $data = '';


            $reset_counter = 0;


            if (isset($_GET["page"]) && $_GET["page"] > 1) {

                $reset_counter = BooksPerPage * ($_GET["page"] - 1);

            }


            if (mysqli_num_rows($result) > 0) {

                // output data of each row

                $i = 1;


                while ($row = mysqli_fetch_assoc($result)) {

                    $page_number = $reset_counter + $i;

                    $data .= "<div id='playlist_" . $row['id'] . "' class='display-table-row #class#'>";

                    $data .= "<div class='display-table-cell number' >" . $page_number . "</div>";

                    $data .= "<div class='display-table-cell book-title'><a href='" . $row['editor'] . "/index.php?id=" . $row['id'] . "'>" . $row['title_en'] . "</a></div>";

                    $data .= "<div class='display-table-cell user'>" . $row['fullname'] . "</div>";

                    $data .= "<div class='display-table-cell category'>" . $row['name_' . strtolower($_SESSION["lang"])] . "</div>";

                    $data .= "<div class='display-table-cell created-at'>" . $row['cdate'] . "</div>";

                    $data .= "<div class='display-table-cell book-thumb'><a class='preview'><img src='games/" . $row['id'] . "/images/thumb.jpg' alt='" . $row['title_en'] . "' /></a></div>";
                    $data .= "<div class='display-table-cell book-thumb'>" . $row['editor'] . "</div>";

                    $data .= "<div class='display-table-cell action'>";

                    $data .= "<div class='butons-container'>";


                    if (canEditGame($row)) {

                        if ($i % 2 == 0) {

                            $data = str_replace("#class#", 'bg-row-a', $data);

                        } else {

                            $data = str_replace("#class#", 'bg-row', $data);

                        }

                        $data .= " <a title='" . $Lang->Info . "' href='editplaylist.php?id=" . $row["id"] . "'>";

                        $data .= " <i class='flaticon-info27'></i> </a>";

                        $data .= " <a title='" . $Lang->Delete . "'  class='deletegame' id='" . $row["id"] . "' >";

                        $data .= " <i class='flaticon-delete96'></i> </a>";

                        $data .= '<a title="' . $Lang->Download . '" class="" target="_blank" href="ajax/download.php?id=' . $row["id"] . '">';

                        $data .= " <i class='flaticon-download195'></i></a>";

                        $data .= '<a title="' . $Lang->Publish . '" class="jq_publishgame" data-href="ajax/games.php?process=publishgame&id=' . $row["id"] . '">';

                        $data .= " <i class='flaticon-arrow73'></i></a>";

                        $data .= '<a title="' . $Lang->View . '" target="_blank" href="' . $row['editor'] . '/viewer/' . strtolower($row['language']) . '/index.php?id=' . $row["id"] . '" >';


                        $data .= " <i class='flaticon-eye106'></i></a>";
                        if ($row["editor"] != 'coloring') {
                            $data .= '<a title="' . $Lang->Edit . '" href="' . $row['editor'] . '/index.php?id=' . $row['id'] . '">';

                            $data .= " <i class='flaticon-pencil43'></i></a>";
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

        <a href="editplaylist.php?id=new" class="btn-default floating-right"><?= $Lang->AddPlaylist; ?></a>

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