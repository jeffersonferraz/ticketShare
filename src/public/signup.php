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

            <input name="first_name" type="text" placeholder=" Vorname"><br>

            <input name="last_name" type="text" placeholder=" Nachname"><br>

            <input name="email" type="email" placeholder=" Email"><br>

            <input name="mobile" type="text" placeholder=" Handynummer"><br>

            <button name="submit_button" type="submit">Registrieren</button>

        </form>

    </div>

    <?php
        include_once ("../includes/autoloader.inc.php");
        include_once ("../includes/link.inc.php");
        
        if (isset($_POST['submit_button'])) {

            $values = [
                $_POST["first_name"], 
                $_POST["last_name"], 
                $_POST["email"], 
                $_POST["mobile"]
                ];

            $table = "user";

            $keys = [
                "first_name", 
                "last_name", 
                "email", 
                "mobile"
                ];

            $param = array_combine($keys, $values);

            $newCrud = new Crud;
            $sql = $newCrud->create($table, $keys);

            $newUser = new Statement($link, $values, $table, $keys, $sql);

            $newUser->executing($param);

        }
    ?>

</body>
</html>