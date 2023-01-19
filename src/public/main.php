<?php

$title = "ticketShare";
$content = <<<html
    <div class="container">
        
        <a href="index.php"><h1>ticketShare</h1></a>

        <nav>
            <a href="search.php" class="button">suchen</a>
            <a href="offer_trip.php" class="button">anbieten</a>
        </nav>
    
        <a href="signup.php" class="button" id="register_btn">Registrieren</a>

    </div>
html;

$page = (isset($_GET["page"])) ? $_GET["page"] : "";

if ($page == "offer_trip") {

    $title = "ticketShare | Anbieten";

    $content = <<<html

    

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