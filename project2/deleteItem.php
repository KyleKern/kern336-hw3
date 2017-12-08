<?php
session_start();
include '../includes/dbConnection.php';
$dbConn = getDatabaseConnection("assets");

if($dbConn->connect_error){
        die("Connection to database failed: " . $dbConn->connect_error);
}

function deleteItem(){
        
        global $dbConn;
        
        $sql = "DELETE FROM equipment
                WHERE assetNumber = :assetNumber"; 
                 
        $namedParameters = array();
        $namedParameters[':assetNumber']  = $_POST['assetNumber'];
     
        
        $statement = $dbConn->prepare($sql);
        $statement->execute($namedParameters);
      
        
        
        echo "Item was deleted! <br />";
        
    }
    
    if(isset($_POST)){
            deleteItem();
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin: Delete Item </title>
        
        <link rel="stylesheet" href="css/styles.css" type="text/css">
        
    </head>
    <body>

       <h1> Delete Item From Item </h1>
        <form method="POST">
            Item Name:<input type="text" name="itemName"/>
            <br/>
            
           
           <input type = "submit" value = "Delete Item" name = "deleteItem">
           
           <a href='admin.php'><button type="button" class="btn btn-default btn-lg">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Return to Item List
            </select>
            
        </form>
    </body>
</html>