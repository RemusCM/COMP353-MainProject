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
        } elseif (empty($_POST['branch'])) {
            $this->errors[] = "Branch cannot be empty";
        }

        /*
         * Form validation for parameters to create the account.
         * */
        elseif (empty($_POST['acc_type'])) {
            $this->errors[] = "Account type cannot be empty";
        } elseif (empty($_POST['service'])) {
            $this->errors[] = "Service type cannot be empty";
        } elseif (empty($_POST['level'])) {
            $this->errors[] = "Level of banking cannot be empty";
        } elseif (empty($_POST['option'])) {
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
            && !empty($_POST['branch'])
            && !empty($_POST['acc_type'])
            && !empty($_POST['service'])
            && !empty($_POST['level'])
            && !empty($_POST['option'])
        ) {

            /*
             * TODO: This part needs to be taken care of. Form validation is correct.
             * */
            // create a database connection
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escaping, additionally removing everything that could be (html/javascript-) code
                $user_name = $this->db_connection->real_escape_string(strip_tags($_POST['user_name'], ENT_QUOTES));
                $user_email = $this->db_connection->real_escape_string(strip_tags($_POST['user_email'], ENT_QUOTES));

                $user_password = $_POST['password_new'];

                // crypt the user's password with PHP 5.5's password_hash() function, results in a 60 character
                // hash string. the PASSWORD_DEFAULT constant is defined by the PHP 5.5, or if you are using
                // PHP 5.3/5.4, by the password hashing compatibility library
                $user_password_hash = password_hash($user_password, PASSWORD_DEFAULT);

                // check if user or email address already exists
                $sql = "SELECT * FROM client WHERE name = '" . $user_name . "' OR user_email = '" . $user_email . "';";
                $query_check_user_name = $this->db_connection->query($sql);

                if ($query_check_user_name->num_rows == 1) {
                    $this->errors[] = "Sorry, a client already exists with that name and email combination.";
                } else {
                    // write new user's data into database
                    $sql = "INSERT INTO users (user_name, user_password_hash, user_email)
                            VALUES('" . $user_name . "', '" . $user_password_hash . "', '" . $user_email . "');";
                    $query_new_user_insert = $this->db_connection->query($sql);

                    // if user has been added successfully
                    if ($query_new_user_insert) {
                        $this->messages[] = "Your account has been created successfully. You can now log in.";
                    } else {
                        $this->errors[] = "Sorry, your registration failed. Please go back and try again.";
                    }
                }
            } else {
                $this->errors[] = "Sorry, no database connection.";
            }
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
            $sql = "SELECT id, area, city FROM branch ;";
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
            $query_branches->free();
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
            $sql = "SELECT opt FROM chargePlan ;";
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
            $query_options->free();
            return $options;
        }
    }

}
