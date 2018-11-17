<?php
//Assume new account balance is always 0
session_start();

$connect = mysqli_connect("localhost", "root","","testAccount");

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

$level = $_POST['level'];
$serviceType = $_POST['service-type'];
$accountType = $_POST['account-type'];
$interestRate = 0.0;
$balance = 0.00;


//need to complete registration of a client/log-in to retrieve this
//TODO store client_id in session once logged in. Also store joining date to see if he is able to make credit card/line of credit
//$clientID = $_SESSION['client_id'];
//$clientJoinDate = $_SESSION['joining_date'];

$client_id = 1; //Testing with fake/ hard-coded client_id until registration/login provides client info to session

// Course of action if user picks Checkings or savings
if($accountType == 'checking' || $accountType == 'savings') {
    if($accountType == 'checking'){
        $interestRate = 0.0;
        $chargePlan = $_POST['charge-plan'];

        //Insert new record into Account and Checking
        $query = "INSERT INTO Account(client_id, balance, account_type, service_type, level, interest_rate)
                          VALUES('$client_id', '$balance', '$accountType', '$serviceType', '$level', '$interestRate');";


        //Insert new record into Checking
        //Retrieve first the last inserted ID.
        if(mysqli_query($connect,$query)) {
            $accountNumber = mysqli_insert_id($connect);
            $query1 = "INSERT INTO Checking(account_number, opt) VALUES('$accountNumber', '$chargePlan');";
            mysqli_query($connect, $query1);
        }

    }

    elseif ($accountType == 'savings'){
        $interestRate = 2.0;
        $chargePlan = $_POST['charge-plan'];

        //Insert new record into account
 $query = "INSERT INTO Account(client_id, balance, account_type, service_type, level, interest_rate)
                          VALUES('$client_id', '$balance', '$accountType', '$serviceType', '$level', '$interestRate');";


        //Insert new record into Savings
        //The if statement actually executes the query, no need to execute before
        if(mysqli_query($connect,$query)) {
            $accountNumber = mysqli_insert_id($connect);
            $query1 = "INSERT INTO Savings(account_number, opt) VALUES('$accountNumber', '$chargePlan');";
            mysqli_query($connect, $query1);
        }

    }

}
//Course of action for foreign currency

elseif($accountType == 'foreign-currency'){


    $currency = $_POST['currency'];

    //Insert a new record into account
    $query = "INSERT INTO Account(client_id, balance, account_type, service_type, level, interest_rate)
                          VALUES('$client_id', '$balance', '$accountType', '$serviceType', '$level', '$interestRate');";
    //Insert a new record into Foreign currency
    if(mysqli_query($connect,$query)) {
        $accountNumber = mysqli_insert_id($connect);

        $query1 = "INSERT INTO ForeignCurrency(account_number, currency_type ) VALUES('$accountNumber', '$currency');";
        mysqli_query($connect, $query1);
    }

}

//Course of action for credit

elseif($accountType == 'credit'){
    $creditLimit = $_POST['credit-limit'];

    //For every limit amount and service type, there's a different interest rate
    if($serviceType == 'banking'){
        $interestRate += 2.0;
    }
    elseif ($serviceType =='investment'){
        $interestRate += 1.0;
    }
    elseif ($serviceType == 'insurance'){
        $interestRate += 0.5;
    }
    if($creditLimit == '500.00'){
        $interestRate += 2.0;
        $minimumPayment = 25.00; //I understand minimal_payment as a percentage of what you owe.
    }
    elseif($creditLimit == '1000.00'){
        $interestRate += 1.5;
        $minimumPayment = 20.00;
    }
    elseif($creditLimit == '5000.00'){
        $interestRate += 1.0;
        $minimumPayment = 15.00;
    }
    elseif($creditLimit == '10000.00'){
        $interestRate += 0.5;
        $minimumPayment = 10.00;
    }
    //Insert a new record into account
    $query = "INSERT INTO Account(client_id, balance, account_type, service_type, level, interest_rate)
                          VALUES('$client_id', '$balance', '$accountType', '$serviceType', '$level', '$interestRate');";
    //Insert a new record into credit
    if(mysqli_query($connect,$query)) {
        $accountNumber = mysqli_insert_id($connect);

        $query1 = "INSERT INTO Credit(account_number, credit_limit, minimal_payment ) VALUES('$accountNumber', '$creditLimit', '$minimumPayment');";
        mysqli_query($connect, $query1);
    }
}

//Course of action for loan

elseif($accountType =='loan'){
    $loanType = $_POST['loan-type'];
    $loanLimit = $_POST['loan-limit'];

    //Initial interest rate
    $interestRate= 2.0;

    //For different amounts of limit, service type, loan type we have different interest rates
    if($serviceType == 'banking'){
        $interestRate += 2.0;
    }
    elseif ($serviceType =='investment'){
        $interestRate += 1.0;
    }
    elseif ($serviceType == 'insurance'){
        $interestRate += 0.5;
    }

    if($loanLimit == '5000.00'){
        $interestRate += 2.0;
    }
    elseif($loanLimit == '10000.00'){
        $interestRate += 1.5;
    }
    elseif($loanLimit == '15000.00'){
        $interestRate += 1.0;
    }
    elseif($loanLimit == '25000.00'){
        $interestRate += 0.5;
    }

    if($loanType == 'loan'){
        $interestRate += 1.5;

    }
    elseif($loanType =='mortgage'){
        $interestRate += 1.0;

    }
    elseif ($loanType == 'line-of-credit'){
        $interestRate += 0.5;
    }

    //Insert a new record into account
    $query = "INSERT INTO Account(client_id, balance, account_type, service_type, level, interest_rate)
                          VALUES('$client_id', '$balance', '$accountType', '$serviceType', '$level', '$interestRate');";
    //Insert a new record into Loan
    if(mysqli_query($connect,$query)) {
        $accountNumber = mysqli_insert_id($connect);

        $query1 = "INSERT INTO Loan(account_number, loan_limit, type ) VALUES('$accountNumber', '$loanLimit', '$loanType');";
        mysqli_query($connect, $query1);

    }
}

mysqli_close($connect);
echo "done";


