<?php 
include 'dbConnection.php';

$con = getDatabaseConnection('heroku_87e7042268995be');

function getItems(){
    global $con;
    $namedParameters = array();
    $results = null;
    if(isset($_GET['submit'])){
        $sql = "select * FROM course";
        if(isset($_GET['category'])){
            $value = $_GET['category'];
            if($value == "Math"){
                $sql .= " where deptId = 1";
            }elseif($value == "CS"){
             $sql .= " where deptId = 2";
            }elseif($value == "Gamedesign"){
               $sql .= " where deptId = 3";
            }elseif($value == "Finance"){
                $sql .= " where deptId = 4";
            }elseif($value == "Accounting"){
              $sql .= " where deptId = 5";
            }elseif($value == "Biology"){
                $sql .= " where deptId = 6";
            }
        }
        
        //order items by price asc or desc
        if(isset($_GET['credits'])){
            if($_GET['credits'] == "asc"){
                $sql .=  " order by credits";
            }
            else{
                $sql .= " order by credits desc";
            }
        }

        $stmt = $con -> prepare ($sql);
        $stmt -> execute($namedParameters);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<table id=\"table1\">
            <tr>
            <th> course_id </th>
 	        <th> Name </th>
         	<th> deptId </th>
         	<th> credits </th>
         	<th></th>
         </tr>";
        foreach($results as $result) {
            echo "<tr>";
            echo "<td><a href=\"info.php?name=".$result['name']. "&course_id=" . 
                $result['course_id'] . "&name=" . 
                $result['name'] . "&deptId=" . 
                $result['deptId'] . "&credits=" . 
                $result['credits'] . 
                "\">" . $result['course_id'] . "</a></td>";
            echo "<td>".$result['name']."</td>";
            echo "<td>".$result['deptId']."</td>";
            echo "<td>".$result['credits']."</td>";
            echo "</tr>";
        }
        echo "</table>";
    }
}

?>
<!DOCTYPE html>
<head>
	<link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body background="background.jpg">
	<div id = "wrapper">
	<h2 style="color: black"> CSUMB Enrollment Simulator 2017</h2></h2>
<form id="indexForm">
	<br /> <br />
    
    <!--I was thinking we can use category to pick the table, but I just get errors when I try to use a variable-->
    <!--or named parameter for table in sql statement-->
    Category: <input type="radio" name="category" value="Math" ><label for="Math"> Math </label>
            <input type="radio" name="category" value="CS" > <label for="CS">  CS </label>
            <input type="radio" name="category" value="Gamedesign" > <label for="Gamedesign">  Econ </label>
            <input type="radio" name="category" value="Finance" > <label for="Finance">  Finance </label>
            <input type="radio" name="category" value="Accounting" > <label for="Accounting">  Accounting </label>
            <input type="radio" name="category" value="Biology" > <label for="Biology">  Biology </label>
    <br />
  

    <br />
    <label for="credits">Sort by credits:</label>
    <input type="radio" name="credits" value="asc"> Ascending
  	<input type="radio" name="credits" value="desc"> Descending
  	
  	<input type="submit" value="Search" name="submit" />

</form>
<br />
<br />
<br />
<center>

 	<?php 
 	  getItems();
    ?>
	
 </center>

 </div>
 <form id='admin' form action="./login.php" method="get" >
            <input type="submit" value="admin">
</form>
</body>

 </html>
