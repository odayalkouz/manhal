<?php
error_reporting(0);
$real_link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//$pageName=basename($_SERVER['PHP_SELF']);
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$_SESSION["lasturl"]=$real_link;
$counters = '';
if(!isset($_SESSION["user_country"]) || $_SESSION["user_country"]==""){
  $_SESSION["user_country"]=getCountry();
}
function getCountry(){
  $xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".getRealIpAddr());
  return strtolower($xml->geoplugin_countryName);
}


function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
//$_SESSION["counters"]="";
if (!isset($_SESSION["counters"]) || $_SESSION["counters"] == "") {
    $sql = "SELECT * FROM `counters` WHERE `id`>0";
    $result = $con->query($sql);
    $counters = [];
    while ($rowHeader = mysqli_fetch_assoc($result))
    {
        if ($rowHeader['product'] == 'books' && $rowHeader['category'] == -1 || $rowHeader['product'] == 'stories' && $rowHeader['category'] == -1) {
            $counters[$rowHeader['product']] = $rowHeader['count'];
        } else if ($rowHeader['product'] != 'books' && $rowHeader['product'] != 'stories') {
            $counters[$rowHeader['product']] = $rowHeader['count'];
        }
    }

    //  $counters=mysqli_fetch_all($result);
    $_SESSION["counters"] = $counters;
}else{
    $counters = $_SESSION["counters"];
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

// Include and instantiate the class.
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;

// Exclude tablets.

if(isset($_GET["ad"]) && $_GET["ad"]!=""){
    $_SESSION["ad"]=$_GET["ad"];
    $sql="INSERT INTO `adslog`(`adid`, `name`, `time`, `url`, `ip`) VALUES ('','".$_GET["ad"]."',NOW(),'".$real_link."','".$_SERVER['REMOTE_ADDR']."')";
    $con->query($sql);
}

$cash = "?201";
$pageTitle=getPageTitle($pageName);

$pageDescription=getPageDescription($pageName);

?>
<!DOCTYPE html>
<html lang="<?= $lang_code; ?>">
<head user_country="<?=$_SESSION['user_country'];?>">
    <meta name="google-site-verification" content="ughitS7hOH0B7dYQUze9p5gkgz2Ky20rkWkYaygwrDk" />
    <meta property="fb:pages" content="716636475135763" />
    <meta content="utf-8" http-equiv="encoding">
    <!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta HTTP-EQUIV="CACHE-CONTROL" CONTENT="Public">
    <meta HTTP-EQUIV="CONTENT-LANGUAGE" CONTENT="<?= $lang_code; ?>">
    <meta NAME="description" CONTENT="<?= $pageDescription; ?>">
    <!--    <meta http-equiv="Pragma" content="no-cache" />-->
    <title><?= $pageTitle; ?></title>
    <meta NAME="AUTHOR" CONTENT="<?= $Lang->Copyrite ?>">
    <meta NAME="COPYRIGHT" CONTENT="&copy; <?php echo date("Y") ?> <?= $Lang->Copyrite ?>">
    <meta name="keywords" content="<?= getPageKeyWords($pageName); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="@nytimes"/>
    <meta property="og:site_name" content="<?= $Lang->SiteName; ?>"/>
    <meta http-equiv="content-language" content="<?= $lang_code; ?>"/>
    <!-- Title -->
    <meta id="metaOgTitle" content="<?= $pageTitle; ?>"/>
    <meta name="title" content="<?= $pageTitle; ?>"/>
    <meta property="og:title" content="<?= $pageTitle; ?>"/>
    <meta name="DC.title" content="<?= $pageTitle; ?>"/>
    <meta name="twitter:label1" content="<?=$pageTitle; ?>"/>
    <meta name="twitter:title" content="<?= $pageTitle; ?>"/>
    <!-- Description -->
    <meta id="metaOgDescription" content="<?= $pageDescription; ?>"/>
    <meta itemprop="description" content="<?= $pageDescription; ?>"/>
    <meta property="og:description" content="<?= $pageDescription; ?>"/>
    <meta name="twitter:description" content="<?= $pageDescription; ?>"/>
    <meta name="twitter:label2" content="<?= $pageDescription; ?>"/>
    <meta property="og:type" content="website"/>
    <!-- Image -->

    <meta id="metaOgImage" content="<?= getPageThumb($pageName); ?>"/>
    <meta itemprop="image" content="<?= getPageThumb($pageName); ?>"/>
    <meta name="image" content="<?= getPageThumb($pageName); ?>"/>
    <meta property="og:image" content="<?= getPageThumb($pageName); ?>"/>
    <meta property="fb:app_id" content="<?= FACEBOOK_APPID; ?>"/>
    <meta name="twitter:image:src" content="<?= getPageThumb($pageName); ?>"/>
    <meta name="twitter:image" content="<?= getPageThumb($pageName); ?>"/>
    <link rel="image_src" href="<?= getPageThumb($pageName); ?>"/>
    <meta name="thumbnail" content="<?= getPageThumb($pageName); ?>"/>
    <!-- Url -->
    <meta id="metaOgUrl" content="<?= $real_link; ?>"/>
    <meta name="url" content="<?= $real_link; ?>"/>
    <meta property="og:url" content="<?= $real_link; ?>"/>
    <meta name="twitter:url" content="<?= $real_link; ?>"/>
    <!-- Keywords -->
    <meta name="keywords" content="<?= getPageKeyWords($pageName); ?>"/>
    <meta name="news_keywords" content="<?= getPageKeyWords($pageName); ?>"/>
    <meta name="DC.keywords" content="<?= getPageKeyWords($pageName); ?>"/>
    <!-- new-->
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="google-site-verification" content=""/>
    <meta name="revisit-after" content="1 days">
    <meta name="google" content="noodp"/>
    <meta NAME="googlebot" CONTENT="NOARCHIVE">
    <meta name="contact" content="info@manhal.com"/>
    <meta name="Slurp" content="noodp">
    <meta name="bingbot" content="noodp">
    <meta name="fragment" content="!">
    <meta name="identifier-url" content="<?= $real_link; ?>"/>
    <meta name="abstract" content="Tools for webmasters"/>
    <link data-type="favicon" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/favicon.ico<?= $cash; ?>" type="image/x-icon" rel="icon"/>
    <link rel="icon" data-type="favicon" sizes="196x196" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/favicon.ico<?= $cash; ?>" type="image/x-icon"/>
    <link href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/favicon.ico<?= $cash; ?>" type="image/x-icon?!" rel="shortcut icon">
    <link rel="icon" sizes="32x32" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/favicon.ico<?= $cash; ?>" type="image/x-icon"/>
    <script type="text/javascript" src="<?= SITE_URL; ?>js/jquery.js<?= $cash; ?>"></script>
    <script async type="text/javascript" src="<?= SITE_URL; ?>js/lang.js<?= $cash; ?>"></script>
    <script type="text/javascript" src="<?= SITE_URL; ?>js/platforms-ui-<?= $session_lang;?>.js<?= $cash; ?>"></script>
    <script async type="text/javascript" src="<?= SITE_URL; ?>js/fastclick.js<?= $cash; ?>"></script>
    <script src='<?= SITE_URL; ?>js/slick.js<?= $cash; ?>'></script>
    <?php
    if(!$detect->isMobile() && !$detect->isTablet())
    {
        ?>
        <script type="text/javascript" src="<?= SITE_URL; ?>js/not-mobile.js<?= $cash; ?>"></script>
        <script type="text/javascript" src="<?= SITE_URL; ?>js/animation.js<?= $cash; ?>"></script>
<!--        <script type="text/javascript" src="--><?//= SITE_URL; ?><!--js/jQuery.scrollSpeed.js--><?//= $cash; ?><!--"></script>-->
        <script async type="text/javascript" src="<?= SITE_URL; ?>js/parallax.min.js<?= $cash; ?>"></script>
        <?php
    }
    if($detect->isTablet())
    {
        ?>
        <script type="text/javascript" src="<?= SITE_URL; ?>js/not-mobile.js<?= $cash;?>"></script>
        <script async type="text/javascript" src="<?= SITE_URL; ?>js/parallax.min.js<?= $cash;?>"></script>
        <?php
    }
    ?>
    <script src="<?= SITE_URL; ?>js/jquery-ui.min.js<?= $cash; ?>"></script>
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/style.css<?=$cash;?>">
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/all.css<?=$cash;?>">
    <link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/size.css<?=$cash;?>">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <?php
    if($detect->isMobile() || $detect->isTablet())
    {
        ?>
        <link rel="stylesheet" type="text/css" href="<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/css/prosize.css<?=$cash;?>">
        <?php
    }
    ?>
    <script src="<?= SITE_URL; ?>js/lobibox.js<?= $cash;?>"></script>
    <script src="<?= SITE_URL; ?>js/platform.js<?= $cash;?>"></script>
    <script src="<?= SITE_URL; ?>js/process.js<?= $cash;?>"></script>
    <script>
        function checkcookies()
        {
            if (navigator.cookieEnabled) return true;
            // set and read cookie
            document.cookie = "cookietest=1";
            var ret = document.cookie.indexOf("cookietest=") != -1;

            // delete cookie
            document.cookie = "cookietest=1; expires=Thu, 01-Jan-1970 00:00:01 GMT";

            return ret;
        }
        if (!checkcookies()) {
            openWarningMessage();
        }

        window.fbAsyncInit = function () {
            FB.init({
                appId: '<?=FACEBOOK_APPID;?>',
                cookie: true,  // enable cookies to allow the server to access
                xfbml: true,  // parse social plugins on this page
                version: 'v2.2' // use version 2.2
            });
        };
        // Load the SDK asynchronously
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function fb_login() {
            FB.login(function (response) {
                if (response.authResponse) {
                    console.log('Welcome!  Fetching your information.... ');
                    //console.log(response); // dump complete info
                    access_token = response.authResponse.accessToken; //get access token
                    user_id = response.authResponse.userID; //get FB UID

                    FB.api('/me', {fields: 'id,name,first_name,last_name,gender,email'}, function (response) {
                        user_email = response.email; //get user email
                        // you can store this data into your database
                        //loginuser("social-file:///C:/ProgramData/pbtmp245.html
                        // book="+response.id);
                        a = response;
                        console.log("a=", a);
                        $.ajax({
                            method: "POST",
                            url: window.SITE_URL + "platform/ajax/platform.php?process=facebooklogin",
                            data: {
                                "social": a.id,
                                "name": a.name,
                                "fname": a.first_name,
                                "lname": a.last_name,
                                "gender": a.gender,
                                "email": a.email
                            },
                            dataType: "HTML",
                            success: function (html) {
                                if (html != 1) {
                                    Lobibox.notify('error', {
                                        title: window.Lang.Error,
                                        msg: window.Lang.loginFaild
                                    });
                                } else {
                                    window.location.reload();
                                }
                            }
                        });
                    });
                } else {
                    //user hit cancel button
                    console.log('User cancelled login or did not fully authorize.');
                }
            }, {
                scope: 'public_profile,email'
            });
        }

        <!-- Facebook Pixel Code -->

        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '485461879023304');
        fbq('track', 'PageView');


    <!-- End Facebook Pixel Code -->






    $(document).ready(function(){
             $array_Category=['books','stories','worksheet','games','video'];
             Category_num=0;
            loadCategory($array_Category[Category_num])
        });


