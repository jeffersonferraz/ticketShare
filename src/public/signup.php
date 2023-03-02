<?php
include_once ("../includes/autoloader.inc.php");
include_once ("../includes/link.inc.php");

    if (isset($_POST['signup_button'])) {

        $errors = [];

        $searchedValue = 'userId';

        $values = [
            trim($_POST["username"]),
            trim($_POST["password"]),
            trim($_POST["first_name"]), 
            trim($_POST["last_name"]), 
            trim($_POST["email"]), 
            trim($_POST["mobile"])
            ];

        $confirmPassword = trim($_POST["confirm_password"]);

        $table = "user";

        $keys = [
            "username",
            "password",
            "firstName", 
            "lastName", 
            "email", 
            "mobile"
            ];
        
        if (empty($values[0]) || empty($values[1]) || empty($values[2]) || empty($values[3]) || 
            empty($values[4]) || empty($values[5]) || empty($confirmPassword)) {

            array_push($errors, 'Eingabe fehlt.');

        } else {

            $valuesCheck = [$values[0], $values[4]];
            $keysCheck = [$keys[0], $keys[4]];

            $sql = "SELECT $searchedValue FROM $table WHERE $keysCheck[0] = :$keysCheck[0] 
                    OR $keysCheck[1] = :$keysCheck[1]";

            $newUserCheck = new Statement($link, $valuesCheck, $table, $keysCheck, $sql);
            
            $data = $newUserCheck->select();

            if (!empty($data)) {
                array_push($errors, 'Benutzername oder Email vorhanden.');
            }

            if ($values[1] != $confirmPassword) {
                array_push($errors, 'Passwort stimmt nicht überein.');
            }

        }

        if (empty($errors)) {

            $newQuery = new Query;
            $sql = $newQuery->create($table, $keys);

            $values[1] = password_hash($values[1], PASSWORD_DEFAULT);

            $newUser = new Statement($link, $values, $table, $keys, $sql);

            $newUser->insert();

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
            if (isset($_POST['signup_button'])) {

                foreach ($errors as $error) {
                    echo '<div class="alert">';
                    echo $error;
                    echo '</div>';
                }
            
                if (empty($errors)) {
                    echo '<div class="success">';
                    echo "Benutzer wurde registriert!";
                    echo '</div>';
                }
            }
        ?>

        <form action="signup.php" method="post">
           
            <input name="username" type="text" placeholder=" Benutzername"><br>

            <input name="password" type="password" placeholder=" Passwort"><br>

            <input name="confirm_password" type="password" placeholder=" Passwort bestätigen"><br>

            <input name="first_name" type="text" placeholder=" Vorname"><br>

            <input name="last_name" type="text" placeholder=" Nachname"><br>

            <input name="email" type="email" placeholder=" Email"><br>

            <input name="mobile" type="text" placeholder=" Handynummer"><br>

            <button name="signup_button" type="submit">Registrieren</button><br>

            <a href="login.php" class="button" id="register_btn">Anmelden</a>

        </form>

    </div>



</body>
</html>