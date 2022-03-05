<?php

session_start();

//unsetting all session variables
$_SESSION = array();

session_destroy();

//redirect to login page
header("location: login.php");
exit;
?>
