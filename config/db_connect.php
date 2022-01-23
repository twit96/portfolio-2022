<?php

/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


$server   = "localhost";
$user     = "portfolio_user";
$password = "portfolio_user_pass";
$db_name  = "Portfolio";

// Build Database Connection Object
require_once(__DIR__ .'/../src/Model/DB.php');
$db = new DB($server, $user, $password, $db_name);
unset($server, $user, $password, $db_name);


?>
