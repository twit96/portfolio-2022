<?php

DEFINE("FILENAME", 'admin');
require_once (__DIR__ .'/../src/View/common/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;

require_once (__DIR__ .'/../src/View/common/header.php');
echo <<<SECTION_TOP
<main id="admin">
  <div class="wrapper">
    <h1>Admin</h1>
SECTION_TOP;

require_once (__DIR__ .'/../src/Controller/admin.php');

echo <<<SECTION_BTM
  </div>
</main>
SECTION_BTM;

require_once (__DIR__ .'/../src/View/common/footer.php');


echo <<<PAGE_END
\n
  </body>
</html>
PAGE_END;

?>
