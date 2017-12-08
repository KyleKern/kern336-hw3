<?php

  //Check that the session is active

    include "../includes/dbConnection.php";
    
    $dbConn = getDatabaseConnection('assets');
    
    function addItem()
    {
        
        global $dbConn; 
        
        $sql = "INSERT INTO equipment 
                (category, assetNumber, manuName, manuAddr, manuPhone, manuPage, model, price, warrExp, retire, purchDate)
                VALUES
                (:category, :assetNumber, :manuName, :manuAddr, :manuPhone, :manuPage, :model, :price, :warrExp, :retire, :purchDate)"; 
                 
        $namedParameters = array();
        $namedParameters[':category']    = $_POST['category'];
        $namedParameters[':assetNumber'] = $_POST['assetNumber'];
        $namedParameters[':manuName']  = $_POST['manuName'];
        $namedParameters[':manuAddr']     = $_POST['manuAddr'];
        $namedParameters[':manuPhone']     = $_POST['manuPhone'];
        $namedParameters[':manuPage']    = $_POST['manuPage'];
        $namedParameters[':model']    = $_POST['model'];
        $namedParameters[':price']    = $_POST['price'];
        $namedParameters[':warrExp']    = $_POST['warrExp'];
        $namedParameters[':retire']    = $_POST['retire'];
        $namedParameters[':purchDate']    = $_POST['purchDate'];
        
        $statement = $dbConn->prepare($sql);
        $statement->execute($namedParameters);
        
        echo "Item was added! <br />";
        
    }
    
    if(isset($_POST['addItem'])){
        addItem();
    }
    
    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/styles.css" type="text/css" />
        <title> Admin: Add new item</title>
    </head>
    <body>

       <h1> Assets </h1>
        <form method="POST">
            Category: <input type="text" name="category" />
            <br />
            Item Id: <input type="text" name="assetNumber" />
            <br />
            Manufacturer Name:<input type="text" name="manuName" />
            <br />
            Manufacturer Address:<input type="text" name="manuAddr"/>
            <br/>
            Manufacturer Phone: <input type= "tel" name ="manuPhone"/>
            <br/>
            Manufacturer Page: <input type ="url" name= "manuPage"/>
            <br />
            Model: <input type ="text" name= "model"/>
            <br />
            Price: <input type ="text" name= "price"/>
            <br />
            Warranty Expiration: <input type ="date" name= "warrExp"/>
            <br />
            Retire Date: <input type ="date" name= "retire"/>
            <br />
            Purchase Date: <input type ="date" name= "purchDate"/>
            
    
            <input type="submit" value="Add Item" name="addItem">
          <a href='admin.php'><button type="button" class="btn btn-default btn-lg">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Continue
            
        </form>
    </body>
</html>