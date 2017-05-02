<?php
	session_start();
	$uid = $_SESSION['id']; 
	$page_title = 'post';

	include 'includes/db.php';
	include 'includes/functions.php';
	include 'includes/header.php';
	include 'includes/dynamic.php';

	$error = [];

	if(array_key_exists('submit', $_POST)){

		if(empty($_POST['title'])){
			$error['title'] = "please enter title";

		}

		if(empty($_POST['post'])){
			$error['post'] = "please enter post";
		}

		if(empty($error)){
			$clean = array_map('trim', $_POST);
			$clean['post'] = htmlspecialchars($clean['post']);
			AddPost($conn, $clean, $uid);

		}



	}

?>

		 <div class="wrapper">
		<h1 id="register-label">Add Post</h1>
		<hr>
		<form id="register"  action ="post.php" method ="POST">
			<div>
				<label>Title:</label>
				<input type="text" name="title" placeholder="POST TITLE">
			</div>

			<div>
				<label>post:</label>
				<textarea name="post" placeholder="INPUT POST HERE" cols="50" rows="10"></textarea>
				
			</div>
			
			<input type="submit" name="submit" value="ADD POST">
		</form>