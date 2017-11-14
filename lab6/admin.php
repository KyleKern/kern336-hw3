<?php
session_start();

if (!isset($_SESSION['username'])) {  //checks whether the admin is logged in
    header("Location: index.php");
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

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Tech Center - Admin Page</title>
        <link rel="stylesheet" href="css/main.css" type="text/css" />
          <style>
            

        body {
    background-image: url("bluebg.jpg");
}
        </style>
        <script>
        

            function confirmDelete(firstName) {
                
                return confirm("Are you sure you wanna delete " + firstName + "?");
                
            }            
            
        </script>
        
    </head>
    <body>
  
       <h1> Tech Center - Admin Page  </h1>

        <h2> Welcome  <?=$_SESSION['adminName']?>  </h2>
      
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