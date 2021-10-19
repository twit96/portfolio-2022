<?php

$curr_dir = basename(getcwd());
$if = function($condition, $true, $false) { return $condition ? $true : $false; };


// Firefox-Only Bug Patch - Hide Dark-Mode Toggle if user on firefox (style="display:none;")
if (isset($_SERVER['HTTP_USER_AGENT'])) {
  $agent = $_SERVER['HTTP_USER_AGENT'];
}
if (strlen(strstr($agent, 'Firefox')) > 0) { $browser = 'firefox'; }
else { $browser = ''; }

echo <<<HEADER
\n    <div id="loader"></div>

    <label id="dark-toggle-wrap" for="dark-toggle"{$if($browser=='firefox',' style="display:none;"','')}>
      <span class="hidden-text">Dark Mode Toggle</span>
      <input id="dark-toggle" type="checkbox">
      <span class="slider"></span>
    </label>

    <header>
      <span>
        <a href="/">TW</a>
      </span>
      <nav>
        <a href="/"{$if($curr_dir=='html',' class="active"','')}>Home</a>
        <a href="/projects/"{$if($curr_dir=='projects',' class="active"','')}>Projects</a>
        <a class="resume" href="/20211003-résumé-tylerwittig.pdf">
          Résumé
        </a>
      </nav>
      <div class="nav-toggle">
        <span></span>
        <span></span>
        <span></span>
      </div>
      <div id="header-bg"></div>
    </header>
HEADER;


?>
