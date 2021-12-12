<?php
error_reporting(0);
$real_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//$pageName=basename($_SERVER['PHP_SELF']);
if (session_status() == PHP_SESSION_NONE)
{
    session_start();
}
$_SESSION["lasturl"]=$real_link;
$counters='';
//$_SESSION["counters"]="";
if(!isset($_SESSION["counters"]) || $_SESSION["counters"]==""){
    $sql="SELECT * FROM `counters` WHERE `id`>0";
    $result=$con->query($sql);
    $counters='';

while($rowHeader=mysqli_fetch_assoc($result)){

    if($rowHeader['product']=='books' && $rowHeader['category']==-1||$rowHeader['product']=='stories' && $rowHeader['category']==-1) {
        $counters[$rowHeader['product']] = $rowHeader['count'];

    }else if($rowHeader['product']!='books' && $rowHeader['product']!='stories'){

        $counters[$rowHeader['product']]=$rowHeader['count'];

    }

}

 //  $counters=mysqli_fetch_all($result);
    $_SESSION["counters"]=$counters;
}else{
    $counters=$_SESSION["counters"];
}



//set headers to NOT cache a page
//header("Cache-Control: private"); //HTTP 1.1
//header("Cache-Control: max-age=31104000");
//header("Pragma: max-age=31104000"); //HTTP 1.0
//if(!isset($_SESSION["user"]) && isset($_COOKIE["tokenbasic"]) && $_COOKIE["tokenbasic"]!="")
//{
//    $tokenbasic=$_COOKIE["tokenbasic"];
//    $ctime=$_COOKIE["ctime"];
//    $tokenNumber=($tokenbasic*3-465)*6;
//    $sql="SELECT * FROM `users` WHERE `token`=".$tokenNumber." AND `ctime`=".$ctime;
//    $result = $con->query($sql);
//    if (mysqli_num_rows($result) > 0)
//    {
//        $row = mysqli_fetch_assoc($result);
//        $_SESSION["user"] = $row;
//    }
//}
$cash="?18";
?>
<!DOCTYPE html>
<html lang="<?=strtolower($_SESSION["lang"]);?>">
<head>
    <meta content="utf-8" http-equiv="encoding">
<!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta HTTP-EQUIV="CACHE-CONTROL" CONTENT="Public">
    <meta HTTP-EQUIV="CONTENT-LANGUAGE" CONTENT="<?=strtolower($_SESSION["lang"]);?>">
    <meta NAME="description" CONTENT="<?=getPageDescription($pageName);?>">
