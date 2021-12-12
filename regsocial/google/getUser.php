<?php

session_start();

$_SESSION['socialdata']="";

require_once 'src/Google_Client.php';

require_once 'src/contrib/Google_Oauth2Service.php';



include_once "../../platform/config.php";
include_once "../../includes/function.php";


$clientgoogle = new Google_Client();

$oauth2google = new Google_Oauth2Service($clientgoogle);



if (isset($_GET['error'])){
	$_SESSION['socialdata']="close";
	//echo "<script>window.location.href='../../index.php';</script>";
	if($_SESSION["lang"]=="Ar"){
		$extend="ar";
	}else{
		$extend="";
	}
	echo "<script>window.location.href='".SITE_URL.$extend."';</script>";
	//	header('Location:'.SITE_URL);
	//gosup();
}



if (isset($_GET['code'])) {

	$clientgoogle->authenticate($_GET['code']);

	$_SESSION['access_token'] = $clientgoogle->getAccessToken();

	$redirect_uri='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

//		header('Location: ' . filter_var($redirect_uri, FILTER_SANITIZE_URL));

	redirect(filter_var($redirect_uri, FILTER_SANITIZE_URL));

	return;

}

if (isset($_SESSION['access_token'])) {

	$clientgoogle->setAccessToken($_SESSION['access_token']);

}



if ($clientgoogle->getAccessToken()) {

	$user = $oauth2google->userinfo->get();

	//fast  file_put_contents('testlogin.txt',json_encode($user));

	$id=$user['id']?$user['id']:"";

	if(signInGoogle($user)===true){

		$date=date("d/m/Y");
		$avatar=$user['picture']?$user['picture']:"";
		$vuser_login=$user['email']?$user['email']:"";
		$vuser_password=makeRandomString(12);
		$vuser_name=$user['given_name']?$user['given_name']:"";
		$vuser_lastname=$user['family_name']?$user['family_name']:"";
		$vuser_gender=$user['gender']?$user['gender']:"";
		$fullName=$vuser_name." ".$vuser_lastname;
		$countryCode=getIp("../../");
		$ad='';
		if(isset($_SESSION["ad"]) && $_SESSION["ad"]!=""){
			$ad=$_SESSION["ad"];
		}
		$sql="INSERT INTO `users`(`userid`, `uname`, `fullname`, `status`, `cdate`, `avatar`, `views_count`, `sales_count`,`social`,`email`,`country`,`ads`) VALUES ('','".mysqli_real_escape_string($con,$vuser_name)."','".mysqli_real_escape_string($con,$fullName)."',1,CURDATE(),'".$avatar."',0,0,'".$user['id']."','".$vuser_login."','".$countryCode."','".$ad."')";

		if($con->query($sql)){
			signInGoogle($user);
		}else{
			echo "Error : 091020151147 ";
		}

	}

	//echo "mysql num rows = ".mysql_num_rows($result);




}else{

	$authUrl = $clientgoogle->createAuthUrl();

	//header('Location: '.$authUrl);

	redirect($authUrl);

	exit();

}





function makeRandomString($max=6) {
	$i = 0;
	$possible_keys = "0123456789abcdefghijklmnopqrstuvwxyz";
	$keys_length = strlen($possible_keys);
	$str = "";

	while($i<$max) {
		$rand = mt_rand(1,$keys_length-1);
		$str.= $possible_keys[$rand];
		$i++;
	}
	return $str;
}



function redirect($location){
	echo "<script>window.location.href='$location';</script>";
}

function signInGoogle($data){
	global $con;
	$sql="SELECT * FROM users WHERE social='".$data['id']."'";

	$result=$con->query($sql);
	if(mysqli_num_rows($result)){
		$row=mysqli_fetch_assoc($result);
		$_SESSION["user"]=$row;
		if($_SESSION["lang"]=="Ar"){
			$extend="ar";
		}else{
			$extend="";
		}
		$sql="UPDATE `users` SET `lastlogin`=NOW() WHERE userid=".$row["userid"];
		$con->query($sql);

		echo "<script>window.location.href='".SITE_URL.$extend."';</script>";
		exit();
	}else{
		return true;
	}
}
?>