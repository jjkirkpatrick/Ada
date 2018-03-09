<div class="">
    <div class="loginmodal-container">
        <h1>Login to Your Account</h1><br>

        <?php
        if (isset($this->form['positiveFeedback'])) {
            echo "
                     <div class='alert alert-success' role='alert'>
                        {$this->form['positiveFeedback']}.
                     </div>";
        }
        ?>

        <form action="/account/login" method="post">
            <input type="text" name="username" placeholder="Username"
                   value="<?php echo(isset($this->form[0]) ? $this->form[0] : "") ?>">
            <input type="password" name="password" placeholder="Password"
                   value="<?php echo(isset($this->form[1]) ? $this->form[1] : "") ?>">
            <input type="hidden" name="CSRF" value="<?php echo $this->session->getCSRF() ?>">
            <input type="submit" name="login" class="login loginmodal-submit" value="Login">
        </form>
        <?php
        if (isset($this->form['negativeFeedback'])) {
            echo "
                     <div class='alert alert-danger' role='alert'>
                        <strong>Oh snap!</strong> {$this->form['negativeFeedback']}.
                     </div>";
        }
        ?>
        <div class=\"login-help\">
            <a href=\"#\">Register</a> - <a href=\"#\">Forgot Password</a>
        </div>
    </div>
</div>

