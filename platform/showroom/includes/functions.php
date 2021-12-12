<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION["lang"]) || $_SESSION["lang"]==''){
    $_SESSION["lang"]='En';
}
include_once 'language.php';
include_once 'store.php';



class Prosses extends store {
    use store_language;
    private $noPage;
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
    public function GetDataCustomers(){
        $result='';
        $customernum=json_decode($this->GetCustomers($this->GetPage(),$this->GetDate(),$this->GetSearch()), true);
        if(!isset($customernum['number']) || $customernum['number']==''){
            $customernum['number']=0;
        }
        $this->setPages($customernum['number']);
        if($customernum['result']==1){
            $i=1;
            foreach ($customernum['data']  as $key =>$value) {
                $result.= '<tr><th scope="row">'.$i.'</th><td>'.$value['userid'].'</td><td>'.$value['name'].'</td><td>'.$value['email'].'</td><td>'.$value['Phone'].'</td><td>'.$value['Country'].'</td><td>'.$value['purchase'].'</td></tr>';
                $i++;
            }
        }
        return $result;
    }

    public function GetDataSubscriptions(){
        $result='';
        $customernum=json_decode($this->GetSubscriptionCustomers($this->GetPage(),$this->GetDate(),$this->GetSearch()), true);
        if(!isset($customernum['number']) || $customernum['number']==''){
            $customernum['number']=0;
        }
        $this->setPages($customernum['number']);
        if($customernum['result']==1){
            $i=1;
            foreach ($customernum['data']  as $key =>$value) {
                $result.= '<tr><th scope="row">'.$i.'</th><td>'.$value['userid'].'</td><td>'.$value['name'].'</td><td>'.$value['email'].'</td><td>'.$value['Phone'].'</td><td>'.$value['Country'].'</td><td>'.$value['start_date'].'</td><td>'.$value['end_date'].'</td><td>'.$value['purchase'].'</td></tr>';
                $i++;
            }
        }
        return $result;
    }


