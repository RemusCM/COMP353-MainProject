<?php
/**
 * Created by PhpStorm.
 * User: v_obl
 * Date: 2018-11-22
 * Time: 11:18 PM
 */
class Employee {

    private $employee_id;
    private $title;
    private $name;
    private $address;
    private $start_date;
    private $salary;
    private $email_address;
    private $phone_number;
    private $holidays;
    private $sick_days;
    private $branch_id;

    /**
     * Employee constructor.
     * @param $employee_id
     * @param $title
     * @param $name
     * @param $address
     * @param $start_date
     * @param $salary
     * @param $email_address
     * @param $phone_number
     * @param $holidays
     * @param $sick_days
     * @param $branch_id
     */
    public function __construct($employee_id, $title, $name, $address, $start_date, $salary, $email_address, $phone_number, $holidays, $sick_days, $branch_id)
    {
        $this->employee_id = $employee_id;
        $this->title = $title;
        $this->name = $name;
        $this->address = $address;
        $this->start_date = $start_date;
        $this->salary = $salary;
        $this->email_address = $email_address;
        $this->phone_number = $phone_number;
        $this->holidays = $holidays;
        $this->sick_days = $sick_days;
        $this->branch_id = $branch_id;
    }

    /**
     * @return mixed
     */
    public function getEmployeeId()
    {
        return $this->employee_id;
    }

    /**
     * @param mixed $employee_id
     */
    public function setEmployeeId($employee_id): void
    {
        $this->employee_id = $employee_id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * @param mixed $start_date
     */
    public function setStartDate($start_date): void
    {
        $this->start_date = $start_date;
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param mixed $salary
     */
    public function setSalary($salary): void
    {
        $this->salary = $salary;
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->email_address;
    }

    /**
     * @param mixed $email_address
     */
    public function setEmailAddress($email_address): void
    {
        $this->email_address = $email_address;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phone_number;
    }

    /**
     * @param mixed $phone_number
     */
    public function setPhoneNumber($phone_number): void
    {
        $this->phone_number = $phone_number;
    }

    /**
     * @return mixed
     */
    public function getHolidays()
    {
        return $this->holidays;
    }

    /**
     * @param mixed $holidays
     */
    public function setHolidays($holidays): void
    {
        $this->holidays = $holidays;
    }

    /**
     * @return mixed
     */
    public function getSickDays()
    {
        return $this->sick_days;
    }

    /**
     * @param mixed $sick_days
     */
    public function setSickDays($sick_days): void
    {
        $this->sick_days = $sick_days;
    }

    /**
     * @return mixed
     */
    public function getBranchId()
    {
        return $this->branch_id;
    }

    /**
     * @param mixed $branch_id
     */
    public function setBranchId($branch_id): void
    {
        $this->branch_id = $branch_id;
    }


}