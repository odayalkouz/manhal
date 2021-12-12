<?php
/**
 * Created by PhpStorm.
 * User: khalid alomiri
 * Date: 1/5/2016
 * Time: 8:22 AM
 */
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
if($_POST['TypeProcesses']!="login"){
    if(!(isset($_SESSION["user"]["permession"]) && $_SESSION["user"]["permession"]>0)){
        exit("secured");
    }
}



include_once('../config.php') ;
include_once('../includes/colors.inc.php') ;
include_once('../includes/function.php') ;



if(isset($_POST['TypeProcesses'])){
    $_POST['TypeProcesses']();
}

function getdatagames(){
    global $con;
    $sql = "SELECT  * FROM `editors` WHERE `gameid`='".$_POST['id']."'";
    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo json_encode($row);
    }


}
function updateuser(){
    global $con;
    $sql ="SELECT * FROM users WHERE uname='".$_POST['user_name']."' and userid!='".$_SESSION['user']["userid"]."' ";
    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        echo "0";
        return ;
    }
    if ($result = $con->query("UPDATE `users` SET `uname`='".$_POST['user_name']."',`password`='".$_POST['user_password']."',`email`='".$_POST['user_email']."',`fullname`='".$_POST['user_fullname']."' WHERE userid=".$_SESSION['user']["userid"])) {
        echo 1;
    }
}
function updatepublisher(){
    global $con;

    if ($result = $con->query("UPDATE `publishers` SET `pname_ar`='".mysqli_real_escape_string($con, $_POST['pnamear'])."',`pname_en`='".mysqli_real_escape_string($con, $_POST['pnameen'])."' WHERE pid=".$_POST['publisher_id'])) {
        echo 1;
    }else{
        echo 0;
    }
}

