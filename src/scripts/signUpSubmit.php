<?php

// verifying if a POST method was submitted by the user
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && !isset($_POST['signup-submit'])) {
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=signup">';
    exit();
}

// get the data from the sign up form
$firstname = $_POST['firstname'] ?? NULL;
$lastname = $_POST['lastname'] ?? NULL;
$email = $_POST['email'] ?? NULL;
$password = password_hash($_POST['password'] ?? NULL, PASSWORD_DEFAULT);

// verify if there is data
if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=signup">';
    exit();
}

// DB communication - read data from user
$db = new Database();
$params = [
    ':email' => $email
];
$sql = "SELECT * FROM users WHERE email = :email";
$result = $db->query($sql, $params);

// verify if the user already exists
if (count($result['data']) !== 0) {

    // session error
    $_SESSION['error'] = 'Email is already registered.';

    echo '<meta http-equiv="refresh" content="0;url=index.php?route=signup">';
    exit();
}

// DB communication - send data from user
$params = [
    ':firstname' => $firstname,
    ':lastname' => $lastname,
    ':email' => $email,
    ':password' => $password
];
$sql = "
INSERT INTO users (firstname, lastname, email, password) 
VALUES (:firstname, :lastname, :email, :password)
";
$result = $db->query($sql, $params);

// verify DB communication errors 
if ($result['status'] == 'error') {
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=404">';
    exit();
}

// redirect user
echo '<meta http-equiv="refresh" content="0;url=index.php?route=login">';
exit();

