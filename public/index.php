<?php

DEFINE("FILENAME", 'home');
require_once (__DIR__ .'/../src/View/common/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

require_once (__DIR__ .'/../src/View/common/header.php');

// Opening HTML
echo <<<TOP
\n    <main id="home">
      <div class="wrapper">
TOP;

include (__DIR__ .'/../src/View/home/intro.html');
include (__DIR__ .'/../src/View/home/skills.html');
include (__DIR__ .'/../src/View/home/featured_projects.php');
include (__DIR__ .'/../src/View/home/demo.html');

// Closing HTML
echo "\n".'      </div>';
echo "\n".'    </main>'."\n\n";

require_once (__DIR__ .'/../src/View/common/footer.php');

echo <<<PAGE_END
  </body>
</html>
PAGE_END;

?>
