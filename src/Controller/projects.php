<?php


require_once (__DIR__ .'/../../config/db_connect.php');
require_once (__DIR__ .'/../Model/Project.php');


function getProjects($db, $featured_only=FALSE) {
  if ($featured_only == TRUE) {
    $result = $db->getResults(
      "SELECT * FROM projects WHERE featured>0 ORDER BY featured, date DESC"
    );
  } else {
    $result = $db->getResults(
      "SELECT * FROM projects ORDER BY date DESC"
    );
  }

  $project_array = array();
  while ($row = $result->fetch_assoc()) {
    $this_project = new Project(
      $db,
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
