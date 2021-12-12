<?php
//$xml = simplexml_load_file("http://www.geoplugin.net/xml.gp?ip=".getRealIpAddr());
//
//echo $xml->geoplugin_countryName ;

$URL="https://ipapi.co/".getRealIpAddr()."/json/";
// create curl resource
$ch = curl_init();
// set url
curl_setopt($ch, CURLOPT_URL, $URL);

//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// $output contains the output string
$output = curl_exec($ch);

// close curl resource to free up system resources
curl_close($ch);
echo $output;
//foreach ($xml as $key => $value)
//{
//    echo $key , "= " , $value ,  " \n" ;
//}
echo "</pre>";

function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
?>
