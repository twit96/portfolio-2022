<?php


DEFINE("FILENAME", 'projects');
include('./includes/templates/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('./includes/templates/header.php');


// Opening HTML
echo <<<TOP
\n    <main id="projects">
      <div class="wrapper">
        <h1>Projects</h1>
TOP;

include('./includes/views/projects.php');

// Closing HTML
echo "\n".'      </div>';
echo "\n".'    </main>'."\n\n";

include('./includes/templates/footer.php');

echo <<<PAGE_END
  </body>
</html>
PAGE_END;

?>
