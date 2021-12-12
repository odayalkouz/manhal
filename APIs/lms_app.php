<?php
/**
 * Created by Dar Al-Manhal publishers - Hussam Abu khadijeh.
 * User: Hussam Abu Khadijeh
 * Date: 02/04/2019
 * Time: 11:47 ص
 */

class api{
    var $conn;
    //constructor - Connect to DB - By Hussam
    function __construct(){
        global $con;
        $this->conn=$con;
    }

    //get LMS instance domain by ID - By Hussam
    function getLMSURL($id){
        $sql = "SELECT `subdomain` FROM `lms_instances` WHERE `lmsid`=".$id;
        $result = $this->conn->query($sql);
        if(mysqli_num_rows($result)>0){
           $row=mysqli_fetch_assoc($result);
            $result=json_encode(array("result"=>"1","message"=>"success","data"=>array("domain"=>str_replace(".manhal.com","",$row["subdomain"]))));
        }else{
            $result=json_encode(array("result"=>"0","message"=>"invalid school ID"));
        }
        return $result;
    }

}

if(isset($_GET["process"]) && $_GET["process"]!=""){
    $api=new api();
   switch($_GET["process"]){
       case "get-lms-domain":
           echo $api->getLMSURL($_GET["id"]);
   }
}


?>