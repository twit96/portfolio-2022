<?php

include('../templates/head.php');

echo <<<HEAD_END
\n
    <!-- Additional Head Tags -->
    <meta name="description" content="Tyler Wittig's Portfolio Admin Dashboard" />
    <link rel="stylesheet" type="text/css" href="/css/admin.css" />
  </head>
	<body>
HEAD_END;

include('../templates/header.html');
echo '<section id="entries">';
include('../php/admin_dashboard.php');
echo '</section>';
include('../templates/footer.html');

echo <<<PAGE_END
\n
  </body>
</html>
PAGE_END;

?>
