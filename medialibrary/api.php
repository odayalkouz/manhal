<?php

/**
 * Created by PhpStorm.
 * User: khalid
 * Date: 15/06/2020
 * Time: 03:44 م
 */
include_once("colors.php");

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

    public function msg4_txt()
    {
        return 'error token';
    }

    public function msg5_txt()
    {
        return 'You have no access';
    }

    public function msg6_txt()
    {
        return 'There are no Media';
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
         $this->DB['Name'] = "medialibrary";
         $this->PerPage = 20;
         $this->pagination = 10;
         $this->URL = 'http://localhost/manhal/';
        /* $this->DB['UserName'] = "medialibrary";
        $this->DB['UserPass'] = "Vttl*3zAdl4H";
        $this->DB['Name'] = "medialibrary_library";
        $this->pagination = 10;
        $this->PerPage = 30;
        $this->URL = 'https://medialibrary.manhal.com/';*/


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
            $Tquery = " SELECT * FROM user WHERE Uname='$user' AND Upass='$pass'";
            if ($temp = $this->makeQuery($Tquery)->num_rows == 1)
                return true;
            else
                return false;
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

class medialibrary extends mySession
{
    use message;
    private static $classObj = NULL;

    public function __construct()
    {
        parent::__construct();
        $this->ex = new GetMostCommonColors();
        // $this->con = mySession::getObj();
        // $this->query=MYsql::getObj();
    }

    public static function getObj()
    {
        if (!self::$classObj)
            self::$classObj = new self();

        return self::$classObj;
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

    private function getrandomnumber($length)
    {
        $this->num = "";
        //$this->codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $this->codeAlphabet = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        // $this->codeAlphabet = "0123456789";
        $this->max = strlen($this->codeAlphabet) - 1;
        for ($this->i = 0; $this->i < $length; $this->i++) {
            $this->num .= $this->codeAlphabet[$this->crypto_rand_secure(0, $this->max)];
        }
        return $this->num;
    }

    private function getToken()
    {
        $this->token = "";
        $date = gettimeofday();
        $secretKey = $date['sec'] . "Lfnvj8UAAAAAGMIkj9n6Xi6qDqManhalFGkO3804EyKG" . $this->getrandomnumber(4);
        $this->token = hash('sha256', $secretKey);
        return $this->token;
    }

    private function gettokenfromhedar()
    {
        if (isset($_SERVER['HTTP_X_API_KEY'])) {
            return $_SERVER['HTTP_X_API_KEY'];
        } else {
            return 'false';
        }
    }

    private function getuserid($token)
    {
        if ($token == '') {
            return 'false';
        }
        $Tquery = "SELECT user.Usts,user.Uperm as permession,user.Uid ,token.* FROM `token` LEFT JOIN user ON token.Tuid = user.Uid WHERE  `Ttoken`='" . $token . "'";
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $result = mysqli_fetch_assoc($temp);
        } else {
            $result = 'false';
        }
        return $result;
    }

    private function GetDataCategory($temp)
    {

        $data = [];
        $i = 0;
        while ($row = mysqli_fetch_assoc($temp)) {
            $data[$i] = (array("id" => $row['Cid'], "name_ar" => $row['Ct_ar'], "name_en" => $row['Ct_en'], "parent" => $row['Cpar']));
            $i++;
        }
        return $data;
    }


    private function CanReade()
    {
        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);
        $resualt = 'false';
        if ($user != 'false') {
            if ($user['Usts'] == 0) {
                $resualt = 'true';
            }
        }
        return $resualt;
    }





    public function CanEdit()
    {

        $resualt = 'false';
        if ($this->checkSLogin()) {
            $Tquery = "SELECT * FROM `user` WHERE `uname`='" . $_SESSION['username'] . "'";
            $temp = $this->makeQuery($Tquery);
            if ($temp->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($temp)) {
                    if ($row['Uperm'] == 1) {
                        $resualt = 'true';
                    }
                }
            }
        }else{
            $token = $this->gettokenfromhedar();
            $user = $this->getuserid($token);
            if ($user != 'false') {
                if ($user['Usts'] == 0) {
                    if ($user['permession'] == 1 || $user['permession'] == 2) {
                        $resualt = 'true';
                    }
                }

            }
        }
        return $resualt;
    }

    private function getMediaKeyword($keyword)
    {
        $this->keyword = '';
        if ($keyword != "") {
            $this->keyword = " AND (`media`.`Mt_ar` LIKE '%" . mysqli_real_escape_string($this->getConObj(), $keyword) . "%' OR `media`.`Mt_en` LIKE '%" . mysqli_real_escape_string($this->getConObj(), $keyword) . "%' OR `media`.`Mdesc_ar` LIKE '%" . mysqli_real_escape_string($this->getConObj(), $keyword) . "%' OR `media`.`Mdesc_en` LIKE '%" . mysqli_real_escape_string($this->getConObj(), $keyword) . "%' OR tags.Tags LIKE '%" . mysqli_real_escape_string($this->getConObj(), $keyword) . "%')";
        }
        return $this->keyword;
    }

    private function getMediaCategory($category)
    {
        $this->category = '';
        if ($category != 0 && $category != 'all') {
            $this->category = " AND `categories`.Cid in(" . $category . ")";
        }
        return $this->category;
    }

    private function getMediaId($id)
    {
        $this->id = '';
        if ($id != '') {
            $this->id = " AND `media`.`Mid`=" . $id . "";
        }
        return $this->id;
    }

    private function getMedialang($lang)
    {
        $this->lang = '';
        if ($lang != '') {
            $this->lang = "AND `media`.`Mlan`='" . $lang . "'";
        }
        return $this->lang;
    }

    private function getMediaType($type)
    {
        $this->type = '';
        if ($type != '') {
            $this->type = "AND `media`.`Mtype`='" . $type . "'";
        }
        return $this->type;
    }

    private function getMediaColor($color)
    {
        $this->color = '';
        if ($color != '') {
            $this->color = "AND `colors`.`Cocolor`='" . $color . "'";
        }
        return $this->color;
    }

    private function pagesnumber($num_rows)
    {
        $Pages_number = ceil($num_rows / $this->PerPage);
        return $Pages_number;
    }

    private function get_paginagtion($from, $to)
    {
        $this->FromTo = '';
        if ($to != null && $to > 0) {
            if ($from == '') {
                $from = 0;
            }
            $this->FromTo = " LIMIT " . $from . ", " . (int)$to;
        }
        return $this->FromTo;
    }

    private function getMediaSql()
    {
        $sql = "SELECT  distinct media.`Mid`,media.*,categories.*,type.* FROM  media  INNER JOIN categories ON media.Mcat = categories.Cid  INNER JOIN type ON media.Mtype = type.Tid  LEFT JOIN tags ON media.Mid = tags.Tmid  LEFT JOIN colors ON media.Mid = colors.Comid     where media.Mdelete=0 AND ( `media`.`Mid`>0 " . $this->id . $this->lang . $this->keyword . $this->category . $this->type . $this->color . " ) " . $this->orderby . $this->FromTo;

        return $sql;
    }

    private function GetDataMedia($temp)
    {
        $data = [];
        $i = 0;
        while ($row = mysqli_fetch_assoc($temp)) {
            $thumb = $this->URL . "medias/" . $row['Tdirectory'] . "/imagethumb_" . $row['Mid'] . "." . $row['Mexe'];
            if ($row['Mexe'] == 'svg') {
                $thumb = $this->URL . "medias/" . $row['Tdirectory'] . "/" . $row['file'] . "." . $row['Mexe'];
            }
            $data[$i] = (array("MediaId" => $row['Mid'], "MediaTitel_ar" => $row['Mt_ar'], "MediaTitel_en" => $row['Mt_en']
            , "MediaDescraption_ar" => $row['Mdesc_ar'], "MediaDescraption_en" => $row['Mdesc_en'], "MediaType" => $row['Mtype'], "MediaCategories" => $row['Mcat']
            , "MediaThumb" => $thumb, "MediaLanguage" => $row['Mlan'], "Categories_ar" => $row['Ct_ar'], "Categories_en" => $row['Ct_en']
            , "Type_ar" => $row['Tt_ar'], "Type_en" => $row['Tt_en'], "extension" => $row['Mexe'],
                "Path" => $this->URL . "medias/" . $row['Tdirectory'] . "/" . $row['file'] . "." . $row['Mexe']
            ));
            $i++;
        }
        return $data;
    }

    public function Media($type, $category, $keyword, $id, $lang, $page, $color)
    {


        if ($type == 6) {

            if ($keyword == '') {
                $keyword = 'tree';
            }
            // Get cURL resource
            $curl = curl_init();
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, [
                CURLOPT_RETURNTRANSFER => 1,
                CURLOPT_URL => 'https://api.unsplash.com/search/photos/?client_id=p_-iYKRiKkc0ZaLok6sEpux9xRXb_EN0YahTWJipqho&content_filter=high&query=' . $keyword . '&page=' . ($page + 1) . '&per_page=' . $this->PerPage,
                CURLOPT_USERAGENT => 'Codular Sample cURL Request'
            ]);
            $resp2 = curl_exec($curl);
            curl_close($curl);
            $data = [];
            $resp = json_decode($resp2, true);

            for ($i = 0; $i < $this->PerPage && $i < $resp['total_pages']; $i++) {
                $thumb = $resp['results'][$i]['urls']['thumb'];
                $small = $resp['results'][$i]['urls']['regular'];
                $data[$i] = (array("MediaId" => $resp['results'][$i]['id'], "MediaTitel_ar" => $resp['results'][$i]['alt_description'], "MediaTitel_en" => $resp['results'][$i]['alt_description']
                , "MediaDescraption_ar" => $resp['results'][$i]['alt_description'], "MediaDescraption_en" => $resp['results'][$i]['alt_description'], "MediaType" => 2, "MediaCategories" => 'photo'
                , "MediaThumb" => $thumb, "MediaLanguage" => 'en', "Categories_ar" => '', "Categories_en" => ''
                , "Type_ar" => '', "Type_en" => '', "extension" => 'jpg',
                    "Path" => $small
                ));
            }

            $result = $this->msg1($this->msg1_txt(), $data, $resp['total_pages']);
            return $result;
        }


        $this->keyword = $this->getMediaKeyword($keyword);
        $this->category = $this->getMediaCategory($category);
        $this->id = $this->getMediaId($id);
        $this->lang = $this->getMedialang($lang);
        $this->type = $this->getMediaType($type);
        $this->color = $this->getMediaColor($color);
        $this->orderby = '';// $this->StoriesFilter($filter);
        $this->FromTo = '';
        $sql = $this->getMediaSql();
        $temp = $this->makeQuery($sql);
        $page_count = $this->pagesnumber(mysqli_num_rows($temp));
        if ($page > $page_count) {
            $page = $page_count;
        } else if ($page < 0) {
            $page = 0;
        }
        $this->FromTo = $this->get_paginagtion((int)$page * (int)$this->PerPage, (int)$this->PerPage);
        $sql = $this->getMediaSql();

        $temp = $this->makeQuery($sql);
        if ($temp->num_rows > 0) {
            $result = $this->msg1($this->msg1_txt(), $this->GetDataMedia($temp), $page_count);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;

    }

    private function GetDataTageswords($temp)
    {

        $data = [];
        $i = 0;
        while ($row = mysqli_fetch_assoc($temp)) {
            $data[$i] = (array("Tags" => $row['Tags'], "MediaId" => $row['Tmid']));
            $i++;
        }
        return $data;
    }

    public function GetTagsmediaId($id)
    {
        $Tquery = "SELECT * FROM `tags` WHERE `Tmid`=" . $id;
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $result = $this->msg1($this->msg1_txt(), $this->GetDataTageswords($temp), $temp->num_rows);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function GetTagsmediaWord($keyword)
    {
        $Tquery = "SELECT * FROM `tags` WHERE `Tags` like '%" . $keyword . "%'";
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $result = $this->msg1($this->msg1_txt(), $this->GetDataTageswords($temp), $temp->num_rows);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    private function GetDataTypes($temp)
    {
        $data = [];
        $i = 0;
        while ($row = mysqli_fetch_assoc($temp)) {
            $data[$i] = (array("id" => $row['Tid'], "name_ar" => $row['Tt_ar'], "name_en" => $row['Tt_en'], "directory" => $row['Tdirectory']));
            $i++;
        }
        return $data;
    }

    public function Types()
    {
        $Tquery = "SELECT * FROM `type` WHERE `Tid`>0";
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $result = $this->msg1($this->msg1_txt(), $this->GetDataTypes($temp), $temp->num_rows);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function Category($type)
    {
        if ($type != '') {
            $Tquery = "SELECT categories.* FROM `cat_type` LEFT JOIN categories on categories.Cid=`catid` WHERE `typeid`=" . $type;
        } else {
            $Tquery = "SELECT * FROM `categories` WHERE Cid>0";
        }
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $result = $this->msg1($this->msg1_txt(), $this->GetDataCategory($temp), $temp->num_rows);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    private function CheckedId($id)
    {
        $Tquery = "SELECT * FROM `media` WHERE `Mid`=" . $id;
        $temp = $this->makeQuery($Tquery);
        $result = 'false';
        if ($temp->num_rows > 0) {
            $result = mysqli_fetch_assoc($temp);
        }
        return $result;
    }


    private function chekedTagesId($id, $tag)
    {
        $Tquery = "SELECT * FROM `tags` WHERE `Tmid`=" . $id . " and `Tags`='" . $tag . "'";
        $temp = $this->makeQuery($Tquery);
        $result = 'false';
        if ($temp->num_rows > 0) {
            $result = 'true';
        }
        return $result;
    }

    private function chekedColorId($id, $color)
    {
        $Tquery = "SELECT * FROM `colors` WHERE `Comid`=" . $id . " and `Cocolor`='" . $color['color'] . "'";
        $temp = $this->makeQuery($Tquery);
        $result = 'false';
        if ($temp->num_rows > 0) {
            $result = 'true';
        }
        return $result;
    }


    public function DeleteTages($id, $tage)
    {

        if ($this->CanEdit()) {
            $result = $this->msg2($this->msg3_txt());
            if ($this->CanEdit()) {
                $Tquery = "DELETE FROM `tags` WHERE `Tmid`=" . $id . " and `Tags`='" . mysqli_real_escape_string($this->getConObj(), $tage) . "'";
                $temp = $this->makeQuery($Tquery);
                if ($temp) {
                    $result = $this->msg1($this->msg1_txt(), $this->json(), 0);
                }
            }
        } else {
            $result = $this->msg2($this->msg5_txt());
        }
        return $result;
    }

    private function CanYouEdit($parmation)
    {
        $result = 'false';
        if ($parmation == 1 || $parmation == 2) {
            $result = 'true';
        }
        return $result;
    }

    public function CreateMedia($id, $tages, $category, $type, $titel_ar, $titel_en, $description_ar, $description_en, $language)
    {


        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);
        if ($user != 'false') {
            if ($this->CanYouEdit($user['permession']) == 'true') {

                if ($id == 'new' && $_FILES['media']["name"] != '') {


                    $result = $this->UploadFile($tages, $category, $type, $titel_ar, $titel_en, $description_ar, $description_en, $language, $user['Uid']);
                } else if ($id != 'new') {

                    $result = $this->updateMedia($id, $tages, $category, $type, $titel_ar, $titel_en, $description_ar, $description_en, $language, $user['Uid']);
                }
            } else {
                $result = $this->msg2($this->msg5_txt());
            }
        } else {
            $result = $this->msg2($this->msg5_txt());
        }


        return $result;
    }

    private function DeleteAllTages($id)
    {
        $Tquery = "DELETE FROM `tags` WHERE `Tmid`=" . $id;
        $temp = $this->makeQuery($Tquery);

    }

    private function resize($newWidth, $targetFile, $originalFile, $id)
    {

        $info = getimagesize($targetFile . $originalFile);
        $mime = $info['mime'];

        switch ($mime) {
            case 'image/jpeg':
            case 'image/jpg':
                $image_create_func = 'imagecreatefromjpeg';
                $image_save_func = 'imagejpeg';
                $new_image_ext = 'jpg';
                break;

            case 'image/png':
                $image_create_func = 'imagecreatefrompng';
                $image_save_func = 'imagepng';
                $new_image_ext = 'png';
                break;

            case 'image/gif':
                $image_create_func = 'imagecreatefromgif';
                $image_save_func = 'imagegif';
                $new_image_ext = 'gif';
                break;

            default:
                throw new Exception('Unknown image type.');
        }

        $img = $image_create_func($targetFile . $originalFile);
        list($width, $height) = getimagesize($targetFile . $originalFile);

        $newHeight = ($height / $width) * $newWidth;
        $tmp = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($tmp, $img, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
        $thumb = 'imagethumb_';
        $image_save_func($tmp, "$targetFile$thumb$id$new_image_ext");
    }

    private function updateMedia($id, $tages, $category, $type, $titel_ar, $titel_en, $description_ar, $description_en, $language, $user)
    {

        $media = $this->CheckedId($id);
        if ($media != 'false') {

            if ($_FILES['media']["name"] == '') {
                $Tquery = "UPDATE `media` SET `Mt_ar`='" . mysqli_real_escape_string($this->getConObj(), $titel_ar) . "',`Mt_en`='" . mysqli_real_escape_string($this->getConObj(), $titel_en) . "',`Mdesc_ar`='" . mysqli_real_escape_string($this->getConObj(), $description_ar) . "',`Mdesc_en`='" . mysqli_real_escape_string($this->getConObj(), $description_en) . "',`Mtype`='" . mysqli_real_escape_string($this->getConObj(), $type) . "',`Mcat`=" . $category . ",`Muid`=" . $user . ",`Mthumb`='',`Mlan`=" . $language . " WHERE `Mid`=" . $id;

            } else {

                $newFileName = "medias/" . $type . "/" . $media['file'];
                $masge = $this->UploadImage('media', $newFileName);


                if ($masge['masge'] == '') {
                    if ($type == 'images' && $masge['ext'] != 'svg') {
                        $this->resize(200, "medias/" . $type . "/", $media['file'] . "." . $masge['ext'], $id . '.');
                    }

                    $this->DeleteAllTages($id);
                    $setTitel_ar = '';
                    if ($titel_ar != '') {
                        $setTitel_ar = ",`Mt_ar`='" . mysqli_real_escape_string($this->getConObj(), $titel_ar) . "'";
                    }
                    $setTitel_en = '';
                    if ($titel_en != '') {
                        $setTitel_en = ",`Mt_en`='" . mysqli_real_escape_string($this->getConObj(), $titel_en) . "'";
                    }
                    $setDescription_ar = '';
                    if ($description_ar != '') {
                        $setDescription_ar = ",`Mdesc_ar`='" . mysqli_real_escape_string($this->getConObj(), $description_ar) . "'";
                    }
                    $setDescription_en = '';
                    if ($description_en != '') {
                        $setDescription_en = ",`Mdesc_en`='" . mysqli_real_escape_string($this->getConObj(), $description_en) . "'";
                    }
                    $setcategory = '';
                    if ($category != '') {
                        $setcategory = ",`Mcat`=" . $category;
                    }
                    $types = $this->getTypes($type);


                    $Tquery = "UPDATE `media` SET `Mtype`='" . mysqli_real_escape_string($this->getConObj(), $types) . "'" . $setTitel_ar . $setTitel_en . $setDescription_ar . $setDescription_en . $setcategory . ",`Muid`=" . $user . ",`Mthumb`='',`Mlan`=" . $language . ",`Mexe`='" . mysqli_real_escape_string($this->getConObj(), $masge['ext']) . "'  WHERE `Mid`=" . $id;

                }

            }
            $temp = $this->makeQuery($Tquery);
            if ($temp) {
                $colors = '';


                $tagesinsert = $this->TagesInsert($id, $tages);
                $Tquery = $tagesinsert;
                if ($type == 'images' && $_FILES['media']["name"] != '') {
                    $colors = $this->AddColors($id, $masge['file']);
                    $Tquery .= $colors;
                }


                $temp = $this->getConObj()->multi_query($Tquery);
                $result = $this->msg1($this->msg1_txt(), $this->json(), 0);
            }

        } else {
            $result = $this->msg2($this->msg6_txt());
        }
        return $result;
    }

    private function getTypes($directory)
    {
        $Tquery = "SELECT * FROM `type` WHERE `Tdirectory`='" . $directory . "'";
        $temp = $this->makeQuery($Tquery);
        $row = mysqli_fetch_assoc($temp);
        return $row['Tid'];
    }

    private function converttype($type)
    {
        $result = '';
        switch ($type) {
            case 'audios':
                $result = 1;
                break;
            case 'images':
                $result = 2;
                break;
            case 'videos':
                $result = 4;
                break;
            case 'documents':
                $result = 5;
                break;

        }
        return $result;
    }

    private function UploadFile($tages, $category, $type, $titel_ar, $titel_en, $description_ar, $description_en, $language, $user)
    {

        $id = $this->GetLastId('`media`', 'Mid');
        $newId = $id + 1;
        $filename = $this->getToken();
        $newFileName = "medias/" . $type . "/" . $filename;

        $masge = $this->UploadImage('media', $newFileName);


        if ($masge['masge'] == '') {

            $Tquery = "INSERT INTO `media`(`Mid`, `file`, `Mt_ar`, `Mt_en`, `Mdesc_ar`, `Mdesc_en`, `Mtype`, `Mcat`, `Muid`, `Mthumb`, `Mexe`, `Mdelete`, `Mcdate`, `Mlan`) VALUES (null,'" . $filename . "','" . mysqli_real_escape_string($this->getConObj(), $titel_ar) . "','" . mysqli_real_escape_string($this->getConObj(), $titel_en) . "','" . mysqli_real_escape_string($this->getConObj(), $description_ar) . "','" . mysqli_real_escape_string($this->getConObj(), $description_en) . "','" . mysqli_real_escape_string($this->getConObj(), $this->converttype($type)) . "'," . $category . "," . $user . ",'','" . mysqli_real_escape_string($this->getConObj(), $masge['ext']) . "','0','" . date("Y-m-d H:i:s") . "'," . $language . ")";
            $temp = $this->makeQuery($Tquery);
            if ($temp) {

                $colors = '';
                $tagesinsert = $this->TagesInsert($newId, $tages);
                $Tquery = $tagesinsert;
                if ($type == 'images') {
                    $this->resize(200, "medias/" . $type . "/", $filename . "." . $masge['ext'], $newId . '.');
                    //$this->resize(1024, "medias/" . $type."/", $filename."regular.".$masge['ext'],$newId.'.');
                    $colors = $this->AddColors($newId, $masge['file']);
                    $Tquery .= $colors;

                }


                $temp = $this->getConObj()->multi_query($Tquery);
                $result = $this->msg1($this->msg1_txt(), $this->json(), 0);
            }
        } else {
            $result = $this->msg2($this->msg6_txt());
        }
        return $result;
    }


    private function TagesInsert($id, $tages)
    {
        $data = explode(',', $tages);
        $Tquery = '';
        for ($i = 0; $i < count($data); $i++) {
            if ($data[$i] != '' && $data[$i] != 'null' && $this->chekedTagesId($id, trim($data[$i], " ")) == 'false') {
                $tage = trim($data[$i], " ");
                $Tquery .= "INSERT INTO `tags`(`Tid`, `Tags`, `Tmid`, `Tcdate`) VALUES (null,'" . mysqli_real_escape_string($this->getConObj(), $tage) . "'," . $id . ",now());";
            }
        }
        return $Tquery;
    }

    public function AddTages($id, $tages)
    {
        if ($this->CanEdit()) {
            if ($this->CheckedId($id) != 'false') {
                $Tquery = $this->TagesInsert($id, $tages);
                $temp = $this->getConObj()->multi_query($Tquery);
                if ($temp) {
                    $result = $this->msg1($this->msg1_txt(), $this->json(), 1);
                } else {
                    $result = $this->msg2($this->msg6_txt());
                }
            } else {
                $result = $this->msg2($this->msg6_txt());
            }
        } else {
            $result = $this->msg2($this->msg5_txt());
        }

        return $result;
    }
    public function NumberofMedia(){
        $Tquery="SELECT count(`Mid`) as NO FROM `media` WHERE `Mdelete`=0";
        $temp = $this->makeQuery($Tquery);
        $row = mysqli_fetch_assoc($temp);
        $result = $row['NO'];
        return $result;
    }
    public function NumberofCategories(){
        $Tquery="SELECT count(`Cid`) as NO FROM `categories` WHERE `Cid`>0";
        $temp = $this->makeQuery($Tquery);
        $row = mysqli_fetch_assoc($temp);
        $result = $row['NO'];
        return $result;
    }
    public function NumberofTypes(){
        $Tquery="SELECT count(`Tid`) as NO FROM `type` WHERE `Tid`>0";
        $temp = $this->makeQuery($Tquery);
        $row = mysqli_fetch_assoc($temp);
        $result = $row['NO'];
        return $result;
    }
    public function AddColors($id, $file)
    {
        $colors = $this->ex->Get_Color($file, 4, true, true, 20);
        $Tquery = 'DELETE FROM `colors` WHERE `Comid`=' . $id . " ;";
        for ($i = 0; $i < count($colors); $i++) {
            $Tquery .= "INSERT INTO `colors`(`Coid`, `Comid`, `Cocolor`, `Cocolorper`) VALUES (null," . $id . ",'" . mysqli_real_escape_string($this->getConObj(), $colors[$i]['color']) . "','" . mysqli_real_escape_string($this->getConObj(), $colors[$i]['value']) . "');";
        }
        return $Tquery;
    }

    private function GetLastId($tablename, $Trow)
    {

        $chek = "SELECT MAX(" . $Trow . ") as id FROM " . $tablename;
        $result = '';
        $temp = $this->makeQuery($chek);
        if ($temp->num_rows > 0) {
            $row = mysqli_fetch_assoc($temp);
            $result = $row['id'];
        } else {
            $result = 'false';
        }
        return $result;

    }

    private function UploadImage($image, $newFileName)
    {

        $masge = '';
        $fileName = $_FILES[$image]["name"]; // The file name
        $fileTmpLoc = $_FILES[$image]["tmp_name"]; // File in the PHP tmp folder
        $fileType = $_FILES[$image]["type"]; // The type of file it is
        $fileSize = $_FILES[$image]["size"]; // File size in bytes
        $fileErrorMsg = $_FILES[$image]["error"]; // 0 for false... and 1 for true
        $fileName = preg_replace('#[^a-z.0-9]#i', '', $fileName); // filter the $filename
        $kaboom = explode(".", $fileName); // Split file name into an array using the dot
        $fileExt = end($kaboom); // Now target the last array element to get the file extension

        // START PHP Image Upload Error Handling --------------------------------
        if (!$fileTmpLoc) { // if file not chosen
            $masge = "ERROR: Please browse for a file before clicking the upload button.";
        } else if ($fileSize > 104857600) { // if file size is larger than 5 Megabytes
            $masge = "ERROR: Your file was larger than 5 Megabytes in size.";
            unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
        } else if (!preg_match("/.(gif|jpg|png|mp3|svg|mp4|MP4)$/i", $fileName)) {
            // This condition is only if you wish to allow uploading of specific file types
            $masge = "ERROR: Your image was not .gif, .jpg, or .png.";
            unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
        } else if ($fileErrorMsg == 1) { // if file upload error key is equal to 1
            $masge = "ERROR: An error occured while processing the file. Try again.";
        }
        if ($masge == '') {
            // END PHP Image Upload Error Handling ----------------------------------
            // Place it into your "uploads" folder mow using the move_uploaded_file() function
            $fileName = $newFileName . '.' . $fileExt;
            $moveResult = move_uploaded_file($fileTmpLoc, $fileName);
            // Check to make sure the move result is true before continuing
            if ($moveResult != true) {
                $masge = "ERROR: File not uploaded. Try again.";
            }
            return array('file' => $fileName, 'masge' => $masge, 'ext' => $fileExt);
        }
        return array('file' => $fileName, 'masge' => $masge, 'ext' => $fileExt);
    }
}

$api = medialibrary::getObj();
$session_lang;
if (isset($_GET["process"]) && $_GET["process"] != "") {
    switch ($_GET["process"]) {
        case "logout":
            $api->sLogout();
           header('Location: login.php');
            break;
        case "type":
            echo $api->Types();
            break;
        case "category":
            echo $api->Category($_GET["type"]);
            break;
        case "media":
            echo $api->Media($_GET["filter_type"], $_GET["filter_cat"], $_GET["filter_keyword"], $_GET["id"], $_GET["filter_lan"], $_GET["page"], $_GET["filter_color"]);
            break;
        case "tagsmediaid":
            echo $api->GetTagsmediaId($_GET["id"]);
            break;
        case "tagsmediaword":
            echo $api->GetTagsmediaWord($_GET["keyword"]);
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
        case "addtages":
            echo $api->AddTages($_POST['id'], $_POST['tages']);
            break;
        case "deletetages":
            echo $api->DeleteTages($_POST['id'], $_POST['tage']);
            break;
        case 'CreateMedia':

            echo $api->CreateMedia($_POST['id'], $_POST['tage'], $_POST['category'], $_POST['type'], $_POST['titel_ar'], $_POST['titel_en'], $_POST['description_ar'], $_POST['description_en'], $_POST['language']);
            break;


    }
}
