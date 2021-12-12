<?php
namespace Chirp;

if(session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['user']['permession']) || $_SESSION['user']['permession']<1){
    echo "Secured";
    exit();
}

include_once("../config.php");
global $con;
$sql = "SELECT * FROM `payments` WHERE `shipping_close_user`!=-1 and `exported`=0 and `shipping`='DHL'";
$result = $con->query($sql);
$filename = "Manhal_DHL_" . date('Y-m-d') . ".csv";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: text/csv");
$output = fopen('php://output', 'w');
$i=0;
while ($row = mysqli_fetch_assoc($result) ) {
    $data=array($row['manhal_ref'],
         $row['RecieverCompanyName'],
         $row['userid'],
         $row['RecieverAttention'],
         $row['Address1'],
         $row['Address2'],
         $row['Address3'],
         $row['City'],
         $row['StateProvince'],
         $row['Postcode'],
         $row['Country'],
         $row['Weight']."kgs",
         $row['Phone'],
         $row['Refrence'],
         $row['Productcode'],
         $row['Contents'],
         $row['DeclaredValue']
        );
  fputcsv($output,$data,';');
    $i++;
    $sql2 = "UPDATE `payments` SET `exported`='1' WHERE `paymentid`='".$row['paymentid']."'";
    $con->query($sql2) ;
}
fclose($output);
exit;
?>