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
      <form method="POST" action="admin">
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
function doUnsetLoginPost() {
  unset($_POST['username']);
  unset($_POST['password']);
}


/**
* Function to handle the login functionality from the given username/password.
* No return value.
*/
function checkLogin($mysqli, $username, $password) {

  if (!$username == '' && !$password == '') {

    // check db for valid login
    $stmt = $mysqli->prepare("SELECT COUNT(1) FROM people WHERE username=? AND password=? AND (role='admin' OR role='author')");
    $stmt->bind_param("ss", $usr, $pwd);
    $usr = $username;
    $pwd = $password;
    $stmt->execute();
    if ($stmt === false) {
      error_log('mysqli execute() failed: ');
      error_log( print_r( htmlspecialchars($stmt->error), true ) );
    }
    $result = $stmt->get_result();
    $stmt->close();
    $valid_login = ($result->fetch_row()[0] === 1);

    // actions
    if ($valid_login) {
      buildDashboard($mysqli);
    } else {
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

  $max_id = 0;  // to set new project's input ID

  $projects = getProjects($mysqli, FALSE, null);
  foreach ($projects as $project) {
    if ($project->id > $max_id) { $max_id = $project->id; }   // update max_id
    echo <<<PROJECT_TOP
    <h3 class="accordion" onclick="this.classList.toggle('active');"><span>({$project->date})</span> <span>{$project->title}</span></h3>
    <div class="panel">
      <h4 class="accordion" onclick="this.classList.toggle('active');">Details</h4>
      <form method="POST" action="admin" enctype="multipart/form-data" class="panel">
        <input name="id" type="hidden" value="{$project->id}" />
        <input name="author_id" type="hidden" value="{$project->author_id}" />
        <div class="label-group">
          <label>
            <input type="text" name="title" value="{$project->title}" />
            <span>Title</span>
          </label>
          <label>
            <input type="date" name="date" value="{$project->date}" />
            <span>Date</span>
          </label>
        </div>
        <div class="label-group">
          <label>
            <input type="text" name="directory" value="{$project->directory}" />
            <span>Directory</span>
          </label>
          <label>
            <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" />
            <span>Image</span>
          </label>
        </div>
        <label>
          <input type="text" name="blurb" value="{$project->blurb}" />
          <span>Blurb</span>
        </label>
        <label>
          <textarea name="description">{$project->description}</textarea>
          <span>Description</span>
        </label>
        <div class="label-group">
          <label>
            <input type="number" name="featured" min="0" value="{$project->featured}" />
            <span>Featured Rank</span>
          </label>
          <div class="submit-toggle">
            <input type="checkbox" name="toggle" />
            <input name="update" type="submit" value="Update" />
          </div>
        </div>
      </form>
    PROJECT_TOP;

    $primary_link = $project->primary_link;
    echo <<<PROJECT_MID
      <h4 class="accordion" onclick="this.classList.toggle('active');">Links</h4>
      <div class="panel">
        <h5 class="accordion" onclick="this.classList.toggle('active');">Primary Link</h5>
        <form method="POST" action="admin" enctype="multipart/form-data" class="panel">
          <input name="link_only" type="hidden" value="1" />
          <input name="link_id" type="hidden" value="{$primary_link->id}" />
          <input name="project_id" type="hidden" value="{$primary_link->project_id}" />
          <input name="is_primary" type="hidden" value="1" />
          <div class="label-group">
            <label>
              <input type="text" name="link_text" value="{$primary_link->text}" />
              <span>Text</span>
            </label>
            <label>
              <input type="text" name="link_url" value="{$primary_link->url}" />
              <span>URL</span>
            </label>
            <div class="submit-toggle">
              <input name="update" type="submit" value="Update" style="margin-right: 0; margin-left: auto;" />
            </div>
          </div>
        </form>
        <h5 class="accordion" onclick="this.classList.toggle('active');">Other Links</h5>
        <div class="panel">
    PROJECT_MID;

    $other_links = $project->other_links;
    foreach ($other_links as $link) {
      echo <<<PROJECT_MID
          <form method="POST" action="admin" enctype="multipart/form-data">
            <input name="link_only" type="hidden" value="1" />
            <input name="link_id" type="hidden" value="{$link->id}" />
            <input name="project_id" type="hidden" value="{$link->project_id}" />
            <input name="is_primary" type="hidden" value="0" />
            <div class="label-group">
              <label>
                <input type="text" name="link_text" value="{$link->text}" />
                <span>Text</span>
              </label>
              <label>
                <input type="text" name="link_url" value="{$link->url}" />
                <span>URL</span>
              </label>
              <div class="submit-toggle">
                <input type="checkbox" name="toggle" />
                <input name="update" type="submit" value="Update" />
              </div>
            </div>
          </form>
      PROJECT_MID;
    }

    echo <<<PROJECT_BTM
          <h5 class="accordion" onclick="this.classList.toggle('active');">Add New Link</h5>
          <form method="POST" action="admin" enctype="multipart/form-data" class="panel">
            <input name="link_only" type="hidden" value="1" />
            <input name="project_id" type="hidden" value="{$project->id}" />
            <input name="is_primary" type="hidden" value="0" />
            <div class="label-group">
              <label>
                <input type="text" name="link_text" placeholder="Link Text" required />
                <span>Text</span>
              </label>
              <label>
                <input type="text" name="link_url" placeholder="https://link-url.com/" required />
                <span>URL</span>
              </label>
              <div class="submit-toggle">
                <input name="update" type="submit" value="Add" style="margin-right: 0; margin-left: auto;" />
              </div>
            </div>
          </form>
        </div>  <!-- other links area panel -->
      </div>  <!-- links panel -->
    </div>  <!-- main project panel -->
    PROJECT_BTM;
  }

  $max_id++;  // add 1 to max_id so it is greater than all other ID's
  echo <<<EMPTYROW
    <h3 class="accordion" onclick="this.classList.toggle('active');">Add New Project</h3>
    <form method="POST" action="admin" enctype="multipart/form-data" class="panel">
      <input name="id" type="hidden" value="{$max_id}" />
      <input name="author_id" type="hidden" value="1" />
      <div class="label-group">
        <label><input type="text" name="title" placeholder="New Title" required /><span>Title</span></label>
        <label><input type="date" name="date" required /><span>Date</span></label>
      </div>
      <div class="label-group">
        <label><input type="text" name="directory" placeholder="new-directory" required /><span>Directory</span></label>
        <label><input type="file" name="image" accept="image/png, image/jpg, image/jpeg" required /><span>Image</span></label>
      </div>
      <label><input type="text" name="blurb" placeholder="New Blurb" required /><span>Blurb</span></label>
      <label><textarea name="description" placeholder="New Description" required></textarea><span>Description</span></label>
      <div class="label-group">
        <input name="is_primary" type="hidden" value="1" />
        <input name="project_id" type="hidden" value="{$max_id}" />
        <label>
          <input type="text" name="link_text" placeholder="Link Text" required />
          <span>Primary Link Text</span>
        </label>
        <label>
          <input type="text" name="link_url" placeholder="https://primary-link.com/" required />
          <span>Primary Link URL</span>
        </label>
      </div>
      <div class="label-group">
        <label><input type="number" name="featured" min="0" value="0" required /><span>Featured</span></label>
        <div class="submit-toggle"><span></span><input name="update" type="submit" value="Add" /></div>
      </div>
    </form>
    <script src="/js/admin.js"></script>
  EMPTYROW;

  echo '</section>';  // #/edit-projects

  echo <<<LOGOUT
  <form id="logout" method="POST" action="admin">
    <input name="logout" type="submit" value="Logout" />
  </form>
  LOGOUT;

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
    // if (file_exists($target_file)) $new_img_name = false;

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
* Function to unset project-related POST variables.
* No return value.
*/
function doUnsetProjectPost() {
  unset($_POST["id"]);
  unset($_POST["title"]);
  unset($_POST["directory"]);
  unset($_POST["blurb"]);
  unset($_POST["description"]);
  unset($_POST["date"]);
  unset($_POST["featured"]);
  unset($_POST["author_id"]);
  unset($_POST["link_text"]);
  unset($_POST["link_url"]);
}


/**
* Function to unset link-related POST variables.
* No return value.
*/
function doUnsetLinkPost() {
  unset($_POST["link_only"]);
  unset($_POST["link_id"]);
  unset($_POST["link_text"]);
  unset($_POST["link_url"]);
  unset($_POST["project_id"]);
  unset($_POST["is_primary"]);
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
  $post_project = new Project(
    $mysqli,
    $_POST["id"],
    $_POST["title"],
    $_POST["directory"],
    $new_img_name,
    $_POST["blurb"],
    $_POST["description"],
    $_POST["date"],
    $_POST["featured"],
    $_POST["author_id"]
  );
  $post_link = new Link(
    $mysqli,
    null,
    $_POST["link_text"],
    $_POST["link_url"],
    $_POST["id"],
    1
  );
  $post_project->primary_link = $post_link;

  doUnsetProjectPost();
  doUnsetLinkPost();
  $post_project->insertDB($mysqli);

  return true;
}


/**
* Function to delete existing project.
*/
function deleteProject($mysqli) {
  $post_project = new Project(
    $mysqli,
    $_POST["id"],
    $_POST["title"],
    $_POST["directory"],
    null,
    $_POST["blurb"],
    $_POST["description"],
    $_POST["date"],
    $_POST["featured"],
    $_POST["author_id"]
  );

  doUnsetProjectPost();
  $post_project->deleteDB($mysqli);
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
      echo '<script>alert("Directory ('.$row["directory"].') already exists - current directory not renamed");</script>';

    // rename existing directory
    } else {
      rcopy($old_path, $new_path);
      unlink($old_path.$row["image"]);
      rmdir($old_path);
    }
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
  $post_project = new Project(
    $mysqli,
    $_POST["id"],
    $_POST["title"],
    $_POST["directory"],
    $new_img_name,
    $_POST["blurb"],
    $_POST["description"],
    $_POST["date"],
    $_POST["featured"],
    $_POST["author_id"]
  );

  doUnsetProjectPost();
  $post_project->updateDB($mysqli);
}


/**
* Function called when user clicks update or add button in controls column of
* table. If posted project data is not in database, calls addProject(). Else,
* calls updateProject();
*/
function directPost($mysqli) {
  $usr_action = $_POST["update"];
  unset($_POST["update"]);
  $is_link = isset($_POST["link_only"]);

  // Is Link
  if ($is_link) {
    // create Link object
    $post_link = new Link(
      $mysqli,
      null,
      $_POST["link_text"],
      $_POST["link_url"],
      $_POST["project_id"],
      $_POST["is_primary"]
    );
    // handle link action
    if ($usr_action == "Add") {
      $post_link->insertDB($mysqli);
    } else if ($usr_action == "Update") {
      $post_link->id = $_POST["link_id"];
      $post_link->updateDB($mysqli);
    } else if ($usr_action == "Delete") {
      $post_link->id = $_POST["link_id"];
      $post_link->deleteDB($mysqli);
    } else {
      echo '<script>alert("Error: POST action not set to Add, Update, or Delete. No Change Made!")</script>';
    }
    // unset POST
    doUnsetLinkPost();

  // Is Project
  } else {
    // check if submitted project is in database
    $stmt = $mysqli->prepare("SELECT * FROM projects WHERE ID=?");
    $stmt->bind_param("i", $post_id);
    $post_id = $_POST["id"];
    $stmt->execute();
    if ($stmt === false) {
      error_log('mysqli execute() failed: ');
      error_log( print_r( htmlspecialchars($stmt->error), true ) );
    }
    $result = $stmt->get_result();
    $stmt->close();
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
      deleteProject($mysqli);
      // delete from projects folder
      unlink($old_img);
      rmdir($old_path);

    // Error
    } else {
      echo '<script>alert("Error: Neither Add, Update, Nor Delete Triggered!")</script>';
      unset($_POST["update"]);
    }
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
    include (__DIR__ .'/projects.php');
    directPost($mysqli);

  // if user logged in
  } else if (isset($_POST["login"])) {
    include (__DIR__ .'/projects.php');
    // Retrieve data from POST
    $username = $_POST['username'];
    $password = $_POST['password'];
    doUnsetLoginPost();
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
