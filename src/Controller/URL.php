<?php


class URL {
  public $url_string;
  public $posts_per_page;
  public $total_pages;
  public $page_num;
  public $page_link_prefix;  // used on relative links from current page

  function __construct(
    $in_posts_per_page=1,
    $in_total_pages=1
  ) {
    $this->posts_per_page = $in_posts_per_page;
    $this->total_pages = $in_total_pages;

    // Get URL String
    $this->url_string = $_SERVER['REQUEST_URI'];
    $pieces = explode("/", $this->url_string);
    $pieces = array_diff($pieces, [""]);  // remove empty values
    $last = end($pieces);                 // get last value

    // Config Curr Page Num and Link Prefix
    if (is_numeric($last)) {
      $last = (int) $last;
      if ($last < 1) {
        $this->page_num = 1;
      } else if ($last > $this->total_pages) {
        $this->page_num = $this->total_pages;
      } else {
        $this->page_num = $last;
      }
      $this->page_link_prefix = '../';
    } else {
      $this->page_num = 1;
      $this->page_link_prefix = '/';
    }

  }

}


?>
