<?php

//Check that the session is active

    include '../includes/dbConnection.php';
    
    $dbConn = getDatabaseConnection('Team Project');
    
    
     function getItemInfo() {
        global $dbConn;
        $sql = "SELECT * 
                FROM item
                WHERE itemName = '$itemName'";
        $statement = $dbConn->prepare($sql);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        return $record;        
    }
    
    if (isset($_GET['itemName'])) {
        $user = getItemInfo($_GET['itemName']);
        //print_r($user);
    }

    
    function updateItem() {
        global $dbConn;
    
        //UPDATE  `tcp`.`user` SET  `phone` =  '8315552022' WHERE  `user`.`userId` =0;
        $sql = "INSERT INTO item 
                 (itemId, itemName, price, deptId, supplierId, availability)
                 VALUES
                 (:itemId, :itemName, :price, :deptId, :supplierId, :availability)";
         $namedParameters = array();
          $namedParameters[":itemId"] = $_POST['itemId'];
         $namedParameters[":itemName"] = $_POST['itemName'];
         $namedParameters[":price"]      = $_POST['price'];
        $namedParameters[":deptId"]    = $_POST['deptId'];
         $namedParameters[":supplierId"]    = $_POST['supplierId'];
          $namedParameters[":availability"] = $_POST['availability'];
          
         $statement = $dbConn->prepare($sql);
        $statement->execute($namedParameters);
     }
    
     if (isset($_POST['updateItem'])) {  //checks whether the Update Form was submitted
        
         updateItem();
        $item = getItemInfo($_POST['itemId']);
        $item = getItemInfo($_POST['itemName']);
        $item = getItemInfo($_POST['price']);
        $item = getItemInfo($_POST['supplierId']);
        echo "Item updated!";
        
    }
    
?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
        <title> Admin: Update Item</title>
    </head>
    <body>


       <h1> Online Clothing Store</h1>
       <fieldset>
        <legend> Update Item</legend>
        <form method="POST">
            Item Id: <input type="text" name="itemId" value="<?=$_GET['itemId']?>" />
            <br />
            Item Name:<input type="text" name="itemName" value="<?=$item['itemName']?>" />
            <br />
            Price:<input type="text" name="price"/>
            <br/>
            Suppiler Id: <input type= "text" name ="suppilerId"/>
            <br />
            
            </select><br />
            <input type="submit" value="Update Item" name="updateItem">
            
        </form>
        </fieldset>

<a href='admin.php'><button type="button" class="btn btn-default btn-lg">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Continue
    </body>
</html>