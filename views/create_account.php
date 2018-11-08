<?php
/**
 * Created by PhpStorm.
 * User: jasminelatendresse
 * Date: 2018-11-08
 * Time: 10:15
 */
?>
<h1>Create an Account</h1>
<form method="post" action="" name="create-account-form">

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

    <p>Select an account type</p>
    <select name="account-type">
        <option value="checking">Checking</option>
        <option value="savings">Savings</option>
        <option value="foreign-currency">Foreign Currency</option>
        <option value="credit">Credit</option>
        <option value="loan">Loan</option>
    </select>

    <div id="charge-plan">
        <p>Select a charge plan for your account</p>
        <input type="radio", name="charge-plan", value="basic" checked>Basic<br>
        <input type="radio", name="charge-plan", value="student">Student<br>
        <input type="radio", name="charge-plan", value="premium">Premium<br>
        <input type="radio", name="charge-plan", value="platinum">Platinum<br>
        <input type="radio", name="charge-plan", value="senior">Senior<br>
    </div>

    <div id="foreign-currency">
        <p>Select a foreign currency</p>
        <input type="radio", name="currency", value="usd">USD<br>
        <input type="radio", name="currency", value="jpy">JPY<br>
        <input type="radio", name="currency", value="eur">EUR<br>
        <input type="radio", name="currency", value="cny">CNY<br>
    </div>

    <div id="credit-card">
        <p>Select a credit card limit</p>
        <select name="credit-limit">
            <option value="500">500$</option>
            <option value="1000">1000$</option>
            <option value="5000">5000$</option>
            <option value="10000">10000$</option>
        </select>
    </div>
</form>

