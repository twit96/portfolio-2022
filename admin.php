<?php

DEFINE("FILENAME", 'admin');
include('./includes/templates/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('./includes/templates/header.php');
echo <<<SECTION_TOP
<main id="admin">
  <div class="wrapper">
    <h1>Admin</h1>
SECTION_TOP;

include('./includes/models/admin.php');

echo <<<SECTION_BTM
  </div>
</main>
SECTION_BTM;

include('./includes/templates/footer.php');


echo <<<PAGE_END
\n
  </body>
</html>
PAGE_END;

?>
