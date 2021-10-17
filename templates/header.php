<?php

$curr_dir = basename(getcwd());
$if = function($condition, $true, $false) { return $condition ? $true : $false; };


echo <<<HEADER
<div id="loader"></div>

<label id="dark-toggle-wrap" for="dark-toggle">
  <span class="hidden-text">Dark Mode Toggle</span>
  <input id="dark-toggle" type="checkbox">
  <span class="slider"></span>
</label>

<header>
  <span>
    <a href="/">TW</a>
  </span>
  <nav>
    <a href="/" {$if($curr_dir=='html','class="active"','')}>Home</a>
    <a href="/projects/" {$if($curr_dir=='projects','class="active"','')}>Projects</a>
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
