<?php
$result = $_POST['from'];
$result_explode = explode('|', $result);


$from = (int)$result_explode[0];
$account_type = (string)$result_explode[2];
$balance = number_format(floatval($result_explode[1]), 2,'.','');
$amount = number_format(floatval($_POST['amount']), 2,'.','');

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

</head>
<body>
<div class="col-md-12 well" style="position:absolute; top:10%; left:30%; width:40%;">
    <form method = "post" action="index.php" id="e-transfer"  name="e-transfer"><h4>Interac Transfer</h4>
        <hr>
        <div id="fromRow" class="form-group row">
            <label name="from" id="from" class="col-sm-8 col-form-label" value = <?php echo "'$from'"; ?>>From Account #: <?php echo "$from"?></label>
            <input type="hidden" name="fromTable" id="fromTable"value = <?php echo "'$from'"; ?>>
        </div>
        <div id="amountRow" class="form-group row">
            <label name="amountToTransfer" id="amountToTransfer" class="col-sm-8 col-form-label" value = <?php echo "'$amount'"; ?>>Amount to transfer: <?php echo "$amount"?></label>
            <input type="hidden" name="amountToTransfer" id="amountToTransfer" value = <?php echo "'$amount'"; ?>>

        </div>

        <?php
        if($balance<$amount && ($account_type == 'checking' ||$account_type == 'savings')){
            echo "Please go <a href='index.php'>back</a>, you are trying to send more money than you currently own.";
        }

        else if($account_type == 'credit' || $account_type == 'loan'){
            echo "Can't be giving money you don't own. Go <a href='index.php'>back</a> and pick a checking or savings account. ";
        }
        else{

            echo" <div id=\"emailRow\" class=\"form-group row\">
                <label for=\"mail\" class=\"col-sm-4 col-form-label\">Email:</label>
                <div class=\"col-sm-8\">
                    <input class=\"form-control\" type=\"email\" placeholder=\"Enter recipient's email here\" id=\"mail\" name=\"mail\">
                </div>

            </div>";

            echo"<br>
            <p>OR</p>
            <br>
            <div id=\"mobileRow\" class=\"form-group row\">
            <label for=\"mobile\"class=\"col-sm-4 col-form-label\">Cellphone Number</label>
                <div class=\"col-sm-8\">
            <input id=\"mobile\" type=\"tel\" pattern=\"[1-9]\d{2}-\d{3}-\d{4}\" name=\"mobile\" placeholder=\"###-###-####\"  />
                </div>
            </div>";

            echo "<button type=\"submit\" class=\"btn btn-primary\" id=\"etransfer\" onclick='return validateForm()' name=\"etransfer\">Transfer Money</button>";

        }
        ?>


    </form>
</div>
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




