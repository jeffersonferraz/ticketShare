<?php
require_once __DIR__ . '/../includes/navbar.php';
?>
<div class="container mt-2 border rounded-3 shadow-sm bg-light">
    <div class="row">
        <div class="col">
            <h4 class="text-center mt-4">Offer a ride</h4>
            <form action="?route=login-submit" method="POST">
                <div class="mb-3">
                    <input class="form-control" type="text" name="departure" placeholder="Departure" required>
                </div>
                <div class="mb-5">
                    <input class="form-control" type="text" name="arrival" placeholder="Arrival" required>
                </div>
                <div>
                    <input class="btn btn-success w-100" type="submit" name="offer-submit" value="Create Offer">
                </div>
            </form>
        </div>
    </div>
</div>