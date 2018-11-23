<?php
class ManageEmployees
{
    private $db_connection = null;
    public $errors = array();
    public $messages = array();

    public function __construct()
    {
        session_start();

        if (isset($_POST["update_employee"])) {
            $this->updateEmployee();
        } else if (isset($_POST["add_employee"])) {
           $this->addEmployee();
        } else if (isset($_POST["delete_employee"])) {
            $this->deleteEmployee();
        }
    }

    public function fetchAllEmployees()
    {
        // create a database connection
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$this->db_connection->connect_errno) {
            $sql = "SELECT employee_id, title, name, address, start_date, salary, email_address, phone_number, holidays, sick_days, branch_id FROM Employee;";
            $query_employees = $this->db_connection->query($sql);
            $employees = array();
            if ($query_employees->num_rows == 0) {
                $this->errors[] = "No employees exist.";
            } else {
                // read branch data from database
                while($row = mysqli_fetch_object($query_employees)) {
                    array_push($employees, $row);
                }
            }
            mysqli_close($this->db_connection);
            return $employees;
        }
    }

    public function updateEmployee()
    {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
        }

        if (!$this->db_connection->connect_errno) {
            $employee_id = $this->db_connection->real_escape_string(strip_tags($_POST['employee_id'], ENT_QUOTES));
            $title = $this->db_connection->real_escape_string(strip_tags($_POST['title'], ENT_QUOTES));
            $name = $this->db_connection->real_escape_string(strip_tags($_POST['name'], ENT_QUOTES));
            $address = $this->db_connection->real_escape_string(strip_tags($_POST['address'], ENT_QUOTES));
            $start_date = $this->db_connection->real_escape_string(strip_tags($_POST['start_date'], ENT_QUOTES));
            $salary = $this->db_connection->real_escape_string(strip_tags($_POST['salary'], ENT_QUOTES));
            $email_address = $this->db_connection->real_escape_string(strip_tags($_POST['email_address'], ENT_QUOTES));
            $phone_number = $this->db_connection->real_escape_string(strip_tags($_POST['phone_number'], ENT_QUOTES));
            $holidays = $this->db_connection->real_escape_string(strip_tags($_POST['holidays'], ENT_QUOTES));
            $sick_days = $this->db_connection->real_escape_string(strip_tags($_POST['sick_days'], ENT_QUOTES));
            $branch_id = $this->db_connection->real_escape_string(strip_tags($_POST['branch_id'], ENT_QUOTES));

            $sql = "UPDATE Employee SET title = '" . $title . "', name = '" . $name . "', address = '" . $address . "', start_date = '" . $start_date . "', salary = '" . $salary . "', email_address = '" . $email_address . "', phone_number = '" . $phone_number . "', holidays ='" . $holidays . "', sick_days = '" . $sick_days . "', branch_id = '" . $branch_id . "' WHERE employee_id = '" . $employee_id . "';";
            $query_employees = $this->db_connection->query($sql);
            if ($query_employees->num_rows == 0) {
                $this->messages[] = "Employee updated.";
            } else {
                $this->errors[] = "Employee was not updated.";
            }
            mysqli_close($this->db_connection);
        }
    }

    public function deleteEmployee()
    {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
        }

        if (!$this->db_connection->connect_errno) {
            $employee_id = $this->db_connection->real_escape_string(strip_tags($_POST['employee_id'], ENT_QUOTES));

            $sql = "DELETE FROM Employee WHERE employee_id = '" . $employee_id . "';";
            $query_employees = $this->db_connection->query($sql);
            if ($query_employees->num_rows == 0) {
                $this->messages[] = "Employee was deleted.";
            } else {
                $this->errors[] = "Employee was not deleted.";
            }
            mysqli_close($this->db_connection);
        }
    }

    public function addEmployee()
    {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
        }

        if (!$this->db_connection->connect_errno) {
            $title = $this->db_connection->real_escape_string(strip_tags($_POST['title'], ENT_QUOTES));
            $name = $this->db_connection->real_escape_string(strip_tags($_POST['name'], ENT_QUOTES));
            $address = $this->db_connection->real_escape_string(strip_tags($_POST['address'], ENT_QUOTES));
            $start_date = $this->db_connection->real_escape_string(strip_tags($_POST['start_date'], ENT_QUOTES));
            $salary = $this->db_connection->real_escape_string(strip_tags($_POST['salary'], ENT_QUOTES));
            $email_address = $this->db_connection->real_escape_string(strip_tags($_POST['email_address'], ENT_QUOTES));
            $phone_number = $this->db_connection->real_escape_string(strip_tags($_POST['phone_number'], ENT_QUOTES));
            $holidays = 0;
            $sick_days = 0;
            $branch_id = $this->db_connection->real_escape_string(strip_tags($_POST['branch_id'], ENT_QUOTES));

            $sql = "INSERT INTO Employee(title, name, address, start_date, salary, email_address, phone_number, holidays, sick_days, branch_id)
                                  VALUES('$title', '$name', '$address', '$start_date', '$salary', '$email_address', '$phone_number', '$holidays', '$sick_days', '$branch_id');";

            $query_employees = $this->db_connection->query($sql);
            if ($query_employees->num_rows == 0) {
                $this->messages[] = "Employee was added.";
            } else {
                $this->errors[] = "Employee was not added.";
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