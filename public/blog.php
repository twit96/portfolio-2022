<?php

/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


include ('../src/Controller/blog.php');


if (isset($_GET["id"])) {
  displayOnePost($mysqli);
} else if (isset($_GET["tag"])) {
  displayTaggedPosts($mysqli);
} else {
  displayAllPosts($mysqli);
}


function displayOnePost($mysqli) {
  $id = htmlspecialchars($_GET["id"]);
  $post = getBlogPosts($mysqli, $id, null, null);
  if (count($post) > 0) {
    $post = $post[0];
  } else {
    // no blog post of the given name - redirect to blog page
    header('Location: /blog');
    die();
  }

  DEFINE("FILENAME", 'blog');
  DEFINE("BLOGPOSTNAME", $post->title);
  include('../src/View/common/head.php');
  echo <<<HEAD_END
  \n  </head>
    <body>
  HEAD_END;

  include('../src/View/common/header.php');

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
  include ('../src/View/blog/toc.html');
  echo '</div>';

  // Closing HTML
  echo <<<BTM
  \n    </div>  <!-- ./wrapper -->
      </main>
  BTM;

  include('../src/View/common/footer.php');

  echo <<<PAGE_END
    </body>
  </html>
  PAGE_END;
}


function displayTaggedPosts($mysqli) {
  DEFINE("FILENAME", 'blog');
  include('../src/View/common/head.php');
  echo <<<HEAD_END
  \n  </head>
    <body>
  HEAD_END;

  include('../src/View/common/header.php');

  // Opening HTML
  $url_tag = str_replace("-", " ", htmlspecialchars($_GET["tag"]));
  echo <<<TOP
  \n    <main id="blog">
        <div class="wrapper">
          <h1><a href="/blog">Blog</a> / <span>{$url_tag}</span></h1>
        </div>
        <div class="wrapper grid">
  TOP;

  $blog_posts = getBlogPosts($mysqli, null, $url_tag, null);
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
  // $total_posts = getNumBlogPosts($mysqli);
  // $total_pages = ceil($total_posts/12);
  // $total_pages = $total_posts;
  // echo '<script>alert("$total_pages: '.$total_pages.'");</script>';
  // include ('./src/templates/PageIndicator.php');


  // Closing HTML
  echo '</main>';

  include('../src/View/common/footer.php');

  echo <<<PAGE_END
    </body>
  </html>
  PAGE_END;

}


function displayAllPosts($mysqli) {

  DEFINE("FILENAME", 'blog');
  include('../src/View/common/head.php');
  echo <<<HEAD_END
  \n  </head>
    <body>
  HEAD_END;

  include('../src/View/common/header.php');

  // Opening HTML
  echo <<<TOP
  \n    <main id="blog">
        <div class="wrapper">
          <h1>Blog</h1>
        </div>
        <div class="wrapper grid">
  TOP;

  $blog_posts = getBlogPosts($mysqli, null, null, null);
  foreach ($blog_posts as $post) {
    $this_link = './blog/post/'.$post->id.'/'.str_replace(" ", "-", strtolower($post->title)).'/';

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
        echo '<li><a href="./blog/tag/'.str_replace(" ", "-", $tag->name).'/">'.$tag->name.'</a></li>';
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
    echo'</p>';
    echo '</div>';
    echo '</article>';
  }
  // Close BlogPost Grid Section
  echo '</div>  <!-- ./wrapper grid -->';


  // Page Indicator Section
  // $total_posts = getNumBlogPosts($mysqli);
  // $total_pages = ceil($total_posts/12);
  // $total_pages = $total_posts;
  // echo '<script>alert("$total_pages: '.$total_pages.'");</script>';
  // include ('./src/templates/PageIndicator.php');


  // Closing HTML
  echo '</main>';

  include('../src/View/common/footer.php');

  echo <<<PAGE_END
    </body>
  </html>
  PAGE_END;
}


?>