<?php

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
    
    
    function updateUser() {
        global $dbConn;
    
        //UPDATE  `tcp`.`user` SET  `phone` =  '8315552022' WHERE  `user`.`userId` =0;
        $sql = "UPDATE user
                SET firstName = :firstName,
                    lastName= :lastName,
                    phone= :phone,
                    email= :email,
                    role = :role
                    
                WHERE userId = :userId";
        $namedParameters = array();
        $namedParameters[":firstName"] = $_POST['firstName'];
        $namedParameters[":lastName"] = $_POST['lastName'];
        $namedParameters[":phone"] = $_POST['phone'];
        $namedParameters[":email"] = $_POST['email'];
        $namedParameters[":role"]      = $_POST['role'];
        $namedParameters[":userId"]    = $_POST['userId'];
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
    </head>
    <body>


       <h1> Tech Checkout System</h1>
       <fieldset>
        <legend> Update User</legend>
        <form method="POST">
            User Id: <input type="hidden" name="userId" value="<?=$_GET['userId']?>" />
            <br />
            First Name:<input type="text" name="firstName" value="<?=$user['firstName']?>" />
            <br />
            Last Name:<input type="text" name="lastName" value="<?=$user['lastName']?>" />
            <br/>
            Email: <input type= "email" name ="email" value="<?=$user['email']?>"/>
            <br/>
            Phone Number: <input type ="text" name= "phoneNum" value="<?=$user['phone']?>"/>
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
                <option value="computer science"  <?=($userInfo['deptId']=='1')?" selected":"" ?>  > computer science</option>
                 <option value="Statistics"  <?=($userInfo['deptId']=='2')?" selected":"" ?>  >Statistics</option>
                  <option value="Design"  <?=($userInfo['deptId']=='3')?" selected":"" ?>  >Design</option>
                   <option value="Economics"  <?=($userInfo['deptId']=='4')?" selected":"" ?>  >Economics</option>
                    <option value="Drama"  <?=($userInfo['deptId']=='5')?" selected":"" ?>  >Drama</option>
                     <option value="Biology"  <?=($userInfo['deptId']=='6')?" selected":"" ?>  >Biology</option>
            </select>
            <input type="submit" value="Update User" name="updateUser">
        </form>
        </fieldset>


    </body>
</html>