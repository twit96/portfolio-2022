<?php
/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");

include (__DIR__ .'/../models/blog_post.php');

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


function getBlogPosts($mysqli, $in_title=null, $in_tag_name=null) {
  if (!empty($in_title)) {
    $in_title = $mysqli->real_escape_string($in_title);
    $command = "SELECT * FROM blog_posts WHERE title='".$in_title."' ORDER BY date_posted DESC;";
  } else if (!empty($in_tag_name)) {
    $in_tag_name = $mysqli->real_escape_string($in_tag_name);
    // $command = "SELECT blog_posts.* FROM blog_post_tags LEFT JOIN (blog_posts) ON (blog_post_tags.blog_post_id = blog_posts.id) WHERE blog_post_tags.tag_id IN (SELECT id FROM tags WHERE name='".$in_tag_name."') ORDER BY blog_posts.date_posted DESC;";
    $command = "SELECT p.* FROM blog_posts AS p JOIN blog_post_tags AS bpt ON p.id = bpt.blog_post_id JOIN tags AS t ON t.id = bpt.tag_id WHERE t.name = '".$in_tag_name."' ORDER BY date_posted DESC;";
  } else {
    $command = "SELECT * FROM blog_posts ORDER BY date_posted DESC;";
  }
  $result = $mysqli->query($command);
  if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }

  $post_array = array();
  while ($row = $result->fetch_assoc()) {
    $this_post = new BlogPost(
      $mysqli,
      $row["id"],
      $row["directory"],
      $row["image"],
      $row["title"],
      $row["post"],
      $row["author_id"],
      $row["date_posted"],
      $row["date_updated"]
    );
    array_push($post_array, $this_post);
  }
  return $post_array;
}

?>
