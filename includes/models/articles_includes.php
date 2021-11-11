<?php

include (__DIR__ .'/../helpers/db_connect.php');
include (__DIR__ .'/../classes/BlogPost.php');


function getBlogPosts($mysqli, $in_title=null, $in_tag_name=null) {

  if (!empty($in_title)) {
    $in_title = $mysqli->real_escape_string($in_title);
    $command = "SELECT * FROM blog_posts WHERE title='".$in_title."' ORDER BY date_posted DESC;";
  } else if (!empty($in_tag_name)) {
    $in_tag_name = $mysqli->real_escape_string(str_replace("-", " ", $in_tag_name));
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
