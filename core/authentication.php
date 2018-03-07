<?php
/**
 * Created by PhpStorm.
 * User: JKirkpatrick
 * Date: 07/03/2018
 * Time: 10:00
 */

class authentication
{
    private $model;
    private $session;
    public $user;


    public function __construct()
    {
        $this->model = $this->loadmodel();
        $this->session = new session();
        $this->buildUser();
    }


    private function buildUser()
    {
        $this->user = new stdclass();
        $this->user->authenticated = ($this->session->exists('user', 'userid') ? true : false);
        if ($this->user->authenticated) {
            $this->user->userID = ($this->session->exists('user', 'userid') ? $this->session->get('user', 'userid') : null);
            $this->user->username = ($this->session->exists('user', 'username') ? $this->session->get('user', 'username') : null);
            $this->user->email = ($this->session->exists('user', 'useremail') ? $this->session->get('user', 'useremail') : null);
        }
    }


    public function login()
    {
        //Check to see if the post variables have been set
        if (isset($_POST['username']) and isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            //get the user via the username provided in the post request
            $user = $this->model->getUser($username);
            //if the user exists
            if ($user[0]['name']) {
                //verify the password
                if (password_verify($password, $user[0]['password'])) {
                    //set the required session variables
                    $this->session->add("user", array(
                        'userid' => $user[0]['id'],
                        'username' => $user[0]['name'],
                        'useremail' => $user[0]['email']
                    ));
                    header('Location:/');
                } else {
                    //exit if the password isn't correct
                    $this->session->add("form", array(
                        $username,
                        $password,
                        'negativeFeedback' => "Password not recognized"
                    ));
                    header('Location:/account/login');
                }
            } else {
                //exit if the password isn't correct
                $this->session->add("form", array(
                    $username,
                    $password,
                    'negativeFeedback' => "Username not recognized"
                ));
                header('Location:/account/login');
            }
        }
    }

    public function register()
    {
//Check if the user wants the register page or to submit a register request

        //Check to make sure the post variables have been set
        if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['passwordCheck']) and isset($_POST['email'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $passwordCheck = $_POST['passwordCheck'];
            $email = $_POST['email'];
            //Check that both passwords provided are matching
            if ($password === $passwordCheck) {
                //request the user $username, if nothing is returned then the username is userable
                if ($this->model->getUser($username) == false) {
                    //insert the data in to the database
                    if ($this->model->insertUser($username, password_hash($password, PASSWORD_DEFAULT), $email)) {
                        $this->session->add("form", array(
                            'positiveFeedback' => "Account created successfully"
                        ));
                        header('Location:/account/login');
                    } else {
                        $this->session->add("form", array(
                            $username,
                            $email,
                            $password,
                            $password,
                            'negativeFeedback' => "Unknown Error Try again later"
                        ));
                        header('Location:/account/register');
                    }
                } else {
                    //exit if the user does not exist
                    $this->session->add("form", array(
                        $username,
                        $email,
                        $password,
                        $password,
                        'negativeFeedback' => "Username taken!"
                    ));
                    header('Location:/account/register');
                }
            } else {
                //exit if the passwords don't match
                $this->session->add("form", array(
                    $username,
                    $email,
                    $password,
                    $password,
                    'negativeFeedback' => "Passwords do not match!"
                ));
                header('Location:/account/register');
            }
        } else {
            //exit if the fields are not set correctly
            $this->session->add("form", array(
                (isset($_POST['username']) ? $_POST['username'] : ""),
                (isset($_POST['email']) ? $_POST['email'] : ""),
                (isset($_POST['password']) ? $_POST['password'] : ""),
                (isset($_POST['passwordCheck']) ? $_POST['passwordCheck'] : ""),
                'negativeFeedback' => "Please Enter all fields"
            ));
            header('Location:/account/register');
        }
    }


    public function logout()
    {
        //destory the session upon logging out
        session_destroy();
        //redirect to the root of the app
        header('Location:/');
    }


    private function loadModel()
    {
        //Load the model file and create an instance of the class if the file exists
        if (file_exists("model/auth/authModel.php")) {
            require "model/auth/authModel.php";
            return new authModel();
        }
    }


}

