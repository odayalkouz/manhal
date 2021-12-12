<?php
if(isset($_POST['process']) && $_POST['process']!=""){
    $_POST['process']();
}


function secret(){
    $date=date('m-d');
    $secretKey = $date."Lfnvj8UAAAAAGMIkj9n6Xi6qDq-Manhal.com-FGkO3804EyKG";
    $hash = hash('sha256', $secretKey);
    echo $hash;
//    echo "asdjh787AJH23djHFGB6672399GUJHGBnkjgh123fghgasd67HJKV8asbqlga345Fyhasd2343";

}

?>