<?php

/**

 * Created by Dar Almanhal - Hussam Abu Khadijeh.

 * User: Hussam Abu Khadijeh

 * Date: 17/01/2017

 * Time: 11:21 AM

 */



include_once "platform/config.php";



$sql="DELETE  FROM `counters`";

$con->query($sql);



//for books

$sql="SELECT count(bookid) as productcount ,`categories`.* FROM `categories` LEFT OUTER JOIN `books` ON `categories`.`catid`=`books`.`category` WHERE `books`.`status`=1 GROUP BY `categories`.`catid`";

$result=$con->query($sql);

while($row=mysqli_fetch_assoc($result)){

    $sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','books',".$row['catid'].",".$row['productcount'].")";

    $con->query($sql);

    $sql="UPDATE `categories` SET `count`=".$row['productcount']." WHERE `catid`=".$row['catid'];

    $con->query($sql);

}



//for all books

$sql="SELECT count(bookid) as productcount  FROM  `books` WHERE `books`.`status`=1 ";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','books','-1',".$row['productcount'].")";

$con->query($sql);



//for electornic books

$sql="SELECT count(bookid) as productcount  FROM `books` WHERE `books`.`status`=1 AND  booktype in(2,3,6,7)";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','ebooks',-1,".$row['productcount'].")";

$con->query($sql);



//for interactive books

$sql="SELECT count(bookid) as productcount  FROM `books` WHERE `books`.`status`=1 AND `books`.`booktype` in(4,5,6,7)";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','ibooks',-1,".$row['productcount'].")";

$con->query($sql);



//for stories

$sql="SELECT count(storyid) as productcount ,`stories_cat`.* FROM `stories_cat` LEFT OUTER JOIN `story` ON `stories_cat`.`catid`=`story`.`catid` WHERE `story`.`status`=1 GROUP BY `stories_cat`.`catid`";

$result=$con->query($sql);

while($row=mysqli_fetch_assoc($result)){

    $sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','stories',".$row['catid'].",".$row['productcount'].")";

    $con->query($sql);

    $sql="UPDATE `stories_cat` SET `count`=".$row['productcount']." WHERE `catid`=".$row['catid'];

    $con->query($sql);

}



//for electornic stories

$sql="SELECT count(storyid) as productcount  FROM `story` WHERE `story`.`status`=1 AND `story`.`type`in(2,3,6,7)";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','estories',-1,".$row['productcount'].")";

$con->query($sql);



//for all stories

$sql="SELECT count(storyid) as productcount  FROM `story` WHERE `story`.`status`=1 AND  `type` in(1,3,5,7) ";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','stories',-1,".$row['productcount'].")";

$con->query($sql);



//for interactive stories

$sql="SELECT count(storyid) as productcount  FROM `story` WHERE `story`.`status`=1 AND `story`.`type` in(4,5,6,7)";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','istories',-1,".$row['productcount'].")";

$con->query($sql);





//for worksheets

$sql="SELECT count(id) as productcount ,`categories`.* FROM `categories` LEFT OUTER JOIN `media` ON `categories`.`catid`=`media`.`category` WHERE `media`.`status`=1 AND `media`.`type`=0  GROUP BY `categories`.`catid`";

$result=$con->query($sql);

while($row=mysqli_fetch_assoc($result)){

    $sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','worksheets',".$row['catid'].",".$row['productcount'].")";

    $con->query($sql);

    $sql="UPDATE `categories` SET `wcount`=".$row['productcount']." WHERE `catid`=".$row['catid'];

    $con->query($sql);

}

//for Games

$sql="SELECT count(id) as productcount ,`categories`.* FROM `categories` LEFT OUTER JOIN `media` ON `categories`.`catid`=`media`.`category` WHERE `media`.`status`=1 AND `media`.`type`=11  GROUP BY `categories`.`catid`";

$result=$con->query($sql);

while($row=mysqli_fetch_assoc($result)){

    $sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','games',".$row['catid'].",".$row['productcount'].")";

    $con->query($sql);

    $sql="UPDATE `categories` SET `Gcount`=".$row['productcount']." WHERE `catid`=".$row['catid'];

    $con->query($sql);

}
//for Video

$sql="SELECT count(id) as productcount ,`categories`.* FROM `categories` LEFT OUTER JOIN `media` ON `categories`.`catid`=`media`.`category` WHERE `media`.`status`=1 AND `media`.`type`=4  GROUP BY `categories`.`catid`";

