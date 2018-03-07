<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
<link rel="stylesheet" href="/public/css/auth/login.css">
<script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>



<style>
    body {
        padding-top: 60px; /* This should be equal to the height of your header */
    }
</style>


<nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Framework Oisain</a>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                <div class="dropdown-menu" aria-labelledby="dropdown01">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
        </ul>
        <?php
        if($this->user->authenticated === false){
        echo "
        <button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#login-modal'>Login</button>
        <button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#Register-modal'>Register</button>
        ";

        }else{
            echo "<span class='navbar-text padd'>Welcome {$this->user->username}</span>
                <form action='/account/logout' class='form-inline my-2 my-lg-0'>
                                    <button class='btn btn-outline-success my-2 my-sm-0' type='submit'>Logout</button>
                </form>
            ";

        }
        ?>

    </div>
</nav>


<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <h1>Login to Your Account</h1><br>
            <form action="/account/login" method="post">
                <input type="text" name="username" placeholder="Username" value="<?php echo  (isset($this->form[0]) ? $this->form[0]: "" )?>">
                <input type="password" name="password" placeholder="Password" value="<?php echo  (isset($this->form[1]) ? $this->form[1]: "" )?>">
                <input type="submit" name="login" class="login loginmodal-submit" value="Login">
            </form>

            <?php
            if ($this->form['negativeFeedback']) {
                echo "
                     <div class='alert alert-danger' role='alert'>
                        <strong>Oh snap!</strong> {$this->form['negativeFeedback']}.
                     </div>";
            }
            ?>

            <div class="login-help">
                <a href="#">Register</a> - <a href="#">Forgot Password</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="Register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="loginmodal-container">
            <h1>Register Account</h1><br>
            <form action="/account/login" method="post">
                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <input type="submit" name="login" class="login loginmodal-submit" value="Login">
            </form>

            <div class="login-help">
                <a href="#">Register</a> - <a href="#">Forgot Password</a>
            </div>
        </div>
    </div>
</div>