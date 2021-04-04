<?php
/* Database connection settings */
$host = 'localhost';
$user = 'zebruyic_ruirusa';
$pass = 'kensta879097';
$db1 = 'zebruyic_ruirusa';
$mysqli = new mysqli($host,$user,$pass,$db1) or die($mysqli->error);

define('DBSERVER','localhost');
define('DBUSERNAME','zebruyic_ruirusa');
define('DBPASSWORD','kensta879097');
define('DBNAME','zebruyic_ruirusa');

/* connect to database */

$db=mysqli_connect(DBSERVER,DBUSERNAME,DBPASSWORD,DBNAME);

if($db === false){
die("Error:connection error.".mysqli_connect_error());
}



?>