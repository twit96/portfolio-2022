<?php

/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


function doLogin() {
  $script = $_SERVER['PHP_SELF'];
  echo <<<TOP
  <h2>Login</h2>
  <form id="login" method="POST" action="index.php">
    <p>
      Username:
      <input name="username" type="text" placeholder="Username" required />
    </p>
    <p>
      Password:
      <input name="password" type="password" placeholder="Password" required />
    </p>
    <p>
      <input name="login" type="submit" value="Submit" />
      <input type="reset" value="Reset" />
    </p>
  </form>
TOP;
}


/**
* Function to unset username and password POST variables.
* No return value.
*/
function doUnsetPost() {
  unset($_POST['username']);
  unset($_POST['password']);
}


/**
* Function to check if a username
* is in the admin database.
* Returns 1 if username exists and 0 otherwise.
*/
function checkUser($mysqli, $username) {
  $command = 'SELECT COUNT(1) FROM admin WHERE username = "' . $username . '";';
  $result = $mysqli->query($command);
  if (!$result) { die("Query failed: ($mysqli->error <br>"); }
  // $user_in_db will be 1 if in database and 0 if not in database
  $user_in_db = $result->fetch_row()[0];
  return $user_in_db;
}


/**
* Function to check if a username/password entry
* is in the iq_passwords database.
* Returns 1 if username/password entry exists and 0 otherwise.
*/
function checkPass($mysqli, $username, $password) {
  $command = 'SELECT COUNT(1) FROM admin WHERE username = "' . $username . '" AND password = "' . $password . '";';
  $result = $mysqli->query($command);
  if (!$result) { die("Query failed: ($mysqli->error <br>"); }
  // $pass_in_db will be 1 if in database and 0 if not in database
  $pass_in_db = $result->fetch_row()[0];
  return $pass_in_db;
}


/**
* Function to handle the login functionality
* based off of the given username and password.
* No return value.
*/
function checkLogin($mysqli, $username, $password) {

  if (!$username == '' && !$password == '') {
    // username and password have values
    if (
      (checkUser($mysqli, $username) == 1) &&
      (checkPass($mysqli, $username, $password) == 1)
    ) {
      // username and password in database
      buildDashboard($mysqli);
    } else {
      // username or pass not in database
      echo '<script>alert("Login Failed. Please Try Again.");</script>';
      doLogin();
    }
  } else {
    // username or password is empty
    echo '<script>alert("Username and password cannot be empty!");</script>';
    doLogin();
  }
}


function buildDashboard($mysqli) {
  // Opening HTML
  echo <<<TOP
  <h2>Database Entries</h2>
  <table>
    <col style="width:8%">
    <col style="width:7%">
    <col style="width:13%">
    <col style="width:7%">
    <col style="width:7%">
    <col style="width:6%">
    <col style="width:7%">
    <col style="width:6%">
    <col style="width:7%">
    <col style="width:6%">
    <col style="width:7%">
    <col style="width:6%">
    <col style="width:6%">
    <col style="width:7%">
    <thead>
      <tr>
  TOP;

  // Table Header Row
  $command = 'SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "projects" ORDER BY ORDINAL_POSITION;';
  $result = $mysqli->query($command);
  if (!$result) { die("Query failed: ($mysqli->error <br>"); }

  while ($row = $result->fetch_assoc()) {
    $str = ucwords(str_replace("_", " ", $row['COLUMN_NAME']));
    if ($str != "ID") { echo '<th>'.$str.'</th>'; }
  }
  echo '<th>Controls</th>';
  echo '</tr></thead>';

  // Table Body Data
  $project_directories = displayData($mysqli);

  // Closing HTML
  echo <<<BOTTOM
    </table>
    <form method="POST" action="index.php">
      <input name="logout" type="submit" value="Logout" />
    </form>
  </section>
  BOTTOM;

  // Forms for each row of inputs to reference
  foreach ($project_directories as &$curr_dir) {
    echo '<form class="hidden" id="'.$curr_dir.'" method="POST" action="index.php"></form>';
  }
  unset($curr_dir);
}


