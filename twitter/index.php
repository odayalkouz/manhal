<?php
/**
 * Created by Semanoor - Hussam.
 * User: hussam
 * Date: 20/08/2015
 * Time: 10:37 ص
 */
session_start();
include_once("../platform/config.php");
include_once("twitteroauth.php");

if(isset($_SESSION['status']) && $_SESSION['status']=='verified')
{	//Success, redirected back from process.php with varified status.
    //retrive variables
    // echo "in twitter function <br>";

    $screenname 		= $_SESSION['request_vars']['screen_name'];
    $twitterid 			= $_SESSION['request_vars']['user_id'];
    $oauth_token 		= $_SESSION['request_vars']['oauth_token'];
    $oauth_token_secret = $_SESSION['request_vars']['oauth_token_secret'];

    $connection = new TwitterOAuth(TWITTER_APPID, TWITTER_SECRET, $oauth_token, $oauth_token_secret);

    $json = $connection->get('https://api.twitter.com/1.1/account/verify_credentials.json', array('include_email' => "true"));
    $data=(array)$json;
    if(signInTwitter($data)===true){
        $date=date("d/m/Y");
        $avatar=str_replace("http:","https",$data['profile_image_url']);
        //echo "insert<br>";
        $countryCode=getIp("../");
        $ad='';
        if(isset($_SESSION["ad"]) && $_SESSION["ad"]!=""){
            $ad=$_SESSION["ad"];
        }

        $sql="INSERT INTO `users`(`userid`, `uname`, `fullname`, `status`, `cdate`, `avatar`, `views_count`, `sales_count`,`social`,`country`,`ads`) VALUES ('','".mysqli_real_escape_string($con,$data['screen_name'])."','".mysqli_real_escape_string($con,$data['name'])."',1,CURDATE(),'".mysqli_real_escape_string($con,$avatar)."',0,0,'".$data['id']."','".$countryCode."','".$ad."')";

        if($con->query($sql)){
            signInTwitter($data);
        }else{
            //echo "cannot insert ".$sql;
        }
    }
}else{
    echo "in else <br>";
    echo json_encode($_SESSION);
    echo "<br>in else -------------- <br>";
    echo json_encode($_REQUEST);

}
function signInTwitter($data){
    global $con;
    $sql="SELECT * FROM users WHERE social='".$data['id']."'";

    $result=$con->query($sql);
    if(mysqli_num_rows($result)){
       // echo "logged in <br>".$data['id'];
        $row=mysqli_fetch_assoc($result);
        $_SESSION["user"]=$row;

        $sql="UPDATE `users` SET `lastlogin`=NOW() WHERE userid=".$row["userid"];
        $con->query($sql);

        header('location:../');
        exit();
    }else{
        //echo "return true <br>".$data['id'];
        return true;
    }
}

?>