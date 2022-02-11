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

}


?>
