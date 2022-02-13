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
    if (isset($_GET["page"])) {                    // is set
      $url_num = htmlspecialchars($_GET["page"]);  // initial sanitize

      if (is_numeric($url_num)) {                  // is numeric
        $url_num = (int) $url_num;                 // cast to int

        // if < 1, set page to 1
        if ($url_num < 1) { $p = 1; }
        // if > max, set page to max
        else if ($url_num > $this->total_pages) { $p = $this->total_pages; }
        // SUCCESS - within 1 and max
        else { $p = $url_num; }

      } else { $p = 1; }                           // not numeric? set page to 1
    }

    return $p;
  }

}


?>
