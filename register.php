<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<!-- kwdikas gia register form-->

<head>
	<title>
		Analyzer!
	</title>
	<link rel="stylesheet" type="text/css"href="style.css">
</head>

<body>
	<ul>
	<li>
		 <a class="navbartext active" href="aboutus.php">About us</a>

		 <a class="navbarlogo">Analyzer!</a>
	</li>
	</ul>


	<div class="header">
		<h2>Register</h2>
	</div>

	<form method="post" action="register.php">

		<?php include('errors.php'); ?>

		<div class="input-group">
			<label>Username<span class="text-danger">*</span></label>
			<input type="text" name="username" placeholder="Choose your user name"
				value="<?php echo $username; ?>">
				<div class="text-danger"><em>This will be your login name!</em></div>
		</div>

		<div class="input-group">
			<label>Email<span class="text-danger">*</span></label>
			<input type="email" name="email" placeholder="Enter valid email"
				value="<?php echo $email; ?>">
		</div>

		<div class="input-group">
			<label>Password<span class="text-danger">*</span></label>
			<input type="password" name="password_1" class="form-control" placeholder="Enter your password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[#$*@_&]).{8,}$" onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Must have at least 8 characters that are of at least one number, one uppercase and lowercase letter and one symbol #$*&@_' : ''); if(this.checkValidity()) form.password_two.pattern = this.value;"
				required>
		</div>

		<div class="input-group">
			<label>Confirm password<span class="text-danger">*</span></label>
			<input type="password" name="password_confrim" placeholder="Confrim your password">
		</div>
		
		<div class="input-group">
			<button type="submit" class="btn" name="user_registration">Register</button>

		  <button class="btn">

			   <a href="login.php" class="btn">Login Here!</a>

		  </button>
	</form>
</body>
</html>
