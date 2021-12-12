<?php
/**
 * Created by Dar Almanhal - khalid alomiri.
 * User: khalid alomiri
 * Date: 1/5/2020
 * Time: 03:02 م
 */
error_reporting(0);
header("Access-Control-Allow-Origin: *");
//header("Content-Type: application/json; charset=UTF-8");
//header("Access-Control-Allow-Methods: POST");
//header("Access-Control-Allow-Methods: GET");
//header("Access-Control-Max-Age: 3600");
//header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
//header('Content-Type: application/json');


trait message
{
    public function msg1($msg, $data, $page)
    {
        echo json_encode(array("result" => "1", "message" => $msg, "pagenumber" => $page, "data" => $data));
    }

    public function json()
    {
        $json = '{}';
        $json2 = json_decode($json);
        return $json2;
    }

    public function msg2($data)
    {

        echo json_encode(array("result" => "0", "message" => $data, "data" => $this->json()));
    }

    public function msg1_txt()
    {
        return 'Invalid username or password';
    }

    public function msg2_txt()
    {
        return 'There are no data';
    }

    public function msg3_txt()
    {
        return 'SocialLogin error';
    }

    public function msg4_txt()
    {
        return 'username is already taken';
    }

    public function msg5_txt()
    {
        return 'email is already taken';
    }

    public function msg6_txt()
    {
        return 'username is not already taken';
    }

    public function msg7_txt()
    {
        return 'email is not already taken';
    }

    public function msg8_txt()
    {
        return 'Error Email';
    }

    public function msg9_txt()
    {
        return 'Cannot Send Email';
    }

    public function msg10_txt()
    {
        return 'Password changed successfully';
    }

    public function msg11_txt()
    {
        return 'error new Password OR Confirm Password';
    }

    public function msg12_txt()
    {
        return 'It was previously recorded';
    }

    public function msg13_txt()
    {
        return 'operation accomplished successfully';
    }

    public function msg14_txt()
    {
        return 'Deleted';
    }

    public function msg15_txt()
    {
        return 'error token';
    }

    public function msg16_txt()
    {
        return 'success';
    }

    public function msg17_txt()
    {
        return 'Cannot update';
    }

    public function msg18_txt()
    {
        return 'Unexpected error occured Err: 230217045055';
    }

    public function msg19_txt()
    {
        return 'Error Location';
    }
}

class store
{
    protected $conn;
    use message;

    public function __construct()
    {
        global $con;
        $this->conn = $con;
        $this->URL = 'https://www.manhal.com/';
        $this->PerPage = 12;
        $this->Expires = 2;
    }

    public function LoginUserManhal($name, $pass)
    {
        if ($name == '' || $pass == '') {
            $result = $this->msg2($this->msg1_txt());
            //  return $result;
        }
        $sql = "SELECT * FROM `users` WHERE `uname`='" . $name . "' and `password`='" . $pass . "'";
        $result = $this->conn->query($sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $token = $this->CreateTokenCode($row['userid']);
            if ($token == 'false') {
                $result = $this->msg2($this->msg1_txt());
                return $result;
            }
            $data = array("userid" => $row['userid'], "uname" => $row['uname'], "fullname" => $row['fullname'], "email" => $row['email'], "avatar" => $this->URL . $row['avatar'], "address" => $row['address'], "gender" => $row['gender'], "birthdate" => $row['birthdate'], "token" => $token);
            $result = $this->msg1($this->msg16_txt(), $data, 0);
        } else {
            $result = $this->msg2($this->msg1_txt());
        }
        return $result;
    }

