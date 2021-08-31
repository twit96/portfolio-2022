
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

var nav_toggle = document.querySelector(".nav-toggle");
var header_bg = document.getElementById("header-bg");


function toggleNav() {
  nav_toggle.classList.toggle("active");
  header_nav.classList.toggle("active");
  header_bg.classList.toggle("active");
}
nav_toggle.onclick = toggleNav;
// header_bg.onclick = toggleNav;


function toggleNavBg() {
  if (
    (document.body.scrollTop > 0) ||
    (document.documentElement.scrollTop > 0)
  ) { header.classList.add("filled"); }
  else { header.classList.remove("filled"); }
}
window.onscroll = function() {
  window.requestAnimationFrame(toggleNavBg);
};


// Intro Functionality --------------------------------------------------------
var intro = document.getElementById("intro");

// swap main logo image with full resolution image once it loads
var main_logo = document.getElementById("main-logo");
main_logo.classList.add("blurred");
var logo_lg = document.createElement("img");
logo_lg.src = "/img/icon_lg.png";
logo_lg.onload = function() {
  main_logo.src = "/img/icon_lg.png";
  main_logo.classList.remove("blurred");
}

// cycle through taglines
// var taglines = intro.getElementsByClassName("tagline");
// var active_idx = 0;
// var active_tag = taglines[0];
// setTimeout(function() {
//   window.requestAnimationFrame(updateTag);
// }, 3000);
//
// function updateTag() {
//   active_tag.classList.remove("active");
//   active_idx = (active_idx + 1) % taglines.length;
//   active_tag = taglines[active_idx];
//   active_tag.classList.add("active");
//   setTimeout(function() {
//     window.requestAnimationFrame(updateTag);
//   }, 3000);
// }

// add randomly generated elements to background
var rand_span;  // placed in #intro
var clone;      // placed in #header-bg

// random properties
var rand_x;
var rand_y;
var rand_size;
var rand_rotation;
var rand_opacity;

// random leaves
for (i=0; i<30; i++) {
  rand_span = document.createElement("span");
  rand_span.classList.add("leaf");
  // generate random attributes
  rand_x = Math.floor(Math.random() * 100);         // 0 to 100 vw
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
  rand_opacity = (Math.random() * 0.75) + 0.25;	    // 0.15 to 1
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
  header_bg.insertAdjacentElement("beforeend", clone);
}


// Demo Functionality ---------------------------------------------------------
var demo = document.getElementById("demo");

// add randomly generated elements to background
var rand_span;  // placed in #intro

// random properties
var rand_x;
var rand_y;
var rand_size;
var rand_rotation;
var rand_opacity;

// random squares
for (i=0; i<15; i++) {
  rand_span = document.createElement("span");
  rand_span.classList.add("square");
  // generate random attributes
  rand_x = Math.floor(Math.random() * 100) - 7.5;     // -7.5 to 92.5 vw
  rand_y = Math.floor(Math.random() * 85) + 7.5;      // 7.5 to 92.5 vh
  rand_size = Math.floor(Math.random() * 15) + 15;  	// 15 to 30 vmin
  rand_rotation = Math.floor(Math.random() * 360);  	// 0 to 360 deg
  // set CSS styles
  rand_span.style.left = rand_x + "%";
  rand_span.style.top = rand_y + "%";
  rand_span.style.width = rand_size + "vmin";
  rand_span.style.height = rand_size + "vmin";
  rand_span.style.transform = "rotate(" + rand_rotation + "deg)";
  // place on page
  demo.insertAdjacentElement("beforeend", rand_span);
}


// var figure = demo.querySelector("figure");
//
// function toggleDemoCSS() { figure.classList.toggle("with-css"); }
// function toggleDemoJS() { figure.classList.toggle("with-js"); }
// function toggleDemoPHP() { figure.classList.toggle("with-php"); }
// function toggleDemoSQL() { figure.classList.toggle("with-sql"); }
// function toggleDemoHost() { figure.classList.toggle("with-host"); }
//
// function demoForwards() {
//   window.requestAnimationFrame(toggleDemoCSS);
//   setTimeout(function() {
//     window.requestAnimationFrame(toggleDemoJS);
//     setTimeout(function() {
//       window.requestAnimationFrame(toggleDemoPHP);
//       setTimeout(function() {
//         window.requestAnimationFrame(toggleDemoSQL);
//         setTimeout(function() {
//           window.requestAnimationFrame(toggleDemoHost);
//           setTimeout(function() {
//             window.requestAnimationFrame(demoReverse);
//           }, 5000);
//         }, 1000);
//       }, 1000);
//     }, 1000);
//   }, 1000);
// }
// function demoReverse() {
//   window.requestAnimationFrame(toggleDemoHost);
//   setTimeout(function() {
//     window.requestAnimationFrame(toggleDemoSQL);
//     setTimeout(function() {
//       window.requestAnimationFrame(toggleDemoPHP);
//       setTimeout(function() {
//         window.requestAnimationFrame(toggleDemoJS);
//         setTimeout(function() {
//           window.requestAnimationFrame(toggleDemoCSS);
//           setTimeout(function() {
//             window.requestAnimationFrame(demoForwards);
//           }, 2000);
//         }, 1000);
//       }, 1000);
//     }, 1000);
//   }, 1000);
// }

// function figureInViewport(el) {
//   var top = el.offsetTop;
//   var height = el.offsetHeight;
//
//   while (el.offsetParent) {
//     el = el.offsetParent;
//     top += el.offsetTop;
//   }
//
//   return (
//     top >= window.pageYOffset &&
//     (top + (height/2)) <= (window.pageYOffset + window.innerHeight)
//   );
// }
//
// var firing_handler = function() {
//   if (figureInViewport(figure)) {
//     demoForwards();
//     window.removeEventListener('scroll', firing_handler, false);
//   }
// }
// window.addEventListener('scroll', firing_handler, false);
