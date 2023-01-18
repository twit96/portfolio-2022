<?php

$footer_year = date("Y");

echo <<<FOOTERTOP
    <footer>
      <div class="wrapper">
        <div class="info">
          <img class="logo" src="/img/portrait.png" alt="Portrait"/>
          <span><em>Tyler Wittig</em> | Web Developer</span>
        </div>
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
        <span>&copy; {$footer_year} Tyler Wittig</span>
      </div>
    </footer>\n\n
FOOTERBTM;

?>
