<?php
$server_root=$_SERVER['DOCUMENT_ROOT']."/manhal/";
include_once($server_root.'platform/config.php');
include_once $server_root."platform/new/includes/db.php";
include_once $server_root."platform/new/includes/functions.php";
$URL="http://localhost/Manhal/platform/new";
$real_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if(isset($_SESSION["lang"]) && $_SESSION["lang"]!=""){
    $db_lang=strtolower($_SESSION["lang"]);
    $Lang = simplexml_load_file($server_root."language/".ucfirst($_SESSION["lang"]).".xml");
}else{
    $db_lang="en";
    $_SESSION["lang"]="en";
    $Lang = simplexml_load_file($server_root."language/En.xml");
}
?>
<html>
<head>
    <title>Dar Al-Manhal</title>
    <link data-type="favicon" href="../themes/en/images/favicon.ico" type="image/x-icon" rel="icon">
    <link href="../themes/en/css/login.css" rel="stylesheet">
    <script src="../js/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="../themes/en/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="col-left">
                <div class="login-text">
                    <h2><img src="../themes/en/images/logowhite.svg"></h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget eros dapibus, ultricies tellus vitae, consectetur tortor. Etiam rutrum placerat</p>
                    <a class="btn" href="https://www.manhal.com/en/about-us" target="_blank"><?=$Lang->ReadMore?></a>
                </div>
            </div>
            <div class="col-right">
                <div class="login-form">
                    <h2><?=$Lang->Login?></h2>
                    <form>
                        <div class="display-block">
                            <input type="text" placeholder="<?=$Lang->UserName?>" id="username" name="username" required>
                        </div>
                        <div class="display-block">
                            <input type="password" placeholder="<?=$Lang->Password?>" id="password" name="password" required>
                        </div>
                        <div class="display-block">
                            <input class="btn" type="submit" value="<?=$Lang->Login1?>" id="signIn" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


