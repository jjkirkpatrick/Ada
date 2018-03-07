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
        //Create Session if non exist
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


}