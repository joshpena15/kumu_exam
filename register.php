<?php
	require_once("model/Credentials.php");
	
	if(json_decode(file_get_contents('php://input')) !== null){
		$input_json = json_decode(file_get_contents('php://input'));
		$login = new Credentials();
		
		$user = $input_json->username;
		$pass = $input_json->password;
		
		if($login->register($user, $pass)) {
			header('Content-type:application/json;charset=utf-8');
			$response = array("response" => "Registration Success");
			echo json_encode($response);
			
		} else {
			header('HTTP/1.0 500 Internal Server Error');
			exit;
		}
		
	} else {
		header('HTTP/1.0 422 Unprocessable Entity');
		error_log("Unprocessable Entity", 0);
		exit;
	}
?>