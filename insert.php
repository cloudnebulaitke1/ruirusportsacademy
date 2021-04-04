<?php
$username = "zebruyic_ruirusa";
$password = "kensta879097";
$database = "zebruyic_ruirusa";

$mysqli = new mysqli("localhost", $username, $password, $database);

// Don't forget to properly escape your values before you send them to DB
// to prevent SQL injection attacks.

$fname = $mysqli->real_escape_string($_POST['fname']);
$sname = $mysqli->real_escape_string($_POST['sname']);
$lname = $mysqli->real_escape_string($_POST['lname']);
$age = $mysqli->real_escape_string($_POST['age']);
$weight = $mysqli->real_escape_string($_POST['weight']);
$height = $mysqli->real_escape_string($_POST['height']);
$dob = $mysqli->real_escape_string($_POST['dob']);
$nationality = $mysqli->real_escape_string($_POST['nationality']);
$county = $mysqli->real_escape_string($_POST['county']);
$school = $mysqli->real_escape_string($_POST['school']);
$playerpos = $mysqli->real_escape_string($_POST['playerpos']);
$parent = $mysqli->real_escape_string($_POST['parent']);
$contacts = $mysqli->real_escape_string($_POST['contacts']);
$fclub = $mysqli->real_escape_string($_POST['fclub']);
$nick = $mysqli->real_escape_string($_POST['nick']);
$jersey = $mysqli->real_escape_string($_POST['jersey']);
$pjersey = $mysqli->real_escape_string($_POST['pjersey']);
$file = $mysqli->real_escape_string($_POST['file']);





$query = "INSERT INTO player_register (fname, sname, lname, age, weight,height,dob,nationality,county,school,playerpos,parent,contacts,fclub,nick,jersey,pjersey,file)
            VALUES ('{$fname}','{$sname}','{$lname}','{$age}','{$weight}','{$height}','{$dob}','{$nationality}','{$county}','{$school}','{$playerpos}','{$parent}','{$contacts}','{$fclub}','{$nick}','{$jersey}','{$pjersey},'{$file}')";



$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}





$mysqli->query($query);
$mysqli->close();
