<?php


require_once("config/db.php");


require_once("classes/Login.php");
session_start();


// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER,DB_PASS,DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


//Here are the queries to use for transferring money from an account to another.
//From: All accounts except foreign currency and Mortgage type loans, and loans and credits balance<lent limit
//From Checkings accounts query
$sql_checking_from = "SELECT DISTINCT checking.account_number, balance, account_type FROM account, checking WHERE client_id = '" . $_SESSION['client_id'] . "' AND checking.account_number = account.account_number AND balance > 0.00;";
$result_checking_from = $conn->query($sql_checking_from);

//From Savings accounts query
$sql_savings_from = "SELECT DISTINCT savings.account_number, balance, account_type FROM account, savings WHERE client_id = '" . $_SESSION['client_id'] . "' AND savings.account_number = account.account_number AND balance>0.00;";
$result_savings_from = $conn->query($sql_savings_from);

//From Credit accounts query
$sql_credit_from = "SELECT DISTINCT credit.account_number, balance, account_type FROM account, credit WHERE client_id = '" . $_SESSION['client_id'] . "' AND credit.account_number = account.account_number AND balance < credit_limit;";
$result_credit_from = $conn->query($sql_credit_from);

//From Loan accounts query
$sql_loan_from = "SELECT DISTINCT loan.account_number, balance, account_type FROM account, loan WHERE client_id = '" . $_SESSION['client_id'] . "' AND loan.account_number = account.account_number AND balance< loan_limit AND type<>'mortgage';";
$result_loan_from = $conn->query($sql_loan_from);


//Here we make the query to get all the bills that have not been paid related to that client_id.
$sql_client_bills = "SELECT DISTINCT bill_id, amount FROM bills WHERE client_id = '" . $_SESSION['client_id'] . "' AND is_paid = 0 ";
$result_client_bills = $conn->query($sql_client_bills);

include("views/menu.php");


?>

<!doctype html>
<html lang="en">
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>Pay your bills.</title>
</head>
<body>


<form method="post" action="index.php" id="pay-bills" name="pay-bills">
    <h1>Pay your bills</h1>
    <hr>
    <div id="fromRow" class="form-group row">
        <label for="from" class="col-sm-2 col-form-label">Select account to pay from:</label>
        <div class="col-sm-2">
            <select name='from' id="from" class="form-control" required>
                <option value="" disabled selected hidden>Select an Account</option>
                <?php
                if($result_checking_from -> num_rows >0) {
                    while ($row = $result_checking_from->fetch_assoc()) {
                        $account_number = $row["account_number"];
                        $balance = $row["balance"];
                        $account_type = $row["account_type"];
                        echo "<option value='$account_number|$balance|$account_type'>$account_number --- $balance --- $account_type</option>";
                    }
                }
                if($result_savings_from -> num_rows >0) {
                    while ($row = $result_savings_from->fetch_assoc()) {
                        $account_number = $row["account_number"];
                        $balance = $row["balance"];
                        $account_type = $row["account_type"];
                        echo "<option value='$account_number|$balance|$account_type'>$account_number --- $balance --- $account_type</option>";
                    }
                }
                if($result_credit_from -> num_rows >0) {
                    while ($row = $result_credit_from->fetch_assoc()) {
                        $account_number = $row["account_number"];
                        $balance = $row["balance"];
                        $account_type = $row["account_type"];
                        echo "<option value='$account_number|$balance|$account_type'>$account_number --- $balance --- $account_type</option>";
                    }
                }
                if($result_loan_from -> num_rows >0) {
                    while ($row = $result_loan_from->fetch_assoc()) {
                        $account_number = $row["account_number"];
                        $balance = $row["balance"];
                        $account_type = $row["account_type"];
                        echo "<option value='$account_number|$balance|$account_type'>$account_number --- $balance --- $account_type --- " . $row["type"] . "</option>";
                    }
                }
                ?>
            </select>

        </div>

    </div>

    <div id="bills-list-row" name="bills-list-row" class="form-group row">
        <label for="list-of-bills" class="col-sm-2 col-form-label">List of bills to be paid<hr></label>

            <div class="col-sm-2">
                <?php
                if($result_client_bills -> num_rows >0){
                    while($row = $result_client_bills->fetch_assoc()){
                        echo"<br>";
                        $bill_id = $row["bill_id"];
                        $amount = $row["amount"];
                        echo "<input type=\"checkbox\" name=\"bills_list[]\" value='$bill_id|$amount'> Bill ID:".$bill_id."   ----    ".$amount."\$ ";

                    }


                }

                ?>

            </div>



    </div>



                <button type="submit" class="btn btn-primary" id="pay-bills" name="pay-bills">Pay Bills</button>

</form>

</body>
</html>
