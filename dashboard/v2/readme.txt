As we know Database is a collection of tables that stores data in it.

To retrieve or fetch data from MySQL database it is simple to do it using MySQL ” Select ” query in PHP .

Here in this blog post we will be going to see how to fetch data and to display it in front end.

MySQL Select Query:

SELECT column_name(s)
FROM table_name
Copy

PHP:

$query = mysql_query("select * from tablename", $connection);
Copy

For this you must have a database in MySQL . Here, we have a database named “company” which consists of a table named “employee” with 5 fields in it.

Next we have created a PHP page named “updatephp.php” where following steps will be going to perform:

    We first establish connection with server .

$connection = mysql_connect("localhost", "root", "");
Copy

    Selects database.

$db = mysql_select_db("company", $connection);
Copy

    Executes MySQL select query.

$query = mysql_query("select * from employee", $connection);
Copy

    Display fetched data

<span>Name:</span> <?php echo $row1['employee_name']; ?>
<span>E-mail:</span> <?php echo $row1['employee_email']; ?>
<span>Contact No:</span> <?php echo $row1['employee_contact']; ?>
<span>Address:</span> <?php echo $row1['employee_address']; ?>
Copy

    Closing connection with server.

mysql_close($connection);
Copy

 

Below is our complete code with download and live demo option

Download script   

PHP File: readphp.php


<!DOCTYPE html>
<html>
<head>
<title>Read Data From Database Using PHP - Demo Preview</title>
<meta content="noindex, nofollow" name="robots">
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>
<div class="maindiv">
<div class="divA">
<div class="title">
<h2>Read Data Using PHP</h2>
</div>
<div class="divB">
<div class="divD">
<p>Click On Menu</p>
<?php
$connection = mysql_connect("localhost", "root", ""); // Establishing Connection with Server
$db = mysql_select_db("company", $connection); // Selecting Database
//MySQL Query to read data
$query = mysql_query("select * from employee", $connection);
while ($row = mysql_fetch_array($query)) {
echo "<b><a href="readphp.php?id={$row['employee_id']}">{$row['employee_name']}</a></b>";
echo "<br />";
}
?>
</div>
<?php
if (isset($_GET['id'])) {
$id = $_GET['id'];
$query1 = mysql_query("select * from employee where employee_id=$id", $connection);
while ($row1 = mysql_fetch_array($query1)) {
?>
<div class="form">
<h2>---Details---</h2>
<!-- Displaying Data Read From Database -->
<span>Name:</span> <?php echo $row1['employee_name']; ?>
<span>E-mail:</span> <?php echo $row1['employee_email']; ?>
<span>Contact No:</span> <?php echo $row1['employee_contact']; ?>
<span>Address:</span> <?php echo $row1['employee_address']; ?>
</div>
<?php
}
}
?>
<div class="clear"></div>
</div>
<div class="clear"></div>
</div>
</div>
<?php
mysql_close($connection); // Closing Connection with Server
?>
</body>
</html
