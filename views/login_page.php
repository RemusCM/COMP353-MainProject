<?php
// show potential errors / feedback (from login object)
if (isset($login)) {
    if ($login->errors) {
        foreach ($login->errors as $error) {
            echo $error;
        }
    }
    if ($login->messages) {
        foreach ($login->messages as $message) {
            echo $message;
        }
    }
}
?>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
<!-- register form -->
<div class="col-md-12 well" style="position:absolute; top:10%; left:40%; width:20%;">
    <!-- login form -->
    <form method="post" action="index.php" name="loginform" class="form-horizontal">
            <fieldset>
                <legend>Login:</legend>
                <p>
                    <label for="login_input_username">Client Card Number</label>
                    <input id="login_input_username" class="login_input" type="text" name="client_id" required />
                </p>
                <p>
                    <label for="login_input_password">Password</label>
                    <input id="login_input_password" class="login_input" type="password" name="password" autocomplete="off" required />
                </p>
            </fieldset>
        <div style="margin-top:20px;float:left">
            <a href="register.php">Register</a>

        </div>
            <div style="margin-top:20px; float:right">
                <input type="submit"  name="login" value="Log in" />
            </div>

    </form>


</div>


</body>
</html>

