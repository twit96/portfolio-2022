<?php
/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


function displayFeatured() {
  // Opening HTML
  echo <<<TOP
      <section id="featured">
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
      var_dump($row);
      // check values of certain fields, decide to perform more queries, or not
      //echo 'Name and surname: '.$row['name'].' '.$row['surname'].'<br>';
      //echo 'Age: '.$row['age'].'<br>'; // Prints info from 'age' column
      // tack it all into the returning result set
    }

  // Closing HTML
  echo <<<BOTTOM
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
