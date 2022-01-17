<?php

require_once (__DIR__ .'/../helpers/db_connect.php');
require_once (__DIR__ .'/../classes/BlogPost.php');


function getBlogPosts(
  $mysqli,
  $in_title=null,
  $in_date_posted=null,
  $in_tag_name=null
) {

  // Search By Title and Date (grab first match only)
  if (!empty($in_title) and !empty($in_date_posted)) {
    $result = getResults(
      $mysqli,
      "SELECT * FROM blog_posts WHERE title=? AND date_posted=? LIMIT 1",
      "ss",
      array($in_title)
    );

  // Search By Tag (order by newest first)
  } else if (!empty($in_tag_name)) {
    $result = getResults(
      $mysqli,
      "SELECT p.* FROM blog_posts AS p JOIN blog_post_tags AS bpt ON p.id = bpt.blog_post_id JOIN tags AS t ON t.id = bpt.tag_id WHERE t.name=? ORDER BY date_posted DESC",
      "s",
      array($in_tag_name)
    );

  // Select All
  } else {
    $result = getResults(
      $mysqli,
      "SELECT * FROM blog_posts ORDER BY date_posted DESC"
    );
  }

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
