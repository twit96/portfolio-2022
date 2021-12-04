<?php

DEFINE("FILENAME", 'home');
include('./includes/templates/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('./includes/templates/header.php');

?>

    <main id="home">
      <div class="wrapper">

        <article id="intro">
          <div id="logo-container">
    				<div id="main-logo-wrap">
    					<img id="main-logo" src="/img/icon.png" alt="site logo" />
    					<span class="main-logo-overlay"></span>
    				</div>
    			</div>
          <div class="blurb">
            <p>
              Well <i>hello</i> world,
              <br />
              My name is Tyler and I am a full-stack web developer.<br />
              I specialize in...
            </p>
            <p>
              <span class="active tagline">Custom Websites</span>
              <span class="tagline">Website Redesigns</span>
              <span class="tagline">Game Development</span>
            </p>
          </div>
          <div class="details">
            <h1>Tyler Wittig</h1>
            <h2>Web Developer</h2>
            <div class="links">
              <a href="mailto:tylerwittig@utexas.edu?subject=Web%20Developer%20Information" target="_blank" rel="noreferrer">
                <img src="/img/logo_email.png" alt="twitter logo" />
              </a>
              <a href="https://github.com/twit96" target="_blank" rel="noreferrer">
                <img src="/img/logo_github.png" alt="github logo" />
              </a>
              <a href="https://www.linkedin.com/in/tylerwittig/" target="_blank" rel="noreferrer">
                <img src="/img/logo_linkedin.png" alt="linkedin logo" />
              </a>
            </div>  <!-- ./links -->
          </div>  <!-- ./details -->
        </article>  <!-- #/intro -->

        <?php include('./includes/views/skills.html'); ?>
        <?php include('./includes/views/projects_featured.php'); ?>

        <article id="demo">
          <div class="flex">
            <div class="blurb">
              <h2>Your New Website</h2>
              <p>
                Whether a static website or one with an integrated database,
                I build websites from the ground up to meet your needs.
              </p>
            </div>
            <figure class="with-css with-js with-php with-sql with-host">
              <div class="website">
                <div class="monitor">
                  <span class="title">Your Website</span>
                </div>
                <span class="text">HTML</span>
                <span class="text"> / CSS</span>
                <span class="text"> / JS</span>
              </div>
              <div class="pipeline">
                <span class="pipe"></span>
                <span class="pipe"></span>
                <span class="text">PHP</span>
              </div>
              <div class="database">
                <div>
                  <span class="light"></span>
                  <span class="light"></span>
                  <span class="light"></span>
                  <span class="title">Database</span>
                </div>
                <span class="text">SQL</span>
              </div>
              <span class="text">Host</span>
            </figure>
          </div>  <!-- ./flex -->
          <div id="demo-controls">
            <div class="btn-text play">
              <span class="icon"></span>
              <span class="text">Play</span>
            </div>
            <div class="btn-text stop disabled">
              <span class="icon"></span>
              <span class="text">Stop</span>
            </div>
          </div>  <!-- #/demo-controls -->
        </article>  <!-- #/demo -->

      </div>  <!-- ./wrapper -->
    </main>  <!-- #home -->

<?php include('./includes/templates/footer.php'); ?>
  </body>
</html>
