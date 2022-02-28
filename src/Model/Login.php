<?php


class Login {
  private $username;
  private $password;
  public $error = '';
  public $valid_login = false;

  function __construct($db) {
    if (
      (isset($_POST["username"])) &&
      (isset($_POST["password"]))
    ) {
      $this->getLoginPost();
      if (!$this->hasErrors()) checkLogin($db);
      if ($this->valid_login) doLogin();
    }
  }

  private function getLoginPost() {
    $this->username = htmlspecialchars($_POST["username"]);
    $this->password = htmlspecialchars($_POST["password"]);
    unset($_POST["username"]);
    unset($_POST["password"]);
    $_POST = array();
  }

  private function hasErrors() {
    // ensure all fields are not empty
    if (empty(trim($this->username))) {
      $this->error .= "Please enter username. ";
    }
    if (empty(trim($this->password))) {
      $this->error .= "Please enter your password. ";
    }
    ($this->error == '') ? return false : return true;
  }

  private function checkLogin($db) {
    // check db for valid login
    $result = $db->getResults(
      "SELECT COUNT(1) FROM people WHERE username=? AND password=? AND (role='admin' OR role='author')",
      "ss",
      array($username, $password)
    );
    $this->valid_login = ($result->fetch_row()[0] === 1);
    if (!$this->valid_login) {
      $this->error .= "Login failed. Please try again. ";
    }
  }

  private function doLogin() {
    session_start();
    // Store data in session variables
    $_SESSION["loggedin"] = true;
    $_SESSION["id"] = $id;
    $_SESSION["username"] = $this->username;
  }

}


?>
