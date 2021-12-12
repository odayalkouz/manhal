<?php
session_name('linkedin');

function getAuthorizationCode() {
	global $lnkd_URI;
	global $lnkd_KEY;
	global $lnkd_scope;
	$params = array('response_type' => 'code',
					'client_id' => $lnkd_KEY,
					'scope' => $lnkd_scope,
					'state' => uniqid('', true), 
					'redirect_uri' => $lnkd_URI,
			);

	$url = 'https://www.linkedin.com/uas/oauth2/authorization?' . http_build_query($params);
	$_SESSION['state'] = $params['state'];
	header("Location: $url");
	exit;
}
	
function getAccessToken() {
	global $lnkd_URI;
	global $lnkd_KEY;
	global $lnkd_Secret;
   // global $lnkd_token;
	$params = array('grant_type' => 'authorization_code',
					'client_id' => $lnkd_KEY,
					'client_secret' => $lnkd_Secret,
					'code' => $_GET['code'],
					'redirect_uri' => $lnkd_URI,
			);
	
	$url = 'https://www.linkedin.com/uas/oauth2/accessToken?' . http_build_query($params);
	$context = stream_context_create(
					array('http' => 
						array('method' => 'POST',
						)
					)
				);
	$response = file_get_contents($url, false, $context);
	$token = json_decode($response);
	$_SESSION['access_token'] = $token->access_token;
  //  $_SESSION['access_token'] = $lnkd_token;
   // $_SESSION['access_token'] ="42fdd842-d332-416e-947f-eed69e0d86c2";
	$_SESSION['expires_in'] = $token->expires_in;
	$_SESSION['expires_at'] = time() + $_SESSION['expires_in'];
	
	return true;
}

function fetch($method, $resource, $body = '') {
	$params = array('oauth2_access_token' => $_SESSION['access_token'],
					'format' => 'json',
			);
	$url = 'https://api.linkedin.com' . $resource . '?' . http_build_query($params);
	$context = stream_context_create(
					array('http' => 
						array('method' => $method,
						)
					)
				);

	$response = file_get_contents($url, false, $context);
	return json_decode($response);
}
?>