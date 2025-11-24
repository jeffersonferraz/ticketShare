<?php
require_once __DIR__ . '/includes/navbar.php';

// TO DO: create/use a View for "get offers" and "get cities"

// get offers
use App\Models\Offer;
$offerResults = Offer::getOffersByUserId($_SESSION['user']['userId']);
$offers = $offerResults['data'];
// echo '<pre>';
// print_r($offers);
// echo '</pre>';

// get cities
use App\Models\Cities;
$results = Cities::getCities();
$cities = $results['data'];
?>
<div class="container p-5 mt-2 mb-5 border rounded-3 shadow-sm bg-light text-center w-100">
    <h2 class="text-start p-2 text-dark text-opacity-75 mt-4" style="font-weight: 700;">My Offers</h2>
    <hr class="mb-4">
    <div class="row">
        <? foreach ($offers as $offer): ?>
            <div class="col">
                <div class="container text-center mb-4 p-4 rounded-3 bg-secondary bg-gradient bg-opacity-50" style="max-width: 350px;">

                    <form class="row" action="?route=offer-edit" method="POST">
                        <div class="col">
                            <p class="badge text-bg-secondary mb-4" style="font-size: 15px; font-weight: 400;"><?= 'Offer Id: ' . $offer["offerId"] ?></p>
                            <input class="form-control mb-3" name="offerId" value="<?= $offer["offerId"] ?>" hidden>

                            <select class="form-control mb-3" name="departure">
                                <option value="<?= $offer["departure"] ?>" selected disabled>
                                    <?= $cities[$offer["departure"] - 1]['cityName'] ?>
                                </option>

                                <? foreach ($cities as $city): ?>
                                    <option class="edit-city" value="<?= $city["cityId"] ?>" hidden>
                                        <?= $city["cityName"] ?>
                                    </option>
                                <? endforeach; ?>
                            </select>

                            <select class="form-control mb-3" name="arrival">
                                <option value="<?= $offer["arrival"] ?>" selected disabled>
                                    <?= $cities[$offer['arrival'] - 1]["cityName"] ?>
                                </option>

                                <? foreach ($cities as $city): ?>
                                    <option class="edit-city" value="<?= $city["cityId"] ?>" hidden>
                                        <?= $city["cityName"] ?>
                                    </option>
                                <? endforeach; ?>
                            </select>

                            <div class="edit">
                                <input class="edit form-control" id="datetime" type="datetime-local" name="datetime" value="<?= $offer['datetime'] ?>" disabled>
                            </div>
                        </div>
                        
                        <div class="mt-4 text-end">
                            <button class="btn btn-secondary btn-sm w-25" onclick="enableInputs()" type="button">Edit</button>

                            <input class="btn btn-success btn-sm w-25" type="submit" name="offer-update" value="Save">

                            <input class="btn btn-danger btn-sm w-25" type="submit" name="offer-delete" value="Delete">
                        </div>
                    </form>

                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>

<script src="../public/assets/js/myOffers.js"></script>