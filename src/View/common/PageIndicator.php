<?php


class PageIndicator {
  protected $total_pages;
  protected $page_name;
  protected $page_num;
  protected $html;
  protected $built = false;

  function __construct(
    $in_page_name=null,
    $in_page_num=1,
    $in_total_pages=1,
    $in_link_prefix=null
  ) {
    $this->page_num = $in_page_num;
    $this->total_pages = $in_total_pages;
    $this->link_prefix = $in_link_prefix;

    // Display Indicator if Multiple Pages
    if ($this->total_pages > 1) {
      $this->display();
    }
  }


  private function generateNumLink($page) {
    if ($page == $this->page_num) {
      $this->html .= '<span class="active">'.$page.'</span>';
    } else {
      $this->html .= '<a href="'.$this->link_prefix.$page.'/">'.$page.'</a>';
    }
  }

  private function generateNumLinks() {
    $this->html .= "<div>";

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
      if ($this->page_num <= 4) {
        $this->generateNumLink(2);
      } else {
        $this->html .= '<span>...</span>';
      }

      // Slots 3, 4, and 5
      if ($this->page_num <= 4) {
        // page_num at beginning
        for ($p=3; $p<=5; $p++) {
          $this->generateNumLink($p);
        }
      } else if ($this->total_pages - $this->page_num < 4) {
        // page_num at end
        for ($p=$this->total_pages-4; $p<=$this->total_pages-2; $p++) {
          $this->generateNumLink($p);
        }
      } else {
        // page_num in middle
        for ($p=$this->page_num-1; $p<=$this->page_num+1; $p++) {
          $this->generateNumLink($p);
        }
      }

      // Slot 6
      if ($this->total_pages - $this->page_num < 4) {
        $p = $this->total_pages - 1;
        $this->generateNumLink($p);
      } else {
        $this->html .= '<span>...</span>';
      }

      // Slot 7
      $this->generateNumLink($this->total_pages);
    }

    $this->html .= "</div>";
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
    if ($this->page_num > 1) {
      $prev_page = $this->page_num - 1;
      $this->html .= <<<PREV_LINK
        <a class="end-link prev-link" href="../{$prev_page}/">Previous</a>
      PREV_LINK;
    }

    // Numerical Links
    $this->generateNumLinks();

    // Next Link
    if ($this->page_num < $this->total_pages) {
      $next_page = $this->page_num + 1;
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
