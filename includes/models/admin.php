<?php

/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


/**
* Admin Page Login Area
*/
function doLogin() {
  echo <<<LOGIN
  <section id="login">
    <h2>Login</h2>
    <div class="flex">
      <form method="POST" action="admin.php">
        <label>
          <input name="username" type="text" required />
          <span>Username</span>
        </label>
        <label>
          <input name="password" type="password" required />
          <span>Password</span>
        </label>
        <p>
          <input name="login" type="submit" value="Submit" />
          <input type="reset" value="Reset" />
        </p>
      </form>
      <p>
        The place where super duper top secret things definitely do not occur...
      </p>
    </div>
  </section>
LOGIN;
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
  if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }
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
  if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }
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

  echo <<<LEFTTOP
  <div class="flex">
    <div class="left">
      <section id="edit-projects" class="card">
        <h2>Edit Projects</h2>
  LEFTTOP;

  $command = 'SELECT * FROM projects ORDER BY date DESC;';
  $result = $mysqli->query($command);
  if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }

  $project_directories = array();

  $max_id = 0;  // to set add-new-column form's input ID

  while ($row = $result->fetch_assoc()) {
    if ($row['ID'] > $max_id) { $max_id = $row['ID']; }   // update max_id

    array_push($project_directories, $row['directory']);

    echo '<h3 class="accordion" onclick="this.classList.toggle(\'active\')">('.$row['date'].') '.$row['title'].'</h3>';
    echo '<form method="POST" action="admin.php" class="panel">';
    echo '<input name="id" type="hidden" value="'.$row['ID'].'" />';
    echo '<div class="label-group">';
    echo '<label><input type="text" name="title" value="'.$row['title'].'" /><span>Title</span></label>';
    echo '<label><input type="date" name="date" value="'.$row['date'].'" /><span>Date</span></label>';
    echo '</div>';
    echo '<div class="label-group">';
    echo '<label><input type="text" name="directory" value="'.$row['directory'].'" /><span>Directory</span></label>';
    echo '<label><input type="file" name="image" accept="image/png, image/jpg, image/jpeg" /><span>Image</span></label>';
    echo '</div>';
    echo '<label><input type="text" name="blurb" value="'.$row['blurb'].'" /><span>Blurb</span></label>';
    echo '<label><input type="text" name="description" value="'.$row['description'].'" /><span>Description</span></label>';
    echo '<div class="label-group">';
    echo '<label><input type="number" name="featured" min="0" value="'.$row['featured'].'" /><span>Featured</span></label>';
    echo '<div class="submit-toggle"><input type="checkbox" name="toggle" /><input type="submit" name="update" value="Update" /></div>';
    echo '</div>';
    echo '</form>';
  }

  $max_id++;  // add 1 to max_id so it is greater than all other ID's

  echo <<<EMPTYROW
    <h3 class="accordion" onclick="this.classList.toggle('active');">Add New Project</h3>
    <form method="POST" action="admin.php" class="panel">
      <input name="id" type="hidden" value="{$max_id}" />
      <div class="label-group">
        <label><input type="text" name="title" placeholder="New Title" required /><span>Title</span></label>
        <label><input type="date" name="date" required /><span>Date</span></label>
      </div>
      <div class="label-group">
        <label><input type="text" name="directory" placeholder="new-directory" required /><span>Directory</span></label>
        <label><input type="file" name="image" accept="image/png, image/jpg, image/jpeg" required /><span>Image</span></label>
      </div>
      <label><input type="text" name="blurb" placeholder="New Blurb" required /><span>Blurb</span></label>
      <label><input type="text" name="description" placeholder="New Description" required /><span>Description</span></label>
      <div class="label-group">
        <label><input type="number" name="featured" min="0" value="0" required /><span>Featured</span></label>
        <div class="submit-toggle"><input type="submit" name="update" value="Add" /></div>
      </div>
    </form>
    <script src="/js/admin.js"></script>
  EMPTYROW;
  echo '</div>';  // ./left

  echo <<<RIGHTTOP
    <div class="right">
      <div id="user-profile" class="card">
        <!-- <div class="btn-container">
          <button class="btn-text edit">
            <span class="icon"></span>
            <span>Edit</span>
          </button>
        </div> -->
        <div class="flex">
          <div class="left">
            <div class="profile-box">
              <img class="profile" src="/img/profile.jpg" alt="Profile Image" />
            </div>
            <span class="role">Admin</span>
          </div>  <!-- ./left -->
          <ul class="right">
            <li><b>Tyler Wittig</b></li>
            <li>
              <a class="btn-text internet" href="#">
                <span class="icon"></span>
                <span>tylerwittig.com</span>
              </a>
            </li>
            <li>
              <a class="btn-text mail" href="#">
                <span class="icon"></span>
                <span>tylerwittig@utexas.edu</span>
              </a>
            </li>
          </ul>  <!-- ./right -->
        </div>  <!-- ./flex -->
      </div>  <!-- #/user-profile -->
  RIGHTTOP;
  echo '</div>';  // ./right
  echo '</div>';  // ./flex
}