    public function GetMoreInformationCanceledOrder(){
        $result=json_decode($this->InformationCanceledOrder($_GET['id']), true);
        return $result['data'];

    }
    public function GetAllCanceledOrder(){
        $result='';
        $AllOrders=json_decode($this->GetAllCanceledOrders($this->GetPage(),$this->GetShipping(),$this->GetDate(),$this->GetSearch()), true);
        if(!isset($AllOrders['number']) || $AllOrders['number']==''){
            $AllOrders['number']=0;
        }
        $this->setPages($AllOrders['number']);
        if($AllOrders['result']==1){
            $i=1;
            foreach ($AllOrders['data']  as $key =>$value) {
                $result.= '<tr><th scope="row">'.$i.'</th><td>'.$value['paymentid'].'</td><td>'.$value['name'].'</td><td>'.$value['email'].'</td><td>'.$value['Phone'].'</td><td>'.$value['Country'].'</td>';
                $result.= '<td> <select onchange="changeOfStatusRequest(this);" class="form-control-sm form-control" att="'.$value['paymentid'].'" att_page="cancelled" >   <option value="cancelled">'.$this->getlang('Cancelled').'</option> <option value="pending">'.$this->getlang('inprogress').'</option> </select> </td>';
                $result.= '<td><a class="icons-actions btnmore-cancelled" att_userid="'.$value['userid'].'"   title="'.$this->getlang('MoreDetails').'" att="'.$value['paymentid'].'"      data-toggle="modal" data-target="#exampleModal"><i class="metismenu-icon pe-7s-info"></i></a>';
                $result.= '<a  class="icons-actions btnprintrow" att_userid="'.$value['userid'].'"   title="'.$this->getlang('PrintInvoice').'" att="'.$value['paymentid'].'"><i class="metismenu-icon pe-7s-print"></i></a></td></tr>';
                $i++;
            }
        }
        return $result;
    }
    public function GetMoreInformationCompletedOrder(){
        $result=json_decode($this->InformationCompletedOrder($_GET['id']), true);
        return $result['data'];
    }
    public function GetAllCompletedOrder(){
        $result='';
        $AllOrders=json_decode($this->GetAllCompletedOrders($this->GetPage(),$this->GetShipping(),$this->GetDate(),$this->GetSearch()), true);

        if(!isset($AllOrders['number']) || $AllOrders['number']==''){
            $AllOrders['number']=0;
        }
        $this->setPages($AllOrders['number']);
        if($AllOrders['result']==1){
            $i=1;
            foreach ($AllOrders['data']  as $key =>$value) {
                $result.= '<tr><th scope="row">'.$i.'</th><td>'.$value['paymentid'].'</td><td>'.$value['name'].'</td><td>'.$value['email'].'</td><td>'.$value['Phone'].'</td><td>'.$value['Country'].'</td>';
                $result.= '<td><a class="icons-actions btnmore-completed" att_userid="'.$value['userid'].'"   title="'.$this->getlang('MoreDetails').'" att="'.$value['paymentid'].'" data-toggle="modal" data-target="#exampleModal"><i class="metismenu-icon pe-7s-info"></i></a>';
                $result.= '<a  class="icons-actions btnprintrow" att_userid="'.$value['userid'].'"   title="'.$this->getlang('PrintInvoice').'" att="'.$value['paymentid'].'"><i class="metismenu-icon pe-7s-print"></i></a></td></tr>';
                $i++;
            }
        }
        return $result;
    }
    public function GetAllPendingOrder(){
        $result='';
        $AllOrders=json_decode($this->GetAllPendingOrders($this->GetPage(),$this->GetShipping(),$this->GetDate(),$this->GetSearch()), true);
        if(!isset($AllOrders['number'])||$AllOrders['number']==""){
            $AllOrders['number']=0;
        }
        $this->setPages($AllOrders['number']);
        if($AllOrders['result']==1){
            $i=1;
            foreach ($AllOrders['data']  as $key =>$value) {
                $result.= '<tr><th scope="row">'.$i.'</th><td>'.$value['paymentid'].'</td><td>'.$value['name'].'</td><td>'.$value['email'].'</td><td>'.$value['Phone'].'</td><td>'.$value['Country'].'</td>';
                $result.= '<td> <select onchange="changeOfStatusRequest(this);" class="form-control-sm form-control" att="'.$value['paymentid'].'" att_page="inprogress"> <option value="pending">'.$this->getlang('inprogress').'</option> <option value="inshipping">'.$this->getlang('Inshipping').'</option> <option value="cancelled">'.$this->getlang('Cancelled').'</option> </select> </td>';
                $result.= '<td><a class="icons-actions btnmore-completed" att_userid="'.$value['userid'].'"   title="'.$this->getlang('MoreDetails').'" att="'.$value['paymentid'].'"      data-toggle="modal" data-target="#exampleModal"><i class="metismenu-icon pe-7s-info"></i></a>';
                $result.= '<a class="icons-actions btnprintrow" att_userid="'.$value['userid'].'"   title="'.$this->getlang('PrintInvoice').'" att="'.$value['paymentid'].'"><i class="metismenu-icon pe-7s-print"></i></a></td></tr>';

                $i++;
            }
        }
        return $result;
    }
    public function GetAllInShippingOrder(){
        $result='';
        $AllOrders=json_decode($this->GetAllInShippingOrders($this->GetPage(),$this->GetShipping(),$this->GetDate(),$this->GetSearch()), true);
        if(!isset($AllOrders['number'])||$AllOrders['number']==""){
            $AllOrders['number']=0;
        }
        $this->setPages($AllOrders['number']);
        if($AllOrders['result']==1){
            $i=1;
            foreach ($AllOrders['data']  as $key =>$value) {
                $result.= '<tr><th scope="row">'.$i.'</th><td>'.$value['paymentid'].'</td><td>'.$value['name'].'</td><td>'.$value['email'].'</td><td>'.$value['Phone'].'</td><td>'.$value['Country'].'</td>';
                $result.= '<td> <select onchange="changeOfStatusRequest(this);" class="form-control-sm form-control" att="'.$value['paymentid'].'" att_page="inshipping">  <option value="inshipping">'.$this->getlang('Inshipping').'</option><option value="pending">'.$this->getlang('inprogress').'</option><option value="completed">'.$this->getlang('Completed').'</option>  </select> </td>';
                $result.= '<td><a class="icons-actions btnmore-completed" att_userid="'.$value['userid'].'"   title="'.$this->getlang('MoreDetails').'" att="'.$value['paymentid'].'"      data-toggle="modal" data-target="#exampleModal"><i class="metismenu-icon pe-7s-info"></i></a></td></tr>';
                $i++;
            }
        }
        return $result;
    }
    public function GetinformationOrder(){
        $result=$this->informationOrder($_GET['id']);
        return $result;
    }

