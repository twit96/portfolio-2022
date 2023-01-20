<?php


require_once (__DIR__ .'/../../Controller/projects.php');
$url = configProjectsURL($db);


$projects = getProjects($db, FALSE, $url->page_num);
$db->close();

foreach ($projects as $project) {

  // config primary link
  $primary_link_url = null;
  $primary_link_text = null;
  if (!empty($project->primary_link)) {
    $primary_link = $project->primary_link;
    $primary_link_url = $primary_link->url;
    $primary_link_text = $primary_link->text;
  }

  // Project Info
  echo '<article class="article-card">';
  echo '<div class="info">';
  // featured badge
  if ($project->featured > 0) {
    echo '<div class="featured-badge">';
    echo '<span>#'.$project->featured.'</span>';
    echo '</div>';
  }
  // image
  if ($primary_link_url != null) {
    echo '<a class="img-link" href="'.$primary_link_url.'">';
    echo '<img src="'.$project->image->path.$project->image->name.'" loading="lazy" alt="'.$project->title.' Title Card" />';
    echo '</a>';
  } else {
    echo '<img src="'.$project->image->path.$project->image->name.'" loading="lazy" alt="'.$project->title.' Title Card" />';
  }
  echo '<em>'.$project->blurb.'</em>';
  echo '</div>';

  // Project Details
  echo '<div class="details">';
  echo '<div class="title">';
  // heading
  if ($primary_link_url != null) {
    echo '<h2><a href="'.$primary_link_url.'">'.$project->title.'</a></h2>';
  } else {
    echo '<h2>'.$project->title.'</h2>';
  }
  // date
  echo '<em>'.$project->date.'</em>';
  echo '</div>';
  // description
  echo '<p>'.$project->description.'</p>';
  // links
  if ($primary_link_url != null) {
    echo '<div class="links">';
    // primary link
    echo '<a class="btn-text link" href="'.$primary_link_url.'">';
    echo '<span class="icon"></span>'.$primary_link_text;
    echo '</a>';
    // other links
    if (is_array($project->other_links) && count($project->other_links) > 0) {
      foreach ($project->other_links as $link) {
        echo '<a class="btn-text link" href="'.$link->url.'">';
        echo '<span class="icon"></span>'.$link->text;
        echo '</a>';
      }
    }
    echo '</div>';
  }
  echo '</div>';
  echo '</article>';
}


?>
