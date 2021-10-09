

var this_cell;
var this_submit;
function handleCheck(e) {
  this_cell = e.target.parentNode.parentNode;
  this_submit = this_cell.querySelectorAll("input[type='submit']")[0];
  if (e.target.checked) {
    this_submit.value = "Delete";
    this_cell.style.background = "var(--red)";
  } else {
    this_submit.value = "Update";
    this_cell.style.background = "var(--blue-shadow)";
  }
}

// called by PHP when table loads
function addCheckboxListeners() {
  var projects_table = document.getElementById("projects-table");
  var checkboxes = projects_table.querySelectorAll("input[type='checkbox']");

  for (var i=0; i<checkboxes.length; i++) {
    checkboxes[i].addEventListener("click", handleCheck);
  }
}
