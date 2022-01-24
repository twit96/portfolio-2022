<?php

/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


require_once ('../src/Controller/blog.php');


if (isset($_GET["id"])) {
  require_once ('../src/View/blog/single_post.php');
} else if (isset($_GET["tag"])) {
  require_once ('../src/View/blog/tagged_posts.php');
} else {
  require_once ('../src/View/blog/all_posts.php');
}


?>
