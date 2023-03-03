<?php

session_start();

include_once ("../includes/autoloader.inc.php");
include_once ("../includes/link.inc.php");

if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    // do nothing
} else {
    header("Location: welcome.php");
    exit;
}

if (isset($_POST['login_button'])) {

    $errors = [];

    $searchedValues = 'userId, username, password';

    $values = [
        trim($_POST["email"]),
        trim($_POST["password"])
        ];

    $table = "user";

    $keys = [
        "email",
        "password"
        ];
    
    if (empty($values[0]) || empty($values[1])) {

        array_push($errors, 'Eingabe fehlt.');

    }

    if (empty($errors)) {

        $valuesCheck = [$values[0]];
        $keysCheck = [$keys[0]];

        $sql = "SELECT $searchedValues FROM $table WHERE $keys[0] = :$keys[0]";
        
        $userCheck = new Statement($link, $valuesCheck, $table, $keysCheck, $sql);
            
        $data = $userCheck->selectOne();

        if (!$data) {

            array_push($errors, 'Email nicht registriert.');

        } elseif (password_verify($values[1],$data['password'])) {
                //Session
                $_SESSION['authenticated'] = true;
                $_SESSION['userId'] = $data['userId'];
                $_SESSION['username'] = $data['username'];
                header("Location: welcome.php");

            } else {

                array_push($errors, 'Passwort inkorrekt.');

            }
    }

}
    
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>ticketShare</title>
</head>
<body>

    <div class="container">
        
        <a href="index.php"><h1>ticketShare</h1></a>

        <nav>
            <a href="search.php" class="button">suchen</a>
            <a href="offer_trip.php" class="button">anbieten</a>
        </nav>

        <?php
            
            if (isset($_POST['login_button'])) {

                foreach ($errors as $error) {
                    echo '<div class="alert">';
                    echo $error;
                    echo '</div>';
                }
            }
        ?>

        <form action="login.php" method="post">

            <input name="email" type="text" placeholder=" Email"><br>

            <input name="password" type="password" placeholder=" Passwort"><br>

            <button name="login_button" type="submit">Anmelden</button><br>

            <a href="signup.php" class="button" id="register_btn">Registrieren</a>

        </form>

    </div>

</body>
</html>