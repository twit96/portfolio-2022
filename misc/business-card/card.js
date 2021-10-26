var card = document.querySelector("section");
console.log(card.id);

// Add Randomly Generated Elements to Background ------------------------------
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
