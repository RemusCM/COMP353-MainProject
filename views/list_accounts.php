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


        // Create connection
        $conn = mysqli_connect("localhost", "root","root","testaccount");
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT account_type, account_number, balance, service_type, level FROM account";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table class='table'><tr><th scope=\"col\">Account Type</th><th scope=\"col\">Account Number</th><th scope=\"col\">Balance</th><th scope=\"col\">Service Type</th><th scope=\"col\">Level</th>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr><td scope=\"row\">".$row["account_type"]."</td><td>".$row["account_number"]."</td><td>".$row["balance"]."</td><td>".$row["service_type"]."</td><td>".$row["level"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }
        $conn->close();
        ?>
    </div>
</body>
</html>