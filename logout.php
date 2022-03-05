<?php

session_start();

//unsetting all session variables
$_SESSION = array();

session_destroy();
