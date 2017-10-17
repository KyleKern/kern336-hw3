<?php
$host = "localhost";
$dbname = "tech_checkout";
//I need to re-configure web_user
$username = "root";
$password = "";

// Establishing a connection
$dbConn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Setting Errorhandling to Exception
$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

//$sql = " SELECT * FROM table_name WHERE id = :id ";

$sql = 'SELECT * FROM user WHERE email LIKE "%csumb%";';


$stmt = $dbConn -> prepare ($sql);
$stmt -> execute( );
$records = $stmt->fetchAll(PDO::FETCH_ASSOC);


foreach($records as $record){
    echo $record['firstName']."<br />";
}
echo "<br />";
echo $records[0]['firstName'];


function getDeviceTypes(){
    global $dbConn;
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Lab 5 </title>
    </head>
    <body>
        <form>
            Device: <input type="text" name="deviceName" />
            Type: <select name="deviceType">
            Availability: <select name
                
            </select>
        </form>

    </body>
</html>