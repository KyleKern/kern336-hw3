<?php
session_start();
if (!isset($_SESSION['username'])) {  //checks whether the admin is logged in
    header("Location: adminMain.php");
}
include 'dbConnection.php';
$dbConn = getDatabaseConnection('heroku_87e7042268995be');

function listUsers() {
    global $dbConn;
    $sql = "SELECT * 
            FROM user
            ORDER BY lastName";
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $users;
}

function csCount(){
 global $dbConn;
    $sql = "SELECT count(userId) 
            FROM user
            WHERE deptId=2";
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    $count = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $count;
}

function greatestCredits(){
    global $dbConn;
    $sql = "SELECT max(credits) 
            FROM course";
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    $max = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $max;
}

function mostPopular(){
    global $dbConn;
    $sql = "SELECT max(course_id) 
            FROM user";
    $statement = $dbConn->prepare($sql);
    $statement->execute();
    $popular = $statement->fetchAll(PDO::FETCH_ASSOC);
     echo $popular['course_id']; 
    return $popular;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title> CSUMB Update Students</title>
        <link rel="stylesheet" href="styles.css">
        <style>
        

        </style>
        <script>
        
            function confirmDelete(firstName) {
                
                return confirm("Are you sure you wanna delete " + firstName + "?");
                
            }            
            
        </script>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
  
       <h1> CSUMB - Admin Page  </h1>

        <h2> Welcome  <?=$_SESSION['adminName']?>  </h2>
       <form action="reports.php">
            <input type="submit" value="Reports!" />
        </form>
        </br>
        <form action="logout.php">
            <input type="submit" value="Logout!" />
        </form>
        <br />
        <form action="addUser.php">
            <input type="submit" value="Add New User!" />
        </form>
        <br />
        <?php 
          $users = listUsers();
          foreach($users as $user) {
              echo $user['firstName'] . " " . $user['lastName'] . " " . $user['email'];
            
              echo "[<a href='updateUser.php?userId=".$user['userId']."'>Edit</a>]";
              echo "<form action='deleteUser.php' onsubmit='return confirmDelete(\"".$user['firstName']."\")'>
                       <input type='hidden' name='userId' value='".$user['userId']."'>
                       <input type='submit' value='Delete'>
                    </form><br />";
          }
          
          ?>
 
    </body>
</html>