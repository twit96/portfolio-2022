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
  echo '<script>console.log("formatDuplicateFilenames()");</script>';
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
function checkImage($img) {
  echo '<script>console.log("checkImage()");</script>';

  $new_img_name = false;

  // Ensure image is set in $_POST
  if (isset($_FILES["image"]) && ($_FILES["image"]["size"] != 0)) {

    // update new image file name if same as old name
    $new_img_name = basename($_FILES["image"]["name"]);
    $new_img_name = formatDuplicateFilenames($new_img_name, $img);

    // begin check
    $target_file = '../projects/'.$_POST["directory"].'/'.$new_img_name;
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
  echo '<script>console.log("uploadImage()");</script>';
  $upload_success = false;

  // Upload New Image
  $target_file = '../projects/'.$directory.'/'.$new_img_name;
  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    $upload_success = true;
  }
  // Delete Old Image
  if ($upload_success == true) {
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
* Function to add new project. Failure gives alert to user.
* Returns false if failed and true if succeeded.
*/
function addProject($row) {
  echo '<script>console.log("addProject()");</script>';

  // check for valid image (null parameter since no existing img to compare to)
  $new_img_name = checkImage(null);
  echo '<script>console.log("$new_img_name: '.$new_img_name.'");</script>';
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
  $new_path = '../projects/'.$_POST["directory"];
  mkdir($new_path, 0777, true);

  // try to upload image
  $uploaded_img = uploadImage($row, $_POST["directory"], $new_img_name);
  if (!$uploaded_img) {
    // upload failed
    rmdir($new_path);  // delete new directory
    echo '<script>alert("Image upload failed - project not added.");</script>';
    return false;
  }

  // update database if all went well
  updateDB($row);
  return true;
}


/**
* Function to update existing project.
*/
function updateProject($row) {
  echo '<script>console.log("updateProject()");</script>';
}


function updateDB($row) {
  echo '<script>console.log("updateDB()");</script>';
}

// Function to update a single column value for a given project id.
function updateProjectsTable($mysqli, $col, $val, $id) {

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
  (mysqli_num_rows($result) == 0) ? addProject($row) : updateProject($row);
  // display updated table data after changes are made
  buildDashboard($mysqli);
}



function OLDupdateDB($mysqli) {
  unset($_POST["update"]);

  // update other columns
  $command = 'SELECT * FROM projects WHERE ID='.$_POST["id"].';';
  $result = $mysqli->query($command);
  if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }
  $row = $result->fetch_assoc();
  unset($_POST["id"]);

  // check for new/changed directory
  $pathname = '../projects/';
  $directory = $_POST["directory"];
  unset($_POST["directory"]);

  if (mysqli_num_rows($result) == 0) {
    // create new directory
    mkdir($pathname.$directory, 0777, true);

  } else if ($directory != $row["directory"]) {
    // rename existing directory
    copy($pathname.$row["directory"].'/*.*', $pathname.$directory.'/');
    unlink($pathname.$row["image"]);
    unlink($pathname.$row["directory"]);
  }

  // upload image
  if (isset($_FILES["image"]) && ($_FILES["image"]["size"] != 0)) {

    $existing_img_name = $row["image"];

    // update new image name if same as old name
    $new_file_name = basename($_FILES["image"]["name"]);
    $new_file_name = formatDuplicateFilenames($new_file_name, $existing_img_name);

    // Try to Upload Image
    $target_dir = $pathname.$directory.'/';
    $target_file = $target_dir.$new_file_name;
    $upload_ok = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $alert_txt = '<script>alert("';

    // check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
      // echo 'File is an image - '.$check["mime"];
      $upload_ok = 1;
    } else {
      $alert_txt .= 'Image upload is not an image. ';
      $upload_ok = 0;
    }

    // check if file already exists
    // (should never trigger since we format the image name above)
    // if (file_exists($target_file)) {
    //   $alert_txt .= 'Image upload already exists in directory.';
    //   $upload_ok = 0;
    // }

    // check file size
    if ($_FILES["image"]["size"] > 500000) {
      $alert_txt .=  'Image upload file is too large (>500KB). ';
      $upload_ok = 0;
    }

    // allow certain file formats
    if (
      ($imageFileType != "jpg") &&
      ($imageFileType != "png") &&
      ($imageFileType != "jpeg") &&
      ($imageFileType != "gif") &&
      ($imageFileType != "webp")
    ) {
      $alert_txt .=  'Image upload file type is not JPG, JPEG, PNG GIF, or WebP. ';
      $upload_ok = 0;
    }

    // if $upload_ok is still set to 1, try to upload file
    if ($upload_ok != 0) {
      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $alert_txt .= 'The file '.htmlspecialchars( basename( $_FILES["image"]["name"])).' has been uploaded. ';
      } else {
        $alert_txt .= 'Sorry, there was an error uploading your file. ';
        $upload_ok = 0;
      }
    // handle if $upload_ok was set to 0 by an error
    } else {
      $alert_txt .= 'File was not uploaded. ';
    }


    // Delete Old Image and Update Database
    if ($upload_ok != 0) {
      // delete old image
      $img_to_delete = '../projects/'.$directory.'/'.$existing_img_name;
      unlink($img_to_delete);
      // point database to new image
      $command = 'UPDATE projects SET image="'.$new_file_name.'" WHERE id='.$project_id.';';
      $result = $mysqli->query($command);
      if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }
    }


    // Finish and Display Alert Text
    $alert_txt .= '");</script>';
    echo $alert_txt;
  }
  unset($_POST["image"]);


  while ($row = $result->fetch_assoc()) {
    // echo 'ROW<br />';
    // var_dump($row);
    // echo '<br /><br />';
    // echo 'POST<br />';
    // var_dump($_POST);
    // echo '<br /><br />';

    foreach ($_POST as $key => $value) {
      if ($row[$key] != $_POST[$key]) {
        $command1 = 'UPDATE projects SET '.$key.'="'.$_POST[$key].'" WHERE id='.$project_id.';';
        $result1 = $mysqli->query($command1);
        if (!$result1) { die('Query failed: '.$mysqli->error.'<br>'); }
      }
      // unset post for each key
      unset($_POST[$key]);
    }
  }

  // echo 'POST<br />';
  // var_dump($_POST);
  // echo '<br /><br />';

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
