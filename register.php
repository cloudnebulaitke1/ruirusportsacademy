<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'zebruyic_ruirusa', 'kensta879097', 'zebruyic_ruirusa');

// REGISTER USER
if (isset($_POST['submit'])) {
  // receive all input values from the form
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $sname = mysqli_real_escape_string($db, $_POST['sname']);
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $nationality = mysqli_real_escape_string($db, $_POST['nationality']);
  $county = mysqli_real_escape_string($db, $_POST['county']);
  $position = mysqli_real_escape_string($db, $_POST['position']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM register_login WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO register_login (fname,sname,lname,email,username, email, password,phone,nationality,county,position) 
  			  VALUES('$fname','$sname','$lname','$username', '$email', '$password','$phone','$nationality','$county','$position')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location:index.html');
  }
}

?>

<!DOCTYPE html>
<title>REGISTRATION FORM</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Navigation -->
<nav class="navbar navbar-expand-sm bg-cyan navbar-dark">
    <a class="navbar-brand" href="./index.html">
     <img id="img1" src="./img/ic-launcher-web.jpg" alt="Logo" style="width:40px;">
   </a>

   
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          COACHING
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./coaching.html">Coaching schedule register</a>
          <a class="dropdown-item" href="./coaching-attendance.html">Coaching attendance</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Reports</a>
        </div>
      </li>
      
     <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          TEAMS
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="./player.html">Register</a>
          <a class="dropdown-item" href="#">Ratings</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Reports</a>
        </div>
      </li>
      
     
      <li class="nav-item">
        <a class="nav-link" href="./tournaments.html">TOURNAMENTS</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="#">VIEW REPORTS</a>
      </li>
    
    <input type="button" id="btn" class="btn btn-primary " value="REGISTER / LOGIN" onclick="window.location.href='register.html'">
  </nav>
  
 
  <hr>
  <div class="alert alert-success">Success! you are registered</div>
   
  <!--preloader-->
  
  <div class="load">
      <hr><hr><hr><hr>

</div>


<style>
   body{background:#8cd7f7}

.load{position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);
  /*change these sizes to fit into your project*/
  width:100px;
  height:100px;
}
.load hr{border:0;margin:0;width:40%;height:40%;position:absolute;border-radius:50%;animation:spin 2s ease infinite}

