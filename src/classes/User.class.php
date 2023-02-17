<?php
include_once ("../includes/config.inc.php");

class User {

    public $firstName;
    public $lastName;
    public $email;
    public $mobile;

    public function setFirstName($firstName) {
        $this->firstName = $firstName;

    }

    public function getFirstName() {
        return $this->firstName;

    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;

    }

    public function getLastName() {
        return $this->lastName;

    }

    public function setEmail($email) {
        $this->email = $email;

    }

    public function getEmail() {
        return $this->email;

    }

    public function setMobile($mobile) {
        $this->mobile = $mobile;

    }

    public function getMobile() {
        return $this->mobile;

    }

}