<?php
/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");

include (__DIR__ .'../controllers/articles_includes.php');

$blog_posts = $getBlogPosts();
foreach ($blog_posts as $post) {
  echo '<article>';

  if (!empty($post->directory) && (!empty($post->image))) {
    echo <<<IMG_LINK
    <a class="img-link" href="#">
      <img src="/img/articles/{$post->directory}/{$post->image}" loading="lazy" alt="{$post->title} Title Card" />
    </a>
    IMG_LINK;
  }


  // Details
  echo '<div class="details">';
  // tags
  if ($sizeof($post->tags) > 0) {
    echo '<ul class="tags">';
    foreach ($tags as $tag) {
      echo '<li><a href="#">'.$tag.'</a></li>';
    }
    echo '</ul>';
  }
  // title
  echo '<h3><a href="#">'.$post->title.'</a></h3>';
  // blurb
  echo '<p>';
  if (strlen($post->post) > 150) {
    echo substr($post->post,0,150).'...';
  } else {
    echo $post->post;
  }
  echo '</p>';
  echo '</div>';
  // Author
  echo '<div class="author">';
    echo '<img src="/img/profile.jpg" alt="'.$post->author.' Image" />';
  echo '</div>';
  echo '</article>';
}

?>