function updatebook(){
    global $con;
    if(isset($_POST["book_cover"]) && $_POST["book_cover"]!=""){
        saveImageBase64($_POST["book_cover"],"../books/".$_POST['book_id']."/cover.jpg");
        $sql="UPDATE `books` set color='".getImageColor("../books/".$_POST['book_id']."/cover.jpg")."' WHERE bookid=".$_POST['book_id'];
        $con->query($sql);
    }

    if(isset($_POST["back_cover"]) && $_POST["back_cover"]!=""){
        saveImageBase64($_POST["back_cover"],"../books/".$_POST['book_id']."/back.jpg");
    }

   $sql="UPDATE `books` SET  `name`='".mysqli_real_escape_string($con,$_POST['book_name'])."',`category`='".$_POST['Category']."',`width`='".$_POST['book_width']."',
   `pages_count`='".$_POST['book_pagescount']."',`language`='".$_POST['book_lang']."',`height`='".$_POST['book_height']."',`description_ar`='".mysqli_real_escape_string($con,$_POST['description_ar'])."',
   `description_en`='".mysqli_real_escape_string($con,$_POST['description_en'])."',`awidth`=".$_POST['awidth'].",`aheight`=".$_POST['aheight'].",`weight`=".$_POST['weight'].",
   `author_en`='".mysqli_real_escape_string($con,$_POST['author_en'])."',`author_ar`='".mysqli_real_escape_string($con,$_POST['author_ar'])."',`isbn`='".$_POST['isbn']."',`covertype`=".$_POST['binding'].",
   `grade`=".$_POST['grade'].",`age`=".$_POST['age'].",`year`=".$_POST['year'].",`booktype`=".$_POST["booktype"].",`price`=".$_POST['price'].",`iprice`='".$_POST['iprice']."',`eprice`='".$_POST['eprice']."',
   `semester`=".$_POST['semester'].",`filling`='".$_POST['book_register']."',`status`=".$_POST["ispublished"].",`isteacherbook`=".$_POST["teacherbook"].", `curriculum`=".$_POST["curriculum"].", `seodescription_ar`='".mysqli_real_escape_string($con,$_POST['seodescription_ar'])."',
    `seodescription_en`='".mysqli_real_escape_string($con,$_POST['seodescription_en'])."',`oldprice`=".$_POST['oldprice'].",`package`=".$_POST['package'].",`seriesid`='".$_POST['book_series']."'
    ,`store`=".$_POST['store']." ,`publisher`=".$_POST['publisher']." WHERE `bookid`=".$_POST['book_id'];
    if ($con->query($sql)) {
        echo 1;
    }else{
        echo "error sql=".$sql;
    }

}
function merge($img1,$img2,$img3){
    $photo = imagecreatefromjpeg($img1);
    $w_=imagesx($photo);
    $h_ = imagesy($photo);
    $photo2 = imagecreatefrompng($img2);
    $w = imagesx($photo2);
    $h = imagesy($photo2);
    imagealphablending($photo,true);
    $frame = imagecreatefrompng($img2);
    imagecopy($photo,$frame,($w_/2)-($w/2),($h_/2)-($h/2),0,0,$w,$h);
    imagejpeg($photo,$img3,100);
}
function updatemedia(){
    global $con;
    if(isset($_POST["thumbnail_small"]) && $_POST["thumbnail_small"]!=""){
    saveImageBase64($_POST["thumbnail_small"],"../media/".$_POST['media_id']."/thumbnail_small.jpg");
    }

    if(isset($_POST["image_larg"]) && $_POST["image_larg"]!=""){
        if(isset($_POST["mediatype"]) && $_POST["mediatype"]!=""){
            switch($_POST["mediatype"]){
                case 0:
                case 1:
                saveImageBase64($_POST["image_larg"],"../media/".$_POST['media_id']."/".$_POST["filename"]."image_larg.jpg");
                merge("../media/".$_POST['media_id']."/".$_POST["filename"]."image_larg.jpg", '../images/watermark.png', "../media/".$_POST['media_id']."/indexmark.jpg");
                    break;
                case 11:
                case 4:
                    saveImageBase64($_POST["image_larg"],"../media/".$_POST['media_id']."/thumbnail.jpg");
                    break;
                default:
                    saveImageBase64($_POST["image_larg"],"../media/".$_POST['media_id']."/thumbnail.jpg");
                    break;

            }
        }
    }

    if ($result = $con->query("UPDATE `media` SET  `title_en`='".mysqli_real_escape_string($con,$_POST['title_en'])."',`title_ar`='".mysqli_real_escape_string($con,$_POST['title_ar'])."',`category`='".$_POST['Category']."',`language`='".$_POST['lang']."',`description_ar`='".mysqli_real_escape_string($con,$_POST['description_ar'])."',`description_en`='".mysqli_real_escape_string($con,$_POST['description_en'])."',`grade`=".$_POST['grade'].",`age`=".$_POST['age'].",`price`=".$_POST['price'].",`fakeid`=".$_POST['fakeid'].",`status`=".$_POST['ispublished'].",`is_newtab`=".$_POST['isnewtab'].",`is_playlist`=".$_POST['is_playlist'].",`type`=".$_POST['mediatype']." WHERE `id`=".$_POST['media_id']." ")) {
        $sql="DELETE FROM `playlist_media` WHERE playlistid=".$_POST['media_id'];
        $con->query($sql);
        $playlist_arr=json_decode($_POST["plsylist_media"],true);
        foreach($playlist_arr as $media){
            $sql="INSERT INTO `playlist_media`(`playlistid`, `mediaid`,`title`,`type`) VALUES (".$_POST['media_id'].",".$media["mediaid"].",'".mysqli_real_escape_string($con,$media["title"])."',".$media["type"].")";
            $con->query($sql);
        }
        echo 1;
    }
    if(isset($_POST['book']) || is_array($_POST['book'])){
        if($_POST['book']!=null){
    for($i=0;$i<count($_POST['book']);$i++){
    $sql ="SELECT * FROM `medialinked` WHERE idmedia='".$_POST['media_id']."' and idbook='".$_POST['book'][$i]['idbook']."' and type='0' ";
    $result = $con->query($sql);
    if (mysqli_num_rows($result) <1) {
        $sql2 ="INSERT INTO `medialinked`(`id`, `idbook`, `type`, `idmedia`, `title`) VALUES (null,'".$_POST['book'][$i]['idbook']."','0',".$_POST['media_id'].",'".$_POST['book'][$i]['title']."')";
         $con->query($sql2);
    }
}}
}
    if(isset($_POST['story']) || is_array($_POST['story'])){
        if($_POST['story']!=null){
    for($j=0;$j<count($_POST['story']);$j++){
    $sqlstory ="SELECT * FROM `medialinked` WHERE idmedia='".$_POST['media_id']."' and idbook='".$_POST['story'][$j]['idbook']."' and type='1' ";
    $resultstory = $con->query($sqlstory);
    if (mysqli_num_rows($resultstory) <1) {
        $sql2story ="INSERT INTO `medialinked`(`id`, `idbook`, `type`, `idmedia`, `title`) VALUES (null,'".$_POST['story'][$j]['idbook']."','1',".$_POST['media_id'].",'".$_POST['story'][$j]['title']."')";
         $con->query($sql2story);
    }
}}
}

}


