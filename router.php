<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 9/22/2016
 * Time: 4:51 PM
 */


if(session_status()==PHP_SESSION_NONE){
    session_start();
}
include_once "platform/config.php";

$open_books=array(726,721, 720, 719, 718, 717, 715, 714, 713, 727, 725, 724,716);
$real_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//if(strpos($real_link,".")!==false){
//    exit();
//}
$breadCrumbsTxt="";

if(strpos(strtolower($real_link),"manhal/ar")!==false ){
    $_GET["lang"]="Ar";
    $_SESSION["lang"]="Ar";
    $session_lang="Ar";
    setcookie("lang","Ar",time()+COOKIE_EXPIRE,"/");
}elseif(strpos(strtolower($real_link),"manhal/fr")!==false){
    $_GET["lang"]="Fr";
    $_SESSION["lang"]="Fr";
    $session_lang="Fr";
    setcookie("lang","Fr",time()+COOKIE_EXPIRE,"/");
}elseif(strpos(strtolower($real_link),"manhal/en")!==false || $real_link=='https://www.manhal.com/' || $real_link=='https://www.manhal.com'){
    $_GET["lang"]="En";
    $_SESSION["lang"]="En";
    $session_lang="En";
    setcookie("lang","En",time()+COOKIE_EXPIRE,"/");
}else{
//    $_GET["lang"]="En";
//    $_SESSION["lang"]="En";
//    $session_lang="En";
//    setcookie("lang","En",time()+COOKIE_EXPIRE,"/");
    $session_lang="en";
    $lang_code=strtolower($session_lang);
    $cat_code="en";
    $pageName="404.php";
    $Lang = simplexml_load_file("language/".ucfirst($session_lang).".xml");

    $breadCrumbs=getBreadCrumbs(array());
    ob_clean();
    header("HTTP/1.0 404 Not Found");
    include_once "404.php";
    exit();
}



$lang_code=strtolower($session_lang);
$css_code="En";
if($lang_code!="ar" && $lang_code!="en"){
    $cat_code="ar";
    $css_code="En";
}else{
    $cat_code=$lang_code;
    $css_code=ucfirst($lang_code);
}

$Lang = simplexml_load_file("language/".$session_lang.".xml");


include_once "includes/language.php";
$page = str_replace('index.php','', $_SERVER['PHP_SELF']);
$page = strtolower(str_replace($page,'',$_SERVER['REQUEST_URI']));
$page = explode('/',$page );
$controller = array_shift($page );
$parameters = array();


foreach ($page as $val){
    $parameters[] = urldecode($val);
}



//For Localhost
unset($parameters[0]);
if(isset($parameters[1]) && $parameters[1]!=""){
    unset($parameters[1]);
}


$parameters = array_values($parameters);
//print_r($parameters);
//exit();
//end localhost
if(!isset($parameters[0])){
    $parameters[0]="";
}

if(count($parameters)==1 && strpos($parameters[0],"?")!==false){
    $temp=explode("?",$parameters[0]);
    $parameters[0]=$temp[0];
    $parameters[1]="?";
    $parameters[2]=$temp[1];
}
$catName="";
function getBreadCrumbs($array,$h1=""){
    global $breadCrumbsTxt;
    global $Lang;
    global $lang_code;
    global $catName;


    $HomeURL=SITE_URL;
    if($lang_code!="en"){
        $HomeURL.=$lang_code;
    }
    $breadCrumbs='<div class="breadcrumbs-container floating-left"><div class="center-piece">
                     <ul class="floating-left" id="breadcrumb">
                        <li class="floating-left">
                            <a  class="anchor" href="'.$HomeURL.'">'.$Lang->Home.'</a>
                        </li>';
    $breadCrumbsTxt=$Lang->Home;

    foreach($array as $link=>$title){
        if(strpos($title,"?")!==false){
            $ar=explode("?",$title);
            $title=$ar[0];
        }
        $breadCrumbs.='<li class="floating-left"><a>/</a></li><li class="floating-left"><a class="anchor" href="'.SITE_URL.$lang_code."/".$link.'">'.$title.'</a></li>';
        $breadCrumbsTxt.=" > ".$title;
    }
    $breadCrumbs.='</ul>';
    if($h1!=""){
        $breadCrumbs.='<div class="breadcrumbs-title floating-right"><h1>'.$h1.'</h1></div>';
    }
    $breadCrumbs.='</div></div>';
    return $breadCrumbs;
}

