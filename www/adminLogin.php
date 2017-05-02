<?php

$page_title = 'Login';

	include 'includes/db.php';
	include 'includes/functions.php';
	include 'includes/header.php';

	$error = [];

	if(array_key_exists('login', $_POST)){

		if(empty($_POST['email'])){
			$error['email'] = "please enter email";
		}

		if(empty($_POST['password'])){
			$error['password'] = "please enter password";
		}

		if(empty($error)){
			$clean = array_map('trim', $_POST);
			//do error login
		}


	}





?>


	<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register"  action ="adminLogin.php" method ="POST">
			<div>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>

			<input type="submit" name="login" value="login">
		</form>

		<h4 class="jumpto">Don't have an account? <a href="register.php">register</a></h4>
	</div>