function updateproducts(){
    global $con;
    if(isset($_POST["thumbnail_small"]) && $_POST["thumbnail_small"]!=""){
        saveImageBase64($_POST["thumbnail_small"],"../products/".$_POST['product_id']."/thumbnail_small.jpg");
    }

    if(isset($_POST["image_larg"]) && $_POST["image_larg"]!=""){
        saveImageBase64($_POST["image_larg"],"../products/".$_POST['product_id']."/image_larg.jpg");
    }

    if ($result = $con->query("UPDATE `products` SET `ISBN`='".$_POST['product_ISBN']."', `name_ar`='".$_POST['title_ar']."',`name_en`='".$_POST['title_en']."',`color`='".$_POST['product_color']."',`Width`='".$_POST['product_width']."',`Height`='".$_POST['product_height']."',`Weight`='".$_POST['product_weight']."',`Price`='".$_POST['product_price']."',`brand`='".$_POST['product_brand']."',`description_en`='".$_POST['description_en']."',`description_ar`='".$_POST['description_ar']."',`status`='".$_POST['ispublished']."',`department`='".$_POST['departments']."',`age`='".$_POST['product_age']."' WHERE `productid`=".$_POST['product_id']." ")) {
        echo 1;



    }




}


function removebooklinked(){
    global $con;
    $sql ="DELETE FROM `medialinked` WHERE idmedia='".$_POST['media_id']."' and idbook='".$_POST['idbook']."' and type='".$_POST['type']."'  ";
    $result = $con->query($sql);
    if (mysqli_num_rows($result) <1) {

    }
}



//function updatequiz(){
//    global $con;
//
//    if ($con->query("UPDATE `quiz` SET `category`='".$_POST['Category']."',`title`='".$_POST['quiz_title']."',`Introduction`='".$_POST['quiz_Introduction']."',`age`='".$_POST['quiz_age']."',`passing_rate`='".$_POST['quiz_passing_rate']."',`result`='".mysqli_real_escape_string($con,$_POST['quiz_result'])."',`passed`='".$_POST['question_Passed']."',`failed`='".$_POST['question_Failed']."' WHERE quizid='".$_POST['quiz_id']."'")) {
//        echo 1;
//    }
//}

function updatecategory(){
    global $con;
    if ($result = $con->query("UPDATE `categories` SET `name_ar`='".$_POST['category_namear']."',`name_en`='".$_POST['category_nameen']."' WHERE `catid`='".$_POST['category_id']."'")) {
        echo 1;
    }
}
function updatebrand(){
    global $con;
    if ($result = $con->query("UPDATE `brand` SET `name_ar`='".$_POST['category_namear']."',`name_en`='".$_POST['category_nameen']."' WHERE `catid`='".$_POST['category_id']."'")) {
        echo 1;
    }
}
function updatedepartments (){
    global $con;
    if ($result = $con->query("UPDATE `departments` SET `name_ar`='".$_POST['category_namear']."',`name_en`='".$_POST['category_nameen']."' WHERE `catid`='".$_POST['category_id']."'")) {
        echo 1;
    }
}


function deleteuser()
{
global $con;
    if ($result = $con->query("DELETE FROM users WHERE userid='".$_POST['userId']."'")) {
       echo 1;
    }
}
function deletecategory()
{
    global $con;
    if ($result = $con->query("DELETE FROM categories WHERE catid='".$_POST['categoryid']."'")) {
        echo 1;
    }
}
//start khalid [000001-7-9-2016]
function deletecategorystory()
{
    global $con;
    if ($result = $con->query("DELETE FROM stories_cat WHERE catid='".$_POST['categoryid']."'")) {
        echo 1;
    }
}
function deletedepartment()
{
    global $con;
    if ($result = $con->query("DELETE FROM departments WHERE catid='".$_POST['categoryid']."'")) {
        echo 1;
    }
}





function deletebook(){
    global $con;
    if ($result = $con->query("DELETE FROM books WHERE bookid='".$_POST['bookId']."'")) {
        deleteDirectory('../books/'.$_POST['bookId']);
        echo 1;
    }
}
function deletemedia(){
    global $con;
    if ($result = $con->query("DELETE FROM media WHERE id='".$_POST['mediaId']."'")) {
        deleteDirectory('../media/'.$_POST['mediaId']);
        echo 1;
    }
}
function deleteproduct(){
    global $con;
    if ($result = $con->query("DELETE FROM products WHERE productid='".$_POST['productId']."'")) {
        deleteDirectory('../products/'.$_POST['productId']);
        echo 1;
    }
}