    public function LoginUserSocial($social, $name, $fname, $lname, $gender, $email, $avatar, $birthdate)
    {

        if (trim($name) == '' || trim($email) == '' || trim($social) == '') {
            $result = $this->msg2($this->msg1_txt());
            return $result;
        }

        $sql = "SELECT * FROM users WHERE social=" . $social . " AND status=1";
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $sql = "UPDATE `users` SET `lastlogin`=NOW(),`token`='" . $row['social'] . "' WHERE userid=" . $row["userid"];
            $this->conn->query($sql);
            $token = $this->CreateTokenCode($row['userid']);
            if ($token == 'false') {
                $result = $this->msg2($this->msg1_txt());
                return $result;
            }
            $data = array("userid" => $row['userid'], "fullname" => $row['fullname'], "email" => $row['email'], "avatar" => $row['avatar'], "address" => $row['address'], "gender" => $row['gender'], "token" => $token, "birthdate" => $row['birthdate']);
            $result = $this->msg1($this->msg16_txt(), $data, 0);
        } else {
            $date = date("d/m/Y");
            $vuser_lastname = $lname;
            $fullName = $fname . " " . $vuser_lastname;
            $countryCode = $this->GetIP();
            $sql = "INSERT INTO `users`(`userid`, `uname`, `password`, `email`, `permession`, `cdate`, `fullname`, `status`, `token`, `ctime`, `social`, `avatar`, `views_count`, `sales_count`, `country`, `address`, `phone`, `birthdate`, `gender`) VALUES ('','" . mysqli_real_escape_string($this->conn, $name) . "','','" . $email . "','',CURDATE(),'" . mysqli_real_escape_string($this->conn, $fname) . "','1','','','" . $social . "','" . $avatar . "','0','0','" . $countryCode . "','','','" . $birthdate . "','')";
            if ($this->conn->query($sql) === TRUE) {
                // echo  $last_id = $this->conn->insert_id;
                return $this->LoginUserSocial($social, $name, $fname, $lname, $gender, $email);
            } else {
                $result = $this->msg2($this->msg3_txt());
            }

        }
        return $result;
    }

    public function signupManhal($email, $pass, $name)
    {
        if ($this->CheckEmail($email) == 'false' and $this->CheckUser($name) == 'false') {

            if ($this->username_v($name) == 'true' and $this->email_v($email) == 'true' and $this->pass_v($pass) == 'true') {
                $countryCode = $this->GetIP();
                $token = $this->getToken();
                $sql = "INSERT INTO `users`(`userid`,`uname`,`fullname`,`email`, `password`, `status`, `token`,`cdate`, `views_count`, `sales_count`,`country`) VALUES (null,'" . mysqli_real_escape_string($this->conn, $name) . "','" . mysqli_real_escape_string($this->conn, $name) . "','" . $email . "','" . mysqli_real_escape_string($this->conn, $pass) . "',1,'" . $token . "',CURDATE(),'0','0','" . $countryCode . "')";
                if ($this->conn->query($sql)) {
                    $this->SendMail($emai, 'signup', "Ar");
                    return $this->LoginUserManhal($name, $pass);
                }
            } else {
                $result = $this->msg2($this->msg1_txt());
                return $result;
            }

        } else {
            $data = [];
            $data['username'] = $this->msg6_txt();
            $data['email'] = $this->msg7_txt();
            if ($this->CheckUser($name) == 'true') {
                $data['username'] = $this->msg4_txt();
            }
            if ($this->CheckEmail($emai) == 'true') {
                $data['email'] = $this->msg5_txt();
            }
            $result = $this->msg2($data);
        }
        return $result;
    }

    public function ChangePassword($old_password, $new_password)
    {

        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);

        if ($user != 'false') {
            $userid=$user['userid'];
            if ($old_password == '' || $new_password == "" || $userid == '' || trim($new_password) == "") {
                return $this->msg2($this->msg11_txt());
            }
            $sql = "SELECT * FROM `users` WHERE `userid`=" . $userid . " AND `password`='" . $old_password . "'";
            $result = $this->conn->query($sql);

            if (mysqli_num_rows($result) > 0) {
                $sql = "UPDATE `users` SET `password`='" . $new_password . "' WHERE `userid`=" . $userid;
                $this->conn->query($sql);
                $result = $this->msg1($this->msg10_txt(), $this->json(), 0);
            } else {
                $result = $this->msg2($this->msg11_txt());
            }
        } else {
            $result = $this->msg2($this->msg15_txt());
        }
        return $result;
    }

    private function CheckUser($name)
    {
        if ($name == '' || trim($name) == '') {
            return 'false';
        }
        $sql = "SELECT * FROM `users` WHERE `uname`='" . $name . "'";
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            return 'true';
        } else {
            return 'false';
        }

    }

    private function SendMail($email, $type, $lang, $object)
    {
        $logo = SITE_URL . "images/logo.png";
        switch ($type) {
            case 'signup':
                $message = file_get_contents("../../templates/mailsignup_" . $lang . ".html");
                $subject = 'manhal.com';
                $headers .= "Reply-To: " . strip_tags($email) . "\r\n";
                break;
            case 'ForgotPassword':
                $message = file_get_contents("../../templates/forget_pass_" . $lang . ".html");
                $message = str_replace("#Manhal_Username#", $object['uname'], $message);
                $message = str_replace("#Link#", "https://www.manhal.com/" . $lang . "/reset-password?token=" . $object['token'], $message);
                $subject = 'Manhal.com Forgotten Password Reset';


                break;
        }
        $message = str_replace("#Manhal_logo#", $logo, $message);
        $to = $email;
        $headers = "From:'support@manhal.com'\r\n";
        $headers .= "Reply-To:'support@manhal.com'\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        if (mail($to, $subject, $message, $headers)) {
            //  $result = $this->msg1($object['data'], 0);
        } else {
            //  $result = $this->msg2($this->msg9_txt());
        }
        // return $result;
    }

    private function CheckEmail($email)
    {
        if ($email == '' || trim($email) == '') {
            return 'false';
        }
        $sql = "SELECT * FROM `users` WHERE `email`='" . $email . "'";
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            return 'true';
        } else {
            return 'false';
        }

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

    public function get_category($type, $icon)
    {
        $urlicon = '';

        $sql = "Select `catid`,`name_ar`,`name_en` From  " . $type . " WHERE `parent`=0 ORDER BY `".$type."`.`sort` ASC";
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $data = [];
            $i = 0;

            while ($row = mysqli_fetch_assoc($result)) {
                if ($icon != '') {
                    $urlicon = $this->URL . 'themes/main-Light-green-En/images/cat/' . $icon . '/' . $row['catid'] . '.svg';
                }

                $data[$i] = (array("catid" => $row['catid'], "name_ar" => $row['name_ar'], "name_en" => $row['name_en'], "icon" => $urlicon));
                $i++;
            }
            $result = $this->msg1($this->msg16_txt(), $data, $i);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    private function get_books_keyword($keyword)
    {
        $this->keyword = '';
        if ($keyword != "") {
            $this->keyword = " AND ( `name` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `description_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `description_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `author_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `author_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `isbn` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' )";
        }
        return $this->keyword;
    }

    private function get_books_category($category)
    {
        $this->category = '';
        if ($category != 0) {
            $this->category .= " AND `category` in(" . $category . ")";
        }

        return $this->category;
    }

    private function get_books_lang($lang)
    {
        $this->lang = '';
        if ($lang != '') {
            $this->lang = "AND `books`.`language`='" . $lang . "'";
        }
        return $this->lang;
    }

    private function get_books_Id($id)
    {
        $this->id = '';
        if ($id != '') {
            $this->id = " AND `books`.`bookid`=" . $id . "";
        }
        return $this->id;
    }

    private function get_books_store($store)
    {
        $this->store = '';
        if ($store == 1) {
            $this->store = " AND `books`.`store`=1 ";
        } else if ($store == 0) {
            $this->store = " AND `books`.`store`=0  AND `books`.`booktype`in(1,3,5,7)";
        } else if ($store == 2) {
            $this->store = " AND ((`books`.`store`=0  AND `books`.`booktype`in(1,3,5,7)) OR `books`.`store`=1 )";
        }
        return $this->store;
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

    private function getbookssql()
    {
        $books = "(`books`.bookid) as id ,IF(status=1,'https://www.manhal.com/platform/books/###/cover.jpg','')as thumbnail,`books`.name as title_ar ,`books`.name as title_en,`books`.price,`books`.`rating_count` as rate,`books`.`views`,`books`.description_ar,`books`.description_en,`books`.isbn,`books`.status,`books`.count";
        $sql = "SELECT " . $books . " FROM `books` left OUTER JOIN `categories` ON `books`.`category`=`categories`.`catid` WHERE `books`.`status` =1  AND( `books`.`bookid`>0 " . $this->keyword . $this->store . $this->category . $this->lang . $this->Price . $this->id . " ) " . $this->orderby . $this->FromTo;
        return $sql;
    }

    private function pagesnumber($num_rows)
    {
        $Pages_number = ceil($num_rows / $this->PerPage);
        return $Pages_number;
    }

    private function BooksFilter($filter)
    {
        switch ($filter) {
            case 'Recent':
                $this->OrderBy = " order by `books`.`booktype` DESC,bookid DESC ";
                break;
            case 'Seller':
                $this->OrderBy = " order by `books`.`booktype` DESC,`books`.`sales` DESC ";
                break;
            case 'Popular':
                $this->OrderBy = " order by `books`.`booktype` DESC,`books`.`views` DESC  ";
                break;
            case 'TopRated':
                $this->OrderBy = " order by `books`.`booktype` DESC,`books`.`rate` DESC ";
                break;
            case 'TopFavorite':
                $this->OrderBy = " order by `books`.`booktype` DESC,`books`.`favorites` DESC  ";
                break;
            case 'bigger':
                $this->OrderBy = " order by `books`.`booktype` DESC,`books`.`price` DESC  ";
                break;
            case 'smaller':
                $this->OrderBy = " order by `books`.`booktype` DESC,`books`.`price` ASC  ";
                break;
            default:
                $this->OrderBy = 'ORDER BY `books`.`booktype` DESC,`books`.`name` DESC ';
                break;
        }
        return $this->OrderBy;
    }

    public function getbooks($keyword, $category, $lang, $Price, $id, $store, $page, $filter, $operation)
    {

        $this->keyword = $this->get_books_keyword($keyword);
        $this->category = $this->get_books_category($category);
        $this->lang = $this->get_books_lang($lang);
        $this->store = $this->get_books_store($store);
        $this->id = $this->get_books_Id($id);
        $this->Price = $this->get_books_price($operation, $Price);
        $this->orderby = $this->BooksFilter($filter);
        $this->FromTo = '';
        $sql = $this->getbookssql();
        $result = $this->conn->query($sql);
        $page_count = $this->pagesnumber(mysqli_num_rows($result));
        if ($page > $page_count) {
            $page = $page_count;
        } else if ($page < 0) {
            $page = 0;
        }

        $this->FromTo = $this->get_paginagtion($page * $this->PerPage, $this->PerPage);
        $sql = $this->getbookssql();
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $data = [];
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $slider = $this->GetScreenShots('book', $row['id'], '');
                $thumbnail = str_replace("###", $row['id'], $row['thumbnail']);
                $price=$this->convertCurrency($row['price']);

                $data[$i] = (array("id" => $row['id'], "type" => 'book', "thumbnail" => $thumbnail, "title_ar" => $row['title_ar'], "title_en" => $row['title_en'], "price" => $price, "isbn" => $row['isbn'], "availible" => $this->convertnullto($row['status']), "count" => $this->convertnullto($row['count']), "description_en" => $row['description_en'], "description_ar" => $row['description_ar'], "slider" => $slider));
                $i++;
            }
            $result = $this->msg1($this->msg16_txt(),$data, $page_count);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    private function getproductssql()
    {
        $sql = "SELECT `products`.*,`brand`.*,`products`.`name_ar` as title_ar,`products`.`name_en` as title_en ,`departments`.*, `brand`.`name_ar` as brand_ar, `brand`.`name_en` as brand_en, `departments`.`name_ar` as department_ar, `departments`.`name_en` as department_en FROM `products` left OUTER JOIN `brand` ON `products`.`brand`=`brand`.`catid` left OUTER JOIN `departments` ON `products`.`department`=`departments`.`catid` WHERE `products`.`status` =1 AND( `products`.`status`=1 " . $this->keyword . $this->brand . $this->department . $this->price . " ) " . $this->orderby . $this->FromTo;
        return $sql;
    }

    private function get_products_keyword($keyword)
    {
        $this->keyword = '';
        if ($keyword != "") {
            $this->keyword = " AND ( `products`.`name_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `products`.`name_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `products`.`description_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `products`.`description_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `products`.`ISBN` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' )";
        }
        return $this->keyword;
    }

    private function get_products_brand($brand)
    {
        $this->brand = '';
        if ($brand != 0) {
            $this->brand = " AND `brand` in(" . $brand . ")";
        }
        return $this->brand;
    }

    private function get_products_department($department)
    {
        $this->department = '';
        if ($department != 0) {
            $this->department = " AND `department` in(" . $department . ")";
        }
        return $this->department;
    }

    private function get_products_price($operation, $Price)
    {
        $this->Price = '';
        if ($Price != 0) {
            $this->Price = " AND `Price` " . $this->get_Processes_price($operation, $Price);;
        }
        return $this->Price;
    }

    private function get_Processes_price($operation, $Price)
    {
        $reteunopp = '=';
        switch ($operation) {
            case '1':
                $reteunopp = '=' . $Price;
                break;
            case '2':
                $reteunopp = '=>' . $Price;
                break;
            case '3':
                $reteunopp = '=<' . $Price;
                break;
            case '4':
                $Price1 = explode(',', $Price);
                $reteunopp = 'BETWEEN ' . $Price1[0] . ' and ' . $Price1[1];
                break;
        }
        return $reteunopp;
    }

    private function get_books_price($operation, $Price)
    {
        $this->Price = '';
        if ($Price != 0) {

            $this->Price = " AND `price` " . $this->get_Processes_price($operation, $Price);
        }
        return $this->Price;
    }

    private function get_story_price($operation, $Price)
    {
        $this->Price = '';
        if ($Price != 0) {
            $this->Price = " AND `price` " . $this->get_Processes_price($operation, $Price);;
        }
        return $this->Price;
    }

    private function get_products_Id($id)
    {
        $this->id = '';
        if ($id != '') {
            $this->id = " AND `products`.`productid`=" . $id . "";
        }
        return $this->id;
    }

    private function productsFilter($filter)
    {
        switch ($filter) {
            case 'Recent':
                $this->OrderBy = " ORDER BY productid DESC ";
                break;
            case 'Seller':
                $this->OrderBy = " ORDER BY   products.sales_count Desc ";
                break;
            case 'Popular':
                $this->OrderBy = " ORDER BY   view_count Desc  ";
                break;
            case 'TopRated':
                $this->OrderBy = " ORDER BY   products.rate Desc ";
                break;
            case 'TopFavorite':
                $this->OrderBy = " ORDER BY   products.favorite_count Desc   ";
                break;
            case 'bigger':
            case 'Bigger':
                $this->OrderBy = " ORDER BY   products.Price Desc   ";
                break;
            case 'smaller':
            case 'Smaller':
                $this->OrderBy = " ORDER BY   products.Price ASC   ";
                break;

            default:
                $this->OrderBy = ' ORDER BY `products`.`productid` DESC';
                break;
        }
        return $this->OrderBy;
    }

    private function convertnullto($var)
    {

        if (is_null($var)) {
            $var = '';
        }
        return $var;
    }

    public function getproducts($keyword, $department, $brand, $Price, $id, $page, $filter, $operation)
    {

        $this->keyword = $this->get_products_keyword($keyword);
        $this->brand = $this->get_products_brand($brand);
        $this->department = $this->get_products_department($department);
        $this->id = $this->get_products_Id($id);
        $this->Price = $this->get_products_price($operation, $Price);
        $this->orderby = $this->productsFilter($filter);
        $this->FromTo = '';
        $sql = $this->getproductssql();

        $result = $this->conn->query($sql);
        $page_count = $this->pagesnumber(mysqli_num_rows($result));
        if ($page > $page_count) {
            $page = $page_count;
        } else if ($page < 0) {
            $page = 0;
        }

        $this->FromTo = $this->get_paginagtion($page * $this->PerPage, $this->PerPage);
        $sql = $this->getproductssql();

        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $data = [];
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $thumbnail = $this->URL . 'platform/products/' . $row['productid'] . '/thumbnail_small.jpg';
                $slider = $this->GetScreenShots('product', $row['productid'], '');
                $price=$this->convertCurrency($row['Price']);
                $data[$i] = (array("id" => $row['productid'], "type" => 'toy', "thumbnail" => $thumbnail, "title_ar" => $row['title_ar'], "title_en" => $row['title_en'], "price" => $price, "isbn" => $row['ISBN'], "availible" => $this->convertnullto($row['status']), "count" => $this->convertnullto($row['count']), "description_en" => $row['description_en'], "description_ar" => $row['description_ar'], "slider" => $slider));
                $i++;
            }
            $result = $this->msg1($this->msg16_txt(), $data, $page_count);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }


    private function get_stories_keyword($keyword)
    {
        $this->keyword = '';
        if ($keyword != "") {
            $this->keyword = " AND (`story`.`title` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`description_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`description_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`author_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`author_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `story`.`isbn` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%')";
        }
        return $this->keyword;
    }

    private function get_stories_category($category)
    {
        $this->category = '';
        if ($category != 0) {
            $this->category = " AND `stories_cat`.catid in(" . $category . ")";
        }
        return $this->category;
    }

    private function get_story_Id($id)
    {
        $this->id = '';
        if ($id != '') {
            $this->id = " AND `story`.`storyid`=" . $id . "";
        }
        return $this->id;
    }

    private function get_stories_lang($lang)
    {
        $this->lang = '';
        if ($lang != '') {
            $this->lang = "AND `story`.`language`='" . $lang . "'";
        }
        return $this->lang;
    }

    private function get_stories_store($store)
    {
        $this->store = '';
        if ($store == 1) {
            $this->store = " AND `story`.`store`=1 AND `story`.`is_media`=0 ";
        } else if ($store == 0) {
            $this->store = " AND `story`.`store`=0  AND `story`.`type` in(1,3,5,7)";
        } else if ($store == 2) {
            $this->store = " AND (`story`.`store`=0  AND `story`.`type` in(1,3,5,7) or `story`.`store`=1 AND `story`.`is_media`=0 )";
        }

        return $this->store;
    }

    private function CreateTokenCode($userid)
    {
        $token = $this->getToken();
        $sql = "INSERT INTO `token`(`id`, `token`, `expiredate`, `userid`) VALUES (null,'" . $token . "',CURRENT_TIMESTAMP()," . $userid . ")";
        if ($this->conn->query($sql) === TRUE) {
        } else {
            $token = 'false';
        }
        return $token;
    }

    private function updateTokenCode($token)
    {

        $sql = "SELECT * FROM token WHERE  `token`='" . $token . "' ";
        $result = $this->conn->query($sql);
        $newtoken = 'false';
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $newtoken = $this->getToken();
            $sql2 = "UPDATE `token` SET `token`='" . $newtoken . "' WHERE `token`='" . $token . "' and  `userid`=" . $row['userid'];
            $result2 = $this->conn->query($sql2);
        }
        return $newtoken;
    }

    private function getstoriessql()
    {
        $sql = "SELECT (story.storyid)as id,story.seriesid,story.status,story.count,IF(story.storyid>0   ,'https://www.manhal.com/platform/stories/$$$/story/###/images/pic.jpg','')as thumbnail,`story`.`rating_count` as rate,story.title as title_ar,story.title as title_en,story.price,story.rate,story.view_count as view,`story`.description_ar,`story`.description_en,`story`.isbn   FROM `story` left OUTER JOIN `stories_cat` ON `story`.`catid`=`stories_cat`.`catid` left OUTER JOIN `series` on `story`.`seriesid`=`series`.`seriesid` WHERE `story`.`status`=1  AND ( `story`.`storyid`>0 " . $this->id . $this->lang . $this->store . $this->keyword . $this->Price . $this->category . " ) " . $this->orderby . $this->FromTo;
        return $sql;
    }

    private function StoriesFilter($filter)
    {
        switch ($filter) {
            case 'Recent':
                $this->OrderBy = " order by storyid DESC ";
                break;
            case 'Seller':
                $this->OrderBy = " Order By   story.sales_count Desc ";
                break;
            case 'Popular':
                $this->OrderBy = " Order By   view_count Desc  ";
                break;
            case 'TopRated':
                $this->OrderBy = " Order By   story.rate Desc ";
                break;
            case 'TopFavorite':
                $this->OrderBy = " Order By   story.favorite_count Desc   ";
                break;
            case 'bigger':
                $this->OrderBy = " Order By   story.price Desc   ";
                break;
            case 'smaller':
                $this->OrderBy = " Order By   story.price ASC   ";
                break;
            default:
                $this->OrderBy = '';
                break;
        }
        return $this->OrderBy;
    }

    public function getstories($keyword, $category, $lang, $Price, $id, $store, $page, $filter, $operation)
    {
        $this->keyword = $this->get_stories_keyword($keyword);
        $this->category = $this->get_stories_category($category);
        $this->lang = $this->get_stories_lang($lang);
        $this->store = $this->get_stories_store($store);
        $this->id = $this->get_story_Id($id);
        $this->Price = $this->get_story_price($operation, $Price);
        $this->orderby = $this->StoriesFilter($filter);
        $this->FromTo = '';
        $sql = $this->getstoriessql();
        $result = $this->conn->query($sql);
        $page_count = $this->pagesnumber(mysqli_num_rows($result));
        if ($page > $page_count) {
            $page = $page_count;
        } else if ($page < 0) {
            $page = 0;
        }

        $this->FromTo = $this->get_paginagtion($page * $this->PerPage, $this->PerPage);
        $sql = $this->getstoriessql($this->keyword, $this->store, $this->category, $this->lang, $this->id, $this->FromTo);
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $data = [];
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $thumbnail = str_replace("###", $row['id'], $row['thumbnail']);
                $thumbnail = str_replace("$$$", $row['seriesid'], $thumbnail);
                $slider = $this->GetScreenShots('story', $row['id'], $row['seriesid']);
                $price=$this->convertCurrency($row['price']);
                $data[$i] = (array("id" => $row['id'], "type" => 'story', "thumbnail" => $thumbnail, "title_ar" => $row['title_ar'], "title_en" => $row['title_en'], "price" =>$price, "isbn" => $row['isbn'], "availible" => $this->convertnullto($row['status']), "count" => $this->convertnullto($row['count']), "description_en" => $row['description_en'], "description_ar" => $row['description_ar'], "slider" => $slider));
                $i++;
            }
            $result = $this->msg1($this->msg16_txt(), $data, $page_count);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    private function gettokenfromhedar()
    {

        // $headers = apache_request_headers();
        //return explode('Basic ', $_SERVER['HTTP_X_API_KEY'])[1];
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
        $sql = "SELECT * FROM `token` WHERE  `token`='" . $token . "'";
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $result = $row;
        } else {
            $result = 'false';
        }
        return $result;
    }

    private function favorite($type)
    {
        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);

        if ($user != 'false') {
            $userid=$user['userid'];
            $cat_code = '';
            $filter = " WHERE `wishs`.`userid`=" . $userid;
            if ($type != "0") {
                $filter .= " AND `wishs`.`type` ='" . $type . "' ";
            } else {
                $filter .= " AND ( `wishs`.`type` ='book' or `wishs`.`type` ='story' or `wishs`.`type` ='product' )";
            }
            $sql = "SELECT `wishs`.wishid,
                               IF(`wishs`.`type`='book',`books`.`price`,IF(`wishs`.`type`='story',`story`.`price`,`products`.`Price`)) as `price`,
                               IF(`wishs`.`type`='book',`books`.`isbn`,IF(`wishs`.`type`='story',`story`.`isbn`,`products`.`ISBN`)) as `isbn`,
                                IF(`wishs`.`type`='book',`books`.`bookid`,IF(`wishs`.`type`='story',`story`.`storyid`,`products`.`productid`)) as `id`,
                                IF(`wishs`.`type`='book',`books`.`name`,IF(`wishs`.`type`='story',`story`.`title`,`products`.`name_ar`)) as `title_ar`,
                                IF(`wishs`.`type`='book',`books`.`name`,IF(`wishs`.`type`='story',`story`.`title`,`products`.`name_en`)) as `title_en`,
                                IF(`wishs`.`type`='book',IF(status=1,'https://www.manhal.com/platform/books/###/cover.jpg',''),IF(`wishs`.`type`='story',IF(story.storyid>0   ,'https://www.manhal.com/platform/stories/$$$/story/###/images/pic.jpg',''),IF(products.productid>0   ,'https://www.manhal.com/platform/products/###/thumbnail_small.jpg',''))) as `thumbnail`,
                               `story`.`seriesid`,`wishs`.`type` as item_type FROM `wishs` LEFT OUTER JOIN `books` ON `wishs`.`bookid`=`books`.`bookid` LEFT OUTER JOIN `story` ON `wishs`.`bookid`=`story`.`storyid` LEFT OUTER JOIN `products` ON `wishs`.`bookid`=`products`.`productid` " . $filter;

            return $sql;
        } else {
            return 'false';
        }


    }

    public function Myorders()
    {
        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);

        if ($user != 'false') {
            $userid=$user['userid'];
            $sql = "SELECT * FROM `payments` WHERE `userid`=" . $userid;
            $result = $this->conn->query($sql);
            if (mysqli_num_rows($result) > 0) {
                $data = [];
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $data[$i] = array("paymentid" => $row['paymentid'], "payment_date" => $row['payment_date'], "payment_type" => $row['payment_type'], "shipping" => $row['shipping'], "RecieverCompanyName" => $row['RecieverCompanyName'], "status" => $row['status'], "Order processing" => $row['store_close_user'], "Order processing date" => $row['store_close_date'], "Delivery of the order" => $row['shipping_close_user'], "Delivery of the order date" => $row['shipping_close_date'], "total_price" => $row['total_price']);
                    $i++;
                }
                $result = $this->msg1($this->msg16_txt(), $data, $i);
            } else {
                $result = $this->msg2($this->msg2_txt());
            }
        } else {
            $result = $this->msg2($this->msg15_txt());
        }
    }

    public function GETWishs($type)
    {
        $this->FromTo = '';
        $sql = $this->favorite($type);

        $result = $this->conn->query($sql);
        $page_count = $this->pagesnumber(mysqli_num_rows($result));
        if ($page > $page_count) {
            $page = $page_count;
        } else if ($page < 0) {
            $page = 0;
        }

        $this->FromTo = $this->get_paginagtion($page * $this->PerPage, $this->PerPage);
        $sql = $this->favorite($type);
        $result = $this->conn->query($sql);
        if ($sql != 'false') {
            $result = $this->conn->query($sql);
            if (mysqli_num_rows($result) > 0) {

                $data = [];
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {

                    $thumbnail = str_replace("###", $row['id'], $row['thumbnail']);
                    $thumbnail = str_replace("$$$", $row['seriesid'], $thumbnail);

                    $data[$i] = (array("id" => $row['id'], "type" => $row['item_type'], "thumbnail" => $thumbnail, "title_ar" => $row['title_ar'], "title_en" => $row['title_en'], "price" => $row['price'], "isbn" => $row['isbn'], "seriesid" => $row['seriesid']));
                    $i++;
                }
                $result = $this->msg1($this->msg16_txt(), $data, $page_count);

            } else {
                $result = $this->msg2($this->msg2_txt());
            }
        } else {
            $result = $this->msg2($this->msg2_txt());
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
        } else if ($fileSize > 5242880) { // if file size is larger than 5 Megabytes
            $masge = "ERROR: Your file was larger than 5 Megabytes in size.";
            unlink($fileTmpLoc); // Remove the uploaded file from the PHP temp folder
        } else if (!preg_match("/.(gif|jpg|png)$/i", $fileName)) {
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
            return array('file' => $fileName, 'masge' => $masge);
        }
        return array('file' => $fileName, 'masge' => $masge);
    }

    public function GetNotification($id)
    {
        if ($id == 0) {
            $filter = '>0';
        } else {
            $filter = '=' . $id;
        }
        $chek = "SELECT * FROM `notification` WHERE `id`" . $filter;
        $result = $this->conn->query($chek);
        if (mysqli_num_rows($result) > 0) {
            $data = [];
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $files = explode('../../', $row['image'])[1];
                $data[$i] = array("id" => $row['id'], "type" => $row['type'], "title" => $row['title'], "text" => $row['text'], "image" => $this->URL . $files);
                $i++;
            }
            $result = $this->msg1($this->msg16_txt(), $data, $i);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
    }

    public function NotificationEdit($image, $title, $text, $type)
    {
        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);
        if ($user != 'false') {
            $userid=$user['userid'];
            $newFileName = "../../notification/" . $this->getToken();
            $masge = $this->UploadImage('image', $newFileName);
            // echo $masge['masge'];
            if ($masge['masge'] == '') {
                $sql = "INSERT INTO `notification`(`id`, `type`, `title`, `text`, `image`) VALUES (null," . $type . ",'" . mysqli_real_escape_string($this->conn, $title) . "','" . mysqli_real_escape_string($this->conn, $text) . "','" . $newFileName . "')";
                if ($this->conn->query($sql) === TRUE) {
                    $id = $last_id = $this->conn->insert_id;
                    $files = explode('../../', $masge['file']);
                    $data = array("id" => $id, "image" => $this->URL . $files[1], "type" => $type, "title" => $title, "text" => $text);
                    $result = $this->msg1($this->msg16_txt(), $data, 0);
                } else {
                    $result = $this->msg2($this->msg3_txt());
                }
            }
        } else {
            $result = $this->msg2($this->msg15_txt());
        }
        return $result;
    }

    public function updateAvatar($avatar)
    {
        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);
        if ($user != 'false') {
            $userid=$user['userid'];
            $newFileName = "../../users/images/" . $this->getToken();
            $masge = $this->UploadImage('avatar', $newFileName);
            if ($masge['masge'] == '') {
                $chek = "Select  * From `users` WHERE `userid`=" . $userid;
                $result = $this->conn->query($chek);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    unlink($row['avatar']); // Remove the uploaded file from the PHP temp folder
                    $sql = "UPDATE `users` SET `avatar`='" . $masge['file'] . "' WHERE `userid`=" . $userid;
                    $this->conn->query($sql);
                    $files = explode('../../', $masge['file']);
                    $data = array("avatar" => $this->URL . $files[1]);
                    $result = $this->msg1($this->msg16_txt(), $data, 0);
                } else {
                    $result = $this->msg2($this->msg17_txt);
                }
            } else {
                $result = $this->msg2($masge['masge']);
            }
        } else {
            $result = $this->msg2($this->msg15_txt());
        }
        return $result;
    }


    public function updateCount($count, $id, $type)
    {

        switch ($type) {
            case 'books':
                $chek = "Select  * From `books` WHERE `bookid`=" . $id;
                $sql = "UPDATE `books` SET `count`=" . $count . " WHERE `bookid`=" . $id;
                break;
            case 'stories':
                $chek = "Select  * From `story` WHERE `storyid`=" . $id;
                $sql = "UPDATE `story` SET `count`=" . $count . " WHERE `storyid`=" . $id;
                break;
            case 'products':
                $chek = "Select  * From `products` WHERE `productid`=" . $id;
                $sql = "UPDATE `products` SET `count`=" . $count . " WHERE `productid`=" . $id;
                break;
            default:
                return $this->msg2($this->msg17_txt());
                break;
        }

        $result = $this->conn->query($chek);

        if (mysqli_num_rows($result) > 0) {
            $this->conn->query($sql);
            $result = $this->msg1($this->msg16_txt(), $this->json(), 0);
        } else {
            $result = $this->msg2($this->msg17_txt());
        }

        return $result;
    }

    public function Wishs($id, $type)
    {
        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);
        if ($user != 'false') {
            $userid=$user['userid'];
            $sql = "Select  * From   wishs where wishs.userid='" . $userid . "' and wishs.bookid=" . $id . " and wishs.type='" . $type . "' ";
            $result = $this->conn->query($sql);
            if (mysqli_num_rows($result) > 0) {
                $delete = "DELETE FROM `wishs` WHERE `userid`='" . $userid . "' and `bookid`=" . $id . " and type='" . $type . "' ";
                if ($this->conn->query($delete) === TRUE) {
                    $result = $this->msg1($this->msg16_txt(), $this->json(), 0);
                } else {
                    $result = $this->msg2($this->msg2_txt());
                }
            } else {
                $date = date("Y/m/d H:i:s", time());
                $insert = "INSERT INTO `wishs`(`wishid`, `userid`, `bookid`, `wish_date`, `type`) VALUES (null,'" . $userid . "'," . $id . ",'" . $date . "','" . $type . "' )";
                if ($this->conn->query($insert) === TRUE) {
                    $result = $this->msg1($this->msg16_txt(), $this->json(), 0);
                } else {
                    $result = $this->msg2($this->msg15_txt());
                }
            }
        } else {
            $result = $this->msg2($this->msg15_txt());
        }
        return $result;
    }

    private function checkLocation($userid, $lat, $long)
    {
        $sql = "SELECT * FROM `location` WHERE `userid`='" . $userid . "' AND `lat`='" . $lat . "' AND `long`='" . $long . "'";
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            return 'true';
        } else {
            return 'false';
        }
    }


    private function GetlocationID($id)
    {
        $sql = "SELECT * FROM `location` WHERE `id`=" . $id;
        $result = $this->conn->query($sql);
        $data = 'false';
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $data = array("id" => $row['id'], "lat" => $row['lat'], "long" => $row['long'], "address" => $row['address'], "mob" => $row['mob'], "name" => $row['name'], "building" => $row['building'], "apr" => $row['apr'], "floor" => $row['floor'], "region" => $row['region'], "isdefault" => $row['isdefault']);
        }
        return $data;
    }

    public function DeletSlider($id)
    {
        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);
        if ($user != 'false') {
            if($this->CanYouEdit($user['permession'])=='true'){
                $chek = "SELECT * FROM `storeslider` WHERE `id`=" . $id;
                $result = $this->conn->query($chek);
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    unlink('../../'.$row['url']); // Remove the uploaded file from the PHP temp folder
                    $sql = "DELETE FROM `storeslider` WHERE `id`=" . $id;
                    $this->conn->query($sql);
                    $result = $this->msg1($this->msg16_txt(), $this->json(), 0);
                } else {
                    $result = $this->msg2($this->msg17_txt);
                }
            }else{
                $result = $this->msg2($this->msg17_txt());
            }

        }
        return $result;
    }
    private  function CanYouEdit($parmation){
        $result='false';
        if($parmation==1 || $parmation==2 || $parmation=6){
            $result='true';
        }
        return $result;
    }
    public function UpdateSlider($id,$action)
    {
        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);

        if ($user != 'false') {

            if($this->CanYouEdit($user['permession'])=='true'){
                $newFileName = "../../images/store/slider/" . $id;
                $masge = $this->UploadImage('slider', $newFileName);
                if ($masge['masge'] == '') {

                    $chek = "SELECT * FROM `storeslider` WHERE `id`=" . $id;
                    $result = $this->conn->query($chek);
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        unlink('../../'.$row['url']); // Remove the uploaded file from the PHP temp folder
                        $files = explode('../../', $masge['file']);
                        $data = array("slider" => $this->URL . $files[1]);
                        $sql = "UPDATE `storeslider` SET `url`='" . $files[1] . "',`action`='".$action."' WHERE `id`=" . $id;
                        $this->conn->query($sql);

                        $result = $this->msg1($this->msg16_txt(), $data, 0);
                    } else {
                        $result = $this->msg2($this->msg17_txt);
                    }



                }

            }else{
                $result = $this->msg2($this->msg17_txt());
            }

        }
        return $result;

    }

    private function GetLastId($tablename){
        $result='';
        $chek = "SELECT MAX(id) as id FROM ".$tablename ;
        $result = $this->conn->query($chek);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $result =$row['id'];
        }
        return $result;
    }
    public function InsertSlider($action)
    {
        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);
        if ($user != 'false') {
            if($this->CanYouEdit($user['permession'])=='true'){
                $id=$this->GetLastId('`storeslider`');
                $newId=$id+1;
                $newFileName = "../../images/store/slider/" . $newId;
                $masge = $this->UploadImage('slider', $newFileName);
                if ($masge['masge'] == '') {
                    $files = explode('../../', $masge['file']);
                    $data = array("slider" => $this->URL . $files[1]);
                    $sql = "INSERT INTO `storeslider`(`id`, `url`, `action`) VALUES (null,'".$files[1]."','".$action."')";
                    $this->conn->query($sql);
                    $result = $this->msg1($this->msg16_txt(), $this->json(), 0);
                } else {
                    $result = $this->msg2($this->msg17_txt);
                }
            }
        }else{
            $result = $this->msg2($this->msg17_txt());
        }


        return $result;

    }
    private function mysqlinformationorder($id)
    {
        $sql =
            "SELECT `payments_books`.`bookid`,`payments_books`.`quantity`,`payments_books`.`book_price`,`payments_books`.`itemtype` ,`story`.`seriesid`,
 IF(`payments_books`.`itemtype`='book',`books`.`isbn`, IF(`payments_books`.`itemtype`='story',`story`.`isbn`,`products`.`ISBN`)) as `isbn`,
 IF(`payments_books`.`itemtype`='book',`books`.`name`,IF(`payments_books`.`itemtype`='story',`story`.`title`,`products`.`name_ar`)) as `name`,
 IF(`payments_books`.`itemtype`='book',IF(`books`.status=1,'https://www.manhal.com/platform/books/###/cover.jpg',''),IF(`payments_books`.`itemtype`='story',IF(`story`.storyid>0   ,'https://www.manhal.com/platform/stories/$$$/story/###/images/pic.jpg',''),IF(`products`.productid>0   ,'https://www.manhal.com/platform/products/###/thumbnail_small.jpg',''))) as `thumbnail`
                               FROM `payments_books` LEFT OUTER JOIN `books` ON `payments_books`.`bookid`=`books`.`bookid` AND `payments_books`.`itemtype`='book'
                                  LEFT OUTER JOIN `story` ON `payments_books`.`bookid`=`story`.`storyid` AND `payments_books`.`itemtype`='story'
                                  LEFT OUTER JOIN `products` ON `payments_books`.`bookid`=`products`.`productid` AND `payments_books`.`itemtype`='toy'
                                 where payments_books.paymentid=". $id." and ( payments_books.`type`=1 or payments_books.`type`=3 or payments_books.`type`=5 or payments_books.`type`=7 )"  ;
        $result = $this->conn->query($sql);
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $thumbnail = str_replace("###", $row['bookid'], $row['thumbnail']);
                $thumbnail = str_replace("$$$", $row['seriesid'], $thumbnail);
                $data[$i] = array("id" => $row['bookid'],"name" => $row['name'],"thumbnail" => $thumbnail, "quantity" => $row['quantity'], "price" => $row['book_price'], "type" => $row['itemtype'], "isbn" => $row['isbn']);
                $i++;
            }


        }
        return $data;
    }

    private function get_Activities_keyword($keyword){
        $this->keyword = '';
        if ($keyword != "") {
            $this->keyword =  " AND ( `title_ar` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `title_en` LIKE '%" . mysqli_real_escape_string($this->conn, $keyword) . "%' OR `description_ar` LIKE '%" . mysqli_real_escape_string($this->conn,$keyword) . "%' OR `description_en` LIKE '%" . mysqli_real_escape_string($this->conn,$keyword) . "%'  )";;
        }
        return $this->keyword;
    }
    private function get_Activities_category($category){
        $this->category = '';
        if ($category != "") {
            $this->category =  " AND `category` = " . $category;
        }
        return $this->category;
    }

    private function get_Activities_lang($lang){
        $this->lang = '';
        if($lang=='0' || $lang=='ar'|| $lang=='AR' ){
            $lang='Ar';
        }else if($lang=='1' || $lang=='en'|| $lang=='En'){
            $lang='En';
        }else if($lang=='2' || $lang=='fr'|| $lang=='FR'){
            $lang='Fr';
        }
        if ($lang != "") {
            $this->lang =  " `media`.`language`=" . $lang;
        }
        return $this->lang;
    }
    private function get_Activities_age($age){
        $this->age = '';
        if ($age != "") {
            $this->age =  "  AND `media`.`age`= " . $age;
        }
        return $this->age;
    }
    private function get_Activities_grade($grade){
        $this->grade = '';
        if ($grade != "") {
            $this->grade =  "  AND `media`.`grade`= " . $grade;
        }
        return $this->grade;
    }

    private function get_Activities_type($type){
        $this->type = '';
        if ($type != "") {
            $this->type =  "  AND `media`.`type`= " . $type;
        }
        return $this->type;
    }
    private function get_Activities_Id($id){
        $this->id = '';
        if ($id != "") {
            $this->id =  "  AND `media`.`id`= " . $id;
        }
        return $this->id;
    }
    private function getActivitiesssql(){

        $sql = "Select media.*,categories.name_ar, categories.name_en From media Inner Join categories On media.category = categories.catid Where media.status = 1 And media.id > 0 And (media.type=11 OR media.type=12) " . $this->keyword . $this->category . $this->lang . $this->age . $this->grade .$this->type.$this->id. "  ORDER BY `media`.`price` ASC,  `media`.`id` DESC ,`media`.`is_playlist` DESC". $this->FromTo;;
        return $sql;
    }
    private function convertage($age){

            $resualt='';
        switch ($age){
            case  '-1':
                $resualt='All';
                break;
            case '1':
                $resualt='4-5';
                break;
                case '2':
                $resualt='6-8';
                break;
                case '3':
                $resualt='9-11';
                break;
                case '4':
                $resualt='12-15';
                break;
                case '5':
                $resualt='+22';
                break;
        }
        return $resualt;
    }
    private function convertgrade($grade){

            $resualt='';

        switch ($grade){
            case  '-1':
                $resualt='All';
                break;
            case '20':
                $resualt='Pre-K';
                break;
                case '0':
                $resualt='Kindergarten';
                break;
            default :
                $resualt=$grade;
                break;
        }
        return $resualt;
    }
    public function Activities($id,$keyword, $category, $lang, $grade,$age,$type,$page)
    {

        $this->keyword = $this->get_Activities_keyword($keyword);
        $this->category = $this->get_Activities_category($category);
        $this->lang = $this->get_Activities_lang($lang);
        $this->age = $this->get_Activities_age($age);
        $this->grade = $this->get_Activities_grade($grade);
        $this->type = $this->get_Activities_type($type);
        $this->id = $this->get_Activities_Id($id);


        $this->FromTo = '';
        $sql = $this->getActivitiesssql();

        $result = $this->conn->query($sql);
        $page_count = $this->pagesnumber(mysqli_num_rows($result));
        if ($page > $page_count) {
            $page = $page_count;
        } else if ($page < 0) {
            $page = 0;
        }

        $this->FromTo = $this->get_paginagtion($page * $this->PerPage, $this->PerPage);
        $sql = $this->getActivitiesssql();

        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $data = [];
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $thumbnail = $this->URL . 'platform/media/' . $row['id'] . '/thumbnail_small.jpg';
               $ImageLarge=$this->URL . 'platform/media/' . $row['id'] . '/thumbnail.jpg';

                if($row["path"] == "") {
                    $activity = "" . $this->URL . 'platform/media/' . $row['id'] . '/' . $row['filename'] . ".html";
                } else {
                    $activity = "" . SITE_URL .  $row["path"];
                }

               $Age=$this->convertage($row['age']);
               $grade=$this->convertgrade($row['grade']);
                $data[$i] = (array("id" => $row['id'], "type" => $row['type'], "activity" => $activity, "thumbnail" => $thumbnail, "ImageLarge" => $ImageLarge, "title_ar" => $row['title_ar'], "title_en" => $row['title_en'],   "description_en" => $row['description_en'], "description_ar" => $row['description_ar'], "age" => $Age, "grade" => $grade, "category_ar" =>$row['name_ar'], "category_en" =>$row['name_en'] ));
                $i++;
            }
            $result = $this->msg1($this->msg16_txt(), $data, $page_count);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;



    }
    public function GetOrder()
    {
        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);

        if ($user != 'false') {
            $userid=$user['userid'];
            $sql = "SELECT * FROM `payments` WHERE  `userid`=" . $userid;
            $result = $this->conn->query($sql);
            if (mysqli_num_rows($result) > 0) {
                $data = [];
                $i = 0;
                while ($row = mysqli_fetch_assoc($result)) {
                    $list=$this->mysqlinformationorder($row['paymentid']);
                    $data[$i] = array("id" => $row['paymentid'], "total_price" => $row['total_price'], "payment_date" => $row['payment_date'], "status" => $row['status'], "store" => $row['store_close_user'],"information"=>$row['Address1'],"ref"=>$row['manhal_ref'],"list"=>$list);
                    $i++;
                }
                $result = $this->msg1($this->msg16_txt(), $data, $i);

            } else {
                $result = $this->msg2($this->msg2_txt());
            }
        } else {
            $result = $this->msg2($this->msg15_txt());
        }
        return $result;
    }

    private function mysqlrelatedbook($id,$LIMIT,$store,$keyword){
        $this->store = $this->get_books_store($store);

        $seacrch1=str_replace("  "," ",$keyword);
        $tags = explode(' ',$seacrch1);
        $seacrch='';
        for($i=0;$i<count($tags);$i++ ) {

            if($tags[$i]!=''){
                $seacrch.=' books.name LIKE  "%'.$tags[$i].' '.$tags[$i+1].'%" ';
                if($i<count($tags)-1){
                    $seacrch.=' OR';
                }
            }

        }


        $books = "books.grade AS grade,If(SubQuery.status = 1, 'https://www.manhal.com/platform/books/###/cover.jpg', '') AS thumbnail,SubQuery.bookid As id,SubQuery.name AS title_ar,SubQuery.name AS title_en,SubQuery.price,SubQuery.rating_count AS rate,SubQuery.views,SubQuery.description_ar,SubQuery.description_en,SubQuery.isbn,SubQuery.status,SubQuery.category,SubQuery.count,SubQuery.grade" ;
        $sql2="SELECT  ".$books." FROM  books,(SELECT   books.name, books.bookid, books.description_ar, books.description_en, books.category, books.grade, books.status, books.price, books.isbn, books.rating_count, `books`.count, books.views FROM books WHERE   ".$seacrch." and  books.bookid <> ".$id." AND  books.status = 1 ".$this->store.") AS SubQuery WHERE  books.bookid = ".$id." ORDER BY  SubQuery.category,SubQuery.grade ASC LIMIT ".$LIMIT;

        $sql=str_replace("OR and","and",$sql2);


        $result = $this->conn->query($sql);
        $data = [];
        if (mysqli_num_rows($result) > 0) {
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $slider = $this->GetScreenShots('book', $row['id'], '');
                $thumbnail ='https://www.manhal.com/platform/books/'.$row['id'].'/cover.jpg';
                $data[$i] = (array("id" => $row['id'], "type" => 'book', "thumbnail" => $thumbnail, "title_ar" => $row['title_ar'], "title_en" => $row['title_en'], "price" => $row['price'], "isbn" => $row['isbn'], "availible" => $this->convertnullto($row['status']), "count" => $this->convertnullto($row['count']), "description_en" => $row['description_en'], "description_ar" => $row['description_ar'], "slider" => $slider));
                $i++;
            }
            $result = $this->msg1($this->msg16_txt(), $data, $i);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }
    private function mysqlrelatedstory($id,$LIMIT,$store,$keyword){

        $seacrch1=str_replace("  "," ",$keyword);
        $tags = explode(' ',$seacrch1);
        $seacrch='';

        for($i=0;$i<count($tags);$i++ ) {
            if($tags[$i]!=''){
                $seacrch.=' story.title LIKE  "%'.$tags[$i].'%" ';
                if($i<count($tags)-1){
                    $seacrch.=' OR';
                }
            }
        }
        $this->store = $this->get_stories_store($store);
        $story = "SubQuery.title_en,SubQuery.title_ar,SubQuery.catid,SubQuery.storyid as id,SubQuery.seriesid,SubQuery.description_ar,SubQuery.status,SubQuery.count,SubQuery.store,SubQuery.description_en,SubQuery.rating_count,SubQuery.`language`,SubQuery.price,SubQuery.rate,If(SubQuery.storyid > 0, 'https://www.manhal.com/platform/stories/$$$/story/###/images/pic.jpg','') AS thumbnail,SubQuery.view_count,SubQuery.isbn,SubQuery.catid";
        $sql2="SELECT  ".$story." FROM  story  LEFT JOIN (SELECT story.title AS title_ar,story.title AS title_en,story.author_ar,story.author_en,story.description_ar,story.view_count,story.isbn,story.price,story.path,story.rate,story.sales_count,story.thumb,story.type,story.status,story.description_en,story.rating_count,story.language,story.store,story.count,story.seriesid, story.catid, story.storyid, story.age  FROM story  WHERE  ((story.seriesid = story.seriesid AND story.catid = story.catid AND        story.age = story.age) OR (story.seriesid = story.seriesid AND  story.catid = story.catid) OR   (story.seriesid = story.seriesid) OR (story.catid = story.catid) OR (".$seacrch.")) AND story.storyid <>".$id." AND  story.status = 1 And `story`.`storyid`>0 ".$this->store."   ORDER BY   story.seriesid, story.catid,story.storyid) AS SubQuery ON story.catid = SubQuery.catid AND story.seriesid = SubQuery.seriesid WHERE  story.storyid = ".$id."  LIMIT ".$LIMIT;
        $sql=str_replace("OR and","and",$sql2);
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $data = [];
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $thumbnail = str_replace("###", $row['id'], $row['thumbnail']);
                $thumbnail = str_replace("$$$", $row['seriesid'], $thumbnail);
                $slider = $this->GetScreenShots('story', $row['id'], $row['seriesid']);
                $data[$i] = (array("id" => $row['id'], "type" => 'story', "thumbnail" => $thumbnail, "title_ar" => $row['title_ar'], "title_en" => $row['title_en'], "price" => $row['price'], "isbn" => $row['isbn'], "availible" => $this->convertnullto($row['status']), "count" => $this->convertnullto($row['count']), "description_en" => $row['description_en'], "description_ar" => $row['description_ar'], "slider" => $slider));
                $i++;
            }
            $result = $this->msg1($this->msg16_txt(), $data, $i);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }
    private function mysqlrelatedtoy($id,$LIMIT){
        $sql = "SELECT SubQuery.productid, SubQuery.name_ar as title_ar , SubQuery.name_en as title_en, SubQuery.ISBN, SubQuery.thumbnail, SubQuery.count, SubQuery.Width, SubQuery.Height, SubQuery.Weight, SubQuery.Price, SubQuery.brand, SubQuery.description_en, SubQuery.description_ar, SubQuery.status, SubQuery.department, SubQuery.age, SubQuery.view_count, SubQuery.favorite_count, SubQuery.sales_count,SubQuery.name_ar1 as brand_ar,SubQuery.name_en1 as brand_en,SubQuery.name_ar2 as department_ar,SubQuery.name_en2 as department_en,SubQuery.status FROM products,(SELECT products.productid, products.name_ar, products.name_en, products.ISBN, products.thumbnail, products.count, products.Width, products.Height, products.Weight, products.Price, products.brand, products.description_en, products.description_ar, products.status, products.department, products.age, products.view_count, products.favorite_count, products.sales_count, brand.name_ar AS name_ar1,brand.name_en AS name_en1,departments.name_ar AS name_ar2,departments.name_en AS name_en2 FROM products LEFT JOIN brand ON products.brand = brand.catid LEFT JOIN departments ON products.department = departments.catid WHERE products.status=1  AND (((products.brand = products.brand AND products.department = products.department AND products.age = products.age) OR    products.age = products.age) OR (products.brand = products.brand AND products.age = products.age) OR      (products.department = products.department AND(products.age = products.age))  AND products.productid <> ".$id."  )) AS SubQuery WHERE `products`.`status` =1 and  products.productid = ".$id." ORDER BY  SubQuery.brand,  SubQuery.department,  SubQuery.age LIMIT ".$LIMIT;


        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $data = [];
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $thumbnail = $this->URL . 'platform/products/' . $row['productid'] . '/thumbnail_small.jpg';
                $slider = $this->GetScreenShots('product', $row['productid'], '');

                $data[$i] = (array("id" => $row['productid'], "type" => 'toy', "thumbnail" => $thumbnail, "title_ar" => $row['title_ar'], "title_en" => $row['title_en'], "price" => $row['Price'], "isbn" => $row['ISBN'], "availible" => $this->convertnullto($row['status']), "count" => $this->convertnullto($row['count']), "description_en" => $row['description_en'], "description_ar" => $row['description_ar'], "slider" => $slider));
                $i++;
            }
            $result = $this->msg1($this->msg16_txt(), $data, $i);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function GetRelatedID($id,$type,$LIMIT,$store,$keyword)
    {
        switch ($type) {
            case "book":
                $result=$this->mysqlrelatedbook($id,$LIMIT,$store,$keyword);
                break;
            case "story":
                $result=$this->mysqlrelatedstory($id,$LIMIT,$store,$keyword);
                break;
            case "toy":
                $result=$this->mysqlrelatedtoy($id,$LIMIT,$keyword);
                break;
        }
        return $result;
    }
    public function Getlocation()
    {


        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);

        if ($user != 'false') {
            $userid=$user['userid'];
            $sql = "SELECT * FROM `location` WHERE `userid`=" . $userid;
            $result = $this->conn->query($sql);
            if (mysqli_num_rows($result) > 0) {


                $data = [];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data[$i] = array("id" => $row['id'], "lat" => $row['lat'], "long" => $row['long'], "address" => $row['address'], "mob" => $row['mob'], "name" => $row['name'], "building" => $row['building'], "apr" => $row['apr'], "floor" => $row['floor'], "region" => $row['region'], "isdefault" => $row['isdefault']);
                    $i++;
                }
                $result = $this->msg1($this->msg16_txt(), $data, $i);

            } else {
                $result = $this->msg2($this->msg2_txt());
            }
        } else {
            $result = $this->msg2($this->msg15_txt());
        }
        return $result;

    }

    private function SetDefaultLocation($userid, $last_id)
    {
        $sql = "UPDATE `location` SET `isdefault`=0 WHERE `userid`=" . $userid . " and id !=" . $last_id;
        $this->conn->query($sql);
    }

    public function UpdateLocation($id, $lat, $long, $address, $mob, $name, $building, $apr, $floor, $region, $isdefault)
    {

        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);

        if ($user != 'false') {
            $userid=$user['userid'];
            $sql = "UPDATE `location` SET `address`='" . mysqli_real_escape_string($this->conn, $address) . "',`mob`='" . mysqli_real_escape_string($this->conn, $mob) . "',`name`='" . mysqli_real_escape_string($this->conn, $name) . "',`cdate`=CURRENT_TIMESTAMP(),`building`='" . mysqli_real_escape_string($this->conn, $building) . "',`apr`='" . mysqli_real_escape_string($this->conn, $apr) . "',`floor`='" . mysqli_real_escape_string($this->conn, $floor) . "',`region`='" . mysqli_real_escape_string($this->conn, $region) . "',`isdefault`=" . $isdefault . " WHERE `userid`= " . $userid . " and `id`=" . $id;
            $this->conn->query($sql);
            $result = $this->msg1($this->msg13_txt(), $this->json(), 0);
        } else {
            $result = $this->msg2($this->msg15_txt());
        }
        return $result;

    }

    public function RemoveLocation($idlocation)
    {

        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);

        if ($user != 'false') {
            $userid=$user['userid'];
            $sql = "DELETE FROM `location`  WHERE `id`=" . $idlocation . " and `userid`= " . $userid;
            $this->conn->query($sql);
            $result = $this->msg1($this->msg14_txt(), $this->json(), 0);
        } else {
            $result = $this->msg2($this->msg15_txt());
        }
        return $result;

    }

    public function SaveFirebaseKey($key)
    {

        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);

        if ($user != 'false') {
            $userid=$user['userid'];
            $sql = "UPDATE `users` SET `firebase`='" . mysqli_real_escape_string($this->conn, $key) . "' WHERE  `userid`= " . $userid;
            $this->conn->query($sql);
            $result = $this->msg1($this->msg13_txt(), $this->json(), 0);
        } else {
            $result = $this->msg2($this->msg15_txt());
        }
        return $result;

    }


    private function GetScreenShots($type = '', $id = '', $series = '')
    {
        $images = [];
        switch ($type) {
            case 'book':
                $path = "platform/books/" . $id . "/screenshoots/";
                break;
            case 'story':
                $path = "platform/stories/" . $series . "/story/" . $id . "/images/screenshoots/";
                break;

                break;
            default:
                return $images;
        }
        if (is_dir('../../' . $path)) {
            $files = scandir('../../' . $path);
            foreach ($files as $file) {
                if ($file != "." && $file != "..") {
                    if (preg_match("/.(gif|jpg|png|svg|bmp|jpeg)$/i", $file)) {
                        array_push($images, SITE_URL . $path . $file);
                    }
                }
            }
        }
        return $images;
    }


    public function SetLocation($lat, $long, $address, $mob, $name, $building, $apr, $floor, $region, $isdefault)
    {

        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);

        if ($user != 'false') {
            $userid=$user['userid'];
            if ($this->checkLocation($userid, $lat, $long) == 'false') {

                $sql = "INSERT INTO `location`(`id`, `userid`, `lat`, `long`, `address`, `mob`, `name`, `cdate`, `building`, `apr`, `floor`, `region`, `isdefault`)  VALUES (null,'" . $userid . "','" . mysqli_real_escape_string($this->conn, $lat) . "','" . mysqli_real_escape_string($this->conn, $long) . "','" . mysqli_real_escape_string($this->conn, $address) . "','" . mysqli_real_escape_string($this->conn, $mob) . "','" . mysqli_real_escape_string($this->conn, $name) . "',CURRENT_TIMESTAMP(),'" . mysqli_real_escape_string($this->conn, $building) . "','" . mysqli_real_escape_string($this->conn, $apr) . "','" . mysqli_real_escape_string($this->conn, $floor) . "','" . mysqli_real_escape_string($this->conn, $region) . "','" . $isdefault . "')";
                if ($this->conn->query($sql) === TRUE) {
                    $last_id = $this->conn->insert_id;
                    if ($isdefault == 1) {
                        $this->SetDefaultLocation($userid, $last_id);
                    }
                    $result = $this->msg1($this->msg13_txt(), $this->json(), 0);
                } else {
                    $result = $this->msg2($this->msg2_txt());
                }
            } else {
                $result = $this->msg2($this->msg12_txt());
            }
        } else {
            $result = $this->msg2($this->msg15_txt());
        }
        return $result;

    }

    public function EditProfile($name, $birthday, $gender)
    {
        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);

        if ($user != 'false') {
            $userid=$user['userid'];
            $sql = "UPDATE `users` SET `fullname`='" . $name . "',`birthdate`='" . $birthday . "',`gender`='" . $gender . "'  WHERE `userid`=" . $userid;
            $this->conn->query($sql);
            $data = array("fullname" => $name, "birthdate" => $birthday, "gender" => $gender);
            $result = $this->msg1($this->msg16_txt(), $data, 0);
        } else {
            $result = $this->msg2($this->msg15_txt());
        }
        return $result;

    }

    private function checktokenuser($tokens)
    {
        $sql = "SELECT * FROM `token` WHERE  `token`='" . $tokens . "'";
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
        } else {
            $row = 'false';
        }
        return $row;
    }

    private function checkexpiredate($timestamp)
    {
        $startdate = $timestamp;
        $expire = strtotime($startdate . ' + ' . $this->Expires . ' days');
        $today = strtotime("now");
        if ($today >= $expire) {
            $data = "expired";
        } else {
            $data = "active";
        }
        return $data;

    }

    public function refreshToken($email)
    {
        $token = $this->gettokenfromhedar();
        $sql = "SELECT * FROM users WHERE email='" . $email . "'  AND status=1 ";
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $newtoken = $this->getToken();
            $data = $this->checktokenuser($token);
            if ($data != 'false') {
                $expiredate = $this->checkexpiredate($data['expiredate']);
                if ($expiredate == "active") {
                    $data = array("email" => $email, "token" => $data['token']);
                    $result = $this->msg1($this->msg16_txt(), $data, 0);
                } else if ($expiredate == "expired") {
                    $updatesql = "UPDATE `token` SET `token`='" . $newtoken . "' WHERE `token`='" . $token . "' and `userid`=" . $row['userid'];
                    $result = $this->conn->query($updatesql);
                    $row = mysqli_fetch_assoc($result);
                    if ($this->checktokenuser($newtoken) != 'false') {
                        $data = array("email" => $email, "token" => $newtoken);
                        $result = $this->msg1($this->msg16_txt(), $data, 0);
                    } else {
                        $result = $this->msg2($this->msg2_txt());
                    }
                }
            }
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function CheckTokenCodePassword($email)
    {
        $token = $this->gettokenfromhedar();
        $sql = "SELECT * FROM users WHERE email='" . $email . "' AND token='" . $token . "' AND status=1 AND (`social` is Null or `social`='')";

        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $data = array("email" => $row['email'], "uname" => $row['uname']);
            $result = $this->msg1($this->msg16_txt(), $this->json(), 0);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function ForgotPassword($email, $lang = 'En')
    {
        $sql = "SELECT * FROM users WHERE email='" . $email . "' AND status=1 AND (`social` is Null or `social`='')";
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $token = $this->getToken();
            $sql = "UPDATE `users` SET `token`='" . $token . "' WHERE `userid`=" . $row['userid'];
            $this->conn->query($sql);
            $data = array("uname" => $row['uname'], "password" => $row['password'], "token" => $token);
        } else {
            return $this->msg2($this->msg8_txt());
        }
        $result = $this->msg1($this->msg16_txt(), $data, 0);
        $this->SendMail($row["email"], 'ForgotPassword', $lang, $data);

    }
    private  function convertCurrency($n){
       //convert $ to JD
        $price=round($n*0.71, 1);
        return round($price, 1,PHP_ROUND_HALF_UP);
    }
    private function getrandomnumber($length)
    {

        $this->num = "";
        //$this->codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $this->codeAlphabet .= "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
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
        $secretKey = $date . "Lfnvj8UAAAAAGMIkj9n6Xi6qDq-Manhal.com-FGkO3804EyKG" . $this->getrandomnumber(12);
        $this->token = hash('sha256', $secretKey);
        return $this->token;

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

    private function pass_v($password)
    {
        if ($password != '') {
            if (preg_match('/^([a-zA-Z0-9]){3,20}$/', $password)) {
                return 'true';
            } else {
                return 'false';
            }
        } else {
            return 'false';
        }
    }

    private function email_v($email)
    {

        if ($email != '') {
            if (preg_match('/^([a-zA-Z])([a-zA-Z0-9._-]){2,30}@([a-zA-Z0-9.-])+\.([a-zA-Z0-9]){2,5}$/', $email)) {
                return 'true';
            } else {
                return 'false';
            }
        } else {
            return 'false';
        }
    }

    private function username_v($name)
    {
        if ($name != '') {
            if (preg_match('/([a-zA-Z0-9._-]){3,30}/', $name)) {
                return 'true';
            } else {
                return 'false';
            }
        } else {
            return 'false';
        }
    }

    public function GetSliders()
    {
        $sql = "SELECT * FROM `storeslider` WHERE `id`>0";
        $result = $this->conn->query($sql);
        if (mysqli_num_rows($result) > 0) {
            $data = [];
            $i = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $data[$i] = (array("id" => $row['id'], "url" => $this->URL .   $row['url'], "action" => $row['action']));
                $i++;
            }
            $result = $this->msg1($this->msg16_txt(), $data, $i);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function GetDeliveryCost($city)
    {
        $cost = $this->DeliveryCost($city);
        $data = array("cost" => $cost, "city" => $city);
        $result = $this->msg1($this->msg16_txt(), $data, 0);
        return $result;

    }

    private function DeliveryCost($city)
    {
        $cost = 1;
        switch (strtolower($city)) {
            case 'amman':
            case 'عمان':
                $cost = 1;
                break;
            case 'aqaba':
            case 'alaqaba':
            case 'عقبة':
            case 'العقبة':
                $cost = 4;
                break;
            default:
                $cost = 3;
                break;
        }
        return $cost;
    }

    public function savePaymentToDB($grandTotal, $idlocation, $items, $additional_info)
    {

        $transaction='';
        $shipping_fullname='';
        $shipping_city='';
        $shipping_address2='';
        $shipping_mobile='';
        $shipping_phone='';
        $Shipping='';
        $cart_email='';
        $shipping_address1=$additional_info;
        $token = $this->gettokenfromhedar();
        $user = $this->getuserid($token);

        if ($user != 'false') {
            $userid=$user['userid'];
            $location = $this->GetlocationID($idlocation);
            if ($location == 'false') {
                return $this->msg2($this->msg19_txt());
            }
            $shipping = $this->DeliveryCost($location['region']);

            $cat_code = "ar";
            $shippingC = "Manhal";
            $status = 0;
            $transactio = 'Manhal';
            $payment_type = 'cash';
            $shipping_state = '';
            $shipping_post = '';
            $shipping_country = 'Jordan';
            $weight = 0;
            $contents = 'doc';
            $shipping_country_code = 'JO';
            $cart_fullname = $location['name'];;
            $cart_mobile = $location['mob'];
            $cart_phone = $location['mob'];;
            $cart_country = 'Jordan';
            $cart_city = $location['region'];
            $cart_state = '';
            $cart_post = '';
            $cart_address1 = $location['addres'];
            $cart_address2 = '';
            $total = $grandTotal + $shipping;
            $tax = 0;
            $cod = 0;


            $sql = "INSERT INTO `payments`(`paymentid`, `userid`, `total_price`, `status`, `payment_date`, `transaction`, `shipping`, `manhal_ref`, `payment_type`, `RecieverCompanyName`, `RecieverAttention`, `Address1`,`Address2`,

 `City`, `StateProvince`, `Postcode`, `Country`, `Weight`,`Phone`, `Contents`, `DeclaredValue`, `exported`, `shippingprice`, `Countrycode`, `telephone`,  `billing_fullname`,

 `billing_email`,`billing_mobile`, `billing_telephone`,`billing_country`, `billing_city`, `billing_state`, `billing_zipcode`, `billing_address1`, `billing_address2`, `products_price`,`tax`,`cod`)

 VALUES (''," . $userid . "," . $grandTotal . "," . $status . ",NOW(),'" . $transaction . "','" . $shippingC . "','0','" . $payment_type . "',

 '" . mysqli_real_escape_string($this->conn, $shipping_fullname) . "','" . mysqli_real_escape_string($this->conn, $shipping_fullname) . "',

 '" . mysqli_real_escape_string($this->conn, $shipping_address1) . "','" . mysqli_real_escape_string($this->conn, $shipping_address2) . "',

 '" . mysqli_real_escape_string($this->conn, $shipping_city) . "','" . mysqli_real_escape_string($this->conn, $shipping_state) . "',

 '" . mysqli_real_escape_string($this->conn, $shipping_post) . "','" . mysqli_real_escape_string($this->conn, $shipping_country) . "', " . $weight . ",

 '" . mysqli_real_escape_string($this->conn, $shipping_mobile) . "','" . mysqli_real_escape_string($this->conn, $this->conntents) . "',

 '" . $Shipping . "',0,'" . $Shipping . "','" . $shipping_country_code . "','" . mysqli_real_escape_string($this->conn, $shipping_phone) . "',

 '" . mysqli_real_escape_string($this->conn, $cart_fullname) . "',

 '" . mysqli_real_escape_string($this->conn, $cart_email) . "','" . mysqli_real_escape_string($this->conn, $cart_mobile) . "','" . mysqli_real_escape_string($this->conn, $cart_phone) . "',

'" . mysqli_real_escape_string($this->conn, $cart_country) . "','" . mysqli_real_escape_string($this->conn, $cart_city) . "',

 '" . mysqli_real_escape_string($this->conn, $cart_state) . "','" . mysqli_real_escape_string($this->conn, $cart_post) . "','" . mysqli_real_escape_string($this->conn, $cart_address1) . "',

 '" . mysqli_real_escape_string($this->conn, $cart_address2) . "'," . $total . "," . $tax . "," . $cod . ")";

            if ($this->conn->query($sql)) {
                $paymentid = mysqli_insert_id($this->conn);
                $sql = "UPDATE `payments` SET `Productcode`='" . $paymentid . "' WHERE `paymentid`=" . $paymentid;
                $this->conn->query($sql);
                $sql = "UPDATE `payments` SET `manhal_ref`='MP" . $paymentid . "' WHERE `paymentid`=" . $paymentid;
                $this->conn->query($sql);
                $data = json_decode($items, true);
                foreach ($data as $item) {

                    $sql = "INSERT INTO `payments_books`(`pbid`, `paymentid`, `bookid`, `quantity`, `book_price`, `totalprice`,`type`,`itemtype`) VALUES ('',$paymentid," . $item["id"] . "," . $item["quantity"] . "," . $item["price"] . "," . $item["quantity"] * $item["price"] . "," . $item["type"] . ",'" . $item["itemtype"] . "')";
                    $this->conn->query($sql);
                    if ($item["itemtype"] == "book") {
                        $sql = "UPDATE `books` SET `sales`=`sales`+1 WHERE `bookid`=" . $item["id"];

                        $this->conn->query($sql);
                    } elseif ($item["itemtype"] == "story") {
                        $sql = "UPDATE `story` SET `sales_count`=`sales_count`+1 WHERE `storyid`=" . $item["id"];
                        $this->conn->query($sql);
                    } elseif ($item["itemtype"] == "toy") {
                        $sql = "UPDATE `products` SET `sales_count`=`sales_count`+1 WHERE `productid`=" . $item["id"];
                        $this->conn->query($sql);
                    }
                }
                $result = $this->msg1($this->msg13_txt(), $this->json(), 0);
            } else {
                // "Unexpected error occured Err: 230217045055";
                $result = $this->msg2($this->msg18_txt());
            }


        } else {
            $result = $this->msg2($this->msg15_txt());
        }
        return $result;


    }
}

include_once('../../platform/config.php');
$api = new store();


if (isset($_GET["process"]) && $_GET["process"] != "") {
    switch ($_GET["process"]) {
        case "books_category":
            echo $api->get_category('categories', 'books');
            break;
        case "stories_category":
            echo $api->get_category('stories_cat', 'stories');
            break;
        case "departments":
            echo $api->get_category('departments', 'departments');
            break;
        case "brand":
            echo $api->get_category('brand', 'brand');
            break;
        case "books":
            echo $api->getbooks($_GET["keyword"], $_GET["category"], $_GET["lang"], $_GET["Price"], $_GET["id"], $_GET["store"], $_GET["page"], $_GET["filter"], $_GET["operation"]);
            break;
        case "stories":
            echo $api->getstories($_GET["keyword"], $_GET["category"], $_GET["lang"], $_GET["Price"], $_GET["id"], $_GET["store"], $_GET["page"], $_GET["filter"], $_GET["operation"]);
            break;
        case "products":
            echo $api->getproducts($_GET["keyword"], $_GET["department"], $_GET["brand"], $_GET["Price"], $_GET["id"], $_GET["page"], $_GET["filter"], $_GET["operation"]);
            break;
        case "getlocation":
            echo $api->Getlocation();
            break;
        case "favorit":
            echo $api->Wishs($_GET["id"], $_GET["type"]);
            break;
        case "myfavorite":
            echo $api->GETWishs($_GET["type"], $_GET["page"]);
            break;
        case "myorders":
            echo $api->Myorders();
            break;
        case "getnotification":
            echo $api->GetNotification($_GET["id"]);
            break;
        case "getdeliverycost":
            echo $api->GetDeliveryCost($_GET["city"]);
            break;
        case "getslider":
            echo $api->GetSliders();
            break;
        case "getrelatedid":
            echo $api->GetRelatedID($_GET["id"],$_GET["type"],$_GET["limit"],$_GET["store"],$_GET["keyword"]);
            break;


    }
}


//$rawData = file_get_contents("php://input");
//echo $rawData;
if (isset($_POST['process'])) {
    switch ($_POST["process"]) {
        case "signin":
            echo $api->LoginUserManhal($_POST['name'], $_POST['pass']);
            break;
        case "signup":
            echo $api->signupManhal($_POST['email'], $_POST['pass'], $_POST['name']);
            break;
        case "signinSocial":
            echo $api->LoginUserSocial($_POST['social'], $_POST['name'], $_POST['fname'], $_POST['lname'], $_POST['gender'], $_POST['email'], $_POST['avatar'], $_POST['birthdate']);
            break;
        case "forgot":
            echo $api->ForgotPassword($_POST['email'], $_POST['lang']);
            break;
        case "checktoken":
            echo $api->CheckTokenCodePassword($_POST['email']);
            break;
        case "changepassword":
            echo $api->ChangePassword($_POST['old_password'], $_POST['new_password']);
            break;
        case "setlocation":
            echo $api->SetLocation($_POST['lat'], $_POST['long'], $_POST['address'], $_POST['mob'], $_POST['name'], $_POST['building'], $_POST['apr'], $_POST['floor'], $_POST['region'], $_POST['isdefault']);
            break;
        case "updatelocation":
            echo $api->UpdateLocation($_POST['id'], $_POST['lat'], $_POST['long'], $_POST['address'], $_POST['mob'], $_POST['name'], $_POST['building'], $_POST['apr'], $_POST['floor'], $_POST['region'], $_POST['isdefault']);
            break;

        case "refreshtoken":
            echo $api->refreshToken($_POST['email']);
            break;
        case "editprofile":
            echo $api->EditProfile($_POST['name'], $_POST['birthday'], $_POST['gender']);
            break;
        case "updatecount":
            echo $api->updateCount($_POST["count"], $_POST["id"], $_POST["type"]);
            break;
        case "updateavatar":
            echo $api->updateAvatar($_POST["image"]);
            break;
        case "savefirebasekey":
            echo $api->SaveFirebaseKey($_POST["key"]);
            break;
        case "removelocation":
            echo $api->RemoveLocation($_POST["id"]);
            break;
        case "notificationedit":
            echo $api->NotificationEdit($_POST["image"], $_POST["title"], $_POST["text"], $_POST["type"]);
            break;
        case "setOrder":
            echo $api->savePaymentToDB($_POST["total"], $_POST["idlocation"], $_POST["items"], $_POST["additional_info"]);
            break;
        case "getorder":
            echo $api->GetOrder();
            break;
        case "deleteslider":
            echo $api->DeletSlider($_POST["id"]);
            break;
        case "updateslider":
            echo $api->UpdateSlider($_POST["id"], $_POST["action"]);
            break;
        case "insertslider":
            echo $api->InsertSlider($_POST["action"]);
            break;
        case "activities":
            echo $api->Activities($_POST["id"],$_POST["keyword"], $_POST["category"], $_POST["lang"], $_POST["grade"],$_POST["age"],$_POST["type"],$_POST["page"]);
            break;

    }
}
