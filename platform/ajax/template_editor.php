<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 30/10/2020
 * Time: 02:12 AM
 */
if(session_status()==PHP_SESSION_NONE){
    session_start();
}
if(!(isset($_SESSION['user']['permession']) && ($_SESSION['user']['permession']==1 || $_SESSION['user']['permession']==2 || $_SESSION['user']['permession']==6 || $_SESSION['user']['permession']==10 || $_SESSION['user']['permession']==11 ))){
    echo "Secured";
    exit();
}


include_once "../config.php";
include_once "../includes/function.php";
$template_colors=array(
    'c3e3ff'=>':root {--haderShadow6:rgba(120,188,255,0.10);--bg1: rgb(127,184,228);--bg2: -moz-linear-gradient(90deg, rgb(127,184,228) 30%, rgb(255, 255, 255) 70%);--bg3:-webkit-linear-gradient(90deg, rgb(127, 184, 228) 30%, rgb(255, 255, 255) 70%);--bg4:-o-linear-gradient(90deg, rgb(127, 184, 228) 30%, rgb(255, 255, 255) 70%);--bg5:-ms-linear-gradient(90deg, rgb(127, 184, 228) 30%, rgb(255, 255, 255) 70%);--bg6:linear-gradient(180deg, rgb(127, 184, 228) 30%, rgb(255, 255, 255) 70%);--fontColor: #7950a5;--borderColor1: #79b7ea;--borderColor2: #79b7ea;--bghader: #79b7ea;--haderShadow: rgba(121,183,238,0.3);--haderShadow2: rgba(94,94,94,0.10);--fontColor2: #ffffff;--bg7: rgba(121,183,234,0.10);--bg8: #8db5e7; --bghader1: #79b7ea;--haderShadow1: rgba(124,182,227,0.30);--borderColor3: #e0f2fe; --borderColor4: #ebf6fe; --borderColor5: #d7edfd; --haderShadow3: rgba(178,178,178,0.2);--fontColor1: #7950a5; --borderColor6: #ffbf31; --haderShadow5: rgba(121,183,234,0.35); --haderShadow4: rgba(121,183,234,0.1); --bghader2: #79b7ea;--bghader3: #79b7ea; --bghader4: #bee3fb; --fontColor3: #4d9ada;--bghader5: 121,183,234;--bghader6: #79b7ea6b;--bghader7: #79b7ea;--fontColor4: #79b7ea21;}',
    '9ccf8d'=>':root {--haderShadow6:rgba(156,207,141,0.10);--bg1: rgb(156,207,141);--bg2: -moz-linear-gradient(90deg, rgb(156,207,141) 30%, rgb(255, 255, 255) 70%);--bg3:-webkit-linear-gradient(90deg, rgb(156, 207, 141) 30%, rgb(255, 255, 255) 70%);--bg4:-o-linear-gradient(90deg, rgb(156, 207, 141) 30%, rgb(255, 255, 255) 70%);--bg5:-ms-linear-gradient(90deg, rgb(156, 207, 141) 30%, rgb(255, 255, 255) 70%);--bg6:linear-gradient(180deg, rgb(156, 207, 141) 30%, rgb(255, 255, 255) 70%);--fontColor: #ba7560; --borderColor1: #9ccf8d;--borderColor2: #9ccf8d; --bghader: #9ccf8d; --haderShadow: rgba(213,255,201,0.3);--haderShadow2: rgba(94,94,94,0.10);--fontColor2: #ffffff;--bg7: rgba(156,207,141,0.10);--bg8: #9ccf8d;; --bghader1: #9ccf8d;;--haderShadow1: rgba(156,208,140,0.30);--borderColor3: #d2efca; --borderColor4: #f1ffed; --borderColor5: #ddf9d4; --haderShadow3: rgba(178,178,178,0.2);--fontColor1: #ba7560; --borderColor6: #ffbf31; --haderShadow5: rgba(156,207,141,0.35); --haderShadow4: rgba(156,207,141,0.1); --bghader2: #9ccf8d;--bghader3: #9ccf8d; --bghader4: #daf1d1; --fontColor3: #65a951; --bghader5: 156,207,141;--bghader6: #9ccf8d70;--bghader7: #9ccf8d;--fontColor4: #9ccf8d30;}',
    '40beba'=>':root {--haderShadow6:rgba(64,190,186,0.10);--bg1: rgb(64,190,186);--bg2: -moz-linear-gradient(90deg, rgb(64,190,186) 30%, rgb(255, 255, 255) 70%);--bg3:-webkit-linear-gradient(90deg, rgb(64,190,186) 30%, rgb(255, 255, 255) 70%);--bg4:-o-linear-gradient(90deg, rgb(64,190,186) 30%, rgb(255, 255, 255) 70%);--bg5:-ms-linear-gradient(90deg, rgb(64,190,186) 30%, rgb(255, 255, 255) 70%);--bg6:linear-gradient(180deg, rgb(64,190,186) 30%, rgb(255, 255, 255) 70%);              --fontColor: #686868; --borderColor1: #40beba;--borderColor2: #40beba; --bghader: #40beba; --haderShadow: rgba(64,190,186,0.3);--haderShadow2: rgba(94,94,94,0.10);--fontColor2: #ffffff;--bg7: rgba(64,190,186,0.10);--bg8: #40beba; --bghader1: #40beba;--haderShadow1: rgba(61,191,187,0.30);--borderColor3: #90d8d6; --borderColor4: #e8f9f7; --borderColor5: #e5f7f5; --haderShadow3: rgba(178,178,178,0.2);--fontColor1: #4b5757; --borderColor6: #ffbf31; --haderShadow5: rgba(10,201,185,0.35); --haderShadow4: rgba(10,201,185,0.1); --bghader2: #0ac9b9;--bghader3: #4fb8c1; --bghader4: #bbf1f2; --fontColor3: #2b9193;--bghader5: 79,184,193; --bghader6: #4fb8c166;--bghader7: #4fb8c1;--fontColor4: #4fb8c11f;}',
    'be9bca'=>':root {--haderShadow6:rgba(190,155,202,0.10);--bg1: rgb(190,155,202);--bg2: -moz-linear-gradient(90deg, rgb(190,155,202) 30%, rgb(255, 255, 255) 70%);--bg3:-webkit-linear-gradient(90deg, rgb(190,155,202) 30%, rgb(255, 255, 255) 70%);--bg4:-o-linear-gradient(90deg, rgb(190,155,202) 30%, rgb(255, 255, 255) 70%);--bg5:-ms-linear-gradient(90deg, rgb(190,155,202) 30%, rgb(255, 255, 255) 70%);--bg6:linear-gradient(180deg, rgb(190,155,202) 30%, rgb(255, 255, 255) 70%);        --fontColor: #4f8a9e; --borderColor1: #be9bca;--borderColor2: #be9bca; --bghader: #be9bca; --haderShadow: rgba(188,154,200,0.3);--haderShadow2: rgba(94,94,94,0.10);--fontColor2: #ffffff;--bg7: rgba(190,155,202,0.10);--bg8: #be9bca; --bghader1: #be9bca;--haderShadow1: rgba(188,154,200,0.30);--borderColor3: #e1c7ea; --borderColor4: #f9f1fd; --borderColor5: #f0e2f7; --haderShadow3: rgba(178,178,178,0.2);--fontColor1: #4f8a9e; --borderColor6: #ffbf31; --haderShadow5: rgba(190,155,202,0.35); --haderShadow4: rgba(190,155,202,0.1); --bghader2: #be9bca;--bghader3: #be9bca; --bghader4: #e6cfef; --fontColor3: #b676cc;--bghader5: 190,155,202;--bghader6: #be9bca59;--bghader7: #be9bca;;--fontColor4: #be9bca1f;}',
);
$Lang = simplexml_load_file("../../language/".$_SESSION["lang"].".xml");

