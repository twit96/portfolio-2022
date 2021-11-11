<?php

/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


// Opening HTML
echo <<<TOP
<article id="featured">
      <div class="flex">
        <div class="heading-card">
          <h2>Featured</h2>
        </div>
        <div class="card-container">
TOP;

include (__DIR__ .'/../models/projects_includes.php');


$featured_projects = getProjects($mysqli, TRUE);
foreach ($featured_projects as $project) {

  // config primary link
  $primary_link_url = null;
  $primary_link_text = null;
  if (is_array($project->primary_link) && sizeof($project->primary_link) != 0) {
    $primary_link_url = reset($project->primary_link);
    $primary_link_text = key($project->primary_link);
  }

  echo '<div class="card">';
  echo '<div class="featured-badge">';
  echo '<span>#'.$project->featured.'</span>';
  echo '</div>';
  echo '<img src="/img/projects/'.$project->directory.'/'.$project->image.'" loading="lazy" alt="'.$project->title.' Title Card" />';
  echo '<em>'.$project->blurb.'</em>';
  echo '<div class="info">';
  echo '<div class="btn-text date">';
  echo '<span class="icon"></span>';
  echo '<span>'.$project->date.'</span>';
  echo '</div>';
  if ($primary_link_url != null) {
    echo '<a class="btn-text link" href="'.$primary_link_url.'">';
    echo '<span class="icon"></span>'.$primary_link_text;
    echo '</a>';
  }
  echo '</div>';  // ./info
  echo '</div>';  // ./card

}


// Closing HTML
echo <<<BOTTOM
\n          <a class="card link" href="/projects">
            <span>View All <br />Projects</span>
          </a>
        </div>  <!-- ./card-container -->
      </div>  <!-- ./flex -->
      <p>
        To view all of my work, please visit my
        <a href="/projects">projects page</a>.
      </p>
    </article>\n
BOTTOM;


?>
