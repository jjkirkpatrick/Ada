<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 03/03/2018
 * Time: 04:21 PM
 */

class router
{
    //variable to store domain
    private $host;
    //Array storing the processed routes
    private $routes = array();
    //Variable to store the URI values
    private $uri;

    public function __construct()
    {
        //Host is assigned to the domain
        $this->host = $_SERVER['HTTP_HOST'];
    }


    public function buildRoutes()
    {
        //Load the routes.php file if it exists
        //routes.php has the routes of the application.
        if (file_exists("core/routes.php")) {
            require "core/routes.php";
        } else {
            exit("cant find routes");
        }

        //for each route in the file
        foreach ($routes as $r) {
            //for each line replace the wildcard {h} with the value of $this->host
            //this allows routes to work on any domain easily
            $new_route = preg_replace('/{h}/', $this->host, $r);
            //Push the altered route to the routes array
            array_push($this->routes, $new_route);
        }
    }


    public function constructURIArray()
    {

        //If the url is actually set
        if (isset($_GET['url'])) {
            //remore any trailing slashes
            $url = rtrim($_GET['url'], '/');
            //you may want to check that the url is valid asin doesn't contain any invalid characters
            //explode the url in to chunks
            $url = explode('/', $url);
            //assign the chunks to be the controller and the action in the controller
            $count = (isset($url) ? count($url) : 0);
            $vars = array();

            if(isset($url[1])){
                for ($i = 2; $i < $count ; $i++) {
                    array_push($vars, $url[$i]);
                }
            }

            $this->uri = [
                'controller' => (isset($url[0]) ? $url[0] : null),
                'action' => (isset($url[1]) ? $url[1] : null),
                'var' => (isset($vars[1]) ? $vars: null),
            ];
        }
    }


    public function loadRoute()
    {
        $this->constructURIArray();

        print_r($this->host . '/' . $this->uri['controller'] . (isset($this->uri['action']) ? '/' . $this->uri['action'] : null));

        //If the controller chunk of the URI is not set then go to the index page
        //equivalent of index/index
        if ($this->uri['controller'] == '') {
            //load the controller
            require "controller/index.php";
            //create an instance of the controller and call the index function
            $controller = new index();
            $controller->index();
            //if the controller chunk is set check the constructed URI with the valid built routes.
        } elseif (in_array($this->host . '/' . $this->uri['controller'] . (isset($this->uri['action']) ? '/' . $this->uri['action'] : null), $this->routes)) {
            //load the controller for the route
            require "controller/" . $this->uri['controller'] . '.php';
            $controller = new $this->uri['controller']();
            //if an action is set, test if it exists in the controller and call it, else call index
            if (isset($this->uri['action'])) {
                if (method_exists($controller, $this->uri['action'])) {
                    $controller->{$this->uri['action']}($this->uri['var']);
                } else {
                    $controller->{"index"}();
                }
                //if controller is set but no method go the index of the controller.
            } else {
                $controller->{"index"}();
            }
            //if the route is not valid end the application
        } else {
            die(" invalid route");
        }


    }


}