if(isset($_GET['process']) && $_GET['process']!=""){
    $_GET['process']();
}

function removebookdir(){
    if(isset($_GET['bookid']) && $_GET['bookid']!=''){
        removeDirectoryX("../books/".$_GET['bookid']."/");
        echo 'removed '.$_GET['bookid'];
    }
}
function removeDirectoryX($dir){
    $filesToKeep = array(
        $dir.'cover.jpg',
        $dir.'back.jpg'
    );

    $dirList = glob($dir.'*');
    foreach ($dirList as $file) {
        if (! in_array($file, $filesToKeep)) {
            if (is_dir($file)) {
                rrmdir($file);
            } else {
                unlink($file);
            }//END IF
        }//END IF
    }//END FOREACH LOOP

}

function rrmdir($dir) {
    if (is_dir($dir)) {
        $objects = scandir($dir);
        foreach ($objects as $object) {
            if ($object != "." && $object != "..") {
                if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object);
            }
        }
        reset($objects);
        rmdir($dir);
    }
}

function uploadimg64(){
    if(isset($_POST['id']) && $_POST['id']!=''){
        $types=explode(";",$_POST['data']);
        $data=$types[1];
        $types=explode("/",$types[0]);
        $ext = $types[1];

        $imgName=uniqid().'.'.$ext;
        $path='../media/'.$_POST['id'].'/'.$imgName;
        saveImage64($_POST['data'],$path);
//        $absolutePath='https://www.manhal.com/platform/media/'.$_POST['id'].'/'.$imgName;
        $absolutePath=SITE_URL.'platform/media/'.$_POST['id'].'/'.$imgName;
        $result=array('status'=>1,'msg'=>'success','path'=>$absolutePath);
    }else{
        $result=array('status'=>0,'msg'=>'invalid id');
    }
    echo json_encode($result);
}

