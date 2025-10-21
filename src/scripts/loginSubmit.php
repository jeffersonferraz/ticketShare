<?php

// verifying if a POST method was submitted by the user
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && isset($_POST['login-submit'])) {
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=login">';
    exit();
}

// get the user submitted data
$email = $_POST['email'] ?? NULL;
$password = $_POST['password'] ?? NULL;

// verify if there is data
if (empty($email) || empty($password)) {
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=login">';
    exit();
}

// DB communication - get data from user
$db = new Database();
$params = [
    ':email' => $email
];
$sql = "SELECT * FROM users WHERE email = :email";
$result = $db->query($sql, $params);

// verify DB communication errors 
if ($result['status'] == 'error') {
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=404">';
    exit();
}

// verify if the user already exists
if (count($result['data']) == 0) {

    // session error
    $_SESSION['error'] = 'Invalid email or password.';

    echo '<meta http-equiv="refresh" content="0;url=index.php?route=login">';
    exit();
}

// verify if the password match
if (!password_verify($password, $result['data'][0]->password)) {

    // session error
    $_SESSION['error'] = 'Email or password invalid.';

    echo '<meta http-equiv="refresh" content="0;url=index.php?route=login">';
    exit();
}

// define the of the user
$_SESSION['user'] = $result['data'][0];

// redirect user
echo '<meta http-equiv="refresh" content="0;url=index.php?route=home">';
exit();