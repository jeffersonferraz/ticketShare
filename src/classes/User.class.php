<?php
include_once ("../includes/config.inc.php");

class User {

    public $first_name;
    public $last_name;
    public $email;
    public $mobile;

    // public $link;

    
    // public function __construct($databaseLink) {
    //     $this->link = $databaseLink;
    // }

    // //adding user
    // public function insertUser($first_name, $last_name, $email, $mobile) {

    //     $conn = new ConnectionDb;
        
    //     //preparing the statement for SQL command
    //     $stmt = $conn->connectDb()->prepare("INSERT INTO user (first_name, last_name, email, mobile)
    //     VALUES (:first_name, :last_name, :email, :mobile)");

    //     $stmt->bindParam(':first_name', $first_name);
    //     $stmt->bindParam(':last_name', $last_name);
    //     $stmt->bindParam(':email', $email);
    //     $stmt->bindParam(':mobile', $mobile);

    //     $stmt->execute();

    //     echo "<p>Du wurdest erfolgreich registriert.</p>";

    // }

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