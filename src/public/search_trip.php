<?php
include_once ("../includes/autoloader.inc.php");
include_once ("../includes/link.inc.php");

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
    <div class="container" id="search_trip">

        <h2>Fahrten</h2><br>

        <?php

            $searchedValues =  
                "departureCity,
                departure,
                arrivalCity,
                arrival,
                seats,
                price";

            $values = [
                $_POST["departure_city"],
                $_POST["arrival_city"]
                ];

            $table = "trip";

            $keys = [
                "departureCity",
                "arrivalCity"
                ];

            $newQuery = new Query;
            $sql = $newQuery->read($table, $keys, $searchedValues);

            $newSearch = new Statement($link, $values, $table, $keys, $sql);
            $trips = $newSearch->select();
            
        ?>

        <table>
            <thead>
                <tr>
                    <th>Abfahrt</th>
                    <th>Uhrzeit</th>
                    <th>Ankunft</th>
                    <th>Uhrzeit</th>
                    <th>Plätze</th>
                    <th>Preis</th>
                </tr>
            </thead>

            <tbody>

                <?php foreach($trips as $trip): ?>

                    <tr>
                        <td><?= $trip["departureCity"]?></td>
                        <td><?= $trip["departure"]?></td>
                        <td><?= $trip["arrivalCity"]?></td>
                        <td><?= $trip["arrival"]?></td>
                        <td><?= $trip["seats"]?></td>
                        <td><?= $trip["price"]?></td>
                    </tr>

                <?php endforeach; ?>

            </tbody>
        </table>

        <nav>
            <a href="search.php" class="button">suchen</a>
            <a href="offer_trip.php" class="button">anbieten</a>
        </nav>

    </div>
</body>
</html>