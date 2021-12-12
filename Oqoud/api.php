<?php

/**
 * Created by PhpStorm.
 * User: khalid
 * Date: 15/06/2020
 * Time: 03:44 م
 */
trait message
{
    public function msg1($msg, $data, $page)
    {
        return json_encode(array("result" => "1", "message" => $msg, "number" => $page, "data" => $data));
    }

    public function json()
    {
        $json = '{}';
        $json2 = json_decode($json);
        return $json2;
    }

    public function msg2($data)
    {
        return json_encode(array("result" => "0", "message" => $data, "data" => $this->json()));
    }

    public function msg1_txt()
    {
        return 'success';
    }

    public function msg2_txt()
    {
        return 'There are no data';
    }

    public function msg3_txt()
    {
        return 'You cannot delete';
    }

}

class mySQL
{

    private $DB = array();
    private static $classObj = NULL;
    private static $objCon = NULL;

    protected function __construct()
    {
       $this->DB['Host'] = "localhost";
         $this->DB['UserName'] = "root";
        $this->DB['UserPass'] = "";
        $this->DB['Name'] = "oqoud";
        $this->PerPage = 6;
        $this->URL = 'http://localhost/manhal/';

       /* $this->DB['UserName'] = "manhal_uoqoud";
        $this->DB['UserPass'] = "@}3@peC_%tBH";
        $this->DB['Name'] = "manhal_oqoud";
        $this->PerPage = 12;
        $this->URL = 'https://www.manhal.com/';
*/
       
    }

    final private function __clone()
    {
    }

    public static function getObj()
    {
        if (!self::$classObj)
            self::$classObj = new self();
        return self::$classObj;
    }

    public function getConObj()
    {
        if (!self::$objCon) {
            self::$objCon = new mysqli($this->DB['Host'],
                $this->DB['UserName'], $this->DB['UserPass'], $this->DB['Name']);
            self::$objCon->set_charset("utf8");
            if (self::$objCon->connect_error)
                die(self::$objCon->connect_error);
        }
        return self::$objCon;
    }

    public function makeQuery($qu)
    {



        $temp = $this->getConObj()->query($qu);
        if (!$temp)
            die($this->getConObj()->error);
        return $temp;
    }
}

class myLogin extends mySQL
{
    private static $classObj = NULL;

    protected function __construct()
    {
        parent::__construct();
    }

    public static function getObj()
    {
        if (!self::$classObj)
            self::$classObj = new self();
        return self::$classObj;
    }

    public function login($user, $pass)
    {
        if ($user == NULL or $pass == NULL) {
            return false;
        } else {
            $user = preg_replace('/[^A-Za-z0-9]/', '', $user);
            $pass = preg_replace('/[^A-Za-z0-9]/', '', $pass);
            $Tquery = " SELECT * FROM user WHERE uname='$user' AND pass='$pass'";
            if ($temp = $this->makeQuery($Tquery)->num_rows == 1) {
                $row = mysqli_fetch_assoc($temp);
                $_SESSION['Uperm'] = $row['Uperm'];
                return true;
            }else {
                return false;
            }
        }
    }
}

class mySession extends myLogin
{
    private static $classObj = NULL;

    protected function __construct()
    {
        if (!isset($_SESSION)) SESSION_START();
        parent::__construct();
    }

    public static function getObj()
    {
        if (!self::$classObj)
            self::$classObj = new self();
        return self::$classObj;
    }

    public function sLogin($user, $pass)
    {

        $User = $this->login($user, $pass);
        if ($User) {
            $_SESSION['username'] = $user;
            $_SESSION['password'] = $pass;

            if ($_SESSION["lang"] == 'Ar') {
                $_SESSION["lang"] = 'En';
            } else {
                $_SESSION["lang"] = 'En';
            }
            $session_lang = $_SESSION["lang"];
            return true;
        } else return false;
    }

