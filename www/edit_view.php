<?php
session_start();

$page_title = 'edit View Posts';

	include 'includes/db.php';
	include 'includes/functions.php';

	if(isset($_GET['pid'])){
		$pid = $_GET['pid'];
		
		}
	
	$view = getPostById($conn,$pid);


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
			$clean['post'] = htmlspecialchars_decode($clean['post']);
			updatePost($conn,$clean,$pid);
			redirect('view_post.php');
		}



	}

?>

		 <div class="wrapper">
		<h1 id="register-label">Add Post</h1>
		<hr>
		<form id="register"  action ="" method ="POST">
			<div>
				<label>Title:</label>
				<input type="text" name="title" placeholder="POST TITLE" value="<?php echo $view['title']; ?>">
			</div>

			<div>
				<label>post:</label>
				<textarea name="post" placeholder="INPUT POST HERE" cols="50" rows="10" value="<?php echo $view['posts']; ?>">					
				</textarea>
				
			</div>
			
			<input type="submit" name="submit" value="ADD POST">
		</form>