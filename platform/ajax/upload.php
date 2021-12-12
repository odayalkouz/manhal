<?php
// requires php5

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
include_once "../includes/function.php";

$url = $_POST['urlUpload'];
$name = $_POST['FileName'];
$FileData = $_POST['FileData'];
$Type = $_POST['Type'];
$dest = $_POST['dest'];
$game = $_POST['game'];
$baseFile = $name;

if (($Type == "image")
    || ($Type == "sound")
) {
    echo "image and sound\n";
    if ($Type == "image") {
        $arr = explode('/', $FileData);
        $type = substr($arr[1], 0, 4);
        if (substr($type, 3, 1) == ';') {
            $type = substr($type, 0, 3);
            if ($type == "jpe") {
                $type = "jpeg";
            }
			
			
        }
		
		
echo $type."\n";
        $img = $FileData;

        $type=str_replace("+","",$type);
        echo $type."\n";
		if ($type == "svg") {
			 $img = str_replace("data:image/"  . "svg+xml;base64,", '', $img);
            echo $img."\n";
		}else{
			 $img = str_replace("data:image/" . $type . ";base64,", '', $img);
		}
       
    }

    if ($Type == "sound") {
        $arr = explode('/', $FileData);
        $type = substr($arr[1], 0, 4);
        if (substr($type, 3, 1) == ';') {
            $type = substr($type, 0, 3);
            if ($type == "jpe") {
                $type = "jpeg";
            }
        }

        $img = $FileData;
        $img = str_replace("data:audio/" . $type . ";base64,", '', $img);


    }


    $img = str_replace(' ', '+', $img);
    $data = base64_decode($img);

    if ($type != "") {
        $picture = $url . $baseFile;

        file_put_contents($picture, $data);
        echo $picture . ',';


    }
}


if(($Type == "CopyFile")){

echo "copy";
    copy($url , $dest);
}

if(($Type == "removeFile")){

    echo "removeFile";

    unlink(strip_tags($url));
}


if(($Type == "JsonFile")){

    if(!is_dir($url)){
        @mkdir($url);
    }
 file_put_contents($url.$name,"var game=".$game  );
    //echo $url .$name;
}




?>