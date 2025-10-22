<?php

// verifying if a POST method was submitted by the user
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=offer">';
    exit();
}

// get the data from the sign up form
$creatorId = $_SESSION['user']['userId'];
$offerId = $_POST['offerId'] ?? NULL;
$departure = $_POST['departure'] ?? NULL;
$arrival = $_POST['arrival'] ?? NULL;
$datetime = $_POST['datetime'] ?? NULL;

// DB communication
$db = new Offer();

// verify which type of POST method
if (isset($_POST['offer-create'])) {

    // verify if there is data
    if (empty($creatorId) || empty($departure) || empty($arrival) || empty($datetime)) {
        echo '<meta http-equiv="refresh" content="0;url=index.php?route=offer">';
        exit();
    }

    // send data from user
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

    // redirect user
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=home">';
    exit();
}

// verify which type of POST method
if (isset($_POST['offer-update'])) {

    // verify if there is data
    if (empty($offerId) || empty($departure) || empty($arrival) || empty($datetime)) {
        echo '<meta http-equiv="refresh" content="0;url=index.php?route=my-offers">';
        exit();
    }

    // update offer
    $result = $db->updateOffer($offerId, $departure, $arrival, $datetime);

    // redirect user
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=my-offers">';
    exit();
}

// verify which type of POST method
if (isset($_POST['offer-delete'])) {

    // verify if there is data
    if (empty($offerId)) {
        echo '<meta http-equiv="refresh" content="0;url=index.php?route=my-offers">';
        exit();
    }
    
    // delete offer
    $result = $db->deleteOffer($offerId);

    // redirect user
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=my-offers">';
    exit();
}

// verify DB communication errors 
if ($result['status'] == 'error') {
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=404">';
    exit();
}