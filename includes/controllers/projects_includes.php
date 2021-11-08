<?php

include (__DIR__ .'/../models/project.php');

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


function getProjects($mysqli, $featured_only=FALSE) {
  if ($featured_only == TRUE) {
    $command = 'SELECT * FROM projects WHERE featured>0 ORDER BY featured, date DESC;';
  } else {
    $command = 'SELECT * FROM projects ORDER BY date DESC;';
  }
  $result = $mysqli->query($command);
  if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }

  $project_array = array();
  while ($row = $result->fetch_assoc()) {
    $this_project = new Project(
      $mysqli,
      $row["ID"],
      $row["title"],
      $row["directory"],
      $row["image"],
      $row["blurb"],
      $row["description"],
      $row["date"],
      $row["featured"]
    );
    array_push($project_array, $this_project);
  }
  return $project_array;
}

?>
