<?php

class Reports
{
    private $db_connection = null;
    public $errors = array();
    public $messages = array();

    public function __construct()
    {
        session_start();
    }

    public function fetchPresident()
    {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$this->db_connection->connect_errno) {
            $sql = "SELECT name, branch_id FROM employee WHERE title='President';";
            $query = $this->db_connection->query($sql);
            $result = $query->fetch_object();
            mysqli_close($this->db_connection);
            return $result;
        }
    }

    public function fetchClientCount()
    {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$this->db_connection->connect_errno) {
            $sql = "SELECT COUNT(*) AS ccount FROM client;";
            $query = $this->db_connection->query($sql);
            $result = $query->fetch_object();
            mysqli_close($this->db_connection);
            return $result;
        }
    }

    public function fetchEmployeeCount()
    {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$this->db_connection->connect_errno) {
            $sql = "SELECT COUNT(*) AS ecount FROM employee;";
            $query = $this->db_connection->query($sql);
            $result = $query->fetch_object();
            mysqli_close($this->db_connection);
            return $result;
        }
    }

    public function fetchBranches()
    {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
        }

        if (!$this->db_connection->connect_errno) {
            $sql = "SELECT branch_id, area, city, phone, fax, manager_name, opening_date FROM branch;";
            $query_branches = $this->db_connection->query($sql);
            $branches = array();
            if ($query_branches->num_rows == 0) {
                $this->errors[] = "No branches exist.";
            } else {
                while($row = mysqli_fetch_object($query_branches)) {
                    array_push($branches, $row);
                }
            }
            mysqli_close($this->db_connection);
            return $branches;
        }
    }

    public function fetchCities()
    {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
        }

        if (!$this->db_connection->connect_errno) {
            $sql = "SELECT DISTINCT city AS cityName FROM branch;";
            $query = $this->db_connection->query($sql);
            $cities = array();
            if ($query->num_rows == 0) {
                $this->errors[] = "No cities exist.";
            } else {
                while($row = mysqli_fetch_object($query)) {
                    array_push($cities, $row);
                }
            }
            mysqli_close($this->db_connection);
            return $cities;
        }
    }

    public function fetchServices()
    {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
        }

        if (!$this->db_connection->connect_errno) {
            $sql = "SELECT service_type, manager_id FROM service;";
            $query = $this->db_connection->query($sql);
            $services = array();
            if ($query->num_rows == 0) {
                $this->errors[] = "No services exist.";
            } else {
                while($row = mysqli_fetch_object($query)) {
                    array_push($services, $row);
                }
            }
            mysqli_close($this->db_connection);
            return $services;
        }
    }

    public function fetchEmployeeById($id) {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$this->db_connection->connect_errno) {
            $sql = "SELECT name FROM employee WHERE employee_id='" . $id . "';";
            $query = $this->db_connection->query($sql);
            $result = $query->fetch_object();
            mysqli_close($this->db_connection);
            return $result->name;
        }
    }

    public function fetchOverallEmployeeSalaries() {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$this->db_connection->connect_errno) {
            $sql = "SELECT SUM(salary) AS salarySum FROM employee;";
            $query = $this->db_connection->query($sql);
            $result = $query->fetch_object();
            mysqli_close($this->db_connection);
            return $result->salarySum;
        }
    }

    public function fetchEmployeeSalariesByBranch($branch_id) {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$this->db_connection->connect_errno) {
            $sql = "SELECT SUM(salary) AS salarySum FROM employee WHERE branch_id='" . $branch_id . "';";
            $query = $this->db_connection->query($sql);
            $result = $query->fetch_object();
            mysqli_close($this->db_connection);
            return $result->salarySum;
        }
    }

    public function fetchEmployeeSalariesByCity($city) {
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if (!$this->db_connection->connect_errno) {

            $sql = "SELECT branch_id FROM branch WHERE city = '" . $city . "';";
            $query = $this->db_connection->query($sql);
            $sum = 0;
            if ($query->num_rows == 0) {
                $this->errors[] = "No branches exist in this city.";
            } else {
                while($row = mysqli_fetch_object($query)) {
                    $sql = "SELECT SUM(salary) AS salarySum FROM employee WHERE branch_id='" . $row->branch_id . "';";
                    $query = $this->db_connection->query($sql);
                    $result = $query->fetch_object();
                    $sum = $sum + $result->salarySum;
                }
            }
            mysqli_close($this->db_connection);
            return $sum;
        }
    }
}