    public function sLogout()
    {
        if (isset($_SESSION['username']) and isset($_SESSION['password'])) unset($_SESSION['username'], $_SESSION['password']);
    }

    public function checkSLogin()
    {
        if (isset($_SESSION['username']) and isset($_SESSION['password'])) {
            if ($this->login($_SESSION['username'], $_SESSION['password']))
                return true;
            else
                return false;
        } else return false;
    }
}

class oqoud extends mySession
{
    use message;
    private static $classObj = NULL;


    public function __construct()
    {
        parent::__construct();
        // $this->con = mySession::getObj();
        // $this->query=MYsql::getObj();


    }

    public static function getObj()
    {
        if (!self::$classObj)
            self::$classObj = new self();

        return self::$classObj;
    }

    private function UploadImage($image, $newFileName)
    {
        $files = [];
        for ($i = 0; $i < count($_FILES[$image]); $i++) {
            $masge = '';
            if (isset($_FILES[$image]["name"][$i]) && $_FILES[$image]["name"][$i] != '') {
                $fileName = $_FILES[$image]["name"][$i]; // The file name
                $fileTmpLoc = $_FILES[$image]["tmp_name"][$i]; // File in the PHP tmp folder
                $fileType = $_FILES[$image]["type"][$i]; // The type of file it is
                $fileSize = $_FILES[$image]["size"][$i]; // File size in bytes
                $fileErrorMsg = $_FILES[$image]["error"][$i]; // 0 for false... and 1 for true
                $fileName = preg_replace('#[^a-z.0-9]#i', '', $fileName); // filter the $filename
                $kaboom = explode(".", $fileName); // Split file name into an array using the dot
                $fileExt = end($kaboom); // Now target the last array element to get the file extension
                // START PHP Image Upload Error Handling --------------------------------
                if (!$fileTmpLoc) { // if file not chosen
                    $masge = "ERROR: Please browse for a file before clicking the upload button.";
                } else if ($fileSize > 5242880) { // if file size is larger than 5 Megabytes
                    $masge = "ERROR: Your file was larger than 5 Megabytes in size.";
                    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
                } else if (!preg_match("/.(gif|jpg|png|pdf)$/i", $fileName)) {
                    // This condition is only if you wish to allow uploading of specific file types
                    $masge = "ERROR: Your image was not .gif, .jpg, or .png.or .pdf.";
                    unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
                } else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
                    $masge = "ERROR: An error occured while processing the file. Try again.";
                }
                if ($masge == '') {
                    // END PHP Image Upload Error Handling ----------------------------------
                    // Place it into your "uploads" folder mow using the move_uploaded_file() function
                    $fileName = $newFileName . "_" . $i . '.' . $fileExt;
                    //$files[$i]=$fileName;
                    $moveResult = move_uploaded_file($fileTmpLoc, $fileName);
                    // Check to make sure the move result is true before continuing
                    if ($moveResult != true) {
                        $masge = "ERROR: File not uploaded. Try again.";
                    }
                    $files[$i] = array('file' => $fileName, 'masge' => $masge);
                    // return array('file' => $fileName, 'masge' => $masge);
                }
            }

        }

