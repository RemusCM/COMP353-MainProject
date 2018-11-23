<?php
/**
 * Created by PhpStorm.
 * User: jasminelatendresse
 * Date: 2018-11-04
 * Time: 12:44
 */

class Loan extends Account
{
    private $loan_limit;
    private $type;

    public function __construct($account_number, $balance, $account_type, $option_name, $loan_limit, $type)
    {
        parent::__construct($account_number, $balance, $account_type, $option_name);
        $this->loan_limit = $loan_limit;
        $this->type = $type;
    }

}