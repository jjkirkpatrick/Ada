<?php
/**
 * Created by PhpStorm.
 * User: JKirkpatrick
 * Date: 07/03/2018
 * Time: 13:17
 */



class session
{

    public function __construct()
    {
        if (session_id() == '') {
            session_start();
        }
    }

    public function add($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function remove($key, $value)
    {
        unset($_SESSION[$key][$value]);
    }

    public function get($key, $value)
    {
        return $_SESSION[$key][$value];
    }

    public function exists($key, $value){
        return (isset($_SESSION[$key][$value]) ? true : false);
    }

    public function destorySession()
    {
        session_destroy();
    }

    public function dumpSession()
    {
        return $_SESSION;
    }

    public function getSessionArray($key)
    {
        return $_SESSION[$key];
    }

    public function setFormSession($array)
    {
        $_SESSION['form'][$array];
    }

    public function getFormData()
    {
        $data =  (isset($_SESSION['form']) ? $this->getSessionArray('form') :  null);
        unset($_SESSION['form']);
        return $data;
    }

    //todo This should be moved in to a security classW
    public function getCSRF()
    {
        if (isset($_SESSION['CSRF']) && $_SESSION['CSRF']['Expiry'] > date("Y-m-d H:i:s")) {
            return $_SESSION['CSRF']['Token'];
        }else{
            $_SESSION['CSRF'] = array(
                'Token' => base64_encode(openssl_random_pseudo_bytes(32)),
                'Expiry' => date("Y-m-d H:i:s", strtotime("+1 hours"))
            );
            return $_SESSION['CSRF']['Token'];
        }
    }

    public function checkCSRF($csrf)
    {
        if ($csrf === $_SESSION['CSRF']['Token']) {
            return true;
        }else{
            return false;
        }
    }


}