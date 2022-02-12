<?php


require_once (__DIR__ .'/../../config/db_connect.php');
require_once (__DIR__ .'/../Controller/URL.php');
require_once (__DIR__ .'/../Model/Project.php');


function getProjects(
  $db,
  $featured_only=FALSE,
  $in_page_num=null
) {
  if ($featured_only == TRUE) {
    $result = $db->getResults(
      "SELECT * FROM projects WHERE featured>0 ORDER BY featured, date DESC"
    );
  } else {
    // configure pagination - SQL LIMIT clause
    $limit = "";
    if (
      (!empty($in_page_num)) &&
      (is_int($in_page_num)) &&
      ($in_page_num > 0)
    ) {
      $ini = parse_ini_file(__DIR__ .'/../../config/config.ini.php', true)['projects_config'];
      $posts_per_page = $ini["posts_per_page"];
      $ini = null; unset($ini);
      $num_skipped = ($in_page_num - 1) * $posts_per_page;
      $limit .= " LIMIT ".$num_skipped.",".$posts_per_page;
    }

    $result = $db->getResults(
      "SELECT * FROM projects ORDER BY date DESC".$limit
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


function getNumProjects($db) {
  $result = $db->getResults(
    "SELECT COUNT(*) FROM projects",
    null,
    null
  );
  return ($result->fetch_row()[0]);
}


function configProjectsURL($db) {
  $ini = parse_ini_file(__DIR__ .'/../../config/config.ini.php', true)['projects_config'];
  $posts_per_page = $ini["posts_per_page"];
  $ini = null; unset($ini);

  $total_pages = ceil(
    getNumProjects($db) / $posts_per_page
  );

  $url = new URL(
    $posts_per_page,
    $total_pages
  );
  return $url;
}


?>
