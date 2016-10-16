<?php 

session_start();


$username = $_REQUEST["username"];
$password = $_REQUEST["password"];

$_SESSION["username"] = $username;

	$data = json_decode(file_get_contents('users.txt'), true);
	$_SESSION["all_users"] = $data;
	
	//print_r( $data);
	$success = false; 
	
	foreach($data as $user) {
		if ((strcmp($username, $user['username']) == 0) && (strcmp($password, $user['password']) == 0)) {
			$success = true;
		}
		$_SESSION["private_key"] = $user["private_key"];
	}
	
	echo $success;

?> 