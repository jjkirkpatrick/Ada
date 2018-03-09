<?php


//use this as a base to extend controllers from
class controller
{
    public $view;
    //todo Split up the way this is working, too much shit happening in the constructor for the controllers.
    public function __construct()
    {
        //Create an instance of the view class
        //enables controllers to directly access the view class
        $this->session = new session();
        $this->user = new authentication();
        $this->view = new view();
        $this->view->user = $this->user->user;

        $this->view->session = $this->session;
        $this->view->form = $this->session->getFormData();

        //Auto load the model based on the controller name
        //Models must follow the controllernameModel.php format for this to work.
        //alternatively you can specify inside the controller to load a different model.
        $this->model = $this->loadmodel(get_class($this) . "Model");

    }



    public function loadmodel($modelName)
    {
        //Load the model file and create an instance of the class if the file exists
        if (file_exists("model/" . $modelName . ".php")) {
            require "model/" . $modelName . ".php";
            return new $modelName();
        }
    }

    //a helper function that allows controllers to see if a user is authenticated
    //if not redirect to the login view
    public function requireAuth()
    {
        if(!$this->user->user->authenticated){
            $this->view->renderLogin();
            exit();
        }
    }

    //Helper function to allow controllers to check the request method of a request
    public function getRequest(){
        if (!$_SERVER['REQUEST_METHOD'] !== 'GET') {
            http_response_code(405);
            die();
        }
    }

    //Helper function to allow controllers to check the request method of a request
    public function postRequest($redirect)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: '.$redirect);
        }
    }

    //Helper function to allow controllers to check the request method of a request
    public function methodType()
    {
        return $_SERVER['REQUEST_METHOD'];
    }


}
