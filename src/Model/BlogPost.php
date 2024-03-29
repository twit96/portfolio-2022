<?php


require_once (__DIR__ .'/Image.php');
require_once (__DIR__ .'/ServerDirectory.php');
require_once (__DIR__ .'/Tag.php');


class BlogPost {
  public $path = "./img/blog/posts/";  // yyyy/mm/dd/ added in constructor

  public $id;
  public $directory;
  public $image;
  public $title;
  public $post;
  public $author_id;
  public $author;
  public $author_img_path;
  public $tags;
  public $date_posted;
  public $date_updated;

  function __construct(
    $db,
    $in_id=null,
    $in_directory=null,
    $in_image=null,
    $in_title=null,
    $in_post=null,
    $in_author_id=null,
    $in_date_posted=null,
    $in_date_updated=null
  ) {

    if (!empty($in_id)) {           $this->id = $in_id; }
    if (!empty($in_directory)) {    $this->directory = $in_directory; }
    if (!empty($in_image)) {        $this->image = $in_image; }
    if (!empty($in_title)) {        $this->title = $in_title; }
    if (!empty($in_post)) {         $this->post = $in_post; }
    if (!empty($in_date_posted)) {  $this->date_posted = $in_date_posted; }

    if (!empty($in_date_updated)) {
      $this->date_updated = $in_date_updated;
    } else if (!empty($in_date_posted)) {
      $this->date_updated = $in_date_posted;
    }

    // path (add date to existing path)
    if (!empty($in_date_posted)) {
      $more_path = str_replace("-", "/", $in_date_posted).'/';
      $this->path .= $more_path;
    }

    // image config
    $img_name = null;
    if (!empty($in_image)) {
      $img_name = $in_image;
    } else if (!empty($in_id)) {
      $result = $db->getResults(
        "SELECT image FROM blog_posts WHERE id=?",
        "i",
        array($in_id)
      );
      if (mysqli_num_rows($result) != 0) {
        $row = $result->fetch_assoc();
        $img_name = $row["image"];
      }
    }

    // directory and image
    if (!empty($in_directory)) {
      $this->directory = new ServerDirectory($this->path, $in_directory);
      $this->image = new Image($this->path.$this->directory->name.'/', $img_name);
    }

    // author
    if (!empty($in_author_id)) {
      $this->author_id = $in_author_id;
      $result = $db->getResults(
        "SELECT first_name, last_name, profile_img_name FROM people WHERE id=?",
        "i",
        array($in_author_id)
      );
      $row = $result->fetch_assoc();
      $this->author = $row["first_name"]." ".$row["last_name"];

      if (!empty($row["profile_img_name"])) {
        $this->author_img_path = '/img/people/'.strtolower($row["last_name"]).'-'.strtolower($row["first_name"]).'/'.$row["profile_img_name"];
      } else {
        $this->author_img_path = '/img/icon.png';
      }
    }

    // tags
    $tag_array = array();
    if (!empty($in_id)) {
      $result = $db->getResults(
        "SELECT tags.* FROM blog_post_tags LEFT JOIN (tags) ON (blog_post_tags.tag_id = tags.id) WHERE blog_post_tags.blog_post_id=?",
        "i",
        array($in_id)
      );

      while ($row = $result->fetch_assoc()) {
        $this_tag = new Tag(
          $db,
          $row["id"],
          $row["name"],
          $in_id
        );
        array_push($tag_array, $this_tag);
      }
    }
    $this->tags = $tag_array;
  }


  function create($db, $img_file) {

    // Configure Server Directory
    $ok = $this->directory->create();   // create directory
    if (!$ok) return false;
    $ok = $this->image->upload($img_file);  // upload image
    if (!$ok) return false;

    // Insert Self into Database
    $db->getResults(
      "INSERT INTO blog_posts VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)",
      "issssiss",
      array(
        $this->id,
        $this->directory->name,
        $this->image->name,
        $this->title,
        $this->post,
        $this->author_id,
        $this->date_posted,
        $this->date_updated
      )
    );

    // Link Tags to Post in Database
    foreach ($this->tags as $tag) {
      $tag->link($db);
    }

  }


  /**
  * Formats the pathname of a nested directory then deletes it.
  */
  private function deleteNestedDirectory($yyyy=null, $mm=null, $dd=null) {

    // Format Nested Directory Path
    $nested_path = "./img/blog/posts";
    if (!empty($yyyy)) {
      $nested_path.="/".$yyyy;

      if (!empty($mm)) {
        $nested_path.="/".$mm;

        if (!empty($dd)) {
          $nested_path.="/".$dd;
        }

      } else if (!empty($dd)) { return false; }  // mm required for dd
    } else { return false; }                     // yyyy always required

    // Success
    rmdir($nested_path);
    return true;
  }

