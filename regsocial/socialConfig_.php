<?php
	//FaceBook ---------------------------------------------
    $hst=$_SERVER['HTTP_HOST'];
//    if(strpos($hst,'fb.')===false)
//    {$hst="fb.".$hst;}
    $fb_URI    = 'http://'.$hst.$_SERVER['PHP_SELF'];
	//$fb_URI    = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
	$fb_KEY    = '355250731349202';
	$fb_Secret = 'c57ff9daa5563cee5d5323c0ab322769';
	$fb_href   = 'https://www.facebook.com/plugins/registration?client_id='.$fb_KEY.'&redirect_uri='.$fb_URI.'&fields=name,birthday,gender,location,email,first_name,last_name';
	echo "<script type='text/javascript'>window.fbAsyncInit=function(){FB.init({appId:'".$fb_KEY."',status:true,cookie:true, xfbml:true});};(function(d){var js,id='facebook-jssdk',ref=d.getElementsByTagName('script')[0];if(d.getElementById(id)){return;}js = d.createElement('script'); js.id = id; js.async = true;js.src = '//connect.facebook.net/en_US/all.js';ref.parentNode.insertBefore(js, ref);}(document));</script>";
	//LinkedIn ---------------------------------------------
	$lnkd_URI    = $fb_URI;
	
	//local:8080
	//$lnkd_KEY    = '75qsiu5vs451h0';
	//$lnkd_Secret = 'pftjD7mgZuS0sPll';

//Hussam linked in
$token="f9f56647-c22f-44bd-bb65-35bc8559da1b";
$user_secret="a1d4c6e9-8694-49c3-b2d1-58608071cd3f";
$lnkd_KEY="75jfrwnfvwl8iw";
$lnkd_Secret="qKec5qtalzYGie1A";
	
	//online http://www.semastudio.com/SSBuilder/regsocial/linkedin/getUser.php
//	$lnkd_KEY    = '759j8zlbqbe9rv';
//	$lnkd_Secret = 'YhciGpGUzq45lKHg';
	
	
	$lnkd_scope  = 'r_fullprofile r_emailaddress rw_nus';
	//Google+ ---------------------------------------------
//    $gogl_client_id     = "880828488585.apps.googleusercontent.com";//offline
//    $gogl_client_secret = "khE4x3olP1LR_tClu256H1n9";//offline
    

    $gogl_client_id     = "298412291073-p708jsupmmb12njgaetu0k9gs1a7306g.apps.googleusercontent.com";//online

    $gogl_client_secret = "G-OIH945r8czlEm_0TBwYN2Z";//online

    
    $gogl_redirect_uri  = $fb_URI;
    
?>
