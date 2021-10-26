<?php

DEFINE("FILENAME", 'projects');
include('./templates/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('./templates/header.php');
include('./php/all_projects.php');
include('./templates/footer.php');

echo <<<PAGE_END
  </body>
</html>
PAGE_END;

?>
