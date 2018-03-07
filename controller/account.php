<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 02/03/2018
 * Time: 08:43 PM
 */

class account extends controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->render("account/login");
    }

    public function login()
    {

        if($this->methodType() == 'POST'){
            $this->postRequest("/account/");
            $this->user->login();
        }else{
            $this->view->render("account/login");
        }
    }

    public function logout()
    {
        $this->user->logout();
    }

    public function register()
    {
        if ($this->methodType() === 'GET') {
            //render the view
            $this->view->render('account/register');
        } else {
            $this->user->register();
        }
    }

    public function recoverPassword()
    {

    }

    public function profile()
    {
        $this->requireAuth();
    }

    public function editprofile()
    {
        $this->requireAuth();
    }


}