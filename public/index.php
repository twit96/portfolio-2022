<?php

DEFINE("FILENAME", 'home');
include('../src/View/common/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('../src/View/common/header.php');

// Opening HTML
echo <<<TOP
\n    <main id="home">
      <div class="wrapper">
TOP;

include('../src/View/home/intro.html');
include('../src/View/home/skills.html');
include('../src/View/home/projects_featured.php');
include('../src/View/home/demo.html');

// Closing HTML
echo "\n".'      </div>';
echo "\n".'    </main>'."\n\n";

include('../src/View/common/footer.php');

echo <<<PAGE_END
  </body>
</html>
PAGE_END;

?>
