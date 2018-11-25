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

        if(isset($_POST["mail"])){
       //First, check if mail exists. If it does, then we will proceed to find whether if he has a checking or savings. And then insert.
            $sql= "SELECT client_id FROM client WHERE email_address = '" . $_POST['mail'] . "'  ";
            $result_sql = $conn->query($sql);
            //email doesn't exist.
            if($result_sql->num_rows == 0){
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
                    //must have at least a savings account
                }

                elseif($result_checking_sql->num_rows > 0){
                    //grab the first checking account that the client has.
                    $rowAccount = $result_checking_sql->fetch_assoc();
                    $account_numberUsed = (int)($rowAccount["account_number"]);

                    $sql_updateTarget = "UPDATE account SET balance = balance + '".$amount."' WHERE account_number ='".$account_numberUsed."' ";
                    $sql_updateClient = "";
                    if($conn->query($sql_updateTarget)){
                        echo "success";
                    }

                }


            }
        }
        elseif(isset($_POST['mobile'])){

        }
        else{
            return;
        }


    }
}