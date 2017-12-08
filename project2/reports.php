<?php

session_start();
include '../includes/dbConnection.php';
$dbConn = getDatabaseConnection("Team Project");

if($dbConn->connect_error){
        die("Connection to database failed: " . $dbConn->connect_error);
}
    
function avgPrice(){ 
   global $dbConn;
   
   //calculates the average price
   $sql = "SELECT AVG(price) average
   FROM item";
   
   //gets records from database
    $statement= $dbConn->prepare($sql); 
    $statement->execute();
    $records = $statement->fetch(PDO::FETCH_ASSOC);
    
    //prints databases and sql statement
    echo "<td>Average Price: </td>";
    echo "   $" . $records['average']; //%i tells the program that a number is coming, the number is the average
    echo "</br>";
}

function standardDev(){
    global $dbConn;
    
    $sql = "SELECT STD(price) standDev
    FROM item";
    
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    $records = $statement->fetch(PDO::FETCH_ASSOC);
    

    echo "Standard Deviation:";
    echo "  $" .$records['standDev']; //%i tells the program that a number is coming, the number is the average
   echo "</br>";
}

function totalCost(){
    global $dbConn;
    $sql = "SELECT SUM(price) cost
    FROM item";
    
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    $records = $statement->fetch(PDO::FETCH_ASSOC);
    
    echo "Cost";
    echo "  $" .$records['cost']; //%i tells the program that a number is coming, the number is the average
    echo "</br>";
    
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reports Page</title>
        <link rel="stylesheet" href="css/styles.css" type="text/css">
    </head>
    

    
    <body>
        <form id = "table">
            <strong>This is the average of all the products in the store.</strong>
            <?=avgPrice()?>
            <strong>This is the standard deviation from the average.</strong>
            <?=standardDev()?>
            <strong>If somone bought every item in the store once.</strong>
            <?=totalCost()?>
        </form>
        
        <a href='index.php'><button type="button" class="btn btn-default btn-lg">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Continue
    </body>
</html>