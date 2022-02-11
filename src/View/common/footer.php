<?php

echo <<<FOOTER
    <footer>
      <div class="wrapper">
        <div class="info">
          <img class="logo" src="/img/profile.jpg" alt="Profile Image"/>
          <span><em>Tyler Wittig</em> | Web Developer</span>
        </div>
        <div class="links">
          <nav>
            <a href="/"{$if(FILENAME=='home',' class="active"','')}>Home</a>
            <a href="/projects"{$if(FILENAME=='projects',' class="active"','')}>Projects</a>
            <a href="/admin"{$if(FILENAME=='admin',' class="active"','')}>Admin</a>
          </nav>
          <div class="socials">
            <div>
              <a class="social-icon" href="mailto:tylerwittig@utexas.edu?subject=Web%20Developer%20Information" target="_blank" rel="noreferrer">
                <img src="/img/logo_email.png" alt="twitter logo" />
              </a>
              <a class="social-icon" href="https://github.com/twit96" target="_blank" rel="noreferrer">
                <img src="/img/logo_github.png" alt="github logo" />
              </a>
              <a class="social-icon" href="https://www.linkedin.com/in/tylerwittig/" target="_blank" rel="noreferrer">
                <img src="/img/logo_linkedin.png" alt="linkedin logo" />
              </a>
              <!-- <a class="social-icon" href="https://twitter.com/tyler_wittig" target="_blank" rel="noreferrer">
                <img src="/img/logo_twitter.png" alt="twitter logo" />
              </a> -->
            </div>
            <a class="resume" href="/20211003-résumé-tylerwittig.pdf">
              Download my Résumé
            </a>
          </div>  <!-- ./socials -->
        </div>  <!-- ./links -->
        <span>&copy; 2022 Tyler Wittig</span>
      </div>
    </footer>\n\n
FOOTER;

?>
