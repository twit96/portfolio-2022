<?php


DEFINE("FILENAME", 'projects');
require_once (__DIR__ .'/../src/View/common/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

require_once (__DIR__ .'/../src/View/common/header.php');


// Opening HTML
echo <<<TOP
\n    <main id="projects">
      <div class="wrapper">
        <h1>Projects</h1>
TOP;

require_once (__DIR__ .'/../src/View/projects/projects.php');

// Close Projects Section Wrapper
echo "\n".'      </div>';

// Page Indicator
// new PageIndicator(
//   $url->page_num,
//   $url->total_pages
// );

// Closing HTML
echo "\n".'    </main>'."\n\n";

require_once (__DIR__ .'/../src/View/common/footer.php');

echo <<<PAGE_END
  </body>
</html>
PAGE_END;

?>
