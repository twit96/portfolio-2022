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
    $stmt = $mysqli->prepare("INSERT INTO project_links (link_text, url, project_id, is_primary_link) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $new_text, $new_url, $new_project_id, $new_is_primary);
    $new_text = $this->text;
    $new_url = $this->url;
    $new_project_id = $this->project_id;
    $new_is_primary = $this->is_primary;
    $stmt->execute();
    if ($stmt === false) {
      error_log('mysqli execute() failed: ');
      error_log( print_r( htmlspecialchars($stmt->error), true ) );
    }
    $stmt->close();
  }

  function deleteDB($mysqli) {
    $stmt = $mysqli->prepare("DELETE FROM project_links WHERE id = ?");
    $stmt->bind_param("i", $this_id);
    $this_id = $this->id;
    $stmt->execute();
    if ($stmt === false) {
      error_log('mysqli execute() failed: ');
      error_log( print_r( htmlspecialchars($stmt->error), true ) );
    }
    $stmt->close();
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
      $command = 'SELECT * FROM project_links WHERE project_id='.$in_id.';';
      $result = $mysqli->query($command);
      if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }

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
    $stmt = $mysqli->prepare("INSERT INTO projects VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
      "issssssii",
      $new_id,
      $new_title,
      $new_directory,
      $new_image,
      $new_blurb,
      $new_description,
      $new_date,
      $new_featured,
      $new_author_id
    );
    $new_id = $this->id;
    $new_title = $this->title;
    $new_directory = $this->directory;
    $new_image = $this->image;
    $new_blurb = $this->blurb;
    $new_description = $this->description;
    $new_date = $this->date;
    $new_featured = $this->featured;
    $new_author_id = $this->author_id;
    $stmt->execute();
    if ($stmt === false) {
      error_log('mysqli execute() failed: ');
      error_log( print_r( htmlspecialchars($stmt->error), true ) );
    }
    $stmt->close();

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
    $stmt = $mysqli->prepare("DELETE FROM projects WHERE ID = ?");
    $stmt->bind_param("i", $this_id);
    $this_id = $this->id;
    $stmt->execute();
    if ($stmt === false) {
      error_log('mysqli execute() failed: ');
      error_log( print_r( htmlspecialchars($stmt->error), true ) );
    }
    $stmt->close();
  }
}

?>
