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
    <div class="heading-card">
      <h2>Featured</h2>
    </div>
    <div class="card-container">
  TOP;


  // update iq_journeys database
  $command = 'SELECT * FROM projects WHERE featured=1;';
  $result = $mysqli->query($command);
  if (!$result) { die("Query failed: ($mysqli->error <br>"); }

  while ($row = $result->fetch_assoc()) {
    // var_dump($row);
    // echo 'Title: '.$row['title'].'<br>';
    // echo 'Directory: '.$row['directory'].'<br>';
    // echo 'Blurb: '.$row['blurb'].'<br>';
    // echo 'Description: '.$row['description'].'<br>';
    // echo 'Date: '.$row['date'].'<br>';
    // echo 'Featured: '.$row['featured'].'<br>';
    // echo 'Primary Link: '.$row['primary_link'].'<br>';
    // echo 'Primary Link Text: '.$row['primary_link_text'].'<br>';
    // echo 'Secondary Link: '.$row['secondary_link'].'<br>';
    // echo 'Secondary Link Text: '.$row['secondary_link_text'].'<br>';
    // echo 'Tertiary Link: '.$row['tertiary_link'].'<br>';
    // echo 'Tertiary Link Text: '.$row['tertiary_link_text'].'<br>';

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
