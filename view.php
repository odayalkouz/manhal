<?php
include_once "platform/config.php";
include_once "includes/function.php";


if(isset($_GET["type"]) && $_GET["type"]=="book"){
    include_once "includes/view_book.php";
}elseif(isset($_GET["type"]) && $_GET["type"]=="story") {
    include_once "includes/view_story.php";
}elseif(isset($_GET["type"]) && $_GET["type"]=="games") {
    include_once "includes/view_game.php";
}elseif(isset($_GET["type"]) && $_GET["type"]=="worksheet") {
    include_once "includes/view_worksheet.php";
}elseif(isset($_GET["type"]) && $_GET["type"]=="video") {
    include_once "includes/view_video.php";
}elseif(isset($_GET["type"]) && $_GET["type"]=="audio") {
    include_once "includes/view_audio.php";
}elseif(isset($_GET["type"]) && $_GET["type"]=="playgame") {
    include_once "includes/play_game.php";
}elseif(isset($_GET["type"]) && $_GET["type"]=="educationalinquiries") {
    include_once "includes/view_discussions.php";
}elseif(isset($_GET["type"]) && $_GET["type"]=="playworksheet") {
    include_once "includes/play_worksheet.php";
}elseif(isset($_GET["type"]) && $_GET["type"]=="teacher_book") {
    include_once "includes/view_Teacher_book.php";
}elseif(isset($_GET["type"]) && $_GET["type"]=="furniture") {
    include_once "includes/view_furniture.php";
}elseif(isset($_GET["type"]) && $_GET["type"]=="interactive-worksheets") {
    include_once "includes/view_interactive_worksheets.php";
}elseif(isset($_GET["type"]) && $_GET["type"]=="playinteractiveworksheets") {
    include_once "includes/play_interactive_worksheets.php";
}elseif(isset($_GET["type"]) && $_GET["type"]=="store") {
    if($_GET["storetype"]=="book"){
        include_once "includes/view_store.php";
    }elseif ($_GET["storetype"]=="story"){
        include_once "includes/view_store_story.php";
    }elseif ($_GET["storetype"]=="toy"){
        include_once "includes/view_store_toy.php";
    }
}

 include_once("includes/footer.php"); ?>
