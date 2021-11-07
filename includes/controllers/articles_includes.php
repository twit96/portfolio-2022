<?php
/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");

include (__DIR__ .'../models/blog_post.php');

// Connect to MySQL Server
$server = "localhost";
$user   = "portfolio_user";
$pwd    = "portfolio_user_pass";
$dbName = "Portfolio";
$mysqli = new mysqli ($server, $user, $pwd, $dbName);
if ($mysqli->connect_errno) {
  die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
}

function getBlogPosts($in_id=null, $in_tag_id=null) {
  if (!empty($in_id)) {
    $query = mysql_query("SELECT * FROM blog_posts WHERE id=".$in_id." ORDER BY id DESC");
  } else if (!empty($in_tag_id)) {
    $query = mysql_query("SELECT blog_posts.* FROM blog_post_tags LEFT JOIN (blog_posts) ON (blog_post_tags.post_id = blog_posts.id) WHERE blog_post_tags.tag_id=".$tag_id." ORDER BY blog_posts.id DESC");
  } else {
    $query = mysql_query("SELECT * FROM blog_posts ORDER BY id DESC");
  }

  $post_array = array();
  while ($row = mysql_fetch_assoc($query)) {
    $this_post = new BlogPost($row["id"], $row["directory"], $row["image"], $row["title"], $row["post"], $row["author_id"], $row["date_posted"], $row["date_updated"]);
    array_push($post_array, $this_post);
  }
  return $post_array;
}

?>
