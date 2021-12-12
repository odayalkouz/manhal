<?php
/**
 * Created by PhpStorm.
 * User: khalid alomiri
 * Date: 1/4/2016
 * Time: 1:17 PM
 */
$cuerrentpage="user.php";

if(session_status()==PHP_SESSION_NONE){ session_start();}
if(!isset($_SESSION["user"])|| $_SESSION["user"]['permession']!='1'){
    header('Location: index.php');
    die();
}
include_once('config.php') ;
include_once('includes/language.php') ;
$sql ="SELECT * FROM users";
$result = $con->query($sql);
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $data='';
    $i=0;
    while($row = mysqli_fetch_assoc($result)) {
        $designitem = file_get_contents('designtxt/admin_user.txt');
        $designitem = str_replace("#userid#", $row["userid"], $designitem);
        $designitem = str_replace("#username#", $row["uname"], $designitem);
        $designitem = str_replace("#password#", $row["password"], $designitem);
        $designitem = str_replace("#useremail#", $row["email"], $designitem);
        $designitem = str_replace("#userdate#", $row["cdate"], $designitem);
        $designitem = str_replace("#fullname#", $row["fullname"], $designitem);
        if($row["status"]==1){
            $status=$Lang->Enabled;
        }else{
            $status=$Lang->Disabled;
        }
        $designitem = str_replace("#status#", $status, $designitem);
        $designitem = str_replace("#Permessionnum#",$row["permession"], $designitem);
        if($row["permession"]==1) {
            $designitem = str_replace("#Permession#",'Admin', $designitem);
        }else{
            $designitem = str_replace("#Permession#",'User', $designitem);
        }
        if($i%2==0) {
            $designitem = str_replace("#class#", 'bg-row-a', $designitem);
        }else{
            $designitem = str_replace("#class#", 'bg-row', $designitem);
            }
$i++;
        $data.=$designitem;
    }
}
?>
<!--    <script type="text/javascript" src="js/jquery.js"></script>-->
<!--    <script type="text/javascript" src="js/ajax.js"></script>-->
<?php
$bredcrumb = '<li class="floating-left"><a href="user.php" class="floating-left active">'.$Lang->Users.'</a></li>';

include "includes/header.php";
?>
    <div class="user-container">
        <div class="display-table">
            <!--start table caption-->
            <div class="disply-table-caption table-title">
                <div class="display-table-cell number"><?= $Lang->IdUser ?></div>
                <div class="display-table-cell user"><?= $Lang->User ?></div>
                <div class="display-table-cell category"><?= $Lang->Password ?></div>
                <div class="display-table-cell book-title"><?= $Lang->EMail ?></div>
                <div class="display-table-cell Date"><?= $Lang->Date ?></div>
                <div class="display-table-cell created-at"><?= $Lang->Permession ?></div>
                <div class="display-table-cell width"><?= $Lang->FullName ?></div>
                <div class="display-table-cell height"><?= $Lang->Status ?> </div>
                <div class="display-table-cell action"><?= $Lang->Action ?></div>
            </div>
            <!--end table caption-->
            <?php
            echo $data;
            ?>
        </div>
        <a href="createuser.php" class="btn-default floating-right"><?= $Lang->CreateUser ?></a>
    </div>
<?php
//echo "<div id='maintabel'>".$data."</div>";
?>






<?php
include "includes/footer.php";
?>