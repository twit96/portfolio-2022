<?php


// Connect to MySQL Server
$server = "localhost";
$user   = "portfolio_user";
$pwd    = "portfolio_user_pass";
$dbName = "Portfolio";
$mysqli = new mysqli ($server, $user, $pwd, $dbName);
if ($mysqli->connect_errno) {
  die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
}
// Select Database
$mysqli->select_db($dbName) or die($mysqli->error);


/**
* Reused code in all prepared statements.
* $mysqli is a database object, $query is a string, $types is a string, and
* $params is an array.
*/
function getResults($mysqli, $query, $types, $params) {
  $stmt = $mysqli->prepare($query);
  $stmt->bind_param($types, ...$params);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();
  return $result;
}


?>
