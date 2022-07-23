<?php

// Starting the session, necessary
// for using session variables
session_start();

// DB connection code -> hostname,
// username, password, database name
$db = mysqli_connect('localhost', 'root', '', 'webdatabase');


// Declaring  the variables
$username = "";
$email = "";
$errors = array();
$_SESSION['success'] = "";

// Registration code
if (isset($_POST['user_registration'])) {

	// Receiving the values entered and storing
	// in the variables
	// Data sanitization is done to prevent
	// SQL injections

	//Escape special characters, if any
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	$password_confrim = mysqli_real_escape_string($db, $_POST['password_confrim']);

	// Ensuring that the user has not left any input field blank
	// error messages will be displayed for every blank input
	if (empty($username)) { array_push($errors, "Username is required"); }
	if (empty($email)) { array_push($errors, "Email is required"); }
	if (empty($password_1)) { array_push($errors, "Password is required"); }
	if (empty($password_confrim)) { array_push($errors, "Repeat Password is required"); }

	elseif ($password_1 != $password_confrim) {
		array_push($errors, "The two passwords do not match");
		// Checking if the passwords match
	}
	//Checking if the username already exists
	$query = "SELECT * FROM users WHERE username='$username'";
  $results = mysqli_query($db, $query);
  if (mysqli_num_rows($results) == 1) {
	  array_push($errors, "Username already exists!");
  }
  //Checking if the email already exists
  $query1 = "SELECT * FROM users WHERE email='$email'";
  $results1 = mysqli_query($db, $query1);
  if (mysqli_num_rows($results1) == 1) {
    array_push($errors, "Email already exists!");
  }


	// If the form is error free, then register the user
	if (count($errors) == 0) {

		// Password encryption to increase data security
		$password = md5($password_1);

		// Inserting data into table
		$query = "INSERT INTO users (username, email, password)
				VALUES('$username', '$email', '$password')";

		mysqli_query($db, $query);

		// Storing username of the logged in user,
		// in the session variable
		$_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
		// Welcome message
		$_SESSION['success'] = "You have logged in";

		// Page on which the user will be
		// redirected after logging in
		header('location: index.php');
	}
}

// User login
if (isset($_POST['login_user'])) {

	// Data sanitization to prevent SQL injection
	$username = mysqli_real_escape_string($db, $_POST['username']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$password = mysqli_real_escape_string($db, $_POST['password']);

	// Error message if the input field is left blank
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// Checking for the errors
	if (count($errors) == 0) {

		// Password matching
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username'AND email='$email' AND password='$password'";
		$results = mysqli_query($db, $query);

		// $results = 1 means that one user with the
		// entered username exists
		if (mysqli_num_rows($results) == 1) {

			// Storing username in session variable
			$_SESSION['username'] = $username;
      $_SESSION['email'] = $email;
			// Welcome message
			$_SESSION['success'] = "You have logged in!";

			// Page on which the user is sent
			// to after logging in
			$username = mysqli_real_escape_string($db, $_POST['username']);//data injection protection
			if ($username == "admin") {
				// Admin page
				header('location: admin.php');
			} else {
				// user page
				header('location: index.php');
			}

			
		}
		else {

			// If the username,email and password dont match
			array_push($errors, "Username, Email or password incorrect");
		}
	}
}


?>
