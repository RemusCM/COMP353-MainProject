<?php
/**
 * Created by PhpStorm.
 * User: jasminelatendresse
 * Date: 2018-11-03
 * Time: 15:43
 */

class Account
{
    private $account_number;
    private $balance;
    private $account_type;
    private $option_name;

    public function __construct($account_number, $balance, $account_type, $option_name)
    {
        $this->account_number = $account_number;
        $this->balance = $balance;
        $this->account_type = $account_type;
        $this->option_name = $option_name;
    }




    // GETTERS

    public function getAccountNumber() {
        return $this->account_number;
    }


    public function getBalance() {
        return $this->balance;
    }

    public function getAccountType() {
        return $this->account_type;
    }


    public function getOptionName() {
        return $this->option_name;
    }

    // SETTERS

    public function setAccountNumber($account_number) {
        $this->account_number = $account_number;
        return $this;
    }


    public function setBalance($balance) {
        $this->balance = $balance;
        return $this;
    }

    public function setAccountType($account_type) {
        $this->account_type = $account_type;
        return $this;
    }


    public function setOptionName($option_name) {
        $this->option_name = $option_name;
        return $this;
    }

    public function toArray() {
        return array (
            'account_number' => $this->account_number,
            'balance' => $this->balance,
            'account_type' => $this->account_type,
            'option_name' => $this->option_name
        );
    }









}