<?php


$server   = "localhost";
$user     = "portfolio_user";
$password = "portfolio_user_pass";
$db_name  = "Portfolio";

// Build Database Connection Object
require_once('../src/Model/DB.php');
$db = new DB($server, $user, $password, $db_name);


?>
