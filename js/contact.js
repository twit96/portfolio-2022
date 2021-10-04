/* contact_form.js */


/**
* Function to provide name feedback on form value by changing the style of the
* form input fields. No return value.
*/
function doFormFeedback(name, email, subject, message) {
  // Form Styles Feedback (quick and dirty code)
  if (name == '') {
    document.getElementById('name').style.border = "1px solid red";
  } else { document.getElementById('name').style.border = "1px solid #4f4f4f"; }

  if (email == '') {
    document.getElementById('email').style.border = "1px solid red";
  } else { document.getElementById('email').style.border = "1px solid #4f4f4f"; }

  if (subject == '') {
    document.getElementById('subject').style.border = "1px solid red";
  } else { document.getElementById('subject').style.border = "1px solid #4f4f4f"; }

  if (message == '') {
    document.getElementById('message').style.border = "1px solid red";
  } else { document.getElementById('message').style.border = "1px solid #4f4f4f"; }

  // Reset Form if Successful Submit
  if (!((name == '') || (email == '') || (subject == '') || (message == ''))) {
    document.getElementById("contact-form").reset();
  }
}


/**
* Function to reset any form styles previously set by doFormFeedback().
* Called on form reset button click. No return value.
*/
function resetForm() {
  // resest ajax text
  document.getElementById('ajax_container').innerHTML = "If you have feedback or questions about the dungeon, send us a direct message here!";
  // reset form styles
  document.getElementById('name').style.border = "1px solid #4f4f4f";
  document.getElementById('email').style.border = "1px solid #4f4f4f";
  document.getElementById('subject').style.border = "1px solid #4f4f4f";
  document.getElementById('message').style.border = "1px solid #4f4f4f";
}


/**
* Function to work as engine for this script. Called on form submit button
* click. Configures browser support for ajax functionality, pulls form values,
* calls doFormFeedback() for JavaScript validation, and passes form values into
* contact_form.php for PHP processing. No return value.
*/
function ajaxFunction() {

  // Ajax Config
  var ajaxRequest;
  ajaxRequest = new XMLHttpRequest();
  ajaxRequest.onreadystatechange = function() {
    if (ajaxRequest.readyState == 4) {
      var ajaxDisplay = document.getElementById('ajax_container');
      ajaxDisplay.innerHTML = ajaxRequest.responseText;
    }
  }

  // Pull Form Values
  var name = document.getElementById('name').value;
  var email = document.getElementById('email').value;
  var subject = document.getElementById('subject').value;
  var message = document.getElementById('message').value;

  // Provide UI Feedback on Form Values
  doFormFeedback(name, email, subject, message);

  // Build and Send Ajax String
  var queryString = "?name=" + name ;
  queryString +=  "&email=" + email;
  queryString +=  "&subject=" + subject;
  queryString +=  "&message=" + message;
  ajaxRequest.open("GET", "../php/contact_form.php" + queryString, true);
  ajaxRequest.send(null);

}


// map stuff ------------------------------------------------------------------
mapboxgl.accessToken = 'pk.eyJ1IjoidHlsZXJ3aXR0aWciLCJhIjoiY2t1Y3dkZG5vMTRqMDJxbWFvdHdkNjN6dSJ9.xX7asGY6YOfLrfGiXTHKIw';
var map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/streets-v11',
  center: [-95.9, 29.2552],
  zoom: 8
});
// Set marker options.
const marker = new mapboxgl.Marker({
  color: "#ff0022",
}).setLngLat([-95.9, 29.2552])
.addTo(map);