function checkModifiedID($bookid){
    global $con;
    global $lang_code;
    $validID=$bookid;
    switch($bookid){
        case "215":
            $validID="639";
            break;
        case "441":
            $validID="671";
            break;
        case "214":
            $validID="660";
            break;
        case "158":
            $validID="549";
            break;
        case "156":
            $validID="547";
            break;
        case "118":
            $validID="620";
            break;
        case "105":
            $validID="598";
            break;
        case "212":
            $validID="624";
            break;
        case "181":
            $validID="628";
            break;
        case "178":
            $validID="627";
            break;
        case "329":
            $validID="644";
            break;
        case "183":
            $validID="623";
            break;
        case "266":
            $validID="694";
            break;
        case "279":
            $validID="673";
            break;
        case "179":
            $validID="637";
            break;
        case "280":
            $validID="638";
            break;
        case "157":
            $validID="643";
            break;
        case "159":
            $validID="633";
            break;
        case "160":
            $validID="629";
            break;
        case "277":
            $validID="634";
            break;
        case "479":
            $validID="764";
            break;
        case "481":
            $validID="769";
            break;
        case "170":
            $validID="771";
            break;
        case "484":
            $validID="656";
            break;
        case "532":
            $validID="655";
            break;
        case "534":
            $validID="645";
            break;
        case "507":
            $validID="785";
            break;
        case "165":
            $validID="630";
            break;
        case "264":
            $validID="615";
            break;
        case "533":
            $validID="549";
            break;
        case "538":
            $validID="660";
            break;
        case "539":
            $validID="682";
            break;
        case "578":
            $validID="666";
            break;
        case "582":
            $validID="668";
            break;
        case "586":
            $validID="669";
            break;
        case "577":
            $validID="666";
            break;
        case "581":
            $validID="668";
            break;
        case "585":
            $validID="669";
            break;
        case "576":
            $validID="666";
            break;
        case "580":
            $validID="668";
            break;
        case "584":
            $validID="669";
            break;
        case "575":
            $validID="666";
            break;
        case "579":
            $validID="668";
            break;
        case "583":
            $validID="669";
            break;
        case "172":
            $validID="712";
            break;
        case "173":
            $validID="753";
            break;
        case "443":
            $validID="822";
            break;
        case "449":
            $validID="827";
            break;
        case "446":
            $validID="762";
            break;
        case "460":
            $validID="817";
            break;
        case "786":
            $validID="427";
            break;
        case "787":
            $validID="455";
            break;
        case "792":
            $validID="842";
            break;
        case "794":
            $validID="650";
            break;
        case "798":
            $validID="705";
            break;
        case "800":
            $validID="459";
            break;
        case "801":
            $validID="647";
            break;
        case "803":
            $validID="651";
            break;
        case "795":
            $validID="305";
            break;

    }
    if($bookid!=$validID){
        $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status`=1 AND `books`.`bookid` =" . $validID;
        $result = $con->query($sql);
        $row = mysqli_fetch_assoc($result);
        $title = str_replace(" ", "-", $row["name"]);
        header('Location:' . BaseURL.$lang_code."/books/".$validID."/".$title);
        exit();
    }
}
//echo 'aa';
//echo $parameters[0];
//exit();

switch($parameters[0]){

    case "series":
        $pageName="view_series.php";
        $breadCrumbs=getBreadCrumbs(array("series"=>$Lang->series));
        include_once "view_series.php";
        break;
    case "product":
        $pageName="view.php";
        $breadCrumbs="";
        include_once "products/".$parameters[1]."/".$parameters[2]."/index.php";
        break;

    case "advertise":
        $pageName="advertise.php";
        $breadCrumbs=getBreadCrumbs(array("advertise.php"=>$Lang->aboutusTitle));
        include_once "advertise.php";
        break;
    case "playlist":
        $pageName="playlist";
        $_GET["media_id"]=$parameters[1];
        include_once "playlist.php";
        break;
    case "story":
        if(isset($parameters[1]) && is_numeric($parameters[1])){
            $pageName="story.php";
            $_GET['id']=$parameters[1];
            $sql="SELECT `story`.*,`stories_cat`.*,`series`.*,`story`.`rating_count` as rate_count FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid`  WHERE `story`.`storyid`=".$_GET['id'];
            $result = $con->query($sql);
            $story=mysqli_fetch_assoc($result);
//            $title= str_replace(" ","-",$story["title"]);
            $title= $story["title"];
            include_once "storyeditor/viewer/index.php";
        }
        break;
    case "quiz-editor":
        $pageName="quizeditor";
        include_once "quizeditor/index.php";
        break;
    case "lms-settings":
        $pageName="lms-settings";
        include_once "lms-settings.php";
        break;
    case "story-editor":
        $pageName="storyeditor";
        include_once "storyeditor/index.php";
        break;
    case "editor":
        $pageName="editor";
        include_once "editor/index.php";
    break;
        case "quizeditor_":
        $pageName="quizeditor_";
        include_once "quizeditor_/index.php";
        break;
//    case "quiz":
//        if(isset($parameters[1]) && is_numeric($parameters[1])){
//            $pageName="quiz";
//            include_once "platform/quiz/".$parameters[1]."/index.html";
//        }
//        break;
    case "api":
        if(isset($parameters[1]) && $parameters[1]=="books"){
            $pageName="book_api.php";
            include_once "APIs/book_api.php";
        }elseif(isset($parameters[1]) && $parameters[1]=="stories"){
            $pageName="stories_api.php";
            include_once "APIs/stories_api.php";
        }elseif(isset($parameters[1]) && $parameters[1]=="app" && isset($parameters[2]) && $parameters[2]!=""){
            $_GET["process"]=$parameters[2];
            include_once "APIs/lms_app.php";
        }
        break;
    case "download":
        $pageName="download.php";
        include_once "download_books.php";
        break;
    case "reset-password":
        $pageName="forgetpassword.php";
        $breadCrumbs=getBreadCrumbs(array("paypal"=>$Lang->ResetPassword));
        include_once "forgetpassword.php";
        break;
    case "executepayment":
        $pageName="cart.php";
        $breadCrumbs=getBreadCrumbs(array("paypal"=>$Lang->paypalTitle));
        include_once "paypal/ExecutePayment.php";
        break;
        case "executepaymentsubscribe":
        $pageName="pay.php";
        $breadCrumbs=getBreadCrumbs(array("paypal"=>$Lang->paypalTitle));
        include_once "paypal/ExecutePaymentsubscribe.php";
        break;
    case "payment":
        $pageName="payment.php";
        $breadCrumbs="";
        include_once "payment.php";
        break;
    case "payment-feedback":
        $pageName="payfort_feedback.php";
        $breadCrumbs="";
        include_once "payfort_feedback.php";
        break;
    case "privacy-policy":
        $pageName="privacy.php";
        $breadCrumbs=getBreadCrumbs(array("privacy-policy"=>$Lang->privacyTitle));
        include_once "privacy.php";
        break;
        case "return-policy":
        $pageName="returnprivacy.php";
        $breadCrumbs=getBreadCrumbs(array("privacy-policy"=>$Lang->Return_Policy));
        include_once "returnprivacy.php";
        break;
    case "paypal":
        $pageName="cart.php";
        $breadCrumbs=getBreadCrumbs(array("paypal"=>$Lang->paypalTitle));
        include_once "paypal/functions.php";
        break;
    case "sitemap":
        $pageName="sitemap.php";
        $breadCrumbs=getBreadCrumbs(array("sitemap"=>$Lang->sitemapTitle));
        include_once "sitemap.php";
        break;
    case "applications":
        $pageName="applications.php";
        $breadCrumbs=getBreadCrumbs(array("applications"=>$Lang->Applications));
        include_once "applications.php";
        break;
    case "contact-us":
        $pageName="contactus.php";
        $breadCrumbs=getBreadCrumbs(array("contact-us"=>$Lang->ContectUs));
        include_once "contactus.php";
        break;
    case "about-us":
        $pageName="aboutus.php";
        $breadCrumbs=getBreadCrumbs(array("about-us"=>$Lang->aboutusTitle));
        include_once "aboutus.php";
        break;
        case "advertise":
        $pageName="advertise.php";
        $breadCrumbs=getBreadCrumbs(array("advertise.php"=>$Lang->aboutusTitle));
        include_once "advertise.php";
        break;
        case "donate-khcc":
        $pageName="donatecampaign.php";
        $breadCrumbs=getBreadCrumbs(array("donatecampaign.php"=>$Lang->donationfor));
        include_once "donatecampaign.php";
        break;
    case "imanhal":
        $pageName="imanhal.php";
        $breadCrumbs=getBreadCrumbs(array("imanhal.php"=>$Lang->imanhal));
        include_once "imanhal.php";
        break;
    case "terms-and-conditions":
        $pageName="terms_conditions.php";
        $breadCrumbs=getBreadCrumbs(array("terms-and-conditions"=>$Lang->TermsofUse));
        include_once "terms_conditions.php";
        break;
    case "our-partners":
        $pageName="ourpartners.php";
        $breadCrumbs=getBreadCrumbs(array("our-partners"=>$Lang->OurPartners));
        include_once "ourpartners.php";
        break;
    case "orders":
        $pageName="orders.php";
        $breadCrumbs=getBreadCrumbs(array("orders"=>$Lang->orders));
        include_once "orders.php";
        break;
        case "quiz-result":


            if(isset($parameters[1]) && $parameters[1] != "?"){
                if (is_numeric($parameters[1])) {
                    $_GET["id"] = $parameters[1];
        $pageName="quiz-result.php";
                    $breadCrumbs=getBreadCrumbs(array("myquizzes"=>$Lang->myquizzes,"quiz-result/".$parameters[1]."/".str_replace(" ","-",$parameters[2])=>str_replace(" ","-",$parameters[2])));
        include_once "quiz-result.php";
                }
            }else{
                $pageName = "quiz-result.php";
                $breadCrumbs=getBreadCrumbs(array("myquizzes"=>$Lang->myquizzes));
                include_once "quiz-result.php";
            }


        break;
        case "quiz-result-details":


            if(isset($parameters[1]) && $parameters[1] != "?"){
                if (is_numeric($parameters[1])) {
                    $_GET["id"] = $parameters[1];
                    $_GET["userid"] = $parameters[3];

        $pageName="quiz-result-details.php";
                    $breadCrumbs=getBreadCrumbs(array("myquizzes"=>$Lang->myquizzes,"quiz-result/".$parameters[1]."/".str_replace(" ","-",$parameters[2])=>str_replace(" ","-",$parameters[2]),"quiz-result-details/".$parameters[1]."/".$parameters[2]."/".$parameters[3]."/".str_replace(" ","-",$parameters[4])=>str_replace(" ","-",$parameters[4])));
        include_once "quiz-result-details.php";
                }
            }else{
                $pageName = "quiz-result-details.php";
                $breadCrumbs=getBreadCrumbs(array("myquizzes"=>$Lang->myquizzes));
                include_once "quiz-result-details.php";
            }




        break;
    case "features":
        $pageName="features.php";
        $breadCrumbs=getBreadCrumbs(array("features"=>$Lang->Features));
        include_once "features.php";
        break;
    case "make-money-online":
        $pageName="makemoney.php";
        $breadCrumbs=getBreadCrumbs(array("make-money-online"=>$Lang->makeMoneyTitle));
        include_once "makemoney.php";
        break;
    case "check-out":
        $pageName="cart.php";
        $breadCrumbs=getBreadCrumbs(array("check-out"=>$Lang->CheckOut));
        include_once "cart.php";
        break;
        case "note":
        $pageName="note.php";
        $breadCrumbs=getBreadCrumbs(array("note"=>$Lang->Note));
        include_once "note.php";
        break;


    case "logout":
        $pageName="logout.php";
        $breadCrumbs=getBreadCrumbs(array("logout"=>$Lang->logOut));
        include_once "logout.php";
        break;
    case "change-password":
        $pageName="changepass.php";
        $breadCrumbs=getBreadCrumbs(array("change-password"=>$Lang->changepass));
        include_once "changepass.php";
        break;
    case "edit-profile":
        $pageName="editaccount.php";
        $breadCrumbs=getBreadCrumbs(array("edit-profile"=>$Lang->Editaccount));
        include_once "editaccount.php";
        break;
    case "favorites":
        $pageName="favorites.php";
        $breadCrumbs=getBreadCrumbs(array("favorites"=>$Lang->Favorites));
        include_once "favorites.php";
        break;
    case "myquizzes":
        $pageName="myquizzes.php";
        $breadCrumbs=getBreadCrumbs(array("myquizzes"=>$Lang->myquizzes));
        include_once "myquizzes.php";
        break;

    case "mystories":
        $pageName="mystories.php";
        $breadCrumbs=getBreadCrumbs(array("mystories"=>$Lang->mystories));
        include_once "mystories.php";
        break;
    case "my-activities":
        $pageName="myactivities.php";
        $breadCrumbs=getBreadCrumbs(array("my-activities"=>$Lang->myactivities));
        include_once "myactivities.php";
        break;
        case "books-info":
        $pageName="books-info.php";
        $breadCrumbs=getBreadCrumbs(array("books-info"=>$Lang->booksinfo));
        include_once "books-info.php";
        break;
        case "electronic-books-info":
        $pageName="electronic-books-info.php";
        $breadCrumbs=getBreadCrumbs(array("electronic-books-info"=>$Lang->electronicbooksinfo));
        include_once "electronic-books-info.php";
        break;
        case "interactive-books-info":
        $pageName="interactive-books-info.php";
        $breadCrumbs=getBreadCrumbs(array("interactive-books-info"=>$Lang->interactivebooksinfo));
        include_once "interactive-books-info.php";
        break;
        case "stories-info":
        $pageName="stories-info.php";
        $breadCrumbs=getBreadCrumbs(array("stories-info"=>$Lang->storiesinfo));
        include_once "stories-info.php";
        break;
        case "electronic-stories-info":
        $pageName="electronic-stories-info.php";
        $breadCrumbs=getBreadCrumbs(array("electronic-stories-info"=>$Lang->electronicstoriesinfo));
        include_once "electronic-stories-info.php";
        break;
        case "interactives-stories-info":
        $pageName="interactives-stories-info.php";
        $breadCrumbs=getBreadCrumbs(array("interactive-stories-info"=>$Lang->interactivestoriesinfo));
        include_once "interactives-stories-info.php";
        break;
        case "educational-games-info":
        $pageName="educational-games-info.php";
        $breadCrumbs=getBreadCrumbs(array("educational-games-info"=>$Lang->educationalgamesinfo));
        include_once "educational-games-info.php";
        break;
        case "educational-tools-info":
        $pageName="educational-tools-info.php";
        $breadCrumbs=getBreadCrumbs(array("educational-tools-info"=>$Lang->educationaltoolsinfo));
        include_once "educational-tools-info.php";
        break;
        case "application-info":
        $pageName="application-info.php";
        $breadCrumbs=getBreadCrumbs(array("application-info"=>$Lang->applicationinfo));
        include_once "application-info.php";
        break;
        case "childrens-furniture-info":
        $pageName="childrens-furniture-info.php";
        $breadCrumbs=getBreadCrumbs(array("childrens-furniture-info"=>$Lang->childrensfurnitureinfo));
        include_once "childrens-furniture-info.php";
        break;
        case "worksheets-info":
        $pageName="worksheets-info.php";
        $breadCrumbs=getBreadCrumbs(  array("worksheets-info"=>$Lang->worksheetsinfo));
        include_once "worksheets-info.php";
        break;
        case "interactive-worksheets-info":
        $pageName="interactive-worksheets-info.php";
        $breadCrumbs=getBreadCrumbs(array("interactive-worksheets-info"=>$Lang->interactiveworksheetsinfo));
        include_once "interactive-worksheets-info.php";
        break;
        case "sound-info":
        $pageName="sound-info.php";
        $breadCrumbs=getBreadCrumbs(array("sound-info"=>$Lang->soundinfo));
        include_once "sound-info.php";
        break;
        case "store":
            if(isset($parameters[1]) && $parameters[1]!="?" && isset($parameters[2])) {
                if($parameters[1] == "books" && is_numeric($parameters[2])) {
                    $_GET["type"]="store";
                    $_GET["storetype"]="book";
                    $_GET['id']=$parameters[2];
                    $pageName = "view.php";
                    $breadCrumbs = getBreadCrumbs(array("store?type=books" => $Lang->Store, "store/books/" . $parameters[1] . "/" . $parameters[2]."/" . $parameters[3] => $parameters[3]));
                    include_once "view.php";
                }elseif ($parameters[1] == "stories" && is_numeric($parameters[2])) {
                    $_GET["type"]="store";
                    $_GET["storetype"]="story";
                    $_GET['id']=$parameters[2];
                    $pageName = "view.php";
                    $breadCrumbs = getBreadCrumbs(array("store?type=stories" => $Lang->Store, "store/stories/" . $parameters[1] . "/" . $parameters[2]."/" . $parameters[3] => $parameters[3]));
                    include_once "view.php";
                }elseif ($parameters[1] == "toys" && is_numeric($parameters[2])){
                    $_GET["type"]="store";
                    $_GET["storetype"]="toy";
                    $_GET['id']=$parameters[2];
                    $pageName = "view.php";
                    $breadCrumbs = getBreadCrumbs(array("store?type=toys" => $Lang->Store, "store/toys/" . $parameters[1] . "/" . $parameters[2]."/" . $parameters[3] => $parameters[3]));
                    include_once "view.php";
                }
                echo $parameters[1]." - ".$parameters[2];
            }else{
                $pageName="store.php";
                $breadCrumbs=getBreadCrumbs(array("store"=>$Lang->BookStore));
                include_once "store.php";
            }
            break;

        case "video-info":
        $pageName="video-info.php";
        $breadCrumbs=getBreadCrumbs(array("video-info"=>$Lang->videoinfo));
        include_once "video-info.php";
        break;
        case "teachers-guides-info":
        $pageName="teachers-guides-info.php";
        $breadCrumbs=getBreadCrumbs(array("teachers-guides-info"=>$Lang->teachersguidesinfo));
        include_once "teachers-guides-info.php";
        break;
        case "exercises-info":
        $pageName="exercises-info.php";
        $breadCrumbs=getBreadCrumbs(array("exercises-info"=>$Lang->exercisesinfo));
        include_once "exercises-info.php";
        break;
        case "subscribe":
        $pageName="subscribe.php";
        $breadCrumbs=getBreadCrumbs(array("subscribe"=>$Lang->subscribe));
        include_once "subscribe.php";
        break;
        case "activation":
        $pageName="activation.php";
        $breadCrumbs=getBreadCrumbs(array("activation"=>$Lang->activation));
        include_once "activation.php";
        break;
        case "invoice":
        $pageName="invoices.php";
        $breadCrumbs=getBreadCrumbs(array("invoice"=>$Lang->invoices));
            if (is_numeric($parameters[1])) {
                $_GET["id"] = $parameters[1];
            }
        include_once "invoices.php";
        break;
        case "furniture":
            if(isset($parameters[1])) {
                if ($parameters[1] == "category") {
                    $pageName = "furniture.php";
                    $_GET["type"] = "furniture";
                    if (!isset($_GET["category"]) || $_GET["category"] == "") {
                        $_GET["category"] = $parameters[2];
                    }
                    $catName = getCatName("furniture", $_GET["category"]);
                    if ($lang_code == "en") {
                        $h1 = $catName . " " . $Lang->Booksh1;
                    } else {
                        $h1 = $Lang->Booksh1 . " " . $catName;
                    }
                    //$breadCrumbs=getBreadCrumbs(array("books"=>$Lang->Books,"books/category/".$parameters[2]."/".$parameters[3]=>str_replace(" ","-",$catName)),$h1);
                    $breadCrumbs = getBreadCrumbs(array("furniture" => $Lang->Books, "furniture/category/" . $parameters[2] . "/" . $parameters[3] => $catName), $h1);
                    include_once "books.php";
                } elseif (is_numeric($parameters[1])) {
                    $_GET["id"] = $parameters[1];
                    $_GET["type"] = "furniture";
                    if ($parameters[2] == '') {
//                        $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status`=1 AND `books`.`bookid` =" . $_GET['id'];
//                        $result = $con->query($sql);
//                        $row = mysqli_fetch_assoc($result);
//                        $title = str_replace(" ", "-", $row["name"]);
//                        header('Location:' . $title);
                    }
                    $pageName = "view.php";
                    //$breadCrumbs=getBreadCrumbs(array("books"=>$Lang->Books,"books/".$parameters[1]."/".$parameters[2]=>str_replace(" ","-",$parameters[2])));
                    $breadCrumbs = getBreadCrumbs(array("furniture" => $Lang->Books, "furniture/" . $parameters[1] . "/" . $parameters[2] => $parameters[2]));
                    include_once "view.php";
                } elseif ($parameters[1] == "?") {
                    $_GET["type"] = "furniture";
                    $pageName = "furniture.php";
                    $breadCrumbs = getBreadCrumbs(array("furniture" => $Lang->furniture), $Lang->furniture);
                    include_once "furniture.php";
                }
            }else{
                $pageName="furniture.php";
                $breadCrumbs=getBreadCrumbs(array("furniture"=>$Lang->furniture));
                include_once "furniture.php";

            }
        break;
        case "pay":
        $pageName="pay.php";
        $breadCrumbs=getBreadCrumbs(array("pay"=>$Lang->Subscribe));
        include_once "pay.php";
        break;
        case "membership":
        $pageName="membership.php";
        $breadCrumbs=getBreadCrumbs(array("membership"=>$Lang->Membership));
        include_once "membership.php";
        break;
        case "faq":
            $_GET["type"] = "faq";
            if(isset($parameters[1])){
                if ($parameters[1] == "category") {
                    $pageName = "faq.php";
                    if(isset($_GET["category"]) && $_GET["category"]!=""){
                        $catName=getCatName("faq",$_GET["category"]);
                    }
                    $breadCrumbs=getBreadCrumbs(array("faq"=>$Lang->faq,"faq/category/".$parameters[2]."/".$parameters[3]=>str_replace(" ","-",$catName)));
                    include_once "faq.php";
                }elseif($parameters[1] == "?"){
                    $pageName = "faq.php";
                    $breadCrumbs=getBreadCrumbs(array("faq"=>$Lang->faq));
                    include_once "faq.php";
                }
            }else {
                $pageName = "faq.php";
                $breadCrumbs=getBreadCrumbs(array("faq"=>$Lang->faq));
                include_once "faq.php";
            }

        break;
        case "coloring-worksheet-info":
        $pageName="coloring-worksheet-info.php";
        $breadCrumbs=getBreadCrumbs(array("coloring-worksheet-info"=>$Lang->coloringworksheetinfo));
        include_once "coloring-worksheet-info.php";
        break;
        case "educationaltools":
            $_GET["type"] = "educationaltools";
            if(isset($parameters[1])){
                if ($parameters[1] == "category") {
                    $pageName = "educational_tools.php";

                    if(!isset($_GET["category"]) || $_GET["category"]==""){
                        $_GET["category"]=$parameters[2];
                    }
                    $catName=getCatName("educationaltools",$_GET["category"]);
                    if($lang_code=="en"){
                        $h1=$catName." ".$Lang->educationaltoolsh1;
                    }else{
                        $h1=$Lang->educationaltoolsh1." ".$catName;
                    }
                    $breadCrumbs=getBreadCrumbs(array("educationaltools"=>$Lang->educationaltools,"educationaltools/category/".$parameters[2]."/".$parameters[3]=>$catName),$h1);
                    include_once "educational_tools.php";
                }elseif (is_numeric($parameters[1])){
                    $_GET["id"] = $parameters[1];
                    $pageName = "view.php";
                    $breadCrumbs=getBreadCrumbs(array("educationaltools"=>$Lang->educationaltools,"educationaltools/".$parameters[1]."/".$parameters[2]=>$parameters[2]));
                    include_once "view.php";
                }elseif($parameters[1] == "?"){
                    $pageName = "educational_tools.php";
                    $breadCrumbs=getBreadCrumbs(array("educationaltools"=>$Lang->educationaltools),$Lang->educationaltoolsh1);
                    include_once "educational_tools.php";
                }
            }else {
                $pageName="educational_tools.php";
                $breadCrumbs=getBreadCrumbs(array("educationaltools"=>$Lang->educationaltools));
                include_once "educational_tools.php";
            }
            break;
    case "activities":
    case "games":
    case "playgame":
    if(isset($parameters[1])){
            if ($parameters[1] == "category") {
                $pageName = "games.php";
                $_GET["type"] = "games";
                if(isset($_GET["category"]) && $_GET["category"]!=""){
                    $catName=getCatName("games",$_GET["category"]);
                }else{
                    $_GET["category"]=$parameters[2];
                    $catName=$parameters[3];
                }
                $breadCrumbs=getBreadCrumbs(array("activities"=>$Lang->Activities,"activities/category/".$parameters[2]."/".$parameters[3]=>str_replace(" ","-",$catName)));
                include_once "games.php";
            }elseif (isset($parameters[3])&&$parameters[3]=='play') {
                $_GET["id"] = $parameters[1];
                $_GET["type"] = "playgame";


                if($parameters[3]==''){
                    $sql="Select media.*, categories.name_ar, categories.name_en From media Inner Join categories On media.category = categories.catid   where   media.type=11 and  media.status=1 and media.id=".$_GET['id'];
                    $result = $con->query($sql);
                    $row=mysqli_fetch_assoc($result);
                    $title= str_replace(" ","-",$row["title_".$cat_code]);
                    //header('Location:'.$title);
                    header('Location:' . BaseURL.$lang_code."/".$parameters[0]."/".$_GET["id"]."/".$title);

                }


                $pageName = "view.php";
                $breadCrumbs=getBreadCrumbs(array("activities"=>$Lang->Activities,"activities/".$parameters[1]."/".$parameters[2]=>str_replace(" ","-",$parameters[2]),"activities/".$parameters[1]."/".$parameters[2]."/".$parameters[3]=>$parameters[3]));
                include_once "view.php";
            }elseif (is_numeric($parameters[1])) {
                $_GET["id"] = $parameters[1];
                $_GET["type"] = "games";
                $pageName = "view.php";
                $breadCrumbs=getBreadCrumbs(array("activities"=>$Lang->Activities,"activities/".$parameters[1]."/".$parameters[2]=>str_replace(" ","-",$parameters[2])));
                include_once "view.php";
            }elseif($parameters[1] == "?"){
                $_GET["type"] = "games";
                $pageName = "games.php";
                $breadCrumbs=getBreadCrumbs(array("activities"=>$Lang->Activities));
                include_once "games.php";
            }
        }else {
            $pageName = "games.php";
            $breadCrumbs=getBreadCrumbs(array("activities"=>$Lang->Activities));
            include_once "games.php";
        }
        break;
    case "worksheet":
    case "playworksheet":
        if(isset($parameters[1])){
            if ($parameters[1] == "category") {
                $pageName = "worksheet.php";
                $_GET["type"] = "worksheet";
                if(isset($_GET["category"]) && $_GET["category"]!=""){
                    $catName=getCatName("worksheet",$_GET["category"]);
                }else{
                    $_GET["category"]=$parameters[2];
                    $catName=$parameters[3];
                }
                $breadCrumbs=getBreadCrumbs(array("worksheet"=>$Lang->Worksheets1,"worksheet/category/".$parameters[2]."/".$parameters[3]=>str_replace(" ","-",$catName)));
                include_once "worksheet.php";
            }elseif (isset($parameters[3])&&$parameters[3]=='view') {
                $_GET["id"] = $parameters[1];
                $_GET["type"] = "playworksheet";





                $pageName = "view.php";
                $breadCrumbs=getBreadCrumbs(array("worksheet"=>$Lang->Worksheets1,"worksheet/".$parameters[1]."/".$parameters[2]=>str_replace(" ","-",$parameters[2]),"worksheet/".$parameters[1]."/".$parameters[2]."/".$parameters[3]=>$parameters[3]));
                include_once "view.php";
            }elseif (is_numeric($parameters[1])) {
                $_GET["id"] = $parameters[1];
                $_GET["type"] = "worksheet";
                $pageName = "view.php";
                $breadCrumbs=getBreadCrumbs(array("worksheet"=>$Lang->Worksheets1,"worksheet/".$parameters[1]."/".$parameters[2]=>str_replace(" ","-",$parameters[2])));
                include_once "view.php";
            }elseif($parameters[1] == "?"){
                $_GET["type"] = "worksheet";
                $pageName = "worksheet.php";
                $breadCrumbs=getBreadCrumbs(array("worksheet"=>$Lang->Worksheets1));
                include_once "worksheet.php";
            }
        }else {
            $pageName = "worksheet.php";
            $breadCrumbs=getBreadCrumbs(array("worksheet"=>$Lang->Worksheets1));
            include_once "worksheet.php";
        }
        break;
    case "interactive-worksheets":
    case "playinteractiveworksheets":
        if(isset($parameters[1])){
            if ($parameters[1] == "category") {
                $pageName = "interactive_worksheets.php";
                $_GET["type"] = "interactive-worksheets";
                if(isset($_GET["category"]) && $_GET["category"]!=""){
                    $catName=getCatName("interactive-worksheets",$_GET["category"]);
                }else{
                    $_GET["category"]=$parameters[2];
                    $catName=$parameters[3];
                }
                $breadCrumbs=getBreadCrumbs(array("activities"=>$Lang->Activities,"activities/category/".$parameters[2]."/".$parameters[3]=>str_replace(" ","-",$catName)));
                include_once "interactive_worksheets.php";
            }elseif (isset($parameters[3])&&$parameters[3]=='play') {
                $_GET["id"] = $parameters[1];
                $_GET["type"] = "playinteractiveworksheets";
                if($parameters[3]==''){
                    $sql="Select media.*, categories.name_ar, categories.name_en From media Inner Join categories On media.category = categories.catid   where   media.type=12 and  media.status=1 and media.id=".$_GET['id'];
                    $result = $con->query($sql);
                    $row=mysqli_fetch_assoc($result);
                    $title= str_replace(" ","-",$row["title_".$cat_code]);
                   // header('Location:'.$title);
                    header('Location:' . BaseURL.$lang_code."/".$parameters[0]."/".$_GET["id"]."/".$title);
                }
                $pageName = "view.php";
                $breadCrumbs=getBreadCrumbs(array("activities"=>$Lang->Activities,"activities/".$parameters[1]."/".$parameters[2]=>str_replace(" ","-",$parameters[2]),"activities/".$parameters[1]."/".$parameters[2]."/".$parameters[3]=>$parameters[3]));
                include_once "view.php";
            }elseif (is_numeric($parameters[1])) {
                $_GET["id"] = $parameters[1];
                $_GET["type"] = "interactive-worksheets";
                $pageName = "view.php";
                $breadCrumbs=getBreadCrumbs(array("activities"=>$Lang->Activities,"activities/".$parameters[1]."/".$parameters[2]=>str_replace(" ","-",$parameters[2])));
                include_once "view.php";
            }elseif($parameters[1] == "?"){
                $_GET["type"] = "interactive-worksheets";
                $pageName = "interactive_worksheets.php";
                $breadCrumbs=getBreadCrumbs(array("activities"=>$Lang->Activities));
                include_once "interactive_worksheets.php";
            }
        }else {
            $pageName = "interactive_worksheets.php";
            $breadCrumbs=getBreadCrumbs(array("activities"=>$Lang->Activities));
            include_once "interactive_worksheets.php";
        }
        break;
    case "video":
        if(isset($parameters[1])){
            if ($parameters[1] == "category") {
                $pageName = "video.php";
                $_GET["type"] = "video";
                if(isset($_GET["category"]) && $_GET["category"]!=""){
                    $catName=getCatName("video",$_GET["category"]);
                }else{
                    $_GET["category"]=$parameters[2];
                    $catName=$parameters[3];
                }

                if($lang_code=="en"){
                    $h1=$catName." ".$Lang->Videos1;
                }else{
                    $h1=$Lang->Videos1." ".$catName;
                }

                $breadCrumbs=getBreadCrumbs(array("video"=>$Lang->Video,"video/category/".$parameters[2]."/".$parameters[3]=>str_replace(" ","-",$catName)),$h1);
                include_once "video.php";
            }elseif (is_numeric($parameters[1])) {
                $_GET["id"] = $parameters[1];
                $_GET["type"] = "video";
                if($parameters[2]==''){
                    $sql="Select media.*, categories.name_ar, categories.name_en From media Inner Join categories On media.category = categories.catid   where  media.type=4 and  media.status=1 and media.fakeid=".$_GET['id'];
                    $result = $con->query($sql);
                    if(mysqli_num_rows($result)<1){
                        $sql="Select media.*, categories.name_ar, categories.name_en From media Inner Join categories On media.category = categories.catid   where   media.type=4 and  media.status=1 and media.id=".$_GET['id'];
                        $result = $con->query($sql);
                    }
                    $row=mysqli_fetch_assoc($result);
                    $title= str_replace(" ","-",$row["title_".$cat_code]);
                    //header('Location:'.$title);
                    $_SESSION["canshow"][$row["id"]]=1;

                    header('Location:' . BaseURL.$lang_code."/".$parameters[0]."/".$row["id"]."/".$title);
                }
                $pageName = "view.php";
                $breadCrumbs=getBreadCrumbs(array("video"=>$Lang->Video,"video/".$parameters[1]."/".$parameters[2]=>str_replace(" ","-",$parameters[2])));
                include_once "view.php";
            }elseif($parameters[1] == "?"){
                $_GET["type"] = "video";
                $pageName = "video.php";
                $breadCrumbs=getBreadCrumbs(array("video"=>$Lang->Video),$Lang->Videos1);
                include_once "video.php";
            }
        }else {
            $pageName = "video.php";
            $breadCrumbs=getBreadCrumbs(array("video"=>$Lang->Video),$Lang->Videos1);
            include_once "video.php";
        }

        break;
    case "audio":
        if(isset($parameters[1])){
            if ($parameters[1] == "category") {
                $pageName = "audio.php";
                $_GET["type"] = "audio";
                if(isset($_GET["category"]) && $_GET["category"]!=""){
                    $catName=getCatName("audio",$_GET["category"]);
                }else{
                    $_GET["category"]=$parameters[2];
                    $catName=$parameters[3];
                }

                if($lang_code=="en"){
                    $h1=$catName." ".$Lang->Sounds1;
                }else{
                    $h1=$Lang->Sounds1." ".$catName;
                }

                $breadCrumbs=getBreadCrumbs(array("audio"=>$Lang->audio,"video/category/".$parameters[2]."/".$parameters[3]=>str_replace(" ","-",$catName)),$h1);
                include_once "audio.php";
            }elseif (is_numeric($parameters[1])) {
                $_GET["id"] = $parameters[1];
                $_GET["type"] = "audio";


                if($parameters[2]==''){
                    $sql="Select media.*, categories.name_ar, categories.name_en From media Inner Join categories On media.category = categories.catid   where   media.type=3 and  media.status=1 and media.id=".$_GET['id'];
                    $result = $con->query($sql);
                    $row=mysqli_fetch_assoc($result);
                    $title= str_replace(" ","-",$row["title_".$cat_code]);
                    //header('Location:'.$title);
                    header('Location:' . BaseURL.$lang_code."/".$parameters[0]."/".$_GET["id"]."/".$title);
                }


                $pageName = "view.php";
                $breadCrumbs=getBreadCrumbs(array("audio"=>$Lang->audio,"audio/".$parameters[1]."/".$parameters[2]=>str_replace(" ","-",$parameters[2])));
                include_once "view.php";
            }elseif($parameters[1] == "?"){
                $_GET["type"] = "audio";
                $pageName = "audio.php";
                $breadCrumbs=getBreadCrumbs(array("audio"=>$Lang->audio),$Lang->Sounds1);
                include_once "audio.php";
            }
        }else {
            $pageName = "audio.php";
            $breadCrumbs=getBreadCrumbs(array("audio"=>$Lang->audio),$Lang->Sounds1);
            include_once "audio.php";
        }
        break;
    case "books-editor":
        $pageName="bookseditor.php";
        $breadCrumbs=getBreadCrumbs(array("books-editor"=>$Lang->bookEditor));
        include_once "bookseditor.php";
        break;
        case "quizzes":
        $pageName="exercises.php";
        $breadCrumbs=getBreadCrumbs(array("exercises"=>$Lang->exercises));
        include_once "exercises.php";
        break;
        case "stories-editors":
        $pageName="storieseditor.php";
        $breadCrumbs=getBreadCrumbs(array("stories-editors"=>$Lang->StoriesEditor));
        include_once "storieseditor.php";
        break;
        case "quiz-creator":
        $pageName="quizeditor.php";
        $breadCrumbs=getBreadCrumbs(array("quizeditor"=>$Lang->QuizCreator));
        include_once "quizeditor.php";
        break;
        case "interactive-stories-editors":
        $pageName="interactivestorieseditors.php";
        $breadCrumbs=getBreadCrumbs(array("interactive-stories-editors"=>$Lang->InteractiveStoriesBuilder));
        include_once "interactivestorieseditors.php";
        break;
        case "subscribe-tutorial":
        $pageName="subscribe-tutorial.php";
        $breadCrumbs=getBreadCrumbs(array("subscribe-tutorial"=>$Lang->subscribetutorial));
        include_once "subscribe-tutorial.php";
        break;
    case "services":
        $pageName="services.php";
        $breadCrumbs=getBreadCrumbs(array("services"=>$Lang->Services));
        include_once "services.php";
        break;
    case "products":
        $pageName="products.php";
        $breadCrumbs=getBreadCrumbs(array("products"=>$Lang->Products));
        include_once "products.php";
        break;
    case "":
        $pageName="index.php";
        $breadCrumbs=getBreadCrumbs(array());
        include_once "index.php";
        break;
    case "purchased":
        if(isset($parameters[1])&& $parameters[1]=='?'){
            if(isset($_GET["category"]) && $_GET["category"]!=""){
                $type='';
                if($_GET["category"]=='book') {
                    $type = $Lang->Books;
                }else if($_GET["category"]=='story'){
                    $type = $Lang->Story;
                }
                $pageName = "purchased.php";

                $breadCrumbs=getBreadCrumbs(array("purchased"=>$Lang->Purchased,"purchased/".$_GET["category"]=>$type),$type);
                include_once "purchased.php";
            }elseif(isset($_GET["success"]) && $_GET["success"]=1){
                $pageName = "purchased.php";
                $breadCrumbs=getBreadCrumbs(array("purchased"=>$Lang->Purchased));
                include_once "purchased.php";
            }else{
                $pageName = "purchased.php";
                $breadCrumbs=getBreadCrumbs(array("purchased"=>$Lang->Purchased));
                include_once "purchased.php";
            }
        }else {
            $pageName = "purchased.php";
            $breadCrumbs=getBreadCrumbs(array("purchased"=>$Lang->Purchased));
            include_once "purchased.php";
        }
        break;
    case "stories":
        if(isset($parameters[1])){
            if (isset($_GET["series"]) && $_GET["series"]!=""){
                $pageName = "stories.php";
                $_GET["type"] = "story";
                $seriesName=getSeriesName("story",$_GET["series"]);

                $breadCrumbs=getBreadCrumbs(array("stories"=>$Lang->Stories,"stories/?series=".$_GET["series"]=>str_replace(" ","-",$seriesName)),$seriesName);
                include_once "stories.php";
            }elseif ($parameters[1] == "category") {
                $pageName = "stories.php";
                $_GET["type"] = "story";
                $_GET["category"]=$parameters[2];
                $catName=getCatName("story",$_GET["category"]);

                if($lang_code=="en"){
                    $h1=$catName." ".$Lang->Story1;
                }else{
                    $h1=$Lang->Story1." ".$catName;
                }
                //$breadCrumbs=getBreadCrumbs(array("stories"=>$Lang->Stories,"stories/category/".$parameters[2]."/".$parameters[3]=>str_replace(" ","-",$catName)),$h1);
                $breadCrumbs=getBreadCrumbs(array("stories"=>$Lang->Stories,"stories/category/".$parameters[2]."/".$parameters[3]=>$catName),$h1);
                include_once "stories.php";
            }elseif (is_numeric($parameters[1])) {
                $_GET["id"] = $parameters[1];
                $_GET["type"] = "story";
                if($parameters[2]==''){
                    $sql="SELECT `story`.*,`stories_cat`.*,`series`.*,`story`.`rating_count` as rate_count FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid`  WHERE `story`.`status`=1 AND `story`.`storyid`=".$_GET['id'];
                    $result = $con->query($sql);
                    $row=mysqli_fetch_assoc($result);
                    $title= str_replace(" ","-",$row["title"]);
                    //header('Location:'.$title);
                    header('Location:' . BaseURL.$lang_code."/".$parameters[0]."/".$_GET["id"]."/".$title);
                }

                if(isset($_GET["s"]) && $_GET["s"]==1){
                    $pageName = "view.php";
                    //$breadCrumbs=getBreadCrumbs(array("stories"=>$Lang->Stories,"stories/".$parameters[1]."/".$parameters[2]=>str_replace(" ","-",$parameters[2])));
                    $breadCrumbs=getBreadCrumbs(array("stories"=>$Lang->Stories,"stories/".$parameters[1]."/".$parameters[2]=>$parameters[2]));
                    include_once "view.php";
                }else{
                    $sql="SELECT `story`.*,`stories_cat`.*,`series`.*,`story`.`rating_count` as rate_count FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid`  WHERE `story`.`status`=1 AND `story`.`storyid`=".$_GET['id'];
                    $result = $con->query($sql);
                    $row=mysqli_fetch_assoc($result);
                    if($row["type"]>1){
                        header('Location:' . BaseURL."platform/stories/demo/index.php?storyid=".$_GET["id"]);
                        exit();
                    }else{
                        $pageName = "view.php";
                        //$breadCrumbs=getBreadCrumbs(array("stories"=>$Lang->Stories,"stories/".$parameters[1]."/".$parameters[2]=>str_replace(" ","-",$parameters[2])));
                        $breadCrumbs=getBreadCrumbs(array("stories"=>$Lang->Stories,"stories/".$parameters[1]."/".$parameters[2]=>$parameters[2]));
                        include_once "view.php";
                    }
                }

            }elseif($parameters[1] == "?"){
                $_GET["type"] = "story";
                $pageName = "stories.php";
                $breadCrumbs=getBreadCrumbs(array("stories"=>$Lang->Stories),$Lang->Story1);
                include_once "stories.php";
            }
        }else {

            $pageName = "stories.php";
            $breadCrumbs=getBreadCrumbs(array("stories"=>$Lang->Stories),$Lang->Story1);

            include_once "stories.php";
        }
        break;
    case "electronic-stories":
        $_GET["book_type"]="electronic";
        if(isset($parameters[1])){
            if (isset($_GET["series"]) && $_GET["series"]!=""){
                $pageName = "stories.php";
                $_GET["type"] = "story";
                $seriesName=getSeriesName("story",$_GET["series"]);

                $breadCrumbs=getBreadCrumbs(array("electronic-stories"=>$Lang->estories,"electronic-stories/?series=".$_GET["series"]=>str_replace(" ","-",$seriesName)),$seriesName);
                include_once "stories.php";
            }elseif ($parameters[1] == "category") {
                $pageName = "stories.php";
                $_GET["type"] = "story";
                $_GET["category"]=$parameters[2];
                $catName=getCatName("story",$_GET["category"]);
                if($lang_code=="en"){
                    $h1=$catName." ".$Lang->Story1;
                }else{
                    $h1=$Lang->Story1." ".$catName;
                }
                $breadCrumbs=getBreadCrumbs(array("electronic-stories"=>$Lang->estories,"electronic-stories/category/".$parameters[2]."/".$parameters[3]=>$catName),$h1);
                include_once "stories.php";
            }elseif($parameters[1] == "?"){
                $_GET["type"] = "story";
                $pageName = "stories.php";
                $breadCrumbs=getBreadCrumbs(array("electronic-stories"=>$Lang->estories),$Lang->Story1);
                include_once "stories.php";
            }
        }else{
            $pageName = "stories.php";
            $breadCrumbs=getBreadCrumbs(array("electronic-stories"=>$Lang->estories),$Lang->Story1);
            include_once "stories.php";
        }
        break;
    case "books":
        if(isset($parameters[1])) {
            if($parameters[1] == "category") {
                $pageName = "books.php";
                $_GET["type"] = "book";
                if (!isset($_GET["category"]) || $_GET["category"] == "") {
                    $_GET["category"] = $parameters[2];
                }
                $catName = getCatName("book", $_GET["category"]);
                if ($lang_code == "en") {
                    $h1 = $catName . " " . $Lang->Booksh1;
                } else {
                    $h1 = $Lang->Booksh1 . " " . $catName;
                }
                //$breadCrumbs=getBreadCrumbs(array("books"=>$Lang->Books,"books/category/".$parameters[2]."/".$parameters[3]=>str_replace(" ","-",$catName)),$h1);
                $breadCrumbs = getBreadCrumbs(array("books" => $Lang->Books, "books/category/" . $parameters[2] . "/" . $parameters[3] => $catName), $h1);
                include_once "books.php";
            } elseif (is_numeric($parameters[1])) {
                checkModifiedID($parameters[1]);
                $_GET["id"] = $parameters[1];
                $_GET["type"] = "book";
                if ($parameters[2] == '') {
                    $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status`=1 AND `books`.`bookid` =" . $_GET['id'];
                    $result = $con->query($sql);
                    $row = mysqli_fetch_assoc($result);
                    $title = str_replace(" ", "-", $row["name"]);
                    //header('Location:' . $title);
                    header('Location:' . BaseURL.$lang_code."/".$parameters[0]."/".$_GET["id"]."/".$title);
                    //exit();
                }

                if(isset($_GET["s"]) && $_GET["s"]==1){
                    $pageName = "view.php";
                    $breadCrumbs = getBreadCrumbs(array("books" => $Lang->Books, "books/" . $parameters[1] . "/" . $parameters[2] => $parameters[2]));
                    include_once "view.php";
                }else{
                    $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status`=1 AND `books`.`bookid` =" . $_GET['id'];
                    $result = $con->query($sql);
                    $row = mysqli_fetch_assoc($result);
                    if($row["booktype"]>1){
                        if(in_array($_GET['id'],$open_books)){
                            header('Location:' . BaseURL."platform/books/".$_GET["id"]."/index.html?o=qr");
                        }else{
                            header('Location:' . BaseURL."platform/books/".$_GET["id"]."/index.html");
                        }
                        exit();
                    }else{
                        $pageName = "view.php";
                        $breadCrumbs = getBreadCrumbs(array("books" => $Lang->Books, "books/" . $parameters[1] . "/" . $parameters[2] => $parameters[2]));
                        include_once "view.php";
                    }

                }
            } elseif ($parameters[1] == "?") {
                $_GET["type"] = "book";
                $pageName = "books.php";
                $breadCrumbs = getBreadCrumbs(array("books" => $Lang->Books), $Lang->Booksh1);
                include_once "books.php";
            }elseif ($parameters[1] == "view" && isset($parameters[2]) && $parameters[2]!=''){
                $_GET["bookid"] = $parameters[2];
                include_once "platform/books/viewer/index.php";
            }
        }else{
            $pageName = "books.php";
            $breadCrumbs=getBreadCrumbs(array("books"=>$Lang->Books),$Lang->Booksh1);
            include_once "books.php";
        }
        break;
    case "electronic-books":
        $_GET["book_type"]="electronic";
        if(isset($parameters[1])) {
            if($parameters[1] == "category") {
                $pageName = "books.php";
                $_GET["type"] = "book";
                if (!isset($_GET["category"]) || $_GET["category"] == "") {
                    $_GET["category"] = $parameters[2];
                }
                $catName = getCatName("book", $_GET["category"]);
                if ($lang_code == "en") {
                    $h1 = $catName . " " . $Lang->ebooks;
                } else {
                    $h1 = $Lang->ebooks . " " . $catName;
                }
                $breadCrumbs = getBreadCrumbs(array("electronic-books" => $Lang->ebooks, "electronic-books/category/" . $parameters[2] . "/" . $parameters[3] => $catName), $h1);
                include_once "books.php";
            } elseif (is_numeric($parameters[1])) {
                $_GET["id"] = $parameters[1];
                $_GET["type"] = "book";
                if ($parameters[2] == '') {
                    $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status`=1 AND `books`.`bookid` =" . $_GET['id'];
                    $result = $con->query($sql);
                    $row = mysqli_fetch_assoc($result);
                    $title = str_replace(" ", "-", $row["name"]);
                    //header('Location:' . $title);
                    header('Location:' . BaseURL.$lang_code."/".$parameters[0]."/".$_GET["id"]."/".$title);
                }
                $pageName = "view.php";
                $breadCrumbs = getBreadCrumbs(array("electronic-books" => $Lang->ebooks, "electronic-books/" . $parameters[1] . "/" . $parameters[2] => $parameters[2]));
                include_once "view.php";
            } elseif ($parameters[1] == "?") {
                $_GET["type"] = "book";
                $pageName = "books.php";
                $breadCrumbs = getBreadCrumbs(array("books" => $Lang->Books), $Lang->Booksh1);
                include_once "books.php";
            }
        }else {
            $pageName = "books.php";
            $breadCrumbs=getBreadCrumbs(array("books"=>$Lang->Books),$Lang->Booksh1);
            include_once "books.php";
        }
        break;
    case "teachers-guides":
        if(isset($parameters[1])){
            if ($parameters[1] == "category") {
                $pageName = "teacher_books.php";
                $_GET["type"] = "teacher_book";
                if(!isset($_GET["category"]) || $_GET["category"]==""){
                    $_GET["category"]=$parameters[2];
                }
                $catName=getCatName("book",$_GET["category"]);
                if($lang_code=="en"){
                    $h1=$catName." ".$Lang->Booksh1;
                }else{
                    $h1=$Lang->Booksh1." ".$catName;
                }
                $breadCrumbs=getBreadCrumbs(array("teachers-guides"=>$Lang->teachersguides,"teachers-guides/category/".$parameters[2]."/".$parameters[3]=>$catName),$h1);
                include_once "teacher_books.php";
            }elseif (is_numeric($parameters[1])){
                $_GET["id"] = $parameters[1];
                $_GET["type"] = "teacher_book";
                if($parameters[2]==''){
                    $sql = "SELECT `categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status`=1 AND `books`.`isteacherbook`=1 AND `books`.`bookid` =".$_GET['id'];
                    $result = $con->query($sql);
                    $row=mysqli_fetch_assoc($result);
                    $title= str_replace(" ","-",$row["name_".$cat_code]);
                    //header('Location:'.$title);
                    header('Location:' . BaseURL.$lang_code."/".$parameters[0]."/".$_GET["id"]."/".$title);
                }
                $pageName = "view.php";
                //$breadCrumbs=getBreadCrumbs(array("books"=>$Lang->Books,"books/".$parameters[1]."/".$parameters[2]=>str_replace(" ","-",$parameters[2])));
                $breadCrumbs=getBreadCrumbs(array("teachers-guides"=>$Lang->teachersguides,"teachers-guides/".$parameters[1]."/".$parameters[2]=>$parameters[2]));
                include_once "view.php";
            }elseif($parameters[1] == "?"){
                $_GET["type"] = "teacher_book";
                $pageName = "teacher_books.php";
                $breadCrumbs=getBreadCrumbs(array("teachers-guides"=>$Lang->teachersguides),$Lang->Booksh1);
                include_once "teacher_books.php";
            }
        }else {
            $pageName = "teacher_books.php";
            $breadCrumbs=getBreadCrumbs(array("teachers-guides"=>$Lang->teachersguides),$Lang->Booksh1);
            include_once "teacher_books.php";
        }
        break;
    case "events":
        if(isset($parameters[1]) && $parameters[1] != "?"){
            if (is_numeric($parameters[1])) {
                $_GET["id"] = $parameters[1];
                $pageName = "innerevents.php";
                $breadCrumbs=getBreadCrumbs(array("events"=>$Lang->Events,"events/".$parameters[1]."/".str_replace(" ","-",$parameters[2])=>str_replace(" ","-",$parameters[2])));
                include_once "innerevents.php";
            }
        }else{
            $pageName = "events.php";
            $breadCrumbs=getBreadCrumbs(array("events"=>$Lang->Events));
            include_once "events.php";
        }
        break;
    case "galleries":

        if(isset($parameters[1]) && $parameters[1] != "?"){
            if (is_numeric($parameters[1])) {
                $_GET["type"] = "innergalleries";
                $_GET["id"] = $parameters[1];
                $pageName = "innergalleries.php";
                $breadCrumbs=getBreadCrumbs(array("galleries"=>$Lang->Galleries,"galleries/".$parameters[1]."/".str_replace(" ","-",$parameters[2])=>str_replace(" ","-",$parameters[2])));
                include_once "innergalleries.php";
            }
        }else{
            $pageName = "galleries.php";
            $breadCrumbs=getBreadCrumbs(array("galleries"=>$Lang->Galleries));
            include_once "galleries.php";
        }
        break;
    case "news":
        if(isset($parameters[1]) && $parameters[1] != "?"){
            if (is_numeric($parameters[1])) {
                $_GET["id"] = $parameters[1];
                $pageName = "innernews.php";
                $breadCrumbs=getBreadCrumbs(array("news"=>$Lang->News,"news/".$parameters[1]."/".str_replace(" ","-",$parameters[2])=>str_replace(" ","-",$parameters[2])));
                include_once "innernews.php";
            }
        }else{
            $pageName = "news.php";
            $breadCrumbs=getBreadCrumbs(array("news"=>$Lang->News));
            include_once "news.php";
        }

        break;
    case "signin-popup":
                $pageName = "popupcontent.php";
                include_once "includes/popupcontent.php";
        break;
    case "careers":
        if (isset($parameters[1]) && $parameters[1] != "?") {
            if (is_numeric($parameters[1])) {
                $_GET["id"] = $parameters[1];
                $pageName = "careers.php";
                $breadCrumbs = getBreadCrumbs(array("careers" => $Lang->careers, "careers/" . $parameters[1] . "/" . str_replace(" ", "-", $parameters[2]) => str_replace(" ", "-", $parameters[2])));
                include_once "innercareers.php";
            }

        } else {

            $pageName = "careers.php";
            $breadCrumbs = getBreadCrumbs(array("careers" => $Lang->careers));
            include_once "careers.php";
        }


        break;

    case "educationalinquiries":
        if(isset($parameters[1])){
            if ($parameters[1] == "category") {
                $pageName = "educationalinquiries.php";
                $_GET["type"] = "educationalinquiries";
                if(isset($_GET["category"]) && $_GET["category"]!=""){
                    $catName=getCatName("educationalinquiries",$_GET["category"]);
                }else{
                    $_GET["category"]=$parameters[2];
                    $catName=$parameters[3];
                }
                $breadCrumbs=getBreadCrumbs(array("educationalinquiries"=>$Lang->Educationalinquiries,"educationalinquiries/category/".$parameters[2]."/".$parameters[3]=>str_replace(" ","-",$catName)));
                include_once "educationalinquiries.php";
            }elseif (is_numeric($parameters[1])) {
                $_GET["id"] = $parameters[1];
                $_GET["type"] = "educationalinquiries";
                $pageName = "view.php";
                $breadCrumbs=getBreadCrumbs(array("educationalinquiries"=>$Lang->Educationalinquiries,"educationalinquiries/".$parameters[1]."/".$parameters[2]=>str_replace(" ","-",$parameters[2])));
                include_once "view.php";
            }elseif($parameters[1] == "?"){
                $_GET["type"] = "educationalinquiries";
                $pageName = "educationalinquiries.php";
                $breadCrumbs=getBreadCrumbs(array("educationalinquiries"=>$Lang->Educationalinquiries));
                include_once "educationalinquiries.php";
            }
        }else {
            $pageName = "educationalinquiries.php";
            $breadCrumbs=getBreadCrumbs(array("educationalinquiries"=>$Lang->Educationalinquiries));
            include_once "educationalinquiries.php";
        }

        break;

    default :
        $pageName="404.php";
        $breadCrumbs=getBreadCrumbs(array());
        include_once "404.php";
        break;
}

function getCatName($type,$id){
    global $con;
    global $lang_code;
    global $cat_code;
    global $Lang;
    switch($type){
        case "book":
        case "worksheet":
        case "games":
        case "audio":
        case "video":
            case "quiz-result":
            case "interactive-worksheets":

            $sql="SELECT `name_".$cat_code."` FROM `categories` WHERE `catid`=".$id;
            $result=$con->query($sql);
            $row=mysqli_fetch_assoc($result);
            $catName=$row["name_".$cat_code];
            break;
        case "story":
            $sql="SELECT `name_".$cat_code."` FROM `stories_cat` WHERE `catid`=".$id;
            $result=$con->query($sql);
            $row=mysqli_fetch_assoc($result);
            $catName=$row["name_".$cat_code];
            break;
        case "educationaltools":
            $sql="Select `name_".$cat_code."` From  educationaltools_cat WHERE `parent`=0 AND `catid`=".$id;
            $result=$con->query($sql);
            $row=mysqli_fetch_assoc($result);
            $catName=$row["name_".$cat_code];
            break;
        case "faq":
            $sql="Select `name_".$cat_code."` From  faq_categories WHERE `parent`=0 AND `catid`=".$id;
            $result=$con->query($sql);
            $row=mysqli_fetch_assoc($result);
            $catName=$row["name_".$cat_code];
            break;
        case "educationalinquiries":

            switch($id){
                case "-1":
                case "5":
                case "6":
                    $catName= $Lang->AllDiscussions;
                    break;
                case "0":
                    $catName= $Lang->postme;
                    break;
                case "1":
                    $catName= $Lang->OpenDiscussions;
                    break;
                case "2":
                    $catName= $Lang->CloseDiscussions;
                    break;
                case "3":
                    $catName= $Lang->posthidden;
                    break;
                case "4":
                    $catName= $Lang->notificationDiscussions;
                    break;
            }
            break;
    }

    return $catName;
}
function getSeriesName($type,$id){
    global $con;
    switch($type){
        case "story":
            $sql="SELECT `name` FROM `series` WHERE `seriesid`=".$id;
            $result=$con->query($sql);
            $row=mysqli_fetch_assoc($result);
            $seriesName=$row["name"];
            break;
    }

    return $seriesName;
}
?>
