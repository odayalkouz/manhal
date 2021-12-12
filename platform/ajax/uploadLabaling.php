<?php
// requires php5

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
include_once "../includes/function.php";

if(isset($_POST['urlUpload'])){$url = $_POST['urlUpload'];}
if(isset($_POST['FileData'])){$FileData  = $_POST['FileData'];}
if(isset($_POST['FileName'])){$name  = $_POST['FileName'];$baseFile = $name;}
if(isset($_POST['Type'])){$Type = $_POST['Type'];}
if(isset($_POST['dest'])){$dest = $_POST['dest'];}

if(isset($_POST['game'])){$game = $_POST['game'];}

//$name = $_POST['FileName'];
//$FileData = $_POST['FileData'];
//$Type = $_POST['Type'];
//$dest = $_POST['dest'];
//$game = $_POST['game'];

$baseFile = $name;

if (($Type == "image")
    || ($Type == "sound")
    || ($Type == "video")
) {


    if ($Type == "image") {
        $img = $FileData;
        $arr = explode('/', $FileData);
        $type = substr($arr[1], 0, 4);



        if (substr($type, 3, 1) == ';') {
            $type = substr($type, 0, 3);
        }
            if ($type == "jpe") {
                $type = "jpeg";
            }



            if ((isset($_POST['saveImageType']) && $_POST['saveImageType'] == "compress") && $type == "jpeg" ||  $type == "jpg") {

                $img = str_replace("data:image/" . $type . ";base64,", '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);

                if ($type != "") {
                    $picture = $url . $baseFile;

//                    file_put_contents($picture, $data);


                    $path_parts = explode(".", $_POST['FileName']);;


                    $image = imagecreatefromstring($data);
                    $bg = imagecreatetruecolor(imagesx($image), imagesy($image));
                    imagefill($bg, 0, 0, imagecolorallocate($bg, 255, 255, 255));
                    imagealphablending($bg, TRUE);
                    imagecopy($bg, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));
                    imagedestroy($image);
                    $quality = 80; // 0 = worst / smaller file, 100 = better / bigger file
                    imagejpeg($bg, $url . $path_parts[0] . ".jpg", $quality);
                    imagedestroy($bg);


                }


            }else{

                if ($type == "png" || $type == "PNG") {


                    $img = str_replace("data:image/" . $type . ";base64,", '', $img);
                    $img = str_replace(' ', '+', $img);
                    $data = base64_decode($img);

                    if ($type != "") {
                        $picture = $url . $baseFile;
                        echo $picture;
                        file_put_contents($picture, $data);
                        echo $picture . ',';


                    }
                }
                else if ($type == "jpeg" || $type == "jpg" || $type == "JPG" || $type == "JPEG") {


                    $img = str_replace("data:image/" . $type . ";base64,", '', $img);
                    $img = str_replace(' ', '+', $img);
                    $data = base64_decode($img);

                    if ($type != "") {
                        $picture = $url . $baseFile;
                        echo $picture;
                        file_put_contents($picture, $data);
                        echo $picture . ',';


                    }
                } else if ($type == "svg+" || $type == "SVG+") {
                    echo $type;
                    $img = str_replace("data:image/svg+xml;base64,", '', $img);
                    $img = str_replace(' ', '+', $img);
                    $data = base64_decode($img);

                    if ($type != "") {
                        $picture = $url . $baseFile;
                        echo $picture;
                        file_put_contents($picture, $data);
                        echo $picture . ',';


                    }

                }
            }



    }

    if ($Type == "sound") {
        $arr = explode('/', $FileData);
        $type = substr($arr[1], 0, 4);
        if (substr($type, 3, 1) == ';') {
            $type = substr($type, 0, 3);

        }

        $img = $FileData;
        $img = str_replace("data:audio/" . $type . ";base64,", '', $img);

        echo "Done upload sound";
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);

        if ($type != "") {
            $picture = $url . $baseFile;

            file_put_contents($picture, $data);
            echo $picture . ',';


        }
    }


    if ($Type == "video") {
        echo $Type;
        $arr = explode('/', $FileData);
        $type = substr($arr[1], 0, 4);
        if (substr($type, 3, 1) == ';') {
            $type = substr($type, 0, 3);

        }

        $img = $FileData;
        $img = str_replace("data:video/" . $type . ";base64,", '', $img);
        echo "Done upload video";
        $img = str_replace(' ', '+', $img);
        $data = base64_decode($img);

        if ($type != "") {
            $picture = $url . $baseFile;

            file_put_contents($picture, $data);
            echo $picture . ',';


        }
    }


}


if (($Type == "CopyFile")) {

    echo "copy";
    copy($url, $dest);
}


if (($Type == "removeFile")) {



    if (file_exists($url)) {
        unlink(strip_tags($url));
    }
    echo "removeFile";
}


if (($Type == "removeFileImage")) {

    if (file_exists($url)) {
        unlink(strip_tags($url));
        echo "removeFileDone";
    }else{
        echo "removeError";

    }





}

if (($Type == "removeFileImageSound")) {

    if (file_exists($url)) {
        unlink(strip_tags($url));
    }
    echo "removeFileImageSoundDone";




}

if (($Type == "removeSound")) {

    if (file_exists($url)) {
        unlink(strip_tags($url));
    }
    echo "removeSound";




}

if (($Type == "JsonFile")) {

    if (!is_dir($url)) {
        @mkdir($url);
    }
    file_put_contents($url . $name, "var game=" . $game);
    //echo $url .$name;
}





?>