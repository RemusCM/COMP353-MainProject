<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="col-md-12 well" style="position:absolute; top:10%; ">
        <?php
        /**
         * Created by PhpStorm.
         * User: jasminelatendresse
         * Date: 2018-11-19
         * Time: 17:54
         */
        session_start();
        $clientId = $_SESSION['client_id'];

        // Create connection
        $conn = mysqli_connect("localhost", "root","root","testaccount");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //TODO retrieve data from Loan, Credit and Foreign Currency and display it
        //TODO Make sure that what is displayed in the table is for the client that is logged in.

        //Retrieving client id
        $sql_clientId = "SELECT client_id FROM client";
        $result_clientId = $conn->query($sql_clientId);

        //Checking accounts query
        $sql_checking = "SELECT DISTINCT checking.account_number, opt, balance, service_type, level FROM account, checking";
        $result_checking = $conn->query($sql_checking);

        //Savings accounts query
        $sql_savings = "SELECT DISTINCT savings.account_number, opt, balance, service_type, level FROM account, savings";
        $result_savings = $conn->query($sql_savings);

        //Displaying checking accounts
        if ($result_checking->num_rows > 0 && $clientId = $result_clientId) {
            echo "<table class='table'><caption>Checking Accounts</caption><tr><th scope=\"col\">Account Number</th><th scope=\"col\">Balance</th><th scope=\"col\">Option</th><th scope=\"col\">Service Type</th><th scope=\"col\">Level</th>";
            // output data of each row
            while($row = $result_checking->fetch_assoc()) {
                echo "<tr><td>".$row["account_number"]."</td><td>".$row["balance"]."</td><td>".$row["opt"]."</td><td>".$row["service_type"]."</td><td>".$row["level"]."</td></tr>";
            }
            echo "</table>";
        }

        //Displaying savings accounts
        if ($result_savings->num_rows > 0 && $clientId = $result_clientId) {
            echo "<table class='table'><caption>Savings Accounts</caption><tr><th scope=\"col\">Account Number</th><th scope=\"col\">Balance</th><th scope=\"col\">Option</th><th scope=\"col\">Service Type</th><th scope=\"col\">Level</th>";
            // output data of each row
            while($row = $result_savings->fetch_assoc()) {
                echo "<tr><td>".$row["account_number"]."</td><td>".$row["balance"]."</td><td>".$row["opt"]."</td><td>".$row["service_type"]."</td><td>".$row["level"]."</td></tr>";
            }
            echo "</table>";
        }

        else {
            echo "";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>