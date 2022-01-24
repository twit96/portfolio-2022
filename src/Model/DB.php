<?php


class DB {
  protected $connection;  // mysqli object

  function __construct(
    $in_host=null,
    $in_username=null,
    $in_password=null,
    $in_db_name=null
  ) {

    if (
      !empty($in_host) &&
      !empty($in_username) &&
      !empty($in_password) &&
      !empty($in_db_name)
    ) {

      // Connect to MySQLi Server
      $this->connection = new mysqli(
        $in_host, $in_username, $in_password, $in_db_name
      );
      if ($this->connection->connect_errno) {
        $err_msg = 'Connect Error: '.$this->connection->connect_errno .": ";
        $err_msg .= $this->connection->connect_error;
        die($err_msg);
      }
      // Select Database
      $this->connection->select_db($in_db_name) or die($this->connection->error);

    }
  }

  /**
  * Reused code in all prepared statements.
  * $query is a string, $types is a string, and $params is an array.
  */
  function getResults($query, $types=null, $params=null) {
    $stmt = $this->connection->prepare($query);
    if ($types) { $stmt->bind_param($types, ...$params); }
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    return $result;
  }

  function close() {
    return $this->connection->close();
  }
}


?>
