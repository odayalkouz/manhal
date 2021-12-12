<?php
/**
 * Created by PhpStorm.
 * User: Design1
 * Date: 1/7/2016
 * Time: 9:56 AM
 */
if(session_status()==PHP_SESSION_NONE){
    session_start();
}

if(!isset($_SESSION['user']['permession']) || $_SESSION['user']['permession']<1  || $_SESSION['user']['permession']>3){
    echo "Secured";
    exit();
}
if(isset($_GET["seriesid"])) {
    if (isset($_GET['storyid'])) {
        Zip('../stories/' . $_GET['seriesid'] . "/story/" . $_GET['storyid'], "story" . $_GET['storyid'] . ".zip", NULL);
        downloadBook("story" . $_GET['storyid'] . ".zip");
    }
}else{
    if(isset($_GET['bookId'])){
        Zip('../books/'.$_GET['bookId'],"book".$_GET['bookId'].".zip",NULL);
        downloadBook("book".$_GET['bookId'].".zip");
    }
}


function Zip($source,$destination,$exeption=NULL)
{
    if (!extension_loaded('zip') || !file_exists($source)) {
        return false;
    }

    $zip = new ZipArchive();
    if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
        return false;
    }
    //  chdir($source);
    $source = str_replace('\\', '/', realpath($source));

    if (is_dir($source) === true)
    {
        $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

        foreach ($files as $file)
        {
            $file = str_replace('\\', '/', $file);

            // Ignore "." and ".." folders
            if( in_array(substr($file, strrpos($file, '/')+1), array('.', '..')) )
                continue;

            $file = realpath($file);

            if (is_dir($file) === true)
            {
                if(strpos($file,'home')===false){
                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));
                }else{
                    continue;
                }

            }
            else if (is_file($file) === true)
            {
                if($exeption!=NULL){
                    if(end(explode('.',$file))!=$exeption){
                        $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));

                    }
                }else{
                    $zip->addFromString(str_replace($source . '/', '', $file), file_get_contents($file));
                }
            }
        }
    }
    else if (is_file($source) === true)
    {
        if($exeption!=NULL){
            if(end(explode('.',$source))!=$exeption){
                $zip->addFromString(basename($source), file_get_contents($source));
            }
        }else{
            $zip->addFromString(basename($source), file_get_contents($source));
        }
    }
    // chdir(dirname(__FILE__));

    return $zip->close();
}
function downloadBook($zip){
        header('Content-Description: File Transfer');
        header('Content-Type: application/zip');
        header('Content-Disposition:attachment; filename=' . basename($zip));
        header('Content-Length:' . filesize($zip));
        ob_clean();
        readfile($zip);
        @unlink($zip);
        exit();
}
?>