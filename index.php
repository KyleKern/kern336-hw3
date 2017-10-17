<?php

include 'dbConnection.php';

$dbConn = getDatabaseConnection('heroku_87e7042268995be');

function getDeviceTypes(){
    global $dbConn;
    $sql = "SELECT DISTINCT(deviceType) 
            FROM devices
            ORDER BY deviceType" ;
            
      $statement= $dbConn->prepare($sql); 
      $statement->execute();
      $records = $statement->fetchALL(PDO::FETCH_ASSOC);  
      
      
      foreach($records as $record) {
          
          echo "<table>";
          echo "<tr>";
          echo "<option value='" . $record['deviceType'] . "'>" .
          $record['deviceType'] . "</option>";
          echo "</tr>";
          echo "</table>";
      }
            
            
}

function displayDevices() {
    global $dbConn;
    $sql = "SELECT * 
            FROM devices 
            WHERE 1 " ;  //Getting all records 
            
            if (isset($_GET['submit']))
            {
            //form has been submitted

                $namedParameters = array();
                
                
                
                if (!empty($_GET['deviceName'])){
                    //deviceName has some value
                    
                    // Following sql works but it doesn't prevent SQL INJECTION
                   //  $sql = $sql . " AND deviceName LIKE  '%" . $_GET['deviceName'] . "%'";
                   $sql = $sql . " AND deviceName LIKE  :deviceName "; //using Named Parameters to prevent SQL Injection
                   
                   $namedParameters[':deviceName'] = "%" . $_GET['deviceName'] . "%";
                   
                }
                
                if(!empty($_GET['deviceType'])){
                    //type has been selected
                    
                    $sql = $sql . " AND deviceType = :deviceType";
                    
                    $namedParameters[':deviceType'] = $_GET['deviceType'];
                }
                
                if(isset($_GET['available']))
                {
                    $sql = $sql . " AND status = :status";
                    $namedParameters[':status'] = "available";
                }
                
                if(isset($_GET['price']))
                {
                    $sql = $sql . " AND price = :price";
                    $namedParameters[':price']=$_GET['price'];
                }
            }
            
                
                if(isset($_GET['sort']))
                {
                    $sortN = $_GET['sort'];
                    
                    
                    if($sortN = 'pricehigh')
                        {
                        $sql= $sql . 'ORDER BY price DESC';
                        }
                }
                    
                     if(isset($_GET['sort1']))
                     
                    {
                    $sortN1 = $_GET['sort1'];
                    
                    if ($sortN1='device')
                    {
                        $sql=$sql . 'ORDER BY deviceName';
                }
        }
            
      $statement= $dbConn->prepare($sql); 
      $statement->execute($namedParameters); //Always pass the named parameters, if any
      $records = $statement->fetchAll(PDO::FETCH_ASSOC);  
      
      echo '<table>';
      foreach($records as $record) {
          echo '<tr>';
         // echo "<input type='checkbox' name='cart[]'value =" . $record['deviceId'] . ">";
          echo $record['deviceName'] . " - ". $record['deviceType'] .  " - ". $record['status'] . " - " . $record['price'] . "<br/> ";
      }
   
    
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title> Lab 5 </title>
        <link rel="stylesheet" href="styles.css" type="text/css" />
    </head>
    <body>

         <h1> Technology Center: Checkout System </h1>
         
         <form>
        
            <td> Device:
    
            <input Type="text" name ="deviceName" placeholder ="Device Name" >
             Type: 
             <select name="deviceType" >
                 <option value = "">Select One</option>
                 <?=getDeviceTypes()?>
             </select>
             
             <input type= "radio" name= "available" id ="available" value="available">
             <label for="available" > Available</label>
             
             <input type= "radio" name= "sort" id ="sort" value="sort">
             <label for="sort" > Sort By Price</label>
             
              <input type= "radio" name= "sort1" id ="sort1" value="sort1">
             <label for="sort1" > Sort By Name</label>
             
             <input type="submit" name ="submit" value="Search"/></td>
         </form>
         <br /><hr><br />
         
         <form action="displayCart.php">
           <?=displayDevices()?>  
           <br />
         </form>  
        
        
         

    </body>
</html>