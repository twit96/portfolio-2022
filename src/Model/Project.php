<?php


require_once (__DIR__ .'/Image.php');
require_once (__DIR__ .'/Link.php');
require_once (__DIR__ .'/ServerDirectory.php');


class Project {
  public $path = "./img/projects/";

  public $id;
  public $title;
  public $directory;
  public $image;
  public $blurb;
  public $description;
  public $date;
  public $primary_link;
  public $other_links;
  public $featured;
  public $author_id;

  function __construct(
    $db,
    $in_id=null,
    $in_title=null,
    $in_directory=null,
    $in_image=null,
    $in_blurb=null,
    $in_description=null,
    $in_date=null,
    $in_featured=null,
    $in_author_id=null
  ) {

    if (!empty($in_id)) {          $this->id = $in_id; }
    if (!empty($in_title)) {       $this->title = $in_title; }
    if (!empty($in_blurb)) {       $this->blurb = $in_blurb; }
    if (!empty($in_description)) { $this->description = $in_description; }
    if (!empty($in_date)) {        $this->date = $in_date; }
    if (isset($in_featured)) {     $this->featured = $in_featured; }
    if (!empty($in_author_id)) {   $this->author_id = $in_author_id; }

    // image
    $img_name = null;
    if (!empty($in_image)) {
      $img_name = $in_image;
    } else if (!empty($in_id)) {
      $result = $db->getResults(
        "SELECT image FROM projects WHERE ID=?",
        "i",
        array($in_id)
      );
      if (mysqli_num_rows($result) != 0) {
        $row = $result->fetch_assoc();
        $img_name = $row["image"];
      }
    }

    // directory
    if (!empty($in_directory)) {
      $this->directory = new ServerDirectory($this->path, $in_directory);
      $this->image = new Image($this->path.$this->directory->name.'/', $img_name);
    }

    // links
    $primary_link_object = null;
    $other_links_array = array();
    if (!empty($in_id)) {
      $result = $db->getResults(
        "SELECT * FROM project_links WHERE project_id=?",
        "i",
        array($in_id)
      );

      while ($row = $result->fetch_assoc()) {
        $this_link = new Link(
          $db,
          $row["id"],
          $row["link_text"],
          $row["url"],
          $row["project_id"],
          $row["is_primary_link"]
        );

        if ($this_link->is_primary == 1) {
          $primary_link_object = $this_link;
        } else {
          array_push($other_links_array, $this_link);
        }
      }

      if (
        ($primary_link_object == null) &&
        (count($other_links_array) > 0)
      ) {
        $primary_link_object = array_shift($other_links_array);
      }
    }
    $this->primary_link = $primary_link_object;
    $this->other_links = $other_links_array;
  }

  function create($db, $img_file) {

    // Configure Server Directory
    $ok = $this->directory->create();   // create directory
    if (!$ok) return false;
    $ok = $this->image->upload($img_file);  // upload image
    if (!$ok) return false;

    // Insert Self into Database
    $db->getResults(
      "INSERT INTO projects VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
      "issssssii",
      array(
        $this->id,
        $this->title,
        $this->directory->name,
        $this->image->name,
        $this->blurb,
        $this->description,
        $this->date,
        $this->featured,
        $this->author_id
      )
    );

    // Insert Links into Database
    $this->primary_link->insertDB($db);
    foreach ($this->other_links as $link) {
      $link->insertDB($db);
    }
  }

  function delete($db) {
    // Delete image and directory from server (directory will remove image)
    $ok = $this->directory->delete();
    if (!$ok) return false;

    // Delete links from database
    $this->primary_link->deleteDB($db);
    foreach ($this->other_links as $link) {
      $link->deleteDB($db);
    }

    // Delete self from database
    $db->getResults(
      "DELETE FROM projects WHERE ID = ?",
      "i",
      array($this->id)
    );
  }

  function update($db, $new_img_file=null) {
    // grab current details database
    $result = $db->getResults(
      "SELECT * FROM projects WHERE ID = ?",
      "i",
      array($this->id)
    );
    $row = $result->fetch_assoc();

    // compare self to database
    if ($row["directory"] !== $this->directory->name) { $this->updateDirectory($db, $row["directory"]); }
    if (!empty($new_img_file)) {                        $this->updateImage($db, $new_img_file); }

    if ($row["title"] !== $this->title) {               $this->updateTitleDB($db); }
    if ($row["blurb"] !== $this->blurb) {               $this->updateBlurbDB($db); }
    if ($row["description"] !== $this->description) {   $this->updateDescriptionDB($db); }
    if ($row["date"] !== $this->date) {                 $this->updateDateDB($db); }
    if ($row["featured"] !== $this->featured) {         $this->updateFeaturedDB($db); }
    if ($row["author_id"] !== $this->author_id) {       $this->updateAuthorDB($db); }
  }

  private function updateDirectory($db, $old_name) {
    // update server
    $this->directory->rename($old_name, $this->directory->name);
    // update database
    $db->getResults(
      "UPDATE projects SET directory=? WHERE ID=?",
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
      "UPDATE projects SET image=? WHERE ID=?",
      "si",
      array($this->image->name, $this->id)
    );
  }

  private function updateTitleDB($db) {
    $db->getResults(
      "UPDATE projects SET title=? WHERE ID=?",
      "si",
      array($this->title, $this->id)
    );
  }

  private function updateBlurbDB($db) {
    $db->getResults(
      "UPDATE projects SET blurb=? WHERE ID=?",
      "si",
      array($this->blurb, $this->id)
    );
  }

  private function updateDescriptionDB($db) {
    $db->getResults(
      "UPDATE projects SET description=? WHERE ID=?",
      "si",
      array($this->description, $this->id)
    );
  }

  private function updateDateDB($db) {
    $db->getResults(
      "UPDATE projects SET date=? WHERE ID=?",
      "si",
      array($this->date, $this->id)
    );
  }

  private function updateFeaturedDB($db) {
    $db->getResults(
      "UPDATE projects SET featured=? WHERE ID=?",
      "ii",
      array($this->featured, $this->id)
    );
  }

  private function updateAuthorDB($db) {
    $db->getResults(
      "UPDATE projects SET author_id=? WHERE ID=?",
      "ii",
      array($this->author_id, $this->id)
    );
  }
}


?>
