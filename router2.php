<?php

/**

 * Created by Dar Almanhal - Hussam Abu Khadijeh.

 * User: Hussam Abu Khadijeh

 * Date: 9/22/2016

 * Time: 4:51 PM

 */

include_once "platform/config.php";



if(strpos($_SERVER['REQUEST_URI'],"/ar")){

    $_GET["lang"]="Ar";

}else{

    $_GET["lang"]="En";

}



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

//unset($parameters[0]);

//if(isset($parameters[1]) && $parameters[1]!=""){
//    unset($parameters[1]);
//}
//
//
//$parameters = array_values($parameters);

//print_r($parameters);

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

function getBreadCrumbs($array){

    global $Lang;

    global $lang_code;

    $breadCrumbs='<div class="breadcrumbs-container floating-left"><div class="center-piece">

                     <ul class="floating-left" id="breadcrumb">

                        <li class="floating-left">

                            <a  class="anchor" href="'.SITE_URL.'">'.$Lang->Home.'</a>

                        </li>';



    foreach($array as $link=>$title){

        $breadCrumbs.='<li class="floating-left"><a>/</a></li><li class="floating-left"><a class="anchor" href="'.SITE_URL.$lang_code."/".$link.'">'.$title.'</a></li>';

    }

    $breadCrumbs.='<ul></div></div>';

    return $breadCrumbs;

}

switch($parameters[0]){

    case "ExecutePayment":

        $pageName="cart.php";

        $breadCrumbs=getBreadCrumbs(array("paypal"=>$Lang->paypalTitle));

        include_once "paypal/ExecutePayment.php";

        break;

    case "privacy-policy":

        $pageName="privacy.php";

        $breadCrumbs=getBreadCrumbs(array("privacy-policy"=>$Lang->privacyTitle));

        include_once "privacy.php";

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

    case "games":

        $pageName="games.php";

        $breadCrumbs=getBreadCrumbs(array("games"=>$Lang->Games));

        include_once "games.php";

        break;

    case "editors":

        $pageName="editors.php";

        $breadCrumbs=getBreadCrumbs(array("editors"=>$Lang->Editors));

        include_once "editors.php";

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

                $breadCrumbs=getBreadCrumbs(array("purchased"=>$Lang->Purchased,"purchased/".$_GET["category"]=>$type ));

                include_once "purchased.php";

            }elseif(isset($_GET["success"]) && $_GET["success"]=1){

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

            if ($parameters[1] == "category") {

                $pageName = "stories.php";

                $_GET["type"] = "story";

                $_GET["category"]=$parameters[2];

                if(isset($_GET["category"]) && $_GET["category"]!=""){

                    $catName=getCatName("story",$_GET["category"]);

                }else{

                    $_GET["category"]=$parameters[2];

                    $catName=$parameters[3];

                }

                $breadCrumbs=getBreadCrumbs(array("stories"=>$Lang->Stories,"stories/category/".$parameters[2]."/".$parameters[3]=>str_replace(" ","-",$catName)));

                include_once "stories.php";

            }elseif (is_numeric($parameters[1])) {

                $_GET["id"] = $parameters[1];

                $_GET["type"] = "story";

                $pageName = "view.php";

                $breadCrumbs=getBreadCrumbs(array("stories"=>$Lang->Stories,"stories/".$parameters[1]."/".$parameters[2]=>str_replace(" ","-",$parameters[2])));

                include_once "view.php";

            }elseif($parameters[1] == "?"){

                $_GET["type"] = "story";

                $pageName = "stories.php";

                $breadCrumbs=getBreadCrumbs(array("stories"=>$Lang->Stories));

                include_once "stories.php";

            }

        }else {

            $pageName = "stories.php";

            $breadCrumbs=getBreadCrumbs(array("stories"=>$Lang->Stories));

            include_once "stories.php";

        }

        break;

    case "books":

        if(isset($parameters[1])){

            if ($parameters[1] == "category") {

                $pageName = "books.php";

                $_GET["type"] = "book";

                if(isset($_GET["category"]) && $_GET["category"]!=""){

                    $catName=getCatName("book",$_GET["category"]);

                }else{

                    $_GET["category"]=$parameters[2];

                    $catName=$parameters[3];

                }

                $breadCrumbs=getBreadCrumbs(array("books"=>$Lang->Books,"books/category/".$parameters[2]."/".$parameters[3]=>str_replace(" ","-",$catName)));

                include_once "books.php";

            }elseif (is_numeric($parameters[1])) {

                $_GET["id"] = $parameters[1];

                $_GET["type"] = "book";

                $pageName = "view.php";

                $breadCrumbs=getBreadCrumbs(array("books"=>$Lang->Books,"books/".$parameters[1]."/".$parameters[2]=>str_replace(" ","-",$parameters[2])));

                include_once "view.php";

            }elseif($parameters[1] == "?"){

                $_GET["type"] = "book";

                $pageName = "books.php";

                $breadCrumbs=getBreadCrumbs(array("books"=>$Lang->Books));

                include_once "books.php";

            }

        }else {

            $pageName = "books.php";

            $breadCrumbs=getBreadCrumbs(array("books"=>$Lang->Books));

            include_once "books.php";

        }

        break;

    case "events":

        if(isset($parameters[1])){

            if (is_numeric($parameters[1])) {

                $_GET["id"] = $parameters[1];

                $pageName = "innerevents.php";

                $breadCrumbs=getBreadCrumbs(array("events"=>$Lang->Events,"events/".$parameters[1]."/".str_replace(" ","-",$parameters[2])));

                include_once "innerevents.php";

            }

        }else{

            $pageName = "events.php";

            $breadCrumbs=getBreadCrumbs(array("events"=>$Lang->Events));

            include_once "events.php";

        }

        break;

    case "news":







        $pageName = "news.php";

        $breadCrumbs=getBreadCrumbs(array("news"=>$Lang->News));

        include_once "news.php";



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

    switch($type){

        case "book":

            $sql="SELECT `name_".$lang_code."` FROM `categories` WHERE `catid`=".$id;

            $result=$con->query($sql);

            $row=mysqli_fetch_assoc($result);

            $catName=$row["name_".$lang_code];

            break;

        case "story":

            $sql="SELECT `name_".$lang_code."` FROM `stories_cat` WHERE `catid`=".$id;

            $result=$con->query($sql);

            $row=mysqli_fetch_assoc($result);

            $catName=$row["name_".$lang_code];

            break;

    }



    return $catName;

}

?>