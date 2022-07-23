<?php

// Starting the session, to use and
// store data in session variable
session_start();

// If the session variable is empty, this
// means the user is yet to login
// User will be sent to 'login.php' page
// to allow the user to login
if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You have to log in first";
	header('location: login.php');
}

// Logout button will destroy the session, and
// will unset the session variables
// User will be headed to 'login.php'
// after loggin out
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	header("location: login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Page</title>
	<link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>


	<!-- Side navigation -->
	<div class="sidenav">
		 <a href="admin/question1/jsstuff.php">Απεικόνιση Βασικών Πληροφοριών</a>
		 <a href="admin/question2/q2jsstuff.php">Ανάλυση Χρόνων Απόκρισης Σε Αιτήσεις</a>
		 <a href="admin/question3/q3jsstuff.php">Ανάλυση κεφαλίδων HTTP</a>
		 <a href="#">Οπτικοποίηση Δεδομένων</a>
		 <a href="index.php?logout='1'">Logout!</a>
	</div>

	 <!-- Page content -->
	 <div class="main">

			 <!-- Creating notification when the
					 user logs in -->

			 <!-- Accessible only to the users that
					 have logged in already -->
			 <?php if (isset($_SESSION['success'])) : ?>
				 <div>
					 <h3>
						 <?php
							 echo $_SESSION['success'];
							 unset($_SESSION['success']);
						 ?>
					 </h3>
				 </div>
			 <?php endif ?>

			 <!-- information of the user logged in -->
			 <!-- welcome message for the logged in user -->
			 <?php if (isset($_SESSION['username'])) : ?>
				 <p class="paragraph">Welcome<strong>
						 <?php echo $_SESSION['username']; ?>
					 </strong>

			 <?php endif ?>

</body>
</html>