function deleteInvoices(){
    global $con;
    if ($result = $con->query("DELETE FROM `invoices` WHERE id='".$_POST['InvoicesId']."'")) {

        echo 1;
    }
}
function updateinvoice(){
    global $con;
    if ($result = $con->query("UPDATE `invoices` SET `number`='".mysqli_real_escape_string($con,$_POST['Invoicenumber'])."',`name`='".mysqli_real_escape_string($con,$_POST['invoice_name'])."',`email`='".mysqli_real_escape_string($con,$_POST['invoice_EMail'])."',`address`='".mysqli_real_escape_string($con,$_POST['invoice_AddressA'])."',`city`='".mysqli_real_escape_string($con,$_POST['invoice_city'])."',`shippingmethod`='".mysqli_real_escape_string($con,$_POST['invoice_Shippingmethod'])."',`description`='".mysqli_real_escape_string($con,$_POST['invoice_Description'])."',`country`='".mysqli_real_escape_string($con,$_POST['invoice_country'])."',`productname`='".mysqli_real_escape_string($con,$_POST['invoice_productname'])."',`shippingprice`='".mysqli_real_escape_string($con,$_POST['invoice_shippingprice'])."',`price`='".mysqli_real_escape_string($con,$_POST['invoice_price'])."',`totalprice`='".mysqli_real_escape_string($con,$_POST['invoice_totalprice'])."' WHERE `id`='".(int)$_POST['invoice_id']."'")) {
        echo 1;
    }
}
function sendmailinvoice(){
    global $con;

    $sql = "SELECT * FROM `invoices` WHERE id=" . $_POST['id'];
    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    }

    global $Lang;
    $message=file_get_contents("../../templates/invoice_".$_SESSION["lang"].".html");
    $logo=SITE_URL."images/logo.png";
    $message=str_replace("#Manhal_logo#",$logo,$message);
    $message=str_replace("#Manhal_Number#",$row['number'],$message);
    $message=str_replace("#Manhal_Name#",$row['name'],$message);
    $message=str_replace("#Manhal_mail#",$row['email'],$message);
    $message=str_replace("#Manhal_Address#",$row['address'],$message);
    $message=str_replace("#Manhal_Country#",$row['country'],$message);
    $message=str_replace("#Manhal_City#",$row['city'],$message);
    $message=str_replace("#Manhal_ProductName#",$row['productname'],$message);
    $message=str_replace("#Manhal_Price#",$row['price'],$message);
    $message=str_replace("#Manhal_ShippingPrice#",$row['shippingprice'],$message);
    $message=str_replace("#Manhal_ShippingMethod#",$row['shippingmethod'],$message);
    $message=str_replace("#Manhal_TotalPrice#",$row['totalprice'],$message);
    $message=str_replace("#Manhal_Description#",$row['description'],$message);
    $message=str_replace("#Manhalinvoice_id#",$_SESSION["lang"]."/invoices/".$row['id'],$message);
    $to=$row['email'];
    $subject = 'manhal.com';
    $headers = "From: " . strip_tags(WEBMASTER_EMAIL) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($row['email']) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
    if(mail($to, $subject, $message, $headers)){
        // echo 1;
    }else{
        echo $Lang->CannotSendEmail;
    }
}
function deletepage(){
    global $con;
    if ($result = $con->query("DELETE FROM `pages` WHERE bookid='".$_POST['book_id']."' and pageid='".$_POST['page_id']."'  ")) {
        $file = "../books/".$_POST['book_id']."/".$_POST['page_id'].".jpg";
        if (!unlink($file))
        {
            echo ("Error deleting $file");
        }
        echo 1;
    }
}
function deletequistion(){
    global $con;
    if ($result = $con->query("DELETE FROM `questions` WHERE quizid='".$_POST['quizid']."' and quistionid='".$_POST['quistionid']."'  ")) {
        $arrextantion=['jpg','mp3','mp4'];
        foreach ($arrextantion as $value) {
            $file = "../quiz/" . $_POST['quizid'] . "/" . $_POST['quistionid'] . ".".$value;
            if (!unlink($file)) {
                echo("Error deleting $file");
            }
        }
        echo 1;
    }
}
//start khalid [000001-7-9-2016]
function sortstorypages(){
    global $con;
    $i=0;
    foreach ($_POST['pages'] as $value) {

        if ($result = $con->query("UPDATE `storypages` SET `sort`=".$i." WHERE idstory='".$_POST['id']."' and id='".$value."'")) {
            $i++;
            echo 1;
        }
    }
}
//end khalid [000001-7-9-2016]
function sortpages(){
    global $con;
    $i=0;
    foreach ($_POST['pages'] as $value) {
        if ($result = $con->query("UPDATE `pages` SET `page_sort`=".$i." WHERE bookid='".$_POST['book_id']."' and pageid='".$value."'")) {
            $i++;
            echo 1;
        }
    }
}
function sortquistion(){
    global $con;
    $i=0;
    foreach ($_POST['quistions'] as $value) {
        if ($result = $con->query("UPDATE `questions` SET `quiz_sort`='".$i."' WHERE quizid='".$_POST['Quizid']."' and quistionid='".$value."'")) {
            $i++;
            echo 1;
        }
    }
}
function createuser(){
    global $con;
    $date = date("Y/m/d H:i:s", time());

    $sql ="SELECT * FROM users WHERE uname='".$_POST['user_name']."' ";
    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        echo "1";
        return ;
    }

     $sql = "INSERT INTO users (uname, password, email,permession,cdate,fullname,status)VALUES ('".$_POST['user_name']."', '".$_POST['user_password']."', '".$_POST['user_email']."','".$_POST['user_permession']."','".$date."','".$_POST['user_fullname']."','".$_POST['user_status']."')";

      if ($con->query($sql) === TRUE) {

          $designitem = file_get_contents('../designtxt/admin_user.txt');
          $designitem = str_replace("#userid#", $con->insert_id, $designitem);
          $designitem = str_replace("#username#", $_POST['user_password'], $designitem);
          $designitem = str_replace("#useremail#", $_POST['user_email'], $designitem);
          $designitem = str_replace("#userdate#", $date, $designitem);
          $designitem = str_replace("#fullname#", $_POST['user_fullname'], $designitem);
          $designitem = str_replace("#status#", $_POST['user_status'], $designitem);
          if($_POST['user_permession']==1) {
              $designitem = str_replace("#Permession#",'Admin', $designitem);
          }else{
              $designitem = str_replace("#Permession#",'User', $designitem);
          }
          echo $designitem ;
       } else {
           echo "0";
       }
}
function createbook(){
    global $con;
    $date = date("Y/m/d H:i:s", time());
    $sql = "INSERT INTO `books`(`bookid`, `name`, `category`, `userid`, `width`, `height`, `cdate`, `status`, `note`,`language`,`booktype`) VALUES (null,'".$_POST['book_name']."','".$_POST['Category']."','".$_SESSION["user"]['userid']."','".$_POST['book_width']."','".$_POST['book_height']."','".$date."','0', '','".$_POST['book_lang']."',".$_POST['booktype'].") ";
    if($con->query($sql) === TRUE){
        $newID=$con->insert_id;
        mkdir('../books/'.$newID);
        if(isset($_POST['iscopy']) && $_POST['iscopy']!=""){
            copyFolder('../books/'.$_POST['iscopy'],'../books/'.$newID);
            $sql="SELECT * FROM `pages` WHERE `bookid`=".$_POST['iscopy'];
            $res=$con->query($sql);
            while($row=mysqli_fetch_assoc($res)){
                $sql2="INSERT INTO `pages`(`pageid`, `title`, `subtitle`, `height`, `width`, `is_index`, `html`, `bookid`, `page_sort`) VALUES ('','".mysqli_real_escape_string($con,$row['title'])."','".mysqli_real_escape_string($con,$row['subtitle'])."',".$row['height'].",".$row['width'].",0,'".mysqli_real_escape_string($con,$row['html'])."',$newID,".$row['page_sort'].")";
                $con->query($sql2);
            }
        }
        if(isset($_POST["book_cover"]) && $_POST["book_cover"]!=""){
            saveImageBase64($_POST["book_cover"],"../books/".$newID."/cover.jpg");
            $sql="UPDATE `books` set color='".getImageColor("../books/".$newID."/cover.jpg")."' WHERE bookid=".$newID;
            $con->query($sql);
        }
        echo "1#manhal#seperator#".$newID;
    }else{
       // echo $sql;
        echo 0;
    }
}
function createcategorystories(){
    global $con;
    $date = date("Y/m/d H:i:s", time());
    $sql = "SELECT `catid`, `name_ar`, `name_en`, `thumbnail` FROM `stories_cat` WHERE name_ar='".$_POST['categoryname_ar']."' or name_en='".$_POST['categoryname_en']."'";

    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        echo "2";
        return ;
    }
    $sql = "INSERT INTO `stories_cat`(`catid`, `name_ar`, `name_en`, `thumbnail`) VALUES (null,'".$_POST['categoryname_ar']."','".$_POST['categoryname_en']."',null)";
    if ($con->query($sql) === TRUE) {
        echo "1";
    } else {
        echo "0";
    }
}
function createcategory(){
    global $con;
    $date = date("Y/m/d H:i:s", time());
    $sql = "SELECT `catid`, `name_ar`, `name_en`, `thumbnail` FROM `categories` WHERE name_ar='".$_POST['categoryname_ar']."' or name_en='".$_POST['categoryname_en']."'";

    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        echo "2";
        return ;
    }
    $sql = "INSERT INTO `categories`(`catid`, `name_ar`, `name_en`, `thumbnail`) VALUES (null,'".$_POST['categoryname_ar']."','".$_POST['categoryname_en']."',null)";
    if ($con->query($sql) === TRUE) {
        echo "1";
    } else {
        echo "0";
    }
}

