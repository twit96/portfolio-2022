<?php


function generateNumLink($page, $curr_page) {
  if ($page == $curr_page) {
    echo '<span class="active">'.$page.'</span>';
  } else {
    echo '<a href="./'.$page.'">'.$page.'</a>';
  }
}


function generateNumLinks($curr_page, $total_pages) {
  if ($total_pages <= 7) {
    // all page links will fit on indicator
    for ($p=1; $p<=$total_pages; $p++) {
      generateNumLink($p, $curr_page);
    }

  } else {
    // some page links won't fit on indicator - must format them

    // Slot 1
    generateNumLink(1, $curr_page);

    // Slot 2
    if ($curr_page <= 4) {
      echo '<a href="./2">2</a>';
    } else {
      echo '<span>...</span>';
    }

    // Slots 3, 4, and 5
    if ($curr_page <= 4) {
      // curr_page at beginning
      for ($p=3; $p<=5; $p++) {
        generateNumLink($p, $curr_page);
      }
    } else if ($total_pages - $curr_page < 4) {
      // curr_page at end
      for ($p=$total_pages-4; $p<=$total_pages-2; $p++) {
        generateNumLink($p, $curr_page);
      }
    } else {
      // curr_page in middle
      for ($p=$curr_page-1; $p<=$curr_page+1; $p++) {
        generateNumLink($p, $curr_page);
      }
    }

    // Slot 6
    if ($total_pages - $curr_page < 4) {
      $p = $total_pages - 1;
      echo '<a href="./'.$p.'">'.$p.'</a>';
    } else {
      echo '<span>...</span>';
    }

    // Slot 7
    generateNumLink($total_pages, $curr_page);
  }
}


function getPage() {
  $curr_page = 1;

  // Check URL "page" Paramater
  if (isset($_GET["page"])) {                    // is set
    $url_num = htmlspecialchars($_GET["page"]);  // initial sanitize
    if (
      (is_numeric($url_num)) &&                  // is number
      ($url_num >= 1) &&                         // is at least 1
      ($url_num <= $total_pages)                 // is not beyond last page
    ) {
      $url_num = (int) $url_num;                 // SUCCESS - cast num to int
    } else {
      $url_num = 1;                              // FAILURES - set num to 1
    }
    $curr_page = $url_num;
  }

  return $curr_page;
}


function buildIndicator($total_pages) {
  $curr_page = getPage();

  // Indicator Opening HTML
  echo <<<ELEM_TOP
  <div class=" wrapper page-links-wrap">
    <nav class="page-links">
  ELEM_TOP;

  // Previous Link
  if ($curr_page > 1) {
    $prev_page = $curr_page - 1;
    echo '<a class="end-link prev-link" href="./'.$prev_page.'">Previous</a>';
  }

  // Numerical Links
  generateNumLinks($curr_page, $total_pages);

  // Next Link
  if ($curr_page < $total_pages) {
    $next_page = $curr_page + 1;
    echo '<a class="end-link next-link" href="./'.$next_page.'">Next</a>';
  }

  // Indicator Closing HTML
  echo <<<ELEM_BTM
    </nav>
  </div>
  ELEM_BTM;
}


// only do things if $num_pages variable is set
echo '<script>alert("Here.");</script>';
if (isset($total_pages)) {
  buildIndicator($total_pages);
}


?>
