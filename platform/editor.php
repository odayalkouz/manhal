<?php

/**
 * Created by Dar Almanhal - Hussam.
 * User: Hussam Abu Khadijeh
 * Date: 1/4/2016
 * Time: 12:49 PM
 */

if (session_status() == PHP_SESSION_NONE) {

    session_start();

}

include_once "config.php";

include_once "includes/function.php";


if (!isset($_GET['bookid']) || $_GET['bookid'] == '') {

    header("location:index.php");

    exit();

} else {

    if (!canEdit($_GET['bookid'])) {

        header("location:index.php");

        exit();

    }

}

//if($_SESSION["user"]["userid"]==25282){
//    echo "<script>alert('تم إغلاق المحرر لهذا المستخدم , لأسباب أمنية');</script>";
//    echo "خذي مغادرة وروحي يا فاطمة , ممنوع تشتغلي اليوم";
//    exit();
//}


$sql = "SELECT * FROM `books` WHERE `bookid`=" . $_GET['bookid'];

$result = $con->query($sql);

$row = mysqli_fetch_assoc($result);

$book = $row;


if (isset($_GET['type']) && $_GET['type'] == "new") {
    $sql = "SELECT max(`page_sort`) as sorting FROM `pages` WHERE `bookid`=" . $_GET['bookid'];
    $result = $con->query($sql);
    $row = mysqli_fetch_assoc($result);
    $page_sort = $row['sorting'] + 1;

    if(isset($_GET['dpage']) && $_GET['dpage'] != ""){
        $sql = "SELECT * FROM `pages` WHERE `pageid`=" .$_GET['dpage'];
        $result = $con->query($sql);
        $row = mysqli_fetch_assoc($result);
        $sql = "INSERT INTO `pages`(`title`, `subtitle`, `height`, `width`,`bookid`,`html`,`page_sort`) VALUES ('".mysqli_real_escape_string($con,$row['title'])."', '".mysqli_real_escape_string($con,$row['subtitle'])."', " . $row['height'] . ", " . $row['width'] . "," . $row['bookid'] . ",'" . mysqli_real_escape_string($con, $row['html'] ) . "',$page_sort)";
        $con->query($sql);
        $pageid = $con->insert_id;
        header("location:editor.php?bookid=" . $_GET['bookid'] . "&pageid=" . $pageid);
        exit();
    }else{
        $sql = "INSERT INTO `pages`(`pageid`,`title`, `subtitle`, `height`, `width`,`bookid`,`html`,`page_sort`) VALUES ('','Title', 'Subtitle', " . $book['height'] . ", " . $book['width'] . "," . $_GET['bookid'] . ",'" . mysqli_real_escape_string($con, '<div class="page page_container jq_multi_file" publish="" editor="" style="width:' . $book['width'] . 'px;height:' . $book['height'] . 'px;background: url(book.jpg) no-repeat;"><div class="negative  negative-container" style="background:url() no-repeat;"></div></div>') . "',$page_sort)";
        $con->query($sql);
        $pageid = $con->insert_id;
        header("location:editor.php?bookid=" . $_GET['bookid'] . "&pageid=" . $pageid);
        exit();
    }

} elseif (isset($_GET['pageid']) && $_GET['pageid'] != '') {

    $pageid = $_GET['pageid'];

} else {

    $sql = "SELECT `pageid` FROM `pages` WHERE `bookid`=" . $_GET['bookid'] . " ORDER BY `page_sort` DESC";

    $result = $con->query($sql);

    if (mysqli_num_rows($result) > 0) {

        $row = mysqli_fetch_assoc($result);

        $pageid = $row['pageid'];

    } else {

        header("location:editor.php?type=new&bookid=" . $_GET['bookid']);

        exit();

    }

}


$sql = "SELECT * FROM `pages` WHERE `bookid`=" . $_GET['bookid'] . " AND pageid=" . $pageid;

$result = $con->query($sql);

$row = mysqli_fetch_assoc($result);

$page = $row;


include_once "includes/language.php";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.0 Final//AR">

