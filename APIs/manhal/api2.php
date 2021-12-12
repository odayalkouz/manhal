<?php
//error_reporting(0);

class action
{

    /**
     * @url GET /costSubscribe
     */
    public function cost_subscribe()
    {
        global $con;
        $sql = "SELECT * FROM `cost_subscribe`";
        $result = $con->query($sql);
        $typesub = ['family', 'school'];
        $typesubd = ['month', 'year'];
        $costs = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $costs[$typesub[$row["type_user"]]][$typesubd[$row["type_cost"]]] = $row["cost"];
            $costs[$typesub[$row["type_user"]]]['rangeUser'] = $row["range_user"];
        }
        return $costs;
    }

    /**
     * @url GET /changepassword
     */
    public function ChangePassword($userid = '', $old_password = '', $new_password = '', $cpassword = '')
    {
        global $con;
        if ($old_password != '' && $new_password != "" && $userid != '') {
            if ($new_password == $cpassword) {
                $sql = "SELECT * FROM `users` WHERE `userid`=" . $userid . " AND `password`='" . $old_password . "'";
                $result = $con->query($sql);
                if (mysqli_num_rows($result) > 0) {
                    if (trim($new_password) != "") {
                        $sql = "UPDATE `users` SET `password`='" . $new_password . "' WHERE `userid`=" . $userid;
                        $con->query($sql);
                        return 'Change Password';
                    }
                } else {
                    return 'error new Password';
                }
            } else {
                return 'error new Password OR Confirm Password ';
            }

        } else {
            return 'error Change Password ';
        }
    }

    /**
     * @url GET /forgotpassword
     * * @url POST /forgotpassword
     */
    public function ForgotPassword($email, $lang = 'En')
    {
        global $con;
        $sql = "SELECT * FROM users WHERE email='" . $email . "' AND status=1 AND (`social` is Null or `social`='')";

        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $token = $this->getToken(6);
            $row = mysqli_fetch_assoc($result);
            $sql = "UPDATE `users` SET `token`='" . $token . "' WHERE `userid`=" . $row['userid'];
            $con->query($sql);
            $data_array = [];
            $data_array['userid'] = $row['userid'];
            $data_array['token'] = $token;
            $data_array['oldpassword'] = $row['password'];
        } else {
            return 'Error Email';
        }
        $message = file_get_contents( "../../templates/forget_pass_" . $lang . ".html");
        $logo = SITE_URL . "images/logo.png";
       $message = str_replace("#Manhal_logo#", $logo, $message);
        $message = str_replace("#Manhal_Username#", $row['uname'], $message);
       $message = str_replace("#Link#", "code=" . $token, $message);
        $to = $row["email"];
       // $to = 'k.alomiri@manhal.com ';
        $subject = 'Manhal.com Forgotten Password Reset';
        $headers = "From: " . strip_tags(CONTACT_EMAIL) . "\r\n";
        $headers .= "Reply-To: " .strip_tags(CONTACT_EMAIL) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
       // return $data_array;
        if (mail($to, $subject, $message, $headers)) {
            return $data_array;
           // return 'Send Email';
        } else {
            return 'Cannot Send Email';
          //  return(error_get_last());
        }

    }

    /**
     * @url GET /checktokenpassword
     */
    public function CheckTokenCodePassword($email, $token)
    {
        global $con;
        $sql = "SELECT * FROM users WHERE email='" . $email . "' AND token='" . $token . "' AND status=1 AND (`social` is Null or `social`='')";
        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $data_array = [];
            $data_array['userid'] = $row['userid'];
            $data_array['oldpassword'] = $row['password'];
            return $data_array;
        } else {
            return 'error';
        }
    }


    /**
     * @url GET /activateuser
     */
    public function ActivateUser($userid = '', $code = '')
    {
        global $con;
        $resultData = array("result" => 0, "msg" => "");
        $sql = "SELECT `payment_subscribe`.*,`payments`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`status`=1 AND `payment_subscribe`.`users_code`='" . mysqli_real_escape_string($con, $code) . "'";
        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if (strtotime($row["expire_date"]) > time()) {
                if ($row["students_active"] < $row["students_allowed"]) {
                    $sql = "UPDATE `users` SET `permession`=10,`activation_code`='" . mysqli_real_escape_string($con, $code) . "' WHERE `userid`=" . $userid;
                    if ($con->query($sql)) {
                        $_SESSION["user"]["permession"] = 10;
                        $sql = "UPDATE `payment_subscribe` SET `students_active`=`students_active`+1 WHERE `psid`=" . $row["psid"];
                        if ($con->query($sql)) {
                            $resultData["result"] = 1;
                        } else {//Unexpected Error
                            $resultData["result"] = 0;
                            $resultData["msg"] = "An unexpected error occurred Err: 1910171135";
                        }
                    } else {//Unexpected Error
                        $resultData["result"] = 0;
                        $resultData["msg"] = "An unexpected error occurred Err: 1910171136";
                    }
                } else {//account reach maximum allowed
                    $resultData["result"] = 0;
                    $resultData["msg"] = "You have reached the maximum number of allowed students accounts";
                }
            } else {//code expiered
                $resultData["result"] = 0;
                $resultData["msg"] = "This activation code has been expired";
            }
        } else {//invalid code for studen check for teacher
            $sql = "SELECT `payment_subscribe`.*,`payments`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`status`=1 AND `payment_subscribe`.`teachers_code`='" . mysqli_real_escape_string($con, $code) . "'";
            $result = $con->query($sql);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                if (strtotime($row["expire_date"]) > time()) {
                    if ($row["teachers_active"] < $row["teachers_allowed"]) {
                        $sql = "UPDATE `users` SET `permession`=11,`activation_code`='" . mysqli_real_escape_string($con, $code) . "' WHERE `userid`=" . $userid;
                        if ($con->query($sql)) {
                            $_SESSION["user"]["permession"] = 11;
                            $sql = "UPDATE `payment_subscribe` SET `teachers_active`=`teachers_active`+1 WHERE `psid`=" . $row["psid"];
                            if ($con->query($sql)) {
                                $resultData["result"] = 1;
                            } else {//Unexpected Error
                                $resultData["result"] = 0;
                                $resultData["msg"] = "An unexpected error occurred Err: 1910171135";
                            }
                        } else {//Unexpected Error
                            $resultData["result"] = 0;
                            $resultData["msg"] = "An unexpected error occurred Err: 1910171136";
                        }
                    } else {//account reach maximum allowed
                        $resultData["result"] = 0;
                        $resultData["msg"] = "You have reached the maximum number of allowed teachers accounts";
                    }
                } else {//code expiered
                    $resultData["result"] = 0;
                    $resultData["msg"] = "This activation code has been expired";
                }
            } else {//invalid code for studen
                $resultData["result"] = 0;
                $resultData["msg"] = "Invalid activation code";
            }
        }
        return $resultData;
    }


    /**
     * @url POST /membership
     * @url GET /membership
     */
    public function Membership($userid)
    {
        global $con;
        $arrays = [];

        $sql = "SELECT `permession`,`activation_code` FROM `users` WHERE `userid`=" . $userid;

        $result = $con->query($sql);
        $row = mysqli_fetch_assoc($result);

        switch ($row['permession']) {
            case 10:
                $arrays['is_expired'] = '1';
                if ($row['activation_code'] != '') {
                    $sqlcod = "SELECT count(*)as counts,payment_subscribe.*,payments.payment_date FROM `payment_subscribe` LEFT JOIN payments ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `users_code`='" . $row['activation_code'] . "'";
                    $resultcod = $con->query($sqlcod);
                    $rowcod = mysqli_fetch_assoc($resultcod);
                    if ($rowcod['counts'] >= 1) {

                        $arrays['info'] = $resultcod;
                        if ($rowcod['userid'] == $userid) {
                            $arrays['type'] = 'owner';
                        } else {
                            $arrays['type'] = 'student';
                        }
                    }

                } else {
                    $sqlcod = "SELECT count(*)as counts,payment_subscribe.*,payments.payment_date FROM `payment_subscribe` LEFT JOIN payments ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE payment_subscribe.`userid`=" . $userid;

                    $resultcod = $con->query($sqlcod);
                    $rowcod = mysqli_fetch_assoc($resultcod);

                    if ($rowcod['counts'] >0) {

                        $arrays['info'] = $resultcod;

                        if ($rowcod['userid'] == $userid) {
                            $arrays['type'] = 'owner';
                        } else {
                            $arrays['type'] = 'student';
                        }
                    }

                }
                break;
            case 11:
                $arrays['is_expired'] = '1';
                /// if($row['activation_code']!=''){
                $sqlcod = "SELECT count(*)as counts,payment_subscribe.*,payments.payment_date FROM `payment_subscribe` LEFT JOIN payments ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `teachers_code`='" . $row['activation_code'] . "'";
                $resultcod = $con->query($sqlcod);
                $rowcod = mysqli_fetch_assoc($resultcod);
                if ($rowcod['counts'] >= 1) {

                    $arrays['info'] = $resultcod;

                    if ($rowcod['userid'] == $userid) {
                        $arrays['type'] = 'owner';
                    } else {
                        $arrays['type'] = 'teacher';
                    }
                }

                //}
                break;
            default:
                $sql = "SELECT `payments`.*,`payment_subscribe`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`userid`=" . $userid . " ORDER BY `payment_subscribe`.`expire_date` DESC LIMIT 1";
                $result = $con->query($sql);
                //$oldsubscribe = mysqli_fetch_assoc($result);
                $arrays['type'] = 'notsubscribed';
                $arrays['is_expired'] = '0';
                $arrays['info'] =$result;
                break;
        }


        return $arrays;


        /*

        $sql = "SELECT  count(*) as counts, `payments`.payment_date,`payment_subscribe`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid`  WHERE `payments`.`userid`=" . (int)$userid . " ORDER BY `payments`.`paymentid` DESC LIMIT 0,1";
        $result = $con->query($sql);
        $row = mysqli_fetch_assoc($result);

        $sqluser ="SELECT `permession` FROM `users` WHERE `userid`=".$userid;
        $resultuser = $con->query($sqluser);
        $rows = mysqli_fetch_assoc($resultuser);
        if ($row['counts'] == 1) {
            $arrays['info']=$result;
            if($rows['permession']==10) {
                $arrays['type'] = 'owner';
            }else {
                $arrays['type'] = 'expire';
            }

        }else{
            if($rows['permession']==10) {
                $arrays['type'] = 'student';
            }else if($rows['permession']==11){
                $arrays['type'] = 'teacher';
            }else{
                $arrays['type'] = 'notsubscribed';
            }
        }
        return $arrays;*/

    }

    /**
     * @url GET /subscrib
     */
    public function CheckedSubscrib($userid)
    {
        global $con;
        if ($userid < 1) {
            return array("result" => 0, "msg" => 'User is not  subscribed OR User is guest ');
        }
        $checksql = "SELECT count(*) as count FROM `users` WHERE `userid`=" . (int)$userid . " and `permession`=0";
        $result = $con->query($checksql);
        $row = mysqli_fetch_assoc($result);
        if ($row['count'] == 0) {

            return array("result" => 1, "msg" => 'User is  subscribed');
        } else {

            return array("result" => 0, "msg" => 'User is not  subscribed');
        }
    }

    /**
     * @url GET /cancelsubscribe
     */
    public  function cancelsubscription($userid = '',$reason='',$canceldate=''){
        global $con;
        if ($userid < 1 || $userid =='') {
            return 'error user or usersAccounts';
        }
        $date=date('Y-m-d');
        $checksql = "SELECT * FROM `payment_subscribe` WHERE `userid`=" . $userid ." and `expire_date` >'".$date."'" ;
        $result = $con->query($checksql);
        $row = mysqli_fetch_assoc($result);
        $cancelsubscription="UPDATE `users` SET `permession`=0 WHERE `activation_code`='".$row['users_code']."'";
        $con->query($cancelsubscription);
        $cancelsubscription="UPDATE `users` SET `permession`=0 WHERE `activation_code`='".$row['teachers_code']."'";
        $con->query($cancelsubscription);
        $expire = date('Y-m-d', strtotime("-1 days"));
        $updatesql = "UPDATE `payment_subscribe` SET `expire_date`='".$expire."' WHERE `userid`=".$userid ." and `expire_date` >'".$date."'" ;
        $con->query($updatesql);
        $transaction=json_encode(['reason'=>$reason,'canceldate'=>$canceldate]);
        $updatepaymentssql = "UPDATE `payments` SET `transaction`='".$transaction."' WHERE `userid`=".$userid." AND `paymentid`='".$row['paymentid']."'" ;
        $con->query($updatepaymentssql);
        return 'cancelsubscribe';
    }


    /**
     * @url GET /paymentsubscribe
     */

    public function PaymentSubscribe($userid = '', $type = 'Parents', $subscribe = 'Monthly', $usersAccounts = 0, $months_years = 0, $payment = '', $qty,$transaction='',$subscribe_type='new')
    {
        global $con;
        if ($userid < 1 || $usersAccounts < 1) {
            return 'error user or usersAccounts';
        }

        $this->parm = $this->calcSubscribe($type, (int)$usersAccounts);
        $this->usersAccounts = (int)$this->parm['useraccount'];
        if ($subscribe == 'Monthly') {
            $this->type_cost = 0;
        } else {
            $this->type_cost = 1;
        }

        $this->type_user = $this->parm['type'];
        $sql = "SELECT * FROM `cost_subscribe` WHERE `type_user`=" . $this->type_user . " AND `type_cost`=" . $this->type_cost;
        $result = $con->query($sql);
        $row = mysqli_fetch_assoc($result);
        $this->id = "subscribe" . uniqid();
        $this->type = $type;
        $this->total = $this->usersAccounts * $row["cost"] * (int)$months_years;
        $this->GrandTotal = $this->total;
        $this->cost = $row["cost"] * $this->usersAccounts;
        $this->qty = $qty;

        $checksql = "SELECT count(*) as count FROM `users` WHERE `userid`=" . $userid . " and `permession`=0";

        $result = $con->query($checksql);
        $row = mysqli_fetch_assoc($result);

        if ($row['count'] != 0) {
            $this->savePaymentsubscribeToDB($userid, $this->total, $payment, $subscribe, $this->usersAccounts, $this->cost, $this->GrandTotal, $this->type, $qty,$transaction,$subscribe_type,$months_years);
        } else {
        return 'error user is subscribe';
        }


    }

    private function savePaymentsubscribeToDB($userid, $total, $payment, $subscribe, $usersAccounts, $cost, $GrandTotal, $type, $qty,$transaction,$subscribe_type,$months_years)
    {
        global $con;
        $ref = "subscribe_" . uniqid();
        $sql = "INSERT INTO `payments`(`paymentid`, `userid`, `total_price`, `status`, `payment_date`, `transaction`, `manhal_ref`, `payment_type`, `exported`, `products_price`) VALUES (''," . $userid . "," . $total . ",1,NOW(),'" . $transaction . "','" . $ref . "','" . $payment . "',1," . $total . ")";
        if ($con->query($sql)) {
            $paymentid = mysqli_insert_id($con);
            $this->inserPaymentSubscribe($paymentid, $subscribe, $usersAccounts, $userid, $cost, $GrandTotal, $type, $qty,$months_years,$subscribe_type);
            $sql = "UPDATE users set `permession`=10 WHERE `userid`=" . $userid;
            $con->query($sql);
            return "success";
        } else {
            //  echo $sql;
            return "Unexpected error occured Err: 2302170454";
        }
    }

    private function inserPaymentSubscribe($paymentid, $subscribe, $usersAccounts, $userid, $cost, $GrandTotal, $type,$qty=1,$months_years=1,$subscribe_type='new')
    {
        global $con;

/*
        if ($subscribe == "Monthly") {
            $expire = date('Y-m-d', strtotime("+30 days"));
        } else {
            $expire = date('Y-m-d', strtotime("+365 days"));
        }
        $teachers = floor($usersAccounts / 10);

        $sql = "INSERT INTO `payment_subscribe`(`psid`, `paymentid`, `userid`, `accounts_number`, `price`, `total_price`, `subscribe_type`, `teachers_allowed`, `students_allowed`, `teachers_active`, `students_active`, `users_code`,`teachers_code`, `expire_date`,`subscribe_usertype`,`status`,`qty`) VALUES (''," . $paymentid . "," . $userid . "," . $usersAccounts . "," . $cost . "," . $GrandTotal . ", '" . $subscribe . "'," . $teachers . "," . $usersAccounts . ",0,0,'" . $this->generateStrongPassword(12, false, "lud") . "','" . $this->generateStrongPassword(12, false, "lud") . "','" . $expire . "','" . $type . "',1,'" . $qty . "')";
        $con->query($sql);
        */


        if ($subscribe == "Monthly") {
            $qtyDays = $months_years * 30;
            $expire = date('Y-m-d', strtotime("+" . $qtyDays . " days"));
        } else {
            $qtyDays = $months_years * 365;
            $expire = date('Y-m-d', strtotime("+" . $qtyDays . " days"));
        }
        $teachers = floor($usersAccounts / 10);

        if (isset($subscribe_type) && $subscribe_type == "renew") {
            $sql = "SELECT `payments`.*,`payment_subscribe`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`userid`=" . $userid . " ORDER BY `payments`.`paymentid` DESC";
            $result = $con->query($sql);
            $oldsubscribe = mysqli_fetch_assoc($result);
            if ($subscribe == "Monthly") {
                $qtyDays = $months_years * 30;
                $expire = date('Y-m-d', strtotime("+" . $qtyDays . " days", strtotime($oldsubscribe["expire_date"])));
            } else {
                $qtyDays = $months_years * 365;
                $expire = date('Y-m-d', strtotime("+" . $qtyDays . " days", strtotime($oldsubscribe["expire_date"])));
            }
            $sql = "UPDATE `payment_subscribe` SET `paymentid`=" . $paymentid . ",`price`=" . $cost . ",`total_price`=`total_price`+" . $GrandTotal . ",`subscribe_type`='" . $subscribe . "',`expire_date`='" . $expire . "',`status`=1,`qty`=" . $months_years . " WHERE `psid`=" . $oldsubscribe["psid"];
            $con->query($sql);

        } elseif (isset($subscribe_type) && $subscribe_type == "upgrade") {
            $sql = "SELECT `payments`.*,`payment_subscribe`.* FROM `payments` INNER JOIN `payment_subscribe` ON `payments`.`paymentid`=`payment_subscribe`.`paymentid` WHERE `payments`.`userid`=" . $userid . " ORDER BY `payments`.`paymentid` DESC";
            $result = $con->query($sql);
            $oldsubscribe = mysqli_fetch_assoc($result);

            $sql = "UPDATE `payment_subscribe` SET `paymentid`=" . $paymentid . ",`accounts_number`=" . $usersAccounts . ",`price`=" . $cost . ",
        `total_price`=`total_price`+" . $GrandTotal . ",`subscribe_type`='" . $subscribe . "',`teachers_allowed`=" . $teachers . ",
        `students_allowed`=" . $usersAccounts . ",`status`=1,`qty`=`qty`+" . $months_years . " WHERE `psid`=" . $oldsubscribe["psid"];
            $con->query($sql);
        } else {
            $activcode=$this->generateStrongPassword2(12, false, "lud");
            $sql = "INSERT INTO `payment_subscribe`(`psid`, `paymentid`, `userid`, `accounts_number`, `price`, `total_price`, `subscribe_type`, `teachers_allowed`, `students_allowed`, `teachers_active`, `students_active`, `users_code`,`teachers_code`, `expire_date`,`subscribe_usertype`,`status`,`qty`) VALUES (''," . $paymentid . "," . $userid . "," . $usersAccounts . "," . $cost . "," . $GrandTotal . ", '" . $subscribe . "'," . $teachers . "," . $usersAccounts . ",0,0,'" . $activcode . "','" . $this->generateStrongPassword2(12, false, "lud") . "','" . $expire . "','" . $type . "',1," . $months_years . ")";
            $con->query($sql);

            $sql = "UPDATE users set `activation_code`='".$activcode."' WHERE `userid`=" . $userid;
            $con->query($sql);


        }

    }


    private function generateStrongPassword2($length = 9, $add_dashes = false, $available_sets = 'luds')
    {
        $sets = array();
        if (strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if (strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if (strpos($available_sets, 'd') !== false)
            $sets[] = '23456789';
        if (strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%&*?';
        $all = '';
        $password = '';
        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for ($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];
        $password = str_shuffle($password);
        if (!$add_dashes)
            return $password;
        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while (strlen($password) > $dash_len) {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }


    private function calcSubscribe($type, $usersAccounts)
    {
        if ($type == 'Parents') {
            $type_user = 0;
            if ((int)$usersAccounts > 3) {
                $usersAccounts = 3;
            } elseif ((int)$usersAccounts < 1) {
                $usersAccounts = 1;
            }
        } else {
            $type_user = 1;
            if ((int)$usersAccounts < 10) {
                $usersAccounts = 10;
            }
        }
        return array('useraccount' => $usersAccounts, 'type' => $type_user);
    }

    private function generateStrongPassword($length = 9, $add_dashes = false, $available_sets = 'luds')
    {
        $sets = array();
        if (strpos($available_sets, 'l') !== false)
            $sets[] = 'abcdefghjkmnpqrstuvwxyz';
        if (strpos($available_sets, 'u') !== false)
            $sets[] = 'ABCDEFGHJKMNPQRSTUVWXYZ';
        if (strpos($available_sets, 'd') !== false)
            $sets[] = '23456789';
        if (strpos($available_sets, 's') !== false)
            $sets[] = '!@#$%&*?';
        $all = '';
        $password = '';
        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
            $all .= $set;
        }
        $all = str_split($all);
        for ($i = 0; $i < $length - count($sets); $i++)
            $password .= $all[array_rand($all)];
        $password = str_shuffle($password);
        if (!$add_dashes)
            return $password;
        $dash_len = floor(sqrt($length));
        $dash_str = '';
        while (strlen($password) > $dash_len) {
            $dash_str .= substr($password, 0, $dash_len) . '-';
            $password = substr($password, $dash_len);
        }
        $dash_str .= $password;
        return $dash_str;
    }

    /**
     * @url GET /category
     */
    public function category($type)
    {
        global $con;
        $this->conn = $con;
        switch ($type) {
            case 'media':
            case 'books':
                $tabel = 'categories';
                break;
            case 'story':
                $tabel = 'stories_cat';
                break;
            default:
                return Array('error' => 'Type error');
        }
        $sql = "Select `catid`,`name_ar`,`name_en` From  " . $tabel . " WHERE `parent`=0";
        $result = $this->conn->query($sql);
        return $result;
    }

    /**
     * @url GET /media
     */
    public function CheckMedia($type = '', $keyword = '', $category = 0, $from = '', $to = '', $series = 0, $storytype = '', $lang = '', $booktype = '', $id = '', $userid = '')
    {
        $FromTo = '';
        if ($to != '' && $to > 0) {
            if ($from == '') {
                $from = 0;
            }
            $FromTo = " LIMIT " . $from . ", " . (int)$to;
        }
        if ($id != '') {
            $id = (int)$id;
        }
        switch ($type) {
            case 'books':
                if ($id != '') {
                    return $this->getBookDetails($id, $userid);
                } else {

                    return $this->getbook($keyword, $category, $FromTo, $lang, $booktype);
                }
                break;


            case 'stories':
                if ($id != '') {
                    return $this->getStoryDetails($id, $userid);
                } else {
                    return $this->getstory($keyword, $category, $FromTo, $series, $storytype);
                }
                break;
            case 'worksheet':
            case 'interactive-worksheets':
            case 'games':
            case 'video':
            case 'sound':
                if ($id != '') {
                    return $this->getMediaDetails($id, $this->GetTypeMediaID($type), $userid);
                } else {
                    return $this->getmedia($this->GetTypeMediaID($type), $keyword, $category, $FromTo);
                }
                break;
            case 'getComment':


                break;
        }
    }

    /**
     * @url GET /allmedia
     */
    public function AllMedia($from = '', $to = '', $no = 0)
    {
        $filter = 'recent';
        $data_array = [];
        $FromTo = '';
        if ($to != '' && $to > 0) {
            if ($from == '') {
                $from = 0;
            }
            $FromTo = " LIMIT " . $from . ", " . (int)$to;
        }
        $data_array['books'] = $this->FilterBooks($filter, $FromTo, 0);
        $data_array['stories'] = $this->FilterStories($filter, $FromTo, 0);
        $data_array['worksheet'] = $this->FilterMedia($filter, $FromTo, 0, 0);
        $data_array['interactive-worksheets'] = $this->FilterMedia($filter, $FromTo, 0, 0);
        $data_array['games'] = $this->FilterMedia($filter, $FromTo, 11, 0);
        $data_array['video'] = $this->FilterMedia($filter, $FromTo, 4, 0);
        $data_array['sound'] = $this->FilterMedia($filter, $FromTo, 3, 0);
        return $data_array;
    }

    /**
     * @url GET /filter
     */
    public function FiltersMedia($type = '', $filter = '', $from = '', $to = '', $no = 0)
    {
        $FromTo = '';
        if ($to != '' && $to > 0) {
            if ($from == '') {
                $from = 0;
            }
            $FromTo = " LIMIT " . $from . ", " . (int)$to;
        }
        $no = (int)$no;
        switch ($type) {
            case 'books':
                return $this->FilterBooks($filter, $FromTo, $no);
                break;
            case 'stories':
                return $this->FilterStories($filter, $FromTo, $no);
                break;
            case 'worksheet':
                return $this->FilterMedia($filter, $FromTo, 0, $no);
                break;
            case 'interactive-worksheets':
                return $this->FilterMedia($filter, $FromTo, 12, $no);
                break;
            case 'games':
                return $this->FilterMedia($filter, $FromTo, 11, $no);
                break;
            case 'video':
                return $this->FilterMedia($filter, $FromTo, 4, $no);
                break;
            case 'sound':
                return $this->FilterMedia($filter, $FromTo, 3, $no);
                break;

        }
    }

    /**
     * @url GET /related
     */
    public function RelatedMedia($type = '', $id = '', $from = '', $to = '')
    {
        $FromTo = " LIMIT 8";
        if($from!=''&&$to!=''){
            $FromTo = " LIMIT " . $from . ", " . (int)$to;
        }
        switch ($type) {
            case 'books':
                return $this->RelatedBooksFilter($id,$FromTo);
                break;
            case 'stories':
                return $this->RelatedStoriesFilter($id,$FromTo);
                break;
            case 'worksheet':
                return $this->RelatedMediaFilter($id, 0,$FromTo);
                break;
            case 'interactive-worksheets':
                return $this->RelatedMediaFilter($id, 12,$FromTo);
                break;
            case 'games':
                return $this->RelatedMediaFilter($id, 11,$FromTo);
                break;
            case 'video':
                return $this->RelatedMediaFilter($id, 4,$FromTo);
                break;
            case 'sound':
                return $this->RelatedMediaFilter($id, 3,$FromTo);
                break;
            default:
                return 'error type';
                break;
        }
    }

    /**
     * @url GET /getcomments
     */
    public function Comment($id = '', $type = '', $to = '', $from = '')
    {
        $FromTo = '';
        if ($to != '' && $to > 0) {
            if ($from == '') {
                $from = 0;
            }
            $FromTo = " LIMIT " . $from . ", " . (int)$to;
        }
        if ($id != '') {
            $id = (int)$id;
        }
        // $type = preg_replace('/[^a-zA-Z0-9._-]/', '', $type);
        if ($type == 'books') {
            $type = 'book';
        } else if ($type == 'stories') {
            $type = 'story';
        } else if ($type == 'sound') {
           // $type = 'audio';
        }
        switch ($type) {
            case 'worksheet':
            case 'interactive-worksheets':
            case 'book':
            case 'story':
            case 'video':
            case 'games':
            case 'audio':case 'sound':
                return $this->getComments($type, $id, $FromTo);
                break;
            default:
                return 'error type';
                break;
        }
    }

    /**
     * @url POST /setcomments
     * @url GET /setcomments
     */
    public function InsertComment($userid = '', $comment = '', $id = '', $type = '', $rate = '')
    {

        global $con;
        $this->conn = $con;
        if ($userid == '' ||  $id == '' || $type == '') {
            return 'error parameter empty';
        }
        $this->$id = (int)$id;
        $this->CheckId = false;

        if ($type == 'books') {
            $type = 'book';
            $this->CheckId = $this->CheckBookId($this->$id);
        } else if ($type == 'stories') {
            $type = 'story';
            $this->CheckId = $this->CheckStoryId($this->$id);
        } else if ($type == 'worksheet' || $type == 'interactive-worksheets' || $type == 'video' || $type == 'games' || $type == 'audio' || $type == 'sound') {
            $this->CheckId = $this->CheckMediaId($this->$id);
        } else {
            return 'error in type';
        }
        if ($this->CheckUserId((int)$userid) && $this->CheckId == true) {

            if (!$this->CheckCommentsId($this->$id, (int)$userid, $type)) {
                $sql = "INSERT INTO `comments`(`idcomments`, `userid`, `comment`, `productid`, `state`, `type`) VALUES (''," . $userid . ",'" . mysqli_real_escape_string($this->conn, $comment) . "'," . $this->$id . ",1,'" . $type . "')";
                $this->conn->query($sql);
                switch ($type) {
                    case "book":
                        $sql = "UPDATE `books` SET `comments`=`comments`+1 WHERE `bookid`=" . $this->$id;
                        $this->conn->query($sql);
                        break;
                    case "story":
                        $sql = "UPDATE `story` SET `comments`=`comments`+1 WHERE `storyid`=" . $this->$id;
                        $this->conn->query($sql);
                        break;
                    case 'worksheet':
                    case 'interactive-worksheets':

                    case 'video':
                    case 'games':
                    case 'audio':
                    case 'sound':

                        $sql = "UPDATE `media` SET `comments`=`comments`+1 WHERE `id`=" . $this->$id;
                        $this->conn->query($sql);
                        break;
                }
                if ($rate != '') {
                    $this->setRating($id, $userid, $type, $rate);
                }
                return true;
            } else {

                $sql = "UPDATE `comments` SET `comment`='" . mysqli_real_escape_string($this->conn, $comment) . "' WHERE `userid`=" . $userid . " and `productid`=" . $this->$id . " and `type`='" . $type . "'";
                $this->conn->query($sql);
                return $this->updateRating($this->$id, $userid, $type, $rate);
            }

        } else {
            $arr = [];
            $arr['user'] = $this->CheckUserId((int)$userid);
            $arr['id'] = $this->CheckId;
            if ($this->CheckCommentsId($this->$id, (int)$userid, $type)) {
                $arr['comment'] = 'Can not comment more than once';
            } else {
                $arr['comment'] = true;
            };
            return $arr;
        }
    }

    /**
     * @url POST /removecomments
     * @url GET /removecomments
     */
    public function RemoveComment($userid = '', $id = '', $type = '', $rate = '')
    {
        global $con;
        $this->conn = $con;


        if ($type == 'books') {
            $type = 'book';
        } else if ($type == 'stories') {
            $type = 'story';
        } else if ($type == 'sound') {
            $type = 'audio';
        }


        $sql = "SELECT * FROM `comments` WHERE `userid`=" . (int)$userid . " and `productid`=" . (int)$id . " and`type`='" . $type . "'";

        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $sql = "DELETE FROM `comments` WHERE `userid`=" . (int)$userid . " and `productid`=" . (int)$id . " and`type`='" . $type . "'";
            $this->conn->query($sql);
            $sql = "DELETE FROM `rating` WHERE `userid`=" . (int)$userid . " and `bookid`=" . (int)$id . " and`rating`='" . (int)$rate . "'";
            $this->conn->query($sql);
            $this->updateRatingCountEdit($id, $type, -1);
            return Array('Comment' => 'deleted');
        } else {
            return Array('error' => 'Comment does not exist');
        }
    }

    /**
     * @url GET /screenshots
     */
    public function GetScreenShots($type = '', $id = '', $series = '')
    {
        $images = [];

        switch ($type) {
            case 'books':
            case 'book':
                $path = "platform/books/" . $id . "/screenshoots/";
                break;
            case 'stories':
            case 'story':
                $path = "platform/stories/" . $series . "/story/" . $id . "/images/screenshoots/";
                break;
            default:
                return $images;

        }

        if (is_dir('../../' . $path)) {
            $files = scandir('../../' . $path);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    $images[]['file'] = SITE_URL . $path . $file;
                }
            }
        }
        return $images;
    }
    /**
     * @url POST /login
     */
    public function LoginUser($type = '', $social = '', $name = '', $fname = '', $lname = '', $gender = '', $email = '', $email2 = '', $pass = '', $pass2 = '', $avatar = '')
    {
        // $name = preg_replace('/[^a-zA-Z0-9._-]/', '', $name);
        // $pass = preg_replace('/[^a-zA-Z0-9]/', '', $pass);
        switch ($type) {
            case 'signin':
                $_user=true;
                $_pass=true;
                $usermsg='';
                if ($name == '' || $pass == '') {
                    if($name == ''){
                        $_user=false;
                        $usermsg='error2';
                    }
                    if($pass == ''){
                        $_pass=false;
                        $passmsg='error5';
                    }
                    $account=Array('uname'=>-1,'subscribe'=>-1,'fullname'=>-1,'country'=>-1,'gender'=>-1,'userid'=>-1,'avatar'=>-1);
                    return Array('account'=>[$account],'user' =>['check'=>$_user,'reason'=>$usermsg],'pass'=>['check'=>$_pass,'reason'=>$passmsg]);
                }
                return $this->signin($email,$pass);
                break;
            case 'signup':
                if ($this->username_v($name)['check'] and $this->email_v($email, $email2)['check'] and $this->pass_v($pass, $pass2)['check']) {

                    return $this->signup($email,$pass,$name);
                } else {
                    $account=Array('uname'=>-1,'subscribe'=>-1,'fullname'=>-1,'country'=>-1,'gender'=>-1,'userid'=>-1,'avatar'=>-1);
                    return Array('account'=>[$account],'user' =>['check'=> $this->username_v($name)['check'],'reason'=>$this->username_v($name)['reason']],'email' => ['check'=> $this->email_v($email, $email2)['check'],'reason'=>$this->email_v($email, $email2)['reason']],'pass'=>['check'=> $this->pass_v($pass, $pass2)['check'],'reason'=>$this->pass_v($pass, $pass2)['reason']]);

                }
                break;
            case 'facebook':
            case 'google':
            case 'twitter':
                return $this->SocialLogin($social, $name, $fname, $lname, $gender, $email, $avatar);
        }
    }

    /**
     * @url POST /updatecomments
     */
    public function UpdateComment()
    {

    }

    /**
     * @url POST /download
     * * @url GET /download
     */
    public function AppsDownload($iduser = 0, $idproduct = 0, $type = '', $remove = '')
    {
        if ($type != '') {
            switch ($type) {
                case 'books':
                    $type = 'book';
                    break;
                case 'stories':
                    $type = 'story';
                    break;
                case 'worksheet':
                case 'interactive-worksheets':
                case 'games':
                case 'video':
                case 'sound':
                    break;
                default:
                    return 'error type';
                    break;
            }
        }

        if ($iduser < 2) {
            return 'error';
        }

        if ($remove == 'remove') {
            $this->removeMediaDownloadApps($iduser, $idproduct, $type);
        } else
            if ($this->CheckMediaDownloadApps($iduser, $idproduct, $type) === true && $iduser > 1 && $type != '' && $idproduct > 0) {
                $this->insertMediaDownloadApps($iduser, $idproduct, $type);
            } else if ($iduser > 1 && $type == '' && $idproduct == 0) {
                return $this->GetMediaDownloadApps($iduser);
            } else if ($iduser > 1 && $type != '' && $idproduct > 0) {
                return 'Previously downloaded';
            } else {
                return 'error';
            }
    }

    /**
     * @url POST /search
     * * @url GET /search
     */
    public function Search($type = '', $medai = '', $text = '', $lang = '', $to = '', $from = '',$category='all')
    {
        $FromTo = '';
        if ($to != '' && $to > 0) {
            if ($from == '') {
                $from = 0;
            }
            $FromTo = " LIMIT " . $from . ", " . (int)$to;
        }

        $data_array = [];
        switch ($type) {
            case 'suggestion':
                $books = $this->getbook($text, 0, $FromTo, $lang, 1);

                $stories = $this->getstory($text, 0, $FromTo, '', '', 1);
                $worksheet = $this->getmedia(0, $text, 0, $FromTo, 1);
                $interactiveworksheets = $this->getmedia(12, $text, 0, $FromTo, 1);

                $games = $this->getmedia(11, $text, 0, $FromTo, 1);
                $video = $this->getmedia(4, $text, 0, $FromTo, 1);
                $sound = $this->getmedia(3, $text, 0, $FromTo, 1);
                foreach ($books as $value) {

                    array_push($data_array, $value["title_$lang"]);
                }
                foreach ($stories as $value) {
                    $value['type'] = 'stories';
                    array_push($data_array, $value["title_$lang"]);
                }
                foreach ($worksheet as $value) {
                    $value['type'] = 'worksheet';
                    array_push($data_array, $value["title_$lang"]);
                }
                foreach ($interactiveworksheets as $value) {
                    $value['type'] = 'interactive-worksheets';
                    array_push($data_array, $value["title_$lang"]);
                }

                foreach ($games as $value) {
                    $value['type'] = 'games';
                    array_push($data_array, $value["title_$lang"]);
                }
                foreach ($video as $value) {
                    $value['type'] = 'video';
                    array_push($data_array, $value["title_$lang"]);
                }
                foreach ($sound as $value) {
                    $value['type'] = 'sound';
                    array_push($data_array, $value["title_$lang"]);
                }

                // array_push($data_array,$this->getbook($text, 0, $FromTo, '', ''),$this->getstory($text, 0, $FromTo, '', ''),$this->getmedia(0, $text, 0, $FromTo),$this->getmedia(11, $text, 0, $FromTo),$this->getmedia(4, $text, 0, $FromTo),$this->getmedia(3, $text, 0, $FromTo));
                /*$data_array['stories']=$this->getstory($text, 0, $FromTo, '', '');
                $data_array['worksheet']=$this->getmedia(0, $text, 0, $FromTo);
                $data_array['games']=$this->getmedia(11, $text, 0, $FromTo);
                $data_array['video']=$this->getmedia(4, $text, 0, $FromTo);
                $data_array['sound']=$this->getmedia(3, $text, 0, $FromTo);*/
                break;
            case 'media':
                $books = $this->getbook($text, 0, $FromTo, $lang, '', '');
                $stories = $this->getstory($text, 0, $FromTo, '', '', '');
                $worksheet = $this->getmedia(0, $text, 0, $FromTo, '');
                $interactiveworksheets = $this->getmedia(12, $text, 0, $FromTo, '');

                $games = $this->getmedia(11, $text, 0, $FromTo, '');
                $video = $this->getmedia(4, $text, 0, $FromTo, '');
                $sound = $this->getmedia(3, $text, 0, $FromTo, '');
                if($category=='all'||$category=='books'){
                    foreach ($books as $value) {
                        $value['type_cat'] = 'books';
                        array_push($data_array, $value);
                    }
                }
                if($category=='all'||$category=='stories') {
                    foreach ($stories as $value) {
                        $value['type_cat'] = 'stories';
                        array_push($data_array, $value);
                    }
                }
                if($category=='all'||$category=='worksheet') {
                    foreach ($worksheet as $value) {
                        $value['type_cat'] = 'worksheet';
                        array_push($data_array, $value);
                    }
                }
                if($category=='all'||$category=='interactive-worksheets') {
                    foreach ($interactiveworksheets as $value) {
                        $value['type_cat'] = 'interactive-worksheets';
                        array_push($data_array, $value);
                    }
                }
                if($category=='all'||$category=='games') {
                    foreach ($games as $value) {
                        $value['type_cat'] = 'games';
                        array_push($data_array, $value);
                    }
                }
                if($category=='all'||$category=='video') {
                    foreach ($video as $value) {
                        $value['type_cat'] = 'video';
                        array_push($data_array, $value);
                    }
                }
                if($category=='all'||$category=='sound') {
                    foreach ($sound as $value) {
                        $value['type_cat'] = 'sound';
                        array_push($data_array, $value);
                    }
                }
                // array_push($data_array,$this->getbook($text, 0, $FromTo, '', ''),$this->getstory($text, 0, $FromTo, '', ''),$this->getmedia(0, $text, 0, $FromTo),$this->getmedia(11, $text, 0, $FromTo),$this->getmedia(4, $text, 0, $FromTo),$this->getmedia(3, $text, 0, $FromTo));
                /*$data_array['stories']=$this->getstory($text, 0, $FromTo, '', '');
                $data_array['worksheet']=$this->getmedia(0, $text, 0, $FromTo);
                $data_array['games']=$this->getmedia(11, $text, 0, $FromTo);
                $data_array['video']=$this->getmedia(4, $text, 0, $FromTo);
                $data_array['sound']=$this->getmedia(3, $text, 0, $FromTo);*/
                break;
        }
        return $data_array;
    }


    private function SearchStories($text)
    {

    }

    private function SearchMedia($text)
    {

    }

    private function removeMediaDownloadApps($iduser, $idproduct, $type)
    {
        global $con;
        $this->conn = $con;
        $sql = "DELETE FROM `apps_download` WHERE `iduser`=" . $iduser . " and `iddownload`=" . $idproduct . " and `type`='" . $type . "'";
        if ($this->conn->query($sql)) {
            return 'remove download';
        } else {
            return 'error remove download';
        }
    }

    private function GetMediaDownloadApps($iduser)
    {
        global $con;
        $this->conn = $con;
        $filter = "IF(apps_download.`type`='book',`books`.bookid,IF(apps_download.`type`='story',story.storyid,media.id))as id , ";
        $filter .= "IF(apps_download.`type`='book','books',IF(apps_download.`type`='story','stories',apps_download.`type`))as type , ";
        $filter .= "IF(apps_download.`type`='story',`stories_cat`.`name_ar`,`categories`.`name_ar`)as categories_ar , ";
        $filter .= "IF(apps_download.`type`='story',`stories_cat`.`name_en`,`categories`.`name_en`)as categories_en , ";
        $filter .= "IF(apps_download.`type`='book','https://www.manhal.com/platform/books/###/cover.jpg',IF(apps_download.`type`='story','https://www.manhal.com/platform/stories/$$$/story/###/images/pic.jpg',IF(media.path='','https://www.manhal.com/platform/media/###/thumbnail_small.jpg','https://www.manhal.com/platform/games/###/images/thumb.jpg')))as thumbnail , ";
        $filter .= "IF(apps_download.`type`='book','',IF(apps_download.`type`='story','',IF(media.path='','',media.path)))as path , ";
        $filter .= "IF(apps_download.`type`='book',`books`.name,IF(apps_download.`type`='story',story.title,`media`.`title_ar`))as title_ar , ";
        $filter .= "IF(apps_download.`type`='book',`books`.name,IF(apps_download.`type`='story',story.title,`media`.`title_en`))as title_en , ";
        $filter .= "IF(apps_download.`type`='book',`books`.price,IF(apps_download.`type`='story',`story`.`price`,`media`.`price`))as price , ";
        $filter .= "IF(apps_download.`type`='book',`books`.rating_count,IF(apps_download.`type`='story',`story`.`rating_count`,`media`.`rating_count`))as rate , ";
        $filter .= "IF(apps_download.`type`='book','',IF(apps_download.`type`='story',`story`.`seriesid`,''))as seriesid , ";
        $filter .= "IF(apps_download.`type`='book',`books`.views,IF(apps_download.`type`='story',story.view_count,`media`.`views`))as views";
        $sql = "SELECT " . $filter . " FROM apps_download  LEFT JOIN books ON apps_download.iddownload = books.bookid  LEFT JOIN story ON apps_download.iddownload =story.storyid LEFT JOIN media ON apps_download.iddownload =media.id   LEFT JOIN categories ON books.category = categories.catid and apps_download.type='book' OR media.category =categories.catid and apps_download.type!='book'  LEFT JOIN stories_cat ON story.catid = stories_cat.catid      WHERE apps_download.`iduser`=" . $iduser;
        $result = $this->conn->query($sql);
       
        return $result;
    }

    private function CheckMediaDownloadApps($iduser, $idproduct, $type)
    {
        global $con;
        $this->conn = $con;

        $sql = "SELECT count(`iduser`) as count FROM `apps_download` WHERE `iduser`=" . $iduser . " AND `iddownload`=" . $idproduct . " AND`type`='" . $type . "'";
        $result = $this->conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        if ($row['count'] == "0") {
            return true;
        } else {
            return false;
        }

    }

    private function insertMediaDownloadApps($iduser, $idproduct, $type)
    {
        global $con;
        $this->conn = $con;
        $sql = "INSERT INTO `apps_download`(`id`, `iduser`, `iddownload`, `type`, `date`) VALUES (null," . $iduser . "," . $idproduct . ",'" . ($type) . "',CURDATE())";
        if ($this->conn->query($sql)) {
            return 'create download';
        }
    }

    private function FilterStories($filter, $FromTo, $No)
    {
        global $con;
        $this->conn = $con;


        $this->book_type = 'electronic';
        switch ($this->book_type) {
            case "electronic":
                $type_filter = " AND `story`.`type` in(2,3,6,7)";
                break;
            case "interactive":
                $type_filter = " AND `story`.`type` in(4,5,6,7)";
                break;
            case "paper";
                $type_filter = " AND `story`.`type` in(1,3,5,7)";
                break;
            default :
                $type_filter = " AND `story`.`type` in(1,3,5,7)";
                break;
        }
        $story = "(story.storyid)as id,story.seriesid,IF(story.thumb!='','https://www.manhal.com/platform/stories/$$$/story/###/images/pic.jpg','')as thumbnail,`story`.`rating_count` as rate,story.title as title_ar,story.title as title_en,story.price,story.rate,story.view_count as view,`story`.description_ar,`story`.description_en";
        switch ($filter) {
            case 'toprated':
                $sql = "Select  " . $story . " From   `story`  INNER JOIN   stories_cat categories1 On story.catid = categories1.catid WHERE story.status=1 " . $type_filter . " Group By   story.storyid Order By   story.rate Desc   " . $FromTo;
                break;
            case 'mostviewed':
                $sql = "Select  " . $story . " From  story story Inner Join   stories_cat categories1 On story.catid = categories1.catid WHERE story.status=1  " . $type_filter . " Group By   story.view_count Order By   view_count Desc  " . $FromTo;
                break;
            case 'recent':
                $sql = "SELECT " . $story . "  FROM `story` INNER JOIN `stories_cat` on `story`.`catid`=`stories_cat`.`catid` WHERE `story`.`status`=1 " . $type_filter . " GROUP BY `story`.`storyid` order by storyid DESC  " . $FromTo;
                break;
            case "bestseller":
                $sql = "SELECT " . $story . "  FROM `story` INNER JOIN `stories_cat` on `story`.`catid`=`stories_cat`.`catid` WHERE `story`.`status`=1 " . $type_filter . " GROUP BY `story`.`storyid` order by storyid DESC  " . $FromTo;
                break;
            case "topfavorite":
                $sql = "Select " . $story . " From   `story`  INNER JOIN   stories_cat categories1 On story.catid = categories1.catid  WHERE story.status=1 " . $type_filter . " Group By   story.storyid Order By   story.favorite_count Desc   " . $FromTo;
                break;
            case 'ar':
                $sql = "SELECT " . $story . "  FROM `story` INNER JOIN `stories_cat` on `story`.`catid`=`stories_cat`.`catid` WHERE `story`.`status`=1  And `story`.`language`='Ar' " . $type_filter . " GROUP BY `story`.`storyid` order by storyid DESC  " . $FromTo;
                break;
            case 'en':
                $sql = "SELECT " . $story . "  FROM `story` INNER JOIN `stories_cat` on `story`.`catid`=`stories_cat`.`catid` WHERE `story`.`status`=1  And `story`.`language`='En' " . $type_filter . " GROUP BY `story`.`storyid` order by storyid DESC  " . $FromTo;
                break;
            case 'categories':
                $sql = "SELECT " . $story . "  FROM `story` INNER JOIN `stories_cat` on `story`.`catid`=`stories_cat`.`catid` WHERE `story`.`status`=1   AND `story`.`catid` ='" . $No . "' " . $type_filter . " GROUP BY `story`.`storyid` order by storyid DESC  " . $FromTo;
                break;
            default:
                return 'error';
                break;
        }
        $result = $this->conn->query($sql);
        return $result;
    }

    private function FilterBooks($filter, $FromTo, $No)
    {
        global $con;
        $this->conn = $con;
        $books = "(`books`.bookid) as id ,IF(books.status=1,'https://www.manhal.com/platform/books/###/cover.jpg','')as thumbnail,`books`.name as title_ar ,`books`.name as title_en,`books`.price,`books`.`rate` as rate,`books`.`views`,`books`.description_ar,`books`.description_en";
        switch ($filter) {
            case 'toprated':
                $sql = "SELECT " . $books . " FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1   ORDER BY `books`.`rate` DESC " . $FromTo;
                break;
            case 'mostviewed':
                $sql = "SELECT " . $books . ", `books`.`rating_count` as rate_count FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1  GROUP BY `books`.`bookid` order by `books`.`views` DESC " . $FromTo;
                break;
            case 'recent':
                $sql = "SELECT " . $books . " FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1  GROUP BY `books`.`bookid` order by bookid DESC " . $FromTo;
                break;
            case "bestseller":
                $sql = "SELECT " . $books . " FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1  GROUP BY `books`.`bookid` order by `books`.`sales` DESC " . $FromTo;
                break;
            case "topfavorite":
                $sql = "SELECT " . $books . " FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1  GROUP BY `books`.`bookid` order by `books`.`favorites` DESC " . $FromTo;
                break;
            case 'ar':
                $sql = "SELECT " . $books . " FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1 And `books`.`language`='Ar'  GROUP BY `books`.`bookid` order by bookid DESC " . $FromTo;
                break;
            case 'en':
                $sql = "SELECT " . $books . " FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1 And `books`.`language`='En'  GROUP BY `books`.`bookid` order by bookid DESC " . $FromTo;
                break;
            case 'categories':
                $sql = "SELECT " . $books . " FROM `books` INNER JOIN `categories` on `books`.`category`=`categories`.`catid`  WHERE `books`.`status`=1 And `books`.`category`='" . $No . "'  GROUP BY `books`.`bookid` order by bookid DESC " . $FromTo;
                break;
            default:
                return 'error';
                break;
        }

        $result = $this->conn->query($sql);
        return $result;
    }

    private function FilterMedia($filter, $FromTo, $typesmedia, $No)
    {
        global $con;
        $this->conn = $con;
        $Media = "media.id,IF(media.path='','https://www.manhal.com/platform/media/###/thumbnail_small.jpg','https://www.manhal.com/platform/games/###/images/thumb.jpg') as thumbnail,media.filename,media.price,media.rate,media.title_ar,media.title_en,media.views,media.path,`media`.description_ar,`media`.description_en";
        switch ($filter) {
            case 'toprated':
                $sql = "Select " . $Media . "  From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=" . $typesmedia . " order by `media`.`rate` DESC" . $FromTo;
                break;
            case 'mostviewed':
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=" . $typesmedia . " order by `media`.`views` DESC" . $FromTo;
                break;
            case 'recent':
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=" . $typesmedia . " ORDER BY `media`.`price` ASC,`media`.`id` DESC" . $FromTo;
                break;
            case "bestseller":
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=" . $typesmedia . " order by `media`.`sales` DESC" . $FromTo;
                break;
            case "topfavorite":
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=" . $typesmedia . " order by `media`.`favorites` DESC" . $FromTo;
                break;
            case "ar":
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.language='Ar' And media.type=" . $typesmedia . " ORDER BY `media`.`price` ASC,`media`.`id` DESC" . $FromTo;
                break;
            case "en":
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.language='En' And media.type=" . $typesmedia . " ORDER BY `media`.`price` ASC,`media`.`id` DESC" . $FromTo;
                break;
            case 'categories':
                $sql = "Select " . $Media . " From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.category='" . $No . "' And media.type=" . $typesmedia . " ORDER BY `media`.`price` ASC,`media`.`id` DESC" . $FromTo;
                break;
            default:
                return 'error';
                break;
        }

        $result = $this->conn->query($sql);
        return $result;
    }

    private function RelatedBooksFilter($id,$FromTo)
    {
        global $con;
        static $filtercount = 7;
        static $totalRowsCount = 0;
        static $data_array = [];
        static $notin_array = [];
        $this->conn = $con;
        $data = $this->BookDetails($id);
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);
        $filter = '';
        switch ($filtercount) {
            case 0:
                $filter = " AND `category`=" . $row[0]["category"] . " AND `semester`='" . $row[0]["semester"] . "' AND `age`=" . $row[0]["age"] . " AND `grade`=" . $row[0]["grade"];
                break;
            case 1:
                $filter = " AND `category`=" . $row[0]["category"] . " AND `semester`='" . $row[0]["semester"] . "' AND `grade`=" . $row[0]["grade"];
                break;
            case 2:
                $filter = " AND `category`=" . $row[0]["category"] . "  AND `semester`='" . $row[0]["semester"] . "' AND `age`=" . $row[0]["age"];
                break;
            case 3:
                $filter = " AND `category`=" . $row[0]["category"] . "  AND `age`=" . $row[0]["age"] . " AND `grade`=" . $row[0]["grade"];
                break;
            case 4:
                $filter = " AND `category`=" . $row[0]["category"] . " AND `grade`=" . $row[0]["grade"];
                break;
            case 5:
                $filter = " AND `category`=" . $row[0]["category"] . "  AND `age`=" . $row[0]["age"];
                break;
            case 6:
                $filter = " AND `category`=" . $row[0]["category"] . "  AND `semester`=" . $row[0]["semester"];
                break;
            case 7:
                $filter = " AND `category`=" . $row[0]["category"];
                break;
        }
        if (count($notin_array) < 1) {
            $notin_array[] = $id;
        }
        $notin_array2 = implode(",", $notin_array);
        $books = "(`books`.bookid) as id ,IF(books.status=1,'https://www.manhal.com/platform/books/###/cover.jpg','')as thumbnail,`books`.name as title_ar ,`books`.name as title_en,`books`.price,`books`.`rating_count` as rate,`books`.`views`,`books`.description_ar,`books`.description_en";
        $sql = "SELECT " . $books . " FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status` =1  AND( `books`.`bookid`>0  " . $filter . " ) AND `books`.`bookid` NOT IN(" . $notin_array2 . ") ".$FromTo;
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $notin_array[] = $row['id'];
        }
        $notin_array = array_unique($notin_array);
        $result = $this->conn->query($sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $data_array = array_merge($data_array, $rows);
        $totalRowsCount += count($data_array);
       /* if ( $filtercount < 7) {
            $filtercount++;
            $this->RelatedBooksFilter($id);
        }*/
        return $data_array;
    }

    private function RelatedStoriesFilter($id,$FromTo)
    {
        global $con;
        static $filtercount =4;
        static $totalRowsCount = 0;
        static $data_array = [];
        static $notin_array = [];
        $this->conn = $con;
        $data = $this->StoryDetails($id);
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);
        $filter = '';
        $this->type = " AND `story`.`type`in(2,3,6,7)";
        switch ($filtercount) {
            case 0:
                $filter = " AND `series`.`category`=" . $row[0]["category"] . " AND `series`.`seriesid`=" . $row[0]["seriesid"] . " AND `story`.`age`=" . $row[0]["age"];
                break;
            case 1:
                $filter = " AND `series`.`category`=" . $row[0]["category"] . " AND `series`.`seriesid`=" . $row[0]["seriesid"];
                break;
            case 2:
                $filter = " AND `series`.`category`=" . $row[0]["category"] . " AND `series`.`seriesid`=" . $row[0]["seriesid"];
                break;
            case 3:
                $filter = " AND `series`.`category`=" . $row[0]["category"] . "  AND `story`.`age`=" . $row[0]["age"];
                break;
            case 4:
                $filter = " AND`series`.`category`=" . $row[0]["category"];
                break;
        }

        if (count($notin_array) < 1) {
            $notin_array[] = $id;
        }
        $notin_array2 = implode(",", $notin_array);
        $sql = "SELECT (story.storyid)as id,story.seriesid,IF(story.thumb!='','https://www.manhal.com/platform/stories/$$$/story/###/images/pic.jpg','')as thumbnail,`story`.`rating_count` as rate,story.title as title_ar,story.title as title_en,story.price,story.rate,story.view_count as view ,`story`.description_ar,`story`.description_en FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid`  WHERE `story`.`status`=1   " . $filter . $this->type . "  AND `story`.`storyid` NOT IN(" . $notin_array2 . ") ".$FromTo;
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $notin_array[] = $row['id'];
        }
        $notin_array = array_unique($notin_array);
        $result = $this->conn->query($sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $data_array = array_merge($data_array, $rows);
        $totalRowsCount += count($data_array);
      /*  if ($totalRowsCount < 8 && $filtercount < 4) {
            $filtercount++;
            $this->RelatedStoriesFilter($id);
        }*/
        return $data_array;
    }

    private function RelatedMediaFilter($id, $type,$FromTo)
    {
        global $con;
        static $filtercount = 2;
        static $totalRowsCount = 0;
        static $data_array = [];
        static $notin_array = [];
        $this->conn = $con;
        $data = $this->MediaDetails($id, $type);
        $row = mysqli_fetch_all($data, MYSQLI_ASSOC);
        $filter = '';

        switch ($filtercount) {
            case 0:
                $filter = " AND  media.type='" . $type . "' AND media.category=" . $row[0]["category"] . " AND media.grade=" . $row[0]["grade"] . " AND media.age=" . $row[0]["age"];
                break;
            case 1:
                $filter = " AND  media.type='" . $type . "' AND media.category=" . $row[0]["category"] . " AND media.grade=" . $row[0]["grade"];
                break;
            case 2:
                $filter = " AND  media.type='" . $type . "' AND media.category=" . $row[0]["category"];
                break;
        }

        if (count($notin_array) < 1) {
            $notin_array[] = $id;
        }
        $notin_array2 = implode(",", $notin_array);
        $sql = "Select media.filename as filename, media.filename as filename, media.id,IF(media.path='','https://www.manhal.com/platform/media/###/thumbnail_small.jpg','https://www.manhal.com/platform/games/###/images/thumb.jpg') as thumbnail,media.price,media.rate,media.title_ar,media.title_en,media.views,media.path From media Inner Join categories On media.category = categories.catid Where ( media.status = 1 And media.id > 0 " . $filter . " ) AND media.id NOT IN(" . $notin_array2 . ") ".$FromTo;
        $result = $this->conn->query($sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $notin_array[] = $row['id'];
        }
        $notin_array = array_unique($notin_array);
        $result = $this->conn->query($sql);
        $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
        $data_array = array_merge($data_array, $rows);
        $totalRowsCount += count($data_array);
       /* if ($totalRowsCount < 8 && $filtercount < 2) {
            $filtercount++;
            $this->RelatedMediaFilter($id, $type);
        }*/
        return $data_array;
    }

    private function CheckRate($id, $userid, $type, $flag = false)

    {
        global $con;
        $this->conn = $con;
        $type = $type == 'sound' ? 'audio' : $type;
        $sql = "Select count(rating),rating  From rating where `rating`.`type`='" . $type . "' AND userid='" . $userid . "' and bookid=" . $id;
        $result = $this->conn->query($sql);
        $rating = false;
        if (mysqli_num_rows($result) > 0) {

            $row = mysqli_fetch_assoc($result);
            if ($flag) {
                return $row['rating'];
            } else if ($row['count'] == 0) {
                $rating = true;
            }
        }


        return $rating;
    }

    private function setRating($id, $userid, $type, $rate)
    {
        global $con;
        $this->conn = $con;
        $rate = $rate > 5 ? $rate = 5 : $rate = $rate;
        if ($this->CheckRate($id, $userid, $type)) {
            $sql = "INSERT INTO `rating`(`ratingid`, `userid`, `bookid`, `rating`, `date`,`type`) VALUES (''," . $userid . "," . $id . "," . $rate . ",CURDATE(),'" . $type . "')";

            if ($this->conn->query($sql)) {
                return $this->UpdateCountRating($id, $type);
            }
        }

    }

    private function UpdateCountRating($id, $type)
    {

        global $con;
        $this->conn = $con;
        $sql = "SELECT *,count(`ratingid`) as rate_count from `rating` WHERE bookid=" . $id . " and `type`='" . $type . "' GROUP BY `rating`";
        $result = $this->conn->query($sql);
        $sum = 0;
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            if (isset($row['rating'])) {
                $rating = $row['rating'];
            } else {
                $rating = 0;
            }
            $sum += $row['rate_count'] * $rating;
            $count += $row['rate_count'];
        }
        $rate = round($sum / $count);
        switch ($type) {
            case 'book':
                $sql = "UPDATE `books` set `rate`=" . $rate . ",`rating_count`=`rating_count`+1 WHERE bookid=" . $id;
                break;
            case 'story':
                $sql = "UPDATE `story` set `rate`=" . $rate . ",`rating_count`=`rating_count`+1 WHERE storyid=" . $id;
                break;
            case 'games':
            case 'worksheet':
            case 'interactive-worksheets':

            case 'video':
            case 'audio':
                $sql = "UPDATE `media` set `rate`=" . $rate . ",`rating_count`=`rating_count`+1 WHERE id=" . $id;
                break;
        }
        $this->conn->query($sql);
        return $count;

    }

    private function updateRatingCountEdit($id, $type, $num = 0)
    {
        global $con;
        $sql = "SELECT *,count(`ratingid`) as rate_count from `rating` WHERE bookid=" . $id . " and `type`='" . $type . "' GROUP BY `rating`";
        $result = $con->query($sql);
        $sum = 0;
        $count = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            if (isset($row['rating'])) {
                $rating = $row['rating'];
            } else {
                $rating = 0;
            }
            $sum += $row['rate_count'] * $rating;
            $count += $row['rate_count'];
        }
        $rate = round($sum / $count);
        switch ($type) {
            case 'book':
                $sql = "UPDATE `books` set `rate`=" . $rate . ",`rating_count`=`rating_count`+$num WHERE bookid=" . $id;
                break;
            case 'story':
                $sql = "UPDATE `story` set `rate`=" . $rate . ",`rating_count`=`rating_count`+$num WHERE storyid=" . $id;
                break;
            case 'games':
            case 'worksheet':
            case 'interactive-worksheets':

            case 'video':
            case 'audio':
                $sql = "UPDATE `media` set `rate`=" . $rate . ",`rating_count`=`rating_count`+$num WHERE id=" . $id;
                break;
        }
        $con->query($sql);
    }

    private function updateRating($id, $userid, $type, $rate)
    {
        global $con;
        $this->conn = $con;
        $sql = "UPDATE `rating` SET `rating`=" . $rate . " WHERE `userid`=" . $userid . " and `bookid`=" . $id . " and `type`='" . $type . "'";
        $this->conn->query($sql);
        $this->updateRatingCountEdit($id, $type, 0);
    }

    private function CheckCommentsId($id, $userid, $type, $check = false)
    {
        global $con;
        $this->conn = $con;
        $sql = "SELECT comment,date FROM `comments` WHERE `userid`=" . $userid . " and `type`='" . $type . "' AND `productid` =" . $id;
        $result = $this->conn->query($sql);
        if ($check) {
            return $result;
        }
        $flag = false;
        if (mysqli_num_rows($result) > 0) {
            $flag = true;

        }
        return $flag;
    }

    private function CheckMediaId($id = '')
    {
        global $con;
        $this->conn = $con;
        $sql = "SELECT * FROM `media` WHERE `id`=" . $id;
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function CheckStoryId($id = '')
    {
        global $con;
        $this->conn = $con;
        $sql = "SELECT * FROM `story` WHERE `storyid`=" . $id;
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function CheckBookId($id = '')
    {
        global $con;
        $this->conn = $con;
        $sql = "SELECT * FROM `books` WHERE `bookid`=" . $id;
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function CheckUserId($userid = '')
    {
        global $con;
        $this->conn = $con;
        $sql = "SELECT * FROM `users` WHERE `userid`=" . $userid;
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            return true;
        } else {
            return false;
        }
    }

    private function wp_strip_all_tags($string, $remove_breaks = false)
    {
        $string = preg_replace('@<(script|style)[^>]*?>.*?</\\1>@si', '', $string);
        $string = strip_tags($string);

        if ($remove_breaks)
            $string = preg_replace('/[\r\n\t ]+/', ' ', $string);

        return trim($string);
    }

    private function getBookDetails($id, $userid)
    {
        global $con;
        $this->conn = $con;
        $this->AddViewBook($id);


        $row = mysqli_fetch_assoc($this->BookDetails($id));
        if ($row['description_ar'] != '') {
            $row['description_ar'] = $this->wp_strip_all_tags($row['description_ar']);
        }
        if ($row['description_en'] != '') {
            $row['description_en'] = $this->wp_strip_all_tags($row['description_en']);
        }
        $FromTo = " LIMIT " . 0 . ", " . 1;
        $row['Comments'] = $this->getComments('book', $id, $FromTo);
        $row['UserComments'] = $this->CheckCommentsId($id, $userid, 'book', true);
        $row['UserRating'] = $this->CheckRate($id, $userid, 'book', true);
        return $row;

    }

    private function BookDetails($id)
    {
        $sql = "SELECT `books`.*,`categories`.*,`books`.`rating_count` as rate_count FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status`=1 AND `books`.`bookid` =" . $id;
        $result = $this->conn->query($sql);
        return $result;
    }

    private function StoryDetails($id)
    {
        $sql = "SELECT `story`.*,`stories_cat`.*,`series`.*,`story`.`rating_count` as rate_count FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid`  WHERE `story`.`status`=1 AND `story`.`storyid`=" . $id;
        $result = $this->conn->query($sql);
        return $result;
    }

    private function AddViewBook($id)
    {
        global $con;
        $this->conn = $con;
        $sql = "UPDATE `books` SET `views`=`views`+1 WHERE `bookid`=" . $id;
        $con->query($sql);
    }

    private function AddViewStory($id)
    {
        global $con;
        $this->conn = $con;
        $sql = "UPDATE `story` SET `view_count`=`view_count`+1 WHERE `storyid`=" . $id;
        $con->query($sql);
    }

    private function MediaDetails($id, $type)
    {
        $sql = "Select media.*, categories.name_ar, categories.name_en From media Inner Join categories On media.category = categories.catid   where   media.type=" . $type . " and  media.status=1 and media.id=" . $id;
        $result = $this->conn->query($sql);
        return $result;
    }

    private function AddViewMedia($id)
    {
        global $con;
        $this->conn = $con;
        $sql = "UPDATE `media` SET `views`=`views`+1 WHERE id=" . $id;
        $this->conn->query($sql);
    }

    private function getStoryDetails($id, $userid)
    {
        global $con;
        $this->conn = $con;
        $this->AddViewStory($id);
        $row = mysqli_fetch_assoc($this->StoryDetails($id));
        $row['description_ar'] = preg_replace("/(<\/?)(\w+)([^>]*>)/e", "", $row['description_ar']);
        $row['description_en'] = preg_replace("/(<\/?)(\w+)([^>]*>)/e", "", $row['description_en']);
        $FromTo = " LIMIT " . 0 . ", " . 1;
        $row['Comments'] = $this->getComments('story', $id, $FromTo);
        $row['UserComments'] = $this->CheckCommentsId($id, $userid, 'story', true);
        $row['UserRating'] = $this->CheckRate($id, $userid, 'story', true);
        return $row;
    }

    private function getMediaDetails($id, $type, $userid)
    {
        global $con;
        $this->conn = $con;
        $this->AddViewMedia($id);
        $row = mysqli_fetch_assoc($this->MediaDetails($id, $type));
        $FromTo = " LIMIT " . 0 . ", " . 1;
        $type = $this->GetTypeMediaString($type);
        $row['Comments'] = $this->getComments($type, $id, $FromTo);
        $row['UserComments'] = $this->CheckCommentsId($id, $userid, $type, true);
        $row['UserRating'] = $this->CheckRate($id, $userid, $type, true);
        return $row;
    }

    private function GetTypeMediaID($type)
    {
        $typemedia = '';
        switch ($type) {
            case 'worksheet':
                $typemedia = 0;
                break;
            case 'interactive-worksheets':
                $typemedia = 12;
                break;
            case 'sound':
                $typemedia = 3;
                break;
            case 'video':
                $typemedia = 4;
                break;
            case 'games':
                $typemedia = 11;
                break;
        }
        return $typemedia;
    }

    private function GetTypeMediaString($type)
    {
        $typemedia = '';
        switch ($type) {
            case 0:
                $typemedia = 'worksheet';
                break;
            case 12:
                $typemedia = 'interactive-worksheets';
                break;
            case 3:
                $typemedia = 'sound';
                break;
            case 4:
                $typemedia = 'video';
                break;
            case 11:
                $typemedia = 'games';
                break;
        }
        return $typemedia;
    }

    private function getComments($type, $id, $FromTo)

    {
        global $con;
        $this->conn = $con;
        $this->FromTo = $FromTo;
        //$this->FromTo = " LIMIT " . 0 . ", " . 1;
        $sql = "SELECT `comments`.*,IF(`users`.fullname!='',`users`.fullname,`users`.uname)as username,`users`.`avatar`,rating.rating FROM `comments` INNER JOIN `users` ON `comments`.`userid`=`users`.`userid` LEFT JOIN rating ON comments.userid = rating.userid AND comments.productid =rating.bookid AND comments.type = rating.type  WHERE `comments`.`productid`=" . $id . " AND `comments`.`type`='" . $type . "'" . '   ORDER BY `comments`.`date` DESC   ' . $this->FromTo;

        $result = $this->conn->query($sql);
        return $result;

    }

    private function gettypeBookAndStory($type, $typemedia)
    {


        $this->type = '';
        if ($typemedia == 'books') {
            $this->sqtype = 'booktype';
        } else if ($typemedia == 'story') {
            $this->sqtype = 'type';
        }
        switch ($type) {
            case "electronic":
                $this->type = " AND `" . $typemedia . "`.`" . $this->sqtype . "`in(2,3,6,7)";
                break;
            case "interactive":
                $this->type = " AND `" . $typemedia . "`.`" . $this->sqtype . "`in(4,5,6,7)";
                break;
            case "paper";
                $this->type = " AND `" . $typemedia . "`.`" . $this->sqtype . "`in(1,3,5,7)";
                break;
            default :
                $this->type = " AND `" . $typemedia . "`.`" . $this->sqtype . "`in(1,3,5,7)";
                break;
        }
        return $this->type;
    }

    private function getbook($keyword, $category, $FromTo, $lang, $booktype, $search = '')
    {
        global $con;
        $this->conn = $con;
        $this->FromTo = $FromTo;
        $this->keyword = '';
        $this->category = '';
        $this->lang = '';
        $this->type = $this->gettypeBookAndStory($booktype, 'books');
        if ($keyword != "") {
            if ($search == 1) {
                $this->keyword = " AND ( `name` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%'  )";
                // $this->keyword = " AND ( `name` MATCH" . mysqli_real_escape_string($this->conn, $keyword) . "'  )";

            } else if ($search == '') {
                $this->keyword = " AND ( `name` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `description_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `description_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `author_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `author_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `isbn` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' )";
            }

        }
        if ($category != 0) {
            $this->category = " AND `category` = " . $category;
        }
        if ($lang != '') {
            $this->lang = "AND `books`.`language`='" . $lang . "'";
        }

        $books = "(`books`.bookid) as id ,IF(books.status=1,'https://www.manhal.com/platform/books/###/cover.jpg','')as thumbnail,`books`.name as title_ar ,`books`.name as title_en,`books`.price,`books`.`rating_count` as rate,`books`.`views`,`books`.description_ar,`books`.description_en";
        $sql = "SELECT " . $books . " FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status` =1  AND( `books`.`bookid`>0 " . $this->keyword . $this->category . $this->lang . $this->type . " ) " . " ORDER BY `books`.`booktype` DESC,`books`.`name` DESC " . $this->FromTo;

        $result = $this->conn->query($sql);
        return $result;
    }

    private function getstory($keyword, $category, $FromTo, $series, $storytype, $search = '')
    {
        global $con;
        $this->conn = $con;
        $this->FromTo = $FromTo;
        $this->keyword = '';
        $this->category = '';
        $this->series_filter_stories = '';
      //  $this->type = $this->gettypeBookAndStory($storytype, 'story');
        $this->type ='';
        if ($keyword != "") {
            if ($search == 1) {
                $this->keyword = " AND (`story`.`title` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%')";
            } else {
                $this->keyword = " AND (`story`.`title` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`description_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`description_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`author_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`author_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`isbn` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%')";
            }

        }
        if ($category != 0) {
            $this->category = " AND `stories_cat`.catid  = " . $category;
        }
        if ($series > 0) {
            $this->series_filter_stories = " AND `series`.`seriesid` = " . $series;
        }


        $type_filter = " AND `story`.`type` in(2,3,6,7)";
//`story`.`status`=1 AND
        $sql = "SELECT (story.storyid)as id,story.seriesid,IF(story.thumb!='','https://www.manhal.com/platform/stories/$$$/story/###/images/pic.jpg','')as thumbnail,`story`.`rating_count` as rate,story.title as title_ar,story.title as title_en,story.price,story.rate,story.view_count as view,`story`.description_ar,`story`.description_en   FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid` WHERE ( `story`.`package`=0)   AND( `story`.`storyid`>0 " . $this->keyword . $this->category . $this->series_filter_stories . $this->type . $type_filter . " ) " . $this->FromTo;
        $result = $this->conn->query($sql);

        return $result;
    }


    private function getmedia($typesmedia, $keyword, $category, $FromTo, $search = '')
    {
        global $con;
        $this->conn = $con;
        $this->FromTo = $FromTo;
        $this->keyword = '';
        $this->category = '';
        if ($keyword != "") {
            if ($search == 1) {
                $this->keyword = " AND ( `title_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `title_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%'  )";
            } else {
                $this->keyword = " AND ( `title_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `title_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `description_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `description_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%'  )";
            }
        }
        if ($category != 0) {
            $this->category = " AND `category` = " . $category;
        }
        $sql = "Select media.id,IF(media.path='','https://www.manhal.com/platform/media/###/thumbnail_small.jpg','https://www.manhal.com/platform/games/###/images/thumb.jpg') as thumbnail,media.price,media.rate,media.title_ar,media.title_en,media.views,media.path,`media`.description_ar,`media`.description_en From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And media.type=" . $typesmedia . $this->keyword . $this->category . " " . " ORDER BY `media`.`price` ASC,`media`.`id` DESC " . $this->FromTo;
        return $sql;
        $result = $this->conn->query($sql);
        return $result;
    }

    private function CheckEmail($email)
    {
        global $con;
        $sql = "SELECT * FROM `users` WHERE `email`='" . $email . "'";
        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0) {
            return false;
        } else {
            return true;
        }

    }

    private function CheckUser($name)
    {
        global $con;
        $sql = "SELECT * FROM `users` WHERE `uname`='" . $name . "'";
        $result = $con->query($sql);
        if (mysqli_num_rows($result) > 0) {
            //##msg_no=9
            return false;
        } else {
            return true;
        }

    }

    private function signup($emai, $pass, $name)
    {
        global $con;
        $this->conn = $con;
        if ($this->CheckEmail($emai) == true and $this->CheckUser($name) == true) {
            $countryCode = $this->GetIP();
            $sql = "INSERT INTO `users`(`userid`,`uname`,`email`, `password`, `status`,`cdate`, `views_count`, `sales_count`,`country`) VALUES (null,'" . $name . "','" . $emai . "','" . $pass . "',1,CURDATE(),'0','0','" . $countryCode . "')";
            if ($this->conn->query($sql)) {
                $this->SendMail($emai, 'signup', "Ar");
               // return Array('check'=>true,'reason'=>'');
                return $this->signin($emai,$pass);
            }
        } else {
            $user = Array('check' => true, 'reason' => "");
            if ($this->CheckUser($name) == false) {
                $user = Array('check' => false, 'reason' => "error9");
            }
            $email=Array('check' => true, 'reason' => "");
            if($this->CheckEmail($emai)==false){
                $email=Array('check' => false, 'reason' => "error10");
            }
            $account=Array('uname'=>-1,'subscribe'=>-1,'fullname'=>-1,'country'=>-1,'gender'=>-1,'userid'=>-1,'avatar'=>-1);
            return Array('account'=>[$account],'user'=>$user,'email'=>$email,'pass'=>['check'=>true,'reason'=>'']);
            //return Array('user' => $user, 'email' => $email,'pass'=>Array('check' => true, 'reason' => ""));
        }
    }

    private function pass_v($password1, $password2)
    {
        global $error;
        if ($password1 != '' and $password2 != '') {
            if (preg_match('/^([a-zA-Z0-9]){3,20}$/', $password1)) {

                if ($password1 != $password2) {
                    //##msg_no=3
                    return Array('check' => false, 'reason' => "error3");
                } else {
                    return Array('check' => true, 'reason' => "");
                }
            } else {
                //##msg_no=4
                return Array('check' => false, 'reason' => "error4");
            }
        } else {
            //##msg_no=5
            return Array('check' => false, 'reason' => "error5");
        }
    }

    private function email_v($email, $email2)
    {
        global $error;
        if ($email != '') {
            if (preg_match('/^([a-zA-Z])([a-zA-Z0-9._-]){2,30}@([a-zA-Z0-9.-])+\.([a-zA-Z0-9]){2,5}$/', $email)) {
                if ($email != $email2) {
                    //##msg_no=6
                    return Array('check' => false, 'reason' => "error6");
                } else {
                    return Array('check' => true, 'reason' => "");
                }
            } else {
                //##msg_no=7
                return Array('check' => false, 'reason' => "error7");
            }
        } else {
            //##msg_no=8
            return Array('check' => false, 'reason' => "error8");
        }
    }

    private function username_v($name)
    {
        global $error;

        if ($name != '') {
            if (preg_match('/^([a-zA-Z0-9._-]){3,30}$/', $name)) {
                return Array('check' => true, 'reason' => "");
            } else {
                //##msg_no=1
                return Array('check' => false, 'reason' => "error1");
            }
        } else {
            //##msg_no=2
             return Array('check' => false, 'reason' => "error2");
        }
    }

    private function signin($name, $pass)
    {
        global $con;
        $arrays = [];
        $this->conn = $con;
        $sql = "SELECT users.uname,IF(users.permession=1||users.permession=2||users.permession=10||users.permession=11,'yes','no')as subscribe,users.fullname,users.country,users.gender,users.userid,users.avatar FROM users WHERE (email='" . $name . "') and password='" . $pass . "' AND status=1";
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            return Array('account'=>$result,'user'=>['check'=>true,'reason'=>''],'email'=>['check'=>true,'reason'=>''],'pass'=>['check'=>true,'reason'=>'']);
        }else{
            $account=Array('uname'=>-1,'subscribe'=>-1,'fullname'=>-1,'country'=>-1,'gender'=>-1,'userid'=>-1,'avatar'=>-1);
            return Array('account'=>[$account],'user'=>['check'=>false,'reason'=>'error11'],'email'=>['check'=>false,'reason'=>'error11'],'pass'=>['check'=>false,'reason'=>'error11']);
        }

    }

    private function SocialLogin($social, $name, $fname, $lname, $gender, $email, $avatar)
    {
        global $con;
        $arrays = [];
        $this->conn = $con;
        $sql = "SELECT * FROM users WHERE social=" . $social . " AND status=1";
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $sql = "UPDATE `users` SET `lastlogin`=NOW() WHERE userid=" . $row["userid"];
            $this->conn->query($sql);

            return $row;
        } else {
            $date = date("d/m/Y");
            $vuser_lastname = $lname;
            $fullName = $fname . " " . $vuser_lastname;
            $countryCode = $this->GetIP();
            $sql = "INSERT INTO `users`(`userid`, `uname`, `password`, `email`, `permession`, `cdate`, `fullname`, `status`, `token`, `ctime`, `social`, `avatar`, `views_count`, `sales_count`, `country`, `address`, `phone`, `birthdate`, `gender`) VALUES ('','" . mysqli_real_escape_string($this->conn, $name) . "','','" . $email . "','',CURDATE(),'" . mysqli_real_escape_string($this->conn, $fname) . "','1','','','" . $social . "','" . $avatar . "','0','0','" . $countryCode . "','','','','')";
            if ($this->conn->query($sql)) {
                SocialLogin($social, $name, $fname, $lname, $gender, $email);
            } else {
                return Array('error' => 'SocialLogin error');
            }
        }

    }

    private function SendMail($email, $type, $lang)
    {
        $logo = SITE_URL . "images/logo.png";
        switch ($type) {
            case 'signup':
                $message = file_get_contents("../../templates/mailsignup_" . $lang . ".html");
                $message = str_replace("#Manhal_logo#", $logo, $message);
                break;
        }
        $to = $email;
        $subject = 'manhal.com';
        $headers = "From: " . strip_tags(WEBMASTER_EMAIL) . "\r\n";
        $headers .= "Reply-To: " . strip_tags($email) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        if (mail($to, $subject, $message, $headers)) {
        } else {
            return Array('error' => 'Cannot Send Email');
        }

    }

    private function crypto_rand_secure($min, $max)
    {
        $range = $max - $min;
        if ($range < 1) return $min; // not so random...
        $log = ceil(log($range, 2));
        $bytes = (int)($log / 8) + 1; // length in bytes
        $bits = (int)$log + 1; // length in bits
        $filter = (int)(1 << $bits) - 1; // set all lower bits to 1
        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd >= $range);
        return $min + $rnd;
    }

    private function getToken($length)
    {

        $this->token = "";
        //$this->codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        // $this->codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
        $this->codeAlphabet = "0123456789";
        $this->max = strlen($this->codeAlphabet) - 1;
        for ($this->i = 0; $this->i < $length; $this->i++) {
            $this->token .= $this->codeAlphabet[$this->crypto_rand_secure(0, $this->max)];
        }
        return $this->token;
    }

    private function GetIP()
    {
        include_once('../../includes/ip2locationlite.class.php');
        //Load the class
        $ipLite = new ip2location_lite;
        $ipLite->setKey('ee0ae4326f966ea90705cd8a0d36e7a0e1cdd5a9fe4ab3c724c68fa0d9d8a6a2');
        //Get errors and locations
        $locations = $ipLite->getCity($_SERVER['REMOTE_ADDR']);
        $countryCode = $locations['countryCode'];
        return $countryCode;
    }


}


$sitekey = "6Lfnvj8UAAAAAOp7R2hIx7LfMaDNcQDGrIc6aS7N";
include_once('../../platform/config.php');
require_once 'vendor/restler.php';
use Luracast\Restler\Restler;
$r = new Restler();
$r->setSupportedFormats('JsonFormat');
$r->addAPIClass('action');
$r->handle();

