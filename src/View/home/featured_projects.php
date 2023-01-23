<?php


// Opening HTML
echo <<<TOP
<section id="featured">
      <div class="flex">
        <h2 class="card-heading"><span>Featured</span></h2>
        <div class="article-carousel">
TOP;

require_once (__DIR__ .'/../../Controller/projects.php');


$featured_projects = getProjects($db, TRUE);
$db->close();

foreach ($featured_projects as $project) {

  // config primary link
  $primary_link_url = null;
  $primary_link_text = null;
  if (!empty($project->primary_link)) {
    $primary_link = $project->primary_link;
    $primary_link_url = $primary_link->url;
    $primary_link_text = $primary_link->text;
  }

  echo '<article class="article-card">';

  // Info
  echo '<div class="info">';
  // featured badge
  echo '<div class="featured-badge">';
  echo '<span>#'.$project->featured.'</span>';
  echo '</div>';
  // image
  if ($primary_link_url != null) {
    echo '<a class="img-link" href="'.$primary_link_url.'">';
    echo '<img src="'.$project->image->path.$project->image->name.'" loading="lazy" alt="'.$project->title.' Title Card" />';
    echo '</a>';
  } else {
    echo '<img src="'.$project->image->path.$project->image->name.'" loading="lazy" alt="'.$project->title.' Title Card" />';
  }
  echo '<em>'.$project->blurb.'</em>';
  echo '</div>';  // ./info

  // Details
  echo '<div class="details">';
  // title
  echo '<div class="title">';
  if ($primary_link_url != null) {
    echo '<h3><a href="'.$primary_link_url.'">'.$project->title.'</a></h3>';
  } else {
    echo '<h3>'.$project->title.'</h3>';
  }
  echo '<em>'.$project->date.'</em>';
  echo '</div>';  // ./title
  echo '</div>';  // ./details

  echo '</article>';
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
    </section>\n
BOTTOM;


?>
