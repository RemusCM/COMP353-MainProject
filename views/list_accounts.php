<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script>
        $(document).ready(function() {
            $(".hidden-content-reveal").click(function() {
                $(this).children().toggleClass('toggler');

                $(this).next('.table').slideToggle();
                return false;
            });
        });

    </script>
    <style>
        table {
            display: none;
        }

        a:link, a:visited{
          color:black;
          text-decoration: none;
        }

        a:hover, a:active{
            color:darkgray;
            text-decoration: none;
        }

    </style>
</head>
<body>
    <div class="col-md-12">
        <form method='post' action='list_accounts.php'>I want to notifications about my accounts
            <select name='notified' id='notified'>
                <option value='yes'<?php echo (isset($_POST['submit']) && $_POST['notified'] == 'yes' && $_SESSION['is_notified'] ==1) ? 'selected="selected"' : ''; ?>>Yes</option>
                <option value='no' <?php echo (isset($_POST['submit']) && $_POST['notified'] == 'no' && $_SESSION['is_notified'] == 0) ? 'selected="selected"' : ''; ?> >No</option>
            </select><br>
            <input type='submit' name='submit' id='submit' value="Save"></form>
        <?php
        /**
         * Created by PhpStorm.
         * User: jasminelatendresse
         * Date: 2018-11-19
         * Time: 17:54
         */

        session_start();
        // Create connection
        $conn = mysqli_connect(DB_HOST, DB_USER,DB_PASS,DB_NAME);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }



        //Checking accounts query
        $sql_checking = "SELECT DISTINCT checking.account_number, client_id, opt, balance, service_type, level FROM account, checking WHERE client_id = '" . $_SESSION['client_id'] . "' AND checking.account_number = account.account_number;";
        $result_checking = $conn->query($sql_checking);

        //Savings accounts query
        $sql_savings = "SELECT DISTINCT savings.account_number, client_id, opt, balance, service_type, level FROM account, savings WHERE client_id = '" . $_SESSION['client_id'] . "' AND savings.account_number = account.account_number;";
        $result_savings = $conn->query($sql_savings);

        //Credit accounts query
        $sql_credit = "SELECT DISTINCT credit.account_number, client_id, credit_limit, minimal_payment, service_type, balance, level FROM account, credit WHERE client_id = '" . $_SESSION['client_id'] . "' AND credit.account_number = account.account_number;";
        $result_credit = $conn->query($sql_credit);

        //Foreign currency accounts query
        $sql_foreignCurrency = "SELECT DISTINCT foreigncurrency.account_number, client_id, currency_type, service_type, level FROM account, foreigncurrency WHERE client_id = '" . $_SESSION['client_id'] . "' AND foreigncurrency.account_number = account.account_number;";
        $result_foreignCurrency = $conn->query($sql_foreignCurrency);

        //Loan accounts query
        $sql_loan = "SELECT DISTINCT loan.account_number, client_id, type, loan_limit, service_type,  level FROM account, loan WHERE client_id = '" . $_SESSION['client_id'] . "' AND loan.account_number = account.account_number;";
        $result_loan = $conn->query($sql_loan);



        //Displaying checking accounts
        if ($result_checking->num_rows > 0) {
            echo "<a href='#' class = 'hidden-content-reveal'><h3 class='toggler'>Checking accounts details</h3></a>";
            echo "<table class='table'><tr><th scope=\"col\">Account Number</th><th scope=\"col\">Balance</th><th scope=\"col\">Option</th><th scope=\"col\">Service Type</th><th scope=\"col\">Level</th><th scope=\"col\">Transaction Details</th>";
            // output data of each row
            while($row = $result_checking->fetch_assoc()) {
                $account_number = $row["account_number"];
                echo "<tr><td>".$account_number."</td><td>".$row["balance"]."</td><td>".$row["opt"]."</td><td>".$row["service_type"]."</td><td>".$row["level"]."</td><td><a href=\"transactions.php?id=$account_number\">View</a></td></tr>";
            }
            echo "</table>";
            echo "<hr class='style2'>";
        }



        //Displaying savings accounts
        if ($result_savings->num_rows > 0 ) {
            echo "<a href='#' class = 'hidden-content-reveal'><h3 class='toggler'>Savings accounts details</h3></a>";
            echo "<table class='table'><tr><th scope=\"col\">Account Number</th><th scope=\"col\">Balance</th><th scope=\"col\">Option</th><th scope=\"col\">Service Type</th><th scope=\"col\">Level</th><th>Transaction Details</th>";
            // output data of each row
            while($row = $result_savings->fetch_assoc()) {
                $account_number = $row["account_number"];
                echo "<tr><td>".$account_number."</td><td>".$row["balance"]."</td><td>".$row["opt"]."</td><td>".$row["service_type"]."</td><td>".$row["level"]."</td><td><a href=\"transactions.php?id=$account_number\">View</a></td></tr>";
            }
            echo "</table>";
            echo "<hr class='style2'>";
        }



        //Displaying credit accounts
        if ($result_credit->num_rows > 0) {
            echo "<a href='#' class = 'hidden-content-reveal'><h3 class='toggler'>Credit accounts details</h3></a>";
            echo "<table class='table'><tr><th scope=\"col\">Account Number</th><th scope=\"col\">Credit Limit</th><th scope=\"col\">Service Type</th><th scope=\"col\">Level</th><th scope=\"col\">Minimal Payment</th><th>Transaction Details</th>";
            // output data of each row
            while($row = $result_credit->fetch_assoc()) {
                $account_number = $row["account_number"];
                echo "<tr><td>".$account_number."</td><td>".$row["credit_limit"]."</td><td>".$row["service_type"]."</td><td>".$row["level"]."</td><td>".$row["minimal_payment"]."</td><td><a href=\"transactions.php?id=$account_number\">View</a></td></tr>";
            }
            echo "</table>";
            echo "<hr class='style2'>";
        }



        //Displaying foreign currency accounts
        if ($result_foreignCurrency->num_rows > 0) {
            echo "<a href='#' class = 'hidden-content-reveal'><h3 class='toggler'>Foreign Currency accounts details</h3></a>";
            echo "<table class='table'><tr><th scope=\"col\">Account Number</th><th scope=\"col\">Balance</th><th scope=\"col\">Currency Type</th><th scope=\"col\">Service Type</th><th scope=\"col\">Level</th><th>Transaction Details</th>";
            // output data of each row
            while($row = $result_foreignCurrency->fetch_assoc()) {
                $account_number = $row["account_number"];
                echo "<tr><td>".$account_number."</td><td>".$row["balance"]."</td><td>".$row["currency_type"]."</td><td>".$row["service_type"]."</td><td>".$row["level"]."</td><td><a href=\"transactions.php?id=$account_number\">View</a></td></tr>";
            }
            echo "</table>";
            echo "<hr class='style2'>";
        }

        //Displaying loan accounts
        if ($result_loan->num_rows > 0) {
            echo "<a href='#' class = 'hidden-content-reveal'><h3 class='toggler'>Loan accounts details</h3></a>";
            echo "<table class='table'><tr><th scope=\"col\">Account Number</th><th scope=\"col\">Loan type</th><th scope=\"col\">Loan Limit</th><th scope=\"col\">Service Type</th><th scope=\"col\">Level</th><th>Transaction Details</th>";
            // output data of each row
            while($row = $result_loan->fetch_assoc()) {
                $account_number = $row["account_number"];
                echo "<tr><td>".$account_number."</td><td>".$row["type"]."</td><td>".$row["loan_limit"]."</td><td>".$row["service_type"]."</td><td>".$row["level"]."</td><td><a href=\"transactions.php?id=$account_number\">View</a></td></tr>";
            }
            echo "</table>";
            echo "<hr class='style2'>";
        }

        $conn->close();
        ?>
    </div>
</body>
</html>