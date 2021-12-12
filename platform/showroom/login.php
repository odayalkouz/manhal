<?php
include_once "includes/functions.php";
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
if(isset($_SESSION['user']) &&  $_SESSION['user']!=''){
    if(isset($_SESSION['user']['permission'])&&$_SESSION['user']['permission']!=''){
       if($_SESSION['user']['permission']==1 || $_SESSION['user']['permission']==7){
           header('Location: index.php');
       }
    }
}

?>
<html>
<head>
    <title>Dar Al-Manhal</title>
    <link data-type="favicon" href="<?=$prosses->URL;?>/themes/En/images/favicon.ico" type="image/x-icon" rel="icon">
    <link href="<?=$prosses->URL;?>/themes/En/css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="<?=$prosses->URL;?>/themes/all/css/lobibox.min.css"/>
    <script src="<?=$prosses->URL;?>/js/jquery.js"></script>
    <script type="text/javascript" src="<?=$prosses->URL;?>/js/lobibox.min.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.2.4/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/6.2.4/firebase-messaging.js"></script>
    <script defer src="<?=$prosses->URL;?>/js/init-firebase.js"></script>
    <script src="<?=$prosses->URL;?>/js/login.js"></script>
    <link rel="stylesheet" type="text/css" href="<?=$prosses->URL;?>/themes/En/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <script language="JavaScript">
        var lang_getmassage=<?=$prosses->getlang('msgjavascript');?>;
        var $url='<?=$prosses->URL?>';
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container">
            <div class="col-left">
                <div class="login-text">
                    <h2><img src="<?=$prosses->URL;?>/themes/En/images/logowhite.svg"></h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget eros dapibus, ultricies tellus vitae, consectetur tortor. Etiam rutrum placerat</p>
                    <a class="btn" href="https://www.manhal.com/en/about-us" target="_blank"><?=$prosses->getlang('ReadMore');?></a>
                </div>
            </div>
            <div class="col-right">
                <div class="login-form">
                    <h2><?=$prosses->getlang('Login_to_your_account');?></h2>
                    <form>
                        <input type="hidden" name="web_token" id="web_token">
                        <div class="display-block">
                            <input type="text" placeholder="<?=$prosses->getlang('Username');?>" id="username" name="username" required>
                        </div>
                        <div class="display-block">
                            <input type="password" placeholder="<?=$prosses->getlang('Password');?>" id="password" name="password" required>
                        </div>
                        <div class="display-block">
                            <input class="btn" onclick="login()" name="submit" id="submit" type="button" value="<?=$prosses->getlang('LOGIN');?>" id="signIn"/>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


