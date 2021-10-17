<?php

include('../templates/head.php');
echo <<<HEAD_END
\n
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
