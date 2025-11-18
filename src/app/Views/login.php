<?php

// TO DO: put this into AuthController

// verify if there is a session error
$error = $_SESSION['error'] ?? NULL;
unset($_SESSION['error']);
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card bg-light p-5 shadow-mt-5" style="width: 350px;">
            <h1 class="logo mb-5 w-100">ticketShare</h1>
            <form action="?route=login-submit" method="POST">
                <div class="mb-3">
                    <input class="form-control" type="email" name="email" placeholder="Email" required>
                </div>
                <div class="mb-5">
                    <input class="form-control" type="password" name="password" placeholder="Password" required>
                </div>
                <? if (!empty($error)): ?>
                    <div class="alert alert-danger p-2 text-center" style="margin-top: -30px;">
                        <?= $error ?>
                    </div>
                <? endif; ?>
                <div>
                    <input class="btn btn-success w-100" type="submit" name="login-submit"  value="Login">
                </div>
                <div>
                    <a href="?route=signup" class="mt-2 btn btn-secondary w-100">Sign Up</a>
                </div>
            </form>
        </div>
    </div>
</div>