<?php
session_start();  

include 'dbConnection.php';

$dbConn = getDatabaseConnection('heroku_87e7042268995be');

$username = $_POST['username'];
$password = sha1($_POST['password']); 

$sql = "SELECT * 
        FROM admin
        WHERE userName = :username
          AND password = :password";

$namedParameters = array();          
$namedParameters[':username'] = $username;  
$namedParameters[':password'] = $password;  

$statement = $dbConn->prepare($sql);
$statement->execute($namedParameters);
$record = $statement->fetch(PDO::FETCH_ASSOC);
print_r($record);

    if (empty($record)) { 
        
        echo "Wrong username or password!";
        echo "<a href='login.php'> Try again </a>";
        
    } else {
        
        $_SESSION['username'] = $record['username'];
        $_SESSION['adminName'] = $record['firstName'] . " " . $record['lastName'];
        
        header('Location: admin.php');  //redirects to another program        
        
    }
?>