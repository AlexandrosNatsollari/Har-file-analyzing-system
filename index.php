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
	<title>Homepage</title>
	<link rel="stylesheet" type="text/css" href="indexstyle.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>





	<div class="sidenav">

    <a href="FileReader.php">Upload Δεδομένων</a>
		<button class="dropdown-btn">Διαχείριση Προφίλ</button>
	  <div class="dropdown-container">
			<a href="ChangeUsername.php">Αλλαγή Username</a>
	    <a href="ChangePassword.php">Αλλαγή Password</a>
	    <a href="statistics.php">Στατιστικά</a>
	  </div>
	  <a href="question4/index.php">Οπτικοποίηση δεδομένων</a>
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


	</div>
</body>
</html>
<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>
