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
  $newpassword = "";
  $confirmnewpassword = "";
  $errors = array();
  $_SESSION['success'] = "";

   if (isset($_POST['ChangePassword'])) {


        //data cleansing and protection from sql injection
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $newpassword = mysqli_real_escape_string($db, $_POST['newpassword']);
        $confirmnewpassword = mysqli_real_escape_string($db, $_POST['confirmnewpassword']);


        //Checking if  username  exists
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
        elseif ( $newpassword != $confirmnewpassword ) {
          array_push($errors, "New password doesnt match with confirmation password!");
        }
        elseif ( $newpassword == $password ) {
          array_push($errors, "New password cant be old password!");
        }
        if (count($errors) == 0) {

         // Password encryption to increase data security
          $newpassword= md5($confirmnewpassword);

         // Inserting data into table
         $query4 = "UPDATE users SET password='$newpassword' WHERE username='$username' ";
         if (mysqli_query($db, $query4)) {
            echo "Password updated successfully";
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
     <title>Password Change</title>
     <link rel="stylesheet" type="text/css" href="style.css">
  </head>
  <body>

    <div class="header">
      <h2>Change Password</h2>
    </div>

   <form method="POST">
     <?php include('errors.php'); ?>

     <div class="input-group">
       <label>Username<span class="text-danger">*</span></label>
       <input type="text" name="username" placeholder="Enter your username">
     </div>

     <div class="input-group">
       <label>Existing Password<span class="text-danger">*</span></label>
       <input type="password" name="password" placeholder="Enter your existing password">
     </div>

     <div class="input-group">
       <label>New Password<span class="text-danger">*</span></label>
       <input type="password" name="newpassword" class="form-control" placeholder="Enter your new password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[#$*@_&]).{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 8 characters that are of at least one number, one uppercase and lowercase letter and one symbol #$*&@_' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;"
 				required>
     </div>

     <div class="input-group">
       <label>Confirm Your New Password<span class="text-danger">*</span></label>
       <input type="password" name="confirmnewpassword" placeholder="Confirm your new password">
     </div>

     <div class="input-group">
    			<button type="submit" class="btn" name="ChangePassword">Change Password</button>

    		  <button class="btn">
    			  <a href="index.php" class="btn">Home</a>
    		  </button>
    	</div>

    </form>
</body>
</html>
