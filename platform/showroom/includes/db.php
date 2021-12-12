<?php
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
        $this->DB['Name'] = "books";
        $this->PerPage = 18;
        $this->pagination = 10;

        $this->URL = 'http://localhost/Manhal/platform/showroom';
      /*  $this->DB['UserName'] = "manhal_database";
        $this->DB['UserPass'] = "?.s}PGf&!8d#";
        $this->DB['Name'] = "manhal_books";
        $this->pagination = 10;
        $this->PerPage = 30;
        $this->URL = 'https://www.manhal.com/platform/showroom/';*/


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
?>