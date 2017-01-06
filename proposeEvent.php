<?php
// $db is your database connection
include('connection.php');

// from the caller
// var location = location_input.val();
// var duration = duration_input.val();
// var start_time = start_time_input.val();
// var description = description_input.val();
// var event_name = event_name_input.val();
// $_POST is a superglobal array holding post values
if(isset($_POST['location']) && isset($_POST['duration']) && 
	isset($_POST['start_time']) && isset($_POST['description']) && 
	isset($_POST['event_name'])){
	// valid request
	// store the values now
	$location = $_POST['location'];
	$duration = $_POST['duration'];
	$start_time = $_POST['start_time'];
	$description = $_POST['description'];
	$event_name = $_POST['event_name'];
	$sql = "INSERT INTO `request` (`request_name`, `location`, `time`, `date`, `duration`, 
	`official`, `description`) VALUES (:rn, :loc, :t, :d, :dur, :off, :desc)";
	
	$propose_event_query = $db -> prepare($sql);
	$propose_event_query -> bindValue('rn', $event_name);
	$propose_event_query -> bindValue('loc', $location);
	$propose_event_query -> bindValue('t', $start_time);
	$propose_event_query -> bindValue('d', '2016-05-17');
	$propose_event_query -> bindValue('dur', $duration);
	$propose_event_query -> bindValue('off', 'no');
	$propose_event_query -> bindValue('desc', $description);
	
	$response = $propose_event_query -> execute();
	$propose_event_query -> closeCursor();
	if($response != 1){
		echo '{"error": true, "err_pos": 0}';
		exit;
	}
	echo '{"error": false}';
	
} else{
	// invalid request
	// you can manually type json
	echo '{"error": true, "err_pos": 1}';// sent back to the always function
}

?>