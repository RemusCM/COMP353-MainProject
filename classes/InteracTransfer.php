<?php
/**
 * Created by PhpStorm.
 * User: Remus
 * Date: 2018-11-24
 * Time: 10:13 PM
 */

class InteracTransfer
{
    public function __construct()
    {

        if (isset($_POST["etransfer"])) {
            $this->transferThroughInterac();
        }
    }

    private function transferThroughInterac(){
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $from = (string)($_POST['fromTable']);
        $amount = number_format(floatval($_POST['amountToTransfer']), 2,'.','');

        //if user sets both fields, we need to check that both fields go to the same user.
        if(!$_POST["mail"]=="" && !($_POST["mobile"]=="")) {
            $sql_mail = "SELECT client_id FROM client WHERE email_address = '" . $_POST['mail'] . "'  ";
            $result_sql_mail = $conn->query($sql_mail);
            //email doesn't exist.
            if ($result_sql_mail->num_rows == 0) {
                echo "That mail doesn't exist, try again.";
                return;
            }

            $sql_phone = "SELECT client_id FROM client WHERE phone_number = '" . $_POST['mobile'] . "'  ";
            $result_sql_phone = $conn->query($sql_phone);

            //phone doesn't exist.
            if ($result_sql_phone->num_rows == 0) {
                echo "Phone doesn't exist, try again.";
                return;
            }
            //then we find a single result for each
            if($result_sql_mail->num_rows == 1 && $result_sql_phone->num_rows == 1){
                $rowMail= $result_sql_mail->fetch_assoc();
                //fetch client_id from the mail
                $client_id_mail = (int)($rowMail["client_id"]);
                $rowMobile= $result_sql_phone->fetch_assoc();
                //fetch client_id from the mail
                $client_id_mobile = (int)($rowMobile["client_id"]);

                if($client_id_mail != $client_id_mobile){
                    echo "The two fields you entered do not correspond to a single client.";
                    return;
                }

                //we can pick either method to insert into the account.
                elseif($client_id_mobile == $client_id_mail){
                    $sql_checking = "SELECT DISTINCT checking.account_number FROM account, checking WHERE client_id = '".$client_id_mail."' AND checking.account_number = account.account_number;";

                    $result_checking_sql= $conn->query($sql_checking);

                    if($result_checking_sql->num_rows==0){
                        //must have at least a savings account or checkings account since start of clients accounts (either checking or savings)
                        $sql_savings = "SELECT DISTINCT savings.account_number FROM account, checking WHERE client_id = '".$client_id_mail."' AND savings.account_number = account.account_number;";
                        $result_savings_sql = $conn->query($sql_savings);
                        $rowAccount = $result_savings_sql->fetch_assoc();
                        $account_numberUsed = (int)($rowAccount["account_number"]);
                        $sql_updateTarget = "UPDATE account SET balance = balance + '".$amount."' WHERE account_number ='".$account_numberUsed."' ";
                        $sql_updateClient = "UPDATE account SET balance = balance -'".$amount."' WHERE account_number= '".$from."'";

                        if($conn->query($sql_updateTarget)){
                            if($conn->query($sql_updateClient)) {
                                echo "success";
                                return;
                            }
                        }


                    }

                    elseif($result_checking_sql->num_rows > 0){
                        //grab the first checking account that the client has.
                        $rowAccount = $result_checking_sql->fetch_assoc();
                        $account_numberUsed = (int)($rowAccount["account_number"]);

                        $sql_updateTarget = "UPDATE account SET balance = balance + '".$amount."' WHERE account_number ='".$account_numberUsed."' ";
                        $sql_updateClient = "UPDATE account SET balance = balance -'".$amount."' WHERE account_number= '".$from."'";
                        if($conn->query($sql_updateTarget)){
                            if($conn->query($sql_updateClient)) {
                                echo "success";
                                return;
                            }
                        }

                    }


                }

            }

        }



        if(($_POST["mail"])!= "" && $_POST["mobile"]== ""){
       //First, check if mail exists. If it does, then we will proceed to find whether if he has a checking or savings. And then insert.
            $sql= "SELECT client_id FROM client WHERE email_address = '" . $_POST['mail'] . "'  ";
            $result_sql = $conn->query($sql);
            //email doesn't exist.
            if($result_sql->num_rows == 0){
                echo "That mail doesn't exist, try again.";
                return;
            }

            //email exists.
            elseif($result_sql->num_rows == 1){
                $row = $result_sql->fetch_assoc();
                //fetch the client id of that result, store as string
                $client_id = (int)($row["client_id"]);
                //retrieve all that clients checking accounts, if he has any.
                $sql_checking = "SELECT DISTINCT checking.account_number FROM account, checking WHERE client_id = '".$client_id."' AND checking.account_number = account.account_number;";

                $result_checking_sql= $conn->query($sql_checking);

                if($result_checking_sql->num_rows==0){
                    //must have at least a savings account or checkings account since start of clients accounts (either checking or savings)
                    $sql_savings = "SELECT DISTINCT savings.account_number FROM account, checking WHERE client_id = '".$client_id."' AND savings.account_number = account.account_number;";
                    $result_savings_sql = $conn->query($sql_savings);
                    $rowAccount = $result_savings_sql->fetch_assoc();
                    $account_numberUsed = (int)($rowAccount["account_number"]);
                    $sql_updateTarget = "UPDATE account SET balance = balance + '".$amount."' WHERE account_number ='".$account_numberUsed."' ";
                    $sql_updateClient = "UPDATE account SET balance = balance -'".$amount."' WHERE account_number= '".$from."'";

                    if($conn->query($sql_updateTarget)){
                        if($conn->query($sql_updateClient)) {
                            echo "success";
                            return;
                        }
                    }


                }

                elseif($result_checking_sql->num_rows > 0){
                    //grab the first checking account that the client has.
                    $rowAccount = $result_checking_sql->fetch_assoc();
                    $account_numberUsed = (int)($rowAccount["account_number"]);

                    $sql_updateTarget = "UPDATE account SET balance = balance + '".$amount."' WHERE account_number ='".$account_numberUsed."' ";
                    $sql_updateClient = "UPDATE account SET balance = balance -'".$amount."' WHERE account_number= '".$from."'";
                    if($conn->query($sql_updateTarget)){
                        if($conn->query($sql_updateClient)) {
                            echo "success";
                            return;
                        }
                    }

                }


            }
        }
        //Otherwise, the user entered the cellphone number
        elseif(($_POST['mobile'])!="" && $_POST["mail"] == ""){
            //First, check if cellphone number exists. If it does, then we will proceed to find whether if he has a checking or savings. And then insert.
            $sql= "SELECT client_id FROM client WHERE phone_number = '".$_POST['mobile']."'  ";
            $result_sql = $conn->query($sql);

            //phone doesn't exist.
            if($result_sql->num_rows == 0){
                echo "Phone doesn't exist, try again.";
                return;
            }

            //phone exists.
            elseif($result_sql->num_rows == 1){
                $row = $result_sql->fetch_assoc();
                //fetch the client id of that result, store as string
                $client_id = (int)($row["client_id"]);
                //retrieve all that clients checking accounts, if he has any.
                $sql_checking = "SELECT DISTINCT checking.account_number FROM account, checking WHERE client_id = '".$client_id."' AND checking.account_number = account.account_number;";

                $result_checking_sql= $conn->query($sql_checking);

                if($result_checking_sql->num_rows==0){
                    //must have at least a savings account since start of clients accounts (either checking or savings)
                    $sql_savings = "SELECT DISTINCT savings.account_number FROM account, checking WHERE client_id = '".$client_id."' AND savings.account_number = account.account_number;";
                    $result_savings_sql = $conn->query($sql_savings);
                    $rowAccount = $result_savings_sql->fetch_assoc();
                    $account_numberUsed = (int)($rowAccount["account_number"]);
                    $sql_updateTarget = "UPDATE account SET balance = balance + '".$amount."' WHERE account_number ='".$account_numberUsed."' ";
                    $sql_updateClient = "UPDATE account SET balance = balance -'".$amount."' WHERE account_number= '".$from."'";

                    if($conn->query($sql_updateTarget)){
                        if($conn->query($sql_updateClient)) {
                            echo "Monies Transferred Successfully";
                            return;
                        }
                    }


                }

                elseif($result_checking_sql->num_rows > 0){
                    //grab the first checking account that the client has.
                    $rowAccount = $result_checking_sql->fetch_assoc();
                    $account_numberUsed = (int)($rowAccount["account_number"]);

                    $sql_updateTarget = "UPDATE account SET balance = balance + '".$amount."' WHERE account_number ='".$account_numberUsed."' ";
                    $sql_updateClient = "UPDATE account SET balance = balance -'".$amount."' WHERE account_number= '".$from."'";
                    if($conn->query($sql_updateTarget)){
                        if($conn->query($sql_updateClient)) {
                            echo "Monies Transferred Successfully.";
                            return;
                        }
                    }

                }


            }

        }

        else{
            echo "Enter either the correct phone, or the correct mail.";
            return;
        }


    }
}