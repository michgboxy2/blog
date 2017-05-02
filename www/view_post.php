<?php

$page_title = 'View Posts';

	include 'includes/db.php';
	include 'includes/functions.php';
	include 'includes/header.php';
	include 'includes/dynamic.php';
?>

	<div class="wrapper">
		<div id="stream">
			<table id="tab">
				<thead>
					<tr>
						<th>title</th>
						<th>Post</th>
						<th>author</th>
						<th>date created</th>
						<th>edit</th>
						<th>delete</th>
					</tr>
				</thead>
				<tbody>
					<tr>
					<?php
					$view = ViewPost($conn); echo $view;
					?>
						
					</tr>
          		</tbody>
			</table>
		</div>