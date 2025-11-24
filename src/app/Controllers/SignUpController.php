<?php

// TO DO: restructure in a class

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

// DB communication
$db = new Signup();

$params = [
    ':email' => $email
];

// check if user already exists
$result = $db->checkUser($params);

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

$result = $db->createUser($params);

// verify DB communication errors 
if ($result['status'] == 'error') {
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=404">';
    exit();
}

// redirect user
echo '<meta http-equiv="refresh" content="0;url=index.php?route=login">';
exit();

