

<div class="container">
    <div class="header clearfix">

        <div class="jumbotron">
            <h1 class="display-3">
                <?php echo($this->user->profile->firstName != false ? "Welcome {$this->user->profile->firstName} {$this->user->profile->middleName} {$this->user->profile->surname} " : "Not logged in ") ?>
            </h1>
        </div>

    </div>
    <div class="panel panel-info">
        <div class="panel-body">
            <div class="row">
                <div class=" col-md-9 col-lg-9 ">
                    <table class="table table-user-information">
                        <tbody>
                        <tr>
                            <td>First Name:</td>
                            <td><?php echo $this->user->profile->firstName ?></td>
                        </tr>
                        <tr>
                            <td>Middle Name</td>
                            <td><?php echo $this->user->profile->middleName ?></td>
                        </tr>
                        <tr>
                            <td>Surname</td>
                            <td><?php echo $this->user->profile->surname ?></td>
                        </tr>

                        <tr>
                        <tr>
                            <td>Height</td>
                            <td><?php echo $this->user->profile->height ?></td>
                        </tr>
                        <tr>
                            <td>Weight</td>
                            <td><?php echo $this->user->profile->weight ?></td>
                        </tr>
                        <tr>
                            <td>Systolic Blood Pressure</td>
                            <td><?php echo $this->user->profile->systolicBloodPressure ?></td>
                        </tr>
                        <td>Diastolic Blood Pressure</td>
                        <td><?php echo $this->user->profile->diastolicBloodPressure ?></td>
                        <td>
                        </td>

                        </tr>

                        </tbody>
                    </table>

                    <a href="/profile/edit" class="btn btn-primary">Edit profile</a>
                    <a href="/health/" class="btn btn-primary">Check health</a>
                </div>
            </div>
        </div>
    </div>
</div>


