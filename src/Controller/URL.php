<?php


class URL {
  public $posts_per_page;
  public $total_pages;
  public $page_num;

  function __construct(
    $in_posts_per_page=1,
    $in_total_pages=1
  ) {
    $this->posts_per_page = $in_posts_per_page;
    $this->total_pages = $in_total_pages;
    $this->page_num = $this->getPage();
  }

  protected function getPage() {
    $p = 1;  // page initialized as 1

    // Check URL "page" Paramater
    if (
      (isset($_GET["page"])) &&
      is_int($_GET["page"])
    ) {
      $url_num = $_GET["page"];                   // if is integer, check value
      if ($url_num < 1) {
        $p = 1;                                   // below 1, set equal to 1
      } else if ($url_num > $this->total_pages) {
        $p = $this->total_pages;                  // above max, set equal to max
      } else {
        $p = $url_num;                            // within 1 and max, all good
      }
    }

    return $p;
  }

}


?>
