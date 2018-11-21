<?php
/**
 * Created by PhpStorm.
 * User: jasminelatendresse
 * Date: 2018-11-04
 * Time: 12:45
 */

class Credit extends Account
{
    private $credit_limit;
    private $minimal_payment;

    public function __construct($account_number, $balance, $account_type, $option_name, $credit_limit, $minimal_payment) {
        parent::__construct($account_number, $balance, $account_type, $option_name);
        $this->credit_limit = $credit_limit;
        $this->minimal_payment = $minimal_payment;
    }

    //GETTERS

    public function getCreditLimit() {
        return $this->credit_limit;
    }

    public function getMinimalPayment() {
        return $this->minimal_payment;
    }

    //SETTERS

    public function setCreditLimit($credit_limit) {
        $this->credit_limit = $credit_limit;
        return $this;
    }

    public function setMinimalPayment($minimal_payment) {
        $this->minimal_payment = $minimal_payment;
        return $this;
    }

}