<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">





    <script src="../js/jquery.js"></script>

    <script type="text/javascript">

        // showLoading();

        window.bookid =<?=$_GET['bookid'];?>;

        window.pageid =<?=$pageid;?>;

    </script>

    <script src="../js/lang.js"></script>

    <script src="../js/editor.js"></script>

    <script src="../js/jquery-ui.min.js"></script>

    <link href="../js/jquery-ui.min.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css"

          href="themes/Light-green-<?= $_SESSION["lang"]; ?>/fonts/font-awesome/css/font-awesome.min.css"/>

    <script type="text/javascript" src="../js/jquery.popline.min.js"></script>

    <link rel="stylesheet" type="text/css" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/css/default.css">

    <link rel="stylesheet" type="text/css" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/css/icons.css">

    <link rel="stylesheet" type="text/css" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/fonts/fonts.css">

    <link rel="stylesheet" type="text/css" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/css/editor.css">

    <script type="text/javascript" src="../js/manhal-ui-<?= $_SESSION["lang"]; ?>.js"></script>

    <script type="text/javascript" src="../js/sweetalert-dev.js"></script>

    <link rel="stylesheet" type="text/css" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/css/sweetalert.css">


    <link rel="stylesheet" type="text/css" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/css/animate.css">


    <script type="text/javascript" src="../js/jquery.nu-context-menu.js"></script>

    <link rel="stylesheet" type="text/css" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/css/nu-context-menu.css">

    <link rel="stylesheet" type="text/css" href="books/<?= $_GET['bookid']; ?>/files/css/editor-fonts.css">

    <script type="text/javascript" src="../js/action.js"></script>

    <script type="text/javascript" src="../js/html2canvas.js"></script>
    <script type="text/javascript" src="<?=SITE_URL?>viedoplayer/dist/plyr.js"></script>
    <link rel="stylesheet" href="<?=SITE_URL?>viedoplayer/dist/plyr.css">

    <link rel="stylesheet" href="themes/Light-green-<?= $_SESSION["lang"]; ?>/css/magnific-popup.css">
    <script src="../js/jquery.magnific-popup.min.js"></script>
    <script type="text/javascript" src="../js/seeThru.min.js"></script>
    <script type="text/javascript" src="../js/spritespin.js"></script>
    <script src="../js/jquery.ui.rotatable.js"></script>
    <script type="text/javascript" src="../js/Event.js"></script>
    <script type="text/javascript" src="../js/Dragdrop.js"></script>
    <script type="text/javascript" src="../js/RulersGuides.js"></script>

</head>

<body>

<div class="loader-table" style="display: none">

    <div class="loader-cell">

        <div id="loader">

            <div class="bar"></div>

            <div class="bar"></div>

            <div class="bar"></div>

            <div class="bar"></div>

            <div class="bar"></div>

            <div class="bar"></div>

            <div class="bar"></div>

            <div class="bar"></div>

        </div>

    </div>

</div>

<header>

    <a href="index.php">

        <img class="floating-left" src="themes/Light-green-<?= $_SESSION["lang"]; ?>/images/logo1.png">

    </a>

    <nav class="floating-left">

        <div class="floating-right display-inline-block">

            <a class="floating-left flaticon-save31" title="<?= $Lang->Save; ?>" id="save"></a>

            <a href="ajax/editor.php?process=publish&bookid=<?= $_GET['bookid']; ?>&pageid=<?= $pageid; ?>&view=1"

               target="_blank" class="floating-left flaticon-eye106" title="<?= $Lang->View; ?>" id="view"></a>

            <a class="floating-left flaticon-direction237" href="index.php" id="exit" title="<?= $Lang->Exit; ?>"></a>

        </div>

        <div class="floating-right goto-container">

            <label class="floating-left"><?= $Lang->goTo; ?></label>

            <select id="goto">

                <optgroup label="<?= $Lang->Pages; ?>">

                    <?php

                    $sql = "SELECT * FROM `pages` WHERE `bookid`=" . $_GET['bookid'] . " ORDER BY `page_sort` ASC ";

                    $result = $con->query($sql);

                    while ($row = mysqli_fetch_assoc($result)) {

                        if ($row['pageid'] == $pageid) {

                            $selected = 'selected="selected"';

                        } else {
                            $selected = '';
                        }
                        ?>

                        <option value="<?= $row['pageid']; ?>" <?= $selected; ?>><?= $row['page_sort']; ?></option>

                        <?php

                    }

                    ?>

                </optgroup>

            </select>

        </div>

    </nav>

