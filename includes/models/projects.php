<?php

include (__DIR__ .'/../helpers/db_connect.php');
include (__DIR__ .'/../classes/Project.php');


function getProjects($mysqli, $featured_only=FALSE) {
  if ($featured_only == TRUE) {
    $stmt = $mysqli->prepare("SELECT * FROM projects WHERE featured>0 ORDER BY featured, date DESC");
  } else {
    $stmt = $mysqli->prepare("SELECT * FROM projects ORDER BY date DESC");
  }
  $stmt->execute();
  if ($stmt === false) {
    error_log('mysqli execute() failed: ');
    error_log( print_r( htmlspecialchars($stmt->error), true ) );
  }
  $result = $stmt->get_result();
  $stmt->close();

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
