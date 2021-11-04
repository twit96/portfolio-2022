<?php

DEFINE("FILENAME", 'post');
include('../../includes/head.php');
echo '<meta name="robots" content="noindex">';
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('../../includes/header.php');

?>

    <main id="post">
      <div class="wrapper">
        <div id="title-img">
          <img src="/img/projects/first-portfolio/title-card.png" alt="Title Card" />
        </div>
        <article>

          <div class="details">
            <h2>First Portfolio Website is First is First</h2>
            <ul class="tags">
              <li><a href="#">Web Game</a></li>
              <li><a href="#">JavaScript</a></li>
              <li><a href="#">Grid Traversal</a></li>
              <li><a href="#">Responsive</a></li>
            </ul>
            <div class="author">
              <img src="/img/profile.jpg"/>
              <p>
                Posted by <b>Tyler Wittig</b> on 2020-09-01
              </p>
            </div>
            <div class="blurb">
              Grow sales with a smart marketing platform. Try Mailchimp today.
            </div>
          </div>  <!-- ./details -->


          <div class="card">
            <p>
              We’re all familiar with the concept of autocompletion, right?
              You type something into a search box and it tries to guess what
              you’re looking for as you type, displaying suggestions, often
              below the cursor. While we’re used to autocomplete on eCommerce
              sites that redirect to search or product pages, an underrated
              usage is when used as a secondary search pattern to augment the
              typing experience.
            </p>

<pre><code>#title-img {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100vh;
  opacity: 0.75;
  z-index: -1;
}

#title-img::after {
  content: '';
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-image: radial-gradient(ellipse, transparent, var(--green) 75%);
}</code></pre>
            <p>
              In modern web applications, there’s no reason a composition box
              has to be a dull, plain text area, or limit itself to rich text
              formatting. Social and productivity apps like Twitter, Slack,
              Notion, Google Docs, and Asana have popularized the “@mention”
              pattern, allowing you to reference other users as you type. You
              can mention another person, a channel, a file, or some other
              queryable object using triggers, such as the @ or # characters.
              This opens a panel with suggestions, letting you complete your
              message with the right reference.
            </p>
            <figure>
              <img src="/img/projects/first-portfolio/title-card.png" alt="Post Title Card" />
              <figcaption>This is an image within a figure</figcaption>
            </figure>
            <p>
              We’re all familiar with the concept of autocompletion, right?
              You type something into a search box and it tries to guess what
              you’re looking for as you type, displaying suggestions, often
              below the cursor. While we’re used to autocomplete on eCommerce
              sites that redirect to search or product pages, an underrated
              usage is when used as a secondary search pattern to augment the
              typing experience.
            </p>
            <p>
              In modern web applications, there’s no reason a composition box
              has to be a dull, plain text area, or limit itself to rich text
              formatting. Social and productivity apps like Twitter, Slack,
              Notion, Google Docs, and Asana have popularized the “@mention”
              pattern, allowing you to reference other users as you type. You
              can mention another person, a channel, a file, or some other
              queryable object using triggers, such as the @ or # characters.
              This opens a panel with suggestions, letting you complete your
              message with the right reference.
            </p>
          </div>  <!-- ./card -->

        </article>
        <div id="sidebar">
          <nav class="card">
            <h3>Table of Contents</h3>
            <a href="#">This is the first</a>
            <a href="#">And the Second</a>
            <a href="#">Plus #3</a>
          </nav>
          <div class="card">
            <p>
              We’re all familiar with the concept of autocompletion, right?
              You type something into a search box and it tries to guess what
              you’re looking for as you type, displaying suggestions, often
              below the cursor.
            </p>
            <p>
              While we’re used to autocomplete on eCommerce
              sites that redirect to search or product pages, an underrated
              usage is when used as a secondary search pattern to augment the
              typing experience.
            </p>
          </div>
        </div>  <!-- #/sidebar -->

      </div>  <!-- ./wrapper -->
    </main>

    <?php
      include('../../includes/footer.php');
    ?>
  </body>
</html>
