<div class="container">
    <div class="row">
        <div class="col">
        </div>
        <div class="col-8">
            <div class="card">
                <div class="card-header">
                    Edit Profile
                </div>
                <?php
                if (isset($this->form['positiveFeedback'])) {
                    echo "
                     <div class='alert alert-success' role='alert'>
                        {$this->form['positiveFeedback']}.
                     </div>";
                }

                if (isset($this->form['negativeFeedback'])) {
                    echo "
                     <div class='alert alert-danger' role='alert'>
                        <strong>Oh snap!</strong> {$this->form['negativeFeedback']}.
                     </div>";
                }
                ?>

                <div class="card-block">
                    <div class="bd-example" data-example-id="">
                        <form class="form-control" action="/profile/edit" method="POST">

                            <input  class="form-control" name="userID" type="hidden"
                                   value="<?php echo $this->user->id ?>">

                            <div class="form-group row">
                                <label for="example-text-input" class="col-4 col-form-label">First name</label>
                                <div class="col-8">
                                    <input class="form-control" name="firstName" type="text"
                                           value="<?php echo $this->user->profile->firstName ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-4 col-form-label">Middle Name</label>
                                <div class="col-8">
                                    <input class="form-control" name="middleName" type="text"
                                           value="<?php echo $this->user->profile->middleName ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-4 col-form-label">Surname</label>
                                <div class="col-8">
                                    <input class="form-control" name="surname" type="text"
                                           value="<?php echo $this->user->profile->surname ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-4 col-form-label">Height</label>
                                <div class="col-8">
                                    <input class="form-control" name="height" type="text"
                                           value="<?php echo $this->user->profile->height ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-4 col-form-label">Weight</label>
                                <div class="col-8">
                                    <input class="form-control" name="weight" type="text"
                                           value="<?php echo $this->user->profile->weight ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-4 col-form-label">systolic Blood
                                    Pressure</label>
                                <div class="col-8">
                                    <input class="form-control" name="systolic" type="text"
                                           value="<?php echo $this->user->profile->systolicBloodPressure ?>">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-4 col-form-label">diastolic Blood
                                    Pressure</label>
                                <div class="col-8">
                                    <input class="form-control" name="diastolic" type="text"
                                           value="<?php echo $this->user->profile->diastolicBloodPressure ?>">
                                </div>
                            </div>
                            <input type="hidden" name="CSRF" value="<?php echo $this->session->getCSRF() ?>">

                            <div class="form-group  row">
                                <div class="offset-sm-5 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
        </div>
    </div>
</div>




