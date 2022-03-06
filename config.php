<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "hackmerceddb";

/*Connect to SQL DB*/
$link = mysqli_connect($server, $username, $password, $database);

/*Check connection*/
if($link == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>