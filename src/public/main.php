<?php

$title = "ticketShare";

$content = <<<html
        <div class="container">
            
            <a href="index.php"><h1>ticketShare</h1></a>

            <nav>
                <a href="?page=search_trip" class="button">suchen</a>
                <a href="?page=offer_trip" class="button">anbieten</a>
            </nav>
        
            <a href="?page=signup" class="button" id="register_btn">Registrieren</a>

        </div>
    html;

$page = (isset($_GET["page"])) ? $_GET["page"] : "";



if ($page == "offer_trip") {

    $title = "ticketShare | Anbieten";

    $content = <<<html

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

        html;

} else if ($page == "search_trip"){


    $title = "ticketShare | Suchen";

    $content = <<<html

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

        html;

} else if ($page == "signup"){


    $title = "ticketShare | Registrieren";

    $content = <<<html

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

        html;
}



?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/main.css">
    <title><?$title?></title>
</head>
<body>
    <? echo $content; ?>
</body>
</html>