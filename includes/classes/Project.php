<?php


class Link {
  public $id;
  public $text;
  public $url;
  public $project_id;
  public $is_primary;

  function __construct(
    $in_id=null,
    $in_text=null,
    $in_url=null,
    $in_project_id=null,
    $in_is_primary=null
  ) {
    if (!empty($in_id)) {         $this->id = $in_id; }
    if (!empty($in_text)) {       $this->text = $in_text; }
    if (!empty($in_url)) {        $this->directory = $in_directory; }
    if (!empty($in_project_id)) { $this->project_id = $in_project_id; }
    if (isset($in_is_primary)) {  $this->is_primary = $in_is_primary; }
  }

  function textIsEqual($other_text) {
    return ($this->text === $other_text);
  }

  function urlIsEqual($other_url) {
    return ($this->url === $other_url);
  }

  function pidIsEqual($other_pid) {
    return ($this->project_id === $other_pid);
  }

  function statusIsEqual($other_status) {
    return ($this->is_primary === $other_status);
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
          $row["id"],
          $row["link_text"],
          $row["url"],
          $row["project_id"],
          $row["is_primary_link"]
        );
        echo "\n".'$row["url"]: '.$row["url"].', $this_link->url: '.$this_link->url."\n";

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
}

?>
