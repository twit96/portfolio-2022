<?php


class URL {
  public $posts_per_page;
  public $total_pages;
  public $page_num;

  function __construct(
    $in_posts_per_page=1,
    $in_total_pages=1
  ) {
    $this->posts_per_page = (int) $in_posts_per_page;
    $this->total_pages = (int) $in_total_pages;
    $this->page_num = $this->getPage();
  }

  protected function getPage() {
    $p = 1;  // page initialized as 1

    // Check URL "page" Paramater
    if (isset($_GET["page"])) {                      // is set
      $url_num = htmlspecialchars($_GET["page"]);    // initial sanitize

      if (is_numeric($url_num)) {                    // is number
        $url_num = (int) $url_num;                   // cast to int

        if ($url_num > $this->total_pages) {
          $p = $this->total_pages;                   // if > max, set = max
        } else if (
          ($url_num >= 1) &&
          ($url_num <= $this->total_pages)
        ) {
          $p = $url_num;                             // between 1 and max, good
        }

      }
    }

    return (int) $p;
  }

}


?>