function displayData($mysqli) {

  $command = 'SELECT * FROM projects ORDER BY date DESC;';
  $result = $mysqli->query($command);
  if (!$result) { die("Query failed: ($mysqli->error <br>"); }

  $project_directories = array();

  echo '<tbody>';
  while ($row = $result->fetch_assoc()) {

    array_push($project_directories, $row['directory']);

    echo '<tr>';
    echo '<td>';
    echo '<input form="'.$row['directory'].'" name="id" type="hidden" value="'.$row['ID'].'" />';
    echo '<input form="'.$row['directory'].'" name="title" type="text" value="'.$row['title'].'" required />';
    echo '</td>';
    echo '<td><input form="'.$row['directory'].'" name="directory" type="text" value="'.$row['directory'].'" required /></td>';
    echo '<td><input form="'.$row['directory'].'" name="image" type="file" /></td>';
    echo '<td><input form="'.$row['directory'].'" name="blurb" type="text" value="'.$row['blurb'].'" /></td>';
    echo '<td><input form="'.$row['directory'].'" name="description" type="text" value="'.$row['description'].'" /></td>';
    echo '<td><input form="'.$row['directory'].'" name="date" type="text" value="'.$row['date'].'" required /></td>';
    echo '<td><input form="'.$row['directory'].'" name="primary_link" type="text" value="'.$row['primary_link'].'" /></td>';
    echo '<td><input form="'.$row['directory'].'" name="primary_link_text" type="text" value="'.$row['primary_link_text'].'" /></td>';
    echo '<td><input form="'.$row['directory'].'" name="secondary_link" type="text" value="'.$row['secondary_link'].'" /></td>';
    echo '<td><input form="'.$row['directory'].'" name="secondary_link_text" type="text" value="'.$row['secondary_link_text'].'" /></td>';
    echo '<td><input form="'.$row['directory'].'" name="tertiary_link" type="text" value="'.$row['tertiary_link'].'" /></td>';
    echo '<td><input form="'.$row['directory'].'" name="tertiary_link_text" type="text" value="'.$row['tertiary_link_text'].'" /></td>';
    echo '<td><input form="'.$row['directory'].'" name="featured" type="text" value="'.$row['featured'].'" required /></td>';
    echo '<td><input form="'.$row['directory'].'" name="update" type="submit" value="Update" /></td>';
    echo '</tr>';

  }
  echo <<<EMPTYROW
  <tr>
    <td><input form="add-new-project" name="title" type="text" placeholder="New Title" required /></td>
    <td><input form="add-new-project" name="directory" type="text" placeholder="new-directory" required /></td>
    <td><input form="add-new-project" name="image" type="file" /></td>
    <td><input form="add-new-project" name="blurb" type="text" placeholder="A Short Blurb" /></td>
    <td><input form="add-new-project" name="description" type="text" placeholder="Project Description" /></td>
    <td><input form="add-new-project" name="date" type="text" placeholder="0000-00-00" required /></td>
    <td><input form="add-new-project" name="primary_link" type="text" placeholder="project-link1.com" /></td>
    <td><input form="add-new-project" name="primary_link_text" type="text" placeholder="Link1 Button Text" /></td>
    <td><input form="add-new-project" name="secondary_link" type="text" placeholder="project-link2.com" /></td>
    <td><input form="add-new-project" name="secondary_link_text" type="text" placeholder="Link2 Button Text" /></td>
    <td><input form="add-new-project" name="tertiary_link" type="text" placeholder="project-link3.com" /></td>
    <td><input form="add-new-project" name="tertiary_link_text" type="text" placeholder="Link3 Button Text" /></td>
    <td><input form="add-new-project" name="featured" type="number" value="0" required /></td>
    <td><input form="add-new-project" name="update" type="submit" value="Add" /></td>
  </tr>
  EMPTYROW;
  echo '</tbody>';

  return $project_directories;
}



function updateDB($mysqli) {
  unset($_POST["update"]);
  $project = $_POST["id"];

  // update db
  $command = 'SELECT * FROM projects WHERE ID='.$project.';';
  $result = $mysqli->query($command);
  if (!$result) { die("Query failed: ($mysqli->error <br>"); }

  while ($row = $result->fetch_assoc()) {
    echo 'ROW<br />';
    var_dump($row);
    echo '<br /><br />';
    echo 'POST<br />';
    var_dump($_POST);
    echo '<br /><br />';

    foreach ($_POST as $key => $value) {
      // special keys
      if (($key == "id")|| ($key == "directory") || ($key == "image")) {
        // echo 'Special Key: '.$key.'<br />';
      // normal keys
    } else if ($row[$key] != $_POST[$key]) {
        $command1 = 'UPDATE projects SET '.$key.'="'.$_POST[$key].'" WHERE ID='.$project.';';
        $result1 = $mysqli->query($command1);
        if (!$result1) { die("Query failed: ($mysqli->error <br>"); }
      }
      // unset keys
      unset($_POST[$key]);
    }
  }

  echo 'POST<br />';
  var_dump($_POST);
  echo '<br /><br />';

  // Display Data
  buildDashboard($mysqli);
}


/**
* Engine function to configure required inputs for the above functions.
* Checks database connection and pulls and handles username and password inputs.
*/
function doEngine() {

  // if user logged out
  if (isset($_POST["logout"])) {
    unset($_POST["login"]);
    unset($_POST["logout"]);
    doLogin();

  // if user updated table
  } else if (isset($_POST["update"])) {
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

    // Update Database
    updateDB($mysqli);


  // if user logged in
  } else if (isset($_POST["login"])) {
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

    // Retrieve data from POST
    $username = $_POST['username'];
    $password = $_POST['password'];
    doUnsetPost();
    // Escape User Input to help prevent SQL Injection
    $username = $mysqli->real_escape_string($username);
    $password = $mysqli->real_escape_string($password);
    // Check Login
    checkLogin($mysqli, $username, $password);


  // user has not logged in yet
  } else {
    doLogin();
  }
}


/**
* Initial function call to execute script.
*/
doEngine();


?>