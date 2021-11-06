var toc = document.getElementById("toc");
var toc_toggle = document.getElementById("toc-toggle");
var toc_bg = document.getElementById("toc-bg");
function toggleTOC() {
  toc.classList.toggle("active");
  toc_bg.classList.toggle("active");
}
toc_toggle.onclick = toggleTOC;
toc_bg.onclick = toggleTOC;

// identify all headings in the article
var article_text = document.getElementsByTagName("article")[0];
var headings;
for (i=2; i<=6; i++) {
  headings = article_text.getElementsByTagName('h'+i);
  for (j=0; j<headings.length; j++) {
    headings[j].className = 'h';
  }
}

// build TOC
var unique_ids = {};
var toc_nav = document.getElementById("toc").querySelector("nav");
headings = document.getElementsByClassName('h');

var h;
var h_id;
var h_link;
for (i=0; i<headings.length; i++) {
  // config heading id
  h = headings[i];
  h_id = h.innerHTML.split(' ').join('_').replace(/[`~!@#$%^&*()|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
  unique_ids[h_id] = (unique_ids[h_id] + 1 || 0);
  (unique_ids[h_id]==0) ? (h.id=h_id) : (h.id=h_id+"_"+unique_ids[h_id]);

  // build anchor link
  h_link = document.createElement('a');
  h_link.href = '#' + h.id;
  h_link.setAttribute('onclick','toggleTOC()');
  h_link.innerHTML = h.innerHTML;
  h_link.classList.add(h.tagName.replace("H", "h") + '-link');
  // add link to table of contents
  toc_nav.insertAdjacentElement("beforeend", h_link);
}
// remove identifying class from headings
while (headings.length > 0) {
  h = headings[0];
  h.className = h.className.replace('h', '');
}
