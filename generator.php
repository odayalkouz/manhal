<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 9/22/2016
 * Time: 4:51 PM
 */
include_once "platform/config.php";
//exit();
//
//for($i=1;$i<=500;$i++){
//    $uname='care'.$i;
//    $pass='123care';
//    $email=$uname.'@manhal.com';
//    $sql="INSERT INTO `users`(`uname`, `password`, `email`, `permession`, `cdate`,`status`,`views_count`, `sales_count`, `country`,`activation_code`)
//VALUES ('".$uname."','".$pass."','".$email."',10,CURDATE(),1,0,0,'JO','11531251451235')";
//    $con->query($sql);
//}

for($i=1;$i<=2;$i++){
    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`,`note`) VALUES ('','2021-01-20','2022-01-21','teacherbook',816,0,1,'',CURDATE(),1,'216')";
    $con->query($sql);

    $id=mysqli_insert_id($con);

    $code = substr($id, -4);
    $code=str_pad($code, 4, '0', STR_PAD_LEFT);
    $month=date("m");
    $year=date("y");
    $digits = 3;
    $code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
    echo $code." -- 816 <br>";
    $sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
    $con->query($sql);
}
//for($i=1;$i<=40;$i++){
////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`, `code`) VALUES ('','1-11-2016','1-11-2100','series',122,0,1,'',[value-9])";
//    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2019-09-07','2020-09-07','book',774,0,1,'',CURDATE(),1)";
//    $con->query($sql);
//
//    $id=mysqli_insert_id($con);
//
//    $code = substr($id, -4);
//    $code=str_pad($code, 4, '0', STR_PAD_LEFT);
//    $month=date("m");
//    $year=date("y");
//    $digits = 3;
//    $code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//    echo $code."  >> العب وتعلم مع الحروف 1 - 774 "."<br>";
//    $sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//    $con->query($sql);
//
//}
//
//
//echo "نادي الرياضيات 1";
//for($i=1;$i<=33;$i++){
////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`, `code`) VALUES ('','1-11-2016','1-11-2100','series',122,0,1,'',[value-9])";
//    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2020-09-05','2021-09-05','book',547,0,1,'',CURDATE(),1)";
//    $con->query($sql);
//
//    $id=mysqli_insert_id($con);
//
//    $code = substr($id, -4);
//    $code=str_pad($code, 4, '0', STR_PAD_LEFT);
//    $month=date("m");
//    $year=date("y");
//    $digits = 3;
//    $code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//    echo $code."<br>";
//    $sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//    $con->query($sql);
//
//}

//
//
//
//$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2019-09-11','2020-09-11','book',133,0,8000,'',CURDATE(),1)";
//$con->query($sql);
//
//$id=mysqli_insert_id($con);
//
//$code = substr($id, -4);
//$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//$month=date("m");
//$year=date("y");
//$digits = 3;
//$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//echo $code."  >> 133 "."<br>";
//$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//$con->query($sql);
//

