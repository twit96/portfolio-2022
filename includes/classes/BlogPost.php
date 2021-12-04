<?php


require_once (__DIR__ .'/Image.php');
require_once (__DIR__ .'/ServerDirectory.php');
require_once (__DIR__ .'/Tag.php');


class BlogPost {
  public $path = "./img/articles/";  // yyyy/mm/dd/ added in constructor

  public $id;
  public $directory;
  public $image;
  public $title;
  public $post;
  public $author;
  public $author_img_path;
  public $tags;
  public $date_posted;
  public $date_updated;

  function __construct(
    $mysqli,
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
    if (!empty($in_date_updated)) { $this->date_updated = $in_date_updated; }

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
      $result = getResults(
        $mysqli,
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
      $result = getResults(
        $mysqli,
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
      $result = getResults(
        $mysqli,
        "SELECT tags.* FROM blog_post_tags LEFT JOIN (tags) ON (blog_post_tags.tag_id = tags.id) WHERE blog_post_tags.blog_post_id=?",
        "i",
        array($in_id)
      );

      while ($row = $result->fetch_assoc()) {
        $this_tag = new Tag(
          $row["id"],
          $row["name"],
          $in_id
        );
        array_push($tag_array, $this_tag);

        echo '<script>alert("$row["id"]: '.$row["id"].', $row["name"]: '.$row["name"].', in_id: '.$in_id.', tag->id: '.$this_tag->id.', tag->name: '.$this_tag->name.', tag->post_id: '.$this_tag->post_id.'")</script>';
      }
    }
    $this->tags = $tag_array;
  }
}


?>
