<?php
class ManageClients
{
    private $db_connection = null;
    public $errors = array();
    public $messages = array();

    public function __construct()
    {
        session_start();

        if (isset($_POST["update_client"])) {
            $this->updateClient();
        } else if (isset($_POST["delete_client"])) {
            $this->deleteClient();
        }
    }

    public function fetchAllClients()
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

    public function updateClient()
    {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
        }

        if (!$this->db_connection->connect_errno) {
            $client_id = $this->db_connection->real_escape_string(strip_tags($_POST['client_id'], ENT_QUOTES));
            $name = $this->db_connection->real_escape_string(strip_tags($_POST['name'], ENT_QUOTES));
            $email = $this->db_connection->real_escape_string(strip_tags($_POST['email'], ENT_QUOTES));
            $address = $this->db_connection->real_escape_string(strip_tags($_POST['address'], ENT_QUOTES));
            $phone = $this->db_connection->real_escape_string(strip_tags($_POST['phone'], ENT_QUOTES));
            $dob = $this->db_connection->real_escape_string(strip_tags($_POST['dob'], ENT_QUOTES));
            $category = $this->db_connection->real_escape_string(strip_tags($_POST['category'], ENT_QUOTES));
            $branch = $this->db_connection->real_escape_string(strip_tags($_POST['branch'], ENT_QUOTES));

            $sql = "UPDATE client SET name = '" . $name . "', date_of_birth = '" . $dob . "', address = '" . $address . "', category= '" . $category . "', phone_number = '" . $phone . "', email_address ='" . $email. "', branch_id = '" . $branch . "' WHERE client_id = '" . $client_id . "';";
            $query_clients = $this->db_connection->query($sql);
            if ($query_clients->num_rows == 0) {
                $this->messages[] = "Client updated.";
            } else {
                $this->errors[] = "Client was not updated.";
            }
            mysqli_close($this->db_connection);
        }
    }

    public function deleteClient()
    {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
        }

        if (!$this->db_connection->connect_errno) {
            $client_id = $this->db_connection->real_escape_string(strip_tags($_POST['client_id'], ENT_QUOTES));

            $sql = "DELETE FROM client WHERE client_id = '" . $client_id . "';";
            $query_clients = $this->db_connection->query($sql);
            if ($query_clients->num_rows == 0) {
                $this->messages[] = "Client was deleted.";
            } else {
                $this->errors[] = "Client was not deleted.";
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