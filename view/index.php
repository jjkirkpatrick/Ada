<?php

?>


<div class="container">
    <div class="header clearfix">

    <div class="jumbotron">
        <h1 class="display-3">
            <?php  echo ($this->user->authenticated != false ? "Welcome {$this->user->username} You are logged in! " :  "Not logged in ")  ?>
        </h1>
        <p class="lead">Cras justo odio, dapibus ac facilisis in, egestas eget quam. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>


        <?php  echo ($this->user->authenticated == false ? "<a class='btn btn-lg btn-success' href='#' role='button' >Sign up today</a>
                                                            <a class='btn btn-lg btn-success' href='#' role='button' data-toggle='modal' data-target='#login-modal'>Login </a>"
                                                            :  "")?>



    </div>
    <div class="row marketing">
        <div class="col-lg-6">
            <h4>Subheading</h4>
            <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

            <h4>Subheading</h4>
            <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

            <h4>Subheading</h4>
            <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>

        <div class="col-lg-6">
            <h4>Subheading</h4>
            <p>Donec id elit non mi porta gravida at eget metus. Maecenas faucibus mollis interdum.</p>

            <h4>Subheading</h4>
            <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Cras mattis consectetur purus sit amet fermentum.</p>

            <h4>Subheading</h4>
            <p>Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
        </div>
    </div>

    <footer class="footer">
        <p>© Company 2017</p>
    </footer>

</div>