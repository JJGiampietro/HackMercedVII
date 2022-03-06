<?php

define('DB_SERVER', 'localhost'); //database server
define('DB_USERNAME', 'root'); //database username
define('DB_PASSWORD', ''); //database password
define('DB_NAME', 'users'); //databse name

/*Connect to SQL DB*/
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);

/*Check connection*/
if($link == false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}

?>