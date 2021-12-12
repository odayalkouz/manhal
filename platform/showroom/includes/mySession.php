<?php

include_once 'myLogin.php';
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
        if ($User!=false) {
            if($User['permession']==1 || $User['permession']==7 || $User['permession']==2){
                $_SESSION['user'] = [];
                $_SESSION['user']['username'] = $user;
                $_SESSION['user']['password'] = $pass;
                $_SESSION['user']['permission'] = $User['permession'];
                if ($_SESSION["lang"] == 'Ar') {
                    $_SESSION["lang"] = 'En';
                } else {
                    $_SESSION["lang"] = 'En';
                }

                $session_lang = $_SESSION["lang"];
                return $User['userid'];
            }else{
                return false;
            }

        } else return false;
    }

    public function sLogout()
    {
        $_SESSION['user'] = [];
        if (isset($_SESSION['user'])) unset($_SESSION['user']);
    }

    public function checkSLogin()
    {
        if (isset( $_SESSION['user']['username']) and isset( $_SESSION['user']['password'])) {
            if ($this->login( $_SESSION['user']['username'],  $_SESSION['user']['password']))
                return true;
            else
                return false;
        } else return false;
    }
}