<?php

/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");

include (__DIR__ .'/../helpers/db_connect.php');
include (__DIR__ .'/../classes/Project.php');


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
      $row["featured"],
      $row["author_id"]
    );
    array_push($project_array, $this_project);
  }
  return $project_array;
}

?>
