<?php


function getDatabaseConnection(){
    $host = "us-cdbr-iron-east-05.cleardb.net";
    $dbname = "heroku_87e7042268995be";
    $username = "bbabc890c66b77";
    $password = "ed6002a9";
    
    //Creates a database connection
    $dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Setting Errorhandling to Exception
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
    
    return $dbConn;    
}



function getUsersThatMatchUserName() {
    $email = $_GET['email']; 
    $dbConn = getDatabaseConnection(); 
   // echo json_encode(array($email));
    $sql = "SELECT * from user WHERE email='$email'"; 
     
    $statement = $dbConn->prepare($sql); 
    
    $statement->execute(); 
    $records = $statement->fetchAll(); 
        
    echo json_encode($records); 
}
   
     
     
if ($_GET['action'] == 'validate-username' ) {
    getUsersThatMatchUserName(); 
}

?>