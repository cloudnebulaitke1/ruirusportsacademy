<?php
//start session.
session_start();

//destroy session.
if(session_destroy()){
//redirect to login page
header("Location:login.html")
exit;

}

?>