function loadCategory(type){
    $.ajax({
        url:  "<?= SITE_URL; ?>includes/categoriestype.php?lang=<?=$lang_code;?>",
        type: "POST",
        cache: false,
        dataType: 'html',
        data:{"TypeProcesses":'getCategoriescount',"type":type,"currentTab":'<?=$currentTab?>'},
        success: function (data) {
            $("#"+type+"pop").append(data);
            if(Category_num<$array_Category.length-1){
                Category_num++;
                loadCategory($array_Category[Category_num])
            }
        }
    });
}




    </script>



    <!-- Global site tag (gtag.js) - Google AdWords: 836956915 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-836956915"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'AW-836956915');
    </script>

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
            n.callMethod.apply(n,arguments):n.queue.push(arguments)};
            if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
            n.queue=[];t=b.createElement(e);t.async=!0;
            t.src=v;s=b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t,s)}(window, document,'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '928793117292057');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=928793117292057&ev=PageView&noscript=1"/></noscript>
    <!-- End Facebook Pixel Code -->




</head>
<body class="full-page">
<div class="warning message" style="display: none;">
    <label><?= $Lang->warning;?></label>
    <p><?= $Lang->cocieesMessage;?></p>
    <a></a>
</div>
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-74397962-2', 'auto');
    ga('send', 'pageview');


</script>

<div class="popup-main-container">
    <div class="popup-tabel">
        <div class="popup-row">
            <div class="popup-cell" id="popup_content">

            </div>
        </div>
    </div>
</div>
<div class="manhal-loader-main-container">
    <div class="lms-help-message" style="display: none"><?= $Lang->lmshelpmessage?></div>
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
<?php
if(!$detect->isMobile() || $detect->isTablet()) {
    ?>
    <div class="social-share-position-container">
        <div class="buttons-content close-all-popup">
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
    <?php
}
?>
<header>
    <div class="header-main static-header">
        <div class="top-header-container">
            <div class="center-piece">
                <div class="left-header-container floating-left">
                    <?php
                    if ($lang_code == "en")
                    {
                        ?>
                        <a class="floating-left" href="<?= SITE_URL; ?>"></a>
                        <?php
                    } else
                        {
                        ?>
                        <a class="floating-left" href="<?= SITE_URL . $lang_code; ?>"></a>
                        <?php
                    }
                    ?>
                </div>
                <div class="center-header-container" style="display: none">

                </div>
                <div class="right-header-container floating-right">
                    <div class="floating-right">
                        <a class="watsapp-header floating-right reveal-right" style="width: 193px;"><label class="floating-left phone"></label><span class="floating-left phone-with-width">+962 (6) 5533889</span></a>
                        <div class="watsapp-header floating-right reveal-right" style="width: 180px;"><label class="floating-left email"></label><span class="floating-left">info@manhal.com</span></div>
                    </div>
                    <div class="floating-right clear-both">
                    <a target="_blank" href="https://wa.me/00962787000410" class="watsapp-header floating-right reveal-right"><label class="floating-left watsapp"></label><label class="floating-left separate">|</label><label class="floating-left phone"></label><span class="floating-left">+962 (78) 7000410</span></a>
                    <div class="watsapp-header floating-right reveal-right"><label class="floating-left email"></label><span class="floating-left">support@manhal.com </span></div>
                </div>
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
                    if ($lang_code == "en")
                    {
                        ?>
                        <a class="floating-left" href="<?= SITE_URL; ?>"></a>
                        <?php
                    } else
                        {
                        ?>
                        <a class="floating-left" href="<?= SITE_URL . $lang_code; ?>"></a>
                        <?php
                    }
                    ?>
                </div>
                <div class="menu-header-container floating-left">
                    <nav class="close-all-popup">
                        <li class="active floating-left text-center <?php if ($currentTab == "index") {
                            echo 'selected';
                        } ?>">
                            <?php
                            if ($lang_code == "en")
                            {
                                ?>
                                <a href="<?= SITE_URL; ?>"><?= $Lang->Home ?></a>
                                <?php
                            } else
                                {
                                ?>
                                <a href="<?= SITE_URL . $lang_code; ?>"><?= $Lang->Home ?></a>
                                <?php
                            }
                            ?>

                        </li>
                        <li class="active floating-left text-center <?php if ($currentTab == "books") {
                            echo 'selected';
                        } ?>">
                            <a href="<?=SITE_URL.$lang_code?>/books"><?=$Lang->Books?></a>
                            <div id="bookspop" class="current-tab scrollable">
                            </div>
                        </li>
                        <li class="active floating-left text-center <?php if ($currentTab == "stories") {
                            echo 'selected';
                        } ?>">
                            <a href="<?= SITE_URL . $lang_code; ?>/stories"><?= $Lang->Stories ?></a>
                            <div id="storiespop" class="current-tab scrollable">

                            </div>
                        </li>
                        <li class="active floating-left text-center <?php if ($currentTab == "worksheet") {
                            echo 'selected';
                        } ?>">
                            <a href="<?= SITE_URL . $lang_code; ?>/worksheet"><?= $Lang->worksheets ?></a>
                            <div id="worksheetpop" class="current-tab scrollable">

                            </div>
                        </li>
                        <li class="active floating-left text-center <?php if ($currentTab == "games") {
                            echo 'selected';
                        } ?>">
                            <a title="<?= $Lang->Activities;?>" href="<?= SITE_URL . $lang_code; ?>/activities"><?= $Lang->Activities ?></a>
                            <div id="gamespop" class="current-tab scrollable">

                            </div>
                        </li>

                        <?php
                        if(!$detect->isMobile())
                        {
                            ?>
                            <li class="product-pc active floating-left text-center <?php if ($currentTab == "store") {
                                echo 'selected';
                            } ?>">
                                <a href="<?= SITE_URL . $lang_code; ?>/store?type=books"><?= $Lang->Store ?></a>
                                <div class="current-tab scrollable">
                                    <div class="item-container floating-left">
                                        <a href="<?= SITE_URL . $lang_code; ?>/store?type=books">
                                            <label class="floating-left"
                                                   style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/books.svg)"></label>
                                            <div class="floating-left title"><?= $Lang->Books ?></div>
                                        </a>
                                    </div>
                                    <div class="item-container floating-left">
                                        <a href="<?= SITE_URL . $lang_code; ?>/store?type=stories">
                                            <label class="floating-left"
                                                   style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/story.svg)"></label>
                                            <div class="floating-left title"><?= $Lang->Stories ?></div>
                                        </a>
                                    </div>
                                    <div class="item-container floating-left">
                                        <a href="<?= SITE_URL . $lang_code; ?>/store?type=toys">
                                            <label class="floating-left"
                                                   style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/educationalgames.svg)"></label>
                                            <div class="floating-left title"><?= $Lang->Toys ?></div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="product-pc active floating-left text-center <?php if ($currentTab == "products") {
                                echo 'selected';
                            } ?>">
                                <a href="<?= SITE_URL . $lang_code; ?>/products"><?= $Lang->Products ?></a>
                                <div class="current-tab scrollable">
                                    <div class="item-container floating-left">
                                        <a href="<?= SITE_URL . $lang_code; ?>/books">
                                            <label class="floating-left"
                                                   style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/books.svg)"></label>
                                            <div class="floating-left title"><?= $Lang->Books ?></div>
                                            <span><div><?= $counters['books']; ?></div></span>
                                        </a>
                                        <a class="more" href="<?= SITE_URL . $lang_code; ?>/books-info">
                                            <p title="<?= $Lang->BooksDesc1 ?>"><?= $Lang->BooksDesc1 ?> </p>
                                        </a>
                                    </div>
                                    <div class="item-container floating-left">
                                        <a href="<?= SITE_URL . $lang_code; ?>/electronic-books">
                                            <label class="floating-left"
                                                   style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/ebook.svg)"></label>
                                            <div class="floating-left title"><?= $Lang->ebooks ?></div>
                                            <span><div><?= $counters['ebooks']; ?></div></span>
                                        </a>
                                        <a href="<?= SITE_URL . $lang_code; ?>/electronic-books-info" class="more">
                                            <p title="<?= $Lang->ebooksDesc1 ?>"><?= $Lang->ebooksDesc1 ?>
                                            </p>
                                        </a>
                                    </div>
                                    <div class="item-container floating-left">
                                        <a href="<?= SITE_URL . $lang_code; ?>/stories">
                                            <label class="floating-left"
                                                   style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/story.svg)"></label>
                                            <div class="floating-left title"><?= $Lang->Stories ?></div>
                                            <span><div><?= $counters['stories']; ?></div></span>
                                        </a>
                                        <a href="<?= SITE_URL . $lang_code; ?>/stories-info" class="more">
                                            <p title="<?= $Lang->estoriesDesc1 ?>"><?= $Lang->storiesDesc1 ?></p>
                                        </a>
                                    </div>
                                    <div class="item-container floating-left">
                                        <a href="<?= SITE_URL . $lang_code; ?>/electronic-stories">
                                            <label class="floating-left"
                                                   style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/estory.svg)"></label>
                                            <div class="floating-left title"><?= $Lang->EStories ?></div>
                                            <span><div><?= $counters['estories']; ?></div></span>
                                        </a>
                                        <a href="<?= SITE_URL . $lang_code; ?>/electronic-stories-info" class="more">
                                            <p title="<?= $Lang->estoriesDesc1 ?>"><?= $Lang->estoriesDesc1 ?></p>
                                        </a>
                                    </div>
                                    <div class="item-container floating-left">
                                        <a href="<?= SITE_URL . $lang_code; ?>/activities">
                                            <label class="floating-left"
                                                   style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/educationalgames.svg)"></label>
                                            <div class="floating-left title"><?= $Lang->Activities; ?></div>
                                            <span><div><?= $counters['games']; ?></div></span>
                                        </a>
                                        <a href="<?= SITE_URL . $lang_code; ?>/educational-games-info" class="more">
                                            <p title="<?= $Lang->EducationalGamesDesc1 ?>"><?= $Lang->EducationalGamesDesc1 ?> </p>
                                        </a>
                                    </div>
                                    <div class="item-container floating-left">
                                        <a href="<?= SITE_URL . $lang_code; ?>/educational-tools-info">
                                            <label class="floating-left"
                                                   style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/educationtools.svg)"></label>
                                            <div class="floating-left title"><?= $Lang->EducationalTools ?></div>
                                            <span><div><?= $counters['educationtools']; ?></div></span>
                                        </a>
                                        <a href="<?= SITE_URL . $lang_code; ?>/educational-tools-info" class="more">
                                            <p title="<?= $Lang->EducationalToolsDesc1 ?>"><?= $Lang->EducationalToolsDesc1 ?></p>
                                        </a>
                                    </div>
                                    <div class="item-container floating-left">
                                        <a href="<?= SITE_URL . $lang_code; ?>/applications">
                                            <label class="floating-left" style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/application.svg)"></label>
                                            <div class="floating-left title"><?= $Lang->Application ?></div>
                                            <span><div>5</div></span>
                                        </a>
                                        <a href="<?= SITE_URL . $lang_code; ?>/application-info" class="more">
                                            <p title="<?= $Lang->Applicationdesc1 ?>"><?= $Lang->Applicationdesc1 ?></p>
                                        </a>
                                    </div>
                                    <div class="item-container floating-left">
                                        <a href="<?= SITE_URL . $lang_code; ?>/childrens-furniture-info">
                                            <label class="floating-left"
                                                   style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/furniture.svg)"></label>
                                            <div class="floating-left title"><?= $Lang->Furniture ?></div>
                                            <span><div>0</div></span>
                                        </a>
                                        <a href="<?= SITE_URL . $lang_code; ?>/childrens-furniture-info" class="more">
                                            <p title="<?= $Lang->FurnitureDesc1 ?>"><?= $Lang->FurnitureDesc1?></p>
                                        </a>
                                    </div>
                                    <div class="item-container floating-left">
                                        <a href="<?= SITE_URL . $lang_code; ?>/worksheet">
                                            <label class="floating-left"
                                                   style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/education/Worksheets.svg)"></label>
                                            <div class="floating-left title"><?= $Lang->worksheets ?></div>
                                            <span><div><?= $counters['worksheets']; ?></div></span>
                                        </a>
                                        <a href="<?= SITE_URL . $lang_code; ?>/worksheets-info" class="more">
                                            <p title="<?= $Lang->worksheetsDesc ?>"><?= $Lang->worksheetsDesc ?></p>
                                        </a>
                                    </div>

                                    <div class="item-container floating-left">
                                        <a href="<?= SITE_URL . $lang_code; ?>/audio">
                                            <label class="floating-left"
                                                   style="background-image:url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/education/audio.svg)"></label>
                                            <div class="floating-left title"><?= $Lang->Sounds ?></div>
                                            <span><div><?= $counters['sounds']; ?></div></span>
                                        </a>
                                        <a href="<?= SITE_URL . $lang_code; ?>/sound-info" class="more">
                                            <p title="<?= $Lang->soundDesc ?>"><?= $Lang->soundDesc ?></p>
                                        </a>
                                    </div>
                                    <div class="item-container floating-left">
                                        <a href="<?= SITE_URL . $lang_code; ?>/video">
                                            <label class="floating-left"
                                                   style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/education/video.svg)"></label>
                                            <div class="floating-left title"><?= $Lang->Videos ?></div>
                                            <span><div><?= $counters['videos']; ?></div></span>
                                        </a>
                                        <a href="<?= SITE_URL . $lang_code; ?>/video-info" class="more">
                                            <p title="<?= $Lang->videoDesc ?>"><?= $Lang->videoDesc ?></p>
                                        </a>
                                    </div>
                                    <div class="item-container floating-left">
                                        <a href="<?= SITE_URL . $lang_code; ?>/teachers-guides">
                                            <label class="floating-left"
                                                   style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/education/DD.svg)"></label>
                                            <div class="floating-left title"><?= $Lang->TeachersGuides ?></div>
                                            <span><div><?= $counters['teachersguid']; ?></div></span>
                                        </a>
                                        <a href="<?= SITE_URL . $lang_code; ?>/teachers-guides-info" class="more">
                                            <p title="<?= $Lang->CurriculaRequirementsDesc ?>"><?= $Lang->CurriculaRequirementsDesc ?></p>
                                        </a>
                                    </div>
                                    <div class="item-container floating-left">
                                        <a href="<?= SITE_URL . $lang_code; ?>/quizzes">
                                            <label class="floating-left"
                                                   style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/education/Quizzes.svg)"></label>
                                            <div class="floating-left title"><?= $Lang->Quizzes ?></div>
                                            <span><div><?= $counters['excesises']; ?></div></span>
                                        </a>
                                        <a href="<?= SITE_URL . $lang_code; ?>/exercises-info" class="more">
                                            <p title="<?= $Lang->QuizzesDesc ?>"><?= $Lang->QuizzesDesc ?></p>
                                        </a>
                                    </div>
                                    <div class="item-container floating-left">
                                        <a href="<?= SITE_URL . $lang_code; ?>/worksheet/category/11/coloring?category=11">
                                            <label class="floating-left"
                                                   style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/books/11.svg)"></label>
                                            <div class="floating-left title"><?= $Lang->ColoringWorksheet ?></div>
                                            <span><div><?= $counters['cworksheets']; ?></div></span>
                                        </a>
                                        <a href="<?= SITE_URL . $lang_code; ?>/coloring-worksheet-info" class="more">
                                            <p title="<?= $Lang->ColoringWorksheetDesc ?>"><?= $Lang->ColoringWorksheetDesc ?></p>
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <?php
                        }
                        ?>
                        <?php
                        if($detect->isMobile())
                        {
                            ?>
                            <li style="display: none"
                                class="last-childs scrollable active floating-left text-center jq_menu <?php if ($currentTab == "store") {
                                    echo 'selected';
                                } ?>">
                                <a href="<?= SITE_URL . $lang_code; ?>/store?type=books" class="Education"><?= $Lang->Store;?></a>
                                <div class="current-tab-ipads scrollable">
                                    <a class="item-container floating-left"
                                       href="<?= SITE_URL . $lang_code; ?>/store?type=books">
                                        <label class="floating-left"
                                               style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/books.svg)"></label>
                                        <div class="floating-left title"><?= $Lang->Books ?></div>
                                    </a>
                                    <a class="item-container floating-left"
                                       href="<?= SITE_URL . $lang_code; ?>/store?type=stories">
                                        <label class="floating-left"
                                               style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/story.svg)"></label>
                                        <div class="floating-left title"><?= $Lang->Stories; ?></div>
                                    </a>
                                    <a class="item-container floating-left"
                                       href="<?= SITE_URL . $lang_code; ?>/store?type=toys">
                                        <label class="floating-left"
                                               style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/educationalgames.svg)"></label>
                                        <div class="floating-left title"><?= $Lang->Toys;?></div>
                                    </a>
                                </div>
                            </li>
                            <li style="display: none"
                                class="last-childs scrollable active floating-left text-center jq_menu <?php if ($currentTab == "products") {
                                    echo 'selected';
                                } ?>">
                                <a class="Education"><?= $Lang->Products?></a>
                                <div class="current-tab-ipads scrollable">
                                    <a class="item-container floating-left"
                                       href="<?= SITE_URL . $lang_code; ?>/books">
                                        <label class="floating-left"
                                               style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/books.svg)"></label>
                                        <div class="floating-left title"><?= $Lang->Books ?></div>
                                    </a>
                                    <a class="item-container floating-left"
                                       href="<?= SITE_URL . $lang_code; ?>/electronic-books">
                                        <label class="floating-left"
                                               style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/ebook.svg)"></label>
                                        <div class="floating-left title"><?= $Lang->ebooks ?></div>
                                    </a>
                                    <a class="item-container floating-left"
                                       href="<?= SITE_URL . $lang_code; ?>/stories">
                                        <label class="floating-left"
                                               style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/story.svg)"></label>
                                        <div class="floating-left title"><?= $Lang->Stories ?></div>
                                    </a>
                                    <a class="item-container floating-left"
                                       href="<?= SITE_URL . $lang_code; ?>/electronic-stories">
                                        <label class="floating-left"
                                               style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/estory.svg)"></label>
                                        <div class="floating-left title"><?= $Lang->EStories ?></div>
                                    </a>
                                    <a class="item-container floating-left"
                                       href="<?= SITE_URL . $lang_code; ?>/activities">
                                        <label class="floating-left"
                                               style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/educationalgames.svg)"></label>
                                        <div class="floating-left title"><?= $Lang->Activities; ?></div>
                                    </a>
                                    <a class="item-container floating-left"
                                       href="<?= SITE_URL . $lang_code; ?>/educational-tools-info">
                                        <label class="floating-left"
                                               style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/educationtools.svg)"></label>
                                        <div class="floating-left title"><?= $Lang->EducationalTools ?></div>
                                    </a>
                                    <a class="item-container floating-left"
                                       href="<?= SITE_URL . $lang_code; ?>/furniture">
                                        <label class="floating-left"
                                               style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/product/furniture.svg)"></label>
                                        <div class="floating-left title"><?= $Lang->Furniture ?></div>
                                    </a>
                                    <a class="item-container floating-left"
                                       href="<?= SITE_URL . $lang_code; ?>/worksheet">
                                        <label class="floating-left"
                                               style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/education/Worksheets.svg)"></label>
                                        <div class="floating-left title"><?= $Lang->worksheets ?></div>
                                    </a>

                                    <a class="item-container floating-left" href="<?= SITE_URL . $lang_code; ?>/audio">
                                        <label class="floating-left"
                                               style="background-image:url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/education/audio.svg)"></label>
                                        <div class="floating-left title"><?= $Lang->Sound ?></div>
                                    </a>
                                    <a class="item-container floating-left" href="<?= SITE_URL . $lang_code; ?>/video">
                                        <label class="floating-left"
                                               style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/education/video.svg)"></label>
                                        <div class="floating-left title"><?= $Lang->Video ?></div>
                                    </a>
                                    <a class="item-container floating-left"
                                       href="<?= SITE_URL . $lang_code; ?>/teachers-guides">
                                        <label class="floating-left"
                                               style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/education/DD.svg)"></label>
                                        <div class="floating-left title"><?= $Lang->CurriculaRequirements ?></div>
                                    </a>
                                    <a class="item-container floating-left"
                                       href="<?= SITE_URL . $lang_code; ?>/quizzes">
                                        <label class="floating-left"
                                               style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/education/Quizzes.svg)"></label>
                                        <div class="floating-left title"><?= $Lang->Quizzes ?></div>
                                    </a>
                                    <a class="item-container floating-left"
                                       href="<?= SITE_URL . $lang_code; ?>/worksheet/category/11/coloring?category=11">
                                        <label class="floating-left"
                                               style="background-image: url(<?= SITE_URL; ?>themes/main-Light-green-<?= $session_lang; ?>/images/cat/books/11.svg)"></label>
                                        <div class="floating-left title"><?= $Lang->ColoringWorksheet ?></div>
                                    </a>
                                </div>
                            </li>

                            <?php
                        }
                        ?>
                    </nav>
                </div>
                <div class="right-header-container floating-right">
                    <div class="buy-content-container fade-top-buy close-all-popup"></div>
                    <?php
                    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                        ?>
                        <div class="after-login-content-container close-all-popup fade-top-buy">
                            <div class="buttons-container clear-both">
                                <a href="<?= SITE_URL . $lang_code; ?>/favorites" class="button"><?= $Lang->Favorites ?></a>
                                <a href="<?= SITE_URL . $lang_code; ?>/purchased" class="button"><?= $Lang->Purchased ?></a>
                                <a href="<?= SITE_URL . $lang_code; ?>/orders" class="button"><?= $Lang->orders ?></a>
                                <a href="<?= SITE_URL . $lang_code; ?>/myquizzes" class="button"><?= $Lang->myquizzes ?></a>
                                <?php
                                if($_SESSION['user']["permession"]>0 && $_SESSION['user']["permession"]<=8){
                                    ?>
                                    <a href="<?= SITE_URL . $lang_code; ?>/my-activities" class="button"><?= $Lang->myactivities; ?></a>
                                    <?php
                                }
                                ?>
                                <?php
                                if($_SESSION['user']["permession"]>0 && $_SESSION['user']["permession"]<=11){
?>
                                    <a href="<?= SITE_URL . $lang_code; ?>/mystories" class="button"><?= $Lang->mystories ?></a>
                                    <?php
                                }
                                ?>

                                <a href="<?= SITE_URL . $lang_code; ?>/edit-profile" class="button"><?= $Lang->Editaccount ?></a>
                                <a href="<?= SITE_URL . $lang_code; ?>/activation" class="button"><?= $Lang->Activation?></a>
                                <a href="<?= SITE_URL . $lang_code; ?>/membership" class="button"><?= $Lang->Membership?></a>
                                <?php
                                echo getLMSLink();
                                ?>
                                <!-- //start khalid 22-9-2016-->
                                <?php if ($_SESSION["user"]['social'] == '' || $_SESSION["user"]['social'] == null) {
                                    ?>
                                    <a href="<?= SITE_URL . $lang_code; ?>/change-password"
                                       class="button"><?= $Lang->changepass ?></a>
                                <?php } ?>
                                <!--//end khalid 22-9-2016-->
                                <a href="<?= SITE_URL . $lang_code; ?>/logout" class="button jq_logout"><?= $Lang->SignOut ?></a>
                            </div>
                        </div>
                        <?php
                    }

                    if(!(isset($pageName) && $pageName=="404.php")){
                        ?>
                        <div class="sign-container floating-right">
                            <?php
                            if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
                                ?>
                                <a class="floating-left after-login-container">
                                    <div class="avatar floating-left" style="background:url(<?= getAvatar(); ?>)"
                                         title="<?= $Lang->UserName ?>"></div>
                                    <label class="name floating-left"
                                           title="<?= $_SESSION['user']["uname"]; ?>"><?= $_SESSION['user']["uname"]; ?></label>
                                </a>
                                <!--                            <a  class="floating-left logout-btn"></a>-->
                                <?php
                            } else {
                                ?>
                                <a data-type="Container"
                                   class="btn-popup floating-left login-btn login-btn-phone"><?= $Lang->signin?></a>
                                <a data-type="ContainerA" class="btn-popup floating-left login-btn"><?= $Lang->SignUp ?></a>
                                <?php
                            }
                            ?>
                            <a class="floating-left after-login-container1">
                                <?php
                                if(strtolower($lang_code)=="ar"){
                                    ?>
                                    <label class="name floating-left" title="English">English</label>
                                    <?php
                                }else{
                                    ?>
                                    <label class="name floating-left" title="عربي">عربي</label>
                                    <?php
                                }
                                ?>

                            </a>
                            <a class="buy-button floating-left"><label
                                        class="cart shop_container floating-left"></label>
                                <span class="floating-left num shoppercount"><?= getCartItemCount(); ?></span>
                            </a>
                        </div>
                        <div class="after-login-content-container1 close-all-popup fade-top-buy">
                            <div class="buttons-container clear-both">
                                <?= getLangLink($real_link); ?>
                                <!--                            <a href="#" class="button">عربي</a>-->
                                <!--                            <a href="#" class="button">English</a>-->
                                <!--                            <a href="#" class="button">French</a>-->
                            </div>
                        </div>
                    <?php
                    }
                    ?>



                </div>
            </div>
        </div>
    </div>
