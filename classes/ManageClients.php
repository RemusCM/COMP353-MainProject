<?php
class ManageClients
{
    private $db_connection = null;
    public $errors = array();
    public $messages = array();

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
}