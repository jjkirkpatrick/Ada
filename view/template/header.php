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

    <div class="collapse navbar-collapse" id="">
        <ul class="navbar-nav mr-auto">
            <?php $this->loadSnippit("/template/header");?>
        </ul>
        <?php
        if($this->user->authenticated === false){
        echo "
        <button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#login-modal'>Login</button>
        <button type='button' class='btn btn-outline-primary' data-toggle='modal' data-target='#Register-modal'>Register</button>
        ";
        }else{
            echo "<span class='navbar-text padd'>Welcome {$this->user->name}</span>
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
        <?php $this->loadSnippit("/auth/login");?>

    </div>
</div>

<div class="modal fade" id="Register-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <?php $this->loadSnippit("/auth/register");?>
    </div>
</div>

