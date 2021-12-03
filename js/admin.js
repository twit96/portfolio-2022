// called by PHP when table loads


var this_cell;
var this_submit;
function handleCheck(e) {
  this_cell = e.target.parentNode;
  this_submit = this_cell.querySelectorAll("input[type='submit']")[0];
  this_submit.classList.toggle("active");
  if (e.target.checked) {
    this_submit.value = "Delete";
  } else {
    this_submit.value = "Update";
  }
}


function addCheckboxListeners(parent) {
  var checkboxes = parent.querySelectorAll("input[type='checkbox']");
  for (var i=0; i<checkboxes.length; i++) {
    checkboxes[i].addEventListener("click", handleCheck);
  }
}


addCheckboxListeners(document.getElementById("edit-projects"));
// addCheckboxListeners(document.getElementById("edit-posts"));
