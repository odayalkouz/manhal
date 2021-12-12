<?php
/**
 * Created by PhpStorm.
 * User: khalid alomiri
 * Date: 5/17/2017
 * Time: 10:17 AM
 */
if(isset($_GET['process'])){
    $_GET['process']();
}
file_put_contents('kk.txt','ok');
function uploadFile($name,$ext,$dir,$multible=false){
    if($multible==false){
        $path_parts = pathinfo($_FILES[$name]['name']);
        $extension = strtolower($path_parts['extension']);
        if(in_array($extension,$ext)){
            $newName=$_POST[$name.'_id'].".".$extension;
            if(move_uploaded_file($_FILES[$name]['tmp_name'], $dir.$newName)){
                return $newName;
            }else{
                return $name."-".$dir.$newName;
                return false;
            }
        }else{
            return false;
        }
    }
}

function mediafile(){

    if (isset($_FILES['Filemedia'])) {
        if(!is_dir("sound")){
            mkdir("sound");
        }
        $target_path = "sound/";     // Declaring Path for uploaded images.
        if(!is_dir($target_path)){
            mkdir($target_path);
        }
        $validextensions = array("mp3");      // Extensions which are allowed.
        $ext = explode('.', basename($_FILES['Filemedia']['name']));   // Explode file name from dot(.)
        $file_extension = end($ext); // Store extensions in the variable.

        if (in_array($file_extension, $validextensions)) {

                $dir = $target_path;
                $dh  = opendir($dir);
                while (false !== ($fileName = readdir($dh))) {

                    if(strpos($fileName,$_GET["filename"])>-1)
                        unlink($target_path.'/'.$fileName);
                }



                move_uploaded_file($_FILES['Filemedia']['tmp_name'], $target_path);
            }


    }
}