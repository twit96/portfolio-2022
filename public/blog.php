<?php

/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


require_once (__DIR__ .'/../src/Controller/blog.php');


if (isset($_GET["id"])) {
  require_once (__DIR__ .'/../src/View/blog/single_post.php');
} else if (isset($_GET["tag"])) {
  require_once (__DIR__ .'/../src/View/blog/tagged_posts.php');
} else {
  require_once (__DIR__ .'/../src/View/blog/all_posts.php');
}


?>
