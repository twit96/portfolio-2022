<?php


/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");


/**
* Function to format user inputs into an email, and send that email.
* No return value.
*/
function sendEmail($name, $email, $subject, $message) {
  $to = "tylerwittig@utexas.edu";
  $subject = "Portfolio: ".$subject;
  $txt = "Name: " . $name . "\n\n";
  $txt .= $message;
  $txt = wordwrap($txt, 100);
  $headers = "From: $email";
  // send email
  mail($to,$subject,$txt,$headers);
}


/**
* Function to build return string based off of user inputs.
* Ensures name is in database and email is valid, calls sendEmail() if
* inputs are valid, and returns $return_string.
*/
function buildReturnString($name, $email, $subject, $message) {
  $return_string = '';

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // email is invalid
    $return_string .= '"'.$email.'" is not a valid email address.<br />';
  }

  if (($name == '') || ($subject == '') || ($message == '')) {
    // subject or message is empty
    $return_string .= "The name, subject, and message fields cannot be empty.<br />";
  }

  if ($return_string == '') {
    // inputs passed the above checks - return_string still empty
    $return_string .= "Email sent! ";
    // send message email
    sendEmail($name, $email, $subject, $message);
  }

  return $return_string;
}


/**
* Function to configure required inputs for the above functions.
* Checks database connection, handles user inputs, then calls buildReturnString().
*/
function doEngine() {

  // Retrieve data from Query String
  $name = $_GET['name'];
  $email = $_GET['email'];
  $subject = $_GET['subject'];
  $message = $_GET['message'];

  // Build Return String
  $return_string = buildReturnString($name, $email, $subject, $message);

  // Display Return String
  echo $return_string;
}


/**
* Initial call to start script.
*/
doEngine();


?>
