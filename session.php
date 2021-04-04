<?php
//start session
session_start();

//if user is already login in redirect to a page

if(isset($_SESSION["userid"])&&$_SESSION["userid"]=== true){
    header("location:")
    exit;


}




?>