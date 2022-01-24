<?php


DEFINE("FILENAME", 'blog');
require_once (__DIR__ .'/../common/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

require_once (__DIR__ .'/../common/header.php');

// Opening HTML
$url_tag = str_replace("-", " ", htmlspecialchars($_GET["tag"]));
echo <<<TOP
\n    <main id="blog">
      <div class="wrapper">
        <h1><a href="/blog">Blog</a> / <span>{$url_tag}</span></h1>
      </div>
      <div class="wrapper grid">
TOP;

$blog_posts = getBlogPosts($db, null, $url_tag, null);
$db->close();

foreach ($blog_posts as $post) {
  $this_link = '/blog/post/'.$post->id.'/'.str_replace(" ", "-", strtolower($post->title)).'/';

  echo '<article>';

  if (!empty($post->image)) {
    $img_path = substr($post->image->path.$post->image->name, 1);
    echo <<<IMG_LINK
    <a class="img-link" href="{$this_link}">
      <img src="{$img_path}" loading="lazy" alt="{$post->title} Title Card" />
    </a>
    IMG_LINK;
  }

  // Details
  echo '<div class="details">';
  // tags
  if (is_array($post->tags) && count($post->tags) > 0) {
    echo '<ul class="tags">';
    foreach ($post->tags as $tag) {
      echo '<li><a href="/blog/tag/'.str_replace(" ", "-", $tag->name).'/">'.$tag->name.'</a></li>';
    }
    echo '</ul>';
  }
  // title
  echo '<h3><a href="'.$this_link.'">'.$post->title.'</a></h3>';
  // blurb
  echo '<p>';
  // remove tags from blurb (not headings)
  $blurb = strip_tags($post->post, "<h1><h2><h3><h4><h5><h6><h7>");
  // replace any headings in blurb with bold tags
  for ($i=1; $i<7; $i++) {
    $blurb = str_replace('<h'.$i.'>', '<b style="display:block;">', $blurb);
    $blurb = str_replace('</h'.$i.'>', '</b>', $blurb);
  }
  // shorten blurb if too long
  if (strlen($blurb) > 150) {
    $blurb = substr($blurb,0,150);
    echo $blurb.'...';
  } else {
    echo $blurb;
  }
  echo '</p>';
  echo '</div>';
  // Author
  echo '<div class="author">';
  echo '<img src="'.$post->author_img_path.'" alt="'.$post->author.' Image" />';
  $date_text = '<p><b>'.$post->author.'</b> on <span>'.$post->date_posted.'</span>';
  if (
    (!empty($post->date_updated)) &&
    ($post->date_posted != $post->date_updated)
  ) {
    $date_text.=' <span>(Updated on <span>'.$post->date_updated.')</span></span>';
  }
  $date_text.='</p>';
  echo $date_text;
  echo '</div>';
  echo '</article>';
}
// Close BlogPost Grid Section
echo '</div>  <!-- ./wrapper grid -->';


// Page Indicator Section
// $total_posts = getNumBlogPosts($db);
// $total_pages = ceil($total_posts/12);
// $total_pages = $total_posts;
// echo '<script>alert("$total_pages: '.$total_pages.'");</script>';
// require_once (__DIR__ .'/common/PageIndicator.php');


// Closing HTML
echo '</main>';

require_once (__DIR__ .'/../common/footer.php');

echo <<<PAGE_END
  </body>
</html>
PAGE_END;


?>
