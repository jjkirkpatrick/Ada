<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 02/03/2018
 * Time: 09:07 PM
 */

class view
{

    //Render the view via a file name
    public function render($filename)
    {
            //load the view file
            require "view/" . $filename . '.php';
    }


    //helper view function for calling the login page directly
    public function renderLogin()
    {
        require "view/account/login.php";
    }
}