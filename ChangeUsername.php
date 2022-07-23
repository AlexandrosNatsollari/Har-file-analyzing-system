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



  $db = mysqli_connect('localhost', 'root', '', 'webdatabase');
  $username = "";
  $password = "";
  $newusername = "";
  $errors = array();
  $_SESSION['success'] = "";

   if (isset($_POST['ChangeUsername'])) {


        //data cleansing and protection from sql injection
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $newusername = mysqli_real_escape_string($db, $_POST['newusername']);

        //Checking if  username&password  exists
        $query = "SELECT * FROM users WHERE username='$username'";
        $results = mysqli_query($db, $query);

        $password = md5($password);//retrieving the right password(unhashed)

        $query2 = "SELECT * FROM users WHERE  password='$password'";
        $results2 = mysqli_query($db, $query2);

        if (mysqli_num_rows($results) == 0) {
         array_push($errors, "Wrong username!");
        }
        elseif(mysqli_num_rows($results2) == 0) {
         array_push($errors, "Wrong Password!");
        }
        elseif(count($errors) == 0) {
         // Inserting data into table
         $query4 = "UPDATE users SET username='$newusername' WHERE username='$username' ";
         if (mysqli_query($db, $query4)) {
            echo "Username updated successfully";
         } else {
           array_push($errors, "Something went wrong");
         }
       }


       mysqli_close($db);
      }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
     <title>Username Change</title>
     <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>

     <div class="header">
      <h2>Change Your Username</h2>
     </div>

     <form method="POST">
     <?php include('errors.php'); ?>


     <div class="input-group">
       <label>Username<span class="text-danger">*</span></label>
       <input type="text" name="username" placeholder="Enter your username">
     </div>

     <div class="input-group">
       <label>Password<span class="text-danger">*</span></label>
       <input type="password" name="password" placeholder="Enter your password">
     </div>

     <div class="input-group">
       <label>New Username<span class="text-danger">*</span></label>
       <input type="text" name="newusername" placeholder="Enter your new username">
     </div>

     <div class="input-group">
    			<button type="submit" class="btn" name="ChangeUsername">Change Username</button>

    		  <button class="btn">
    			  <a href="index.php" class="btn">Home</a>
    		  </button>
    	</div>

    </form>
</body>
</html>
