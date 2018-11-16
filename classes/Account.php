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
    private $level;
    private $interest_rate;

    public function __construct($account_number, $balance, $account_type, $level, $interest_rate) {
        $this->account_number = $account_number;
        $this->balance = $balance;
        $this->account_type = $account_type;
        $this->level = $level;
        $this->interest_rate = $interest_rate;
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

    public function getLevel() {
        return $this->level;
    }

    public function getInterestRate() {
        return $this->interest_rate;
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

    public function setLevel($level) {
        $this->level = $level;
        return $this;
    }

    public function setInterestRate($interest_rate) {
        $this->interest_rate = $interest_rate;
        return $this;
    }


    public function toArray() {
        return array (
            'account_number' => $this->account_number,
            'balance' => $this->balance,
            'account_type' => $this->account_type,
            'level' => $this->level,
            'interest_rate' => $this->interest_rate
        );
    }









}