<?php

$footer_year = date("Y");

echo <<<FOOTERTOP
    <footer>
      <div class="wrapper">
        <span class="info"><em>Tyler Wittig</em> | Web Developer</span>
        <div class="links">
          <nav>
            <a href="/"{$if(FILENAME=='home',' class="active"','')}>Home</a>
            <a href="/projects"{$if(FILENAME=='projects',' class="active"','')}>Projects</a>
            <a href="/admin"{$if(FILENAME=='admin',' class="active"','')}>Admin</a>
          </nav>
FOOTERTOP;

include(__DIR__ .'/socials.html');

echo <<<FOOTERBTM
        </div>  <!-- ./links -->
        <span class="copyright">&copy; {$footer_year} Tyler Wittig</span>
      </div>
    </footer>\n\n
FOOTERBTM;

?>