/**
* Function to check if a file has the same name as an existing filename.
* Appends a number to the beginning of the filename if it does, and increments
* the number up by 1 if it already has a number.
* Returns formatted file name and leaves existing file name alone.
*/
function formatDuplicateFilenames($file_name, $existing_file_name) {
  if ($file_name == $existing_file_name) {
    // split string by hyphens
    $splitted_string = explode("-", $file_name);
    // update num
    $num = $splitted_string[0];
    (is_numeric($num)) ? $num++ : $num = 0;
    // combine string part of filename
    if ($num != 0) { $str = implode("-", array_slice($splitted_string, 1)); }
    else { $str = implode("-", $splitted_string); }
    // combine num and string parts with hyphen
    $file_name = $num.'-'.$str;
  }
  return $file_name;
}


/**
* Function to check if uploaded image is valid. Returns false if image is not
* valid and returns formatted image name if image is valid.
*/
function checkImage($img, $directory) {

  $new_img_name = false;

  // Ensure image is set in $_POST
  if (isset($_FILES["image"]) && ($_FILES["image"]["size"] != 0)) {

    // update new image file name if same as old name
    $new_img_name = basename($_FILES["image"]["name"]);
    $new_img_name = formatDuplicateFilenames($new_img_name, $img);

    // begin check
    $target_file = './img/projects/'.$directory.'/'.$new_img_name;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) { $new_img_name = false; }

    // check if file already exists
    // (should never trigger since we format the image name above)
    // if (file_exists($target_file)) $new_file_name = 0;

    // check file size (<500kB)
    if ($_FILES["image"]["size"] > 500000) { $new_img_name = false; }

    // only allow certain file formats
    if (
      ($imageFileType != "jpg") &&
      ($imageFileType != "png") &&
      ($imageFileType != "jpeg") &&
      ($imageFileType != "gif") &&
      ($imageFileType != "webp")
    ) {
      $new_img_name = false;
    }

  }
  return $new_img_name;
}


/**
* Function to upload an image (which was previously checked to be valid).
* Returns true if successful upload and false otherwise.
*/
function uploadImage($row, $directory, $new_img_name) {
  $upload_success = false;

  // Upload New Image
  $target_file = './img/projects/'.$directory.'/'.$new_img_name;
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $upload_success = true;
  }
  // Delete Old Image (if it exists - not adding a project)
  if (($upload_success == true) && (!is_null($row["image"]))) {
    unlink('./img/projects/'.$directory.'/'.$row["image"]);
  }

  return $upload_success;
}


/**
* Function to check if posted directory name already exists in projects
* directory. Returns true if so and false if not.
*/
function directoryExists($dir) {
  return is_dir('./img/projects/'.$dir);
}


/**
* Function to update a project directory name. Copies the contents of the
* existing directory into the new directory, deletes the contents of the old
* directory, and then deletes the old directory.
* (NON-RECURSIVE - SINGLE LAYER DIRECTORIES ONLY)
* Returns true if success and false if failure.
*/
function updateDirectory($row, $dir) {
  $old_path = './img/projects/'.$row["directory"].'/';
  $new_path = './img/projects/'.$dir.'/';

  // Transfer Files to New Directory
  copy($old_path.'*.*', $new_path);

  // Delete Old Directory
  unlink($old_path.$row["image"]);
  rmdir($old_path);

  // Return if Success
  return (is_dir($new_path) && (!is_dir($old_path)));
}


/**
* Function to insert a new project into the Portfolio database's projects table
* after addProject() function has checked the POST values. No return value.
*/
function insertDB($mysqli, $row, $new_img_name) {

  // format values to be updated in database
  $col_vals = array();
  foreach ($_POST as $key => $value) {
    $val = $mysqli->real_escape_string($value);
    array_push($col_vals, $val);
    if ($key == 'directory') array_push($col_vals, $new_img_name);
    // unset post for each key
    unset($_POST[$key]);
  }
  $col_vals_length = count($col_vals);

  // build sql command
  $command = "INSERT INTO projects VALUES ";
  $command .= "(".$col_vals[0].", ";
  for ($i=1; $i<=$col_vals_length-2; $i++) {
    $command .= "'".$col_vals[$i]."', ";
  }
  $command .= $col_vals[$col_vals_length-1].");";

  // execute command
  $result = $mysqli->query($command);
  if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }
}


/**
* Function to update an existing project in the Portfolio database's projects
* table after the updateProject() function has checked the POST values.
* No return value.
*/
function updateDB($mysqli, $row, $new_img_name) {

  $project_id = $_POST["id"];
  unset($_POST["id"]);

  // update image value
  if (!is_null($new_img_name)) {
    $command = 'UPDATE projects SET image="'.$new_img_name.'" WHERE id='.$project_id.';';
    $result = $mysqli->query($command);
    if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }
  }

  // update POST values
  foreach ($_POST as $key => $value) {
    $val = $mysqli->real_escape_string($value);
    if (($val != $row[$key])) {
      $command = 'UPDATE projects SET '.$key.'="'.$val.'" WHERE id='.$project_id.';';
      $result = $mysqli->query($command);
      if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }
    }
    // unset post for each key
    unset($_POST[$key]);
  }
}


