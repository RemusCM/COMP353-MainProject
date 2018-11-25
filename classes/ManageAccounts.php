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
//        // create a database connection
//        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
//        if (!$this->db_connection->connect_errno) {
//            $client = $this->db_connection->real_escape_string(strip_tags($_GET['client'], ENT_QUOTES));
//            $sql = "SELECT client_id FROM client WHERE branch_id='" . $branch . "';";
//            $query_clients = $this->db_connection->query($sql);
//            $clients = array();
//            if ($query_clients->num_rows == 0) {
//                $this->errors[] = "No clients exist.";
//            } else {
//                // read branch data from database
//                while($row = mysqli_fetch_object($query_clients)) {
//                    array_push($clients, $row);
//                }
//            }
//            mysqli_close($this->db_connection);
//            $this->clientsFromSelectedBranch = $clients;
//        }
        return null;
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
            $sql = "DELETE FROM account WHERE account_number = '" . $account_number . "';";
            $query_clients = $this->db_connection->query($sql);
            if ($query_clients->num_rows == 0) {
                $this->messages[] = "Account was deleted.";
            } else {
                $this->errors[] = "Account was not deleted.";
            }
            mysqli_close($this->db_connection);
        }
    }
    public function fetchBranchesForForm()
    {
        // create a database connection
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // change character set to utf8 and check it
        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
        }
        // if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno) {
            $sql = "SELECT branch_id, area, city FROM branch;";
            $query_branches = $this->db_connection->query($sql);
            $branches = array();
            if ($query_branches->num_rows == 0) {
                $this->errors[] = "No branches exist.";
            } else {
                // read branch data from database
                while($row = mysqli_fetch_object($query_branches)) {
                    array_push($branches, $row);
                }
            }
            mysqli_close($this->db_connection);
            return $branches;
        }
    }
}