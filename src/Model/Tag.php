<?php


class Tag {
  public $id;
  public $name;
  public $post_id;
  public $is_linked;

  function __construct(
    $db,
    $in_id=null,
    $in_name=null,
    $in_post_id=null
  ) {
    if (!empty($in_id)) {      $this->id = $in_id; }
    if (!empty($in_name)) {    $this->name = $in_name; }
    if (!empty($in_post_id)) { $this->post_id = $in_post_id; }

    if (!empty($in_post_id) && !empty($in_id)) {
      // check $in_post_id and $in_id are linked in blog_post_tags table
      $result = $db->getResults(
        "SELECT COUNT(*) FROM blog_post_tags WHERE blog_post_id=? AND tag_id=?",
        "ii",
        array($in_post_id, $in_id)
      );
      $this->is_linked = ($result->fetch_row()[0] === 1);
    }
  }


  private function unlinkAllPosts($db) {
    // unlink from ALL posts in the database
    $db->getResults(
      "DELETE FROM blog_post_tags WHERE tag_id=?",
      "i",
      array($this->id)
    );
  }

  function deleteUniversal($db) {
    // unlink self from all posts
    $this->unlinkAllPosts($db);
    // delete self from tags table
    $db->getResults(
      "DELETE FROM tags WHERE id=?",
      "i",
      array($this->id)
    );
  }


  private function numPostsUseTag($db) {
    // check how many posts use the tag
    $result = $db->getResults(
      "SELECT COUNT(*) FROM blog_post_tags WHERE tag_id=?",
      "i",
      array($this->id)
    );
    return ($result->fetch_row()[0]);
  }

  function unlink($db) {

    // Not Previously Linked
    if (!$this->is_linked) {
      echo '<script>alert("Tag unlinking failed! Tag and project were not previously linked.")</script>';
      return false;

    // Unlink
    } else {
      // unlink from $this->post_id Blog Post
      $db->getResults(
        "DELETE FROM blog_post_tags WHERE blog_post_id=? AND tag_id=?",
        "ii",
        array($this->post_id, $this->id)
      );
      $this->is_linked = false;
      // if no other posts use tag, delete self from datbase
      if ($this->numPostsUseTag($db) === 0) $this->deleteUniversal($db);
      return true;
    }

  }


  private function existsInDB($db) {
    // check how many posts use the tag
    $result = $db->getResults(
      "SELECT COUNT(*) FROM tags WHERE name=?",
      "s",
      array($this->name)
    );
    return ($result->fetch_row()[0] !== 0);
  }

  private function createTag($db) {
    // insert self into tags table
    $db->getResults(
      "INSERT INTO tags (name) VALUES (?)",
      "s",
      array($this->name)
    );
  }

  private function getId($db) {
    $result = $db->getResults(
      "SELECT id FROM tags WHERE name=?",
      "s",
      array($this->name)
    );
    $row = $result->fetch_assoc();
    $this->id = $row["id"];
  }


  function link($db) {

    // Already Linked
    if ($this->is_linked) {
      echo '<script>alert("Tag linking failed! Tag and project were already linked.")</script>';
      return false;

    // Link
    } else {
      // create tag if not already in database
      if (!($this->existsInDB($db))) $this->createTag($db);
      $this->getId($db);
      // link to $this->post_id Blog Post
      $db->getResults(
        "INSERT INTO blog_post_tags VALUES(?,?)",
        "ii",
        array($this->post_id, $this->id)
      );
      return true;
    }

  }
}


?>
