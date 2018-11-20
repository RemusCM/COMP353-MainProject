<?php

/**
 * Class login
 * handles the user's login and logout process
 */
class Login
{
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();

    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
        // create/read session, absolutely necessary
        session_start();

        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        // login via post data (if user just submitted a login form)
        elseif (isset($_POST["login"])) {
            $this->dologinWithPostData();
        }
    }

    /**
     * log in with post data
     */
    private function dologinWithPostData()
    {
        // check login form contents
        if (empty($_POST['client_id'])) {
            $this->errors[] = "Client Card Number field was empty.";
        } elseif (empty($_POST['password'])) {
            $this->errors[] = "Password field was empty.";
        } elseif (!empty($_POST['client_id']) && !empty($_POST['password'])) {

            // create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escape the POST stuff
                $client_id = $this->db_connection->real_escape_string($_POST['client_id']);

                // first check if this is admin logging in
                $sql = "SELECT admin_id, password FROM admin WHERE admin_id = '" . $client_id . "';";
                $result_of_admin_check = $this->db_connection->query($sql);

                // if the admin exists
                if ($result_of_admin_check->num_rows == 1) {

                    // get result row (as an object)
                    $result_row = $result_of_admin_check->fetch_object();

                    // using PHP 5.5's password_verify() function to check if the provided password fits
                    // the hash of that user's password
                    if ($_POST['password'] == $result_row->password) {

                        // write user data into PHP SESSION (a file on your server)
                        $_SESSION['admin_id'] = $result_row->admin_id;
                        $_SESSION['user_login_status'] = 1;

                    } else {
                        $this->errors[] = "Wrong password. Try again.";
                    }
                } else {
                    // database query, getting all the info of the selected user (allows login via email address in the
                    // username field)
                    $sql = "SELECT client_id, password, joining_date FROM client WHERE client_id = '" . $client_id . "' AND client_id = '" . $client_id . "';";
                    $result_of_login_check = $this->db_connection->query($sql);

                    // if this user exists
                    if ($result_of_login_check->num_rows == 1) {

                        // get result row (as an object)
                        $result_row = $result_of_login_check->fetch_object();

                        // using PHP 5.5's password_verify() function to check if the provided password fits
                        // the hash of that user's password
                        if (password_verify($_POST['password'], $result_row->password)) {

                            // write user data into PHP SESSION (a file on your server)
                            $_SESSION['client_id'] = $result_row->client_id;
                            $_SESSION['user_login_status'] = 1;
                            $_SESSION['joining_date'] = $result_row->joining_date;

                        } else {
                            $this->errors[] = "Wrong password. Try again.";
                        }
                    } else {
                        $this->errors[] = "This user does not exist.";
                    }
                }
            } else {
                $this->errors[] = "Database connection problem.";
            }
            mysqli_close($this->db_connection);
        }
    }

    /**
     * perform the logout
     */
    public function doLogout()
    {
        // delete the session of the user
        $_SESSION = array();
        session_destroy();
        // return a little feedback message
        $this->messages[] = "You have been logged out.";

    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }
}
