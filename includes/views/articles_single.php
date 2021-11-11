<?php


// configure title
$title = ucfirst(str_replace("-", " ", $_GET["post"]));
$post = getBlogPosts($mysqli, $title, null);
if (sizeof($post) > 0) {
  $post = $post[0];
} else {
  // no blog post of the given name - redirect to articles page
  header('Location: ./articles');
  die();
}

DEFINE("FILENAME", 'articles');
DEFINE("ARTICLENAME", $title);
include('./includes/templates/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('./includes/templates/header.php');

// Opening HTML
echo <<<TOP
\n    <main id="post">
      <div class="wrapper">
TOP;

echo '<article>';
if (!empty($post->path) && !empty($post->image)) {
  echo '<div class="card details" style="background-image: url('.$post->path.$post->image.')">';
} else {
  echo '<div class="card details">';
}
echo '<h1>'.$post->title.'</h1>';
if (is_array($post->tags) && sizeof($post->tags) > 0) {
  echo '<ul class="tags">';
  foreach ($post->tags as $tag) {
    echo '<li><a href="../'.str_replace(" ", "-", $tag).'">'.$tag.'</a></li>';
  }
  echo '</ul>';
}
echo '<div class="author">';
echo '<img src="'.$post->author_img_path.'" alt="'.$post->author.' Image" />';
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
include ('./includes/templates/toc.html');
echo '</div>';

// Closing HTML
echo <<<BTM
\n    </div>  <!-- ./wrapper -->
    </main>
BTM;

include('./includes/templates/footer.php');

echo <<<PAGE_END
  </body>
</html>
PAGE_END;


?>
