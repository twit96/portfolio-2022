<?php


$id = htmlspecialchars($_GET["id"]);
$post = getBlogPosts($db, $id, null, null);
$db->close();

if (count($post) > 0) {
  $post = $post[0];
} else {
  // no blog post of the given name - redirect to blog page
  header('Location: /blog');
  die();
}

DEFINE("FILENAME", 'blog');
DEFINE("BLOGPOSTNAME", $post->title);
require_once (__DIR__ .'/../common/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

require_once (__DIR__ .'/../common/header.php');

// Opening HTML
echo <<<TOP
\n    <main id="post">
      <div class="wrapper">
TOP;

echo '<article>';
if (!empty($post->image)) {
  // remove leading period from image path for use as CSS background image
  $img_path = substr($post->image->path.$post->image->name, 1);
  echo '<div class="card details" style="background-image: url('.$img_path.')">';
} else {
  echo '<div class="card details">';
}
echo '<h1>'.$post->title.'</h1>';
if (is_array($post->tags) && count($post->tags) > 0) {
  echo '<ul class="tags">';
  foreach ($post->tags as $tag) {
    echo '<li><a href="../../../tag/'.str_replace(" ", "-", $tag->name).'/">'.$tag->name.'</a></li>';
  }
  echo '</ul>';
}
echo '<div class="author">';
echo '<img src="'.$post->author_img_path.'" alt="'.$post->author.' Image" />';
echo '<p><b>'.$post->author.'</b> on <span>'.$post->date_posted.'</span> ';
if (
  (!empty($post->date_updated)) &&
  ($post->date_posted != $post->date_updated)
) {
  echo '(Updated on <span>'.$post->date_updated.')</span>';
}
echo '</p>';
echo '</div>';  //./author
echo '<div class="btm-border"></div>';
echo '</div>';  // ./card details
echo '<div class="card">'.$post->post.'</div>';  // post content
echo '</article>';

echo '<div id="sidebar">';
include (__DIR__ .'/toc.html');
echo '</div>';

// Closing HTML
echo <<<BTM
\n    </div>  <!-- ./wrapper -->
    </main>
BTM;

require_once (__DIR__ .'/../common/footer.php');

echo <<<PAGE_END
  </body>
</html>
PAGE_END;


?>
