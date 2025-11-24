<?php
require_once __DIR__ . '/includes/navbar.php';

// get cities
use App\Models\Cities;
$results = Cities::getCities();
$cities = $results['data'];
?>
<div class="container p-5 mt-2 border rounded-3 shadow-sm bg-light text-center w-100">
    <h2 class="text-start p-2 text-dark text-opacity-75 mt-4" style="font-weight: 700;">Search for a Ride</h2>
    <hr class="mb-4">
    <div class="col">
        <div class="mb-5 p-4 rounded-3 bg-secondary bg-gradient bg-opacity-50" style="max-width: 350px; margin:auto;">

            <form action="?route=offer-search" method="POST">

                <select class="form-control mb-3" name="departure">
                    <option selected disabled>Departure</option>
                    <? foreach ($cities as $city): ?>
                        <option value="<?= $city["cityId"] ?>">
                            <?= $city["cityName"] ?>
                        </option>
                    <? endforeach; ?>
                </select>

                <select class="form-control mb-4" name="arrival">
                    <option selected disabled>Arrival</option>
                    <? foreach ($cities as $city): ?>
                        <option value="<?= $city["cityId"] ?>">
                            <?= $city["cityName"] ?>
                        </option>
                    <? endforeach; ?>
                </select>

                <div>
                    <input class="btn btn-success w-100" type="submit" name="offer-search" value="Search">
                </div>

            </form>

        </div>
    </div>

    <!-- TO DO: create a View for this table -->
    <div class="container">

        <!-- false: if $_SESSION['results'] is NULL, false, 0, "", [] or array() -->
        <? if (!empty($_SESSION['results'])): ?>
            <? $offerResults = $_SESSION['results'] ?>
            <? $_SESSION['results'] = NULL ?>
            <? $_SESSION['request_submitted'] = NULL ?>

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Departure</th>
                        <th scope="col">Arrival</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>
                <tbody>
                    <? foreach ($offerResults as $offerId => $offerResult): ?>
                        <tr>
                            <th scope="row"><?= $offerId + 1 ?></th>
                            <td><?= $cities[$offerResult['departure'] - 1]['cityName'] ?></td>
                            <td><?= $cities[$offerResult['arrival'] - 1]['cityName'] ?></td>
                            <td><?= $offerResult['datetime'] ?></td>
                        </tr>
                    <? endforeach; ?>
                </tbody>
            </table>

        <!-- check if a request was submitted -->
        <? elseif (!empty($_SESSION['request_submitted'])): ?>
            <? $_SESSION['request_submitted'] = NULL ?>
            <p>No results for this ride.</p>
        <? endif; ?>
    </div>
</div>