    private function setPages($val){
        $this->noPage=$val;
    }
    private function getPages(){
        return $this->noPage;
    }
    public function Pagination()
    {
        $Page=$this->getPages();
        $data = '';
        $prev=$this->GetPage()-$this->pagination;
        if($prev<0){
            $prev=0;
        }
        $next=$this->GetPage()+$this->pagination;
        $current=$this->GetPage();
        if ($Page > 0) {

            if($current>$this->pagination/2){
                $pageBegin=($current-ceil($this->pagination/2))+1;
                if($Page>$this->pagination){
                    $pageEnd=($current+ceil($this->pagination/2))-1;
                }else{
                    $pageEnd=$Page;
                }
            }else{
                $pageBegin=1;
                if($Page>$this->pagination){
                    $pageEnd=$this->pagination;
                }else{
                    $pageEnd=$Page;
                }
            }
            if($pageEnd>$Page){
                $pageEnd=$Page;
                if($Page-$this->pagination+1>0){
                    $pageBegin=$Page-$this->pagination+1;
                }else{
                    $pageBegin=1;
                }
            }
            if($pageBegin>1 && $Page-$pageBegin<$this->pagination-1){
                $pageBegin=1;
            }
            $data ='';
            if($current>5){
                $data = '<li class="page-item"><div att="'.$prev.'" onclick="GotoPage(this);" class="page-link" aria-label="Previous"><span aria-hidden="true">«</span><span class="sr-only">' . $this->getlang('Previous') . '</span></div></li>';
            }
            for ($i =$pageBegin-1; $i <$pageEnd ; $i++) {
                $active='';
                if($i==$this->GetPage()){
                    $active='active';
                }
                $data .= '<li xx="'.$Page.'" class="page-item '.$active.' "><div att="' . $i . '" onclick="GotoPage(this);"    class="page-link">' . ($i + 1) . '</div></li>';
            }
            if($next<$Page){
                $data .= '<li class="page-item"><div att="' . $next . '" onclick="GotoPage(this);" class="page-link" aria-label="Next"><span aria-hidden="true">»</span><span class="sr-only">' . $this->getlang('Next') . '</span></div></li>';
            }

        }
        return $data;
    }
    public function ReverseLang($lang){

        if($lang=='En'){
            $result='Ar';
            $_SESSION["lang"]='Ar';
        }else{
            $result='En';
            $_SESSION["lang"]='En';
        }
        return $result;
    }

