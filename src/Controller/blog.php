<?php

require_once (__DIR__ .'/../../config/db_connect.php');
require_once (__DIR__ .'/../Controller/URL.php');
require_once (__DIR__ .'/../Model/BlogPost.php');


function getBlogPosts(
  $db,
  $in_id=null,
  $in_tag_name=null,
  $in_include_unpublished=null,
  $in_page_num=null
) {


  // Configure Pagination - SQL LIMIT Clause
  $limit = "";
  if (
    (!empty($in_page_num)) &&
    (is_int($in_page_num)) &&
    ($in_page_num > 0)
  ) {
    $ini = parse_ini_file(__DIR__ .'/../../config/config.ini.php', true)['blog_config'];
    $posts_per_page = $ini["posts_per_page"];
    $ini = null; unset($ini);
    $num_skipped = ($in_page_num - 1) * $posts_per_page;
    $limit .= " LIMIT ".$num_skipped.",".$posts_per_page;
  }


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
      "SELECT p.* FROM blog_posts AS p JOIN blog_post_tags AS bpt ON p.id = bpt.blog_post_id JOIN tags AS t ON t.id = bpt.tag_id WHERE t.name=? AND p.published=1 ORDER BY date_posted DESC".$limit,
      "s",
      array($in_tag_name)
    );

  // Select All
  } else if (!empty($in_include_unpublished)) {
    $result = $db->getResults(
      "SELECT * FROM blog_posts ORDER BY date_posted DESC".$limit
    );

  // Select All (Published Only)
  } else {
    $result = $db->getResults(
      "SELECT * FROM blog_posts WHERE published=1 ORDER BY date_posted DESC".$limit
    );
  }

  $post_array = array();
  while ($row = $result->fetch_assoc()) {
    $this_post = new BlogPost(
      $db,
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


function getNumBlogPosts($db) {
  $result = $db->getResults(
    "SELECT COUNT(*) FROM blog_posts WHERE published=1",
    null,
    null
  );
  return ($result->fetch_row()[0]);
}


function configBlogURL($db) {
  $ini = parse_ini_file(__DIR__ .'/../../config/config.ini.php', true)['blog_config'];
  $posts_per_page = $ini["posts_per_page"];
  $ini = null; unset($ini);

  $total_pages = ceil(
    getNumBlogPosts($db) / $posts_per_page
  );

  $url = new URL(
    $posts_per_page,
    $total_pages
  );
  return $url;
}


?>
