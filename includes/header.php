<?php

$if = function($condition, $true, $false) { return $condition ? $true : $false; };

echo <<<HEADER
\n    <div id="loader"></div>

    <span id="scroll-down-indicator"></span>
    <span id="scroll-top-btn"></span>

    <header>
      <div class="wrapper">
        <span>
          <a href="/">TW</a>
        </span>
        <nav>
          <a href="/"{$if(FILENAME=='home',' class="active"','')}>Home</a>
          <a href="/projects"{$if(FILENAME=='projects',' class="active"','')}>Projects</a>
          <a class="resume" href="/20211003-résumé-tylerwittig.pdf">
            Résumé
          </a>
          <label id="dark-toggle-wrap" for="dark-toggle">
            <span class="hidden-text">Dark Mode Toggle</span>
            <input id="dark-toggle" type="checkbox">
            <span class="slider"></span>
          </label>
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