    public function GetPage()
    {
        $page = 0;
        if (isset($_GET["page"]) && $_GET["page"] != "") {
            $page = $_GET["page"];
        }
        return $page;
    }
    public function GetShipping()
    {
        $shipping= -1;
        if (isset($_GET["shipping"]) && $_GET["shipping"] != "") {
            $shipping = $_GET["shipping"];
        }
        return $shipping;
    }
    public function GetDate()
    {
        $Date= '2016-01-01 - '.date('Y-m-d');
        if (isset($_GET["date"]) && $_GET["date"] != "") {
            $Date = $_GET["date"];
        }
        return $Date;
    }
    public function GetSearch()
    {
        $search= '';
        if (isset($_GET["search"]) && $_GET["search"] != "") {
            $search = $_GET["search"];
        }
        return $search;
    }
    public function GetGroub()
    {
        $search= '';
        if (isset($_GET["groub"]) && $_GET["groub"] != "") {
            $search = $_GET["groub"];
        }
        return $search;
    }
    public  function GetDashboardStatistic($getdata)
    {

        $result=0;
        switch ($getdata) {
            case 'totlalCustomer':
                $customernum=json_decode($this->totlalCustomer(), true);
                if($customernum['result']==1){
                    $result= $customernum['data'];
                }
                break;
            case 'TotalBookingscompleted':
                $Bookingscompleted=json_decode($this->TotalBookingscompleted(), true);
                if($Bookingscompleted['result']==1){
                    $result=$Bookingscompleted['data'];
                }
                break;
            case 'TotalOrdersinprogress':
                $Bookingscompleted=json_decode($this->TotalOrdersinprogress(), true);
                if($Bookingscompleted['result']==1){
                    $result=$Bookingscompleted['data'];
                }
                break;
            case 'Inshippingorders':
                $Bookingscompleted=json_decode($this->TotalOrdersInshippingorders(), true);
                if($Bookingscompleted['result']==1){
                    $result=$Bookingscompleted['data'];
                }
                break;

            case 'Numberofcanceledrequests':
                $Bookingscompleted=json_decode($this->Numberofcanceledrequests(), true);
                if($Bookingscompleted['result']==1){
                    $result=$Bookingscompleted['data'];
                }
                break;
            case 'Totalsales':
                $Bookingscompleted=json_decode($this->Totalsales(''), true);
                if($Bookingscompleted['result']==1){
                    $result=number_format((float)$Bookingscompleted['data'], 2, '.', '');
                }
                break;
            case 'totalsubscription':
                $Bookingscompleted=json_decode($this->Totalsubscription(''), true);
                if($Bookingscompleted['result']==1){
                    $result=number_format((float)$Bookingscompleted['data'], 2, '.', '');
                }
                break;
            case 'TotalsalesCurrentWeek':
                $sql='and `payment_date` > DATE_SUB(NOW(), INTERVAL 1 WEEK)';
                $Bookingscompleted=json_decode($this->Totalsales($sql), true);
                if($Bookingscompleted['result']==1){
                    $result=number_format((float)$Bookingscompleted['data'], 2, '.', '');
                }
                break;
            case 'TotalsalesCurrentMonth':
                $sql='and `payment_date` > DATE_SUB(NOW(), INTERVAL 1 MONTH)';
                $Bookingscompleted=json_decode($this->Totalsales($sql), true);
                if($Bookingscompleted['result']==1){
                    $result=number_format((float)$Bookingscompleted['data'], 2, '.', '');
                }
                break;
            case 'TotalsalesCurrenToday':
                $sql='and `payment_date` > DATE_SUB(NOW(), INTERVAL 1 DAY)';
                $Bookingscompleted=json_decode($this->Totalsales($sql), true);
                if($Bookingscompleted['result']==1){
                    $result=number_format((float)$Bookingscompleted['data'], 2, '.', '');
                }
                break;

        }
        return $result;
    }
    public  function GetTotalSales()
    {
        $result=0;
                $customernum=json_decode($this->GetTotalSaless($this->GetDate()), true);
                if($customernum['result']==1){
                    $result= $customernum['data'];
                }
        return $result;
    }
    public  function GetTotalSubscription()
    {
        $result=0;
        $customernum=json_decode($this->GetTotalSubscriptions($this->GetDate()), true);
        if($customernum['result']==1){
            $result= $customernum['data'];
        }
        return $result;
    }
    public function GetAllSliders(){
        $result='';
        $Counties=json_decode($this->GetSliders(), true);
        if($Counties['result']==1){
            $data='';
            $i=1;
            foreach ($Counties['data']  as $key =>$value) {

                $active='1';
                $active_text='disable';
                if($value['_delete']==1){
                    $active='0.3';
                    $active_text='Enable';
                }
                $data.='<div class="col-md-3">
                        <div class="main-card mb-3 card card-settings" att_id="'.$value['id'].'" id="slider_'.$value['id'].'" att="'.$value['sort'].'"  style="cursor:move">
                            <img style="opacity:'.$active.'" width="100%" height="100%"  src="'.$value['url'].'" alt="Card image cap" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <div class="slider-text">slider #</div> <div class="slider-number">'.$i.'</div>
                                    <div class="delete" att_id="'.$value['id'].'" title="'.$this->getlang('Delete').'">
                                        <i class="metismenu-icon pe-7s-trash"></i>
                                    </div>
                                    <div att_id="'.$value['id'].'" class="disable" title="<?=$prosses->getlang(\'disable\');?>"> '.$active_text.'</div>
                                </h5>
                            </div>
                        </div>
                    </div>';
                $i++;
            }
            $result=$data;
        }
        return $result;
    }
    public function GetViewSliders(){
        $result='';
        $Counties=json_decode($this->GetSliders(), true);
        if($Counties['result']==1){
            $data='';
            $i=0;
            foreach ($Counties['data']  as $key =>$value) {
                $active='';
                if($i==0){
                    $active='active';
                    $i++;
                }
                $data.=' <div class="carousel-item '.$active.'"><img class="d-block w-100" src="'.$value['url'].'" alt="First slide">
        </div>';
                $i++;
            }
            $result=$data;
        }
        return $result;
    }
    public function GetCuntryOfPurchase(){
    $result='';
    $Counties=json_decode($this->CountriesOfPurchase($this->GetDate()), true);
    if($Counties['result']==1){
      $data='';
        foreach ($Counties['data']  as $key =>$value) {
            $price=number_format((float)$value['total_price'], 0, '.', '');
            $data.= "['".$value['Countr']."', ".$price."],";
        }
        $result=$data;
    }
    return $result;
}
    public function GetCuntryOfSubscription(){
        $result='';
        $Counties=json_decode($this->GetCuntryOfSubscriptions($this->GetDate()), true);
        if($Counties['result']==1){
            $data='';
            foreach ($Counties['data']  as $key =>$value) {
                $price=number_format((float)$value['total_price'], 0, '.', '');
                $data.= "['".$value['Countr']."', ".$price."],";
            }
            $result=$data;
        }
        return $result;
    }
    public function AreYouAllowedIn()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user'] == '' || !isset($_SESSION['user']['permission'])) {
            $this->sLogout();
            header('Location:'.$this->URL.'/login.php');
            exit();
        }

    }


    //get data from PRESTOSOFT API
    public function GetGroub_PRESTOSOFT(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://85.159.220.130/API/api.php?process=getallgroup&search=".$this->GetSearch()."&page=".$this->GetPage(),
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
        $page=$this->GetPage();
        $page_count = ceil($data['number'] / $this->PerPage);

        if ($page > $page_count) {
            $page = $page_count;
        } else if ($page < 0) {
            $page = 0;
        }
        $this->setPages($page_count);
        if($data['result']==1){
            $i=($page*18);

            foreach ($data['data']  as $key =>$value) {
                $No=$value['GROUP_NO'];
                $name_ar=$value['GROUP_NAME'];
                $name_en=$value['GROUP_NAME_ENG'];
                $result.='<tr> <td>'.$i.'</td> <td>'.$No.'</td> <td>'.$name_ar.'</td> <td>'.$name_en.'</td> </tr>';
                $i++;
            }
        }
        return $result;
    }
    public function GetGroub_Filter_PRESTOSOFT(){
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://85.159.220.130/API/api.php?process=getallgroup_Filter",
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
        $grpub=$this->GetGroub();
        $selected='';
        if($grpub==''){
            $grpub='';
            $selected='selected';
        }

        $result='<option '.$selected.' value="">all</option>';
        $data=json_decode($response, true);
        if($data['result']==1){

            foreach ($data['data']  as $key =>$value) {
                $No=$value['GROUP_NO'];
                $selected='';

               if($grpub==$No){
                    $selected='selected';
                }

                $name_ar=$value['GROUP_NAME'];
                $name_en=$value['GROUP_NAME_ENG'];
                $result.='<option '.$selected.' value="'.$No.'">'.$name_en.'</option>';
            }
        }
        return $result;
    }
    public function GetStockBook_PRESTOSOFT($ACTIVE){

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://85.159.220.130/API/api.php?process=getproduct&search=".$this->GetSearch()."&page=".$this->GetPage()."&groub=".$this->GetGroub()."&ACTIVE=".$ACTIVE,
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
        $page=$this->GetPage();
        $page_count = ceil($data['number'] / 18);

        $this->setPages($page_count);
        if($data['result']==1){
            $i=($page*18);
            foreach ($data['data']  as $key =>$value) {

                $image=str_replace("P:","http://85.159.220.130/API",$value['IMAGE_PATH']);
                if($image==""){
                    $image="../slider/cover5.jpg";
                }
                $SUB_DESC=str_replace('"',"",$value['SUB_DESC']);
                $result.='<tr>
                            <td att="'.$image.'">'.$i.'</td>
                            <td>
                                <div class="widget-content p-0">
                                    <div class="widget-content-wrapper">
                                        <div class="widget-content-left mr-3">
                                            <div class="widget-content-left">
                                                <img width="40" class="preview" src="'.$image.'" alt="'.$SUB_DESC.'">
                                            </div>
                                        </div>
                                        <div class="widget-content-left flex2">
                                            <div class="widget-heading text-left">'.$SUB_DESC.'</div>
                                        </div>
                                    </div>
                                </div>

                            </td>
                            <td>'.$value['COUNT'].'</td>
                            <td>'.$value['WEIGHT'].'</td>
                            <td>'.$value['C_SUB'].'</td>
                            <td>$'.$value['ONE_PRICE'].'</td>
                           
                        </tr>';
                $i++;
            }
        }
        return $result;
    }







}











$prosses = Prosses::getObj();
?>