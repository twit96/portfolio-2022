<?php


class PageIndicator {
  protected $total_pages;
  protected $curr_page;
  protected $posts_per_page = 1;
  protected $link_prefix;
  protected $html;
  protected $built = false;

  function __construct($db) {
    // Get Total Pages
    $this->total_pages = ceil(
      getNumBlogPosts($db) / $this->posts_per_page
    );
    // Display Indicator if Multiple Pages
    if ($this->total_pages > 1) {
      // Get Current Page
      $this->curr_page = $this->getPage();
      // Generate Link Prefix
      $this->generateLinkPrefix();
      // Build and Display Indicator
      $this->display();
    }
  }

  protected function getPage() {
    $p = 1;  // page initialized as 1

    // Check URL "page" Paramater
    if (isset($_GET["page"])) {                    // is set
      $url_num = htmlspecialchars($_GET["page"]);  // initial sanitize
      if (
        (is_numeric($url_num)) &&                  // is number
        ($url_num >= 1) &&                         // is at least 1
        ($url_num <= $this->total_pages)           // is not beyond last page
      ) {
        $p = (int) $url_num;                       // SUCCESS - cast num to int
      } else { $p = 1; }                           // FAILURE - set page to 1
    }

    return $p;
  }

  private function generateLinkPrefix() {
    $url = $_SERVER['REQUEST_URI'];
    $pieces = explode("/", $url);

    // remove empty values
    $pieces = array_diff($pieces, [""]);

    // get last value
    $last = end($pieces);

    // set link prefix
    if (is_numeric($last)) {
      $last = (int) $last;
      $this->link_prefix = '../';
    } else {
      $this->link_prefix = '';
    }
  }

  private function generateNumLink($page_num) {
    if ($page_num == $this->curr_page) {
      $this->html .= '<span class="active">'.$page_num.'</span>';
    } else {
      $link = $this->link_prefix.$page_num;
      $this->html .= '<a href="'.$link.'/">'.$page_num.'</a>';
    }
  }

  private function generateNumLinks() {
    if ($this->total_pages <= 7) {
      // all page links will fit on indicator
      for ($p=1; $p<=$this->total_pages; $p++) {
        $this->generateNumLink($p);
      }

    } else {
      // some page links won't fit on indicator - must format them

      // Slot 1
      $this->generateNumLink(1);

      // Slot 2
      if ($this->curr_page <= 4) {
        $this->generateNumLink(2);
      } else {
        $this->html .= '<span>...</span>';
      }

      // Slots 3, 4, and 5
      if ($this->curr_page <= 4) {
        // curr_page at beginning
        for ($p=3; $p<=5; $p++) {
          $this->generateNumLink($p);
        }
      } else if ($this->total_pages - $this->curr_page < 4) {
        // curr_page at end
        for ($p=$this->total_pages-4; $p<=$this->total_pages-2; $p++) {
          $this->generateNumLink($p);
        }
      } else {
        // curr_page in middle
        for ($p=$this->curr_page-1; $p<=$this->curr_page+1; $p++) {
          $this->generateNumLink($p);
        }
      }

      // Slot 6
      if ($this->total_pages - $this->curr_page < 4) {
        $p = $this->total_pages - 1;
        $this->generateNumLink($p);
      } else {
        $this->html .= '<span>...</span>';
      }

      // Slot 7
      $this->generateNumLink($this->total_pages);
    }
  }

  protected function build() {
    // init HTML
    $this->html = '';

    // Opening HTML
    $this->html .= <<<ELEM_TOP
      <div class=" wrapper page-links-wrap">
        <nav class="page-links">
    ELEM_TOP;

    // Previous Link
    if ($this->curr_page > 1) {
      $prev_page = $this->curr_page - 1;
      $this->html .= <<<PREV_LINK
        <a class="end-link prev-link" href="{$this->link_prefix}{$prev_page}/">Previous</a>
      PREV_LINK;
    }

    // Numerical Links
    $this->generateNumLinks();

    // Next Link
    if ($this->curr_page < $this->total_pages) {
      $next_page = $this->curr_page + 1;
      $this->html .= <<<NEXT_LINK
        <a class="end-link next-link" href="{$this->link_prefix}{$next_page}/">Next</a>
      NEXT_LINK;
    }

    // Closing HTML
    $this->html .= <<<ELEM_BTM
      </nav>
    </div>
    ELEM_BTM;

    // mark self as built
    $this->built = true;
  }

  protected function display() {
    if (!($this->built)) { $this->build(); }
    echo $this->html;
  }
}


?>
