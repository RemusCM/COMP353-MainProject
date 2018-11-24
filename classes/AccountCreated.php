<?php

class AccountCreated
{

    public function __construct()
    {
        // create/read session, absolutely necessary
        session_start();
        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["create_account"])) {
            $this->doCreateAccountWithPostData();
        }
    }

    private function doCreateAccountWithPostData()
    {
        $connect = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$connect) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $level = $_POST['level'];
        $serviceType = $_POST['service-type'];
        $accountType = $_POST['account-type'];
        $interestRate = 0.0;
        $balance = 0.00;
        $client_id = $_SESSION['client_id'];
        $clientJoiningDate = $_SESSION['joining_date'];

        // Course of action if user picks Checkings or savings
        if ($accountType == 'checking' || $accountType == 'savings') {
            if ($accountType == 'checking') {
                $interestRate = 0.0;
                $chargePlan = $_POST['charge-plan'];

                //Insert new record into Account and Checking
                $query = "INSERT INTO account(client_id, balance, account_type, service_type, level, interest_rate)
                                  VALUES('$client_id', '$balance', '$accountType', '$serviceType', '$level', '$interestRate');";


                //Insert new record into Checking
                //Retrieve first the last inserted ID.
                if (mysqli_query($connect, $query)) {
                    $accountNumber = mysqli_insert_id($connect);
                    $query1 = "INSERT INTO checking(account_number, opt) VALUES('$accountNumber', '$chargePlan');";
                    mysqli_query($connect, $query1);
                }

            } elseif ($accountType == 'savings') {
                $interestRate = 2.0;
                $chargePlan = $_POST['charge-plan'];

                //Insert new record into account
                $query = "INSERT INTO account(client_id, balance, account_type, service_type, level, interest_rate)
                                  VALUES('$client_id', '$balance', '$accountType', '$serviceType', '$level', '$interestRate');";


                //Insert new record into Savings
                //The if statement actually executes the query, no need to execute before
                if (mysqli_query($connect, $query)) {
                    $accountNumber = mysqli_insert_id($connect);
                    $query1 = "INSERT INTO savings(account_number, opt) VALUES('$accountNumber', '$chargePlan');";
                    mysqli_query($connect, $query1);
                    echo 'success?';
                }

            }

        } //Course of action for foreign currency

        elseif ($accountType == 'foreign-currency') {


            $currency = $_POST['currency'];

            //Insert a new record into account
            $query = "INSERT INTO account(client_id, balance, account_type, service_type, level, interest_rate)
                                  VALUES('$client_id', '$balance', '$accountType', '$serviceType', '$level', '$interestRate');";
            //Insert a new record into Foreign currency
            if (mysqli_query($connect, $query)) {
                $accountNumber = mysqli_insert_id($connect);

                $query1 = "INSERT INTO foreigncurrency(account_number, currency_type ) VALUES('$accountNumber', '$currency');";
                mysqli_query($connect, $query1);
            }

        } //Course of action for credit

        elseif ($accountType == 'credit') {
            $creditLimit = $_POST['credit-limit'];

            //For every limit amount and service type, there's a different interest rate
            if ($serviceType == 'banking') {
                $interestRate += 2.0;
            } elseif ($serviceType == 'investment') {
                $interestRate += 1.0;
            } elseif ($serviceType == 'insurance') {
                $interestRate += 0.5;
            }
            if ($creditLimit == '500.00') {
                $interestRate += 2.0;
                $minimumPayment = 25.00; //I understand minimal_payment as a percentage of what you owe.
            } elseif ($creditLimit == '1000.00') {
                $interestRate += 1.5;
                $minimumPayment = 20.00;
            } elseif ($creditLimit == '5000.00') {
                $interestRate += 1.0;
                $minimumPayment = 15.00;
            } elseif ($creditLimit == '10000.00') {
                $interestRate += 0.5;
                $minimumPayment = 10.00;
            }
            //Insert a new record into account
            $query = "INSERT INTO account(client_id, balance, account_type, service_type, level, interest_rate)
                                  VALUES('$client_id', '$balance', '$accountType', '$serviceType', '$level', '$interestRate');";
            //Insert a new record into credit
            if (mysqli_query($connect, $query)) {
                $accountNumber = mysqli_insert_id($connect);

                $query1 = "INSERT INTO credit(account_number, credit_limit, minimal_payment ) VALUES('$accountNumber', '$creditLimit', '$minimumPayment');";
                mysqli_query($connect, $query1);
            }
        } //Course of action for loan

        elseif ($accountType == 'loan') {
            $loanType = $_POST['loan-type'];
            $loanLimit = $_POST['loan-limit'];

            //Initial interest rate
            $interestRate = 2.0;

            //For different amounts of limit, service type, loan type we have different interest rates
            if ($serviceType == 'banking') {
                $interestRate += 2.0;
            } elseif ($serviceType == 'investment') {
                $interestRate += 1.0;
            } elseif ($serviceType == 'insurance') {
                $interestRate += 0.5;
            }

            if ($loanLimit == '5000.00') {
                $interestRate += 2.0;
            } elseif ($loanLimit == '10000.00') {
                $interestRate += 1.5;
            } elseif ($loanLimit == '15000.00') {
                $interestRate += 1.0;
            } elseif ($loanLimit == '25000.00') {
                $interestRate += 0.5;
            }

            if ($loanType == 'loan') {
                $interestRate += 1.5;

            } elseif ($loanType == 'mortgage') {
                $interestRate += 1.0;

            } elseif ($loanType == 'line-of-credit') {
                $interestRate += 0.5;
            }

            //Insert a new record into account
            $query = "INSERT INTO account(client_id, balance, account_type, service_type, level, interest_rate)
                                  VALUES('$client_id', '$balance', '$accountType', '$serviceType', '$level', '$interestRate');";
            //Insert a new record into Loan
            if (mysqli_query($connect, $query)) {
                $accountNumber = mysqli_insert_id($connect);

                $query1 = "INSERT INTO loan(account_number, loan_limit, type ) VALUES('$accountNumber', '$loanLimit', '$loanType');";
                mysqli_query($connect, $query1);

            }
        }
        mysqli_close($connect);
    }

}


