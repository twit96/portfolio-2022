<?php


class Tag {
  public $id;
  public $name;
  public $post_id;

  function __construct(
    $mysqli,
    $in_id=null,
    $in_name=null,
    $in_post_id=null
  ) {
    if (!empty($in_id)) {      $this->id = $in_id; }
    if (!empty($in_name)) {    $this->text = $in_name; }
    if (!empty($in_post_id)) { $this->post_id = $in_post_id; }
  }

  function numPostsUseTag($mysqli) {
    // check how many posts use the tag
    $result = getResults(
      $mysqli,
      "SELECT COUNT(*) FROM blog_post_tags WHERE tag_id=?",
      "i",
      array($this->id)
    );

    return ($result->fetch_row()[0]);
  }

  function unlinkPost($mysqli) {
    // unlink from $post_id passed into object
    getResults(
      $mysqli,
      "DELETE FROM blog_post_tags WHERE blog_post_id=? AND tag_id=?",
      "ii",
      array($this->post_id, $this->id)
    );

    // if no other posts use tag, delete from datbase
    if (numPostsUseTag($mysqli) === 0) {
      deleteDB($mysqli);
    }
  }


  function unlinkAllPosts($mysqli) {
    // unlink from ALL posts in the database
    getResults(
      $mysqli,
      "DELETE FROM blog_post_tags WHERE tag_id=?",
      "i",
      array($this->id)
    );
  }

  function deleteDB($mysqli) {
    // unlink self from all posts (no action if called by unlinkPost() above)
    unlinkAllPosts($mysqli);
    // delete self from tags table
    getResults(
      $mysqli,
      "DELETE FROM tags WHERE id=?",
      "i",
      array($this->id)
    );
  }

  function insertDB($mysqli) {
    // soon.
  }
}


?>
