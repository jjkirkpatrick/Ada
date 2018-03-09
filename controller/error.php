<?php
/**
 * Created by PhpStorm.
 * User: josh
 * Date: 09/03/2018
 * Time: 20:25
 */

class error extends controller
{

    public function index()
    {
        $this->view->render('error/index');
    }

}