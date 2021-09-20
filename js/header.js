
// Loader Functionality -------------------------------------------------------
var loader = document.getElementById("loader");
setTimeout(function() {
  loader.style.opacity = '0';
}, 100);
setTimeout(function() {
  loader.style.display = 'none';
}, 1100);



// Header Functionality -------------------------------------------------------
var header = document.querySelector("header");
var header_nav = header.querySelector("nav");
var header_bg = document.getElementById("header-bg");

var nav_toggle = document.querySelector(".nav-toggle");
nav_toggle.onclick = function() {
  nav_toggle.classList.toggle("active");
  header_nav.classList.toggle("active");
  header_bg.classList.toggle("active");
}
header_bg.onclick = function() {
  nav_toggle.classList.toggle("active");
  header_nav.classList.toggle("active");
  header_bg.classList.toggle("active");
}

window.onscroll = function() {
  if (
    (document.body.scrollTop > 0) ||
    (document.documentElement.scrollTop > 0)
  ) { header.classList.add("filled"); }
  else { header.classList.remove("filled"); }
};
