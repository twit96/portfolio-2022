<?php
/**
* Display all errors.
*/
error_reporting(E_ALL);
ini_set("display_errors", "on");

DEFINE("FILENAME", 'articles');
include('./includes/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('./includes/header.php');
include('./includes/views/articles.php');
include('./includes/footer.php');

echo <<<PAGE_END
  </body>
</html>
PAGE_END;


?>
