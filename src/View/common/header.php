<?php

$if = function($condition, $true, $false) { return $condition ? $true : $false; };

// Firefox-Only Bugfix - CSS filter on parent breaks fixed-positioning on children
// add style tag to top of HTML that removes CSS filter from html.dark-mode
if (isset($_SERVER['HTTP_USER_AGENT'])) {
  $agent = $_SERVER['HTTP_USER_AGENT'];
}
if (strlen(strstr($agent, 'Firefox')) > 0) {
  echo "\n".'      <style>html.dark-mode{filter:none;}</style>';
}

echo <<<HEADER
\n      <span id="scroll-down-indicator"></span>
      <span id="scroll-top-btn"></span>

      <header>
        <div class="wrapper">
          <span>
            <a href="/">TW</a>
          </span>
          <nav>
            <a href="/"{$if(FILENAME=='home',' class="active"','')}>Home</a>
            <a href="/projects"{$if(FILENAME=='projects',' class="active"','')}>Projects</a>
            <a href="/20221009-résumé-tylerwittig.pdf">Résumé</a>
            <div id="dark-toggle-wrap">
              <span class="slider"></span>
            </div>
          </nav>
          <div class="nav-toggle">
            <span></span>
            <span></span>
            <span></span>
          </div>
          <div id="header-bg"></div>
        </div>
      </header>\n
HEADER;


?>
