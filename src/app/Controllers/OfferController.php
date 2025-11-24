<?php
namespace App\Controllers;

use App\Models\Offer;
use App\Core\View;

// to-do: create a Helper to handle the logics and get this Controller cleaner

class OfferController {

    public function viewMyOffers() {
        View::render('myOffers.php');
    }

    public function viewCreateOffer() {
        View::render('offer.php');
    }

    public function createOffer() {
        // verify if there is POST method and which case of POST method
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['offer-create'])) {
            // get the data from form
            $creatorId = $_SESSION['user']['userId'] ?? NULL;
            $departure = $_POST['departure'] ?? NULL;
            $arrival = $_POST['arrival'] ?? NULL;
            $datetime = $_POST['datetime'] ?? NULL;

            // verify if there is data
            if (empty($creatorId) || empty($departure) || empty($arrival) || empty($datetime)) {
                header("Location: index.php?route=offer&error=missing-fields");
                exit();
            }

            // create params
            $params = [
                ':creatorId' => $creatorId,
                ':departure' => $departure,
                ':arrival' => $arrival,
                ':datetime' => $datetime
            ];

            // DB communication
            $db = new Offer();

            // create new offer
            $result = $db->createOffer($params);

            // redirect user
            if ($result) {
                header("Location: index.php?route=offer&status=created");
                // to do: implement view - result message offer created

            } else {
                header("Location: index.php?route=offer&error=create-failed");
                // to do: implement view - result message create offer error
            }
            exit();
        } else {
            header("Location: index.php?route=offer&error=post-submit-failed");
            // to do???: implement view - message POST submit error

            exit();
        }
    }

    public function viewSearchOffer() {
        View::render('search.php');
    }

    public function searchOffer() {
        // verify if there is POST method and which case of POST method
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['offer-search'])) {
            // get data from form
            $departure = $_POST['departure'] ?? NULL;
            $arrival = $_POST['arrival'] ?? NULL;

            // verify if there is data
            if (empty($departure) || empty($arrival)) {
                header("Location: index.php?route=search&error=missing-fields");
                exit();
            }

            $params = [
                ':departure' => $departure,
                ':arrival' => $arrival
            ];

            // DB communication
            $db = new Offer();

            // search for offers
            $result = $db->getOffers($params);

            // fallback value: NULL
            // if $_SESSION['results'] is empty or NULL
            $_SESSION['results'] = $result['data'] ?? NULL;
            $_SESSION['request_submitted'] = true;

            // redirect user
            header("Location: index.php?route=search");
            exit();
        }
    }

    public function editOffer() {
        // verify if there is POST method and which case of POST method
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (isset($_POST['offer-update'])) {

                // get the data from form
                $offerId = $_POST['offerId'] ?? NULL;
                $departure = $_POST['departure'] ?? NULL;
                $arrival = $_POST['arrival'] ?? NULL;
                $datetime = $_POST['datetime'] ?? NULL;

                // verify if there is data
                if (empty($offerId) && empty($departure) && empty($arrival) && empty($datetime)) {
                    header("Location: index.php?route=my-offers&error=no-changes");
                    exit();
                }

                $params = [
                    ':offerId' => $offerId,
                    ':departure' => $departure,
                    ':arrival' => $arrival,
                    ':datetime' => $datetime
                ];

                // DB communication
                $db = new Offer();

                // update offer
                $result = $db->updateOffer($params);

                // redirect user
                if ($result) {
                    header("Location: index.php?route=my-offers&status=updated");
                    // to do: implement view - result message updated

                } else {
                    header("Location: index.php?route=my-offers&error=update-failed");
                    // to do: implement view - result message update error

                }
                exit();

            } else if (isset($_POST['offer-delete'])) {
                // get the data from form
                $offerId = $_POST['offerId'] ?? NULL;

                // verify if there is data
                if (empty($offerId)) {
                    header("Location: index.php?route=my-offers&error=missing-fields");
                    exit();
                }
                
                $params = [
                    ':offerId' => $offerId,
                ];

                // DB communication
                $db = new Offer();
                
                // delete offer
                $result = $db->deleteOffer($params);

                // redirect user
                if ($result) {
                    header("Location: index.php?route=my-offers&status=deleted");
                    // to do: implement view - result message deleted

                } else {
                    header("Location: index.php?route=my-offers&error=delete-failed");
                    // to do: implement view - result message delete error

                }
                exit();
            }

        } else {
            header("Location: index.php?route=my-offers&error=post-submit-failed");
            // to do???: implement view - message POST submit error

            exit();
        }
    }
}