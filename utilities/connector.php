<?php 
	$servername = "localhost";
	$username = "root";
	//$password = "your_password";

	try {
		// if is needed to use a password for the server just uncomment the line bellow and comment the one under that
		//$conn = new PDO("mysql:host=$servername;dbname=tasker", $username, $password);
		$conn = new PDO("mysql:host=$servername;dbname=tasker", $username);
	    // set the PDO error mode to exception
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
	catch(PDOException $e){
	    echo "Connection failed: " . $e->getMessage();
    }
?>