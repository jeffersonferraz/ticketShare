<?php
require_once __DIR__ . '/../includes/navbar.php';

// get cities
$data = new Database();
$results = $data->getCities();
$cities = $results['data'];
?>
<div class="container p-5 mt-2 border rounded-3 shadow-sm bg-light text-center w-100">
    <h2 class="text-start p-2 text-dark text-opacity-75 mt-4" style="font-weight: 700;">Offer a Ride</h2>
    <hr class="mb-4">
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

                <select class="form-control mb-3" name="arrival">
                    <option selected disabled>Arrival</option>
                    <? foreach ($cities as $city): ?>
                        <option value="<?= $city["cityId"] ?>">
                            <?= $city["cityName"] ?>
                        </option>
                    <? endforeach; ?>
                </select>

                <div class="mb-4">
                    <input class="form-control" id="datetime" type="datetime-local" name="datetime" required>
                </div>

                <div>
                    <input class="btn btn-success w-100" type="submit" name="offer-create" value="Create">
                </div>

            </form>

        </div>

    </div>
</div>

<script>
    const now = new Date();
    const formatted = now.toISOString().slice(0, 16);
    document.getElementById("datetime").value = formatted;
</script>