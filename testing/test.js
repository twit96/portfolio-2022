/*
TEMP: ignoring in Git
- function to generate any set of elements with any set of randomly generated
  properties. Currently works with leaf class and bug class, but bug class
  required patch code. Goal: make this work for ALL CSS properties.

Last Edited: 2021/07/21
*/


/*
  function to generate n spans of the class "span_class", with the
  random properties specified by the dictionary "attr" as follows:

  var props = {
    "prop": [
      lower_bound,
      upper_bound,
      "css unit",
      "other spec (optional)"
    ]
  };

  ...so that each key is the name of the css proprty to be randomized,
  and each value is an array specifying a lower bound, an upper bound,
  the css unit, and the transform property if needed.
  For example:

  var props = {
    "left": [0, 100, "vw"],
    "width height ": [10, 25, "vmin"],
    "transform": [0, 360, "deg)", "rotate("]
  };

  ...gives us:
  a random left value from 0 to 100 vw,
  a random width and height set to the same value from 10 to 25 vmin,
  and a random transform: rotate from 0 to 360 deg.
*/
function generateRandomSpans(n, span_class, props, parent) {
  var rand_span;
  for (var i=0; i<n; i++) {
    rand_span = document.createElement("span");
    rand_span.classList.add(span_class);
    // iterate through all properties to be randomized
    for (var prop in props) {
      var constraints = props[prop];
      var lbound = constraints[0];
      var ubound = constraints[1];
      var unit = "";
      var specs = "";
      if (constraints.length > 2) { unit = constraints[2]; }
      if (constraints.length > 3) { specs = constraints[3]; }
      // generate random val
      var rand_val = (Math.random() * (ubound - lbound)) + lbound;
      var formatted_val = specs + rand_val + unit;
      // set all specified properties at the random val
      var properties = prop.trim().split(/\s+/);
      for (var j=0; j<properties.length; j++) {
        var property = properties[j];
        rand_span.style[property] = formatted_val;
      }
    }
    // insert into end of parent element
    parent.insertAdjacentElement("beforeend", rand_span);
    var clone = rand_span.cloneNode(true);
    loader.insertAdjacentElement("beforeend", clone);

  }
}


generateRandomSpans(
  n = 30,
  span_class = "leaf",
  props = {
    "left": [0, 100, "vw"],
    "top": [0, 100, "vh"],
    "width height": [10, 25, "vmin"],
    "transform": [0, 360, "deg)", "rotate("]
  },
  parent = intro
);

generateRandomSpans(
  n = 30,
  span_class = "bug",
  props = {
    "left": [0, 100, "vw"],
    "top": [0, 100, "vh"],
    "width height": [1, 3, "vmin"],
    "animationDelay": [0, -5, "s"]
  },
  parent = intro
);

/*
  add filter: blur() CSS property to each bug,
  set to 1/2 the dimension of the bug
*/
var bugs = document.getElementsByClassName("bug");
for (var i=0; i<bugs.length; i++) {
  var bug = bugs.item(i);
  var size = (bug.style.width).replace("vmin", "");
  bug.style.filter = "blur(" + (size / 2) + "vmin";
}
