<?php
/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");

DEFINE("FILENAME", 'articles');
include('./includes/templates/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('./includes/templates/header.php');
include('./includes/views/articles.php');
include('./includes/templates/footer.php');

echo <<<PAGE_END
  </body>
</html>
PAGE_END;


?>
