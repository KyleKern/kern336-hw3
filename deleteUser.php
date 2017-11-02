<?php
//check that the session is active
    include 'dbConnection.php';
    $dbConn = getDatabaseConnection('heroku_87e7042268995be');

$sql = "DELETE FROM user
        WHERE userId = " . $_GET['userId'];

$statement = $dbConn->prepare($sql);  
$statement->execute();

header("Location: admin.php");


?>