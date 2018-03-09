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
    private $routes = array(
        'GET' => array(),
        'POST' => array(),
    );
    //Variable to store the URI values
    private $uri;

    public function __construct()
    {
        //Host is assigned to the domain
        $this->host = $_SERVER['HTTP_HOST'];
    }


    public function get($route)
    {
        if (is_array($route)) {
            $_uri = (isset($route['_url']) ? preg_replace('{/$}', '', $route['_url']) : null);
            $_uri = (isset($_uri) ? preg_replace('(\[:host\])', $this->host, $_uri) : null);

            $r = array(
                'uri' => $_uri,
                'controller' => (isset($route['controller']) ? $route['controller'] : null),
                'action' => (isset($route['action']) ? $route['action'] : null)
            );

            //Push the altered route to the routes array
            array_push($this->routes['GET'], $r);

        }

    }


    public function post($route)
    {
        if (is_array($route)) {
            $_uri = (isset($route['_url']) ? preg_replace('{/$}', '', $route['_url']) : null);
            $_uri = (isset($_uri) ? preg_replace('(\[:host\])', $this->host, $_uri) : null);

            $r = array(
                'uri' => $_uri,
                'controller' => (isset($route['controller']) ? $route['controller'] : null),
                'action' => (isset($route['action']) ? $route['action'] : null)
            );

            //Push the altered route to the routes array
            array_push($this->routes['POST'], $r);
        }

    }


    public function invalid($route)
    {
        if (is_array($route)) {
            $_uri = (isset($route['_url']) ? preg_replace('{/$}', '', $route['_url']) : null);
            $_uri = (isset($_uri) ? preg_replace('(\[:host\])', $this->host, $_uri) : null);

            $r = array(
                'uri' => $_uri,
                'controller' => (isset($route['controller']) ? $route['controller'] : null),
                'action' => (isset($route['action']) ? $route['action'] : null)
            );

            //Push the altered route to the routes array
            $this->routes['invalidRoute'] = $r;
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

            if (isset($url[1])) {
                for ($i = 2; $i < $count; $i++) {
                    array_push($vars, $url[$i]);
                }
            }

            $this->uri = [
                'controller' => (isset($url[0]) ? $url[0] : null),
                'action' => (isset($url[1]) ? $url[1] : null),
                'var' => (isset($vars[1]) ? $vars : null),
            ];
        }
    }


    public function loadRoute()
    {
        $this->constructURIArray();

        if ($this->uri) {
            foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $key => $value) {
                if ($value['uri'] == ($this->host . '/' . $this->uri['controller'] . (isset($this->uri['action']) ? '/' . $this->uri['action'] : null))) {

                    //load the controller for the route
                    require "controller/" . $value['controller'] . '.php';
                    $controller = new $value['controller']();
                    //if an action is set, test if it exists in the controller and call it, else call index
                    if (isset($value['action'])) {
                        if (method_exists($controller, $value['action'])) {
                            $controller->{$value['action']}($this->uri['var']);
                        } else {
                            $controller->{"index"}();
                        }
                        //if controller is set but no method go the index of the controller.
                    } else {
                        $controller->{"index"}();
                    }
                    //found match
                    die();
                }
            }
            if(isset($this->routes['invalidRoute'])){
                require "controller/" . $this->routes['invalidRoute']['controller'] . '.php';
                $controller = $this->routes['invalidRoute']['controller'];
                $controller = new $controller();
                if (isset($this->routes['invalidRoute']['action'])){
                    $action = $this->routes['invalidRoute']['action'];
                    $controller->$action();
                }else{
                    $controller->index();
                }
            }
        } else {
            require "controller/index.php";
            //create an instance of the controller and call the index function
            $controller = new index();
            $controller->index();
        }

    }
}
