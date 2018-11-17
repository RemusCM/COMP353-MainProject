<?php
/**
 * Created by PhpStorm.
 * User: jasminelatendresse
 * Date: 2018-11-08
 * Time: 10:15
 */
session_start();
$clientJoiningDate = $_SESSION['joining_date'];
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    $clientJoiningDate = <?php echo $clientJoiningDate;?>;
    //Handling what the client sees when filling the form to create an account depending on selected elements
    $(function() {
        $('#foreign-currency').hide();
        $('#credit-card').hide();
        $('#loan').hide();
        $('#account-type').change(function(){
            if ($('#account-type').val() == 'checking' || $('#account-type').val() == 'savings') {
                $('#foreign-currency').hide();
                $('#credit-card').hide();
                $('#loan').hide();
                $('#charge-plan').show();
            }
            else if($('#account-type').val() == 'foreign-currency') {
                $('#foreign-currency').show();
                $('#credit-card').hide();
                $('#loan').hide();
                $('#charge-plan').hide();
            }
            else if($('#account-type').val() == 'credit' ) {
                $('#credit-card').show();
                $('#charge-plan').hide();
                $('#loan').hide();
                $('#foreign-currency').hide();
            }
            else if($('#account-type').val() == 'loan') {
                $('#credit-card').hide();
                $('#charge-plan').hide();
                $('#loan').show();
                $('#foreign-currency').hide();
            }
        });
    });

    function validateForm() {
        if($('#account-type').val() == 'credit' ) {
            if($clientJoiningDate < 6) {
                alert('You cannot open a credit account unless you have been a client for at least 6 months.');
                return false;
            }
        }
        if($('#account-type').val() == 'loan' && $('#loan-type').val() == 'line-of-credit') {
            if($clientJoiningDate < 12) {
                alert('You cannot open a Line of Credit unless you have been a client for at least 12 months.');
                return false;
            }
        }
    }
</script>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<html>
<div class="col-md-12 well" style="position:absolute; top:10%; left:40%; width:20%;">

    <h3>Create an account</h3>
    <form method="post" action="AccountCreated.php" class="form-horizontal" name="create-account-form" onsubmit="return validateForm();">

        <br><label>Select an account level</label><br>
        <select name="level">
            <option value="personal">Personal</option>
            <option value="business">Business</option>
            <option value="corporate">Corporate</option>
        </select><br>

        <br><label>Select a service type</label><br>
        <select name="service-type">
            <option value="banking">Banking</option>
            <option value="investment">Investment</option>
            <option value="insurance">Insurance</option>
        </select><br>

        <br><label>Select an account type</label><br>
        <select name="account-type" id="account-type">
            <option value="checking">Checking</option>
            <option value="savings">Savings</option>
            <option value="foreign-currency">Foreign Currency</option>
            <option value="credit">Credit</option>
            <option value="loan">Loan</option>
        </select><br>

        <div id="charge-plan">
            <br> <label>Select a charge plan for your account</label><br>
            <input type="radio" name="charge-plan" value="basic" checked> Basic<br>
            <input type="radio" name="charge-plan" value="student"> Student<br>
            <input type="radio" name="charge-plan" value="premium"> Premium<br>
            <input type="radio" name="charge-plan" value="platinum"> Platinum<br>
            <input type="radio" name="charge-plan" value="senior"> Senior<br>
        </div>

        <div id="foreign-currency">
            <br><label>Select a foreign currency</label><br>
            <input type="radio" name="currency" value="usd" checked> USD<br>
            <input type="radio" name="currency" value="jpy"> JPY<br>
            <input type="radio" name="currency" value="eur"> EUR<br>
            <input type="radio" name="currency" value="cny"> CNY<br>
        </div>

        <div id="credit-card">
            <br><label>Select a credit card limit</label><br>
            <input type="radio" name="credit-limit" value="500.00" checked> 500$<br>
            <input type="radio" name="credit-limit" value="1000.00"> 1000$<br>
            <input type="radio" name="credit-limit" value="5000.00"> 5000$<br>
            <input type="radio" name="credit-limit" value="10000.00"> 10 000$<br>
        </div>

        <div id="loan">
            <br><label>Select a loan type</label><br>
            <select name="loan-type" id="loan-type">
                <option value="loan"> Loan</option>
                <option value="mortgage"> Mortgage</option>
                <option value="line-of-credit"> Line of credit</option>
            </select><br>

            <br><label>Select a limit</label><br>
            <input type="radio" name="loan-limit" value="5000.00" checked> 5000$<br>
            <input type="radio" name="loan-limit" value="10000.00"> 10 000$<br>
            <input type="radio" name="loan-limit" value="15000.00"> 15 000$<br>
            <input type="radio" name="loan-limit" value="25000.00"> 25 000$<br>
        </div><br>
        <input type="submit" >
    </form>
</div>
</html>