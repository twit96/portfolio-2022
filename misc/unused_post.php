<?php

DEFINE("FILENAME", 'post');
include('./includes/templates/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('../includes/templates/header.php');
// include('../php/post.php');
include('../includes/templates/footer.php');

echo <<<PAGE_END
  </body>
</html>
PAGE_END;


?>
