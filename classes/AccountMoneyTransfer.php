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

    private function moneyTransfer(){
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $accountFrom = $_POST['from'];
        $accountTo = $_POST['to'];
        $amount = $_POST['amount'];

    }

}