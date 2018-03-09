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
        $start_time = microtime(TRUE);


        //Create new router object
        $router = new router();

        require 'routes.php';
        //Build the routes from the routes.php file
        //$router->buildRoutes();
        //Load the requested resources
        $router->loadRoute();

        $end_time = microtime(TRUE);

        //die(var_dump($end_time - $start_time));

    }

}