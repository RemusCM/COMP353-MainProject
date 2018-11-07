<?php
// show potential errors / feedback (from registration object)
if (isset($registration)) {
    if ($registration->errors) {
        foreach ($registration->errors as $error) {
            echo $error;
        }
    }
    if ($registration->messages) {
        foreach ($registration->messages as $message) {
            echo $message;
        }
    }
}

// TODO: Need to fetch the branches available from DB to present as options.
$branch = array (
    1=>"TestBranch1",
    2=>"TestBranch2",
);

$option = array (
    1=>"TestOption1",
    2=>"TestOption2",
);
?>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<!-- register form -->
<div class="col-md-12 well" style="position:absolute; top:10%; left:30%; width:40%;">
<!-- register form -->
<form method="post" action="register.php" name="registerform" class="form-horizontal">
<div class="row" style="padding:20px;">
    <div class="col-md-6 form-group">
        <fieldset>
            <legend>Personal information:</legend>
            <p>
                <label for="register_input_name">Name</label><br>
                <input id="register_input_name" class="login_input" type="text" pattern="^[a-zA-Z]+( [a-zA-Z]+)*$" name="name" required />
            </p>
            <p>
                <label for="register_input_dob">Date of Birth</label><br>
                <input id="register_input_dob" class="login_input" type="date" name="dob" required />
            </p>
            <p>
                <label for="register_input_address">Address</label><br>
                <input id="register_input_address" class="login_input" type="text" pattern="^\w+( \w+)*$" name="address" required />
            </p>
            <p>
                <label for="register_input_phone">Phone Number</label><br>
                <input id="register_input_phone" class="login_input" type="tel" pattern="[1-9]\d{2}-\d{3}-\d{4}" name="phone" required />
            </p>
            <p>
                <label for="register_input_email">Email</label><br>
                <input id="register_input_email" class="register_input" type="email" name="email" required />
            </p>
            <p>
                <label for="register_input_password_new">Password (min. 6 characters)</label><br>
                <input id="register_input_password_new" class="register_input" type="password" name="password_new" pattern=".{6,}" required autocomplete="off" />
            </p>
            <p>
                <label for="register_input_password_repeat">Repeat password</label><br>
                <input id="register_input_password_repeat" class="register_input" type="password" name="password_repeat" pattern=".{6,}" required autocomplete="off" />
            </p>
            <p>
                <label for="register_input_branch">Branch</label><br>
                <select id="register_input_level" class="login_input" name="branch" required>
                    <?php foreach($branch as $key => $value) { ?>
                        <option value="<?php echo $key ?>"><?php echo $value ?></option>
                    <?php }?>
                </select>
            </p>
        </fieldset>
    </div>
    <div class="col-md-6 form-group">
        <fieldset>
            <legend>Account information:</legend>
            <p>
                <label for="register_input_acc_type">Account Type</label><br>
                <select id="register_input_service" class="login_input" name="acc_type" required>
                    <option value = "Saving">Saving</option>
                    <option value = "Checking">Checking</option>
                    <option value = "Foreign Exchange">Foreign Exchange</option>
                </select>            </p>
            <p>
                <label for="register_input_service">Service Type</label><br>
                <select id="register_input_service" class="login_input" name="service" required>
                    <option value = "Banking">Banking</option>
                    <option value = "Investment">Investment</option>
                    <option value = "Insurance">Insurance</option>
                </select>
            </p>
            <p>
                <label for="register_input_level">Level of Banking</label><br>
                <select id="register_input_level" class="login_input" name="level" required>
                    <option value = "Personal">Personal</option>
                    <option value = "Business">Business</option>
                    <option value = "Corporate">Corporate</option>
                </select>
            </p>
            <p>
                <label for="register_input_option">Charge Plan Option</label><br>
                <select id="register_input_level" class="login_input" name="option" required>
                    <?php foreach($option as $key => $value) { ?>
                        <option value="<?php echo $key ?>"><?php echo $value ?></option>
                    <?php }?>
                </select>
            </p>
        </fieldset>
    </div>


</div>
    <div>
        <input type="submit"  name="register" value="Register" />
    </div>
</form>
    <!-- backlink -->
    <a href="index.php">Back to Login Page</a>

</div>


</body>
</html>
