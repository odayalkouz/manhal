<?php
include_once "platform/config.php";
$sql='Select media.*,categories.name_ar, categories.name_en From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=0 ORDER BY `media`.`title_en` ASC';
$result=$con->query($sql);
while($row=mysqli_fetch_assoc($result)){

    $dir="platform/media/".$row['id'];

   // $dh  = opendir($dir);
   // while (false !== ($fileName = readdir($dh))) {
$newnames=str_replace(" ","-",$row['title_en']).$row['filename'];
    echo $dir."/".$newnames."<br>";
    if(file_exists($dir."/".$row['filename'].".pdf")){
        rename($dir."/".$row['filename'].".pdf",$dir."/".$newnames.".pdf");
    }




}