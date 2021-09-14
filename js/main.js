
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
var taglines = intro.getElementsByClassName("tagline");
var active_idx = 0;
var active_tag = taglines[0];
setTimeout(updateTag, 3000)

function updateTag() {
  active_tag.classList.remove("active");
  active_idx = (active_idx + 1) % taglines.length;
  active_tag = taglines[active_idx];
  active_tag.classList.add("active");
  setTimeout(function() {
    updateTag();
  }, 3000);
}

// add randomly generated elements to background
var rand_span;  // placed in #intro
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

// scroll down indicator visibility
var scroll_indicator = document.querySelector('.scroll-down-indicator');
var scroll_indicator_handler = function() {
  if (
    (document.body.scrollTop > 100) ||
    (document.documentElement.scrollTop > 100)
  ) {
    scroll_indicator.classList.add('hidden');
    window.removeEventListener('scroll', scroll_indicator_handler, false);
  }
}
window.addEventListener('scroll', scroll_indicator_handler, false);


// Demo Functionality ---------------------------------------------------------
var demo = document.getElementById("demo");

// add randomly generated elements to background

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


// Demo Figure Playable Animation
var figure = demo.querySelector("figure");
var controls = document.getElementById("demo-controls");
var play_btn = controls.querySelector(".play");
var play_btn_text = controls.querySelector(".text");
var stop_btn = controls.querySelector(".stop");

var demo_idx = 0;
var css_classes = [
  "with-css", "with-js", "with-php", "with-sql", "with-host",  // forwards
  "with-host", "with-sql", "with-php", "with-js", "with-css"   // reverse
];
var timeouts = [
  2000, 1000, 1000, 1000, 1000,  // forwards
  5000, 1000, 1000, 1000, 1000   // reverse
];

var paused = true;
var timer;

function  updateDemo() {
  if (timer) clearInterval(timer);
  (demo_idx <= 4) ? updateFigure("add") : updateFigure("remove");  // figure
  demo_idx = (demo_idx + 1) % css_classes.length;  // index
  // next step
  timer = setInterval(function() {
    if (!paused) updateDemo();
  }, timeouts[demo_idx]);
}

function updateFigure(method="add") {
  figure.classList[method](css_classes[demo_idx]);
}

function playPauseDemo() {
  play_btn.classList.toggle("play");
  play_btn.classList.toggle("pause");

  // play
  if (paused) {
    paused = false;
    play_btn_text.innerHTML = "Pause";
    stop_btn.classList.remove("disabled");
    updateDemo();

  // stop if at stopping point
  } else if (demo_idx == 5) {
    stopDemo();

  // pause if not at stopping point
  } else {
    paused = true;
    play_btn_text.innerHTML = "Play"
  }
}
play_btn.onclick = playPauseDemo;

function stopDemo() {
  if (!stop_btn.classList.contains("disabled")) {
    stop_btn.classList.add("disabled");
    for (i=0; i<css_classes.length; i++) {
      figure.classList.add(css_classes[i]);
    }
    paused = true;
    demo_idx = 5;
    play_btn_text.innerHTML = "Play"
    play_btn.classList.add("play");
    play_btn.classList.remove("pause");

  }
}
stop_btn.onclick = stopDemo;


// trigger animation when element enters window
function figureInViewport(el) {
  var top = el.offsetTop;
  var height = el.offsetHeight;

  while(el.offsetParent) {
    el = el.offsetParent;
    top += el.offsetTop;
  }

  return (
    top >= window.pageYOffset &&
    (top + (height/2)) <= (window.pageYOffset + window.innerHeight)
  );
}

var demo_handler = function() {
  if (figureInViewport(figure)) {
    playPauseDemo();
    window.removeEventListener('scroll', demo_handler, false);
  }
}
window.addEventListener('scroll', demo_handler, false);


// Projects Section -----------------------------------------------------------
var projects = document.getElementById("projects");

// random circles
for (i=0; i<20; i++) {
  rand_span = document.createElement("span");
  rand_span.classList.add("circle");
  // generate random attributes
  rand_x = Math.floor(Math.random() * 100) - 7.5;     // -7.5 to 92.5 vw
  rand_y = Math.floor(Math.random() * 85) - 15;      // 7.5 to 92.5 vh
  rand_size = Math.floor(Math.random() * 15) + 15;  	// 15 to 30 vmin
  rand_rotation = Math.floor(Math.random() * 360);  	// 0 to 360 deg
  // set CSS styles
  rand_span.style.left = rand_x + "%";
  rand_span.style.top = rand_y + "%";
  rand_span.style.width = rand_size + "vmin";
  rand_span.style.height = rand_size + "vmin";
  rand_span.style.transform = "rotate(" + rand_rotation + "deg)";
  // place on page
  projects.insertAdjacentElement("beforeend", rand_span);
}