function createdepartment(){
    global $con;
    $date = date("Y/m/d H:i:s", time());
    $sql = "SELECT `catid`, `name_ar`, `name_en`, `thumbnail` FROM `departments` WHERE name_ar='".$_POST['categoryname_ar']."' or name_en='".$_POST['categoryname_en']."'";

    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        echo "2";
        return ;
    }
    $sql = "INSERT INTO `departments`(`catid`, `name_ar`, `name_en`, `thumbnail`,`parent`,`sort`) VALUES (null,'".$_POST['categoryname_ar']."','".$_POST['categoryname_en']."','',0,0)";

    if ($con->query($sql) === TRUE) {
        echo "1";
    } else {
        echo "0";
    }
};
function createbrand(){
    global $con;
    $date = date("Y/m/d H:i:s", time());
    $sql = "SELECT `catid`, `name_ar`, `name_en`, `thumbnail` FROM `brand` WHERE name_ar='".$_POST['categoryname_ar']."' or name_en='".$_POST['categoryname_en']."'";

    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        echo "2";
        return ;
    }
    $sql = "INSERT INTO `brand`(`catid`, `name_ar`, `name_en`, `thumbnail`,`sort`,`parent`) VALUES (null,'".$_POST['categoryname_ar']."','".$_POST['categoryname_en']."','',0,0)";

    if ($con->query($sql) === TRUE) {
        echo "1";
    } else {
        echo "0";
    }
}