<!--    <meta http-equiv="Pragma" content="no-cache" />-->
     <title><?=getPageTitle($pageName);?></title>
    <meta NAME="AUTHOR" CONTENT="<?= $Lang->Copyrite?>">
    <meta NAME="COPYRIGHT" CONTENT="&copy; <?php echo date("Y")?> <?= $Lang->Copyrite?>">
    <meta name="keywords" content="<?=getPageKeyWords($pageName);?>">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@nytimes"/>
    <meta property="og:site_name" content="<?=$Lang->SiteName;?>"/>
    <meta http-equiv="content-language" content="<?=strtolower($_SESSION['lang']);?>"/>
    <!-- Title -->
    <meta id="metaOgTitle" content="<?=getPageTitle($pageName);?>"/>
    <meta name="title" content="<?=getPageTitle($pageName);?>"/>
    <meta property="og:title" content="<?=getPageTitle($pageName);?>"/>
    <meta name="DC.title" content="<?=getPageTitle($pageName);?>"/>
    <meta name="twitter:label1" content="<?=getPageTitle($pageName);?>"/>
    <meta name="twitter:title" content="<?=getPageTitle($pageName);?>"/>
    <!-- Description -->
    <meta id="metaOgDescription" content="<?=getPageDescription($pageName);?>"/>
    <meta itemprop="description" content="<?=getPageDescription($pageName);?>"/>
    <meta property="og:description" content="<?=getPageDescription($pageName);?>"/>
    <meta name="twitter:description" content="<?=getPageDescription($pageName);?>"/>
    <meta name="twitter:label2" content="<?=getPageDescription($pageName);?>"/>
    <meta property="og:type"   content="website" />
    <!-- Image -->

    <meta id="metaOgImage" content="<?=getPageThumb($pageName);?>"/>
    <meta itemprop="image" content="<?=getPageThumb($pageName);?>"/>
    <meta name="image" content="<?=getPageThumb($pageName);?>"/>
    <meta property="og:image" content="<?=getPageThumb($pageName);?>"/>
    <meta property="fb:app_id" content="<?=FACEBOOK_APPID;?>"/>
    <meta name="twitter:image:src" content="<?=getPageThumb($pageName);?>"/>
    <meta name="twitter:image" content="<?=getPageThumb($pageName);?>"/>
    <link rel="image_src"  href="<?=getPageThumb($pageName);?>"/>
    <meta name="thumbnail" content="<?=getPageThumb($pageName);?>"/>
    <!-- Url -->
    <meta id="metaOgUrl" content="<?=$real_link;?>"/>
    <meta name="url" content="<?=$real_link;?>"/>
    <meta property="og:url" content="<?=$real_link;?>"/>
    <meta name="twitter:url" content="<?=$real_link;?>"/>
    <!-- Keywords -->
    <meta name="keywords" content="<?=getPageKeyWords($pageName);?>"/>
    <meta name="news_keywords" content="<?=getPageKeyWords($pageName);?>"/>
    <meta name="DC.keywords" content="<?=getPageKeyWords($pageName);?>"/>
    <!-- new-->
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="google-site-verification" content=""/>
    <meta name="revisit-after" content="1 days">
    <meta name="google" content="noodp" />
    <meta NAME="googlebot" CONTENT="NOARCHIVE">
    <meta name="contact" content="info@manhal.com" />
    <meta name="Slurp" content="noodp" >
    <meta name="bingbot" content="noodp" >
    <meta name="fragment" content="!" >
    <meta name="identifier-url" content="<?=$real_link;?>" />
    <meta name="abstract" content="Tools for webmasters" />
    <link data-type="favicon" href="<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/favicon.ico<?=$cash;?>" type="image/x-icon" rel="icon"/>
    <link rel="icon" data-type="favicon" sizes="196x196" href="<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/favicon.ico<?=$cash;?>" type="image/x-icon"/>
    <link href="<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/favicon.ico<?=$cash;?>" type="image/x-icon?!" rel="shortcut icon">
    <link rel="icon" sizes="32x32" href="<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION["lang"];?>/images/favicon.ico<?=$cash;?>" type="image/x-icon"/>
    <script type="text/javascript" src="<?=SITE_URL;?>js/jquery.js<?=$cash;?>"></script>
    <script async type="text/javascript" src="<?=SITE_URL;?>js/lang.js<?=$cash;?>"></script>
    <script  type="text/javascript" src="<?=SITE_URL;?>js/platforms-ui-<?=$_SESSION["lang"];?>.js<?=$cash;?>"></script>
    <script  type="text/javascript" src="<?=SITE_URL;?>js/jQuery.scrollSpeed.js<?=$cash;?>"></script>
    <script type="text/javascript" src="<?=SITE_URL;?>js/fastclick.js<?=$cash;?>"></script>
    <script type="text/javascript" src="<?=SITE_URL;?>js/parallax.min.js<?=$cash;?>"></script>
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/css/style.css<?=$cash;?>">
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/css/all.css<?=$cash;?>">
    <link rel="stylesheet" type="text/css" href="<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/css/size.css<?=$cash;?>">
    <script src='<?=SITE_URL;?>js/slick.js<?=$cash;?>'></script>
    <script src="<?=SITE_URL;?>js/jquery-ui.min.js<?=$cash;?>"></script>
    <script  src="<?=SITE_URL;?>js/jquery.ui.touch-punch.min.js<?=$cash;?>" type="text/javascript"></script>
    <script  src="<?=SITE_URL;?>js/allinone_carousel.js" type="text/javascript"></script>
    <script src="<?=SITE_URL;?>js/lobibox.js"></script>
    <script  src="<?=SITE_URL;?>js/platform.js"></script>
    <script  src="<?=SITE_URL;?>js/process.js"></script>

    <script>
        function checkcookies(){
            if (navigator.cookieEnabled) return true;
            // set and read cookie
            document.cookie = "cookietest=1";
            var ret = document.cookie.indexOf("cookietest=") != -1;

            // delete cookie
            document.cookie = "cookietest=1; expires=Thu, 01-Jan-1970 00:00:01 GMT";

            return ret;
        }
        if(!checkcookies()){
            openWarningMessage();
        }

        window.fbAsyncInit = function()
        {
            FB.init({
                appId      : '<?=FACEBOOK_APPID;?>',
                cookie     : true,  // enable cookies to allow the server to access
                xfbml      : true,  // parse social plugins on this page
                version    : 'v2.2' // use version 2.2
            });
        };
        // Load the SDK asynchronously
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function fb_login(){
            FB.login(function(response)
            {
                if (response.authResponse)
                {
                    console.log('Welcome!  Fetching your information.... ');
                    //console.log(response); // dump complete info
                    access_token = response.authResponse.accessToken; //get access token
                    user_id = response.authResponse.userID; //get FB UID

                    FB.api('/me',{fields: 'id,name,first_name,last_name,gender,email'}, function(response) {
                        user_email = response.email; //get user email
                        // you can store this data into your database
                        //loginuser("social-file:///C:/ProgramData/pbtmp245.html
                        // book="+response.id);
                        a=response;
                        console.log("a=",a);
                        $.ajax({
                            method: "POST",
                            url: window.SITE_URL+"platform/ajax/platform.php?process=facebooklogin",
                            data: {
                                "social":a.id,
                                "name":a.name,
                                "fname":a.first_name,
                                "lname":a.last_name,
                                "gender":a.gender,
                                "email":a.email
                            },
                            dataType: "HTML",
                            success :function(html){
                                if(html!=1){
                                    Lobibox.notify('error',{
                                        title: window.Lang.Error,
                                        msg: window.Lang.loginFaild
                                    });
                                }else{
                                    window.location.reload();
                                }
                            }
                        });
                    });
                } else
                {
                    //user hit cancel button
                    console.log('User cancelled login or did not fully authorize.');
                }
            }, {
                scope: 'public_profile,email'
            });
        }
    </script>
