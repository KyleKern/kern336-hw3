<?php
  //Check that the session is active
    include 'dbConnection.php';
    $dbConn = getDatabaseConnection('heroku_87e7042268995be');
    
    function getDepartments() {
        global $dbConn;
        $sql = "SELECT deptName, departmentId 
                FROM department 
                ORDER BY deptName ASC";
                
        $statement = $dbConn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        
        //print_r($records);
        
        return $records;
    }
    
    
    function addUser(){
        
        global $dbConn; 
        
        $sql = "INSERT INTO user 
                (userId, firstName, lastName, email, phone, role, deptId)
                VALUES
                (:userId, :firstName, :lastName, :email, :phone, :role, :deptId)"; 
                 
        $namedParameters = array();
        $namedParameters[':userId']    = $_POST['userId'];
        $namedParameters[':firstName'] = $_POST['firstName'];
        $namedParameters[':lastName']  = $_POST['lastName'];
        $namedParameters[':email']     = $_POST['email'];
        $namedParameters[':phone']     = $_POST['phoneNum'];
        $namedParameters[':role']      = $_POST['role'];
        $namedParameters[':deptId']    = $_POST['department'];
        
        $statement = $dbConn->prepare($sql);
        $statement->execute($namedParameters);
        
        echo "User was added! <br />";
        
    }
    
    if(isset($_POST['addUser'])){
        //echo "Form was submitted!";
        addUser();
    }
    
    
    
?>

<!DOCTYPE html>
<html>
    <head>
        <title> Admin: Add new user</title>
        <link rel="stylesheet" href="styles.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>

       <h1> CSUMB: Adding a New Student </h1>
        <form method="POST">
            User Id: <input type="text" name="userId" />
            <br />
            First Name:<input type="text" name="firstName" />
            <br />
            Last Name:<input type="text" name="lastName"/>
            <br/>
            Email: <input type= "email" name ="email"/>
            <br/>
            Phone Number: <input type ="text" name= "phoneNum"/>
            <br />
           Role: <select name="role">
                <option value=""> - Select One - </option>
                <option value="staff">Staff</option>
                <option value="student">Student</option>
                <option value="faculty">Faculty</option>
            </select>
            <br />
            Department: <select name="department">
                <option value="" > Select One </option>
                <?php
                  $departments=getDepartments();
                  
                  foreach($departments as $department)
                  {
                      echo "<option value = '" .$department['departmentId'] . "'> ". $department['deptName']. "</option>" ;
                  }
                  
                ?>
            </select>
            <input type="submit" value="Add User" name="addUser">
        </form>
    </body>
</html>