<?php

	function doAdminRegister($dbconn, $input){

		$hash = password_hash($input['password'], PASSWORD_BCRYPT);

		#insert data
		$stmt = $dbconn->prepare("INSERT INTO admin(firstname, lastname, email, hash) VALUES(:fn, :ln, :e, :h)");

		#bind params...
		$data = [

			':fn' => $input['fname'],
			':ln' => $input['lname'],
			':e' => $input['email'],
			':h' => $hash

		];

		$stmt-> execute($data);





	}

	function DoesEmailExist($dbconn,$email ){
		$result = false;

		$stmt = $dbconn->prepare("SELECT email FROM admin WHERE email=:e");
		$stmt->bindParam(":e", $email);
		$stmt->execute();
		$count = $stmt->rowCount();
		if($count > 0){
			$result = true;
		}

		return $result;
	}

	function ErrorDisplay($error, $formfield){
			$result = "";

		if(isset($error[$formfield])){ 

			$result .= '<span class="err">'.$error[$formfield].'</span>';}

			return $result;

	}

	function doAdminLogin($dbconn,$input){
		$result = [];

		$stmt = $dbconn->prepare("SELECT admin_id,hash FROM admin WHERE email=:e");
		$stmt->bindParam(":e",$input['email']);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_BOTH);
		#print_r($row);exit();
		
		if($stmt->rowCount() != 1 || !password_verify($input['password'], $row['hash'])){
			
		redirect('adminLogin.php');exit();	

				} else {

			$result[] = true;
			$result[] = $row['admin_id'];
		}

		return $result;

	}

	function redirect($loc){

		header("Location:$loc");

	}

	function AddPost($dbconn, $input, $user_id){
		
		$stmt = $dbconn->prepare("INSERT INTO post(post_id,title,user_id,posts,date) VALUES(NULL,:ti,:uid,:p,NOW())");
		$data = [

		":ti" => $input['title'],
		":uid" => $user_id,
		":p" => $input['post']
				];
		$stmt->execute($data);

	}

	function ViewPost($dbconn){
		$result = "";

		$stmt = $dbconn->prepare("SELECT * FROM post");		
		$stmt->execute();
		
	
		
		while($row = $stmt->fetch(PDO::FETCH_BOTH)){

			  $item = GetAdminDetails($dbconn,$row['user_id']);


			  $result .= '<tr>
						 <td>'.$row['title'].'</td>;
						 <td>'.$row['posts'].'</td>;
						 <td>'.$item['firstname'].'</td>;
						 <td>'.$row['date'].'</td>;
						 <td><a href="edit_view.php?pid='.$row['post_id'].'">edit</a></td>;
						 <td><a href="delete.php?pid='.$row['post_id'].'">delete</a></td>;
						 <td><a href="archive.php?pid='.$row['post_id'].'">archive</a></td>;
						 </tr>';
		}

		return $result;
}
	function GetAdminDetails($dbconn,$admin_id){

		$stmt = $dbconn->prepare("SELECT firstname FROM admin WHERE admin_id=:id");
				$stmt->bindParam(":id",$admin_id);
				$stmt->execute();
		$rows = $stmt->fetch(PDO::FETCH_BOTH);

		return $rows;



	}

	function getPostById($dbconn,$post_id){
		$result = "";

		$stmt = $dbconn->prepare("SELECT * FROM post WHERE post_id=:p");
		$stmt->bindParam(":p",$post_id);
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_BOTH);
		return $row;
	}

	function updatePost($dbconn,$input,$post_id){
		$result = "";

		$stmt = $dbconn->prepare("UPDATE post SET title=:ti,posts=:post WHERE post_id=:post_id");
		$data = [
		":post_id" => $post_id,
		":ti" => $input['title'],
		":post" => $input['post']

				];
		$stmt->execute($data);
	}

	function Delete($dbconn,$post_id){

		$stmt = $dbconn->prepare("DELETE FROM post WHERE post_id=:post_id");
		$stmt->bindParam(":post_id", $post_id);
		$stmt->execute();	


	}

	function DisplayPosts($dbconn){
		$result = "";

		$stmt = $dbconn->prepare("SELECT title,user_id,posts,DATE_FORMAT(date,'%M %e, %Y') AS d FROM post");
		$stmt->execute();
		while ($row = $stmt->fetch(PDO::FETCH_BOTH)){
			   $item = GetAdminDetails($dbconn,$row['user_id']);


			$result .= '<div class="blog-post">
            			<h2 class="blog-post-title">'.$row['title'].'</h2>
            			<p class="blog-post-meta">'.$row['d'].' by <a href="#">'.$item['firstname'].'</a></p>
            			<p clas="blog-post">'.$row['posts'].'</p>';

			
		}

		return $result;
		
	}

	function CheckLogin(){
		
		if(!isset($_SESSION['id'])){
			redirect("adminLogin.php");
		}
	}

	function InsertArchive($dbconn,$pid){

		$stmt = $dbconn->prepare("INSERT INTO archive(archive_id,post_id,date) VALUES(NULL,:pid,NOW())");
		$stmt->bindParam(":pid",$pid);
		$stmt->execute();
	}