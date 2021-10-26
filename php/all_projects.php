<?php
/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


function displayFeatured($mysqli) {
  // Opening HTML
  echo <<<TOP
  \n    <section id="projects">
        <h2>Projects</h2>
  TOP;


  $command = 'SELECT * FROM projects ORDER BY date DESC;';
  $result = $mysqli->query($command);
  if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }

  while ($row = $result->fetch_assoc()) {

    echo "\n".'      <article>';
    echo "\n".'        <figure>';
    if ($row['featured'] > 0) {
      echo "\n".'          <div class="featured-badge">';
      echo "\n".'            <span>#'.$row['featured'].'</span>';
      echo "\n".'          </div>';
    }
    echo "\n".'          <img src="/img/projects/'.$row['directory'].'/'.$row['image'].'" loading="lazy" alt="'.$row['title'].' Title Card" />';
    echo "\n".'          <figcaption>'.$row['blurb'].'</figcaption>';
    echo "\n".'        </figure>';
    echo "\n".'        <div>';
    echo "\n".'          <h3>'.$row['title'].'</h3>';
    echo "\n".'          <em>'.$row['date'].'</em>';
    echo "\n".'          <p>'.$row['description'].'</p>';

    if (!is_null($row['primary_link']) && ($row['primary_link'] != "")) {
      echo "\n".'          <a class="btn-text link" href="'.$row['primary_link'].'">';
      echo "\n".'            <span class="icon"></span>';
      echo "\n".'            '.$row['primary_link_text'];
      echo "\n".'          </a>';
    }
    if (!is_null($row['secondary_link']) && ($row['secondary_link'] != "")) {
      echo "\n".'          <a class="btn-text link" href="'.$row['secondary_link'].'">';
      echo "\n".'            <span class="icon"></span>';
      echo "\n".'            '.$row['secondary_link_text'];
      echo "\n".'          </a>';
    }
    if (!is_null($row['tertiary_link']) && ($row['tertiary_link'] != "")) {
      echo "\n".'          <a class="btn-text link" href="'.$row['tertiary_link'].'">';
      echo "\n".'            <span class="icon"></span>';
      echo "\n".'            '.$row['tertiary_link_text'];
      echo "\n".'          </a>';
    }

    echo "\n".'        </div>';
    echo "\n".'      </article>';
  }

  // Closing HTML
  echo "\n".'    </section>'."\n\n";
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
