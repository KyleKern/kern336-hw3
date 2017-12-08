<?php
session_start();

if (!isset($_SESSION['username'])) {
    
    header('Location: login.php'); //sends users back to login screen if they haven't logged in
    exit;
}

include '../includes/dbConnection.php';
$conn = getDatabaseConnection("Team Project");

function listItems() {
    global $conn;
    $sql = "SELECT * 
            FROM item
            ORDER BY itemName";
    $statement = $conn->prepare($sql);
    $statement->execute();
    $items = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $items;
}

?>

<!DOCTYPE html>
<html>
    <head>
         <link rel="stylesheet" href="css/styles.css" type="text/css" />
        <title> Online Clothing Store - Admin Page</title>
         <a href='https://cst336-internet-programming-brodriguez.c9users.io/project2/' target='_blank'>
             Return to page </a>
        <script>
        $("#logout").click(function(){
            $.ajax({
            url: 'index.php',
            type: 'get',
            data:{'action':'logout'},
            success: function(data){
            alert(data);
                  location.reload();
            }
        })
        });

            function confirmDelete(firstName) {
                
                return confirm("Are you sure you wanna delete " + firstName + "?");
                
            }            
            
        </script>
        
    </head>
    <body>
  
       <h1> Online Clothing Store - Admin Page  </h1>

        <h2> Welcome  <?=$_SESSION['adminName']?>  </h2>
      
        <form action="logout.php">
            <input type="submit" value="Logout!" id = "logout" />
        </form>
        <br />
        <form action="addItem.php">
            <input type="submit" value="Add New Item!" />
            <form action="index.php">
        </form>
        <br />
        <?php 
          $items = listItems();
          foreach($items as $item) {
              echo $item['itemName'] . "  $".$item['price'] . " " . "Item Id".$item['itemId']."  " ."Department Id".$item['deptId'];
              echo "[<a href='updateItem.php?itemId=".$item['itemId']."'>Edit</a>]";
              echo "<form action='deleteItem.php' onsubmit='return confirmDelete(\"".$item['itemName']."\")'>
                       <input type='hidden' name='itemId' value='".$item['itemId']."'>
                       <input type='submit' value='Delete'>
                    </form><br />";
          }
          
          ?>
 
    </body>
</html>