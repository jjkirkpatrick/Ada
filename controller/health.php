<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 08/03/2018
 * Time: 21:05
 */

class health extends controller
{

    public function __construct()
    {
        parent::__construct();
        $this->requireAuth();
    }

    public function index()
    {
        $this->view->render('health/index');
    }


}