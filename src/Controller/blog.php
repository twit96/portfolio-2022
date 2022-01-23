<?php

require_once (__DIR__ .'/../../config/db_connect.php');
require_once (__DIR__ .'/../Model/BlogPost.php');


function getBlogPosts(
  $mysqli,
  $in_id=null,
  $in_tag_name=null,
  $in_include_unpublished=null
) {

  // Search By id
  if (!empty($in_id)) {
    $result = $db->getResults(
      "SELECT * FROM blog_posts WHERE id=? AND published=1",
      "i",
      array($in_id)
    );

  // Search By Tag (order by newest first)
  } else if (!empty($in_tag_name)) {
    $result = $db->getResults(
      "SELECT p.* FROM blog_posts AS p JOIN blog_post_tags AS bpt ON p.id = bpt.blog_post_id JOIN tags AS t ON t.id = bpt.tag_id WHERE t.name=? AND p.published=1 ORDER BY date_posted DESC",
      "s",
      array($in_tag_name)
    );

  // Select All
  } else if (!empty($in_include_unpublished)) {
    $result = $db->getResults(
      "SELECT * FROM blog_posts ORDER BY date_posted DESC"
    );

  // Select All (Published Only)
  } else {
    $result = $db->getResults(
      "SELECT * FROM blog_posts WHERE published=1 ORDER BY date_posted DESC"
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


function getNumBlogPosts($mysqli) {
  $result = $db->getResults(
    "SELECT COUNT(*) FROM blog_posts WHERE published=1",
    null,
    null
  );
  return ($result->fetch_row()[0]);
}


?>
