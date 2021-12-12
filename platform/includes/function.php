<?php
/**
 * Created by Dar Almanhal - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/6/2016
 * Time: 12:06 PM
 */

function getPagination($url,$num_rows,$rows=BooksPerPage){
    if(isset($_GET['page'])){
        $current=$_GET['page'];
    }else{
        $current=1;
    }
    $result1[0]="";
    $result1[1]="";
    $prev=$current-1;
    $next=$current+1;
    $Pages_number=ceil($num_rows/$rows);
    if($Pages_number>1){
        if($current>PagesOfPagination/2){
            $pageBegin=($current-ceil(PagesOfPagination/2))+1;
            if($Pages_number>PagesOfPagination){
                $pageEnd=($current+ceil(PagesOfPagination/2))-1;
            }else{
                $pageEnd=$Pages_number;
            }
        }else{
            $pageBegin=1;
            if($Pages_number>PagesOfPagination){
                $pageEnd=PagesOfPagination;
            }else{
                $pageEnd=$Pages_number;
            }
        }
        if($pageEnd>$Pages_number){
            $pageEnd=$Pages_number;
            if($Pages_number-PagesOfPagination+1>0){
                $pageBegin=$Pages_number-PagesOfPagination+1;
            }else{
                $pageBegin=1;
            }
        }
        if($pageBegin>1 && $Pages_number-$pageBegin<PagesOfPagination-1){
            $pageBegin=1;
        }

        //echo "<script>alert('".$pageBegin.'>>'.$pageEnd."');</script>";
        $result="";
        for($i=$pageBegin;$i<=$pageEnd;$i++){
            if($current==$i){
                $result.="<a class='selected page floating-left'  href='".$url."&page=".$i."' >$i</a>";
            }else{
                $result.="<a class='page floating-left' href='".$url."&page=".$i."' >$i</a>";
            }
        }
        if($current!=1){
            $first="<a href='".$url."&page=1' class='first floating-left'><i class='flaticon-arrowheads3'></i></a>";
        }else{
            $first="";
        }
        if($prev>0){
            $previus="<a  href='".$url."&page=".$prev."' class='prev floating-left'><i class='flaticon-last-track '></i></a>";
        }else{
            $previus="";
        }

        if($Pages_number!=$current){
            $last="<a href='".$url."&page=$Pages_number' class='last floating-left'><i class='flaticon-right39'></i></a>";
        }else{
            $last="";
        }
        if($next<=$Pages_number){
            $next_link=" <a href='".$url."&page=$next' class='next floating-left'><i class='flaticon-right-arrow26'></i></a>";
        }else{
            $next_link="";
        }
        $begin=$current*$rows-($rows);
        $result1[0]=" LIMIT " . $begin . ", " . $rows;
        $result1[1]=$first.$previus.$result.$next_link.$last;
    }
    return $result1;
}
function canEdit($bookid){
    global $con;
    if($_SESSION['user']['permession']==1 || $_SESSION['user']['permession']==6){
        return true;
    }else{
        $sql="SELECT `userid` FROM `books` WHERE `bookid`=".$bookid;
        $result=$con->query($sql);
        $row=mysqli_fetch_assoc($result);
        if($row['userid']==$_SESSION['user']['userid']){
            return true;
        }else{
            return false;
        }
    }
}

function canEditmedia($mediaid)
{
    global $con;
    if ($_SESSION['user']['permession'] == 1 || $_SESSION['user']['permession'] == 6) {
        return true;
    } else {
        $sql = "SELECT `userid` FROM `media` WHERE `id`=" . $mediaid;
        $result = $con->query($sql);
        $row = mysqli_fetch_assoc($result);
        if ($row['userid'] == $_SESSION['user']['userid']) {
            return true;
        } else {
            return false;
        }
    }
}

function canEditStory($storyid)
{

    global $con;

    if ($_SESSION['user']['permession'] == 1 || $_SESSION['user']['permession'] == 6) {

        return true;

    } else {

        $sql = "SELECT `userid` FROM `story` WHERE `storyid`=" . $storyid;

        $result = $con->query($sql);

        $row = mysqli_fetch_assoc($result);

        if ($row['userid'] == $_SESSION['user']['userid']) {

            return true;

        } else {

            return false;

        }

    }

}
function canEditGame($row){
    if($_SESSION['user']['permession']==1 || $_SESSION['user']['permession']==6){
        return true;
    }else{
        if($row['userid']==$_SESSION['user']['userid']){
            return true;
        }else{
            return false;
        }
    }
}
function canEditSeries($seriesID){
    global $con;
    if($_SESSION['user']['permession']==1 || $_SESSION['user']['permession']==6 || $_SESSION['user']['permession']==2 ){
        return true;
    }else{
        $sql="SELECT `userid` FROM `series` WHERE `storyid`=".$seriesID;
        $result=$con->query($sql);
        $row=mysqli_fetch_assoc($result);
        if($row['userid']==$_SESSION['user']['userid']){
            return true;
        }else{
            return false;
        }
    }
}
function canEditQ($Quizid){
    global $con;
    if($_SESSION['user']['permession']==1){
        return true;
    }else{
        $sql="SELECT `userid` FROM `quiz` WHERE `quizid`=".$Quizid;
        $result=$con->query($sql);
        $row=mysqli_fetch_assoc($result);
        if($row['userid']==$_SESSION['user']['userid']){
            return true;
        }else{
            return false;
        }
    }
}
function copyDirectory($src,$dst) {
    $dir = opendir($src);
    @mkdir($dst);
    while(false !== ( $file = readdir($dir)) ) {
        if (( $file != '.' ) && ( $file != '..' )) {
            if (is_dir($src . '/' . $file) ){
                copyDirectory($src . '/' . $file,$dst . '/' . $file);
            }else{
                    copy($src . '/' . $file,$dst . '/' . $file);
            }
        }
    }
    closedir($dir);
}
function array_shuffle($array){
    // shuffle using Fisher-Yates
    $i = count($array);

    while(--$i){
        $j = mt_rand(0,$i);
        if($i != $j){
            // swap items
            $tmp = $array[$j];
            $array[$j] = $array[$i];
            $array[$i] = $tmp;
        }
    }
    return $array;
}
function saveImageBase64($data,$path){
    $data=explode(";",$data);
    if(count($data)>1){
        $data = str_replace('base64,', '', $data[1]);
        $data = str_replace(' ', '+', $data);
        $data = base64_decode($data);
        file_put_contents($path, $data);
    }
}
function getImageColor($path){
    $delta = 24;
    $reduce_brightness = true;
    $reduce_gradients = true;
    $num_results = 20;
    $ex=new GetMostCommonColors();
    $colors=$ex->Get_Color($path, $num_results, $reduce_brightness, $reduce_gradients, $delta);
    $max=0;
    foreach ( $colors as $hex => $count )
    {

        if ( $count > $max && $hex!="000000" && $hex!="ffffff"){
            $max=$count;
            $color_max=$hex;
        }

    }
    return $color_max;
}
function removeDirectory($dir){
    if (!file_exists($dir)) return true;
    if (!is_dir($dir) || is_link($dir)) return unlink($dir);
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') continue;
        if (!removeDirectory($dir . "/" . $item)) {
            chmod($dir . "/" . $item, 0777);
            if (!removeDirectory($dir . "/" . $item)) return false;
        };
    }
    return @rmdir($dir);
}
?>