.load :first-child{background:#19A68C;animation-delay:-1.5s}
.load :nth-child(2){background:#F63D3A;animation-delay:-1s}
.load :nth-child(3){background:#FDA543;animation-delay:-0.5s}
.load :last-child{background:#193B48}

@keyframes spin{
  0%,100%{transform:translate(0)}
  25%{transform:translate(160%)}
  50%{transform:translate(160%, 160%)}
  75%{transform:translate(0, 160%)}
} 
    
    
    
    
    
    
</style>
  
  <!--preloader-->
 <body>
<div id="login-box">
  <div class="left">
    <form method="POST" action="register.php">
    <?php include('errors.php'); ?>
    
    <input type="text"  value="<?php echo $username; ?>"  name="username" placeholder="Username"  id="username"/>
    <input type="text"  value="<?php echo $email; ?>"   name="email" placeholder="E-mail" id="email"/>
    <input type="password" name="password_1" placeholder="Password"  id="password_1"/>
    <input type="password" name="password_2" placeholder="Re enter your password"  id="password_2"/>
    <input type="text" value="<?php echo $fname; ?>" name="fname" placeholder="Your first name"  id="fname"/>
    <input type="text" value="<?php echo $sname; ?>" name="sname" placeholder="Your second name"  id="sname"/>
    <input type="text"  value="<?php echo $lname; ?>"  name="lname" placeholder="Your last name"  id="lname"/>
    <input type="number"  value="<?php echo $phone; ?>" name="phone" placeholder="Your phone number" id="phone"  /><br><br>
    <input type="text"  value="<?php echo $county; ?>"   name="county" placeholder="Your county" id="county"/>
    
    
    
    <input type="submit" name="submit" value="SUBMIT" id="submit" /><br><br>
    
    <input type="button" width="120" name="login" value="LOGIN" class="btn btn-secondary" id="login" onclick="window.location.href='./login.html';"/>
  </div>
  
  <div class="right" style="background-image:url('https://cloudnebulaitke.com/projects/ruiru/img/ruiruteam.jpg')">
      
    
    
   
  </div>
  <div class=""><h1 style="color:#222; margin-left:10px;">ENTER YOUR DETAILS</h1></div>
</div>
 <!-- Add Firebase products that you want to use -->
 <script src="https://www.gstatic.com/firebasejs/8.3.1/firebase-auth.js"></script>
</body>   
</form>  
     



  <footer>
    <!-- Site footer -->
    <footer class="site-footer">
      <div class="container">
        <div class="row">
          <div class="col-sm-12 col-md-6">
            <h6>About</h6>
            <p class="text-justify">Ruiru Sports Academy <br><i>P.O. BOX 2320 </i> <br><i>RUIRU,KENYA </i><br><i>TEL: 0714 990364 </i>.</p>
          </div>
  
          <div class="col-xs-6 col-md-3">
            <h6>Categories</h6>
            <ul class="footer-links">
              <li><a href="">  under 17</a></li>
              <li><a href="">under 15</a></li>
              <li><a href="">under 13</a></li>
              <li><a href="">under 5</a></li>
            
            </ul>
          </div>
  
          <div class="col-xs-6 col-md-3">
            <h6>Quick Links</h6>
            <ul class="footer-links">
              <li><a href="">Coaching</a></li>
              <li><a href="">Join teams</a></li>
              <li><a href="">Tornaments</a></li>
              <li><a href="">View reports</a></li>
            
            </ul>
          </div>
        </div>
        <hr>
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-8 col-sm-6 col-xs-12">
            <p class="copyright-text">RUIRUSPORTS-ACADEMY Copyright &copy; 2021 All Rights Reserved by 
         <a href="https://cloudnebulaitke.com">cloudnebulaitke</a>.
            </p>
          </div>
  
          <div class="col-md-4 col-sm-6 col-xs-12">
            <ul class="social-icons">
              <li><a class="facebook" href="https://www.facebook.com/ruirusportsacademy/"><i class="fa fa-facebook"></i></a></li>
              <li><a class="twitter" href="https://twitter.com/ruirusports"><i class="fa fa-twitter"></i></a></li>
              <li><a class="instagram" href="https://www.instagram.com/ruirusports/"><i class="fa fa-instagram"></i></a></li>
              <li><a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>   
            </ul>
          </div>
        </div>
      </div>
  </footer>
  
  <!---form-css--->
  <style>
      
      
    @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,500);
*:focus {
  outline: none;
}

body {
  margin: 0;
  padding: 0;
  background: #DDD;
  font-size: 16px;
  color: #222;
  font-family: 'Roboto', sans-serif;
  font-weight: 300;
}

#login-box {
  position: relative;
  margin: 5% auto;
  width: 800px;
  height: 800px;
  background: #FFF;
  border-radius: 2px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
}

.nav-link{
    
    color:#fff;
    
    
}



.left {
  position: absolute;
  top: 0;
  left: 0;
  box-sizing: border-box;
  padding: 40px;
  width: 400px;
  height: 800px;
}

h1 {
  margin: 0 0 20px 0;
  font-weight: 300;
  font-size: 28px;
}

input[type="text"],
input[type="password"] {
  display: block;
  box-sizing: border-box;
  margin-bottom: 20px;
  padding: 4px;
  width: 220px;
  height: 32px;
  border: none;
  border-bottom: 1px solid #AAA;
  font-family: 'Roboto', sans-serif;
  font-weight: 400;
  font-size: 15px;
  transition: 0.2s ease;
}

input[type="text"]:focus,
input[type="password"]:focus {
  border-bottom: 2px solid #16a085;
  color: #16a085;
  transition: 0.2s ease;
}

input[type="submit"] {
  margin-top: 28px;
  width: 120px;
  height: 36px;
  background: #8cd7f7;
  border: none;
  border-radius: 2px;
  color: #FFF;
  font-family: 'Roboto', sans-serif;
  font-weight: 500;
  text-transform: uppercase;
  transition: 0.1s ease;
  cursor: pointer;
}

input[type="submit"]:hover,
input[type="submit"]:focus {
  opacity: 0.8;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
  transition: 0.1s ease;
}

input[type="submit"]:active {
  opacity: 1;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
  transition: 0.1s ease;
}

.or {
  position: absolute;
  top: 180px;
  left: 280px;
  width: 40px;
  height: 40px;
  background: #DDD;
  border-radius: 50%;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
  line-height: 40px;
  text-align: center;
}

.right {
  position: absolute;
  top: 0;
  right: 0;
  box-sizing: border-box;
  padding: 40px;
  width: 400px;
  height: 800px;
  background-color:#8cd7f7;
  background-size: cover;
  background-position: center;
  border-radius: 0 2px 2px 0;


.right .loginwith {
  display: block;
  margin-bottom: 40px;
  font-size: 28px;
  color: #FFF;
  text-align: center;
}

button.social-signin {
  margin-bottom: 20px;
  width: 220px;
  height: 36px;
  border: none;
  border-radius: 2px;
  color: #FFF;
  font-family: 'Roboto', sans-serif;
  font-weight: 500;
  transition: 0.2s ease;
  cursor: pointer;
}

button.social-signin:hover,
button.social-signin:focus {
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
  transition: 0.2s ease;
}

button.social-signin:active {
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
  transition: 0.2s ease;
}

button.social-signin.facebook {
  background: #32508E;
}

button.social-signin.twitter {
  background: #55ACEE;
}

button.social-signin.google {
  background: #DD4B39;
}  
      
  </style>
  
  
  <style>
  
  .site-footer
  {
    background-color:#222;
    padding:45px 0 20px;
    font-size:15px;
    line-height:24px;
    color:#737373;
  }
  .site-footer hr
  {
    border-top-color:#bbb;
    opacity:0.5
  }
  .site-footer hr.small
  {
    margin:20px 0
  }
  .site-footer h6
  {
    color:#fff;
    font-size:16px;
    text-transform:uppercase;
    margin-top:5px;
    letter-spacing:2px
  }
  .site-footer a
  {
    color:#737373;
  }
  .site-footer a:hover
  {
    color:#3366cc;
    text-decoration:none;
  }
  .footer-links
  {
    padding-left:0;
    list-style:none
  }
  .footer-links li
  {
    display:block
  }
  .footer-links a
  {
    color:#737373
  }
  .footer-links a:active,.footer-links a:focus,.footer-links a:hover
  {
    color:#3366cc;
    text-decoration:none;
  }
  .footer-links.inline li
  {
    display:inline-block
  }
  .site-footer .social-icons
  {
    text-align:right
  }
  .site-footer .social-icons a
  {
    width:40px;
    height:40px;
    line-height:40px;
    margin-left:6px;
    margin-right:0;
    border-radius:100%;
    background-color:#33353d
  }
  .copyright-text
  {
    margin:0
  }
  @media (max-width:991px)
  {
    .site-footer [class^=col-]
    {
      margin-bottom:30px
    }
  }
  @media (max-width:767px)
  {
    .site-footer
    {
      padding-bottom:0
    }
    .site-footer .copyright-text,.site-footer .social-icons
    {
      text-align:center
    }
  }
  .social-icons
  {
    padding-left:0;
    margin-bottom:0;
    list-style:none
  }
  .social-icons li
  {
    display:inline-block;
    margin-bottom:4px
  }
  .social-icons li.title
  {
    margin-right:15px;
    text-transform:uppercase;
    color:#96a2b2;
    font-weight:700;
    font-size:13px
  }
  .social-icons a{
    background-color:#eceeef;
    color:#818a91;
    font-size:16px;
    display:inline-block;
    line-height:44px;
    width:44px;
    height:44px;
    text-align:center;
    margin-right:8px;
    border-radius:100%;
    -webkit-transition:all .2s linear;
    -o-transition:all .2s linear;
    transition:all .2s linear
  }
  .social-icons a:active,.social-icons a:focus,.social-icons a:hover
  {
    color:#222;
    background-color:#29aafe
  }
  .social-icons.size-sm a
  {
    line-height:34px;
    height:34px;
    width:34px;
    font-size:14px
  }
  .social-icons a.facebook:hover
  {
    background-color:#3b5998
  }
  .social-icons a.twitter:hover
  {
    background-color:#00aced
  }
  .social-icons a.linkedin:hover
  {
    background-color:#007bb6
  }
  .social-icons a.dribbble:hover
  {
    background-color:#ea4c89
  }
  @media (max-width:767px)
  {
    .social-icons li.title
    {
      display:block;
      margin-right:0;
      font-weight:600
    }
  }
  

    body{
        background-color:#8cd7f7;
        background-image:url('https://cloudnebulaitke.com/projects/ruiru/img/ruiruteam.png');
        background-repeat:no-repeat;
        background-size:cover;
    }
    h1{color:#fff;}
    
    form{
        background-color:#fff;
    }


</style>







<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();





    //show alert
document.querySelector('.alert').style.display='block';

//hide alert
setTimeout(function() {
    document.querySelector('.alert').style.display='none';
},3000

);


</script>