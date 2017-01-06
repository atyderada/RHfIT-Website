<?php
$db; // variable to store the database connection
$anthony_pass = "";
$george_pass = "";
$roger_pass = "";
try{
    $db = new PDO("mysql:host=localhost;dbname=rhfit", "root", $anthony_pass);
}catch(Exception $e){
    try {
		$db = new PDO("mysql:host=localhost;dbname=rhfit", "root", $george_pass);
	} catch(exception $e) {
		try {
		    $db = new PDO("mysql:host=localhost;dbname=rhfit", "root", $roger_pass);
        } catch(exception $e) {
            echo "Failed to connect to server, please try again.";
            exit ;
        }
	}
}

?>