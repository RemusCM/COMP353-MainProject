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

    public function __construct($account_number, $balance, $account_type, $option_name, $credit_limit)
    {
        parent::__construct($account_number, $balance, $account_type, $option_name);
        $this->credit_limit = $credit_limit;
    }

}