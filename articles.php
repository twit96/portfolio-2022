<?php

/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


include ('./includes/models/articles.php');


if (isset($_GET['post'])) {
  include ('./includes/views/articles_single.php');
} else if (isset($_GET['tag'])) {
  displayTaggedArticles($mysqli);
} else {
  displayAllArticles($mysqli);
}




function displayTaggedArticles($mysqli) {
  DEFINE("FILENAME", 'articles');
  include('./includes/templates/head.php');
  echo <<<HEAD_END
  \n  </head>
    <body>
  HEAD_END;

  include('./includes/templates/header.php');

  // Opening HTML
  $tag = str_replace("-", " ", $_GET['tag']);
  echo <<<TOP
  \n    <main id="articles">
        <div class="wrapper">
          <h1><a href="../../articles">Articles</a> / <span>{$tag}</span></h1>
        </div>
        <div class="wrapper grid">
  TOP;

  $tag = str_replace(" ", "-", $tag);
  $blog_posts = getBlogPosts($mysqli, null, $tag);
  foreach ($blog_posts as $post) {
    $this_link = '../../post/'.str_replace(" ", "-", strtolower($post->title));

    echo '<article>';

    if (!empty($post->directory) && (!empty($post->image))) {
      echo <<<IMG_LINK
      <a class="img-link" href="{$this_link}">
        <img src="{$post->path}/{$post->image}" loading="lazy" alt="{$post->title} Title Card" />
      </a>
      IMG_LINK;
    }

    // Details
    echo '<div class="details">';
    // tags
    if (is_array($post->tags) && sizeof($post->tags) > 0) {
      echo '<ul class="tags">';
      foreach ($post->tags as $tag) {
        echo '<li><a href=./articles/='.str_replace(" ", "-", $tag).'>'.$tag.'</a></li>';
      }
      echo '</ul>';
    }
    // title
    echo '<h3><a href="'.$this_link.'">'.$post->title.'</a></h3>';
    // blurb
    echo '<p>';
    if (strlen($post->post) > 150) {
      $blurb = substr($post->post,0,150);
      // replace any headings in blurb
      for ($i=1; $i<7; $i++) {
        $blurb = str_replace('h'.$i, 'b style="display:block;"', $blurb);
      }
      echo $blurb.'...';
    } else {
      echo $post->post;
    }
    echo '</p>';
    echo '</div>';
    // Author
    echo '<div class="author">';
    echo '<img src="'.$post->author_img_path.'" alt="'.$post->author.' Image" />';
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

  include('./includes/templates/footer.php');

  echo <<<PAGE_END
    </body>
  </html>
  PAGE_END;

}


function displayAllArticles($mysqli) {

  DEFINE("FILENAME", 'articles');
  include('./includes/templates/head.php');
  echo <<<HEAD_END
  \n  </head>
    <body>
  HEAD_END;

  include('./includes/templates/header.php');

  // Opening HTML
  echo <<<TOP
  \n    <main id="articles">
        <div class="wrapper">
          <h1>Articles</h1>
        </div>
        <div class="wrapper grid">
  TOP;

  $blog_posts = getBlogPosts($mysqli, null, null);
  foreach ($blog_posts as $post) {
    $this_link = './articles/post/'.str_replace(" ", "-", strtolower($post->title));

    echo '<article>';

    if (!empty($post->directory) && (!empty($post->image))) {
      echo <<<IMG_LINK
      <a class="img-link" href="{$this_link}">
        <img src="{$post->path}/{$post->image}" loading="lazy" alt="{$post->title} Title Card" />
      </a>
      IMG_LINK;
    }

    // Details
    echo '<div class="details">';
    // tags
    if (is_array($post->tags) && sizeof($post->tags) > 0) {
      echo '<ul class="tags">';
      foreach ($post->tags as $tag) {
        echo '<li><a href="./articles/tag/'.str_replace(" ", "-", $tag).'">'.$tag.'</a></li>';
      }
      echo '</ul>';
    }
    // title
    echo '<h3><a href="'.$this_link.'">'.$post->title.'</a></h3>';
    // blurb
    echo '<p>';
    if (strlen($post->post) > 150) {
      $blurb = substr($post->post,0,150);
      // replace any headings in blurb
      for ($i=1; $i<7; $i++) {
        $blurb = str_replace('h'.$i, 'b style="display:block;"', $blurb);
      }
      echo $blurb.'...';
    } else {
      echo $post->post;
    }
    echo '</p>';
    echo '</div>';
    // Author
    echo '<div class="author">';
    echo '<img src="'.$post->author_img_path.'" alt="'.$post->author.' Image" />';
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

  include('./includes/templates/footer.php');

  echo <<<PAGE_END
    </body>
  </html>
  PAGE_END;
}


?>
