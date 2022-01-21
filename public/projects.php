<?php


DEFINE("FILENAME", 'projects');
include('../src/View/common/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('../src/View/common/header.php');


// Opening HTML
echo <<<TOP
\n    <main id="projects">
      <div class="wrapper">
        <h1>Projects</h1>
TOP;

include('../src/View/projects/projects.php');

// Closing HTML
echo "\n".'      </div>';
echo "\n".'    </main>'."\n\n";

include('../src/View/common/footer.php');

echo <<<PAGE_END
  </body>
</html>
PAGE_END;

?>
