<?php
/**
 * Created by PhpStorm.
 * User: Josh
 * Date: 02/03/2018
 * Time: 08:43 PM
 */

class account extends controller
{

    public function index()
    {
        $this->view->render("account/login");
    }

    public function login()
    {
        //Require that only post requests hit /account/login
        //if anything other than post redirect to /accout/
        $this->postRequest("/account/");
#
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
                    $_SESSION['userID'] = $user[0]['id'];
                    $_SESSION['userName'] = $user[0]['name'];
                    $_SESSION['userEmail'] = $user[0]['email'];
                    header('Location:/');
                } else {
                    //exit if the password isn't correct
                    die("invlid password");
                }
            } else {
                //exit if the username isn't correct
                die("Invalid username");
            }
        }
    }

    public function logout()
    {
        //destory the session upon logging out
        session_destroy();
        //redirect to the root of the app
        header('Location:/');
    }

    public function register()
    {
        //Check if the user wants the register page or to submit a register request
        if ($this->methodType() === 'GET') {
            //render the view
            $this->view->render('account/register');
        } else {
            //Check to make sure the post variables have been set
            if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['passwordCheck'])) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $passwordCheck = $_POST['passwordCheck'];
                //Check that both passwords provided are matching
                if ($password === $passwordCheck) {
                    //request the user $username, if nothing is returned then the username is userable
                    if ($this->model->getUser($username) == false) {
                        //insert the data in to the database
                        if($this->model->insertUser($username, password_hash($password,PASSWORD_DEFAULT ))){
                            print_r("create Success");
                        }else{
                            print_r("unable to create");
                        }
                    } else {
                        //exit if the user does not exist
                        die("user Exists");
                    }
                } else {
                    //exit if the passwords don't match
                    die("passwords don't match");
                }
            } else {
                //exit if the fields are not set correctly
                die("invalid not all fields set");
            }
        }
    }

    public function recoverPassword()
    {

    }

    public function profile()
    {
        $this->requireAuth();
    }

    public function editprofile()
    {
        $this->requireAuth();
    }


}