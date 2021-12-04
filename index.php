<?php

DEFINE("FILENAME", 'home');
include('./includes/templates/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('./includes/templates/header.php');

// Opening HTML
echo <<<TOP
\n    <main id="home">
      <div class="wrapper">
TOP;

include('./includes/views/intro.html');
include('./includes/views/skills.html');
include('./includes/views/projects_featured.php');
include('./includes/views/demo.html');

// Closing HTML
echo "\n".'      </div>';
echo "\n".'    </main>'."\n\n";

include('./includes/templates/footer.php');

echo <<<PAGE_END
  </body>
</html>
PAGE_END;

?>
