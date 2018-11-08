<?php
//Assume new account balance is always 0

$connect = mysqli_connect('vdc353.encs.concordia.ca', 'vdc353_2','jrssv353','vdc353_2');

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$level = $_POST['level'];
$serviceType = $_POST['service-type'];
$accountType = $_POST['account-type'];
$interestRate = 0.0;


// Course of action if user picks Checkings or savings
if($accountType == 'checking' || $accountType = 'Savings') {
    if($accountType == 'checking'){
        $interestRate = 0.0;
        $chargePlan = $_POST['charge-plan'];

        //Insert new record into account

        //Insert new record into Checking

    }
    elseif ($accountType == 'savings'){
        $interestRate = 2.0;
        $chargePlan = $_POST['charge-plan'];

        //Insert new record into account

        //Insert new record into Savings
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

}

//Course of action for loan

elseif($accountType =='loan'){
    $loanType = $_POST['loan-type'];
    $loanLimit = $_POST['loan-limit'];

    //For different types of limit, we have different  interest rates


}

mysqli_close($connect);

?>