/**
* Function to add new project. Failure gives alert to user.
* Returns false if failed and true if succeeded.
*/
function addProject($mysqli, $row) {

  // check for valid image (null parameter since no existing img to compare to)
  $new_img_name = checkImage(null, $_POST["directory"]);
  if (is_null($new_img_name)) {
    echo '<script>alert("Image did not pass checks - project not added.");</script>';
    return false;
  }

  // check directory doesn't already exist
  if (directoryExists($_POST["directory"])) {
    echo '<script>alert("Directory ('.$row["directory"].') already exists - project not added");</script>';
    return false;
  }

  // create new directory
  $new_path = './img/projects/'.$_POST["directory"];
  mkdir($new_path, 0777, true);

  // try to upload image
  $uploaded_img = uploadImage($row, $_POST["directory"], $new_img_name);
  if ($uploaded_img == false) {
    // upload failed
    rmdir($new_path);  // delete new directory
    echo '<script>alert("Image upload failed - project not added.");</script>';
    return false;
  }

  // update database if all went well
  insertDB($mysqli, $row, $new_img_name);
  return true;
}


/**
* Function to recursively copy files and non-empty directories.
* Used by updateProject() function if user changes directory name.
* No return value.
*/
function rcopy($src, $dst) {
  if (!file_exists($dst)) {
    if (is_dir($src)) {
      mkdir($dst);
      $files = scandir($src);
      foreach ($files as $file)
      if ($file != "." && $file != "..") rcopy("$src/$file", "$dst/$file");
    }
    else if (file_exists($src)) copy($src, $dst);
  }
}


/**
* Function to update existing project. No return value.
*/
function updateProject($mysqli, $row) {

  // handle directory name change
  $directory = $_POST["directory"];  // used for img later on
  $old_path = './img/projects/'.$row["directory"].'/';
  $new_path = './img/projects/'.$directory.'/';
  if ($old_path != $new_path) {

    // if new directory name already exists
    if (directoryExists($directory)) {
      unset($_POST["directory"]);
      echo '<script>alert("Directory ('.$row["directory"].') already exists - current directory not renamed");</script>';

    // rename existing directory
    } else {
      rcopy($old_path, $new_path);
      unlink($old_path.$row["image"]);
      rmdir($old_path);
    }

  // directory name stayed the same
  } else {
    unset($_POST["directory"]);
  }

  // handle image change
  $new_img_name = null;
  if (isset($_FILES["image"]) && ($_FILES["image"]["size"] != 0)) {
    $new_img_name = checkImage($row["image"], $directory);

    // if uploaded image didn't pass checks
    if (is_null($new_img_name)) {
      echo '<script>alert("Image did not pass checks - image not updated.");</script>';

    // uploaded image passed check - try to upload image
    } else {
      $uploaded_img = uploadImage($row, $directory, $new_img_name);
      if ($uploaded_img == false) {
        // if upload failed
        echo '<script>alert("Image upload failed - image not updated.");</script>';
      }
    }
  }

  // update database if all went well
  updateDB($mysqli, $row, $new_img_name);
}


/**
* Function called when user clicks update or add button in controls column of
* table. If posted project data is not in database, calls addProject(). Else,
* calls updateProject();
*/
function directPost($mysqli) {
  $usr_action = $_POST["update"];
  unset($_POST["update"]);

  // check if submitted project is in database
  $command = 'SELECT * FROM projects WHERE ID='.$_POST["id"].';';
  $result = $mysqli->query($command);
  if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }
  $row = $result->fetch_assoc();


  // User wants to add project
  if ($usr_action == "Add") {
    if (mysqli_num_rows($result) == 0) {
      addProject($mysqli, $row);
    } else {
      echo '<script>alert("Error: Project Already in Database!")</script>';
    }

  // User wants to update project
  } else if ($usr_action == "Update") {
    if (mysqli_num_rows($result) != 0) {
      updateProject($mysqli, $row);
    } else {
      echo '<script>alert("Error: Project Not in Database!")</script>';
    }

  // User wants to delete project
  } else if ($usr_action == "Delete") {
    // configure needed data
    $old_path = './img/projects/'.$row["directory"].'/';
    $old_img = $old_path.$row["image"];
    // delete from database
    $command = 'DELETE FROM projects WHERE ID='.$_POST["id"].';';
    $result = $mysqli->query($command);
    if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }
    // delete from projects folder
    unlink($old_img);
    rmdir($old_path);

  // Error
  } else {
    echo '<script>alert("Error: Neither Add, Update, Nor Delete Triggered!")</script>';
    unset($_POST["update"]);
  }


  // display updated table data after changes are made
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

    // Handle Posted Data
    directPost($mysqli);


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
