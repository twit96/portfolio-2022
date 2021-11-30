<?php


class Link {
  public $id;
  public $text;
  public $url;
  public $project_id;
  public $is_primary;

  function __construct(
    $mysqli,
    $in_id=null,
    $in_text=null,
    $in_url=null,
    $in_project_id=null,
    $in_is_primary=null
  ) {
    if (!empty($in_id)) {         $this->id = $in_id; }
    if (!empty($in_text)) {       $this->text = $in_text; }
    if (!empty($in_url)) {        $this->url = $in_url; }
    if (!empty($in_project_id)) { $this->project_id = $in_project_id; }
    if (isset($in_is_primary)) {  $this->is_primary = $in_is_primary; }
  }

  function insertDB($mysqli) {
    getResults(
      $mysqli,
      "INSERT INTO project_links (link_text, url, project_id, is_primary_link) VALUES (?, ?, ?, ?)",
      "ssii",
      array($this->text, $this->url, $this->project_id, $this->is_primary)
    );
  }

  function deleteDB($mysqli) {
    getResults(
      $mysqli,
      "DELETE FROM project_links WHERE id = ?",
      "i",
      array($this->id)
    );
  }

  function updateDB($mysqli) {
    $result = getResults(
      $mysqli,
      "SELECT * FROM project_links WHERE id = ?",
      "i",
      array($this->id)
    );
    $row = $result->fetch_assoc();

    if ($row["link_text"] !== $this->text) { $this->updateTextDB($mysqli); }
    if ($row["url"] !== $this->url) { $this->updateUrlDB($mysqli); }
  }

  private function updateTextDB($mysqli) {
    getResults(
      $mysqli,
      "UPDATE project_links SET link_text=? WHERE id=?",
      "si",
      array($this->text, $this->id)
    );
  }

  private function updateUrlDB($mysqli) {
    getResults(
      $mysqli,
      "UPDATE project_links SET url=? WHERE id=?",
      "si",
      array($this->url, $this->id)
    );
  }
}


class Project {
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
    if (!empty($in_directory)) {   $this->directory = $in_directory; }
    if (!empty($in_image)) {       $this->image = $in_image; }
    if (!empty($in_blurb)) {       $this->blurb = $in_blurb; }
    if (!empty($in_description)) { $this->description = $in_description; }
    if (!empty($in_date)) {        $this->date = $in_date; }
    if (isset($in_featured)) {     $this->featured = $in_featured; }
    if (!empty($in_author_id)) {   $this->author_id = $in_author_id; }

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

  function insertDB($mysqli) {
    getResults(
      $mysqli,
      "INSERT INTO projects VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)",
      "issssssii",
      array(
        $this->id,
        $this->title,
        $this->directory,
        $this->image,
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

  function deleteDB($mysqli) {
    // Delete Links from Database
    $this->primary_link->deleteDB($mysqli);
    foreach ($this->other_links as $link) {
      $link->deleteDB($mysqli);
    }

    // Delete self from Database
    getResults(
      $mysqli,
      "DELETE FROM projects WHERE ID = ?",
      "i",
      array($this->id)
    );
  }

  function updateDB($mysqli) {
    $result = getResults(
      $mysqli,
      "SELECT * FROM projects WHERE ID = ?",
      "i",
      array($this->id)
    );

    $row = $result->fetch_assoc();

    if ($row["title"] !== $this->title) {             $this->updateTitleDB($mysqli); }
    if ($row["directory"] !== $this->directory) {     $this->updateDirectoryDB($mysqli); }
    if ($row["image"] !== $this->image) {             $this->updateImageDB($mysqli); }
    if ($row["blurb"] !== $this->blurb) {             $this->updateBlurbDB($mysqli); }
    if ($row["description"] !== $this->description) { $this->updateDescriptionDB($mysqli); }
    if ($row["date"] !== $this->date) {               $this->updateDateDB($mysqli); }
    if ($row["featured"] !== $this->featured) {       $this->updateFeaturedDB($mysqli); }
    if ($row["author_id"] !== $this->author_id) {     $this->updateAuthorDB($mysqli); }
  }

  private function updateTitleDB($mysqli) {
    getResults(
      $mysqli,
      "UPDATE projects SET title=? WHERE ID=?",
      "si",
      array($this->title, $this->id);
    );
  }

  private function updateDirectoryDB($mysqli) {
    getResults(
      $mysqli,
      "UPDATE projects SET directory=? WHERE ID=?",
      "si",
      array($this->directory, $this->id);
    );
  }

  private function updateImageDB($mysqli) {
    getResults(
      $mysqli,
      "UPDATE projects SET image=? WHERE ID=?",
      "si",
      array($this->image, $this->id);
    );
  }

  private function updateBlurbDB($mysqli) {
    getResults(
      $mysqli,
      "UPDATE projects SET blurb=? WHERE ID=?",
      "si",
      array($this->blurb, $this->id);
    );
  }

  private function updateDescriptionDB($mysqli) {
    getResults(
      $mysqli,
      "UPDATE projects SET description=? WHERE ID=?",
      "si",
      array($this->description, $this->id);
    );
  }

  private function updateDateDB($mysqli) {
    getResults(
      $mysqli,
      "UPDATE projects SET date=? WHERE ID=?",
      "si",
      array($this->date, $this->id);
    );
  }

  private function updateFeaturedDB($mysqli) {
    getResults(
      $mysqli,
      "UPDATE projects SET featured=? WHERE ID=?",
      "ii",
      array($this->featured, $this->id);
    );
  }

  private function updateAuthorDB($mysqli) {
    getResults(
      $mysqli,
      "UPDATE projects SET author_id=? WHERE ID=?",
      "ii",
      array($this->author_id, $this->id);
    );
  }
}


?>