</header>
<script>
    window.topHeaderHeight = $(".top-header-container").height();
    if ($(window).scrollTop() >= window.topHeaderHeight) {
        $(".bottom-header-container").css("top", "0px");
        $(".bottom-header-container").css("position", "fixed");
    }

        $(document).on("click","#add_to_cart:not(.hide-modal)",function(){
            $('.modal').modal('show');
            $('.modal').show();
            if($('.upsell_viewed_slider').length) {
                var viewedSlider = $('.upsell_viewed_slider');
                viewedSlider.owlCarousel( {
                    loop:false,
                    margin:10,
                    autoplayTimeout:6000,
                    nav:true,
                    dots:false,
                    responsive:
                        {
                            0:{items:1},
                            575:{items:1},
                            768:{items:2},
                            991:{items:2},
                            1199:{items:2}
                        },
                    navText:["<div class='nav-btn prev-slide'></div>","<div class='nav-btn next-slide'></div>"],
                });
            }
        });



</script>
<main class="site-container">
     <?php

     if($detect->isMobile() || $detect->isTablet())
     {
     ?>
    <div class="backgoround-menu"></div>
         <?php
     }

     $campainPrice=[
         '1485' => ['old' => 14.6, "new" => 11, "a1"],
         '1486' => ['old' => 8.7, "new" => 6.6, "a1"],
         '1487' => ['old' => 28.2, "new" => 21.2, "a1"],
         '1488' => ['old' => 23.4, "new" => 17.6, "a1"],

         '1489' => ['old' => 14.6, "new" => 11, "a2"],
         '1490' => ['old' => 8.7, "new" => 6.6, "a2"],
         '1491' => ['old' => 28.2, "new" => 21.2, "a2"],
         '1492' => ['old' => 23.4, "new"=>17.6,"a2"],

         '1493' => ['old' => 17.5, "new" => 13.2, "a3"],
         '1494' => ['old' => 10.2, "new" => 7.7, "a3"],
         '1495' => ['old' => 28.2, "new" => 21.2, "a3"],
         '1496' => ['old' => 27.8, "new"=>20.9,"a3"],

         '1497' => ['old' => 17.5, "new" => 13.2, "a4"],
         '1498' => ['old' => 10.2, "new" => 7.7, "a4"],
         '1499' => ['old' => 28.2, "new" => 21.2, "a4"],
         '1500' => ['old' => 27.8, "new"=>20.9,"a4"],

         '1501' => ['old' => 17.5, "new" => 13.2, "a5"],
         '1502' => ['old' => 10.2, "new" => 7.7, "a5"],
         '1503' => ['old' => 28.2, "new" => 21.2, "a5"],
         '1504' => ['old' => 27.8, "new"=>20.9,"a5"],

         '1505' => ['old' => 17.5, "new" => 13.2, "a6"],
         '1506' => ['old' => 10.2, "new" => 7.7, "a6"],
         '1507' => ['old' => 28.29, "new" => 21.2, "a6"],
         '1508' => ['old' => 27.8, "new"=> 20.9,"a6"],


         '1509' => ['old' => 8.6, "new" => 6.5, "b1"],
         '1510' => ['old' => 7.3, "new" => 5.5, "b1"],

         '1511' => ['old' => 9.7, "new" => 7.5, "b2"],
         '1512' => ['old' => 7.3, "new" => 5.5, "b2"],
         '1513' => ['old' => 7.3, "new" => 5.5, "b2"],
         '1514' => ['old' => 17.3, "new"=>13,"b2"],



         '1515' => ['old' => 9.3, "new" => 7, "c1"],
         '1516' => ['old' => 9.3, "new" => 7, "c1"],
         '1517' => ['old' => 18.6, "new" => 14, "c1"],

         '1518' => ['old' => 8.7, "new" => 6.6, "d1"],

         '1519' => ['old' => 11.9, "new" => 9, "d2"],
         '1520' => ['old' => 7.3, "new" => 5.5, "d2"],

         '1521' => ['old' => 11.9, "new" => 9, "d3"],
         '1522' => ['old' => 7.3, "new" => 5.5, "d3"],

         '1523' => ['old' => 11.9, "new" => 9, "d4"],

         '1524' => ['old' => 6.6, "new" => 5, "e1"],
         '1525' => ['old' => 7.3, "new" => 5.5, "e1"],
         '1526' => ['old' => 14, "new" => 10.5, "e1"],

         '1527' => ['old' => 17.2, "new" => 13.2, "f1"],
         '1528' => ['old' => 8.6, "new" => 6.6, "f1"],
         '1529' => ['old' => 26.39, "new" => 19.8, "f1"],

         '1530' => ['old' =>17.2, "new" => 13.2, "f1"],
         '1531' => ['old' =>8.6,  "new" => 6.6,  "f2"],
         '1532' => ['old' =>26.2, "new" => 19.7, "f2"],

         '1533' => ['old' => 17.2, "new" => 13.2, "f3"],
         '1534' => ['old' => 8.6,  "new" => 6.6,  "f3"],
         '1535' => ['old' => 26.2, "new" => 19.7, "f3"],

         '1536' => ['old' => 17.2, "new" => 13.2, "f4"],
         '1537' => ['old' => 8.6,  "new" => 6.6,  "f4"],
         '1538' => ['old' => 26.2, "new" => 19.7, "f4"],

         '1539' => ['old' => 41.3, "new" => 31, "cards/1"],
         '1540' => ['old' => 63.9, "new" => 48, "cards/1"],
         '1541' => ['old' => 21.3, "new" => 16, "cards/1"],

         '1542' => ['old' => 41.3, "new" => 31, "posters/1"],
         '1543' => ['old' => 41.3, "new" => 31, "posters/1"],
         '1544' => ['old' => 46.6, "new" => 35, "posters/1"],
         '1545' => ['old' => 46.6, "new" => 35, "posters/1"],
         '1546' => ['old' => 46.6, "new" => 35, "posters/1"],

         '1547' => ['old' => 47.3, "new" => 35.5, "posters/2"],
         '1548' => ['old' => 58.6, "new" => 44, "posters/2"],

         '3455' => ['old' => 24, "new" => 12, "stories/1"],

         '3456' => ['old' => 73.3, "new" => 55, "stories/2"],

         '3451' => ['old' => 26, "new" => 20, "stories/3"],
         '3452' => ['old' => 26, "new" => 20, "stories/3"],
         '3453' => ['old' => 26, "new" => 20, "stories/3"],
         '3454' => ['old' => 70.2, "new" => 54, "stories/3"],

         '3457' => ['old' => 20, "new" => 10, "stories/4"],

         '3458' => ['old' => 46.8, "new" => 36, "stories/5"],
         '3459' => ['old' => 31.2, "new" => 24, "stories/5"],
         '3460' => ['old' => 46.8, "new" => 36, "stories/5"],
         '3461' => ['old' => 36.4, "new" => 28, "stories/5"],
         '3462' => ['old' => 31.2, "new" => 24, "stories/5"],
         '3463' => ['old' => 182, "new" => 140, "stories/5"],

//             '1542'=>['old'=>23.99,"new"=>17.99],
     ];

     ?>
