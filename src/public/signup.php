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

        <form action="signup.php" method="post">
            <!--
            <input name="username" type="text" placeholder=" Benutzername"><br>

            <input name="password" type="password" placeholder=" Passwort"><br>

            <input name="confirm_password" type="password" placeholder=" Passwort bestätigen"><br> -->

            <input name="first_name" type="text" placeholder=" Vorname"><br>

            <input name="last_name" type="text" placeholder=" Nachname"><br>

            <input name="email" type="email" placeholder=" Email"><br>

            <input name="mobile" type="text" placeholder=" Handynummer"><br>

            <button name="signup_button" type="submit">Registrieren</button><br>

            <a href="login.php" class="button" id="register_btn">Anmelden</a>

        </form>

    </div>

    <?php
        include_once ("../includes/autoloader.inc.php");
        include_once ("../includes/link.inc.php");
        
        if (isset($_POST['signup_button'])) {

            $values = [
               // trim($_POST["username"]),
               // trim($_POST["password"]),
                trim($_POST["first_name"]), 
                trim($_POST["last_name"]), 
                trim($_POST["email"]), 
                trim($_POST["mobile"])
                ];

            $table = "user";

            $keys = [
               // "username",
               // "password",
                "firstName", 
                "lastName", 
                "email", 
                "mobile"
                ];

            $newQuery = new Query;
            $sql = $newQuery->create($table, $keys);

            $newUser = new Statement($link, $values, $table, $keys, $sql);

            $newUser->insert();

        }
    ?>

</body>
</html>