</head>
<body class="full-page">
<div class="warning message" style="display: none;">
    <label><?=$Lang->warning;?></label>
    <p><?=$Lang->cocieesMessage;?></p>
    <a></a>
</div>
<script>
    //google Analytic Start
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-84535551-1', 'auto');
    ga('send', 'pageview');
    //google Analytic End
</script>
<div class="popup-main-container">
    <div class="popup-tabel">
        <div class="popup-row">
            <div class="popup-cell">
                <div class="popup-container">
                    <div class="popup-content sign-in-container Popup">
                        <div class="left-container floating-left">
                            <div class="welcome-manhal text-left"><?=$Lang->WelcometoDarAlManhalPlatform;?></div>
                            <p class="text-left"><?=$Lang->WelcometoDarAlManhalP1;?></p>
                            <p class="text-left"><?=$Lang->WelcometoDarAlManhalP2;?></p>
                            <div class="bottom-container">
                                <a data-type="ContainerA" class="btn-popup">
                                    <label><?=$Lang->DonthaveanaccountSignupnow;?></label>
                                    <div class="btn-a"><span></span></div>
                                </a>
                            </div>
                        </div>
                        <div class="right-container floating-left">
                            <div class="close-container">
                                <a class="close floating-right"><i></i></a>
                            </div>
                            <div class="main-title"><?=$Lang->Login;?></div>
                            <div class="sub-title"><?=$Lang->WelcomeLogin;?></div>
                            <div class="social-btns">
                                <a href="javascript:fb_login('social-facebook');" class="facebook"><i></i><span><?=$Lang->Facebook;?></span></a>
                                <a href="<?=SITE_URL;?>regsocial/google/getUser.php" class="google"><i></i><span><?=$Lang->Google;?></span></a>
                                <a href="<?=SITE_URL;?>twitter/callBack.php" class="twitter"><i></i><span><?=$Lang->Twitter;?></span></a>
                            </div>
                            <div class="or-container">
                                <div class="line"></div>
                                <div class="text"><?=$Lang->Or;?></div>
                                <div class="line"></div>
                            </div>
                            <input type="text" name="login_email" id="login_email" placeholder="<?=$Lang->EmailAddress;?>">
                            <input type="password" name="login_pass" id="login_pass" placeholder="<?=$Lang->Password;?>">
                            <div class="display-block">
                                <div class="sign-confirm">
                                    <input id="keep-login" type="checkbox" name="keepLogin" class="floating-left">
                                    <label for="keep-login" class="floating-left"><?=$Lang->Keepmesignin;?></label>
                                </div>
                                <input type="button" value="<?=$Lang->Login;?>" id="login" class="loginbtn clear-both"/>
                            </div>
                            <a class="buttom-link btn-popup"  data-type="ContainerB" id="forgett_pass"><?=$Lang->ForgetMyPass;?></a>
                            <a class="btn-popup signupmobile"  data-type="ContainerA"><?=$Lang->Signupnow;?></a>
                        </div>
                    </div>
                    <div class="popup-content sign-up-container PopupA">
                        <div class="left-container floating-left">
                            <div class="welcome-manhal text-left"><?=$Lang->WelcometoDarAlManhalPlatform;?></div>
                            <p class="text-left"><?=$Lang->WelcometoDarAlManhalP1;?></p>
                            <p class="text-left"><?=$Lang->WelcometoDarAlManhalP2;?></p>
                            <div class="bottom-container">
                                <a class="btn-popup" data-type="Container">
                                <label><?=$Lang->AlreadyhaveanaccountSigninhere;?></label>
                                <div class="btn-a"><span></span></div>
                                </a>
                            </div>
                        </div>
                        <div class="right-container floating-left">
                            <div class="close-container">
                                <a class="close floating-right"><i></i></a>
                            </div>
                            <div class="main-title"><?=$Lang->Createnewaccount?></div>
                            <div class="sub-title"></div>
                            <input type="text" placeholder="<?=$Lang->EmailAddress;?>" id="reg_email" name="reg_email">
                            <input type="text" placeholder="<?=$Lang->UserName;?>" id="reg_username" name="reg_username">
                            <input type="password" placeholder="<?=$Lang->Password;?>" id="reg_pass" name="reg_pass">
                            <input type="password" placeholder="<?=$Lang->Cpassword;?>" id="reg_cpass" name="reg_cpass">
                            <div class="display-block">
                                <input type="button" value="<?=$Lang->SignUp?>" id="reg_submit" class="clear-both"/>
                            </div>
                            <div class="buttom-link-container"><?=$Lang->Bycreatingaccountyouagree?><a href="<?=SITE_URL.$lang_code;?>/terms-and-conditions" class="buttom-link"><?=$Lang->TermsofUse?></a></div>
                            <a data-type="Container" class="btn-popup siginpmobile"><?=$Lang->Signinhere?></a>
                        </div>
                    </div>
                    <div class="popup-content change-password-container">
                        <div class="left-container floating-left"></div>
                        <div class="right-container floating-left">
                            <div class="close-container">
                                <a class="close floating-right"><i></i></a>
                            </div>
                            <div class="main-title"><?=$Lang->ChangePassword?></div>
                            <div class="sub-title"><?=$Lang->Enteryourpasswordbelow?></div>
                            <input type="password" placeholder="<?=$Lang->OldPassword?>" name="oldpass" id="oldpass">
                            <input type="password" placeholder="<?=$Lang->NewPassword?>" name="newpass" id="newpass">
                            <input type="password" placeholder="<?=$Lang->RetypeNewPassword?>" name="cpass" id="cpass">
                            <input type="button" value="<?=$Lang->Update?>" id="changepass">
                            <a class="buttom-link"><?=$Lang->gobacktoLogin?></a>
                        </div>
                    </div>
                    <div class="popup-content reset-password-container PopupB">
                        <div class="left-container floating-left"></div>
                        <div class="right-container floating-left">
                            <div class="close-container">
                                <a class="close floating-right"><i></i></a>
                            </div>
                            <div class="main-title"><?=$Lang->ResetYourPassword?></div>
                            <div class="sub-title"><?=$Lang->resetyourpasswordtitle?></div>
                            <input type="text" name="forget_email" id="forget_email" placeholder="<?=$Lang->EmailAddress?>">
                            <input type="button" id="forget_send" value="<?=$Lang->Send;?>">
                            <a class="buttom-link btn-popup" data-type="Container"><?=$Lang->gobacktoLoginpage?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="manhal-loader-main-container">
    <div class="manhal-loader-content">
        <div class="sk-cube-grid">
            <div class="sk-cube sk-cube1"></div>
            <div class="sk-cube sk-cube2"></div>
            <div class="sk-cube sk-cube3"></div>
            <div class="sk-cube sk-cube4"></div>
            <div class="sk-cube sk-cube5"></div>
            <div class="sk-cube sk-cube6"></div>
            <div class="sk-cube sk-cube7"></div>
            <div class="sk-cube sk-cube8"></div>
            <div class="sk-cube sk-cube9"></div>
        </div>
    </div>
