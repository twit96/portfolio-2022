<?php
/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");

class BlogPost {
  public $id;
  public $directory;
  public $image;
  public $title;
  public $post;
  public $author;
  public $tags;
  public $date_posted;
  public $date_updated;

  function __construct($mysqli, $in_id=null, $in_directory=null, $in_image, $in_title=null, $in_post=null, $in_author_id=null, $in_date_posted=null, $in_date_updated=null) {
    if (!empty($in_id)) { $this->id = $in_id; }
    if (!empty($in_directory)) { $this->directory = $in_directory; }
    if (!empty($in_image)) { $this->image = $in_image; }
    if (!empty($in_title)) { $this->title = $in_title; }
    if (!empty($in_post)) { $this->post = $in_post; }
    if (!empty($in_date_posted)) { $this->date_posted = $in_date_posted; }
    if (!empty($in_date_updated)) { $this->date_updated = $in_date_updated; }

    if (!empty($in_author_id)) {
      $command = 'SELECT first_name, last_name, FROM people WHERE id='.$in_author_id.';';
      $result = $mysqli->query($command);
      if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }
      $row = $result->fetch_assoc();
      $this->author = $row["first_name"]." ".$row["last_name"];
    }

    $tag_array = array();
    $tag_id_array = array();
    if (!empty($in_id)) {
      $command = 'SELECT tags.* FROM blog_post_tags LEFT JOIN (tags) ON (blog_post_tags.tag_id = tags.id) WHERE blog_post_tags.blog_post_id='.$in_id.';';
      $result = $mysqli->query($command);
      if (!$result) { die('Query failed: '.$mysqli->error.'<br>'); }
      while ($row = $result->fetch_assoc()) {
        array_push($tag_array, $row["name"]);
        array_push($tag_id_array, $row["id"]);
      }
    }
    $this->tags = $tag_array;
  }
}

?>
