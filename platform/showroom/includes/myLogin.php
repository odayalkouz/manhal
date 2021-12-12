<?php

include_once 'db.php';
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
           // $user = preg_replace('/[^A-Za-z0-9]/', '', $user);
            //$pass = preg_replace('/[^A-Za-z0-9]/', '', $pass);
            $Tquery = " SELECT * FROM users WHERE uname='".mysqli_real_escape_string($this->getConObj(),$user) ."' AND password='".mysqli_real_escape_string($this->getConObj(),$pass)."'";
            $temp = $this->makeQuery($Tquery);
            if ($temp->num_rows == 1) {

                 return mysqli_fetch_assoc($temp);
            } else {
                return false;
            }
        }
    }

}