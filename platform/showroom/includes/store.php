<?php

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
        return 'Cannot update';
    }

}

include_once 'mySession.php';

class store extends mySession
{
    use message;
    private static $classObj = NULL;

    public function __construct()
    {
        parent::__construct();
    }

    public static function getObj()
    {
        if (!self::$classObj)
            self::$classObj = new self();
        return self::$classObj;
    }

    public function totlalCustomer()
    {
        $Tquery = "Select count(distinct users.userid) as Num From users Left Join payments On users.userid = payments.userid  where payments.shipping='DHL' or payments.shipping='Manhal' or payments.shipping='ARAMEX'";
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $data = mysqli_fetch_assoc($temp);
            $result = $this->msg1($this->msg1_txt(), $data['Num'], $temp->num_rows);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function TotalBookingscompleted()
    {
        $Tquery = "Select count(payments.paymentid) as Num From payments Where (payments.shipping = 'DHL' Or payments.shipping = 'Manhal' Or payments.shipping = 'ARAMEX') And payments.shipping_close_user = 2";
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $data = mysqli_fetch_assoc($temp);
            $result = $this->msg1($this->msg1_txt(), $data['Num'], $temp->num_rows);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function TotalOrdersinprogress()
    {
        $Tquery = "Select count(payments.paymentid) as Num From payments Where (payments.shipping = 'DHL' Or payments.shipping = 'Manhal' Or payments.shipping = 'ARAMEX') And payments.store_close_user=-1 and payments.cancelled=0";
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $data = mysqli_fetch_assoc($temp);
            $result = $this->msg1($this->msg1_txt(), $data['Num'], $temp->num_rows);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function TotalOrdersInshippingorders()
    {
        $Tquery = "Select count(payments.paymentid) as Num From payments Where (payments.shipping = 'DHL' Or payments.shipping = 'Manhal' Or payments.shipping = 'ARAMEX') And  payments.shipping_close_user=1 and payments.cancelled=0";
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $data = mysqli_fetch_assoc($temp);
            $result = $this->msg1($this->msg1_txt(), $data['Num'], $temp->num_rows);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function Totalsales($date)
    {
        $Tquery = "Select sum( payments.total_price) as Num From payments Where (payments.shipping = 'DHL' Or payments.shipping = 'Manhal' Or payments.shipping = 'ARAMEX') And payments.shipping_close_user = 2 " . $date;
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $data = mysqli_fetch_assoc($temp);
            $result = $this->msg1($this->msg1_txt(), $data['Num'], $temp->num_rows);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }
    public function Totalsubscription($date)
    {
        $Tquery = "Select Distinct sum(payments.total_price)as Num From payments Where payments.shipping is null " . $date;
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $data = mysqli_fetch_assoc($temp);
            $result = $this->msg1($this->msg1_txt(), $data['Num'], $temp->num_rows);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }
    public function Numberofcanceledrequests()
    {
        $Tquery = "Select count(payments.paymentid) As Num From payments Where (payments.shipping = 'DHL' Or payments.shipping = 'manhal' Or payments.shipping = 'ARAMEX') And payments.cancelled = 1";
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $data = mysqli_fetch_assoc($temp);
            $result = $this->msg1($this->msg1_txt(), $data['Num'], $temp->num_rows);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    private function GetCustomersSql($date, $search = '')
    {
        $filter_date = '';
        if ($date != '') {
            $thisdatae = explode(" - ", $date);
            $filter_date = " and  `users`.`cdate`>='" . $thisdatae[0] . "' and  `users`.`cdate` <= '" . $thisdatae[1] . " 23:59:59'";
        }
        $filtersearch = '';
        if ($search != '') {
            $filtersearch = " and  (`payments`.`RecieverCompanyName` like '%" . $search . "%'  or  `payments`.`telephone` like '%" . $search . "%' or  `payments`.`billing_telephone` like '%" . $search . "%'or  `payments`.`Phone` like '%" . $search . "%'  or `payments`.`Address1` like '%" . $search . "%' or `payments`.`Address2` like '%" . $search . "%' or `payments`.`Address3` like '%" . $search . "%' or   `payments`.`Country` like '%" . $search . "%' or  `payments`.`telephone` like '%" . $search . "%' or `payments`.`City` like '%" . $search . "%'  or `payments`.`billing_fullname` like '%" . $search . "%' or  `payments`.`billing_email` like '%" . $search . "%' or  users.uname like '%" . $search . "%' or users.fullname like '%" . $search . "%' or users.email like '%" . $search . "%' or users.Country like '%" . $search . "%' )";
        }

        $Tquery = "Select Distinct payments.userid, users.fullname, payments.Country, users.uname, users.email, users.country As country1, payments.Phone, SubQuery.counts From payments Left Join users On users.userid = payments.userid Left Join (Select Count(payments.paymentid) As counts, payments.userid From payments where  payments.cancelled = 0 Group By payments.userid) As SubQuery On SubQuery.userid = payments.userid  Where (payments.shipping = 'DHL' Or payments.shipping = 'manhal' Or payments.shipping = 'ARAMEX') and payments.cancelled = 0 And users.permession != 1 And users.permession != 2 And users.permession != 6 " . $filtersearch . $filter_date . " Group By payments.userid, SubQuery.counts Order By SubQuery.counts DESC,payments.userid, country1 ASC" . $this->FromTo;;


        return $Tquery;
    }

    private function GetSubscriptionCustomersSql($date, $search = '')
    {
        $filter_date = '';
        if ($date != '') {
            $thisdatae = explode(" - ", $date);
            $filter_date = " and  `users`.`cdate`>='" . $thisdatae[0] . "' and  `users`.`cdate` <= '" . $thisdatae[1] . " 23:59:59'";
        }
        $filtersearch = '';
        if ($search != '') {
            $filtersearch = " and  (`payments`.`RecieverCompanyName` like '%" . $search . "%'  or  `payments`.`telephone` like '%" . $search . "%' or  `payments`.`billing_telephone` like '%" . $search . "%'or  `payments`.`Phone` like '%" . $search . "%'  or `payments`.`Address1` like '%" . $search . "%' or `payments`.`Address2` like '%" . $search . "%' or `payments`.`Address3` like '%" . $search . "%' or   `payments`.`Country` like '%" . $search . "%' or  `payments`.`telephone` like '%" . $search . "%' or `payments`.`City` like '%" . $search . "%'  or `payments`.`billing_fullname` like '%" . $search . "%' or  `payments`.`billing_email` like '%" . $search . "%' or  users.uname like '%" . $search . "%' or users.fullname like '%" . $search . "%' or users.email like '%" . $search . "%' or users.Country like '%" . $search . "%' )";
        }
        $Tquery = "Select Distinct payments.userid,users.fullname, payments.Country, users.uname, users.email, users.country As country1, payments.Phone, SubQuery.counts, payment_subscribe.subscribe_type, payment_subscribe.expire_date, payments.payment_date From payments Left Join users On users.userid =payments.userid Left Join (Select Count(payments.paymentid) As counts, payments.userid From payments Where (payments.shipping = '' Or payments.shipping Is Null) Group By payments.userid) As SubQuery On SubQuery.userid=payments.userid Left Join payment_subscribe On payment_subscribe.paymentid =payments.paymentid Where (payments.shipping = '' Or payments.shipping Is Null)  And (users.permession >8 or users.permession =0) " . $filtersearch . $filter_date . " Group By payments.userid Order By  SubQuery.counts Desc,payments.payment_date Desc,payments.userid,country1 " . $this->FromTo;
        return $Tquery;
    }

    public function GetCustomers($page = 0, $date = '', $search = '')
    {
        $this->FromTo = '';
        $Tquery = $this->GetCustomersSql($date, $search);

        $temp = $this->makeQuery($Tquery);
        $page_count = $this->pagesnumber(mysqli_num_rows($temp));
        if ($page > $page_count) {
            $page = $page_count;
        } else if ($page < 0) {
            $page = 0;
        }
        $this->FromTo = $this->get_paginagtion((int)$page * (int)$this->PerPage, (int)$this->PerPage);
        $Tquery = $this->GetCustomersSql($date, $search);
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $data = [];
            $i = 0;
            while ($row = mysqli_fetch_assoc($temp)) {
                $username = $row['fullname'];
                $Country = $row['Country'];
                if ($username == '') {
                    $username = $row['uname'];
                }
                if ($Country == '') {
                    $Country = $row['country1'];
                }
                $data[$i] = (array("userid" => $row['userid'], "name" => $username, "Country" => $Country, "email" => $row['email'], "Phone" => $row['Phone'], "purchase" => $row['counts']));
                $i++;
            }
            $result = $this->msg1($this->msg1_txt(), $data, $page_count);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function GetSubscriptionCustomers($page = 0, $date = '', $search = '')
    {
        $this->FromTo = '';
        $Tquery = $this->GetSubscriptionCustomersSql($date, $search);

        $temp = $this->makeQuery($Tquery);
        $page_count = $this->pagesnumber(mysqli_num_rows($temp));
        if ($page > $page_count) {
            $page = $page_count;
        } else if ($page < 0) {
            $page = 0;
        }
        $this->FromTo = $this->get_paginagtion((int)$page * (int)$this->PerPage, (int)$this->PerPage);

        $Tquery = $this->GetSubscriptionCustomersSql($date, $search);

        $temp = $this->makeQuery($Tquery);

        if ($temp->num_rows > 0) {
            $data = [];
            $i = 0;
            while ($row = mysqli_fetch_assoc($temp)) {
                $username = $row['fullname'];
                $Country = $row['Country'];
                if ($username == '') {
                    $username = $row['uname'];
                }
                if ($Country == '') {
                    $Country = $row['country1'];
                }

                $data[$i] = (array("userid" => $row['userid'], "name" => $username, "Country" => $Country, "email" => $row['email'], "Phone" => $row['Phone'], "purchase" => $row['counts'], "subscribe_type" => $row['subscribe_type'], "start_date" => $row['payment_date'], "end_date" => $row['expire_date']));
                $i++;
            }
            $result = $this->msg1($this->msg1_txt(), $data, $page_count);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function GetAllCanceledOrders($page = 0, $shipping = -1, $date = '', $search = '')
    {
        $this->FromTo = '';
        $filter = " and payments.cancelled = 1 ";
        $Tquery = $this->GetAllOrdersSql($filter, $shipping, $date, $search);
        $temp = $this->makeQuery($Tquery);
        $page_count = $this->pagesnumber(mysqli_num_rows($temp));
        if ($page > $page_count) {
            $page = $page_count;
        } else if ($page < 0) {
            $page = 0;
        }
        $this->FromTo = $this->get_paginagtion((int)$page * (int)$this->PerPage, (int)$this->PerPage);

        $Tquery = $this->GetAllOrdersSql($filter, $shipping, $date, $search);
        $temp = $this->makeQuery($Tquery);

        if ($temp->num_rows > 0) {
            $data = [];
            $i = 0;
            while ($row = mysqli_fetch_assoc($temp)) {


                $username = $row['fullname'];
                $Country = $row['StateProvince'];
                if ($username == '') {
                    $username = $row['billing_fullname'];
                }
                if ($Country == '') {
                    $Country = $row['Country'];
                }
                $email = $row['billing_email'];
                if ($email == '') {
                    $email = $row['email'];
                }
                $telephone = $row['billing_telephone'];
                if ($telephone == '') {
                    $telephone = $row['Phone'];
                }


                $data[$i] = (array("paymentid" => $row['paymentid'], "userid" => $row['userid'], "name" => $username, "Country" => $Country, "email" => $email
                , "Phone" => $telephone, "total_price" => $row['total_price'], "City" => $row['City'], "Postcode" => $row['Postcode'], "telephone" => $telephone, "payment_date" => $row['payment_date']));

                $i++;
            }
            $result = $this->msg1($this->msg1_txt(), $data, $page_count);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }

        return $result;
    }

    private function GetAllOrdersSql($filter, $shipping, $date, $search)
    {
        $filter_shipping = " And (payments.shipping = 'DHL' Or payments.shipping = 'manhal' Or payments.shipping = 'ARAMEX')  ";
        if ($shipping == 'DHL') {
            $filter_shipping = " And (payments.shipping = 'DHL')  ";
        } else if ($shipping == 'manhal') {
            $filter_shipping = " And (payments.shipping = 'manhal')  ";
        } else if ($shipping == 'ARAMEX') {
            $filter_shipping = " And(payments.shipping = 'ARAMEX')  ";
        }
        $filter_date = '';
        if ($date != '') {
            $thisdatae = explode(" - ", $date);
            $filter_date = " and  payments.payment_date>='" . $thisdatae[0] . "' and  payments.payment_date <= '" . $thisdatae[1] . " 23:59:59'";
        }

        $filtersearch = '';
        if ($search != '') {

            $filtersearch = " and  (`payments`.`total_price` like '%" . $search . "%' or `payments`.`manhal_ref` like '%" . $search . "%' or `payments`.`RecieverCompanyName` like '%" . $search . "%' or `payments`.`Address1` like '%" . $search . "%' or `payments`.`Address2` like '%" . $search . "%' or `payments`.`Address3` like '%" . $search . "%' or  `payments`.`payment_type` like '%" . $search . "%' or  `payments`.`Country` like '%" . $search . "%' or  `payments`.`telephone` like '%" . $search . "%' or `payments`.`City` like '%" . $search . "%' or  `payments`.`total_price` like '%" . $search . "%' or `payments`.`billing_fullname` like '%" . $search . "%' or  `payments`.`billing_email` like '%" . $search . "%' or `payments`.`Weight` like '%" . $search . "%' or `payments`.`Countrycode`  like '%" . $search . "%' 
                 or users.uname like '%" . $search . "%' or users.fullname like '%" . $search . "%' or users.email like '%" . $search . "%' or users.Country like '%" . $search . "%'or payments.userid like '%" . $search . "%' )";
        }

        $sql = "Select  payments.*,users.fullname,users.uname,payments.userid,users.Country,users.email From  payments Left Join    users On users.userid = payments.userid Where  `payments`.`paymentid`>0  " . $filter_shipping . $filter . $filter_date . $filtersearch . " ORDER BY payments.payment_date DESC" . $this->FromTo;
        return $sql;
    }

    public function GetAllCompletedOrders($page = 0, $shipping = -1, $date = '', $search = '')
    {
        $this->FromTo = '';
        $filter = " and (payments.shipping_close_user=2 and payments.cancelled=0) ";
        $Tquery = $this->GetAllOrdersSql($filter, $shipping, $date, $search);
        $temp = $this->makeQuery($Tquery);
        $page_count = $this->pagesnumber(mysqli_num_rows($temp));
        if ($page > $page_count) {
            $page = $page_count;
        } else if ($page < 0) {
            $page = 0;
        }
        $this->FromTo = $this->get_paginagtion((int)$page * (int)$this->PerPage, (int)$this->PerPage);

        $Tquery = $this->GetAllOrdersSql($filter, $shipping, $date, $search);
        $temp = $this->makeQuery($Tquery);

        if ($temp->num_rows > 0) {
            $data = [];
            $i = 0;
            while ($row = mysqli_fetch_assoc($temp)) {
                $username = $row['fullname'];
                $Country = $row['StateProvince'];
                if ($username == '') {
                    $username = $row['uname'];
                }

                if ($Country == '') {
                    $Country = $row['Country'];
                }
                $data[$i] = (array("paymentid" => $row['paymentid'], "userid" => $row['userid'], "name" => $username, "Country" => $Country, "email" => $row['email']
                , "Phone" => $row['Phone'], "total_price" => $row['total_price'], "City" => $row['City'], "Postcode" => $row['Postcode'], "telephone" => $row['telephone'], "payment_date" => $row['payment_date']));

                $i++;
            }
            $result = $this->msg1($this->msg1_txt(), $data, $page_count);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }

        return $result;
    }

    public function GetAllPendingOrders($page = 0, $shipping = -1, $date = '', $search = '')
    {
        $this->FromTo = '';
        $filter = " And  payments.shipping_close_user=-1 and payments.cancelled=0  ";
        $Tquery = $this->GetAllOrdersSql($filter, $shipping, $date, $search);
        $temp = $this->makeQuery($Tquery);
        $page_count = $this->pagesnumber(mysqli_num_rows($temp));
        if ($page > $page_count) {
            $page = $page_count;
        } else if ($page < 0) {
            $page = 0;
        }
        $this->FromTo = $this->get_paginagtion((int)$page * (int)$this->PerPage, (int)$this->PerPage);
        $Tquery = $this->GetAllOrdersSql($filter, $shipping, $date, $search);
        $temp = $this->makeQuery($Tquery);

        if ($temp->num_rows > 0) {
            $data = [];
            $i = 0;
            while ($row = mysqli_fetch_assoc($temp)) {
                $username = $row['fullname'];
                $Country = $row['StateProvince'];
                if ($username == '') {
                    $username = $row['billing_fullname'];
                }
                if ($Country == '') {
                    $Country = $row['Country'];
                }
                $email = $row['billing_email'];
                if ($email == '') {
                    $email = $row['email'];
                }
                $telephone = $row['billing_telephone'];
                if ($telephone == '') {
                    $telephone = $row['Phone'];
                }
                $data[$i] = (array("paymentid" => $row['paymentid'], "userid" => $row['userid'], "name" => $username, "Country" => $Country, "email" => $email
                , "Phone" => $telephone, "total_price" => $row['total_price'], "City" => $row['City'], "Postcode" => $row['Postcode'], "telephone" => $telephone, "payment_date" => $row['payment_date']));

                $i++;
            }
            $result = $this->msg1($this->msg1_txt(), $data, $page_count);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function GetAllInShippingOrders($page = 0, $shipping = -1, $date = '', $search = '')
    {
        $this->FromTo = '';
        $filter = " And  payments.shipping_close_user=1 and payments.cancelled=0  ";
        $Tquery = $this->GetAllOrdersSql($filter, $shipping, $date, $search);
        $temp = $this->makeQuery($Tquery);
        $page_count = $this->pagesnumber(mysqli_num_rows($temp));
        if ($page > $page_count) {
            $page = $page_count;
        } else if ($page < 0) {
            $page = 0;
        }
        $this->FromTo = $this->get_paginagtion((int)$page * (int)$this->PerPage, (int)$this->PerPage);
        $Tquery = $this->GetAllOrdersSql($filter, $shipping, $date, $search);
        $temp = $this->makeQuery($Tquery);

        if ($temp->num_rows > 0) {
            $data = [];
            $i = 0;
            while ($row = mysqli_fetch_assoc($temp)) {

                $username = $row['fullname'];
                $Country = $row['StateProvince'];
                if ($username == '') {
                    $username = $row['billing_fullname'];
                }
                if ($Country == '') {
                    $Country = $row['Country'];
                }
                $email = $row['billing_email'];
                if ($email == '') {
                    $email = $row['email'];
                }
                $telephone = $row['billing_telephone'];
                if ($telephone == '') {
                    $telephone = $row['Phone'];
                }


                $data[$i] = (array("paymentid" => $row['paymentid'], "userid" => $row['userid'], "name" => $username, "Country" => $Country, "email" => $email
                , "Phone" => $telephone, "total_price" => $row['total_price'], "City" => $row['City'], "Postcode" => $row['Postcode'], "telephone" => $telephone, "payment_date" => $row['payment_date']));

                $i++;
            }
            $result = $this->msg1($this->msg1_txt(), $data, $page_count);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function ChangeOfStatusRequest($id, $status)
    {
        $result = 0;
        switch (strtolower($status)) {
            case 'completed':
                $Tquery = 'UPDATE `payments` SET `shipping_close_user`=2 WHERE `paymentid`=' . $id;
                break;
            case 'inshipping':
                $Tquery = 'UPDATE `payments` SET `shipping_close_user`=1 WHERE `paymentid`=' . $id;
                break;
            case 'cancelled':
                $Tquery = 'UPDATE `payments` SET `cancelled`=1,`shipping_close_user`=-1 WHERE `paymentid`=' . $id;

                break;
            case 'pending':
                $Tquery = 'UPDATE `payments` SET `shipping_close_user`=-1 ,`cancelled`=0 WHERE `paymentid`=' . $id;
                break;
        }
        $temp = $this->makeQuery($Tquery);
        $result = 1;
        return $result;
    }

    public function InformationCanceledOrder($id)
    {
        $Tquery = "Select location.*,payments.* From payments Left Join location On location.userid = payments.userid Where payments.paymentid = " . $id . " And    location.isdefault = 1";
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $row = mysqli_fetch_assoc($temp);
            $data = (array("lat" => $row['lat'], "long" => $row['long'], "address" => $row['address'], "mob" => $row['mob'], "name" => $row['name'], "cdate" => $row['cdate'], "building" => $row['building'], "apr" => $row['apr'], "floor" => $row['floor'], "region" => $row['region']
            , "total_price" => $row['total_price'], "payment_date" => $row['payment_date'], "RecieverCompanyName" => $row['RecieverCompanyName'], "RecieverAttention" => $row['RecieverAttention'], "Address1" => $row['Address1'], "Address2" => $row['Address2'], "City" => $row['City']
            , "Postcode" => $row['Postcode'], "Country" => $row['Country'], "Phone" => $row['Phone'], "shippingprice" => $row['shippingprice'], "Countrycode" => $row['Countrycode'], "shipping" => $row['shipping'], "products_price" => $row['products_price']
            ));
            $result = $this->msg1($this->msg1_txt(), $data, 1);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function InformationCompletedOrder($id)
    {
        $Tquery = "Select payments.* From payments Where payments.paymentid = " . $id;
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $row = mysqli_fetch_assoc($temp);

            //return $row;
            $data = (array(
                "paymentid" => $row['paymentid'],
                "userid" => $row['userid'],
                "total_price" => $row['total_price'],
                "payment_date" => $row['payment_date'],
                "payment_type" => $row['payment_type'],
                "transaction" => $row['transaction'],
                "shipping" => $row['shipping'],
                "manhal_ref" => $row['manhal_ref'],
                "shipping_close_date" => $row['shipping_close_date'],
                "confirmed_by" => $row['confirmed_by'],
                "RecieverCompanyName" => $row['RecieverCompanyName'],
                "RecieverAttention" => $row['RecieverAttention'],
                "Address1" => $row['Address1'],
                "Address2" => $row['Address2'],
                "Address3" => $row['Address3'],
                "City" => $row['City'],
                "StateProvince" => $row['StateProvince'],
                "Postcode" => $row['Postcode'],
                "Country" => $row['Country'],
                "Weight" => $row['Weight'],
                "Phone" => $row['Phone'],
                "Refrence" => $row['Refrence'],
                "Contents" => $row['Contents'],
                "DeclaredValue" => $row['DeclaredValue'],
                "Productcode" => $row['Productcode'],
                "shippingprice" => $row['shippingprice'],
                "Countrycode" => $row['Countrycode'],
                "telephone" => $row['telephone'],
                "fax" => $row['fax'],
                "billing_fullname" => $row['billing_fullname'],
                "billing_email" => $row['billing_email'],
                "billing_mobile" => $row['billing_mobile'],
                "billing_telephone" => $row['billing_telephone'],
                "billing_fax" => $row['billing_fax'],
                "billing_country" => $row['billing_country'],
                "billing_city" => $row['billing_city'],
                "billing_state" => $row['billing_state'],
                "billing_zipcode" => $row['billing_zipcode'],
                "billing_address1" => $row['billing_address1'],
                "billing_address2" => $row['billing_address2'],
                "products_price" => $row['products_price'],
                "tax" => $row['tax'],
                "cod" => $row['cod'],

            ));
            $result = $this->msg1($this->msg1_txt(), $data, 1);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function informationOrder($id)
    {

        $Tquery = "SELECT `payments_books`.*,`payments_books`.`type` as item_type,`books`.`booktype`,`books`.`name`,`books`.`weight` as book_weight,
                           `books`.`isbn` as book_isbn, `story`.`title` ,`story`.`isbn` as story_isbn,`story`.`weight` as story_weight, `products`.`name_ar`,
                            `products`.`name_en` , `products`.`ISBN` as toy_isbn  ,`products`.`Weight` as toy_weight               
               FROM `payments_books`
                LEFT OUTER JOIN `books`    ON `payments_books`.`bookid`=`books`.`bookid`       AND `payments_books`.`itemtype`='book'
                LEFT OUTER JOIN `story`    ON `payments_books`.`bookid`=`story`.`storyid`      AND `payments_books`.`itemtype`='story'
                LEFT OUTER JOIN `products` ON `payments_books`.`bookid`=`products`.`productid` AND `payments_books`.`itemtype`='toy'
                where payments_books.paymentid=" . $id . " 
                and ( payments_books.`type`=1 or payments_books.`type`=3 or payments_books.`type`=5 or payments_books.`type`=7 )";

        $temp = $this->makeQuery($Tquery);
        return $temp;
    }

    public function GetTotalSaless($date = '')
    {
        $filter_date = '';
        if ($date != '') {
            $thisdatae = explode(" - ", $date);
            $filter_date = " and  payments.payment_date>='" . $thisdatae[0] . "' and payments.payment_date <= '" . $thisdatae[1] . " 23:59:59'";
        }
        $Tquery = "Select Sum(If(payments.shipping = 'DHL', 1, 0)) As DHL, Sum(If(payments.shipping = 'manhal', 1, 0)) As manhal, Sum(If(payments.shipping = 'ARAMEX', 1, 0)) As ARAMEX, Sum(If(payments.shipping = 'DHL', payments.products_price, 0)) As DHL_Total, Sum(If(payments.shipping = 'manhal',payments.total_price, 0)) As manhal_Total, Sum(If(payments.shipping = 'ARAMEX', payments.products_price, 0)) As ARAMEX_Total From payments Where payments.cancelled = 0 and `payments`.`shipping_close_user`=2" . $filter_date;

        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $row = mysqli_fetch_assoc($temp);
            $result = $this->msg1($this->msg1_txt(), $row, $temp->num_rows);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function CountriesOfPurchase($date = '')
    {

        $filter_date = '';
        if ($date != '') {
            $thisdatae = explode(" - ", $date);
            $filter_date = " and  payments.payment_date>='" . $thisdatae[0] . "' and payments.payment_date <= '" . $thisdatae[1] . " 23:59:59'";
        }
        $Tquery = "Select payments.Countrycode as Countr, Sum(If(payments.cancelled = 0 and `payments`.`shipping_close_user`=2 " . $filter_date . ",payments.products_price, 0)) As total_price , Count(payments.Countrycode) As counts From payments Where (payments.cancelled = 0 And payments.shipping = 'DHL' " . $filter_date . " ) Or ( payments.cancelled = 0 And payments.shipping = 'Manhal' " . $filter_date . ") Or ( payments.cancelled = 0 and payments.shipping = 'ARAMEX' " . $filter_date . " )  Group By payments.Countrycode ";

        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $i = 0;
            $data = [];
            while ($row = mysqli_fetch_assoc($temp)) {
                if ($row['Countr'] != '') {
                    $data[$i] = (array("Countr" => $row['Countr'], "total_price" => $row['total_price'], "counts" => $row['counts']));
                    $i++;
                }
            }
            $result = $this->msg1($this->msg1_txt(), $data, $temp->num_rows);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function GetTotalSubscriptions($date = '')
    {

        $filter_date = '';
        if ($date != '') {
            $thisdatae = explode(" - ", $date);
            $filter_date = " and  payments.payment_date>='" . $thisdatae[0] . "' and payments.payment_date <= '" . $thisdatae[1] . " 23:59:59'";
        }
        $Tquery = "Select Distinct Sum(If(payment_subscribe.subscribe_usertype = 'Parents' , 1, 0)) As No_Family, Sum(If(payment_subscribe.subscribe_usertype = 'Schools', 1, 0)) As No_School, Sum(If(payment_subscribe.subscribe_usertype = 'Parents' " . $filter_date . " , payment_subscribe.total_price, 0)) As Total_Family, Sum(If(payment_subscribe.subscribe_usertype = 'Schools'  " . $filter_date . " , payment_subscribe.total_price, 0)) As Total_School, Sum(If(payment_subscribe.subscribe_type = 'Monthly'  " . $filter_date . "  , 1, 0 )) As Total_Month, Sum(If(payment_subscribe.subscribe_type = 'Annual'  " . $filter_date . " , 1, 0 )) As Total_Anyal From payment_subscribe Left Join users On users.userid = payment_subscribe.userid Left Join payments On payments.paymentid = payment_subscribe.paymentid Where (users.permession>8 or users.permession=0 )" . $filter_date;

        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $row = mysqli_fetch_assoc($temp);
            $result = $this->msg1($this->msg1_txt(), $row, $temp->num_rows);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function GetCuntryOfSubscriptions($date = '')
    {

        $filter_date = '';
        if ($date != '') {
            $thisdatae = explode(" - ", $date);
            $filter_date = " and  payments.payment_date>='" . $thisdatae[0] . "' and payments.payment_date <= '" . $thisdatae[1] . " 23:59:59'";
        }
        $Tquery = "Select payments.Countrycode as Countr, Sum(If(payments.cancelled = 0 and `payments`.`shipping_close_user`=2 " . $filter_date . ",payments.products_price, 0)) As total_price , Count(payments.Countrycode) As counts From payments Where (payments.cancelled = 0 And payments.shipping = 'DHL' " . $filter_date . " ) Or ( payments.cancelled = 0 And payments.shipping = 'Manhal' " . $filter_date . ") Or ( payments.cancelled = 0 and payments.shipping = 'ARAMEX' " . $filter_date . " )  Group By payments.Countrycode ";

        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $i = 0;
            $data = [];
            while ($row = mysqli_fetch_assoc($temp)) {
                if ($row['Countr'] != '') {
                    $data[$i] = (array("Countr" => $row['Countr'], "total_price" => $row['total_price'], "counts" => $row['counts']));
                    $i++;
                }
            }
            $result = $this->msg1($this->msg1_txt(), $data, $temp->num_rows);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function pagesnumber($num_rows)
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
        $this->codeAlphabet = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $this->max = strlen($this->codeAlphabet) - 1;
        for ($this->i = 0; $this->i < $length; $this->i++) {
            $this->num .= $this->codeAlphabet[$this->crypto_rand_secure(0, $this->max)];
        }
        return $this->num;
    }

    private function GetToken()
    {
        $this->token = "";
        $date = gettimeofday();
        $date = implode(" ", $date);
        $secretKey = $date . "Lfnvj8UAAAAAGMIkj9n6Xi6qDq-Manhal.com-FGkO3804EyKG" . $this->getrandomnumber(12);
        $this->token = hash('sha256', $secretKey);
        return $this->token;
    }

    public function CreateTokenFireBase($userid, $token)
    {
        $result = '';
        if ($token != '' && $this->checkedTokenFirebase($userid, $token) == '') {
            $Tquery = "INSERT INTO `token`(`id`, `token`, `expiredate`, `userid`) VALUES (null,'" . $token . "',CURRENT_TIMESTAMP()," . $userid . ")";
            $temp = $this->makeQuery($Tquery);
            if ($temp) {
                $result = $token;
            } else {
                $result = '';
            }
        }
        return $result;
    }

    public function checkedTokenFirebase($userid, $token)
    {
        $result = '';
        $Tquery = "SELECT `token` FROM `token` WHERE `token`='" . $token . "'and `userid`=" . $userid;
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            $row = mysqli_fetch_assoc($temp);
            $result = $row['token'];
        }
        return $result;
    }

    public function CreateTokenCode($userid)
    {
        $token = $this->GetToken();
        $Tquery = "INSERT INTO `token`(`id`, `token`, `expiredate`, `userid`) VALUES (null,'" . $token . "',CURRENT_TIMESTAMP()," . $userid . ")";
        $temp = $this->makeQuery($Tquery);
        if ($temp) {

            $result = $token;
        } else {
            $result = 'false';
        }
        return $result;
    }

    public function GetSliders()
    {
        $Tquery = "SELECT * FROM `storeslider` WHERE `id`>0  ORDER BY `storeslider`.`sort` ASC";
        $temp = $this->makeQuery($Tquery);
        if (mysqli_num_rows($temp) > 0) {
            $data = [];
            $i = 0;
            while ($row = mysqli_fetch_assoc($temp)) {
                $data[$i] = (array("id" => $row['id'], "url" => 'https://www.manhal.com/' . $row['url'], "action" => $row['action'], "sort" => $row['sort'], "_delete" => $row['_delete']));
                $i++;
            }
            $result = $this->msg1($this->msg1_txt(), $data, $i);
        } else {
            $result = $this->msg2($this->msg2_txt());
        }
        return $result;
    }

    public function DeletSlider($id)
    {
        $Tquery = "SELECT * FROM `storeslider` WHERE `id`=" . $id;
        $temp = $this->makeQuery($Tquery);
        if (mysqli_num_rows($temp) > 0) {
            $row = mysqli_fetch_assoc($temp);
            unlink('../../../' . $row['url']); // Remove the uploaded file from the PHP temp folder
            $Tquery = "DELETE FROM `storeslider` WHERE `id`=" . $id;
            $temp = $this->makeQuery($Tquery);
            $result = $this->msg1($this->msg1_txt(), $this->json(), 0);
        } else {
            $result = $this->msg2($this->msg6_txt);
        }

        return $result;
    }
    public function DisableSlider($id)
    {
        $Tquery = "UPDATE `storeslider` SET _delete=(!_delete) WHERE `id`=" . $id;
        echo $Tquery;
        $this->makeQuery($Tquery);
        return 1;
    }


    public function UpdateSortSlider($dataJSON)
    {

        $someArray = json_decode($dataJSON, true);
        $Tquery ='';
        foreach ($someArray as $key => $value) {
            echo $value["id"] . ", " . $value["sort"] . "<br>";
            $Tquery .='UPDATE `storeslider` SET `sort` = '.$value["sort"].' WHERE id ='.$value["id"].';';
        }
        $temp= $this->getConObj()->multi_query($Tquery);
        if (!$temp)
            $this->getConObj()->error;
        return 1;

    }
    private function GetLastId($tablename)
    {
        $result = '';
        $Tquery = "SELECT MAX(id) as id FROM " . $tablename;
        $temp = $this->makeQuery($Tquery);
        if (mysqli_num_rows($temp) > 0) {
            $row = mysqli_fetch_assoc($temp);
            $result = $row['id'];
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
    public function InsertSlider($action)
    {
                $id = $this->GetLastId('`storeslider`');
                $newId = $id + 1;
                $newFileName = "../../../images/store/slider/" . $newId;
                $masge = $this->UploadImage('slider', $newFileName);
                if ($masge['masge'] == '') {
                    $files = explode('../../../', $masge['file']);
                    $data = array("slider" => $this->URL . $files[1]);
                    $Tquery = "INSERT INTO `storeslider`(`id`, `url`, `action`, `sort`) VALUES (null,'" . $files[1] . "','" . $action . "' ,".$newId.")";
                    $temp = $this->makeQuery($Tquery);
                    $result = $this->msg1($this->msg1_txt(), $this->json(), 0);
                } else {
                    $result = $this->msg2($this->msg6_txt);
                }

        return $result;

    }
    public function UpDateAllBooks(){
        $Tquery = "SELECT * FROM `books` WHERE `_group`= 0  and `status`=1 and isbn!='' and `publisher`=0   ";
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($temp)) {
                if(isset($row['isbn'])&& $row['isbn']!=''){
                   $this->GetStockBook_PRESTOSOFTandupdatemanhal($row['isbn'],'Books');
                }
            }
        }


    }
    public function UpDateAllStories(){
        $Tquery = "SELECT * FROM `story` WHERE `_group`= 0 and isbn!=''   ";
        $temp = $this->makeQuery($Tquery);
        if ($temp->num_rows > 0) {
            while ($row = mysqli_fetch_assoc($temp)) {
                if(isset($row['isbn'])&& $row['isbn']!=''){
                    $this->GetStockBook_PRESTOSOFTandupdatemanhal($row['isbn'],'Stories');
                }
            }
        }


    }

    public function GetStockBook_PRESTOSOFTandupdatemanhal($ISBN,$type){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://85.159.220.130/API/api.php?process=getproductISBN&ISBN=".$ISBN,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Cookie: PHPSESSID=a725pg1vbnbm628gpspa3kv14u"
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $result='';
        $data=json_decode($response, true);
        if($data['result']==1){
            if(isset($data['data'][0])&&$data['data'][0]['COUNTS']>0){
                $result=$data['data'][0]['COUNTS'];
                $count=$data['data'][0]['COUNTS'];
                $C_GROUP=$data['data'][0]['C_GROUP'];
                if($type=='Books'){
                    $Tquery = "UPDATE `books` SET `_group`=".$C_GROUP.",`count`=".$count." WHERE `isbn`= '".$ISBN."' and `status`=1 " ;
                }else if($type=='Stories'){
                    $Tquery = "UPDATE `story` SET `_group`=".$C_GROUP.",`count`=".$count." WHERE `isbn` = '".$ISBN."'" ;
                }

                $temp = $this->makeQuery($Tquery);
            }
                $result=0;


        }
        return $result;
    }



}

$api = store::getObj();
$session_lang = 'en';
if (isset($_GET["process"]) && $_GET["process"] != "") {
    switch ($_GET["process"]) {
        case "logout":
            $api->sLogout();
            break;
        case "UpDateAllBooks":
            $api->UpDateAllBooks();
            break;
        case "UpDateAllStories":
            $api->UpDateAllStories();
            break;
        case "lang":
            if ($_SESSION["stor_lang"] == 'En') {
                $_SESSION["stor_lang"] = 'Ar';
            } else {
                $_SESSION["stor_lang"] = 'En';
            }
            $session_lang = $_SESSION["stor_lang"];
            echo $session_lang;
            break;
    }
}
if (isset($_POST['process'])) {
    switch ($_POST["process"]) {
        case "signin":
            $userid = $api->sLogin($_POST['username'], $_POST['pass'], $_POST['webtocken']);
            if ($userid != false) {
                $token = $api->CreateTokenFireBase($userid, $_POST['webtocken']);
                echo 1;
            } else {
                echo 0;
            }
            break;
        case "changeOfStatusRequest":
            return $api->ChangeOfStatusRequest($_POST['id'], $_POST['status']);
            break;
        case "deleteslider":
            echo $api->DeletSlider($_POST["id"]);
            break;
        case "disableslider":
            echo $api->DisableSlider($_POST["id"]);
            break;
        case "updatesortslider":
            echo $api->UpdateSortSlider($_POST["data"]);
            break;
        case "insertslider":
            echo $api->InsertSlider($_POST["action"]);
            break;
        case "updateallbooks":
            echo $api->UpDateAllBooks();
            break;
    }
}
?>
