<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
// $_SESSION["loggedin"]=false;
$_SESSION = array();
// $_SESSION["username"]="";
// $_SESSION["id"]="";
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: landing-page.php");
exit;
?>