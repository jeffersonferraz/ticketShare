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

            <input name="username" type="text" placeholder=" Benutzername"><br>

            <input name="password" type="password" placeholder=" Passwort"><br>

            <button name="submit_button" type="submit">Anmelden</button><br>

            <a href="signup.php" class="button" id="register_btn">Registrieren</a>

        </form>

    </div>

</body>
</html>