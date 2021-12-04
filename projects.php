<?php


/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


DEFINE("FILENAME", 'projects');
include('./includes/templates/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('./includes/templates/header.php');


// Opening HTML
echo <<<TOP
\n    <main id="projects">
      <div class="wrapper">
        <h1>Projects</h1>
TOP;

include('./includes/models/projects.php');


$projects = getProjects($mysqli, FALSE);
foreach ($projects as $project) {

  // config primary link
  $primary_link_url = null;
  $primary_link_text = null;
  if (!empty($project->primary_link)) {
    $primary_link = $project->primary_link;
    $primary_link_url = $primary_link->url;
    $primary_link_text = $primary_link->text;
  }

  // display project info
  echo '<article>';
  echo '<figure>';
  if ($project->featured > 0) {
    echo '<div class="featured-badge">';
    echo '<span>#'.$project->featured.'</span>';
    echo '</div>';
  }
  // Figure
  if ($primary_link_url != null) {
    echo '<a href="'.$primary_link_url.'">';
    echo '<img src="'.$project->image->path.$project->image->name.'" loading="lazy" alt="'.$project->title.' Title Card" />';
    echo '</a>';
  } else {
    echo '<img src="'.$project->image->path.$project->image->name.'" loading="lazy" alt="'.$project->title.' Title Card" />';
  }
  echo '<figcaption>'.$project->blurb.'</figcaption>';
  echo '</figure>';
  // Details
  echo '<div class="details">';
  // heading
  if ($primary_link_url != null) {
    echo '<h3><a href="'.$primary_link_url.'">'.$project->title.'</a></h3>';
  } else {
    echo '<h3>'.$project->title.'</h3>';
  }
  // date/description
  echo '<em>'.$project->date.'</em>';
  echo '<p>'.$project->description.'</p>';
  // links
  if ($primary_link_url != null) {
    // primary link
    echo '<a class="btn-text link" href="'.$primary_link_url.'">';
    echo '<span class="icon"></span>'.$primary_link_text;
    echo '</a>';
    // other links
    if (is_array($project->other_links) && sizeof($project->other_links) > 0) {
      foreach ($project->other_links as $link) {
        echo '<a class="btn-text link" href="'.$link->url.'">';
        echo '<span class="icon"></span>'.$link->text;
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


include('./includes/templates/footer.php');

echo <<<PAGE_END
  </body>
</html>
PAGE_END;

?>
