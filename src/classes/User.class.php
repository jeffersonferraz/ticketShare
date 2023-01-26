<?php
include_once ("../includes/config.inc.php");

class User {

    public $first_name;
    public $last_name;
    public $email;
    public $mobile;

    public function setFirstName($first_name) {
        $this->first_name = $first_name;

    }

    public function getFirstName() {
        return $this->first_name;

    }

    public function setLastName($last_name) {
        $this->last_name = $last_name;

    }

    public function getLastName() {
        return $this->last_name;

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