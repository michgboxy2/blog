<?php
session_start();

	


$page_title = 'Delete Posts';

	include 'includes/db.php';
	include 'includes/functions.php';

	if(isset($_GET['pid'])){
		$pid = $_GET['pid'];
	}
	
	Delete($conn,$pid);
	redirect("view_post.php");


?>