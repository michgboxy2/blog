<?php
	$page_title = 'post';

	include 'includes/db.php';
	include 'includes/functions.php';
	include 'includes/header.php';

	$error = [];

	if(array_key_exists('post', $_POST)){

		echo "haha";



	}

?>

		 <div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register"  action ="login.php" method ="POST">
			<div>
				<label>Title:</label>
				<input type="text" name="title" placeholder="email">
			</div>

			<div>
				<label>post:</label>
				<textarea name="post" placeholder="INPUT POST HERE" cols="50" rows="10"></textarea>
				
			</div>
			
			<input type="submit" name="post" value="ADD POST">
		</form>