<?php


DEFINE("FILENAME", 'blog');
require_once (__DIR__ .'/../common/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

require_once (__DIR__ .'/../common/header.php');

// Opening HTML
echo <<<TOP
\n    <main id="blog">
      <div class="wrapper">
        <h1>Blog</h1>
        <div class="article-grid">
TOP;

$blog_posts = getBlogPosts($db, null, null, null, $url->page_num);
$db->close();

foreach ($blog_posts as $post) {
  $this_link = './blog/post/'.$post->id.'/'.str_replace(" ", "-", strtolower($post->title)).'/';

  echo '<article class="article-card">';


  // Info
  echo '<div class="info">';
  if (!empty($post->image)) {
    $img_path = substr($post->image->path.$post->image->name, 1);
    echo <<<IMG_LINK
    <a class="img-link" href="{$this_link}">
      <img src="{$img_path}" loading="lazy" alt="{$post->title} Title Card" />
    </a>
    IMG_LINK;
  }
  echo '</div>';


  // Details
  echo '<div class="details">';

  // tags
  if (is_array($post->tags) && count($post->tags) > 0) {
    echo '<ul class="tags">';
    foreach ($post->tags as $tag) {
      echo '<li><a href="./blog/tag/'.str_replace(" ", "-", $tag->name).'/">'.$tag->name.'</a></li>';
    }
    echo '</ul>';
  }

  // title
  echo '<div class="title">';
  echo '<h2><a href="'.$this_link.'">'.$post->title.'</a></h2>';
  echo '<em>'.$post->date_posted.'</em>';
  // if (
  //   (!empty($post->date_updated)) &&
  //   ($post->date_posted != $post->date_updated)
  // ) {
  //   echo '<em>(Updated on '.$post->date_updated.'</em>';
  // }
  echo '</div>';

  // description
  echo '<p>';
  // remove HTML tags (not headings)
  $blurb = strip_tags($post->post, "<h1><h2><h3><h4><h5><h6><h7>");
  // replace any headings with bold tags
  for ($i=1; $i<7; $i++) {
    $blurb = str_replace('<h'.$i.'>', '<b style="display:block;">', $blurb);
    $blurb = str_replace('</h'.$i.'>', '</b>', $blurb);
  }
  // shorten if too long
  if (strlen($blurb) > 150) {
    $blurb = substr($blurb,0,150);
    echo $blurb.'...';
  } else {
    echo $blurb;
  }
  echo '</p>';

  echo '</div>';  // ./details

  echo '</article>';
}

// Close Grid Section
echo '</div>';  // ./article-grid


// Page Indicator
new PageIndicator(
  $url->page_num,
  $url->total_pages
);


// Closing HTML
echo '</div>';  // ./wrapper
echo '</main>';


require_once (__DIR__ .'/../common/footer.php');

echo <<<PAGE_END
  </body>
</html>
PAGE_END;


?>
