<?php

DEFINE("FILENAME", 'admin');
include('./includes/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('./includes/header.php');
echo '<section id="entries">';
include('./php/admin_dashboard.php');
echo '</section>';
include('./includes/footer.php');

echo <<<PAGE_END
\n
  </body>
</html>
PAGE_END;

?>
