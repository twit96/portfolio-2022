<?php


// Pull Database Info from Config File
$ini = parse_ini_file(__DIR__ .'/config.ini.php', true)['database'];

$server   = $ini["db_server"];
$user     = $ini["db_user"];
$password = $ini["db_password"];
$db_name  = $ini["db_name"];

// Establish Database Connection
require_once(__DIR__ .'/../src/Model/DB.php');
$db = new DB($server, $user, $password, $db_name);

// Remove Sensitive Information from Memory
$ini = $server = $user = $password = $db_name = null;
unset($ini, $server, $user, $password, $db_name);


?>
