<?php
include('connection.php');

if (isset($_POST['username_input']) && strlen($_POST['username_input']) < 12 && 
	isset($_POST['password_input']) && strlen($_POST['password_input']) < 25) {
	
	//getting vars from html through post
	$username = $_POST['username_input'];
	$password = $_POST['password_input'];
	
	//fixing vars to string
	$username = filter_var($username, FILTER_SANITIZE_STRING);
	$password = filter_var($password, FILTER_SANITIZE_STRING);
	
	//DB query to check if username/passord are valid
	$getUserPrep = $db -> prepare('Call checkUser(:userN)');
	$getUserPrep -> bindValue('userN', $username);
	$getUserPrep -> execute();
	if($getUserPrep->rowCount() < 1){
		echo '{"error": true, "err_pos": 0}';
		exit;
	}
	
	$usernameResult = $getUserPrep -> fetchAll();
	$getUserPrep -> closeCursor();
	
	$getPassPrep = $db -> prepare('Call checkPass(:userN, :passW)');
	$getPassPrep -> bindValue('userN', $username);
	$getPassPrep -> bindValue('passW', $password);
	$getPassPrep -> execute();
	if($getPassPrep -> rowCount() < 1){
		echo '{"error": true, "err_pos": 1}';
		exit;
	} 
	
	$passResult = $getPassPrep -> fetchAll();
	$getPassPrep -> closeCursor();
	
	echo json_encode($passResult);
	exit;
	
} else {
	echo '{"error": true, "err_pos": 2}';
	exit;
}
?>