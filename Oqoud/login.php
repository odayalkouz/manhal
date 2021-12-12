<?php
/**
 * Created by PhpStorm.
 * User: khalid
 * Date: 15/06/2020
 * Time: 03:34 م
 */
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (isset($_SESSION["username"])) {
    header('Location: index.php');
    exit();
}
?>
<html>
<head>
    <title>Dar Al-Manhal Contracts</title>
    <link data-type="favicon" href="themes/en/images/favicon.ico" type="image/x-icon" rel="icon">
    <link href="themes/en/css/login.css" rel="stylesheet">
    <script src="js/jquery.js"></script>
    <script type="text/javascript" src="js/manhal-ui.js"></script>
    <link rel="stylesheet" type="text/css" href="themes/en/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
</head>
<body>
<div class="limiter">
    <div class="container-login100" style="background-image: url('themes/en/images/login-bg.jpg');">
        <div class="wrap-login100 p-t-30 p-b-50">
            <span class="login100-form-title p-b-41" style="background: url('themes/en/images/logowhite.svg') no-repeat center;background-size: 55%;"></span>
            <form method="post" action="api.php" target="_self" class="login100-form validate-form p-b-33 p-t-5">
                <div class="wrap-input100 validate-input" data-validate = "Enter username">
                    <input type="hidden"   name="process" value="signin">
                    <input class="input100" type="text" placeholder="Username" required="" id="username"  name="username" value="">
                    <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                </div>
                <div class="wrap-input100 validate-input" data-validate="Enter password">
                    <input class="input100" type="password" placeholder="Password" required="" id="pass" name="pass">
                    <span class="focus-input100" data-placeholder="&#xe80f;"></span>
                </div>
                <div class="container-login100-form-btn m-t-32">
                    <input class="login100-form-btn" type="submit"/>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>


