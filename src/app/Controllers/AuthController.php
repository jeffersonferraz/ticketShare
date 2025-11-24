<?php
namespace App\Controllers;

use App\Models\User;
use App\Core\View;

class AuthController {

	public function start() {
		View::render('home.php');
		exit();
	}

	public function login() {
		View::render('login.php');
		exit();
	}

	public function loginSubmit() {
		// get user submitted data
		$email = $_POST['email'] ?? NULL;
		$password = $_POST['password'] ?? NULL;

		// verify if there is data
		if (empty($email) || empty($password)) {
			echo '<meta http-equiv="refresh" content="0;url=index.php?route=login">';
			exit();
		}

		// DB communication
		$db = new User();

		$params = [
			':email' => $email
		];

		// get data from user
		$result = $db->getUser($params);

		// verify DB communication errors 
		if ($result['status'] == 'error') {
			echo '<meta http-equiv="refresh" content="0;url=index.php?route=404">';
			exit();
		}

		// verify if the user does not exist
		if (count($result['data']) == 0) {

			// session error
			$_SESSION['error'] = 'Email or password invalid.';

			echo '<meta http-equiv="refresh" content="0;url=index.php?route=login">';
			exit();
		}

		// verify if the password match
		if (!password_verify($password, $result['data'][0]['password'])) {

			// session error
			$_SESSION['error'] = 'Email or password invalid.';

			echo '<meta http-equiv="refresh" content="0;url=index.php?route=login">';
			exit();
		}

		// define a session for user
		$_SESSION['user'] = $result['data'][0];

		// redirect user
		echo '<meta http-equiv="refresh" content="0;url=index.php?route=home">';
		exit();
	}

	public function logout() {
		// terminate session
		session_destroy();

		// redirect to login » home
		echo '<meta http-equiv="refresh" content="0;url=index.php?route=login">';
		exit();
	}

	public function signup() {
		View::render('signup.php');
		exit();
	}

	public function signupSubmit() {
		// get the data from the sign up form
		$firstname = $_POST['firstname'] ?? NULL;
		$lastname = $_POST['lastname'] ?? NULL;
		$email = $_POST['email'] ?? NULL;
		$password = password_hash($_POST['password'] ?? NULL, PASSWORD_DEFAULT);

		// verify if there is data
		if (empty($firstname) || empty($lastname) || empty($email) || empty($password)) {
			echo '<meta http-equiv="refresh" content="0;url=index.php?route=signup">';
			exit();
		}

		// DB communication
		$db = new User();

		$params = [
			':email' => $email
		];

		// check if user already exists
		$result = $db->getUser($params);

		if (count($result['data']) !== 0) {

			// session error
			$_SESSION['error'] = 'Email is already registered.';

			echo '<meta http-equiv="refresh" content="0;url=index.php?route=signup">';
			exit();
		}

		// DB communication - send data from user
		$params = [
			':firstname' => $firstname,
			':lastname' => $lastname,
			':email' => $email,
			':password' => $password
		];

		$result = $db->createUser($params);

		// verify DB communication errors 
		if ($result['status'] == 'error') {
			echo '<meta http-equiv="refresh" content="0;url=index.php?route=404">';
			exit();
		}

		// redirect user
		echo '<meta http-equiv="refresh" content="0;url=index.php?route=login">';
		exit();
	}
}