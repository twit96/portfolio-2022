<?php

DEFINE("FILENAME", 'admin');
include('./includes/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('./includes/header.php');
echo <<<SECTION_TOP
<section id="entries">
  <div class="wrapper">
SECTION_TOP;

include('./php/admin_dashboard.php');

echo <<<SECTION_BTM
  </div>  <!-- ./wrapper -->
</section>
SECTION_BTM;

include('./includes/footer.php');

echo <<<PAGE_END
\n
  </body>
</html>
PAGE_END;

?>