        return array('file' => $files, 'masge' => $masge);
    }

    public function CreateCategory($id)
    {
        switch ($id) {
            case 'new':
                $Tquery = "INSERT INTO `category`(`id`) VALUES (NULL)";
                $temp = $this->makeQuery($Tquery);
                if ($temp) {
                    $result = $this->msg1($this->msg1_txt(), $this->json(), $this->getConObj()->insert_id);
                } else {
                    $result = $this->msg2($this->msg2_txt());
                }
                break;
            default:
                $Tquery = "SELECT * FROM `category` WHERE id=" . $id;
                $temp = $this->makeQuery($Tquery);
                if ($temp->num_rows > 0) {
                    $result = $this->msg1($this->msg1_txt(), $this->GetDataCategory($temp), mysqli_fetch_assoc($temp));
                } else {
                    $result = $this->msg2($this->msg2_txt());
                }
                return json_decode($result, true);;
                break;
        }
        return json_decode($result, true);
    }

    public function DeleteCategory($id)
    {
        $Tquery = "DELETE FROM `category` WHERE id=" . $id;
        $result = $this->msg2($this->msg2_txt());
        if ($this->CanEdit()) {
            $temp = $this->makeQuery($Tquery);
            if ($temp) {
                $result = $this->msg1($this->msg1_txt(), $this->json(), 0);
            }
        }
        return $result;
    }

    public function UpdateCategory($id, $name_ar, $name_en)
    {

        $Tquery = "UPDATE `category` SET `name_ar`='" . mysqli_real_escape_string($this->getConObj(), $name_ar) . "',`name_en`='" . mysqli_real_escape_string($this->getConObj(), $name_en) . "',`cdate`=CURDATE() WHERE id=" . $id;
        $result = $this->msg2($this->msg2_txt());
        if ($this->CanEdit()) {
            $temp = $this->makeQuery($Tquery);
            if ($temp) {
                $result = $this->msg1($this->msg1_txt(), $this->json(), 0);
            }
        }
        return $result;

    }

    private function GetDataCategory($temp)
    {
        $data = [];
        $i = 0;
        while ($row = mysqli_fetch_assoc($temp)) {
            $data[$i] = (array("id" => $row['id'], "name_ar" => $row['name_ar'], "name_en" => $row['name_en']));
            $i++;
        }
        return $data;
    }

    private function GetDatauser($temp)
    {
        $data = [];
        $i = 0;
        while ($row = mysqli_fetch_assoc($temp)) {
            $data[$i] = (array("id" => $row['id'], "fullname" => $row['fullname'], "uname" => $row['uname'], "email" => $row['email'], "pass" => $row['pass']));
            $i++;
        }

        return $data;
    }

    public function Category()
    {
        $Tquery = "SELECT * FROM `category` WHERE id>0";
        $data = [];
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {

            $result = $this->msg1($this->msg1_txt(), $this->GetDataCategory($temp), mysqli_fetch_assoc($temp));
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function CategoryID($id)
    {
        $Tquery = "SELECT * FROM `category` WHERE id=" . $id;
        $data = [];
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {

            $result = $this->msg1($this->msg1_txt(), $this->GetDataCategory($temp), mysqli_fetch_assoc($temp));
        } else {
            $result = $this->msg2($this->msg2_txt());
        }

        return json_decode($result, true);
    }

    public function Action()
    {
        $Tquery = "SELECT * FROM `action` WHERE id>0";
        $data = [];
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($temp)) {
                $data[$i] = (array("id" => $row['id'], "name_ar" => $row['name_ar'], "name_en" => $row['name_en']));
                $i++;
            }
            $result = $this->msg1($this->msg1_txt(), $data, $i);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    private function GetKeyword($keyword)
    {
        $this->keyword = '';
        if ($keyword != "") {
            $this->keyword = " AND ( `num` like '%" . $keyword . "%' OR `act` like '%" . $keyword . "%' OR `name` like '%" . $keyword . "%' OR `email` LIKE '%" . $keyword . "%' OR `country` LIKE '%" . $keyword . "%' OR `city` LIKE '%" . $keyword . "%'   OR `type` LIKE '%" . $keyword . "%'  )";
        }
        return $this->keyword;
    }

    private function GetType($type)
    {
        $this->type = '';
        if ($type != "") {
            $this->type = " AND  `type` = " . $type;
        }
        return $this->type;
    }

    private function DurationOfTheContract($d_contract)
    {
        $this->d_contract = '';
        if ($d_contract != "") {
            $this->d_contract = " AND  `d_contract` = " . $d_contract;
        }
        return $this->d_contract;
    }

    private function StatusContract($status)
    {
        $this->status = '';
        if ($status != "") {
            $this->status = " AND  `status` = " . $status;
        }
        return $this->status;
    }

    private function ActionContract($action)
    {
        $this->action = '';
        if ($action != "") {
            $this->action = " AND  `action` = " . $action;
        }
        return $this->action;
    }

    private function CategoryContract($category)
    {
        $this->category = '';
        if ($category != "" && $category != -1) {
            $this->category = " AND  `cat` = " . $category;
        }
        return $this->category;
    }

    private function GetDataOquad($temp)
    {
        $i = 0;
        $data = [];
        while ($row = mysqli_fetch_assoc($temp)) {
            $data[$i] = (array("id" => $row['id'], "num" => $row['num'], "activity" => $row['act'], "name" => $row['name'], "email" => $row['email'], "country" => $row['country'], "city" => $row['city'], "address" => $row['address'], "IBAN" => $row['IBAN'], "type" => $row['type']
            , "t_contract" => $row['t_contract'], "d_contract" => $row['d_contract'], "s_date" => $row['s_date'], "e_date" => $row['e_date'], "v_contract" => $row['v_contract'], "currency" => $row['currency'], "status" => $row['status'], "monthly_amount" => $row['monthlyamount']
            , "p_date" => $row['p_date'], "alarm" => $row['alarm'], "email_to" => $row['email_to'], "email_cc" => $row['email_cc'], "email_t" => $row['email_t'], "action" => $row['action'], "cat_ar" => $row['cat_ar'], "cat_en" => $row['cat_en'], "cat" => $row['catid'], "phone" => $row['phone']
            ));
            $i++;
        }
        return $data;
    }

    private function get_paginagtion($from = '', $to = '')
    {
        $this->FromTo = '';
        if ($to != '' && $to > 0) {
            if ($from == '') {
                $from = 0;
            }
            $this->FromTo = " LIMIT " . $from . ", " . (int)$to;
        }
        return $this->FromTo;
    }

    private function pagesnumber($num_rows)
    {
        $Pages_number = ceil($num_rows / $this->PerPage);
        return $Pages_number;
    }

    private function getsql()
    {

        $sql = "SELECT contracts.*,category.id as catid ,category.name_ar as cat_ar ,category.name_en as cat_en FROM `contracts` INNER JOIN category ON category.id=contracts.cat WHERE  contracts.delete=0 AND contracts.id>0 " . $this->keyword . $this->type . $this->d_contract . $this->status . $this->action . $this->category . " " . $this->FromTo;
        return $sql;
    }

    public function ContractsAdmin($keyword = '', $type = '', $d_contract = '', $status = '', $action = '', $category, $page)
    {
        $this->keyword = $this->GetKeyword($keyword);
        $this->type = $this->GetType($type);
        $this->d_contract = $this->DurationOfTheContract($d_contract);
        $this->status = $this->StatusContract($status);
        $this->action = $this->ActionContract($action);
        $this->category = $this->CategoryContract($category);
        $this->FromTo = '';
        $sql = $this->getsql();
        $temp = $this->makeQuery($sql);
        $page_count = $this->pagesnumber(mysqli_num_rows($temp));
        if ($page > $page_count) {
            $page = $page_count;
        } else if ($page < 0) {
            $page = 0;
        }
        $this->FromTo = $this->get_paginagtion($page * $this->PerPage, $this->PerPage);
        $sql = $this->getsql();
        $temp = $this->makeQuery($sql);
        if ($temp->num_rows > 0) {
            $result = $this->msg1($this->msg1_txt(), $this->GetDataOquad($temp), $page_count);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function CanEdit()
    {
        $result = false;
        if ($this->checkSLogin()) {
            $Tquery = "SELECT * FROM `user` WHERE `uname`='" . $_SESSION['username'] . "'";
            $temp = $this->makeQuery($Tquery);
            if ($temp->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($temp)) {
                    if ($row['permession'] == 1) {
                        $result = true;
                    }
                }
            }
        }
        return $result;
    }

    public function Delete($id)
    {
        $result = $this->msg2($this->msg3_txt());
        if ($this->CanEdit()) {
            $Tquery = "DELETE FROM `contracts` WHERE `id`=" . $id;
            $temp = $this->makeQuery($Tquery);
            if ($temp) {
                $result = $this->msg1($this->msg1_txt(), $this->json(), 0);
            }
        }
        return $result;
    }

    public function Edit($id, $num, $act, $name, $email, $country, $city, $address, $IBAN, $type, $t_contract, $d_contract, $s_date, $e_date, $v_contract, $currency, $status, $monthlyamount, $p_date, $alarm, $email_to, $email_cc, $email_t, $action, $phone)
    {
        $Tquery = "UPDATE `contracts` SET `num`='" . mysqli_real_escape_string($this->getConObj(), $num) . "',`act`='" . mysqli_real_escape_string($this->getConObj(), $act) . "',`name`='" . mysqli_real_escape_string($this->getConObj(), $name) . "',`email`='" . mysqli_real_escape_string($this->getConObj(), $email) . "',`country`='" . mysqli_real_escape_string($this->getConObj(), $country) . "',`city`='" . mysqli_real_escape_string($this->getConObj(), $city) . "',`address`='" . mysqli_real_escape_string($this->getConObj(), $address) . "',`IBAN`='" . mysqli_real_escape_string($this->getConObj(), $IBAN) . "',`type`='" . mysqli_real_escape_string($this->getConObj(), $type) . "',`t_contract`='" . mysqli_real_escape_string($this->getConObj(), $t_contract) . "',`d_contract`='" . mysqli_real_escape_string($this->getConObj(), $d_contract) . "',`s_date`='" . $s_date . "',`e_date`='" . $e_date . "',`v_contract`='" . mysqli_real_escape_string($this->getConObj(), $v_contract) . "',`currency`='" . mysqli_real_escape_string($this->getConObj(), $currency) . "',`status`='" . $status . "',`monthlyamount`='" . $monthlyamount . "',`p_date`='" . $p_date . "',`alarm`='" . $alarm . "',`email_to`='" . mysqli_real_escape_string($this->getConObj(), $email_to) . "',`email_cc`='" . mysqli_real_escape_string($this->getConObj(), $email_cc) . "',`email_t`='" . mysqli_real_escape_string($this->getConObj(), $email_t) . "',`action`='" . $action . "',`cat`='" . $type . "',`phone`='" . mysqli_real_escape_string($this->getConObj(), $phone) . "' WHERE id=" . $id;
        $result = $this->msg2($this->msg2_txt());
        if ($this->CanEdit()) {
            $temp = $this->makeQuery($Tquery);
            if ($temp) {
                $result = $this->msg1($this->msg1_txt(), $this->json(), 0);
            }
        }
        return $result;
    }

    public function InformationSave($fullname, $password, $email)
    {
        if ($fullname == '' || $password == '' || $email == '') {
            return $this->msg2($this->msg2_txt());
        }
        $result = $this->msg2($this->msg2_txt());
        $information = $this->informationUser();

        $id = $information['data'][0]['id'];
        if ($id == null) {
            return $result;
        }


        $Tquery = "UPDATE `user` SET `fullname`='" . mysqli_real_escape_string($this->getConObj(), $fullname) . "',`pass`='" . mysqli_real_escape_string($this->getConObj(), $password) . "',`email`='" . mysqli_real_escape_string($this->getConObj(), $email) . "' WHERE id=" . $id;


        $temp = $this->makeQuery($Tquery);
        if ($temp) {
            $result = $this->msg1($this->msg1_txt(), $this->json(), 0);
        }

        return $result;


    }

    public function DeleteContract($id)
    {

        $Tquery = "UPDATE `contracts` SET `delete`=1 WHERE id=" . $id;
        $result = $this->msg2($this->msg2_txt());
        if ($this->CanEdit()) {
            $temp = $this->makeQuery($Tquery);
            if ($temp) {
                $result = $this->msg1($this->msg1_txt(), $this->json(), 0);
            }
        }
        return $result;
    }

    public function Create($id)
    {
        switch ($id) {
            case 'new':
                $Tquery = "INSERT INTO `contracts`(`id`) VALUES (null)";
                $temp = $this->makeQuery($Tquery);
                if ($temp) {
                    $result = $this->msg1($this->msg1_txt(), $this->json(), $this->getConObj()->insert_id);
                } else {
                    $result = $this->msg2($this->msg2_txt());
                }
                break;
            default:
                $Tquery = "SELECT contracts.*,category.id as catid ,category.name_ar as cat_ar ,category.name_en as cat_en FROM `contracts` INNER JOIN category ON category.id=contracts.cat WHERE `contracts`.`id`=" . $id;
                $temp = $this->makeQuery($Tquery);
                if ($temp->num_rows > 0) {
                    $result = $this->msg1($this->msg1_txt(), $this->GetDataOquad($temp), mysqli_fetch_assoc($temp));
                } else {
                    $result = $this->msg2($this->msg2_txt());
                }
                return $result;
                break;
        }
        return $result;
    }
        public function checked(){
            $Tquery = "SELECT `id`,`e_date`,`p_date`,`alarm`,`email_to`,`email_cc`,`email_t`, SUBDATE(`e_date`,`alarm`) as expire , SUBDATE(`p_date`,`alarm`) as paid FROM contracts where (SUBDATE(`e_date`,`alarm`) = CURDATE() or  SUBDATE(`p_date`,`alarm`) = CURDATE()) and `action`=1";

            $temp = $this->makeQuery($Tquery);
            $i = 0;
            $data = [];
            while ($row = mysqli_fetch_assoc($temp)) {

            $this->SendMail($row['email_to'],$row['email_cc'],$row['email_t']);
                $i++;
            }

    }
    private function SendMail($email,$emailCC,$message)
    {
        $headers='';
        $subject = 'manhal.com';
        $headers .= "Reply-To: " . strip_tags($email) . "\r\n";
        $to = $email;
        $headers = "From:'support@manhal.com'\r\n";
        $headers .= "Reply-To:'".$emailCC."'\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        if (mail($to, $subject, $message, $headers)) {
            //  $result = $this->msg1($object['data'], 0);
        } else {
            //  $result = $this->msg2($this->msg9_txt());
        }
        // return $result;
    }
    public function informationUser()
    {
        $Tquery = " SELECT * FROM user WHERE uname='" . $_SESSION["username"] . "' AND pass='" . $_SESSION['password'] . "'";
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $result = $this->msg1($this->msg1_txt(), $this->GetDatauser($temp), 0);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return json_decode($result, true);
    }

    public function Uploadfile($oqoud, $IdFolder)
    {

        if (!is_dir("files/" . $IdFolder)) {
            mkdir("files/" . $IdFolder);
        }
        if (!is_dir("files/" . $IdFolder . "/oqoud")) {
            mkdir("files/" . $IdFolder . "/oqoud");
        }
        if (!is_dir("files/" . $IdFolder . "/needed")) {
            mkdir("files/" . $IdFolder . "/needed");
        }
        $directory = '';
        switch ($oqoud) {
            case 'oqoud':
                $directory = "files/" . $IdFolder . '/oqoud/';
                $newFileName = $directory . md5(uniqid());
                $masge = $this->UploadImage('contract', $newFileName);
                break;
            case 'needed':
                $directory = "files/" . $IdFolder . '/needed/';
                $newFileName = $directory . md5(uniqid());
                $masge = $this->UploadImage('needed', $newFileName);
                break;
        }
        $data = $this->getImages($directory);
        return $data;


    }

    public function getImages($dir)
    {
        $data = '';


        if (is_dir($dir)) {
            $d = dir($dir);
            $retval = [];

            while (($file = $d->read()) !== false) {
                if ($file{0} == ".") continue;
                $retval[] = ['file' => $file];

                $data .= '<div class="col-md-3 m-b-10">';
                if ($this->CanEdit()) {
                    $data .= '<a att="' . $dir . $file . '" class="delete"><i class="metismenu-icon pe-7s-trash"></i></a>';
                }
                $data .= '<a href="' . $dir . $file . '" target="_blank" class="download" download><i class="pe-7s-cloud-download" ></i></a>
            <a data-fancybox="gallery" class="fancybox-media" href="' . $dir . $file . '" ><img  src="' . $dir . $file . '" alt="Card image cap" class="card-img-top"/></a>
            </div>';
            }
            $d->close();
        }

        return $data;
    }

    private function getToken()
    {
        $this->token = "";
        $date = gettimeofday();
        $secretKey = $date . "Lfnvj8UAAAAAGMIkj9n6Xi6qDq-Manhal.com-FGkO3804EyKG" . $this->getrandomnumber(12);
        $this->token = hash('sha256', $secretKey);
        return $this->token;

    }

    public function DeleteFile($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }
}

$api = oqoud::getObj();
$session_lang;
if (isset($_GET["process"]) && $_GET["process"] != "") {
    switch ($_GET["process"]) {
        case "logout":
            $api->sLogout();
            header('Location: login.php');
            break;
        case "oqoud":
            echo $api->ContractsAdmin($_GET["keyword"], $_GET["type"], $_GET["d_contract"], $_GET["status"], $_GET["action"], $_GET["category"], $_GET["page"]);
            break;
        case "category":
            echo $api->Category();
            break;
        case "action":
            echo $api->Action();
            break;
        case "checked":
            echo $api->Checked();
            break;
        case "lang":
            if ($_SESSION["lang"] == 'En') {
                $_SESSION["lang"] = 'Ar';
            } else {
                $_SESSION["lang"] = 'En';
            }
            $session_lang = $_SESSION["lang"];
            echo $session_lang;
            break;
    }
}
if (isset($_POST['process'])) {
    switch ($_POST["process"]) {
        case "signin":
            if ($api->sLogin($_POST['username'], $_POST['pass'])) {
                header('Location: index.php');
            } else {
                header('Location: login.php');
            }
            break;
        case "create":
            echo $api->Create($_POST['id']);
            break;
        case "delete":
            echo $api->Delete($_POST['id']);
            break;
        case "edit":
            echo $api->Edit($_POST['id'], $_POST['num'], $_POST['act'], $_POST['name'], $_POST['email'], $_POST['country'], $_POST['city'], $_POST['address'], $_POST['IBAN'], $_POST['type'], $_POST['t_contract'], $_POST['d_contract'], $_POST['s_date'], $_POST['e_date'], $_POST['v_contract'], $_POST['currency'], $_POST['status'], $_POST['monthlyamount'], $_POST['p_date'], $_POST['alarm'], $_POST['email_to'], $_POST['email_cc'], $_POST['email_t'], $_POST['action'], $_POST['phone']);
            break;
        case "createcate":
            echo $api->CreateCategory($_POST['id']);
            break;
        case "deletecategory":
            echo $api->DeleteCategory($_POST['id']);
        case "updatecategory":
            echo $api->UpdateCategory($_POST['id'], $_POST['name_ar'], $_POST['name_en']);
            break;
        case "uploadoqoud":
            echo $api->Uploadfile($_POST['oqoud'], $_POST['IdFolder']);
            break;
        case "DeleteFile":
            echo $api->DeleteFile($_POST['file']);
            break;
        case "deletecontract":
            echo $api->DeleteContract($_POST['id']);
            break;
        case "information_save":
            echo $api->InformationSave($_POST['fullname'], $_POST['pass'], $_POST['email']);
            break;


    }
}
