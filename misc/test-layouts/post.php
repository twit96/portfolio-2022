<?php

DEFINE("FILENAME", 'post');
include('../../includes/templates/head.php');
echo '<meta name="robots" content="noindex">';
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('../../includes/templates/header.php');

?>

    <main id="post">
      <div class="wrapper">

        <article>
          <div class="card details" style="background-image: url(/img/projects/first-portfolio/title-card.png)">
            <h1>First Portfolio Website is First is First</h1>
            <ul class="tags">
              <li><a href="#">Web Game</a></li>
              <li><a href="#">JavaScript</a></li>
              <li><a href="#">Grid Traversal</a></li>
              <li><a href="#">Responsive</a></li>
            </ul>
            <div class="author">
              <img src="/img/profile.jpg"/>
              <p>
                <b>Tyler Wittig</b> on <span>2020-09-01</span> (Updated on <span>2021-11-06)</span>
              </p>
            </div>
            <div class="btm-border"></div>
          </div>  <!-- ./card details -->
          <div class="card">
            <h2>Did you know this?</h2>
            <p>
              We’re all familiar with the concept of autocompletion, right?
              You type something into a search box and it tries to guess what
              you’re looking for as you type, displaying suggestions, often
              below the cursor. While we’re used to autocomplete on eCommerce
              sites that redirect to search or product pages, an underrated
              usage is when used as a secondary search pattern to augment the
              typing experience.
            </p>
            <h3>Here is some code about it</h3>

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
            <h4>Here is the code explanation</h4>
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
            <h3>So what is next?</h3>
            <p>
              We’re all familiar with the concept of autocompletion, right?
              You type something into a search box and it tries to guess what
              you’re looking for as you type, displaying suggestions, often
              below the cursor. While we’re used to autocomplete on eCommerce
              sites that redirect to search or product pages, an underrated
              usage is when used as a secondary search pattern to augment the
              typing experience.
            </p>
            <h4>Should we do that?</h4>
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
            <h5>Pros</h5>
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
            <h6>Pro 1</h6>
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
            <h6>Pro 2</h6>
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
            <h6>Pro 3</h6>
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
            <h5>Cons</h5>
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
            <h6>Con 1</h6>
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
            <h6>Con 2</h6>
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
            <h6>Con 3</h6>
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
            <h3>What others know about it</h3>
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
            <h2>A similar problem</h2>
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
            <h3>What others know about it</h3>
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
            <h3>It has an easier solution</h3>
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
            <h2>In Conclusion</h2>
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
          <div id="toc" class="card">
            <div id="toc-toggle"><span></span></div>
            <h3>Table of Contents</h3>
            <nav></nav>
          </div>
          <div id="toc-bg"></div>
          <script src="/js/toc.js" defer></script>
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
      include('../../includes/templates/footer.php');
    ?>
  </body>
</html>
