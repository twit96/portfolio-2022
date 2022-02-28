<?php


DEFINE("FILENAME", 'user');
require_once (__DIR__ .'/../src/View/common/head.php');
echo <<<HEAD_END
\n  </head>
  <body>
HEAD_END;


require_once (__DIR__ .'/../src/View/common/header.php');

echo <<<SECTION_TOP
<main id="user">
  <div class="wrapper">
    <h1>User</h1>
SECTION_TOP;

require_once (__DIR__ .'/../src/Controller/user.php');

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
