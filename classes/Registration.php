<?php

/**
 * Class registration
 * handles the user registration
 */
class Registration
{
    /**
     * @var object $db_connection The database connection
     */
    private $db_connection = null;
    /**
     * @var array $errors Collection of error messages
     */
    public $errors = array();
    /**
     * @var array $messages Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$registration = new Registration();"
     */
    public function __construct()
    {
        if (isset($_POST["register"])) {
            $this->registerNewUser();
        }
    }

    /**
     * handles the entire registration process. checks all error possibilities
     * and creates a new user in the database if everything is fine
     */
    private function registerNewUser()
    {
        /*
         * Form validation for parameters to create the client.
         * */
        if (empty($_POST['name'])) {
            $this->errors[] = "Empty Name";
        } elseif (!preg_match('/^[a-zA-Z]+( [a-zA-Z]+)*$/i', $_POST['name'])) {
            $this->errors[] = "Name does not fit the name scheme: only a-Z are allowed";
        } elseif (empty($_POST['password_new']) || empty($_POST['password_repeat'])) {
            $this->errors[] = "Empty Password";
        } elseif ($_POST['password_new'] !== $_POST['password_repeat']) {
            $this->errors[] = "Password and password repeat are not the same";
        } elseif (strlen($_POST['password_new']) < 6) {
            $this->errors[] = "Password has a minimum length of 6 characters";
        } elseif (strlen($_POST['name']) > 64) {
            $this->errors[] = "Name cannot be longer than 64 characters";
        } elseif (empty($_POST['email'])) {
            $this->errors[] = "Email cannot be empty";
        } elseif (strlen($_POST['email']) > 64) {
            $this->errors[] = "Email cannot be longer than 64 characters";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Your email address is not in a valid email format";
        } elseif (empty($_POST['address'])) {
            $this->errors[] = "Address cannot be empty";
        } elseif (!preg_match('/^\w+( \w+)*$/i', $_POST['address'])) {
            $this->errors[] = "Address does not fit the name scheme: only a-Z and numbers are allowed";
        } elseif (empty($_POST['phone'])) {
            $this->errors[] = "Phone number cannot be empty";
        } elseif (!preg_match('/^[1-9]\d{2}-\d{3}-\d{4}$/i', $_POST['phone'])) {
            $this->errors[] = "Phone number does not fit the correct format: please use format ###-###-####";
        } elseif (empty($_POST['dob'])) {
            $this->errors[] = "Date of birth cannot be empty";
        } elseif (empty($_POST['category'])) {
            $this->errors[] = "Category cannot be empty";
        } elseif (empty($_POST['branch'])) {
            $this->errors[] = "Branch cannot be empty";
        }

        /*
         * Form validation for parameters to create the account.
         * */
        elseif (empty($_POST['account-type'])) {
            $this->errors[] = "Account type cannot be empty";
        } elseif (empty($_POST['service-type'])) {
            $this->errors[] = "Service type cannot be empty";
        } elseif (empty($_POST['level'])) {
            $this->errors[] = "Level of banking cannot be empty";
        } elseif (empty($_POST['charge-plan'])) {
            $this->errors[] = "Charge plan option cannot be empty";
        }

        /*
         * If all validations for both parts of the form pass, then the new client and account gets created.
         * */
        elseif (!empty($_POST['name'])
            && strlen($_POST['name']) <= 64
            && preg_match('/^[a-zA-Z]+( [a-zA-Z]+)*$/i', $_POST['name'])
            && !empty($_POST['email'])
            && strlen($_POST['email']) <= 64
            && filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)
            && !empty($_POST['password_new'])
            && !empty($_POST['password_repeat'])
            && ($_POST['password_new'] === $_POST['password_repeat'])
            && !empty($_POST['address'])
            && preg_match('/^\w+( \w+)*$/i', $_POST['address'])
            && !empty($_POST['phone'])
            && preg_match('/^[1-9]\d{2}-\d{3}-\d{4}$/i', $_POST['phone'])
            && !empty($_POST['dob'])
            && !empty($_POST['category'])
            && !empty($_POST['branch'])
            && !empty($_POST['account-type'])
            && !empty($_POST['service-type'])
            && !empty($_POST['level'])
            && !empty($_POST['charge-plan'])
        ) {

            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escaping, additionally removing everything that could be (html/javascript-) code
                $name = $this->db_connection->real_escape_string(strip_tags($_POST['name'], ENT_QUOTES));
                $email = $this->db_connection->real_escape_string(strip_tags($_POST['email'], ENT_QUOTES));
                $address = $this->db_connection->real_escape_string(strip_tags($_POST['address'], ENT_QUOTES));
                $phone = $this->db_connection->real_escape_string(strip_tags($_POST['phone'], ENT_QUOTES));
                $dob = $this->db_connection->real_escape_string(strip_tags($_POST['dob'], ENT_QUOTES));
                $category = $this->db_connection->real_escape_string(strip_tags($_POST['category'], ENT_QUOTES));
                $branch = $this->db_connection->real_escape_string(strip_tags($_POST['branch'], ENT_QUOTES));

                $account_type = $this->db_connection->real_escape_string(strip_tags($_POST['account-type'], ENT_QUOTES));
                $service_type = $this->db_connection->real_escape_string(strip_tags($_POST['service-type'], ENT_QUOTES));
                $level = $this->db_connection->real_escape_string(strip_tags($_POST['level'], ENT_QUOTES));
                $charge_plan = $this->db_connection->real_escape_string(strip_tags($_POST['charge-plan'], ENT_QUOTES));

                $password = $_POST['password_new'];

                // check if user or email address already exists
                $sql = "SELECT * FROM client WHERE name = '" . $name . "' OR email_address = '" . $email . "' OR phone_number = '".$phone."';";
                $query_check_exists = $this->db_connection->query($sql);

                if ($query_check_exists->num_rows == 1) {
                    $this->errors[] = "Sorry, a client already exists with that name and/or email and/or phone_number.";
                } else {
                    // Write new user's data into database
                    $sql = "INSERT INTO client(name, date_of_birth, joining_date, address, category, email_address, password, phone_number, branch_id)
                            VALUES('" . $name . "', '" . $dob . "', '" . date("Y-m-d") . "', '" . $address . "', '" . $category . "', '" . $email . "', '" . $password . "', '" . $phone . "', '" . $branch . "');";

                    // if user has been added successfully
                    if (mysqli_query($this->db_connection,$sql)) {
                        $client_id = mysqli_insert_id($this->db_connection);

                        // Create the account for the new client
                        $balance = 0.00;
                        $interestRate = $account_type == 'checking' ? 0.0 : 2.0;
                        $sql = "INSERT INTO account(client_id, balance, account_type, service_type, level, interest_rate)
                          VALUES('$client_id', '$balance', '$account_type', '$service_type', '$level', '$interestRate');";

                        if(mysqli_query($this->db_connection,$sql)) {
                            $account_number = mysqli_insert_id($this->db_connection);
                            if ($account_type == 'checking') {
                                $sql1 = "INSERT INTO checking(account_number, opt) VALUES('$account_number', '$charge_plan');";
                                $this->db_connection->query($sql1);
                            } else {
                                $sql1 = "INSERT INTO savings(account_number, opt) VALUES('$account_number', '$charge_plan');";
                                $this->db_connection->query($sql1);
                            }
                            $this->messages[] = "Your account has been created successfully. You can now log in with Client Number: $client_id";
                        }
                        // If writing to Account failed, the client is deleted from DB.
                        else {
                            $sql = "DELETE FROM client WHERE client_id = '$client_id';";
                            $this->db_connection->query($sql);
                            $this->errors[] = "Sorry, new account could not be created. Your registration failed. Please go back and try again.";
                        }
                    } else {
                        $this->errors[] = "Sorry, new client could not be created. Your registration failed. Please go back and try again.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
            mysqli_close($this->db_connection);
        } else {
            $this->errors[] = "An unknown error occurred.";
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

    public function fetchOptionsForForm()
    {
        // create a database connection
        $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        // change character set to utf8 and check it
        if (!$this->db_connection->set_charset("utf8")) {
            $this->errors[] = $this->db_connection->error;
        }

        // if no connection errors (= working database connection)
        if (!$this->db_connection->connect_errno) {
            $sql = "SELECT opt FROM chargeplan;";
            $query_options = $this->db_connection->query($sql);
            $options = array();
            if ($query_options->num_rows == 0) {
                $this->errors[] = "No options exist.";
            } else {
                // read charge plan option data from database
                while($row = mysqli_fetch_object($query_options)) {
                    array_push($options, $row);
                }
            }
            mysqli_close($this->db_connection);
            return $options;
        }
    }

}