$result=$con->query($sql);

while($row=mysqli_fetch_assoc($result)){

    $sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','videos',".$row['catid'].",".$row['productcount'].")";

    $con->query($sql);

    $sql="UPDATE `categories` SET `Vcount`=".$row['productcount']." WHERE `catid`=".$row['catid'];

    $con->query($sql);

}
//worksheets

$sql="SELECT count(`id`) as productcount FROM `media` WHERE `media`.`status`=1 AND `type`=0";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','worksheets',-1,".$row['productcount'].")";

$con->query($sql);



//coloring worksheets

$sql="SELECT count(`id`) as productcount FROM `media` WHERE `media`.`status`=1 AND `type`=0 and category=11";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','cworksheets',-1,".$row['productcount'].")";

$con->query($sql);



//lessons

$sql="SELECT count(`id`) as productcount FROM `media` WHERE `media`.`status`=1 AND `type`=2";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','lessons',-1,".$row['productcount'].")";

$con->query($sql);



//sounds

$sql="SELECT count(`id`) as productcount FROM `media` WHERE `media`.`status`=1 AND `type`=3";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','sounds',-1,".$row['productcount'].")";

$con->query($sql);



//videos

$sql="SELECT count(`id`) as productcount FROM `media` WHERE `media`.`status`=1 AND `type`=4";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','videos',-1,".$row['productcount'].")";

$con->query($sql);



//excesises

$sql="SELECT count(`id`) as productcount FROM `media` WHERE `media`.`status`=1 AND  `type`=6";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','excesises',-1,".$row['productcount'].")";

$con->query($sql);



//CDs

$sql="SELECT count(`id`) as productcount FROM `media` WHERE  `media`.`status`=1 AND `type`=7";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','cd',-1,".$row['productcount'].")";

$con->query($sql);



//flashs

$sql="SELECT count(`id`) as productcount FROM `media` WHERE `media`.`status`=1 AND `type`=8";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','flash',-1,".$row['productcount'].")";

$con->query($sql);



//flash cards

$sql="SELECT count(`id`) as productcount FROM `media` WHERE `media`.`status`=1 AND `type`=9";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','flashcards',-1,".$row['productcount'].")";

$con->query($sql);



//lectures

$sql="SELECT count(`id`) as productcount FROM `media` WHERE `media`.`status`=1 AND `type`=10";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','lectures',-1,".$row['productcount'].")";

$con->query($sql);



//games

$sql="SELECT count(`id`) as productcount FROM `media` WHERE `media`.`status`=1 AND `type`=11";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','games',-1,".$row['productcount'].")";

$con->query($sql);



//interactive worksheets

$sql="SELECT count(`id`) as productcount FROM `media` WHERE `media`.`status`=1 AND `type`=12";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','iworksheets',-1,".$row['productcount'].")";

$con->query($sql);



//education tools

$sql="SELECT count(`id`) as productcount FROM `media` WHERE  `media`.`status`=1 AND `type`=13";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','educationtools',-1,".$row['productcount'].")";

$con->query($sql);



//Teacher's Guide

$sql="SELECT count(`bookid`) as productcount FROM `books` WHERE  `books`.`status` =1 AND `books`.`isteacherbook`=1 AND `books`.`bookid`>0";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','teachersguid',-1,".$row['productcount'].")";

$con->query($sql);



//Ministry Approval

$sql="SELECT count(`id`) as productcount FROM `media` WHERE  `media`.`status`=1 AND `type`=15";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','approvals',-1,".$row['productcount'].")";

$con->query($sql);



//curriculum Plans

$sql="SELECT count(`id`) as productcount FROM `media` WHERE  `media`.`status`=1 AND `type`=16";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','plans',-1,".$row['productcount'].")";

$con->query($sql);



//curriculum series

$sql="SELECT count(seriesid) as productcount FROM `series` ";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','series',-1,".$row['productcount'].")";

$con->query($sql);

//curriculum quiz

$sql="SELECT count(`quizid`) as productcount FROM `quiz` WHERE `quiz`.`is_public`=1  ";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','excesises',-1,".$row['productcount'].")";

$con->query($sql);



//curriculum series

$sql="SELECT Count(users.userid) As productcount FROM `users` ";

$result=$con->query($sql);

$row=mysqli_fetch_assoc($result);

$sql="INSERT INTO `counters`(`id`, `product`, `category`, `count`) VALUES ('','users',-1,".$row['productcount'].")";

$con->query($sql);

?>