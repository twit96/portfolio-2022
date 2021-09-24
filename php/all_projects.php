<?php
/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


function displayFeatured($mysqli) {
  // Opening HTML
  echo <<<TOP
  <section id="projects">
    <h2>Projects</h2>
  TOP;


  $command = 'SELECT * FROM projects ORDER BY date DESC;';
  $result = $mysqli->query($command);
  if (!$result) { die("Query failed: ($mysqli->error <br>"); }

  while ($row = $result->fetch_assoc()) {

    echo '<article>';
    echo '<figure>';
    if ($row['featured'] > 0) {
      echo '  <div class="featured-badge">';
      echo '    <span>#'.$row['featured'].'</span>';
      echo '  </div>';
    }
    echo '  <img src="/projects/'.$row['directory'].'/title-card.png" alt="'.$row['title'].' Title Card" />';
    echo '  <figcaption>'.$row['blurb'].'</figcaption>';
    echo '</figure>';
    echo '<div>';
    echo '  <h3>'.$row['title'].'</h3>';
    echo '  <em>'.$row['date'].'</em>';
    echo '  <p>'.$row['description'].'</p>';

    if (!is_null($row['primary_link'])) {
      echo '    <a class="btn-text link" href="'.$row['primary_link'].'">';
      echo '      <span class="icon"></span>';
      echo '      '.$row['primary_link_text'];
      echo '    </a>';
    }
    if (!is_null($row['secondary_link'])) {
      echo '    <a class="btn-text link" href="'.$row['secondary_link'].'">';
      echo '      <span class="icon"></span>';
      echo '      '.$row['secondary_link_text'];
      echo '    </a>';
    }
    if (!is_null($row['tertiary_link'])) {
      echo '    <a class="btn-text link" href="'.$row['tertiary_link'].'">';
      echo '      <span class="icon"></span>';
      echo '      '.$row['tertiary_link_text'];
      echo '    </a>';
    }

    echo '  </div>';
    echo '</article>';
  }

  // Closing HTML
  echo '</section>';
}


function doEngine() {
  $server = "localhost";
  $user   = "portfolio_user";
  $pwd    = "portfolio_user_pass";
  $dbName = "Portfolio";

  // Connect to MySQL Server
  $mysqli = new mysqli ($server, $user, $pwd, $dbName);

  if ($mysqli->connect_errno) {
    die('Connect Error: ' . $mysqli->connect_errno . ": " . $mysqli->connect_error);
  }

  // Select Database
  $mysqli->select_db($dbName) or die($mysqli->error);

  // Display Featured
  displayFeatured($mysqli);
}


/**
* Initial function call to execute script.
*/
doEngine();


?>
