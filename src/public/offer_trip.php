<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title>ticketShare | Anbieten</title>
</head>
<body>

    <div class="container">

        <a href="index.php"><h1>ticketShare<sup>anbieten</sup></h1></a>

        <nav>
            <a href="search.php" class="button">suchen</a>
            <a href="signup.php" class="button" id="register_btn">Registrieren</a>
        </nav>

        <form action="offer_trip.php" method="post">

            <label for="ticket_id">Ticket</label>
            <select name="ticket_id">
                <option value="1">Hessenticket</option>
            </select><br>

            <input type="text" name="departure_city" placeholder=" Von"><br>
            <label for="departure">Abfahrt</label>
            <input name="departure" type="datetime-local" class="date_field" required>

            <input type="text" name="arrival_city" placeholder=" Nach"><br>
            <label for="date">Ankunft</label>
            <input name="arrival" type="datetime-local" class="date_field" required><br>

            <label for="seats">Plätze</label>
            <select name="seats">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select><br>

            <label for="price">Preis</label>
            <input name="price" type="number" min="0.00" step="0.01" max="2500.00" id="price" placeholder="0,00€" required><br>

            <button name="submit_button" type="submit">Anbieten</button>

        </form>

    </div>

    <?php
        include_once ("../includes/autoloader.inc.php");
        include_once ("../includes/link.inc.php");

        if (isset($_POST['submit_button'])) {

            $values = [
                $_POST["ticket_id"],
                $_POST["departure_city"],
                $_POST["departure"],
                $_POST["arrival_city"],
                $_POST["arrival"],
                $_POST["seats"],
                $_POST["price"]
            ];

            $table = "trip";

            $keys = [
                "ticketId",
                "departureCity",
                "departure",
                "arrivalCity",
                "arrival",
                "seats",
                "price"
            ];

            $newQuery = new Query;
            $sql = $newQuery->create($table, $keys);

            $newUser = new Statement($link, $values, $table, $keys, $sql);

            $newUser->insert();
            
        }
    ?>

</body>
</html>