<?php

DEFINE("FILENAME", 'admin');
include('./includes/templates/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('./includes/templates/header.php');
echo <<<SECTION_TOP
<main id="entries">
  <div class="wrapper">
SECTION_TOP;

include('./php/admin_dashboard.php');

echo <<<SECTION_BTM
  </div>  <!-- ./wrapper -->
</main>
SECTION_BTM;

include('./includes/templates/footer.php');

echo <<<PAGE_END
\n
  </body>
</html>
PAGE_END;

?>
