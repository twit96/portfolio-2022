<?php


/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


require_once (__DIR__ .'./Link.php');
require_once (__DIR__ .'./Directory.php');
require_once (__DIR__ .'./Image.php');


class Project {
  private $path = "./img/projects/";

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
    $mysqli,
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

    if (!empty($in_directory)) {
      $this->directory = new Directory($this->path, $in_directory);
    }

    $this->image = new Image($this->path, $in_image);

    $primary_link_object = null;
    $other_links_array = array();
    if (!empty($in_id)) {
      $result = getResults(
        $mysqli,
        "SELECT * FROM project_links WHERE project_id=?",
        "i",
        array($in_id)
      );

      while ($row = $result->fetch_assoc()) {
        $this_link = new Link(
          $mysqli,
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
        (sizeof($other_links_array) > 0)
      ) {
        $primary_link_object = array_shift($other_links_array);
      }
    }
    $this->primary_link = $primary_link_object;
    $this->other_links = $other_links_array;
  }

  function create($mysqli, $img_file) {

    // Configure Server Directory
    $ok = $this->directory->create();   // create directory
    if (!$ok) return false;
    $ok = $this->image->upload($img_file);  // upload image
    if (!$ok) return false;

    // Insert Self into Database
    getResults(
      $mysqli,
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
    $this->primary_link->insertDB($mysqli);
    foreach ($this->other_links as $link) {
      $link->insertDB($mysqli);
    }
  }

  function delete($mysqli) {
    // Delete image and directory from server (directory will remove image)
    $ok = $this->directory->delete();
    if (!$ok) return false;

    // Delete links from database
    $this->primary_link->deleteDB($mysqli);
    foreach ($this->other_links as $link) {
      $link->deleteDB($mysqli);
    }

    // Delete self from database
    getResults(
      $mysqli,
      "DELETE FROM projects WHERE ID = ?",
      "i",
      array($this->id)
    );
  }

  function update($mysqli, $new_img_file=null) {
    // grab current details database
    $result = getResults(
      $mysqli,
      "SELECT * FROM projects WHERE ID = ?",
      "i",
      array($this->id)
    );
    $row = $result->fetch_assoc();

    // compare self to database
    if ($row["directory"] !== $this->directory->name) { $this->updateDirectory($mysqli); }
    if (!empty($new_img_file)) {                        $this->updateImage($mysqli, $new_img_file); }

    if ($row["title"] !== $this->title) {               $this->updateTitleDB($mysqli); }
    if ($row["blurb"] !== $this->blurb) {               $this->updateBlurbDB($mysqli); }
    if ($row["description"] !== $this->description) {   $this->updateDescriptionDB($mysqli); }
    if ($row["date"] !== $this->date) {                 $this->updateDateDB($mysqli); }
    if ($row["featured"] !== $this->featured) {         $this->updateFeaturedDB($mysqli); }
    if ($row["author_id"] !== $this->author_id) {       $this->updateAuthorDB($mysqli); }
  }

  private function updateDirectory($mysqli) {
    // update server
    $ok = $this->directory->rename($this->directory->name);
    if (!$ok) return false;
    // update database
    getResults(
      $mysqli,
      "UPDATE projects SET directory=? WHERE ID=?",
      "si",
      array($this->directory->name, $this->id)
    );
  }

  private function updateImage($mysqli, $new_img_file) {
    // update server
    $ok = $this->image->upload($new_img_file);
    if (!$ok) return false;
    // update database
    getResults(
      $mysqli,
      "UPDATE projects SET image=? WHERE ID=?",
      "si",
      array($this->image->name, $this->id)
    );
  }

  private function updateTitleDB($mysqli) {
    getResults(
      $mysqli,
      "UPDATE projects SET title=? WHERE ID=?",
      "si",
      array($this->title, $this->id)
    );
  }

  private function updateBlurbDB($mysqli) {
    getResults(
      $mysqli,
      "UPDATE projects SET blurb=? WHERE ID=?",
      "si",
      array($this->blurb, $this->id)
    );
  }

  private function updateDescriptionDB($mysqli) {
    getResults(
      $mysqli,
      "UPDATE projects SET description=? WHERE ID=?",
      "si",
      array($this->description, $this->id)
    );
  }

  private function updateDateDB($mysqli) {
    getResults(
      $mysqli,
      "UPDATE projects SET date=? WHERE ID=?",
      "si",
      array($this->date, $this->id)
    );
  }

  private function updateFeaturedDB($mysqli) {
    getResults(
      $mysqli,
      "UPDATE projects SET featured=? WHERE ID=?",
      "ii",
      array($this->featured, $this->id)
    );
  }

  private function updateAuthorDB($mysqli) {
    getResults(
      $mysqli,
      "UPDATE projects SET author_id=? WHERE ID=?",
      "ii",
      array($this->author_id, $this->id)
    );
  }
}


?>
