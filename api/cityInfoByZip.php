<?php
header('Access-Control-Allow-Origin: *');
include('dbConnection.php');
$dbConn = getDatabaseConnection('zip_codes');

		 $sql = "SELECT * FROM zips " .
		        " WHERE zip = " . $_GET['zip_code'];
		 $stmt = $dbConn->query($sql);
		 $results = $stmt->fetch(PDO::FETCH_ASSOC);
		 echo json_encode($results);
		 
?>

