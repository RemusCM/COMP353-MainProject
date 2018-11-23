<?php
/**
 * Created by PhpStorm.
 * User: jasminelatendresse
 * Date: 2018-11-04
 * Time: 12:38
 */

class Checking extends Account
{
    public function __construct($account_number, $balance, $account_type, $option_name)
    {
        parent::__construct($account_number, $balance, $account_type, $option_name);
    }

}