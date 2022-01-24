<?php


// Pull Database Info from Config File
$ini = parse_ini_file(__DIR__ .'/config.ini.php', true)['database'];

$host     = $ini["db_host"];
$username = $ini["db_username"];
$password = $ini["db_password"];
$db_name  = $ini["db_name"];

// Establish Database Connection
require_once(__DIR__ .'/../src/Model/DB.php');
$db = new DB($host, $username, $password, $db_name);

// Remove Sensitive Information from Memory
$ini = $host = $username = $password = $db_name = null;
unset($ini, $host, $username, $password, $db_name);


?>
