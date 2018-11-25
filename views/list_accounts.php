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

        a.hidden-content-reveal:link, a.hidden-content-reveal:visited{
          color:black;
          text-decoration: none;
        }

        a.hidden-content-reveal:hover, a.hidden-content-reveal:active{
            color:darkgray;
            text-decoration: none;
        }

    </style>
</head>
<body>
    <div class="col-md-12">
        <?php
        /**
         * Created by PhpStorm.
         * User: jasminelatendresse
         * Date: 2018-11-19
         * Time: 17:54
         */


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


        //Here are the queries to use for transferring money from an account to another.
        //From: All accounts except foreign currency and Mortgage type loans, and loans and credits balance<lent limit
        //From Checkings accounts query
        $sql_checking_from = "SELECT DISTINCT checking.account_number, balance, account_type FROM account, checking WHERE client_id = '" . $_SESSION['client_id'] . "' AND checking.account_number = account.account_number AND balance > 0.00;";
        $result_checking_from = $conn->query($sql_checking_from);

        //From Savings accounts query
        $sql_savings_from = "SELECT DISTINCT savings.account_number, balance, account_type FROM account, savings WHERE client_id = '" . $_SESSION['client_id'] . "' AND savings.account_number = account.account_number AND balance>0.00;";
        $result_savings_from = $conn->query($sql_savings_from);

        //From Credit accounts query
        $sql_credit_from = "SELECT DISTINCT credit.account_number, balance, account_type FROM account, credit WHERE client_id = '" . $_SESSION['client_id'] . "' AND credit.account_number = account.account_number AND balance < credit_limit;";
        $result_credit_from = $conn->query($sql_credit_from);

        //From Loan accounts query
        $sql_loan_from = "SELECT DISTINCT loan.account_number, balance, account_type FROM account, loan WHERE client_id = '" . $_SESSION['client_id'] . "' AND loan.account_number = account.account_number AND balance< loan_limit AND type<>'mortgage';";
        $result_loan_from = $conn->query($sql_loan_from);


        //To: All accounts except foreign currency
        //Checking accounts query
        $sql_checking_to = "SELECT DISTINCT checking.account_number, balance, account_type FROM account, checking WHERE client_id = '" . $_SESSION['client_id'] . "' AND checking.account_number = account.account_number;";
        $result_checking_to = $conn->query($sql_checking_to);

        //Savings accounts query
        $sql_savings_to = "SELECT DISTINCT savings.account_number, balance, account_type FROM account, savings WHERE client_id = '" . $_SESSION['client_id'] . "' AND savings.account_number = account.account_number;";
        $result_savings_to = $conn->query($sql_savings_to);

        //Credit accounts query
        $sql_credit_to = "SELECT DISTINCT credit.account_number, balance, account_type FROM account, credit WHERE client_id = '" . $_SESSION['client_id'] . "' AND credit.account_number = account.account_number;";
        $result_credit_to = $conn->query($sql_credit_to);

        //Loan accounts query
        $sql_loan_to = "SELECT DISTINCT loan.account_number, balance, account_type, type FROM account, loan WHERE client_id = '" . $_SESSION['client_id'] . "' AND loan.account_number = account.account_number;";
        $result_loan_to = $conn->query($sql_loan_to);


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



        <form method='post'>I want to received notifications about my accounts
            <select name='notified' id='notified'>
                <option value='yes'<?php echo (isset($_POST['submit']) && ($_POST['notified'] == 'yes' && $_SESSION['is_notified'] == 1)) ? 'selected="selected"' : ''; ?>>Yes</option>
                <option value='no' <?php echo (isset($_POST['submit']) && ($_POST['notified'] == 'no' && $_SESSION['is_notified'] == 0)) ? 'selected="selected"' : ''; ?> >No</option>
            </select><br>
            <input type='submit' name='submit' id='submit' class ="btn btn-primary" value="Save"></form>




        <form method='post' action="#" id="transfer" name="transfer"><h1>Fast Transfers</h1>
            <hr>
                <div id="fromRow" class="form-group row">
                    <label for="from" class="col-sm-1 col-form-label">From:</label>
                    <div class="col-sm-2">
                <select name='from' id="from" class="form-control" required>
                    <option value="" disabled selected hidden>Select an Account</option>
                    <?php
                    if($result_checking_from -> num_rows >0) {
                        while ($row = $result_checking_from->fetch_assoc()) {
                            $account_number = $row["account_number"];
                            $balance = $row["balance"];
                            $account_type = $row["account_type"];
                            echo "<option value='$account_number|$balance|$account_type'>$account_number --- $balance --- $account_type</option>";
                        }
                    }
                    if($result_savings_from -> num_rows >0) {
                        while ($row = $result_savings_from->fetch_assoc()) {
                            $account_number = $row["account_number"];
                            $balance = $row["balance"];
                            $account_type = $row["account_type"];
                            echo "<option value='$account_number|$balance|$account_type'>$account_number --- $balance --- $account_type</option>";
                        }
                    }
                    if($result_credit_from -> num_rows >0) {
                        while ($row = $result_credit_from->fetch_assoc()) {
                            $account_number = $row["account_number"];
                            $balance = $row["balance"];
                            $account_type = $row["account_type"];
                            echo "<option value='$account_number|$balance|$account_type'>$account_number --- $balance --- $account_type</option>";
                        }
                    }
                    if($result_loan_from -> num_rows >0) {
                        while ($row = $result_loan_from->fetch_assoc()) {
                            $account_number = $row["account_number"];
                            $balance = $row["balance"];
                            $account_type = $row["account_type"];
                            echo "<option value='$account_number|$balance|$account_type'>$account_number --- $balance --- $account_type --- " . $row["type"] . "</option>";
                        }
                    }
                    ?>


                </select>
                    </div>

            </div>
            <div id="toRow" class="form-group row">
                <label for="to" class="col-sm-1 col-form-label">To:</label>
                <div class="col-sm-2">
                    <select name='to' id="to" class="form-control" required>
                        <option value="" disabled selected hidden>Select an Account</option>

                        <?php
                        if($result_checking_to -> num_rows >0) {
                            while ($row = $result_checking_to->fetch_assoc()) {
                                $account_number = $row["account_number"];
                                $balance = $row["balance"];
                                $account_type = $row["account_type"];
                                echo "<option value='$account_number|$balance|$account_type'>$account_number --- $balance --- $account_type</option>";
                            }
                        }
                        if($result_savings_to -> num_rows >0) {
                            while ($row = $result_savings_to->fetch_assoc()) {
                                $account_number = $row["account_number"];
                                $balance = $row["balance"];
                                $account_type = $row["account_type"];
                                echo "<option value='$account_number|$balance|$account_type'>$account_number --- $balance --- $account_type</option>";
                            }
                        }
                        if($result_credit_to -> num_rows >0) {
                            while ($row = $result_credit_to->fetch_assoc()) {
                                $account_number = $row["account_number"];
                                $balance = $row["balance"];
                                $account_type = $row["account_type"];
                                echo "<option value='$account_number|$balance|$account_type'>$account_number --- $balance --- $account_type</option>";
                            }
                        }
                        if($result_loan_to -> num_rows >0) {
                            while ($row = $result_loan_to->fetch_assoc()) {
                                $account_number = $row["account_number"];
                                $balance = $row["balance"];
                                $account_type = $row["account_type"];
                                echo "<option value='$account_number|$balance|$account_type'>$account_number --- $balance --- $account_type </option>";
                            }
                        }
                        ?>

                        <option value="null" disabled>-----------------------</option>
                        <option value="interac_transfer.php">Interac E-Transfer</option>


                    </select>
                </div>

            </div>

            <div id="amountRow" class="form-group row">
                <label for="amount" class="col-sm-1 col-form-label">Amount($):</label>
                <div class="col-sm-2">
                    <input class="form-control" type="text" placeholder="Enter amount here" id="amount" name="amount"required>
                </div>

            </div>



            <button type="submit" class="btn btn-primary" id="transfer" name="transfer">Transfer Money</button>


            </form>

    </div>
<script>

    document.getElementById('transfer').to.onchange = function() {
        var newaction = this.value;
        if(newaction == "interac_transfer.php") {
            document.getElementById('transfer').action = newaction;
        }
        else
            document.getElementById('transfer').action = "";
    };
</script>
</body>
</html>