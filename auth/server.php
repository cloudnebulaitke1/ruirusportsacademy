<?php
session_start();


// initializing variables
$firstname = "";
$lastname  = "";
$username   = "";
$phone   = "";
$email    = "";
$county   = "";
// $password = "";
// $password_1 = "";
// $password_2 = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', '', 'ruiru_sports_academy');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $firstname = mysqli_real_escape_string($db, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($db, $_POST['lastname']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $county = mysqli_real_escape_string($db, $_POST['county']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($firstname)) {
   array_push($errors, "firstname is required");
   }
   if (empty($lastname)) {
   array_push($errors, "lastname is required");
   }
   if (empty($username)) {
   array_push($errors, "username is required");
   }
   if (empty($phone)) {
   array_push($errors, "phone is required");
   }
   
  if (empty($email)) {
   array_push($errors, "email is required");
    }
    if (empty($county)) {
   array_push($errors, "county is required");
   }
  if (empty($password_1)) {
   array_push($errors, "Password is required"); 
 }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $firstname) {
      array_push($errors, "username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }



try {
  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
    $password = md5($password_1);//encrypt the password before saving in the database
 $query = "INSERT INTO users (firstname,lastname,username, phone, email,  county, password) 
          VALUES('$firstname', '$lastname', '$username', '$phone', '$email',  '$county', '$password')";

    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    $_SESSION['firstname'] = $firstname;
    $_SESSION['success'] = "You are now logged in";
    header('location: profile.php');
  }
  
} catch (Exception $e) {
  echo 'Message: ' .$e->getMessage();
  
 }
  
}



 
// LOGIN USER
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
    array_push($errors, "email is required");
  }
  if (empty($password)) {
    array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($results) == 1) {
      $_SESSION['email'] = $email;
      $_SESSION['success'] = "You are now logged in";
     
     header('location: profile.php');
    }else {
      array_push($errors, "Wrong email or password combination");

      
    }
  }
}

?>