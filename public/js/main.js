var html = document.documentElement;
var meta_theme_color = document.querySelector('meta[name="theme-color"]');
var main = document.querySelector("main");
var loader = document.getElementById("loader");
var header = document.querySelector("header");
var header_nav = header.querySelector("nav");
var nav_toggle = document.querySelector(".nav-toggle");
var header_bg = document.getElementById("header-bg");
var dark_toggle = document.getElementById("dark-toggle-wrap");


const throttle = (func, delay) => {
  let inProgress = false;
  return (...args) => {
    if (inProgress) {
      return;
    }
    inProgress = true;
    setTimeout(() => {
      func(...args);
      inProgress = false;
    }, delay);
  }
};


// Randomly Generated Background ----------------------------------------------

// inject background element onto page
let bg = document.createElement("div");
bg.id = "bg";
document.body.insertAdjacentElement("afterbegin", bg);

// add elements to background
var rand_span;  // placed in #bg
var clone;      // placed in #loader or #header-bg

// random properties
var rand_size;
var rand_rotation;
var rand_anim_duration;
var rand_anim_delay;

function shuffle(array) {
  let curr_idx = array.length;
  let rand_idx;
  // while there are elements left to shuffle
  while (curr_idx != 0) {
    // swap random remaining element with current element
    rand_idx = Math.floor(Math.random() * curr_idx);
    curr_idx--;
    [array[curr_idx], array[rand_idx]] = [array[rand_idx], array[curr_idx]];
  }
  return array;
}
// leaves x and y use shuffled arrays of predefined values (prevents harsh overlaps)
var rand_x = shuffle([0,10,20,30,40,50,60,70,80,90]);
var rand_y = shuffle([0,10,20,30,40,50,60,70,80,90]);
// (orbs x and y are completely random though)

// random leaves
for (i=0; i<10; i++) {
  rand_span = document.createElement("span");
  rand_span.classList.add("leaf");
  // generate random attributes
  rand_size = Math.floor(Math.random() * 15) + 10;  // 10 to 25 vmin
  rand_rotation = Math.floor(Math.random() * 360);  // 0 to 360 deg
  // set CSS styles
  rand_span.style.left = rand_x[i] + "vw";
  rand_span.style.top = rand_y[i] + "vh";
  rand_span.style.width = rand_size + "vmin";
  rand_span.style.height = rand_size + "vmin";
  rand_span.style.transform = "rotate(" + rand_rotation + "deg)";
  // place on page
  bg.insertAdjacentElement("beforeend", rand_span);
  clone = rand_span.cloneNode(true);
  loader.insertAdjacentElement("beforeend", clone);
}

