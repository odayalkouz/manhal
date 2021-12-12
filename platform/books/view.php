<?php
if(isset($_GET["url"]) && $_GET["url"]!=""){
    header('Content-type: application/pdf');
    header('Content-Disposition: inline; filename="' . $productid . '.pdf"');
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');

    $curlSession = curl_init();
    curl_setopt($curlSession, CURLOPT_URL, $_GET["url"]);
    curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

    $Data = curl_exec($curlSession);
    curl_close($curlSession);
    echo $Data;
}
?>