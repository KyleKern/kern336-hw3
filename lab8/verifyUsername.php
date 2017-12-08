<?php

include 'dbConnection.php';

$conn = getDatabaseConnection();

$sql = "SELECT * 
        FROM users
        WHERE username = :'username'";

$namedParameters = array();
$namedParameters[':username'] = $_GET['username'];     
        
$statement = $conn->prepare($sql);
$statement->execute( array(":username"=> $_GET['username']) );
$result = $statement->fetch(PDO::FETCH_ASSOC);

echo json_encode($result);
?>