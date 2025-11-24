<?php
namespace App\Controllers;

use App\Models\User;
use App\Core\View;

// to-do: create a Helper/Validator to handle the logics and get this Controller cleaner

class AuthController {

	public function start() {
		// to do: if user is not logged in redirect to login
		View::render('home.php');
	}

	public function login() {
		// to do: if user is logged in redirect to home
		View::render('login.php');
	}

	public function logout() {
		// terminate session
		session_destroy();

		// redirect to login
		header("Location: index.php?route=login&status=logged-out");
		exit();
	}

	public function loginSubmit() {
		// verify if there is POST method and which case of POST method
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login-submit'])) {

			// get user submitted data
			$email = $_POST['email'] ?? NULL;
			$password = $_POST['password'] ?? NULL;

			// verify if there is data
			if (empty($email) || empty($password)) {
				header("Location: index.php?route=login&error=missing-fields");
				exit();
			}

			// create params
			$params = [
				':email' => $email
			];

			// DB communication
			$db = new User();

			// get data from user
			$result = $db->getUser($params);

			// verify if the user does not exist
			if (count($result['data']) == 0) {

				// session error
				$_SESSION['error'] = 'Email or password invalid.';

				header("Location: index.php?route=login&error=invalid-entries");
				exit();
			}

			// verify if the password match
			if (!password_verify($password, $result['data'][0]['password'])) {

				// session error
				$_SESSION['error'] = 'Email or password invalid.';

				header("Location: index.php?route=login&error=invalid-entries");
				exit();
			}

			// define a session for user
			$_SESSION['user'] = $result['data'][0];

			// redirect user
			header("Location: index.php?route=home&status=logged-in");
			exit();

		} else {
			header("Location: index.php?route=login&error=post-submit-failed");
            // to do???: implement view - message POST submit error

            exit();
		}
	}

	public function signup() {
		View::render('signup.php');
	}

	public function signupSubmit() {
		// verify if there is POST method and which case of POST method
		if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup-submit'])) {

			// get the data from the sign up form
			$firstname = $_POST['firstname'] ?? NULL;
			$lastname = $_POST['lastname'] ?? NULL;
			$email = $_POST['email'] ?? NULL;
			$password = password_hash($_POST['password'] ?? NULL, PASSWORD_DEFAULT);

			// verify if there is data
			if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
				header("Location: index.php?route=signup&error=missing-fields");
				exit();
			}

			$checkParams = [
				':email' => $email
			];

			// DB communication
			$db = new User();

			// check if email is already registered
			$result = $db->getUser($checkParams);

			if (count($result['data']) !== 0) {
				// session error
				$_SESSION['error'] = 'Email is already registered.';

				header("Location: index.php?route=signup&error=email-registered");
				exit();
			}

			// create params
			$params = [
				':firstname' => $firstname,
				':lastname' => $lastname,
				':email' => $email,
				':password' => $password
			];

			$result = $db->createUser($params);

			if ($result['modified'] !== 0) {
				// redirect user
				header("Location: index.php?route=login&status=user-created");
                // to do: implement view - result message offer created

            } else {
                header("Location: index.php?route=signup&error=create-failed");
                // to do: implement view - result message create offer error
            }
            exit();

		} else {
			header("Location: index.php?route=signup&error=post-submit-failed");
            // to do???: implement view - message POST submit error

            exit();
		}
	}
}