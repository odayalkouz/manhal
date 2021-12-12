<?php

trait store_breadcrumblanguage
{
    public function getlang($var)
    {
        if (isset($_SESSION["stor_lang"]) && $_SESSION["stor_lang"] != '') {
            $session_lang = $_SESSION["stor_lang"];
        } else {
            $session_lang = 'En';
        }
        if ($session_lang == '' || $session_lang == '') {
            $session_lang = 'En';
        }
        switch ($var) {
            case 'Dashboard':
                $result = array("En" =>  "Dashboard", "Ar" => 'لوحة التحكم');
                break;
                return json_encode($result[$session_lang]);
                break;
            case 'TotalCustomers':
                $result = array("En" => 'Customers', "Ar" => 'العملاء');
                break;
            case 'CancelledOrders':
                $result = array("En" =>  "Canceled Orders", "Ar" => 'الطلبات الملغاة');
                break;
            case 'CompletedOrders':
                $result = array("En" =>  "Completed Orders", "Ar" => 'الطلبات المكتملة');
                break;
                case 'InProgressOrders':
                $result = array("En" =>  "Orders in Progress", "Ar" => 'الطلبات قيد التجهيز');
                break;
            case 'totalsales':
                $result = array("En" => 'Sales', "Ar" => 'المبيعات');
                break;
            case 'totalsubscriptions':
                $result = array("En" =>  "Subscriptions", "Ar" => 'الاشتراكات');
                break;
            case 'subscriptions':
                $result = array("En" =>  "Subscriptions", "Ar" => 'الاشتراكات');
                break;
            case 'settings':
                $result = array("En" =>  "settings", "Ar" => ' ألأعدادات ');
                break;
            case 'books':
                $result = array("En" =>  "Books", "Ar" => 'Books');
                break;
            case 'groups':
                $result = array("En" =>  "Groups", "Ar" => 'Groups');
                break;
            case 'stories':
                $result = array("En" =>  "Stories", "Ar" => 'Stories');
                break;
            case 'otherproducts':
                $result = array("En" =>  "Other products", "Ar" => 'Other products');
                break;
            case 'Stack':
                $result = array("En" =>  "Stock", "Ar" => 'Stock');
                break;
            case 'OutOfStack':
                $result = array("En" =>  "Out Of Stock", "Ar" => 'Out Of Stock');
                break;
                case 'privacyPolicy':
                $result = array("En" =>  "Privacy Policy", "Ar" => 'Privacy Policy');
                break;
                case 'termsconditions':
                $result = array("En" =>  "Terms and Conditions", "Ar" => 'Terms and Conditions');
                break;
            case 'publishers':
                $result = array("En" =>  "publishers", "Ar" => 'publishers');
                break;
        }

        return str_replace('"', "", json_encode($result[$session_lang], JSON_UNESCAPED_UNICODE));
    }

    public function Sessionlang()
    {
        if (isset($_SESSION["stor_lang"]) && $_SESSION["stor_lang"] != '') {
            $session_lang = $_SESSION["stor_lang"];
        } else {
            $session_lang = 'En';
        }

        return strtolower($session_lang);
    }
}
class Breadcrumbs
{
    use store_breadcrumblanguage;
}
$Breadcrumbs = new Breadcrumbs();

