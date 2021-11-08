<?php

/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


include (__DIR__.'/../controllers/articles_includes.php');


if (isset($_GET['title'])) {
    $title = ucfirst(join(" ", explode("-", $_GET["title"])));
    displayOneArticle($mysqli, $title);
} else {
    displayAllArticles($mysqli);
}


function displayOneArticle($mysqli, $title) {


  $post = getBlogPosts($mysqli, $title, null);
  if (sizeof($post) > 0) {
    $post = $post[0];
    var_dump($post);
  } else {
    // no blog post - redirect to articles page
    header('Location: ./articles');
    die();
  }

  // Opening HTML
  echo <<<TOP
  \n    <main id="post">
        <div class="wrapper">
  TOP;

  echo '<article>';
  if (!empty($post->$image)) {
    echo '<div class="card details" style="background-image: url(/img/projects/'.$post->directory.'/'.$post->image.')">';
  } else {
    echo '<div class="card details">';
  }
  echo '<h1>'.$post->title.'</h1>';
  if (is_array($post->tags) && sizeof($post->tags) > 0) {
    echo '<ul class="tags">';
    foreach ($post->tags as $tag) {
      echo '<li><a href="#">'.$tag.'</a></li>';
    }
    echo '</ul>';
  }
  echo '<div class="author">';
  echo '<img src="/img/profile.jpg" alt="'.$post->author.' Image" />';
  echo '<p><b>'.$post->author.'</b> on <span>'.$post->date_posted.'</span> ';
  if ($post->date_posted != $post->date_updated) {
    echo '(Updated on <span>'.$post->date_updated.')</span>';
  }
  echo '</p>';
  echo '</div>';  //./author
  echo '<div class="btm-border"></div>';
  echo '</div>';  // ./card details
  echo '<div class="card">'.$post->post.'</div>';  // post content
  echo '</article>';

  echo '<div id="sidebar">';
  include (__DIR__.'/../templates/toc.html');
  echo '</div>';

  // Closing HTML
  echo <<<BTM
  \n    </div>  <!-- ./wrapper -->
      </main>
  BTM;
}


function displayAllArticles($mysqli) {
  // Opening HTML
  echo <<<TOP
  \n    <main id="articles">
        <div class="wrapper">
          <h1>Articles</h1>
        </div>
        <div class="wrapper grid">
  TOP;

  $blog_posts = getBlogPosts($mysqli);
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
    if (is_array($post->tags) && sizeof($post->tags) > 0) {
      echo '<ul class="tags">';
      foreach ($post->tags as $tag) {
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
      echo '<p><b>'.$post->author.'</b> on <span>'.$post->date_posted.'</span> ';
      if ($post->date_posted != $post->date_updated) {
        echo '(Updated on <span>'.$post->date_updated.')</span>';
      }
      echo'</p>';
    echo '</div>';
    echo '</article>';
  }

  // Closing HTML
  echo <<<BTM
  \n    </div>  <!-- ./wrapper grid -->
      </main>
  BTM;
}




?>
