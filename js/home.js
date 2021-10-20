
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

// animate main logo on scroll
var main_logo_wrap = document.getElementById("main-logo-wrap");
var scroll_pos = (document.body.scrollTop || document.documentElement.scrollTop);
window.addEventListener('scroll', ()=> {
  scroll_pos = (document.body.scrollTop || document.documentElement.scrollTop);
  if (scroll_pos < window.innerHeight) {
    if (main_logo_wrap.classList.contains('hidden')) {
      main_logo_wrap.classList.remove('hidden');
    }
    main_logo_wrap.style.transform =
    "translate(calc(67% + "+scroll_pos+"px),calc(-50% - "+scroll_pos+"px))" +
    "rotate(" + (scroll_pos * 90 / window.innerHeight) + "deg)";
  } else {
    if (!main_logo_wrap.classList.contains('hidden')) {
      main_logo_wrap.classList.add('hidden');
    }
  }
});

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


// Featured Projects Section --------------------------------------------------
var featured = document.getElementById("featured");

// add randomly generated elements to background

// random properties
var rand_x;
var rand_y;
var rand_size;
var rand_rotation;
var rand_opacity;

// random circles
for (i=0; i<15; i++) {
  rand_span = document.createElement("span");
  rand_span.classList.add("circle");
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
  featured.insertAdjacentElement("afterbegin", rand_span);
}


// Demo Functionality ---------------------------------------------------------
var demo = document.getElementById("demo");

// random sqaures
for (i=0; i<20; i++) {
  rand_span = document.createElement("span");
  rand_span.classList.add("square");
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
  demo.insertAdjacentElement("afterbegin", rand_span);
}


// Demo Figure Playable Animation
var figure = demo.querySelector("figure");
var controls = document.getElementById("demo-controls");
var play_btn = controls.querySelector(".play");
var play_btn_text = controls.querySelector(".text");
var stop_btn = controls.querySelector(".stop");

var demo_idx = 5;
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
