<?php
/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


function displayFeatured($mysqli) {
  // Opening HTML
  echo <<<TOP
  <section id="featured">
    <div class="heading-card">
      <h2>Featured</h2>
    </div>
    <div class="card-container">
  TOP;

  // Select and Display Featured Projects
  $command = 'SELECT directory, title, blurb, date, primary_link, primary_link_text FROM projects WHERE featured>0 ORDER BY featured, date DESC;';
  $result = $mysqli->query($command);
  if (!$result) { die("Query failed: ($mysqli->error <br>"); }

  while ($row = $result->fetch_assoc()) {
    echo '<div class="card">';
    echo '  <img src="/projects/'.$row['directory'].'/title-card.png" alt="'.$row['title'].' Title Card" />';
    echo '  <em>'.$row['blurb'].'</em>';
    echo '  <div class="info">';
    echo '    <div class="btn-text date">';
    echo '      <span class="icon"></span>';
    echo '      <span>'.$row['date'].'</span>';
    echo '    </div>';
    echo '    <a class="btn-text link" href="'.$row['primary_link'].'">';
    echo '      <span class="icon"></span>';
    echo '      '.$row['primary_link_text'];
    echo '    </a>';
    echo '  </div>';
    echo '</div>';
  }

  // Closing HTML
  echo <<<BOTTOM
      <a class="card link" href="/projects/">
        <span>View All <br />Projects</span>
      </a>
    </div>
  </section>

  BOTTOM;
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
