<?php
/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");

// Opening HTML
echo <<<TOP
\n    <main id="projects">
      <div class="wrapper">
        <h1>Projects</h1>
TOP;

include (__DIR__ .'/../controllers/projects_includes.php');


$projects = getProjects($mysqli);
foreach ($projects as $project) {

  // config primary link
  $primary_link_url = null;
  $primary_link_text = null;
  if (!sizeof($post->primary_link) != 0) {
    $primary_link_url = reset($post->primary_link);
    $primary_link_text = key($post->primary_link);
  }

  echo '<article>';
  echo '<figure>';
  if ($post->featured > 0) {
    echo '<div class="featured-badge">';
    echo '<span>#'.$post->featured.'</span>';
    echo '</div>';
  }

  // figure
  if ($primary_link_url != null) {
    echo '<a href="'.$primary_link_url.'">';
    echo '<img src="/img/projects/'.$post->directory.'/'.$post->image.'" loading="lazy" alt="'.$post->title.' Title Card" />';
    echo '</a>';
  } else {
    echo '<img src="/img/projects/'.$post->directory.'/'.$post->image.'" loading="lazy" alt="'.$post->title.' Title Card" />';
  }
  echo '<figcaption>'.$post->blurb.'</figcaption>';
  echo '</figure>';

  // details
  echo '<div class="details">';
  // heading
  if ($primary_link_url != null) {
    echo '<h3><a href="'.$primary_link_url.'">'.$post->title.'</a></h3>';
  } else {
    echo '<h3>'.$post->title.'</h3>';
  }
  // date/description
  echo '<em>'.$post->date.'</em>';
  echo '<p>'.$post->description.'</p>';
  // links
  if ($primary_link_url != null) {
    // primary link
    echo '<a class="btn-text link" href="'.$primary_link_url.'">';
    echo '<span class="icon"></span>'.$primary_link_text;
    echo '</a>';
    // other links
    if (sizeof($post->other_links) > 0) {
      foreach ($post->other_links as $link_text => $link_url) {
        echo '<a class="btn-text link" href="'.$link_url.'">';
        echo '<span class="icon"></span>'.$link_text;
        echo '</a>';
      }
    }
  }

  echo '</div>';
  echo '</article>';

}


// Closing HTML
echo "\n".'      </div>';
echo "\n".'    </main>'."\n\n";


?>
