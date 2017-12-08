<script>
     function validateEmail() {
         
            
            
            $.ajax({
                type: "GET",
                url: "https://kern336-hw3-kylekern.c9users.io/usernameLookup.php",
                dataType: "json",
                data: {
                    'email': $('#email').val(),
                    'action': 'validate-username'
                },
                success: function(data,status) {
                    debugger;
                    if (data.length>0) {
                        $('#username-valid').html("Email is not available");
                        $('#username-valid').css("color", "red");
                    } else {
                        $('#username-valid').html("Email is available"); 
                        $('#username-valid').css("color", "green");
                    }
                  },
                complete: function(data,status) { 
                    //optional, used for debugging purposes
                    //alert(status);
                }
            });
                }
</script>
<?php

    include 'dbConnection.php';
    $dbConn = getDatabaseConnection('heroku_87e7042268995be');
    
    function getDepartments() {
        global $dbConn;
        $sql = "SELECT deptName, departmentId 
                FROM department,
                ORDER BY deptName ASC";
                
        $statement = $dbConn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $records;
    }
    
    function getUserInfo($userId) {
        global $dbConn;
        $sql = "SELECT * 
                FROM user
                WHERE userId = $userId";
        $statement = $dbConn->prepare($sql);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        return $record;        
    }
    
    if (isset($_GET['userId'])) {
        $user = getUserInfo($_GET['userId']);
        //print_r($user);
    }
    
    function checkRole($role){
        global $user;
        if ( strtoupper($user['role']) == strtoupper($role)) {
            return "selected";
        }
        
    }
     function checkDept($deptID){
        global $user;
        if ( strtoupper($user['deptId']) == strtoupper($deptID)) {
            return "selected";
        }
        
    }
    
    
    function updateUser() {
        global $dbConn;
    
        //UPDATE  `tcp`.`user` SET  `phone` =  '8315552022' WHERE  `user`.`userId` =0;
        $sql = "UPDATE user
                SET firstName = :firstName,
                    lastName= :lastName,
                    phone= :phone,
                    email= :email,
                    role = :role,
                    deptId = :deptId,
                    course_id= :course
                    
                WHERE userId = :userId";
        $namedParameters = array();
        $namedParameters[":firstName"] = $_POST['firstName'];
        $namedParameters[":lastName"] = $_POST['lastName'];
        $namedParameters[":phone"] = $_POST['phone'];
        $namedParameters[":email"] = $_POST['email'];
        $namedParameters[":role"]      = $_POST['role'];
        $namedParameters[":userId"]    = $_POST['userId'];
        $namedParameters[":deptId"] =$_POST['deptId'];
        $namedParameters[":course"] =$_POST['course'];
        $statement = $dbConn->prepare($sql);
        $statement->execute($namedParameters);
    }
    
    if (isset($_POST['updateUser'])) {  //checks whether the Update Form was submitted
        
        updateUser();
        $user = getUserInfo($_POST['userId']);
        echo "User updated!";
        
    }
    
?>


<!DOCTYPE html>
<html>
    <head>
        <title> Admin: Update User</title>
        	<link rel="stylesheet" href="styles.css">
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
       <h1> CSUMB Enrollment </h1>
       <fieldset>
        <legend> Update User</legend>
        <form method="POST">
            <input type="hidden" name="userId" value="<?=$_GET['userId']?>" />
            <br />
            First Name:<input type="text" name="firstName" value="<?=$user['firstName']?>" />
            <br />
            Last Name:<input type="text" name="lastName" value="<?=$user['lastName']?>" />
            <br/>
            Email: <input id="email" onchange="validateEmail();" type="text" name ="email" value="<?=$user['email']?>"/><span id="username-valid"></span><br>
            <br/>
            Phone Number: <input type ="text" name= "phone" value="<?=$user['phone']?>"/>
            <br />
           Role: <select name="role">
                   <option value=""> - Select One - </option>
                   <option value="staff" <?= ($user['role']=="staff")?"selected":""   ?>>Staff</option>
                   <option value="student" <?= checkRole("student") ?>  >Student</option>
                   <option value="faculty" <?= checkRole("faculty") ?>>Faculty</option>
          </select>
          <br />
            Department:
            <select name="deptId">
                <option value="" > - Select One - </option>
                <option value="Math" <?=($user['deptId']=="1")?' selected':'' ?> >Math</option>
                <option value="Computer Sci" <?=($user['deptId']=="2")?' selected':'' ?> >Computer Sci</option>
                <option value="Game Design"   <?=($user['deptId']=="3")?' selected':'' ?> >Game Design</option>
                <option value="Finance" <?=($user['deptId']=="4")?' selected':'' ?> >Finance</option>
                <option value="Accounting" <?=($user['deptId']=="5")?' selected':'' ?> >Accounting</option>
                <option value="Biology"   <?=($user['deptId']=="6")?' selected':'' ?> >Biology</option>
           </select>
           <br/>
           Course Number:<input  type= "text" name ="course" value="<?=$user['course_id']?>"/>
            <br/>
            <input type="submit" value="Update User" name="updateUser">
        </form>
        </fieldset>
    </body>
</html>