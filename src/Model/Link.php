<?php


class Link {
  public $id;
  public $text;
  public $url;
  public $project_id;
  public $is_primary;

  function __construct(
    $db,
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

  function insertDB($db) {
    $db->getResults(
      "INSERT INTO project_links (link_text, url, project_id, is_primary_link) VALUES (?, ?, ?, ?)",
      "ssii",
      array($this->text, $this->url, $this->project_id, $this->is_primary)
    );
  }

  function deleteDB($db) {
    $db->getResults(
      "DELETE FROM project_links WHERE id = ?",
      "i",
      array($this->id)
    );
  }

  function updateDB($db) {
    $result = $db->getResults(
      "SELECT * FROM project_links WHERE id = ?",
      "i",
      array($this->id)
    );
    $row = $result->fetch_assoc();

    if ($row["link_text"] !== $this->text) { $this->updateTextDB($db); }
    if ($row["url"] !== $this->url) { $this->updateUrlDB($db); }
  }

  private function updateTextDB($db) {
    $db->getResults(
      "UPDATE project_links SET link_text=? WHERE id=?",
      "si",
      array($this->text, $this->id)
    );
  }

  private function updateUrlDB($db) {
    $db->getResults(
      "UPDATE project_links SET url=? WHERE id=?",
      "si",
      array($this->url, $this->id)
    );
  }
}


?>
