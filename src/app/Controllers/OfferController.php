<?php

// TO DO: restructure in a class

// verifying if a POST method was submitted by the user
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=offer">';
    exit();
}

// get the data from the sign up form
$creatorId = $_SESSION['user']['userId'] ?? NULL;
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

    // create new offer
    $result = $db->createOffer($params);

    // redirect user
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=offer">';
    exit();
}

// verify which type of POST method
if (isset($_POST['offer-search'])) {

    // verify if there is data
    if (empty($departure) || empty($arrival)) {
        echo '<meta http-equiv="refresh" content="0;url=index.php?route=search">';
        exit();
    }

    $params = [
        ':departure' => $departure,
        ':arrival' => $arrival
    ];

    // search for offers
    $result = $db->getOffers($params);

    // fallback value: NULL
    // if $_SESSION['results'] is empty or NULL
    $_SESSION['results'] = $result['data'] ?? NULL;
    $_SESSION['request_submitted'] = true;

    // redirect user
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=search">';
    exit();
}

// verify which type of POST method
if (isset($_POST['offer-update'])) {

    // verify if there is data
    if (empty($offerId) || empty($departure) || empty($arrival) || empty($datetime)) {
        echo '<meta http-equiv="refresh" content="0;url=index.php?route=my-offers">';
        exit();
    }

    $params = [
        ':offerId' => $offerId,
        ':departure' => $departure,
        ':arrival' => $arrival,
        ':datetime' => $datetime
    ];

    // update offer
    $result = $db->updateOffer($params);

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

    $params = [
        ':offerId' => $offerId,
    ];
    
    // delete offer
    $result = $db->deleteOffer($params);

    // redirect user
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=my-offers">';
    exit();
}

// verify DB communication errors 
if ($result['status'] == 'error') {
    echo '<meta http-equiv="refresh" content="0;url=index.php?route=404">';
    exit();
}