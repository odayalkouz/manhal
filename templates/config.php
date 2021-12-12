<?php

/**

 * Created by PhpStorm.

 * User: khalid alomiri

 * Date: 1/4/2016

 * Time: 1:14 PM

 */



$servername = "localhost";

$username = "manhal";

$password = "8myPe-Ax7oa5";

$dbname = "manhal_books";



define('WEBSITE_URL',"http://localhost/Manhal/");

define('BooksPerPage',12);

define('PagesOfPagination',9);



define("SITE_URL","http://www.manhal.com/");//aaaaaaaaaaaaaaaaaa



define("FACEBOOK_APPID","139847473035370");

define("TWITTER_APPID","A7kNJwxvlDJYUuMcSu5dHbJBx");

define("TWITTER_SECRET","hkP6k779dM23q6EbKrZE9aTT96wlR5snb90m0aAbDvZWqiqArp");

define("TWITTER_callBack","http://www.manhal.com/twitter/callBack.php");//aaaaaaaaaaaaaaaaaa





///paypal

define("CURRENCY","USD");

define("TAX",0.16);

define("BaseURL","http://www.manhal.com/paypal");





// Create connection

$con = new mysqli($servername, $username, $password, $dbname);

$con->set_charset("utf8");

// Check connection

if ($con->connect_error) {

    die("Connection failed: " . $con->connect_error);

}

$fonts=array("Amiri"=>"Amiri","Kufi"=>"Droid Arabic Kufi","Naskh"=>"Droid Arabic Naskh","Lateef"=>"Lateef","Scheherazade"=>"Scheherazade","Thabit"=>"Thabit");

?>