<?php
if(!isset($_SESSION)){
    session_start();
}

	include_once("../socialConfig.php");
	include_once("linkedin.php");
	
	if (isset($_GET['error'])){$_SESSION['socialdata']="close";gosup();}
	
	if (isset($_GET['code'])) {
		if ($_SESSION['state'] == $_GET['state']) {
			getAccessToken();
			regLinkedin();
		}else {
			gosup();
		}
	}else {
		if (!isset($_SESSION['access_token'])) {
			getAuthorizationCode();
		}else{
			regLinkedin();
		}
	}

	function regLinkedin(){
		$user = fetch('GET', '/v1/people/~:(id,firstName,lastName,headline,dateOfBirth,location,pictureUrl,emailAddress,gender)');
		$id=$user->id?$user->id:"";
		
		if($_SESSION['socialtype']=="signup"){
			$vuser_login=$user->emailAddress?$user->emailAddress:"";
			$vuser_password=makeRandomString(12);
			$vuser_name=$user->firstName?$user->firstName:"";
			$vuser_lastname=$user->lastName?$user->lastName:"";
			$vuser_address1="";
			$vuser_address2=$vuser_address1;
			$vcity=$user->location->country?$user->location->country->code:"";
			$vstate=$vcity;
			$vzip="";
			$vcountry=$user->location?$user->location->name:"";
			$vuser_email=$vuser_login;
			$vuser_phone="";
			$vuser_bairthdate=$user->dateOfBirth?$user->dateOfBirth:"";
			$vuser_image=$user->pictureUrl?$user->pictureUrl:"";
			$vuser_gender=$user->gender?$user->gender:"";
			$_SESSION['socialdata']=$vuser_name."|".$vuser_lastname."|".$vuser_login."|".$vuser_password."|".$vuser_password."|".$vuser_email."|".$vuser_address1."|".$vuser_address2."|".$vcity."|".$vcity."|".$vzip."|".$vcountry."|".$vuser_phone."|".$vuser_phone."|".(string)($id)."|".$vuser_bairthdate."|".$vuser_image."|".$vuser_gender;
		}else{
			$_SESSION['socialdata']=$id;
		}
		gosup();
	}
	
	function gosup(){
		header('Location: ../../'.$_SESSION['socialtype'].'.php');
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
?>