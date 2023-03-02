<?php
include_once ("../includes/autoloader.inc.php");
include_once ("../includes/link.inc.php");

    if (isset($_POST['submit_button'])) {

        $errors = [];

        $values = [
            trim($_POST["ticket_id"]),
            trim($_POST["departure_city"]),
            trim($_POST["departure"]),
            trim($_POST["arrival_city"]),
            trim($_POST["arrival"]),
            trim($_POST["seats"]),
            trim($_POST["price"])
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

        if (empty($values[0]) || empty($values[1]) || empty($values[2]) || empty($values[3]) || 
            empty($values[4]) || empty($values[5]) || empty($values[6])) {

            array_push($errors, 'Eingabe fehlt.');

        } else {

            $newQuery = new Query;
            $sql = $newQuery->create($table, $keys);

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
    <title>ticketShare | Anbieten</title>
</head>
<body>

    <div class="container">

        <a href="index.php"><h1>ticketShare<sup>anbieten</sup></h1></a>

        <nav>
            <a href="search.php" class="button">suchen</a>
            <a href="signup.php" class="button" id="register_btn">Registrieren</a>
        </nav>

        <?php
            if (isset($_POST['submit_button'])) {

                foreach ($errors as $error) {
                    echo '<div class="alert">';
                    echo $error;
                    echo '</div>';
                }
            
                if (empty($errors)) {
                    echo '<div class="success">';
                    echo "Fahrt wurde registriert!";
                    echo '</div>';
                }
            }
        ?>

        <form action="offer_trip.php" method="post">

            <label for="ticket_id">Ticket</label>
            <select name="ticket_id">
                <option value="1">Hessenticket</option>
            </select><br>

            <input type="text" name="departure_city" placeholder=" Von"><br>
            <label for="departure">Abfahrt</label>
            <input name="departure" type="datetime-local" class="date_field">

            <input type="text" name="arrival_city" placeholder=" Nach"><br>
            <label for="date">Ankunft</label>
            <input name="arrival" type="datetime-local" class="date_field"><br>

            <label for="seats">Plätze</label>
            <select name="seats">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select><br>

            <label for="price">Preis</label>
            <input name="price" type="number" min="0.00" step="0.01" max="2500.00" id="price" placeholder="0,00€"><br>

            <button name="submit_button" type="submit">Anbieten</button>

        </form>

    </div>

    

</body>
</html>