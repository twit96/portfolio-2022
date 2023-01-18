// Intro Functionality --------------------------------------------------------
var intro = document.getElementById("intro");

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
