<?php
session_start();

$connect = mysqli_connect("localhost", "root","","testAccount");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$client_id = $_SESSION['client_id'];

$sql= "SELECT * FROM account WHERE client_id = '$client_id';";

$personalAccounts = array();
$businessAccounts = array();
$corporateAccounts = array();
$sqlResult= mysqli_query($connect,$sql);

while($row = mysqli_fetch_object($sqlResult)) {
    if($row){


    }

    //array_push($options, $row);
}



?>

<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<div class="card m-b-20">
    <div class="card-body">

    <h1>Your Accounts</h1>
    <p>On this page, you will find a list of all the accounts that you have created. They are divided by levels; Personal, Business, Corporate.
        <br>
        You can also click on "details" on any account to see further details.</p>

        <div class = "form-group"><h2><u>Personal Accounts</u></h2>

        </div>
        <div class = "form-group"><h2><u>Business Accounts</u></h2>

        </div>
        <div class = "form-group"><h2><u>Corporate Accounts</u></h2>

        </div>

    </div>
</div>

</body>
</html>
