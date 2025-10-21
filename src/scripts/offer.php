<?php
require_once __DIR__ . '/../includes/navbar.php';
?>
<div class="container mt-2 border rounded-3 shadow-sm bg-light">
    <div class="row">
        <div class="col">
            <h2 class="text-center text-dark text-opacity-75 mt-5 mb-4">Offer a ride</h2>

            <div class="mb-5 p-4 rounded-3 bg-secondary bg-gradient bg-opacity-50" style="max-width: 350px; margin:auto;">

                <form action="?route=offer-submit" method="POST">
                    <div class="mb-3">
                        <input class="form-control" type="text" name="departure" placeholder="Departure" required>
                    </div>
                    <div class="mb-3">
                        <input class="form-control" type="text" name="arrival" placeholder="Arrival" required>
                    </div>
                    <div class="mb-4">
                        <input class="form-control" type="text" name="time" placeholder="Time" required>
                    </div>
                    <div>
                        <input class="btn btn-success w-100" type="submit" name="offer-submit" value="Create Offer">
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>