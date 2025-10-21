<?php

// verifying if a POST method was submitted by the user
if ($_SERVER['REQUEST_METHOD'] !== 'POST' && !isset($_POST['offer-submit'])) {
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=offer">';
    exit();
}

// get the data from the sign up form
$creatorId = $_SESSION['user']['userId'];
$departure = $_POST['departure'] ?? NULL;
$arrival = $_POST['arrival'] ?? NULL;
$datetime = $_POST['datetime'] ?? NULL;

// verify if there is data
if (empty($creatorId) || empty($departure) || empty($arrival) || empty($datetime)) {
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=offer">';
    exit();
}

// DB communication - proof
$db = new Offer();

// DB communication - send data from user
$params = [
    ':creatorId' => $creatorId,
    ':departure' => $departure,
    ':arrival' => $arrival,
    ':datetime' => $datetime
];
$sql = "
INSERT INTO offers (creatorId, departure, arrival, datetime) 
VALUES (:creatorId, :departure, :arrival, :datetime)
";
$result = $db->query($sql, $params);

// verify DB communication errors 
if ($result['status'] == 'error') {
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=404">';
    exit();
}

// redirect user
echo '<meta http-equiv="refresh" content="0;url=index.php?route=home">';
exit();