<?php
/**
 * Created by PhpStorm.
 * User: JKirkpatrick
 * Date: 07/03/2018
 * Time: 10:00
 */


//this class will now automatically load all user variables and all profile variables dynamically.


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
        return $this->user;
    }


    private function buildUser()
    {
        $this->user = new stdclass();
        $this->user->authenticated = ($this->session->exists('user', 'id') ? true : false);
        if ($this->user->authenticated) {
            foreach ($this->session->getSessionArray('user') as $key => $value) {
                if ($key != 'password') {
                    $this->user->$key = ($value ? $value : '');
                }
            }

            $this->user->profile = new stdClass();
            foreach ($this->session->getSessionArray('user.profile') as $key => $value) {
                if (isset($key) && isset($value)){
                    $this->user->profile->$key = (isset($value) ? $value : "");
                }
            }
        }
    }

    public function login()
    {
        //Check to see if the post variables have been set
        if (isset($_POST['username']) and isset($_POST['password'])) {
            $username = $_POST['username'];
            $password = $_POST['password'];
            if ($this->session->checkCSRF($_POST['CSRF'])) {
                //get the user via the username provided in the post request
                $user = $this->model->getUser($username);
                //if the user exists
                if ($user['name']) {
                    //verify the password
                    if (password_verify($password, $user['password'])) {
                        //set the required session variables

                        $u = array();
                        foreach ($user as $key => $value) {
                            $u[$key] = $value;
                        }

                        $p = array();
                        foreach ($this->model->getProfile($username) as $key => $value) {
                            $p[$key] = $value;
                        }

                        $this->session->add("user", $u);
                        $this->session->add("user.profile", $p);

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
            } else {
                //if the CSRF failed then just send the user back to the form, possiable that the csrf token
                // can expire between page load and submit.
                $this->session->add("form", array(
                    $username,
                    $password,
                    'negativeFeedback' => "Error occurred, please try again."
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

            if ($this->session->checkCSRF($_POST['CSRF'])) {
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
                $this->session->add("form", array(
                    $username,
                    $email,
                    $password,
                    $password,
                    'negativeFeedback' => "Error occurred. Please try again."
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


    public function editProfile()
    {
        $userID = (isset($_POST['userID']) ? $_POST['userID'] : "");
        $firstName = (isset($_POST['firstName']) ? $_POST['firstName'] : "");
        $middleName = (isset($_POST['middleName']) ? $_POST['middleName'] : "");
        $surname = (isset($_POST['surname']) ? $_POST['surname'] : "");
        $height = (isset($_POST['height']) ? $_POST['height'] : "");
        $weight = (isset($_POST['weight']) ? $_POST['weight'] : "");
        $systolic = (isset($_POST['systolic']) ? $_POST['systolic'] : "");
        $diastolic = (isset($_POST['diastolic']) ? $_POST['diastolic'] : "");

        if ($this->session->checkCSRF($_POST['CSRF'])) {
            //Check that both passwords provided are matching
            //request the user $username, if nothing is returned then the username is usable
            $updated = $this->model->updateProfile(
                $this->user->name,
                $userID,
                $firstName,
                $middleName,
                $surname,
                $height,
                $weight,
                $systolic,
                $diastolic
            );

            if ($updated) {
                $this->session->add("form", array(
                    'positiveFeedback' => "Profile Updated"
                ));
                $this->regenerateUser();
                header('Location:/profile/edit');
            } else {
                $this->session->add("form", array(
                    'negativeFeedback' => "Unable to update profile. Did you change any values?"
                ));
                header('Location:/profile/edit');
            }
        }
    }


    public function regenerateUser()
    {
        $u = array();
        foreach ($user = $this->model->getUser($this->user->name) as $key => $value) {
            $u[$key] = $value;
        }

        $p = array();
        foreach ($this->model->getProfile($this->user->name) as $key => $value) {
            $p[$key] = $value;
        }

        $this->session->add("user", $u);
        $this->session->add("user.profile", $p);
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

