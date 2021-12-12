<?php

/**

 * Created by PhpStorm.

 * User: khalid alomiri

 * Date: 09/04/2017

 * Time: 03:33 م

 */



header("Access-Control-Allow-Origin: *");

header('Content-Type: application/json');

include_once("../config.php");

if (isset($_POST['TypeProcesses']) && $_POST['TypeProcesses'] != "") {

    $_POST['TypeProcesses']();
}



function checkshowroomrating()
{

    global $con;

    $email = $_POST['email'];

    $showroom = $_POST['showroom'];



    $sql = "SELECT Count(email) As count FROM `rating_showroom` WHERE `email`='" . $email . "' AND `showroom`='" . $showroom . "'";

    $result = $con->query($sql);

    $row = mysqli_fetch_assoc($result);

    if ($row['count'] == 0) {

        echo 0;

    } else {

        echo 1;

    }

}



function showroomrating()

{

    global $con;
    $myObj='';
    $myObj->result = 0;
    $myObj->msg = 'not rating';
    $myObj->data = "";
    $email ='';
    $age = 0;
    $sex = 0;
    $telephone = '';
    $job = 0;
    $msg = 0;

    if (isset($_POST['job']) && $_POST['job'] != '') {

        $job = $_POST['job'];

    }
    if(isset($_POST['email'])&& $_POST['email'] != ''){
        $email = $_POST['email'];

    }
    if(isset($_POST['age'])&& $_POST['age'] != ''){
        $age = $_POST['age'];
    }
    if(isset($_POST['sex'])&& $_POST['sex'] != ''){
        $sex = $_POST['sex'];
    }
    if(isset($_POST['telephone'])&& $_POST['telephone'] != ''){
        $telephone = $_POST['telephone'];
    }


//    if($telephone == '' && $email == ''){
//        echo  'errorregisteredemail';
//        return 'errorregisteredemail';
//        exit;
//    }


    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $type = $_POST['type'];
    $showroom = $_POST['showroom'];
    $date = date("Y/m/d H:i:s", time());

    if (isset($_POST['msg']) && $_POST['msg'] != '') {
        $msg = $_POST['msg'];
    }

    $sqlinsert = "INSERT INTO `rating_showroom`(`id`, `name`, `email`, `age`, `sex`, `telephone`, `rate`, `showroom`, `type`, `msg`, `date`,`job`) VALUES ('','" . $name . "','" . $email . "','" . $age . "','" . $sex . "','" . $telephone . "','" . $rating . "','" . $showroom . "','" . $type . "','" . $msg . "','" . $date . "','" . $job . "')";


     $check=$con->query($sqlinsert);




    if ($check === TRUE) {

        $myObj->result = 1;
        $myObj->msg = 'success';
        $myObj->data = "";

    }




    $myJSON = json_encode($myObj);

    echo $myJSON;

    $id = mysqli_insert_id($con);

    if (isset($_POST['datafile']) && $_POST['datafile'] != '') {



        $img = $_POST['datafile'];



        list($type2, $imageData) = explode(';', $img);

        list(, $extension) = explode('/', $type2);

        list(, $imageData) = explode(',', $imageData);

        $imageData = base64_decode($imageData);

    }

    if(!is_dir('../ratingmediashowroom/' . $showroom )){
        mkdir('../ratingmediashowroom/' . $showroom );
    }

    if ($type == 'png') {

        file_put_contents('../ratingmediashowroom/' . $showroom . '/' . $id . '.png', $imageData);

    } else if ($type == 'mp3') {

        file_put_contents('../ratingmediashowroom/' . $showroom . '/' . $id . '.mp3', $imageData);

    }
    else if ($type == 'aac') {

        file_put_contents('../ratingmediashowroom/' . $showroom . '/' . $id . '.aac', $imageData);

    }
    else if ($type == 'mp4') {

        file_put_contents('../ratingmediashowroom/' . $showroom . '/' . $id . '.mp4', $imageData);

    }



    $date = date('d/m/Y');

    $time = date('H:i:s');



    $emailbody = "<p> Dear  ".$name." </p>

                  <p>Thank you for taking the time to post your ratings and feedback on our services. </p>";



    $to = $email;

    $from = CONTACT_EMAIL;

    $reply = CONTACT_EMAIL;

    $subject = 'Rating';

    $headers = "From: $from\n";

    $headers .= "Reply-To: $reply\n";

    $headers .= "MIME-Version: 1.0\n";

    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";

    @mail($to, $subject, $emailbody, $headers);



}



function filter(){
    global $con;
    $keyword_filter = "";
    $showroom_filter = '';
    $rate_filter="";
    $type_filter="";
    $gender_filter="";
    $age_filter="";
    $date_filter="";

    if (isset($_POST['keywords']) && $_POST['keywords'] != "") {
        $keyword_filter = " AND ( `name` LIKE '%" . mysqli_real_escape_string($con, $_POST['keywords']) . "%' OR `email` LIKE '%" . mysqli_real_escape_string($con, $_POST['keywords']) . "%' OR `telephone` LIKE '%" . mysqli_real_escape_string($con, $_POST['keywords']) . "%' OR `msg` LIKE '%" . mysqli_real_escape_string($con, $_POST['keywords']) . "%'  )";
    }
    if (isset($_POST['showroom']) && $_POST['showroom'] != '') {
        $showroom_filter = " AND `showroom` = " . $_POST['showroom'];
    }
    if (isset($_POST['rate']) && $_POST['rate'] != '') {
        $rate_filter = " AND `rate` = " . $_POST['rate'];
    }
    if (isset($_POST['type']) && $_POST['type'] != '') {
        $type_filter = " AND `type` = '" . $_POST['type']."'";
    }
    if (isset($_POST['gender']) && $_POST['gender'] != '') {
        $gender_filter = " AND `sex` = " . $_POST['gender'];
    }
    if (isset($_POST['fromage']) && $_POST['fromage'] != '' && isset($_POST['toage']) && $_POST['toage'] != '' ) {
        $age_filter = " AND `age` BETWEEN '" . $_POST['fromage']."' AND '".$_POST['toage']."'";
    }
    if (isset($_POST['fromdate']) && $_POST['fromdate'] != '' && isset($_POST['todate']) && $_POST['todate'] != '') {
        $age_filter = " AND `date` BETWEEN '" . $_POST['fromdate'] ."' AND '".$_POST['todate']."'";
    }
    $begin=$_POST['page']*$_POST['itemperpage']-($_POST['itemperpage']);
    $LIMIT=" LIMIT " . $begin . ", " . $_POST['itemperpage'];
    $sql = "SELECT * FROM `rating_showroom` WHERE `id` > 0  ".$keyword_filter.$showroom_filter.$rate_filter.$type_filter.$gender_filter.$age_filter.$date_filter." order by `id` DESC";
    $result = $con->query($sql);
    $num_rows = mysqli_num_rows($result);
    $Pages_number=ceil($num_rows/$_POST['itemperpage']);
    $sql = "SELECT * FROM `rating_showroom` WHERE `id` > 0  ".$keyword_filter.$showroom_filter.$rate_filter.$type_filter.$gender_filter.$age_filter.$date_filter." order by `id` DESC ".$LIMIT;

    $result = $con->query($sql);

    $array=[];

    $array[0]=$Pages_number;

    $array[1]=[];

    $array[2]=$num_rows;

    while ($data = mysqli_fetch_assoc($result)) {

        $array[1][]=$data;

    }



    echo json_encode($array);

}