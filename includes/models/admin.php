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
    $result = getResults(
      $mysqli,
      "SELECT COUNT(1) FROM people WHERE username=? AND password=? AND (role='admin' OR role='author')",
      "ss",
      array($username, $password)
    );
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


function buildEditProjectsSection($mysqli) {
  echo <<<EDIT_PROJECTS_TOP
    <section id="edit-projects" class="card">
      <h2>Edit Projects</h2>
  EDIT_PROJECTS_TOP;

  $max_id = 0;  // to set new project's input ID

  $projects = getProjects($mysqli, FALSE, null);
  foreach ($projects as $project) {
    if ($project->id > $max_id) { $max_id = $project->id; }   // update max_id
    echo <<<PROJECT_TOP
    <h3 class="accordion" onclick="this.classList.toggle('active');"><span>({$project->date})</span> <span>{$project->title}</span></h3>
    <div class="panel">
      <h4 class="accordion" onclick="this.classList.toggle('active');">Details</h4>
      <form method="POST" action="admin" enctype="multipart/form-data" class="panel">
        <input name="submitted_data" type="hidden" value="project" />
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
            <input type="text" name="directory" value="{$project->directory->name}" />
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
          <input name="submitted_data" type="hidden" value="link" />
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
            <input name="submitted_data" type="hidden" value="link" />
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
            <input name="submitted_data" type="hidden" value="link" />
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
      <input name="submitted_data" type="hidden" value="project" />
      <input name="id" type="hidden" value="{$max_id}" />
      <input name="author_id" type="hidden" value="1" />
      <div class="label-group">
        <label><input type="text" name="title" placeholder="New Title" required /><span>Title</span></label>
        <label><input type="date" name="date" class="date-today" required /><span>Date</span></label>
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
  EMPTYROW;

  echo '</section>';  // #/edit-projects
}


function buildEditPostsSection($mysqli) {
  echo <<<EDIT_POSTS_TOP
    <section id="edit-posts" class="card">
      <h2>Edit Posts</h2>
  EDIT_POSTS_TOP;

  $max_id = 0;  // to set new project's input ID

  $articles = getBlogPosts($mysqli, null, null);
  foreach ($articles as $article) {
    if ($article->id > $max_id) { $max_id = $article->id; }   // update max_id
    echo <<<POSTS_TOP
    <h3 class="accordion" onclick="this.classList.toggle('active');"><span>({$article->date_posted})</span> <span>{$article->title}</span></h3>
    <div class="panel">
      <h4 class="accordion" onclick="this.classList.toggle('active');">Details</h4>
      <form method="POST" action="admin" enctype="multipart/form-data" class="panel">
        <input name="submitted_data" type="hidden" value="article" />
        <input name="id" type="hidden" value="{$article->id}" />
        <input name="author_id" type="hidden" value="{$article->author_id}" />

        <label>
          <input type="text" name="title" value="{$article->title}" />
          <span>Title</span>
        </label>
        <div class="label-group">
          <label>
            <input type="date" name="date_posted" value="{$article->date_posted}" style="color:var(--grey);" disabled />
            <span>Date Posted</span>
          </label>
          <label>
            <input type="date" name="date_updated" value="{$article->date_updated}" style="color:var(--grey);" disabled />
            <span>Last Updated</span>
          </label>
        </div>
        <div class="label-group">
          <label>
            <input type="text" name="directory" value="{$article->directory->name}" />
            <span>Directory</span>
          </label>
          <label>
            <input type="file" name="image" accept="image/png, image/jpg, image/jpeg" />
            <span>Title Image</span>
          </label>
        </div>
        <label>
          <textarea name="post">{$article->post}</textarea>
          <span>Post Content</span>
        </label>
        <div class="submit-toggle">
          <input type="checkbox" name="toggle" />
          <input name="update" type="submit" value="Update" />
        </div>
      </form>
      <h4 class="accordion" onclick="this.classList.toggle('active');">Tags</h4>
      <div class="panel">
    POSTS_TOP;

    $tags = $article->tags;
    foreach ($tags as $tag) {
      echo <<<POSTS_MID
          <form method="POST" action="admin" enctype="multipart/form-data">
            <input name="submitted_data" type="hidden" value="tag" />
            <input name="id" type="hidden" value="{$tag->id}" />
            <input name="article_id" type="hidden" value="{$tag->post_id}" />
            <div class="label-group">
              <label>
                <input type="text" name="name" value="{$tag->name}" />
                <span>Tag</span>
              </label>
              <div class="submit-toggle">
                <input name="update" type="submit" value="Delete" class="active" style="margin-left: auto;" />
              </div>
            </div>
          </form>
      POSTS_MID;
    }

    echo <<<POSTS_BTM
          <h5 class="accordion" onclick="this.classList.toggle('active');">Add New Tag</h5>
          <form method="POST" action="admin" enctype="multipart/form-data" class="panel">
            <input name="submitted_data" type="hidden" value="tag" />
            <input name="article_id" type="hidden" value="{$article->id}" />
            <div class="label-group">
              <label>
                <input type="text" name="name" placeholder="Tag Name" required />
                <span>Tag</span>
              </label>
              <div class="submit-toggle"><input name="update" type="submit" value="Add" style="margin-left: auto;" /></div>
          </form>
        </div>
      </div>
    </div>
    POSTS_BTM;
  }

  $max_id++;  // add 1 to max_id so it is greater than all other ID's
  echo <<<EMPTYROW
    <h3 class="accordion" onclick="this.classList.toggle('active');">Create New Post</h3>
    <form method="POST" action="admin" enctype="multipart/form-data" class="panel">
      <input name="submitted_data" type="hidden" value="article" />
      <input name="id" type="hidden" value="{$max_id}" />
      <input name="author_id" type="hidden" value="1" />
      <div class="label-group">
        <label><input type="text" name="title" placeholder="New Title" required /><span>Title</span></label>
        <label><input type="date" name="date_posted" class="date-today" required /><span>Date Posted</span></label>
      </div>
      <div class="label-group">
        <label><input type="text" name="directory" placeholder="new-directory" required /><span>Directory</span></label>
        <label><input type="file" name="image" accept="image/png, image/jpg, image/jpeg" required /><span>Title Image</span></label>
      </div>
      <label><textarea name="post" placeholder="New Post" required></textarea><span>Post</span></label>
      <div class="submit-toggle"><span></span><input name="update" type="submit" value="Add" /></div>
    </form>
  EMPTYROW;

  echo '</section>';  // #/edit-posts
}


function buildDashboard($mysqli) {

  echo <<<LEFTTOP
  <div class="flex">
    <div class="left">
  LEFTTOP;

  buildEditProjectsSection($mysqli);
  buildEditPostsSection($mysqli);
  echo '<script src="/js/admin.js"></script>';

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
  unset($_POST["link_id"]);
  unset($_POST["link_text"]);
  unset($_POST["link_url"]);
  unset($_POST["project_id"]);
  unset($_POST["is_primary"]);
}


/**
* Function to unset article-related POST variables.
* No return value.
*/
function doUnsetArticlePost() {
  unset($_POST["id"]);
  unset($_POST["title"]);
  unset($_POST["date_posted"]);
  unset($_POST["date_updated"]);
  unset($_POST["directory"]);
  unset($_POST["post"]);
  unset($_POST["author_id"]);
}


/**
* Function to unset tag-related POST variables.
* No return value.
*/
function doUnsetTagPost() {
  unset($_POST["id"]);
  unset($_POST["name"]);
  unset($_POST["article_id"]);
}


/**
* Function to unset all POST variables that can be set on this page.
* No return value.
*/
function doUnsetAllPost() {
  doUnsetProjectPost();
  doUnsetLinkPost();
  doUnsetArticlePost();
  doUnsetTagPost();
}


/**
* Function called when user clicks update or add button in controls column of
* table. If posted project data is not in database, calls addProject(). Else,
* calls updateProject();
*/
function directPost() {
  require_once (__DIR__ .'/projects.php');
  require_once (__DIR__ .'/articles.php');
  
  $usr_action = $_POST["update"];
  unset($_POST["update"]);
  $data_type = null;
  if (isset($_POST["submitted_data"])) { $data_type = $_POST["submitted_data"]; }
  unset($_POST["submitted_data"]);


  // Is Project
  if ($data_type == "project") {
    // Create Project Object
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
    // Handle Project Actions
    if ($usr_action == "Add") {
      // add link object to project object
      $post_link = new Link(
        $mysqli,
        null,
        $_POST["link_text"],
        $_POST["link_url"],
        $_POST["id"],
        1
      );
      $post_project->primary_link = $post_link;
      // add project
      $post_project->create($mysqli, $_FILES["image"]);
    } else if ($usr_action == "Update") {
      $post_project->update($mysqli, $_FILES["image"]);
    } else if ($usr_action == "Delete") {
      $post_project->delete($mysqli);
    }
    // Unset POST Variables
    doUnsetProjectPost();
    doUnsetLinkPost();


  // Is Project Link
  } else if ($data_type == "link") {
    // Create Link Object
    $post_link = new Link(
      $mysqli,
      null,
      $_POST["link_text"],
      $_POST["link_url"],
      $_POST["project_id"],
      $_POST["is_primary"]
    );
    // Handle Link Actions
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
    // Unset POST Variables
    doUnsetLinkPost();


  // Is Article
  } else if ($data_type == "article") {
    // Create Project Object
    $post_article = new BlogPost(
      $mysqli,
      $_POST["id"],
      $_POST["directory"],
      null,
      $_POST["title"],
      $_POST["post"],
      $_POST["author_id"],
      $_POST["date_posted"],
      $_POST["date_updated"]
    );
    // Handle Article Actions
    if ($usr_action == "Add") {
      $post_article->create($mysqli, $_FILES["image"]);
    } else if ($usr_action == "Update") {
      $post_article->update($mysqli, $_FILES["image"]);
    } else if ($usr_action == "Delete") {
      $post_article->delete($mysqli);
    }
    // Unset POST Variables
    doUnsetArticlePost();


  // Is Article Tag
  } else if ($data_type == "tag") {
    (!empty($_POST["id"])) ? $tag_id = $_POST["id"] : $tag_id = null;
    // Create Tag Object
    $post_tag = new Tag(
      $mysqli,
      $tag_id,
      $_POST["name"],
      $_POST["article_id"]
    );
    // Handle Tag Actions
    if ($usr_action == "Add") {
      $post_tag->link($mysqli);
    } else if ($usr_action == "Delete") {
      $post_tag->unlink($mysqli);
    } else {
      echo '<script>alert("Error: POST action not set to Add, Update, or Delete. No Change Made!")</script>';
    }
    // Unset POST Variables
    doUnsetTagPost();


  // Error
  } else {
    echo '<script>alert("Error: submitted data type not set! No Changes made.")</script>';
    // Unset POST Variables
    doUnsetAllPost();
    return false;
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
    directPost();

  // if user logged in
  } else if (isset($_POST["login"])) {
    require_once (__DIR__ .'/projects.php');
    require_once (__DIR__ .'/articles.php');
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
