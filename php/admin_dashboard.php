<?php

/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


function doLogin() {
  $script = $_SERVER['PHP_SELF'];
  echo <<<TOP
  <h2>Admin Login</h2>
  <div id="login">
    <form method="POST" action="index.php">
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
    <p>
      The place where super duper top secret things definitely do not occur...
    </p>
  </div>
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


/**
* Function to set up the admin page table layout. No return value.
*/
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
  if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }

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
    <form id="logout" method="POST" action="index.php">
      <input name="logout" type="submit" value="Logout" />
    </form>
  </section>
  BOTTOM;

  // Forms for each row of inputs to reference
  foreach ($project_directories as &$curr_dir) {
    echo '<form class="hidden" id="'.$curr_dir.'" method="POST" action="index.php" enctype="multipart/form-data"></form>';
  }
  echo '<form class="hidden" id="add-new-project" method="POST" action="index.php" enctype="multipart/form-data"></form>';
  unset($curr_dir);
}


/**
* Function to display the rows of the admin page table layout.
* Called by buildDashboard(). No return value.
*/
function displayData($mysqli) {

  $command = 'SELECT * FROM projects ORDER BY date DESC;';
  $result = $mysqli->query($command);
  if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }

  $project_directories = array();

  $max_id = 0;  // to set add-new-column form's input ID

  echo '<tbody>';
  while ($row = $result->fetch_assoc()) {
    if ($row['ID'] > $max_id) { $max_id = $row['ID']; }   // update max_id

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
    echo '<td><input form="'.$row['directory'].'" name="date" type="date" value="'.$row['date'].'" required /></td>';
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

  $max_id++;  // add 1 to max_id so it is greater than all other ID's

  echo '<tr>';
  echo '  <td>';
  echo '    <input form="add-new-project" name="id" type="hidden" value="'.$max_id.'" />';

  echo <<<EMPTYROW
      <input form="add-new-project" name="title" type="text" placeholder="New Title" required />
    </td>
    <td><input form="add-new-project" name="directory" type="text" placeholder="new-directory" required /></td>
    <td><input form="add-new-project" name="image" type="file" required /></td>
    <td><input form="add-new-project" name="blurb" type="text" placeholder="A Short Blurb" /></td>
    <td><input form="add-new-project" name="description" type="text" placeholder="Project Description" /></td>
    <td><input form="add-new-project" name="date" type="date" required /></td>
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
    $target_file = '../projects/'.$directory.'/'.$new_img_name;
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
  $target_file = '../projects/'.$directory.'/'.$new_img_name;
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $upload_success = true;
  }
  // Delete Old Image (if it exists - not adding a project)
  if (($upload_success == true) && (!is_null($row["image"]))) {
    unlink('../projects/'.$directory.'/'.$row["image"]);
  }

  return $upload_success;
}


/**
* Function to check if posted directory name already exists in projects
* directory. Returns true if so and false if not.
*/
function directoryExists($dir) {
  return is_dir('../projects/'.$dir);
}


/**
* Function to update a project directory name. Copies the contents of the
* existing directory into the new directory, deletes the contents of the old
* directory, and then deletes the old directory.
* (NON-RECURSIVE - SINGLE LAYER DIRECTORIES ONLY)
* Returns true if success and false if failure.
*/
function updateDirectory($row, $dir) {
  $old_path = '../projects/'.$row["directory"].'/';
  $new_path = '../projects/'.$dir.'/';

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
  echo '<script>console.log("insertDB;");</script>';

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
  echo '<script>console.log("updateDB;");</script>';

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
  echo '<script>console.log("addProject");</script>';
  $pd = $_POST["directory"];  // TEMPORARY used for debug
  echo $pd;
  echo '<script>console.log("POST "directory": '.$pd.'");</script>';

  // check for valid image (null parameter since no existing img to compare to)
  $new_img_name = checkImage(null, $_POST["directory"]);
  if (is_null($new_img_name)) {
    echo '<script>alert("Image did not pass checks - project not added.");</script>';
    return false;
  }
  echo '<script>console.log("$new_img_name: '.$new_img_name.'");</script>';

  // check directory doesn't already exist
  if (directoryExists($_POST["directory"])) {
    echo '<script>alert("Directory ('.$row["directory"].') already exists - project not added");</script>';
    return false;
  }

  // create new directory
  $new_path = '../projects/'.$_POST["directory"];
  mkdir($new_path, 0777, true);

  echo '<script>console.log("$new_path: '.$new_path.'");</script>';
  // try to upload image
  $uploaded_img = uploadImage($row, $_POST["directory"], $new_img_name);
  if ($uploaded_img == false) {
    echo '<script>console.log("$new_img_name: '.$uploaded_img.'");</script>';
    // upload failed
    rmdir($new_path);  // delete new directory
    echo '<script>alert("Image upload failed - project not added.");</script>';
    return false;
  }
  unset($_POST["image"]);  // $new_img_name used in insertDB()

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
  echo '<script>console.log("updateProject;");</script>';

  // handle directory name change
  $directory = $_POST["directory"];  // used for img later on
  $old_path = '../projects/'.$row["directory"].'/';
  $new_path = '../projects/'.$directory.'/';
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
  $new_img_name;
  if (isset($_POST["image"])) {
    $new_img_name = checkImage($row["image"], $directory);

    // if uploaded image didn't pass checks
    if (is_null($new_img_name)) {
      unset($_POST["image"]);
      echo '<script>alert("Image did not pass checks - image not updated.");</script>';

    // uploaded image passed check - try to upload image
    } else {
      $uploaded_img = uploadImage($row, $directory, $new_img_name);
      if ($uploaded_img == false) {
        // if upload failed
        unset($_POST["image"]);
        echo '<script>alert("Image upload failed - image not updated.");</script>';
      }
    }

  // image stayed the same
  } else {
    unset($_POST["image"]);
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
  unset($_POST["update"]);
  // check if submitted project is in database
  $command = 'SELECT * FROM projects WHERE ID='.$_POST["id"].';';
  $result = $mysqli->query($command);
  if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }
  $row = $result->fetch_assoc();
  // either add or update project
  if (mysqli_num_rows($result) == 0) {
    addProject($mysqli, $row);
  } else {
    updateProject($mysqli, $row);
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
