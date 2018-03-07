
<div>
    <div class="">
        <div class="loginmodal-container">
            <h1>Register</h1><br>
            <p>Please fill in this form to create an account.</p>
            <form action="/account/register" method="post">
                <input type="text" name="username" placeholder="Username"
                       value="<?php echo(isset($this->form[0]) ? $this->form[0] : "") ?>">
                <input type="text" name="email" placeholder="Email"
                       value="<?php echo(isset($this->form[1]) ? $this->form[1] : "") ?>">
                <input type="password" name="password" placeholder="Password"
                       value="<?php echo(isset($this->form[2]) ? $this->form[2] : "") ?>">
                <input type="password" name="passwordCheck" placeholder="Password"
                       value="<?php echo(isset($this->form[3]) ? $this->form[3] : "") ?>">


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
</div>