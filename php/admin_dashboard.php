<?php
/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


function displayEntries($mysqli) {
  // Opening HTML
  echo <<<TOP
  <section id="Entries">
    <h2>Database Entries</h2>
    <table>
    <thead>
      <tr>
  TOP;

  $command = 'SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "projects" ORDER BY ORDINAL_POSITION;';
  $result = $mysqli->query($command);
  if (!$result) { die("Query failed: ($mysqli->error <br>"); }

  // display column names
  while ($row = $result->fetch_assoc()) {
    echo '<th>'.$row['COLUMN_NAME'].'</th>';
  }
  echo '</tr></thead>';

  // display all data
  displayData($mysqli);

  // Closing HTML
  echo <<<BOTTOM
    </table>
  </section>
  BOTTOM;
}


function displayData($mysqli) {

  $command = 'SELECT * FROM projects ORDER BY date DESC;';
  $result = $mysqli->query($command);
  if (!$result) { die("Query failed: ($mysqli->error <br>"); }

  echo '<tbody>';
  while ($row = $result->fetch_assoc()) {
    echo '<tr>';
    echo '<td>'.$row['title'].'</td>';
    echo '<td>'.$row['directory'].'</td>';
    echo '<td>'.$row['blurb'].'</td>';
    echo '<td>'.$row['description'].'</td>';
    echo '<td>'.$row['date'].'</td>';
    echo '<td>'.$row['primary_link'].'</td>';
    echo '<td>'.$row['primary_link_text'].'</td>';
    echo '<td>'.$row['secondary_link'].'</td>';
    echo '<td>'.$row['secondary_link_text'].'</td>';
    echo '<td>'.$row['tertiary_link'].'</td>';
    echo '<td>'.$row['tertiary_link_text'].'</td>';
    echo '<td>'.$row['featured'].'</td>';
    echo '</tr>';
  }
  echo '</tbody>';
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
  displayEntries($mysqli);
}


/**
* Initial function call to execute script.
*/
doEngine();




?>