function saveImage64($thumb,$path){
    $types=explode(";",$thumb);
    $data=$types[1];
    $types=explode("/",$types[0]);
    $ext = "jpg";

    $data = str_replace('base64,', '', $data);
    $data = str_replace(') no-repeat;,', '', $data);
    $data = str_replace(')no-repeat;,', '', $data);
    $data = str_replace(' ', '+', $data);
    $data = base64_decode($data);
    file_put_contents($path, $data);
}
function updatesettings(){
    global $con;
    if(isset($_POST["thumb"]) && $_POST["thumb"]!=""){
        $thumb=saveImageBase64($_POST["thumb"],"../media/".$_POST["id"]."/thumbnail.jpg");
    }else{
        $thumb=0;
    }
    if(isset($_POST["thumb_small"]) && $_POST["thumb_small"]!=""){
        $thumb=saveImageBase64($_POST["thumb_small"],"../media/".$_POST["id"]."/thumbnail_small.jpg");
    }else{
        $thumb=0;
    }

    $sql="UPDATE `media` SET `title_ar`='".mysqli_escape_string($con,$_POST["arabic_title"])."',`title_en`='".mysqli_escape_string($con,$_POST["english_title"])."',
    `category`=".$_POST["category"].",`status`=".$_POST["publish"].",`language`='".$_POST["language"]."',`description_en`='".mysqli_escape_string($con,$_POST["english_desc"])."',
    `description_ar`='".mysqli_escape_string($con,$_POST["arabic_desc"])."',`grade`=".$_POST["level"].",`age`=".$_POST["level"].", `template`=".$_POST["template"].", `help`='".mysqli_escape_string($con,$_POST["help"])."' WHERE `id`=".$_POST["id"];

    if($con->query($sql)){
        $result=array("status"=>1,"msg"=>"success");
    }else{
        $result=array("status"=>0,"msg"=>"faild","sql"=>$sql);
    }

    echo json_encode($result);

}

