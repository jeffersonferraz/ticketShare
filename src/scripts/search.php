<?php
require_once __DIR__ . '/../includes/navbar.php';

// get cities
$data = new Database();
$results = $data->getCities();
$cities = $results['data'];
?>
<div class="container p-4 mt-2 border rounded-3 shadow-sm bg-light text-center w-100">
    <h2 class="text-center text-dark text-opacity-75 mt-4 mb-5">Search for a Ride</h2>
    <div class="col">
        <div class="mb-5 p-4 rounded-3 bg-secondary bg-gradient bg-opacity-50" style="max-width: 350px; margin:auto;">

            <form action="?route=offer-submit" method="POST">

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
                    <input class="btn btn-success w-100" type="submit" name="search-offer" value="Search">
                </div>

            </form>

        </div>
    </div>
    <div class="container">
        <? if (isset($_SESSION['results'])) { ?>
            <? $offerResults = $_SESSION['results'] ?>
            <? $_SESSION['results'] = NULL ?>

            <table class="table table-bordered">

                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Departure</th>
                        <th scope="col">Arrival</th>
                        <th scope="col">Date</th>
                    </tr>
                </thead>

                <? foreach ($offerResults as $offerId => $offerResult): ?>
                    <tbody>
                        <tr>
                            <th scope="row"><?= $offerId + 1 ?></th>
                            <td><?= $cities[$offerResult['departure']]['cityName'] ?></td>
                            <td><?= $cities[$offerResult['arrival']]['cityName'] ?></td>
                            <td><?= $offerResult['datetime'] ?></td>
                        </tr>
                    </tbody>
                <? endforeach; ?>

            </table>

        <? } else {
            echo "No results.";
        } ?>
    </div>
</div>