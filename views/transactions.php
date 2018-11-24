<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>
    <div class="col-md-12">
        <?php
        /**
         * Created by PhpStorm.
         * User: jasminelatendresse
         * Date: 2018-11-22
         * Time: 10:41
         */
        session_start();
        // Create connection
        $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $account_number = $_GET['id'];


        //Account details
        $sql_account = "SELECT DISTINCT account_number, account_type, client_id FROM account WHERE client_id = '" . $_SESSION['client_id'] . "' AND account_number = '" .$account_number."'; ";
        $result_account = $conn->query($sql_account);
        $row_account = $result_account->fetch_assoc();

        echo "<h3>Transactions for ".$row_account['account_type']." account # ".$row_account['account_number']."</h3>";

        //Transactions
        $sql_transactions = "SELECT * FROM account, transaction WHERE transaction.account_number = account.account_number AND transaction.account_number = '" .$account_number."' AND (SELECT DATEDIFF(NOW(), date)/365)<=10;";
        $result_transactions = $conn->query($sql_transactions);

        if ($result_transactions->num_rows > 0) {
            echo "<table class='table'><tr><th scope=\"col\">Transaction Number</th><th scope=\"col\">Date</th><th scope=\"col\">Amount</th>";
            // output data of each row
            while($row = $result_transactions->fetch_assoc()) {
                echo "<tr><td>".$row["transaction_number"]."</td><td>".$row["date"]."</td><td>".$row["amount"]."</td></tr>";
            }
            echo "</table>";
        }
        else {
            echo "There are no transactions for this account yet.";
        }
        ?>
    </div>
</body>
</html>

