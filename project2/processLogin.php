<?php
session_start();  //MUST be included whenever $_SESSION is used in the program

include '../includes/dbConnection.php';

$conn = getDatabaseConnection("Team Project");

$username = $_POST['username'];
$password = sha1($_POST['password']);  // hash("sha1", $_POST['password']);

$sql = "SELECT * 
        FROM admin
        WHERE username = :username
          AND password = :password";

$namedParameters = array();          
$namedParameters[':username'] = $username;  
$namedParameters[':password'] = $password;  

$statement = $conn->prepare($sql);
$statement->execute($namedParameters);
$record = $statement->fetch(PDO::FETCH_ASSOC);
print_r($record);

    if (empty($record)) {  //it didn't find any record
        
        echo "Wrong username or password!";
        echo "<a href='login.php'> Try again </a>";
        
    } else {
        
        $_SESSION['username'] = $record['username'];
        $_SESSION['adminName'] = $record['firstName'] . " " . $record['lastName'];
        
        header('Location: admin.php');  //redirects to another program        
        
    }
          








?>
<!DOCTYPE html>
<html>
    <head>
         <link rel="stylesheet" href="css/styles.css" type="text/css" />
        <title> </title>
    </head>
    <body>

    </body>
</html>