<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 02/03/2018
 * Time: 08:24 PM
 */


class app
{

    public function __construct()
    {


        //Create new router object
        $router = new router();
        //Build the routes from the routes.php file
        $router->buildRoutes();
        //Load the requested resources
        $router->loadRoute();


    }

}