</header>

<div class="editor-main-menu-container">

    <div class="nav floating-left">

        <a class="" id="Page_menu" title="page"><i class="flaticon-interface"></i></a>

        <a id="Action_menu" title="<?= $Lang->Action; ?>"><i class="flaticon-icon-74926"></i></a>

        <a id="Widget_menu" title="<?= $Lang->widget; ?>"><i class="flaticon-icon-78938"></i></a>

        <a id="Trace_menu" title="<?= $Lang->Trace; ?>"><i class="flaticon-icon-14485"></i></a>
        <a id="Layer_menu" title="Layer"><i class="layer-icon"></i></a>
        <a id="fix_element" title="Layer">fix</a>
    </div>

    <div class="nav-content" id="page-content" style="display: none">

        <div class="header"><a class="floating-left title"><?= $Lang->page; ?></a><a

                class="floating-right close-menu"><i class="flaticon-x"></i></a></div>

        <div class="content">

            <div class="overview">You can edit, delete, add new page</div>

            <div class="row" id="newpage"><a class="floating-left icon"><i class="flaticon-pages"></i></a> <a

                    class="floating-left title"><?= $Lang->NewPage; ?></a></div>

            <div class="row" id="dplicatepage"><a class="floating-left icon"><i class="flaticon-pages"></i></a> <a

                        class="floating-left title"><?= $Lang->DuplicatePage; ?></a></div>

            <div class="row" id="deletepage"><a class="floating-left icon"><i class="flaticon-document26"></i></a> <a

                    class="floating-left title"><?= $Lang->DeletePage; ?></a></div>



            <div class="row" id="font"><a class="floating-left icon"><i class="flaticon-fon"></i></a> <a

                    class="floating-left title"><?= $Lang->Font; ?></a></div>

            <div class="row" id="setting"><a class="floating-left icon"><i class="flaticon-gear39"></i></a> <a

                    class="floating-left title"><?= $Lang->Setting; ?></a></div>

            <div class="row" id="addindex"><a class="floating-left icon"><i class="flaticon-list6"></i></a> <a

                    class="floating-left title"><?= $Lang->Addindex; ?></a></div>
            <div class="row" id="booklessons"><a class="floating-left icon"><i class="flaticon-list6"></i></a> <a
                    class="floating-left title"><?= $Lang->booklessons; ?></a></div>
        </div>

    </div>

    <div class="nav-content" id="action-content" style="display: none">

        <div class="header"><a class="floating-left title"><?= $Lang->Action; ?></a><a

                class="floating-right close-menu"><i class="flaticon-x"></i></a></div>

        <div class="content">

            <div class="overview">you can add image, video, sound, url, quiz view in popup</div>

            <div class="row widget" id="aimage"><a class="floating-left icon"><i class="flaticon-picture62"></i></a> <a

                    class="floating-left title"><?= $Lang->Image; ?></a></div>

            <div class="row widget" id="avideo"><a class="floating-left icon"><i class="flaticon-youtube1"></i></a> <a

                    class="floating-left title"><?= $Lang->Video; ?></a></div>

            <div class="row widget" id="asound"><a class="floating-left icon"><i class="flaticon-sound"></i></a> <a

                    class="floating-left title"><?= $Lang->Sound; ?></a></div>

            <div class="row widget" id="aurl">
                <a class="floating-left icon"><i class="flaticon-links12"></i></a>
                <a class="floating-left title"><?= $Lang->URL; ?></a>
            </div>

            <div class="row widget" id="aurltext">
                <a class="floating-left icon"><i class="flaticon-links12"></i></a>
                <a class="floating-left title"><?= $Lang->TextURL; ?></a>
            </div>

            <div class="row widget" id="textlink">
                <a class="floating-left icon"><i class="flaticon-links12"></i></a>
                <a class="floating-left title"><?= $Lang->TextLink; ?></a>
            </div>

            <div class="row widget" id="aurlimage">
                <a class="floating-left icon"><i class="flaticon-links12"></i></a>
                <a class="floating-left title"><?= $Lang->ImageURL; ?></a>
            </div>

            <div class="row widget" id="imagelink">
                <a class="floating-left icon"><i class="flaticon-links12"></i></a>
                <a class="floating-left title"><?= $Lang->ImageLink; ?></a>
            </div>

            <div class="row widget" id="douknow"><a class="floating-left icon"><i class="flaticon-info27"></i></a> <a

                    class="floating-left title">هل تعلم</a></div>

            <div class="row widget" id="aquiz">
                <a class="floating-left icon"><i class="flaticon-check7"></i></a>
                <a class="floating-left title"><?= $Lang->Quiz; ?></a>
            </div>


        </div>
    </div>

    <div class="nav-content" id="widget-content" style="display: none">

        <div class="header">

            <a class="floating-left title"><?= $Lang->widget; ?></a>

            <a class="floating-right close-menu">

                <i class="flaticon-x"></i>

            </a>

        </div>

        <div class="content">

            <div class="overview">you can add image, video, sound, text, number box ,animation view on main page</div>

            <div class="row widget" id="wimage"><a class="floating-left icon"><i class="flaticon-books67"></i></a>

                <a class="floating-left title"><?= $Lang->AddImage; ?></a></div>

            <div class="row widget" id="wvideo"><a class="floating-left icon"><i class="flaticon-camera142"></i></a> <a

                    class="floating-left title"><?= $Lang->AddVideo; ?></a></div>

            <div class="row widget" id="wsound"><a class="floating-left icon"><i class="flaticon-plus11"></i></a> <a

                    class="floating-left title"><?= $Lang->AddSound; ?></a></div>

            <div class="row widget" id="wtext"><a class="floating-left icon"><i class="flaticon-note5"></i></a> <a

                    class="floating-left title"><?= $Lang->AddText; ?></a></div>

            <div class="row widget" id="numberbox"><a class="floating-left icon"><i class="flaticon-tool7"></i></a> <a

                    class="floating-left title"><?= $Lang->NumberBox; ?></a></div>

            <div class="row widget" id="animationImage" title="Animation">
                <a class="floating-left icon"><i class="flaticon-interface-1"></i></a>
                <a class="floating-left title"><?= $Lang->AnimationImage; ?></a>
            </div>

            <div class="row widget" id="iframewidget" title="Animation">
                <a class="floating-left icon"><i class="flaticon-interface-1"></i></a>
                <a class="floating-left title"><?=$Lang->Iframe;?></a>
            </div>
            <div class="row widget" id="sliderwidget" title="slider">
                <a class="floating-left icon"><i class="flaticon-interface-1"></i></a>
                <a class="floating-left title"><?=$Lang->Slider;?></a>
            </div>

            <div class="row widget" id="scratcherwidget" title="scratcher">
                <a class="floating-left icon"><i class="flaticon-interface-1"></i></a>
                <a class="floating-left title"><?=$Lang->Scratcher;?></a>
            </div>

            <div class="row widget" id="popoutimage" title="pop uot image">
                <a class="floating-left icon"><i class="flaticon-interface-1"></i></a>
                <a class="floating-left title"><?=$Lang->PopOut;?></a>
            </div>

            <div class="row widget" id="videotransparent" title="Transparent Video">
                <a class="floating-left icon"><i class="flaticon-interface-1"></i></a>
                <a class="floating-left title"><?=$Lang->TransparentVideo;?></a>
            </div>

            <div class="row widget" id="image360" title="image 360">
                <a class="floating-left icon"><i class="flaticon-interface-1"></i></a>
                <a class="floating-left title"><?=$Lang->image360;?></a>
            </div>

            <div class="row widget" id="symbols">
                <a class="floating-left icon"><i>S</i></a>
                <a class="floating-left title"><?= $Lang->Symbols; ?></a>
            </div>


        </div>

    </div>

    <div class="nav-content" id="trace-content" style="display: none">

        <div class="header"><a class="floating-left title"><?= $Lang->Trace; ?></a><a class="floating-right close-menu"><i

                    class="flaticon-x"></i></a></div>

        <div class="content">

            <div class="overview">you can add trace color, trace circle</div>

            <div class="row widget" id="atrace"><a class="floating-left icon"><i class="flaticon-paint81"></i></a> <a

                    class="floating-left title"><?= $Lang->TraceQuiz; ?></a></div>

            <div class="row widget" id="sound_text"><a class="floating-left icon"><i class="flaticon-paint81"></i></a>
                <a

                    class="floating-left title"><?= $Lang->SoundText; ?></a></div>

            <div class="row widget" id="game"><a class="floating-left icon"><i class="flaticon-paint81"></i></a> <a

                    class="floating-left title"><?= $Lang->Game; ?></a></div>

            <div class="row widget" id="circle"><a class="floating-left icon"><i class="flaticon-icon-581"></i></a> <a

                    class="floating-left title"><?= $Lang->Circle; ?></a></div>

        </div>

    </div>


    <div class="nav-content" id="layar-content" style="display: none">
        <div class="header">
            <a class="floating-left title">Layer</a>
            <a class="floating-right close-menu"><i class="flaticon-x"></i></a>
        </div>
        <div class="content layers">
            <div class="row-layer active">
                <a class="floating-left checkbox"><input type="checkbox" checked="checked"></a>
                <a class="floating-left title">Layer 1</a>
            </div>
            <div class="row-layer">
                <a class="floating-left checkbox"><input type="checkbox" checked="checked"></a>
                <a class="floating-left title">Layer 2</a>
            </div>
            <div class="row-layer">
                <a class="floating-left checkbox"><input type="checkbox" checked="checked"></a>
                <a class="floating-left title">Layer 3</a>
            </div>
            <div class="row-layer">
                <a class="floating-left checkbox"><input type="checkbox" checked="checked"></a>
                <a class="floating-left title">Layer 4</a>
            </div>
            <div class="row-layer">
                <a class="floating-left checkbox"><input type="checkbox" checked="checked"></a>
                <a class="floating-left title">Layer 5</a>
            </div>
            <div class="row-layer">
                <a class="floating-left checkbox"><input type="checkbox" checked="checked"></a>
                <a class="floating-left title">Layer 6</a>
            </div>
        </div>
    </div>
