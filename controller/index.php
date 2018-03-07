<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 02/03/2018
 * Time: 08:53 PM
 */

class index extends controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $this->view->render('index');
    }

}