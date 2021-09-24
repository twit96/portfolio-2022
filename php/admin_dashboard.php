<?php

/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


function doLogin() {
  $script = $_SERVER['PHP_SELF'];
  echo <<<TOP
	<form method="POST" action="index.php">
    <h2>Login</h2>
   	<table>
      <tr>
     		<td>Username:</td>
     		<td><input name="username" type="text" size="30" placeholder="username" required /></td>
    	</tr>
    	<tr>
        	<td>Password:</td>
        	<td><input name="password" type="password" size="30" required /></td>
    	</tr>
   	</table>
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
      session_start();
      buildDashboard();
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


function buildDashboard() {
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

  // Opening HTML
  echo <<<TOP
  <h2>Database Entries</h2>
  <table>
  <thead>
    <tr>
  TOP;

  // Table Header Row
  $command = 'SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = "projects" ORDER BY ORDINAL_POSITION;';
  $result = $mysqli->query($command);
  if (!$result) { die("Query failed: ($mysqli->error <br>"); }

  while ($row = $result->fetch_assoc()) {
    $str = ucwords(str_replace("_", " ", $row['COLUMN_NAME']));
    echo '<th>'.$str.'</th>';
  }
  echo '<th>Update?</th>';
  echo '</tr></thead>';

  // Table Body Data
  displayData($mysqli);

  // Closing HTML
  echo <<<BOTTOM
    </table>
    <form method="POST" action="index.php">
      <input name="logout" type="submit" value="Logout" />
    </form>
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
    echo '<td></td>';
    echo '</tr>';
  }
  echo <<<EMPTYROW
  <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
  </tr>
  EMPTYROW;
  echo '</tbody>';
}


/**
* Engine function to configure required inputs for the above functions.
* Checks database connection and pulls and handles username and password inputs.
*/
function doEngine() {

  // if user logged out
  if (isset($_POST["logout"])) {
    echo '<script>alert("Logged Out.");</script>';
    unset($_POST["login"]);
    unset($_POST["logout"]);
    doLogin();

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
