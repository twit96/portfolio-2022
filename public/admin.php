<?php

DEFINE("FILENAME", 'admin');
include('../src/View/common/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

include('../src/View/common/header.php');
echo <<<SECTION_TOP
<main id="admin">
  <div class="wrapper">
    <h1>Admin</h1>
SECTION_TOP;

include('../src/controller/admin.php');

echo <<<SECTION_BTM
  </div>
</main>
SECTION_BTM;

include('../src/View/common/footer.php');


echo <<<PAGE_END
\n
  </body>
</html>
PAGE_END;

?>
