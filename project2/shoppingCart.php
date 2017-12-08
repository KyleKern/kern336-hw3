<?php
    session_start();
    
    include '../includes/dbConnection.php';
    $dbConn = getDatabaseConnection('Team Project');
    
    if(!isset($_SESSION['cart'])){
        $_SESSION['cart'] = array();  //initialize session variable
    }
        
    if(isset($_GET['cart'])){
        $cart = $_GET['cart'];
        foreach($cart as $element)
        {   
            if(!in_array($element, $_SESSION['cart'])){
                $_SESSION['cart'][] = $element;
            }
        }
    }
    
     echo "<h1>Shopping Cart </h1>";
    
    $sql = "SELECT *
            FROM item
            WHERE 1";
            
    $stmt = $dbConn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchALL(PDO::FETCH_ASSOC);
    
    foreach($_SESSION['cart'] as $element){
        for($i = 0; $i < count($records); $i++){
            if($records[$i]['itemId'] == $element){
                echo $records[$i]['itemName'] . " $" . $records[$i]['price'] . "<br>";
            }
        }
        
    }
    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Clothing</title>
        <link rel="stylesheet" href="./css/styles.css" type="text/css" />
    </head>
    
    <body>
        <a href='https://cst336-internet-programming-brodriguez.c9users.io/project2/index.php' target='_blank'>
             Return to Page </a>
    </body>
</html>
