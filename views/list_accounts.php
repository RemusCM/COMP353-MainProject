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
        // Create connection
        $conn = mysqli_connect("localhost", "root","root","testaccount");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        //TODO retrieve data from Loan, Credit and Foreign Currency and display it "' . $_SESSION['user'] . '"
        //TODO Make sure that what is displayed in the table is for the client that is logged in.

        //Checking accounts query
        $sql_checking = "SELECT DISTINCT checking.account_number, client_id, opt, balance, service_type, level FROM account, checking WHERE client_id = '" . $_SESSION['client_id'] . "' AND checking.account_number = account.account_number;";
        $result_checking = $conn->query($sql_checking);

        //Savings accounts query
        $sql_savings = "SELECT DISTINCT savings.account_number, client_id, opt, balance, service_type, level FROM account, savings WHERE client_id = '" . $_SESSION['client_id'] . "' AND savings.account_number = account.account_number;";
        $result_savings = $conn->query($sql_savings);

        //Credit accounts query
        $sql_credit = "SELECT DISTINCT credit.account_number, client_id, credit_limit, minimal_payment, service_type FROM account, credit, WHERE client_id = '" . $_SESSION['client_id'] . "' AND savings.account_number = account.account_number;";
        $result_credit = $conn->query($sql_credit);

        //Displaying checking accounts
        if ($result_checking->num_rows > 0) {
            echo "<table class='table'><caption>Checking Accounts</caption><tr><th scope=\"col\">Account Number</th><th scope=\"col\">Balance</th><th scope=\"col\">Option</th><th scope=\"col\">Service Type</th><th scope=\"col\">Level</th>";
            // output data of each row
            while($row = $result_checking->fetch_assoc()) {
                echo "<tr><td>".$row["account_number"]."</td><td>".$row["balance"]."</td><td>".$row["opt"]."</td><td>".$row["service_type"]."</td><td>".$row["level"]."</td></tr>";
            }
            echo "</table>";
        }

        echo "<hr class='style2'>";

        //Displaying savings accounts
        if ($result_savings->num_rows > 0 ) {
            echo "<table class='table'><caption>Savings Accounts</caption><tr><th scope=\"col\">Account Number</th><th scope=\"col\">Balance</th><th scope=\"col\">Option</th><th scope=\"col\">Service Type</th><th scope=\"col\">Level</th>";
            // output data of each row
            while($row = $result_savings->fetch_assoc()) {
                echo "<tr><td>".$row["account_number"]."</td><td>".$row["balance"]."</td><td>".$row["opt"]."</td><td>".$row["service_type"]."</td><td>".$row["level"]."</td></tr>";
            }
            echo "</table>";
        }

        //Displaying credit accounts
        if ($result_credit->num_rows > 0) {
            echo "<table class='table'><caption>Credit Accounts</caption><tr><th scope=\"col\">Account Number</th><th scope=\"col\">Credit Limit</th><th scope=\"col\">Service Type</th><th scope=\"col\">Level</th><th scope=\"col\">Minimal Payment</th>";
            // output data of each row
            while($row = $result_credit->fetch_assoc()) {
                echo "<tr><td>".$row["account_number"]."</td><td>".$row["credit_limit"]."</td><td>".$row["service_type"]."</td><td>".$row["level"]."</td><td>".$row["minimal_payment"]."</td></tr>";
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