<?php


/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


require_once (__DIR__ .'/../../Model/Login.php');


/**
* Admin Page Login Area
*/
function doLoginForm() {
  echo <<<LOGIN
  <section id="login">
    <h2>Login</h2>
    <div class="flex">
      <form method="POST" action="user">
        <label>
          <input name="username" type="text" required />
          <span>Username</span>
        </label>
        <label>
          <input name="password" type="password" required />
          <span>Password</span>
        </label>
        <p>
          <input type="submit" value="Login" />
          <input type="reset" value="Clear" />
        </p>
      </form>
      <p>
        The place where super duper top secret things definitely do not occur...
      </p>
    </div>
  </section>
LOGIN;
}


function doEngine() {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = new Login($db);
    if ($login->valid_login) {
      header('Location: '.$_SERVER['PHP_SELF']);
      die;
    }
  }
  doLoginForm();
}
doEngine();


?>
