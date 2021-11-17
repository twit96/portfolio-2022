
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

// called by PHP when table loads
function addCheckboxListeners() {
  var edit_projects = document.getElementById("edit-projects");
  var checkboxes = edit_projects.querySelectorAll("input[type='checkbox']");

  for (var i=0; i<checkboxes.length; i++) {
    checkboxes[i].addEventListener("click", handleCheck);
  }
}

addCheckboxListeners();
