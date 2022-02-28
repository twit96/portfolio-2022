<?php


/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


require_once (__DIR__ .'/../../config/db_connect.php');


session_start();
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
  require_once (__DIR__ .'/../View/user/dashboard.php');
} else {
  require_once (__DIR__ .'/../View/user/login.php');
}


?>
