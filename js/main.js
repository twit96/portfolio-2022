var intro = document.querySelector("section");
var loader = document.getElementById("loader");
var header = document.querySelector("header");
var header_nav = header.querySelector("nav");
var header_bg = document.getElementById("header-bg");

// Add Randomly Generated Elements to Background ------------------------------
var rand_span;  // placed in body
var clone;      // placed in #loader and #header-bg

// random properties
var rand_x;
var rand_y;
var rand_size;
var rand_rotation;
var rand_opacity;

// random leaves
for (i=0; i<15; i++) {
  rand_span = document.createElement("span");
  rand_span.classList.add("leaf");
  // generate random attributes
  rand_x = Math.floor(Math.random() * 60);          // 0 to 60 vw
  rand_y = Math.floor(Math.random() * 100);         // 0 to 100 vh
  rand_size = Math.floor(Math.random() * 15) + 10;  // 10 to 25 vmin
  rand_rotation = Math.floor(Math.random() * 360);  // 0 to 360 deg
  // set CSS styles
  rand_span.style.left = rand_x + "vw";
  rand_span.style.top = rand_y + "vh";
  rand_span.style.width = rand_size + "vmin";
  rand_span.style.height = rand_size + "vmin";
  rand_span.style.transform = "rotate(" + rand_rotation + "deg)";
  // place on page
  intro.insertAdjacentElement("beforeend", rand_span);
  clone = rand_span.cloneNode(true);
  loader.insertAdjacentElement("beforeend", clone);
}

// random orbs
for (i=0; i<30; i++) {
  rand_span = document.createElement("span");
  rand_span.classList.add("orb");
  // generate random attributes
  rand_x = Math.floor(Math.random() * 100);         // 0 to 100 vw
  rand_y = Math.floor(Math.random() * 100);         // 0 to 100 vh
  rand_size = Math.floor(Math.random() * 2) + 1;    // 1 to 2 vmin
  rand_opacity = (Math.random() * 0.75) + 0.25;	    // 0.25 to 1
  // set CSS styles
  rand_span.style.left = rand_x + "vw";
  rand_span.style.top = rand_y + "vh";
  rand_span.style.width = rand_size + "vmin";
  rand_span.style.height = rand_size + "vmin";
  rand_span.style.filter = "blur(" + (rand_size / 2) + "vmin)";
  rand_span.style.opacity = rand_opacity;
  // place on page
  intro.insertAdjacentElement("beforeend", rand_span);
  clone = rand_span.cloneNode(true);
  loader.insertAdjacentElement("beforeend", clone);
  clone = rand_span.cloneNode(true);
  header_bg.insertAdjacentElement("beforeend", clone);
}


// Loader Functionality -------------------------------------------------------
setTimeout(function() {
  loader.style.opacity = '0';
}, 100);
setTimeout(function() {
  loader.style.display = 'none';
}, 1100);


// Header Functionality -------------------------------------------------------
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
