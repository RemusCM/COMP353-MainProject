<?php
/**
 * Created by PhpStorm.
 * User: jasminelatendresse
 * Date: 2018-11-03
 * Time: 16:15
 */

class Client
{
    private $client_id;
    private $name;
    private $date_of_birth;
    private $joining_date;
    private $address;
    private $category;
    private $email_address;
    private $password;
    private $phone_number;

    public function __construct($client_id, $name, $date_of_birth, $joining_date, $address, $category, $email_address, $password, $phone_number)
    {
        $this->client_id = $client_id;
        $this->name = $name;
        $this->date_of_birth = $date_of_birth;
        $this->joining_date = $joining_date;
        $this->address = $address;
        $this->category = $category;
        $this->email_address = $email_address;
        $this->password = $password;
        $this->phone_number = $phone_number;
    }

    //GETTERS

    public function getClientId() {
        return $this->client_id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDateOfBirth() {
        return $this->date_of_birth;
    }

    public function getJoiningDate() {
        return $this->joining_date;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getEmailAddress() {
        return $this->email_address;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getPhoneNumber() {
        return $this->phone_number;
    }

    // SETTERS

    public function setClientId($client_id) {
        $this->client_id = $client_id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setDateOfBirth($date_of_birth) {
        $this->date_of_birth = $date_of_birth;
        return $this;
    }

    public function setJoiningDate($joining_date) {
        $this->joining_date = $joining_date;
        return $this;
    }

    public function setAddress($address) {
        $this->address = $address;
        return $this;
    }

    public function setCategory($category) {
        $this->category = $category;
        return $this;
    }

    public function setEmailAddress($email_address) {
        $this->email_address = $email_address;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }

    public function setPhoneNumber($phone_number) {
        $this->phone_number = $phone_number;
        return $this;
    }

}