<?php

$if = function($condition, $true, $false) { return $condition ? $true : $false; };

echo <<<HEADER
\n      <div id="loader"></div>

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
            <a href="/resume-tylerwittig-20230318.pdf">Résumé</a>
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
