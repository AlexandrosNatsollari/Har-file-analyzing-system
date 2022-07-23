<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<!-- kwdikas gia login form-->

<head>
	<title>
	Analyzer!
	</title>

	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<ul>
	<li>
		 <a class="navbartext active" href="aboutus.php">About us</a>

		 <a class="navbarlogo">Analyzer!</a>
	</li>
	</ul>


	<div class="header">
		<h2>Login Here!</h2>
	</div>

	<form method="post" action="login.php">

		<?php include('errors.php'); ?>

		<!--form for login data-->

		<div class="input-group">
			<label>Username<span class="text-danger">*</span></label>
			<input type="text" name="username" placeholder="Enter your username">
		</div>
		<div class="input-group">
			<label>Email<span class="text-danger">*</span></label>
			<input type="text" name="email" placeholder="Enter your email">
		</div>
		<div class="input-group">
			<label>Password<span class="text-danger">*</span></label>
			<input type="password" name="password" placeholder="Enter your password">
		</div>

		 <!-- send data to server.php-->

		<div class="input-group">
			<button type="submit" class="btn" name="login_user">Login</button>

			<!-- send data to register.php-->

		  <button class="btn">
			  <a href="register.php" class="btn">You dont Have an account?:Register Here!</a>
		  </button>
	  </div>
	</form>
</body>

</html>
