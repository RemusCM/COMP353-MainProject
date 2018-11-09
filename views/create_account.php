<?php
/**
 * Created by PhpStorm.
 * User: jasminelatendresse
 * Date: 2018-11-08
 * Time: 10:15
 */

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
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
            else if($('#account-type').val() == 'credit') {
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
</script>

<h1>Create an Account</h1>
<form method="post" action="AccountCreated.php" name="create-account-form">

    <p>Select an account level</p>
    <select name="level">
        <option value="personal">Personal</option>
        <option value="business">Business</option>
        <option value="corporate">Corporate</option>
    </select>

    <p>Select a service type</p>
    <select name="service-type">
        <option value="banking">Banking</option>
        <option value="investment">Investment</option>
        <option value="insurance">Insurance</option>
    </select>

    <!--TODO Credit should only appear if joining_date in $_SESSION is bigger than 6 months -->
    <p>Select an account type</p>
    <select name="account-type" id="account-type">
        <option value="checking">Checking</option>
        <option value="savings">Savings</option>
        <option value="foreign-currency">Foreign Currency</option>
        <option value="credit">Credit</option>
        <option value="loan">Loan</option>
    </select>

    <div id="charge-plan">
        <p>Select a charge plan for your account</p>
        <input type="radio" name="charge-plan" value="basic" checked>Basic<br>
        <input type="radio" name="charge-plan" value="student">Student<br>
        <input type="radio" name="charge-plan" value="premium">Premium<br>
        <input type="radio" name="charge-plan" value="platinum">Platinum<br>
        <input type="radio" name="charge-plan" value="senior">Senior<br>
    </div>

    <div id="foreign-currency">
        <p>Select a foreign currency</p>
        <input type="radio" name="currency" value="usd">USD<br>
        <input type="radio" name="currency" value="jpy">JPY<br>
        <input type="radio" name="currency" value="eur">EUR<br>
        <input type="radio" name="currency" value="cny">CNY<br>
    </div>

    <div id="credit-card">
        <p>Select a credit card limit</p>
        <input type="radio" name="credit-limit" value="500.00" checked>500$<br>
        <input type="radio" name="credit-limit" value="1000.00">1000$<br>
        <input type="radio" name="credit-limit" value="5000.00">5000$<br>
        <input type="radio" name="credit-limit" value="10000.00">10 000$<br>
    </div>

    <!--TODO Line-of-Credit should only appear if joining_date in $_SESSION is bigger than 12 months -->

    <div id="loan">
        <p>Select a loan type</p>
        <select name="loan-type">
            <option value="loan">Loan</option>
            <option value="mortgage">Mortgage</option>
            <option value="line-of-credit">Line of credit</option>
        </select>

        <p>Select a limit type</p>
        <input type="radio" name="loan-limit" value="5000.00">5000$<br>
        <input type="radio" name="loan-limit" value="10000.00">10 000$<br>
        <input type="radio" name="loan-limit" value="15000.00">15 000$<br>
        <input type="radio" name="loan-limit" value="25000.00">25 000$<br>
    </div><br>
    <input type="submit">
</form>
