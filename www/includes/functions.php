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