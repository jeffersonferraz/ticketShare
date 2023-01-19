<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>ticketShare | Suchen</title>
</head>
<body>

    <div class="container">

        <a href="index.php"><h1>ticketShare<sup>suchen</sup></h1></a>

        <nav>
            <a href="offer_trip.php" class="button">anbieten</a>
            <a href="signup.php" class="button" id="register_btn">Registrieren</a>
        </nav>

        <form action="search_trip.php" method="post">

            <input name="departure_city" type="text" placeholder="Von"><br>

            <input name="arrival_city" type="text" placeholder="Nach"><br>

            <label for="departure">Abfahrt</label>
            <input name="departure" type="datetime-local" class="date_field"><br>

            <button name="submit_button" type="submit">Suchen</button>

        </form>

    </div>

</body>
</html>