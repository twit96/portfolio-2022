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
* Reused code in all prepared statements. Executes a prepared statement, logs
* any errors, closes the statement, and returns the result.
* $stmt should be a mysqli prepared statement with the parameters already bound
* and set equal to the desired values.
*/
function executeStatement($mysqli, $stmt) {
  $stmt->execute();
  if ($stmt === false) {
    error_log('mysqli execute() failed: ');
    error_log( print_r( htmlspecialchars($stmt->error), true ) );
  }
  $result = $stmt->get_result();
  $stmt->close();
  return $result;
}


?>
