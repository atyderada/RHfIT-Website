<?php
// $db is your database connection
include('connection.php');

if(isset($_POST['event_id'])){
	$eventNum = $_POST['event_id'];
	$sql = "Select * from request where r_id = $eventNum";
	$getInfoQuery = $db -> prepare($sql);
	$getInfoQuery -> execute();
	
	if($getInfoQuery -> rowCount() < 1){
		echo '{"error": true, "err_pos": 0}';
		exit;
	}
	
	$result = $getInfoQuery -> fetchAll();
	$getInfoQuery -> closeCursor();
	
	echo json_encode($result);
	exit;
}else{
	// error
	exit;
}
?>