</div>

<div class="site-container">

    <div class="admin-login" id="popup_action" style="display: none;">

        <div class="popup-main-container">

            <div class="popup-tabel">

                <div class="popup-row">

                    <div class="popup-cell">

                        <div class="popup-container">

                            <label class="close-container">

                                <i class="flaticon-x floating-right close"></i>

                            </label>

                            <div class="popup-content">

                                <div class="containers" id="action_containerb">

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <?= $page['html']; ?>

</div>

<img id="thumb" style="display: none;"/>

<div class="admin-login" id="popup" style="display:none;">

    <div class="popup-main-container">

        <div class="popup-tabel">

            <div class="popup-row">

                <div class="popup-cell">

                    <div class="popup-container">

                        <label class="close-container">

                            <i class="flaticon-x floating-right close"></i>

                        </label>

                        <div class="popup-content">

                            <div class="container" id="action_container">

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>


<iframe style="border:0px;width:0px;height:0px;" id="upload_target" name="upload_target"></iframe>

<canvas id="queImg" width="115" height="140" style="display: none;"></canvas>

<div style="display: none" id="copier"></div>

<?php

$sql = "SELECT * FROM `books` WHERE `bookid`=" . $_GET['bookid'];

$result = $con->query($sql);

$row = mysqli_fetch_assoc($result);

if ($row['fonts'] == "") {

    $current_fonts = array();

} else {

    $current_fonts = json_decode($row['fonts'], true);

}


foreach ($current_fonts as $font) {


}

?>


<script type="text/javascript">

    (function ($) {

        var m_font = [

            <?php

            foreach ($current_fonts as $font) {

                echo "'" . $fonts[$font] . "',";

            }

            ?>

        ];

        var getMFontButtons = function () {

            var buttons = {};

            $(m_font).each(function (index, font) {

                buttons['font' + index] = {

                    text: font,

                    action: function (event) {

                        document.execCommand('fontName', false, font);

                    }

                }

            });

            return buttons;

        };


        $.popline.addButton({

            FontName: {

                iconClass: "flaticon-fon",

                mode: "edit",

                buttons: getMFontButtons()

            }

        });

    })(jQuery);

</script>

</body>

</html>

