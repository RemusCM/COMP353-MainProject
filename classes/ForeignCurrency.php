<?php
/**
 * Created by PhpStorm.
 * User: jasminelatendresse
 * Date: 2018-11-04
 * Time: 12:46
 */

class ForeignCurrency extends Account
{
    private $currency_type;

    public function __construct($account_number, $balance, $account_type, $option_name, $currency_type)
    {
        parent::__construct($account_number, $balance, $account_type, $option_name);
        $this->currency_type = $currency_type;
    }

}