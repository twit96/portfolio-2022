<?php


class URL {
  public $url_string;
  public $page_num;
  public $page_num_link_prefix;  // used on relative links from current page

  function __construct($max_pages=1) {

    // Get URL String
    $this->url_string = $_SERVER['REQUEST_URI'];
    $pieces = explode("/", $this->url_string);

    $pieces = array_diff($pieces, [""]);  // remove empty values
    $last = end($pieces);                 // get last value

    // Config Page Num Value
    if (is_numeric($last)) {
      $last = (int) $last;
      if ($last < 1) {
        $this->page_num = 1;
      } else if ($last > $max_pages) {
        $this->page_num = $max_pages;
      } else {
        $this->page_num = $last;
      }
      $this->page_num_link_prefix = '../';
    } else {
      $this->page_num = 1;
      $this->page_num_link_prefix = '';
    }

  }
}


?>
