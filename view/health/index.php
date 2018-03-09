<div class="container">
    <div class="header clearfix">

        <div class="jumbotron">
            <h1 class="display-3">
                <?php echo($this->user->profile->firstName != false ? "Hi {$this->user->profile->firstName} Your Health stats are below! " : "Not logged in ") ?>
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
                            <td>BMI</td>
                            <td id="bmi"><?php echo($this->user->profile->weight / ($this->user->profile->height * $this->user->profile->height)) ?></td>
                        </tr>
                        <tr>
                            <td>Systolic Blood Pressure Risk factor</td>
                            <td id="systolic"></td>
                        </tr>
                        <td>Diastolic Blood Pressure Risk factor</td>
                        <td id="diastolic"></td>
                        <td>
                        </td>

                        </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<script>

    function BMI() {
        var height = "<?php echo $this->user->profile->height ?>";
        var weight = "<?php echo $this->user->profile->weight ?>";
        return (weight / (height * height))
    }

    function getSystolicRisk() {
        $systolic = <?php echo $this->user->profile->systolicBloodPressure ?>;

        if ($systolic < 120) {
            return "Normal"
        } else if ($systolic < 129) {
            return "Elevated"
        } else if ($systolic < 139) {
            return "High Blood Pressure Sage 1"
        } else if ($systolic < 140) {
            return "High Blood Pressure Sage 2"
        } else {
            return "High Blood Pressure Sage 3 Seek medical attention"
        }
    }

    function getDiastolicRisk() {
        $diastolic = <?php echo $this->user->profile->diastolicBloodPressure ?>;
        if ($diastolic < 80) {
            return "Normal"
        } else if ($diastolic < 80) {
            return "Elevated"
        } else if ($diastolic < 89) {
            return "High Blood Pressure Sage 1"
        } else if ($diastolic < 90) {
            return "High Blood Pressure Sage 2"
        } else {
            return "High Blood Pressure Sage 3 Seek medical attention"
        }
    }

    $("#bmi").text(Math.round(BMI()));
    $("#systolic").text(getSystolicRisk());
    $("#diastolic").text(getDiastolicRisk());


</script>