function deletemedia(){
    global $con;
    if(!isset($_POST['mediaid']) || $_POST['mediaid']==''){
        $resultData["result"]=-1;
        $resultData["msg"]="invalid media id";
        echo json_encode($resultData);
    }
    if ($_SESSION['user']['permession'] > 0 && $_SESSION['user']['permession']<6) {
        $weruser = '';
    } else {
        $weruser = " and userid=".$_SESSION['user']['userid'];
    }
    $sql = "Select * FROM `media` WHERE `id`=".$_POST['mediaid'].$weruser;
    $result = $con->query($sql);
    $num_rows=mysqli_num_rows($result);
    if($num_rows>0){
        if($con->query("DELETE FROM `media` WHERE `id`=".$_POST['mediaid'])){
            if(is_dir("../media/".$_POST['mediaid']."/")){
                removeDirectory("../media/".$_POST['mediaid']."/");
            }
            $resultData["result"]=1;
        }else{
            $resultData["result"]=0;
            $resultData["msg"]="sqlerror";
        }
    }else{
        $resultData["result"]=-1;
        $resultData["msg"]="no permession";
    }

    echo json_encode($resultData);
}

function savegamedata(){
    global $con;
    $sql="UPDATE `media` SET `data`='".mysqli_escape_string($con,$_POST["data"])."', `temp_color`='".$_POST['color']."' WHERE `id`=".$_POST["id"];
    $_SESSION["gameData"][$_POST["id"]]=$_POST["data"];
    if($con->query($sql)){
        $result=array("status"=>1,"msg"=>"success");
    }else{
        $result=array("status"=>0,"msg"=>"faild","sql"=>$sql);
    }
    echo json_encode($result);
}
function publish(){
    global $template_colors;
    copyDirectory("../../editor/templates/".$_POST["template"],"../media/".$_POST["id"]);
    $cache=uniqid();
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/index.html");
    $data=str_replace('#manhal#cache#',$cache,$data);
    file_put_contents("../media/".$_POST["id"]."/index.html",$data);
    if(isset($_POST['color']) && $_POST['color']!=''){
        $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/style.css");
        $data=str_replace('/*#Manhal#root#color#*/',$template_colors[$_POST['color']],$data);
        file_put_contents("../media/".$_POST["id"]."/css/style.css",$data);
    }
    if(isset($_POST['help']) && $_POST['help']!=''){

        $helpStyle='.title-icon{display: block!important;}.help-icon{display: block!important;}';
//        $helpStyle='.title-icon{display: block!important;}';
    }else{
        $helpStyle='.title-icon{display: none!important;}.help-icon{display: none!important;}';
//        $helpStyle='.title-icon{display: none!important;}';
    }
    $data=file_get_contents("../media/".$_POST["id"]."/index.html");
    $data=str_replace('/*#Manhal#help#style#*/',$helpStyle,$data);
    file_put_contents("../media/".$_POST["id"]."/index.html",$data);


    $function="publishTemp".$_POST["template"];
    $function();
}
function savehelp(){
    if(isset($_POST['id']) && $_POST['id']!=''){
        file_put_contents("../media/".$_POST["id"]."/help.html",$_POST['html']);
    }
    $result=array("status"=>1,"msg"=>"success");
    echo json_encode($result);
}
function gethelp(){
    if(isset($_POST['id']) && $_POST['id']!=''){
        if(is_file("../media/".$_POST["id"]."/help.html")){
            $html=file_get_contents("../media/".$_POST["id"]."/help.html");
        }else{
            $html="";
        }
        $result=array("status"=>1,"msg"=>"success","html"=>$html);
        echo json_encode($result);
    }else{
        $result=array("status"=>0,"msg"=>"faild");
        echo json_encode($result);
    }
}
function publishTemp1(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData["itemList"]).';';
    $puplishData.='var question="'.$gameData["title"].'";';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp2(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData).';';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp3(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData["itemList"]).';';
    $puplishData.='var question="'.$gameData["title"].'";';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp4(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData).';';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp5(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData['itemList']).'; ';
    $puplishData.='var wrongWordsList='.json_encode($gameData['wrongs']).'; ';
    $puplishData.='var titleText="'.$gameData['mainTitle'].'"; ';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp6(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData).';';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp7(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData['itemList']).'; ';
    $puplishData.='var title='.json_encode($gameData['title']).'; ';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp8(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData['itemList']).'; ';
    $puplishData.='var wrongWordsList='.json_encode($gameData['wrongs']).'; ';
    $puplishData.='var titleText="'.$gameData['mainTitle'].'"; ';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp9(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData['itemList']).'; ';
    $puplishData.='var worngList='.json_encode($gameData['worngList']).'; ';
    $puplishData.='var cloumns='.json_encode($gameData['cloumns']).'; ';
    $puplishData.='var title="'.$gameData['title'].'"; ';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp10(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData['itemList']).'; ';
    $puplishData.='var worngList='.json_encode($gameData['worngList']).'; ';
    $puplishData.='var cloumns='.json_encode($gameData['cloumns']).'; ';
    $puplishData.='var title="'.$gameData['title'].'"; ';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp11(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData["itemList"]).';';
    $puplishData.='var mainTitle="'.$gameData["mainTitle"].'";';
    $puplishData.='var supTitle="'.$gameData["supTitle"].'";';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp12(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData["itemList"]).';';
    $puplishData.='var title="'.$gameData["title"].'";';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp14(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData['itemList']).'; ';
    $puplishData.='var wrongAnswer='.json_encode($gameData['wrongAnswer']).'; ';
    $puplishData.='var title='.json_encode($gameData['title']).'; ';
    $puplishData.='var supTitle='.json_encode($gameData['supTitle']).'; ';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp15(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData['itemList']).'; ';
    $puplishData.='var wrongWordsList='.json_encode($gameData['wrongs']).'; ';
    $puplishData.='var titleText="'.$gameData['mainTitle'].'"; ';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp16(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData["itemList"]).';';
    $puplishData.='var mainTitle="'.$gameData["mainTitle"].'";';
    $puplishData.='var supTitle="'.$gameData["supTitle"].'";';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp17(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData["itemList"]).';';
    $puplishData.='var mainTitle="'.$gameData["mainTitle"].'";';
    $puplishData.='var supTitle="'.$gameData["supTitle"].'";';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp18(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData['itemList']).'; ';
    $puplishData.='var text='.json_encode($gameData['text']).'; ';
    $puplishData.='var title="'.$gameData['title'].'"; ';
    $puplishData.='var imag="'.$gameData['imag'].'"; ';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp19(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData["itemList"]).';';
    $puplishData.='var mainTitle="'.$gameData["mainTitle"].'";';
    $puplishData.='var supTitle="'.$gameData["supTitle"].'";';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp20(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData["itemList"]).';';
    $puplishData.='var question="'.$gameData["title"].'";';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp21(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData['itemList']).'; ';
    $puplishData.='var wrongWordsList='.json_encode($gameData['wrongs']).'; ';
    $puplishData.='var titleText="'.$gameData['mainTitle'].'"; ';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp22(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData).';';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp23(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData['itemList']).'; ';
    $puplishData.='var title='.json_encode($gameData['title']).'; ';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp24(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData).';';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}
function publishTemp25(){
    $gameData=json_decode($_SESSION["gameData"][$_POST["id"]],true);
    $puplishData='var itemList='.json_encode($gameData["itemList"]).';';
    $puplishData.='var question="'.$gameData["title"].'";';
    $data=file_get_contents("../../editor/templates/tempData/".$_POST["template"]."/data.js");
    $data=str_replace('//#Manhal#data#',$puplishData,$data);
    file_put_contents("../media/".$_POST["id"]."/js/data.js",$data);
    $result=array("status"=>1,"msg"=>"success","data"=>$data);
    echo json_encode($result);
}