  /**
  * Checks if any other blog posts exist in the dd, mm, or yyyy directories.
  * If none do, removes those empty directories, else, leaves them in place.
  */
  private function checkNestedDirectories($db) {
    // check if directories are in use
    $date_split = explode("-", $this->date_posted);
    $yyyy = $date_split[0];
    $mm = $date_split[1];
    $dd = $date_split[2];

    // day directory
    $result = $db->getResults(
      "SELECT COUNT(*) FROM blog_posts WHERE YEAR(date_posted)=? AND MONTH(date_posted)=? AND DAYOFMONTH(date_posted)=?",
      "sss",
      array($yyyy, $mm, $dd)
    );
    if ($result->fetch_row()[0] === 1) {
      if ($this->deleteNestedDirectory($yyyy, $mm, $dd) === false) return false;
    }

    // month directory
    $result = $db->getResults(
      "SELECT COUNT(*) FROM blog_posts WHERE YEAR(date_posted)=? AND MONTH(date_posted)=?",
      "ss",
      array($yyyy, $mm)
    );
    if ($result->fetch_row()[0] === 1) {
      if ($this->deleteNestedDirectory($yyyy, $mm) === false) return false;
    }

    // year directory
    $result = $db->getResults(
      "SELECT COUNT(*) FROM blog_posts WHERE YEAR(date_posted)=?",
      "s",
      array($yyyy)
    );
    if ($result->fetch_row()[0] === 1) {
      if ($this->deleteNestedDirectory($yyyy) === false) return false;
    }

    // Success
    return true;
  }

  function delete($db) {
    // Delete image, directory, and nested directories from server (directory will remove image)
    $ok = $this->directory->delete();
    if (!$ok) return false;
    $ok = $this->checkNestedDirectories($db);
    if (!$ok) return false;

    // Unlink Tags from Post in Database
    foreach ($this->tags as $tag) {
      $tag->unlink($db);
    }

    // Delete self from database
    $db->getResults(
      "DELETE FROM blog_posts WHERE id = ?",
      "i",
      array($this->id)
    );
  }


  function update($db, $new_img_file=null) {
    // grab current details database
    $result = $db->getResults(
      "SELECT * FROM blog_posts WHERE id=?",
      "i",
      array($this->id)
    );
    $row = $result->fetch_assoc();

    // compare self to database
    if ($row["directory"] !== $this->directory->name) { $this->updateDirectory($db, $row["directory"]); }
    if (!empty($new_img_file)) {                        $this->updateImage($db, $new_img_file); }

    if ($row["title"] !== $this->title) {               $this->updateTitleDB($db); }
    if ($row["post"] !== $this->post) {                 $this->updatePostDB($db); }
    if ($row["author_id"] !== $this->author_id) {       $this->updateAuthorDB($db); }
    if ($row["date_posted"] !== $this->date_posted) {   $this->updateDatePostedDB($db); }

    if (
      (!empty($this->date_updated)) &&
      ($row["date_updated"] !== $this->date_updated)
      ) { $this->updateDateUpdatedDB($db); }
  }

  private function updateDirectory($db, $old_name) {
    // update server
    $this->directory->rename($old_name, $this->directory->name);
    // update database
    $db->getResults(
      "UPDATE blog_posts SET directory=? WHERE id=?",
      "si",
      array($this->directory->name, $this->id)
    );
  }

  private function updateImage($db, $new_img_file) {
    // update server
    $ok = $this->image->upload($new_img_file);
    if (!$ok) return false;
    // update database
    $db->getResults(
      "UPDATE blog_posts SET image=? WHERE id=?",
      "si",
      array($this->image->name, $this->id)
    );
    $this->date_updated = date("Y-m-d");
  }

  private function updateTitleDB($db) {
    $db->getResults(
      "UPDATE blog_posts SET title=? WHERE id=?",
      "si",
      array($this->title, $this->id)
    );
    $this->date_updated = date("Y-m-d");
  }

  private function updatePostDB($db) {
    $db->getResults(
      "UPDATE blog_posts SET post=? WHERE id=?",
      "si",
      array($this->post, $this->id)
    );
    $this->date_updated = date("Y-m-d");
  }

  private function updateAuthorDB($db) {
    $db->getResults(
      "UPDATE blog_posts SET author_id=? WHERE id=?",
      "ii",
      array($this->author_id, $this->id)
    );
  }

  private function updateDatePostedDB($db) {
    $db->getResults(
      "UPDATE blog_posts SET date_posted=? WHERE id=?",
      "si",
      array($this->date_posted, $this->id)
    );
  }

  private function updateDateUpdatedDB($db) {
    $db->getResults(
      "UPDATE blog_posts SET date_updated=? WHERE id=?",
      "si",
      array($this->date_updated, $this->id)
    );
  }


}


?>