//
//$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2019-04-24','2020-09-30','book',664,0,500,'',CURDATE(),1)";
//$con->query($sql);
//
//$id=mysqli_insert_id($con);
//
//$code = substr($id, -4);
//$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//$month=date("m");
//$year=date("y");
//$digits = 3;
//$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//echo $code."  >> 664 "."<br>";
//$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//$con->query($sql);
//
//
//$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2019-04-24','2020-09-30','book',578,0,500,'',CURDATE(),1)";
//$con->query($sql);
//
//$id=mysqli_insert_id($con);
//
//$code = substr($id, -4);
//$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//$month=date("m");
//$year=date("y");
//$digits = 3;
//$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//echo $code."  >> 578 "."<br>";
//$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//$con->query($sql);
//
//
//
//
//
//
//$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2019-04-24','2020-09-30','book',575,0,500,'',CURDATE(),1)";
//$con->query($sql);
//
//$id=mysqli_insert_id($con);
//
//$code = substr($id, -4);
//$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//$month=date("m");
//$year=date("y");
//$digits = 3;
//$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//echo $code."  >> 575 "."<br>";
//$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//$con->query($sql);
//
//
//
//
//
//
//
//
//$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2019-04-24','2020-09-30','book',667,0,2000,'',CURDATE(),1)";
//$con->query($sql);
//
//$id=mysqli_insert_id($con);
//
//$code = substr($id, -4);
//$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//$month=date("m");
//$year=date("y");
//$digits = 3;
//$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//echo $code."  >> 667 "."<br>";
//$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//$con->query($sql);
//
//
//
//
//
//
//
//
//$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2019-04-24','2020-09-30','book',580,0,2000,'',CURDATE(),1)";
//$con->query($sql);
//
//$id=mysqli_insert_id($con);
//
//$code = substr($id, -4);
//$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//$month=date("m");
//$year=date("y");
//$digits = 3;
//$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//echo $code."  >> 580 "."<br>";
//$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//$con->query($sql);
//
//
//
//
//
//
//
//$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2019-04-24','2020-09-30','book',582,0,2000,'',CURDATE(),1)";
//$con->query($sql);
//
//$id=mysqli_insert_id($con);
//
//$code = substr($id, -4);
//$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//$month=date("m");
//$year=date("y");
//$digits = 3;
//$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//echo $code."  >> 582 "."<br>";
//$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//$con->query($sql);
//
//
//
//
//
//
//
//
//
//
//$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2019-04-24','2020-09-30','book',579,0,2000,'',CURDATE(),1)";
//$con->query($sql);
//
//$id=mysqli_insert_id($con);
//
//$code = substr($id, -4);
//$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//$month=date("m");
//$year=date("y");
//$digits = 3;
//$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//echo $code."  >> 579 "."<br>";
//$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//$con->query($sql);
//
//
//
//
//
//
//
//
//
//
//$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2019-04-24','2020-09-30','book',585,0,2000,'',CURDATE(),1)";
//$con->query($sql);
//
//$id=mysqli_insert_id($con);
//
//$code = substr($id, -4);
//$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//$month=date("m");
//$year=date("y");
//$digits = 3;
//$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//echo $code."  >> 585 "."<br>";
//$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//$con->query($sql);
//
//
//
//
//
//
//
//
//
//
//
//
//$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2019-04-24','2020-09-30','book',584,0,2000,'',CURDATE(),1)";
//$con->query($sql);
//
//$id=mysqli_insert_id($con);
//
//$code = substr($id, -4);
//$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//$month=date("m");
//$year=date("y");
//$digits = 3;
//$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//echo $code."  >> 584 "."<br>";
//$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//$con->query($sql);
//
//
//
//
//
//
//
//
//
//
//
//$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2019-04-24','2020-09-30','book',586,0,2000,'',CURDATE(),1)";
//$con->query($sql);
//
//$id=mysqli_insert_id($con);
//
//$code = substr($id, -4);
//$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//$month=date("m");
//$year=date("y");
//$digits = 3;
//$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//echo $code."  >> 586 "."<br>";
//$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//$con->query($sql);
//
//
//
//
//
//
//
//
//
//
//$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2019-04-24','2020-09-30','book',583,0,2000,'',CURDATE(),1)";
//$con->query($sql);
//
//$id=mysqli_insert_id($con);
//
//$code = substr($id, -4);
//$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//$month=date("m");
//$year=date("y");
//$digits = 3;
//$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//echo $code."  >> 583 "."<br>";
//$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//$con->query($sql);
//
//
//
//
//
//










//
//$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2019-02-12','2020-02-12','book',650,0,1,'',CURDATE(),1)";
//$con->query($sql);
//
//$id=mysqli_insert_id($con);
//
//$code = substr($id, -4);
//$code=str_pad( $code, 4, '0', STR_PAD_LEFT);
//$month=date("m");
//$year=date("y");
//$digits = 3;
//$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//echo $code."  >> 442 "."<br>";
//$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//$con->query($sql);

