<?php

	session_start();

	


$page_title = 'Archive';

	include 'includes/db.php';
	include 'includes/functions.php';

	if(isset($_GET['pid'])){
		$pid = $_GET['pid'];
	}


InsertArchive($conn,$pid){



?>