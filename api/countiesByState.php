<?php
header('Access-Control-Allow-Origin: *');
include('dbConnection.php');
$dbConn = getDatabaseConnection('state');

		 $sql = "SELECT * FROM state " .
		        " WHERE state = " . $_GET['state'];
		 $stmt = $dbConn->query($sql);
		 $results = $stmt->fetch(PDO::FETCH_ASSOC);
		 echo json_encode($results);
		 
?>

