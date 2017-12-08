<?php
    include '../includes/dbConnection.php';
    $dbConn = getDatabaseConnection('assets');
    function displayItems(){
        
        global $dbConn;
    
        $sql = "SELECT * FROM 'equipment' where 1";
                
        if (isset($_GET['submit']))
            {
                $namedParameters = array();
                
                if (isset($_GET['category']))
                    {
                   $sql = $sql . " AND category = :category";
                   $namedParameters[':category'] = $_GET['category'];
                    }
                    if(isset($_GET['assetNumber']))
                     {
                    $sql = $sql . " AND assetNumber = :assetNumber";
                    $namedParameters[':assetNumber'] = $_GET['assetNumber'];
                    }
                
                 if(isset($_GET['manuName']))
                    {
                    $sql = $sql . " AND manuName = :manuName";
                    $namedParameters[':manuName'] = $_Get['manuName'];
                    }
                
                if(isset($_GET['manuAddr']))
                    {
                    $sql = $sql . " AND manuAddr = :manuAddr";
                    $namedParameters[':manuAddr'] = $_GET['manuAddr'];
                    }
                
                 if(isset($_GET['manuPhone']))
                    {
                    $sql = $sql . " AND manuPhone = :manuPhone";
                    $namedParameters[':manuPhone'] = $_GET['manuPhone'];
                    }
                
                if(isset($_GET['manuPage']))
                    {
                    $sql = $sql . " AND manuPage = :manuPage";
                    $namedParameters[':manuPage'] = $_GET['manuPage'];
                    }
                if(isset($_GET['model']))
                    {
                    $sql = $sql . " AND model = :model";
                    $namedParameters[':model'] = $_GET['model'];
                    }
                if(isset($_GET['price']))
                    {
                    $sql = $sql . " AND price = :price";
                    $namedParameters[':price'] = $_GET['price'];
                    }
                if(isset($_GET['warrExp']))
                    {
                    $sql = $sql . " AND warrExp = :warrExp";
                    $namedParameters[':warrExp'] = $_GET['warrExp'];
                    }
                if(isset($_GET['retire']))
                    {
                    $sql = $sql . " AND retire = :retire";
                    $namedParameters[':retire'] = $_GET['retire'];
                    }
                if(isset($_GET['purchDate']))
                    {
                    $sql = $sql . " AND purchDate = :purchDate";
                    $namedParameters[':purchDate'] = $_GET['purchDate'];
                    }
            }
        
        $stmt = $dbConn->prepare($sql);
        $stmt->execute($namedParameters);
        $records = $stmt->fetchALL(PDO::FETCH_ASSOC);
        
        echo "<table border=1>";
        echo "<tr>";
            echo "<th>Category</th>";
            echo "<th>Asset Number</th>";
            echo "<th>Manufacturer</th>";
            echo "<th>Manufacturer Address</th>";
            echo "<th>Manufacturer Phone</th>";
            echo "<th>Manufacturer Page</th>";
            echo "<th>Model</th>";
            echo "<th>Price</th>";
            echo "<th>Warranty Expiration</th>";
            echo "<th>Retire Date</th>";
            echo "<th>Purchase Date</th>";
            echo "</tr>";
        foreach($records as $record){
            echo "<tr>";
            echo "<td> <input type='checkbox' value='" . $record['itemId'] . "' name='cart[]'> </td>";
            echo "<td>" . $record['category'] . "</td>";
            echo "<td>" . "$" . $record['price'] . "</td>";
            echo "<td>" . $record['warrExp'] . "</td>";
            echo "<td>" . $record['retire'] . "</td>";
            echo "<td>" . $record['purchDate'] . "</td>";
            echo "<td>";
            //echo "<form action='moreInfo.php' method='get' target='_blank'>";
            //echo "<input type='submit' value='More Info' name='" . $record['itemId'] . "'></form>";
            echo "<a href='./moreInfo.php?itemId=" . $record['itemId'] . "' target='_blank'>More Info";
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
        
           
         
    
    }
?>


<!DOCTYPE html>
<html>
    <head>
        <title> </title>
        <link rel="stylesheet" href="./css/styles.css" type="text/css" />
        <a href='https://cst336-internet-programming-brodriguez.c9users.io/project2/login.php' target='_blank'>
             Click to Login with Admin status </a>
             </br>
    </head>
    
    <body>
        <h1> BryanKaraMatthew Business Profile </h1>
    
        <form name="assetDetails">
            
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
            <br />
            <input type="submit">Submit</input>
            
        </form>

        <!--<br /><hr><br />-->
         
        <!-- <form action="shoppingCart.php">-->
           <?=displayItems()?>  
         <!--  <br />-->
           
         <!--  <input type="submit" value="Continue">-->
         <!--</form>  -->
         
         <br>
        
        
            <script>
$.ajax({
            url: '',
            type: 'get',
            data:{'action':'logout'},
            success: function(data){
            alert(data);
                   //location.reload();
                //window.location.href = data;
            }
        });
</script>
<?php
if(isset($_GET['action'])  && $_GET['action'] == "logout" ){

    //$_SESSION = array();
    session_destroy();
    session_unset();  
    echo "logout";exit;
}

?>
    </body>
</html>
