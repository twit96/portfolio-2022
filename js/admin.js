// called by PHP when table loads


Date.prototype.toDateInputValue = (function() {
    var local = new Date(this);
    local.setMinutes(this.getMinutes() - this.getTimezoneOffset());
    return local.toJSON().slice(0,10);
});

var todays_date = new Date().toDateInputValue();

var today_date_inputs = document.querySelectorAll(".date-today");
for (var i=0; i<today_date_inputs.length; i++) {
  today_date_inputs[i].value = todays_date;
}


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
addCheckboxListeners(document.getElementById("edit-posts"));
