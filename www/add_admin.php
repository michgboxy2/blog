<?php
$page_title = "register";

	include 'includes/db.php';
	include 'includes/functions.php';
	include 'includes/header.php';

	#CheckLogin();
	

?>

	<?php
	$error = [];

	if(array_key_exists('register', $_POST)){
		

		if(empty($_POST['fname'])){
			$error['fname'] = "please enter firstname";
		}

		if(empty($_POST['lname'])){
			$error['lname'] = "please enter lastname";
		}

		if(empty($_POST['email'])){
			$error['email'] = "please enter email";
		}
		
		if(DoesEmailExist($conn,$_POST['email'])){
			$error['email'] = "email already exist";
		}

		if(empty($_POST['password'])){
			$error['password'] = "please enter password";
		}

		if($_POST['password'] != $_POST['pword']){
			$error['pword'] = "password mismatch";

		}

		if(empty($error)){
			$clean = array_map('trim', $_POST);
			
			doAdminRegister($conn, $clean);

		} 

	}




	?>

		<div class="wrapper">
		<h1 id="register-label">Admin Register</h1>
		<hr>
		<form id="register"  action ="add_admin.php" method ="POST">
			<div>
				<?php

				$display = ErrorDisplay($error, 'fname'); echo $display;
				?>
				<label>first name:</label>
				<input type="text" name="fname" placeholder="first name">
			</div>
			<div>
				<?php

				$display = ErrorDisplay($error, 'lname'); echo $display;
				?>
				<label>last name:</label>	
				<input type="text" name="lname" placeholder="last name">
			</div>

			<div>
				<?php

				$display = ErrorDisplay($error, 'email'); echo $display;
				?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<?php

				$display = ErrorDisplay($error, 'password'); echo $display;
				?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>
 
			<div>
				<?php

				$display = ErrorDisplay($error, 'pword'); echo $display;
				?>
				<label>confirm password:</label>	
				<input type="password" name="pword" placeholder="password">
			</div>

			<input type="submit" name="register" value="register">
		</form>