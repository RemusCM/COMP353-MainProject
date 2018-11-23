<?php
/**
 * Created by PhpStorm.
 * User: jasminelatendresse
 * Date: 2018-11-22
 * Time: 17:42
 */

class ClientNotified
{
    public function __construct()
    {
        session_start();
        if (isset($_POST["submit"])) {
            $this->clientGetsNotified();
        }
    }

    private function clientGetsNotified(){
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        $is_notified = $_POST['notified'];

        if($is_notified == 'yes') {
            $query = "UPDATE client SET is_notified = 1 WHERE client_id = '".$_SESSION['client_id']."' ";
            if ($conn->query($query) === TRUE) {
                echo "<script>alert('Saved')</script>";
            } else {
                echo "Error: " . $query . "<br>" . $conn->error;
            }
        }
        else if($is_notified == 'no'){
            $query = "UPDATE client SET is_notified = 0 WHERE client_id = '".$_SESSION['client_id']."' ";
            if ($conn->query($query) === TRUE) {
                echo "<script>alert('Saved')</script>";
            } else {
                echo "Error: " . $query . "<br>" . $conn->error;
            }
        }
        $conn->close();
    }

}