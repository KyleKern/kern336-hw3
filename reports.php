<?php
include 'dbConnection.php';
$dbConn = getDatabaseConnection('heroku_87e7042268995be');

function csCount(){ 
   global $dbConn;
   
   //calculates the average price
   $sql = "SELECT AVG(credits) average
   FROM course";
   
   //gets records from database
    $statement= $dbConn->prepare($sql); 
    $statement->execute();
    $records = $statement->fetch(PDO::FETCH_ASSOC);
    
    //prints databases and sql statement
    echo "<td>Average credits: </td>";
    echo "   " . $records['average']; //%i tells the program that a number is coming, the number is the average
    echo "</br>";
}


function greatestCredits(){
    global $dbConn;
    $sql = "SELECT COUNT(firstname) count
    FROM user where deptId=2";
    
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    $records = $statement->fetch(PDO::FETCH_ASSOC);
    
    echo "total Computer Science students";
    echo " " .$records['count']; //%i tells the program that a number is coming, the number is the average
    echo "</br>";;
}

function mostPopular(){
    global $dbConn;
    $sql = "SELECT SUM(credits) cost
    FROM course";
    
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    $records = $statement->fetch(PDO::FETCH_ASSOC);
    
    echo "total credits offered";
    echo " " .$records['cost']; //%i tells the program that a number is coming, the number is the average
    echo "</br>";
}


?>
<!DOCTYPE html>
<html>
    <head>
        <title> CSUMB Reports</title>
       	<link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>

<body>
    <h1> - Reports - </h1>
<?php 
    $users = csCount();
?>
</br>
</br>
</br>
<?php
    $users = greatestCredits();
?>
</br>
</br>
</br>
<?php
    $users = mostPopular();
?>
<form action="admin.php">
            <input type="submit" value="Admin" />
        </form>
    </body>
</html>