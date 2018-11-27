<?php
class ManageAccounts
{
    private $db_connection = null;
    public $errors = array();
    public $messages = array();

    public function __construct()
    {
        session_start();
        if (isset($_POST["update_account"])) {
            $this->updateAccount();
        } else if (isset($_POST["delete_account"])) {
            $this->deleteAccount();
        }
    }
    public function fetchClients()
    {
        // create a database connection
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$this->db_connection->connect_errno) {
            $sql = "SELECT client_id, name, date_of_birth, joining_date, address, category, email_address, phone_number, branch_id FROM client;";
            $query_clients = $this->db_connection->query($sql);
            $clients = array();
            if ($query_clients->num_rows == 0) {
                $this->errors[] = "No clients exist.";
            } else {
                // read branch data from database
                while($row = mysqli_fetch_object($query_clients)) {
                    array_push($clients, $row);
                }
            }
            mysqli_close($this->db_connection);
            return $clients;
        }
    }

    public function fetchAccounts()
    {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$this->db_connection->connect_errno) {
            $sql = "SELECT account_number, client_id, balance, account_type, service_type, level, interest_rate FROM account;";
            $query_accounts = $this->db_connection->query($sql);
            $accounts = array();
            if ($query_accounts->num_rows == 0) {
                $this->errors[] = "No accounts exist.";
            } else {
                // read branch data from database
                while($row = mysqli_fetch_object($query_accounts)) {
                    array_push($accounts, $row);
                }
            }
            mysqli_close($this->db_connection);
            return $accounts;
        }
    }

    public function updateAccount()
    {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
        }
        if (!$this->db_connection->connect_errno) {
            $account_number = $this->db_connection->real_escape_string(strip_tags($_POST['account_number'], ENT_QUOTES));
            $service_type = $this->db_connection->real_escape_string(strip_tags($_POST['service_type'], ENT_QUOTES));
            $level = $this->db_connection->real_escape_string(strip_tags($_POST['level'], ENT_QUOTES));
            $interest_rate = $this->db_connection->real_escape_string(strip_tags($_POST['interest_rate'], ENT_QUOTES));

            $sql = "UPDATE account SET service_type = '" . $service_type . "', level = '" . $level . "', interest_rate = '" . $interest_rate . "' WHERE account_number = '" . $account_number . "';";
            $query_accounts = $this->db_connection->query($sql);
            if ($query_accounts->num_rows == 0) {
                $this->messages[] = "Account updated.";
            } else {
                $this->errors[] = "Account was not updated.";
            }
            mysqli_close($this->db_connection);
        }
    }

    public function deleteAccount()
    {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
        }
        if (!$this->db_connection->connect_errno) {
            $account_number = $this->db_connection->real_escape_string(strip_tags($_POST['account_number'], ENT_QUOTES));

            // Find the account
            $sql_account = "SELECT account_number, account_type FROM account WHERE account_number = '" . $account_number . "';";
            $query_accounts = $this->db_connection->query($sql_account);
            $result_row_account = $query_accounts->fetch_object();

            // Delete the account type instance based on account type.
            $account_type = null;
            if($result_row_account->account_type == 'Savings'){
                $account_type = 'savings';
            } else if($result_row_account->account_type == 'Checking'){
                $account_type = 'checking';
            } else if($result_row_account->account_type == 'Credit'){
                $account_type = 'credit';
            } else if($result_row_account->account_type == 'Foreign Currency'){
                $account_type = 'foreigncurrency';
            } else if($result_row_account->account_type == 'Loan' || $result_row_account->account_type == 'Mortgage' || $result_row_account->account_type == 'Line of Credit'){
                $account_type = 'loan';
            }
            $sql_type_delete = "DELETE FROM " . $account_type . " WHERE account_number = '" . $account_number . "';";
            $this->db_connection->query($sql_type_delete);

            // Delete the transactions of the account
            $sql_transaction_delete = "DELETE FROM transaction WHERE account_number = '" . $account_number . "';";
            $this->db_connection->query($sql_transaction_delete);

            // Delete the account.
            $sql = "DELETE FROM account WHERE account_number = '" . $account_number . "';";
            $query_clients = $this->db_connection->query($sql);
            if ($query_clients->num_rows == 0) {
                $this->messages[] = "Account was not deleted.";
            } else {
                $this->errors[] = "Account was deleted.";
            }
            mysqli_close($this->db_connection);
        }
    }
}