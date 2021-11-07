<?php
/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");

class Project {
  public $id;
  public $title;
  public $directory;
  public $image;
  public $blurb;
  public $description;
  public $date;
  public $primary_link = array();
  public $other_links = array();
  public $featured;

  function __construct(
    $mysqli,
    $in_id=null,
    $in_title=null,
    $in_directory=null,
    $in_image=null,
    $in_blurb=null,
    $in_description=null,
    $in_date=null,
    $in_featured=null
  ) {

    if (!empty($in_id)) {                   $this->id = $in_id; }
    if (!empty($in_title)) {                $this->title = $in_title; }
    if (!empty($in_directory)) {            $this->directory = $in_directory; }
    if (!empty($in_image)) {                $this->image = $in_image; }
    if (!empty($in_blurb)) {                $this->blurb = $in_blurb; }
    if (!empty($in_description)) {          $this->description = $in_description; }
    if (!empty($in_date)) {                 $this->date = $in_date; }
    if (!empty($in_featured)) {             $this->featured = $in_featured; }

    $primary_link_array = array();
    $other_links_array = array();
    if (!empty($in_id)) {
      $command = 'SELECT * FROM project_links WHERE id='.$in_id.';';
      $result = $mysqli->query($command);
      if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }

      while ($row = $result->fetch_assoc()) {
        if ($row["is_primary_link"] == 1) {
          $primary_link_array[$row["link_text"]] = $row["url"];
        } else {
          $other_links_array[$row["link_text"]] = $row["url"];
        }
      }

      if (sizeof($primary_link_array) == 0) {
        $primary_link_array = array_shift($other_links_array);
      }
    }
    $this->primary_link = $primary_link_array;
    $this->other_links = $other_links_array;
  }
}

?>
