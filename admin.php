<?php

DEFINE("FILENAME", 'admin');
include('./templates/head_new.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('./templates/header.php');
echo '<section id="entries">';
include('./php/admin_dashboard.php');
echo '</section>';
include('./templates/footer.php');

echo <<<PAGE_END
\n
  </body>
</html>
PAGE_END;

?>