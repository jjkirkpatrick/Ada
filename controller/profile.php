<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 08/03/2018
 * Time: 19:22
 */

class profile extends controller
{

    public function __construct()
    {
        parent::__construct();
        $this->requireAuth();
    }


    public function index()
    {
        $this->view->render("profile/index");
    }

    public function edit()
    {
            $this->view->render("profile/edit");
    }

    public function submitEdit()
    {
        $this->user->editProfile();
    }
}
