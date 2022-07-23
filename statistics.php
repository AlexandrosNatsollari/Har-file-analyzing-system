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
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Statistics</title>
    <link rel="stylesheet" type="text/css" href="style2.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  </head>

  <body>

    <div class="sidenav">
      <button class="dropdown-btn"><a href="index.php">Home Page</a></button>
    </div>
    <?php if (isset($_SESSION['success'])) : ?>
  <div class="main">
    <h3>
      <?php
        echo $_SESSION['success'];
        unset($_SESSION['success']);
      ?>
    </h3>

  <?php endif ?>
  <div class="main">


   <br>
    <p class="paragraph" style="display:inline;">Ημερομηνία και ώρα τελευταίου upload:
			<p id="lastUpload" style="display:inline;">No data!</p>
			<br>
			<br>
			<p class="paragraph" style="display:inline;"> Πλήθος εγγραφών: </p>
			<p id="entries" style="display:inline;">No data!</p>

</div>
</div>
<script>


$(document).ready(function(){
		$.get("statistics_server.php", function(data, status){
			obj = JSON.parse(data);
			console.log(obj.lastUpload);
			$('#entries').html(obj.numofentries);
      $('#lastUpload').html(obj.lastUpload);
		});
	});

</script>
</body>
</html>
