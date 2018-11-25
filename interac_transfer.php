<?php
$result = $_POST['from'];
$result_explode = explode('|', $result);
echo "1: ". $result_explode[0]."<br>";

echo "2:". $result_explode[1]."<br>";
echo "3:". $result_explode[2]."<br>";


$from = (int)$result_explode[0];
$account_type = (string)$result_explode[2];
$balance = number_format(floatval($result_explode[1]), 2,'.','');
$amount = number_format(floatval($_POST['amount']), 2,'.','');
echo $balance;
require_once("config/db.php");
require_once("classes/Login.php");

// Create connection
$conn = mysqli_connect(DB_HOST, DB_USER,DB_PASS,DB_NAME);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
include("views/menu.php");

?>

<!doctype html>
<html>
<head>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <title>Interac Transfer</title>
</head>
<body>

    <form method = "post" action="index.php" id="e-transfer"  name="e-transfer"><h1>Interac Transfer</h1>
        <hr>
        <div id="fromRow" class="form-group row">
            <label name="from" id="from" class="col-sm-2 col-form-label" value = <?php echo "'$from'"; ?>>From Account #: <?php echo "$from"?></label>
            <input type="hidden" name="fromTable" id="fromTable"value = <?php echo "'$from'"; ?>>
        </div>
        <div id="amountRow" class="form-group row">
            <label name="amountToTransfer" id="amountToTransfer" class="col-sm-2 col-form-label" value = <?php echo "'$amount'"; ?>>Amount to transfer: <?php echo "$amount"?></label>
            <input type="hidden" name="amountToTransfer" id="amountToTransfer" value = <?php echo "'$amount'"; ?>>

        </div>

        <?php
        if($balance<$amount && ($account_type == 'checking' ||$account_type == 'savings')){
            echo "Please go <a href='index.php'>back</a>, you are trying to send money you don't have.";
        }

        else if($account_type == 'credit' || $account_type == 'loan'){
            echo "Can't be giving money you don't own. Go <a href='index.php'>back</a> ";
        }
        else{

            echo" <div id=\"emailRow\" class=\"form-group row\">
                <label for=\"mail\" class=\"col-sm-1 col-form-label\">Email:</label>
                <div class=\"col-sm-2\">
                    <input class=\"form-control\" type=\"email\" placeholder=\"Enter recipient's email here\" id=\"mail\" name=\"mail\">
                </div>

            </div>";

            echo"<br>
            <p>OR</p>
            <br>
            <div id=\"mobileRow\" class=\"form-group row\">
            <label for=\"mobile\"class=\"col-sm-1 col-form-label\">Cellphone Number</label>
                <div class=\"col-sm-2\">
            <input id=\"mobile\" type=\"tel\" pattern=\"[1-9]\d{2}-\d{3}-\d{4}\" name=\"mobile\" placeholder=\"###-###-####\"  />
                </div>
            </div>";

            echo "<button type=\"submit\" class=\"btn btn-primary\" id=\"etransfer\" onclick='return validateForm()' name=\"etransfer\">Transfer Money</button>";

        }
        ?>


    </form>
    <script type="text/javascript">
        function validateForm()
        {
            let a=document.forms["e-transfer"]["mail"].value;
            let b=document.forms["e-transfer"]["mobile"].value;

            if (a=="" && b=="")
            {
                alert("Please Fill One of Two Fields");
                return false;
            }
        }
    </script>
</body>
</html>




