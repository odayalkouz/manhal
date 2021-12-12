<?php
/**
 * Created by Dar Al-Manhal Publishers - Hussam Abu Khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 1/31/2017
 * Time: 11:00 AM
 */
$cach=uniqid();
?>
<br>
<a href="https://www.manhal.com/compressor/index.php?pass=uasd546asd15q&cache=<?=$cach;?>">List Images</a><br>
<a href="https://www.manhal.com/compressor/index.php?pass=uasd546asd15q&process=extract&cache=<?=$cach;?>">Extract Images</a><br>
<a href="https://www.manhal.com/compressor/index.php?pass=uasd546asd15q&process=delete&cache=<?=$cach;?>">Delete Images</a><br>
<a href="https://www.manhal.com/compressor/index.php?pass=uasd546asd15q&process=deletezip&cache=<?=$cach;?>">Delete Zip Files</a><br>
<a href="https://developers.google.com/speed/pagespeed/insights/?url=https%3A%2F%2Fwww.manhal.com%2Fcompressor%2Findex.php%3Fpass%3Duasd546asd15q%26cache%3D5adc798d9fe85&cache=<?=$cach;?>">Download</a><br>

<?php
if(isset($_GET["pass"]) && $_GET["pass"]=="uasd546asd15q"){
    $images=glob(dirname(__FILE__)."/*.*");
    if(isset($_GET["process"]) && $_GET["process"]=="delete"){
        foreach($images as $image){
            if($image!="." && $image!=".." && $image!="index.php"){
                $image=str_replace('\\',"/",$image);
                $names=explode("/",$image);
                $v=$names[count($names)-1];
                $ext=explode(".",$v);
                $ext=strtolower($ext[1]);
                if($ext!="php" && $ext!="zip") {
                    unlink($v);
                }
            }
        }
        echo "all files deleted";
    }elseif(isset($_GET["process"]) && $_GET["process"]=="deletezip"){
        foreach($images as $image){
            if($image!="." && $image!=".." && $image!="index.php"){
                $image=str_replace('\\',"/",$image);
                $names=explode("/",$image);
                $v=$names[count($names)-1];
                $ext=explode(".",$v);
                $ext=strtolower($ext[1]);
                if(strtolower($ext)=="zip") {
                    unlink($v);
                }
            }
        }
        echo "all files deleted";
    }elseif(isset($_GET["process"]) && $_GET["process"]=="extract"){
        foreach($images as $image){
            if($image!="." && $image!=".." && $image!="index.php"){
                $image=str_replace('\\',"/",$image);
                $names=explode("/",$image);
                $v=$names[count($names)-1];
                $ext=explode(".",$v);
                if(strtolower($ext[1])=="zip"){
                    $zip = new ZipArchive;
                    if ($zip->open($v) === TRUE) {
                        $zip->extractTo("../compressor/");
                        $zip->close();
                    }
                }
            }
        }
        echo "all files extracted successfully";
    }else{
        $images=glob(dirname(__FILE__)."/*.*");
        foreach($images as $image){
            if($image!="." && $image!=".." && $image!="index.php"){
                $image=str_replace('\\',"/",$image);
                $names=explode("/",$image);
                $v=$names[count($names)-1];
                $ext=explode(".",$v);
                $ext=strtolower($ext[1]);
                if($ext!="php" && $ext!="zip"){
                    ?>
                    <img src="<?=$v;?>">
                    <?php
                }

            }
        }
    }

}
?>

