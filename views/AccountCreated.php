<?php
//Assume new account balance is always 0
session_start();
$connect = mysqli_connect('vdc353.encs.concordia.ca', 'vdc353_2','jrssv353','vdc353_2');

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$level = $_POST['level'];
$serviceType = $_POST['service-type'];
$accountType = $_POST['account-type'];
$interestRate = 0.0;
$balance = 0.00;
//need to complete registration of a client/log-in to retrieve this
$clientID = $_SESSION['client_id'];


// Course of action if user picks Checkings or savings
if($accountType == 'checking' || $accountType = 'Savings') {
    if($accountType == 'checking'){
        $interestRate = 0.0;
        $chargePlan = $_POST['charge-plan'];

        //Insert new record into account
        $query = "INSERT INTO Account(client_id, balance, account_type, service_type, option_name, interest_rate)
                          VALUES('$clientID', '$balance', '$accountType', '$serviceType', '$chargePlan', '$interestRate');";

        mysqli_query($connect, $query);


        //Insert new record into Checking
        //Retrieve first the last inserted ID.
        $accountNumberQuery = "SELECT LAST_INSERT_ID();";
        $accountNumber = mysqli_query($connect, $accountNumberQuery);
        $query = "INSERT INTO Checking(account_number, opt) VALUES('$accountNumber', '$chargePlan')";

        mysqli_query($connect, $query);
    }

    elseif ($accountType == 'savings'){
        $interestRate = 2.0;
        $chargePlan = $_POST['charge-plan'];

        //Insert new record into account
 $query = "INSERT INTO Account(client_id, balance, account_type, service_type, option_name, interest_rate)
                          VALUES('$clientID', '$balance', '$accountType', '$serviceType', '$chargePlan', '$interestRate');";

        mysqli_query($connect, $query);
        //Insert new record into Savings
        $accountNumberQuery = "SELECT LAST_INSERT_ID();";
        $accountNumber = mysqli_query($connect, $accountNumberQuery);
        $query = "INSERT INTO Checking(account_number, opt) VALUES('$accountNumber', '$chargePlan')";

        mysqli_query($connect, $query);

    }

}
//Course of action for foreign currency

elseif($accountType == 'foreign-currency'){
    $currency = $_POST['currency'];

    //Insert a new record into account

    //Insert a new record into Foreign currency

}

//Course of action for credit
elseif($accountType = 'credit'){
    $creditLimit = $_POST['credit-limit'];

    //For every limit amount, there's a different interest rate

    //Insert a new record into account

    //Insert a new record into credit

}

//Course of action for loan

elseif($accountType =='loan'){
    $loanType = $_POST['loan-type'];
    $loanLimit = $_POST['loan-limit'];

    //For different amounts of limit, we have different interest rates

    //Insert a new record into account

    //Insert a new record into Loan

}

mysqli_close($connect);

