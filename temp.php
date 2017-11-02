<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>SQL</title>
        <style>
            /*@import url("css/styles.css");*/
        </style>
    </head>

<?php
      
    $servername = "localhost";
    $username = "wesmixon";
    $password = "qwer1234";
    $dbname = "tech_devices_app";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    //$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }    
    echo "<h3>- Admin Login -";
    ?>
    
    <form method="POST">
        Username: <input type="text" name="username"/><br>
        Password: <input type="text" name="password"/><br>
        <input type="submit" name="loginForm" value="Login!"/><br>
    </form>
    
    <?php
    if(isset($_POST['loginForm'])){
      
        $username = $_POST['username']; 
        $password =  $_POST["password"];
    
        $sql = "SELECT * FROM admin WHERE userName ='$username' AND password ='$password'";
        
        //echo $sql;
        
        $result = $conn->query($sql);
        if(($result->num_rows == 0)){
            echo "Wrong Username or Password";
        }
        else
        {
            
        }
        
        
        
    }  
    
?>