function login(){
    global $con;
    //$sql ="SELECT * FROM users WHERE uname='".$_POST['user_name']."' and password='".md5($_POST['user_password'])."' AND status=1";
    $sql ="SELECT * FROM users WHERE (uname='".mysqli_real_escape_string($con,$_POST['user_name'])."' OR email='".mysqli_real_escape_string($con,$_POST['user_name'])."') and password='".$_POST['user_password']."' AND status=1";
    $result = $con->query($sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION["user"]=$row;
        echo $_SESSION["user"]['permession']   ;
    }
}
function copyFolder($src, $dst, $temp = 0){
    $dir = opendir($src);
    @mkdir($dst);
    while (false !== ($file = readdir($dir))){
        if (($file != '.') && ($file != '..')){
            if (is_dir($src . '/' . $file)){
                copyFolder($src . '/' . $file, $dst . '/' . $file);
            }else{
                copy($src . '/' . $file, $dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}
function deleteDirectory($dir){
    if (!file_exists($dir)) return true;
    if (!is_dir($dir) || is_link($dir)) return unlink($dir);
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') continue;
        if (!deleteDirectory($dir . "/" . $item)) {
            chmod($dir . "/" . $item, 0777);
            if (!deleteDirectory($dir . "/" . $item)) return false;
        };
    }
    return @rmdir($dir);
}
function deletefile(){
    if (!file_exists($_POST['file'])) return true;
    unlink($_POST['file']);
}
function updateGames(){
    global $con;
    $data=' ';
    if(isset($_POST['data'])){
        $data=$_POST['data'];
    }

    if ($con->query("UPDATE `editors` SET `data`='".mysqli_real_escape_string($con,$data)."' WHERE `gameid`=".$_POST['id'])) {
        echo 1;
    }else{
        echo 0;
    }
}

?>