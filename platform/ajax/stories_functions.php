<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/7/2016
 * Time: 8:29 AM
 */
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
if(!isset($_SESSION['user']['userid']) || $_SESSION['user']['userid']==""){
    echo "Secured";
    exit();
}

include_once "../config.php";
include_once "../includes/function.php";
include_once "../../includes/function.php";

$Lang = simplexml_load_file("../../language/".$_SESSION["lang"].".xml");

if(isset($_GET['process']) && $_GET['process']!=""){
    $_GET['process']();
}

function publishstory(){
    global $con;
    $sql="SELECT count(storyid) as storycount from story WHERE seriesid=".$_GET["seriesid"]." AND storyid<".$_GET["storyid"];
    $result=$con->query($sql);
    if(mysqli_num_rows($result)>0){
        $row=mysqli_fetch_assoc($result);
        $number=$row['storycount']+1;
    }else{
        $number=1;
    }
    publishstoryData($_GET["storyid"],$_GET["seriesid"],$number);
    echo 1;
}

function publishstoryData($storyID,$seriesID,$storyNumber){
    global $con;
    if(!is_dir("../stories/published/".$seriesID)){
        @mkdir("../stories/published/".$seriesID);
    }
    if(!is_dir("../stories/published/".$seriesID."/story/")){
        @mkdir("../stories/published/".$seriesID."/story/");
    }
    if(!is_dir("../stories/published/".$seriesID."/story/st".$storyNumber)){
        @mkdir("../stories/published/".$seriesID."/story/st".$storyNumber);
    }
    if(!is_dir("../stories/published/".$seriesID."/story/st".$storyNumber."/images")){
        @mkdir("../stories/published/".$seriesID."/story/st".$storyNumber."/images");
    }
    if(!is_dir("../stories/published/".$seriesID."/story/st".$storyNumber."/sound")){
        @mkdir("../stories/published/".$seriesID."/story/st".$storyNumber."/sound");
    }
    if(!is_dir("../stories/published/".$seriesID."/story/st".$storyNumber."/js")){
        @mkdir("../stories/published/".$seriesID."/story/st".$storyNumber."/js");
    }

    $sql="SELECT * FROM `storypages` WHERE `idstory`=".$storyID." ORDER BY `sorting`";
    $result=$con->query($sql);



   if(is_file("../stories/".$seriesID."/story/".$_GET["storyid"]."/images/demo_cover.jpg")){
        copy("../stories/".$seriesID."/story/".$_GET["storyid"]."/images/demo_cover.jpg","../stories/published/$seriesID/story/st$storyNumber/images/demo_cover.jpg");
    }

    $pages=[];
    $i=0;
    while($page=mysqli_fetch_assoc($result)){
        $i++;

        $temp=[];
        $temp["type"]="page";
        $temp["image"]="images/page0".$i.".jpg";

        if(is_file("../".$page["image"])){
            copy("../".$page["image"],"../stories/published/$seriesID/story/st$storyNumber/".$temp["image"]);
        }

        $temp["sound"]=str_replace("sound/","",$page["sound"]);
        $temp["text"]=$page["text"];
        $temp["textPosition"]="bottom";
        $temp["textAligner"]=json_decode($page["textAligner"]);
        $pages[]=$temp;
    }
    if(is_dir("../stories/".$seriesID."/story/".$storyID)){
        $data=str_replace("u06",'\u06',json_encode($pages,JSON_UNESCAPED_UNICODE));
        $data=str_replace('\"','\\"',$data);
        file_put_contents("storytest.txt",$data);
        file_put_contents("../stories/".$seriesID."/story/".$storyID."/js/data.js","StoryPages=".$data.";");
        copyDirectorySpecial("../stories/".$seriesID."/story/".$storyID,"../stories/published/".$seriesID."/story/st".$storyNumber);
    }
}
function publishseries(){
    if(!isset($_GET["seriesid"]) || $_GET["seriesid"]==''){
        exit("Error 071120161138");
    }

    global $con;
    $sql="SELECT `story`.*,`series`.*,`series`.`name` as seriesname, `stories_cat`.* FROM `series` JOIN `story` on `series`.`seriesid`= `story`.`seriesid` JOIN `stories_cat`  ON `story`.`catid`=`stories_cat`.`catid`  WHERE `series`.`seriesid`=".$_GET["seriesid"]." ORDER BY `storyid`";
    $result=$con->query($sql);
    $seriesData=[];
    $i=0;

    if(!is_dir("../stories/published/".$_GET["seriesid"])){
        @mkdir("../stories/published/".$_GET["seriesid"]);
        @mkdir("../stories/published/".$_GET["seriesid"]."/story");
        copyDirectorySpecial("../stories/".$_GET["seriesid"]."/images","../stories/published/".$_GET["seriesid"]."/images");
        copyDirectory("../stories/".$_GET["seriesid"]."/sound","../stories/published/".$_GET["seriesid"]."/sound");
    }
    copyDirectory("../../templates/Massa","../stories/published/".$_GET["seriesid"]);

        while($story=mysqli_fetch_assoc($result)){
        $i++;
        $temp=[];

        if($story["eprice"]==0 || $story["eprice"]==''){
            $temp["charge"]="free";
            $temp["lock"]= false;
        }else{
            $temp["charge"]=$story["eprice"];
            $temp["lock"]= true;
        }


            $path="st".$i;
        $temp["folderName"]= $path;
            if(is_dir("../stories/".$_GET["seriesid"]."/story/".$story["storyid"])){
                copyDirectorySpecial("../stories/".$_GET["seriesid"]."/story/".$story["storyid"],"../stories/published/".$_GET["seriesid"]."/story/".$path);
            }
            if(is_file("../stories/".$_GET["seriesid"]."/story/".$story["storyid"]."/images/pic.jpg")){
                copy("../stories/".$_GET["seriesid"]."/story/".$story["storyid"]."/images/pic.jpg","../stories/published/".$_GET["seriesid"]."/images/BOOK0".$i.".jpg");
            }

        $temp["storyName"]= $story["title"];
        $temp["storyid"]= $story["storyid"];
        $temp["seriesid"]= $_GET["seriesid"];
        $temp["shortDesc"]= $story["description_".strtolower($story["language"])];
        $temp["storyType"]= $story["seriesname"];
        $temp["language"]= $story["language"];
        $temp["author"]=$story["author_".strtolower($story["language"])];
        $temp["age"]= getProductAge($story["age"]);
        $temp["category"]= $story["name_".strtolower($story["language"])];
        $temp["game1"]= array("folderName"=>"filling","name"=>"لون معنا");
        $temp["game2"]= array("folderName"=>"sort","name"=>"رتب القصة");
        $temp["game3"]= array("folderName"=>"puzzle","name"=>"تركيب الصورة");
        $temp["parent"]["text"][0]= array("text"=>$story["title"],"type"=>"Title");
        $temp["parent"]["text"][1]= array("text"=>$story["parenttext"],"type"=>"p");
        $temp["parent"]["sound"]= $story["parentsound"];
        $temp["child"]["text"]= $story["kidstext"];
        $temp["child"]["sound"]= "kids.mp3";
        $temp["pageRange"]["first"]= $story["range_first"];
        $temp["pageRange"]["end"]= $story["range_end"];
        $temp["titleSound"]="title.mp3";
        $temp["downloading"]= false;
        publishstoryData($story["storyid"],$_GET["seriesid"],$i);
        $seriesData[]=$temp;
//            if(is_file('../stories/published/'.$_GET['seriesid']."/story/$path/$path.zip")){
//                unlink('../stories/published/'.$_GET['seriesid']."/story/$path/$path.zip");
//            }
//            Zip("../stories/published/".$_GET["seriesid"]."/story/".$path,'../stories/published/'.$_GET['seriesid']."/story/$path.zip", NULL);
        }
    file_put_contents("../stories/published/".$_GET["seriesid"]."/js/storycontrol.js","arrayStoryDesc=".json_encode($seriesData,JSON_UNESCAPED_UNICODE));
    //Zip('../stories/published/'.$_GET['seriesid'],'../stories/published/'.$_GET['seriesid'].".zip", NULL);
    echo 1;
}
function copyDirectorySpecial($src,$dst){
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if (is_dir($src . '/' . $file)){
                if($file!="screenshoots"){
                    copyDirectorySpecial($src . '/' . $file,$dst . '/' . $file);
                }
            }else if(strpos($file,"compressed.jpg")===false){
                copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}



function aa(){
    global $con;
    $data=json_decode(file_get_contents("data.txt"),true);
    foreach($data as $page){
        $sql="INSERT INTO `storypages`(`id`, `text`, `sound`, `image`, `textAligner`, `idstory`, `cdate`) VALUES ('','".mysqli_real_escape_string($con,$page['text'])."','".$page['sound']."','".mysqli_real_escape_string($con,$page['image'])."',
        '".json_encode($page['textAligner'],JSON_UNESCAPED_UNICODE)."',380,'2016-11-16')";
        $con->query($sql);
        echo $sql."<br>";
    }
}
?>