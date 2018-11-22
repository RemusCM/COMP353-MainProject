<?php

?>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <style type="text/css">
        td, th { padding:5px 15px 0 15px; }
    </style>
</head>
<html>
Hey, <?php echo $_SESSION['client_id']; ?>. You are logged in.<br>
You joined <?php echo $_SESSION['joining_date']; ?>.<br>
Try to close this browser tab and open it again. Still logged in! ;)
</html>
