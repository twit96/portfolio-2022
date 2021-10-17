<?php

include('../templates/head.php');
echo <<<HEAD_END
\n
  </head>
	<body>
HEAD_END;

include('../templates/header.html');
include('../php/all_projects.php');
include('../templates/footer.html');

echo <<<PAGE_END
\n
  </body>
</html>
PAGE_END;

?>
