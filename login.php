<!DOCTYPE html>
<html>
    <head>
        <title> Admin Login </title>
        	<link rel="stylesheet" href="styles.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>

       <h1> - Admin Login -</h1>
        <form action="adminMain.php"  method="post">
            Username: <input type="text" name="username" /> <br />
            Password: <input type="password" name="password"  />
            <input type="submit" name="loginForm" />
        </form>

    </body>
</html>