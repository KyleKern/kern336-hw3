<?php
session_start();
session_destroy();
$message = "Admin logged out!";
echo "<script type='text/javascript'>alert('$message');</script>";
header("Location: index.php");


?>
