<?php

include (__DIR__ .'/../helpers/db_connect.php');
include (__DIR__ .'/../classes/BlogPost.php');


function getBlogPosts($mysqli, $in_title=null, $in_tag_name=null) {

  if (!empty($in_title)) {
    $stmt = $mysqli->prepare("SELECT * FROM blog_posts WHERE title=? ORDER BY date_posted DESC");
    $stmt->bind_param("i", $this_title);
    $this_title = $in_title;

  } else if (!empty($in_tag_name)) {
    $stmt = $mysqli->prepare("SELECT p.* FROM blog_posts AS p JOIN blog_post_tags AS bpt ON p.id = bpt.blog_post_id JOIN tags AS t ON t.id = bpt.tag_id WHERE t.name=? ORDER BY date_posted DESC");
    $stmt->bind_param("i", $this_tag);
    $this_tag = $in_tag_name;

  } else {
    $stmt = $mysqli->prepare("SELECT * FROM blog_posts ORDER BY date_posted DESC");
  }

  $stmt->execute();
  if ($stmt === false) {
    error_log('mysqli execute() failed: ');
    error_log( print_r( htmlspecialchars($stmt->error), true ) );
  }
  $result = $stmt->get_result();
  $stmt->close();

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
