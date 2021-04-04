
<?php
/*
Author: Javed Ur Rehman
Website: http://www.allphptricks.com/
*/
session_start();
if(!isset($_SESSION["username"])){
header("Location: login.php");
exit(); }


$con = mysqli_connect("localhost","zebruyic_ruirusa","kensta879097","zebruyic_ruirusa");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>












<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard - RUIRU SPORTS ACADEMY</title>
<link rel="stylesheet" href="css/style.css" />
</head>
<body>
<div class="form">
<p>Dashboard</p>
<p>This is another secured page.</p>
<p><a href="index.php">Home</a></p>
<a href="logout.php">Logout</a>


<br /><br /><br /><br />
 <a href="">RUIRU SPORTS ACADEMY</a>
</div>
</body>
</html>
