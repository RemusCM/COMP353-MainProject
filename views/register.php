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
    // TODO: Reference proper tables and attributes once creation scripts have been set.
    $branch = $registration->fetchBranchesForForm();
    $option = $registration->fetchOptionsForForm();
}

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
                <label for="register_input_category">Category</label><br>
                <select id="register_input_category" class="login_input" name="category" required>
                    <option value = "Basic">Basic</option>
                    <option value = "Premium">Premium</option>
                    <option value = "Senior">Senior</option>
                    <option value = "Student">Student</option>
                </select>
            </p>
            <p>
                <label for="register_input_branch">Branch</label><br>
                <select id="register_input_level" class="login_input" name="branch" required>
                    <?php foreach($branch as $b) { ?>
                        <option value="<?php echo $b->branch_id ?>"><?php echo $b->area?>, <?php echo $b->city?></option>
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
                <select id="register_input_service" class="login_input" name="account-type" required>
                    <option value = "savings">Saving</option>
                    <option value = "checking">Checking</option>
                </select>            </p>
            <p>
                <label for="register_input_service">Service Type</label><br>
                <select id="register_input_service" class="login_input" name="service-type" required>
                    <option value = "banking">Banking</option>
                    <option value = "investment">Investment</option>
                    <option value = "insurance">Insurance</option>
                </select>
            </p>
            <p>
                <label for="register_input_level">Level of Banking</label><br>
                <select id="register_input_level" class="login_input" name="level" required>
                    <option value = "personal">Personal</option>
                    <option value = "business">Business</option>
                    <option value = "corporate">Corporate</option>
                </select>
            </p>
            <p>
                <label for="register_input_option">Charge Plan Option</label><br>
                <select id="register_input_level" class="login_input" name="charge-plan" required>
                    <?php foreach($option as $o) { ?>
                        <option value="<?php echo $o->opt ?>"><?php echo $o->opt ?></option>
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
