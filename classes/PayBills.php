<?php
/**
 * Created by PhpStorm.
 * User: Remus
 * Date: 2018-11-26
 * Time: 2:17 PM
 */

class PayBills
{

    public function __construct()
    {

        if (isset($_POST["pay-bills"])) {
            $this->payBills();
        }
    }


    private function payBills(){

        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $result = $_POST['from'];
        $result_explode = explode('|', $result);


        $accountNumberFrom = (int)$result_explode[0];
        $balance = number_format(floatval($result_explode[1]), 2,'.','');
        $accountTypeFrom = (string)$result_explode[2];

        $amountToPay = number_format(floatval(0.00),2,'.','');


        //First, we find the sum of all bills that user wants to pay, if too much, cancel transaction directly.
        if(!empty($_POST['bills_list'])) {
            foreach($_POST['bills_list'] as $bill) {


                $explodedCheckbox = explode('|', $bill);

                //retrieve checkbox info.
                $bill_id = (int)$explodedCheckbox[0];
                $amount = number_format(floatval($explodedCheckbox[1]), 2, '.', '');
                $amountToPay +=$amount;


            }

        }


        //Check if the bills can be paid in totality, make transaction, adjust the balance accordingly, make a transaction, and set is_paid to 1.
        if($accountTypeFrom == 'checking'  || $accountTypeFrom == 'savings'){
            if($balance < $amountToPay){
                echo "Your balance does not support the amount that you want to pay. Try <a href='bills.php'>again</a>.";
            }

            elseif($balance >= $amountToPay){

                //Adjust the balance accordingly.
                $sql_update_balance = "UPDATE account SET balance = balance - '".$amountToPay."' WHERE account_number = '".$accountNumberFrom."'";
                if($conn->query($sql_update_balance)){

                    //Make transaction with the amount.
                    $sql_enter_transaction = "INSERT INTO transaction(account_number, date, amount)
                          VALUES ('".$accountNumberFrom."', CURRENT_DATE() ,'".-$amountToPay."')";

                    $conn->query($sql_enter_transaction);

                    //Set all the paid bills is_paid to 1 and date to current.
                    if(!empty($_POST['bills_list'])) {
                        foreach ($_POST['bills_list'] as $bill) {


                            $explodedCheckbox = explode('|', $bill);

                            //retrieve checkbox info.
                            $bill_id = (int)$explodedCheckbox[0];

                            $sql_update_bill = "UPDATE bills SET is_paid = 1, date = CURRENT_DATE() WHERE bill_id = '".$bill_id."'";
                            $conn->query($sql_update_bill);
                        }
                    }
                }
                echo"Paid all bills successfully and adjusted bank balance.";
            }
        }

        if($accountTypeFrom == 'credit'){

            //must first check if balance+amount to pay < credit_limit
            $sql_credit_limit = "SELECT credit_limit FROM credit WHERE account_number = '".$accountNumberFrom."'";
            $result_credit_limit = $conn->query($sql_credit_limit);
            if($result_credit_limit -> num_rows > 0){
                while($row = $result_credit_limit->fetch_assoc()){
                    $credit_limit = $row["credit_limit"];
                }
            }

            if($balance+$amountToPay > $credit_limit){

                echo "Error: Can't surpass your credit limit";

            }
            //Can pay the bills, so make new transaction, adjust balance of account, update bills.
            elseif ($balance+$amountToPay <= $credit_limit){

                //Adjust the balance accordingly.
                $sql_update_balance = "UPDATE account SET balance = balance + '".$amountToPay."' WHERE account_number = '".$accountNumberFrom."'";
                if($conn->query($sql_update_balance)){

                    //Make transaction with the amount.
                    $sql_enter_transaction = "INSERT INTO transaction(account_number, date, amount)
                          VALUES ('".$accountNumberFrom."', CURRENT_DATE() ,'".$amountToPay."')";

                    $conn->query($sql_enter_transaction);

                    //Set all the paid bills is_paid to 1 and date to current.
                    if(!empty($_POST['bills_list'])) {
                        foreach ($_POST['bills_list'] as $bill) {


                            $explodedCheckbox = explode('|', $bill);

                            //retrieve checkbox info.
                            $bill_id = (int)$explodedCheckbox[0];

                            $sql_update_bill = "UPDATE bills SET is_paid = 1, date = CURRENT_DATE() WHERE bill_id = '".$bill_id."'";
                            $conn->query($sql_update_bill);

                        }
                    }

                }
                echo"Paid all bills successfully and adjusted bank balance.";

            }

        }

        if($accountTypeFrom == 'loan'){
            $sql_credit_limit = "SELECT loan_limit FROM loan WHERE account_number = '".$accountNumberFrom."'";
            $result_loan_limit = $conn->query($sql_credit_limit);
            if($result_loan_limit -> num_rows > 0){
                while($row = $result_loan_limit->fetch_assoc()){
                    $loan_limit = $row["credit_limit"];
                }
            }
            if($balance+$amountToPay > $loan_limit){

                echo "Error: Can't surpass your loan limit";
            }

            //Can pay the bills, so make new transaction, adjust balance of account, update bills.
            elseif ($balance+$amountToPay <= $loan_limit){

                //Adjust the balance accordingly.
                $sql_update_balance = "UPDATE account SET balance = balance + '".$amountToPay."' WHERE account_number = '".$accountNumberFrom."'";
                if($conn->query($sql_update_balance)){

                    //Make transaction with the amount.
                    $sql_enter_transaction = "INSERT INTO transaction(account_number, date, amount)
                          VALUES ('".$accountNumberFrom."', CURRENT_DATE() ,'".$amountToPay."')";

                    $conn->query($sql_enter_transaction);

                    //Set all the paid bills is_paid to 1 and date to current.
                    if(!empty($_POST['bills_list'])) {
                        foreach ($_POST['bills_list'] as $bill) {


                            $explodedCheckbox = explode('|', $bill);

                            //retrieve checkbox info.
                            $bill_id = (int)$explodedCheckbox[0];

                            $sql_update_bill = "UPDATE bills SET is_paid = 1, date = CURRENT_DATE() WHERE bill_id = '".$bill_id."'";
                            $conn->query($sql_update_bill);



                        }
                    }


                }
                echo"Paid all bills successfully and adjusted bank balance.";

            }

        }

    }

}