//
//$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2019-01-22','2020-01-31','book',762,0,3000,'',CURDATE(),1)";
//$con->query($sql);
//
//$id=mysqli_insert_id($con);
//
//$code = substr($id, -4);
//$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//$month=date("m");
//$year=date("y");
//$digits = 3;
//$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//echo $code."  >> 762 "."<br>";
//$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//$con->query($sql);
//
//
//$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2019-01-22','2020-01-31','book',656,0,2000,'',CURDATE(),1)";
//$con->query($sql);
//
//$id=mysqli_insert_id($con);
//
//$code = substr($id, -4);
//$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//$month=date("m");
//$year=date("y");
//$digits = 3;
//$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//echo $code."  >> 656 "."<br>";
//$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//$con->query($sql);
//
//
////for($i=1;$i<=100;$i++){
//////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`, `code`) VALUES ('','1-11-2016','1-11-2100','series',122,0,1,'',[value-9])";
////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2018-11-20','2100-11-01','book',842,0,1,'',CURDATE(),1)";
////    $con->query($sql);
////
////    $id=mysqli_insert_id($con);
////
////    $code = substr($id, -4);
////    $code=str_pad($code, 4, '0', STR_PAD_LEFT);
////    $month=date("m");
////    $year=date("y");
////    $digits = 3;
////    $code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
////    echo $code."  >> 842 "."<br>";
////    $sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
////    $con->query($sql);
////
////}
////
////
////for($i=1;$i<=50;$i++){
//////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`, `code`) VALUES ('','1-11-2016','1-11-2100','series',122,0,1,'',[value-9])";
////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2018-11-20','2100-11-01','series',68,0,1,'',CURDATE(),0)";
////    $con->query($sql);
////
////    $id=mysqli_insert_id($con);
////
////    $code = substr($id, -4);
////    $code=str_pad($code, 4, '0', STR_PAD_LEFT);
////    $month=date("m");
////    $year=date("y");
////    $digits = 3;
////    $code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
////    echo $code."  >> dino english 68 "."<br>";
////    $sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
////    $con->query($sql);
////
////}
////
////for($i=1;$i<=50;$i++){
//////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`, `code`) VALUES ('','1-11-2016','1-11-2100','series',122,0,1,'',[value-9])";
////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2018-11-20','2100-11-01','series',64,0,1,'',CURDATE(),0)";
////    $con->query($sql);
////
////    $id=mysqli_insert_id($con);
////
////    $code = substr($id, -4);
////    $code=str_pad($code, 4, '0', STR_PAD_LEFT);
////    $month=date("m");
////    $year=date("y");
////    $digits = 3;
////    $code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
////    echo $code."  >> نادي القراء المستوى الثاني 64 "."<br>";
////    $sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
////    $con->query($sql);
////
////}
////
////for($i=1;$i<=50;$i++){
//////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`, `code`) VALUES ('','1-11-2016','1-11-2100','series',122,0,1,'',[value-9])";
////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2018-11-20','2100-11-01','series',71,0,1,'',CURDATE(),0)";
////    $con->query($sql);
////
////    $id=mysqli_insert_id($con);
////
////    $code = substr($id, -4);
////    $code=str_pad($code, 4, '0', STR_PAD_LEFT);
////    $month=date("m");
////    $year=date("y");
////    $digits = 3;
////    $code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
////    echo $code."71  حقيبتي الجديدة"."<br>";
////    $sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
////    $con->query($sql);
////
////}
////
////for($i=1;$i<=50;$i++){
//////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`, `code`) VALUES ('','1-11-2016','1-11-2100','series',122,0,1,'',[value-9])";
////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2018-11-20','2100-11-01','series',109,0,1,'',CURDATE(),0)";
////    $con->query($sql);
////
////    $id=mysqli_insert_id($con);
////
////    $code = substr($id, -4);
////    $code=str_pad($code, 4, '0', STR_PAD_LEFT);
////    $month=date("m");
////    $year=date("y");
////    $digits = 3;
////    $code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
////    echo $code."  >> سلسلة الزرافة المجموعة الأولى 109 "."<br>";
////    $sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
////    $con->query($sql);
////
////}
////
////
////for($i=1;$i<=50;$i++){
//////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`, `code`) VALUES ('','1-11-2016','1-11-2100','series',122,0,1,'',[value-9])";
////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2018-11-20','2100-11-01','series',110,0,1,'',CURDATE(),0)";
////    $con->query($sql);
////
////    $id=mysqli_insert_id($con);
////
////    $code = substr($id, -4);
////    $code=str_pad($code, 4, '0', STR_PAD_LEFT);
////    $month=date("m");
////    $year=date("y");
////    $digits = 3;
////    $code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
////    echo $code."  >> سلسلة الزرافة المجموعة الثانية 110 "."<br>";
////    $sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
////    $con->query($sql);
////
////}
////
////for($i=1;$i<=50;$i++){
//////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`, `code`) VALUES ('','1-11-2016','1-11-2100','series',122,0,1,'',[value-9])";
////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2018-11-20','2100-11-01','series',111,0,1,'',CURDATE(),0)";
////    $con->query($sql);
////
////    $id=mysqli_insert_id($con);
////
////    $code = substr($id, -4);
////    $code=str_pad($code, 4, '0', STR_PAD_LEFT);
////    $month=date("m");
////    $year=date("y");
////    $digits = 3;
////    $code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
////    echo $code."  >> سلسلة الزرافة المجموعة الثالثة 111 "."<br>";
////    $sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
////    $con->query($sql);
////
////}
////
////
////for($i=1;$i<=50;$i++){
//////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`, `code`) VALUES ('','1-11-2016','1-11-2100','series',122,0,1,'',[value-9])";
////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2018-11-20','2100-11-01','series',122,0,1,'',CURDATE(),0)";
////    $con->query($sql);
////
////    $id=mysqli_insert_id($con);
////
////    $code = substr($id, -4);
////    $code=str_pad($code, 4, '0', STR_PAD_LEFT);
////    $month=date("m");
////    $year=date("y");
////    $digits = 3;
////    $code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
////    echo $code." سلسلة الذكاء المتعدد 122"."<br>";
////    $sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
////    $con->query($sql);
////
////}
////
////
////for($i=1;$i<=50;$i++){
//////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`, `code`) VALUES ('','1-11-2016','1-11-2100','series',122,0,1,'',[value-9])";
////    $sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2018-11-20','2100-11-01','series',156,0,1,'',CURDATE(),0)";
////    $con->query($sql);
////
////    $id=mysqli_insert_id($con);
////
////    $code = substr($id, -4);
////    $code=str_pad($code, 4, '0', STR_PAD_LEFT);
////    $month=date("m");
////    $year=date("y");
////    $digits = 3;
////    $code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
////    echo $code." سلسلة حكايات الحروف 156"."<br>";
////    $sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
////    $con->query($sql);
////
////}
//////
//////
//////$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2017-03-22','2100-11-01','teacherbook',680,0,1000,'',CURDATE(),0)";
//////$con->query($sql);
//////
//////$id=mysqli_insert_id($con);
//////
//////$code = substr($id, -4);
//////$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//////$month=date("m");
//////$year=date("y");
//////$digits = 3;
//////$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//////echo $code."  >> 680 "."<br>";
//////$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//////$con->query($sql);
////
//////
//////$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2017-03-22','2100-11-01','teacherbook',591,0,1000,'',CURDATE(),0)";
//////$con->query($sql);
//////
//////$id=mysqli_insert_id($con);
//////
//////$code = substr($id, -4);
//////$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//////$month=date("m");
//////$year=date("y");
//////$digits = 3;
//////$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//////echo $code."  >> 591 "."<br>";
//////$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//////$con->query($sql);
//////
//////$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2017-03-22','2100-11-01','teacherbook',592,0,1000,'',CURDATE(),0)";
//////$con->query($sql);
//////
//////$id=mysqli_insert_id($con);
//////
//////$code = substr($id, -4);
//////$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//////$month=date("m");
//////$year=date("y");
//////$digits = 3;
//////$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
//////echo $code."  >> 592 "."<br>";
//////$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
//////$con->query($sql);
//////
//////
//////$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2017-03-22','2100-11-01','teacherbook',593,0,1000,'',CURDATE(),0)";
//////$con->query($sql);
//////
//////$id=mysqli_insert_id($con);
//////
//////$code = substr($id, -4);
//////$code=str_pad($code, 4, '0', STR_PAD_LEFT);
//////$month=date("m");
////$year=date("y");
////$digits = 3;
////$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
////echo $code."  >> 593 "."<br>";
////$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
////$con->query($sql);
////
////$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2017-03-22','2100-11-01','teacherbook',594,0,1000,'',CURDATE(),0)";
////$con->query($sql);
////
////$id=mysqli_insert_id($con);
////
////$code = substr($id, -4);
////$code=str_pad($code, 4, '0', STR_PAD_LEFT);
////$month=date("m");
////$year=date("y");
////$digits = 3;
////$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
////echo $code."  >> 594 "."<br>";
////$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
////$con->query($sql);
////
////$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2017-03-22','2100-11-01','teacherbook',603,0,1000,'',CURDATE(),0)";
////$con->query($sql);
////
////$id=mysqli_insert_id($con);
////
////$code = substr($id, -4);
////$code=str_pad($code, 4, '0', STR_PAD_LEFT);
////$month=date("m");
////$year=date("y");
////$digits = 3;
////$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
////echo $code."  >> 603 "."<br>";
////$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
////$con->query($sql);
////
////$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2017-03-22','2100-11-01','teacherbook',604,0,1000,'',CURDATE(),0)";
////$con->query($sql);
////
////$id=mysqli_insert_id($con);
////
////$code = substr($id, -4);
////$code=str_pad($code, 4, '0', STR_PAD_LEFT);
////$month=date("m");
////$year=date("y");
////$digits = 3;
////$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
////echo $code."  >> 604 "."<br>";
////$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
////$con->query($sql);
////
////$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2017-03-22','2100-11-01','teacherbook',605,0,1000,'',CURDATE(),0)";
////$con->query($sql);
////
////$id=mysqli_insert_id($con);
////
////$code = substr($id, -4);
////$code=str_pad($code, 4, '0', STR_PAD_LEFT);
////$month=date("m");
////$year=date("y");
////$digits = 3;
////$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
////echo $code."  >> 605 "."<br>";
////$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
////$con->query($sql);
////
////$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2017-03-22','2100-11-01','teacherbook',606,0,1000,'',CURDATE(),0)";
////$con->query($sql);
////
////$id=mysqli_insert_id($con);
////
////$code = substr($id, -4);
////$code=str_pad($code, 4, '0', STR_PAD_LEFT);
////$month=date("m");
////$year=date("y");
////$digits = 3;
////$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
////echo $code."  >> 606 "."<br>";
////$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
////$con->query($sql);
////
////$sql="INSERT INTO `apps_codes`(`codeid`, `startdate`, `enddate`, `type`, `refid`, `userid`, `countofuser`, `email`,`generated_date`,`status`) VALUES ('','2017-03-22','2100-11-01','teacherbook',607,0,1000,'',CURDATE(),0)";
////$con->query($sql);
////
////$id=mysqli_insert_id($con);
////
////$code = substr($id, -4);
////$code=str_pad($code, 4, '0', STR_PAD_LEFT);
////$month=date("m");
////$year=date("y");
////$digits = 3;
////$code=$year.rand(pow(10, $digits-1), pow(10, $digits)-1).$code.rand(pow(10, $digits-1), pow(10, $digits)-1).$month;
////echo $code."  >> 607 "."<br>";
////$sql="UPDATE `apps_codes` SET `code`='".$code."' WHERE `codeid`=".$id;
////$con->query($sql);
//
//
//?>