<?php
/**
 * Created by PhpStorm.
 * User: Remus
 * Date: 2018-11-24
 * Time: 7:01 PM
 */

class AccountMoneyTransfer
{

    public function __construct()
    {

        if (isset($_POST["transfer"])) {
            $this->moneyTransfer();
        }
    }

    private function moneyTransfer()
    {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        //[0] is account number [1] is balance [2] account type [3] type (if  a loan, says which type of loan)
        $resultFrom = $_POST['from'];
        $result_explode_from = explode('|', $resultFrom);

        $resultTo = $_POST['to'];
        $result_explode_to = explode('|', $resultTo);

        $accountNumberFrom = (int)($result_explode_from[0]);
        $balanceFrom = number_format(floatval($result_explode_from[1]), 2, '.', '');
        $accountTypeFrom = (string)$result_explode_from[2];


        $accountNumberTo = (int)($result_explode_to[0]);
        $accountTypeTo = (string)$result_explode_from[2];
        $amount = number_format(floatval($_POST['amount']), 2, '.', '');


        //First possible path is if account type is checking or savings.
        if ($accountTypeFrom == 'checking' || $accountTypeFrom == 'savings') {
            if ($balanceFrom < $amount) {
                echo "You can't transfer more money than you own.";
                return;
            }

            if ($balanceFrom >= $amount) {
                //we can successfully transfer money from that account.
                //Now it depends to what type of account we transfer (checking/savings or credit/loan)
                if ($accountTypeTo == 'checking' || $accountTypeTo == 'savings') {
                    //we add this to their balance
                    $sql_target_balance = "UPDATE account SET balance = balance +'" . $amount . "' WHERE account_number = '" . $accountNumberTo . "'";
                    $sql_origin_balance = "UPDATE account SET balance = balance - '" . $amount . "' WHERE account_number = '" . $accountNumberFrom . "'";

                    if ($conn->query($sql_target_balance)) {
                        $sql_enter_transaction = "INSERT INTO transaction(account_number, date, amount)
                          VALUES ('".$accountNumberTo."', CURRENT_DATE() ,'".$amount."')";

                            $conn->query($sql_enter_transaction);

                            if ($conn->query($sql_origin_balance)) {
                                $sql_enter_transaction = "INSERT INTO transaction(account_number, date, amount)
                          VALUES ('".$accountNumberFrom."', CURRENT_DATE() ,'".-$amount."')";

                                $conn->query($sql_enter_transaction);
                            echo "Succesfully Transferred Money.";
                            return;
                        }
                    } else {
                        echo "Something did not go to plan.";
                        return;
                    }


                } elseif ($accountTypeTo == 'credit' || $accountTypeTo == 'loan') {
                    //we remove the amount from their balance.
                    $sql_target_balance = "UPDATE account SET balance = balance -'" . $amount . "' WHERE account_number = '" . $accountNumberTo . "'";
                    $sql_origin_balance = "UPDATE account SET balance = balance - '" . $amount . "' WHERE account_number = '" . $accountNumberFrom . "'";

                    if ($conn->query($sql_target_balance)) {
                        $sql_enter_transaction = "INSERT INTO transaction(account_number, date, amount)
                          VALUES ('".$accountNumberTo."', CURRENT_DATE() ,'".-$amount."')";

                        $conn->query($sql_enter_transaction);

                        if ($conn->query($sql_origin_balance)) {

                            $sql_enter_transaction = "INSERT INTO transaction(account_number, date, amount)
                          VALUES ('".$accountNumberFrom."', CURRENT_DATE() ,'".-$amount."')";

                            $conn->query($sql_enter_transaction);
                            echo "Succesfully Transferred Money.";
                            return;
                        }
                    } else {
                        echo "Something did not go to plan.";
                        return;
                    }

                } else {
                    echo "Something did not go to plan.";
                    return;
                }
            }


        }


        //other path is transfering from credit/loan.
        //Must check if the balance + the limit of loan/credit is
        elseif ($accountTypeFrom == 'credit') {

            //First, need to find the credit limit for the account_number in credit.
            $sql_credit_limit = "SELECT credit_limit FROM credit WHERE account_number = '" . $accountNumberFrom . "'";
            $result_credit_limit = $conn->query($sql_credit_limit);
            $rowCreditLimit = $result_credit_limit->fetch_assoc();
            $credit_limit = number_format(floatval($rowCreditLimit["credit_limit"]));

            //then we need to compare if balance of the account + the amount to transfer is bigger than the limit or not.
            if (($balanceFrom + $amount) > $credit_limit) {
                echo "You're trying to transfer over your limit.";
                return;

            } //if his balance+ amount is less than his limit, he can transfer safely.
            elseif (($balanceFrom + $amount) <= $credit_limit) {

                //now we can insert accordingly, different type of insertions depending on type of receiving account.
                if ($accountTypeTo == 'checking' || $accountTypeTo == 'savings') {
                    //we add this to their balance
                    $sql_target_balance = "UPDATE account SET balance = balance +'" . $amount . "' WHERE account_number = '" . $accountNumberTo . "'";
                    $sql_origin_balance = "UPDATE account SET balance = balance + '" . $amount . "' WHERE account_number = '" . $accountNumberFrom . "'";

                    if ($conn->query($sql_target_balance)) {

                        $sql_enter_transaction = "INSERT INTO transaction(account_number, date, amount)
                          VALUES ('".$accountNumberTo."', CURRENT_DATE() ,'".$amount."')";

                        $conn->query($sql_enter_transaction);

                        if ($conn->query($sql_origin_balance)) {

                            $sql_enter_transaction = "INSERT INTO transaction(account_number, date, amount)
                          VALUES ('".$accountNumberFrom."', CURRENT_DATE() ,'".$amount."')";

                            $conn->query($sql_enter_transaction);
                            echo "Succesfully Transferred Money.";
                            return;
                        }
                    } else {
                        echo "Something did not go to plan.";
                        return;
                    }


                } elseif ($accountTypeTo == 'credit' || $accountTypeTo == 'loan') {
                    //we remove the amount from their balance.
                    $sql_target_balance = "UPDATE account SET balance = balance -'" . $amount . "' WHERE account_number = '" . $accountNumberTo . "'";
                    $sql_origin_balance = "UPDATE account SET balance = balance + '" . $amount . "' WHERE account_number = '" . $accountNumberFrom . "'";

                    if ($conn->query($sql_target_balance)) {

                        $sql_enter_transaction = "INSERT INTO transaction(account_number, date, amount)
                          VALUES ('".$accountNumberTo."', CURRENT_DATE() ,'".-$amount."')";

                        $conn->query($sql_enter_transaction);

                        if ($conn->query($sql_origin_balance)) {

                            $sql_enter_transaction = "INSERT INTO transaction(account_number, date, amount)
                          VALUES ('".$accountNumberFrom."', CURRENT_DATE() ,'".$amount."')";

                            $conn->query($sql_enter_transaction);

                            echo "Succesfully Transferred Money.";
                            return;
                        }
                    } else {
                        echo "Something did not go to plan.";
                        return;
                    }

                }

            }

        }

        elseif($accountTypeFrom =='loan'){
            //First, need to find the credit limit for the account_number in credit.
            $sql_loan_limit = "SELECT loan_limit FROM credit WHERE account_number = '" . $accountNumberFrom . "'";
            $result_loan_limit = $conn->query($sql_loan_limit);
            $rowLoanLimit = $result_loan_limit->fetch_assoc();
            $loan_limit = number_format(floatval($rowLoanLimit["credit_limit"]));

            //then we need to compare if balance of the account + the amount to transfer is bigger than the limit or not.
            if (($balanceFrom + $amount) > $loan_limit) {
                echo "You're trying to transfer over your limit.";
                return;

            } //if his balance+ amount is less than his limit, he can transfer safely.
            elseif (($balanceFrom + $amount) <= $loan_limit) {

                //now we can insert accordingly, different type of insertions depending on type of receiving account.
                if ($accountTypeTo == 'checking' || $accountTypeTo == 'savings') {
                    //we add this to their balance
                    $sql_target_balance = "UPDATE account SET balance = balance +'" . $amount . "' WHERE account_number = '" . $accountNumberTo . "'";
                    $sql_origin_balance = "UPDATE account SET balance = balance + '" . $amount . "' WHERE account_number = '" . $accountNumberFrom . "'";

                    if ($conn->query($sql_target_balance)) {

                        $sql_enter_transaction = "INSERT INTO transaction(account_number, date, amount)
                          VALUES ('".$accountNumberTo."', CURRENT_DATE() ,'".$amount."')";

                        $conn->query($sql_enter_transaction);

                        if ($conn->query($sql_origin_balance)) {

                            $sql_enter_transaction = "INSERT INTO transaction(account_number, date, amount)
                          VALUES ('".$accountNumberTo."', CURRENT_DATE() ,'".$amount."')";

                            $conn->query($sql_enter_transaction);

                            echo "Succesfully Transferred Money.";
                            return;
                        }
                    } else {
                        echo "Something did not go to plan.";
                        return;
                    }


                } elseif ($accountTypeTo == 'credit' || $accountTypeTo == 'loan') {
                    //we remove the amount from their balance.
                    $sql_target_balance = "UPDATE account SET balance = balance -'" . $amount . "' WHERE account_number = '" . $accountNumberTo . "'";
                    $sql_origin_balance = "UPDATE account SET balance = balance + '" . $amount . "' WHERE account_number = '" . $accountNumberFrom . "'";

                    if ($conn->query($sql_target_balance)) {

                        $sql_enter_transaction = "INSERT INTO transaction(account_number, date, amount)
                          VALUES ('".$accountNumberTo."', CURRENT_DATE() ,'".-$amount."')";

                        $conn->query($sql_enter_transaction);

                        if ($conn->query($sql_origin_balance)) {

                            $sql_enter_transaction = "INSERT INTO transaction(account_number, date, amount)
                          VALUES ('".$accountNumberTo."', CURRENT_DATE() ,'".$amount."')";

                            $conn->query($sql_enter_transaction);

                            echo "Succesfully Transferred Money.";
                            return;
                        }
                    } else {
                        echo "Something did not go to plan.";
                        return;
                    }

                }

            }
        }

    }

}