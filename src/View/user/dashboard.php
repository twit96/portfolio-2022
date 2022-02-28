<?php


/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


function doLogout() {
  session_start();
  $_SESSION = array();
  session_destroy();
  header('Location: '.$_SERVER['PHP_SELF']);
  die;
}


function doDashboard() {
  echo <<<DASHBOARD
    <h2>Dashboard</h2>
    <section id="dashboard">
      <h2>Dashboard</h2>
      <div class="flex">
        <form method="POST" action="admin">
          <input type="submit" value="Logout" />
        </form>
        <p>
          This is the dashboard.
        </p>
      </div>
    </section>
  DASHBOARD;
  echo '';
}


function doEngine() {
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_POST = array();
    doLogout();
  }
  doLoginForm();
}
doEngine();


?>
