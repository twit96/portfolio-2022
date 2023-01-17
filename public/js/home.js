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
