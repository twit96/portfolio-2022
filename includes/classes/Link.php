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


?>
