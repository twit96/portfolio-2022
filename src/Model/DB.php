<?php


class DB {
  protected $mysqli;

  function __construct(
    $in_server=null,
    $in_user=null,
    $in_password=null,
    $in_db_name=null
  ) {

    if (
      !empty($in_server) &&
      !empty($in_user) &&
      !empty($in_password) &&
      !empty($in_db_name)
    ) {

      // Connect to MySQLi Server
      $this->mysqli = new mysqli(
        $in_server, $in_user, $in_password, $in_db_name
      );
      if ($this->mysqli->connect_errno) {
        $err_msg = 'Connect Error: '.$this->mysqli->connect_errno .": ";
        $err_msg .= $this->mysqli->connect_error;
        die($err_msg);
      }
      // Select Database
      $this->mysqli->select_db($in_db_name) or die($this->mysqli->error);

    }
  }

  /**
  * Reused code in all prepared statements.
  * $query is a string, $types is a string, and $params is an array.
  */
  function getResults($query, $types=null, $params=null) {
    $stmt = $this->mysqli->prepare($query);
    if ($types) { $stmt->bind_param($types, ...$params); }
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result;
  }
}


?>
