<?php

DEFINE("FILENAME", 'projects');
include('./includes/templates/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('./includes/templates/header.php');
include('./php/all_projects.php');
include('./includes/templates/footer.php');

echo <<<PAGE_END
  </body>
</html>
PAGE_END;

?>