// random orbs
for (i=0; i<30; i++) {
  rand_span = document.createElement("span");
  rand_span.classList.add("orb");
  // generate random attributes
  rand_x = Math.floor(Math.random() * 100);                   // 0 to 100 vw
  rand_y = Math.floor(Math.random() * 100);                   // 0 to 100 vh
  rand_size = (Math.random() * 1.5) + 0.5;                    // 0.5 to 2 vmin
  rand_anim_duration = (Math.random() * 3) + 3;               // 3 to 6 s
  rand_anim_delay = Math.random() * rand_anim_duration * -1;  // 0 to -rand_anim_duration s
  // set CSS styles
  rand_span.style.left = rand_x + "vw";
  rand_span.style.top = rand_y + "vh";
  rand_span.style.width = rand_size + "vmin";
  rand_span.style.height = rand_size + "vmin";
  rand_span.style.animationDuration = rand_anim_duration + "s";
  rand_span.style.animationDelay = rand_anim_delay + "s";
  // place on page
  bg.insertAdjacentElement("beforeend", rand_span);
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


// Dark Mode Toggle Functionality ---------------------------------------------

// toggle light/dark mode functionality
var slider = document.querySelector("#dark-toggle-wrap .slider");

slider.onclick = function(e) {
  updateCookie();
}

function setCookie(c_value) {
  const d = new Date();
  d.setTime(d.getTime() + (365*24*60*60*1000));
  let expires = "expires="+ d.toUTCString();
  document.cookie = "dark_mode" + "=" + c_value + ";" + expires + ";path=/;SameSite=None;Secure";
}
function getCookie() {
  decoded_cookie = decodeURIComponent(document.cookie);
  let ca = decoded_cookie.split(';');
  for (let i=0; i<ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') { c = c.substring(1); }
    if (c.indexOf("dark_mode=") == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
function updateCookie() {
  var dark_mode = getCookie();
  // not set yet
  if (dark_mode == "") { setCookie("on"); }
  // toggled to dark
  else if (dark_mode == "dark_mode=off") { setCookie("on"); }
  // toggled to light
  else { setCookie("off"); }
  configColorScheme();
}

function configColorScheme() {
  var dark_mode = getCookie();
  if (
    (dark_mode == "dark_mode=on") &&
    (!html.classList.contains('dark-mode'))
  ) { html.classList.toggle("dark-mode"); }
  if (
    (dark_mode == "dark_mode=off") &&
    (html.classList.contains('dark-mode'))
  ) { html.classList.toggle("dark-mode"); }
  configMetaThemeColor();
}
configColorScheme();


function configMetaThemeColor() {
  var theme_color = '#06632c';  // default
  var header_active = header_nav.classList.contains("active");

  // dark mode
  if (html.classList.contains('dark-mode')) {
    (header_active) ? theme_color='#0c4d79' : theme_color='#022e13';
  // light mode
  } else {
    (header_active) ? theme_color='#148bdb' : theme_color='#06632c';
  }

  if (meta_theme_color.content != theme_color) {
    meta_theme_color.setAttribute('content', theme_color);
  }
}


// Header Functionality -------------------------------------------------------

/**
* Function to toggle the navigation menu and its components.
* Called by nav-toggle and header-bg click events.
*/
function toggleNav(e) {
  nav_toggle.classList.toggle("active");
  header_nav.classList.toggle("active");
  header_bg.classList.toggle("active");
  configMetaThemeColor();
}

nav_toggle.onclick = toggleNav;
header_bg.onclick = toggleNav;


/**
* Function to toggle the header between its initial state (on page load) and its
* filled state (after scrolling down). Called by window scroll event listener
* (scroll event handlers combined at bottom of main.js).
*/
function toggleHeaderState() {
  header.classList.toggle("filled");
}


/**
* Ensure that nav maintains proper state if user resizes while nav is active.
* Note: 1000px is large screen header breakpoint.
*/
const resizeHandler = throttle(() => {
  if (
    (window.innerWidth > 1000) &&
    (header_bg.classList.contains("active"))
  ) { toggleNav(); }
}, 200);
window.addEventListener('resize', resizeHandler, false);



// Scroll Down Indicator ------------------------------------------------------
var scroll_down_indicator = document.getElementById("scroll-down-indicator");

// toggle event listeners
var triggered_scroll_down_indicator_listeners = false;
function triggerScrollDownIndicatorListeners() {
  triggered_scroll_down_indicator_listeners = true;
  scroll_down_indicator.classList.add('hidden');
  scroll_down_indicator.removeEventListener('click', click_scroll_down_indicator_handler, false);
}

// click listener
var click_scroll_down_indicator_handler = function() {
  window.scroll({
    top: document.documentElement.clientHeight * 0.75,
    left: 0,
    behavior: 'smooth'
  });
  triggerScrollDownIndicatorListeners();
}
scroll_down_indicator.addEventListener(
  'click', click_scroll_down_indicator_handler, false
);


// Scroll Top Btn -------------------------------------------------------------
var scroll_top_btn = document.getElementById("scroll-top-btn");

// scroll position changes visibility
var scroll_top_trigger_height = document.documentElement.clientHeight * 0.75;
function toggleScrollTopBtn() {
  scroll_top_btn.classList.toggle('displayed');
}


// click functionality
var click_scroll_top_handler = function() {
  if (scroll_top_btn.classList.contains('displayed')) {
    window.scroll({
      top: 0,
      left: 0,
      behavior: 'smooth'
    });
  }
}
scroll_top_btn.addEventListener('click', click_scroll_top_handler, false);


// Throttle Scroll Event Listeners --------------------------------------------
function getScrollPos() {
  return (window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop);
}
var scroll_pos = getScrollPos();


const scrollHandler = throttle(() => {
  scroll_pos = getScrollPos();
  // Manage Header State
  if (
    ((scroll_pos > 0) && (!header.classList.contains("filled"))) ||
    ((scroll_pos <= 0) && (header.classList.contains("filled")))
  ) { toggleHeaderState(); }

  // Manage Scroll Down Indicator State
  if ((!triggered_scroll_down_indicator_listeners) && (scroll_pos > 100)) {
    triggerScrollDownIndicatorListeners();
  }

  // Manage Scroll Top Btn State
  if (
    ((scroll_pos > scroll_top_trigger_height) && (!scroll_top_btn.classList.contains("displayed"))) ||
    ((scroll_pos <= scroll_top_trigger_height) && (scroll_top_btn.classList.contains("displayed")))
  ) {
    toggleScrollTopBtn();
  }
}, 100);

window.addEventListener('scroll', scrollHandler, false);
