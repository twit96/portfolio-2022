var card = document.querySelector("section");


// ---------------------------------------------- Randomly Generated Background
function generateBg() {
  var rand_span;  // placed in body
  var clone;      // placed in #loader and #header-bg

  // random properties
  var rand_x;
  var rand_y;
  var rand_size;
  var rand_rotation;
  var rand_anim_duration;
  var rand_anim_delay;

  // random leaves
  for (i=0; i<15; i++) {
    rand_span = document.createElement("span");
    rand_span.classList.add("leaf");
    // generate random attributes
    if (card.id == "back") { rand_x = (Math.random() * 2.5) + 1; }  // 1 to 3.5 in
    else if (card.id == "front") { rand_x = (Math.random() * 2); }  // 0 to 3.5 in
    rand_y = Math.random() * 2;             // 0 to 2 in
    rand_size = (Math.random() * 0.3) + 0.2;  // 0.2 to 0.5 in
    rand_rotation = Math.floor(Math.random() * 360);    // 0 to 360 deg
    // set CSS styles
    rand_span.style.left = rand_x + "in";
    rand_span.style.top = rand_y + "in";
    rand_span.style.width = rand_size + "in";
    rand_span.style.height = rand_size + "in";
    rand_span.style.transform = "rotate(" + rand_rotation + "deg)";
    // place on page
    card.insertAdjacentElement("beforeend", rand_span);
  }

  // random orbs
  for (i=0; i<30; i++) {
    rand_span = document.createElement("span");
    rand_span.classList.add("orb");
    // generate random attributes
    rand_x = Math.random() * 3.5;                   // 0 to 3.5 in
    if (card.id == "back") { rand_x =  Math.random() * 3.5; }  // 1 to 3.5 in
    else if (card.id == "front") { rand_x =  Math.random() * 2.5; }  // 0 to 3.5 in
    rand_y = Math.random() * 2;                     // 0 to 2 in
    rand_size = (Math.random() * 0.03) + 0.01;                  // 0.01 to 0.04 in
    rand_anim_duration = (Math.random() * 3) + 3;               // 3 to 6 s
    rand_anim_delay = Math.random() * rand_anim_duration * -1;  // 0 to -rand_anim_duration s
    // set CSS styles
    rand_span.style.left = rand_x + "in";
    rand_span.style.top = rand_y + "in";
    rand_span.style.width = rand_size + "in";
    rand_span.style.height = rand_size + "in";
    rand_span.style.animationDuration = rand_anim_duration + "s";
    rand_span.style.animationDelay = rand_anim_delay + "s";
    // place on page
    card.insertAdjacentElement("beforeend", rand_span);
  }
}
generateBg();

function removeElementsByClassName(className) {
  const elements = document.getElementsByClassName(className);
  while (elements.length > 0) {
    elements[0].parentNode.removeChild(elements[0]);
  }
}
function destroyBg() {
  removeElementsByClassName('leaf');
  removeElementsByClassName('orb');
}


// ------------------------------------------------------------- Season Buttons
var html = document.documentElement;
var body = document.body;
// create link to flip card over
function createFlipCardLink() {
  var link = document.createElement("a");
  link.id = "flip-card";
  if (card.id == "front") {
    link.href = "back.php";
    link.innerHTML = "Go to Back";
  } else {
    link.href = "front.php";
    link.innerHTML = "Go to Front";
  }
  return link;
}
// create button to toggle to a season style
function createSeasonBtn(season) {
  var btn = document.createElement("button");
  if (season == "") {
    btn.textContent = "default"
  } else {
    btn.textContent = season
    btn.classList.add(season);
  }
  btn.onclick = function() { html.classList.value = this.classList[0]; }
  return btn;
}
// create button to toggle background (back of card only)
function createBgToggleBtn() {
  var btn = document.createElement("button");
  btn.textContent = "Toggle BG"
  btn.classList.add("bg-toggle");
  btn.onclick = function() {
    body.classList.toggle("no-bg");
    body.classList.contains("no-bg") ? destroyBg() : generateBg();

  }
  return btn;
}
// generate all controls
function generateControls() {
  const flip_card_link = createFlipCardLink();
  html.insertAdjacentElement("beforeend", flip_card_link);
  var btns = document.createElement("div");
  btns.classList.add("buttons");
  const summer_btn = createSeasonBtn("");
  const autumn_btn = createSeasonBtn("autumn");
  const winter_btn = createSeasonBtn("winter");
  btns.insertAdjacentElement("beforeend", summer_btn);
  btns.insertAdjacentElement("beforeend", autumn_btn);
  btns.insertAdjacentElement("beforeend", winter_btn);
  if (card.id == "back") {
    const toggle_btn = createBgToggleBtn();
    btns.insertAdjacentElement("beforeend", toggle_btn);
  }
  html.insertAdjacentElement("beforeend", btns);
}
generateControls();
