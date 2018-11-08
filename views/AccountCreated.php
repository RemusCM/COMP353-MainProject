<?php
//Assume new account balance is always 0

$level = $_POST['level'];
$serviceType = $_POST['service-type'];
$accountType = $_POST['account-type'];
$interestRate = 0.0;


// Course of action if user picks Checkings or savings
if($accountType == 'Checking' || $accountType = 'Savings') {
    if($accountType == 'Checking'){
        $interestRate = 0.0;
        $chargePlan = $_POST['charge-plan'];

        //Insert new record into account

        //Insert new record into Checking

    }
    elseif ($accountType == 'Savings'){
        $interestRate = 2.0;
        $chargePlan = $_POST['charge-plan'];

        //Insert new record into account

        //Insert new record into Savings
    }

}
//Course of action for foreign currency

elseif($accountType == 'Foreign Currency'){
    $currency = $_POST['currency'];

}

//Course of action for credit
elseif($accountType = 'Credit'){
    $creditLimit = $_POST['credit-limit'];
}

//Course of action for loan

elseif($accountType =='Loan'){


}