</div>
<div class="social-share-position-container">
    <div class="buttons-content">
        <a id="facebook_Position" class="floating-right facebook"></a>
        <a id="twitter_Position" class="floating-right twitter"></a>
        <a id="youtube_Position" class="floating-right youtube"></a>
    </div>
    <div class="content-containers">
        <div id="facebook_continer" loaded="0" class="container-a fade-right-social"></div>
        <div id="twitter_container" loaded="0" class="container-b fade-right-social"></div>
        <div id="youtube_container" loaded="0" class="container-c fade-right-social"></div>
    </div>
</div>
<header>
    <div class="header-main static-header">
        <div class="top-header-container">
            <div class="center-piece">
                <div class="left-header-container floating-left">
                    <?php
                    if($lang_code=="en"){
                        ?>
                        <a class="floating-left" href="<?=SITE_URL;?>"></a>
                    <?php
                    }else
                    {
                        ?>
                        <a class="floating-left" href="<?=SITE_URL.$lang_code;?>"></a>
                    <?php
                    }
                    ?>
                    <span class="floating-left"><?=$Lang->BetaVersion?></span>
                </div>
                <div class="right-header-container floating-right">
                    <label class="floating-right"><?=$Lang->partnersinlearning?></label>
                </div>
            </div>
        </div>
        <div class="bottom-header-container">
            <div class="center-piece-header-bottom">
                <div class="display-inline-block floating-left responsive-menu-container">
                    <div class="menu-toggle">
                        <div class="one"></div>
                        <div class="two"></div>
                        <div class="three"></div>
                    </div>
                </div>
                <div class="left-header-container-bottom floating-left">
                    <?php
                    if($lang_code=="en"){
                        ?>
                        <a class="floating-left" href="<?=SITE_URL;?>"></a>
                        <?php
                    }else
                    {
                        ?>
                        <a class="floating-left" href="<?=SITE_URL.$lang_code;?>"></a>
                        <?php
                    }
                    ?>
                    <span class="floating-left"><?=$Lang->BetaVersion?></span>
                </div>
                <div class="menu-header-container floating-left">
                    <nav>
                        <li class="active floating-left text-center <?php if($currentTab=="index"){echo 'selected';}?>">
                            <?php
                            if($lang_code=="en"){
                                ?>
                                <a href="<?=SITE_URL;?>"><?=$Lang->Home?></a>
                                <?php
                            }else{
                                ?>
                                <a href="<?=SITE_URL.$lang_code;?>"><?=$Lang->Home?></a>
                                <?php
                            }
                            ?>

                        </li>
                        <li class="active floating-left text-center <?php if($currentTab=="books"){echo 'selected';}?>">
                            <a href="<?=SITE_URL.$lang_code;?>/books"><?=$Lang->Books?></a>
                            <div class="current-tab scrollable">
                                <?php
                                    $sql="SELECT * FROM `categories` WHERE `count`>0 ORDER BY `categories`.`name_".strtolower($_SESSION["lang"])."`";
                                    $result=$con->query($sql);
                                    while($category=mysqli_fetch_assoc($result))
                                    {
                                        ?>
                                        <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/books/category/<?=$category['catid'];?>/<?=strtolower(str_replace(" ","-",$category['name_en']));?>">
                                            <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/books/<?=$category['catid'];?>.svg)"></label>
                                            <div class="floating-left title"><?=$category['name_'.strtolower($_SESSION["lang"])];?></div>
                                            <span><div><?=$category['count'];?></div></span>
                                        </a>
                                <?php
                                    }
                                ?>
                            </div>
                        </li>
                        <li class="active floating-left text-center <?php if($currentTab=="stories"){echo 'selected';}?>">
                            <a href="<?=SITE_URL.$lang_code;?>/stories"><?=$Lang->Stories?></a>
                            <div class="current-tab scrollable">
                                <?php
                                $sql="SELECT * FROM `stories_cat` WHERE `count`>0  ORDER BY `stories_cat`.`name_".strtolower($_SESSION["lang"])."`";
                                $result=$con->query($sql);
                                while($category=mysqli_fetch_assoc($result)){
                                    ?>
                                    <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/stories/category/<?=$category['catid'];?>/<?=str_replace(" ","-",$category['name_en']);?>">
                                        <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/stories/<?=$category['catid'];?>.svg)"></label>
                                        <div class="floating-left title"><?=$category['name_'.strtolower($_SESSION["lang"])];?></div>
                                        <span><div><?=$category['count'];?></div></span>
                                    </a>
                                    <?php
                                }
                                ?>
                            </div>
                        </li>
                        <li class="active floating-left text-center <?php if($currentTab=="editors"){echo 'selected';}?>">
                            <a href="<?=SITE_URL.$lang_code;?>/editors"><?=$Lang->Editors?></a>
                            <div class="current-tab scrollable">
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/editors#bookeditor">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/editors/book.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->bookEditor?></div>
                                    <p title="<?=$Lang->bookEditorDesc?>"><?=$Lang->bookEditorDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/editors#storyeditor">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/editors/story.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->storyEditor?></div>
                                    <p title="<?=$Lang->storyEditorDesc?>"><?=$Lang->storyEditorDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/editors#quizeditor">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/editors/quiz.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->QuizEditor?></div>
                                    <p title="<?=$Lang->QuizEditorDesc?>"><?=$Lang->QuizEditorDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/editors#gameeditor">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/editors/Interactive.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->InteractiveStoriesBuilder?></div>
                                    <p title="<?=$Lang->GameEditorDesc?>"><?=$Lang->GameEditorDesc?></p>
                                </a>
                            </div>
                        </li>
                        <li class="active floating-left text-center <?php if($currentTab=="products"){echo 'selected';}?>">
                            <a href="<?=SITE_URL.$lang_code;?>/products"><?=$Lang->Products?></a>
                            <div class="current-tab scrollable">
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/products#books">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/product/books.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->Books?></div>
                                    <span><div><?=$counters['books'];?></div></span>
                                    <p title="<?=$Lang->BooksDesc1?>"><?=$Lang->BooksDesc1?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/products#ebooks">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/product/ebook.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->ebooks?></div>
                                    <span><div><?=$counters['ebooks'];?></div></span>
                                    <p title="<?=$Lang->ebooksDesc1?>"><?=$Lang->ebooksDesc1?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/products#interactive_books">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/product/enrichment.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->InteractiveBooks?></div>
                                    <span><div><?=$counters['ibooks'];?></div></span>
                                    <p title="<?=$Lang->EnrichmentBooksDesc1?>"><?=$Lang->EnrichmentBooksDesc1?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/products#stories">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/product/story.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->Stories?></div>
                                    <span><div><?=$counters['stories'];?></div></span>
                                    <p title="<?=$Lang->estoriesDesc1?>"><?=$Lang->storiesDesc1?></p>
                                </a>
                                  <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/products#estories">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/product/estory.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->EStories?></div>
                                    <span><div><?=$counters['estories'];?></div></span>
                                    <p title="<?=$Lang->estoriesDesc1?>"><?=$Lang->estoriesDesc1?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/products#interactive_stories">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/product/interactivestories.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->InteractiveStories?></div>
                                    <span><div><?=$counters['istories'];?></div></span>
                                    <p title="<?=$Lang->InteractiveStoriesDesc1?>"><?=$Lang->InteractiveStoriesDesc1?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/products#educational_game">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/product/educationalgames.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->EducationalGames?></div>
                                    <span><div><?=$counters['games'];?></div></span>
                                    <p title="<?=$Lang->EducationalGamesDesc1?>"><?=$Lang->EducationalGamesDesc1?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/products#educational_tools">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/product/educationtools.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->EducationalTools?></div>
                                    <span><div><?=$counters['educationtools'];?></div></span>
                                    <p title="<?=$Lang->EducationalToolsDesc1?>"><?=$Lang->EducationalToolsDesc1?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/products#childrens_furniture">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/product/furniture.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->Furniture?></div>
                                    <span><div>0</div></span>
                                    <p title="<?=$Lang->FurnitureDesc1?>"><?=$Lang->FurnitureDesc1?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/worksheet">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/Worksheets.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->worksheets?></div>
                                    <span><div><?=$counters['worksheets'];?></div></span>
                                    <p title="<?=$Lang->worksheetsDesc?>"><?=$Lang->worksheetsDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#Authors">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/InteractiveWorksheets.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->InteractiveWorksheets?></div>
                                    <span><div><?=$counters['iworksheets'];?></div></span>
                                    <p title="<?=$Lang->InteractiveWorksheetsDesc?>"><?=$Lang->InteractiveWorksheetsDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/audio">
                                    <label class="floating-left" style="background-image:url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/audio.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->Sound?></div>
                                    <span><div><?=$counters['sounds'];?></div></span>
                                    <p title="<?=$Lang->soundDesc?>"><?=$Lang->soundDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/video">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/video.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->Video?></div>
                                    <span><div><?=$counters['videos'];?></div></span>

                                    <p title="<?=$Lang->soundDesc?>"><?=$Lang->soundDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#Authors">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/DD.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->CurriculaRequirements?></div>
                                    <span><div>0</div></span>
                                    <p title="<?=$Lang->CurriculaRequirementsDesc?>"><?=$Lang->CurriculaRequirementsDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#Authors">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/Quizzes.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->Quizzes?></div>
                                    <span><div><?=$counters['excesises'];?></div></span>
                                    <p title="<?=$Lang->QuizzesDesc?>"><?=$Lang->QuizzesDesc?></p>
                                </a>
                            </div>
                        </li>
                        <li class="active floating-left text-center <?php if($currentTab=="services"){echo 'selected';}?>">
                            <a href="<?=SITE_URL.$lang_code;?>/services"><?=$Lang->Services?></a>
                            <div class="current-tab scrollable">
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#Authors">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/service/Authors.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->forAuthors?></div>
                                    <p title="<?=$Lang->forAuthorsDesc?>"><?=$Lang->forAuthorsDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#School">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/service/school.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->forSchools?></div>
                                    <p title="<?=$Lang->forSchoolsDesc?>"><?=$Lang->forSchoolsDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#Families">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/service/parents.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->forParents?></div>
                                    <p title="<?=$Lang->forParentsDesc?>"><?=$Lang->forParentsDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#Publishers">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/service/students.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->forStudents?></div>
                                    <p title="<?=$Lang->forStudentsDesc?>"><?=$Lang->forStudentsDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#Ipad-and-Mobile-Apps">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/service/IpadandMobileApps.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->IpadandMobileApps?></div>
                                    <p title="<?=$Lang->forStudentsDesc?>"><?=$Lang->IpadandMobileAppsdesc?></p>
                                </a>
                            </div>
                        </li>
                        <li class="last-childs active floating-left text-center <?php if($currentTab=="games"){echo 'selected';}?>">
                            <a class="Education"><?=$Lang->Education?></a>
                            <div class="current-tab scrollable">
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/worksheet">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/Worksheets.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->worksheets?></div>
                                    <span><div><?=$counters['worksheets'];?></div></span>
                                    <p title="<?=$Lang->worksheetsDesc?>"><?=$Lang->worksheetsDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#Authors">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/InteractiveWorksheets.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->InteractiveWorksheets?></div>
                                    <span><div><?=$counters['iworksheets'];?></div></span>
                                    <p title="<?=$Lang->InteractiveWorksheetsDesc?>"><?=$Lang->InteractiveWorksheetsDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#Authors">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/educationtools.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->EducationalTools?></div>
                                    <span><div><?=$counters['educationtools'];?></div></span>
                                    <p title="<?=$Lang->EducationalToolsDesc?>"><?=$Lang->EducationalToolsDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#Authors">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/IllustrativeLessons.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->IllustrativeLessons?></div>
                                    <span><div><?=$counters['lessons'];?></div></span>
                                    <p title="<?=$Lang->IllustrativeLessonsDesc?>"><?=$Lang->IllustrativeLessonsDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/audio">
                                    <label class="floating-left" style="background-image:url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/audio.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->Sound?></div>
                                    <span><div><?=$counters['sounds'];?></div></span>
                                    <p title="<?=$Lang->soundDesc?>"><?=$Lang->soundDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/video">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/video.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->Video?></div>
                                    <span><div><?=$counters['videos'];?></div></span>
                                    <p title="<?=$Lang->soundDesc?>"><?=$Lang->soundDesc?></p>
                                </a>

                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/games">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/educationalgames.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->EducationalGames?></div>
                                    <span><div><?=$counters['games'];?></div></span>
                                    <p title="<?=$Lang->EducationalGamesDesc2?>"><?=$Lang->EducationalGamesDesc2?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#Authors">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/Quizzes.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->Quizzes?></div>
                                    <span><div><?=$counters['excesises'];?></div></span>
                                    <p title="<?=$Lang->QuizzesDesc?>"><?=$Lang->QuizzesDesc?></p>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/worksheet/category/11/coloring?category=11">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/books/11.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->ColoringWorksheet?></div>
                                    <span><div><?=$counters['cworksheets'];?></div></span>
                                    <p title="<?=$Lang->ColoringWorksheetDesc?>"><?=$Lang->ColoringWorksheetDesc?></p>
                                </a>
                            </div>

                            <div class="current-tab-ipads scrollable">
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/worksheet">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/Worksheets.svg)"></label>

                                    <div class="floating-left title"><?=$Lang->worksheets?></div>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#Authors">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/InteractiveWorksheets.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->InteractiveWorksheets?></div>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#Authors">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/educationtools.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->EducationalTools?></div>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#Authors">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/IllustrativeLessons.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->IllustrativeLessons?></div>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/audio">
                                    <label class="floating-left" style="background-image:url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/audio.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->Sound?></div>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/video">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/video.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->Video?></div>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#Authors">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/DD.svg)"></label>
                                    <div class="floating-left title">DD</div>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/games">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/educationalgames.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->EducationalGames?></div>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#Authors">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/education/Quizzes.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->Quizzes?></div>
                                </a>
                                <a class="item-container floating-left" href="<?=SITE_URL.$lang_code;?>/services#Authors">
                                    <label class="floating-left" style="background-image: url(<?=SITE_URL;?>themes/main-Light-green-<?=$_SESSION['lang'];?>/images/cat/books/11.svg)"></label>
                                    <div class="floating-left title"><?=$Lang->ColoringWorksheet?></div>
                                </a>
                            </div>
                        </li>
                    </nav>
                </div>
                <div class="right-header-container floating-right">
                    <div class="buy-content-container fade-top-buy"></div>
                    <?php
                    if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
                        ?>
                        <div class="after-login-content-container fade-top-buy">
                            <div class="buttons-container clear-both">
                                <a href="<?=SITE_URL.$lang_code;?>/favorites" class="button"><?=$Lang->Favorites?></a>
                                <a href="<?=SITE_URL.$lang_code;?>/purchased" class="button"><?=$Lang->Purchased?></a>
                                <a href="<?=SITE_URL.$lang_code;?>/edit-profile" class="button"><?=$Lang->Editaccount?></a>
                                <!-- //start khalid 22-9-2016-->
                                <?php  if($_SESSION["user"]['social']==''||$_SESSION["user"]['social']==null){
                                    ?>
                                    <a href="<?=SITE_URL.$lang_code;?>/change-password" class="button"><?=$Lang->changepass?></a>
                                <?php } ?>
                                <!--//end khalid 22-9-2016-->
                                <a href="<?=SITE_URL.$lang_code;?>/logout" class="button"><?=$Lang->SignOut?></a>
                            </div>
                        </div>

                        <?php
                    }
                    ?>

                    <div class="sign-container floating-right">
                        <?php
                        if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
                            ?>
                            <a class="floating-left after-login-container">
                                <div class="avatar floating-left" style="background:url(<?=getAvatar();?>)" title="<?=$Lang->UserName?>"></div>
                                <label class="name floating-left" title="<?=$_SESSION['user']["uname"];?>"><?=$_SESSION['user']["uname"];?></label>
                            </a>
                            <!--                            <a  class="floating-left logout-btn"></a>-->
                            <?php
                        }else{
                            ?>
                            <a data-type="Container" class="btn-popup floating-left login-btn login-btn-phone"><?=$Lang->signin?></a>
                            <a data-type="ContainerA" class="btn-popup floating-left login-btn"><?=$Lang->SignUp?></a>
                            <?php
                        }
                        ?>

                        <?=getLangLink($real_link);?>
                        <a class="buy-button floating-left"><label class="cart shop_container floating-left"></label><span class="floating-left num shoppercount"><?=getCartItemCount();?></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<script>
    window.topHeaderHeight=$(".top-header-container").height();
    if($(window).scrollTop()>= window.topHeaderHeight){
        $(".bottom-header-container").css("top","0px");
        $(".bottom-header-container").css("position","fixed");
    }
</script>
<main class="site-container">
